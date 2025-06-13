<x-app-layout>
@php
    foreach($posts as $post){
        $photo = $post->user->profile_photo_path;
    };

    $name = Auth::user()->get()->value('name');
    $first = $name[0];
    $pfp = Auth::user()->get()->value('profile_photo_path');
@endphp

    <div class="w-full flex flex-row items-center justify-center h-auto p-5 bg-cover bg-center bg-gray-100">
        <div class="w-3/4 flex flex-col items-center justify-center h-auto p-5 ">

                @can('shkrim')
                <div class="w-1/2 bg-white p-6 rounded-lg shadow-lg mb-6">
                    <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col space-y-4">
                        @csrf
                        <div class="flex flex-col items-center gap-3 space-x-3">
                            
                            <div id="imagePreviewContainer" class="hidden mt-3">
                                <img id="imagePreview" src="" alt="Image Preview" class="w-full h-auto rounded-lg shadow-lg" />
                            </div>
                            <div class="w-full gap-3 flex items-center">
                                <img src="{{ $pfp ? $pfp : 'https://ui-avatars.com/api/?name=' . $first . '&color=7F9CF5&background=EBF4FF' }}" alt="Profile" class="w-10 h-10 object-cover rounded-full">
                                <input type="text" name="text" placeholder="Shkruaj lajmrimin..." class="w-full p-3 rounded-full border border-gray-300 focus:border-blue-500" required>
                                
                                <label for="photoInput" class="flex items-center px-4 py-2 text-white bg-slate-700 rounded-full cursor-pointer hover:bg-blue-200 transition duration-150 ease-in-out">
                                    <svg class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                                    </svg>
                                    <span>Foto</span>
                                </label>
                                <input type="file" name="photo" class="hidden" id="photoInput" accept="image/*" onchange="previewImage(event)">
                                
                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-slate-800 transition duration-150 ease-in-out">
                                    Posto
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @endcan
                        
                <!-- Post Feed -->

                <div class="w-1/2 space-y-6">
                    @if($posts->isEmpty())
                        <div class="bg-white rounded-lg shadow-lg p-6 relative">
                            <span class="text-xl font-bold">
                                Nuk ka ndonje postim ende :(
                            </span>
                        </div>
                    @else
                        @foreach ($posts as $post)
                            <div class="bg-white rounded-lg shadow-lg p-6 relative">
                                <!-- Post Header -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-5">
                                        <img src="{{ asset('storage/'.$post->user->profile_photo_path) ?? 'https://via.placeholder.com/40' }}" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                                        <div>
                                            <p class="font-bold text-gray-800">{{ $post->user_name }}</p>
                                            <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                
                                    <!-- Edit/Delete options for the post -->
                                    @if (Auth::id() == $post->user_id)
                                        <div class="relative">
                                            <button onclick="toggleOptions(event, {{ $post->id }})" class="text-gray-600 hover:text-gray-900">
                                                ...
                                            </button>
                                            <div id="options-{{ $post->id }}" class="hidden absolute right-0 mt-2 w-24 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                                                <!-- Edit Button -->
                                                <button type="button" onclick="openEditModal({{$post->id}})" class="w-full text-left px-4 py-2 text-sm text-yellow-600 hover:bg-yellow-200">Modifiko</button>

                                                <!-- Delete Form -->
                                                <form action="{{ route('media.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100">Fshij</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            
                                <!-- Post Image (if exists) -->
                                @if ($post->photo)
                                    <div class="mt-3">
                                        <img src="{{ asset('storage/' . $post->photo) }}" class="w-full h-auto rounded-lg object-cover">
                                    </div>
                                @endif
                                
                                <!-- Post Text -->
                                <p class="text-gray-700 my-5 text-lg mb-4">{{ $post->text }}</p>
                            </div>
                        @endforeach
                    @endif
            </div>
        </div>


        <script>
            function previewImage(event) {
                const input = event.target;
                const previewContainer = document.getElementById('imagePreviewContainer');
                const imagePreview = document.getElementById('imagePreview');

                // Check if any file is selected
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result; // Set the image source to the file's data
                        previewContainer.classList.remove('hidden'); // Show the preview container
                    };
                    reader.readAsDataURL(input.files[0]); // Read the file as a data URL
                }
            }

            function toggleOptions(event, postId) {
                event.stopPropagation(); // Prevent click from closing the menu
                const optionsMenu = document.getElementById(`options-${postId}`);
                optionsMenu.classList.toggle('hidden');
            
                // Close any other open menus
                document.querySelectorAll('[id^="options-"]').forEach(menu => {
                    if (menu.id !== `options-${postId}`) {
                        menu.classList.add('hidden');
                    }
                });
            }
        
            // Hide options menus when clicking outside
            document.addEventListener('click', function(event) {
                document.querySelectorAll('[id^="options-"]').forEach(menu => {
                    if (!menu.contains(event.target)) {
                        menu.classList.add('hidden');
                    }
                });
            });
            
            function openEditModal(postId) {
                // Fetch post data for editing
                fetch(`/media/${postId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('editText').value = data.post.text;
                        document.getElementById('editForm').action = `/media/${postId}`;
                        document.getElementById('editModal').classList.remove('hidden');
                    })
                    .catch(error => console.error('Error loading post data:', error));
            }
            
            function closeEditModal() {
                document.getElementById('editModal').classList.add('hidden');
            }
        </script>
    </div>
</x-app-layout>
