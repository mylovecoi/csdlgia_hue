<?php

namespace App\Http\Controllers\manage\thuetn;

use App\Model\manage\dinhgia\thuetn\DmThueTn;
use App\Model\manage\dinhgia\thuetn\NhomThueTn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\ColectionImport;
use App\Model\system\dmdvt;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class DmThueTnController extends Controller
{
    public function index(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = DmThueTn::where('manhom', $inputs['manhom'])->get();
            $nhom = NhomThueTn::where('manhom', $inputs['manhom'])->first();
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','madvt');
            $inputs['url'] = '/giathuetn';
            return view('manage.dinhgia.thuetn.danhmuc.chitiet.index')
                ->with('model', $model)
                ->with('a_dvt', $a_dvt)
                ->with('nhom', $nhom)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Thông tin chi tiết mặt hàng thuế tài nguyên');
        } else
            return view('errors.notlogin');
    }

    public function store(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = DmThueTn::where('id', $inputs['id'])->first();
            //            dd($inputs);
            if ($model == null) {
                unset($inputs['id']);
                $inputs['theodoi'] = 'TD';
                DmThueTn::create($inputs);
            } else
                $model->update($inputs);

            return redirect('giathuetn/danhmuc/detail?manhom=' . $inputs['manhom']);
        } else
            return view('errors.notlogin');
    }

    public function theodoi(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            DmThueTn::where('manhom', $inputs['manhom'])->update(['theodoi' => $inputs['theodoi']]);
            return redirect('giathuetn/danhmuc/detail?manhom=' . $inputs['manhom']);
        } else
            return view('errors.notlogin');
    }

    public function show(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $id = $inputs['id'];
        $model = DmThueTn::findOrFail($id);
        $model->date = getDayVn($model->ngayapdung);
        die($model);
    }

    public function update(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $id = $inputs['edit_id'];
            $inputs['ten'] = $inputs['edit_ten'];
            $inputs['dvt'] = $inputs['edit_dvt'];
            $inputs['cap1'] = $inputs['edit_cap1'];
            $inputs['cap2'] = $inputs['edit_cap2'];
            $inputs['cap3'] = $inputs['edit_cap3'];
            $inputs['cap4'] = $inputs['edit_cap4'];
            $inputs['cap5'] = $inputs['edit_cap5'];
            $inputs['level'] = $inputs['edit_level'];
            $inputs['theodoi'] = $inputs['edit_theodoi'];
            $model = DmThueTn::findOrFail($id);
            $model->update($inputs);
            return redirect('giathuetn/danhmuc/detail?manhom=' . $model->manhom);
        } else
            return view('errors.notlogin');
    }

    public function destroy(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $id = $inputs['iddelete'];
            $model = DmThueTn::findOrFail($id);
            $manhom = $model->manhom;
            $model->delete();
            return redirect('giathuetn/danhmuc/detail?manhom=' . $manhom);
        } else
            return view('errors.notlogin');
    }

    public function importexcel(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();

            //Do mã char('A') = 65
            //Chuyển mã A,B,C về 0,1,2,3,...

            $inputs["imex_sapxep"] = ord(strtoupper($inputs["imex_sapxep"])) - 65;
            $inputs["imex_level"] = ord(strtoupper($inputs["imex_level"])) - 65;
            $inputs["imex_cap1"] = ord(strtoupper($inputs["imex_cap1"])) - 65;
            $inputs["imex_cap2"] = ord(strtoupper($inputs["imex_cap2"])) - 65;
            $inputs["imex_cap3"] = ord(strtoupper($inputs["imex_cap3"])) - 65;
            $inputs["imex_cap4"] = ord(strtoupper($inputs["imex_cap4"])) - 65;
            $inputs["imex_cap5"] = ord(strtoupper($inputs["imex_cap5"])) - 65;
            $inputs["imex_cap6"] = ord(strtoupper($inputs["imex_cap6"])) - 65;
            $inputs["imex_maso"] = ord(strtoupper($inputs["imex_maso"])) - 65;
            $inputs["imex_maso_goc"] = ord(strtoupper($inputs["imex_maso_goc"])) - 65;
            $inputs["imex_ten"] = ord(strtoupper($inputs["imex_ten"])) - 65;
            $inputs["imex_dvt"] = ord(strtoupper($inputs["imex_dvt"])) - 65;

            $file = $request->file('fexcel');
            $dataObj = new ColectionImport();
            $theArray = Excel::toArray($dataObj, $file);
            $data = $theArray[0]; //Mặc định lấy Sheet 1  

            // $filename = getdate()[0];
            // $request->file('fexcel')->move(public_path() . '/data/uploads/excels/', $filename . '.xls');
            // $path = public_path() . '/data/uploads/excels/' . $filename . '.xls';
            // $data = [];
            // Excel::load($path, function ($reader) use (&$data, $inputs) {
            //     $obj = $reader->getExcel();
            //     $sheet = $obj->getSheet(0);
            //     $data = $sheet->toArray(null, true, true, true);// giữ lại tiêu đề A=>'val';
            // });

            $a_dvt = [];
            foreach (dmdvt::all() as $dvt) {
                $ten = strtolower($dvt->dvt);
                $a_dvt[$ten] = $dvt->madvt;
            }
            //dd($a_dvt['tấn']);
            $a_dm = [];
            $inputs['dendong'] = $inputs['dendong'] < count($data) ? count($data) - 1 : $inputs['dendong'];
            $inputs['tudong'] = $inputs['tudong'] - 1; //Do mảng bắt đầu từ 0
            //dd($inputs);
            for ($i = $inputs['tudong']; $i <= $inputs['dendong']; $i++) {
                $dvt = $a_dvt[strtolower($data[$i][$inputs['imex_dvt']])] ?? $data[$i][$inputs['imex_dvt']];
                $a_dm[] = [
                    'sapxep' => $data[$i][$inputs['imex_sapxep']],
                    'level'  => $data[$i][$inputs['imex_level']],
                    'cap1'  => $data[$i][$inputs['imex_cap1']],
                    'cap2' => $data[$i][$inputs['imex_cap2']],
                    'cap3' => $data[$i][$inputs['imex_cap3']],
                    'cap4' => $data[$i][$inputs['imex_cap4']],
                    'cap5' => $data[$i][$inputs['imex_cap5']],
                    'cap6' => $data[$i][$inputs['imex_cap6']],
                    'maso' => $data[$i][$inputs['imex_maso']],
                    'maso_goc' => $data[$i][$inputs['imex_maso_goc']],
                    'ten' => $data[$i][$inputs['imex_ten']],
                    'dvt' => $dvt,
                    'theodoi' => 'TD',
                    'manhom' => $inputs['imex_manhom'],
                ];
            }
            foreach (array_chunk($a_dm, 100) as $data) {
                DmThueTn::insert($data);
            }
           
            return redirect('giathuetn/danhmuc/detail?manhom=' . $inputs['imex_manhom']);
        } else
            return view('errors.notlogin');
    }
}
