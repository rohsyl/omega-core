<?php
namespace rohsyl\OmegaCore\Http\Requests\Admin\Member\Member;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberPasswordRequest extends FormRequest
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
            'password' => 'required',
            'repeat_password' => 'required|same:password',
        ];
    }
}