@if(chkPer('csdlttpvctqlnn','ttpvctqlnn','ttqlnn'))
    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
        data-original-title="">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">Thông tin phục vụ công tác QLNN về giá</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if(chkPer('csdlttpvctqlnn','ttpvctqlnn','ttqlnn','danhmuc','index'))
                <li>
                    <a href="{{url('dmttpvctqlnn')}}">Danh mục thông tin</a>
                </li>
            @endif
            @if(chkPer('csdlttpvctqlnn','ttpvctqlnn','ttqlnn','hoso','index'))
                <?php $ttpvctqlnn = \App\Model\manage\ttpvctqlnn\TtPvCtQlNnDm::where('theodoi','TD')->get();?>
                @foreach($ttpvctqlnn as $ttpv)
                <li class="tooltips" data-container="body" data-placement="right" data-html="true"
                    data-original-title="">
                    <a href="{{url('ttpvctqlnn?&phanloai='.$ttpv->phanloai)}}"><span class="title">{{$ttpv->mota}}</span>
                    </a>
                </li>
                @endforeach
            @endif
        </ul>
    </li>
@endif
