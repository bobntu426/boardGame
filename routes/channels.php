<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('lobby', function ($user, $id) {
    // return (int) $user->id === (int) $id;
});
Broadcast::channel('table.{tableId}', function ($user, $tableId){
    
});
