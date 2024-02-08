<?php

/**
 * readInputFile function
 * Open file and read content into array and sort data items
 * @param string $inputfile
 * @return array
 */
function readInputFile($inputfile) {
    $data_arr = [];

    $handle = fopen($inputfile, "r");
    if ( !$handle ) {
        die("unable to read file");
    }
    while (($line = fgets($handle)) !== false) {
        $d = explode(" ", $line);
        $data_arr[$d[0]] = $d[1];
    }

    fclose($handle);
    ksort($data_arr);

    return $data_arr;
}

/**
 * buildPyramidToArray function
 * Generate a pyramid number sequence into array
 * @param int $length
 * @return array
 */
function buildPyramidToArray($length) {
    $retval = [];
    $j = 0;
    for ( $row = 1; $row < $length; $row++ ) {
        // count up to same value of r
        for ( $c = 1; $c <= $row; $c++ ) {
            // increment $j value
            if ($j < $length) {
                $j++;
                // only pick the last number of each row
                if ( $c == $row ) array_push($retval, $j);
            } else {
                break;
            }
        }
    }

    return $retval;
}
/**
 * decodeMessage function
 * Extract message base on the reference key number from pyramid sequence
 * @param array $data array data with [key, value] format
 * @return string
 */
function decodeMessage($data) {
    $retval = "";
    $cnt = buildPyramidToArray(count($data));
    foreach ($cnt as $c) {
        $i=1;
        // iterate to data and only extract matching index location
        foreach ($data as $key => $val) {
            if ($i == $c) {
                $retval = $retval." ".rtrim($val);
                break;
            }
            $i++;
        }
    }

    return $retval;
}


$message = decodeMessage(readInputFile("data.txt"));
echo $message;
