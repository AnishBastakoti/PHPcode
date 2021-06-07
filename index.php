<?php
session_start();//starting the php session
ini_set('display_errors','On');//for error reporting

// defining Paths
DEFINE("LIB",$_SERVER['DOCUMENT_ROOT']."/lib");
DEFINE("VIEWS",LIB."/views");
DEFINE("PARTIALS",VIEWS."/partials");

//paths for the files
DEFINE("DB",LIB."/db.php");
DEFINE("APP",LIB."/application.php");

//layout defining
DEFINE("LAYOUT","standard");

require DB;//Database
require APP;

$messages = array();

get("/",function(){ //path for index page
   force_to_http("/");
   $messages["message"]="Welcome";
   $messages["title"] = "Home";

   render($messages,LAYOUT,"home");
});

//path for singin option
get("/signin",function(){
   force_to_http("/?signin");
   $messages["title"] = "Sign in";
   render($messages,"standard","signin");
});

//path for signup
get("/signup",function(){
   force_to_http("/?signup");
   $messages["title"] = "Sign up";
   render($messages,LAYOUT,"signup");
});

//path for changing the password
get("/change",function(){
   force_to_http("/?change");
   $messages["title"] = "Change password";
   render($messages,LAYOUT,"change_password");
});

//path for signout
get("/signout",function(){
   force_to_http("/signout");
   set_flash("You are now signed out.");// session message
   signout();
   redirect_to("/user_page");//redirects to home page
});

post("/signup",function(){//path for signup function
  set_flash("You are now signed up,".form('name'));//message once signed up
  redirect_to("/");//redirects toindex page
});


put("/?change",function(){
  set_flash("Password changed");
  redirect_to("/");
});

// Editor Section/ Admin Section start
get("/user_page/editor",function(){

	if(!empty($_SESSION['user_id'])&& $_SESSION['admin']==="admin")
  {
   force_to_http("/user_page");
   $messages["message"]="Welcome";
   $messages["title"] = "User Home";
   render_user($messages,"admin","editor","editor_page");
	}else{
		redirect_to("/user_page/login");//redirect to login page if not loggedin
	}

});
get("/editor",function(){

	if(!empty($_SESSION['user_id'])&& $_SESSION['admin']==="admin")
  {
   force_to_http("/editor");

   $messages["title"] = "Editor Home";
	$messages["data"] = get_all_post();
   render_user($messages,"admin","editor","editor_page");
	}else{
		redirect_to("/?user_page/login");
	}

});

get("/editor/post",function(){

	if(!empty($_SESSION['user_id']) && $_SESSION['admin']=="admin")
  {
		force_to_http("/editor/post");
		$messages["title"] = "User-post";
		$messages["published"] = get_all_post_by_status("published articles");
		$messages["unpublished"] = get_all_post_by_status("unpublished articles");

		render_user($messages,"admin","post","editor_page");
	}else{
		redirect_to("/user_page/login");
	}
});
// get users's id
$get_id = get_url_id();
get("/editor/post/edit/?id={$get_id}",function(){
	if(!empty($_SESSION['user_id']) && $_SESSION['admin']=="admin")
  {

			$article_id = get_url_id();
			if(get_data_by_article_id($article_id)){
				force_to_http("/editor/edit");
				$messages["title"] = "Edit Page";
				$messages["data"] = get_data_by_article_id($article_id);
				render_user($messages,"admin","edit_post","editor_page");
			}else{
				error_404();
			}
	}
});

//Start of User section
get("/user_page/login",function(){
	if(!empty($_SESSION['user_id']) && $_SESSION['admin']=="admin")
  {
		redirect_to("/editor");
	}elseif(!empty($_SESSION['user_id']) && $_SESSION['admin']!=="admin")
  {
		redirect_to("/user_page");
	}else{
		force_to_http("/user_page/login");
		$messages["message"]="Welcome";
		$messages["title"] = "Login";
		render_user($messages,LAYOUT,"login", "user_page");
	}
});


get("/user_page",function(){

	if(!empty($_SESSION['user_id']) && $_SESSION['admin']!=="admin" )
  {
   force_to_http("/user_page");
   $messages["message"]="Welcome";
   $messages["title"] = "User Home";
   render_user($messages,LAYOUT,"home", "user_page");
 }else{
		redirect_to("/user_page/login");
	}

});

get("/user_page/post",function(){

	if(!empty($_SESSION['user_id']) && $_SESSION['admin']!=="admin")
  {
   force_to_http("/user_page");
   $messages["title"] = "User-post";
	$messages["data"] = get_data_by_user_id();
   render_user($messages,LAYOUT,"post", "user_page");
 }else{
		redirect_to("/user_page/login");
	}
});

//start login section.
post("/login",function(){
	if(!empty(form('email')) && !empty(form('password')))//checking for empty submission
  {

		$username = form('email');
		$password = form('password');
		if(logged_in($username, $password)){
			if($_SESSION['admin']==="admin")
      {
				set_flash("You are now signed in as an Editor!");
				redirect_to("/editor");
			}else{
			set_flash("You are now signed In!");
			redirect_to("/user_page");
			}
		}else{
			set_flash("Oops! Username / Passoword did not match");
			redirect_to("/user_page/login");
		}

	}else{
		set_flash("Username or Passoword is required");
		redirect_to("/user_page/login");
	}
});
//Start of article section
post("/user_page/post/add",function(){
	if(!empty(form('post-title')) && !empty(form('post-description') && !empty(form('post-date'))))//gives error message if empty
  {

		$title = form('post-title');
		$description = form('post-description');
		$date = form('post-date');
		$result=insert_post_data($title, $description, $date, $_SESSION['user_id']);

		if($result>1){
			set_flash("Post Successfuly Added!");
			redirect_to("/user_page/post");

		}else{
			set_flash("Post did not added!");
			redirect_to("/user_page/post");
		}
	}else{
		redirect_to("/user_page/post");
	}
});

//start of "delete article" section
post("/delete",function(){
	if(!empty(form('delete'))){
		$article_id = form('delete');
		if(delete_article_by_id($article_id)){
			set_flash("Your Article has been deleted");
			redirect_to("/editor/post");

		}
	}

});

put("/edit/update",function(){
  if(!empty(form('post-title')) && !empty(form('post-description'))){

		$title = form('post-title');
		$description = form('post-description');
	  	if(!empty(form('status'))){
	  		$status = form('status');
		}else{
			$status = form('default_value');
		}
	  	$article_id = form('id');
		$data =array($title,$description,$status, $article_id);
		if(update_article_by_id($data)==1){
			set_flash("Changes has been saved");
			redirect_to("/editor/post");

		}else{
			set_flash("Oops! Post did not save.");
			redirect_to("/editor/post");
		}

	}else{

		redirect_to("/editor/post");
	}
});

error_404();
session_write_close();//session close
?>
