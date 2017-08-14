<?php
if (empty($_REQUEST['name']))
	$errors['name'] = 'Name is required.';
else 
	$name = $_REQUEST['name'];

if (empty($_REQUEST['page']))
	$page = 1;
else 
	$page = $_REQUEST['page'];

if ( ! empty($errors)) {
	$data['success'] = false;
	$data['errors']  = $errors;
} else {
	$data['success'] = true;
	$data['message'] = 'Success!';
}
$resultsSearch = array();
$curl = curl_init();
$params = http_build_query(['include_adult'=>'true','page'=>$page,'language'=>'en-US','api_key'=>'7bdfd53d5ec326c2ba6e6c6116477956','query'=>$name]);
curl_setopt_array($curl, array(
	CURLOPT_URL => "https://api.themoviedb.org/3/search/person?".$params,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_POSTFIELDS => "{}",
	));

$persons = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	// echo "cURL Error #:" . $err;
	// return;
}
$persons = json_decode($persons);

foreach ($persons->results as $key => $person) {
	$person_tmp = new stdClass();
	$person_tmp->id = $person->id;
	$person_tmp->name = $person->name;
	$person_tmp->profile_path = ($person->profile_path)?'https://image.tmdb.org/t/p/w90_and_h90_bestv2'.$person->profile_path:'images/movie.png';
	$person_tmp->known_for = '';
	foreach ($person->known_for as $known_for) {
		$person_tmp->known_for .= (isset($known_for->original_name))?$known_for->original_name.', ':$known_for->original_title.', ';
	}
	$person_tmp->known_for = substr($person_tmp->known_for, 0, -2);
	$resultsSearch[] = $person_tmp;
}
// echo "<pre>".print_r($resultsSearch,true)."</pre>";

$curl = curl_init();
$params = http_build_query(['include_adult'=>'true','page'=>$page,'language'=>'en-US','api_key'=>'7bdfd53d5ec326c2ba6e6c6116477956','query'=>$name]);
curl_setopt_array($curl, array(
	CURLOPT_URL => "https://api.themoviedb.org/3/search/movie?".$params,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_POSTFIELDS => "{}",
	));

$movies = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	// echo "cURL Error #:" . $err;
}

$movies = json_decode($movies);

foreach ($movies->results as $movie) {
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.themoviedb.org/3/movie/".$movie->id."/credits?api_key=7bdfd53d5ec326c2ba6e6c6116477956",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "{}",
		));

	$cast = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	}
	$cast = json_decode($cast);
	// echo $movie->title;
	// echo "<pre>".print_r($cast->cast,true)."</pre>";
	foreach ($cast->cast as $key => $person) {
		$person_tmp = new stdClass();
		$person_tmp->id = $person->id;
		$person_tmp->name = $person->name;
		$person_tmp->profile_path = ($person->profile_path)?'https://image.tmdb.org/t/p/w90_and_h90_bestv2'.$person->profile_path:'images/movie.png';
		$person_tmp->known_for = $movie->title;
		$resultsSearch[] = $person_tmp;
	}
	// echo "<pre>".print_r($cast->cast,true)."</pre>";
}

// echo "<pre>".print_r($resultsSearch,true)."</pre>";
echo json_encode($resultsSearch);
