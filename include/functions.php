<?php

	function create_note($note)
	{
		$clean_title = mysql_real_escape_string($title);
		$clean_note = mysql_real_escape_string($note);
		$create_note_query = "INSERT INTO posts (title, description, created_at) VALUES ('{$clean_title}', '{$clean_note}', NOW())";
		mysql_query($create_note_query);
		return TRUE; //don't know if we really need this or not...
	}

	function edit_note($note)
	{
		$clean_title = mysql_real_escape_string($title);
		$clean_note = mysql_real_escape_string($note);
		$edit_note_query = "INSERT INTO posts (title, description, updated_at) VALUES ('{$clean_title}', '{$clean_note}', NOW())";
		mysql_query($edit_note_query);
		return TRUE;
	}

	function remove_note($note_id)
	{
		$remove_note_query = "DELETE FROM posts where posts.id = '{$note_id}'";
		//echo $note_id . "<br />";
		//echo $remove_note_query;
		//die();

		mysql_query($remove_note_query);
		return TRUE;
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
			$html .= "<div class='note'>";
			$html .= "	<p class='note_body'>{$note['description']}</p>";
			$html .= "	<form action='process.php' method='post'>";
			$html .= "		<input type='hidden' name='action' value='delete' />";
			$html .= "		<input type='hidden' name='note_id' value='{$note['id']}' />";
			$html .= "		<button class='delete' type='submit'>Edit</button>";
			$html .= "		<button class='delete' type='submit'>Delete</button>";
			$html .= "	</form>";
			$html .= "</div>";
		}
		return $html;
	}
?>