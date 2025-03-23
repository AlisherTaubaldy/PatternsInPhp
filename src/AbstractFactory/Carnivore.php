<?php

namespace App\AbstractFactory;

interface Carnivore
{
    public function getName(): string;

    public function hunt(Herbivore $herbivore): string;

}