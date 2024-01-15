<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title> {{ $title }} </title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,400;1,500&display=swap');

        .report-box {
            max-width: 800px;
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        ::selection {background: #f31544; color: #FFF;}
        ::moz-selection {background: #f31544; color: #FFF;}

        h2{font-size: .9em;}

        table{
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 5px 0 5px 15px;
            border: 1px solid #EEE
        }
        .table-title {
            padding: 5px;
            background: #EEE;
        }
        .table-row { border: 1px solid #EEE; height: 40px }
        .item-text {
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
            height: 30px;
        }

        .content.page-break {
            page-break-before: always;
        }

        @media print {
            @page {
                size: 'A4'; /* You can try 'auto' or specific paper sizes like 'letter', 'A4', etc. */
                margin-top: 0; /* Try setting margins to 0 to maximize space */
                margin-bottom: 0;
                margin-left: 1;
                margin-right: 1;
            }

            body {
                margin: 0;
                padding: 0;
            }
        }

        .report-header-container {
            border-bottom: 2px solid;
            padding: 1em 0em;
            margin-bottom: 5px;
            font-family: 'Ubuntu', sans-serif;
            font-size: 14px;
            color: black;
        }

        .report-footer-text {
            text-align: right;
            font-size: 12px;
            color: white;
            font-weight: 100;
            background: darkgray;
        }
    </style>
</head>

<body>
    <div class="report-box" id="page-drawing-area">
        <div class="header" id="header-container">
            @if(View::exists('lara_report_craft.partiel.header'))
                @include('lara_report_craft.partiel.header')
            @else
                @include('lara_report_craft::printing.partiel.header')
            @endif
        </div>

        <div class="footer" id="footer-container">
            @if(View::exists('lara_report_craft.partiel.footer'))
                @include('lara_report_craft.partiel.footer')
            @else
                @include('lara_report_craft::printing.partiel.footer')
            @endif
        </div>
    </div>
</body>

</html>
