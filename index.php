<?php

$filenames_raw = $_GET['filenames'];
$filenames = json_decode(urldecode($filenames_raw));

$response_data = array();
foreach ($filenames as $filename) {
  $encoded_file_uri = datastream_uri_encode($filename);
  $file_location = trim(shell_exec("locate -d /vagrant/dbs/datastreams.db {$encoded_file_uri}"));
  $response_data[$encoded_file_uri] = $file_location;
}
format_response($response_data);

function format_response($response_data) {
  Header('Content-type: application/json');
  $response = json_encode($response_data);
  echo $response;
}

function datastream_uri_encode($uri) {
  $uri = urlencode($uri);
  $uri = str_replace('_', '%5F', $uri);
  return $uri;
}
