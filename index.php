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
							$("#note_container").html(data);
						},
						"json"	//data format
					);
					//$(this).reset(); --> Doesn't work because it's a jQuery object
					this.reset(); //"This" is a javascript reference to this
					// Another way to do the above command:
					// document.getElementById("create_note").reset();
					return false;
				});
				$("#note_container").on("submit", "form", function(){
					$.post(
						$(this).attr("action"), //URL to send data
						$(this).serialize(), //the data being sent
						function(data){
							$("#note_container").html(data);
						},
						"json"	//data format
					);
					return false;
				});
				//for making existing notes edit-able
				$(".note_body").on("click", function(){
					$note_id = $(this).data("note_id");
					//alert("you clicked note " + $note_id);
					//build an html string for the edit form
					$edit_form = "<form action='process.php' method='post'>";
					$edit_form += "	<textarea class='edit_note_body' name='note_description'>" + $(this).text() + "</textarea>";
					$edit_form += "	<input type='hidden' name='action' value='edit' />";
					$edit_form += "	<input type='hidden' name='note_id' value=" + $note_id + " />";
					$edit_form += "	<button class='edit' type='submit'>Save Edit</button>";
					$edit_form += "</form>";
					//change this particular paragraph to the edit form
					$(this).replaceWith($edit_form);
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
				<div><input type="text" name="title" value="Title..." /></div>
				<div><textarea id="note_description" name="note_description"></textarea></div>
				<input type="hidden" name="action" value="post" />
				<input type="submit" value="Post It!" />
			</form>
		</div>
	</body>
</html>