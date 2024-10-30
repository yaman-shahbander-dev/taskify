<?php

namespace App\Support\Bases;

use App\Support\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class BaseRequest extends FormRequest
{
    use ResponseTrait;
    public function authorize(): true
    {
        return true;
    }

    abstract public function rules(): array;

    protected function failedValidation(Validator $validator): void
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(
                $this->unprocessableResponse($validator->errors()->all())
            );
        }

        parent::failedValidation($validator);
    }
}
