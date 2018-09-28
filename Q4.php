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
$course = $_GET['course'];


echo '<h1> Comment for '.$course.'</h1>';
echo '<br/><br/>';
echo "<form action='Q4.php?course=".$course."' method='post'>";
echo "Your Comment <br/>";
echo "<textarea name='comment'> Enter your comment here </textarea><input type='submit' name='submit' value='Submit Comment'></form>";

$comm = $_POST['comment'];

if(!empty($comm)){
$redis->rpush($course.'comment',$comm);};
$values = $redis->lrange($course.'comment',0,-1);
foreach ($values as $value) {echo nl2br("\n".$value."\n");};
?>
</body>
</html>
