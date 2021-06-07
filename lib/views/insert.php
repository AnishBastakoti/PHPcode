<?php
$username = $_POST['username'];
$Password =$_POST['password'];
$email = $_POST['email'];

if (!empty($username) || !empty($password) || !empty($email)){
  $host = "localhost";
  $dbUsernme = "root";
  $dbPassword = "";
  $dbname = "austro_asian_times";

  //create connections
  $conn = new mysqli($host, $dbUsernme, $dbPassword, $dbname);

  if (mysqli_connect_error()) {
    die("connection Error('.mysqli_connect_errorno().')"). mysqli_connect_error());
  } else{
    $SELECT = "SELECT email From users Where email = ? Limit 1";
    $INSERT = "INSERT Into User (username, password, email) values(?, ?, ?)";

    //prepare Statement

    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    rnum == $stmt->num_rows;

    if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->biind_param("sss, $usermane, $password, $email");
      $stmt->execute();
      echo "New record added";
    }else{
      echo"oops someone used this one";
      }
    $stmt->close();
    $conn->close();
  }else{
    echo "All field are required";
    }
}
?>
