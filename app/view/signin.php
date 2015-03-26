<?php
// WH since we defined LOADED in our settings file, this should be defined here unless 
// the file is accessed directly 
if(!defined('LOADED')){
	header("HTTP/1.1 403 Forbidden")&die('403.14 - Directory listing denied.');
}
?>
<body class="dark-body">
<div class="container">
	<div class="col-md-4 col-md-push-4 login-box">
		<form action="">
			<div class="form-group">
				<label for="">Username</label>
				<input type="text" name="username" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="">Password</label>
				<input type="password" name="password" class="form-control" required>
			</div>
			<div class="form-group"><button class="btn btn-sm btn-default">login</button></div>
		</form>
	</div>
</div>