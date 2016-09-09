<?php

/**
1. Refactor the following pseudo code, correct if necessary.

    $id = $request['id'];
    $result = query($conn, "SELECT * FROM testdb WHERE id = $id");
**/

$result = false;
if (filter_var($request['id'], FILTER_VALIDATE_INT) !== FALSE) {
	$id = $request['id'];
	$query = <<<EOL
SELECT *
FROM testdb
WHERE id = $1
EOL;
	$params = array($id);
	$result = query_params($conn,$query,$params);
}