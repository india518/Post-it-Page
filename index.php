<?php
	require("connection.php");
	require("include/functions.php");
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
		<title>Ajax - postit notes</title>
		<!-- css -->
		<link rel="stylesheet" type="text/css" href="css/mycss.css">
		<!-- jQuery -->
		<link media="all" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#create_note").submit(function(){
					$.post(
						$(this).attr("action"), //URL to send data
						$(this).serialize(), //the data being sent
						function(data){
							$("#note_container").append(data);
						},
						"json"	//data format
					);
					//$(this).reset(); --> Doesn't work because it's a jQuery object
					this.reset(); //"This" is a javascript reference to this
					// Another way to do the above command:
					// document.getElementById("create_note").reset();
					return false;
				});
			});
		</script>
	</head>
	<body>
		<div id="container">
			<h1>My Posted Notes:</h1>
			<div id="note_container">
				<!-- This will only run once, on page load -->
				<?= display_notes() ?>
			</div>
			<div class="clear"></div>
			<form id="create_note" action="process.php" method="post">
				<!-- I don't wan to use a <br />, since that's bad practice -->
				<div><label for="note_description">Add a Note:</label></div>
				<div><textarea id="note_description" name="note_description"></textarea></div>
				<input type="submit" value="Post It!" />
			</form>
		</div>
	</body>
</html>