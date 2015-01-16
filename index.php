<?php
// the current date & time
  $now = date(DATE_ATOM);
  
  // Here's the array of dates for the event
  $dates = array(
  	date(DATE_ATOM, mktime(19, 30, 0, 09, 24, 2014)), 
  	date(DATE_ATOM, mktime(19, 30, 0, 08, 31, 2014)),
  	date(DATE_ATOM, mktime(19, 30, 0, 10, 29, 2014)), 
  	date(DATE_ATOM, mktime(19, 30, 0, 11, 26, 2014)), 
  	date(DATE_ATOM, mktime(19, 30, 0, 12, 17, 2014)), 
  	date(DATE_ATOM, mktime(19, 30, 0, 01, 28, 2015)), 
  	date(DATE_ATOM, mktime(19, 30, 0, 02, 25, 2015)), 
  	date(DATE_ATOM, mktime(19, 30, 0, 03, 25, 2015)), 
  	date(DATE_ATOM, mktime(19, 30, 0, 04, 29, 2015)), 
  	date(DATE_ATOM, mktime(19, 30, 0, 05, 27, 2015)), 
  	date(DATE_ATOM, mktime(19, 30, 0, 06, 24, 2015))
  );
 
  // initialise empty array for future events
  $futuredates = array();
 
  // the foreach
  foreach($dates as $date){
    // if the date from the $dates array is older than today...
  	if ($date < $now ){
  		// donothing
  	} else {
  	  // if it's a future event, push the date into $futuredates
  		array_push($futuredates, $date);
  	};
  };
 
  // and bosh, convert the first line from the array as a string, ie: the next event.
  $nextDate = strtotime($futuredates[0]); 

  // time as a string for <time> element.
  $timeNextDate = date("c",$nextDate);

  // date as human readable, 29th Oct
  $showNextDate = date("jS M",$nextDate);

  $attendingDate = date("My", $nextDate);

  $attendlink = "http://attending.io/events/cc-".$attendingDate;

?>

<!DOCTYPE HTML>

<!--[if IEMobile 7 ]><html class="no-js iem7" manifest="default.appcache?v=1"><![endif]-->
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="no-js ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="no-js ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" lang="en"><!--<![endif]-->

<head>
	<meta charset="UTF-8">
	<title>CroydonCreativ.es</title>
	<script>
		var docElement = document.documentElement;
		docElement.className = docElement.className.replace(/\bno-js\b/,'') + ' js';
	</script>
	<meta name="description" content="An open and informal community of designers, developers and digital creatives from in and around Croydon who fancy a break from the screen and to chat about the web, print, typography and design.">
	<meta name="author" content="MrQwest and Croydon Creatives">

	<!-- We are a friendly bunch, why not come down and say hello? Claim your free drink for reading the source! -->

	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1">

	<link rel="stylesheet" href="css/style.css">
	<link rel="canonical" href="http://www.croydoncreativ.es/">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery.js"><\/script>')</script>
	<script src="js/modernizr.js"></script>
	<script src="js/crcreatives.js"></script>
	<script src="http://use.typekit.com/bof8zfa.js"></script>
	<script>
		try{Typekit.load();}catch(e){}

		// Remove Mailchimp default styles
		var mc_custom_error_style = '';

		$.anystretch('images/bg.jpg', {speed:150});
	</script>
</head>
<body class="anystretch">

	<header>
		<h1><img src="images/croydoncreatives.png" alt="croydoncreatives" title="The Croydon Creatives, a bunch of web workers meeting for a pint and a chat. Join us?"></h1>
		<nav>
			<ul>
				<li><a href="#header" title="Home">Home</a></li>
				<li><a href="#about" title="About Croydon Creatives">About</a></li>
				<li><a href="#where" title="Where in Croydon do we meet?">Where</a></li>
				<li><a href="#jointhelist" title="Join the Croydon Creatives mailing list and get notified about our upcoming meetups">Join the list</a></li>
				<li><a href="<?php echo $attendlink; ?>" title="Attending?">Attend</a></li>
				<li><a href="http://twitter.com/crcreatives" title="Follow us on twitter" rel="nofollow">@CrCreatives</a></li>
			</ul>
		</nav>
	</header>

	<section id="next">
		<h1>Next: <time datetime="<?php echo $timeNextDate; ?>"><a href="<?php echo $attendlink; ?>" data-old="http://lanyrd.com/series/croydoncreatives/save-to-calendar/"><?php echo $showNextDate; ?> @ 7pm (ish)</a></time></h1>
	</section>

	<section id="about">
		<h1>About</h1>
		<p>Croydon Creatives is a monthly gathering of web folk from in and around Croydon and further afield (current record distance travelled to a meet is ~160miles). An open and informal community of designers, developers and digital creatives who fancy a break from the screen and to chat about what we love. Talk about the web, print, typography and design. Talk about music, your hobbies or sport. Come along and have fun with fellow creatives.</p>
		<p>If you’re interested, why don’t you come down and join us one evening?</p>
	</section>

	<section id="where">
		<h1>Where?</h1>
		<div id="map_canvas"></div>
		<p>In our search for a regular venue, we’ve happened across two decent establishments so we’ll alternate between the two. This month, we’re meeting at <a href="http://matthewsyard.com/" title="Matthews Yard" rel="nofollow">Matthews Yard</a>, 1 Matthews Yard (off Surrey St), Croydon, <a href="http://goo.gl/maps/KRFhK" title="Directions from East Croydon">CR0 1FF</a>.</p>
		<p>If you’re traveling by train, aim for East Croydon station (20 minutes from Victoria/London Bridge rail stations), come out of the main entrance of the station, turn right and walk down George St towards Croydon center (follow the tram tracks!). Walk past the pedestrianised high street on your right and down a small (but steep!) hill. Turn left after the KFC and walk up Surrey St. After 2 minutes, you’ll see a small pedestrianised lane on your right between two buildings called Matthews Yard. Walk down the lane and Matthews Yard is on your left.</p>
		<p>If you’re coming by car, then the closest parking is Fairfield Halls Car Park. Take a look at <a href="http://g.co/maps/ctwpy" title="Parking Map" rel="nofollow">this map</a> for locations of the parking in the area and the meeting place.</p>
		<p>Finally, if you’re coming via tram, you’ll want the George Street tram stop.</p>
	</section>

	<section id="jointhelist">
		<h1>Join the list</h1>
		<p>We send out emails every now and then to let you know when the next gathering or event will take place. If you want to receive these emails, all we need is your name and email address–the Twitter username is just so we can say hello :)</p>

		<!-- MailChimp Signup Form -->
		<div id="mc_embed_signup">
			<form action="http://mrqwest.us2.list-manage.com/subscribe/post?u=c823261dac3f873975b9895fc&amp;id=c1f1938a5d" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
				<fieldset>
					<p class="indicate-required"><b class="note-required">*</b> indicates required.</p>
					<div class="mc-field-group">
						<label for="mce-EMAIL"><strong>Email address</strong> <b class="note-required">*</b></label>
						<input type="email" required value="" name="EMAIL" class="required email" id="mce-EMAIL" title="Email Address">
					</div>
					<div class="mc-field-group">
						<label for="mce-FNAME"><strong>Name</strong> <b class="note-required">*</b></label>
						<input type="text" required value="" name="FNAME" class="required" id="mce-FNAME" title="Name">
					</div>
					<div class="mc-field-group">
						<label for="mce-FTWITTER"><strong>Twitter username</strong></label>
						<input type="text" value="" name="FTWITTER" class="" id="mce-FTWITTER" title="Twitter">
					</div>
					<div id="mce-responses">
						<div class="response flipInX" id="mce-error-response" style="display:none"></div>
						<div class="response" id="mce-success-response" style="display:none"></div>
					</div>
					<div>
						<input type="submit" value="Subscribe" title="Subscribe to the mailing list" name="subscribe" id="mc-embedded-subscribe" class="btn">
					</div>
				</fieldset>
			</form>
		</div>

		<!-- /MailChimp Signup Form -->

	</section>


	<section id="attend">
		<h1>Attending?</h1>
		<p>We love <a href="http://attending.io" title="attending.io" rel="nofollow">Attending</a> here, it’s an awesome service for events.</p>
		<p>We set up an event on Attending for every Croydon Creatives meet and we love it when new and old friends add their names to the list. If you’re planning on coming along to the next Croydon Creatives meet, please do pop your name down–all you need is your Twitter username!</p>
		<p><a href="<?php echo $attendlink; ?>" title="The Next CroydonCreatives event" rel="nofollow">The next Croydon Creatives on Attending</a>.</p>
	</section>

	<footer>
		<p class="copyright" data-switch="yellowswitch">&copy; 2011-<?= date('Y') ?> CroydonCreativ.es, <a href="http://mrqwest.co.uk" title="MrQwest, a Croydon Web Designer" rel="nofollow">MrQwest</a> and <a href="http://steverydz.com" title="Steve Rydz" rel="nofollow">Steve Rydz</a>. Made by <a href="humans.txt" title="Made by Humans">Humans</a>.</p>
	</footer>

	<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script src="js/mailchimp.js"></script>
	<script src="js/map.js"></script>


	<script>
		var _gaq=[['_setAccount','UA-23121126-1'],['_trackPageview']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
		g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
	</script>

</body>
</html>
