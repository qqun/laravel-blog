<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Repositories\UserRepository;
use Cache;
use Illuminate\Http\Request;

class ExcelController extends BaseController
{

    private $user;

    public function __construct(UserRepository $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $program = [
            's_name' => $request->input('s_name'),
            's_phone' => $request->input('s_phone'),
        ];
        $data = [];

        return View('admin.excel.index', compact('data'));
    }


}
