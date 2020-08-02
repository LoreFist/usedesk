<?php

namespace App\Services;

use App\Clients;
use App\Emails;
use App\Http\Requests\ClientsRequest;
use App\Logs;
use App\Phones;
use Illuminate\Support\Facades\Auth;

class ClientsService {

    /**
     * @param ClientsRequest $request
     *
     * @return array|bool
     */
    public static function saveClient(ClientsRequest $request) {
        if ($request->validated()) {
            $model             = new Clients();
            $model->first_name = request('first_name');
            $model->last_name  = request('last_name');
            if ($model->save()) {
                $phones = [];
                $emails = [];
                if ( !is_null($request->phones) AND is_array($request->phones)) {
                    foreach ($request->phones as $phone) {
                        $modelPhones            = new Phones();
                        $modelPhones->client_id = $model->client_id;
                        $modelPhones->phone     = $phone;
                        $modelPhones->save();
                        $phones[] = $modelPhones->toArray();

                    }
                }

                if ( !is_null($request->emails) AND is_array($request->emails)) {
                    foreach ($request->emails as $email) {
                        $modelEmails            = new Emails();
                        $modelEmails->client_id = $model->client_id;
                        $modelEmails->email     = $email;
                        $modelEmails->save();
                        $emails[] = $modelEmails->toArray();
                    }
                }

                dd(LogService::save(Logs::TYPE_CREATE, ['client_id'=>$model->client_id]));
                return ['client' => $model->toArray(), 'phones' => $phones, 'emails' => $emails];
            }

        }
        return false;
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public static function deleteClient($id) {
        $client = self::findClient($id);

        if ($client->exists() AND $client->user_id == Auth::User()->user_id) {
            Phones::where('client_id', $id)->delete();
            Emails::where('client_id', $id)->delete();
            Clients::where('client_id', '=', $id)->delete();

            LogService::save(Logs::TYPE_DELETE, ['client_id'=>$id]);
            return true;
        }
        return false;
    }

    /**
     * @param $request
     * @param $id
     *
     * @return mixed
     */
    public static function updateClient($request, $id) {
        $model = self::findClient($id);
        $model->fill($request->all());

        LogService::save(Logs::TYPE_UPDATE, $request->all());
        return $model->update();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public static function findClient($id) {
        return Clients::with(['phones', 'emails'])->where('client_id', '=', $id)->firstOrFail();
    }

    public static function searchClient($request) {
        $modelClient = Clients::with(['phones', 'emails']);

        if ($request->first_name) $modelClient->where('first_name', 'LIKE', '%' . $request->first_name . '%');
        if ($request->last_name) $modelClient->where('last_name', 'LIKE', '%' . $request->last_name . '%');
        if ($request->phone) $modelClient->whereHas('phones', function ($q) use ($request) {
            $q->where('phone', $request->phone);
        });
        if ($request->email) $modelClient->whereHas('emails', function ($q) use ($request) {
            $q->where('email', $request->email);
        });

        LogService::save(Logs::TYPE_SEARCH, $request->all());
        return $modelClient->get();
    }
}
