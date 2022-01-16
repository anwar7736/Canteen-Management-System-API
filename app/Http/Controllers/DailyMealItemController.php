<?php

namespace App\Http\Controllers;
use App\Models\DailyMealItem;
use Illuminate\Http\Request;

class DailyMealItemController extends Controller
{
    public function GetDayWiseMealItem(){
        $data = DailyMealItem::all();
        return $data;
    }
}
