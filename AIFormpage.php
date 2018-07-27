<?php
//setup error reporting & session
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors',1);
session_start();

//connect to the database
include (  "accountAI.php"     ) ;
$db = mysqli_connect($hostname,$username, $password ,$project);
if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
print "<br>Successfully connected to MySQL.<br>";
mysqli_select_db( $db, $project ); 

//questions Array
$questions = array("Where do you live?",
"Where do you work?",
"Where do you go to school?",
"How do you get there?",
"Where will you have lunch?",
"Where do you buy books?",
"Fresh groceries?",
"Favorite pazar?",
"Where do you buy your clothes from?",
"What are you doing this Saturday night?");
//select one question at random
$qselected = $questions[rand(0,9)];

//how many Users are in the database? 
//Finds the highest ID and sets that to the new ID++
$currentID = 0;
$s = "SELECT ID FROM AIQuestions ORDER BY ID ASC";
$t = mysqli_query($db,$s) or die (mysqli_error($db));
while ( $r = mysqli_fetch_array($t,MYSQLI_ASSOC) ) {
		$currentID 				= $r[ "ID" ];
}
$currentID++;
echo "your ID is $currentID <br><br>";
$_SESSION["currentID"]= $currentID;


//change to a query that finds the highest ID and sets that to the new ID++
$s = "SELECT * FROM AIQuestions";
$t = mysqli_query($db,$s) or die (mysqli_error($db));
$numStoredQuestions = mysqli_num_rows($t);


//store values in session
$_SESSION["qselected"] = $qselected;
$_SESSION["numStoredQuestions"] = $numStoredQuestions;
$_SESSION["questions"] = $questions;

//print the HTML form
echo '<form    action="AIFormpageHandler.php"  >';

//for loop to iterate through all the questions
$qnum = 0;
foreach($questions as $q){
echo "$q <br>";
echo "<input type=text  name=\"$qnum\"><br><br>";
$qnum++;
}

echo "<input type=submit>";
echo "</form>";
?>