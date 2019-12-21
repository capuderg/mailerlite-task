<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = [
        'email',
        'name'
    ];

    // Define the possible states.
    const ACTIVE_STATE = 1;
    const UNSUBSCRIBED_STATE = 2;
    const JUNK_STATE = 3;
    const BOUNCED_STATE = 4;
    const UNCONFIRMED_STATE = 5;

    // A collection of all possible states and their human readable form.
    const STATES = [
        self::ACTIVE_STATE => 'active',
        self::UNSUBSCRIBED_STATE => 'unsubscribed',
        self::JUNK_STATE => 'junk',
        self::BOUNCED_STATE => 'bounced',
        self::UNCONFIRMED_STATE => 'unconfirmed',
    ];

    public function fields()
    {
        return $this->hasMany('App\Field');
    }

    public function getStateAttribute($value)
    {
        return self::STATES[$value];
    }
}
