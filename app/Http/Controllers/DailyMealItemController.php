<?php

namespace App\Http\Controllers;
use App\Models\DailyMealItem;
use Illuminate\Http\Request;

class DailyMealItemController extends Controller
{
    public function GetDayWiseMealItem()
    {
        $data = DailyMealItem::all();
        return $data;
    }
    
    public function EditDayWiseMealItem(Request $req)
    {
        $item_id     = $req->item_id;
        $lunch_item  = $req->lunch_item;
        $dinner_item = $req->dinner_item;
        
        $item = DailyMealItem::find($item_id);
        $item->lunch_item  = $lunch_item;
        $item->dinner_item = $dinner_item;
        $result = $item->save();
        return $result;

    }
}
