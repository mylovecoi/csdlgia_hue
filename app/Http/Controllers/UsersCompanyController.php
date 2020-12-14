<?php

namespace App\Http\Controllers;

use App\Model\system\company\Company;
use App\Model\system\company\CompanyLvCc;
use App\District;
use App\Model\system\dmnganhnghekd\DmNganhKd;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use App\Model\system\dsdonvi;
use App\Model\system\view_dsdoanhnghiep_dangky;
use App\Town;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UsersCompanyController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $model = view_dsdoanhnghiep_dangky::all();
            //dd($model);
            return view('system.userscompany.index')
                ->with('model', $model)
                ->with('pageTitle', 'Danh sách tài khoản doanh nghiệp');
        } else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            //dd($input);
            $model = Users::where('madv',$input['madv'])->first();
            $modelcompany = Company::where('madv',$model->madv)->first();
            $modellvcc = CompanyLvCc::where('madv',$model->madv)->get();
            $a_nghe = array_column(DmNgheKd::all()->toArray(),'tennghe','manghe');
            $a_dv = array_column(dsdonvi::all()->toArray(),'tendv','madv');
            //dd($modelcompany);
            return view('system.userscompany.edit')
                ->with('model', $model)
                ->with('modelcompany',$modelcompany)
                ->with('modellvcc',$modellvcc)
                ->with('a_nghe',$a_nghe)
                ->with('a_dv',$a_dv)
                ->with('pageTitle', 'Chỉnh sửa thông tin tài khoản doanh nghiệp');
        } else
            return view('errors.notlogin');
    }

    public function update(Request $request)
    {
        if (Session::has('admin')) {
            $input = $request->all();
            //dd($input);
            $model = Users::where('username', $input['username'])->first();
            if ($input['newpass'] != '') {
                $model->password = md5($input['newpass']);
            }
            $model->name = $input['name'];
            $model->status = $input['status'];
            $model->save();
            return redirect('/doanhnghiep/dstaikhoan');

        } else
            return view('errors.notlogin');
    }

    public function permission($id){
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X' && can('users','per')) {
                $model = Users::findorFail($id);
                $permission = !empty($model->permission) || $model->permission != '' ? $model->permission : getPermissionDefault($model->level);
                //dd(json_decode($permission));
                return view('system.userscompany.perms')
                    ->with('permission', json_decode($permission))
                    ->with('model', $model)
                    ->with('pageTitle', 'Phân quyền cho tài khoản doanh nghiệp');
            }else
                return view('errors.noperm');
        } else
            return view('errors.notlogin');
    }

    public function uppermission(Request $request)
    {
        if (Session::has('admin')) {
            $update = $request->all();

            $id = $update['id'];

            $model = Users::findOrFail($id);
            //dd($model);
            if (isset($model)) {
                $update['roles'] = isset($update['roles']) ? $update['roles'] : null;

                $model->permission = json_encode($update['roles']);
                $model->save();
                return redirect('userscompany?&level='.$model->level);

            } else
                dd('Tài khoản không tồn tại');

        } else
            return view('errors.notlogin');
    }

    public function destroy(Request $request)
    {
        //lấy theo phân quyền chkPer('hethong', 'hethong_pq', 'dangky')
        if (Session::has('admin')) {
            $input = $request->all();
            //$model = Users::where('madv', $input['madv'])->first();
            DB::statement("Delete from ttdntd where madv ='".$input['madv']."'");
            DB::statement("Delete from companylvcc where madv ='".$input['madv']."'");
            DB::statement("Delete from kkgiaxmtxd where madv ='".$input['madv']."'");
            DB::statement("Delete from kkgiathan where madv ='".$input['madv']."'");
            DB::statement("Delete from kkgiatacn where madv ='".$input['madv']."'");
            DB::statement("Delete from kkgiagiay where madv ='".$input['madv']."'");
            DB::statement("Delete from kkgiasach where madv ='".$input['madv']."'");
            DB::statement("Delete from kkgiaetanol where madv ='".$input['madv']."'");
            DB::statement("Delete from giavtxk where madv ='".$input['madv']."'");
            DB::statement("Delete from kkgiavtxb where madv ='".$input['madv']."'");
            DB::statement("Delete from kkgiavtxtx where madv ='".$input['madv']."'");
            DB::statement("Delete from kkgs where madv ='".$input['madv']."'");
            DB::statement("Delete from kkgiadvlt where madv ='".$input['madv']."'");
            DB::statement("Delete from kkgiadvch where madv ='".$input['madv']."'");
            DB::statement("Delete from kkgiahplx where madv ='".$input['madv']."'");
            DB::statement("Delete from kkgiacatsan where madv ='".$input['madv']."'");
            DB::statement("Delete from kkgiadatsanlap where madv ='".$input['madv']."'");
            DB::statement("Delete from kkgiadaxaydung where madv ='".$input['madv']."'");
            DB::statement("Delete from users where madv ='".$input['madv']."'");
            DB::statement("Delete from company where madv ='".$input['madv']."'");
            return redirect('/doanhnghiep/dstaikhoan');
        } else
            return view('errors.notlogin');
    }
}
