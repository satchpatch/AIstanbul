<?php
//setup error reporting & session
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors',1);

//connect to DB
include (  "account.php"     ) ;
$db = mysqli_connect($hostname,$username, $password ,$project);
if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
print "Successfully connected to MySQL.\n";

mysqli_select_db( $db, $project );

//Finds the highest ID and sets that to the new ID++
$ID = 0;
$s = "SELECT ID FROM AIQuestions ORDER BY ID ASC";
$t = mysqli_query($db,$s) or die (mysqli_error($db));
while ( $r = mysqli_fetch_array($t,MYSQLI_ASSOC) ) {
		$ID 				= $r[ "ID" ];
}
$ID++;

//retrive values from URL
//$numStoredQuestions = 1; //$_GET["numStoredQuestions"];
$questions = array();
$qindex = 0;
//push questions into question array
while (!empty($_GET["Q"."$qindex"])) 
{
	array_push($questions, $_GET["Q".$qindex]);
	$qindex++;
}
$numStoredQuestions = count($questions);
	
//package questions with answers
$qnum = 0;
$ansnum = 0;
foreach ($questions as $q) 
{
	//if the user entered an answer, add question and answer to BD
	if (!empty($_GET["$qnum"]))
	{
		$ans = $_GET["$qnum"];
		//add to DB
		$s = "insert into AIQuestions values ('$ID', '$ansnum', NOW(), '$q', '$ans')";
		mysqli_query($db,$s) or die(mysqli_error($db));
		echo "ID $ID answered \"$ans\" to the question: \"$q\" and was stored in qindex: $ansnum <br>";
		$ansnum++;
	}
	$qnum++;
}
?>
