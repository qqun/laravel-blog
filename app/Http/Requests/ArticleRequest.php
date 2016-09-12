<?php namespace App\Http\Requests;

class ArticleRequest extends Request
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
//        $id = $this->segment(3) ? ',' . $this->segment(3) : '';
        return [
            'title' => 'required|min:2|max:50',
            'cat_id'=>'required|min:1',    //设置不能为0
            'content' => 'required|min:5',
        ];
    }


    public function messages()
    {
        return [
            'title.required' => '文章名称不能为空',
            'title.min' => '文章名称不能少于2',
            'title.max' => '文章名称不能大于50',

            'cat_id.required' => '分类为必选',

            'content.required' => '内容不能为空',
            'content.min' => '内容不能少于5',
        ];
    }

}
