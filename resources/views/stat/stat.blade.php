@php
$name = Auth::user()->name;
$role = Auth::user()->roles->first();
$first = $name[0];
$pfp = Auth::user()->get()->value('profile_photo_path');
@endphp
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full flex flex-row gap-5">
                <div class="w-80 h-58 bg-slate-300 gap-5 my-5 flex flex-row overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <div class="w-24 h-24  overflow-hidden object-cover z-50">
                        <img class="w-full h-full" src="{{ $pfp ? $pfp : 'https://ui-avatars.com/api/?name=' . $first . '&color=7F9CF5&background=EBF4FF' }}" alt="">
                    </div>
                    <div>
                        <p class="text-sm">Jeni te kyqyr si</p>
                        <p class="font-bold text-2xl">    
                            {{$name}}
                        </p>
                        <p class="text-sm">Me rol</p>
                        <p class="font-bold text-xl">    
                            {{$role->name}}
                        </p>
                        
                    </div>
                </div>
                <div class="w-3/4 h-58 bg-slate-300 gap-5 my-5 overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <p class="font-bold text-2xl">
                        Statistikat
                    </p>
                    <p class="text-xl">
                        Ne kete faqe mund te i shikoni statistikat per shkollen ne tersi me forma te ndryshme.
                    </p>
                </div>
            </div>
            <div class="flex flex-row gap-5">
                <div class=" w-2/4 bg-slate-300 gap-5 my-5 overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <p class="font-bold text-xl">Kerkesat</p>
                    <h2>Totali i kerkesave: {{ $k_count }}</h2>
                    
                    <div id="requestsByDateChart"></div>
                    <div id="statusChart"></div>
                    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var dates = @json($dates);
                            var requestCounts = @json($requestCounts);
                            
                            // Chart 1: Requests Over Time
                            var options1 = {
                                chart: { type: 'line' },
                                series: [{ name: 'Kerkesat', data: requestCounts }],
                                xaxis: { categories: dates }
                            };
                            
                            var chart1 = new ApexCharts(document.querySelector("#requestsByDateChart"), options1);
                            chart1.render();
                        });
                    </script>
                </div>
                <div class=" w-2/4 bg-slate-300 gap-5 my-5 overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <p class="font-bold text-xl">Studentet</p>
                    <h2>Totali i studentve: {{ $totalStudents }}</h2>
                    <div id="studentByDateChart"></div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var dates = @json($s_dates);
                            var studentCounts = @json($studentCounts);
                            
                            var options = {
                                chart: { type: 'bar' },
                                series: [{ name: 'Student', data: studentCounts }],
                                xaxis: { categories: dates }
                            };
                            
                            var chart = new ApexCharts(document.querySelector("#studentByDateChart"), options);
                            chart.render();
                        });
                        </script>
            </div>
        </div>
            <div class=" w-3/4 bg-slate-300 gap-5 my-5 overflow-hidden shadow-xl sm:rounded-lg p-5">
                <h2>Totali i Klaseve: {{ $totalClasses }}</h2>

                <div id="classByDateChart"></div>
            
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var dates = @json($klasa_dates);
                        var classCounts = @json($classCounts);
            
                        var options = {
                            chart: { type: 'bar' },
                            series: [{ name: 'Klasat', data: classCounts }],
                            xaxis: { categories: dates },
                            title: { text: 'Klasat te numruara me dat' }
                        };
            
                        var chart = new ApexCharts(document.querySelector("#classByDateChart"), options);
                        chart.render();
                    });
                </script>
            </div>

            <div class=" w-3/4 bg-slate-300 gap-5 my-5 overflow-hidden shadow-xl sm:rounded-lg p-5">
                <h2>Mesatarja e Klaseve</h2>
                
            </div>
        </div>
    </div>
</x-app-layout>