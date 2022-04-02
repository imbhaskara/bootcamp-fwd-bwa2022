<?php

namespace App\Http\Requests\Consultation;

//Import model for Request methods --> This case: User Model
use App\Model\MasterData\Consultation;
//use Gate;
//Insert library from laravel to do requestform --> Wajib ada
use Illuminate\Foundation\Http\FormRequest;
//Insert libarary Symfony to get response
use Symfony\Component\HttpFoundation\Response;
//Insert rule library special for update request
use Illuminate\Validation\Rule;

class UpdateConsultationRequest extends FormRequest
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
        ];
    }
}
