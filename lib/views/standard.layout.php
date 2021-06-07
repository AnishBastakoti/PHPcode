<!DOCTYPE html>
<html lang="en-GB">
<head>
<meta charset='utf-8' />
<title><?php echo $messages['title']; ?></title>
 <link rel="stylesheet" href="/css/standard.css" />
</head>
<body>

<!--navigation  -->
<div id="main">
<nav class="nav">
  <ul>
    <li><a href='/'>Home</a></li>
    <li><a href='/user_page'>Login</a></li>
  </ul>
</nav>

<!-- content section -->
<div id='content'>
<?php
  if(!empty($flash)){
    echo "<p id='flash'>{$flash}</p>";
  }
  require VIEWS."/{$content}.php";
?>
</div> <!-- end content -->

</div> <!-- end main -->

</body>
</html>
