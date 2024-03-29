<?php


namespace rohsyl\OmegaCore\Http\Requests\Admin\UserManagement\User;


use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|email|string',
            'fullname' => 'required|string',
            'is_enabled' => 'nullable|boolean',
        ];
    }
}