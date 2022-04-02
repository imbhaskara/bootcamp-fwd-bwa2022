<?php

namespace App\Http\Requests\Doctor;

//Import model for Request methods --> This case: User Model
use App\Model\Operational\Doctor;
//use Gate;
//Insert library from laravel to do requestform --> Wajib ada
use Illuminate\Foundation\Http\FormRequest;
//Insert libarary Symfony to get response
use Symfony\Component\HttpFoundation\Response;

class StoreDoctorRequest extends FormRequest
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
            'specialist_id' => [
                'required', 'integer',
            ],
            'name' => [
                'required', 'string', 'max:255',
            ],
            'fee' => [
                'required', 'string', 'max:255',
            ],
            'photo' => [
                'nullable', 'string', 'max:10000',
            ],
        ];
    }
}
