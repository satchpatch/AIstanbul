<?php
//setup error reporting & session
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors',1);
session_start();

//connect to DB
include (  "account.php"     ) ;
$db = mysqli_connect($hostname,$username, $password ,$project);
if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
print "<br>Successfully connected to MySQL.<br>";
mysqli_select_db( $db, $project );

//retrive values from session and form
$qselected = $_SESSION["qselected"];
$numStoredQuestions = $_SESSION["numStoredQuestions"];
$answer = $_GET['answer'];

//add to DB
$s = "insert into AIQuestions values ('$numStoredQuestions', '$qselected', '$answer')";
//echo "<br> s is $s";
echo "<br>added answer to row: $numStoredQuestions"
mysqli_query($db,$s) or die(mysqli_error($db));

?>
