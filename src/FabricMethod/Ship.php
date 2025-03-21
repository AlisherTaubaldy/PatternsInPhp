<?php

namespace App\FabricMethod;


class Ship implements Transport
{
    #[\Override] public function deliver()
    {
        return "Delivering by ship\n";
    }
}