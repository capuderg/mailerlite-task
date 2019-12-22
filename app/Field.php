<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        'title',
        'type',
    ];

    // Define the possible types.
    const DATE_TYPE = 1;
    const NUMBER_TYPE = 2;
    const STRING_TYPE = 3;
    const BOOLEAN_TYPE = 4;

    // A collection of all possible types and their human readable form.
    const TYPES = [
        self::DATE_TYPE => 'date',
        self::NUMBER_TYPE => 'number',
        self::STRING_TYPE => 'string',
        self::BOOLEAN_TYPE => 'boolean',
    ];

    public function subscriber()
    {
        return $this->belongsTo('App\Subscriber');
    }

    public function getTypeAttribute($value)
    {
        return self::TYPES[$value];
    }

    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = array_flip(self::TYPES)[$value];
    }
}
