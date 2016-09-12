<?php namespace App\Interfaces;


/**
 * REST 相关资源接口函数
 * Interface IRepository
 * @package App\Interfaces
 */
interface IRepository
{

    /**
     * 资源列表
     * @param array $data 必须，模型相关数据
     * @param string|array $extra 可选，额外参数
     * @param string $size 分页大小（有默认值）
     * @return Illuminate\Support\Collection
     */
    public function index($data, $extra, $size);


    /**
     * 存储资源
     *
     * @param  array $inputs 必须传入与存储模型相关的数据
     * @param  string|array $extra 可选额外传入的参数
     * @return Illuminate\Database\Eloquent\Model
     */
    public function store($inputs, $extra);

    /**
     * 编辑特定id资源
     *
     * @param  int $id 资源id
     * @param  string|array $extra 可选额外传入的参数
     * @return Illuminate\Support\Collection
     */
    public function edit($id, $extra);

    /**
     * 更新特定id资源
     *
     * @param  int $id 资源id
     * @param  array $inputs 必须传入与更新模型相关的数据
     * @param  string|array $extra 可选额外传入的参数
     * @return void
     */
    public function update($id, $inputs, $extra);

    /**
     * 删除特定id资源
     *
     * @param  int $id 资源id
     * @param  string|array $extra 可选额外传入的参数
     * @return void
     */
    public function destroy($id, $extra);
}