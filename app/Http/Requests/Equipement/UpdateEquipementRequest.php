<?php

namespace App\Http\Requests\Equipement;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEquipementRequest extends FormRequest
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
             'type' => ['required', Rule::in(['audio', 'video', 'display', 'autre']),],
             'description' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
