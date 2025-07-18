<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
{
    /**
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {   
        
        // $this->isMethod('post') ? 'create' : 'update';// $this -_> request object, isMethod checks if the request is a POST request
        return [
            'name'=> ['required','string','max:255',function($attribute,$value,$fail){
                if($value === 'admin') {
                    $fail('the name field cannot be "admin".');
                }
            }], // required field, must be a string, and max length is 255 characters
            'section'=> 'nullable|string|max:255',// nullable if empty field dont  check next rules
            'subject'=> 'nullable|string|max:255',
            'room'=> 'nullable|string|max:255',
            'cover_image' => 'required|image|dimensions:min_width=200,min_height=200|max:2048', // max size 2MB
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.max' => 'The name field may not be greater than 255 characters.',
            'section.string' => 'The section field must be a string.',
            'section.max' => 'The section field may not be greater than 255 characters.',
            'subject.string' => 'The subject field must be a string.',
            'subject.max' => 'The subject field may not be greater than 255 characters.',
            'room.string' => 'The room field must be a string.',
            'room.max' => 'The room field may not be greater than 255 characters.',
            'cover_image.image' => 'The cover image must be an image file.',
            'cover_image.dimensions' => 'The cover image must have minimum dimensions of 200x200 pixels.',
            'cover_image.max' => 'The cover image may not be larger than 2MB.',// comment
        ];
    }
}
