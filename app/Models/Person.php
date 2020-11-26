<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Person extends Model
{
    /**
     * @var string
     */
    protected $table = 'persons';

    /**
     * @var array
     */
    protected $fillable = [
        'product', 'client', 'passport', 'first_name', 'last_name', 'Address', 'city', 'number'
    ];

    /**
     * Check if person information exist.
     * 
     * @return bool
     */
    public function personInfoExist()
    {
        return $this->where('client', Auth::id())->count() > 0;
    }

    /**
     * Get loggedIn person.
     * 
     * @return App\Models\Person
     */
    public function currentPerson()
    {
        return $this->where('client', Auth::id())->first();
    }

}
