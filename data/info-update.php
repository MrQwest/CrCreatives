<?php

	function check_url($url) {
		 $headers = @get_headers($url);
		 $headers = (is_array($headers)) ? implode( "\n ", $headers) : $headers;

		 return (bool)preg_match('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers);
	}

	$nextDate = strtotime('Last wednesday of this month');

	// time as a string for <time> element.
	$timeNextDate = date("c", strtotime('7pm'));

	// date as human readable, 29th Oct
	$showNextDate = date("jS M",$nextDate);
	$attendingDate = date("My", $nextDate);

	$attendlink = "http://attending.io/events/cc-".$attendingDate;

	$link = (check_url($attendlink)) ? $attendlink : false;

	$data = array(
		'showNextDate' => $showNextDate,
		'timeNextDate' => $timeNextDate,
		'attendingDate' => $attendingDate,
		'link' => $link
	);


	file_put_contents('data.json', json_encode($data));
