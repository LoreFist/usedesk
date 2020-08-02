<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ClientsRequest;
use App\Services\ClientsService;
use Illuminate\Http\JsonResponse;

class ClientsController extends BaseController {

    /**
     * Store a newly created resource in storage.
     *
     * @param ClientsRequest $request
     *
     * @return JsonResponse
     */
    public function store(ClientsRequest $request) {
        $result = ClientsService::saveClient($request);
        if (is_array($result))
            return $this->sendResponse($result, 'created ok');
        else
            return $this->sendError('save error');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function show($id) {
        $model = ClientsService::findClient($id);
        if (is_null($model)) {
            return $this->sendError('not found');
        }
        return $this->sendResponse($model->toArray(), '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClientsRequest $request
     * @param                $id
     *
     * @return JsonResponse
     */
    public function update(ClientsRequest $request, $id) {
        return $this->sendResponse(ClientsService::updateClient($request, $id)->toArray(), '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function destroy($id) {
        return $this->sendResponse([], ClientsService::deleteClient($id));
    }

    /**
     * @param ClientsRequest $request
     *
     * @return JsonResponse
     */
    public function search(ClientsRequest $request) {
        return $this->sendResponse(ClientsService::searchClient($request)->toArray(), 'search');
    }
}
