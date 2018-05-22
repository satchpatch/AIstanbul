<?php
//setup error reporting & session
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors',1);
session_start();

//connect to the database
include (  "account.php"     ) ;
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
$qselected = $questions[rand(0,9)];

//how many questions in the database?
$s = "SELECT * FROM AIQuestions";
$t = mysqli_query($db,$s) or die (mysqli_error($db));
$numStoredQuestions = mysqli_num_rows($t);


//store values in session
$_SESSION["qselected"] = $qselected;
$_SESSION["numStoredQuestions"] = $numStoredQuestions;
 print $qselected;
?>

<!DOCTYPE html>
<form    action="AIFormpageHandler.php"  >

<input type=text  name="answer" >Enter Answer<br>
<input type=submit>

</form>