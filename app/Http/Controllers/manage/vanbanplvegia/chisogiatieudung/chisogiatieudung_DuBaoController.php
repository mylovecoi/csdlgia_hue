<?php

namespace App\Http\Controllers\manage\vanbanplvegia\chisogiatieudung;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DanhMuc;
use App\Model\manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DanhMuc_ChiTiet;
use App\Model\manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DuBao;
use App\Model\manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_KichBan;
use App\Model\manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_KichBan_ChiTiet;
use App\Model\manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_TieuChi;
use Illuminate\Support\Facades\Session;

class chisogiatieudung_DuBaoController extends Controller
{
    public function KichBan(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] =  '/ChiSoCPI/DuBao';
            $model = chisogiatieudung_KichBan::all();
            return view('manage.vanbanqlnn.giatieudung.dubao.DanhSach')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('pageTitle','Thông tin dự báo chỉ số CPI');

        }else
            return view('errors.notlogin');
    }

    public function storeKichBan(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = chisogiatieudung_KichBan::where('id',-1)->first();

            if($model == null){
                unset($inputs['id']);
                $model = new chisogiatieudung_KichBan();
                $inputs['masokichban'] = getdate()[0];
                $model->create($inputs);
            }else{
                $model->update($inputs);
            }
           
            return redirect('/ChiSoCPI/DuBao/KichBan');

        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $id = $inputs['id'];
            $model = chisogiatieudung_TieuChi::findOrFail($id); 
            $model->delete();
            return redirect('ChiSoCPI/TieuChi/DanhSach');
        }else
            return view('errors.notlogin');
    }


    public function ChiTiet(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] =  '/ChiSoCPI/DuBao';
            $m_kichban = chisogiatieudung_KichBan::where('masokichban',$inputs['masokichban'])->first();
            $model = chisogiatieudung_KichBan_ChiTiet::where('masokichban',$inputs['masokichban'])->get();
            $m_hanghoa = chisogiatieudung_DanhMuc_ChiTiet::all();
            return view('manage.vanbanqlnn.giatieudung.dubao.ChiTiet')
                ->with('model',$model)
                ->with('m_kichban',$m_kichban)
                ->with('inputs',$inputs)
                ->with('a_hanghoa',array_column($m_hanghoa->toArray(),'tenhanghoa','masohanghoa'))
                ->with('pageTitle','Thông tin chi tiết danh mục');

        }else
            return view('errors.notlogin');
    }

    public function storeChiTiet(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = chisogiatieudung_TieuChi::where('masohanghoa_tieuchi',$inputs['masohanghoa'])->get();
            $m_kichban_chitiet = chisogiatieudung_KichBan_ChiTiet::where('masokichban',$inputs['masokichban'])->get();

            foreach($model as $chitiet){
                if($m_kichban_chitiet->where('masohanghoa',$chitiet->masohanghoa_tieuchi)->count()>0){
                    continue;
                }
                $new = new chisogiatieudung_KichBan_ChiTiet();
                $new->masohanghoa = $chitiet->masohanghoa_ketqua;
                $new->phanloai = $inputs['phanloai'];
                $new->ketqua = $chitiet->ketqua;
                $new->masokichban = $inputs['masokichban'];
                $new->save();
            }
           
            return redirect('ChiSoCPI/DuBao/ChiTiet?masokichban='.$inputs['masokichban']);

        }else
            return view('errors.notlogin');
    }

    public function DuBao(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] =  '/ChiSoCPI/DuBao';
            $m_danhmuc = chisogiatieudung_DanhMuc::all()->first();
            $m_kichban = chisogiatieudung_KichBan::where('masokichban',$inputs['masokichban'])->first();
            $model = chisogiatieudung_DanhMuc_ChiTiet::where('masodanhmuc',$m_danhmuc->masodanhmuc)->get();
            return view('manage.vanbanqlnn.giatieudung.dubao.DuBao')
                ->with('model',$model)
                ->with('m_kichban',$m_kichban)
                ->with('inputs',$inputs)
                ->with('pageTitle','Thông tin chi tiết danh mục');

        }else
            return view('errors.notlogin');
    }

    public function layTieuChi(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $id = $inputs['id'];
        $model = chisogiatieudung_TieuChi::findOrFail($id);
        die($model);
    }

    // public function update(Request $request){
    //     if (Session::has('admin')) {
    //         $inputs = $request->all();
    //         $model = BcThVeGiaDm::where('id',$inputs['edit_id'])
    //             ->first();
    //         $model->phanloai = $inputs['edit_phanloai'];
    //         $model->mota = $inputs['edit_mota'];
    //         $model->theodoi = $inputs['edit_theodoi'];
    //         $model->save();
    //         return redirect('dmbaocaothvegia');
    //     }else
    //         return view('errors.notlogin');
    // }

}
