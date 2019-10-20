<?php include 'validations.php'; ?> 

<form method="POST"
 action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 	PLACA: <input type="text" name="license_plate" value="aaa-112"/>
	DATE: <input type="date" name="date"/>
	TIME: <input type="time" name="time"/>
	
	<input type="submit" name="submit" value="Submit">
</form>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	echo picoLicenseplate($_POST["license_plate"], $_POST["date"], $_POST["time"]);
}
?>