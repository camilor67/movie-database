<?php
if (empty($_REQUEST['id']))
	$errors['id'] = 'id is required.';
else 
	$id = $_REQUEST['id'];

if ( ! empty($errors)) {

	$data['success'] = false;
	$data['errors']  = $errors;
} else {
	$data['success'] = true;
	$data['message'] = 'Success!';
}

$curl = curl_init();
$params = http_build_query(['language'=>'en-US','api_key'=>'7bdfd53d5ec326c2ba6e6c6116477956']);
curl_setopt_array($curl, array(
	CURLOPT_URL => "https://api.themoviedb.org/3/person/".$id."/movie_credits?".$params,
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
$response = json_decode($response);
$movies = $response->cast;
usort($movies, function($a, $b) {
	return $a->release_date <= $b->release_date;
});

$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://api.themoviedb.org/3/person/".$id."?".$params,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_POSTFIELDS => "{}",
	));

$personDetail = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  // echo "cURL Error #:" . $err;
}

$personDetail = json_decode($personDetail);
$profile_path = ($personDetail->profile_path)?'https://image.tmdb.org/t/p/w600_and_h900_bestv2'.$personDetail->profile_path:'images/movie.png';

include_once 'header-person.php';
?>
<div class="container initiative">
	<article class="inner clearfix">
		<div class="profile_detail">
			<div class="image_content">
				<img class="poster" data-sizes="auto" data-src="<?php echo $profile_path?>" data-srcset="<?php echo $profile_path?> 1x, https://image.tmdb.org/t/p/w600_and_h900_bestv2/lhjnYohEn2HflqCEnWuuilcNUsj.jpg 2x" alt="<?php echo $personDetail->name?>" sizes="300px" srcset="<?php echo $profile_path?> 1x, https://image.tmdb.org/t/p/w600_and_h900_bestv2/lhjnYohEn2HflqCEnWuuilcNUsj.jpg 2x" src="<?php echo $profile_path?>">
			</div>
			<div class="detail_content">
				<h2><?php echo $personDetail->name?></h2>
				<p><?php echo $personDetail->biography?></p>
			</div>
		</div>
		<div class="results">
			<?php foreach($movies as $movie):?>
				<?php $movie_profile_path = ($movie->poster_path)?'https://image.tmdb.org/t/p/w600_and_h900_bestv2'.$movie->poster_path:'images/movie.png';?>
				<div class="item profile list_item">
					<div class="image_content profile">
						<img class="profile lazyautosizes lazyloaded" data-sizes="auto" src="<?= $movie_profile_path ?>" alt="<?= $movie->title ?>">
					</div>

					<div class="content">
						<p class="name"><?= $movie->title ?></p>
						<p class="sub">
							<?php echo (isset($movie->release_date))?$movie->release_date:'' ?>
						</p>
						<p class="sub">
							<?= $movie->overview ?>
						</p>
					</div>
				</div>
			<?php endforeach;?>
		</div>
	</article>
</div>
<?php include_once 'footer.php'; ?>