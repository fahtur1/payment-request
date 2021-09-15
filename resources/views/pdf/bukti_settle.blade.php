<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Settlement</title>
</head>
<body>
    <table border="0">
        @foreach($payment->item as $item)
        <center>
            <tr>
                <td>
                    <img width="500" src="{{ storage_path('app/public/settlement/' . $item->settlement) }}" alt="">
                </td>
            </tr>
        </center>
        @endforeach
    </table>
</body>
</html>
