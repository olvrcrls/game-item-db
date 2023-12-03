<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
            'name' => 'string|sometimes|unique:items,name,' . $this->item->id,
            'game_id' => 'string|sometimes|exists:games,id',
            'description' => 'string|sometimes',
            'attributes' => 'sometimes|array',
            'type' => 'sometimes|string',
            'rarity' => 'sometimes|string',
            'level' => 'sometimes|integer',
            'deprecated' => 'sometimes|boolean'
        ];
    }
}
