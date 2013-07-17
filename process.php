<?php

	require("connection.php");
	require("include/functions.php");

	//echo "This is the process page!";
	//var_dump($_POST);
	//die();

	//first, validate the input to make sure it's not empty
	//validate_note($_POST["note_description"])

	$data = array();
	//
	$html = "<div class='note'>";
	$html .= "	<p>{$_POST['note_description']}</p>";
	$html .= "</div>";

//
	$data["html"] = $html;
	echo json_encode($data);
?>
