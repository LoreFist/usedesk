<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phones extends Model {
    protected $table    = 'clients_phones';
    protected $fillable = ['client_id', 'phone'];
    protected $hidden   = ['created_at', 'updated_at'];
}
