<?php

namespace App\Http\Controllers;

use App\DmHhDvK;
use App\Model\system\dmdvt;
use App\NhomHhDvK;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DmHhDvKController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giahhdvk';
            $modelnhom = NhomHhDvK::where('matt',$inputs['matt'])->first();
            $model = DmHhDvK::where('matt',$inputs['matt'])->get();
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            if($modelnhom->theodoi == 'KTD'){
                return view('errors.duplicate')
                    ->with('message', 'Nhóm danh mục hàng hóa dịch vụ đang tạm ngưng theo dõi.')
                    ->with('url', '/giahhdvk/danhmuc');
            }
            return view('manage.dinhgia.giahhdvk.danhmuc.chitiet.index')
                ->with('model',$model)
                ->with('a_dvt',$a_dvt)
                ->with('inputs',$inputs)
                ->with('modelnhom',$modelnhom)
                ->with('pageTitle','Thông tin chi tiết hàng hóa dịch vụ');

        }else
            return view('errors.notlogin');

    }

    public function store(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            //dd($inputs);
            $chk_dvt = dmdvt::where('dvt', $inputs['dvt'])->first();
            if ($chk_dvt == null) {
                dmdvt::insert(['dvt' => $inputs['dvt']]);
            }
            $inputs['mahhdv'] = chuanhoatruong($inputs['mahhdv']);
            //dd($inputs);
            $check = DmHhDvK::where('mahhdv', $inputs['mahhdv'])->first();
            if ($inputs['trangthai'] == 'ADD') {
                if ($check == null) {
                    $model = new DmHhDvK();
                    $model->create($inputs);
                } else {
                    return view('errors.duplicate')
                        ->with('message', 'Mã số này đã được sử dụng.')
                        ->with('url', '/giahhdvk/danhmuc/detail?matt=' . $inputs['matt']);
                }
            } else {
                $check->update($inputs);
            }

            return redirect('/giahhdvk/danhmuc/detail?matt=' . $inputs['matt']);
        } else
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
        $model = DmHhDvK::where('mahhdv',$inputs['mahhdv'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            //dd($inputs);
            $model = DmHhDvK::where('mahhdv',$inputs['mahhdv'])->first();
            $model->delete();
            return redirect('/giahhdvk/danhmuc/detail?matt='.$model->matt);
        }else
            return view('errors.notlogin');
    }
}
