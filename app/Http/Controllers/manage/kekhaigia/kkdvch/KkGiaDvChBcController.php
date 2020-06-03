<?php

namespace App\Http\Controllers\manage\kekhaigia\kkdvch;

use App\Model\manage\kekhaigia\kkdvch\KkGiaDvCh;
use App\Model\manage\kekhaigia\kkdvch\KkGiaDvChCt;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use App\Model\system\dsdiaban;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class KkGiaDvChBcController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $modeldmnghe = DmNgheKd::where('manghe','CAHUE')
                ->first();
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            return view('manage.kkgia.dvch.reports.index')
                ->with('a_diaban', array_column($m_diaban->wherein('level', ['H','T','X'])->toarray(), 'tendiaban', 'madiaban'))
                ->with('pageTitle', 'Báo cáo tổng hợp kê khai giá dịch vụ ca huế');
        }else
            return view('errors.notlogin');
    }

    public function bc1(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model =  KkGiaDvCh::join('company','company.madv','=','kkgiadvch.madv')
                ->where('kkgiadvch.trangthai','DD')
                ->select('kkgiadvch.*','company.tendn');
            if($inputs['phanloai'] == 'ngaychuyen'){
                if($inputs['time'] == 'ngay')
                    $model = $model->whereBetween('ngaychuyen',[getDateToDb($inputs['tungay']), getDateToDb($inputs['denngay'])]);
                elseif($inputs['time'] == 'thang')
                    $model = $model->whereMonth('ngaychuyen',$inputs['thang'])
                        ->whereYear('ngaychuyen',$inputs['nam']);
                else{
                    if ($inputs['quy'] == 1) {
                        $ngaytu = $inputs['nam'] . '-01-01';
                        $ngayden = $inputs['nam'] . '-03-31';
                    } elseif ($inputs['quy'] == 2) {
                        $ngaytu = $inputs['nam'] . '-04-01';
                        $ngayden = $inputs['nam'] . '-06-30';
                    } elseif ($inputs['quy'] == 3) {
                        $ngaytu = $inputs['nam'] . '-07-01';
                        $ngayden = $inputs['nam'] . '-09-31';
                    } else {
                        $ngaytu = $inputs['nam'] . '-10-01';
                        $ngayden = $inputs['nam'] . '-12-31';
                    }
                    $model = $model->whereBetween('ngaychuyen', [$ngaytu, $ngayden]);
                }
            }else{
                if($inputs['time'] == 'ngay')
                    $model = $model->whereBetween('ngaynhan',[getDateToDb($inputs['tungay']), getDateToDb($inputs['denngay'])]);
                elseif($inputs['time'] == 'thang')
                    $model = $model->whereMonth('ngaynhan',$inputs['thang'])
                        ->whereYear('ngaynhan',$inputs['nam']);
                else{
                    if ($inputs['quy'] == 1) {
                        $ngaytu = $inputs['nam'] . '-01-01';
                        $ngayden = $inputs['nam'] . '-03-31';
                    } elseif ($inputs['quy'] == 2) {
                        $ngaytu = $inputs['nam'] . '-04-01';
                        $ngayden = $inputs['nam'] . '-06-30';
                    } elseif ($inputs['quy'] == 3) {
                        $ngaytu = $inputs['nam'] . '-07-01';
                        $ngayden = $inputs['nam'] . '-09-31';
                    } else {
                        $ngaytu = $inputs['nam'] . '-10-01';
                        $ngayden = $inputs['nam'] . '-12-31';
                    }
                    $model = $model->whereBetween('ngaynhan', [$ngaytu, $ngayden]);
                }
            }
            $model = $model->get();

            return view('manage.kkgia.dvch.reports.bc1')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('pageTitle', 'Báo cáo tổng hợp kê khai giá dịch vụ ca huế');
        }else
            return view('errors.notlogin');
    }

    public function bc2(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model =  KkGiaDvCh::join('company','company.madv','=','kkgiadvch.madv')
                ->where('kkgiadvch.trangthai','DD')
                ->select('kkgiadvch.*','company.tendn');
            if($inputs['phanloai'] == 'ngaychuyen'){
                if($inputs['time'] == 'ngay')
                    $model = $model->whereBetween('ngaychuyen',[getDateToDb($inputs['tungay']), getDateToDb($inputs['denngay'])]);
                elseif($inputs['time'] == 'thang')
                    $model = $model->whereMonth('ngaychuyen',$inputs['thang'])
                        ->whereYear('ngaychuyen',$inputs['nam']);
                else{
                    if ($inputs['quy'] == 1) {
                        $ngaytu = $inputs['nam'] . '-01-01';
                        $ngayden = $inputs['nam'] . '-03-31';
                    } elseif ($inputs['quy'] == 2) {
                        $ngaytu = $inputs['nam'] . '-04-01';
                        $ngayden = $inputs['nam'] . '-06-30';
                    } elseif ($inputs['quy'] == 3) {
                        $ngaytu = $inputs['nam'] . '-07-01';
                        $ngayden = $inputs['nam'] . '-09-31';
                    } else {
                        $ngaytu = $inputs['nam'] . '-10-01';
                        $ngayden = $inputs['nam'] . '-12-31';
                    }
                    $model = $model->whereBetween('ngaychuyen', [$ngaytu, $ngayden]);
                }
            }else{
                if($inputs['time'] == 'ngay')
                    $model = $model->whereBetween('ngaynhan',[getDateToDb($inputs['tungay']), getDateToDb($inputs['denngay'])]);
                elseif($inputs['time'] == 'thang')
                    $model = $model->whereMonth('ngaynhan',$inputs['thang'])
                        ->whereYear('ngaynhan',$inputs['nam']);
                else{
                    if ($inputs['quy'] == 1) {
                        $ngaytu = $inputs['nam'] . '-01-01';
                        $ngayden = $inputs['nam'] . '-03-31';
                    } elseif ($inputs['quy'] == 2) {
                        $ngaytu = $inputs['nam'] . '-04-01';
                        $ngayden = $inputs['nam'] . '-06-30';
                    } elseif ($inputs['quy'] == 3) {
                        $ngaytu = $inputs['nam'] . '-07-01';
                        $ngayden = $inputs['nam'] . '-09-31';
                    } else {
                        $ngaytu = $inputs['nam'] . '-10-01';
                        $ngayden = $inputs['nam'] . '-12-31';
                    }
                    $model = $model->whereBetween('ngaynhan', [$ngaytu, $ngayden]);
                }
            }
            $model = $model->get();
            /*dd($model);*/
            $mahss = '';
            foreach($model as $ct){
                $mahss = $mahss.$ct->mahs.',';
            }
            $modelct = KkGiaDvChCt::whereIn('mahs',explode(',',$mahss))->get();

            return view('manage.kkgia.dvch.reports.bc2')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('modelct',$modelct)
                ->with('pageTitle', 'Báo cáo tổng hợp kê khai giá dịch vụ ca huế');
        }else
            return view('errors.notlogin');
    }
}
