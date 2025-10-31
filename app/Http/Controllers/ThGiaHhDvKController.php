<?php

namespace App\Http\Controllers;

use App\DiaBanHd;
use App\District;
use App\DmHhDvK;
use App\GiaHhDvK;
use App\GiaHhDvKCt;
use App\Imports\ColectionImport;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_thgiahhdvk;
use App\NhomHhDvK;
use App\ThGiaHhDvK;
use App\ThGiaHhDvKCt;
use App\ThGiaHhDvKCtDf;
use App\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ThGiaHhDvKController extends Controller
{
    public function index(Request $request)
    {
        if (Session::has('admin')) {
            if (chkPer('csdlmucgiahhdv', 'hhdv', 'giahhdvk', 'khac', 'baocao')) {
                $inputs = $request->all();
                $inputs['url'] = '/giahhdvk';
                $inputs['thang'] = isset($inputs['thang']) ? $inputs['thang'] : date('m');
                $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
                //$inputs['phanloai'] = isset($inputs['phanloai']) ? $inputs['phanloai'] : 'thang';
                $inputs['phanloai'] = 'thang';
                $m_nhom = NhomHhDvK::where('theodoi', 'TD')->get();
                $inputs['matt'] = isset($inputs['matt']) ? $inputs['matt'] : $m_nhom->first()->matt;
                $m_hoso = GiaHhDvK::where('matt', $inputs['matt'])
                    ->where('trangthai', 'HT');
                $model = ThGiaHhDvK::where('nam', $inputs['nam'])
                    ->where('matt', $inputs['matt']);

                if ($inputs['thang'] != 'all') {
                    $m_hoso = $m_hoso->where('thang', $inputs['thang']);
                    $model = $model->where('thang', $inputs['thang']);
                }
                if ($inputs['nam'] != 'all') {
                    $m_hoso = $m_hoso->where('nam', $inputs['nam']);
                    $model = $model->where('nam', $inputs['nam']);
                }
                $model = $model->get();
                $m_hoso = $m_hoso->get();
                $a_donvi = array_column(view_dsdiaban_donvi::all()->toArray(), 'tendv', 'madv');
                $inputs['baocao'] = count($model) > 0 ? true : false;
                $a_nhaplieu = array_column(getDonViNhapLieu(session('admin')->level, 'giahhdvk')->toArray(), 'tendv', 'madv');
                //dd($a_nhaplieu);
                return view('manage.dinhgia.giahhdvk.tonghop.index')
                    ->with('model', $model)
                    ->with('m_hoso', $m_hoso)
                    ->with('a_donvi', $a_donvi)
                    ->with('a_tt', array_column($m_nhom->toarray(), 'tentt', 'matt'))
                    ->with('a_nhaplieu', $a_nhaplieu)
                    ->with('inputs', $inputs)
                    ->with('pageTitle', 'Tổng hợp giá hàng hóa dịch vụ khác');
            } else
                return view('errors.perm');
        } else
            return view('errors.notlogin');
    }

    public function create(Request $request)
    {
        if (Session::has('admin')) {
            if (chkPer('csdlmucgiahhdv', 'hhdv', 'giahhdvk', 'khac', 'baocao')) {
                $inputs = $request->all();
                $inputs['ngaychotbc'] = getDateToDb($inputs['ngaychotbc']);
                // dd($inputs);
                $modelcheck = ThGiaHhDvK::where('manhom', $inputs['manhombc'])
                    ->where('thang', $inputs['thangbc'])
                    ->where('nam', $inputs['nambc'])
                    ->where('phanloai', $inputs['phanloaibc'])
                    ->count();
                //dd($inputs['phanloaibc']);
                if ($modelcheck > 0) {
                    dd('Đã có báo cáo, bạn cần kiểm tra lại! Nếu số liệu không đúng bạn cần xóa báo cáo trước để tạo báo cáo mới');
                } else {
                    $checkdf = ThGiaHhDvKCtDf::where('manhom', $inputs['manhombc'])
                        //->where('ngaychotbc', $inputs['ngaychotbc'])
                        ->delete();

                    $modeldiaban = DiaBanHd::where('level', 'H')
                        ->get();
                    $id = '';
                    foreach ($modeldiaban as $diaban) {
                        $modelid = GiaHhDvK::where('manhom', $inputs['manhombc'])
                            ->where('district', $diaban->district)
                            ->where('thang', $inputs['thangbc'])
                            ->where('nam', $inputs['nambc'])
                            //->where('phanloai',$inputs['phanloaibc'])
                            ->where('trangthai', 'HT')
                            ->first();
                        if ($modelid != null)
                            $id = $id . $modelid->id . ',';
                    }
                    //Lấy ra mahs kê khai
                    $modelhskk = GiaHhDvK::wherein('id', explode(',', $id))
                        ->select('mahs')
                        ->get();
                    //Lấy ra chi tiết các hồ sơ kê khai
                    $modelcthskk = GiaHhDvKCt::wherein('mahs', $modelhskk->toArray())
                        ->where('gia', '<>', 0)
                        ->get();
                    //dd($modelcthskk->select('mahhdv','tenhhdv','gia')->get()->toArray());


                    $modeldm = DmHhDvK::where('theodoi', 'TD')
                        ->where('manhom', $inputs['manhombc'])
                        ->select('mahhdv', 'tenhhdv', 'dvt')
                        ->get();
                    //dd($modeldm);

                    foreach ($modeldm as $dm) {

                        $ttgia = $modelcthskk->where('mahhdv', $dm->mahhdv)->avg('gia');
                        $modelct = new ThGiaHhDvKCtDf();
                        $modelct->manhom = $inputs['manhombc'];
                        $modelct->ngaychotbc = $inputs['ngaychotbc'];
                        $modelct->mahhdv = $dm->mahhdv;
                        $modelct->tenhhdv = $dm->tenhhdv;
                        $modelct->dvt = $dm->dvt;
                        $modelct->gia = $ttgia;
                        $modelct->save();
                    }
                    $modelct = ThGiaHhDvKCtDf::where('manhom', $inputs['manhombc'])
                        ->where('ngaychotbc', $inputs['ngaychotbc'])
                        ->get();

                    //dd($modelct);
                    $modelnhom = NhomHhDvK::where('manhom', $inputs['manhombc'])->first();
                    return view('manage.dinhgia.giahhdvk.tonghop.create')
                        ->with('modelct', $modelct)
                        ->with('modelnhom', $modelnhom)
                        ->with('inputs', $inputs)
                        ->with('pageTitle', 'Tổng hợp giá hàng hóa dịch vụ khác');
                }
            } else
                return view('errors.perm');
        } else
            return view('errors.notlogin');
    }

    public function store(Request $request)
    {
        if (Session::has('admin')) {
            if (chkPer('csdlmucgiahhdv', 'hhdv', 'giahhdvk', 'khac', 'baocao')) {
                $inputs = $request->all();

                if (isset($inputs['ipf_word'])) {
                    $ipf1 = $request->file('ipf_word');
                    $name = $inputs['mahs'] . '_' . $ipf1->getClientOriginalName();
                    $ipf1->move(public_path() . '/data/giahhdvk/', $name);
                    $inputs['ipf_word'] = $name;
                    $inputs['ipf_word_base64'] = base64_encode(file_get_contents(public_path() . '\\data\\giahhdvk\\' . $name));
                }

                if (isset($inputs['ipf_pdf'])) {
                    $ipf1 = $request->file('ipf_pdf');
                    $name = $inputs['mahs'] . '_' . $ipf1->getClientOriginalName();
                    $ipf1->move(public_path() . '/data/giahhdvk/', $name);
                    $inputs['ipf_pdf'] = $name;
                    $inputs['ipf_pdf_base64'] = base64_encode(file_get_contents(public_path() . '\\data\\giahhdvk\\' . $name));
                }

                if (isset($inputs['ipf_excel'])) {
                    $ipf1 = $request->file('ipf_excel');
                    $name = $inputs['mahs'] . '_' . $ipf1->getClientOriginalName();
                    $ipf1->move(public_path() . '/data/giahhdvk/', $name);
                    $inputs['ipf_excel'] = $name;
                    $inputs['ipf_excel_base64'] = base64_encode(file_get_contents(public_path() . '\\data\\giahhdvk\\' . $name));
                }
                //

                $inputs['ngaybc'] = getDateToDb($inputs['ngaybc']);
                $model = ThGiaHhDvK::where('mahs', $inputs['mahs'])->first();
                if ($model == null) {
                    $inputs['trangthai'] = 'CHT';
                    ThGiaHhDvK::create($inputs);
                } else {
                    $model->update($inputs);
                }
                //Lấy thông tin
                $model = ThGiaHhDvK::where('mahs', $inputs['mahs'])->first();
                return redirect('/giahhdvk/tonghop?thang=' . $inputs['thang'] . '&nam=' . $inputs['nam'] . '&matt=' . $inputs['matt']);
            } else
                return view('errors.perm');
        } else
            return view('errors.notlogin');
    }

    public function show($id)
    {
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H') {
                $model = ThGiaHhDvK::findOrFail($id);
                $modelct = ThGiaHhDvKCt::where('mahs', $model->mahs)
                    ->get();
                $modelnhom = NhomHhDvK::where('matt', $model->matt)->first();
                $modelgr = ThGiaHhDvKCt::where('mahs', $model->mahs)
                    ->select('manhom', 'nhom')
                    ->groupBy('manhom', 'nhom')
                    ->get();
                if (session('admin')->level == 'T') {
                    $inputs['dvcaptren'] = getGeneralConfigs()['tendvcqhienthi'];
                    $inputs['dv'] = getGeneralConfigs()['tendvhienthi'];
                    $inputs['diadanh'] = getGeneralConfigs()['diadanh'];
                } elseif (session('admin')->level == 'H') {
                    $modeldv = District::where('mahuyen', session('admin')->mahuyen)->first();
                    $inputs['dvcaptren'] = $modeldv->tendvcqhienthi;
                    $inputs['dv'] = $modeldv->tendvhienthi;
                    $inputs['diadanh'] = getGeneralConfigs()['diadanh'];
                } else {
                    $modeldv = Town::where('maxa', session('admin')->maxa)
                        ->where('mahuyen', session('admin')->mahuyen)->first();
                    $inputs['dvcaptren'] = $modeldv->tendvcqhienthi;
                    $inputs['dv'] = $modeldv->tendvhienthi;
                    $inputs['diadanh'] = getGeneralConfigs()['diadanh'];
                }
                return view('manage.dinhgia.giahhdvk.tonghop.show')
                    ->with('modelct', $modelct)
                    ->with('modelnhom', $modelnhom)
                    ->with('model', $model)
                    ->with('inputs', $inputs)
                    ->with('modelgr', $modelgr)
                    ->with('pageTitle', 'Tổng hợp giá hàng hóa dịch vụ khác');
            } else
                return view('errors.perm');
        } else
            return view('errors.notlogin');
    }

    public function edit(Request $request)
    {
        if (Session::has('admin')) {
            if (chkPer('csdlmucgiahhdv', 'hhdv', 'giahhdvk', 'khac', 'baocao')) {
                $inputs = $request->all();
                $inputs['url'] = '/giahhdvk';
                $model = ThGiaHhDvK::where('mahs', $inputs['mahs'])->first();
                $modelct = ThGiaHhDvKCt::where('mahs', $model->mahs)->get();
                $modelnhom = NhomHhDvK::where('matt', $model->matt)->first();
                $modeldm = DmHhDvK::where('matt', $model->matt)->get();
                return view('manage.dinhgia.giahhdvk.tonghop.edit')
                    ->with('model', $model)
                    ->with('modelct', $modelct)
                    ->with('modelnhom', $modelnhom)
                    ->with('a_dm', array_column($modeldm->toarray(), 'tenhhdv', 'mahhdv'))
                    ->with('inputs', $inputs)
                    ->with('pageTitle', 'Tổng hợp giá hàng hóa, dịch vụ chỉnh sửa');
            } else
                return view('errors.perm');
        } else
            return view('errors.notlogin');
    }

    public function destroy(Request $request)
    {
        if (Session::has('admin')) {
            if (chkPer('csdlmucgiahhdv', 'hhdv', 'giahhdvk', 'khac', 'baocao')) {
                $inputs = $request->all();
                //dd($inputs);
                $model = ThGiaHhDvK::where('mahs', $inputs['mahs'])->first();
                ThGiaHhDvKCt::where('mahs', $model->mahs)->delete();
                $model->delete();

                return redirect('/giahhdvk/tonghop');
            } else
                return view('errors.perm');
        } else
            return view('errors.notlogin');
    }

    public function exportXML(Request $request)
    {
        $inputs = $request->all();
        $model = ThGiaHhDvK::where('mahs', $inputs['mahs'])->first();
        $modelct = ThGiaHhDvKCt::where('mahs', $model->mahs)->get();
        $modeldm = NhomHhDvK::where('matt', $model->matt)->first();
        //dd($modelct);
        $data = '<?xml version="1.0" encoding="UTF-8"?>';
        $data .= '<title>' . $model->ttbc . ',ngày báo cáo: ' . getDayVn($model->ngaybc);
        $data .= '<name>' . $modeldm->manhom . '. ' . $modeldm->tennhom;
        $data .= '<data>';
        foreach ($modelct as $ct) {
            $data .= '<row>';
            $data .= '<stt>' . $ct->mahhdv . '</stt>';
            $data .= '<tenhhdv>' . $ct->tenhhdv . '</tenhhdv>';
            $data .= '<dacdiemkt>' . $ct->dacdiemkt . '</dacdiemkt>';
            $data .= '<dvt>' . $ct->dvt . '</dvt>';
            $data .= '<loaigia>$ct->loaigia</loaigia>';
            $data .= '<dongialk>' . $ct->gialk . '</dongialk>';
            $data .= '<dongia>' . $ct->gia . '</dongia>';
            $data .= '<muctg>' . (($ct->gia) - ($ct->gialk)) . '</muctg>';
            $data .= '<tyle>' . (number_format($ct->gialk) == 0 ? number_format($ct->gia) == 0 ? 0 : 100
                : dinhdangsothapphan(($ct->gia - $ct->gialk) / $ct->gialk, 2)) . '</tyle>';
            $data .= '<nguontin>' . $ct->nguontin . '</nguontin>';
            $data .= '<ghichu>' . $ct->ghichu . '</ghichu>';
            $data .= '</row>';
        }
        $data .= '</data>';
        $data .= '</name>';
        $data .= '</title>';

        $fp = 'hhdvk' . $model->id . '.xml';
        //dd($data);
        File::put(public_path('data/xml/' . $fp), $data);
        return Response::download(public_path('data/xml/' . $fp));
    }

    function exportEx(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = ThGiaHhDvK::where('mahs', $inputs['mahs'])->first();
            $modelct = view_thgiahhdvk::where('mahs', $model->mahs)->get();
            //dd($modelct);
            $modelnhom = NhomHhDvK::where('matt', $model->matt)->first();

            Excel::create('THHANGHOA', function ($excel) use ($model, $modelct, $modelnhom, $inputs) {
                $excel->sheet('THHANGHOA', function ($sheet) use ($model, $modelct, $modelnhom, $inputs) {
                    $sheet->loadView('manage.dinhgia.giahhdvk.tonghop.show_excel')
                        ->with('modelct', $modelct)
                        ->with('modelnhom', $modelnhom)
                        ->with('model', $model)
                        ->with('inputs', $inputs)
                        ->with('pageTitle', 'Danh mục hàng hóa');
                    //$sheet->setPageMargin(0.25);
                    $sheet->setAutoSize(false);
                    $sheet->setFontFamily('Tahoma');
                    $sheet->setFontBold(false);

                    //$sheet->setColumnFormat(array('D' => '#,##0.00'));
                });
            })->download('xlsx');
        } else
            return view('errors.notlogin');
    }

    public function createthang(Request $request)
    {
        if (Session::has('admin')) {
            if (chkPer('csdlmucgiahhdv', 'hhdv', 'giahhdvk', 'khac', 'baocao')) {
                $inputs = $request->all();
                $inputs['url'] = '/giahhdvk';

                //                //bỏ chức năng mỗi tháng chi có 1 báo cáo
                //                $model = ThGiaHhDvK::where('matt', $inputs['matt'])
                //                    ->where('thang', $inputs['thang'])
                //                    ->where('nam', $inputs['nam'])
                //                    ->first();
                //                //dd($inputs['phanloaibc']);
                //                if ($model != null) {
                //                    return redirect('/giahhdvk/tonghop/edit?mahs=' . $model->mahs . '&act=false');
                //                    //dd('Đã có báo cáo, bạn cần kiểm tra lại! Nếu số liệu không đúng bạn cần xóa báo cáo trước để tạo báo cáo mới');
                //                }
                //DB::statement("DELETE FROM thgiahhdvkct WHERE mahs not in (SELECT mahs FROM thgiahhdvk)");
                // if (!isset($inputs['hoso'])) {
                //     return view('errors.403')
                //         ->with('message', 'Không có hồ sơ nào được chọn để tổng hợp số liệu.')
                //         ->with('url', '/giahhdvk/tonghop');
                // }
                $a_hoso = isset($inputs['hoso']) ? array_keys($inputs['hoso']) : [];
                //Lấy ra chi tiết các hồ sơ kê khai
                $modelcthskk = GiaHhDvKCt::wherein('mahs', $a_hoso)
                    ->where('gia', '<>', 0)->get();

                $modeldm = DmHhDvK::where('matt', $inputs['matt'])->get();
                //dd($modeldm);
                //                $m_lk = ThGiaHhDvK::where('matt', $inputs['matt'])
                //                    ->where('trangthai', 'HT')
                //                    ->orderby('ngaybc', 'desc')->first();
                //                $a_ctlk = array();
                //                if ($m_lk != null) {
                //                    $a_ctlk = array_column(GiaHhDvKCt::where('mahs', $m_lk->mahs)->get()->toarray(), 'mahhdv', 'gia');
                //                }
                $model = new ThGiaHhDvK();
                $model->mahs = getdate()[0];
                $model->matt = $inputs['matt'];
                $model->trangthai = 'CHT';
                $model->thang = $inputs['thang'];
                $model->nam = $inputs['nam'];
                $model->ttbc = 'Tổng hợp số liệu tháng ' . $inputs['thang'] . ' năm ' . $inputs['nam'];
                $model->mahstonghop = implode(';', $a_hoso);

                $a_dm = array();

                foreach ($modeldm as $dm) {
                    $a_dm[] = [
                        'mahs' => $model->mahs,
                        'mahhdv' => $dm->mahhdv,
                        'gia' => getDbl($modelcthskk->where('mahhdv', $dm->mahhdv)->avg('gia')),
                        'gialk' => getDbl($modelcthskk->where('mahhdv', $dm->mahhdv)->avg('gialk')),
                        //'gialk' => $a_ctlk[$dm->mahhdv] ?? 0,
                    ];
                }
                ThGiaHhDvKCt::insert($a_dm);
                $modelct = ThGiaHhDvKCt::where('mahs', $model->mahs)->get();
                $modelnhom = NhomHhDvK::where('matt', $inputs['matt'])->first();
                return view('manage.dinhgia.giahhdvk.tonghop.edit')
                    ->with('model', $model)
                    ->with('modelct', $modelct)
                    ->with('modelnhom', $modelnhom)
                    ->with('a_dm', array_column($modeldm->toarray(), 'tenhhdv', 'mahhdv'))
                    ->with('inputs', $inputs)
                    ->with('pageTitle', 'Tổng hợp giá hàng hóa dịch vụ khác');
            } else
                return view('errors.perm');
        } else
            return view('errors.notlogin');
    }

    public function create_hoso(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            //dd($inputs['madv']);
            $m_dv = dsdonvi::where('madv', $inputs['madv'])->first();
            $m_hs = ThGiaHhDvK::where('mahs', $inputs['mahs'])->first();

            $model = new GiaHhDvK();
            $model->mahs = $inputs['madv'] . '_' . getdate()[0];
            $model->matt = $m_hs->matt;
            $model->soqd = $m_hs->sobc;
            $model->thoidiem = $m_hs->ngaybc;
            $model->madiaban = $m_dv->madiaban;
            $model->madv = $inputs['madv'];
            $model->trangthai = 'CHT';
            $model->thang = $m_hs->thang;
            $model->nam = $m_hs->nam;
            $a_dm = array();

            foreach (ThGiaHhDvKCt::where('mahs', $inputs['mahs'])->get() as $ct) {
                $a_dm[] = [
                    'mahs' => $model->mahs,
                    'mahhdv' => $ct->mahhdv,
                    'loaigia' => 'Giá bán lẻ',
                    'nguontt' => 'Do cơ quan/đơn vị quản lý nhà nước có liên quan cung cấp/báo cáo theo quy định',
                    'gia' => round(getDoubleToDb($ct->gia), 0),
                    'gialk' => round(getDoubleToDb($ct->gialk), 0),
                ];
            }
            foreach (array_chunk($a_dm, 100) as $dm) {
                GiaHhDvKCt::insert($dm);
            }
            // GiaHhDvKCt::insert($a_dm);
            $model->save();
            return view('errors.success')
                ->with('message', 'Tạo mới hồ sơ kê khai từ số liệu tổng hợp thành công.')
                ->with('url', '/giahhdvk/tonghop?thang=' . $model->thang . '&nam=' . $model->nam);
        } else
            return view('errors.notlogin');
    }


    public function tonghopthang(Request $request)
    {
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H') {
                $inputs = $request->all();
                $inputs['mahs'] = getdate()[0];
                $modelcheck = ThGiaHhDvK::where('matt', $inputs['mattbct'])
                    ->where('thang', $inputs['thangbct'])
                    ->where('nam', $inputs['nambct'])
                    ->where('phanloai', $inputs['phanloaibct'])
                    ->count();
                //dd($inputs['phanloaibc']);
                if ($modelcheck > 0) {
                    dd('Đã có báo cáo, bạn cần kiểm tra lại! Nếu số liệu không đúng bạn cần xóa báo cáo trước để tạo báo cáo mới');
                } else {
                    $del = ThGiaHhDvKCt::where('trangthai', 'CXD')
                        ->delete();


                    //                    $modeldiaban = DiaBanHd::where('level', 'H')
                    //                        ->get();
                    //                    $id = '';
                    //                    foreach ($modeldiaban as $diaban) {
                    //                        $modelid = GiaHhDvK::where('manhom', $inputs['manhombct'])
                    //                            ->where('district', $diaban->district)
                    //                            ->where('thang', $inputs['thangbct'])
                    //                            ->where('nam', $inputs['nambct'])
                    //                            //->where('phanloai',$inputs['phanloaibc'])
                    //                            ->where('trangthai', 'HT')
                    //                            ->first();
                    //                        if ($modelid != null)
                    //                            $id = $id . $modelid->id . ',';
                    //                    }
                    //Lấy ra mahs kê khai
                    $modelhskk = GiaHhDvK::where('matt', $inputs['mattbct'])
                        ->where('thang', $inputs['thangbct'])
                        ->where('nam', $inputs['nambct'])
                        ->select('mahs')
                        ->get();
                    //Lấy ra chi tiết các hồ sơ kê khai
                    $modelcthskk = GiaHhDvKCt::wherein('mahs', $modelhskk->toArray())
                        ->where('gia', '<>', 0)
                        ->get();
                    //dd($modelcthskk->select('mahhdv','tenhhdv','gia')->get()->toArray());


                    $modeldm = DmHhDvK::where('theodoi', 'TD')
                        ->where('matt', $inputs['mattbct'])
                        ->get();
                    //dd($modeldm);
                    $idlk = ThGiaHhDvK::where('matt', $inputs['mattbct'])
                        ->where('trangthai', 'HT')
                        ->where('phanloai', 'thang')
                        ->max('id');
                    if ($idlk != '')
                        $mahslk = ThGiaHhDvK::where('id', $idlk)->first()->mahs;
                    else
                        $mahslk = '';
                    foreach ($modeldm as $dm) {
                        $ttgia = $modelcthskk->where('mahhdv', $dm->mahhdv)->avg('gia');
                        if ($mahslk != '') {
                            $modellk = ThGiaHhDvKCt::where('mahs', $mahslk)
                                ->where('mahhdv', $dm->mahhdv)
                                ->first();
                            if (count($modellk) > 0)
                                $gialk = $modellk->gia;
                            else
                                $gialk = 0;
                        } else
                            $gialk = 0;

                        $modelct = new ThGiaHhDvKCt();
                        $modelct->mahs = $inputs['mahs'];
                        $modelct->trangthai = 'CXD';
                        $modelct->manhom = $dm->manhom;
                        $modelct->nhom = $dm->nhom;
                        //$modelct->ngaychotbc = $inputs['ngaychotbct'];
                        $modelct->mahhdv = $dm->mahhdv;
                        $modelct->tenhhdv = $dm->tenhhdv;
                        $modelct->dacdiemkt = $dm->dacdiemkt;
                        $modelct->dvt = $dm->dvt;
                        $modelct->gia = $ttgia;
                        $modelct->gialk = $gialk;
                        $modelct->loaigia = 'Giá bán lẻ';
                        $modelct->nguontt = 'Do cơ quan/đơn vị quản lý nhà nước có liên quan cung cấp/báo cáo theo quy định';
                        $modelct->save();
                    }
                    $modelct = ThGiaHhDvKCt::where('mahs', $inputs['mahs'])
                        ->get();

                    //dd($modelct);
                    $modelnhom = NhomHhDvK::where('matt', $inputs['mattbct'])->first();
                    return view('manage.dinhgia.giahhdvk.tonghop.createththang')
                        ->with('modelct', $modelct)
                        ->with('modelnhom', $modelnhom)
                        ->with('inputs', $inputs)
                        ->with('pageTitle', 'Tổng hợp giá hàng hóa dịch vụ khác');
                }
            } else
                return view('errors.perm');
        } else
            return view('errors.notlogin');
    }

    public function update(Request $request, $id)
    {
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H') {
                $inputs = $request->all();
                $inputs['ngaybc'] = getDateToDb($inputs['ngaybc']);
                $model = ThGiaHhDvK::findOrFail($id);
                dd(isset($inputs['ipf_word']));
                if (isset($inputs['ipf_word'])) {
                    $ipf1 = $request->file('ipf_word');
                    $name = $inputs['mahs'] . '_' . $ipf1->getClientOriginalName();
                    $ipf1->move(public_path() . '/data/giahhdvk/', $name);
                    $inputs['ipf_word'] = $name;
                    $inputs['ipf_word_base64'] = base64_encode(file_get_contents(public_path() . '\\data\\giahhdvk\\' . $name));
                }

                if (isset($inputs['ipf_pdf'])) {
                    $ipf1 = $request->file('ipf_pdf');
                    $name = $inputs['mahs'] . '_' . $ipf1->getClientOriginalName();
                    $ipf1->move(public_path() . '/data/giahhdvk/', $name);
                    $inputs['ipf_pdf'] = $name;
                    $inputs['ipf_pdf_base64'] = base64_encode(file_get_contents(public_path() . '\\data\\giahhdvk\\' . $name));
                }

                if (isset($inputs['ipf_excel'])) {
                    $ipf1 = $request->file('ipf_excel');
                    $name = $inputs['mahs'] . '_' . $ipf1->getClientOriginalName();
                    $ipf1->move(public_path() . '/data/giahhdvk/', $name);
                    $inputs['ipf_excel'] = $name;
                    $inputs['ipf_excel_base64'] = base64_encode(file_get_contents(public_path() . '\\data\\giahhdvk\\' . $name));
                }
                $model->update($inputs);
                return redirect('tonghopgiahhdvk?&matt=' . $model->matt . '&nam=' . $model->nam . '&phanloai=' . $model->phanloai);
            } else
                return view('errors.perm');
        } else
            return view('errors.notlogin');
    }

    public function hoanthanh(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $id = $inputs['idhoanthanh'];
            $model = ThGiaHhDvK::findOrFail($id);
            $model->trangthai = 'HT';
            $model->save();
            return redirect('tonghopgiahhdvk?&matt=' . $model->matt . '&nam=' . $model->nam . '&phanloai=' . $model->phanloai);
        } else
            return view('errors.notlogin');
    }

    public function huyhoanthanh(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $id = $inputs['idhuyhoanthanh'];
            $model = ThGiaHhDvK::findOrFail($id);
            $model->trangthai = 'CHT';
            $model->save();
            return redirect('tonghopgiahhdvk?&matt=' . $model->matt . '&nam=' . $model->nam . '&phanloai=' . $model->phanloai);
        } else
            return view('errors.notlogin');
    }

    public function congbo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $id = $inputs['idcongbo'];
            $model = ThGiaHhDvK::findOrFail($id);
            $model->congbo = 'CB';
            $model->save();
            return redirect('tonghopgiahhdvk?&matt=' . $model->matt . '&nam=' . $model->nam . '&phanloai=' . $model->phanloai);
        } else
            return view('errors.notlogin');
    }

    function import_excel(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            //Do mã char('A') = 65
            //Chuyển mã A,B,C về 0,1,2,3,...
            $inputs["mahhdv"] = ord(strtoupper($inputs["mahhdv"])) - 65;
            $inputs["loaigia"] = ord(strtoupper($inputs["loaigia"])) - 65;
            $inputs["gialk"] = ord(strtoupper($inputs["gialk"])) - 65;
            $inputs["gia"] = ord(strtoupper($inputs["gia"])) - 65;
            $inputs["nguontt"] = ord(strtoupper($inputs["nguontt"])) - 65;
            $file = $request->file('fexcel');
            $dataObj = new ColectionImport();
            $theArray = Excel::toArray($dataObj, $file);
            //Mặc định lấy Sheet 1
            $data = $theArray[0];
            //dd($theArray[0]);
            //Gán lại dòng
            $inputs['dendong'] = $inputs['dendong'] < count($data) ? count($data) : $inputs['dendong'];
            
            for ($i = $inputs['tudong']-1; $i <= ($inputs['dendong']); $i++) {
                //dd($data[$i]);
                if (!isset($data[$i][$inputs['mahhdv']])) {
                    continue; //Mã hàng hoá rỗng => thoát
                }
                $chitiet = ThGiaHhDvKCt::where('mahs', $inputs['mahs'])->where('mahhdv', $data[$i][$inputs['mahhdv']])->first();
                if ($chitiet != null) {
                    $chitiet->loaigia = $data[$i][$inputs['loaigia']];
                    $chitiet->gia = chkDbl($data[$i][$inputs['gia']]);
                    $chitiet->gialk = chkDbl($data[$i][$inputs['gialk']]);
                    $chitiet->nguontt = $data[$i][$inputs['nguontt']];
                    //dd($chitiet);
                    $chitiet->save();
                }
            }

            return redirect('/giahhdvk/tonghop/edit?mahs=' . $inputs['mahs']);
        } else
            return view('errors.notlogin');
    }
}
