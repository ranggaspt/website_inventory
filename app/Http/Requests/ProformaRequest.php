<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProformaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->get('id');
        if ($this->method() == 'PUT') {
            $file = 'nullable|file|mimes:doc,docx,xls,xlsx,ppt,pptx,pdf|max:4096';
        } else {
            $file = 'required|file|mimes:doc,docx,xls,xlsx,ppt,pptx,pdf|max:4096';
        }
        return [
            'code' => 'required|string',
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'total_price' => 'required',
            'information' => 'required',
            'file' => $file
        ];
    }
}
