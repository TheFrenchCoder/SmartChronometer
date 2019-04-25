<?php

$data = file_get_contents('config.json');
//Now decode the JSON using json_decode():

$json = json_decode($data, true); // decode the JSON into an associative array
//You have an associative array containing all the information. To figure out how to access the values you need, you can do the following:

echo '<pre>' . print_r($json, true) . '</pre>';
//This will print out the contents of the array in a nice readable format. Note that the second parameter is set to true in order to let print_r() know that the output should be returned (rather than just printed to screen). Then, you access the elements you want, like so:

$temperatureMin = $json['daily']['data']['temperatureMin'];
$temperatureMax = $json['daily']['data']['temperatureMax'];
echo $temperatureMin." to ".$temperatureMax;
//Or loop through the array however you wish:
foreach ($json['daily']['data'] as $field => $value) {
    // Use $field and $value here
}