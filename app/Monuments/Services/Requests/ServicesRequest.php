<?php

namespace App\Monuments\Services\Requests;

use App\Monuments\Services\DTOs\ServicesDTO;
use Illuminate\Foundation\Http\FormRequest;

class ServicesRequest extends FormRequest
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
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
        ];
    }

    public function toDto(): ServicesDTO
    {
        $validated = $this->validated();

        return new ServicesDTO(...array_values($validated));
    }

}
