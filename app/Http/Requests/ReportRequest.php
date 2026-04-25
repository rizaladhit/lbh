<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'client_name' => 'required|string|max:255',
            'client_contact' => 'required|string|max:255',
            'case_title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:Draft,Submitted,In Progress,Completed',
            'user_id' => 'nullable|exists:users,id',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:5120',
            'notes' => 'nullable|string',
        ];
    }
}
