<?php

namespace App\Http\Controllers\manage\giadvkcb;

use App\Model\manage\dinhgia\giadvkcb\dvkcbdm;
use App\Model\manage\dinhgia\giaspdvci\trogiatrocuocdm;
use App\Model\manage\dinhgia\thuetn\DmThueTn;
use App\Model\system\dmdvt;
use App\NhomDvKcb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class dvkcbdmController extends Controller
{
    public function index(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = dvkcbdm::where('manhom',$inputs['manhom'])->get();
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            $inputs['url'] = '/giadvkcb';
            //dd($inputs);
            $nhom = NhomDvKcb::where('manhom',$inputs['manhom'])->first();
            return view('manage.dinhgia.giadvkcb.danhmuc.index')
                ->with('model',$model)
                ->with('a_dvt',$a_dvt)
                ->with('nhom',$nhom)
                ->with('inputs',$inputs)
                ->with('pageTitle','Danh mục dịch vụ khám chữa bệnh');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            //dd($inputs);
            if(isset($inputs['dvt'])){
                $chk_dvt = dmdvt::where('dvt', $inputs['dvt'])->get();
                if (count($chk_dvt) == 0) {
                    dmdvt::insert(['dvt' => $inputs['dvt']]);
                }
            }

            $check = dvkcbdm::where('maspdv',$inputs['maspdv'])->first();
            if ($check == null) {
                $inputs['maspdv'] = getdate()[0];
                dvkcbdm::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/giadvkcb/danhmuc/detail?manhom='.$inputs['manhom']);
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
        $model = dvkcbdm::where('maspdv',$inputs['maspdv'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $model = dvkcbdm::where('maspdv',$inputs['maspdv'])->first();
            $model->delete();
            return redirect('giadvkcb/danhmuc/detail?manhom='.$model->manhom);
        }else
            return view('errors.notlogin');
    }

    public function importexcel(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            //dd($inputs);
            $filename = getdate()[0];
            $request->file('fexcel')->move(public_path() . '/data/uploads/excels/', $filename . '.xls');
            $path = public_path() . '/data/uploads/excels/' . $filename . '.xls';
            $data = [];
            Excel::load($path, function ($reader) use (&$data, $inputs) {
                $obj = $reader->getExcel();
                $sheet = $obj->getSheet(0);
                $data = $sheet->toArray(null, true, true, true);// giữ lại tiêu đề A=>'val';
            });
            $a_dm = [];
            $maso = getdate()[0];
            //dd($data);
            //dd($inputs);
            for ($i = $inputs['tudong']; $i <= $inputs['dendong']; $i++) {
                if(!isset($data[$i][$inputs['imex_tenspdv']]) || $data[$i][$inputs['imex_tenspdv']] == ''){
                    continue;
                }
                $a_dm[] = [
                    'manhom' => $inputs['manhom'],
                    'maspdv' => $maso++,
                    'madichvu' => $data[$i][$inputs['imex_madichvu']],
                    'tenspdv' => $data[$i][$inputs['imex_tenspdv']],
                    'dvt' => $data[$i][$inputs['imex_dvt']],
                    'phanloai' => $data[$i][$inputs['imex_phanloai']],
                    'hientrang' => 'TD',
                ];
            }
            //dd($a_dm);
            File::Delete($path);
            foreach (array_chunk($a_dm, 100) as $dm){
                dvkcbdm::insert($dm);
            }
            return redirect('giadvkcb/danhmuc/detail?manhom='.$inputs['manhom']);
        }else
            return view('errors.notlogin');
    }
}
