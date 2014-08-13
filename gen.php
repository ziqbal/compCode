<?php

/*
 * CompCode
 * 
 * rev6 (c)2014 Zafar Iqbal <mail@zaf.io>
 * 
 */

// Total number of codes required
$totalCodes = 100;

// Length of each code
$codeLength = 10;

// Allowed alphabet which can include any single character including letters and symbols
$alphabet = array(
    '1' , '2' , '3' , '4' , '5' , '6' , '7' , '8' , '9' , '0' ,
    /* 'A' , 'B' , 'C' */
);

/*********************************
 * //\\// HIC SVNT LEONES \\//\\ *
 *********************************/

$alphabetSize = count( $alphabet );

$codes = array( );

$currentTotal = 0;

// Main loop to generate all the codes
while( $currentTotal < $totalCodes ) {    

    // Checksum control value
    $cc = 0;

    // Current code
    $code = "";
   
    // Keep track of previous generated digit for better looking codes 
    $prevDigit = ""; 
   
    // Loop to generate one code 
    for( $j = 0; $j < ( $codeLength - 1 ); $j++ ) {
       
        // Generate digit until its different from the previous digit 
        do{
            
            $digit = $alphabet[ mt_rand( 0, $alphabetSize - 1 ) ];
            
        } while( $digit == $prevDigit );

        $code .= $digit;
       
        $cc += ord( $digit );

        // Use again every other digit for checksum to handle transposition errors 
        if( ( $j % 2 ) == 0 ) $cc += ord( $digit );
        
        $prevDigit = $digit;

    }
    
    // Convert checksum to a digit which exists in the alphabet
    $cc = $alphabet[ $cc % ( $alphabetSize ) ];
    
    // Skip if first digit is the digit zero '0'
    if( substr( $code , 0 , 1 ) == "0" ) continue;
    
    // Skip if control digit exists in code
    if( strpos( $code , $cc ) !== false ) continue;

    $key = $code . $cc;

    // If the code is new then use it
    if( ! isset( $codes[ $key ] ) ) {
        
        $codes[ $key ] = 1;
        $currentTotal++;
        
    }
    
}

// Extract the codes from the array keys
$codes = array_keys( $codes );

// Print out all codes
foreach( $codes as $code ) {

    print( "$code\n" ); 

}


