<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets') }}/css/sb-admin-2.min.css" rel="stylesheet">
    <title>Bukti Settlement</title>
</head>
<body>
<table border="0" style="width: 100%">
    @foreach($payment->item as $item)
        <tr>
            <td class="text-center">
                <img src="{{ asset('settlement/' . $item->settlement) }}" alt=""
                     style="width: 100%; height: auto; object-fit: contain">
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>
