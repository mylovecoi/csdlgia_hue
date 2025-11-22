<?php

use App\Model\system\company\CompanyLvCc;
use App\Model\view\view_dmnganhnghe;

function getPermissionDefault($level)
{
    $roles = array();
    //Quyền tỉnh
    $roles['T'] = array(
        //CSDL về mức giá hàng hóa dịch vụ
        'csdlmucgiahhdv' => array(
            'index' => 1,
        ),
        'dinhgia' => array(
            'index' => 1,
        ),
        'giacldat' => array(
            'index' => 1,
        ),
        'dmgiacldat' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiacldat' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiacldat' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giadaugiadat' => array(
            'index' => 1,
        ),
        'dmgiadaugiadat' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiadaugiadat' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiadaugiadat' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giathuedatnuoc' => array(
            'index' => 1,
        ),
        'dmgiathuedatnuoc' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiathuedatnuoc' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiathuedatnuoc' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giarung' => array(
            'index' => 1,
        ),
        'dmgiarung' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiarung' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiarung' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giathuemuanhaxh' => array(
            'index' => 1,
        ),
        'dmgiathuemuanhaxh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiathuemuanhaxh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiathuemuanhaxh' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'gianuocsh' => array(
            'index' => 1,
        ),
        'dmgianuocsh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgianuocsh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgianuocsh' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giathuetscong' => array(
            'index' => 1,
        ),
        'dmgiathuetscong' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiathuetscong' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiathuetscong' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giadvgddt' => array(
            'index' => 1,
        ),
        'dmgiadvgddt' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiadvgddt' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiadvgddt' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giadvkcb' => array(
            'index' => 1,
        ),
        'dmgiadvkcb' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiadvkcb' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiadvkcb' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giahhdvk' => array(
            'index' => 1,
        ),
        'dmgiahhdvk' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiahhdvk' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiahhdvk' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giathuetn' => array(
            'index' => 1,
        ),
        'dmgiathuetn' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiathuetn' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiathuetn' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'gialephitruocba' => array(
            'index' => 1,
        ),
        'dmgialephitruocba' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgialephitruocba' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgialephitruocba' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giaphilephi' => array(
            'index' => 1,
        ),
        'dmgiaphilephi' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiaphilephi' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiaphilephi' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        // 'bog' => array(
        //     'index' => 1,
        // ),
        // 'dmbog' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        //     'approve' => 1,
        // ),
        // 'bpbog' => array(
        //     'index' => 1,
        // ),
        // 'kkbpbog' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        //     'approve' => 1,
        // ),
        // 'thbpbog' => array(
        //     'baocao' => 1,
        //     'timkiem' => 1,
        //     'congbo' => 1,
        // ),
        // 'dangkygia' => array(
        //     'index' => 1,
        // ),
        // 'dkgxangdau' => array(
        //     'index' => 1,
        // ),
        // 'ttdndkgxangdau' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        // ),
        // 'thdkgxangdau' => array(
        //     'baocao' => 1,
        //     'timkiem' => 1,
        //     'congbo' => 1,
        // ),
        // 'kkdkgxangdau' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        //     'approve' => 1,
        // ),
        // 'dkgdien' => array(
        //     'index' => 1,
        // ),
        // 'ttdndkgdien' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        // ),
        // 'thdkgdien' => array(
        //     'baocao' => 1,
        //     'timkiem' => 1,
        //     'congbo' => 1,
        // ),
        // 'kkdkgdien' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        //     'approve' => 1,
        // ),
        // 'dkgkhidau' => array(
        //     'index' => 1,
        // ),
        // 'ttdndkgkhidau' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        // ),
        // 'thdkgkhidau' => array(
        //     'baocao' => 1,
        //     'timkiem' => 1,
        //     'congbo' => 1,
        // ),
        // 'kkdkgkhidau' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        //     'approve' => 1,
        // ),
        // 'dkgphan' => array(
        //     'index' => 1,
        // ),
        // 'ttdndkgphan' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        // ),
        // 'thdkgphan' => array(
        //     'baocao' => 1,
        //     'timkiem' => 1,
        //     'congbo' => 1,
        // ),
        // 'kkdkgphan' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        //     'approve' => 1,
        // ),
        // 'dkgthuocbvtv' => array(
        //     'index' => 1,
        // ),
        // 'ttdndkgthuocbvtv' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        // ),
        // 'thdkgthuocbvtv' => array(
        //     'baocao' => 1,
        //     'timkiem' => 1,
        //     'congbo' => 1,
        // ),
        // 'kkdkgthuocbvtv' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        //     'approve' => 1,
        // ),
        // 'dkgvacxingsgc' => array(
        //     'index' => 1,
        // ),
        // 'ttdndkgvacxingsgc' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        // ),
        // 'thdkgvacxingsgc' => array(
        //     'baocao' => 1,
        //     'timkiem' => 1,
        //     'congbo' => 1,
        // ),
        // 'kkdkgvacxingsgc' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        //     'approve' => 1,
        // ),
        // 'dkgmuoi' => array(
        //     'index' => 1,
        // ),
        // 'ttdndkgmuoi' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        // ),
        // 'thdkgmuoi' => array(
        //     'baocao' => 1,
        //     'timkiem' => 1,
        //     'congbo' => 1,
        // ),
        // 'kkdkgmuoi' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        //     'approve' => 1,
        // ),
        // 'dkgsuate6t' => array(
        //     'index' => 1,
        // ),
        // 'ttdndkgsuate6t' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        // ),
        // 'thdkgsuate6t' => array(
        //     'baocao' => 1,
        //     'timkiem' => 1,
        //     'congbo' => 1,
        // ),
        // 'kkdkgsuate6t' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        //     'approve' => 1,
        // ),
        // 'dkgduong' => array(
        //     'index' => 1,
        // ),
        // 'ttdndkgduong' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        // ),
        // 'thdkgduong' => array(
        //     'baocao' => 1,
        //     'timkiem' => 1,
        //     'congbo' => 1,
        // ),
        // 'kkdkgduong' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        //     'approve' => 1,
        // ),
        // 'dkgthocgao' => array(
        //     'index' => 1,
        // ),
        // 'ttdndkgthocgao' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        // ),
        // 'thdkgthocgao' => array(
        //     'baocao' => 1,
        //     'timkiem' => 1,
        //     'congbo' => 1,
        // ),
        // 'kkdkgthocgao' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        //     'approve' => 1,
        // ),
        // 'dkgthuocpcb' => array(
        //     'index' => 1,
        // ),
        // 'ttdndkgthuocpcb' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        // ),
        // 'thdkgthuocpcb' => array(
        //     'baocao' => 1,
        //     'timkiem' => 1,
        //     'congbo' => 1,
        // ),
        // 'kkdkgthuocpcb' => array(
        //     'index' => 1,
        //     'create' => 1,
        //     'edit' => 1,
        //     'delete' => 1,
        //     'approve' => 1,
        // ),

        'kknygia' => array(
            'index' => 1,
        ),
        'ttdn' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'tacn' => array(
            'index' => 1,
        ),
        'kktacn' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thtacn' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),
        'dvlt' => array(
            'index' => 1,
        ),
        'dmdvlt' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkdvlt' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thdvlt' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),
        'dvvt' => array(
            'index' => 1,
            'xdttdn' => 1,
        ),
        'vtxk' => array(
            'index' => 1,
        ),
        'dmvtxk' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkvtxk' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thvtxk' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),

        'vtxb' => array(
            'index' => 1,
        ),
        'dmvtxb' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkvtxb' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thvtxb' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),

        'vtxtx' => array(
            'index' => 1,
        ),
        'dmvtxtx' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkvtxtx' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thvtxtx' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),
        'tpcnte6t' => array(
            'index' => 1,
        ),
        'kktpcnte6t' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thtpcnte6t' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),
        'vlxd' => array(
            'index' => 1,
        ),
        'dmvlxd' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'kkvlxd' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thvlxd' => array(
            'baocao' => 1,
            'congbo' => 1,
            'timkiem' => 1,
            'xdttdn' => 1,
        ),
        //End CSDL mức giá hàng hóa dịch vụ
        //CSDL thẩm định giá
        'csdlthamdinhgia' => array(
            'index' => 1,
        ),
        'thamdinhgia' => array(
            'index' => 1,
        ),
        'dmthamdinhgia' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkthamdinhgia' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'ththamdinhgia' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'thamdinhgiahh' => array(
            'index' => 1,
        ),
        'dmthamdinhgiahh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkthamdinhgiahh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'ththamdinhgiahh' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        //End CSDL thẩm định giá
        //CSDL Văn bản quản lý nhà nước
        'csdlvbqlnn' => array(
            'index' => 1,
        ),
        'vbqlnn' => array(
            'index' => 1
        ),
        'vbgia' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'giacpi' => array(
            'index' => 1,
        ),
        'dmgiacpi' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiacpi' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiacpi' => array(
            'congbo' => 1,
            'baocao' => 1,
            'timkiem' => 1,
        ),
        //End CSDL Văn bản quản lý nhà nước
        //CSDL thông tin phục vụ công tác quản lý nhà nước về giá
        'csdlttpvctqlnn' => array(
            'index' => 1,
        ),

        //End CSDL thông tin phục vụ công tác quản lý nhà nước về giá
        //System
        'system' => array(
            'index' => 1,
        ),
        'ngaynghile' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'dmdiadanh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'districts' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'towns' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'companies' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'users' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'copy' => 1,
            'per' => 1
        ),
        'register' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        //End System
    );

    //End Quyền tỉnh

    //Quyền huyện
    $roles['H'] = array(
        //CSDL về mức giá hàng hóa dịch vụ
        'csdlmucgiahhdv' => array(
            'index' => 1,
        ),
        'dinhgia' => array(
            'index' => 1,
        ),
        'giacldat' => array(
            'index' => 1,
        ),
        'dmgiacldat' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiacldat' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiacldat' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giadaugiadat' => array(
            'index' => 1,
        ),
        'dmgiadaugiadat' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiadaugiadat' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiadaugiadat' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giathuedatnuoc' => array(
            'index' => 1,
        ),
        'dmgiathuedatnuoc' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiathuedatnuoc' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiathuedatnuoc' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giarung' => array(
            'index' => 1,
        ),
        'dmgiarung' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiarung' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiarung' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giathuemuanhaxh' => array(
            'index' => 1,
        ),
        'dmgiathuemuanhaxh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiathuemuanhaxh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiathuemuanhaxh' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'gianuocsh' => array(
            'index' => 1,
        ),
        'dmgianuocsh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgianuocsh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgianuocsh' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giathuetscong' => array(
            'index' => 1,
        ),
        'dmgiathuetscong' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiathuetscong' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiathuetscong' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giadvgddt' => array(
            'index' => 1,
        ),
        'dmgiadvgddt' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiadvgddt' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiadvgddt' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giadvkcb' => array(
            'index' => 1,
        ),
        'dmgiadvkcb' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiadvkcb' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiadvkcb' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giahhdvk' => array(
            'index' => 1,
        ),
        'dmgiahhdvk' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiahhdvk' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiahhdvk' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giathuetn' => array(
            'index' => 1,
        ),
        'dmgiathuetn' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiathuetn' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiathuetn' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'gialephitruocba' => array(
            'index' => 1,
        ),
        'dmgialephitruocba' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgialephitruocba' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgialephitruocba' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giaphilephi' => array(
            'index' => 1,
        ),
        'dmgiaphilephi' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiaphilephi' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiaphilephi' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'bog' => array(
            'index' => 1,
        ),
        'dmbog' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'bpbog' => array(
            'index' => 1,
        ),
        'kkbpbog' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thbpbog' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'dangkygia' => array(
            'index' => 1,
        ),
        'dkgxangdau' => array(
            'index' => 1,
        ),
        'ttdndkgxangdau' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgxangdau' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgxangdau' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgdien' => array(
            'index' => 1,
        ),
        'ttdndkgdien' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgdien' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgdien' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgkhidau' => array(
            'index' => 1,
        ),
        'ttdndkgkhidau' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgkhidau' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgkhidau' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgphan' => array(
            'index' => 1,
        ),
        'ttdndkgphan' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgphan' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgphan' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgthuocbvtv' => array(
            'index' => 1,
        ),
        'ttdndkgthuocbvtv' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgthuocbvtv' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgthuocbvtv' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgvacxingsgc' => array(
            'index' => 1,
        ),
        'ttdndkgvacxingsgc' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgvacxingsgc' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgvacxingsgc' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgmuoi' => array(
            'index' => 1,
        ),
        'ttdndkgmuoi' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgmuoi' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgmuoi' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgsuate6t' => array(
            'index' => 1,
        ),
        'ttdndkgsuate6t' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgsuate6t' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgsuate6t' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgduong' => array(
            'index' => 1,
        ),
        'ttdndkgduong' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgduong' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgduong' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgthocgao' => array(
            'index' => 1,
        ),
        'ttdndkgthocgao' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgthocgao' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgthocgao' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgthuocpcb' => array(
            'index' => 1,
        ),
        'ttdndkgthuocpcb' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgthuocpcb' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgthuocpcb' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),

        'kknygia' => array(
            'index' => 1,
        ),
        'ttdn' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'tacn' => array(
            'index' => 1,
        ),
        'kktacn' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thtacn' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),
        'dvlt' => array(
            'index' => 1,
        ),
        'dmdvlt' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkdvlt' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thdvlt' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),
        'dvvt' => array(
            'index' => 1,
            'xdttdn' => 1,
        ),
        'vtxk' => array(
            'index' => 1,
        ),
        'dmvtxk' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkvtxk' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thvtxk' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),
        'vtxb' => array(
            'index' => 1,
        ),
        'dmvtxb' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkvtxb' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thvtxb' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),
        'vtxtx' => array(
            'index' => 1,
        ),
        'dmvtxtx' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkvtxtx' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thvtxtx' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),
        'tpcnte6t' => array(
            'index' => 1,
        ),
        'kktpcnte6t' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thtpcnte6t' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),
        'vlxd' => array(
            'index' => 1,
        ),
        'dmvlxd' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'kkvlxd' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thvlxd' => array(
            'baocao' => 1,
            'congbo' => 1,
            'timkiem' => 1,
            'xdttdn' => 1,
        ),
        //End CSDL mức giá hàng hóa dịch vụ
        //CSDL thẩm định giá
        'csdlthamdinhgia' => array(
            'index' => 1,
        ),
        'thamdinhgia' => array(
            'index' => 1,
        ),
        'dmthamdinhgia' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkthamdinhgia' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'ththamdinhgia' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'thamdinhgiahh' => array(
            'index' => 1,
        ),
        'dmthamdinhgiahh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkthamdinhgiahh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'ththamdinhgiahh' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        //End CSDL thẩm định giá
        //CSDL Văn bản quản lý nhà nước
        'csdlvbqlnn' => array(
            'index' => 1,
        ),
        'vbqlnn' => array(
            'index' => 1
        ),
        'vbgia' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'giacpi' => array(
            'index' => 1,
        ),
        'dmgiacpi' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkgiacpi' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiacpi' => array(
            'congbo' => 1,
            'baocao' => 1,
            'timkiem' => 1,
        ),
        //End CSDL Văn bản quản lý nhà nước
        //CSDL thông tin phục vụ công tác quản lý nhà nước về giá
        'csdlttpvctqlnn' => array(
            'index' => 1,
        ),

        //End CSDL thông tin phục vụ công tác quản lý nhà nước về giá
        //System
        'system' => array(
            'index' => 1,
        ),
        'ngaynghile' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'dmdiadanh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'districts' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'towns' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'companies' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'users' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'copy' => 1,
            'per' => 1
        ),
        'register' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        //End System
    );
    //End QUyền Huyện

    //Quyền xã
    $roles['X'] = array(
        //CSDL về mức giá hàng hóa dịch vụ
        'csdlmucgiahhdv' => array(
            'index' => 1,
        ),
        'dinhgia' => array(
            'index' => 1,
        ),
        'giacldat' => array(
            'index' => 1,
        ),

        'kkgiacldat' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiacldat' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giadaugiadat' => array(
            'index' => 1,
        ),

        'kkgiadaugiadat' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiadaugiadat' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giathuedatnuoc' => array(
            'index' => 1,
        ),

        'kkgiathuedatnuoc' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiathuedatnuoc' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giarung' => array(
            'index' => 1,
        ),

        'kkgiarung' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiarung' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giathuemuanhaxh' => array(
            'index' => 1,
        ),

        'kkgiathuemuanhaxh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiathuemuanhaxh' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'gianuocsh' => array(
            'index' => 1,
        ),

        'kkgianuocsh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgianuocsh' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giathuetscong' => array(
            'index' => 1,
        ),

        'kkgiathuetscong' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiathuetscong' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giadvgddt' => array(
            'index' => 1,
        ),

        'kkgiadvgddt' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiadvgddt' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giadvkcb' => array(
            'index' => 1,
        ),

        'kkgiadvkcb' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiadvkcb' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giahhdvk' => array(
            'index' => 1,
        ),

        'kkgiahhdvk' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiahhdvk' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giathuetn' => array(
            'index' => 1,
        ),

        'kkgiathuetn' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiathuetn' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'gialephitruocba' => array(
            'index' => 1,
        ),

        'kkgialephitruocba' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgialephitruocba' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'giaphilephi' => array(
            'index' => 1,
        ),

        'kkgiaphilephi' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiaphilephi' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'bog' => array(
            'index' => 1,
        ),

        'bpbog' => array(
            'index' => 1,
        ),
        'kkbpbog' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thbpbog' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'dangkygia' => array(
            'index' => 1,
        ),
        'dkgxangdau' => array(
            'index' => 1,
        ),
        'ttdndkgxangdau' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgxangdau' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgxangdau' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgdien' => array(
            'index' => 1,
        ),
        'ttdndkgdien' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgdien' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgdien' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgkhidau' => array(
            'index' => 1,
        ),
        'ttdndkgkhidau' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgkhidau' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgkhidau' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgphan' => array(
            'index' => 1,
        ),
        'ttdndkgphan' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgphan' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgphan' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgthuocbvtv' => array(
            'index' => 1,
        ),
        'ttdndkgthuocbvtv' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgthuocbvtv' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgthuocbvtv' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgvacxingsgc' => array(
            'index' => 1,
        ),
        'ttdndkgvacxingsgc' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgvacxingsgc' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgvacxingsgc' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgmuoi' => array(
            'index' => 1,
        ),
        'ttdndkgmuoi' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgmuoi' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgmuoi' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgsuate6t' => array(
            'index' => 1,
        ),
        'ttdndkgsuate6t' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgsuate6t' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgsuate6t' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgduong' => array(
            'index' => 1,
        ),
        'ttdndkgduong' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgduong' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgduong' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgthocgao' => array(
            'index' => 1,
        ),
        'ttdndkgthocgao' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgthocgao' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgthocgao' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'dkgthuocpcb' => array(
            'index' => 1,
        ),
        'ttdndkgthuocpcb' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'thdkgthuocpcb' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'kkdkgthuocpcb' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),

        'kknygia' => array(
            'index' => 1,
        ),
        'ttdn' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'tacn' => array(
            'index' => 1,
        ),
        'kktacn' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thtacn' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),
        'dvlt' => array(
            'index' => 1,
        ),
        'dmdvlt' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkdvlt' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thdvlt' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),
        'dvvt' => array(
            'index' => 1,
            'xdttdn' => 1,
        ),
        'vtxk' => array(
            'index' => 1,
        ),
        'dmvtxk' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkvtxk' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thvtxk' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),
        'vtxb' => array(
            'index' => 1,
        ),
        'dmvtxb' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkvtxb' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thvtxb' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),
        'vtxtx' => array(
            'index' => 1,
        ),
        'dmvtxtx' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'kkvtxtx' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thvtxtx' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),
        'tpcnte6t' => array(
            'index' => 1,
        ),
        'kktpcnte6t' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thtpcnte6t' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
            'xdttdn' => 1,
        ),
        'vlxd' => array(
            'index' => 1,
        ),
        'dmvlxd' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'kkvlxd' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thvlxd' => array(
            'baocao' => 0,
            'congbo' => 0,
            'timkiem' => 0,
            'xdttdn' => 0,
        ),
        //End CSDL mức giá hàng hóa dịch vụ
        //CSDL thẩm định giá
        'csdlthamdinhgia' => array(
            'index' => 1,
        ),
        'thamdinhgia' => array(
            'index' => 1,
        ),

        'kkthamdinhgia' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'ththamdinhgia' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        'thamdinhgiahh' => array(
            'index' => 1,
        ),

        'kkthamdinhgiahh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'ththamdinhgiahh' => array(
            'baocao' => 1,
            'timkiem' => 1,
            'congbo' => 1,
        ),
        //End CSDL thẩm định giá
        //CSDL Văn bản quản lý nhà nước
        'csdlvbqlnn' => array(
            'index' => 1,
        ),
        'vbqlnn' => array(
            'index' => 1
        ),
        'vbgia' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'giacpi' => array(
            'index' => 1,
        ),

        'kkgiacpi' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        'thgiacpi' => array(
            'congbo' => 1,
            'baocao' => 1,
            'timkiem' => 1,
        ),
        //End CSDL Văn bản quản lý nhà nước
        //CSDL thông tin phục vụ công tác quản lý nhà nước về giá
        'csdlttpvctqlnn' => array(
            'index' => 1,
        ),

        //End CSDL thông tin phục vụ công tác quản lý nhà nước về giá
        //System
        'system' => array(
            'index' => 1,
        ),
        'ngaynghile' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'dmdiadanh' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'districts' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'towns' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'companies' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'users' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'copy' => 1,
            'per' => 1
        ),
        'register' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1,
        ),
        //End System
    );
    //End quyền xã

    $roles['DN'] = array(
        'csdlmucgiahhdv' => array(
            'index' => 1,
        ),
        'kknygia' => array(
            'index' => 1
        ),
        'kkgia' => array(
            'index' => 1,
        ),
        'ttdn' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1
        ),
    );

    return json_encode($roles[$level]);
}

function getGiaoDien()
{
    $gui = array();
    $gui['csdlmucgiahhdv'] = array(
        'index' => '0',
        'congbo' => '0',
        'dinhgia' => array(
            'index' => '0',
            'congbo' => '0',
            'giacldat' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',), //giacacloaidat
            'giadatduan' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',), //giadatduan
            'khunggiadat' => array('index' => '0', 'congbo' => '0', 'table' => 'khunggiadat', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giadatpl' => array('index' => '0', 'congbo' => '0', 'table' => 'giadatphanloai', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giadaugiadat' => array('index' => '0', 'congbo' => '0', 'table' => 'daugiadat', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giadatthitruong' => array('index' => '0', 'congbo' => '0', 'table' => 'giadatthitruong', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'daugiadatts' => array('index' => '0', 'congbo' => '0', 'table' => 'daugiadatts', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giathuetn' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giathuedatnuoc' => array('index' => '0', 'congbo' => '0', 'table' => 'giathuedatnuoc', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giarung' => array('index' => '0', 'congbo' => '0', 'table' => 'giarung', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giathuemuanhaxh' => array('index' => '0', 'congbo' => '0', 'table' => 'giathuemuanhaxh', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giathuenhacongvu' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',), //giathuenhacongvu
            'bannhataidinhcu' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'gianuocsh' => array('index' => '0', 'congbo' => '0', 'table' => 'gianuocsh', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giathuetscong' => array('index' => '0', 'congbo' => '0', 'table' => 'giathuetscong', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giathuetsdautu' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giadvgddt' => array('index' => '0', 'congbo' => '0', 'table' => 'giadvgddt', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giadvkcb' => array('index' => '0', 'congbo' => '0', 'table' => 'dvkcb', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'trogiatrocuoc' => array('index' => '0', 'congbo' => '0', 'table' => 'trogiatrocuoc', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giaspdvci' => array('index' => '0', 'congbo' => '0', 'table' => 'giaspdvci', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giahhdvcn' => array('index' => '0', 'congbo' => '0', 'table' => 'giahhdvcn', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giacuocvanchuyen' => array('index' => '0', 'congbo' => '0', 'table' => 'giacuocvanchuyen', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giaspdvcuthe' => array('index' => '0', 'congbo' => '0', 'table' => 'giaspdvcuthe', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giaspdvtoida' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => 'giaspdvtoida', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giaspdvkhunggia' => array('index' => '0', 'congbo' => '0', 'table' => 'giaspdvkhunggia', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
        'hhdv' => array(
            'index' => '0',
            'congbo' => '0',
            'giahhdvk' => array('index' => '0', 'congbo' => '0', 'table' => 'giahhdvk', 'url' => 'giahhdvk', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giathitruong' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',), //giathitruong
            'giavangngoaite' => array('index' => '0', 'congbo' => '0', 'table' => 'giavangngoaite', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
        'philephi' => array(
            'index' => '0',
            'congbo' => '0',
            'gialephitruocba' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'gialephitruocbanha' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giaphilephi' => array('index' => '0', 'congbo' => '0', 'table' => 'philephi', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'phichuyengia' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
        'taisan' => array(
            'index' => '0',
            'congbo' => '0',
            'thanhlytaisan' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',), //thanhlytaisan
            'giabatdongsan' => array('index' => '0', 'congbo' => '0', 'table' => 'giagdbatdongsan', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'muataisan' => array('index' => '0', 'congbo' => '0', 'table' => 'muataisan', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'giagocvlxd' => array('index' => '0', 'congbo' => '0', 'table' => 'giagocvlxd', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'taisancong' => array('index' => '0', 'congbo' => '0', 'table' => 'giataisancong', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
    );
    $gui['csdlkkgia'] = array(
        'index' => '0',
        'congbo' => '0',
        'thongtinkknygia' => array('index' => '0', 'congbo' => '0', 'table' => 'ttdntd', 'url' => '/doanhnghiep/xetduyet', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',), //xét duyệt thay đổi thông tin của đơn vị
        'bog' => array(
            'index' => '0',
            'congbo' => '0',
            'tacn' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiatacn', 'url' => 'xetduyetgiatacn', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'xangdau' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'kdm' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'sted6t' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'tgtt' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'pdurenpk' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'vxgxgc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'tbvtv' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'tpcb' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        ),
        'cp' => array(
            'index' => '0',
            'congbo' => '0',
            'xmtxd' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiaxmtxd', 'url' => 'xetduyetgiaxmtxd', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'nhao' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'congtrinh' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'than' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiathan', 'url' => 'xetduyetgiathan', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'etanol' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiaetanol', 'url' => 'xetduyetgiaetanol', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'khi' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'thuy' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'duong' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'muoi' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'dvcangbien' => array('index' => '0', 'congbo' => '0', 'table' => 'giadvcang', 'url' => 'xetduyetgiadvcang', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'duongsat' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'duongbo' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'tpcn' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgs', 'url' => 'xetduyetkkgiatpcnte6t', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'tbyt' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'kcbtn' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiakcbtn', 'url' => 'xetduyetgiakcbtn', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'vienthong' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        ),
        'kknygia' => array(
            'index' => '0',
            'congbo' => '0',
            'dvlt' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiadvlt', 'url' => 'xetduyetkkgiadvlt', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'trongxe' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'tqbien' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'vtxtx' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiavtxtx', 'url' => 'xetduyetkekhaigiavtxtx', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'vttqdl' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'vthh' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'vlxd' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiavlxd', 'url' => 'xetduyetkkgiavlxd', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'giongnn' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'chonndg' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'nuockhoang' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'cahue' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiadvch', 'url' => 'xetduyetkkgiadvcahue', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
            'hocphilx' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiahplx', 'url' => 'xetduyetkkgiahplx', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        ),
        // 'kknygia' => array(
        //     'index' => '0',
        //     'congbo' => '0',
        //     'thongtinkknygia' => array('index' => '0', 'congbo' => '0', 'table' => 'ttdntd', 'url' => '/doanhnghiep/xetduyet', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',), //xét duyệt thay đổi thông tin của đơn vị
        //     //bog
        //     'tacn' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiatacn', 'url' => 'xetduyetgiatacn', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'xangdau' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'kdm' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'sted6t' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'tgtt' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'pdurenpk' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'vxgxgc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'tbvtv' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'tpcb' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     //cp
        //     'xmtxd' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiaxmtxd', 'url' => 'xetduyetgiaxmtxd', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'nhao' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'congtrinh' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'than' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiathan', 'url' => 'xetduyetgiathan', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'etanol' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiaetanol', 'url' => 'xetduyetgiaetanol', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'khi' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'thuy' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'duong' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'muoi' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'dvcangbien' => array('index' => '0', 'congbo' => '0', 'table' => 'giadvcang', 'url' => 'xetduyetgiadvcang', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'duongsat' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'duongbo' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'tpcn' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgs', 'url' => 'xetduyetkkgiatpcnte6t', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'tbyt' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'kcbtn' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiakcbtn', 'url' => 'xetduyetgiakcbtn', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'vienthong' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     //kknygia
        //     'dvlt' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiadvlt', 'url' => 'xetduyetkkgiadvlt', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'trongxe' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'tqbien' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'vtxtx' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiavtxtx', 'url' => 'xetduyetkekhaigiavtxtx', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'vttqdl' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'vthh' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'vlxd' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiavlxd', 'url' => 'xetduyetkkgiavlxd', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'giongnn' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'chonndg' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'nuockhoang' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'cahue' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiadvch', 'url' => 'xetduyetkkgiadvcahue', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     'hocphilx' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiahplx', 'url' => 'xetduyetkkgiahplx', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),  
        //     // 'dvhdtmck' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiadvhdtm', 'url' => 'xetduyetkkgiadvhdtm', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     // 'giay' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiagiay', 'url' => 'xetduyetgiagiay', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     // 'sach' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiasach', 'url' => 'xetduyetgiasach', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     // 'oto' => array('index' => '0', 'congbo' => '0', 'table' => 'giaotonksx', 'url' => 'xetduyetgiaotonksx', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     // 'xemay' => array('index' => '0', 'congbo' => '0', 'table' => 'giaxemaynksx', 'url' => 'xetduyetgiaxemaynksx', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     // 'dvvtxk' => array('index' => '0', 'congbo' => '0', 'table' => 'giavtxk', 'url' => 'xetduyetkekhaigiavtxk', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     // 'dvvtxb' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiavtxb', 'url' => 'xetduyetkekhaigiavtxb', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     // 'dvvthk' => array('index' => '0', 'congbo' => '0', 'table' => 'giavtxk', 'url' => 'xetduyetkekhaigiavtxk', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     // 'dlbb' => array('index' => '0', 'congbo' => '0', 'table' => 'giadvdlbb', 'url' => 'xetduyetgiadvdlbb', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     // 'tqkdl' => array('index' => '0', 'congbo' => '0', 'table' => 'giavetqkdl', 'url' => 'xetduyetgiavetqkdl', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     // 'catsan' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiacatsan', 'url' => 'xetduyetkkgiacatsan', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     // 'datsanlap' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiadatsanlap', 'url' => 'xetduyetkkgiadatsanlap', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        //     // 'daxaydung' => array('index' => '0', 'congbo' => '0', 'table' => 'kkgiadaxaydung', 'url' => 'xetduyetkkgiadaxaydung', 'thoidiem' => 'ngaychuyen', 'trangthai' => 'HT', 'API' => '0',),
        // ),
    );
    $gui['csdlthamdinhgia'] = array(
        'index' => '0',
        'congbo' => '0',
        'thamdinhgia' => array(
            'index' => '0',
            'congbo' => '0',
            'dmhhthamdinhgia' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'dmdonvi' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'thamdinh' => array('index' => '0', 'congbo' => '0', 'table' => 'thamdinhgia', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'cungcapgia' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
    );
    $gui['csdlvbqlnn'] = array(
        'index' => '0',
        'congbo' => '0',
        'vbqlnn' => array(
            'index' => '0',
            'congbo' => '0',
            'vbgia' => array('index' => '0', 'congbo' => '0', 'table' => 'vanbanqlnn', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'chisogiatieudung' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'bcthvegia' => array('index' => '0', 'congbo' => '0', 'table' => 'bcthvegia', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),

        ),
    );
    $gui['csdlttpvctqlnn'] = array(
        'index' => '0',
        'congbo' => '0',
        'ttpvctqlnn' => array(
            'index' => '0',
            'congbo' => '0',
            'ttqlnn' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
    );
    $gui['thongke'] = array(
        'index' => '0',
        'congbo' => '0',
        'thongkehethong' => array(
            'index' => '0',
            'congbo' => '0',
            'nnnhaplieu' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'nntonghop' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'dnnhaplieu' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
    );
    $gui['csdlquocgia'] = array(
        'index' => '0',
        'congbo' => '0',
        'qg_giathuetn' => array(
            'index' => '0',
            'congbo' => '0',
            'nhandanhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'danhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'nhanhoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'hoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
        'qg_giahhdvcn' => array(
            'index' => '0',
            'congbo' => '0',
            'nhandanhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'danhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'nhanhoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'hoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
        'qg_giadvgddt' => array(
            'index' => '0',
            'congbo' => '0',
            'nhandanhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'danhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'nhanhoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'hoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
        'qg_giaspdvci' => array(
            'index' => '0',
            'congbo' => '0',
            'nhandanhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'danhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'nhanhoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'hoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
        'qg_giaphilephi' => array(
            'index' => '0',
            'congbo' => '0',
            'nhandanhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'danhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'nhanhoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'hoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
        'qg_giahhdvk' => array(
            'index' => '0',
            'congbo' => '0',
            'nhandanhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'danhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'nhanhoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'hoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
        'qg_thamdinhgia' => array(
            'index' => '0',
            'congbo' => '0',
            'nhandanhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'danhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'nhanhoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'hoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
        'qg_kkgiaetanol' => array(
            'index' => '0',
            'congbo' => '0',
            'nhanhoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'hoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
        'qg_kkgiadvlt' => array(
            'index' => '0',
            'congbo' => '0',
            'nhanhoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'hoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
        'qg_kkgiadvch' => array(
            'index' => '0',
            'congbo' => '0',
            'nhanhoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'hoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
        'qg_kkgiahplx' => array(
            'index' => '0',
            'congbo' => '0',
            'nhanhoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'hoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
        // 'qg_racthai' => array(
        //     'index' => '0',
        //     'congbo' => '0',
        //     'danhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        //     'hoso' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        // ),
        // 'qg_thuetainguyen' => array(
        //     'index' => '0',
        //     'congbo' => '0',
        //     'danhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        //     'hoso' => array('index' => '0', 'congbo' => '0', 'table' => 'giagdbatdongsan', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        // ),
        // 'qg_giathitruong' => array(
        //     'index' => '0',
        //     'congbo' => '0',
        //     'danhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        //     'hoso' => array('index' => '0', 'congbo' => '0', 'table' => 'giagdbatdongsan', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        // ),
        // 'qg_philephi' => array(
        //     'index' => '0',
        //     'congbo' => '0',
        //     'danhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        //     'hoso' => array('index' => '0', 'congbo' => '0', 'table' => 'giagdbatdongsan', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        // ),
        // 'qg_kekhaigia' => array(
        //     'index' => '0',
        //     'congbo' => '0',
        //     'danhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        //     'doituong' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        //     'doanhnghiep' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        //     'hoso' => array('index' => '0', 'congbo' => '0', 'table' => 'giagdbatdongsan', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        // ),
        // 'qg_dangkygia' => array(
        //     'index' => '0',
        //     'congbo' => '0',
        //     'danhmuc' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        //     'doituong' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        //     'doanhnghiep' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        //     'hoso' => array('index' => '0', 'congbo' => '0', 'table' => 'giagdbatdongsan', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        // ),
        // 'qg_thamdinhgia' => array(
        //     'index' => '0',
        //     'congbo' => '0',
        //     'hoidong' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        //     'hoso' => array('index' => '0', 'congbo' => '0', 'table' => 'giagdbatdongsan', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        // ),
    );
    $gui['hethong'] = array(
        'index' => '0',
        'congbo' => '0',
        'hethong_pq' => array(
            'index' => '0',
            'congbo' => '0',
            'danhsachdiaban' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'danhsachxaphuong' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'danhsachdonvi' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'danhsachtaikhoan' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'ngaynghile' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'danhmucnganhkd' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'danhmucdvt' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'dangky' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'chucnang' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'thongtin' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
            'api' => array('index' => '0', 'congbo' => '0', 'table' => '', 'url' => '', 'thoidiem' => 'thoidiem', 'trangthai' => 'HT', 'API' => '0',),
        ),
    );
    return $gui;
}

function getPhanQuyen()
{
    $gui = array();
    //csdl
    $gui['csdlmucgiahhdv'] = array(
        'index' => '0',
    );
    $gui['csdlkkgia'] = array(
        'index' => '0',
    );
    $gui['csdlthamdinhgia'] = array(
        'index' => '0',
    );
    $gui['csdlvbqlnn'] = array(
        'index' => '0',
    );
    $gui['csdlttpvctqlnn'] = array(
        'index' => '0',
    );
    $gui['thongke'] = array(
        'index' => '0',
    );
    $gui['hethong'] = array(
        'index' => '0',
    );
    $gui['csdlquocgia'] = array(
        'index' => '0',
    );


    //nhóm chức năng
    $gui['dinhgia'] = array(
        'index' => '0',
    );
    $gui['hhdv'] = array(
        'index' => '0',
    );
    $gui['philephi'] = array(
        'index' => '0',
    );
    $gui['taisan'] = array(
        'index' => '0',
    );
    $gui['thongtinkknygia'] = array(
        'index' => '0',
    );
    $gui['bog'] = array(
        'index' => '0',
    );
    $gui['cp'] = array(
        'index' => '0',
    );
    $gui['kknygia'] = array(
        'index' => '0',
    );
    $gui['thamdinhgia'] = array(
        'index' => '0',
    );
    $gui['vbqlnn'] = array(
        'index' => '0',
    );
    $gui['ttpvctqlnn'] = array(
        'index' => '0',
    );
    $gui['hethong_pq'] = array(
        'index' => '0',
    );
    $gui['thongkehethong'] = array(
        'index' => '0',
    );
    $gui['csdlquocgia'] = array(
        'index' => '0',
    );

    //chức năng chi tiết
    $gui['giacldat'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giadatduan'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['khunggiadat'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giadatpl'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giadaugiadat'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giadatthitruong'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('baocao' => '0', 'api' => '0',),
    );
    $gui['daugiadatts'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
    );
    $gui['giathuetn'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giathuedatnuoc'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giarung'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('baocao' => '0', 'api' => '0',),
    );
    $gui['giathuemuanhaxh'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('baocao' => '0', 'api' => '0',),
    );
    $gui['giathuenhacongvu'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['bannhataidinhcu'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['gianuocsh'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('baocao' => '0', 'api' => '0',),

    );
    $gui['giathuetscong'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('baocao' => '0', 'api' => '0',),
    );
    $gui['giathuetsdautu'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giadvgddt'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giadvkcb'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['trogiatrocuoc'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giaspdvci'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giahhdvcn'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giacuocvanchuyen'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giaspdvcuthe'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giaspdvtoida'] = array(
        'index' => '0',
        //        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giaspdvkhunggia'] = array(
        'index' => '0',
        //        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giahhdvk'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('baocao' => '0', 'api' => '0',),
    );
    $gui['giathitruong'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giavangngoaite'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('baocao' => '0', 'api' => '0',),
    );
    $gui['gialephitruocba'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['gialephitruocbanha'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giaphilephi'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['phichuyengia'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['thanhlytaisan'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giabatdongsan'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['muataisan'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['taisancong'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giagocvlxd'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );

    $gui['thongtinkknygia'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    //bog
    $gui['tacn'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['xangdau'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['kdm'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['sted6t'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['tgtt'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['pdurenpk'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['vxgxgc'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['tbvtv'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['tpcb'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    //cp
    $gui['xmtxd'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['nhao'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['congtrinh'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['than'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['etanol'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['khi'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['thuy'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['duong'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['muoi'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['dvcangbien'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['duongsat'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['duongbo'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['tpcn'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['tbyt'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['kcbtn'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['vienthong'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    //kknygia
    $gui['dvlt'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['trongxe'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['tqbien'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['vtxtx'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['vttqdl'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['vthh'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['vlxd'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['giongnn'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['chonndg'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['nuockhoang'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['cahue'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['hocphilx'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );

    $gui['dmhhthamdinhgia'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['dmdonvi'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['thamdinh'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['cungcapgia'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
        'khac' => array('api' => '0',),
    );
    $gui['vbgia'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
    );
    $gui['chisogiatieudung'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
    );
    $gui['bcthvegia'] = array(
        'index' => '0',
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
    );
    $gui['ttqlnn'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0',),
        'hoso' => array('index' => '0', 'modify' => '0', 'approve' => '0',),
    );


    $gui['nnnhaplieu'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0'),
    );
    $gui['nntonghop'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0'),
    );
    $gui['dnnhaplieu'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0'),
    );

    $gui['danhsachdiaban'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0'),
    );

    $gui['danhsachxaphuong'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0'),
    );
    $gui['danhsachdonvi'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0'),
    );

    $gui['danhsachtaikhoan'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0'),
    );

    $gui['nhomtaikhoan'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0'),
    );

    $gui['ngaynghile'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0'),
    );

    $gui['danhmucnganhkd'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0'),
    );

    $gui['danhmucdvt'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0'),
    );

    $gui['dangky'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0'),
    );

    $gui['chucnang'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0'),
    );

    $gui['thongtin'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0'),
    );

    $gui['api'] = array(
        'index' => '0',
        'danhmuc' => array('index' => '0', 'modify' => '0'),
    );

    // $gui['qg_thuetainguyen'] = array(
    //     'index' => '0',
    //     'danhmuc' => array('index' => '0', 'modify' => '0'),
    //     'hoso' => array('index' => '0', 'modify' => '0'),
    // );
    return $gui;
}

function getAPIThietLapMacDinh($maso)
{
    $MacDinh = [];
    //Thiết lập chung về tham số API
    $MacDinh['Header'] = [
        ['stt' => '1', 'phanloai' => 'Header', 'tendong' => 'Version', 'mota' => 'Tên phiên bản XML truyền nhận dữ liệu', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '250', 'batbuoc' => '1', 'macdinh' => '1.0', 'ghichu' => '',],
        ['stt' => '2', 'phanloai' => 'Header', 'tendong' => 'Sender_Code', 'mota' => 'Mã nơi gửi, giá trị thay đổi qua các nút truyền dữ liệu.', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '50', 'batbuoc' => '1', 'macdinh' => '', 'ghichu' => '',],
        ['stt' => '3', 'phanloai' => 'Header', 'tendong' => 'Sender_Name', 'mota' => 'Tên nơi gửi, giá trị thay đổi qua các nút truyền dữ liệu.', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '250', 'batbuoc' => '1', 'macdinh' => '', 'ghichu' => '',],
        ['stt' => '4', 'phanloai' => 'Header', 'tendong' => 'Receiver_Code', 'mota' => 'Mã nơi nhận, giá trị thay đổi qua các nút truyền dữ liệu.', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '50', 'batbuoc' => '1', 'macdinh' => '', 'ghichu' => '',],
        ['stt' => '5', 'phanloai' => 'Header', 'tendong' => 'Receiver_Name', 'mota' => 'Tên nơi nhận, giá trị thay đổi qua các nút truyền dữ liệu.', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '250', 'batbuoc' => '1', 'macdinh' => '', 'ghichu' => '',],
        ['stt' => '6', 'phanloai' => 'Header', 'tendong' => 'Tran_Code', 'mota' => 'Mã loại dữ liệu trao đổi', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '10', 'batbuoc' => '1', 'macdinh' => '', 'ghichu' => '',],
        ['stt' => '7', 'phanloai' => 'Header', 'tendong' => 'Tran_Name', 'mota' => 'Tên loại dữ liệu trao đổi', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '150', 'batbuoc' => '1', 'macdinh' => '', 'ghichu' => '',],
        ['stt' => '8', 'phanloai' => 'Header', 'tendong' => 'Msg_ID', 'mota' => 'Mã gói tin. Mã gói tin sẽ thay đổi qua các nút truyền dữ liệu.', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '50', 'batbuoc' => '1', 'macdinh' => '', 'ghichu' => '',],
        ['stt' => '9', 'phanloai' => 'Header', 'tendong' => 'Msg_RefID', 'mota' => 'Mã gói tham chiếu. Đây là mã gói được sinh ra tại ứng dụng gốc qua các nút truyền nhận mã không thay đổi', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '50', 'batbuoc' => '1', 'macdinh' => '', 'ghichu' => '',],
        ['stt' => '10', 'phanloai' => 'Header', 'tendong' => 'Send_Date', 'mota' => 'Ngày gửi gói tin, giá trị Send Date thay đổi qua các nút truyền dữ liệu.', 'kieudulieu' => 'String', 'dinhdang' => 'DD/MM/YYYY HH24:MI:SS', 'dodai' => '19', 'batbuoc' => '1', 'macdinh' => '', 'ghichu' => '',],
        ['stt' => '11', 'phanloai' => 'Header', 'tendong' => 'Original_Code', 'mota' => 'Mã gốc nơi gửi dữ liệu', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '50', 'batbuoc' => '1', 'macdinh' => '', 'ghichu' => '',],
        ['stt' => '12', 'phanloai' => 'Header', 'tendong' => 'Original_name', 'mota' => 'Tên gốc nơi gửi dữ liệu', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '250', 'batbuoc' => '1', 'macdinh' => '', 'ghichu' => '',],
        ['stt' => '13', 'phanloai' => 'Header', 'tendong' => 'Export_Date', 'mota' => 'Ngày đóng gói gói tin tại ứng dụng nguồn, khi gửi qua các nút truyền dữ liệu thì giá trị Export_Date không thay đổi', 'kieudulieu' => 'String', 'dinhdang' => 'DD/MM/YYYY HH24:MI:SS', 'dodai' => '19', 'batbuoc' => '1', 'macdinh' => '', 'ghichu' => '',],
        ['stt' => '14', 'phanloai' => 'Header', 'tendong' => 'Notes', 'mota' => 'Trường hợp này phục vụ rẽ nhánh dữ liệu trong trường hợp cùng một mã loại dữ liệu được gửi cho nhiều nơi khác nhau nhưng thông tin chi tiết của gói tin không giống nhau. Trục sẽ sử dụng thông tin này để gửi đến đúng đích.', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '5', 'batbuoc' => '0', 'macdinh' => '', 'ghichu' => '',],
        ['stt' => '15', 'phanloai' => 'Header', 'tendong' => 'Tran_Num', 'mota' => 'Tổng số dòng trong phần body', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '5', 'batbuoc' => '1', 'macdinh' => '', 'ghichu' => '',],
        ['stt' => '16', 'phanloai' => 'Header', 'tendong' => 'Path', 'mota' => 'Đường dẫn của gói tin. Mỗi gói tin đi qua nút chuyển dữ liệu, nút đó điền thêm thông tin vào đường dẫn của gói tin này.', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '50', 'batbuoc' => '1', 'macdinh' => '', 'ghichu' => '',],
        ['stt' => '17', 'phanloai' => 'Header', 'tendong' => 'NumMsg_InGroup', 'mota' => 'Số lượng của gói tin tách ra, thành bao nhiêu gói tin nhỏ.', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '3', 'batbuoc' => '1', 'macdinh' => '', 'ghichu' => 'Khi một gói tin có số lượng dòng lớn hơn 5000 phải tách thành các gói tin nhỏ hơn (gói lớn nhất có số dòng = 5000)',],
        ['stt' => '18', 'phanloai' => 'Header', 'tendong' => 'SPARE1', 'mota' => 'Trường thông tin dự phòng. Hiện tại, dữ liệu xuất phát từ DMDC sử dụng để đưa thông tin từ user webservice được hệ thống DMDC cấp cho ứng dụng để trao đổi dữ liệu', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '10', 'batbuoc' => '0', 'macdinh' => '', 'ghichu' => 'Hệ thống DMDC cung cấp qua văn bản đến các ứng dụng',],
        ['stt' => '19', 'phanloai' => 'Header', 'tendong' => 'SPARE2', 'mota' => 'Trường thông tin dự phòng. Hiện tại, dữ liệu xuất phát từ DMDC sử dụng để đưa thông tin mật khẩu webservice được hệ thống DMDC cấp cho ứng dụng để trao đổi dữ liệu', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '10', 'batbuoc' => '0', 'macdinh' => '', 'ghichu' => 'Hệ thống DMDC cung cấp qua văn bản đến các ứng dụng',],
        ['stt' => '20', 'phanloai' => 'Header', 'tendong' => 'SPARE3', 'mota' => 'Trường thông tin dự phòng. Hiện tại dữ liệu xuất phát từ DMDC sử dụng để đưa thông tin giá trị quy định DMDC nhận dữ liệu hay cung cấp dữ liệu.', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '10', 'batbuoc' => '0', 'macdinh' => '', 'ghichu' => '0: PUT (đẩy dữ liệu)1: GET (Nhận dữ liệu)',],
        ['stt' => '21', 'phanloai' => 'Header', 'tendong' => 'Finish_Code', 'mota' => 'Dùng để phân biệt gói phản hồi đối soát dữ liệu', 'kieudulieu' => 'String', 'dinhdang' => '', 'dodai' => '50', 'batbuoc' => '0', 'macdinh' => '', 'ghichu' => '',],
    ];

    //Thiết lập Hồ sơ kê khai giá
    $MacDinh['KeKhaiGia'] = [
        //Hồ sơ kê khai
        'HOSO' => [
            ['tentruong' => 'NULL', 'macdinh' => 'GET_DIABAN', 'dinhdang' => '', 'stt' => '1', 'tendong' => 'DIA_BAN', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '2', 'dinhdang' => '', 'stt' => '2', 'tendong' => 'MAU_BIEU', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'plhs', 'macdinh' => '', 'dinhdang' => '', 'stt' => '3', 'tendong' => 'LOAI_HO_SO', 'kieudulieu' => 'NUMBER', 'dodai' => '1', 'batbuoc' => '1', 'ghichu' => 'NUMBER',],
            ['tentruong' => 'NULL', 'macdinh' => '0', 'dinhdang' => '', 'stt' => '4', 'tendong' => 'LOAI_XNK', 'kieudulieu' => 'NUMBER', 'dodai' => '1', 'batbuoc' => '1', 'ghichu' => 'NUMBER',],
            ['tentruong' => 'madv', 'macdinh' => '', 'dinhdang' => '', 'stt' => '5', 'tendong' => 'DOANH_NGHIEP_DKKK', 'kieudulieu' => 'STRING', 'dodai' => '100', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'socv', 'macdinh' => '', 'dinhdang' => '', 'stt' => '6', 'tendong' => 'SO_VAN_BAN', 'kieudulieu' => 'STRING', 'dodai' => '100', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'ngaynhap', 'macdinh' => '', 'dinhdang' => 'DD/MM/YY', 'stt' => '7', 'tendong' => 'NGAY_THUC_HIEN', 'kieudulieu' => 'STRING(DATE)', 'dodai' => '8', 'batbuoc' => '1', 'ghichu' => 'STRING(DATE)',],
            ['tentruong' => 'ngayhieuluc', 'macdinh' => '', 'dinhdang' => 'DD/MM/YY', 'stt' => '8', 'tendong' => 'NGAY_BD_HIEU_LUC', 'kieudulieu' => 'STRING(DATE)', 'dodai' => '8', 'batbuoc' => '1', 'ghichu' => 'STRING(DATE)',],
            ['tentruong' => 'madv', 'macdinh' => '', 'dinhdang' => '', 'stt' => '9', 'tendong' => 'DONVI_TTSL', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '10', 'tendong' => 'QUOC_GIA_XNK', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '11', 'tendong' => 'CHI_NHANH', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '12', 'tendong' => 'KHO_HANG', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '13', 'tendong' => 'TINH_THANH', 'kieudulieu' => 'STRING', 'dodai' => '1000', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '14', 'tendong' => 'DOI_TUONG_AP_DUNG', 'kieudulieu' => 'STRING', 'dodai' => '1000', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '12', 'tendong' => 'TY_GIA', 'kieudulieu' => 'NUMBER', 'dodai' => '(18,0)', 'batbuoc' => '0', 'ghichu' => 'NUMBER',],
            ['tentruong' => 'NULL', 'macdinh' => 'GET_NGUOI_KY', 'dinhdang' => '', 'stt' => '16', 'tendong' => 'NGUOI_KY', 'kieudulieu' => 'STRING', 'dodai' => '500', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'ngaychuyen', 'macdinh' => '', 'dinhdang' => 'DD/MM/YY', 'stt' => '17', 'tendong' => 'NGAY_KY', 'kieudulieu' => 'STRING(DATE)', 'dodai' => '8', 'batbuoc' => '0', 'ghichu' => 'STRING(DATE)',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '18', 'tendong' => 'TRICH_YEU', 'kieudulieu' => 'STRING', 'dodai' => '4000', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '19', 'tendong' => 'PHAN_TICH_NGUYEN_NHAN', 'kieudulieu' => 'STRING', 'dodai' => '4000', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'mahinhthucthanhtoan', 'macdinh' => '', 'dinhdang' => '', 'stt' => '20', 'tendong' => 'HINH_THUC_THANH_TOAN', 'kieudulieu' => 'STRING', 'dodai' => '1000', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '21', 'tendong' => 'NGUOI_TAO', 'kieudulieu' => 'STRING', 'dodai' => '1000', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => 'DD/MM/YY', 'stt' => '22', 'tendong' => 'NGAY_TAO', 'kieudulieu' => 'STRING(DATE)', 'dodai' => '8', 'batbuoc' => '0', 'ghichu' => 'STRING(DATE)',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '23', 'tendong' => 'NGUOI_DUYET', 'kieudulieu' => 'STRING', 'dodai' => '1000', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => 'DD/MM/YY', 'stt' => '24', 'tendong' => 'NGAY_DUYET', 'kieudulieu' => 'STRING(DATE)', 'dodai' => '8', 'batbuoc' => '0', 'ghichu' => 'STRING(DATE)',],
            ['tentruong' => 'DS_HHDV', 'macdinh' => '', 'dinhdang' => '', 'stt' => '25', 'tendong' => 'DS_HHDV_DKG', 'kieudulieu' => 'OBJECT', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'OBJECT',],
            ['tentruong' => 'DS_FILE_DINH_KEM', 'macdinh' => '', 'dinhdang' => '', 'stt' => '26', 'tendong' => 'DS_FILE_DINH_KEM', 'kieudulieu' => 'OBJECT', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'OBJECT',],
        ],
        'CHITIET' => [
            //Danh sách hàng hoá
            ['tentruong' => 'maloaigia', 'macdinh' => '1', 'dinhdang' => '', 'stt' => '1', 'tendong' => 'LOAI_GIA', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING', 'tendong_goc' => 'DS_HHDV_DKG'],
            ['tentruong' => 'NULL', 'macdinh' => 'MA_HHDV', 'dinhdang' => '', 'stt' => '2', 'tendong' => 'MA_HHDV', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING', 'tendong_goc' => 'DS_HHDV_DKG'],
            ['tentruong' => 'gialk', 'macdinh' => '', 'dinhdang' => '', 'stt' => '3', 'tendong' => 'MUC_GIA_CU', 'kieudulieu' => 'NUMBER', 'dodai' => '(18,0)', 'batbuoc' => '1', 'ghichu' => 'NUMBER', 'tendong_goc' => 'DS_HHDV_DKG'],
            ['tentruong' => 'giakk', 'macdinh' => '', 'dinhdang' => '', 'stt' => '4', 'tendong' => 'MUC_GIA_MOI', 'kieudulieu' => 'NUMBER', 'dodai' => '(18,0)', 'batbuoc' => '1', 'ghichu' => 'NUMBER', 'tendong_goc' => 'DS_HHDV_DKG'],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '5', 'tendong' => 'MUC_TANG_GIAM', 'kieudulieu' => 'NUMBER', 'dodai' => '(18,0)', 'batbuoc' => '1', 'ghichu' => 'NUMBER', 'tendong_goc' => 'DS_HHDV_DKG'],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '6', 'tendong' => 'TY_LE', 'kieudulieu' => 'NUMBER', 'dodai' => '(18,0)', 'batbuoc' => '1', 'ghichu' => 'NUMBER', 'tendong_goc' => 'DS_HHDV_DKG'],
            ['tentruong' => 'ghichu', 'macdinh' => '', 'dinhdang' => '', 'stt' => '7', 'tendong' => 'GHI_CHU', 'kieudulieu' => 'STRING', 'dodai' => '4000', 'batbuoc' => '', 'ghichu' => 'STRING', 'tendong_goc' => 'DS_HHDV_DKG'],
            //Danh sách file đính kem
            ['tentruong' => 'giakk', 'macdinh' => '11', 'dinhdang' => '', 'stt' => '1', 'tendong' => 'MA_LOAI_FILE', 'kieudulieu' => 'NUMBER', 'dodai' => '(18,1)', 'batbuoc' => '1', 'ghichu' => 'NUMBER', 'tendong_goc' => 'DS_FILE_DINH_KEM'],
            ['tentruong' => 'ipf1', 'macdinh' => '', 'dinhdang' => '', 'stt' => '2', 'tendong' => 'TEN_FILE', 'kieudulieu' => 'STRING', 'dodai' => '100', 'batbuoc' => '', 'ghichu' => 'STRING', 'tendong_goc' => 'DS_FILE_DINH_KEM'],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '3', 'tendong' => 'FILE_DINH_KEM', 'kieudulieu' => 'STRING(BASES64)', 'dodai' => '', 'batbuoc' => '', 'ghichu' => 'STRING', 'tendong_goc' => 'DS_FILE_DINH_KEM'],

        ],
    ];

    //Thiết lập Danh sách doanh nghiệp kê khai giá
    $MacDinh['dsdoanhnghiep'] = [
        'HOSO' => [
            ['tentruong' => 'NULL', 'macdinh' => 'GET_DIABAN', 'dinhdang' => '', 'stt' => '1', 'tendong' => 'DIA_BAN', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'tendn', 'macdinh' => '', 'dinhdang' => '', 'stt' => '2', 'tendong' => 'TEN_DOANH_NGHIEP', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'madv', 'macdinh' => '', 'dinhdang' => '', 'stt' => '3', 'tendong' => 'MA_SO_THUE', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'diachi', 'macdinh' => '', 'dinhdang' => '', 'stt' => '4', 'tendong' => 'DIA_CHI', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '2', 'dinhdang' => '', 'stt' => '5', 'tendong' => 'LOAI_DN_KINH_DOANH', 'kieudulieu' => 'NUMBER', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'NUMBER',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '6', 'tendong' => 'DON_VI_DKKK_GIA', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'ghichu', 'macdinh' => '', 'dinhdang' => '', 'stt' => '7', 'tendong' => 'GHI_CHU', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '0', 'ghichu' => 'STRING',],
        ],
    ];

    //Thiết lập Danh mục hàng hóa, dịch vụ kê khai giá 
    //2023.08.10 Chưa có chức năng danh mục
    $MacDinh['dmhanghoakkg'] = [
        'HOSO' => [
            ['tentruong' => 'NULL', 'macdinh' => 'GET_DIABAN', 'dinhdang' => '', 'stt' => '1', 'tendong' => 'DIA_BAN', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'madv', 'macdinh' => '', 'dinhdang' => '', 'stt' => '2', 'tendong' => 'MA_SO_THUE', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'mahhdv', 'macdinh' => '', 'dinhdang' => '', 'stt' => '3', 'tendong' => 'MA_HHDV', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'mahhdv', 'macdinh' => '', 'dinhdang' => '', 'stt' => '4', 'tendong' => 'TEN_THI_TRUONG_HHDV', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '2', 'dinhdang' => '', 'stt' => '5', 'tendong' => 'LOAI_DKKK', 'kieudulieu' => 'NUMBER', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'NUMBER',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '6', 'tendong' => 'MA_HANG_HOA_DICH_VU', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'dvt', 'macdinh' => '', 'dinhdang' => '', 'stt' => '7', 'tendong' => 'DON_VI_TINH', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'quycach', 'macdinh' => '', 'dinhdang' => '', 'stt' => '8', 'tendong' => 'QUY_CACH', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'ghichu', 'macdinh' => '', 'dinhdang' => '', 'stt' => '9', 'tendong' => 'GHI_CHU', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '0', 'ghichu' => 'STRING',],
        ],
    ];

    //Thiết lập Hồ sơ hàng hóa thị trường
    $MacDinh['giahhdvk'] = [
        'HOSO' => [
            ['tentruong' => 'NULL', 'macdinh' => 'GET_DIABAN', 'dinhdang' => '', 'stt' => '1', 'tendong' => 'DIA_BAN', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '2', 'dinhdang' => '', 'stt' => '2', 'tendong' => 'NGUON_SO_LIEU', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '24', 'dinhdang' => '', 'stt' => '3', 'tendong' => 'DINH_KY', 'kieudulieu' => 'NUMBER', 'dodai' => '2', 'batbuoc' => '1', 'ghichu' => 'NUMBER',],
            ['tentruong' => 'NULL', 'macdinh' => '1', 'dinhdang' => '', 'stt' => '4', 'tendong' => 'THOI_GIAN_BC_1', 'kieudulieu' => 'NUMBER', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'NUMBER',],
            ['tentruong' => 'thang', 'macdinh' => '', 'dinhdang' => '', 'stt' => '5', 'tendong' => 'THOI_GIAN_BC_2', 'kieudulieu' => 'NUMBER', 'dodai' => '3', 'batbuoc' => '0', 'ghichu' => 'NUMBER',],
            ['tentruong' => 'nam', 'macdinh' => '', 'dinhdang' => '', 'stt' => '6', 'tendong' => 'THOI_GIAN_BC_NAM', 'kieudulieu' => 'NUMBER', 'dodai' => '4', 'batbuoc' => '1', 'ghichu' => 'NUMBER',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '7', 'tendong' => 'FILE_DINH_KEM_WORD', 'kieudulieu' => 'STRING(BASES64)', 'dodai' => '', 'batbuoc' => '', 'ghichu' => 'STRING(BASES64)',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '8', 'tendong' => 'FILE_DINH_KEM_PDF', 'kieudulieu' => 'STRING(BASES64)', 'dodai' => '', 'batbuoc' => '', 'ghichu' => 'STRING(BASES64)',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '9', 'tendong' => 'NGUOI_TAO', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '10', 'tendong' => 'NGUOI_DUYET', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '', 'ghichu' => 'STRING',],
            ['tentruong' => 'DS_HHDV', 'macdinh' => '', 'dinhdang' => '', 'stt' => '11', 'tendong' => 'DS_HHDV_TT', 'kieudulieu' => 'OBJECT', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'OBJECT',],
        ],
        'CHITIET' => [
            ['tentruong' => 'maloaigia', 'macdinh' => '1', 'dinhdang' => '', 'stt' => '1', 'tendong' => 'LOAI_GIA', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING', 'tendong_goc' => 'DS_HHDV_TT'],
            ['tentruong' => 'mahhdv', 'macdinh' => '', 'dinhdang' => '', 'stt' => '2', 'tendong' => 'MA_HHDV', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING', 'tendong_goc' => 'DS_HHDV_TT'],
            ['tentruong' => 'NULL', 'macdinh' => 'GET_TEN_HHDV', 'dinhdang' => '', 'stt' => '3', 'tendong' => 'TEN_HANG_HOA_DICH_VU', 'kieudulieu' => 'STRING', 'dodai' => '1000', 'batbuoc' => '1', 'ghichu' => 'STRING', 'tendong_goc' => 'DS_HHDV_TT'],
            ['tentruong' => 'NULL', 'macdinh' => 'GET_DVT_HHDV', 'dinhdang' => '', 'stt' => '4', 'tendong' => 'DON_VI_TINH', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING', 'tendong_goc' => 'DS_HHDV_TT'],
            ['tentruong' => 'gialk', 'macdinh' => '', 'dinhdang' => '', 'stt' => '5', 'tendong' => 'GIA_KY_TRUOC', 'kieudulieu' => 'NUMBER', 'dodai' => '(18,0)', 'batbuoc' => '0', 'ghichu' => 'NUMBER', 'tendong_goc' => 'DS_HHDV_TT'],
            ['tentruong' => 'gia', 'macdinh' => '', 'dinhdang' => '', 'stt' => '6', 'tendong' => 'GIA_KY_NAY', 'kieudulieu' => 'NUMBER', 'dodai' => '(18,0)', 'batbuoc' => '1', 'ghichu' => 'NUMBER', 'tendong_goc' => 'DS_HHDV_TT'],
            ['tentruong' => 'NULL', 'macdinh' => 'GET_NGUONTT', 'dinhdang' => '', 'stt' => '7', 'tendong' => 'NGUON_THONG_TIN', 'kieudulieu' => 'NUMBER', 'dodai' => '1', 'batbuoc' => '1', 'ghichu' => 'NUMBER', 'tendong_goc' => 'DS_HHDV_TT'],
            ['tentruong' => 'ghichu', 'macdinh' => '', 'dinhdang' => '', 'stt' => '8', 'tendong' => 'GHI_CHU', 'kieudulieu' => 'STRING', 'dodai' => '4000', 'batbuoc' => '0', 'ghichu' => 'STRING', 'tendong_goc' => 'DS_HHDV_TT'],
        ],
    ];

    //Thiết lập hồ sơ giá tính thuế tài nguyên
    $MacDinh['giathuetn'] = [
        'HOSO' => [
            ['tentruong' => 'NULL', 'macdinh' => 'GET_DIABAN', 'dinhdang' => '', 'stt' => '1', 'tendong' => 'DIA_BAN', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '2', 'tendong' => 'DONVI_TTSL', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '3', 'tendong' => 'NGUON_SO_LIEU', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'soqd', 'macdinh' => '', 'dinhdang' => '', 'stt' => '4', 'tendong' => 'SO_VAN_BAN', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'thoidiem', 'macdinh' => '', 'dinhdang' => '', 'stt' => '5', 'tendong' => 'NGAY_THUC_HIEN', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'thoidiem', 'macdinh' => '', 'dinhdang' => '', 'stt' => '6', 'tendong' => 'NGAY_BD_HIEU_LUC', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '7', 'tendong' => 'NGAY_KT_HIEU_LUC', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '8', 'tendong' => 'NGUOI_TAO', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '9', 'tendong' => 'NGUOI_DUYET', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'DS_TAI_NGUYEN_CT', 'macdinh' => '', 'dinhdang' => '', 'stt' => '10', 'tendong' => 'DS_TAI_NGUYEN_CT', 'kieudulieu' => 'OBJECT', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'OBJECT',],
        ],
        'CHITIET' => [
            ['tentruong' => 'mathuetn', 'macdinh' => '1', 'dinhdang' => '', 'stt' => '1', 'tendong' => 'MA_TAI_NGUYEN', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING', 'tendong_goc' => 'DS_TAI_NGUYEN_CT'],
            ['tentruong' => 'gia', 'macdinh' => '', 'dinhdang' => '', 'stt' => '2', 'tendong' => 'GIA_TINH_THUE', 'kieudulieu' => 'NUMBER', 'dodai' => '(18,0)', 'batbuoc' => '0', 'ghichu' => 'NUMBER', 'tendong_goc' => 'DS_TAI_NGUYEN_CT'],
            ['tentruong' => 'NULL', 'macdinh' => '0', 'dinhdang' => '', 'stt' => '3', 'tendong' => 'THUE_SUAT', 'kieudulieu' => 'NUMBER', 'dodai' => '(18,0)', 'batbuoc' => '1', 'ghichu' => 'NUMBER', 'tendong_goc' => 'DS_TAI_NGUYEN_CT'],
            ['tentruong' => 'ghichu', 'macdinh' => '', 'dinhdang' => '', 'stt' => '4', 'tendong' => 'GHI_CHU', 'kieudulieu' => 'STRING', 'dodai' => '4000', 'batbuoc' => '0', 'ghichu' => 'STRING', 'tendong_goc' => 'DS_TAI_NGUYEN_CT'],
        ],
    ];

    //Thiết lập DANH MỤC GIÁ HÀNG HOÁ THỊ TRƯỜNG
    $MacDinh['dmgiahhdvk'] = [
        'HOSO' => [
            ['tentruong' => 'NULL', 'macdinh' => 'GET_DIABAN', 'dinhdang' => '', 'stt' => '1', 'tendong' => 'DIA_BAN', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'manhom', 'macdinh' => '', 'dinhdang' => '', 'stt' => '2', 'tendong' => 'NHOM_HHDV', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'mahhdv', 'macdinh' => '', 'dinhdang' => '', 'stt' => '3', 'tendong' => 'MA_HHDV', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => '', 'macdinh' => '1', 'dinhdang' => '', 'stt' => '4', 'tendong' => 'MA_HHDV_TINH_THANH', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'tenhhdv', 'macdinh' => '', 'dinhdang' => '', 'stt' => '5', 'tendong' => 'TEN_HHDV_TINH_THANH', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'dacdiemkt', 'macdinh' => '', 'dinhdang' => '', 'stt' => '6', 'tendong' => 'DAC_DIEM_KY_THUAT', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'dvt', 'macdinh' => '', 'dinhdang' => '', 'stt' => '7', 'tendong' => 'DON_VI_TINH', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '8', 'tendong' => 'NGUOI_TAO', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '', 'ghichu' => 'STRING',],
        ],
    ];

    //Thiết lập DANH MỤC GIÁ THUẾ TÀI NGUYÊN
    $MacDinh['dmgiathuetn'] = [
        'HOSO' => [
            ['tentruong' => 'NULL', 'macdinh' => 'GET_DIABAN', 'dinhdang' => '', 'stt' => '1', 'tendong' => 'DIA_BAN', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'mathuetn', 'macdinh' => '', 'dinhdang' => '', 'stt' => '2', 'tendong' => 'MA_TAI_NGUYEN', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'ten', 'macdinh' => '', 'dinhdang' => '', 'stt' => '3', 'tendong' => 'TEN_TAI_NGUYEN', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'level', 'macdinh' => '1', 'dinhdang' => '', 'stt' => '4', 'tendong' => 'CAP_TAI_NGUYEN', 'kieudulieu' => 'NUMBER', 'dodai' => '1', 'batbuoc' => '1', 'ghichu' => 'NUMBER',],
            ['tentruong' => 'dvt', 'macdinh' => '', 'dinhdang' => '', 'stt' => '5', 'tendong' => 'DON_VI_TINH', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '', 'ghichu' => 'STRING',],
            ['tentruong' => 'mathuetn_goc', 'macdinh' => '', 'dinhdang' => '', 'stt' => '6', 'tendong' => 'MA_TAI_NGUYEN_TINH_CHA', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'mathuetn', 'macdinh' => '', 'dinhdang' => '', 'stt' => '7', 'tendong' => 'TAI_NGUYEN_BTC', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '0', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '8', 'tendong' => 'NGUOI_TAO', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '', 'ghichu' => 'STRING',],
        ],
    ];

    //Thiết lập Danh mục dịch vụ thu gom rác thải (dịch vụ công ích)
    $MacDinh['dmgiaspdvci'] = [
        'HOSO' => [
            ['tentruong' => 'NULL', 'macdinh' => 'GET_DIABAN', 'dinhdang' => '', 'stt' => '1', 'tendong' => 'DIA_BAN', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'maspdv', 'macdinh' => '', 'dinhdang' => '', 'stt' => '2', 'tendong' => 'MA_DV_VCTG', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'tenspdv', 'macdinh' => '', 'dinhdang' => '', 'stt' => '3', 'tendong' => 'TEN_DV_VCTG', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'mota', 'macdinh' => '1', 'dinhdang' => '', 'stt' => '4', 'tendong' => 'MO_TA', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'dvt', 'macdinh' => '', 'dinhdang' => '', 'stt' => '5', 'tendong' => 'DON_VI_TINH', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '6', 'tendong' => 'NGUOI_TAO', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '', 'ghichu' => 'STRING',],
        ],
    ];

    //Thiết lập Hồ sơ giá dịch vụ thu gom rác thải (dịch vụ công ích)
    $MacDinh['giaspdvci'] = [
        'HOSO' => [
            ['tentruong' => 'NULL', 'macdinh' => 'GET_DIABAN', 'dinhdang' => '', 'stt' => '1', 'tendong' => 'DIA_BAN', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '2', 'tendong' => 'DONVI_TTSL', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '3', 'tendong' => 'NGUON_SO_LIEU', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'soqd', 'macdinh' => '', 'dinhdang' => '', 'stt' => '4', 'tendong' => 'SO_VAN_BAN', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'thoidiem', 'macdinh' => '', 'dinhdang' => '', 'stt' => '5', 'tendong' => 'NGAY_THUC_HIEN', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'thoidiem', 'macdinh' => '', 'dinhdang' => '', 'stt' => '6', 'tendong' => 'NGAY_BD_HIEU_LUC', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '7', 'tendong' => 'NGAY_KT_HIEU_LUC', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '8', 'tendong' => 'NGUOI_TAO', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '9', 'tendong' => 'NGUOI_DUYET', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '82001', 'dinhdang' => '', 'stt' => '10', 'tendong' => 'MA_BM', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '11', 'tendong' => 'FILE_SO_LIEU', 'kieudulieu' => 'STRING(BASES64)', 'dodai' => '', 'batbuoc' => '', 'ghichu' => 'STRING(BASES64)',],
            ['tentruong' => 'ipf1', 'macdinh' => '', 'dinhdang' => '', 'stt' => '12', 'tendong' => 'TEN_FILE', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
        ],
    ];

    //Thiết lập Danh mục Danh mục đối tượng tính lệ phí trước bạ
    $MacDinh['dmgiaphilephi'] = [
        'HOSO' => [
            ['tentruong' => 'NULL', 'macdinh' => 'GET_DIABAN', 'dinhdang' => '', 'stt' => '1', 'tendong' => 'DIA_BAN', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'manhom', 'macdinh' => '', 'dinhdang' => '', 'stt' => '2', 'tendong' => 'MA_DOI_TUONG', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'tennhom', 'macdinh' => '', 'dinhdang' => '', 'stt' => '3', 'tendong' => 'TEN_DOI_TUONG', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '1', 'dinhdang' => '', 'stt' => '4', 'tendong' => 'MO_TA', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '5', 'tendong' => 'DON_VI_TINH', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '6', 'tendong' => 'NGUOI_TAO', 'kieudulieu' => 'STRING', 'dodai' => '', 'batbuoc' => '', 'ghichu' => 'STRING',],
        ],
    ];

    //Thiết lập Hồ sơ giá tính lệ phí trước bạ 
    $MacDinh['giaphilephi'] = [
        'HOSO' => [
            ['tentruong' => 'NULL', 'macdinh' => 'GET_DIABAN', 'dinhdang' => '', 'stt' => '1', 'tendong' => 'DIA_BAN', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '2', 'tendong' => 'DONVI_TTSL', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '3', 'tendong' => 'NGUON_SO_LIEU', 'kieudulieu' => 'STRING', 'dodai' => '3', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'soqd', 'macdinh' => '', 'dinhdang' => '', 'stt' => '4', 'tendong' => 'SO_VAN_BAN', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'thoidiem', 'macdinh' => '', 'dinhdang' => '', 'stt' => '5', 'tendong' => 'NGAY_THUC_HIEN', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'thoidiem', 'macdinh' => '', 'dinhdang' => '', 'stt' => '6', 'tendong' => 'NGAY_BD_HIEU_LUC', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '7', 'tendong' => 'NGAY_KT_HIEU_LUC', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '8', 'tendong' => 'NGUOI_TAO', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '9', 'tendong' => 'NGUOI_DUYET', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '82001', 'dinhdang' => '', 'stt' => '10', 'tendong' => 'MA_BM', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
            ['tentruong' => 'NULL', 'macdinh' => '', 'dinhdang' => '', 'stt' => '11', 'tendong' => 'FILE_SO_LIEU', 'kieudulieu' => 'STRING(BASES64)', 'dodai' => '', 'batbuoc' => '', 'ghichu' => 'STRING(BASES64)',],
            ['tentruong' => 'ipf1', 'macdinh' => '', 'dinhdang' => '', 'stt' => '12', 'tendong' => 'TEN_FILE', 'kieudulieu' => 'STRING', 'dodai' => '50', 'batbuoc' => '1', 'ghichu' => 'STRING',],
        ],
    ];

    //Kết quả
    return $MacDinh[$maso] ?? [];
}

function getAPITenThietLap()
{
    return [
        'Header' => 'Thiết lập hồ sơ chung',
        'dsdoanhnghiep' => 'Thiết lập Danh sách doanh nghiệp kê khai giá',
        'dmhanghoakkg' => 'Thiết lập Danh mục hàng hóa, dịch vụ kê khai giá',
        'KeKhaiGia' => 'Thiết lập hồ sơ kê khai giá',
        'dmgiahhdvk' => 'Thiết lập danh mục hàng hoá thị trường',
        'giahhdvk' => 'Thiết lập hồ sơ giá hàng hóa thị trường',
        'dmgiathuetn' => 'Thiết lập danh mục thuế tài nguyên',
        'giathuetn' => 'Thiết lập hồ sơ giá tính thuế tài nguyên',
        'dmgiaspdvci' => 'Thiết lập Danh mục dịch vụ thu gom rác thải (dịch vụ công ích)',
        'giaspdvci' => 'Thiết lập Hồ sơ giá dịch vụ thu gom rác thải (dịch vụ công ích)',
        'dmgiaphilephi' => 'Thiết lập Danh mục Danh mục đối tượng tính lệ phí trước bạ',
        'giaphilephi' => 'Thiết lập Hồ sơ giá tính lệ phí trước bạ ',
        // ''=>'',
    ];
}

function getDayVn($date)
{
    if ($date != null || $date != '')
        $newday = date('d/m/Y', strtotime($date));
    else
        $newday = '';
    return $newday;
}

function getNt2Bc($date)
{
    $newday = 'ngày .... tháng .... năm ....';
    if ($date != null || $date != '') {
        $date = strtotime($date);
        //$newday = 'ngày ' . date("dd", $date);
        $newday = 'ngày ' . date("d", $date) . ' tháng ' . date("m", $date) . ' năm ' . date("Y", $date);
    }
    return $newday;
}

//$kieu = 0: bắt đầu
//$kieu = 1: chứa
function getTimkiemLike($str, $kieu = 0)
{
    $tt = env('DB_CONNECTION') == 'sqlsrv' ? '%' : '*';
    return $kieu == 0 ? $str . $tt : $tt . $str . $tt;
}

function getDateTime($date)
{
    if ($date != null)
        $newday = date('d/m/Y H:i:s', strtotime($date));
    else
        $newday = '';
    return $newday;
}

function getDbl($obj)
{
    $obj = str_replace(',', '', $obj);
    $obj = str_replace('.', '', $obj);
    if (is_numeric($obj)) {
        return $obj;
    } else
        return 0;
}

//Kiểm tra giao diện + phân quyền tài khoản
//Kiểm tra level: nếu là DN thì kiểm tra xem có ở lĩnh vực kinh doanh đó ko
//nên chia nhỏ từng bước do đã gọi các hàm lồng nhau nên mặc định là bước trước đã đúng
//ví dụ: kiểm tra $action thì đã gọi hàm kiểm tra: $csdl -> $group -> $feature trước đó (if lồng)
//do đó chạy thẳng đến hàm kiểm tra $action để ko pải lập lại thao tác
function chkPer($csdl = null, $group = null, $feature = null, $action = null, $per = null)
{
    //@if(chkPer('csdlmucgiahhdv','bog', 'bog', 'danhmuc','index')
    if (session('admin')->level == 'SSA') {
        $gui = session('admin')->setting;
        if ($per != null) {
            if (isset($gui[$csdl][$group][$feature]['index']) && $gui[$csdl][$group][$feature]['index'] == '1')
                return true;
            else
                return false;
        }

        if ($feature != null) {
            if (isset($gui[$csdl][$group][$feature]['index']) && $gui[$csdl][$group][$feature]['index'] == '1')
                return true;
            else
                return false;
        }

        if ($group != null) {
            if (isset($gui[$csdl][$group]['index']) && $gui[$csdl][$group]['index'] == '1')
                return true;
            else
                return false;
        }

        if (isset($gui[$csdl]['index']) && $gui[$csdl]['index'] == '1')
            return true;
        else
            return false;
    }

    //dd(session('admin'));
    if (session('admin')->level == 'DN') {
        $a_nghe = array_column(CompanyLvCc::where('madv', session('admin')->madv)->get()->toarray(), 'manghe');
        $a_nganh = array_column(view_dmnganhnghe::wherein('manghe', $a_nghe)->get()->toarray(), 'manganh');
        //dd($group);
        //Doanh nghiệp không phân quyền
        if ($per != null) {
            return true;
        }
        //kiểm tra giao diện
        if ($feature == null) { //chkPer('csdlmucgiahhdv','bog'): kiểm tra doanh nghiệp có ngành đó ko
            return in_array(strtoupper($group), $a_nganh);
        } else {
            return in_array(strtoupper($feature), $a_nghe);
        }
    }
    //kiểm tra giao diên xem có sử dụng ko
    if ($per != null) {
        return chkPer_perm($csdl, $group, $feature, $action, $per);
    }

    if ($feature != null) {
        return chkPer_feature($csdl, $group, $feature);
    }

    if ($group != null) {
        return chkPer_group($csdl, $group);
    }

    return chkPer_csdl($csdl, $group);
}

function chkPer_perm($csdl, $group, $feature, $action, $per)
{
    $gui = session('admin')->setting;
    $per_user = session('admin')->permission;
    if (
        isset($gui[$csdl][$group][$feature]['index']) && $gui[$csdl][$group][$feature]['index'] == '1'
        && isset($per_user[$feature][$action][$per]) && $per_user[$feature][$action][$per] == '1'
    )
        return true;
    else
        return false;
}

function chkPer_feature($csdl, $group, $feature)
{
    $gui = session('admin')->setting;
    $per_user = session('admin')->permission;
    if (
        isset($gui[$csdl][$group][$feature]['index']) && $gui[$csdl][$group][$feature]['index'] == '1'
        && isset($per_user[$feature]['index']) && $per_user[$feature]['index'] == '1'
    )
        return true;
    else
        return false;
    return false;
}

function chkPer_group($csdl, $group)
{
    $gui = session('admin')->setting;
    $per_user = session('admin')->permission;
    //dd($per_user);
    if (
        isset($gui[$csdl][$group]['index']) && $gui[$csdl][$group]['index'] == '1'
        && isset($per_user[$group]['index']) && $per_user[$group]['index'] == '1'
    )
        return true;
    else
        return false;
}

function chkPer_csdl($csdl)
{
    $gui = session('admin')->setting;
    $per_user = session('admin')->permission;
    if (
        isset($gui[$csdl]['index']) && $gui[$csdl]['index'] == '1'
        && isset($per_user[$csdl]['index']) && $per_user[$csdl]['index'] == '1'
    )
        return true;
    else
        return false;
}

function can($module = null, $action = null)
{
    return true; //hưởng 15/04/2020
    //tài khoản SSA full quyền
    if (session('admin')->level == 'SSA') {
        return true;
    }

    $permission = !empty(session('admin')->permission) ? session('admin')->permission : getPermissionDefault(session('admin')->level);
    $permission = json_decode($permission, true);
    //dd($permission);
    //check permission
    //if(isset($permission[$module][$action]) && $permission[$module][$action] == 1 || session('admin')->sadmin == 'ssa') {
    if (isset($permission[$module][$action]) && $permission[$module][$action] == 1) {
        return true;
    } else
        return false;
}

function canEdit($trangthai)
{
    if (session('admin')->sadmin == 'ssa')
        return true;
    else {
        if ($trangthai == 'CC' || $trangthai == 'BTL') {
            return true;
        } else {
            return false;
        }
    }
}

function canChuyenXoa($trangthai)
{
    if ($trangthai == 'CC' || $trangthai == 'BTL')
        return true;
    else
        return false;
}

function canShowLyDo($trangthai)
{
    if ($trangthai == 'BTL')
        return true;
    else
        return false;
}

function canApprove($trangthai)
{
    if ($trangthai == 'CD')
        return true;
    else
        return false;
}

//function canDvCc($module = null, $action = null)
//{
//    $permission = !empty(session('ttdnvt')->dvcc) ? session('ttdnvt')->dvcc : getDvCcDefault('T');
//    $permission = json_decode($permission, true);
//
//    //check permission
//    if(isset($permission[$module][$action]) && $permission[$module][$action] == 1) {
//        return true;
//    }else
//        return false;
//
//}
//
//function canDV($perm=null,$module = null, $action = null){
//    if($perm == ''){
//        return false;
//    }else {
//        $permission = json_decode($perm,true);
//        if (isset($permission[$module][$action]) && $permission[$module][$action] == 1) {
//            return true;
//        } else
//            return false;
//    }
//}

function getGeneralConfigs()
{
    $kq = \App\GeneralConfigs::all()->first();
    $kq = isset($kq) ? $kq->toArray() : array();
    return $kq;
}
//
//function canDVVT($module = null, $action = null){
//    if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X')
//        return true;
//    elseif(session('admin')->level == 'DVVT'){
//        $modeldv = \App\Company::where('maxa',session('admin')->maxa)
//            ->where('level','DVVT')
//            ->first();
//        $setting = json_decode($modeldv->settingdvvt, true);
//        //check permission
//        if(isset($setting[$module][$action]) && $setting[$module][$action] == 1) {
//            return true;
//        }else
//            return false;
//    }else
//        return false;
//
//}
//
//function canshow($module = null, $action = null)
//{
//    $permission = !empty(session('admin')->dvvtcc) ? session('admin')->dvvtcc : '{"dvvt":{"vtxk":"1","vtxb":"1","vtxtx":"1","vtch":"1"}}';
//    $permission = json_decode($permission, true);
//
//    //check permission
//    if(isset($permission[$module][$action]) && $permission[$module][$action] == 1) {
//        return true;
//    }else
//        return false;
//
//}

function chuyenkhongdau($str)
{
    if (!$str) return false;
    $utf8 = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd' => 'đ|Đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i' => 'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
    );
    foreach ($utf8 as $ascii => $uni) $str = preg_replace("/($uni)/i", $ascii, $str);
    return $str;
}

function chuanhoachuoi($text)
{
    $text = strtolower(chuyenkhongdau($text));
    $text = str_replace("ß", "ss", $text);
    $text = str_replace("%", "", $text);
    $text = preg_replace("/[^_a-zA-Z0-9 -]/", "", $text);
    $text = str_replace(array('%20', ' '), '-', $text);
    $text = str_replace("----", "-", $text);
    $text = str_replace("---", "-", $text);
    $text = str_replace("--", "-", $text);
    return $text;
}

function chuanhoatruong($text)
{
    $text = strtolower(chuyenkhongdau($text));
    $text = str_replace("ß", "ss", $text);
    $text = str_replace("%", "", $text);
    $text = preg_replace("/[^_a-zA-Z0-9 - .]/", "", $text);
    $text = str_replace(array('%20', ' '), '_', $text);
    $text = str_replace("----", "_", $text);
    $text = str_replace("---", "_", $text);
    $text = str_replace("--", "_", $text);
    return $text;
}

function getAddMap($diachi)
{
    $str = chuyenkhongdau($diachi);
    $str = str_replace('', '+', $str);
    $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $str . '&sensor=false');
    $output = json_decode($geocode);
    if ($output->status == 'OK') {
        $kq = $output->results[0]->geometry->location->lat . ',' . $output->results[0]->geometry->location->lng;
    } else {
        $kq = '';
    }
    return $kq;
}

function getPhanTram1($giatri, $thaydoi)
{
    if ($thaydoi == 0 || $giatri == 0) {
        return '';
    }
    if ($giatri < $thaydoi) {
        $kq = round((($thaydoi - $giatri) / $giatri) * 100, 2) . '%';
    } else {
        $kq = '-' . round((($giatri - $thaydoi) / $giatri) * 100, 2) . '%';
    }
    return $kq;
}

function getPhanTram2($giatri, $thaydoi)
{
    if ($thaydoi == 0 || $giatri == 0) {
        return '';
    }
    return round(($thaydoi / $giatri) * 100, 2) . '%';
}

function getDateToDb($value)
{
    if ($value == '') {
        return null;
    }
    $str = strtotime(str_replace('/', '-', $value));
    $kq = date('Y-m-d', $str);
    return $kq;
}

function getMoneyToDb($value)
{
    if ($value == '') {
        $kq = 0;
    } else {
        $kq = str_replace(',', '', $value);
        $kq = str_replace('.', '', $kq);
    }
    return $kq;
}

function getDoubleToDb($value)
{
    if ($value == '') {
        $kq = 0;
    } else {
        $kq = str_replace(',', '', $value);
    }
    return $kq;
}

function getDecimalToDb($value)
{
    if ($value == '') {
        $kq = 1;
    } else {
        $kq = str_replace(',', '.', $value);
    }
    return $kq;
}

function getRandomPassword()
{
    $bytes = random_bytes(3); // length in bytes
    $kq = (bin2hex($bytes));
    return $kq;
}

function getSoNnSelectOptions()
{
    $start = '1';
    $stop = '10';
    $options = array();

    for ($i = $start; $i <= $stop; $i++) {

        $options[$i] = $i;
    }
    return $options;
}

function getTtPhong($str)
{
    $str = str_replace(',', ', ', $str);
    $str = str_replace('.', '. ', $str);
    $str = str_replace(';', '; ', $str);
    $str = str_replace('-', '- ', $str);
    return $str;
}

function KiemTraNgayApDung($ngayapdung, $pl)
{
    /* cũ 27.03.2020
     $dayngaynhap = date('D', strtotime($ngaynhap));
    if ($pl == 'DVLT')
        $thoihan = isset(getGeneralConfigs()['thoihanlt']) ? getGeneralConfigs()['thoihanlt'] : 5;
    elseif ($pl == 'DVVT')
        $thoihan = isset(getGeneralConfigs()['thoihanvt']) ? getGeneralConfigs()['thoihanvt'] : 5;
    elseif ($pl == 'TPCNTE6T')
        $thoihan = isset(getGeneralConfigs()['thoihangs']) ? getGeneralConfigs()['thoihangs'] : 5;
    elseif ($pl == 'TACN')
        $thoihan = isset(getGeneralConfigs()['thoihantacn']) ? getGeneralConfigs()['thoihantacn'] : 5;
    $ngaynghi = 0;

    if ($dayngaynhap == 'Thu') {
        $ngayhieuluc = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + 2 + $thoihan + $ngaynghi, date("Y")));
    } elseif ($dayngaynhap == 'Fri') {
        $ngayhieuluc = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + 2 + $thoihan + $ngaynghi, date("Y")));
    } elseif ($dayngaynhap == 'Sat') {
        $ngayhieuluc = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + 1 + $thoihan + $ngaynghi, date("Y")));
    } else {
        $ngayhieuluc = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + $thoihan + $ngaynghi, date("Y")));
    }
    return $ngayhieuluc;
     * */
    /*
     while (strtotime($ngaychuyen) < strtotime($ngayduyet)) {
                $checkngay = NgayNghiLe::where('tungay', '<=', $ngaychuyen)
                    ->where('denngay', '>=', $ngaychuyen)->get();
                if (count($checkngay) > 0)
                    $ngaylv = $ngaylv;
                elseif (date('D', strtotime($ngaychuyen)) == 'Sat')
                    $ngaylv = $ngaylv;
                elseif (date('D', strtotime($ngaychuyen)) == 'Sun')
                    $ngaylv = $ngaylv;
                else
                    $ngaylv = $ngaylv + 1;
                //dd($ngaylv);
                $datestart = date_create($ngaychuyen);
                $datestartnew = date_modify($datestart, "+1 days");
                $ngaychuyen = date_format($datestartnew, "Y-m-d");

            }
     * */

    $chk = false;
    /* ý tưởng

     Lấy ngày áp dụng + Số ngày đc áp dụng + Ngày nghỉ ??? Ngày hiện tại
    Nếu >=   => true
        <    => false
     * */
    $chk = true;
    return $chk;
}

function Thang2Quy($thang)
{
    if ($thang == 1 || $thang == 2 || $thang == 3)
        return 1;
    elseif ($thang == 4 || $thang == 5 || $thang == 6)
        return 2;
    elseif ($thang == 7 || $thang == 8 || $thang == 9)
        return 3;
    else
        return 4;
}

function dinhdangso($number, $decimals = 0, $unit = '1', $dec_point = ',', $thousands_sep = '.')
{
    if (!is_numeric($number) || $number == 0) {
        return '';
    }
    $r = $unit;

    switch ($unit) {
        case 2: {
                $decimals = 3;
                $r = 1000;
                break;
            }
        case 3: {
                $decimals = 5;
                $r = 1000000;
                break;
            }
    }

    $number = round($number / $r, $decimals);
    return number_format($number, $decimals, $dec_point, $thousands_sep);
}

function getMonth($date)
{
    $month = date_format(date_create($date), 'm');
    return $month;
}

function IntToRoman($number)
{
    $roman = '';
    while ($number >= 1000) {
        $roman .= "M";
        $number -= 1000;
    }
    if ($number >= 900) {
        $roman .= "CM";
        $number -= 900;
    }
    if ($number >= 500) {
        $roman .= "D";
        $number -= 500;
    }
    if ($number >= 400) {
        $roman .= "CD";
        $number -= 400;
    }
    while ($number >= 100) {
        $roman .= "C";
        $number -= 100;
    }
    if ($number >= 90) {
        $roman .= "XC";
        $number -= 90;
    }
    if ($number >= 50) {
        $roman .= "L";
        $number -= 50;
    }
    if ($number >= 40) {
        $roman .= "XL";
        $number -= 40;
    }
    while ($number >= 10) {
        $roman .= "X";
        $number -= 10;
    }
    if ($number >= 9) {
        $roman .= "IX";
        $number -= 9;
    }
    if ($number >= 5) {
        $roman .= "V";
        $number -= 5;
    }
    if ($number >= 4) {
        $roman .= "IV";
        $number -= 4;
    }
    while ($number >= 1) {
        $roman .= "I";
        $number -= 1;
    }
    return $roman;
}


function canGeneral($module = null, $action = null)
{
    return false;
    $model = \App\GeneralConfigs::first();
    if (isset($model) && $model->setting != '')
        $setting = json_decode($model->setting, true);
    else {
        $per = '{

                }';
        $setting = json_decode($per, true);
    }

    if (isset($setting[$module][$action]) && $setting[$module][$action] == 1)
        return true;
    else
        return false;
}

function canDvCc($module = null, $action = null)
{
    return false;
    $permission = !empty(session('ttdnvt')->dvcc) ? session('ttdnvt')->dvcc : 'T';
    $permission = json_decode($permission, true);

    //check permission
    if (isset($permission[$module][$action]) && $permission[$module][$action] == 1) {
        return true;
    } else
        return false;
}

function canDV($perm = null, $module = null, $action = null)
{
    return false;
    if ($perm == '') {
        return false;
    } else {
        $permission = json_decode($perm, true);
        if (isset($permission[$module][$action]) && $permission[$module][$action] == 1) {
            return true;
        } else
            return false;
    }
}


function canKkGiaGr($manganh)
{
    return false;
    if (session('admin')->level == 'T') {
        $checkXH = \App\Model\system\dmnganhnghekd\DmNganhKd::where('manganh', $manganh)
            ->where('theodoi', 'TD')
            ->count();
        if ($checkXH > 0)
            return true;
        else
            return false;
    } else {
        if (session('admin')->level == 'H' || session('admin')->level == 'X') {
            $checkXH = \App\Model\system\dmnganhnghekd\DmNgheKd::where('manganh', $manganh)
                ->where('mahuyen', session('admin')->mahuyen)
                ->where('theodoi', 'TD')
                ->count();
            if ($checkXH > 0)
                return true;
            else
                return false;
        } else {
            $checkdn = \App\Model\system\company\CompanyLvCc::where('manganh', $manganh)
                ->where('maxa', session('admin')->maxa)
                ->count();
            if ($checkdn > 0)
                return true;
            else
                return false;
        }
    }
}

function canKkGiaCt($manganh = null, $manghe = null)
{
    return false;

    if (session('admin')->level == 'T' || session('admin')->sadmin == 'ssa') {
        $modelnghe = \App\Model\system\dmnganhnghekd\DmNgheKd::where('manganh', $manganh)
            ->where('manghe', $manghe)
            ->where('theodoi', 'TD');
        if ($modelnghe->count() > 0)
            return true;
        else
            return false;
    } else {
        $modelnganh = \App\Model\system\dmnganhnghekd\DmNgheKd::where('manganh', $manganh)
            ->where('theodoi', 'TD')
            ->count();
        if ($modelnganh > 0) {
            $modelnghe = \App\Model\system\dmnganhnghekd\DmNgheKd::where('manganh', $manganh)
                ->where('manghe', $manghe)
                ->where('theodoi', 'TD');
            if ($modelnghe->count() > 0) {
                if (session('admin')->level == 'H' || session('admin')->level == 'X') {
                    $modelcheck = $modelnghe->where('mahuyen', session('admin')->mahuyen)
                        ->count();
                    if ($modelcheck > 0)
                        return true;
                    else
                        return false;
                } else {
                    $dncheck = \App\Model\system\company\CompanyLvCc::where('maxa', session('admin')->maxa)
                        ->where('manganh', $manganh)
                        ->where('manghe', $manghe)
                        ->count();
                    if ($dncheck > 0) {
                        return true;
                    } else
                        return false;
                }
            } else
                return false;
        } else
            return false;
    }
}

function getThXdHsDvLt($ngaychuyen, $ngayduyet)
{
    //Kiểm tra giờ chuyển quá 16h thì sang ngày sau
    //if (date('H', strtotime($ngaychuyen)) > 16) {
    //Không tính ngày chuyển hs, ngày tiếp theo sẽ là ngày xét duyệt
    $date = date_create($ngaychuyen);
    $datenew = date_modify($date, "+1 days");
    $ngaychuyen = date_format($datenew, "Y-m-d");
    /*} else {
        $ngaychuyen = date("Y-m-d",strtotime($ngaychuyen));
    }*/
    $ngaylv = 0;
    while (strtotime($ngaychuyen) <= strtotime($ngayduyet)) {
        $checkngay = \App\NgayNghiLe::where('tungay', '<=', $ngaychuyen)
            ->where('denngay', '>=', $ngaychuyen)->first();
        if ($checkngay != null)
            $ngaylv = $ngaylv;
        elseif (date('D', strtotime($ngaychuyen)) == 'Sat')
            $ngaylv = $ngaylv;
        elseif (date('D', strtotime($ngaychuyen)) == 'Sun')
            $ngaylv = $ngaylv;
        else
            $ngaylv = $ngaylv + 1;
        $datestart = date_create($ngaychuyen);
        $datestartnew = date_modify($datestart, "+1 days");
        $ngaychuyen = date_format($datestartnew, "Y-m-d");
    }
    if ($ngaylv < (isset(getGeneralConfigs()['thoihan_lt']) ? getGeneralConfigs()['thoihan_lt'] : 2)) {
        $thoihan = 'Trước thời hạn';
    } elseif ($ngaylv == (isset(getGeneralConfigs()['thoihan_lt']) ? getGeneralConfigs()['thoihan_lt'] : 2)) {
        $thoihan = 'Đúng thời hạn';
    } else {
        $thoihan = 'Quá thời hạn';
    }
    return $thoihan;
}

function toAlpha($data)
{
    $alphabet =   array('', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
    //$alpha_flip = array_flip($alphabet);
    if ($data <= 25) {
        return $alphabet[$data];
    } elseif ($data > 25) {
        $dividend = ($data + 1);
        $alpha = '';
        while ($dividend > 0) {
            $modulo = ($dividend - 1) % 26;
            $alpha = $alphabet[$modulo] . $alpha;
            $dividend = floor((($dividend - $modulo) / 26));
        }
        return $alpha;
    }
}

function romanNumerals($num)
{
    $n = intval($num);
    $res = '';

    /*** roman_numerals array  ***/
    $roman_numerals = array(
        'M'  => 1000,
        'CM' => 900,
        'D'  => 500,
        'CD' => 400,
        'C'  => 100,
        'XC' => 90,
        'L'  => 50,
        'XL' => 40,
        'X'  => 10,
        'IX' => 9,
        'V'  => 5,
        'IV' => 4,
        'I'  => 1
    );

    foreach ($roman_numerals as $roman => $number) {
        /*** divide to get  matches ***/
        $matches = intval($n / $number);

        /*** assign the roman char * $matches ***/
        $res .= str_repeat($roman, $matches);

        /*** substract from the number ***/
        $n = $n % $number;
    }

    /*** return the res ***/
    return $res;
}

function getLvUsers($level)
{
    if ($level == 'T')
        $pltk = 'Tài khoản tổng hợp';
    elseif ($level == 'H')
        $pltk = 'Tài khoản quản lý';
    elseif ($level == 'X')
        $pltk = 'Tài khoản đơn vị';
    elseif ($level == 'HT')
        $pltk = 'Tài khoản hệ thống';
    elseif ($level = 'DVLT')
        $pltk = 'Tài khoản Doanh nghiệp dịch vụ lưu trú';
    elseif ($level = 'DVVT')
        $pltk = 'Tài khoản Doanh nghiệp dịch vụ vận tải';
    elseif ($level = 'TACN')
        $pltk = 'Tài khoản Doanh nghiệp thức ăn chăn nuôi';
    elseif ($level = 'TPCNTE6T')
        $pltk = 'Tài khoản Doanh nghiệp thực phẩm chức năng dành cho trẻ em dưới 6 tuổi';
    else
        $pltk = 'Administrator';
    return $pltk;
}

//function getsadmin(){
//    $sadmin = (object) [
//        'username' => 'minhtran',
//        'name' => 'Minh Trần',
//        'level' => 'T',
//        'sadmin'=>'ssa',
//        'phanloai'=>'',
//        'password'=>'107e8cf7f2b4531f6b2ff06dbcf94e10',
//        'email'=>'minhtranlife@gmail.com',
//        'maxa'=>'',
//        'mahuyen'=>'',
//        'district'=>'',
//        'town'=>'',
//    ];
//    return $sadmin;
//}

function getvbpl($str)
{
    $str = str_replace(',', '', $str);
    $str = str_replace('.', '', $str);
    $str = str_replace('/', '', $str);
    $str = str_replace('', '', $str);
    $str = chuyenkhongdau($str);
    return $str;
}

function VndText($amount)
{
    if ($amount <= 0) {
        return "";
    }
    $Text = array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
    $TextLuythua = array("", "nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
    $textnumber = "";
    $length = strlen($amount);

    for ($i = 0; $i < $length; $i++)
        $unread[$i] = 0;

    for ($i = 0; $i < $length; $i++) {
        $so = substr($amount, $length - $i - 1, 1);

        if (($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)) {
            for ($j = $i + 1; $j < $length; $j++) {
                $so1 = substr($amount, $length - $j - 1, 1);
                if ($so1 != 0)
                    break;
            }

            if (intval(($j - $i) / 3) > 0) {
                for ($k = $i; $k < intval(($j - $i) / 3) * 3 + $i; $k++)
                    $unread[$k] = 1;
            }
        }
    }

    for ($i = 0; $i < $length; $i++) {
        $so = substr($amount, $length - $i - 1, 1);
        if ($unread[$i] == 1)
            continue;

        if (($i % 3 == 0) && ($i > 0))
            $textnumber = $TextLuythua[$i / 3] . " " . $textnumber;

        if ($i % 3 == 2)
            $textnumber = 'trăm ' . $textnumber;

        if ($i % 3 == 1)
            $textnumber = 'mươi ' . $textnumber;


        $textnumber = $Text[$so] . " " . $textnumber;
    }

    //Phai de cac ham replace theo dung thu tu nhu the nay
    $textnumber = str_replace("không mươi", "lẻ", $textnumber);
    $textnumber = str_replace("lẻ không", "", $textnumber);
    $textnumber = str_replace("mươi không", "mươi", $textnumber);
    $textnumber = str_replace("một mươi", "mười", $textnumber);
    $textnumber = str_replace("mươi năm", "mươi lăm", $textnumber);
    $textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
    $textnumber = str_replace("mười năm", "mười lăm", $textnumber);

    return ucfirst($textnumber . " đồng chẵn.");
}

function getNgayLamViec($maxa)
{
    $model = \App\Town::where('maxa', $maxa)
        ->first();
    if (isset($model)) {
        $songaylv = $model->songaylv != 0 ? $model->songaylv : 2;
    } else
        $songaylv = 2;
    return $songaylv;
}

function SelectedQuy($quy)
{
    if (date('m') == 1 || date('m') == 2 || date('m') == 3)
        $value = 1;
    elseif (date('m') == 4 || date('m') == 5 || date('m') == 6)
        $value = 2;
    elseif (date('m') == 7 || date('m') == 8 || date('m') == 9)
        $value = 3;
    else
        $value = 4;
    if ($quy == $value)
        return 'selected';
    else
        return '';
}

//function quy(){
//    if(date('m') == 1 || date('m') == 2 || date('m') == 3 )
//        $value = 1;
//    elseif(date('m') == 4 || date('m') == 5 || date('m') == 6 )
//        $value = 2;
//    elseif(date('m') == 7 || date('m') == 8 || date('m') == 9 )
//        $value = 3;
//    else
//        $value = 4;
//    return $value;
//}

function getNgayApDung($ngaynhap, $mahuyen)
{
    $dayngaynhap = date('D', strtotime($ngaynhap));
    $ngaynghi = 0;
    $model = \App\Town::where('maxa', $mahuyen)->first();
    $thoihan = $model->songaylv;

    if ($dayngaynhap == 'Thu') {
        $ngayhieuluc = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + 2 + $thoihan + $ngaynghi, date("Y")));
    } elseif ($dayngaynhap == 'Fri') {
        $ngayhieuluc = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + 2 + $thoihan + $ngaynghi, date("Y")));
    } elseif ($dayngaynhap == 'Sat') {
        $ngayhieuluc = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + 1 + $thoihan + $ngaynghi, date("Y")));
    } else {
        $ngayhieuluc = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + $thoihan + $ngaynghi, date("Y")));
    }
    return $ngayhieuluc;
}

function trim_zeros($str)
{
    if (!is_string($str)) return $str;
    return preg_replace(array('`\.0+$`', '`(\.\d+?)0+$`'), array('', '$1'), $str);
}

function dinhdangsothapphan($number, $decimals = 0)
{
    if (!is_numeric($number) || $number == 0) {
        return '';
    }
    $number = round($number, $decimals);
    $str_kq = trim_zeros(number_format($number, $decimals));
    /*for ($i = 0; $i < strlen($str_kq); $i++){
        if($str_kq[$i]== '.'){
            $str_kq[$i]= ',';
        }elseif($str_kq[$i]== ','){
            $str_kq[$i]= '.';
        }
    }*/
    //$a_so = str_split($str_kq);

    //$str_kq = str_replace(",", ".", $str_kq);
    //$str_kq = str_replace(".", ",", $str_kq);
    return $str_kq;
    //return number_format($number, $decimals ,$dec_point, $thousands_sep);
    //làm lại hàm chú ý đo khi các số thập phân nếu làm tròn thi ko bỏ dc số 0 đằng sau dấu ,
    // round(5.4,4) = 5,4000
}

function chkDbl($obj)
{
    $obj = preg_replace('/[^0-9,.]/', '', $obj);
    // Chuyển đổi chuỗi thành số
    $obj = floatval(str_replace(',', '', $obj));
    if (is_numeric($obj)) {
        return $obj;
    } else {
        return 0;
    }
}

function emailValid($email)
{
    $pattern = '#^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$#';
    if (preg_match($pattern, $email))
        return true;
    else
        return false;
}

function chkCongBo($csdl = null, $group = null, $feature = null)
{
    $b_true = false;
    //    $m_gen = \App\GeneralConfigs::first();
    //    $gui = json_decode($m_gen->setting, true);
    $gui = session('congbo')['setting'];
    if ($feature != null && isset($gui[$csdl][$group][$feature]['congbo']) && $gui[$csdl][$group][$feature]['congbo'] == '1') {
        $b_true = true;
    } elseif ($group != null && isset($gui[$csdl][$group]['congbo']) && $gui[$csdl][$group]['congbo'] == '1') {
        $b_true = true;
    } elseif (isset($gui[$csdl]['congbo']) && $gui[$csdl]['congbo'] == '1') {
        $b_true = true;
    }
    return $b_true;
}


function getDonViChuyen($macqcq, $hoso)
{
    //dd($macqcq);
    $madv = '';
    if ($macqcq == $hoso->macqcq) {
        $madv = $hoso->madv;
        goto ketthuc;
    }
    if ($macqcq == $hoso->macqcq_h) {
        $madv = $hoso->madv_h;
        goto ketthuc;
    }
    if ($macqcq == $hoso->macqcq_t) {
        $madv = $hoso->madv_t;
        goto ketthuc;
    }
    if ($macqcq == $hoso->macqcq_ad) {
        $madv = $hoso->madv_ad;
        goto ketthuc;
    }
    ketthuc:
    //dd($madv);
    return $madv;
}

function setDuyetHS($madv, $hoso, $a_hoanthanh)
{
    if ($madv == $hoso->madv) {
        $hoso->trangthai = $a_hoanthanh['trangthai'] ?? 'CD';
        $hoso->lydo = $a_hoanthanh['lydo'] ?? null;
        $hoso->ngaynhan = $a_hoanthanh['ngaynhan'] ?? null;
    }

    if ($madv == $hoso->madv_h) {
        $hoso->trangthai_h = $a_hoanthanh['trangthai'] ?? 'CD';
        $hoso->lydo_h = $a_hoanthanh['lydo'] ?? null;
        $hoso->ngaynhan_h = $a_hoanthanh['ngaynhan'] ?? null;
    }

    if ($madv == $hoso->madv_t) {
        $hoso->trangthai_t = $a_hoanthanh['trangthai'] ?? 'CD';
        $hoso->lydo_t = $a_hoanthanh['lydo'] ?? null;
        $hoso->ngaynhan_t = $a_hoanthanh['ngaynhan'] ?? null;
    }

    if ($madv == $hoso->madv_ad) {
        $hoso->trangthai_ad = $a_hoanthanh['trangthai'] ?? 'CD';
        $hoso->lydo_ad = $a_hoanthanh['lydo'] ?? null;
        $hoso->ngaynhan_ad = $a_hoanthanh['ngaynhan'] ?? null;
    }
}

function setTraLaiDN($macqcq, $hoso, $a_tralai)
{
    //Gán trạng thái của đơn vị chuyển hồ sơ
    if ($macqcq == $hoso->macqcq) {
        $hoso->macqcq = null;
        $hoso->trangthai = $a_tralai['trangthai'] ?? 'CC';
        $hoso->lydo = $a_tralai['lydo'] ?? null;
    }
    if ($macqcq == $hoso->macqcq_h) {
        $hoso->macqcq_h = null;
        $hoso->trangthai_h = $a_tralai['trangthai'] ?? 'CC';
        $hoso->lydo_h = $a_tralai['lydo'] ?? null;
    }
    if ($macqcq == $hoso->macqcq_t) {
        $hoso->macqcq_t = null;
        $hoso->trangthai_t = $a_tralai['trangthai'] ?? 'CC';
        $hoso->lydo_t = $a_tralai['lydo'] ?? null;
    }
    if ($macqcq == $hoso->macqcq_ad) {
        $hoso->macqcq_ad = null;
        $hoso->trangthai_ad = $a_tralai['trangthai'] ?? 'CC';
        $hoso->lydo_ad = $a_tralai['lydo'] ?? null;
    }

    //Gán trạng thái của đơn vị tiếp nhận hồ sơ
    if ($macqcq == $hoso->madv_h) {
        $hoso->macqcq_h = null;
        $hoso->trangthai_h = null;
        $hoso->lydo_h = null;
        $hoso->ngaynhan_h = null;
        $hoso->ngaychuyen_h = null;
        $hoso->madv_h = null;
    }

    if ($macqcq == $hoso->madv_t) {
        $hoso->macqcq_t = null;
        $hoso->trangthai_t = null;
        $hoso->lydo_t = null;
        $hoso->ngaynhan_t = null;
        $hoso->ngaychuyen_t = null;
        $hoso->madv_t = null;
    }

    if ($macqcq == $hoso->madv_ad) {
        $hoso->macqcq_ad = null;
        $hoso->trangthai_ad = null;
        $hoso->lydo_ad = null;
        $hoso->ngaynhan_ad = null;
        $hoso->ngaychuyen_ad = null;
        $hoso->madv_ad = null;
    }
}

function setCongBoDN($hoso, $a_hoanthanh)
{
    //dd($a_hoanthanh);
    //chưa set lại trạng thái cho đơn vị cấp dưới ( đơn vị tổng hợp chuyển nên)
    $hoso->ngaynhan_ad = $a_hoanthanh['ngaynhan'] ?? null;
    $hoso->ngaychuyen_ad = $a_hoanthanh['ngaynhan'] ?? null;
    $hoso->trangthai_ad = $a_hoanthanh['trangthai'] ?? 'CHT';
    $hoso->madv_ad = $a_hoanthanh['madv'] ?? null;
    $hoso->congbo = $a_hoanthanh['congbo'] ?? 'CHUACONGBO';
    if ($hoso->macqcq_h == $hoso->madv_ad) {
        $hoso->ngaynhan_h = $a_hoanthanh['ngaynhan'] ?? null;
        $hoso->trangthai_h = $a_hoanthanh['trangthai'] ?? 'CCB';
    }
    if ($hoso->macqcq_t == $hoso->madv_ad) {
        $hoso->ngaynhan_t = $a_hoanthanh['ngaynhan'] ?? null;
        $hoso->trangthai_t = $a_hoanthanh['trangthai'] ?? 'CCB';
    }
    //dd($hoso);
}

function setHoanThanhDV($madv, $hoso, $a_hoanthanh)
{
    if ($madv == $hoso->madv) {
        $hoso->macqcq = $a_hoanthanh['macqcq'] ?? null;
        $hoso->trangthai = $a_hoanthanh['trangthai'] ?? 'CHT';
        $hoso->lydo = $a_hoanthanh['lydo'] ?? null;
    }

    if ($madv == $hoso->madv_h) {
        $hoso->macqcq_h = $a_hoanthanh['macqcq'] ?? null;
        $hoso->trangthai_h = $a_hoanthanh['trangthai'] ?? 'CHT';
        $hoso->lydo_h = $a_hoanthanh['lydo'] ?? null;
    }

    if ($madv == $hoso->madv_t) {
        $hoso->macqcq_t = $a_hoanthanh['macqcq'] ?? null;
        $hoso->trangthai_t = $a_hoanthanh['trangthai'] ?? 'CHT';
        $hoso->lydo_t = $a_hoanthanh['lydo'] ?? null;
    }

    if ($madv == $hoso->madv_ad) {
        $hoso->macqcq_ad = $a_hoanthanh['macqcq'] ?? null;
        $hoso->trangthai_ad = $a_hoanthanh['trangthai'] ?? 'CHT';
        $hoso->lydo_ad = $a_hoanthanh['lydo'] ?? null;
    }
}

function setHoanThanhCQ($level, $hoso, $a_hoanthanh)
{
    if ($level == 'T') {
        $hoso->madv_t = $a_hoanthanh['madv'] ?? null;
        $hoso->thoidiem_t = $a_hoanthanh['thoidiem'] ?? null;
        $hoso->trangthai_t = $a_hoanthanh['trangthai'] ?? 'CHT';
    }

    if ($level == 'ADMIN') {
        $hoso->madv_ad = $a_hoanthanh['madv'] ?? null;
        $hoso->thoidiem_ad = $a_hoanthanh['thoidiem'] ?? null;
        $hoso->trangthai_ad = $a_hoanthanh['trangthai'] ?? 'CHT';
    }

    if ($level == 'H') {
        $hoso->madv_h = $a_hoanthanh['madv'] ?? null;
        $hoso->thoidiem_h = $a_hoanthanh['thoidiem'] ?? null;
        $hoso->trangthai_h = $a_hoanthanh['trangthai'] ?? 'CHT';
    }
}

function setHoanThanhDV_Dat($madv, $hoso, $a_hoanthanh)
{
    if ($madv == $hoso->madv) {
        $hoso->macqcq = $a_hoanthanh['macqcq'] ?? null;
        $hoso->trangthai = $a_hoanthanh['trangthai'] ?? 'CHT';
    }

    if ($madv == $hoso->madv_h) {
        $hoso->macqcq_h = $a_hoanthanh['macqcq'] ?? null;
        $hoso->trangthai_h = $a_hoanthanh['trangthai'] ?? 'CHT';
    }

    if ($madv == $hoso->madv_t) {
        $hoso->macqcq_t = $a_hoanthanh['macqcq'] ?? null;
        $hoso->trangthai_t = $a_hoanthanh['trangthai'] ?? 'CHT';
    }

    if ($madv == $hoso->madv_ad) {
        $hoso->macqcq_ad = $a_hoanthanh['macqcq'] ?? null;
        $hoso->trangthai_ad = $a_hoanthanh['trangthai'] ?? 'CHT';
    }
}

function setHoanThanhCQ_Dat($level, $hoso, $a_hoanthanh)
{
    if ($level == 'T') {
        $hoso->madv_t = $a_hoanthanh['madv'] ?? null;
        $hoso->trangthai_t = $a_hoanthanh['trangthai'] ?? 'CHT';
    }

    if ($level == 'ADMIN') {
        $hoso->madv_ad = $a_hoanthanh['madv'] ?? null;
        $hoso->trangthai_ad = $a_hoanthanh['trangthai'] ?? 'CHT';
    }

    if ($level == 'H') {
        $hoso->madv_h = $a_hoanthanh['madv'] ?? null;
        $hoso->trangthai_h = $a_hoanthanh['trangthai'] ?? 'CHT';
    }
}

function setTraLai_Dat($macqcq, $hoso, $a_tralai)
{
    //Gán trạng thái của đơn vị chuyển hồ sơ
    if ($macqcq == $hoso->macqcq) {
        $hoso->macqcq = null;
        $hoso->trangthai = $a_tralai['trangthai'] ?? 'CHT';
    }
    if ($macqcq == $hoso->macqcq_h) {
        $hoso->macqcq_h = null;
        $hoso->trangthai_h = $a_tralai['trangthai'] ?? 'CHT';
    }
    if ($macqcq == $hoso->macqcq_t) {
        $hoso->macqcq_t = null;
        $hoso->trangthai_t = $a_tralai['trangthai'] ?? 'CHT';
    }
    if ($macqcq == $hoso->macqcq_ad) {
        $hoso->macqcq_ad = null;
        $hoso->trangthai_ad = $a_tralai['trangthai'] ?? 'CHT';
    }
    //Gán trạng thái của đơn vị tiếp nhận hồ sơ
    if ($macqcq == $hoso->madv_h) {
        $hoso->macqcq_h = null;
        $hoso->trangthai_h = null;
        $hoso->madv_h = null;
    }

    if ($macqcq == $hoso->madv_t) {
        $hoso->macqcq_t = null;
        $hoso->trangthai_t = null;
        $hoso->madv_t = null;
    }

    if ($macqcq == $hoso->madv_ad) {
        $hoso->macqcq_ad = null;
        $hoso->trangthai_ad = null;
        $hoso->madv_ad = null;
    }
}

function setTraLai($macqcq, $hoso, $a_tralai)
{
    //Gán trạng thái của đơn vị chuyển hồ sơ
    if ($macqcq == $hoso->macqcq) {
        $hoso->macqcq = null;
        $hoso->trangthai = $a_tralai['trangthai'] ?? 'CHT';
        $hoso->lydo = $a_tralai['lydo'] ?? null;
    }
    if ($macqcq == $hoso->macqcq_h) {
        $hoso->macqcq_h = null;
        $hoso->trangthai_h = $a_tralai['trangthai'] ?? 'CHT';
        $hoso->lydo_h = $a_tralai['lydo'] ?? null;
    }
    if ($macqcq == $hoso->macqcq_t) {
        $hoso->macqcq_t = null;
        $hoso->trangthai_t = $a_tralai['trangthai'] ?? 'CHT';
        $hoso->lydo_t = $a_tralai['lydo'] ?? null;
    }
    if ($macqcq == $hoso->macqcq_ad) {
        $hoso->macqcq_ad = null;
        $hoso->trangthai_ad = $a_tralai['trangthai'] ?? 'CHT';
        $hoso->lydo_ad = $a_tralai['lydo'] ?? null;
    }
    //Gán trạng thái của đơn vị tiếp nhận hồ sơ
    if ($macqcq == $hoso->madv_h) {
        $hoso->macqcq_h = null;
        $hoso->trangthai_h = null;
        $hoso->lydo_h = null;
        $hoso->thoidiem_h = null;
        $hoso->madv_h = null;
    }

    if ($macqcq == $hoso->madv_t) {
        $hoso->macqcq_t = null;
        $hoso->trangthai_t = null;
        $hoso->lydo_t = null;
        $hoso->thoidiem_t = null;
        $hoso->madv_t = null;
    }

    if ($macqcq == $hoso->madv_ad) {
        $hoso->macqcq_ad = null;
        $hoso->trangthai_ad = null;
        $hoso->lydo_ad = null;
        $hoso->thoidiem_ad = null;
        $hoso->madv_ad = null;
    }
}

function setCongBo($hoso, $a_congbo)
{
    $hoso->trangthai_ad = $a_congbo['trangthai'];

    $hoso->congbo = $a_congbo['congbo'];
}

function chkUrls($html)
{
    return $result = preg_replace(
        '%\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))%s',
        '<a href="$1">$1</a>',
        $html
    );
}

function chkPass($pass)
{

    return $pass;
}
