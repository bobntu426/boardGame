<?php 
namespace App\Services;

use App\Models\Card;
use Illuminate\Support\Facades\DB;

class BuyCardService
{
    public static function costResource($player,$cardObj){
        switch ($cardObj['color']) {
            case 'green':
                return;
            case 'blue':
                $player['money'] -= $cardObj['cost']['money'];
                return;
    
            case 'yellow':
                foreach ($cardObj['cost'] as $key => $value) {
                    $player[$key] -= $value;
                }      
                return;    
            case 'purple':
                foreach ($cardObj['cost'] as $key => $value) {
                    $player[$key] -= $value;
                }
                return; 
        }
    }
    public static function buyEffect($player,$cardObj){
        switch ($cardObj['color']) {
            case 'green':
                foreach ($cardObj['buyEffect'] as $key => $value) {
                    $player[$key] += $value;
                }
                return 'sure'; 
    
            case 'blue':
                switch ($cardObj['function']){
                    case $cardObj['increasePoint']:
                        switch('functionColor'){
                            case 'green':
                                $player->extraGreenPoint += $cardObj->point;
                                return 'sure';
                            case 'blue':
                                $player->extraBluePoint += $cardObj->point;
                                return 'sure';
                            case 'yellow':
                                $player->extraYellowPoint += $cardObj->point;
                                return 'sure';
                            case 'purple':
                                $player->extraPurplePoint += $cardObj->point;
                                return 'sure';
                            case 'harvest':
                                $player->extraHarvest += $cardObj->point;
                                return 'sure';
                            case 'production':
                                $player->extraProduction += $cardObj->point;
                                return 'sure';
                            }
                    case 'gainDice':

                    case 'harvest':
                    case 'production':
                    case 'gainScore':
                    default:
                };
                foreach ($cardObj['buyEffect'] as $key => $value) {
                    $player[$key] += $value;
                }
                return;
    
            case 'yellow':
                if($cardObj['functionColor']){
    
                }
                foreach ($cardObj['buyEffect'] as $key => $value) {
                    $player[$key] += $value;
                }      
                return;    
            case 'purple':
                switch ($cardObj['function']){
                    case 'chooseCost':
                    case 'gainDice':
                    case 'harvest':
                    case 'production':
                    default:
                };
            foreach ($cardObj['buyEffect'] as $key => $value) {
                $player[$key] += $value;
            }
            return; 
        }
    }
}
