<?php

namespace App\Services;
class PlayerService{
    public function addResource(array $array1,array $array2){
        foreach ($array1 as $key => $value) {
            if (isset($array2[$key])) {
                $result[$key] = $value + $array2[$key];
            }
        }
        return $result;
    }
    
}
