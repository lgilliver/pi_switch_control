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

?>