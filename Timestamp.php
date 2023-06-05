<?php

// Timestamp short intro: https://www.baeldung.com/linux/epoch-time#1-1-january-1971

// get current timestamp by using time() function, which will return how many seconds counted from Jan 1, 1970
$currentTimestamp = time();

// try to run this..and it is just an int :)
var_dump($currentTimestamp);

// how to translate timestamp into readable date format
// use: https://www.php.net/manual/en/function.date.php
$date = date("j F Y H:i", $currentTimestamp);
echo $date . "\n";
// "j", "F", or "Y" are date formatting constants.
// See here for available constants for date formatting:
// https://www.php.net/manual/en/datetime.format.php

//=======================
// example on how to get days difference between two timestamps:
// let's create a new timestamp which should represent next 2 days:
$nextTwoDaysTimestamp = $currentTimestamp + (2 * 60 * 60 * 24);

// this is for calculating difference in seconds between $currentTimestamp and $nextTwoDaysTimestamp
$diff = abs($nextTwoDaysTimestamp - $currentTimestamp);

// simple Math: convert the different in seconds into "day"
$days = floor($diff / (24 * 60 * 60));

// will show "2"
echo $days;
