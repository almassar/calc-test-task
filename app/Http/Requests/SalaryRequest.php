<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalaryRequest extends FormRequest
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
        return [
            'salary' => 'required',
            'is_pensioner' => 'required|digits_between:0,1',
            'disability_group' => 'required|digits_between:0,3',
            'is_mzp' => 'required|digits_between:0,1', 
            'id_month' => 'required|digits_between:1,12',
            'id_year' => 'required',
        ];
    }
}
