<?php


//http://library.miami.edu/sp/api/talkback/startdate/2013-04-01/enddate/2013-04-30/key/b7i*ww7%#56/max/1
// 'http://subjectsplus.com/spum/api/talkback/startdate/2013-01-01/enddate/2013-05-30/key/tPEd9gxW8inwcBj4mNq7/max/1'

// get our dates sorted
$start_date = date('Y-m-d', strtotime("-4 days"));
$end_date = date('Y-m-d', strtotime("+1 days"));

$our_api_key = urlencode("b7i*ww7%#56");
$our_api_string = "http://library.miami.edu/sp/api/talkback/startdate/" . $start_date . "/enddate/" . $end_date . "/key/" . $our_api_key . "/max/1";
/*$variable = file_get_contents($our_api_string);
$jobj = json_decode($variable, TRUE);*/

//do Curl instead because file_get_contents causing errors by dgonzalez
$lrscCurl = curl_init($our_api_string);
curl_setopt($lrscCurl, CURLOPT_RETURNTRANSFER, true);
$lstrResponse = curl_exec($lrscCurl);

$jobj = json_decode($lstrResponse, TRUE);

//if (is_array($jobj)) { } else {print "it's dang empty";}

if ( isset($jobj['talkback'][0]) && $jobj['talkback'][0]['question']) {print $jobj['talkback'][0]['question'];} else {print "false";}

//var_dump($jobj);
 ?>