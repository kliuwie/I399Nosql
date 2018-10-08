<!DOCTYPE html>
<html>
<body>
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
$prof1 = $_GET['prof1'];
if($_GET['fav']=='vote'):
$score_keys = 'prof1:'.$prof1;
$keys = $redis->incrBy($score_keys,1);
$values = $redis->zRangeByScore('all_prof', 0, -1, array('withscores' => TRUE);
foreach ($values as $value) {echo nl2br("<option  value='".$value."'>".$value.'</option>');};
	?>
	</body>
	</html>
