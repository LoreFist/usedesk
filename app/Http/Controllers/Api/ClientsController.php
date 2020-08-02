<?php

namespace App\Http\Controllers\Api;

use App\Clients;
use App\Http\Requests\ClientsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ClientsController extends BaseController {
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index() {
        $models = Clients::all();
        return $this->sendResponse($models->toArray(), 'all clients');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function store(ClientsRequest $request) {
        $model = Clients::create($request->validated());
        return $this->sendResponse($model->toArray(), 'created ok');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function show($id) {
        $model = Clients::find($id);
        if (is_null($model)) {
            return $this->sendError('not found');
        }
        return $this->sendResponse($model->toArray(), 'client id=' + $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Clients                  $clients
     *
     * @return Response
     */
    public function update(ClientsRequest $request, Clients $clients) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Clients $clients
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Clients $clients) {
        $clients->delete();
        return $this->sendResponse($clients->toArray(), 'deleted ok');
    }
}
