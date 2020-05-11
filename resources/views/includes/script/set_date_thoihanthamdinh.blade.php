<?php
/**
 * Created by PhpStorm.
 * User: HuongVu
 * Date: 07/09/2017
 * Time: 8:55 AM
 */
        ?>
<script>
    function add_date(thoidiem,songay) {
        if(thoidiem == ''){
            return null;
        }
        if(songay == '' || songay == 0){
            return thoidiem;
        }

        var date = new Date(thoidiem);
        date.setDate(date.getDate() + parseInt(songay));

        var dd = date.getDate();
        var mm = date.getMonth() + 1;
        var y = date.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        return (y + '-' + mm + '-' + dd);
    }
</script>