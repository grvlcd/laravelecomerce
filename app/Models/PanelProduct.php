<?php

namespace App\Models;

class PanelProduct extends Product
{
    protected static function booted() {
        // static::addGlobalScope(new AvailableScope);
    }
}
