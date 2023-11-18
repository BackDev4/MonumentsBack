<?php

namespace App\Monuments\Reviews\Requests;

use App\Monuments\Reviews\DTOs\ReviewsDTO;
use Illuminate\Foundation\Http\FormRequest;

class ReviewsRequest extends FormRequest
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
            'name' => 'required',
            'content' => 'required',
        ];
    }

    public function toDto(): ReviewsDTO
    {
        $validated = $this->validated();

        return new ReviewsDTO(...array_values($validated));
    }
}
