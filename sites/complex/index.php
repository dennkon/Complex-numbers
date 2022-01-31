<?php

use complex\Complex;
use complex\Operation;

require_once 'lib/Complex.php';
require_once 'lib/Operation.php';

$cA = new Complex(1, 2, 'i');
$cB = new Complex(3, 4, 'i');

echo Operation::div($cA,$cB);
echo '<br>';
echo $cA->toJson();