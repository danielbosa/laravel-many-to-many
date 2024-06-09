<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required|max:200|min:3',
            /*
            ATTN: se il campo title fosse unique (se lo avessi definito in fase di migration, quindi nel db) devo ignorarlo qui nell'update! Perché se no non mi fa updatare il record: perché vede che il titolo che sto passando (qualora non lo modificassi) esiste già; è lo stesso! Quindi fare così in array:
                
            'title' => [
                'required',
                'max:200',
                'min:3',
                Rule::unique('posts')->ignore($this->post->id),
            ],
            */
            'image' => 'nullable',
            'url' => 'required',
            'type_id' => 'nullable|exists:types,id'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio!',
            'title.max' => 'Il titolo deve essere lungo massimo :max caratteri!',
            'title.min' => 'Il titolo deve essere lungo almeno :min caratteri!',
            'url.required' => 'La URL è obbligatoria!'
        ];
    }
}
