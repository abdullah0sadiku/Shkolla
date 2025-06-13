<x-app-layout>
    <div class="w-80 mx-auto sm:px-6 lg:px-8 mt-5 flex justify-center bg-white gap-5 overflow-hidden shadow-xl sm:rounded-lg p-5">
        <form action="{{ route('klasat.update', $klasa->id) }}" method="POST">
            @csrf
            @method('PUT')
            <span>Modifikimi i dhenave te klases se {{$klasa -> name}}it</span>
            <div>
                <label for="name">Emri</label>
                <input class="rounded-xl m-2" type="text" name="name" value="{{ $klasa->name }}" required>
            </div>
            <div>
                <label for="teacher_id">Mesuesi:</label>
                <select id="teacher_id" name="teacher_id" required>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-green-600 text-white w-30 p-2 rounded-xl my-5 hover:bg-gray-700 transition duration-300 ease-in-out">
                Confirmo modifikimin
            </button>
        </form>
    </div>
</x-app-layout>


