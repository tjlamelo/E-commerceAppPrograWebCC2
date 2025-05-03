<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- @vite(['css/layout.css', "css/{{ $style }}.css"]) --}}
    @vite(['resources/css/layout.css', "resources/css/{$style}.css"])
    


</head>

<body>
    {{ $slot }}

    <script src="js/{{ $script }}.js"></script>
</body>
</html>
