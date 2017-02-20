<?php
##############################################
#	As this isn't a HTML file that will be viewed 
#	(for the moment at least) we don't need to add
# 	a Doctype, it is just pure PHP.
#
#	We're going to use this file to set some 
#	variables for the whole system
##############################################

// Number of switches/sockets required
$switches = 4;
// Filename for the states file
$fn = "switch_states.txt";

// ID prefix for the switches buttons input
$prefix = "switch";
// ID suffix for the switches hidden state input
$suffix = "state";

// Add the bootstrap loader into here as  avariable which is then loaded on every page with a one line call
$bs = '';
$bs .= '<meta charset="utf-8">';
$bs .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
$bs .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
$bs .= '<link href="css/bootstrap.min.css" rel="stylesheet">';
$bs .= '<script src="js/jQuery1-12-4.js"></script>';
$bs .= '<script src="js/bootstrap.min.js"></script>';


?>
