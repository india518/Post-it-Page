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

		//$data = array();
		$html = "";
		foreach($notes as $note)
		{
			$html .= "<div class='note'>{$note['description']}</div>";
		}
		return $html;
		//$data["html"] = $html;
		//echo json_encode($data["html"]);
	}

	function parse_date($date_string)
	{
		//given: 07/01/2013, output 2013-07-01
		$month = substr($date_string, 0, 2);
		$day = substr($date_string, 3, 2);
		$year = substr($date_string, 6, 4);
		$formatted_date = $year . "-" . $month . "-" . $day;
		return $formatted_date;
	}

?>