<?php

use MongoDB\BSON\ObjectId;

$date = new DateTime('07/27/1999');
echo $date->getTimestamp();