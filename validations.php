<?php
	/**
	 * Validation functions.
	 *
	 * @author Dora Tenesaca <doratenesacam@gmail.com>
	 * @copyright 2019
	 */ 


	/**#@+ 
	* Constants 
	*/ 
	/** 
	* Day of week(LN=1, MR=2...) with the license  plate last number allowed to road.
	*/ 
	const pico_licenseplate  = array('1'=> array(1,2),
							  '2'=> array(3,4),
							  '3'=> array(5,6),
							  '4'=> array(7,8),
							  '5'=> array(9,0));

	const morning= array('07:00', '09:30');
	const afternoon= array('16:00', '19:30');

	/**
	 * Verify if a string has only letters
	 * 
	 * @return boolean true if all characters are a letter
	 * @param string $text
	 */ 
	function picoLicenseplate($license_plate, $date, $time){
		/*
		* 1. Validate license plate,
		* 2. Get number of day. If day is 6 or 7(weekend) cars are allowed to road.
		* 3. Validate if the car has a restriction to road on that day and time
		*/
		$result='';

		if(validateLicenseplate($license_plate)){
			$day_number=dayWeeknumber($date);
			if($day_number>5)$result="Cars are allowed to road on weekends all the day.";
			else if((!testDay($day_number, substr($license_plate, -1)))&&(!testRangetime($time)))
			{
				$result="The car isn't allowed to road on that date and time.";
			}
			else $result="The car is allowed to road on that date and time.";

				//if(testRangetime($time))$result="Cars are allowed to road on weekends all the day.".testRangetime($time);
		}
		else $result="The license plate isn't valid.";

		return $result;
	}

	/**
	 * Verify if a string has 
	 * 
	 * @return boolean true if all characters are a letter
	 * @param string $text
	 */     
    function validateLicenseplate($text){
      if(preg_match('/[A-Za-z]{3}-[0-9]{3}|[0-9]{4}/',$text)) return true;
      else return false;
    }

    /**
	 * Get number of week from a date.
	 * 
	 * @return int day number  Monday = 1
	 * @param string $date
	 */    
    function dayWeeknumber($date){
      return date('N', strtotime($date));
    }

    /**
	 * Check if the car has a restriction to road on the date day($day_number),
	 * using the last digit from the license plate.
	 * 
	 * @return boolean true if the car has not restriction that day
	 * @param int $day_number  string $license_lastnumber
	 */ 
    function testDay($day_number, $license_lastnumber){
	  if (in_array($license_lastnumber, pico_licenseplate[$day_number]))return false;
	  return true;
	}

	/**
	 * Check if the car has a restriction to road on the time($time),
	 * using the constants with the range of time for restriction.
	 * 
	 * @return boolean true if the car has not restriction on that range of time
	 * @param time $time  
	 */ 
    function testRangetime($time){
	  if ($time >= morning[0] && $time <= morning[1])return false;
	  else if ($time >= afternoon[0] && $time <= afternoon[1])return false;
	  else return true;
	}
?>