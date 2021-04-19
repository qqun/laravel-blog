<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Config;
use DB;
use Illuminate\Http\Request;
use Input;
use Validator;

/**
 * Class UploadController
 * @package App\Http\Controllers\Admin
 */
class UploadController extends Controller
{

    private $file_type = '';
    private $thumb_type = '';
    private $file_size = 0;
    private $thumb_size = 0;

    public function __construct()
    {
        $this->file_type = [".rar", ".zip", ".pdf", ".tar", ".gz", ".7z"];
        $this->thumb_type = [".png", ".jpg", ".jpeg", ".gif", ".bmp"];

        $this->file_size = 51200000;
        $this->thumb_size = 2048000;
    }


    /**
     * 创建上传文件窗口
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUpload()
    {
        $fileType = '';

        $type = trim(Input::get('from')) != '' ? trim(Input::get('from')) : 'thumb';
        $name = trim(Input::get('name')) != '' ? trim(Input::get('name')) : 'thumb';
        switch ($type) {

            case 'file':
                $fileType = $this->file_type;
                break;
            case 'thumb':
                $fileType = $this->thumb_type;
                break;
            default :
                $fileType = array_merge($this->thumb_type, $this->file_type);
        }
        
        $fileType = implode(',', $fileType);

        return View('admin.upload.upload', compact('fileType', 'type', 'name'));
    }


    /**
     * 接受文件上传表单
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpload(Request $request)
    {

        if ($request->ajax()) {

            $json = [
                'status' => 0,
                'info' => '失败原因为：<span class="text_error">不存在待上传的文件</span>',
                'operation' => '上传文件',
                'url' => '',
            ];

            //判断上传文件
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                //TODO：：扩展名转小写

                $data = $request->all();
                switch ($data['type']) {
                    case 'file':
                        $file_type = $this->file_type;
                        $file_size = $this->file_size;
                        $rules['file'] = 'required|max:' . $file_size;
                        break;
                    case 'thumb':
                        $file_type = $this->thumb_type;
                        $file_size = $this->thumb_size;
                        $rules['file'] = 'required|image|max:' . $file_size;
                        break;
                    //文件和图片
                    default :
                        $file_type = array_merge($this->thumb_type, $this->file_type);
                        $file_size = $this->file_size;
                        $rules['file'] = 'required|max:' . $file_size;
                        break;
                }

                $realPath = $file->getRealPath();

                $validator = Validator::make($data, $rules);

                if ($validator->passes()) {

                    $fileSize = $file->getSize();
                    $destPath = 'uploads/content/';
                    $savePath = $destPath . '' . date('Ymd', time());

                    $ext = $file->getClientOriginalExtension();
                    $ext = strtolower($ext);
                    $check_ext = in_array(".$ext", $file_type, true);
                    //使用与Ueditor 图片上传相同的 文件格式校验

                    if ($fileSize > $file_size) {
                        $json = array_replace($json, [
                            'status' => 0,
                            'info' => '失败原因为：<span class="text_error">文件大小超出限制</span>'
                        ]);
                    } else if ($check_ext) {

                        $uniqid = uniqid() . '_' . date('s');
                        $oFile = $uniqid . 'o.' . $ext;

                        if ($file->isValid()) {

//					$fullfilename = url('').'/'.$savePath.'/'.$oFile;  //原始完整路径
                            $fullfilename = '/' . $savePath . '/' . $oFile;  //原始完整路径

                            $uploadSuccess = $file->move($savePath, $oFile);

                            $json = array_replace($json, [
                                'status' => 1,
                                'info' => $uploadSuccess,
                                'url' => $fullfilename
                            ]);
                        } else {
                            $json = array_replace($json, [
                                'status' => 0,
                                'info' => '失败原因为：<span class="text_error">文件校验失败</span>'
                            ]);
                        }
                    } else {
                        $json = array_replace($json, [
                            'status' => 0,
                            'info' => '失败原因为：<span class="text_error">文件类型不允许,请上传规定的文件</span>'
                        ]);
                    }
                } else {
//					$json = format_json_message($validator->messages(), $json);
                    $json = array_replace($json, [
                        'status' => 0,
                        'info' => '失败原因为：<span class="text_error">出现致命错误,请联系管理员</span>'
                    ]);
                }
            }
            return response()->json($json);

        } else {
            exitJson(0, 'Error');
        }
    }

}
