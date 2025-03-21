<?php

namespace App\FabricMethod;

use App\FabricMethod\Logistics;
use App\FabricMethod\Ship;

class SeaLogistics extends Logistics
{
    public function createTransport(): string
    {
        $transport = new Ship();
        return $transport->deliver();
    }
}