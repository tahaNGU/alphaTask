<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class KycRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'national_code'=>['required','size:10','unique:kyc,national_code'],
            'pic'=>['required','image','mimes:jpg,jpeg,png','max:512'],
            'birthday'=>['required','regex:/^(13[0-9]{2})\/(0[1-9]|1[0-2])\/(0[1-9]|[12]\d|3[01])$/']
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        throw new HttpResponseException(response()->json([
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
          ],Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
