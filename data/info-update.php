<?php
	
	// Check_URL function checks if a URL is valid
	function check_url($url) {
		 $headers = @get_headers($url);
		 $headers = (is_array($headers)) ? implode( "\n ", $headers) : $headers;
		 return (bool)preg_match('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers);
	}

	// Get timestamp
	$nextDate = strtotime('Last wednesday of this month');

	// If it's still the same month, but past the date of this months meet, get the next months meet
	if(($nextDate < time()) && (date('m') == date('m', $nextDate)))
		$nextDate = strtotime('Last wednesday of next month');

	// time as a string for <time> element.
	$timeNextDate = date("c", strtotime('7pm'));

	// date as human readable, 29th Oct
	$showNextDate = date("jS M",$nextDate);
	$attendingDate = date("My", $nextDate);

	// Constrcut attending link
	$attendlink = "http://attending.io/events/cc-".$attendingDate;

	$link = (check_url($attendlink)) ? $attendlink : false;

	$data = array(
		'showNextDate' => $showNextDate,
		'timeNextDate' => $timeNextDate,
		'attendingDate' => $attendingDate,
		'link' => $link
	);

	file_put_contents('data.json', json_encode($data));
