# pi_switch_control
Raspberry Pi RF Remote Sockets Web GUI

control_config.php
	Some variables to set - only really 1 major one, the number of switches, this is infinite!
	
control_process.php
	Does all the processing - look if you're interested, but otherwise it can stay as is
	
control_uix.php
	This is your main file to read from the web browser - it's the user interface
	
switch_states.txt
	This is the file you need to read from for you py script
	You can reset the name of this to anything you want in the config file above and it PHP will autogenerate the actual file
	
switch_states.txt.php
	This is the file that PHP will re-read from to get current states in the uix.
	If you change the above filename in the config, this will auto-update too via PHP
