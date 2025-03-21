<?php

namespace App\FabricMethod;


class Truck implements Transport
{

    #[\Override] public function deliver()
    {
        return "Delivering by truck\n";
    }
}