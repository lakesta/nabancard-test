<?php

/**
Create the parsing code as a library so that it may be used by other applications (Hint: OOP).
Bonus (optional): Design so that other file formats (xml, json) can be used in the future with ease.
**/

/* Take file */
/* Determine file type */
/* Depending on type, read file and parse values */

class Parsely {
	private $file;
	private $results;

	/**
	* Construct method
	* @param $arg array - Values used to create object
	* @return null
	*/
	public function __construct($arg = array()) {
		if (isset($arg['file'])) {
			if ($this->set('file', $arg['file'])) {
				$this->results = array();
				$this->parse();	
			}
		}
	}

	/**
	 * Get class variables 
	 * @param $var string - class variable name to return value for
	 * @return mixed - whatever class variable was requested value or false if not found
	 */
	public function get($var) {
		$return = false;
		if (property_exists('Parsely', $var)) {
			$return = $this->{$var};
		} 
		return $return;
	}

	/**
	 * Explicitly set class variables 
	 * @param $var string - variable name
	 * @param $val mixed - variable value
	 * @return bool - true if value was set, false if value was not set
	 */
	public function set($var, $val) {
		$return = false;
		if (property_exists('Parsely', $var)) {
			// Validate
			switch ($var) {				
				case 'file': // file path
					if (file_exists($val)) {
						$this->{$var} = $val;
					}
					break;
			}
			$return = true;
		}
		return $return;
	}

	/**
	 * Determine file type and call proper parse function
	 * @return null
	 */
	protected function parse() {
		switch (pathinfo($this->file, PATHINFO_EXTENSION)) {
			case "csv":
				$this->parseCSV();
				break;
			case "json": break; // future
			case "xml": break; // future
		}
	}

	/**
	 * Open and then parse CSV file
	 * @return null
	 */
	private function parseCSV() {
		if (($handler = fopen($this->file, 'r')) !== FALSE) {
			while (($line = fgetcsv($handler)) !== FALSE) {
				$this->results[] = $line;
			}
			fclose($handler);
		}
	}

	
}