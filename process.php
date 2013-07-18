<?php
	require("connection.php");
	require("include/functions.php");

	if ($_POST["action"] == "post")
	{
		//make a new note in the database
		if (! empty($_POST["note_description"]))
		{
			$new_title = $_POST["title"];
			$new_note = $_POST["note_description"];
			create_note($new_title, $new_note);
			//now display it:
			$data = display_notes();
			echo json_encode($data);
		}
	}

	if ($_POST["action"] == "edit")
	{
		$note_id = $_POST["note_id"];
		$note_description = $_POST["note_description"];
		update_note($note_id, $note_description);
		//note: we could just say
		// update_note($_POST["note_id"], $_POST["note_description"]);
		// but I think it's more readable with the variable names.
		$data = display_notes();
		echo json_encode($data);
	}

	if ($_POST["action"] == "delete")
	{
		$note_id = $_POST["note_id"];
		remove_note($note_id);
		$data = display_notes();
		echo json_encode($data);
	}

	//eventually, validate the input to make sure it's not empty:
	//validate_note($_POST["note_description"])

	//Note that we don't want this validation to trigger an error message
	// on page load. Will have to figure out how to deal with that.
?>