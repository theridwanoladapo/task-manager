<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'name' => 'required|max:255|unique:tasks,name',
            'project_id' => 'required|exists:projects,id',
            'priority' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The task name field is required',
            'name.unique' => 'The task name is already added',
            'project_id.exists' => 'Please select a project',
        ];
    }
}
