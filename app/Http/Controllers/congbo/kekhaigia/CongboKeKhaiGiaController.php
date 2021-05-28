<?php

namespace App\Http\Controllers\congbo\kekhaigia;

use App\Model\system\company\Company;
use App\Model\system\company\CompanyLvCc;
use App\Model\system\dsdiaban;
use App\Model\view\view_dmnganhnghe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CongboKeKhaiGiaController extends Controller
{
    public function donvi(Request $request)
    {
        $inputs = $request->all();
        $a_phanloai = [];
        $a_bang = [];
        $a_loai = ['index', 'congbo', 'thongtinkknygia'];

        $a_diaban = array_column(dsdiaban::wherein('level', ['T', 'H', 'X'])->get()->toarray(), 'tendiaban', 'madiaban');
        $inputs['madiaban'] = $inputs['madiaban'] ?? array_key_first($a_diaban);
        $m_doanhnghiep = Company::where('madiaban', $inputs['madiaban'])->get();
        $m_doanhnghiep_lvcc = CompanyLvCc::whereIn('madv',array_column($m_doanhnghiep->toarray(),'madv'))->get();
        $a_doanhnghiep = [];
        //chỉ lấy doanh ngiệp kê khai niêm yết giá
        $a_manghe = array_column(view_dmnganhnghe::where('phanloai','KK')->get()->toarray(),'manghe');

        foreach($m_doanhnghiep as $doanhnghiep){
//            if($doanhnghiep->madv = '6300049053'){
//                dd($m_doanhnghiep_lvcc->where('madv',$doanhnghiep->madv));
//            }
            foreach($m_doanhnghiep_lvcc->where('madv',$doanhnghiep->madv) as $linhvuc){
                if(in_array($linhvuc->manghe,$a_manghe)){
                    $a_doanhnghiep[$doanhnghiep->madv] = $doanhnghiep->tendn;
                    break;
                }
            }
        }
        $inputs['madv'] = $inputs['madv'] ?? '';

        //Do trên màn hình công bố có 2 combo chọn địa bàn; chọn doanh nghiệp
        //=>chọn địa bàn thì val của $inputs['madv'] có thể ko pải là trong $inputs['madiaban']
        //==>kiểm tra nếu $inputs['madv'] ko thuộc $inputs['madiaban'] => gán first()
        $inputs['madv'] = isset($a_doanhnghiep[$inputs['madv']]) ? $inputs['madv'] : array_key_first($a_doanhnghiep);
        $a_lvcc = array_column($m_doanhnghiep_lvcc->where('madv',(string)$inputs['madv'])->toarray(),'manghe');
        //dd(in_array(strtoupper('tacn'), $a_lvcc));

        foreach (getGiaoDien()['csdlmucgiahhdv']['kknygia'] as $key => $val) {
            if (in_array($key, $a_loai)
                || !isset(session('congbo')['setting']['csdlmucgiahhdv']['kknygia'][$key])
                || session('congbo')['setting']['csdlmucgiahhdv']['kknygia'][$key]['index'] == 0
                || !in_array(strtoupper($key), $a_lvcc)
            ) {
                continue;
            }
            $a_phanloai[$key] = session('congbo')['chucnang'][$key] ?? $key;
            $a_bang[$key] = $val['table'];
        }
        //dd($a_phanloai);
        $inputs['phanloai'] = $inputs['phanloai'] ?? '';
        $inputs['phanloai'] = isset($a_phanloai[$inputs['phanloai']]) ? $inputs['phanloai'] : array_key_first($a_phanloai);
        //dd($a_doanhnghiep);
        $m_hoso = nullValue();
        $m_hoso_ct = nullValue();
        if(count($a_bang) > 0) {
            $m_hoso = DB::table($a_bang[$inputs['phanloai']])
                ->where('madv', $inputs['madv'])
                ->where('trangthai', 'HT')
                ->orderby('ngaychuyen', 'desc')
                ->first();

            if ($m_hoso != null) {
                $m_hoso_ct = DB::table($a_bang[$inputs['phanloai'] . 'ct'])->where('mahs', $m_hoso->mahs)->get();
            }
        }
        //dd($inputs);
        return view('congbo.KeKhaiGia._include.doanhnghiep')
            ->with('model', $m_hoso_ct)
            ->with('m_hoso', $m_hoso)
            ->with('a_doanhnghiep', $a_doanhnghiep)
            ->with('a_diaban', $a_diaban)
            ->with('a_phanloai', $a_phanloai)
            ->with('inputs', $inputs)
            ->with('pageTitle', 'Thông tin công bố kê khai giá, niêm yết giá');
    }

    public function linhvuc(Request $request)
    {
        $inputs = $request->all();
        $a_phanloai = [];
        $a_bang = [];
        $a_loai = ['index', 'congbo', 'thongtinkknygia'];

        foreach (getGiaoDien()['csdlmucgiahhdv']['kknygia'] as $key => $val) {
            if (in_array($key, $a_loai)
                || !isset(session('congbo')['setting']['csdlmucgiahhdv']['kknygia'][$key])
                || session('congbo')['setting']['csdlmucgiahhdv']['kknygia'][$key]['index'] == 0
            ) {
                continue;
            }
            $a_phanloai[$key] = session('congbo')['chucnang'][$key] ?? $key;
            $a_bang[$key] = $val['table'];
        }
        //dd($a_phanloai);
        $inputs['phanloai'] = $inputs['phanloai'] ?? array_key_first($a_phanloai);

        $a_diaban = array_column(dsdiaban::wherein('level', ['T', 'H', 'X'])->get()->toarray(), 'tendiaban', 'madiaban');
        $inputs['madiaban'] = $inputs['madiaban'] ?? array_key_first($a_diaban);
        $m_doanhnghiep = Company::where('madiaban', $inputs['madiaban'])->get();
        $m_doanhnghiep_lvcc = CompanyLvCc::whereIn('madv',array_column($m_doanhnghiep->toarray(),'madv'))->get();
        $a_doanhnghiep = [];
        //chỉ lấy doanh ngiệp kê khai niêm yết giá và hoạt động lĩnh vực kinh doanh
        $a_manghe = array_column(view_dmnganhnghe::where('phanloai','KK')->get()->toarray(),'manghe');
        //
        foreach($m_doanhnghiep as $doanhnghiep){
            foreach($m_doanhnghiep_lvcc->where('madv',$doanhnghiep->madv) as $linhvuc){
                if(in_array($linhvuc->manghe,$a_manghe) && $linhvuc->manghe == strtoupper($inputs['phanloai'])){
                    $a_doanhnghiep[$doanhnghiep->madv] = $doanhnghiep->tendn;
                    break;
                }
            }
        }
        $inputs['madv'] = $inputs['madv'] ?? '';

        //Do trên màn hình công bố có 2 combo chọn địa bàn; chọn doanh nghiệp
        //=>chọn địa bàn thì val của $inputs['madv'] có thể ko pải là trong $inputs['madiaban']
        //==>kiểm tra nếu $inputs['madv'] ko thuộc $inputs['madiaban'] => gán first()
        $inputs['madv'] = isset($a_doanhnghiep[$inputs['madv']]) ? $inputs['madv'] : array_key_first($a_doanhnghiep);

        //dd($a_doanhnghiep);
        $m_hoso = nullValue();
        $m_hoso_ct = nullValue();
        if(count($a_bang) > 0) {
            $m_hoso = DB::table($a_bang[$inputs['phanloai']])
                ->where('madv', $inputs['madv'])
                ->where('trangthai', 'HT')
                ->orderby('ngaychuyen', 'desc')
                ->first();

            if ($m_hoso != null) {
                $m_hoso_ct = DB::table($a_bang[$inputs['phanloai'] . 'ct'])->where('mahs', $m_hoso->mahs)->get();
            }
        }
        //dd($inputs);
        return view('congbo.KeKhaiGia._include.linhvuc')
            ->with('model', $m_hoso_ct)
            ->with('m_hoso', $m_hoso)
            ->with('a_doanhnghiep', $a_doanhnghiep)
            ->with('a_diaban', $a_diaban)
            ->with('a_phanloai', $a_phanloai)
            ->with('inputs', $inputs)
            ->with('pageTitle', 'Thông tin công bố kê khai giá, niêm yết giá');
    }

    function timkiem(Request $request){

    }

}
