<?php

namespace App\AbstractFactory;

class Zebra implements Herbivore
{

    #[\Override] public function getName(): string
    {
        return "Zebra";
    }
}