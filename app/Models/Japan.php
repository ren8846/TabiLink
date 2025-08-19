<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Japan extends Model
{
    use HasFactory;

    protected $table = 'japans'; // テーブル名
    protected $fillable = [
        'district', 'prefecture', 'facility_name', 'salary', 'site', 'url', 'image_url', 'world_id'
    ];
}
