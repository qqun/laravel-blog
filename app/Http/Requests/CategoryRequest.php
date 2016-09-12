<?php

namespace App\Http\Requests;

class CategoryRequest extends Request
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
     * 自定义验证规则rules
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(3) ? ',' . $this->segment(3) : '';
        $rules = [
            'title' => 'required|min:1|max:15',
            'alias' => 'min:1|max:15|eng_alpha',
        ];
        return $rules;
    }

    /**
     * 自定义验证信息
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => '分类名称必须填写',
            'title.max' => '分类名称长度不要超出15',
            'title.min' => '分类名称长度不得少于1',

            'alias.max' => '分类别名长度不要超出15',
            'alias.min' => '分类别名长度不得少于1',
            'alias.eng_alpha' => '分类别名只能为英文字母组合',


        ];
    }
}
