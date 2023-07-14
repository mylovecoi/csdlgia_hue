<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="vi">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $pageTitle }}</title>
    <link rel="shortcut icon" href="{{ url('images/LIFESOFT.png') }}" type="image/x-icon">
    <style type="text/css">
        body {
            font: normal 14px/16px time, serif;
        }

        table,
        p {
            width: 98%;
            margin: auto;
        }

        table tr th {
            text-align: center;
        }

        table tr td:first-child {
            text-align: center;
        }

        td,
        th {
            padding: 10px;
        }

        p {
            padding: 5px;
        }

        @media print {
            .in {
                display: none !important;
            }
        }

        #fixNav {
            background: #f7f7f7;
            width: 100%;
            height: 35px;
            display: block;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.5);
            /*Đổ bóng cho menu*/
            position: fixed;
            /*Cho menu cố định 1 vị trí với top và left*/
            top: 0;
            /*Nằm trên cùng*/
            left: 0;
            /*Nằm sát bên trái*/
            z-index: 100000;
            /*Hiển thị lớp trên cùng*/
        }

        #fixNav ul {
            margin: 0;
            padding: 0;

        }

        #fixNav ul li {
            list-style: none inside;
            width: auto;
            float: left;
            line-height: 35px;
            /*Cho text canh giữa menu*/
            color: #fff;
            padding: 0;
            margin-left: 10px;
            position: relative;
        }

        #fixNav ul li a {
            text-transform: uppercase;
            white-space: nowrap;
            /*Cho chữ trong menu không bị wrap*/
            padding: 0 10px;
            color: #fff;
            display: block;
            font-size: 0.8em;
            text-decoration: none;
        }

        @yield('custom-style')
    </style>
    {{-- Ex Doc --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{{ url('reports/FileSaver.js') }}"></script>
    <script src="{{ url('reports/jquery.wordexport.js') }}"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" --}}
    {{-- crossorigin="anonymous"></script> --}}
    <script src="{{ url('reports/table2csv.js') }}"></script>
    <script type="text/javascript">
        function ExDoc() {
            $("#page-content").wordExport();
        }

        function ExCsv() {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableHTML = '';
            //Tiêu đề
            var data_header = document.getElementById('data_header');
            if (data_header) {
                tableHTML = tableHTML + data_header.outerHTML.replace(/ /g, '%20');
            }

            //Nội dung 1
            var data_body = document.getElementById('data_body');
            if (data_body) {
                tableHTML = tableHTML + data_body.outerHTML.replace(/ /g, '%20');
            }
            //Nội dung 2
            var data_body1 = document.getElementById('data_body1');
            if (data_body1) {
                tableHTML = tableHTML + data_body1.outerHTML.replace(/ /g, '%20');
            }
            //Nội dung 3
            var data_body2 = document.getElementById('data_body2');
            if (data_body2) {
                tableHTML = tableHTML + data_body2.outerHTML.replace(/ /g, '%20');
            }
            //Nội dung 4
            var data_body3 = document.getElementById('data_body3');
            if (data_body3) {
                tableHTML = tableHTML + data_body3.outerHTML.replace(/ /g, '%20');
            }
            //Nội dung 5
            var data_body4 = document.getElementById('data_body4');
            if (data_body4) {
                tableHTML = tableHTML + data_body4.outerHTML.replace(/ /g, '%20');
            }
            //Nội dung 6
            var data_body5 = document.getElementById('data_body5');
            if (data_body5) {
                tableHTML = tableHTML + data_body5.outerHTML.replace(/ /g, '%20');
            }

            //Chữ ký
            var data_footer = document.getElementById('data_footer');
            if (data_footer) {
                tableHTML = tableHTML + data_footer.outerHTML.replace(/ /g, '%20');
            }
            //Xác nhận
            var data_footer1 = document.getElementById('data_footer1');
            if (data_footer1) {
                tableHTML = tableHTML + data_footer1.outerHTML.replace(/ /g, '%20');
            }

            // Specify file name
            var filename = $('#title').val() + '.xls';

            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
        }

        
    </script>    
    @yield('custom-script')
</head>

<body style="font:normal 14px Times, serif;">
    <div class="in">
        <nav id="fixNav">
            <ul>
                <li><button onclick=" window.print()">Print</button></li>
                <li><button onclick="ExDoc()"> Xuất ra Word </button></li>
                <li><button onclick="ExCsv()"> Xuất ra Excel </button></li>
            </ul>
        </nav>
    </div>
    <div id="page-content" style="position: relative; margin-top: 40px">
        @yield('content')
    </div>
</body>

</html>
