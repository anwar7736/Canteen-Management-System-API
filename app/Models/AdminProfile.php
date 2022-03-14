<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    use HasFactory;
    protected $table = 'admin_profile';
    protected $fillable = ['shop_logo', 'shop_name', 'shop_address', 'shop_owner', 'owner_phone', 'owner_email'];
    public $timestamps = false;
}
