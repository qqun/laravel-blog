<?php

namespace App\Http\Requests;

class LinksRequest extends Request
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
            'name' => 'required|min:1|max:15',
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
            'name.required' => '链接名称必须填写',
            'name.max' => '链接名称长度不要超出15',
            'name.min' => '链接名称长度不得少于1',

            'alias.eng_alpha' => '分类别名只能为英文字母组合',


        ];
    }
}
