<?php

namespace App\Http\Controllers\Api;

use App\DmHhDvK;
use App\GiaHhDvK;
use App\GiaHhDvKCt;
use App\Model\API\KetNoiAPI;
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
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class getAPIController extends Controller
{
    public function getAPI(Request $request)
    {
        $server = $request->server();
        $inputs = $request->all();
        $TaiKhoan = Users::where('username', $inputs['name'])->first();
        //Thông điệp chung
        $ThongDiepChungAPI = KetNoiAPI::where('phanloai', 'Header')->get();
        $HoSoAPI = KetNoiAPI_HoSo::where('maso', $inputs['maso'])->get();
        $HoSoChiTietAPI = KetNoiAPI_HoSo_ChiTiet::where('maso', $inputs['maso'])->get();
        //
        //Lấy thông tin hồ sơ
        $m_HoSo = null;
        $m_HoSoChiTiet = null;
        $this->getHoSo($m_HoSo, $m_HoSoChiTiet, $inputs['maso'], $TaiKhoan->madv);
        //
        $a_Body = [];
        $i=1;
        foreach ($m_HoSo as $HoSo) {
            $i++;
            $a_HoSo = [];
            foreach ($HoSoAPI as $TenDong) {
                //xử lý mảng chi tiết trc
                if (substr($TenDong->tendong,0,3) =='DS_') {
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
            $a_Body[$i] = $a_HoSo;
        }
        $inputs['i'] = $i;
        $a_Header = [];
        foreach ($ThongDiepChungAPI as $ThongDiep) {
            $a_Header[$ThongDiep->tendong] = $this->getThongDiep($ThongDiep->tendong,$ThongDiep->macdinh, $inputs, $server);
        }

        $a_API['Header'] = $a_Header;
        $a_API['Body'] = $a_Body;
        $a_API['Security'] = ['Signature' => ''];
        return response()->json($a_API, Response::HTTP_OK);
    }

    function getHoSo(&$HoSo, &$HoSoChiTiet,$maso,$madv)
    {
        switch ($maso) {
            case 'giahhdvk':
            {
                $HoSo = GiaHhDvK::where('madv', $madv)->orwhere('madv_h', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = GiaHhDvKCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'vlxd':
            {
                $HoSo = KkGiaVlXd::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else

                $HoSoChiTiet = KkGiaVlXdCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'xmtxd':
            {
                $HoSo = KkGiaXmTxd::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = KkGiaXmTxdCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'dvhdtmck':
            {
                $HoSo = KkGiaDvHdTm::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = KkGiaDvHdTmCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'than':
            {
                $HoSo = KkGiaThan::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = KkGiaThanCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'tacn':
            {
                $HoSo = KkGiaTaCn::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = KkGiaTaCnCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'giay':
            {
                $HoSo = KkGiaGiay::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = KkGiaGiayCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'sach':
            {
                $HoSo = KkGiaSach::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = KkGiaSachCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'etanol':
            {
                $HoSo = KkGiaEtanol::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = KkGiaEtanolCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'dvcb':
            {
                $HoSo = GiaDvCang::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = GiaDvCangCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'oto':
            {
                $HoSo = GiaOtoNkSx::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = GiaOtoNkSxCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'xemay':
            {
                $HoSo = GiaXeMayNkSx::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = GiaXeMayNkSxCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'kcbtn':
            {
                $HoSo = KkGiaKcbTn::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = KkGiaKcbTnCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'dvvtxk':
            {
                $HoSo = GiaVtXk::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = GiaVtXkCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'dvvtxb':
            {
                $HoSo = KkGiaVtXb::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = KkGiaVtXbCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'dvvtxtx':
            {
                $HoSo = KkGiaVtXtx::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = KkGiaVtXtxCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'dvvthk':
            {
                $HoSo = GiaVtXk::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = GiaVtXkCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'tpcnte6t':
            {
                $HoSo = KkGs::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = KkGsCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'dvlt':
            {
                $HoSo = KkGiaDvLt::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = KkGiaDvLtCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'dlbb':
            {
                $HoSo = GiaDvDlBb::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = GiaDvDlBbCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'tqkdl':
            {
                $HoSo = GiaVeTqKdl::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = GiaVeTqKdlCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'cahue':
            {
                $HoSo = KkGiaDvCh::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = KkGiaDvChCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'hocphilx':
            {
                $HoSo = KkGiaHpLx::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = KkGiaHpLxCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'catsan':
            {
                $HoSo = KkGiaCatSan::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = KkGiaCatSanCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'datsanlap':
            {
                $HoSo = KkGiaDatSanLap::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = KkGiaDatSanLapCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'daxaydung':
            {
                $HoSo = KkGiaDaXayDung::where('madv_t', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = KkGiaDaXayDungCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }

            case 'giaphilephi':
            {
                $HoSo = PhiLePhi::where('madv', $madv)->orwhere('madv_h', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = PhiLePhiCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
            case 'giathuetn':
            {
                $HoSo = ThueTaiNguyen::where('madv', $madv)->orwhere('madv_h', $madv)->orwhere('madv_h', $madv)->orwhere('madv_ad', $madv)->get();
                if(count($HoSo) == 0)
                    $HoSoChiTiet = null;
                else
                $HoSoChiTiet = ThueTaiNguyenCt::where('mahs', array_column($HoSo->toarray(), 'mahs'))->get();
                break;
            }
        }

    }

    function getMacDinh($giatri, $HoSo, $HoSoChiTiet = null){
        //dd($HoSo);
        $kQ = $giatri;
        switch ($giatri) {
            case 'GET_DIABAN': {
                $kQ = '93';//để mặc định Hậu Giang
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
                $HangHoa = DmHhDvK::where('mahhdv',$HoSoChiTiet->mahhdv)->first();
                $kQ = $HangHoa->tenhhdv ?? '';
                break;
            }
            case 'GET_DVT_HHDV': {
                $HangHoa = DmHhDvK::where('mahhdv',$HoSoChiTiet->mahhdv)->first();
                $kQ = $HangHoa->dvt ?? '';
                break;
            }
            case 'GET_NGUONTT': {
                $kQ = '2';//sau làm hàm
                break;
            }
        }
        return $kQ;
    }

    function getThongDiep($tendong,$macdinh,$giatri,$server)
    {
        $kQ = $macdinh;
        switch ($tendong) {
            case 'Sender_Code':
            {
                $kQ = $giatri['maso'];
                break;
            }
            case 'Sender_Name':
            {
                $ChucNang = danhmucchucnang::where('maso',$giatri['maso'])->first();
                $kQ = $ChucNang->menu ?? $giatri['maso'];
                break;
            }
            case 'Receiver_Code':
            {

                break;
            }
            case 'Receiver_Name':
            {

                break;
            }
            case 'Tran_Code':
            {
                $kQ = 'JSON';
                break;
            }
            case 'Tran_Name':
            {
                $kQ = 'JSON';
                break;
            }
            case 'Msg_ID':
            {
                $kQ = $server['REDIRECT_STATUS'];
                break;
            }
            case 'Msg_RefID':
            {
                $kQ = $server['REDIRECT_STATUS'];
                break;
            }
            case 'Send_Date':
            {
                $kQ = date('Y-m-d H:i:s');
                break;
            }
            case 'Original_Code':
            {
                $kQ = '93';//Hậu Giang
                break;
            }
            case 'Original_name':
            {
                $kQ = getGeneralConfigs()['diadanh'] ?? '';
                break;
            }
            case 'Export_Date':
            {
                $kQ = date('Y-m-d H:i:s');
                break;
            }
            case 'Notes':
            {

                break;
            }
            case 'Tran_Num':
            {
                $kQ = $giatri['i'];
                break;
            }
            case 'Path':
            {
                $kQ = $server['REDIRECT_URL'] ?? '';
                break;
            }
            case 'NumMsg_InGroup':
            {

                break;
            }
            case 'SPARE1':
            {

                break;
            }
            case 'SPARE2':
            {

                break;
            }
            case 'SPARE3':
            {

                break;
            }
            case 'Finish_Code':
            {

                break;
            }

        }
        return $kQ;
    }
}
