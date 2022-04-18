<?php

namespace App\Http\Requests\DetailUser;

//Import model for Request methods --> This case: User Model
use App\Model\ManagementAccess\DetailUser;
use Gate;
//Insert library from laravel to do requestform --> Wajib ada
use Illuminate\Foundation\Http\FormRequest;
//Insert libarary Symfony to get response
use Symfony\Component\HttpFoundation\Response;
//Insert rule library special for update request
use Illuminate\Validation\Rule;

class UpdateDetailUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Create middleware from kernel at here
        abort_if(Gate::denies('detail_user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
            'user_id' => [
                'required', 'integer',
            ],
            'type_user_id' => [
                'required', 'integer',
            ],
            'contact' => [
                'nullable', 'string', 'max:255',
            ],
            'address' => [
                'nullable', 'string', 'max:255',
            ],
            'photo' => [
                'nullable', 'string', 'max:10000',
            ],
            'gender' => [
                'nullable', 'integer', 'max:255'
            ],
        ];
    }
}
