<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Clients extends Model {
    protected $primaryKey = 'client_id';
    protected $fillable   = ['first_name', 'last_name', 'user_id'];
    protected $hidden     = ['created_at', 'updated_at'];

    public function __construct(array $attributes = []) {
        $this->user_id = Auth::User()->user_id;
        parent::__construct($attributes);
    }

    public function phones() {
        return $this->hasMany(Phones::class, 'client_id', 'client_id');
    }

    public function emails() {
        return $this->hasMany(Emails::class, 'client_id', 'client_id');
    }
}
