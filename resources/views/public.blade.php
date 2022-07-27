<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>{{ env('APP_NAME') }}</title>
    <link href="{{ mix('/css/app.css')}}" rel="stylesheet" />
    <script src="{{ mix('/js/public.js') }}" defer></script>
  </head>
  <body>
    @inertia
  </body>

</html>
