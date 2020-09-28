<?php
	session_start();
	$loginattempts = $_SESSION['logincount'];
	session_write_close();

	if ($loginattempts === null){
		$loginattempts = 0;
	}elseif($loginattempts > 5)
	{
		$loginattempts = 5;
		$lockout = true;
	}
	else{
		$loginattempts = $_SESSION['logincount'];
	}
?>
<div class="container signup-body">
	<h2 class="log-h2">Sign In</h2>
    <p style="color:red;text-align:center;"><?php echo $error ?> </p>   
	<div class="container form-container">
		<?php 
			if ($loginattempts !== null && $loginattempts > 1){
				$remaining = 5 - $loginattempts;	
				echo "<p class='text-danger'>Login attempts left: {$remaining}</p>";
			}
		?>
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