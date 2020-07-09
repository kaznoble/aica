<?php
	// do nothing
	require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php';
	require __DIR__ . '/../vendor/autoload.php';

	use \Curl\Curl;

	$curl = new Curl();
	$curl->get('https://www.alphavantage.co/query?apikey=demo&function=TIME_SERIES_DAILY_ADJUSTED&symbol=MSFT');

	if ($curl->error) {
		echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
	} else {
		echo 'Response:' . "\n";
		//var_dump($curl->response);
	}
	
	global $wpdb;
	$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}options WHERE option_id = 1", OBJECT );
	foreach($results As $res)
	{
		echo '<br />' . $res->option_name . '<br />';
	}
?>

<a href="#!/start">Start Page</a>

<h1>Home page</h1>