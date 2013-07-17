<?php

	require("connection.php");

?>

<html>
	<head>
		<title>Ajax - postit notes</title>
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
							//console.log(data);
							$("#results").html(data.html);
						},
						"json"	//data format
					);
					return false;
				});
				//display all database data on page load
				$("#create_note").submit();

			});
		</script>
	</head>
	<body>
		<div id="results"></div>

		<form id="create_note" action="process.php" method="post">
			<label for="note_description">Add a Note:</label>
			<input type="text" id="note_description" name="note_description" />
			<input type="submit" value="Post It!" />
		</form>

	</body>
</html>