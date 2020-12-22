<?php

namespace App\Http\Controllers\congbo\ttqlnn;

use App\Model\manage\ttpvctqlnn\TtPvCtQlNn;
use App\Model\manage\ttpvctqlnn\TtPvCtQlNnDm;
use App\VanBanQlNn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThongTuPVCTQLNNController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inputs = $request->all();
        $inputs['phanloai'] = isset($inputs['phanloai']) ? $inputs['phanloai'] : 'all';
        $inputs['paginate'] = isset($inputs['paginate']) ? $inputs['paginate'] : '5';
        $inputs['tieude'] = isset($inputs['tieude']) ? $inputs['tieude'] : '';
        $model = TtPvCtQlNn::orderBy('ngayapdung','desc');
        $a_dm = array_column(TtPvCtQlNnDm::get()->take(100)->toarray(),'mota', 'phanloai');
        if($inputs['phanloai']!= 'all')
            $model = $model->where('phanloai',$inputs['phanloai']);

        if(isset($inputs['tieude']) && $inputs['tieude'] != '')
            $model = $model->where('tieude','like', '%'.$inputs['tieude'].'%');
        $model = $model->paginate($inputs['paginate']);
        return view('congbo.ThongTuPVCTQLNN.index')
            ->with('model', $model)
            ->with('a_dm', $a_dm)
            ->with('inputs', $inputs)
            ->with('pageTitle', 'Thông tư phục vụ công tác quản lý nhà nước về giá');
    }

}
