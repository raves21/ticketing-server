<?php

namespace App\Http\Requests\Office;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class Index extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'except_own' => ['nullable', 'boolean']
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('except_own')) {
            $this->merge([
                'except_own' => filter_var($this->except_own, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            ]);
        }
    }
}
