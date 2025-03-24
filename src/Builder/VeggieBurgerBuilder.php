<?php

namespace App\Builder;

class VeggieBurgerBuilder implements BurgerBuilder
{
    private Burger $veggieBurger;

    public function __construct()
    {
        $this->veggieBurger = new Burger();
    }

    #[\Override] public function addBun()
    {
        $this->veggieBurger->addIngredient("Sesame Bun");
    }

    #[\Override] public function addPatty()
    {
        $this->veggieBurger->addIngredient("Lentil patty");
    }

    #[\Override] public function addCheese()
    {

    }

    #[\Override] public function addVegetables()
    {
        $this->veggieBurger->addIngredient("Lettuce & Tomato");
    }

    #[\Override] public function addSauce()
    {
        $this->veggieBurger->addIngredient("Vegan sauce");
    }

    #[\Override] public function getBurger(): Burger
    {
        return $this->veggieBurger;
    }
}