<?php

/**
2. Given the following, What is the value of $b, what is the value of $a, why is that the value?

    function doSomething ( &$arg )
    {
        $return = $arg;
        $arg += 1;
        return $return;
    }
    
    $a = 3;
    $b = doSomething( $a );
**/


/**
Answer:
$a is 4.  doSomething takes an argument by reference which in our case is A, it then adds 1 to itself, therefore a is now 4.

$b is 3.  doSomething sets $return equal to the value within the argument passed in, 3 in our case, and then returns it without ever changing that value (changing the $arg value is inconsequential here since $return is equal to the value in $arg, not a reference to $arg)

PHP's references are less reference and more alias, $arg in this case is really an alias for $a.
**/