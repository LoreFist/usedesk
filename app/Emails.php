<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emails extends Model {
    protected $fillable = ['client_id', 'email'];

    protected $hidden = ['created_at', 'updated_at'];
}
