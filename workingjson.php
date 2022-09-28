<?php

/**
 
 * @fileoverview Functions for working with JSON
 
 * @version 1.0
 
 * @author Javier Vílchez Luque <https://www.linkedin.com/in/javi-vl/>
 
 */



/**

 * File CSV to JSON: convert a csv file to  JSON 
 * Returns a json

 * @param  {$csv: string (path/url csv file)}
 * @param  {$delimiter: string (delimiter of the columns csv)}
 
 * @return  {json}

 */

function csvFileToJson($csv, $delimiter){
    // Open csv in read mode
    if ($fpcsv = fopen($csv, 'r')) {
       // Read the headers of the csv file where $delimiter is the delimiter of the columns
        $header = fgetcsv($fpcsv, "1024", $delimiter);

        // Loop through the csv rows and fill array
        $array = array();
        while ($row = fgetcsv($fpcsv, "1024", $delimiter)) {
            $array[] = array_combine($header, $row);
        }

        // Close the csv file
        fclose($fpcsv);
        // Encode array to json
        $json=json_encode($array);

        // Return json
        return $json;

    }else{
        // If the csv file cannot be read
        echo "Can't open csv file...";
    }
}

/**

 * File xml to JSON: convert a xml file to  JSON 
 * Returns a json

 * @param  {$xml: string (path/url xml file)}
 
 * @return  {json}

 */

function xmlFileToJson($xml){
        // Load the xml
        if(!$xmlDat=simplexml_load_file($xml)){
            die("Can't open xml file...");
        }
        // Encode to json
        $json=json_encode($xmlDat);
        // Return the json
        return $json;
    
}

/**

 * Save file: save a file to the specified path
 * Returns true if the save was successful or false if the file was not saved

 * @param  {$file: string (path file to save)}
 * @param  {$datToSave: string/array/obj Json (data to save to file)}

 * @return  {boolean}

 */

function saveFile($file, $datToSave){
    if($fileSave=fopen($file,'w')){
        fwrite($fileSave, $datToSave);
        fclose($fileSave);
        return true;
    }else{
        return false;
    }
}

// Example of function calls

/*
$miJson=csvFileToJson('myFile.csv',';');
print_r($miJson);
saveFile('test.json', $miJson);
*/

/*
$miJson=xmlFileToJson('myFile.xml');
print_r($miJson);
saveFile('test_xml.json', $miJson);
*/

?>
