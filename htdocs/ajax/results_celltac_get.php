<?php   
#
#   Get results output, sanitize the output, 
#   insert results into an array for handling in front end
#   
$RESULTS_KEYS = array(
        'WBC',
        'UNIT-NE',
        'UNIT-LY',
        'UNIT-MO',
        'UNIT-EO',
        'UNIT-BA',
        'NE',
        'LY',
        'MO',
        'EO',
        'BA',
        'RBC',
        'HGB',
        'HCT',
        'MCV',
        'MCH',
        'MCHC',
        'RDW',
        'PLT',
        'PCT',
        'MPV',
        'PDW'
        );
        
    $DATETIME_KEYS = array(
        'YEAR-CT',
        'MONTH-CT',
        'DATE-CT',
        'HH-CT',
        'MM-CT',
        'SS-CT'
        );

    $RESULTS_STRING = file_get_contents("http://192.168.1.88/celtac/celtac-results.txt");
    if ($RESULTS_STRING === FALSE){
        print "Something went wrong with getting the File";
    };
    
   if (strlen($RESULTS_STRING) < 50) {
       print "Results file is empty, please press print on celltac machine";
       return;
   }
    
    $arr = preg_split("/\r\n|\n|\r/",$RESULTS_STRING);
    $COMPLETE_RESULT_ARRAY = array();
    $RUBBISH = array('\u0003', '\u0002');
    
    foreach ($arr as $key) {       
    	$res_string = trim($key);
        $res_string = str_replace('+', '', $res_string);
        if($res_string != ''){
            $res_string = json_encode($res_string);
            $res_string = str_replace($RUBBISH, '', $res_string);
            $res_string = str_replace('"', '', $res_string);
            $COMPLETE_RESULT_ARRAY[] = $res_string;
        }
    }
    
    //If Results string is reasonably long enough match results
    if(count($COMPLETE_RESULT_ARRAY > 90)){
        match_results($COMPLETE_RESULT_ARRAY);
    }
   
    else{
        print "Something went wrong, results string too short.";
        return;
    }
    // print_r($COMPLETE_RESULT_ARRAY);
    function match_results($COMPLETE_RESULT_ARRAY){
        //Count 98
        //TODO check array length if too small then invalid
        //Validate also using PatientID
        global $DATETIME_KEYS;
        global $RESULTS_KEYS;
        global $RESULTS;
        
        $this_year = date('Y');
        
        //Search for occurences of MEK-8222 string
        $ARR_COUNT = count_needles_in_haystack('MEK-8222', $COMPLETE_RESULT_ARRAY);
        if ($ARR_COUNT != 2){
            //We DO NOT have a valid results with two parts, Results and static values
            print "Something went wrong : Too many results in celltac log file";
            return;
        }
        
        //Find where date starts and begin recording results from here
        $keyofyear = array_search(''.$this_year.'', $COMPLETE_RESULT_ARRAY);
        $DATETIME_VALUES = array_slice($COMPLETE_RESULT_ARRAY, $keyofyear , 6);
        
        $DATETIME_ARRAY = array_combine($DATETIME_KEYS, $DATETIME_VALUES);
        //TODO Validate $datetime_array
        
        //Search using using key of current patient in Results entry page
        $idKey = $keyofyear + 6; 
        $patientID =  $COMPLETE_RESULT_ARRAY[$idKey];
		
		//Assuming they have not put patientID in celltac we start reading results immediately
		$resultsKey = $idKey;
		
		//sometimes they dont input patient ID thus we have to check to see if its there if not start results
		if (strpos($patientID, ".") == false) {
			//There could also be Age / comments inputs Between patient ID and Results
        	$resultsKey = $idKey+1;
		}
        
        //TODO Check if Patient ID from results matches with current patient
        
        //After $idKey next 22 values are results
        $RESULTS_VALUES = array_slice($COMPLETE_RESULT_ARRAY, $resultsKey , 22);
                
        //TODO Need to check if RESULTS Array is valid
        
        //Map values to their corresponding keys i.e WBC, LY, MO
        $RESULTS = array_combine($RESULTS_KEYS, $RESULTS_VALUES);
         if (!$RESULTS) {
          //Something wrong
          print "Something went wrong : Keys not equal";   
         }
         $RESULTS = json_encode($RESULTS);
         echo $RESULTS;
         //print json_encode($RESULTS);
         //We have the results now we have to emtyy the text file in prep
         //For next printed data
    }
    function count_needles_in_haystack($needle, $HayStack){
        //Count number of times needle occurs in array haystack
        $counts = array_count_values($HayStack);
        return $counts[$needle];
    }
?>