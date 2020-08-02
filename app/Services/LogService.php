<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogService {

    /**
     * @param       $type
     * @param array $data
     *
     * @return bool
     */
    public static function save($type, $data = []) {
        DB::beginTransaction();
        try {
            $model          = new \App\Logs();
            $model->user_id = Auth::User() ? Auth::User()->user_id : null;
            $model->type    = $type;
            $model->data    = serialize($data);
            $model->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
}
