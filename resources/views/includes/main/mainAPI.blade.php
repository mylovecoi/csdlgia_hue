
{{--@if((chkPer('hethong', 'hethong_pq', 'api') && session('admin')->chucnang == 'QUANTRI') || session('admin')->level == 'SSA')--}}
@if(chkPer('hethong', 'hethong_pq', 'api'))
    <li class="heading">
        <h3 class="uppercase">Hệ Thống API</h3>
    </li>
    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
        data-original-title="Hệ Thống API">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">Hệ Thống API</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                <a href="{{url('api/giadatphanloai')}}">Giá đất phân loại</a>
            </li>

            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                <a href="{{url('api/giathuedatnuoc')}}">Giá Thuê đất, nước</a>
            </li>

            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                <a href="{{url('api/giarung')}}">Giá thuê môi trường rừng</a>
            </li>

            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                <a href="{{url('api/thuemuanhaxahoi')}}">Giá cho thuê, thuê mua nhà xã hội</a>
            </li>

            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                <a href="{{url('api/gianuocsachsinhhoat')}}">Giá nước sạch sinh hoạt</a>
            </li>

            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                <a href="{{url('api/giathuetscong')}}">Giá thuê tài sản công</a>
            </li>

            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                <a href="{{url('api/giaspdvci')}}">Giá SP, DVCI, DVSNC, HH-DV đặt hàng</a>
            </li>

            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                <a href="{{url('api/giadvgddt')}}">Giá dịch vụ đào tạo</a>
            </li>

            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                <a href="{{url('api/giadvkcb')}}">Giá dịch vụ khám chữa bệnh</a>
            </li>

            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                <a href="{{url('api/trogiatrocuoc')}}">Mức trợ giá, trợ cước</a>
            </li>

            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                <a href="{{url('api/giahhdvcn')}}">Giá hàng hóa, dịch vụ khác theo quy định của pháp luật chuyên ngành</a>
            </li>
        </ul>
    </li>
@endif
