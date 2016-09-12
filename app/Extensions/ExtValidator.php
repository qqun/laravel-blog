<?php namespace App\Extensions;

use Illuminate\Validation\Validator as Validator;
use DB;

/**
 * ExtValidantor
 * 扩展自定义验证
 */
class ExtValidator extends Validator
{

	/*只允许英文字母组合A-Za-z*/
    public function validateEngAlpha($attribute, $value)
    {
        return preg_match('/^[A-Za-z]+$/', $value);
    }

    /*只允许英文字母与阿拉伯数字组合A-Za-z0-9*/
    public function validateEngAlphaNum($attribute, $value)
    {
        return preg_match('/^[A-Za-z0-9]+$/', $value);
    }


	/* 字段是否存在 */
	public function validateFieldsExists($attribute, $value){

        $fields = DB::select('select  column_name  from Information_schema.columns  where table_Name = "'.$value.'"');
		return true;
	}


	/* 验证手机是否合法，使用正则进行判断 */
	public function validateMobilePhone($attribute, $value){
		/*
        匹配中国国内手机号正则
        modified by raoyc
        /^13[0-9]{9}|14[57]{1}[0-9]{8}|15[012356789]{1}[0-9]{8}|170[059]{1}[0-9]{8}|18[0-9]{9}|177[0-9]{8}$/

        此正则验证以下手机电话号码段，如后续有扩展请自行增删改
        更新时间：2015-01-07
        http://zh.wikipedia.org/wiki/%E4%B8%AD%E5%8D%8E%E4%BA%BA%E6%B0%91%E5%85%B1%E5%92%8C%E5%9B%BD%E5%A2%83%E5%86%85%E5%9C%B0%E5%8C%BA%E7%A7%BB%E5%8A%A8%E7%BB%88%E7%AB%AF%E9%80%9A%E8%AE%AF%E5%8F%B7%E7%A0%81
        移动： 134[0-8] 135 136 137 138 139 147 150 151 152 157 158 159 182 183 184 187 188
        联通： 130 131 132 145 155 156 185 186
        电信： 133 134[9] 153 177 180 181 189
        虚拟运营商： 1700 1705 1709

        13[0-9]{9}
        14[57]{1}[0-9]{8}
        15[012356789]{1}[0-9]{8}
        170[059]{1}[0-9]{8}
        177[0-9]{8}
        18[0-9]{9}
        */
        return preg_match('/^13[0-9]{9}|14[57]{1}[0-9]{8}|15[012356789]{1}[0-9]{8}|170[059]{1}[0-9]{8}|18[0-9]{9}|177[0-9]{8}$/', $value);
	}
}


