<?php
include "Predis/Autoloader.php";
	Predis\Autoloader::register();
	$redis = new Predis\Client(array(
        "scheme" => "tcp",
        "host" => "burrow.sice.indiana.edu",
        "port" => 19617));
	if (!$redis) {
	die("Failed to connect to Redis");
	}
	
	$prof = $_POST["prof"];
	
	if($_POST['attribute']=='yes' && $_POST['course']=="yes"):
		$name_keys = 'prof:'.$prof;
		$keys = $redis->hkeys($name_keys);
		foreach ($keys as $key) {echo nl2br("\n" . $key. ": ". ($redis->hget($name_keys, $key)));};
		$name_values = $prof.' course';
		$values = $redis->smembers($name_values);
		foreach ($values as $value) {echo nl2br("\nCourse: " . $value);};
	
	elseif($_POST['attribute'] == 'yes'):
		$name = 'prof:'.$prof;
		$keys = $redis->hkeys($name);
		foreach ($keys as $key) {echo nl2br("\n" . $key. ": ". ($redis->hget($name, $key)));};
		
	elseif($_POST['course'] == 'yes'):
		$name = $prof.' course';
		$values = $redis->smembers($name);
		foreach ($values as $value) {echo nl2br("\nCourse" . $value);};
		
	
	endif;

	$redis->shutdown;
?>

