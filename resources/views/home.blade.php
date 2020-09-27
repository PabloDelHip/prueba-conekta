<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prueba</title>
    <script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/css/app.css') }}">
</head>
<body>

    <div id="app" class="content"><!--La equita id debe ser app, como hemos visto en app.js-->
        <pago-component></pago-component><!--Añadimos nuestro componente vuejs-->
    </div>
    <!-- /.content -->
    {{-- <script> Conekta.setPublicKey("key_eYvWV7gUaMyaN4iD");</script> --}}
    <script src="{{asset('js/app.js')}}"></script>

    
</body>
</html>