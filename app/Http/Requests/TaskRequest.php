<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
        ];
    }
    
    public function messages()
    {
        return [
            'project_id.required' => 'Please select project name.',
            'title.required' => 'Please enter title name.',
            'deadline.required' => 'Please select deadline date.',
        ];
    }
}