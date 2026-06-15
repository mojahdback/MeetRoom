<?php

namespace App\Http\Requests\Room;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
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
            
            'name' => 'required|string|min:3|max:30',
            'capacity' => ['required','integer'],
            'floor' => ['required','integer'],
            'is_active' => 'required|boolean',
            'building_id' => 'required|exists:buildings,id',
            'equipements' => 'nullable|array',
            'equipements.*' => 'exists:equipements,id',
            
        ];
    }
}
