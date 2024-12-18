<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>
    <style>
        body {
            margin-top: 2cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            color: black;
        }

        header .pagenum:before {
            content: counter(page);
        }

        table.customTable {
            width: 100%;
            background-color: #FFFFFF;
            border-collapse: collapse;
            font-size: 14px;
        }

        table.customTable tbody {
            border-bottom: 1px solid black;
        }

        table.customTable th {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        table.customTable td {
            padding: 5px;
            text-align: left;
        }

        table.customTable thead {
            font-weight: bold;
            color: black;
        }

        table.customTable tbody {
            color: black;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
@yield('content')
</body>
</html>
