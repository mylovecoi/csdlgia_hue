<?php

namespace App\Http\Controllers\manage\giagiay;

use App\Model\manage\kekhaigia\kkgiay\KkGiaGiay;
use App\Model\manage\kekhaigia\kkgiay\KkGiaGiayCt;
use App\Model\system\company\Company;
use App\Model\view\view_dmnganhnghe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class KkGiaGiayBcController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $inputs['url'] = '/giagiay';
            $m_giay = view_dmnganhnghe::where('manghe', 'GIAY')->get();
            $m_donvi = getDonViTongHop_dn('giathan',session('admin')->level, session('admin')->madiaban);

            return view('manage.giagiay.baocao.index')
                ->with('inputs',$inputs)
                ->with('m_donvi',$m_donvi)
                ->with('a_dm',array_column($m_giay->toarray(),'tennghe','manghe'))
                ->with('pageTitle', 'Báo cáo tổng hợp kê khai giá giấy');
        }else
            return view('errors.notlogin');
    }

    public function bc1(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $m_donviql = getDonViTongHop_dn('giagiay',session('admin')->level, session('admin')->madiaban);
            //lấy theo đơn vị tổng hợp nếu lấy all thì chỉ lấy trong $m_donvi
            $m_nghe = view_dmnganhnghe::where('manghe', 'GIAY')->get();
            $model =  KkGiaGiay::where('trangthai','DD')->wherein('macqcq',array_column($m_donviql->toarray(),'madv'));
            if($inputs['madv'] != 'all') {
                $model = $model->where('madv', $inputs['madv']);
            }

            if($inputs['phanloai'] == 'ngaychuyen'){
                $model = $model->whereBetween('ngaychuyen',[getDateToDb($inputs['tungay']), getDateToDb($inputs['denngay'])]);
            }else{
                $model = $model->whereBetween('ngaynhan',[getDateToDb($inputs['tungay']), getDateToDb($inputs['denngay'])]);
            }

            $model = $model->get();
            $inputs['counths'] = count($model);
            $m_donviql = $m_donviql->wherein('madv',array_column($model->toarray(),'macqcq'));
            $m_com = Company::wherein('madv',array_column($model->toarray(),'madv'))->get();

            return view('manage.giagiay.baocao.bc1')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('a_nghe',array_column($m_nghe->toarray(),'tennghe','manghe'))
                ->with('a_com',array_column($m_com->toarray(),'tendn','madv'))
                ->with('modeldvql',$m_donviql)
                ->with('pageTitle', 'Báo cáo tổng hợp kê khai, đăng ký giá giấy');
        }else
            return view('errors.notlogin');
    }

    public function bc2(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $m_donviql = getDonViTongHop_dn('giagiay',session('admin')->level, session('admin')->madiaban);
            //lấy theo đơn vị tổng hợp nếu lấy all thì chỉ lấy trong $m_donvi
            $m_nghe = view_dmnganhnghe::where('manghe', 'GIAY')->get();
            $model =  KkGiaGiay::where('trangthai','DD')->wherein('macqcq',array_column($m_donviql->toarray(),'madv'));
            if($inputs['madv'] != 'all') {
                $model = $model->where('madv', $inputs['madv']);
            }

            if($inputs['phanloai'] == 'ngaychuyen'){
                $model = $model->whereBetween('ngaychuyen',[getDateToDb($inputs['tungay']), getDateToDb($inputs['denngay'])]);
            }else{
                $model = $model->whereBetween('ngaynhan',[getDateToDb($inputs['tungay']), getDateToDb($inputs['denngay'])]);
            }

            $model = $model->get();
            //dd($model);
            $inputs['counths'] = count($model);
            $m_donviql = $m_donviql->wherein('madv',array_column($model->toarray(),'macqcq'));
            $m_com = Company::wherein('madv',array_column($model->toarray(),'madv'))->get();
            $modelct = KkGiaGiayCt::whereIn('mahs',array_column($model->toarray(),'mahs'))->get();

            return view('manage.giagiay.baocao.bc2')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('a_nghe',array_column($m_nghe->toarray(),'tennghe','manghe'))
                ->with('a_com',array_column($m_com->toarray(),'tendn','madv'))
                ->with('modeldvql',$m_donviql)
                ->with('modelct',$modelct)
                ->with('pageTitle', 'Báo cáo tổng hợp kê khai');
        }else
            return view('errors.notlogin');
    }
}
