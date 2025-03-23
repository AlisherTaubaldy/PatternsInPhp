<?php

namespace App\AbstractFactory;

class Lion implements Carnivore
{

    #[\Override] public function getName(): string
    {
        return "Lion";
    }

    #[\Override] public function hunt(Herbivore $herbivore): string
    {
        return "Lion hunts " . $herbivore->getName();
    }
}