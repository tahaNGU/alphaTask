<?php

namespace App\Models;

use App\Casts\date_birth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class kyc extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,InteractsWithMedia;
    
    protected $table="kyc";
    protected $append=['image'];
    protected $hidden=['media'];
    public $fillable=['national_code','birthday'];

    protected $casts = [
        'birthday' => date_birth::class,
    ];

    // public function getImageAttribiute(){
    //     return $this->getMedia('image')->first()?->getUrl();
    // }

    public function getRouteKeyName(): string
    {
        return 'national_code';
    }
}
