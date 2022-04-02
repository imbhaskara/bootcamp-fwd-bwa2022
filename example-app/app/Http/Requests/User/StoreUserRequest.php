<?php

namespace App\Http\Requests\User;

//Import model for Request methods --> This case: User Model
use App\Model\User;
//use Gate;
//Insert library from laravel to do requestform --> Wajib ada
use Illuminate\Foundation\Http\FormRequest;
//Insert libarary Symfony to get response
use Symfony\Component\HttpFoundation\Response;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Create middleware from kernel at here
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required', 'string', 'max:255',
            ],
            'email' => [
                'required', 'email', 'unique:users', 'max:255',
            ],
            'password' => [
                'string', 'min:8', 'max:255', 'mixedCase',
            ],
            //add validation for role this here
        ];
    }
}
