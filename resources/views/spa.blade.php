<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script defer src="{{ mix('js/app.client.js') }}"></script>
    <title>Document</title>
</head>

<body>
    {!! ssr('js/app.server.js')
    // SSR 실패 시 CSR 로 작동되게
    ->fallback('<div id="app"></div>')
    ->render() !!}
</body>

</html>
