<!DOCTYPE html>
<html>
<head>
    <title>Tasks Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Tasks Report</h1>
    <table>
        <thead>
            <tr>
                @foreach ($tasks[0] as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $row)
                @if (!$loop->first)
                    <tr>
                        @foreach ($row as $column)
                            <td>{{ $column }}</td>
                        @endforeach
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>
