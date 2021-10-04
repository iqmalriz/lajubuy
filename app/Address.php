<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresss';
    protected $fillable = ['aname', 'aphone', 'zip', 'state', 'city', 'street', 'default', 'shopadd', 'userid'];
}
