<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shkolla</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    @if(session('success'))
    <div id="success-alert" class="fixed top-5 right-5 max-w-sm bg-green-300 border border-green-500 text-green-800 px-4 py-3 rounded shadow-lg" role="alert">
        <div class="flex items-center">
            <svg class="fill-current w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M10 0C4.48 0 0 4.48 0 10s4.48 10 10 10 10-4.48 10-10S15.52 0 10 0zm1 15H9v-2h2v2zm0-4H9V5h2v6z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    </div>

    <script>
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);
    </script>
    @endif


    <div class="w-full h-2/12 p-10 flex flex-row justify-between items-center bg-slate-900 text-white font-bold">
            <div id="logo-light" class="font-bolder text-2xl">
                القراء| Al-Kurra
            </div>
        
            <!-- Dropdown for mobile -->
            <div class="lg:hidden flex items-center">
                <button id="menu-toggle" class="text-white text-2xl">
                    &#9776; <!-- Hamburger icon -->
                </button>
            </div>
        
            <!-- Navigation links -->
            <div class="hidden lg:flex">
                <ul class="flex flex-row gap-5">
                   
                    <li><a class="hover:bg-cyan-200 hover:text-black py-2 px-1 transition-all" href="/login">Platforma</a></li>

                    <li><a href="#contact">Kontakto</a></li>
                    <li><a href="">ar/en</a></li>
                </ul>
            </div>
        
            <!-- Mobile menu -->
            <div id="mobile-menu" class="lg:hidden absolute top-20 right-0 z-20 bg-slate-900 w-full p-5 hidden">
                <ul class="flex flex-col items-start gap-5">
                    
                    <li><a href="">platforma</a></li>
                    <li><a href="#contact">Kontakto</a></li>
                    <li><a href="">ar/en</a></li>
                </ul>
            </div>
        </div>

        <script>
            // Toggle mobile menu
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
        
            menuToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        </script>
    

        <div class="w-full h-96">
            <div class="w-full h-full flex justify-center items-center bg-sky-300 relative">
                <div class="w-3/5 sm:3/6 flex flex-col text-left justify-center z-10">
                    <span class="font-bold text-3xl">
                        Mëso të lexosh
                    </span>
                    <p class="text-xl">
                        Kuranin me saktësi dhe përkushtim, <br>duke u thelluar në kuptimin e tij dhe duke ndjekur traditën e leximit të shenjtë që të çon drejt njohjes dhe afërsisë me fjalën e Allahut.    
                    </p>
                </div>
            </div>
        </div>


        <div class="w-full my-10 px-4 lg:px-0 flex flex-col lg:flex-row justify-evenly items-center gap-6">
           
            <div class="w-4/5 lg:w-1/4 h-auto bg-slate-700 flex-shrink-0 p-4 sm:p-6 shadow-2xl shadow-black">
                <img class="object-cover " src="{{asset('storage/frontend_photos/Xhamia.jpg')}}" alt="">
            </div>
        
           
            <div class="flex flex-col text-left max-w-lg p-4 sm:p-6">
                <span class="font-bold mb-4 text-3xl">
                    Kush jemi ne?
                </span>
                <p class="text-justify">
                    Ne ofrojmë një program të plotë mësimor për të gjitha grupmoshat, ku nxënësit mësojnë leximin e Kuranit, rregullat e tij dhe kuptimin e ajeteve të shenjta.
                    <br> Me mësues të kualifikuar dhe të përkushtuar, <br>sigurojmë një përvojë mësimore cilësore që ndihmon nxënësit të zhvillojnë njohuritë dhe devotshmërinë e tyre.
                    <br> Shkolla jonë përdor metodologji bashkëkohore për të përshtatur mësimin sipas nevojave të secilit student, duke integruar teknologjinë për mësimin online dhe përmbajtjen interaktive për një përvojë të plotë dhe frytdhënëse.
                </p>
            </div>
        </div>
        
        <div class="w-full h-auto my-10 flex flex-col sm:flex-row-reverse justify-evenly items-center gap-6 bg-indigo-950 text-white p-6 sm:p-20">
            
            <div class="w-full sm:w-1/4 h-96 max-h-96  border-white border border-4  shadow-2xl shadow-indigo-800 mb-6 sm:mb-0 overflow-hidden">
                <img class="w-full h-full object-cover" src="{{ asset('storage/frontend_photos/Drejtori.jpg') }}" alt="Dr. Bali Sadiku"/>
            </div>
        
            
            <div class="flex flex-col w-full max-w-3xl text-left">
                <span class="font-bold text-3xl mb-4">
                    Drejtori ynë, Dr. Bali Sadiku
                </span>
                <p class="text-lg text-justify">
                    është një doktor i shkencave me specializim në fakultetin e Hadithit në Medinen e Profetit. Pas një udhëtimi të gjatë studimesh që nisi në moshën 21-vjeçare dhe përfundoi me sukses të lartë në moshën 39-vjeçare, ai u kthye në vendlindje me një mesatare të shkëlqyer 5.0 në doktoraturë.
                    Gjatë qëndrimit të tij në Medine, Dr. Baliu arriti të memorizojë tërësisht Kuranin dhe fitoi ixhazetin, një zinxhir i trashëguar i transmetimit që lidhet brez pas brezi deri tek Profeti Muhamed (paqja qoftë mbi të).
                    Pas kthimit në atdhe, Dr. Baliu vazhdoi kontributin e tij të çmuar si Khatib i Komunës së Vitisë dhe si profesor në Medresenë Alaudin, dega fizike në Gjilan. Me përkushtim të veçantë për përhapjen e dijes dhe edukimin e brezave të rinj, ai mori iniciativën për të hapur një institucion ku do të ndante dijen dhe përvojën e tij të pasur me studentët e tjerë, duke kontribuar kështu në ndriçimin e rrugës së dijes në vendin tonë.
                </p>
        
                <ul class="flex flex-row mt-4">
                    <li class="p-2 my-2 mx-1 bg-sky-300 text-black font-bold text-md hover:scale-110 transition-all duration-300 ease-in-out">
                        <a href="https://www.youtube.com/@hoxhedr.balisadiku/featured">Youtube</a>
                    </li>
                    <li class="p-2 my-2 mx-1 bg-sky-300 text-black font-bold text-md hover:scale-110 transition-all duration-300 ease-in-out">
                        <a href="https://www.facebook.com/profile.php?id=100082785151293">Facebook</a>
                    </li>
                    <li class="p-2 my-2 mx-1 bg-sky-300 text-black font-bold text-md hover:scale-110 transition-all duration-300 ease-in-out">
                        <a href="https://www.tiktok.com/@dr.balisadiku">Tiktok</a>
                    </li>
                </ul>
            </div>
        </div>
      
        <div class="w-full h-4/5">
                <div class="w-full h-auto my-5 flex flex-col justify-around items-center">
                    <div class=" w-5/6 h-60 bg-sky-300 flex justify-center items-center shadow-xl">
                            <span id="logo" class=" text-slate-900 ">
                                Al-Kurra | القراء 
                            </span>
                    </div>
                    
                    <div class="w-4/5 flex flex-row">
                        <div class="w-4/5 h-auto flex flex-col my-10 gap-10 justify-center items-start text-left">
                                <span class="font-bold text-3xl text-slate-900">
                                    Studentet
                                </span>
                                <p class=" text-xl text-slate-900">
                                    Studentet do te perjetojn nje periudh te jashtzakonshme, nje rrugetim ku nuk do ta harrojn kurr, <br>me te vertet se rruga per memorizimin e librit te allahut eshte e veshtir dhe me sfida por kur je i sinqert ajo do te jete e leht me rahmet te zotit.
                                </p>

                                <span class="font-bold text-3xl text-slate-900">
                                    Plan programi
                                </span>
                                <p class=" text-xl text-slate-900">
                                    Me emrin e ALLAHUT gjat keti rrugtimi do te jem krah per krah me studentet dhe do te fillojm nga shkronjat deri tek memorizimi per te gjitha moshat. <br>
                                    Ne kete list jan te shenuara materialet dhe skriptat me te cilen shpjegohen rregullat dhe shkronjat arabe.

                                        <li>Al-kaide A-nuranije | القاعدة النورانية</li>
                                        <li>Poezia e imam xhumzurit | تحفة الاطفال</li>
                                        <li>...</li>
                                 </p>

                                <span class="font-bold text-3xl text-slate-900">
                                    Materialet
                                </span>
                                
                                <span class="font-bold text-xl text-slate-900">
                                    <button onclick="toggleSection('Shqip')" class="w-full text-left text-xl my-2 flex items-center">
                                        <span class="transform transition-transform duration-300 mr-2" id="arrow-Shqip">▶</span>
                                        Shqip
                                    </button>
                                    <ul id="Shqip" class="hidden pl-4 mt-2 space-y-2 transition-all duration-500 overflow-hidden">
                                        <li><a href="#" class="block text-lg">Shkarko matrialin shqip</a></li>    
                                    </ul> 
                                </span>
                                
                                <span class="font-bold text-xl text-slate-900">
                                    <button onclick="toggleSection('Arabisht')" class="w-full text-left text-xl my-2 flex items-center">
                                        <span class="transform transition-transform duration-300 mr-2 " id="arrow-Arabisht">▶</span>
                                        Arabisht
                                    </button>
                                    <ul id="Arabisht" class="hidden pl-4 mt-2 space-y-2 transition-all duration-500 overflow-hidden">
                                        <li><a href="#" class="block text-lg">Shkarko matrialin arabisht</a></li>    
                                    </ul> 
                                </span>
                                
                                <script>
                                    function toggleSection(sectionId) {
                                        const section = document.getElementById(sectionId);
                                        const arrow = document.getElementById(`arrow-${sectionId}`);
                                    
                                        section.classList.toggle('hidden'); // Toggle visibility of the list
                                        arrow.classList.toggle('rotate-90'); // Toggle rotation for the arrow
                                    }
                                </script>
                        </div>
                    </div>

                    
                </div>
        </div>

        <div class="w-full h-auto py-20 bg-sky-300 flex flex-col justify-around items-center">
                        <span class="font-bold text-2xl sm:text-3xl  text-slate-900">
                            Shkolla digjitale <span id="name">Al-Kurra</span>
                        </span>
                        <div class="w-4/5 h-auto flex flex-col my-10 gap-10 justify-center items-start text-left">
                            <span class="font-bold text-3xl text-slate-900">
                               Si funksionon ? 
                            </span>
                            <p class=" text-xl text-slate-900">
                                Per te ia lehtesuar udhen studentit per mesim kemi kriju nje platform online ku do te ket mudesin studenti te shikoj klasaen ne te cilen eshte participent , vijushmerin , performancen , dhe te kontaktoj me koleget e klases mesuesin e me shum,<br> Shkolla posedon nje rrjet social mbrenda saj ku aty do te postohen lajmerimet nga drejtoria dhe stafi administrativ. <br>   
                            </p>

                            <span class="font-bold text-3xl text-slate-900">
                               Si te regjistrohemi? 
                            </span>
                            <p class=" text-xl text-slate-900">
                                Regjistrimi behet ne nje form unike, <br>
                                Nga ana juaj ne fund te faqes duhet te mbusheni <a href="#contact" class="text-indigo-600">formualrin</a> qe perbehet nga emri i plote nje email address dhe numri i telefonit , <br>
                                Nga ana e jone do te kontaktojm me aplikuesin dhe do te konsulltohem dhe te konfirmojm regjistrimin e ti, pas ksaj do te dergohen te dhenat e kyqjes ne email dhe linkin e shkolles, <br> nga ne heren e par do te modifikoni fjalkalimin per sigurin tuaj.
                            </p>

                            <span class="font-bold text-3xl text-slate-900">
                                Si te navigohem tek klasat ?
                            </span>
                            <p class=" text-xl text-slate-900">
                                Pasi se te kyqeni ne platform faqja e par do te jet ballina dhe ndahet ne disa sektor, sektori i par quhet klasat e mia aty do te ju shfaqen klasat e juaja vetem duhej te klikoni mbi to dhe jeni ne faqen e klases.
                            </p>

                            <div class="w-full h-auto flex">
                                <iframe class="w-[90%] h-[200px] sm:w-[560px] sm:h-[315px] rounded-xl" 
                                        src="https://www.youtube.com/embed/U4v3bw4bk0o?si=1elPeR81SR5Pzd-n" 
                                        title="YouTube video player" frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        referrerpolicy="strict-origin-when-cross-origin" 
                                        allowfullscreen>
                                </iframe>
                            </div>

                            <span class="font-bold text-3xl text-slate-900">
                                Rregullat
                            </span>
                            <p class=" text-xl text-slate-900">
                                Si cdo institcuion dhe shkoll edhe ne kemi disa rregulla qe duhet te ju permbaheni pasi te beni antar te kesaj shkolle. <br>
                                rregullat do te ju dergohen pasi te kontaktojm ne dhe te perfundojm regjistrimin. <br>
                            
                                    <li>Mungesat jan te tolerushme pa arsye deri ne 10 mungesa mbrenda mujit.</li>
                                    <li>Studenti me 21 mungesa pa arsye valide do te jet ne nje faze te pritjes dhe kosulltim per vazhdim e tutje ne shkoll.</li>    
                                    <li>Nese vrehet qe nga studenti nuk ka ndonje permirsim pas qortimit nga mungesat ateher mirren masa ndaj studentit.</li>
                                    <li>Nese studenti mund te ket ndonje te mbet fizike apo mendore ateher dergohet ne nje trajtim te vecant.</li>
                                    <li>Regjistrimi per moshat nen 18 vjecare behet me konsulltim te prinderve.</li>
                                    <li>Nese studenti nxihet duke vjedhur nga kurani dhe duke genjy gjat leximit online apo testimit ai, ne menyr automatike perjashtohet.</li>
                                    <li>Per sicilin xhuz do te ket nje provim obligativ per te testuar memorizim dhe texhvidin, Nuk vazhdon memorizimi pa perfundimin e provimeve me nje mesatare 85%.</li>
                                    <li>Studenti duhet te pajtohet me te gjitha rregullat e cekura.</li>
                            </p>
                        </div>
        </div>

        <div class="w-full h-auto py-20 bg-indigo-950 flex flex-col sm:flex-row justify-center sm:justify-center items-center sm:items-start">
            <div class="flex flex-col justify-start w-full sm:w-1/2 text-center sm:text-left">
                <h1 class="font-sans text-white font-bold text-3xl">Kontakto me ne</h1>
                <span id="contact" class="font-bold text-xl text-white">
                    Regjistrohu ne akademin <span id="name_1"> Al-kurra | القراء </span>
                </span>
                <br>
                <form id="contact-form" class="flex flex-col gap-3 w-full" method="post" action="{{ route('kerkesat.store') }}">
                    @csrf
                    <div class="w-full">
                        <input class="input" type="text" name="name" placeholder="Emri i plote.." required>
                        <input class="input" type="email" name="email" placeholder="Email-i..." required>
                        <input class="input" type="text" name="phone" placeholder="Numeri i telefonit..." required>
                        <div class="flex flex-row mt-5 gap-5 text-white justify-start items-center">
                            <label for="check">Pajtohem me te gjitha rregullat e shkolles</label>
                            <input class="check" type="checkbox" name="agreement" required>
                        </div>
                        <button type="submit" class="w-3/4 sm:w-3/7 h-10 mt-10 text-black font-bold bg-sky-300 hover:scale-105 transition-all duration-300 ease-in-out mx-auto">
                            Dergo !
                        </button>
                    </div>
                </form>
            </div>
            
        </div>
        
        <div class="w-full h-2/12 p-10 flex flex-col sm:flex-row justify-evenly items-start bg-slate-900 text-white font-bold">
            <div id="logo-light" class="font-bolder text-2xl mb-4 sm:mb-0">
                القراء| Al-Kurra 
            </div>
            <hr class="border-white mb-4 sm:mb-0 sm:mx-4" />
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-8 sm:ml-4">
                <div class="flex flex-col gap-2">
                    <a href="" class="hover:text-sky-300">Rreth nesh</a>
                    <a href="" class="hover:text-sky-300">Kontakto</a>
                    <a href="" class="hover:text-sky-300">ar/en</a>
                </div>
                <div class="flex flex-col gap-2">
                    <span>email | Avdullahsadiku@gmail.com</span>
                    <span>email | abdu@gmail.com</span>
                    <span>email | test@gmail.com</span>
                </div>
                <div class="flex flex-col gap-2">
                    <span>phone | +383 48 285002</span>
                    <span>phone | +383 48 285002</span>
                </div>
            </div>
            <div class="flex items-end mt-4 sm:mt-0">
                &copy; 2024 Al-Kurra | القراء
            </div>
        </div>
</body>
</html>



