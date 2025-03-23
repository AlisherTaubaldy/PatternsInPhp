<?php

namespace App\AbstractFactory;

class Tiger implements Carnivore
{

    #[\Override] public function getName(): string
    {
        return "Tiger";
    }

    #[\Override] public function hunt(Herbivore $herbivore): string
    {
        return "Tiger hunts " . $herbivore->getName();
    }
}