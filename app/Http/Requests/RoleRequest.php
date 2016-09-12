<?php namespace App\Http\Requests;

class RoleRequest extends Request
{


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
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
            'name' => 'required|min:3|max:15|eng_alpha|unique:roles,name' . $id,
            'display_name' => 'required|min:3|max:15',
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
            'name.required' => '角色标识必须填写',
            'name.max' => '角色标识长度不要超出15',
            'name.min' => '角色标识长度不得少于3',
            'name.eng_alpha' => '角色标识只能为英文字母组合',
            'name.unique' => '系统已存在该角色标识',


            'display_name.required' => '显示名称必须填写',
            'display_name.max' => '显示名称长度不要超出15',
            'display_name.min' => '显示名称长度不得少于3',
        ];
    }
}