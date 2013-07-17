<?php
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