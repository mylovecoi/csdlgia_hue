<?php

namespace App\Http\Controllers\manage\giadvgddt;

use App\Model\manage\dinhgia\GiaDvGdDtCt;
use App\Model\manage\dinhgia\giadvgddtdm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class giadvgddtdmController extends Controller
{
    public function index(){
        if(Session::has('admin')){
            $model = giadvgddtdm::all();
            $inputs['url'] = '/giadvgddt';
            return view('manage.dinhgia.giadvgddt.danhmuc.index')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('pageTitle','Danh mục dịch vụ giáo dục, đào tạo');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            //dd($inputs);
            $check = giadvgddtdm::where('maspdv',$inputs['maspdv'])->first();
            if ($check == null) {
                $inputs['maspdv'] = getdate()[0];
                giadvgddtdm::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/giadvgddt/danhmuc');
        }else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = giadvgddtdm::where('maspdv',$inputs['maspdv'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $chk = GiaDvGdDtCt::where('maspdv',$inputs['maspdv'])->first();
            if($chk == null){
                giadvgddtdm::where('maspdv',$inputs['maspdv'])->first()->delete();
                return redirect('giadvgddt/danhmuc');
            }else{
                return view('errors.duplicate')
                    ->with('message','Mã số này đã được sử dụng trong hồ sơ giá.')
                    ->with('url','/giadvgddt/danhmuc');
            }

        }else
            return view('errors.notlogin');
    }
}
