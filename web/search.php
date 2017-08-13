<?php
if (empty($_POST['name']))
	$errors['name'] = 'Name is required.';
else 
	$name = $_POST['name'];

if (empty($_POST['page']))
	$page = 1;
else 
	$page = $_POST['page'];

// response if there are errors
if ( ! empty($errors)) {

  // if there are items in our errors array, return those errors
	$data['success'] = false;
	$data['errors']  = $errors;
} else {

  // if there are no errors, return a message
	$data['success'] = true;
	$data['message'] = 'Success!';
}

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

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
	return;
}
echo $response;