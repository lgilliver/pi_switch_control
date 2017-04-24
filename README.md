# pi_switch_control
Raspberry Pi RF Remote Sockets Web GUI

control_config.php
	Some variables to set - only really 1 major one, the number of switches, this is infinite!
	Place this along with other cgi files on the pi (Haynes Tutorial sets up CGI scripts to be
	located at /usr/share/pi-www/cgi/...)
	Update the config file accordingly.
	
control_process.php
	Does all the processing - look if you're interested, but otherwise it can stay as is
	Place this in the same location as 'control_config.php' with cgi scripts.
	
control_uix.php
	This is your main file to read from the web browser - it's the user interface
	Place this somewhere in /var/www on the pi
	Change the first 'require' command to point to the location of 'control_config.php.
	Change button actions to point to 'control_process.php'
	
switch_states.txt
	This is the file you need to read from for you py script
	You can reset the name of this to anything you want in the config file above and it PHP will autogenerate the actual file
	Place this with CGI scripts
	
switch_states.txt.php
	This is the file that PHP will re-read from to get current states in the uix.
	If you change the above filename in the config, this will auto-update too via PHP
	Place this with CGI scripts
	
TODO:
- catch failed attempts writing to switch_states.txt. Add write attempt to queue and re-try until successful
- Comment in script what to change (filepaths etc.) to get this to work on a Pi.	
