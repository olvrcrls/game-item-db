<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            'name' => 'string|required|unique:items,name',
            'game_id' => 'string|required|exists:games,id',
            'description' => 'string|required',
            'attributes' => 'sometimes|array',
            'type' => 'sometimes|string',
            'rarity' => 'sometimes|string',
            'level' => 'sometimes|integer',
            'deprecated' => 'sometimes|boolean'
        ];
    }
}
