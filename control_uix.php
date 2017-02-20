<!DOCTYPE html>	<!-- need this to be at very top for HTML5 -->

<!-- anytime you need to add any PHP anywhere, you open a php tag -->
<?php
// These two lines let you see the PHP errors for debugging, comment them out to turn it off
error_reporting(E_ALL);			
ini_set('display_errors', 1);

// We include our config file with our set variables in
// You can either "include" (which asks for it, but it can't find it will carry on) or "require" (which will stop if it can't be found)
require('control_config.php');
include($fn.".php");
?>

<html>

	<head>
		<!-- Adds bootstrap lines -->
		<?php echo $bs; ?>
		
		<title>Remote Switch Control Panel</title>
	
		<script type="text/javascript">
					
			function updateHidden(a)
			{
				// Let's make a new id to use in javascript from the one that triggered the event
				var id = a.id; // a is the object passed in the arguments
				//alert(a.id); // debugger line
				// we want to replace the "on/off" bit of the current id to be the suffix so we can access the hidden field
				id = id.replace(a.value,"<?php echo $suffix; ?>");
				//alert(id); // debugger line
				// Then we set the value of the hidden input with the value from the button "on/off"
				document.getElementById(id).value = a.value;
				updateClasses(a);
			}
			
			function updateClasses(b)
			{
				// Get the current ID and split to it's on and off counerparts
				id_pre = id.replace(a.value,"<?php echo $suffix; ?>");
				btn_on = document.getElementById(id_pre+"on");
				btn_off = document.getElementById(id_pre+"off");
				switch (b.value) {
					case "on" :
						btn_on.className = "<?php echo $btn_class; ?> active";
						btn_off.className = "<?php echo $btn_class; ?> ";
						break;
					case "off" :
						btn_on.className = "<?php echo $btn_class; ?> ";
						btn_off.className = "<?php echo $btn_class; ?> active";
						break;
				
				// Get current state
				
				// Set state on each counterpart
			}
			
			
		</script>
		
		<style type="text/css">
		
		.on
		{
			background-color: #00FF00;
			color: #FFFFFF;
		}
		
		.off
		{
			background-color: #FF0000;
			color: #FFFFFF;
		}
		
		</style>
	
	</head>

	<body>

		<form name="control_form" id="control_form" method="post" action="control_process.php">		<!-- It's best practice to give the name and id to be the same for grabbing these later on if needed -->
		
			<table name="master_table" id="master_table">
				<tr>
					<?php 
					// We can do a loop to iterate through for a number of times to generate all our buttons - love php!
					// We'll use a shorthand so we can jump straight back into std HTML without echo-ing it out line by line from PHP
					for($x=1; $x <= $switches; $x++) : ?> <!-- The colon here signifies, "carry on as if it were a curly bracket" -->	
						<!-- Quickest method for side-by-side columns is nested tabling -->
					<td> <!-- from the main table, a new cell in the same row -->
						<table>
							<tr>
								<?php // So the next lines will add the title Switch # to the top of each column, ucwords just uppercases it to look good ?>
								<td><?php echo ucwords($prefix)?> <?php echo $x; ?></td>
							</tr>
							<tr>
								<td>
								<?php // Rather than write this out twice ... I'm lazy so will revariable it here to type quicker - the full prefix for our ID's will be:
								// We want to pad the numebr to be 2 digits with a leading 0 if needed
								$id_num = str_pad($x,2,'0',STR_PAD_LEFT);
								$id_pre = $prefix ."_". $id_num; 
								?>
									<button class="<?php echo $btn_class; ?> <?php if($switch_array[$id_num] == "on"){ echo "active"; } ?>" name="<?php echo $id_pre; ?>_on" id="<?php echo $id_pre; ?>_on" value="on" onClick="updateHidden(this)">ON</button>
								</td>
							</tr>
							<tr>
								<td>
									<button class="<?php echo $btn_class; ?> <?php if($switch_array[$id_num] == "off"){ echo "active"; } ?>" name="<?php echo $id_pre; ?>_off" id="<?php echo $id_pre; ?>_off" value="off" onClick="updateHidden(this)">OFF</button> <!-- "this" is a javascript thing, it essentially is quickhand for saying, the object that was used to trigger the event -->
								</td>
							</tr>
							<tr>
								<td>
								<?php 
								if(isset($switch_array[$id_num])) : ?>
									<span class=" <?php echo $switch_array[$id_num]; ?>"><?php echo ucwords($switch_array[$id_num]); ?></span>
								<?php endif; ?>
								<!-- This doesn't need to be inside a physical table/cell as it's hidden -->
								<input type="hidden" name="<?php echo $id_pre; ?>_<?php echo $suffix;?>" id="<?php echo $id_pre; ?>_<?php echo $suffix;?>" value="<?php if(isset($switch_array[$id_num])){ echo $switch_array[$id_num]; } ?>" /> <!-- The value will always start blank until there is somethign in the file to read from -->
							</tr>
						</table>
					</td>	<!-- end cell from master table -->
					<?php 
					endfor; ?> <!-- essentially shorthand for the closing curly bracket -->
				</tr>
			</table> <!-- closes master_table>
			
			
		
		</form>

	</body>

</html>
