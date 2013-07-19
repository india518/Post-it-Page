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

	$(document).on("submit", ".delete_form", function(){
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

	//submit an edit
	$(document).on("submit", ".edit_form", function(){
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
	$(document).on("click", ".note_body", function(){
		$note_id = $(this).data("note_id");
		//build an html string for the edit form
		$edit_form = "<form class='edit_form' action='process.php' method='post'>";
		$edit_form += "	<textarea class='edit_note_body' name='note_description'>" + $(this).text() + "</textarea>";
		$edit_form += "	<input type='hidden' name='action' value='edit' />";
		$edit_form += "	<input type='hidden' name='note_id' value=" + $note_id + " />";
		$edit_form += "	<button class='edit' type='submit'>Save Edit</button>";
		$edit_form += "</form>";
		//change this particular paragraph to the edit form
		$(this).replaceWith($edit_form);
	});
});