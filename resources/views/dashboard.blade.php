<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(Auth::user()->getRoleNames()->first() == "Drejtor")
                <a href="/Steps" class="bg-gray-600 text-white w-40 p-2 rounded-xl my-5 hover:bg-gray-700 transition duration-300 ease-in-out">Hapat</a>    
                <a href="/" class="bg-gray-600 text-white w-40 p-2 rounded-xl my-5 hover:bg-gray-700 transition duration-300 ease-in-out">Shkolla</a>    
                <div class="bg-slate-300 gap-5 my-5 overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <h1 class="font-bold text-xl">Klasat e shkolles</h1>
                
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">    
                        @foreach($data as $klasat)
                            <form action="{{ route('klasa.show', $klasat->id) }}" method="GET">
                                <button type="submit" class="text-left bg-indigo-700 flex flex-col justify-between text-white h-auto w-full font-bold text-2xl p-2 rounded-xl my-5 hover:scale-105 transition-all duration-300 ease-in-out">
                                    {{ $klasat->name }}
                                    <br>
                                    <br>
                                    @php
                                        $teachers_id = $klasat->teacher_id;
                                        $emri = App\Models\User::where('id', $teachers_id)->value('name');
                                        $email = App\Models\User::where('id', $teachers_id)->value('email');
                                    @endphp
                    
                                    {{ $emri }}
                                    <br>
                                    {{ $email }}
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            
                <div class="bg-slate-300 gap-5 my-5 overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <h1 class="font-bold text-xl">Menagjimi</h1>
                    <div class="flex flex-row items-center gap-3">
                        <!-- Per Msues -->
                        <form action="{{ route('mng-users.show', ['id' => 'msues']) }}" method="GET">
                            <button id="msuesit" class="text-left bg-indigo-950 flex flex-col justify-between text-white h-28 w-auto font-bold text-2xl p-2 rounded-xl my-5 hover:scale-110 transition duration-300 ease-in-out">
                                Mesuesit
                            </button>
                        </form>                      
                    
                        <!-- Per student -->
                        <form action="{{ route('mng-users.show', ['id' => 'student']) }}" method="GET">
                            <button id="studentet" class="text-left bg-indigo-950 flex flex-col justify-between text-white h-28 w-auto font-bold text-2xl p-2 rounded-xl my-5 hover:scale-110 transition duration-300 ease-in-out">
                                Studentet
                            </button>
                        </form>  
                    
                        <!-- Per kerkesat -->
                        <form action="{{ route('kerkesat') }}" method="GET">
                            <button id="kerkesat" class="text-left bg-indigo-950 flex flex-col justify-between text-white h-28 w-auto font-bold text-2xl p-2 rounded-xl my-5 hover:scale-110 transition duration-300 ease-in-out">
                                Kerkesat
                            </button>
                        </form> 

                        <form action="{{ route('mng-klasa') }}" method="GET">
                            <button id="studentet" class="text-left bg-indigo-950 flex flex-col justify-between text-white h-28 w-auto font-bold text-2xl p-2 rounded-xl my-5 hover:scale-110 transition duration-300 ease-in-out">
                                Klasat
                            </button>
                        </form>

                        <form action="{{ route('mng-paga') }}" method="GET">
                            <button id="studentet" class="text-left bg-indigo-950 flex flex-col justify-between text-white h-28 w-auto font-bold text-2xl p-2 rounded-xl my-5 hover:scale-110 transition duration-300 ease-in-out">
                                Pagat dhe financat
                            </button>
                        </form> 
                    </div>
                </div>
            
            <div class="flex flex-row gap-5">
                <div class="w-1/2 bg-slate-300 gap-5 my-5 overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <h1 class="font-bold text-xl">Statistikat</h1>
                    <div class="flex flex-row items-center gap-3">
                        <form action="{{ route('stat') }}" method="GET">
                            <button id="studentet" class="text-left bg-indigo-800 flex flex-col justify-between text-white h-28 w-auto font-bold text-2xl p-2 rounded-xl my-5 hover:scale-110 transition duration-300 ease-in-out">
                                Statistika
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="w-1/2 bg-slate-300 gap-5 my-5 overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <h1 class="font-bold text-xl">Sherbimet</h1>
                </div>
            </div>
            @endif
    
    
            @if(Auth::user()->getRoleNames()->first() == "Studenti")
                <div class="bg-white gap-5 overflow-hidden shadow-xl sm:rounded-lg p-5">
                
                    <!-- /////////////////////////////////////////////////////// -->
                        <span class="text-xl text-black font-bold">Klasat e mia</span>
                        @foreach($data as $klasat)
                            @if(Auth::user()->class_id === NULL)
                                <div class="bg-red-600 flex flex-col justify-between text-white h-28 w-60 font-bold text-2xl p-2 rounded-xl my-5 hover:bg-gray-700 transition duration-300 ease-in-out">
                                    Nuk je ende antar e ndonje klase :(
                                </div>
                            @else
                                @if($klasat->id == Auth::user()->class_id) 
                                    <form action="{{ route('klasa.show', $klasat->id) }}" method="GET">
                                        <button type="submit" class="text-left bg-green-600 flex flex-col justify-center items-center text-white h-20 w-40 font-bold text-3xl p-2 rounded-xl my-5 hover:bg-gray-700 transition duration-300 ease-in-out">
                                            {{ $klasat->name }}
                                        </button>
                                    </form>
                                @endif
                            @endif
                        @endforeach
                </div>
                <div class="bg-white gap-5 mt-10 overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <span class="text-xl text-black font-bold">Orari im</span>
                    
                </div>
                <div class="bg-white gap-5 mt-10 overflow-hidden shadow-xl sm:rounded-lg p-5">
                        <span class="text-xl text-black font-bold">Performanca ne shkolle</span>
                        
                </div>
                <div class="bg-white gap-5 mt-10 overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <span class="text-xl text-black font-bold">Arritjet ne shkollw</span>
                    
                </div>
            @endif
                <!-- /////////////////////////////////////////////////////// -->
            @if(Auth::user()->getRoleNames()->first() == "Mesuesi")
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-slate-300 gap-5 my-5 overflow-hidden shadow-xl sm:rounded-lg p-5">
                        <span class="text-xl text-black font-bold">Klasat e mia</span>
                        <div class="flex justify-start items-center">
                        @if($data->isEmpty())
                            <div class="p-3 bg-red-500 ">
                                <span class="text-xl font-bold text-white">Nuk keni ndonje klasa aktive ende !!</span>
                            </div>
                        @else
                            @foreach($data as $klasat)
                                @if($klasat->teacher_id == Auth::user()->id)
                                    <form action="{{ route('klasa.show', $klasat->id) }}" method="GET">
                                        <button type="submit" class="text-left">
                                            <div class="bg-indigo-600 flex flex-col justify-between text-white h-28 w-60 font-bold text-2xl p-2 rounded-xl my-5 hover:bg-gray-700 transition duration-300 ease-in-out">
                                                {{ $klasat->name }}
                                                <div class="text-xl">
                                                    Numri i studentve | {{ $users->where('class_id', $klasat->id)->count() }}
                                                </div>
                                            </div>
                                        </button>
                                    </form>
                                @endif
                            @endforeach
                        @endif
                        </div>
                    </div>
                    
                    <div class="bg-slate-300 gap-5 my-5 overflow-hidden shadow-xl sm:rounded-lg p-5">
                        <span class="text-black text-xl font-bold">Menagjimi</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
