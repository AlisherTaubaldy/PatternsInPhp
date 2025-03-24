<?php


namespace App\Builder;

class Burger
{
    private array $ingredients = [];

    public function addIngredient(string $ingredient)
    {
        $this->ingredients[] = $ingredient;
    }

    public function getBurger(): string
    {
        return "Burger with " . implode(", ", $this->ingredients) . "\n";
    }
}