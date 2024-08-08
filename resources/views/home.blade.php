<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Laravel 11</title>
</head>
<body>
    <div class="max-w-4xl mx-auto px-4 font-bold underline">
        Bienvenido a la pagina principal
        <br><x-alert type="warning" class='mb-4'>
            <x-slot name='titulo'>
                Titulo
            </x-slot>
            contenido de la alerta
        </x-alert>
        <p>Hola mundo</p>
    </div>
</body>
</html>