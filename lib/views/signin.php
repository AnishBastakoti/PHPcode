<h1>Signin Page</h1>
<div>
<form action='?signin' method='POST'>
 <input type='hidden' name='_method' value='post' />
 <?php
  require PARTIALS."/form.name.php";
	require PARTIALS."/form.password.php";
  require PARTIALS."/form.password-confirm.php";
  require PARTIALS."/form.email.php";
 ?>
 <input type='submit' value='Sign in' href='home.php' />
</form>
</div>
