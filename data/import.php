<?php

/**
 * Fast and messy PHP script to import from CSV to redis.
 *
 * Assumes you have airports.csv and countries.csv from http://ourairports.com/data/
 * in the same directory as this script.
 */

/* Edit the Redis URL with creds in */

$redis_url = '';

/* Now don't edit anything else */

require "vendor/autoload.php";

// load the countries into an array we can do a lookup on

$fpc = fopen('./countries.csv', 'r');

$countries = [];
$i = 0;
while ($row = fgetcsv($fpc)) {
    // the first row has col headings, skip it
    if ($i > 0) {
        // col 1 is code, col 2 is name
        $countries[$row[1]] = $row[2];
    }
    $i++;
}

// print_r($countries);

// now get on with putting the airports in Redis

$redis = new Predis\Client($redis_url);
// $redis->hset("code:sample", 'name', 'Sample Airport', 'country', 'somewhere');

$fpa = fopen('./airports.csv', 'r');

$j = 0;
$count = 0;
while ($airport = fgetcsv($fpa)) {
    if ($j > 0) {
        if($airport[13]) {
            $redis->hset("code:" . $airport[13], "name", $airport[3], "country", $countries[$airport[8]]);
            // echo $airport[13] . " : " . $airport[3] .  " in " . $countries[$airport[8]] . "\n";
            $count++;
        }
    }

    $j++;
}
echo $count . " airports\n";
