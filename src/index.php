<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\FabricMethod\RoadLogistics;
use App\FabricMethod\SeaLogistics;

$road = new RoadLogistics();

echo $road->planDelivery();
echo $road->createTransport();

$sea = new SeaLogistics();

echo $sea->planDelivery();
echo $sea->createTransport();

