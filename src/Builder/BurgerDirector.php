<?php

namespace App\Builder;

class BurgerDirector
{
    public function createBurger(BurgerBuilder $burgerBuilder): Burger
    {
        $burgerBuilder->addBun();
        $burgerBuilder->addCheese();
        $burgerBuilder->addSauce();
        $burgerBuilder->addVegetables();
        $burgerBuilder->addPatty();

        return $burgerBuilder->getBurger();
    }
}