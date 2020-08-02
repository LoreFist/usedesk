<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ClientsRequest extends FormRequest {

    public $user_id;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null) {
        $this->user_id = Auth::User()->user_id;
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

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
            'phones'     => 'array|unique:clients_phones,phone',
            'emails'     => 'array|unique:clients_emails,email'
        ];

        switch ($this->getMethod()) {
            case 'POST':
                if ($this->getPathInfo() == '/api/clients/search') {
                    return [
                        'first_name' => 'string',
                        'last_name'  => 'string',
                        'phone'      => 'integer',
                        'email'      => 'string'
                    ];
                }
                return $rules;
            CASE 'PUT':
                return [
                    'first_name' => 'string:clients,first_name',
                    'last_name'  => 'string:clients,last_name'
                ];
        }
    }
}
