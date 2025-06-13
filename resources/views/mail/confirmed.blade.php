<!-- resources/views/emails/kerkesat-submitted.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerkesa</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
</head>
<body>
    <div class="flex flex-col justify-center items-center">
        <div id="logo-light" class="w-full h-24 bg-slate-900 text-white flex justify-center items-center">
                Al-kurra | القراء
        </div>
        <div class="w-4/5 h-auto text-left p-10 mt-5 bg-slate-200 rounded-xl">
            <h1>Selam Alejkum, {{ $details['name'] }}!</h1>
            <p>
                Kerkesa juaj eshte aprovuar se shpejti do te ju kontaktojm !!
            </p>
            <br>
            <br>
            &copy; {{ date('Y') }} Al-Kurra. Të gjitha të drejtat të rezervuara.
        </div>
    </div>
</body>
</html>
