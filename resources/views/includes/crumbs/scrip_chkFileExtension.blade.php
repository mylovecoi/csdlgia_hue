<script>
    function chkFile(obj) {
        //alert(obj.value);
        if(obj.value != '' || obj.value != null) {
            var ext = obj.value.split('.').pop().toLowerCase();
            if(ext == 'exe'){
                toastr.error('File đính kèm không chứa các file chương trình (.exe).','Lỗi!');
                obj.value = null;
            }
        }
    }
</script>