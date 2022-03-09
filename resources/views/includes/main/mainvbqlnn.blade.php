
@if(chkPer('csdlvbqlnn','vbqlnn','vbgia','hoso','index'))
    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
        data-original-title="Văn bản quản lý nhà nước về giá, các báo cáo tổng hợp">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">Văn bản quản lý nhà nước về giá - phí, lệ phí</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
{{--            <li class="tooltips" data-container="body" data-placement="right" data-html="true"--}}
{{--                data-original-title="Các quyết định, văn bản quản lý, điều hành về giá">--}}
{{--                <a href="{{url('vanbanqlnnvegia')}}">Các quyết định, văn bản quản lý, điều hành về giá - phí, lệ phí</a>--}}
{{--            </li>--}}

            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                <a href="{{url('vanbanqlnnvegia?phanloai=gia&loaivb=quyetdinh')}}">Các quyết định, văn bản quản lý, điều hành về giá</a>
            </li>

            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                <a href="{{url('vanbanqlnnvegia?phanloai=gia&loaivb=vbhd')}}">Các văn bản hướng dẫn, tham gia, góp ý</a>
            </li>

            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                <a href="{{url('vanbanqlnnvegia?phanloai=gia&loaivb=baocao')}}">Báo cáo tình hình giá cả thị trường</a>
            </li>

            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                <a href="{{url('vanbanqlnnvegia?phanloai=gia&loaivb=tailieu')}}">Các báo cáo, tài liệu học tập kinh nghiệm</a>
            </li>

            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                <a href="{{url('vanbanqlnnvegia?phanloai=gia&loaivb=khoahoc')}}">Kết quả, đề tài nghiên cứu khoa học</a>
            </li>
            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                <a href="{{url('vanbanqlnnvegia?phanloai=gia&loaivb=vbkhac')}}">Các báo cáo, văn bản có liên quan khác</a>
            </li>
        </ul>
    </li>
@endif

@if(chkPer('csdlvbqlnn','vbqlnn','chisogiatieudung','hoso', 'index'))
    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
        data-original-title="Chỉ số giá tiêu dùng (CPI)">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">Chỉ số giá tiêu dùng (CPI)</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{url('/ChiSoCPI/DanhMuc')}}">Danh mục hàng hoá</a>
            </li>
            <li>
                <a href="{{url('/ChiSoCPI/TieuChi')}}">Danh sách tiêu chí</a>
            </li>
            <li>
                <a href="{{url('baocaochisogiatieudung')}}">Báo cáo chỉ số giá tiêu dùng</a>
            </li>
            <li>
                <a href="{{url('/ChiSoCPI/DuBao')}}">Dự báo chỉ số giá tiêu dùng</a>
            </li>
        </ul>
    </li>
@endif

@if(chkPer('csdlvbqlnn','vbqlnn','bcthvegia'))
    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
        data-original-title="Các báo cáo tổng hợp về giá">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">Báo cáo tổng hợp về giá</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if(chkPer('csdlvbqlnn','vbqlnn','bcthvegia','danhmuc', 'index'))
                <li class="tooltips" data-container="body" data-placement="right" data-html="true"
                    data-original-title="">
                    <a href="{{url('dmbaocaothvegia')}}">Danh mục báo cáo tổng hợp</a>
                </li>
            @endif

            @if(chkPer('csdlvbqlnn','vbqlnn','bcthvegia','hoso', 'index'))
                <?php $modelbcthvegia = \App\Model\manage\vanbanplvegia\baocaoth\BcThVeGiaDm::where('theodoi','TD')->get();?>
                @foreach($modelbcthvegia as $bcthvegia)
                <li class="tooltips" data-container="body" data-placement="right" data-html="true"
                    data-original-title="">
                    <a href="{{url('baocaothvegia?&phanloai='.$bcthvegia->phanloai)}}">{{$bcthvegia->mota}}</a>
                </li>
                @endforeach
            @endif
        </ul>
    </li>
@endif

