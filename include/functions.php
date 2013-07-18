<?php

	function create_note($title, $note_text)
	{
		$clean_title = mysql_real_escape_string($title);
		$clean_note_text = mysql_real_escape_string($note);
		$create_note_query = "INSERT INTO posts (title, description, created_at) VALUES ('{$clean_title}', '{$clean_note_text}', NOW())";
		mysql_query($create_note_query);
		return TRUE; //don't know if we really need this or not...
	}

	function update_note($note_id, $note_text)
	{
		$clean_note_text = mysql_real_escape_string($note_text);
		$update_note_query = "UPDATE posts SET description='{$clean_note_text}', updated_at=NOW() WHERE id='{$note_id}'";
		mysql_query($update_note_query);
		return TRUE;
	}

	function remove_note($note_id)
	{
		$remove_note_query = "DELETE FROM posts where posts.id = '{$note_id}'";
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
			$html .= "	<h4>{$note['title']}</h4>";
			$html .= "	<p class='note_body' data-note_id='{$note['id']}'>{$note['description']}</p>";
			$html .= "	<form action='process.php' method='post'>";
			$html .= "		<input type='hidden' name='action' value='delete' />";
			$html .= "		<input type='hidden' name='note_id' value='{$note['id']}' />";
			$html .= "		<button class='delete' type='submit'>Delete</button>";
			$html .= "	</form>";
			$html .= "</div>";
		}
		return $html;
	}
?>