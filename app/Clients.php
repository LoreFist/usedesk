<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model {
    protected $fillable = ['first_name', 'last_name'];

    protected $hidden = ['created_at', 'updated_at'];
}
