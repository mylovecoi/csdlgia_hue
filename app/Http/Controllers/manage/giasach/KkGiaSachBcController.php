<?php

namespace App\Http\Controllers\manage\giasach;

use App\Model\manage\kekhaidkg\kehaimhbog\KkMhBog;
use App\Model\manage\kekhaidkg\kehaimhbog\KkMhBogCt;
use App\Model\system\company\Company;
use App\Model\view\view_dmnganhnghe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class KkGiaSachBcController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $inputs['url'] = '/giasach';
            $m_giasach = view_dmnganhnghe::where('manghe', 'SACH')->get();
            $m_donvi = getDonViTongHop_dn('giaetanol',session('admin')->level, session('admin')->madiaban);

            return view('manage.giasach.baocao.index')
                ->with('inputs',$inputs)
                ->with('m_donvi',$m_donvi)
                ->with('a_dm',array_column($m_giasach->toarray(),'tennghe','manghe'))
                ->with('pageTitle', 'Báo cáo tổng hợp kê khai giá sách');
        }else
            return view('errors.notlogin');
    }

    public function bc1(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $m_donviql = getDonViTongHop_dn('giasach',session('admin')->level, session('admin')->madiaban);
            //lấy theo đơn vị tổng hợp nếu lấy all thì chỉ lấy trong $m_donvi
            $m_nghe = view_dmnganhnghe::where('manghe', 'SACH')->get();
            $model =  KkMhBog::where('trangthai','DD')->wherein('macqcq',array_column($m_donviql->toarray(),'madv'));
            //dd($model->get());
            if($inputs['madv'] != 'all') {
                $model = $model->where('macqcq', $inputs['macqcq']);
            }

            if($inputs['manghe'] != 'all') {
                $model = $model->where('manghe', $inputs['manghe']);
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

            return view('manage.giasach.baocao.bc1')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('a_nghe',array_column($m_nghe->toarray(),'tennghe','manghe'))
                ->with('a_com',array_column($m_com->toarray(),'tendn','madv'))
                ->with('modeldvql',$m_donviql)
                //->with('modeldmnghe',$modeldmnghe)
                ->with('pageTitle', 'Báo cáo tổng hợp kê khai, đăng ký giá sách');
        }else
            return view('errors.notlogin');
    }

    public function bc2(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $m_donviql = getDonViTongHop_dn('giasach',session('admin')->level, session('admin')->madiaban);
            //lấy theo đơn vị tổng hợp nếu lấy all thì chỉ lấy trong $m_donvi
            $m_nghe = view_dmnganhnghe::where('manghe', 'SACH')->get();
            $model =  KkMhBog::where('trangthai','DD')->wherein('macqcq',array_column($m_donviql->toarray(),'madv'));
            //dd($model->get());
            if($inputs['madv'] != 'all') {
                $model = $model->where('macqcq', $inputs['macqcq']);
            }

            if($inputs['manghe'] != 'all') {
                $model = $model->where('manghe', $inputs['manghe']);
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
            $modelct = KkMhBogCt::whereIn('mahs',array_column($model->toarray(),'mahs'))->get();

            return view('manage.giasach.baocao.bc2')
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
