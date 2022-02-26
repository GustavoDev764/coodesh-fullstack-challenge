<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Launches extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'launches';
    
    protected $fillable = [
        'sku',
        'provider',
        'space_flight_news_id',      
    ];

    protected $hidden = [
        'space_flight_news_id',
    ];

    public function spaceFlightNews(){
        return $this->hasOne(SpaceFlightNews::class,'id','space_flight_news_id');
    }
}
