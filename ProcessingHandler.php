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
//print "Successfully connected to MySQL.\n";

mysqli_select_db( $db, $project );

//build SQL statement

//select all unique IDs from the database
//$s = "SELECT DISTINCT ID FROM AIQuestions";

//filter results by question
	//default question
$question = "Where do you live?";
	//retrive optional question from URL
if (isset($_GET['question'])){
	$question = $_GET['question'];
}


$s = "SELECT * FROM AIQuestions WHERE question = '$question'";
$out = "";
($t = mysqli_query( $db,  $s   ) )  or die( mysqli_error($db) );
	//use while loop to see results
	while ( $r = mysqli_fetch_array($t,MYSQLI_ASSOC) ) {

		$ID 				= $r[ "ID" ];
		$answer				= $r["answer"];
		$out .= $ID . "," . $answer . "\n";
		
		//The $$varname just puts $ before $varname's value
	;}
	echo $out;
?>