<?php

namespace App\Http\Requests\Solicitudes;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'order_direction' => 'nullable|in:asc,desc',
            'order_column' => 'nullable|in:created_at,status,id,document_no',
        ];
    }
}
