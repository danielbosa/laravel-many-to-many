<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateTypeRequest extends FormRequest
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
            'name' => [
                'required',
                'max:200',
                Rule::unique('types')->ignore($this->type->id),
            ],
            'icon' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il nome è obbligatorio!',
            'name.max' => 'Il nome deve essere lungo massimo :max caratteri!',
            'name.unique' => 'Il nome deve essere univoco!',
        ];
    }
}
