<h1>Sign up</h1>
<div>
<form action='?signin' method='POST'>
 <input type='hidden' name='_method' value='post' />
 <?php
  require PARTIALS."/form.name.php";
	require PARTIALS."/form.password.php";
	require PARTIALS."/form.password-confirm.php";
  require PARTIALS."/form.email.php";
 ?>
 <input type='submit' value='Sign up' a href='home.php' />
</form>
</div>
