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
        <div class="w-4/5 h-24 text-left">
            <h1>Faleminderit që na kontaktuat, {{ $details['name'] }}!</h1>
            <p>
                Jemi të lumtur që dëshironi të bashkoheni me ne në Al-Kurra për të ndjekur kurset tona të Kuranit.
                Ekipi ynë do të shqyrtojë kërkesën tuaj dhe do të lidhet me ju së shpejti për hapat e mëtejshëm.
            </p>
            &copy; {{ date('Y') }} Al-Kurra. Të gjitha të drejtat të rezervuara.
        </div>
    </div>
</body>
</html>
