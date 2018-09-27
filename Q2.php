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


  if($_POST['Programming']=='Yes' && $_POST['core']=="Yes"):
    $var = $course.'prog';
    $var2= $course.'core';
    $values = $redis->sinter($var,$var2);
    foreach ($values as $value) {echo nl2br("\n".$value);};
  elseif ($_POST['Programming']=="Yes"):

    $values = $redis->smembers($course.'prog');
    foreach ($values as $value) {echo nl2br("\n".$value);};
  elseif ($_POST['core']=='Yes'):

    $values = $redis->smembers($course.'core');
    foreach ($values as $value) {echo nl2br("\n".$value);};
	else:

    $values = $redis->smembers($course);
    foreach ($values as $value) {echo nl2br("\n".$value);};
  endif;

	$redis->shutdown;
?>
