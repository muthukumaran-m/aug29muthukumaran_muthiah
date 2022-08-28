<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;

class StudenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        switch ($this->method()) {
            case 'POST': {
                    return [
                        'name' => 'required|max:50|unique:students,email',
                        'email' => 'required|max:50',
                        'phone' => 'required|max:13|unique:students,phone',
                        'address' => 'required',
                        'city' => 'required|max:50',
                        'state' => 'required|max:50',
                        'country' => 'required|max:50',
                        'status' => 'nullable|boolean',
                        'maths' => 'nullable|integer|max:100',
                        'english' => 'nullable|integer|max:100',
                        'history' => 'nullable|integer|max:100',
                    ];
                }

            case 'PUT':
            case 'PATCH': {
                    $student = request()->student;
                    return [
                        'name' => 'required|max:50|unique:students,email,' . $student->id,
                        'email' => 'required|max:50',
                        'phone' => 'required|max:13|unique:students,phone,' . $student->id,
                        'address' => 'required',
                        'city' => 'required|max:50',
                        'state' => 'required|max:50',
                        'country' => 'required|max:50',
                        'status' => 'nullable|boolean',
                        'maths' => 'nullable|integer|max:100',
                        'english' => 'nullable|integer|max:100',
                        'history' => 'nullable|integer|max:100',
                    ];
                }
        }
    }
}
