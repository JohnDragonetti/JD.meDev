<?php 
// WH 404 page


$message = $this->arr_params[1];


echo '<div class="container">
	<div class="col-md-6 col-md-push-3">
	<h1>404</h1>
	<h2>Whoops</h2>
	<div class="">
		The page you requested ('.$message.') does not exist. 
	</div>
</div>';

?>

