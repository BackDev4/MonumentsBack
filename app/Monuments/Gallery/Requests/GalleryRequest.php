<?php

namespace App\Monuments\Gallery\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Monuments\Gallery\DTOs\GalleryDTO;

class GalleryRequest extends FormRequest
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
            'phone' => 'required'
        ];
    }

    public function toDto(): GalleryDTO
    {
        $validated = $this->validated();

        return new GalleryDTO(...array_values($validated));
    }
}
