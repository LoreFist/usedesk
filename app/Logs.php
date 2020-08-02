<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model {
    protected $table      = 'users_logs';
    protected $primaryKey = 'user_log_id';

    const TYPE_CREATE   = 1;
    const TYPE_UPDATE   = 2;
    const TYPE_DELETE   = 3;
    const TYPE_SEARCH   = 4;
    const TYPE_REGISTER = 5;
    const TYPE_LOGIN    = 6;
    const TYPE_LOGOUT   = 7;
}
