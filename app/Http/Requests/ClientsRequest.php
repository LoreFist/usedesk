<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientsRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [
            'first_name' => 'required|string:clients,first_name',
            'last_name'  => 'required|string:clients,last_name',
            'phone'      => 'required|string|unique:phones,phone',
            'email'      => 'required|string|unique:emails,email',
        ];

        switch ($this->getMethod()) {
            case 'POST':
            case 'PUT':
                return $rules;
            case 'DELETE':
                return [
                    'client_id' => 'required|integer|exists:clients,client_id'
                ];
        }
    }
}
