<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
 <script defer src="{{ mix('js/app.client.js') }}"></script>
  <title>Document</title>
</head>
<body>
  <div id="app"></div>
  {!! ssr('js/app.server.js')->render() !!}
</body>
</html>
