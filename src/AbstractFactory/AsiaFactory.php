<?php

namespace App\AbstractFactory;

class AsiaFactory extends ContinentFactory
{

    #[\Override] public function createHerbivore(): Herbivore
    {
        return new Buffalo();
    }

    #[\Override] public function createCarnivore(): Carnivore
    {
        return new Tiger();
    }
}

