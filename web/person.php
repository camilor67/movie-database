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

include_once 'header.php';
?>
<div class="container initiative">
	<article class="inner clearfix">
		<div class="results">
			<?php foreach($movies as $movie):?>
			<div class="item profile list_item">
				<div class="image_content profile">
					<img class="profile lazyautosizes lazyloaded" data-sizes="auto" src="https://image.tmdb.org/t/p/w90_and_h90_bestv2<?= $movie->poster_path ?>" alt="<?= $movie->title ?>">
				</div>

				<div class="content">
					<p class="name"><?= $movie->title ?></p>
					<p class="sub">
						<?= $movie->release_date ?>
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