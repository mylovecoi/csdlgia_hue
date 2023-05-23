<?php

function PhanLoaiHSRung()
{
    return array(
        'Thuê môi trường' => 'Thuê môi trường',
        'Khai thác' => 'Khai thác',
        'Thanh lý' => 'Thanh lý',
    );
}

function NhomQuanLy()
{
    $a_kq = array(
        'TC' => 'Tài Chính',
        'VT' => 'Vận Tải',
        'CT' => 'Công Thương',
        'KHAC' => 'Khác'
    );
    //dd($a_kq);
    return $a_kq;
}


function getLoaiXe()
{
    $a_loaixe = array(
        'Xe 4 chỗ' => 'Xe 4 chỗ',
        'Xe 5 chỗ' => 'Xe 5 chỗ',
        'Xe 7 chỗ' => 'Xe 7 chỗ',
        'Xe 16 chỗ' => 'Xe 16 chỗ',
        'Xe 29 chỗ' => 'Xe 29 chỗ',
        'Xe 35 chỗ' => 'Xe 35 chỗ',
        'Xe 45 chỗ' => 'Xe 45 chỗ',
        'Xe 47 chỗ' => 'Xe 47 chỗ',
        'Loại xe khác' => 'Loại xe khác'
    );
    return $a_loaixe;
}

//function getDiaDanhH()
//{
//    $diadanhhs = \App\DiaBanHd::where('level', 'H')
//        ->get();
//
//    $options = array();
//    $options[''] = '--Chọn địa bàn quản lý--';
//    foreach ($diadanhhs as $diadanhh) {
//
//
//        $options[$diadanhh->district] = $diadanhh->diaban;
//    }
//    return $options;
//}

function getDtapdungdvlt()
{
    $dtads = \App\DtAdDvLt::all();

    $options = array();
    $options['00'] = '--Chọn loại đối tượng áp dụng--';
    foreach ($dtads as $dtad) {
        $options[$dtad->madtad] = $dtad->tendtad;
    }
    return $options;
}

function getDvtDvLt()
{
    $dvt = array(
        '' => '--Chọn đơn vị tính--',
        'Đồng/giường/ngày đêm' => 'Đồng/giường/ngày đêm',
        'Đồng/phòng/ngày đêm' => 'Đồng/phòng/ngày đêm',
        'Đồng/phòng/tuần' => 'Đồng/phòng/tuần',
        'Đồng/phòng/tháng' => 'Đồng/phòng/tháng',
        'Đồng/căn hộ/ngày đêm' => 'Đồng/căn hộ/ngày đêm',
        'Đồng/căn hộ/tuần' => 'Đồng/căn hộ/tuần',
        'Đồng/căn hộ/tháng' => 'Đồng/căn hộ/tháng',
    );
    return $dvt;
}

function getLoaiVbQlNn($all = true)
{
    $vbqlnn = array(
        'luat' => 'Luật',
        'nghidinh' => 'Nghị định',
        'nghiquyet' => 'Nghị quyết',
        'thongtu' => 'Thông tư',
        'quyetdinh' => 'Quyết định',
        'vbhd' => 'Văn bản hướng dẫn',
        'baocao' => 'Báo cáo tình hình giá trị trường',
        'tailieu' => 'Báo cáo, tài liệu học tập kinh nghiệm',
        'khoahoc' => 'Kết quả, đề tài nghiên cứu khoa học',
        'vbkhac' => 'Báo cáo, văn bản có liên quan khác',
    );

    if ($all) {
        $vbqlnn = a_merge(['' => '--Loại văn bản--'], $vbqlnn);
    }

    return $vbqlnn;
}

function getThang($all = false)
{
    $a_tl = array(
        '01' => '01', '02' => '02', '03' => '03',
        '04' => '04', '05' => '05', '06' => '06',
        '07' => '07', '08' => '08', '09' => '09',
        '10' => '10', '11' => '11', '12' => '12'
    );
    if ($all)
        return a_merge(array('all' => '--Tất cả--'), $a_tl);
    else
        return $a_tl;
}

function getPhanLoaiDonVi_DiaBan()
{
    return array(
        'ADMIN' => 'Đơn vị tổng hợp toàn Tỉnh',
        'T' => 'Đơn vị hành chính cấp Tỉnh',
        'H' => 'Đơn vị hành chính cấp Huyện',
    );
}

function getPhanLoaiDonVi()
{
    return array(
        'TONGHOP' => 'Đơn vị tổng hợp dữ liệu',
        'NHAPLIEU' => 'Đơn vị nhập liệu',
        'QUANTRI' => 'Đơn vị quản trị hệ thống',
    );
}

function getHienTrang_NhaXH()
{
    return array(
        'CHOTHUE' => 'Đang cho thuê',
        'DANGSD' => 'Đang sử dụng',
        'DABAN' => 'Đã bán',
        'CHUASD' => 'Chưa sử dụng',
    );
}

function getPhanLoai_NhaXH()
{
    return array(
        'NHAOXH' => 'Nhà ở xã hội',
        'NHACV' => 'Nhà ở công vụ',
        'NHANN' => 'Nhà ở thuộc sở hữu nhà nước',
        'NHAK' => 'Nhà ở khác',
    );
}

function getPhanLoaiSPDVCI()
{
    return array(
        'SANPHAM' => 'Sản phẩm',
        'DVCI' => 'Dịch vụ công ích',
        'DVSNC' => 'Dịch vụ sự nghiệp công',
        'HHDV' => 'Hàng hóa, dịch vụ',
        'KHAC' => 'Sản phẩm, dịch vụ khác',
    );
}

function getPhanLoaiTroGia()
{
    return array(
        'NGANSACH' => 'Chi từ ngân sách địa phương và trung ương',
        'BANLE' => 'Mức giá hoặc khung giá bán lẻ',
        'KHOKHAN' => 'Cung ứng hàng hóa, dịch vụ thiết yếu phục vụ đồng bào miền núi, vùng sâu, xa và hải đảo',
        'KHAC' => 'Trợ giá, trợ cước khác',
    );
}

function getDiaBan_Level($level, $madiaban = null)
{
    if (in_array($level, ['SSA', 'T', 'ADMIN'])) {
        return array_column(
            App\Model\system\dsdiaban::wherein('level', ['T', 'H', 'ADMIN'])->get()->toarray(),
            'tendiaban',
            'madiaban'
        );
    }

    return array_column(
        App\Model\system\dsdiaban::where('madiaban', $madiaban)->get()->toarray(),
        'tendiaban',
        'madiaban'
    );
}

//Lấy danh sách địa bàn thực tế tại đơn vị
function getDiaBan_ApDung($level, $madiaban = null)
{
    //    if (in_array($level, ['SSA', 'T', 'ADMIN'])) {
    //        return array_column(App\Model\system\dsdiaban::wherein('level', ['T', 'H'])->get()->toarray(),
    //            'tendiaban', 'madiaban');
    //    }
    if (in_array($level, ['SSA', 'T', 'ADMIN'])) {
        return array_column(
            App\Model\system\dsdiaban::wherein('level', ['ADMIN', 'H'])->get()->toarray(),
            'tendiaban',
            'madiaban'
        );
    }

    return array_column(
        App\Model\system\dsdiaban::where('madiaban', $madiaban)->get()->toarray(),
        'tendiaban',
        'madiaban'
    );
}

//Lấy danh sách địa bàn có chức năng nhập liệu (X; H; T)
function getDiaBan_NhapLieu($level, $madiaban = null, $all = true)
{
    //    if (in_array($level, ['SSA', 'T', 'ADMIN'])) {
    //        return array_column(App\Model\system\dsdiaban::wherein('level', ['T', 'H'])->get()->toarray(),
    //            'tendiaban', 'madiaban');
    //    }
    if (in_array($level, ['SSA'])) {
        return array_column(
            App\Model\system\dsdiaban::wherein('level', ['T', 'H'])->get()->toarray(),
            'tendiaban',
            'madiaban'
        );
    }

    if (in_array($level, ['T', 'ADMIN']) && $all == true) {
        return array_column(
            App\Model\system\dsdiaban::wherein('level', ['T', 'H'])->get()->toarray(),
            'tendiaban',
            'madiaban'
        );
    }

    return array_column(
        App\Model\system\dsdiaban::where('madiaban', $madiaban)->get()->toarray(),
        'tendiaban',
        'madiaban'
    );
}

//Lấy danh sách địa bàn các đơn vị xã huyện
function getDiaBan_XaHuyen($level, $madiaban = null)
{
    if (in_array($level, ['SSA', 'T', 'ADMIN'])) {
        return array_column(
            App\Model\system\dsdiaban::wherein('level', ['X', 'H'])->get()->toarray(),
            'tendiaban',
            'madiaban'
        );
    }

    return array_column(
        App\Model\system\dsdiaban::where('madiaban', $madiaban)->get()->toarray(),
        'tendiaban',
        'madiaban'
    );
}

//Lấy danh sách địa bàn theo level hệ thống
function getDiaBan_HeThong($level, $madiaban = null)
{
    if (in_array($level, ['SSA', 'ADMIN'])) {
        return array_column(
            App\Model\system\dsdiaban::wherein('level', ['T', 'H', 'X'])->get()->toarray(),
            'tendiaban',
            'madiaban'
        );
    }

    return array_column(
        App\Model\system\dsdiaban::where('madiaban', $madiaban)->get()->toarray(),
        'tendiaban',
        'madiaban'
    );
}
function getDonViNhapLieu($level, $linhvuc = null)
{
    if ($level == 'SSA' || $level == 'ADMIN') {
        //return App\Model\system\dsdonvi::where('chucnang', 'NHAPLIEU')->get();
        $m_donvi = App\Model\system\view_dsdiaban_donvi::all();
    } else {
        //return App\Model\system\dsdonvi::where('madv', session('admin')->madv)->get();
        $m_donvi = App\Model\system\view_dsdiaban_donvi::where('madv', session('admin')->madv)->get();
    }
    $ketqua = new Illuminate\Support\Collection();
    $m_user = App\Users::wherein('madv', array_column($m_donvi->toarray(), 'madv'))->get();
    //dd($m_user);
    if ($linhvuc != null) {
        foreach ($m_user as $user) {
            $per = json_decode($user->permission, true);
            if (
                isset($per[$linhvuc]['hoso']['approve']) && $per[$linhvuc]['hoso']['approve'] == '1'
                && in_array('NHAPLIEU', explode(';', $user->chucnang))
                && $ketqua->where('madv', $user->madv)->first() == null
            ) {
                $ketqua->add($m_donvi->where('madv', $user->madv)->first());
            }
        }
    } else {
        foreach ($m_user as $user) {
            if (
                in_array('NHAPLIEU', explode(';', $user->chucnang))
                && $ketqua->where('madv', $user->madv)->first() == null
            ) {
                $ketqua->add($m_donvi->where('madv', $user->madv)->first());
            }
        }
    }
    //dd($ketqua);
    // if ($linhvuc != null && count($ketqua) == 0) {
    //     $message = 'Chưa có đơn vị nào được phân quyền nhập liệu cho chức năng: ' . session('admin')['a_chucnang'][$linhvuc]
    //         . '. Bạn cần liên hệ người quản trị để phần quyền nhập liệu cho đơn vị.';
    //     return  view('errors.403')
    //         ->with('message', $message);
    // }

    return $ketqua;
}

function getDoanhNghiepNhapLieu($level, $lvcc)
{
    if ($level == 'SSA') {
        return App\Model\system\company\Company::wherein('madv', function ($qr) use ($lvcc) {
            $qr->select('madv')->from('companylvcc')->where('manghe', $lvcc);
        })->get();
    } else {
        if (in_array('TONGHOP', session('admin')->chucnang)) {
            return App\Model\system\company\Company::wherein('madv', function ($qr) use ($lvcc) {
                $qr->select('madv')->from('companylvcc')->where('manghe', $lvcc);
            })->get();
        } else
            return App\Model\system\company\Company::where('madv', session('admin')->madv)->get();
    }
}

function getDoanhNghiep($level, $madiaban = null)
{
    if ($level == 'SSA') {
        return App\Model\system\company\Company::take(1000)->get();
    } elseif (in_array($level, ['X', 'H', 'T'])) {
        return App\Model\system\company\Company::where('madiaban', $madiaban)->get();
    } else {
        return App\Model\system\company\Company::where('madv', session('admin')->madv)->get();
    }
}

function getDonViTimKiem($level, $madiaban = null, $linhvuc = null)
{
    //Lấy danh sách đơn vị nhập liệu trên địa bàn
    if ($level == 'SSA') {
        $m_donvi = App\Model\system\view_dsdiaban_donvi::all();
    } else {
        $m_donvi = App\Model\system\view_dsdiaban_donvi::where('madiaban', $madiaban)->get();
    }
    $ketqua = new Illuminate\Support\Collection();
    $m_user = App\Users::wherein('madv', array_column($m_donvi->toarray(), 'madv'))->get();
    //dd($m_user);
    if ($linhvuc != null) {
        foreach ($m_user as $user) {
            $per = json_decode($user->permission, true);
            if (
                isset($per[$linhvuc]['hoso']['approve']) && $per[$linhvuc]['hoso']['approve'] == '1'
                && in_array('NHAPLIEU', explode(';', $user->chucnang))
                && $ketqua->where('madv', $user->madv)->first() == null
            ) {
                $ketqua->add($m_donvi->where('madv', $user->madv)->first());
            }
        }
    } else {
        foreach ($m_user as $user) {
            if (
                in_array('NHAPLIEU', explode(';', $user->chucnang))
                && $ketqua->where('madv', $user->madv)->first() == null
            ) {
                $ketqua->add($m_donvi->where('madv', $user->madv)->first());
            }
        }
    }

    //dd($ketqua);
    return $ketqua;
}

function getDonViXetDuyet($level, $linhvuc = null)
{
    if ($level == 'SSA') {
        $m_donvi = App\Model\system\view_dsdiaban_donvi::all();
    } else {
        $m_donvi = App\Model\system\view_dsdiaban_donvi::where('madv', session('admin')->madv)->get();
    }
    $ketqua = new Illuminate\Support\Collection();
    $m_user = App\Users::wherein('madv', array_column($m_donvi->toarray(), 'madv'))->get();
    //dd($m_user);

    if ($linhvuc != null) {
        foreach ($m_user as $user) {
            $per = json_decode($user->permission, true);
            if (
                isset($per[$linhvuc]['hoso']['approve']) && $per[$linhvuc]['hoso']['approve'] == '1'
                && in_array('TONGHOP', explode(';', $user->chucnang))
                && $ketqua->where('madv', $user->madv)->first() == null
            ) {
                $ketqua->add($m_donvi->where('madv', $user->madv)->first());
            }
        }
    } else {
        foreach ($m_user as $user) {
            //$per = json_decode($user->permission, true);
            if (
                in_array('TONGHOP', explode(';', $user->chucnang))
                && $ketqua->where('madv', $user->madv)->first() == null
            ) {
                $ketqua->add($m_donvi->where('madv', $user->madv)->first());
            }
        }
    }
    //dd($ketqua);
    return $ketqua;
}

/*
 * Căn cứ vào lĩnh vực để duyệt user trong nhóm đơn vị tổng hợp
 * nếu User nào có quyền trong lĩnh vực thì thêm đơn vị đó vào danh sách tổng hợp
 * riêng quyền SSA thì ko kiểm tra User (cho trường hợp gửi mà đơn vị đó ko phân quyền)
 * */
function getDonViTongHop($linhvuc, $level, $madiaban = null)
{
    //mặc định luôn thêm đơn vị tổng hợp toàn tỉnh
    if ($level == 'SSA' || $level == 'ADMIN') {
        //lấy tất cả đơn vị
        //return App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')->where('level', '<>', 'ADMIN')->get();
        $m_donvi = App\Model\system\view_dsdiaban_donvi::all();
    } elseif ($level == 'T') {
        //return App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')->wherein('level', ['T'])->get();
        $m_donvi = App\Model\system\view_dsdiaban_donvi::wherein('level', ['T', 'ADMIN'])->get();
    } else {
        //        $m_donvi = App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')
        //            ->where(function ($qr) use ($madiaban) {
        //                $qr->where('level', 'T')
        //                    ->orwhere('madiaban', $madiaban);
        //            })->get();
        $m_donvi = App\Model\system\view_dsdiaban_donvi::wherein('level', ['T', 'ADMIN'])
            ->orwhere('madiaban', $madiaban)->get();
    }

    $ketqua = new Illuminate\Support\Collection();
    $m_user = App\Users::wherein('madv', array_column($m_donvi->toarray(), 'madv'))->get();
    //dd($m_user);
    foreach ($m_user as $user) {
        $per = json_decode($user->permission, true);
        if (
            isset($per[$linhvuc]['hoso']['approve']) && $per[$linhvuc]['hoso']['approve'] == '1'
            && in_array('TONGHOP', explode(';', $user->chucnang))
            && $ketqua->where('madv', $user->madv)->first() == null
        ) {
            $ketqua->add($m_donvi->where('madv', $user->madv)->first());
        }
    }
    //dd($ketqua);
    return $ketqua;
}

function getDonViTongHop_dn($linhvuc, $level, $madiaban = null)
{
    //return App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')->wherein('level', ['T', 'H'])->get();
    switch ($linhvuc) {
        case 'vtxtx': {
                $linhvuc = 'dvvtxtx';
                break;
            }
        case 'vtxk': {
                $linhvuc = 'dvvtxk';
                break;
            }
        case 'vtxb': {
                $linhvuc = 'dvvtxb';
                break;
            }
        case 'vthk': {
                $linhvuc = 'dvvthk';
                break;
            }
        case 'tpcb':
        case 'tgtt':
        case 'dadtl':
        case 'sted6t':
        case 'ma':
        case 'vxgsgc':
        case 'tbvtv':
        case 'pdurenpk':
        case 'kdmhl':
        case 'dbl':
        case 'xd': {
                $linhvuc = 'bog';
                break;
            }
    }
    //dd($madiaban);
    if ($madiaban == null) {
        $m_donvi = App\Model\system\view_dsdiaban_donvi::wherein('level', ['T', 'H'])->get();
    } else {
        $m_donvi = App\Model\system\view_dsdiaban_donvi::wherein('level', ['T', 'H'])
            ->where('madiaban', $madiaban)->get();
    }

    $m_user = App\Users::wherein('madv', array_column($m_donvi->toarray(), 'madv'))->get();
    //dd($m_user);
    $ketqua = new Illuminate\Support\Collection();

    foreach ($m_user as $user) {
        $per = json_decode($user->permission, true);
        if (
            isset($per[$linhvuc]['hoso']['approve']) && $per[$linhvuc]['hoso']['approve'] == '1'
            && in_array('TONGHOP', explode(';', $user->chucnang))
            && $ketqua->where('madv', $user->madv)->first() == null
        ) {
            $ketqua->add($m_donvi->where('madv', $user->madv)->first());
        }
    }
    //dd($ketqua);
    return $ketqua;
}

function getDonViCongBo()
{
    $m_donvi = App\Model\system\view_dsdiaban_donvi::wherein('level', ['ADMIN'])->get();
    $m_user = App\Users::wherein('madv', array_column($m_donvi->toarray(), 'madv'))->get();
    $ketqua = new Illuminate\Support\Collection();

    foreach ($m_user as $user) {
        if (
            in_array('TONGHOP', explode(';', $user->chucnang))
            && $ketqua->where('madv', $user->madv)->first() == null
        ) {
            $ketqua->add($m_donvi->where('madv', $user->madv)->first());
        }
    }
    //dd($ketqua);
    return $ketqua;
}

function getDiaBan_HoSo($m_diaban, $all = false)
{
    $a_diaban = array_column($m_diaban->toarray(), 'tendiaban', 'madiaban');
    if ($all) {
        $a_kq = ['null' => '-- Chọn địa bàn --'];
        foreach ($a_diaban as $k => $v) {
            $a_kq[$k] = $v;
        }
        return $a_kq;
    }
    return $a_diaban;
}

function getNam($all = false)
{
    $a_tl = $all == true ? array('all' => '--Tất cả--') : array();
    for ($i = date('Y') - 3; $i <= date('Y') + 1; $i++) {
        $a_tl[$i] = $i;
    }
    return $a_tl;
}

function getThoiDiem()
{
    return [
        'nam' => 'Cả năm',
        'quy1' => 'Quý I',
        'quy2' => 'Quý II',
        'quy3' => 'Quý III',
        'quy4' => 'Quý IV',
        'thang01' => 'Tháng 01',
        'thang02' => 'Tháng 02',
        'thang03' => 'Tháng 03',
        'thang04' => 'Tháng 04',
        'thang05' => 'Tháng 05',
        'thang06' => 'Tháng 06',
        'thang07' => 'Tháng 07',
        'thang08' => 'Tháng 08',
        'thang09' => 'Tháng 09',
        'thang10' => 'Tháng 10',
        'thang11' => 'Tháng 11',
        'thang12' => 'Tháng 12',
    ];
}

function getFileExtension()
{
    return '.doc , .docx , .pdf , .ppt , .pptx , .xlsx , .xls , .csv , .txt, .jpg, .jpeg, .png, .rar, .zip';
}

function getPhanLoaiAPI()
{
    return [
        'Header' => 'Header',
        'Body' => 'Body',
        'Security' => 'Security/Signature',
    ];
}

function getKieuDuLieu()
{
    return [
        'STRING' => 'STRING',
        'DATE' => 'DATE',
        'BASES64' => 'BASES64',
        'OBJECT' => 'OBJECT',
        'NUMBER' => 'NUMBER',
        'BOOLEAN' => 'BOOLEAN',
    ];
}

function getTenTrangThaiHoSoDN($all = false)
{
    if ($all) {
        return [
            'ALL' => 'Tất cả',
            'CC' => 'Chờ chuyển',
            'CD' => 'Chờ duyệt',
            'CN' => 'Chờ nhận',
            'BTL' => 'Bị trả lại',
            'DD' => 'Đã duyệt',
            'CB' => 'Đã công bố',
        ];
    } else {
        return [
            'CC' => 'Chờ chuyển',
            'CD' => 'Chờ duyệt',
            'CN' => 'Chờ nhận',
            'BTL' => 'Bị trả lại',
            'DD' => 'Đã duyệt',
            'CB' => 'Đã công bố',
        ];
    }
}
