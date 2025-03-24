<?php

namespace App\Builder;

interface BurgerBuilder
{

    public function addBun();

    public function addPatty();

    public function addCheese();

    public function addVegetables();

    public function addSauce();

    public function getBurger(): Burger;

}