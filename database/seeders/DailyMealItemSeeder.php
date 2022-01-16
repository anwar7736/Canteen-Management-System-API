<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DailyMealItem;

class DailyMealItemSeeder extends Seeder
{

    public function run()
    {
        $data = DailyMealItem::insert([
            ['day' => 'শনিবার', 'lunch_item' => 'মুরগীর মাংস, সবজি, ডাল', 'dinner_item' => 'বড় মাছ, ভর্তা, ডাল'],
            ['day' => 'রবিবার', 'lunch_item' => 'বড় মাংস, সবজি, ডাল', 'dinner_item' => 'ছোট মাছ, ভর্তা, ডাল'],
            ['day' => 'সোমবার', 'lunch_item' => 'ডিম, ভর্তা, ডাল', 'dinner_item' => 'বড় মাছ, সবজি, ডাল'],
            ['day' => 'মঙ্গলবার', 'lunch_item' => 'মুরগীর মাংস, সবজি, ডাল', 'dinner_item' => 'মলা মাছ ভর্তা, ডাল'],
            ['day' => 'বুধবার', 'lunch_item' => 'বড় মাছ, শাক-সবজি, ডাল', 'dinner_item' => 'বড় মাছ, আলু ভর্তা, ডাল'],
            ['day' => 'বৃহস্পতিবার', 'lunch_item' => 'ছোট মাছ, ভর্তা, ডাল', 'dinner_item' => 'ভুনা খিচুড়ি, সবজি, ডাল'],
            ['day' => 'শুক্রবার', 'lunch_item' => 'গরুর মাংস, সবজি, ডাল', 'dinner_item' => 'ডিম, শাক, ডাল']
        ]);
    }
}
