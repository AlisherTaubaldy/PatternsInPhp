<?php

namespace App\AbstractFactory;

class AfricaFactory extends ContinentFactory
{

    #[\Override] public function createHerbivore(): Herbivore
    {
        return new Zebra();
    }

    #[\Override] public function createCarnivore(): Carnivore
    {
        return new Lion();
    }
}