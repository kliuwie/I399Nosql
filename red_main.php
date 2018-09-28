<!DOCTYPE html>
<html>
<body>
	<h1>Group Project - Redis Explorationt</h2><br>
	<h2>Q1.Drop down of Groups </h2>
	<form action='Q1.php' method='post'>
	<select name='course'>
			<option value='CSCI'> CSCI - Computer Science Courses </option>
			<option value='INFO'> INFO - Informatics Courses </option>
			<option value='prog'> Programming Courses </option>
			<option value='core'> Core Courses </option>
			<option value='all_course'> All Courses </option>
	</select>
	<input type='submit' name='submit' value="Display Courses">
</form>
<h2>Q2.Drop down of Groups with Checklist </h2>
	<form action='Q2.php' method='post'>
		Please select the course from the drop down <br/>
		<select name='course'>
			<option value='CSCI'> CSCI - Computer Science Courses </option>
			<option value='INFO'> INFO - Informatics Courses </option>
	</select>
	<br/>
</br>
		<input type='checkbox' name='Programming' value='Yes'/> Programming <br/>
		<input type='checkbox' name='core' value='Yes'/> Core <br/>
	<input type='submit' name='submit' value="Display Courses">
</form>
<h2>Q4.Drop down of courses to Display Comment </h2>
	<form action='Q4.php' method='get'>
	<select name='course'>
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
	$values = $redis->smembers('all_course');
    	foreach ($values as $value) {echo nl2br("<option  value='".$value."'>".$value.'</option>');};
?>
	</select>
	<input type='submit' name='submit' value="Display Courses">
</form>

</body>
</html>
