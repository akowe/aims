<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimalIdentification extends Model 
{

        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'animal_identification';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'identification_number',
    ];


}
