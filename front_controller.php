<?php

//Our front controller to handle all types of requests by parsing the url string.

//*************
//****Parse url
//************

$url = $_SERVER["REQUEST_URI"];
$url = parse_url($url);
$hostname = $url['hostname'];


echo $hostname;
