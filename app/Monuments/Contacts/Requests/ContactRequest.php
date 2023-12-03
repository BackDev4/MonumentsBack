<?php

namespace App\Monuments\Contacts\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Monuments\Contacts\DTOs\ContactDTO;

class ContactRequest extends FormRequest
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
            'type' => 'required',
            'data' => 'required',
        ];
    }

    public function toDto(): ContactDTO
    {
        $validated = $this->validated();

        return new ContactDTO(...array_values($validated));
    }
}
