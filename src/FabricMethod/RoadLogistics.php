<?php

namespace App\FabricMethod;

use App\FabricMethod\Logistics;
use App\FabricMethod\Truck;

class RoadLogistics extends Logistics
{
    public function createTransport(): string
    {
        $transport = new Truck();
        return $transport->deliver();
    }
}