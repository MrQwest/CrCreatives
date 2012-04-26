<?php	
	
	// remember to make sure this exists or else there'll be errors...
	$cache = dirname(__FILE__) . '/cache/cctweets.txt';
	
	// NEW Set up an array of usernames (in lower case) to filter.
	// If they're in here, their tweets or retweets won't get shown
	$user_filter = array(
		'cc'
	);
	
	// first, do require_onces and set up Twitter request as usual, but don't do $s->search() yet
	require_once 'time_passed.php';
	require_once 'class.twitter.php';
	$t = new twitter;
	$s = new summize;


 function link_it($text)
{
    $text= preg_replace("/(^|[\n ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a href=\"$3\" >$3</a>", $text);
    $text= preg_replace("/(^|[\n ])([\w]*?)((www|ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"http://$3\" >$3</a>", $text);
    $text= preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a href=\"mailto:$2@$3\">$2@$3</a>", $text);
    $text= preg_replace("/@(\w+)/", '<a href="http://www.twitter.com/$1" target="_blank">@$1</a>', $text);  
    $text= preg_replace("/\#(\w+)/", '<a href="http://search.twitter.com/search?q=$1" target="_blank">#$1</a>',$text);  
    return($text);
}

/* NEW Is this username a filtered one? Returns TRUE if they're in
 * the array and FALSE if not. 
 */
function user_is_filtered($username, $user_filter)
{
	// convert the user to lowercase so it'll always match the filter
	return in_array(strtolower($username), $user_filter);
}

/*
 * NEW Is this tweet an RT of a filtered username?
 * Only a basic check, might not catch *everything*
 * but returns TRUE if it is and FALSE if not.
 */
function rt_filtered_user($text, $user_filter)
{
	foreach($user_filter as $username)
	{
		// convert the user to lowercase so it'll always match the filter,
		// then check to see if the string 'rt @user' appears anywhere in the tweet
		if(strpos(strtolower($text), 'rt @' . $username) !== FALSE)
		{
			// this is an RT, so we filter it out.
			// "return true" exits the function, so we
			// don't waste time checking others if we 
			// already found a match
			return true;
		}
	}
	// if we've got this far, it's because 
	// the tweet is OK to include
	return false;
}

if ( !file_exists($cache) || filemtime($cache) < ( time() - 30 ) )
{
    // do the $s->search(), save the result to a variable as before but also write it out to a file for later use
    $data = $s->search('croydoncreatives OR #crcreatives OR @crcreatives', 100);
    
   	// cache data  
   	$cachefile = fopen($cache, 'cc');  
   	fwrite($cachefile, serialize($data));  
   	fclose($cachefile);  

} else {

    // load the data from the cache file
    $data = file_get_contents($cache); 
    $data = unserialize($data);
}

// now do all your processing like before

$data = $data->results;
	foreach($data as $d)
	{
		// NEW check if this tweet will get filtered out, don't bother processing it if it will
		if(!user_is_filtered($d->from_user, $user_filter) && !rt_filtered_user($d->text, $user_filter))
		{
			$diff = time_passed(strtotime($d->created_at), strtotime('now'));
			$units = 0;
			$created_at = array();
			foreach($diff as $unit => $value)
			{
			   if($value != 0 && $units < 2)
		    	{
					if($value === 1)
					{
						#let's remove the plural "s"
						$unit = substr($unit, 0, -1);
					}
				   $created_at[]= $value . ' ' .$unit;
				   ++$units;		
			    }
			}
			$created_at = implode(', ',$created_at);
			$created_at .= ' ago';
			$tweet = preg_replace('/(^|\s)@(\w+)/','\1<a href="http://twitter.com/\2">@\2</a>', $d->text);
	?>
	<li class="<?php echo $d->from_user; ?>">
		<a class="grid_1 alpha"><img class="twitteravatar" src="<?php echo $d->profile_image_url; ?>" alt="<?php echo $d->from_user; ?>" /></a>
		<span class="grid 4 omega">
			<a class="twitteruser" ref="nofollow" href="http://twitter.com/<?php echo $d->from_user; ?>"><?php echo $d->from_user; ?></a> 
			<span class="twittertime"><?php echo $created_at; ?></span>
		</span>	| <a href="http://twitter.com/intent/tweet?in_reply_to_status_id=<?php echo $d->id; ?>">Reply</a>
			<br />
		<?php echo link_it($tweet); ?><br />
	</li>
	<?php
		}
	}
?>
<li><a href="http://twitter.com/#!/search/realtime/%23eeuk11" >Find older tweets on twitter</a></li>
