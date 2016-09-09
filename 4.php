<?php

/**
4. Implement a function to convert an integer to roman numeral function.  It should allow a custom format for 1 and 5 (e.g. 1=Z, 5=P). 
Bonus (optional) Use an object oriented approach.
**/

class IntToRoman {
	private $int;
	private $roman;

	private $one; // custom value for 1
	private $five; // custom value for 5

	private $lookup; // Roman numeral lookup table

	/**
	* Construct method
	*
	* @param $arg array - Values used to create object
	* @return null
	*/
	public function __construct($arg = array()) {
		if (isset($arg['one'])) {
			$this->set('one', $arg['one']);
		} else {
			$this->set('one', 'I');
		}
		if (isset($arg['five'])) {
			$this->set('five', $arg['five']);
		} else {
			$this->set('five', 'V');
		}
		if (isset($arg['int'])) {
			$this->set('int', $arg['int']);
		}
		$this->lookup = array(
			1000 => 'M',
			900 => 'CM',
			500 => 'D',
			400 => 'CD',
			100 => 'C',
			90 => 'XC',
			50 => 'L',
			40 => 'XL',
			10 => 'X',
			9 => 'IX',
			5 => $this->get('five'),
			4 => $this->get('one').$this->get('five'),
			1 => $this->get('one')
		);
	}

	/**
	 * Get class variables 
	 * @param $var string - class variable name to return value for
	 * @return mixed - whatever class variable was requested's value or false if not found
	 */
	public function get($var) {
		$return = false;
		if (property_exists('IntToRoman', $var)) {
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
		if (property_exists('IntToRoman', $var)) {
			// Validate
			switch ($var) {
				case 'int': // Integer
				if (filter_var($val, FILTER_VALIDATE_INT) !== FALSE) {
						$this->{$var} = $val;
					}
					break;
				
				case 'one': // Character(s)
				case 'five':
					$val = preg_replace("/[^A-Za-z]/", '', $val);
					$this->{$var} = $val;

					// Reset the lookup table
					$this->lookup[5] = $this->get('five');
					$this->lookup[4] = $this->get('one').$this->get('five');
					$this->lookup[1] = $this->get('one');
					break;

				default:
					$this->{$var} = $val;
					break;
			}
			$return = true;
		}
		return $return;
	}

	/**
	 * Convert the integer to roman numeral
	 * @return null
	 */
	public function convert() {
		$output = "";
		$int = $this->get('int');
		foreach($this->get('lookup') as $value => $numeral){
			$x = floor($int/$value);
			$output .= str_repeat($numeral,$x);
			$int = $int % $value;
		}
		$this->set('roman', $output);
	}

	/**
	 * Magic function to echo this class
	 * @return string - roman numeral
	 */
	public function __toString() {
		return $this->get('roman');
	}
}

/* Test Code */
/*
$x = new IntToRoman(array('int' => 144, 'one' => 'Z', 'five' => 'P'));
$x->convert();
echo $x."\n";
*/