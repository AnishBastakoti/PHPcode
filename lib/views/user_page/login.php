<h1>Login Page</h1>
<div>
<form action='/login' method='POST'>
 <input type='hidden' name='_method' value='post' />
 <?php
  require PARTIALS."/form.email.php";
	require PARTIALS."/form.password.php";
 ?>
 <a href=""> Forget Password </a>
 <input type='submit' value='Login' />

<p>Doesn't have an account? <a href='/signup'>Signup</a></p>
</form>

</div>
