
    <div class="row">
        @if(chkPer('csdlmucgiahhdv','bog', 'bog', 'hoso', 'index')
            && (session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA'))

            <div class="col-md-6 col-sm-12">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <span class="caption-subject theme-font-color uppercase">{{session('admin')['a_chucnang']['bog'] ?? 'Mặt hàng bình ổn giá'}}</span>
                        </div>
                    </div>
                    <?php $i=1;?>
                    <div class="portlet-body">
                        <table class="table-dulieubang table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="10%" class="text-center">TT</th>
                                    <th class="text-center">Phân loại hàng hóa, dịch vụ</th>
                                    <th width="15%" class="text-center">Hồ sơ<br>chờ duyệt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($a_bog as $key=>$value)
                                    <tr>
                                        <td>-</td>
                                        <td>
                                            <a href="{{url('/binhongia/xetduyet')}}">{{$value['tennghe']}}</a>

                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-info">{{dinhdangso($value['hoso'])}}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

            @if(chkPer('csdlmucgiahhdv','kknygia')
                && (session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA'))

                <div class="col-md-6 col-sm-12">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                                <span class="caption-subject theme-font-color uppercase">{{session('admin')['a_chucnang']['kknygia'] ?? 'Mặt hàng kê khai, đăng ký giá'}}</span>
                            </div>
                        </div>
                        <?php $i=1;?>
                        <div class="portlet-body">
                            <table class="table-dulieubang table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th width="10%" class="text-center">TT</th>
                                    <th class="text-center">Loại hình kinh doanh</th>
                                    <th width="10%" class="text-center">Hồ sơ<br>chờ duyệt</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($a_kekhai as $key=>$value)
                                    <tr>
                                        <td class="text-center">-</td>
                                        <td>
                                            <a href="{{url($value['url'])}}">{{session('admin')['a_chucnang'][$key] ?? $key}}</a>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-info">{{dinhdangso($value['hoso'])}}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
    </div>