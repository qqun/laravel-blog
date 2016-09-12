<?php

namespace App\Http\Requests;

class NavigationRequest extends Request
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
            'title.required' => '导航名称必须填写',
            'title.max' => '导航名称长度不要超出15',
            'title.min' => '导航名称长度不得少于1',

            'alias.eng_alpha' => '分类别名只能为英文字母组合',


        ];
    }
}
