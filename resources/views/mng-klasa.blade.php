<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Menagjimi i klasave') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1>User has role: {{ Auth::user()->getRoleNames()->first() }}</h1>
            <div class="bg-white gap-5 overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <div class="w-full">
                        <span class="text-black">Tabela e klasave</span>
 
                            @can('krijo_klas')
                                <div class="container mx-auto">
                                    <!-- Button to trigger modal -->
                                    <button 
                                        class="w-30 bg-green-700 text-white p-2 m-3 rounded-xl hover:bg-gray-700 transition duration-300 ease-in-out" 
                                        onclick="openModal()"
                                    >
                                        Shto klas
                                    </button>

                                    <button 
                                        class="w-30 bg-indigo-700 text-white p-2 m-3 rounded-xl hover:bg-gray-700 transition duration-300 ease-in-out" 
                                        onclick="downloadKlasat()"
                                    >
                                        Shkarko tabelen e klasave
                                    </button>
                        
                                    <!-- Modal Background -->
                                    <div id="classModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                        <!-- Modal Content -->
                                        <div class="bg-white p-6 rounded-lg w-1/2 shadow-lg">
                                            <h2 class="text-2xl font-bold mb-4">Create New Class</h2>
                        
                                            <!-- Form to create class -->
                                            <form action="{{ route('klasat.store') }}" method="POST">
                                                @csrf
                                                <div class="mb-4 flex flex-col w-80">
                                                    <label for="name">Emri i klases:</label>
                                                    <input class="rounded-xl" type="text" id="name" name="name" required>

                                                    <label for="teacher_id">Mesuesi:</label>
                                                    <select class="rounded-xl" id="teacher_id" name="teacher_id" required>
                                                        @foreach($teachers as $teacher)
                                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                                
                                                <div class="flex justify-end">
                                                    <button type="button" 
                                                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-300"
                                                        onclick="closeModal()"
                                                    >
                                                        Mos krijo
                                                    </button>
                                                    <button type="submit"
                                                        class="ml-3 bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-900 transition duration-300"
                                                    >
                                                        Krijo klasen
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endcan
            
                        
                        <script>
                            function openModal() {
                                document.getElementById('classModal').classList.remove('hidden');
                            }
                        
                            function closeModal() {
                                document.getElementById('classModal').classList.add('hidden');
                            }
                            function downloadKlasat(){
                                window.location.href = `/export-class/pdf`;
                            }
                        </script>
                    </div>
                    <table class="w-full  border-collapse border bg-cyan-50 rounded-xl border-gray-300">
                        <thead>
                            <tr>
                                <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">ID</th>
                                <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Emri i klases</th>
                                <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">ID e mesuesit</th>
                                <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Emri i mesuesit </th>
                                <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Numri i studentve</th>
                                <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Veprimet</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_klasat as $klasa)
                                <tr class="hover:bg-gray-100">
                                    <td class="border-b border-gray-300 px-4 py-2">{{$klasa->id}}</td>
                                    <td class="border-b border-gray-300 px-4 py-2">{{$klasa->name}}</td>
                                    <td class="border-b border-gray-300 px-4 py-2">{{$klasa->teacher_id}}</td>
                                    <td class="border-b border-gray-300 px-4 py-2">{{ $klasa->teacher ? $klasa->teacher->name : 'No teacher assigned' }}</td>
                                    <?php
                                        $nxens = $students->filter(function ($student) use ($klasa) {
                                            return $student->class_id == $klasa->id;
                                        });
                                        
                                        $NrStudent = $nxens->count();
                                    ?>
                                    <td class="border-b border-gray-300 px-4 py-2">{{$NrStudent}}</td>
                                    <td class="border-b border-gray-300 px-4 py-2 flex flex-row gap-5">
                                        @can('fshij')
                                            <form action="{{ route('klasat.destroy', $klasa->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this class?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 text-white w-20 p-2 rounded-xl my-5 hover:bg-gray-700 transition duration-300 ease-in-out">Fshij</button>
                                            </form>
                                        @endcan
                                        @can('modifikim')
                                            <form action="{{ route('klasat.edit' , $klasa->id)}}" method="PUT">
                                                @csrf
                                                @method('PUT')
                                                <button class="bg-yellow-600 text-white w-20 px-1 p-2 rounded-xl my-5 hover:bg-gray-700 transition duration-300 ease-in-out">Modifikim</button>
                                            </form>
                                        @endcan
                                        @can('lexim')
                                            <form action="{{ route('klasat.show' , $klasa->id)}}" method="GET">
                                                @csrf
                                                @method('GET')
                                                <button class="bg-green-600 text-white w-20 px-1 p-2 rounded-xl my-5 hover:bg-gray-700 transition duration-300 ease-in-out">Shiko</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

           </div>
        </div>
    </div rounded-xl>
</x-app-layout>
