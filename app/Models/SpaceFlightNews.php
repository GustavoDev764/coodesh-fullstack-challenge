<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpaceFlightNews extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'space_flight_news';
    
    protected $fillable = [
        'featured',
        'sku',
        'title',
        'url',
        'imageUrl',
        'newsSite',
        'summary',
        'publishedAt',        
    ];

    public function events(){
        return $this->hasMany(Events::class, 'space_flight_news_id', 'id');   
    }
    
    public function launches(){
        return $this->hasMany(Launches::class, 'space_flight_news_id', 'id');   
    }
}
