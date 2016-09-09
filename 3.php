<?php

/**
3. Parse the included file and output in the format below.  This should be a command line tool.   Create the parsing code as a library so that it may be used by other applications (Hint: OOP).
Bonus (optional): Design so that other file formats (xml, json) can be used in the future with ease.

Use the following format for displaying results from the command line application.

    <id> <name> (<quantity>)
    - <category 1>
    - <category 2>
    - <category n...>

Example:  

    68-OX-YH94 Carrot (5)
    - vegetable
    - green
    - orange
    - skinny

**/

/* Get argument */
/* Instantiate Class with argument */
/* Get results */
/* Create output in desired format */

require_once('3-lib.php');
if (!empty($argv[1])) {
	$p = new Parsely(array('file'=>$argv[1]));
	$r = $p->get('results');

	foreach ($r as $row) {
		$x = 0;
		foreach ($row as $col) {
			switch ($x) {
				case 0: 
					echo "\n".$col; 
					break;
				case 1: 
					echo " ".$col; 
					break;
				case 2: 
					echo " (".$col.")"; 
					break;
				case 3: 
					if (!empty($col)) {
						$c = explode(";", $col);
						foreach ($c as $cat) {
							echo "\n- ".$cat;
						}
					}
			}
			$x++;
		}
		echo "\n";
	}
} else {
	echo "Proper usage requires passing a file path as a parameter ie.) php ".__FILE__." ~/Desktop/test.csv\n";
}