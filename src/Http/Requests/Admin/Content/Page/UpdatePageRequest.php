<?php


namespace rohsyl\OmegaCore\Http\Requests\Admin\Content\Page;


use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
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
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'show_title' => 'required|boolean',
            'show_subtitle' => 'required|boolean',
            'slug' => 'required|string',
            'parent_id' => 'nullable|exists:pages,id',
            'model' => 'nullable|string',
            'menu_id' => 'nullable|exists:menus,id',
            'keyword' => 'nullable|string',
            'components_order.*' => 'nullable|numeric',
        ];
    }
}