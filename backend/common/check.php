<?php

require_once('logger.php');


logger('testing!!!');

$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");

foreach($age as $key => $value) {
    echo "Key=" . $key . ", Value=" . $value;
    echo "<br>";
}

echo "\nIt's working";