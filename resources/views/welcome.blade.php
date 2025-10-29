<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('storage/images/logo.png') }}" type="image/x-icon" />
    <title>{{env('APP_NAME')}}</title>
    @vite('resources/css/app.css')
  </head>
  <body>
    <h1 class="text-3xl font-bold underline">
      Hello world!
    </h1>
  </body>
</html>