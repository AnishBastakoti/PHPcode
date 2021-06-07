<!DOCTYPE html>
<html lang="en-GB">
<head>
<meta charset='utf-8' />
<title><?php echo $title?></title>
<link rel="stylesheet" href="/css/different.css" />
</head>
<body>
<div id="main">
  <!-- navigation bar -->
<nav id="navbar">
  <a class="active" href="javascript:void(0)" href='/'>Home</a>
  <a href="javascript:void(0)" href='?signin'>Sign in</a>
  <a href="javascript:void(0)" href='?signup'>Sign up</a>
  <a href="javascript:void(0)" href='?signout'>Sign out</a>
  <a href="javascript:void(0)" href='?change'>Change password</a>
</nav>


<div id='content'>
<?php
  if(!empty($flash)){
    echo "<p id='flash'>{$flash}</p>";
  }
  require VIEWS."/{$content}.php";
?>
</div> <!-- end content -->

</div> <!-- end main -->

<script src='javascript/sticky.js'></script>
</body>
</html>
