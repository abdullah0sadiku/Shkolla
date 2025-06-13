@php
        $teacher_id = $users->where('id', $klasa->teacher_id )->first();
        $teacher_name = $teacher_id ? $teacher_id->name: null;
        $studentCount = $users->where('class_id', $klasa->id)->count();
@endphp
@vite('resources\css\app.css')
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto flex flex-row sm:px-6 lg:px-8">
            <div class="w-1/4 flex flex-col gap-5 sticky">
                    <div class="w-full bg-slate-300 rounded flex-row justify-between">
                        <p class="font-bold text-2xl p-3">
                            {{$klasa->name}}
                        </p>
                    </div>
                    <div class="w-full bg-slate-300 rounded flex-row justify-between">
                        <p class="font-bold text-xl p-3">
                            Veglat
                        </p>
                        <hr class="ml-2 mr-2">
                        <ul class="p-2">
                            <li>
                                <button class="bg-white w-full text-black font-semibold py-2 px-4 mb-2 border border-gray-300 rounded shadow-md hover:bg-gray-100 focus:outline-none">
                                    Menagjo studentet
                                </button>
                            </li>
                            <li>
                                <button class="bg-white w-full text-black font-semibold py-2 px-4 mb-2 border border-gray-300 rounded shadow-md hover:bg-gray-100 focus:outline-none">
                                    Menagjo vijushmerin
                                </button>
                            </li>
                            <li>
                                <button class="bg-white w-full text-black font-semibold py-2 px-4 mb-2 border border-gray-300 rounded shadow-md hover:bg-gray-100 focus:outline-none">
                                    Menagjo notat
                                </button>
                            </li>
                            <li>
                                <button class="bg-white w-full text-black font-semibold py-2 px-4 mb-2 border border-gray-300 rounded shadow-md hover:bg-gray-100 focus:outline-none">
                                    Statistikat e klases
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="w-full bg-slate-300 rounded flex-row justify-between">
                        <p class="font-bold text-xl p-3">
                            Takimi
                        </p>
                        @if($sesioni == 1)
                                <form action="{{ route('join-meeting', ['classId' => $klasa->id, 'meetingId' => $meeting->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-600 p-3 mt-3 w-full text-center">Kyçu në takim</button>
                                </form>
                        @else
                            <div class="bg-red-500  text-white p-3 mt-3 w-full text-center">
                                Nuk ka ndonje takim aktiv.
                            </div>
                        @endif
                    </div>
            </div>
            <div class="w-3/4 flex ml-3 flex-col gap-5">
                <div class="w-full bg-slate-300 p-3 rounded flex-row justify-between">
                    <div class="w-full flex flex-row items-center justify-between">
                        <p class="font-semibold py-2 px-4 mb-2 ">
                            Tabela e studenteve
                        </p>
                        <div>
                            <div class="relative inline-block text-left">
                                <button id="dropdownButton" class="bg-white text-black font-semibold py-2 px-4 mb-2 border border-gray-300 rounded shadow-md hover:bg-gray-100 focus:outline-none">
                                    Veprimet
                                </button>
                            
                                <!-- Dropdown Menu -->
                                <div id="dropdownMenu" class="hidden absolute left-0 mt-2 w-40 bg-white border border-gray-300 rounded shadow-md">
                                    <a href="#" class="block px-4 py-2 text-black hover:bg-gray-200">Shto student</a>
                                    <a href="#" class="block px-4 py-2 text-black hover:bg-gray-200">Fshij student</a>
                                    <a href="#" class="block px-4 py-2 text-black hover:bg-gray-200">Shkarko tabelen e studenteve</a>
                                </div>
                            </div>                        
                        </div>
                    </div>

                    <table class="w-full border shadow-lg border-black rounded-xl">
                        <thead>
                            <tr class="bg-slate-300 border border-black">
                                <th class="border border-black px-4 py-2 text-left text-black font-semibold">ID</th>
                                <th class="border border-black px-4 py-2 text-left text-black font-semibold">Emri</th>
                                <th class="border border-black px-4 py-2 text-left text-black font-semibold">Emaili</th>
                                <th class="border border-black px-4 py-2 text-left text-black font-semibold">Telefoni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $hasStudents = false; @endphp
                            @foreach($users as $class_student)
                                @if($class_student->class_id == $klasa->id)
                                    @php $hasStudents = true; @endphp
                                    <tr class="bg-slate-100 hover:bg-gray-300 border border-black">
                                        <td class="border border-black text-black px-4 py-2">{{$class_student->id}}</td>
                                        <td class="border border-black text-black px-4 py-2">{{$class_student->name}}</td>
                                        <td class="border border-black text-black px-4 py-2">{{$class_student->email}}</td>
                                        <td class="border border-black text-black px-4 py-2">
                                            @if($class_student->phone == null)
                                                Nuk ka numer te telefonit!
                                            @else
                                                {{$class_student->phone}}
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                    
                            @if(!$hasStudents)
                                <tr>
                                    <td colspan="4" class="text-center bg-red-500 text-white p-2 font-mono border border-black">
                                        Nuk keni student !!
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>   
                </div>
                <div class="w-full bg-slate-300 p-3 rounded flex-row justify-between">
                    <div class="w-full flex flex-row items-center justify-between">
                        <p class="font-semibold py-2 px-4 mb-2 ">
                            Tabela e vijushmeris
                        </p>
                    </div>
                </div>
                <div class="w-full bg-slate-300 p-3 rounded flex-row justify-between">
                    <div class="w-full flex flex-col items-center justify-between">
                        <div class="w-full flex flex-row items-center justify-between">
                            <p class="font-semibold py-2 px-4 mb-2 ">
                                Tabela e notave
                            </p>

                            <div>
                                <button id="InstalldropdownButton" class="bg-white text-black font-semibold py-2 px-4 mb-2 border border-gray-300 rounded shadow-md hover:bg-gray-100 focus:outline-none">
                                    Shkarko
                                </button>
                                <div id="InstalldropdownMenu" class="hidden absolute  mt-2 w-40 bg-white border border-gray-300 rounded shadow-md">
                                    <button id="InstalldropdownButton"  class="block px-4 py-2 text-black hover:bg-gray-200 w-full">
                                        raportin e notave javore
                                    </button>
                                    <button id="InstalldropdownButton"  class="block px-4 py-2 text-black hover:bg-gray-200 w-full">
                                        raportin e notave mujore
                                    </button>
                                    <button id="InstalldropdownButton"  class="block px-4 py-2 text-black hover:bg-gray-200 w-full">
                                        raportin e notave vjetore
                                    </button>                
                                </div>
                                
                                <button id="GradedropdownButton" class="bg-white text-black font-semibold py-2 px-4 mb-2 border border-gray-300 rounded shadow-md hover:bg-gray-100 focus:outline-none">
                                    Veprimet
                                </button>

                                <button  class="bg-white text-black font-semibold py-2 px-4 mb-2 border border-gray-300 rounded shadow-md hover:bg-gray-100 focus:outline-none">
                                    Filtro sipas nxensit
                                </button>
                                <!-- Dropdown Menu -->
                                <div id="GradedropdownMenu" class="hidden absolute  mt-2 w-40 bg-white border border-gray-300 rounded shadow-md">
                                    <button onclick="showModal('AddGrade')" class="block px-4 py-2 text-black hover:bg-gray-200 w-full">
                                        Shto notë
                                    </button>
                                </div>
                                <button  class="bg-white text-black font-semibold py-2 px-4 mb-2 border border-gray-300 rounded shadow-md hover:bg-gray-100 focus:outline-none">
                                    Filtro sipas dates
                                </button>
                            </div>
                        </div>

                        <table class="w-full border shadow-lg border-black rounded-xl">
                            <thead>
                                <tr class="bg-slate-300 border border-black">
                                    <th class="border border-black px-4 py-2 text-left text-black font-semibold">ID</th>
                                    <th class="border border-black px-4 py-2 text-left text-black font-semibold">Emri</th>
                                    <th class="border border-black px-4 py-2 text-left text-black font-semibold">Msimi i ri</th>
                                    <th class="border border-black px-4 py-2 text-left text-black font-semibold">Perseritja</th>
                                    <th class="border border-black px-4 py-2 text-left text-black font-semibold">Texhvidi</th>
                                    <th class="border border-black px-4 py-2 text-left text-black font-semibold">Nota</th>
                                    <th class="border border-black px-4 py-2 text-left text-black font-semibold">Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notat as $student_grade)                                    
                                    <tr class="bg-slate-100 border border-black">    
                                        <td class="border border-black text-black px-4 py-2">{{$student_grade->id}}</td>
                                        <td class="border border-black text-black px-4 py-2">{{$student_grade->student->name ?? 'N/A'}}</td>
                                        <td class="border border-black text-black px-4 py-2">{{$student_grade->new_memorization ?? 'N/A'}}</td>
                                        <td class="border border-black text-black px-4 py-2">{{$student_grade->revision}}</td>
                                        <td class="border border-black text-black px-4 py-2">{{$student_grade->tajweed}}</td>
                                        <td class="border border-black text-black px-4 py-2">{{$student_grade->total}}</td>
                                        <td class="border border-black text-black px-4 py-2">
                                            {{ $student_grade->created_at->format('Y-m-d') }}
                                        </td>                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div id="AddGrade" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="m-5 p-6 w-2/4 bg-white rounded-lg shadow-lg relative border-2 border-black">
            <!-- Close Button -->
            <button onclick="closeModal('AddGrade')" class="absolute top-2 right-2 text-black text-2xl font-bold">
                &times;
            </button>

            <p class="font-bold text-2xl text-black text-center mb-4">Notimi Ditor</p>
            <form action="{{ route('grades.store') }}" method="POST">
                @csrf

                <!-- Select Student -->
                <label for="user_id" class="block font-bold text-black mt-3">Zgjidh Studentin:</label>
                <select name="user_id" class="w-full p-2 border-b-2 border-black text-black bg-white focus:border-b-4 focus:outline-none" required>
                    <option value="">Zgjidh një student...</option>
                    @foreach($users as $class_student)
                        @if($class_student->class_id == $klasa->id)
                            <option value="{{ $class_student->id }}">{{ $class_student->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('user_id') <p class="text-red-500">{{ $message }}</p> @enderror

                <!-- Hidden Class ID -->
                <input type="hidden" name="class_id" value="{{ $klasa->id }}">
                @error('class_id') <p class="text-red-500">{{ $message }}</p> @enderror

                <!-- Date -->
                <label for="date" class="block font-bold text-black mt-3">Data:</label>
                <input type="date" name="date" class="w-full p-2 border-b-2 border-black text-black bg-white focus:border-b-4 focus:outline-none" required>
                @error('date') <p class="text-red-500">{{ $message }}</p> @enderror

                <!-- New Memorization -->
                <label for="new_memorization" class="block font-bold text-black mt-3">Memorizimi i Ri (0-30):</label>
                <input type="number" name="new_memorization" min="0" max="30" class="w-full p-2 border-b-2 border-black text-black bg-white focus:border-b-4 focus:outline-none" required>
                @error('new_memorization') <p class="text-red-500">{{ $message }}</p> @enderror

                <!-- Revision -->
                <label for="revision" class="block font-bold text-black mt-3">Ripërsëritja (0-40):</label>
                <input type="number" name="revision" min="0" max="40" class="w-full p-2 border-b-2 border-black text-black bg-white focus:border-b-4 focus:outline-none" required>
                @error('revision') <p class="text-red-500">{{ $message }}</p> @enderror

                <!-- Tajweed -->
                <label for="tajweed" class="block font-bold text-black mt-3">Tajweed (0-30):</label>
                <input type="number" name="tajweed" min="0" max="30" class="w-full p-2 border-b-2 border-black text-black bg-white focus:border-b-4 focus:outline-none" required>
                @error('tajweed') <p class="text-red-500">{{ $message }}</p> @enderror

                <!-- Submit Button -->
                <button type="submit" class="w-full mt-5 bg-black text-white p-3 rounded-lg font-bold hover:bg-gray-900 transition-all">
                    Regjistro Notën Ditore
                </button>
            </form>
        </div>
    </div>

    <div id="addStudentModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex items-center justify-center">
        
        <div class="bg-white rounded-lg p-5 w-4/6">
            <div class="flex flex-row justify-between">
                <h3 class="text-2xl font-bold mb-4">Shto Student</h3>
            
                <!-- Search Input -->
                <input 
                    type="text" 
                    id="addStudentSearchInput" 
                    placeholder="Kerko student me emer/email/numer telefoni" 
                    class="w-2/5 p-2 mb-3 border border-gray-300 rounded"
                    oninput="filterStudents('addStudentSearchInput', 'addStudentTableBody')"
                />
            </div>
            
            <table class="w-full mt-3 bg-white border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">ID</th>
                        <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Emri</th>
                        <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Emaili</th>
                        <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Telefoni</th>
                        <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Veprimet</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    @foreach($users as $student)
                        @if($student->class_id == null)
                            <tr class="student-row hover:bg-gray-100">
                                <td class="border-b border-gray-300 px-4 py-2">{{$student->id}}</td>
                                <td class="border-b border-gray-300 px-4 py-2">{{$student->name}}</td>
                                <td class="border-b border-gray-300 px-4 py-2">{{$student->email}}</td>
                                <td class="border-b border-gray-300 px-4 py-2">
                                    @if($student->phone) 
                                            {{$student->phone}} 
                                    @else 
                                        Nuk ka numer !! 
                                    @endif
                                </td>
                                <td class="border-b border-gray-300 px-4 py-2">
                                    @can('modifikim')
                                    <form action="{{ route('klasa.shto', $klasa->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                        <input type="hidden" name="class_id" value="{{ $klasa->id }}">
                                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Shto</button>
                                    </form>                                  
                                    @endcan
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            
            
            
            <button type="button" onclick="closeModal('addStudentModal')" class="ml-2 mt-5 bg-red-600 text-white px-4 py-2 rounded">Mbyll</button>
        </div>
    </div>

    <!-- Delete Student Modal -->
    <div id="deleteStudentModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg p-5 w-4/6">
            <div class="flex flex-row justify-between">
                <h3 class="text-2xl font-bold mb-4">Fshij student</h3>
                <input 
                    type="text" 
                    id="deleteStudentSearchInput" 
                    placeholder="Kerko student me emer/email/numer telefoni" 
                    class="w-2/5 p-2 mb-3 border border-gray-300 rounded"
                    oninput="filterStudents('deleteStudentSearchInput', 'deleteStudentTableBody')"
                />
            </div>
            <table  class="w-full mt-3 bg-white border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">ID</th>
                        <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Emri</th>
                        <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Emaili</th>
                        <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Telefoni</th>
                        <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Veprimet</th>
                    </tr>
                </thead>
                <tbody id="deleteStudentTableBody">
                    @foreach($users as $student)
                        @if($student->class_id == $klasa->id)
                        <tr class="student-row hover:bg-gray-100">
                            <td class="border-b border-gray-300 px-4 py-2">{{$student->id}}</td>
                            <td class="border-b border-gray-300 px-4 py-2">{{$student->name}}</td>
                            <td class="border-b border-gray-300 px-4 py-2">{{$student->email}}</td>
                            <td class="border-b border-gray-300 px-4 py-2">{{$student->phone}}</td>
                            <td class="border-b border-gray-300 px-4 py-2">


                                @can('modifikim')
                                <form action="{{ route('klasa.fshij', $student->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Fshij</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table> 
            <button type="button" onclick="closeModal('deleteStudentModal')" class="ml-2 mt-5 bg-red-600 text-white px-4 py-2 rounded">Mbyll</button>
        </div>
</x-app-layout>

<script>
    document.getElementById('dropdownButton').addEventListener('click', function () {
        document.getElementById('dropdownMenu').classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('dropdownMenu');
        const button = document.getElementById('dropdownButton');
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });

    document.getElementById('GradedropdownButton').addEventListener('click', function () {
        document.getElementById('GradedropdownMenu').classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('GradedropdownMenu');
        const button = document.getElementById('GradedropdownButton');
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });

    document.getElementById('InstalldropdownButton').addEventListener('click', function () {
        document.getElementById('InstalldropdownMenu').classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('InstalldropdownMenu');
        const button = document.getElementById('InstalldropdownButton');
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });

    function showModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }
    
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

</script>    