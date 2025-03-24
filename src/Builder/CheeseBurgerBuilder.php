<?php

namespace App\Builder;

class CheeseBurgerBuilder implements BurgerBuilder
{
    private Burger $cheeseBurger;

    public function __construct()
    {
        $this->cheeseBurger = new Burger();
    }


    #[\Override] public function addBun()
    {
        $this->cheeseBurger->addIngredient("Sesame Bun");
    }

    #[\Override] public function addPatty()
    {
        $this->cheeseBurger->addIngredient("Beef Patty");
    }

    #[\Override] public function addCheese()
    {
        $this->cheeseBurger->addIngredient("Cheddar Cheese");
    }

    #[\Override] public function addVegetables()
    {
        $this->cheeseBurger->addIngredient("Lettuce & Tomato");
    }

    #[\Override] public function addSauce()
    {
        $this->cheeseBurger->addIngredient("Ketchup & Mustard");
    }

    #[\Override] public function getBurger(): Burger
    {
        return $this->cheeseBurger;
    }
}