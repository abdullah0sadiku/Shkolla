<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Takimi i klases {{$klasa->name}}</title>

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="bg-indigo-950 flex flex-col min-h-screen">

    <!-- Main Content -->
    <div class="flex-grow flex w-full">
        <!-- Cam Section (Left) -->
        <div class="w-9/12 h-screen p-4 flex flex-col gap-4">
            <!-- Video Grid -->
            <div class="grid grid-cols-2 gap-4">
                @foreach($processed_users as $id => $name)
                    <div class="bg-black rounded-lg shadow-lg overflow-hidden relative">
                        <video id="user-video-" class="w-full h-full object-cover" autoplay muted></video>
                        <span class="absolute bottom-2 left-2 text-white bg-gray-900 bg-opacity-50 px-2 py-1 rounded text-sm">
                            {{$name}}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- Participants Section (Right) -->
        <div class="w-3/12 h-screen bg-gray-800 p-4 overflow-y-auto">
            
            <!-- Antart AKTIVVV -->
            <h2 class="text-white text-lg font-bold mb-4">Anart aktiv ne takim</h2>
            <div id="active-members-list" class="flex flex-col gap-4">
                @foreach($processed_users as $id=>$user)
                    
                    <div class="@if(Auth::user()->id == $id)  bg-green-600 @else bg-slate-600 @endif  text-white p-3 rounded-lg flex items-center justify-between">
                        <span>@if(Auth::user()->id == $id) Une : @endif{{ $user }}</span>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <!-- Control Section -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 w-96 bg-gray-900 p-4 rounded-2xl shadow-lg flex items-center justify-evenly">
        <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Mute</button>
        <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Block Cam</button>
        @if(auth()->user()->hasrole('Mesuesi') )
            <form action="{{ route('end_meeting', $klasa->id) }}" method="post">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-700 text-white rounded-lg hover:bg-red-800 transition">
                    End Meeting
                </button>
            </form>
        @else
            <form action="{{ route('meeting.leave', $klasa->id) }}" method="post">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                    Leave
                </button>
            </form>
        @endif
    </div>

    <script>
        const meetingId = {{$klasa->id}};
        setInterval(() => {
            fetch(`/meeting/${meetingId}/active-participants`)
                .then(response => response.json())
                .then(data => {
                    const membersList = document.getElementById('members-list');
                    membersList.innerHTML = ''; // Clear current list
                
                    data.forEach(participant => {
                        const memberItem = document.createElement('div');
                        memberItem.classList.add('bg-slate-600', 'p-3', 'rounded-lg', 'flex', 'items-center', 'justify-between');
                        memberItem.innerHTML = `<span>${participant.user.name}</span>`;
                        membersList.appendChild(memberItem);
                    });
                });
        }, 5000); // Fetch every 5 seconds
    </script>
</body>
</html>
