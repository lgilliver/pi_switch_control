<!DOCTYPE html>	<!-- need this to be at very top for HTML5 -->

<!-- anytime you need to add any PHP anywhere, you open a php tag -->
<?php
// These two lines let you see the PHP errors for debugging, comment them out to turn it off
error_reporting(E_ALL);			
ini_set('display_errors', 1);

// We include our config file with our set variables in
// You can either "include" (which asks for it, but it can't find it will carry on) or "require" (which will stop if it can't be found)

//
require('/usr/share/pi-www/cgi/control_config.php');
// Does the require need the full path, can it not use relative? Where is the uix2 placed and run from?

include($fn.".php");
?>

<html>

	<head>
		<title>Remote Switch Control Panel</title>
	
		<script type="text/javascript">
					
			function updateHidden(a)
			{
				// Let's make a new id to use in javascript from the one that triggered the event
				var id = a.id; // a is the object passed int eh arguments
				//alert(a.id); // debugger line
				// we want to replace the "on/off" bit of the current id to be the suffix so we can access the hidden field
				id = id.replace(a.value,"<?php echo $suffix; ?>");
				//alert(id); // debugger line
				// Then we set the value of the hidden input with the value from the button "on/off"
				document.getElementById(id).value = a.value;
			}
			
		</script>
		
		<style type="text/css">
		
		.button{
			height: 100px;
			width: 100px;
			border-style: solid;
			border-width: 5px;
			color: white;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
			background-color: rgba(50,50,150,1);
		}

		.button:hover {
			background-color: rgba(100,100,250,1);
		}

		.button_sel {
			background-color: rgba(100,100,250,1);
			font-weight: bold;
		}

		.on
		{
			background-color: #00FF00;
			color: #FFFFFF;
		}
		
		.off{}
		
		</style>
	
	</head>

	<body>

		<form name="control_form" id="control_form" method="post" action="/pi-cgi/control_process.php">		<!-- It's best practice to give the name and id to be the same for grabbing these later on if needed -->
		
			<table name="master_table" id="master_table">
				<tr>
					<?php 
					// We can do a loop to iterate through for a number of times to generate all our buttons - love php!
					// We'll use a shorthand so we can jump straight back into std HTML without echo-ing it out line by line from PHP
					for($x=1; $x <= $switches; $x++) : ?> <!-- The colon here signifies, "carry on as if it were a curly bracket" -->	
						<!-- Quickest method for side-by-side columns is nested tabling -->
					<tr> <!-- from the main table, a new cell in the same row -->
						<table>
							<tr>
								<?php // So the next lines will add the title Switch # to the top of each column, ucwords just uppercases it to look good ?>
								<td>
								<?php // Rather than write this out twice ... I'm lazy so will revariable it here to type quicker - the full prefix for our ID's will be:
								// We want to pad the numebr to be 2 digits with a leading 0 if needed
								$id_num = str_pad($x,2,'0',STR_PAD_LEFT);
								$id_pre = $prefix ."_". $id_num; 
								?>
								<?php
								// 'ON' button - 
								if(isset($switch_array[$id_num])) : 
									// Check if button is selected:
									if($switch_array[$id_num] == 'on'){
										$selected = 'button_sel';
									}else{
										$selected = 'off';
									}
								?>
									<button name="<?php echo $id_pre; ?>_on" id="<?php echo $id_pre; ?>_on" class="button <?php echo $selected; ?>" value="on" onClick="updateHidden(this)">ON</button>
								<?php endif; ?>

								</td>
							
							
								<td>
								<?php
								// Off Button:
								if(isset($switch_array[$id_num])) : 
									//Check if this button is selected:
									if($switch_array[$id_num] == 'off') {
										$selected = 'button_sel';
									}else{
										$selected = 'off';
									}
								?>
									<button name="<?php echo $id_pre; ?>_off" id="<?php echo $id_pre; ?>_off" class="button <?php echo $selected; ?>" value="off" onClick="updateHidden(this)">OFF</button> <!-- "this" is a javascript thing, it essentially is quickhand for saying, the object that was used to trigger the event -->
								<?php endif; ?>

								</td>
							
							
								<td>

								<?php echo $sw_name[$id_num-1]; ?>


								<!-- This doesn't need to be inside a physical table/cell as it's hidden -->
								<input type="hidden" name="<?php echo $id_pre; ?>_<?php echo $suffix;?>" id="<?php echo $id_pre; ?>_<?php echo $suffix;?>" value="<?php if(isset($switch_array[$id_num])){ echo $switch_array[$id_num]; } ?>" /> <!-- The value will always start blank until there is somethign in the file to read from -->
							</tr>
						</table>
					</tr>	<!-- end cell from master table -->
					<?php 
					endfor; ?> <!-- essentially shorthand for the closing curly bracket -->
				</tr>
			</table> <!-- closes master_table>
			
			
		
		</form>

	</body>

</html>
