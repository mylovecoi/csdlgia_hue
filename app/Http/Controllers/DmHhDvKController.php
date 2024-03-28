<?php

namespace App\Http\Controllers;

use App\DmHhDvK;
use App\DmNhomHangHoa;
use App\Model\system\dmdvt;
use App\NhomHhDvK;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\ColectionImport;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class DmHhDvKController extends Controller
{
    public function index(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giahhdvk';
            $modelnhom = NhomHhDvK::where('matt', $inputs['matt'])->first();
            $model = DmHhDvK::where('matt', $inputs['matt'])->orderby('mahhdv')->get();
            $a_dvt = array_column(dmdvt::all()->toArray(), 'dvt', 'madvt');
            $a_dm = array_column(DmNhomHangHoa::where('phanloai', 'GIAHHDVK')->get()->toArray(), 'tennhom', 'manhom');

            if ($modelnhom->theodoi == 'KTD') {
                return view('errors.duplicate')
                    ->with('message', 'Nhóm danh mục hàng hóa dịch vụ đang tạm ngưng theo dõi.')
                    ->with('url', '/giahhdvk/danhmuc');
            }
            $a_nhomhh = ['' => '-- Chọn nhóm hàng hóa, dịch vụ --'];
            foreach ($a_dm as $key => $val) {
                $a_nhomhh[$key] = $val;
            }
            return view('manage.dinhgia.giahhdvk.danhmuc.chitiet.index')
                ->with('model', $model)
                ->with('a_dvt', $a_dvt)
                ->with('a_nhomhh', $a_nhomhh)
                ->with('inputs', $inputs)
                ->with('modelnhom', $modelnhom)
                ->with('pageTitle', 'Thông tin chi tiết hàng hóa dịch vụ');
        } else
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

    public function edit(Request $request)
    {
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = DmHhDvK::where('mahhdv', $inputs['mahhdv'])->first();
        die($model);
    }

    public function destroy(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            //dd($inputs);
            $model = DmHhDvK::where('id', $inputs['mahhdv'])->first();
            //dd($model);
            $model->delete();
            return redirect('/giahhdvk/danhmuc/detail?matt=' . $model->matt);
        } else
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

            $inputs["mahhdv"] = ord(strtoupper($inputs["mahhdv"])) - 65;
            $inputs["tenhhdv"] = ord(strtoupper($inputs["tenhhdv"])) - 65;
            $inputs["dacdiemkt"] = ord(strtoupper($inputs["dacdiemkt"])) - 65;
            $inputs["dvt"] = ord(strtoupper($inputs["dvt"])) - 65;

            $file = $request->file('fexcel');

            $dataObj = new ColectionImport();
            $theArray = Excel::toArray($dataObj, $file);
            $data = $theArray[0]; //Mặc định lấy Sheet 1            
            //Gán lại dòng
            $inputs['dendong'] = $inputs['dendong'] < count($data) ? count($data) : $inputs['dendong'];
            $a_dm = array();
            $dmdvt = array_column(dmdvt::all()->toArray(),'madvt','dvt');
           
            for ($i = $inputs['tudong'] - 1; $i <= ($inputs['dendong']); $i++) {
                //dd($data[$i]);
                if (!isset($data[$i][$inputs['mahhdv']])) {
                    continue; //Mã hàng hoá rỗng => thoát
                }
                
                $a_dm[] = array(
                    'matt' => $inputs['matt'],
                    'mahhdv' => $data[$i][$inputs['mahhdv']] ?? '',
                    'tenhhdv' => $data[$i][$inputs['tenhhdv']] ?? '',
                    'dacdiemkt' => $data[$i][$inputs['dacdiemkt']] ?? '',
                    'dvt' =>$dmdvt[$data[$i][$inputs['dvt']] ?? ''] ?? '',
                    'theodoi' => 'TD',
                );
            }
            ///dd($a_dm);
            DmHhDvK::insert($a_dm);
            return redirect('/giahhdvk/danhmuc/detail?matt=' . $inputs['matt']);
        } else
            return view('errors.notlogin');
    }
}
