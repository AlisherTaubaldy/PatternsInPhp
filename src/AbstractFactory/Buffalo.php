<?php

namespace App\AbstractFactory;

class Buffalo implements Herbivore
{
    #[\Override] public function getName(): string
    {
        return "Buffalo";
    }
}
