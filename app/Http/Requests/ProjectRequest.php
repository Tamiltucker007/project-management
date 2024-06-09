<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'user_id' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'description' => 'required|string|max:255',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'Please enter project name.',
            'user_id.required' => 'Please Assign the Team Member.',
            'start_date.required' => 'Please select start date.',
            'end_date.required' => 'Please select end date.',
            'end_date.after' => 'End date must be after start date.',
            'description.required' => 'Please enter project description.',
        ];
    }

}
