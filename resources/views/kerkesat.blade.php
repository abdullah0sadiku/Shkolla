<x-app-layout>
    <div class="flex flex-col justify-center items-center">
        <!-- Table Container -->
        <div class="w-3/4 bg-gray-200 p-3 mt-5 rounded-xl">
            <!-- Header with Actions -->
            <div class="flex flex-row justify-between">
                <span class="font-bold text-2xl">
                    Kerkesat per regjistrim
                </span>
                <div>
                    <form id="bulkForm" method="POST">
                        @csrf
                        <!-- Hidden input to hold selected IDs -->
                        <input type="hidden" name="selected_ids" id="selectedIds" value="" />

                        <button type="button" onclick="toggleSelect()" id="selectButton" class="bg-slate-500 rounded-md p-1 text-white">
                            Selekto
                        </button>

                        <button type="submit" formaction="{{ route('kerkesat.bulkConfirm') }}" class="bg-green-600 rounded-md p-1 text-white disabled:opacity-50" id="confirmSelected" disabled>
                            Confirmo
                        </button>

                        <button type="submit" formaction="{{ route('kerkesat.bulkDelete') }}" class="bg-red-600 rounded-md p-1 text-white disabled:opacity-50" id="deleteSelected" disabled>
                            Fshij
                        </button>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <table class="w-full mt-3 bg-white border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">
                            <input type="checkbox" id="selectAll" class="hidden" />
                        </th>
                        <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">ID</th>
                        <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Emri</th>
                        <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Emaili</th>
                        <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Nr telefoni</th>
                        <th class="border-b border-gray-300 px-4 py-2 text-left text-gray-700 font-semibold">Statusi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kerkesat as $kerkesa)
                    <tr class="{{ $kerkesa->status == 'done' ? 'bg-green-300' : 'bg-red-400' }}">
                        <td class="border-b border-gray-300 px-4 py-2">
                            <input type="checkbox" value="{{ $kerkesa->id }}" class="rowCheckbox hidden" data-status="{{ $kerkesa->status }}" />
                        </td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $kerkesa->id }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $kerkesa->name }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $kerkesa->email }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $kerkesa->phone }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $kerkesa->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function toggleSelect() {
            const checkboxes = document.querySelectorAll('.rowCheckbox');
            const selectAll = document.getElementById('selectAll');
            const selectButton = document.getElementById('selectButton');

            checkboxes.forEach(checkbox => checkbox.classList.toggle('hidden'));
            selectAll.classList.toggle('hidden');

            // Reset selection and buttons
            checkboxes.forEach(checkbox => (checkbox.checked = false));
            document.getElementById('confirmSelected').disabled = true;
            document.getElementById('deleteSelected').disabled = true;

            selectButton.textContent = checkboxes[0].classList.contains('hidden') ? 'Selekto' : 'Cancel';
        }

        document.addEventListener('change', () => {
            const selectedRows = Array.from(document.querySelectorAll('.rowCheckbox:checked'));
            const confirmButton = document.getElementById('confirmSelected');
            const deleteButton = document.getElementById('deleteSelected');
            const selectedIdsInput = document.getElementById('selectedIds');

            // Update hidden input with selected IDs
            const selectedIds = selectedRows.map(row => row.value);
            selectedIdsInput.value = selectedIds.join(',');

            // Enable buttons based on selection
            const hasPending = selectedRows.some(row => row.dataset.status === 'pendding');
            confirmButton.disabled = !hasPending;
            deleteButton.disabled = selectedIds.length === 0;
        });
    </script>
</x-app-layout>
