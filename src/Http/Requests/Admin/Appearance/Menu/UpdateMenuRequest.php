<?php


namespace rohsyl\OmegaCore\Http\Requests\Admin\Appearance\Menu;


use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'nullable|string',
            'is_main' => 'required|boolean',
            'member_group_id' => 'nullable|exists:member_groups,id',
        ];
    }
}