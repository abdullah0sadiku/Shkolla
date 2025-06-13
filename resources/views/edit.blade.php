<x-app-layout>

    <div class="w-80 mx-auto sm:px-6 lg:px-8 mt-5 justify-center bg-white gap-5 overflow-hidden shadow-xl sm:rounded-lg p-5">
        <form action="{{ route('mng-users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <span>Modifikimi i dhenave te perdoruesit</span>
            <div>
                <label for="name">Emri</label>
                <input class="rounded-xl m-2" type="text" name="name" value="{{ $user->name }}" required>
    
                <label for="email">Emaili</label>
                <input class="rounded-xl m-2" type="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div>
                <label for="role">Role:</label>
                <select id="role"  name="role" class="w-full p-2 mb-3 border border-gray-300 rounded-md" required onchange="nese()">
                    <option value="">Select Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ $role->name == $user->getRoleNames()->first() ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                
                    <?php               
                        foreach($roles as $role){
                            $role_name = $role->name == $user->getRoleNames()->first();
                        };
                    ?>
                    
                @if($role_name == "Studenti")
                    <div  id="Klasa">
                        <label for="class_id">Klasa:</label>
                        <select id="class_id"  name="class_id" class="w-full p-2 mb-3 border border-gray-300 rounded-md">
                            <option value="">Select Class</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}" class="{{ $user->class_id == $class->id ? 'selected' : '' }}">
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                
                <button type="submit" class="bg-green-600 text-white w-30 p-2 rounded-xl my-5 hover:bg-gray-700 transition duration-300 ease-in-out">
                    Confirmo modifikimin
                </button>
                <a href="/mng-users" class="bg-red-600 text-white w-30 p-2 rounded-xl my-5 hover:bg-gray-700 transition duration-300 ease-in-out">
                    Ktheu
                </a>

            </div>
            

           
        </form>
    </div>
</x-layout>

