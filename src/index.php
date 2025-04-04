<?php

require_once __DIR__ . '/../vendor/autoload.php';
//Fabric method
/*
use App\FabricMethod\RoadLogistics;
use App\FabricMethod\SeaLogistics;

$road = new RoadLogistics();

echo $road->planDelivery();
echo $road->createTransport();

$sea = new SeaLogistics();

echo $sea->planDelivery();
echo $sea->createTransport();*/

//Abstract Factory
/*
use App\AbstractFactory\AfricaFactory;
use App\AbstractFactory\AsiaFactory;

$asiaFactory = new AsiaFactory();
$africaFactory = new AfricaFactory();

$asiaHerbivore = $asiaFactory->createHerbivore();
$africaHerbivore = $africaFactory->createHerbivore();

$asiaCarnivore = $asiaFactory->createCarnivore();
$africaCarnivore = $africaFactory->createCarnivore();

echo "🌍 Africa:\n";
echo $asiaCarnivore->hunt($asiaHerbivore) . "\n";
echo "🌍 Asia:\n";
echo $africaCarnivore->hunt($africaHerbivore) . "\n";*/

use App\Builder\BurgerDirector;
use App\Builder\CheeseBurgerBuilder;
use App\Builder\VeggieBurgerBuilder;

$director = new BurgerDirector();

echo "Cheese Burger: ";
$cheeseBurgerBuilder = new CheeseBurgerBuilder();
$cheeseBurger = $director->createBurger($cheeseBurgerBuilder);

echo $cheeseBurger->getBurger();

echo "Veggie Burger: ";
$veggieBurgerBuilder = new VeggieBurgerBuilder();
$veggieBurger = $director->createBurger($veggieBurgerBuilder);

echo $veggieBurger->getBurger();


