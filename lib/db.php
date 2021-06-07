<?php

function get_db(){
	$dbServername = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbName ="austro_asian_times";

//creating connection
	$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

/*check connection
if (!$conn){
	die('Connection failed: ' . mysqli_connect_error());
}
echo "Connected Successfully";  */

return $conn;
}


function query($query, $datatype, $data){
	$db= get_db();
	$sql = $query;

	$stmt = mysqli_stmt_init($db); //initilazation prepare statement
	if(!mysqli_stmt_prepare($stmt, $sql)){ 	//for prepared statement
		echo "SQL statement failed";
	}else{

		mysqli_stmt_bind_param($stmt,$datatype, $data);
		mysqli_stmt_execute($stmt); 	// Run parameters inside database
		$result = mysqli_stmt_get_result($stmt);
		return $result;
	}
mysqli_close($db);
}

function get_all_post_by_status($status){
	$db= get_db();
	$sql = "SELECT * FROM article WHERE articleStatus=?";
	$datatype='s';
	$result = query($sql,$datatype,$status);
	return $result;
}
function get_all_post(){
	$db = get_db();
	$sql = "SELECT * FROM article";
	$result = mysqli_query($db,$sql);
	return $result;
}
function get_data_by_user_id(){
	$db= get_db();
	$sql = "SELECT * FROM article WHERE userId=?";
	$stmt = mysqli_stmt_init($db);//initating prepare statement for user's
	if(!mysqli_stmt_prepare($stmt, $sql)){//for prepared statement
		echo "Statement failed";
	}else{
		mysqli_stmt_bind_param($stmt,"i", $_SESSION['user_id']);//binds paramaters into placeholders
		mysqli_stmt_execute($stmt);//runs paramaters inside database
		$result = mysqli_stmt_get_result($stmt);
	}

// closing database connection
mysqli_close($db);
return $result;
}

function insert_post_data($title, $description, $date, $user_id){
	$db= get_db();
	$sql = "INSERT INTO article(articleTitle, articleDescription, articleDate, userId) VALUES(?,?,?,?)";
	$stmt = mysqli_stmt_init($db);//initating the prepared statemnt
	if(!mysqli_stmt_prepare($stmt, $sql)){//preparing the prepared statement
		set_flash("Statement failed");
	}else{
		mysqli_stmt_bind_param($stmt,"sssi", $title, $description, $date, $user_id);
		mysqli_stmt_execute($stmt);//runs paramaters inside database
		$result = mysqli_stmt_affected_rows($stmt);

	}
// closing connection
mysqli_close($db);
return $result;
}
function logged_in($username, $password){
	$db= get_db();
	$username = strtolower(trim($username)); // delete any whitespace
	$sql = "SELECT * FROM users WHERE email_id=? LIMIT 1"; // avoding SQL Insection
	$stmt = mysqli_stmt_init($db);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		echo "Statement failed";
	}else{
		mysqli_stmt_bind_param($stmt,"s", $username);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
	}
		$row= mysqli_fetch_assoc($result);
		if(password_verify($password,$row['password'])){

			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['first_name']= $row['first_name'];
			$_SESSION['admin'] = $row['authentication'];

			return true;
		}else{
			return false;
		}

	mysqli_close($db);
}

function create_user(){
	$db = get_db();
	$hashed_password = password_hash("admin",PASSWORD_DEFAULT);
	$sql = "INSERT INTO users(first_name, last_name, email_id, password, position, authentication) VALUES('Eden', 'Hazard' , 'eden7@gmail.com', '{$hashed_password}', 'editor', 'admin')";
	$data = mysqli_query($db, $sql);
	mysqli_close($db);
}

// get's article by id
function get_data_by_article_id($id){
	$db = get_db();
	$sql = "SELECT * FROM article WHERE articleId =?;";
	$datatype ="i";
	$result = query($sql,$datatype, $id);
	mysqli_close($db);
	return $result;
}
// deletes article by id
function delete_article_by_id($id){
	$db = get_db();
	$sql = "DELETE FROM article WHERE articleId={$id}";
	$result = mysqli_query($db,$sql);
	mysqli_close($db);
	return $result;

}

//updates article by id
function update_article_by_id($data){
	$db = get_db();
	$sql = "UPDATE article SET articleTitle=?, articleDescription=?, articleStatus=? WHERE articleId=?";
	$stmt = mysqli_stmt_init($db);//initating the prepared statement
	if(!mysqli_stmt_prepare($stmt, $sql)){
		echo "Statement failed";
	}else{
		mysqli_stmt_bind_param($stmt,"sssi", ...$data);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_affected_rows($stmt);
		return $result;
	}
mysqli_close($db);//closing the connection
}
?>
