<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Menagjimi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white gap-5 overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex justify-between">
                    <span class="text-black text-xl font-bold my-5">Tabela e perdoruesve</span>

                    @can(['shto_mesues', 'shto_student'])
                        <!-- Trigger the modal with your button -->
                        <div>
                            <button onclick="openModal()" class="bg-green-600 text-white w-40 p-2 rounded-xl my-5 hover:bg-gray-700 transition duration-300 ease-in-out">
                                Shto përdorues
                            </button>
                            
                            <button onclick="DownloadModal()" class="bg-indigo-600 text-white w-40 p-2 rounded-xl my-5 hover:bg-gray-700 transition duration-300 ease-in-out">
                                Shkarko 
                            </button>
                        </div>

                        <!-- The Modal -->
                        <div id="userModal" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center">
                            <div class="bg-white w-1/3 p-5 rounded-lg shadow-lg">
                                <div class="flex justify-end">
                                    <button onclick="closeModal()" class="text-gray-500 text-xl">&times;</button>
                                </div>
                                <h3 class="text-lg font-semibold mb-5">Shto Përdorues</h3>

                                <form action="{{ route('mng-users.store') }}" method="POST">
                                    @csrf
                                    <label for="name">Name:</label>
                                    <input type="text" id="name" name="name" class="w-full p-2 mb-3 border border-gray-300 rounded-md" required>

                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email" class="w-full p-2 mb-3 border border-gray-300 rounded-md" required>

                                    <label for="password">Password:</label>
                                    <input type="password" id="password" name="password" class="w-full p-2 mb-3 border border-gray-300 rounded-md" required>

                                    <label for="password_confirmation">Confirm Password:</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-2 mb-3 border border-gray-300 rounded-md" required>

                                    <label for="role">Role:</label>
                                    <select id="role" name="role" class="w-full p-2 mb-3 border border-gray-300 rounded-md" required>
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>

                                    <button type="submit" class="bg-green-600 text-white w-40 p-2 rounded-xl my-5 hover:bg-gray-700 transition duration-300 ease-in-out">
                                        Shto përdorues
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div id="downloadModal" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center">
                            <div class="bg-white w-1/3 p-5 rounded-lg shadow-lg">
                                <div class="flex justify-end">
                                    <button onclick="CloseDownloadModal()" class="text-gray-500 text-2xl font-bold">&times;</button>
                                </div>
                                <h3 class="text-lg font-semibold mb-5">Shkarko tabelen e perdoruesve</h3>
                        
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <label class="text-gray-700 font-medium">Excel</label>
                                        <button onclick="downloadExcel()" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded">Shkarko</button>
                                    </div>
                        
                                    <div class="flex items-center justify-between">
                                        <label class="text-gray-700 font-medium">PDF</label>
                                    
                                        <select id="tableSelect" class="w-2/5 border p-2 rounded">
                                            <option value="">Selekto tabelen</option>
                                            <option value="perdoruesve">Perdoruesit</option>
                                            <option value="mesuesit">Mesuesit</option>
                                            <option value="studentet">Studentet</option>
                                        </select>
                                    
                                        <button onclick="downloadPDF()" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">
                                            Shkarko
                                        </button>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        

                        <!-- Modal open/close functionality -->
                        <script>
                            function openModal() {
                                document.getElementById('userModal').classList.remove('hidden');
                            }
                        
                            function closeModal() {
                                document.getElementById('userModal').classList.add('hidden');
                            }

                            function DownloadModal() {
                                document.getElementById('downloadModal').classList.remove('hidden');
                            }
                        
                            function CloseDownloadModal() {
                                document.getElementById('downloadModal').classList.add('hidden');
                            }
                            function downloadExcel() {
                                window.location.href = "{{ route('export.excel') }}";
                            }
                            
                            function downloadPDF() {
                                const table = document.getElementById('tableSelect').value;
                                if (!table) {
                                    alert("Please select a table to download.");
                                    return;
                                }
                        
                                window.location.href = `/export/pdf?table=${table}`;
                            }
                        </script>
                    @endcan
                </div>
                
                <div class="bg-red-500 text-white p-5">
                        Na ka mbet me rregullu shkarkimin ne excel 
                </div>
                <!-- Users Table -->
                <table class="w-full bg-white border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">ID</th>
                            <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Emri</th>
                            <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Emaili</th>
                            <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Roli</th>
                            <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Veprimet</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $user)
                            <tr class="{{ Auth::user()->id == $user->id ? 'bg-green-100 hover:bg-gray-100' : '' }}">
                                <td class="border-b border-gray-300 px-4 py-2">{{$user->id}}</td>
                                <td class="border-b border-gray-300 px-4 py-2">{{$user->name}}</td>
                                <td class="border-b border-gray-300 px-4 py-2">{{$user->email}}</td>
                                <td class="border-b border-gray-300 px-4 py-2">{{ $user->getRoleNames()->first() }}</td>
                                <td class="border-b border-gray-300 px-4 py-2">
                                    @can('fshij')
                                        <form action="{{ route('mng-users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('A je i sigurt se deshiron te hiqesh ket perdorues?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white w-20 p-2 rounded-xl my-1 hover:bg-gray-700 transition duration-300 ease-in-out">
                                                Fshij
                                            </button>
                                        </form>
                                    @endcan
                                    
                                    @can('modifikim')
                                        <form action="{{ route('mng-users.edit', $user->id) }}" method="GET">
                                            @csrf
                                            @method('GET')
                                            <button type="submit" class="bg-yellow-600 text-white w-20 p-2 rounded-xl my-1 hover:bg-gray-700 transition duration-300 ease-in-out">
                                                Modifiko
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>

</x-app-layout>
