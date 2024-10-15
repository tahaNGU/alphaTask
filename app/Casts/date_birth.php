<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class date_birth implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return Jalalian::forge($value)->format('Y/m/d');   
     }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $dateTime=explode('/',$value);
        return (new Jalalian($dateTime[0], $dateTime[1], $dateTime[2]))->toCarbon();
    }
}
