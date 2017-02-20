<?php
// These two lines let you see the PHP errors for debugging, comment them out to turn it off
error_reporting(E_ALL);			
ini_set('display_errors', 1);

// We include our config file with our set variables in
// You can either "include" (which asks for it, but it can't find it will carry on) or "require" (which will stop if it can't be found)
require('control_config.php');
##############################################
#	As this isn't a HTML file that will be viewed 
#	(for the moment at least) we don't need to add
# 	a Doctype, it is just pure PHP.
#
#	This script will do the processing then redirect
#	back to the thingimibobby form
##############################################

// This next command, var_dump, is your friend in PHP, it will drop any data type to screen you want - great for debugging
//var_dump($_POST);	// $_POST is a global variable that holds everything that's been submitted

##############################################
#
# POST variable by default for a 4 switch system 
# will give us the 4 switches, as well as the button 
# which was pressed, meaning we get 5 items in our array
# We want to get rid of that, maybe keep it aside for later
#
##############################################

// We want a new array that is empty and ready to receive ... lol
$switch_array = Array();

foreach($_POST as $key => $value)
{
	// If the key has the word "state" in it, then we want to keep it, if it doesn't, its the one we're dropping
	if(strpos($key,$suffix) != 0)
	{
		// We want to get rid of the word switch, state and the underscores too so we're left with a number only
		$str = str_replace($prefix,"",$key);
		$str = str_replace("_","",$str);
		$str = str_replace($suffix, "", $str);
		
		// Then add it to our new array
		$switch_array[$str] = $value;
	}
}

// Now we dump the array to two text files
// One for the PHP to re-read quickly
// One for the Python to pickup, trimmed down

// let's read out the array line by line to add to the python text file
$py_string = "";
foreach($switch_array as $key => $value)
{
	// The . before = is important, it means, keep adding to the existing string
	$py_string .= $key;
	$py_string .= "=";
	$py_string .= $value;
	// Last bit is a bit of a bodge, to add the new line, normally you can use special escape character \r \n but they never bloody work
	$py_string .= "
";
}

$filename = $fn; // From our config file
file_put_contents($filename, $py_string);

// now let's dump the same info but to a php file that our php files can re-read later easily
$filename = $fn.".php";
file_put_contents($filename, '<?php $switch_array = ' . var_export($switch_array, true) . ';');


//var_dump($switch_array);

// Then lets redirect back to the control page
header('Location: control_uix.php');
?>