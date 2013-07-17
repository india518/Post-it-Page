<?php

	function make_note($note)
	{
		$clean_note = mysql_real_escape_string($note);
		$create_note_query = "INSERT INTO posts (description, created_at) VALUES ('{$note}', NOW())";
		//note: if/when we create an edit function, then:
		//$query = "INSERT INTO posts (description, updated_at) VALUES ({$note}, NOW());"

		mysql_query($create_note_query);
		return TRUE; //don't know if we really need this or not...
	}

	function get_notes()
	{
		$get_notes_query = "SELECT * FROM posts";
		// note: if/when we have multiple users, then:
		// $get_notes_query = "SELECT * FROM posts WHERE user_id = '{$user_id}'";
		// or something along these lines...
		return fetch_all($get_notes_query);
	}

	function display_notes()
	{
		$notes = get_notes();

		$html = "";
		foreach($notes as $note)
		{
			$html .= "<div class='note'>{$note['description']}</div>";
		}
		return $html;
	}

?>