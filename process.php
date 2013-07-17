<?php

	require("connection.php");
	require("include/functions.php");

	//first, validate the input to make sure it's not empty
	//validate_note($_POST["note_description"])

	//make a new note in the database
	if (! empty($_POST["note_description"]))
	{
		$new_note = $_POST["note_description"];
		make_note($new_note);
		//now display it:
		$data = "<div class='note'>{$new_note}</div>";
		echo json_encode($data);
	}

?>
