<?php
	session_start();
	if ($_SESSION['logincount'] === null){
		$_SESSION['logincount'] = 0;
	}else{
		$loginattempts = $_SESSION['logincount'];
	}
	session_write_close();
?>
<div class="container signup-body">
	<h2 class="log-h2">Sign In</h2>
    <p style="color:red;text-align:center;"><?php echo $error ?> </p>      
	<div class="container form-container">
		<form action='/signin' method='POST'>
			<input type='hidden' name='_method' value='post' />
			<?php
                require PARTIALS."/form.email.php";
	            require PARTIALS."/form.password.php";
			?>
			<input class='log-button' type='submit' value='Sign in'/>
		</form>
	</div>
	<p style="text-align: center;"><a href='/signup'>New user?</a></p>
</div>