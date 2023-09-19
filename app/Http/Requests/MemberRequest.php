<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {

        $id = $this->get('id');
        if ($this->method() == 'PUT') {
            $phone = 'required|unique:members,phone,' . $id;
        } else {
            $phone = 'required|unique:members,phone,NULL';
        }
        return [
            'phone' => $phone,
        ];
    }
}
