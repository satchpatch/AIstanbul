<?php
//setup error reporting & session
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors',1);
session_start();

//connect to DB
include (  "accountAI.php"     ) ;
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
$questions = $_SESSION["questions"];
$ID = $_SESSION["currentID"];

//package questions with answers
$qnum = 0;
$ansnum = 0;
foreach ($questions as $q) 
{
	$ans = $_GET["$qnum"];
	//if the user entered an answer, add question and answer to BD
	if (!empty($ans)){
		//add to DB
		$s = "insert into AIQuestions values ('$ID', '$ansnum', NOW(), '$q', '$ans')";
		mysqli_query($db,$s) or die(mysqli_error($db));
		echo "ID $ID answered \"$ans\" to the question: \"$q\" and was stored in qindex: $ansnum <br>";
		$ansnum++;
	}
	$qnum++;
}
?>
