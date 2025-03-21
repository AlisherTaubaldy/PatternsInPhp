<?php

namespace App\FabricMethod;

abstract class Logistics
{
    public function planDelivery(): string{
        return "Deliver has been announced\n";
    }

    public function createTransport(): string{
        return "Creating transport for delivery";
    }
}