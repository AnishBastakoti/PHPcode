<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<meta charset='utf-8' />
		<title><?php echo $messages['title']; ?></title>
		<link rel="stylesheet" href="/css/standard.css" />
	</head>
	<body>
		<div id="main">
			<nav>
				<ul>
					<?php
					 if(empty($_SESSION['user_id'])){

						echo "";
					 }else{
						 echo "<li><a href='/user_page'>Home</a></li>";
						 echo "<li><a href='/user_page/post'>post</a></li>";
						 echo "<li><a href='/signout'>logout</a></li>";
					 }
					?>
				</ul>
				<h3>
					<?php
					if(!empty($_SESSION['first_name']) && empty($_SESSION['admin'])){
						echo "Welcome ".$_SESSION['first_name'];
					}
					?>
				</h3>
			</nav>


			<div id='content'>
			<?php
			  if(!empty($flash)){
				echo "<p id='flash'>{$flash}</p>";
			  }

			  require VIEWS."/user_page/{$content}.php";
			?>
			</div> <!-- end content -->

		</div> <!-- end main -->

	</body>
</html>
