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
use App\PhiLePhi;
use App\PhiLePhiCt;
use App\ThGiaHhDvK;
use App\ThGiaHhDvKCt;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class KetNoiCSDLQuocGiaController extends Controller
{
    public function XemHoSo(Request $request)
    {
        // if (!Session::has('admin'))
        //     return view('errors.notlogin');
        $inputs = $request->all();
        //dd($inputs);
        //Xử lý thông tin hồ sơ
        $HoSoAPI = KetNoiAPI_HoSo::where('maso', $inputs['maso'])->get();
        $HoSoChiTietAPI = KetNoiAPI_HoSo_ChiTiet::where('maso', $inputs['maso'])->get();
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
            $i = 0;
            $a_HoSo = [];
            //File đính kèm cho hồ sơ kê khai giá thị trường
            if ($HoSo->ipf1 != '' && $HoSoAPI->wherein('tendong', ['FILE_DINH_KEM_WORD', 'FILE_DINH_KEM_PDF'])->count() > 0) {
                $path = public_path(getDuongDanThuMuc($inputs['maso'])) . $HoSo->ipf1;
                $type = pathinfo($path, PATHINFO_EXTENSION);
                switch ($type) {
                    case 'doc':
                    case 'docx': {
                            $data = file_get_contents($path);
                            $base64 =  base64_encode($data);
                            $a_HoSo['FILE_DINH_KEM_WORD'] = $base64;
                            break;
                        }
                    case 'pdf': {
                            $data = file_get_contents($path);
                            $base64 =  base64_encode($data);
                            $a_HoSo['FILE_DINH_KEM_PDF'] = $base64;
                            break;
                        }
                }
            }

            foreach ($HoSoAPI as $TenDong) {
                //xử lý mảng chi tiết trc
                if (substr($TenDong->tendong, 0, 3) == 'DS_') {
                    $a_HSChiTiet = array();
                    foreach ($m_HoSoChiTiet as $HSChiTiet) {
                        $i++;
                        $a_ChiTiet = array();
                        foreach ($HoSoChiTietAPI->where('tendong_goc', $TenDong->tendong) as $Dong) {
                            $tenTruongCT = $Dong->tentruong;
                            if ($tenTruongCT == 'NULL') {
                                $a_ChiTiet[$Dong->tendong] = $this->getMacDinh($Dong->macdinh, $HoSo, $HSChiTiet);
                            } else {
                                $a_ChiTiet[$Dong->tendong] = $HSChiTiet->$tenTruongCT;
                            }
                            //dd($a_ChiTiet);
                        }
                        $a_HSChiTiet[$i] = $a_ChiTiet;
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
                    $a_HoSo[$TenDong->tendong] = $HoSo->$tenTruong;
                }
            }
            $a_Body[] = $a_HoSo;
        }
        if (in_array(substr($inputs['maso'], 0, 2), ['dm', 'ds']))
            return json_encode($a_Body ?? null);
        else
            return json_encode($a_Body[0] ?? null);
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

        $string_bear = '';
        switch (session('admin')->phanloaiketnoi) {
            case 'CHUOIKETNOI': {
                    $client = new  Client();
                    $headers = ['Content-Type' => 'application/x-www-form-urlencoded', 'lgspaccesstoken' => 'ewoiQWNjZXNzS2V5IjoiQlRDVFJNQkJUQUpCSklORUJMQlIiLAoiU2VjcmV0S2V5IjoiQWNIT0JNWUNUU0dIYUFBU1dSTVlCQktjYlpRS0ZYIiwKIkFwcE5hbWUiOiJDU0RMX0dJQV9TVEMiLAoiUGFydG5lckNvZGUiOiIwLjAuSDMwIiwKIlBhcnRuZXJDb2RlQ3VzIjoiMC4wLkgzMCIKfQ=='];
                    $body = array('grant_type' => 'client_credentials');
                    $Nbody = json_encode($body);
                    $response = $client->post('https://123.30.159.54/csdl_gia_token', $headers, $Nbody, );
                    dd($response->getStatusCode());

                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://lgsp.haugiang.gov.vn/csdl_gia_token',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
                        CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json',
                            'lgspaccesstoken: ewoiQWNjZXNzS2V5IjoiQlRDVFJNQkJUQUpCSklORUJMQlIiLAoiU2VjcmV0S2V5IjoiQWNIT0JNWUNUU0dIYUFBU1dSTVlCQktjYlpRS0ZYIiwKIkFwcE5hbWUiOiJDU0RMX0dJQV9TVEMiLAoiUGFydG5lckNvZGUiOiIwLjAuSDMwIiwKIlBhcnRuZXJDb2RlQ3VzIjoiMC4wLkgzMCIKfQ=='
                        ),
                    ));

                    $response = curl_exec($curl);
                    $errno = curl_errno($curl);
                    curl_close($curl);
                    //print_r($response);
                    dd($response);

                    // $curl = curl_init();
                    // curl_setopt_array($curl, array(
                    //     CURLOPT_URL => 'https://www.google.com/',
                    //     CURLOPT_RETURNTRANSFER => true,
                    //     CURLOPT_SSL_VERIFYPEER => true,
                    //     CURLOPT_CUSTOMREQUEST => 'GET'
                    // ));
                    // $response = curl_exec($curl);
                    // dd($response);
                    // print_r($response);



                    // //Lấy _token để truyền dữ liệu
                    // $curl = curl_init($inputs['linkAPIXacthuc']);
                    // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    // curl_setopt($curl, CURLOPT_HEADER, true);
                    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                    // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    // curl_setopt($curl, CURLOPT_HTTPHEADER, [
                    //     'Content-Type' => 'application/x-www-form-urlencoded',
                    //     'lgspaccesstoken' => $inputs['token_ketnoi'],
                    // ]);
                    // //curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
                    // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(['grant_type' => 'client_credentials'])); //Gán thêm theo mẫu API hậu giang

                    // //dd($curl);
                    // $result = curl_exec($curl);
                    // curl_close($curl);
                    // dd($result);

                    $headers = [
                        "Content-Type: application/x-www-form-urlencode",
                        "lgspaccesstoken: " . $inputs['token_ketnoi'],
                    ];
                    $data = [
                        "grant_type" => 'client_credentials',
                    ];
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $inputs['linkAPIXacthuc'],
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_POST => true,
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_POSTFIELDS => http_build_query($data)
                    ));
                    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                    //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                    dd($headers);
                    $response = curl_exec($curl);
                    $errno = curl_errno($curl);

                    curl_close($curl);
                    dd($response);
                    dd($errno);
                    break;
                }
        }
        dd($inputs);

        if (session('admin')->phanloaiketnoi == 'CHUOIKETNOI') {
            $a_Header['value'] = $inputs['token_ketnoi'];
        } else {
            $curl = curl_init($inputs['linkAPIXacthuc']);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            //
            $a_headers = [];
            $a_headers[] = 'Content-Type: application/x-www-form-urlencoded';
            $a_headers[] = 'Authorization: Basic ' . base64_encode($inputs['accesskey'] . ':' . $inputs['secretkey']);
            //dd($a_headers);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $a_headers);
            $result = curl_exec($curl);
            curl_close($curl);
            dd($result);

            /* Ví dụ đã chạy
$request->addHeader("Authorization: Bearer $jwt");

Authorization: Giá trị “Basic Base64.encodeBase64(consumerkey + ":" + consumersecret)”
Ví dụ: 
“Basic MU56THpqdElvclBTNmhhcEtXSENlTmhnZkxrYTprSG02WUZhTm0xVGp1S0FmQmZDc19aU1pPc3dh”


            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://nguoicocong.lifesc.vn:81/api/getListDistricts',                
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_POSTFIELDS => http_build_query(array(
                    'SecretKey' => '123456',
                    'Username' => 'minhtran',
                ))
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            */
            $token_xacthuc = '';
            /* Chờ xem kiểu trả về của LGSP tỉnh

            https://api.ngsp.gov.vn/token
            2.1.5	Dữ liệu mẫu
            {
                "access_token": "d32ed548-e44c-350c-b047-c10f829064fb",
                "scope": "am_application_scope default",
                "token_type": "Bearer",
                "expires_in": 3600
            }



            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $inputs['linkAPIXacthuc],                
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_POSTFIELDS => http_build_query(array(
                    'Username' => $inputs['taikhoanketnoi],
                    'Password' => $inputs['matkhauketnoi],
                ))
            ));
            $resp = curl_exec($curl);
            curl_close($curl);            
            dd($resp);
            $a_Header['value'] = $token_xacthuc;
            */
            //Tuỳ xem thuộc tính để xây dựng tiếp
            $a_Header['value'] = 'Bearer d5498fc9-8879-34b6-9a94-d98313f0f8a9';
        }

        //Xử lý thông tin hồ sơ
        $HoSoAPI = KetNoiAPI_HoSo::where('maso', $inputs['chucnang'])->get();
        $HoSoChiTietAPI = KetNoiAPI_HoSo_ChiTiet::where('maso', $inputs['chucnang'])->get();
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
            $i = 0;
            $a_HoSo = [];
            //File đính kèm cho hồ sơ kê khai giá thị trường
            if ($HoSo->ipf1 != '' && $HoSoAPI->wherein('tendong', ['FILE_DINH_KEM_WORD', 'FILE_DINH_KEM_PDF'])->count() > 0) {
                $path = public_path(getDuongDanThuMuc($inputs['chucnang'])) . $HoSo->ipf1;
                $type = pathinfo($path, PATHINFO_EXTENSION);
                switch ($type) {
                    case 'doc':
                    case 'docx': {
                            $data = file_get_contents($path);
                            $base64 =  base64_encode($data);
                            $a_HoSo['FILE_DINH_KEM_WORD'] = $base64;
                            break;
                        }
                    case 'pdf': {
                            $data = file_get_contents($path);
                            $base64 =  base64_encode($data);
                            $a_HoSo['FILE_DINH_KEM_PDF'] = $base64;
                            break;
                        }
                }
            }

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
                        $i++;
                        $a_ChiTiet = array();
                        foreach ($HoSoChiTietAPI->where('tendong_goc', $TenDong->tendong) as $Dong) {
                            $tenTruongCT = $Dong->tentruong;
                            if ($tenTruongCT == 'NULL') {
                                $a_ChiTiet[$Dong->tendong] = $this->getMacDinh($Dong->macdinh, $HoSo, $HSChiTiet);
                            } else {
                                $a_ChiTiet[$Dong->tendong] = $HSChiTiet->$tenTruongCT;
                            }
                            //dd($a_ChiTiet);
                        }
                        $a_HSChiTiet[$i] = $a_ChiTiet;
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
                    $a_HoSo[$TenDong->tendong] = $HoSo->$tenTruong;
                }
            }
            $a_Body[] = $a_HoSo;
        }

        //Truyền số liệu
        $curl = curl_init($inputs['linkTruyenPost']);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        if (in_array(substr($inputs['chucnang'], 0, 2), ['dm', 'ds']))
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($a_Body ?? null));
        else
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($a_Body[0] ?? null));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $a_Header);

        $result = curl_exec($curl);

        curl_close($curl);
        if ($result == false) {
            $result =  array(
                'error_code' => '-1',
                'result' => null,
                'message' => 'Đường dẫn kết nối API không tồn tại.',
            );
        }
        //dd($result);
        //Lưu lại link API
        KetNoiAPI_DanhSach::where('maso', $inputs['chucnang'])->update(['linkTruyenPost' => $inputs['linkTruyenPost']]);
        //Trường hợp mã trả lại từ sever là string html
        if (!is_array($result)) {
            return view('errors.html_entity_decode')
                ->with('result', $result);
        }

        if ($result['error_code'] == '-1') {
            return view('errors.403')
                ->with('message', $result['message'])
                ->with('url', $inputs['url']);
        } else {
            return view('errors.success')
                ->with('message', $result['message'])
                ->with('url', $inputs['url']);
        }
    }

    function getHoSo(&$HoSo, &$HoSoChiTiet, $ChucNang, $mahs)
    {
        switch ($ChucNang) {
                // case 'giahhdvk': {
                //         $HoSo = GiaHhDvK::where('mahs', $mahs)->get();
                //         if (count($HoSo) == 0)
                //             $HoSoChiTiet = null;
                //         else
                //             $HoSoChiTiet = GiaHhDvKCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                //         break;
                //     }
            case 'giahhdvk': {
                    $HoSo = ThGiaHhDvK::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = ThGiaHhDvKCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
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
                        $ct->mathuetn = $ct->cap1;
                        $ct->mathuetn .= $ct->cap2 != '' ? ('.' . $ct->cap2) : '';
                        $ct->mathuetn .= $ct->cap3 != '' ? ('.' . $ct->cap3) : '';
                        $ct->mathuetn .= $ct->cap4 != '' ? ('.' . $ct->cap4) : '';
                        $ct->mathuetn .= $ct->cap5 != '' ? ('.' . $ct->cap5) : '';
                    }

                    break;
                }
            case 'dmgiahhdvk': {
                    $HoSo = DmHhDvK::where('matt', $mahs)->get();
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

    function getMacDinh($giatri, $HoSo, $HoSoChiTiet = null)
    {
        //dd($HoSo);
        $kQ = $giatri;
        switch ($giatri) {
            case 'GET_DIABAN': {
                    $kQ = '93'; //để mặc định Hậu Giang
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
                    $kQ = $HangHoa->dvt ?? '';
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
