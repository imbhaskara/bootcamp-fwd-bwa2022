<?php

namespace App\Http\Requests\User;

//Import model for Request methods --> This case: User Model
use App\Model\User;
use Gate;
//Insert library from laravel to do requestform --> Wajib ada
use Illuminate\Foundation\Http\FormRequest;
//Insert libarary Symfony to get response
use Symfony\Component\HttpFoundation\Response;
//Insert rule library special for update request
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Create middleware from kernel at here
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
                'required', 'email', 'max:255', Rule::unique('users')->ignore($this->user),
                //ignore data user yang sama (this user) atau only work for other record id
            ],
            'password' => [
                'string', 'min:8', 'max:255', 'mixedCase',
            ],
            //add validation for role this here
        ];
    }
}
