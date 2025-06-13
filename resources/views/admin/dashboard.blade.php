@vite('resources\css\app.css')
@php
use App\Models\User;
use App\Models\Klasat;

$name = Auth::user()->name;
$role = Auth::user()->roles->first();
$first = $name[0];
$pfp = Auth::user()->get()->value('profile_photo_path');


$UsersCount = User::all()->count();
$teachersCount = User::role('Mesuesi')->count();
$studentsCount = User::role('Studenti')->count();
$classCount = Klasat::all()->count();

@endphp

<title>Admin Page</title>
<div class="flex h-screen bg-white">
    <!-- Sidebar -->
    <div class="w-64 bg-indigo-950 text-white p-5">
            <div class="flex flex-row justify-center items-center gap-5 mb-10">
                <div class=" w-24 h-24 overflow-hidden object-cover z-50">
                    <img class="w-full h-full" src="{{ $pfp ? $pfp : 'https://ui-avatars.com/api/?name=' . $first . '&color=7F9CF5&background=EBF4FF' }}" alt="">
                </div>
                <div>
                    <p class="font-bold text-xl">    
                        {{$name}}
                    </p>
                    <p class="font-bold text-xl">    
                        {{$role->name}}
                    </p>
                </div>
            </div>
   
        <ul class="space-y-4">
            <li><a href="#" class="text-lg text-white hover:bg-cyan-200 hover:text-black p-2  transition">Dashboard</a></li>
            <li><a href="#" class="text-lg text-white hover:bg-cyan-200 hover:text-black p-2  transition">Users</a></li>
            <li><a href="#" class="text-lg text-white hover:bg-cyan-200 hover:text-black p-2  transition">Settings</a></li>
            <li><a href="#" class="text-lg text-white hover:bg-cyan-200 hover:text-black p-2  transition">Reports</a></li>
            <form method="POST" action="{{ route('logout') }}" >
                @csrf
                @method('POST')
                <a href="{{ route('logout') }}" @click.prevent="$root.submit();" class="text-lg text-white hover:bg-cyan-200 hover:text-black p-2  transition">    
                    {{ __('Log Out') }}
                </a>
            </form>    
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-semibold text-black">Admin Dashboard</h2>
        </div>

        <!-- Stats Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-slate-200 shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-bold text-black">Totali i perdoruesve</h3>
                <p class="text-3xl font-semibold text-indigo-950">{{$UsersCount}}</p>
            </div>
            <div class="bg-slate-200 shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-bold text-black">Totali i mesuesve</h3>
                <p class="text-3xl font-semibold text-indigo-950">{{$teachersCount}}</p>
            </div>
            <div class="bg-slate-200     shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-bold text-black">Totaili i studentve</h3>
                <p class="text-3xl font-semibold text-indigo-950">{{$studentsCount}}</p>
            </div>
            <div class="bg-slate-200     shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-bold text-black">Totaili i klaseve</h3>
                <p class="text-3xl font-semibold text-indigo-950">{{$classCount}}</p>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-slate-100 shadow-lg rounded-lg mt-8 p-6">
            <h3 class="text-2xl font-bold text-black mb-4">Recent Activity</h3>
            <table class="w-full table-auto">
                <thead class="bg-indigo-950 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left">User</th>
                        <th class="py-2 px-4 text-left">Activity</th>
                        <th class="py-2 px-4 text-left">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4">John Doe</td>
                        <td class="py-2 px-4">Updated Profile</td>
                        <td class="py-2 px-4">Feb 04, 2025</td>
                    </tr>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4">Jane Smith</td>
                        <td class="py-2 px-4">Created Order</td>
                        <td class="py-2 px-4">Feb 03, 2025</td>
                    </tr>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4">Mark Lee</td>
                        <td class="py-2 px-4">Logged In</td>
                        <td class="py-2 px-4">Feb 02, 2025</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
