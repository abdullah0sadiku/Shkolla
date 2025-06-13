<x-app-layout>
    <div class=" py-12">
            <div class="bg-slate-200 p-10 m-10 flex flex-col justify-center items-start rounded-xl">
                <span class="font-bold text-xl">
                    Takimet aktive 
                </span>

                <table class="w-full mt-3 bg-white border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Klasa</th>
                            <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Mesuesi</th>
                            <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Filloj</th>
                            <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Veprimet</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($sessions as $session)
                            <tr>
                                <td class="border px-4 py-2">{{ $session->class->name }}</td>
                                <td class="border px-4 py-2">{{ $session->teacher->name }}</td>
                                <td class="border px-4 py-2">{{ $session->started_at }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('meeting', ['classId' => $session->class_id]) }}" class="p-2 bg-green-500 ">
                                        Kyqu ne takim (Anonnim)
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>  
            <div class="bg-slate-200 p-10 m-10 flex flex-col justify-center items-start rounded-xl">
                <span class="font-bold text-xl">
                    Takimet jo aktive 
                </span>

                <table class="w-full mt-3 bg-white border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Klasa</th>
                            <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Mesuesi</th>
                            <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Filloj</th>
                            <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Gjendaj</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($offline_sessions as $session)
                            <tr>
                                <td class="border px-4 py-2">{{ $session->class->name }}</td>
                                <td class="border px-4 py-2">{{ $session->teacher->name }}</td>
                                <td class="border px-4 py-2">{{ $session->started_at }}</td>
                                <td class="border px-4 py-2">{{ $session->is_active }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>  
    </div>
    
</x-app-layout>