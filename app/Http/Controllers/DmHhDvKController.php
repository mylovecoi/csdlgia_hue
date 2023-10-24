<?php

namespace App\Http\Controllers;

use App\DmHhDvK;
use App\DmNhomHangHoa;
use App\Model\system\dmdvt;
use App\NhomHhDvK;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class DmHhDvKController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giahhdvk';
            $modelnhom = NhomHhDvK::where('matt',$inputs['matt'])->first();
            $model = DmHhDvK::where('matt',$inputs['matt'])->orderby('mahhdv')->get();
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            $a_dm = array_column(DmNhomHangHoa::where('phanloai','GIAHHDVK')->get()->toArray(),'tennhom','manhom');

            if($modelnhom->theodoi == 'KTD'){
                return view('errors.duplicate')
                    ->with('message', 'Nhóm danh mục hàng hóa dịch vụ đang tạm ngưng theo dõi.')
                    ->with('url', '/giahhdvk/danhmuc');
            }
            $a_nhomhh = [''=>'-- Chọn nhóm hàng hóa, dịch vụ --'];
            foreach ($a_dm as $key=>$val) {
                $a_nhomhh[$key] = $val;
            }
            return view('manage.dinhgia.giahhdvk.danhmuc.chitiet.index')
                ->with('model',$model)
                ->with('a_dvt',$a_dvt)
                ->with('a_nhomhh',$a_nhomhh)
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
            $model = DmHhDvK::where('id',$inputs['mahhdv'])->first();
            //dd($model);
            $model->delete();
            return redirect('/giahhdvk/danhmuc/detail?matt='.$model->matt);
        }else
            return view('errors.notlogin');
    }

    public function nhanexcel(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giahhdvk/danhmuc/detail';
            return view('manage.dinhgia.giahhdvk.danhmuc.chitiet.importexcel')
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Nhận dữ liệu từ file Excel');
        } else
            return view('errors.notlogin');
    }

    public function create_excel(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giahhdvk/danhmuc/detail';
            $modelnhom = NhomHhDvK::where('matt',$inputs['matt'])->first();
            $filename = $inputs['matt'] . '_' . getdate()[0];
            $request->file('fexcel')->move(public_path() . '/data/uploads/excels/', $filename . '.xls');
            $path = public_path() . '/data/uploads/excels/' . $filename . '.xls';
            $data = [];

            Excel::load($path, function ($reader) use (&$data, $inputs) {
                $obj = $reader->getExcel();
                $sheet = $obj->getSheet(0);
                $data = $sheet->toArray(null, true, true, true); // giữ lại tiêu đề A=>'val';
            });
            //dd($data);

            $a_dm = array();

            for ($i = $inputs['tudong']; $i <= $inputs['dendong']; $i++) {
                if (
                    !isset($data[$i][$inputs['mahhdv']]) || !isset($data[$i][$inputs['tenhhdv']]) ||
                    !isset($data[$i][$inputs['dacdiemkt']]) || !isset($data[$i][$inputs['dvt']])
                ) {
                    continue;
                }
                $a_dm[] = array(
                    'matt' => $inputs['matt'],
                    'manhom' => $data[$i][$inputs['manhom']] ?? '',
                    'mahhdv' => $data[$i][$inputs['mahhdv']] ?? '',
                    'tenhhdv' => $data[$i][$inputs['tenhhdv']] ?? '',
                    'dacdiemkt' => $data[$i][$inputs['dacdiemkt']] ?? '',
                    'dvt' => $data[$i][$inputs['dvt']] ?? '',
                    'theodoi' => 'TD',
                );
            }
            DmHhDvK::insert($a_dm);
            File::Delete($path);

            // $model = DmHhDvK::where('matt', $inputs['matt'])->orderby('mahhdv')->get();

            return redirect('/giahhdvk/danhmuc/detail?matt=' . $inputs['matt']);

            // return view('manage.dinhgia.giahhdvk.danhmuc.chitiet.index')
            //     ->with('model',$model)
            //     ->with('inputs',$inputs)
            //     ->with('modelnhom',$modelnhom)
            //     ->with('pageTitle', 'Thông tin chi tiết hàng hóa dịch vụ');
        } else
            return view('errors.notlogin');
    }
}
