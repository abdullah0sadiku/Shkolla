<html lang="en">
<head>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
</head>
<body>
    <div class="flex flex-col justify-center items-center">
        <div id="logo-light" class="w-full h-24 bg-slate-900 text-white flex justify-center items-center">
                Al-kurra | القراء
        </div>
        <div class="w-4/5 h-24 text-left">
            <h1>Nje kerkes e re  per rigjistrim !! !</h1>
            <p>
                Ki nje kerkes te re me emer {{ $details['name'] }} dhe email {{$details['email']}}.
                Nxito.  
            </p>
            &copy; {{ date('Y') }} Al-Kurra. Të gjitha të drejtat të rezervuara.
        </div>
    </div>
</body>
</html>