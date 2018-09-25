

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
	$course = $_POST["course"];

	$values = $redis->smembers($course);
	foreach ($values as $professor) { echo nl2br("\n" . $professor); };
	$redis->shutdown;
?>

