<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Author;
use App\Models\Works;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller {

    protected $menu = null;
    public function __construct(){
//        parent::__construct();
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        //作者列表
        $author = Author::where('status',1)
            ->orderBy('abc')
            ->get(['id','name','abc','picture'])
            ->toArray();

        //字母序列
        $abc = Author::where('status',1)
            ->where('abc','<>','')
            ->orderBy('abc')
            ->groupBy('abc')
            ->get(['id','name','abc','picture'])
            ->toArray();

        $works = DB::table('works as w')
            ->join('works_images as wi','wi.wid','=','w.id')
            ->join('authors as a','a.id','=','w.author')
            ->groupBy('w.id')
            ->get(['w.id as id','w.title','w.description','wi.image','a.name']);

//        dd($works);


        return View('index',compact('author','abc','works'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function works()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function author($id = 0)
	{
		if($id != 0){
            //取作者信息
            $author = Author::find($id)->toArray();
            //取作者作品
            $works = DB::table('works as w')
                ->join('works_images as wi','wi.wid','=','w.id')
                ->join('authors as a','a.id','=','w.author')
                ->where('w.author',$id)
                ->groupBy('w.id')
                ->get(['w.id as id','w.title','w.description','wi.image','a.name']);
            //取作者相关文章
        }else{
            //作者列表
            $author = Author::where('status',1)
                ->orderBy('abc')
                ->get(['id','name','abc','picture'])
                ->toArray();
            //推荐作品
            $works = DB::table('works as w')
                ->join('works_images as wi','wi.wid','=','w.id')
                ->join('authors as a','a.id','=','w.author')
                ->where('w.recommend',1)
                ->groupBy('w.id')
                ->get(['w.id as id','w.title','w.description','wi.image','a.name']);
        }

        dd($works);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
