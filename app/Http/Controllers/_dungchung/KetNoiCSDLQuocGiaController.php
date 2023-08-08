<?php

namespace App\Http\Controllers\_dungchung;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use App\DmHhDvK;
use App\GiaHhDvK;
use App\GiaHhDvKCt;
use App\Model\API\KetNoiAPI_HoSo;
use App\Model\API\KetNoiAPI_HoSo_ChiTiet;
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
use Illuminate\Support\Facades\Http;

class KetNoiCSDLQuocGiaController extends Controller
{
    public function send_post($inputs)
    {
        $result = array(
            'error_code' => '-1',
            'result' => null,
            'message' => 'Thao tác không hoàn thành.',
        );
        //Lấy _token để truyền dữ liệu
        $a_Header = [
            'key' => 'Authorization',
            'value' => ''
        ];
        if (session('admin')->phanloaiketnoi == 'TOKEN') {
            $a_Header['value'] = $inputs['token_ketnoi'];
        } else {
            /* Ví dụ đã chạy
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
            return array(
                'error_code' => '-1',
                'result' => null,
                'message' => 'Hồ sơ chưa được thiết lập các trường dữ liệu. Bạn hãy thiết lập hệ thống API cho chức năng này.',
            );
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

            foreach ($HoSoAPI as $TenDong) {
                //xử lý mảng chi tiết trc
                if (substr($TenDong->tendong, 0, 3) == 'DS_') {
                    $a_HSChiTiet = array();
                    foreach ($m_HoSoChiTiet as $HSChiTiet) {
                        $i++;
                        $a_ChiTiet = array();
                        foreach ($HoSoChiTietAPI as $Dong) {
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
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($a_Body[0]));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $a_Header);

        $result = curl_exec($curl);        
        curl_close($curl);
        if($result==false){
            return array(
                'error_code' => '-1',
                'result' => null,
                'message' => 'Đường dẫn kết nối API không tồn tại.',
            );
        }
        
        return $result;
    }

    function getHoSo(&$HoSo, &$HoSoChiTiet, $ChucNang, $mahs)
    {
        switch ($ChucNang) {
            case 'giahhdvk': {
                    $HoSo = GiaHhDvK::where('mahs', $mahs)->get();
                    if (count($HoSo) == 0)
                        $HoSoChiTiet = null;
                    else
                        $HoSoChiTiet = GiaHhDvKCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
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
