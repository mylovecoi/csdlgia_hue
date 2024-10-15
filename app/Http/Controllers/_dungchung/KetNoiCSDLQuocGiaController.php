<?php

namespace App\Http\Controllers\_dungchung;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use App\DmHhDvK;
use App\DmHhDvK_DonVi;
use App\DmPhiLePhi;
use App\GiaHhDvK;
use App\GiaHhDvKCt;
use App\Model\Api\KetNoiAPI_DanhSach;
use App\Model\Api\KetNoiAPI_HoSo;
use App\Model\Api\KetNoiAPI_HoSo_ChiTiet;
use App\Model\manage\dinhgia\giaspdvci\GiaSpDvCi;
use App\Model\manage\dinhgia\giaspdvci\GiaSpDvCiCt;
use App\Model\manage\dinhgia\giaspdvci\giaspdvcidm;
use App\Model\manage\dinhgia\thuetn\DmThueTn;
use App\Model\manage\dinhgia\thuetn\ThueTaiNguyen;
use App\Model\manage\dinhgia\thuetn\ThueTaiNguyenCt;
use App\Model\manage\kekhaigia\kkcatsan\KkGiaCatSan;
use App\Model\manage\kekhaigia\kkcatsan\KkGiaCatSanCt;
use App\Model\manage\kekhaigia\kkdatsanlap\KkGiaDatSanLap;
use App\Model\manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapCt;
use App\Model\manage\kekhaigia\kkdaxaydung\KkGiaDaXayDung;
use App\Model\manage\kekhaigia\kkdaxaydung\KkGiaDaXayDungCt;
use App\Model\manage\kekhaigia\kkdvch\KkGiaDvCh;
use App\Model\manage\kekhaigia\kkdvch\KkGiaDvChCt;
use App\Model\manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTm;
use App\Model\manage\kekhaigia\kkdvhdtmck\KkGiaDvHdTmCt;
use App\Model\manage\kekhaigia\kkdvlt\KkGiaDvLt;
use App\Model\manage\kekhaigia\kkdvlt\KkGiaDvLtCt;
use App\Model\manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXb;
use App\Model\manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCt;
use App\Model\manage\kekhaigia\kkdvvt\vtxk\GiaVtXk;
use App\Model\manage\kekhaigia\kkdvvt\vtxk\GiaVtXkCt;
use App\Model\manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtx;
use App\Model\manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCt;
use App\Model\manage\kekhaigia\kkgiadvcang\GiaDvCang;
use App\Model\manage\kekhaigia\kkgiadvcang\GiaDvCangCt;
use App\Model\manage\kekhaigia\kkgiadvdlbb\GiaDvDlBb;
use App\Model\manage\kekhaigia\kkgiadvdlbb\GiaDvDlBbCt;
use App\Model\manage\kekhaigia\kkgiaetanol\KkGiaEtanol;
use App\Model\manage\kekhaigia\kkgiaetanol\KkGiaEtanolCt;
use App\Model\manage\kekhaigia\kkgiakcbtn\KkGiaKcbTn;
use App\Model\manage\kekhaigia\kkgiakcbtn\KkGiaKcbTnCt;
use App\Model\manage\kekhaigia\kkgiaotonksx\GiaOtoNkSx;
use App\Model\manage\kekhaigia\kkgiaotonksx\GiaOtoNkSxCt;
use App\Model\manage\kekhaigia\kkgiasach\KkGiaSach;
use App\Model\manage\kekhaigia\kkgiasach\KkGiaSachCt;
use App\Model\manage\kekhaigia\kkgiatacn\KkGiaTaCn;
use App\Model\manage\kekhaigia\kkgiatacn\KkGiaTaCnCt;
use App\Model\manage\kekhaigia\kkgiathan\KkGiaThan;
use App\Model\manage\kekhaigia\kkgiathan\KkGiaThanCt;
use App\Model\manage\kekhaigia\kkgiatpcnte6t\KkGs;
use App\Model\manage\kekhaigia\kkgiatpcnte6t\KkGsCt;
use App\Model\manage\kekhaigia\kkgiavetqkdl\GiaVeTqKdl;
use App\Model\manage\kekhaigia\kkgiavetqkdl\GiaVeTqKdlCt;
use App\Model\manage\kekhaigia\kkgiavlxd\KkGiaVlXd;
use App\Model\manage\kekhaigia\kkgiavlxd\KkGiaVlXdCt;
use App\Model\manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSx;
use App\Model\manage\kekhaigia\kkgiaxemaynksx\GiaXeMayNkSxCt;
use App\Model\manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxd;
use App\Model\manage\kekhaigia\kkgiaxmtxd\KkGiaXmTxdCt;
use App\Model\manage\kekhaigia\kkgiay\KkGiaGiay;
use App\Model\manage\kekhaigia\kkgiay\KkGiaGiayCt;
use App\Model\manage\kekhaigia\kkhplx\KkGiaHpLx;
use App\Model\manage\kekhaigia\kkhplx\KkGiaHpLxCt;
use App\Model\system\danhmucchucnang;
use App\Model\system\dmdvt;
use App\Model\view\view_thgiahhdvk;
use App\PhiLePhi;
use App\PhiLePhiCt;
use App\ThGiaHhDvK;
use App\ThGiaHhDvKCt;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;

class KetNoiCSDLQuocGiaController extends Controller
{
    public function XemHoSo(Request $request)
    {
        // if (!Session::has('admin'))
        //     return view('errors.notlogin');
        $inputs = $request->all();
        //dd($inputs);
        //Xử lý thông tin hồ sơ
        $HoSoAPI = KetNoiAPI_HoSo::where('maso', $inputs['maso'])->orderby('stt')->get();
        $HoSoChiTietAPI = KetNoiAPI_HoSo_ChiTiet::where('maso', $inputs['maso'])->orderby('stt')->get();
        if ($HoSoAPI->count() == 0) {
            return array(
                'error_code' => '-1',
                'result' => null,
                'message' => 'Hồ sơ chưa được thiết lập các trường dữ liệu. Bạn hãy thiết lập hệ thống API cho chức năng này.',
            );
        }
        $m_HoSo = null;
        $m_HoSoChiTiet = null;
        $this->getHoSo($m_HoSo, $m_HoSoChiTiet, $inputs['maso'], $inputs['mahs']);

        $a_Body = [];
        //dd($m_HoSoChiTiet);
        foreach ($m_HoSo as $HoSo) {
            $a_HoSo = [];

            //File đính kèm cho hồ sơ kê khai giá dịch vụ công ích, ...
            if ($HoSo->ipf1 != '' && $HoSoAPI->wherein('tendong', ['FILE_DINH_KEM',])->count() > 0) {
                $path = public_path(getDuongDanThuMuc($inputs['chucnang'])) . $HoSo->ipf1;
                $type = pathinfo($path, PATHINFO_EXTENSION);
                switch ($type) {
                    case 'doc':
                    case 'docx':
                    case 'pdf': {
                            $data = file_get_contents($path);
                            $base64 =  base64_encode($data);
                            $a_HoSo['FILE_DINH_KEM'] = $base64;
                            break;
                        }
                }
            }

            foreach ($HoSoAPI as $TenDong) {
                //xử lý mảng chi tiết trc
                if (substr($TenDong->tendong, 0, 3) == 'DS_') {
                    $a_HSChiTiet = array();
                    foreach ($m_HoSoChiTiet as $HSChiTiet) {
                        $a_ChiTiet = array();
                        foreach ($HoSoChiTietAPI->where('tendong_goc', $TenDong->tendong) as $Dong) {
                            //dd($Dong);
                            $tenTruongCT = $Dong->tentruong;
                            if ($tenTruongCT == 'NULL') {
                                $a_ChiTiet[$Dong->tendong] = $this->getMacDinh($Dong->macdinh, $HoSo, $HSChiTiet);
                            } else {
                                $giatri = $HSChiTiet->$tenTruongCT;
                                //Nếu giá trị '' và giá trị mặc định != '' =>lấy mặc định
                                if ($giatri == '' && $Dong->macdinh != '') {
                                    $giatri = $Dong->macdinh;
                                }
                                //gán giá trị          

                                $a_ChiTiet[$Dong->tendong] = $giatri;
                            }
                            //Gán lại kiểu dữ liệu

                            switch ($Dong->kieudulieu) {
                                case "NUMBER": {
                                        $a_ChiTiet[$Dong->tendong] = (float)chkDbl($a_ChiTiet[$Dong->tendong]);
                                        break;
                                    }
                                default: {
                                        $a_ChiTiet[$Dong->tendong] = isset($a_ChiTiet[$Dong->tendong]) ? $a_ChiTiet[$Dong->tendong] : "";
                                    }
                            }
                        }
                        $a_HSChiTiet[] = $a_ChiTiet;
                    }
                    //dd($a_HSChiTiet);
                    $a_HoSo[$TenDong->tendong] = $a_HSChiTiet;
                    continue;
                }

                //Xử lý các trường còn lại
                $tenTruong = $TenDong->tentruong;

                if ($tenTruong == 'NULL') {
                    $a_HoSo[$TenDong->tendong] = $this->getMacDinh($TenDong->macdinh, $HoSo);
                } else {
                    $giatri = $HoSo->$tenTruong;
                    //Nếu giá trị '' và giá trị mặc định != '' =>lấy mặc định
                    if ($giatri == '' && $TenDong->macdinh != '') {
                        $giatri = $TenDong->macdinh;
                    }
                    //gán giá trị
                    $a_HoSo[$TenDong->tendong] = $giatri;
                }
                //Kiểm tra kiểu dữ liệu                                
                switch ($TenDong->kieudulieu) {
                    case "NUMBER": {
                            $a_HoSo[$TenDong->tendong] = (float)chkDbl($a_HoSo[$TenDong->tendong]);
                            break;
                        }
                    default: {
                            $a_HoSo[$TenDong->tendong] = isset($a_HoSo[$TenDong->tendong]) ? $a_HoSo[$TenDong->tendong] : "";
                        }
                }
            }
            $a_Body[] = $a_HoSo;
        }

        //if (in_array(substr($inputs['maso'], 0, 2), ['dm', 'ds']))           
        return json_encode(["data" => $a_Body], JSON_UNESCAPED_UNICODE);
    }

    /*
    2024.02.26
    đổi Content-Type về application/x-www-form-urlencoded
    */
    public function send_post_cu(Request $request)
    {
        if (!Session::has('admin'))
            return view('errors.notlogin');

        $inputs = $request->all();
        //dd($inputs);
        $result = array(
            'error_code' => '-1',
            'result' => null,
            'message' => 'Thao tác không hoàn thành.',
        );

        $string_bear = 'Bearer ';
        switch (session('admin')->phanloaiketnoi) {
            case 'CHUOIKETNOI': {
                    //   dd($inputs);
                    $headers = [
                        'Content-Type: application/x-www-form-urlencoded',
                        'lgspaccesstoken: ' . $inputs['token_ketnoi'],
                    ];
                    $data = 'grant_type=client_credentials';

                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $inputs['linkAPIXacthuc'],
                        CURLOPT_RETURNTRANSFER => true,
                        // CURLOPT_ENCODING => '',
                        // CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 20,
                        // CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => $data,
                        CURLOPT_HTTPHEADER => $headers,
                    ));

                    $response = curl_exec($curl);
                    $errno = curl_errno($curl);
                    // dd($errno);
                    if ($errno == 0 && json_decode($response) != null) { //Ko có lỗi                        
                        curl_close($curl);
                        $string_bear .= json_decode($response)->access_token;
                    } else {
                        return view('errors.403')
                            ->with('message', 'Không thể lấy thông tin từ LGSP (Mã lỗi: ' . $errno . ').')
                            ->with('url', $inputs['url']);
                    }
                    break;
                }
        }

        //Xử lý thông tin hồ sơ
        $HoSoAPI = KetNoiAPI_HoSo::where('maso', $inputs['chucnang'])->orderby('stt')->get();
        $HoSoChiTietAPI = KetNoiAPI_HoSo_ChiTiet::where('maso', $inputs['chucnang'])->orderby('stt')->get();
        //dd($HoSoChiTietAPI);
        if ($HoSoAPI->count() == 0) {
            return view('errors.403')
                ->with('message', 'Hồ sơ chưa được thiết lập các trường dữ liệu. Bạn hãy thiết lập hệ thống API cho chức năng này.')
                ->with('url', $inputs['url']);
        }
        $m_HoSo = null;
        $m_HoSoChiTiet = null;
        $this->getHoSo($m_HoSo, $m_HoSoChiTiet, $inputs['chucnang'], $inputs['mahs']);
        $a_Body = [];

        foreach ($m_HoSo as $HoSo) {
            $a_HoSo = [];
            //File đính kèm cho hồ sơ kê khai giá thị trường
            // if ($HoSo->ipf1 != '' && $HoSoAPI->wherein('tendong', ['FILE_DINH_KEM_WORD', 'FILE_DINH_KEM_PDF'])->count() > 0) {
            //     $path = public_path(getDuongDanThuMuc($inputs['chucnang'])) . $HoSo->ipf1;
            //     $type = pathinfo($path, PATHINFO_EXTENSION);
            //     switch ($type) {
            //         case 'doc':
            //         case 'docx': {
            //                 $data = file_get_contents($path);
            //                 $base64 =  base64_encode($data);
            //                 $a_HoSo['FILE_DINH_KEM_WORD'] = $base64;
            //                 break;
            //             }
            //         case 'pdf': {
            //                 $data = file_get_contents($path);
            //                 $base64 =  base64_encode($data);
            //                 $a_HoSo['FILE_DINH_KEM_PDF'] = $base64;
            //                 break;
            //             }
            //     }
            // }

            //File đính kèm cho hồ sơ kê khai giá dịch vụ công ích, ...
            if ($HoSo->ipf1 != '' && $HoSoAPI->wherein('tendong', ['FILE_DINH_KEM',])->count() > 0) {
                $path = public_path(getDuongDanThuMuc($inputs['chucnang'])) . $HoSo->ipf1;
                $type = pathinfo($path, PATHINFO_EXTENSION);
                switch ($type) {
                    case 'doc':
                    case 'docx':
                    case 'pdf': {
                            $data = file_get_contents($path);
                            $base64 =  base64_encode($data);
                            $a_HoSo['FILE_DINH_KEM'] = $base64;
                            break;
                        }
                }
            }

            foreach ($HoSoAPI as $TenDong) {
                //xử lý mảng chi tiết trc
                if (substr($TenDong->tendong, 0, 3) == 'DS_') {
                    $a_HSChiTiet = array();
                    foreach ($m_HoSoChiTiet as $HSChiTiet) {
                        $a_ChiTiet = array();
                        foreach ($HoSoChiTietAPI->where('tendong_goc', $TenDong->tendong) as $Dong) {
                            $tenTruongCT = $Dong->tentruong;
                            if ($tenTruongCT == 'NULL') {
                                $a_ChiTiet[$Dong->tendong] = $this->getMacDinh($Dong->macdinh, $HoSo, $HSChiTiet);
                            } else {
                                $giatri = $HSChiTiet->$tenTruongCT;
                                //Nếu giá trị '' và giá trị mặc định != '' =>lấy mặc định
                                if ($giatri == '' && $Dong->macdinh != '') {
                                    $giatri = $Dong->macdinh;
                                }
                                //gán giá trị
                                $a_ChiTiet[$Dong->tendong] = $giatri;
                            }
                            //dd($a_ChiTiet);
                        }
                        $a_HSChiTiet[] = $a_ChiTiet;
                    }
                    //dd($a_HSChiTiet);
                    $a_HoSo[$TenDong->tendong] = $a_HSChiTiet;
                    continue;
                }

                //Xử lý các trường còn lại
                $tenTruong = $TenDong->tentruong;

                if ($tenTruong == 'NULL') {
                    $a_HoSo[$TenDong->tendong] = $this->getMacDinh($TenDong->macdinh, $HoSo);
                } else {
                    $giatri = $HoSo->$tenTruong;
                    //Nếu giá trị '' và giá trị mặc định != '' =>lấy mặc định
                    if ($giatri == '' && $TenDong->macdinh != '') {
                        $giatri = $TenDong->macdinh;
                    }
                    //gán giá trị
                    $a_HoSo[$TenDong->tendong] = $giatri;
                }
            }
            $a_Body[] = $a_HoSo;
        }

        //Truyền số liệu
        $a_Header = [
            'Content-Type: application/json',
            'lgspaccesstoken: ' . $inputs['token_ketnoi'],
            'Authorization: ' . $string_bear
        ];
        dd(json_encode(['data' => $a_Body[0]]));

        $curl = curl_init($inputs['linkTruyenPost']);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        /* 2023.01.04
        if (in_array(substr($inputs['chucnang'], 0, 2), ['dm', 'ds']))
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($a_Body ?? null));
        else
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($a_Body[0] ?? null));
        */
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(['data' => $a_Body[0]]));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $a_Header);
        $result = curl_exec($curl);

        curl_close($curl);
        // dd($result);
        if ($result == false) {
            $result = json_encode(array(
                'error_code' => '-1',
                'result' => null,
                'message' => 'Đường dẫn kết nối API không tồn tại.',
            ));
        }
        //Lưu lại link API
        KetNoiAPI_DanhSach::where('maso', $inputs['chucnang'])->update(['linkTruyenPost' => $inputs['linkTruyenPost']]);
        $result = json_decode($result);

        //Trường hợp mã trả lại từ sever là string html
        // if (!is_array($result)) {
        //     return view('errors.html_entity_decode')
        //         ->with('result', $result);
        // }

        if ($result->error_code == '-1') {
            return view('errors.403')
                ->with('message', $result->message)
                ->with('url', $inputs['url']);
        } else {
            return view('errors.success')
                ->with('message', $result->message)
                ->with('url', $inputs['url']);
        }
    }

    public function send_post(Request $request)
    {
        if (!Session::has('admin'))
            return view('errors.notlogin');

        $inputs = $request->all();
        //dd($inputs);
        $result = array(
            'error_code' => '-1',
            'result' => null,
            'message' => 'Thao tác không hoàn thành.',
        );

        $string_bear = 'Bearer ';
        switch (session('admin')->phanloaiketnoi) {
            case 'CHUOIKETNOI': {
                    //   dd($inputs);
                    $headers = [
                        'Content-Type: application/x-www-form-urlencoded',
                        'lgspaccesstoken: ' . $inputs['token_ketnoi'],
                    ];
                    $data = 'grant_type=client_credentials';

                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $inputs['linkAPIXacthuc'],
                        CURLOPT_RETURNTRANSFER => true,
                        // CURLOPT_ENCODING => '',
                        // CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 20,
                        // CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => $data,
                        CURLOPT_HTTPHEADER => $headers,
                    ));

                    $response = curl_exec($curl);
                    $errno = curl_errno($curl);
                    // dd($errno);
                    if ($errno == 0 && json_decode($response) != null) { //Ko có lỗi                        
                        curl_close($curl);
                        $string_bear .= json_decode($response)->access_token;
                    } else {
                        return view('errors.403')
                            ->with('message', 'Không thể lấy thông tin từ LGSP (Mã lỗi: ' . $errno . ').')
                            ->with('url', $inputs['url']);
                    }
                    break;
                }
        }

        //Xử lý thông tin hồ sơ
        $HoSoAPI = KetNoiAPI_HoSo::where('maso', $inputs['chucnang'])->orderby('stt')->get();
        $HoSoChiTietAPI = KetNoiAPI_HoSo_ChiTiet::where('maso', $inputs['chucnang'])->orderby('stt')->get();
        //dd($HoSoChiTietAPI);
        if ($HoSoAPI->count() == 0) {
            return view('errors.403')
                ->with('message', 'Hồ sơ chưa được thiết lập các trường dữ liệu. Bạn hãy thiết lập hệ thống API cho chức năng này.')
                ->with('url', $inputs['url']);
        }
        $m_HoSo = null;
        $m_HoSoChiTiet = null;
        $this->getHoSo($m_HoSo, $m_HoSoChiTiet, $inputs['chucnang'], $inputs['mahs']);
        $a_Body = [];

        foreach ($m_HoSo as $HoSo) {
            $a_HoSo = [];
            //File đính kèm cho hồ sơ kê khai giá dịch vụ công ích, ...
            if ($HoSo->ipf1 != '' && $HoSoAPI->wherein('tendong', ['FILE_DINH_KEM',])->count() > 0) {
                $path = public_path(getDuongDanThuMuc($inputs['chucnang'])) . $HoSo->ipf1;
                $type = pathinfo($path, PATHINFO_EXTENSION);
                switch ($type) {
                    case 'doc':
                    case 'docx':
                    case 'pdf': {
                            $data = file_get_contents($path);
                            $base64 =  base64_encode($data);
                            $a_HoSo['FILE_DINH_KEM'] = $base64;
                            break;
                        }
                }
            }

            foreach ($HoSoAPI as $TenDong) {
                //xử lý mảng chi tiết trc
                if (substr($TenDong->tendong, 0, 3) == 'DS_') {
                    $a_HSChiTiet = array();
                    foreach ($m_HoSoChiTiet as $HSChiTiet) {
                        $a_ChiTiet = array();
                        foreach ($HoSoChiTietAPI->where('tendong_goc', $TenDong->tendong) as $Dong) {
                            $tenTruongCT = $Dong->tentruong;
                            if ($tenTruongCT == 'NULL') {
                                $a_ChiTiet[$Dong->tendong] = $this->getMacDinh($Dong->macdinh, $HoSo, $HSChiTiet);
                            } else {
                                $giatri = $HSChiTiet->$tenTruongCT;
                                //Nếu giá trị '' và giá trị mặc định != '' =>lấy mặc định
                                if ($giatri == '' && $Dong->macdinh != '') {
                                    $giatri = $Dong->macdinh;
                                }
                                //gán giá trị
                                $a_ChiTiet[$Dong->tendong] = $giatri;
                            }

                            //Gán lại kiểu dữ liệu
                            switch ($Dong->kieudulieu) {
                                case "NUMBER": {
                                        $a_ChiTiet[$Dong->tendong] = (float)chkDbl($a_ChiTiet[$Dong->tendong]);
                                        break;
                                    }
                                default: {
                                        $a_ChiTiet[$Dong->tendong] = isset($a_ChiTiet[$Dong->tendong]) ? $a_ChiTiet[$Dong->tendong] : "";
                                    }
                            }
                        }
                        $a_HSChiTiet[] = $a_ChiTiet;
                    }
                    //dd($a_HSChiTiet);
                    $a_HoSo[$TenDong->tendong] = $a_HSChiTiet;
                    continue;
                }

                //Xử lý các trường còn lại
                $tenTruong = $TenDong->tentruong;

                if ($tenTruong == 'NULL') {
                    $a_HoSo[$TenDong->tendong] = $this->getMacDinh($TenDong->macdinh, $HoSo);
                } else {
                    $giatri = $HoSo->$tenTruong;
                    //Nếu giá trị '' và giá trị mặc định != '' =>lấy mặc định
                    if ($giatri == '' && $TenDong->macdinh != '') {
                        $giatri = $TenDong->macdinh;
                    }
                    //gán giá trị
                    $a_HoSo[$TenDong->tendong] = $giatri;
                }
                //Kiểm tra kiểu dữ liệu                                
                switch ($TenDong->kieudulieu) {
                    case "NUMBER": {
                            $a_HoSo[$TenDong->tendong] = (float)chkDbl($a_HoSo[$TenDong->tendong]);
                            break;
                        }
                    default: {
                            $a_HoSo[$TenDong->tendong] = isset($a_HoSo[$TenDong->tendong]) ? $a_HoSo[$TenDong->tendong] : "";
                        }
                }
            }
            $a_Body[] = $a_HoSo;
        }

        //Truyền số liệu
        $a_Header = [
            // 'Content-Type: application/x-www-form-urlencoded',
            'Content-Type: application/json',
            'lgspaccesstoken: ' . $inputs['token_ketnoi'],
            'Authorization: ' . $string_bear
        ];

        return json_encode(["data" => $a_Body], JSON_UNESCAPED_UNICODE);
        //File::put(public_path(). '/data/chuyentubase64/TT116.docx' , base64_decode($a_Body[0]['FILE_DINH_KEM_PDF']));        
        //dd($a_Body[0]['FILE_DINH_KEM_PDF']);

        $curl = curl_init($inputs['linkTruyenPost']);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(["data" => $a_Body])); //cho Content-Type: application/json
        //curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(['data'=>$a_Body[0]]));// 'Content-Type: application/x-www-form-urlencoded',
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $a_Header);
        $result = curl_exec($curl);
        $errno = curl_errno($curl);
        curl_close($curl);
        // dd($result);
        // if ($result == false) {
        //     $result = json_encode(array(
        //         'error_code' => '-1',
        //         'result' => null,
        //         'message' => 'Đường dẫn kết nối API không tồn tại.',
        //     ));
        // }
        //Lưu lại link API
        KetNoiAPI_DanhSach::where('maso', $inputs['chucnang'])->update(['linkTruyenPost' => $inputs['linkTruyenPost']]);

        if ($errno > 0) {
            return view('errors.403')
                ->with('message', "Lỗi kêt nối đến trục LGSP (Mã lỗi: " . $errno . ")")
                ->with('url', $inputs['url']);
        } else {
            //Trường hợp mã trả lại từ sever là string html
            if (!is_array($result)) {
                return view('errors.html_entity_decode')
                    ->with('result', $result);
            }

            $result = json_decode($result);
            if ($result->error_code == '-1') {
                return view('errors.403')
                    ->with('message', $result->message)
                    ->with('url', $inputs['url']);
            } else {

                return view('errors.success')
                    ->with('message', $result->message)
                    ->with('url', $inputs['url']);
            }
        }
    }

    function getHoSo(&$HoSo, &$HoSoChiTiet, $ChucNang, $mahs)
    {
        switch ($ChucNang) {
            case 'giahhdvk': {
                    $HoSo = ThGiaHhDvK::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else {
                        $HoSoChiTiet = view_thgiahhdvk::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                        $a_dvt = array_column(dmdvt::all()->toArray(),  'madvt', 'dvt');
                        foreach ($HoSoChiTiet as $ct) {
                            $ct->dvt = $a_dvt[$ct->dvt] ?? $ct->dvt;
                            $ct->loaigia = $this->getLOAI_GIA($ct->loaigia);
                            $ct->nguontt = $this->getNGUON_THONG_TIN($ct->nguontt);
                        }
                    }
                    // $HoSoChiTiet = view_thgiahhdvk::where('mahs', array_column($HoSo->toarray(), 'mahs'))->take(20)->get();
                    break;
                }
            case 'vlxd': {
                    $HoSo = KkGiaVlXd::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGiaVlXdCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'xmtxd': {
                    $HoSo = KkGiaXmTxd::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGiaXmTxdCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'dvhdtmck': {
                    $HoSo = KkGiaDvHdTm::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGiaDvHdTmCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'than': {
                    $HoSo = KkGiaThan::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGiaThanCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'tacn': {
                    $HoSo = KkGiaTaCn::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGiaTaCnCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'giay': {
                    $HoSo = KkGiaGiay::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGiaGiayCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'sach': {
                    $HoSo = KkGiaSach::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGiaSachCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'etanol': {
                    $HoSo = KkGiaEtanol::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGiaEtanolCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'dvcb': {
                    $HoSo = GiaDvCang::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = GiaDvCangCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'oto': {
                    $HoSo = GiaOtoNkSx::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = GiaOtoNkSxCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'xemay': {
                    $HoSo = GiaXeMayNkSx::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = GiaXeMayNkSxCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'kcbtn': {
                    $HoSo = KkGiaKcbTn::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGiaKcbTnCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'dvvtxk': {
                    $HoSo = GiaVtXk::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = GiaVtXkCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'dvvtxb': {
                    $HoSo = KkGiaVtXb::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGiaVtXbCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'dvvtxtx': {
                    $HoSo = KkGiaVtXtx::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGiaVtXtxCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'dvvthk': {
                    $HoSo = GiaVtXk::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = GiaVtXkCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'tpcnte6t': {
                    $HoSo = KkGs::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGsCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'dvlt': {
                    $HoSo = KkGiaDvLt::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGiaDvLtCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'dlbb': {
                    $HoSo = GiaDvDlBb::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = GiaDvDlBbCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'tqkdl': {
                    $HoSo = GiaVeTqKdl::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = GiaVeTqKdlCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'cahue': {
                    $HoSo = KkGiaDvCh::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGiaDvChCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'hocphilx': {
                    $HoSo = KkGiaHpLx::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGiaHpLxCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'catsan': {
                    $HoSo = KkGiaCatSan::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGiaCatSanCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'datsanlap': {
                    $HoSo = KkGiaDatSanLap::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGiaDatSanLapCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'daxaydung': {
                    $HoSo = KkGiaDaXayDung::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = KkGiaDaXayDungCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }

            case 'giaphilephi': {
                    $HoSo = PhiLePhi::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = PhiLePhiCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'giathuetn': {
                    $HoSo = ThueTaiNguyen::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = ThueTaiNguyenCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    //Do không update data
                    foreach ($HoSoChiTiet as $key => $ct) {
                        if ($ct->gia <= 0) {
                            $HoSoChiTiet->forget($key);
                            continue;
                        }

                        // $ct->mathuetn = $ct->cap1;
                        // $ct->mathuetn .= $ct->cap2 != '' ? ('.' . $ct->cap2) : '';
                        // $ct->mathuetn .= $ct->cap3 != '' ? ('.' . $ct->cap3) : '';
                        // $ct->mathuetn .= $ct->cap4 != '' ? ('.' . $ct->cap4) : '';
                        // $ct->mathuetn .= $ct->cap5 != '' ? ('.' . $ct->cap5) : '';
                        $ct->mathuetn = $ct->cap1;
                        $ct->mathuetn = $ct->cap2 != '' ? $ct->cap2 : $ct->mathuetn;
                        $ct->mathuetn = $ct->cap3 != '' ? $ct->cap3 : $ct->mathuetn;
                        $ct->mathuetn = $ct->cap4 != '' ? $ct->cap4 : $ct->mathuetn;
                        $ct->mathuetn = $ct->cap5 != '' ? $ct->cap5 : $ct->mathuetn;
                    }

                    break;
                }
            case 'dmgiahhdvk': {
                    $HoSo = DmHhDvK::where('matt', $mahs)->get();
                    $a_dvt = array_column(dmdvt::all()->toArray(),  'madvt', 'dvt');
                    foreach ($HoSo as $ct) {
                        $ct->dvt = $a_dvt[$ct->dvt] ?? $ct->dvt;
                        //$ct->manhom = (string)intval($ct->manhom);
                    }
                    $HoSoChiTiet = null;
                    break;
                }
            case 'dmgiathuetn': {
                    $HoSo = DmThueTn::where('manhom', $mahs)->get();
                    $HoSoChiTiet = null;
                    break;
                }
            case 'dmgiaspdvci': {
                    $HoSo = giaspdvcidm::all();
                    $HoSoChiTiet = null;
                    break;
                }
            case 'giaspdvci': {
                    $HoSo = GiaSpDvCi::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = GiaSpDvCiCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                    break;
                }
            case 'dmgiaphilephi': {
                    $HoSo = DmPhiLePhi::all();
                    $HoSoChiTiet = null;
                    break;
                }
        }
    }

    function getLOAI_GIA($giatri)
    {
        $aKQ = ["Giá bán buôn" => 10, "Giá bán lẻ" => 5];
        return $aKQ[$giatri] ?? 5;
    }

    function getNGUON_THONG_TIN($giatri)
    {
        $aKQ = [
            "Do trực tiếp điều tra, thu thập" => 1,
            "Do cơ quan/đơn vị quản lý nhà nước có liên quan cung cấp/báo cáo theo quy định" => 2,
            "Từ thống kê đăng ký giá, kê khai giá, thông báo giá của doanh nghiệp" => 3,
            "Hợp đồng mua tin" => 4,
            "Các nguồn thông tin khác" => 5,
        ];
        return $aKQ[$giatri] ?? 2;
    }

    function getMacDinh($giatri, $HoSo, $HoSoChiTiet = null)
    {
        //dd($HoSo);
        $kQ = $giatri;
        switch ($giatri) {
            case 'GET_DIABAN': {
                    $kQ = session('admin')->madiaban_ketnoi;
                    break;
                }
            case 'GET_NGUONTT': {
                    $kQ = session('admin')->madonvithuthap;
                    break;
                }
            case 'GET_LOAIGIA': {

                    $kQ = session('admin')->madonvithuthap;
                    break;
                }
            case 'GET_SOLIEU': {
                    $kQ = session('admin')->madonvithuthap;
                    break;
                }
            case 'MA_HHDV': {
                    $kQ = chuanhoachuoi($HoSoChiTiet->tendvcu);
                    break;
                }
            case 'GET_MA_HHDV': {

                    break;
                }
            case 'GET_TEN_HHDV': {
                    $HangHoa = DmHhDvK::where('mahhdv', $HoSoChiTiet->mahhdv)->first();
                    $kQ = $HangHoa->tenhhdv ?? '';
                    break;
                }
            case 'GET_DVT_HHDV': {
                    $HangHoa = DmHhDvK::where('mahhdv', $HoSoChiTiet->mahhdv)->first();
                    $kQ = 'DVT347';
                    // Xây dựng lại danh mục đơn vị tính
                    // $kQ = $HangHoa->dvt ?? '';DVT347
                    break;
                }
            case 'GET_NGUONTT': {
                    $kQ = '2'; //sau làm hàm
                    break;
                }
        }
        return $kQ;
    }

    function getThongDiep($tendong, $macdinh, $giatri, $server)
    {
        $kQ = $macdinh;
        switch ($tendong) {
            case 'Sender_Code': {
                    $kQ = $giatri['maso'];
                    break;
                }
            case 'Sender_Name': {
                    $ChucNang = danhmucchucnang::where('maso', $giatri['maso'])->first();
                    $kQ = $ChucNang->menu ?? $giatri['maso'];
                    break;
                }
            case 'Receiver_Code': {

                    break;
                }
            case 'Receiver_Name': {

                    break;
                }
            case 'Tran_Code': {
                    $kQ = 'JSON';
                    break;
                }
            case 'Tran_Name': {
                    $kQ = 'JSON';
                    break;
                }
            case 'Msg_ID': {
                    $kQ = $server['REDIRECT_STATUS'];
                    break;
                }
            case 'Msg_RefID': {
                    $kQ = $server['REDIRECT_STATUS'];
                    break;
                }
            case 'Send_Date': {
                    $kQ = date('Y-m-d H:i:s');
                    break;
                }
            case 'Original_Code': {
                    $kQ = '93'; //Hậu Giang
                    break;
                }
            case 'Original_name': {
                    $kQ = getGeneralConfigs()['diadanh'] ?? '';
                    break;
                }
            case 'Export_Date': {
                    $kQ = date('Y-m-d H:i:s');
                    break;
                }
            case 'Notes': {

                    break;
                }
            case 'Tran_Num': {
                    $kQ = $giatri['i'];
                    break;
                }
            case 'Path': {
                    $kQ = $server['REDIRECT_URL'] ?? '';
                    break;
                }
            case 'NumMsg_InGroup': {

                    break;
                }
            case 'SPARE1': {

                    break;
                }
            case 'SPARE2': {

                    break;
                }
            case 'SPARE3': {

                    break;
                }
            case 'Finish_Code': {

                    break;
                }
        }
        return $kQ;
    }
}
