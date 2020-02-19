<?php
require_once(dirname(__DIR__) . '/vendor/autoload.php');
use \BBS\Routing\Routing;
$routing = new Routing();
$routing->execute();
