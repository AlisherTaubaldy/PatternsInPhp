<?php

namespace App\AbstractFactory;

abstract class ContinentFactory
{
    abstract public function createHerbivore(): Herbivore;

    abstract public function createCarnivore():Carnivore;
}