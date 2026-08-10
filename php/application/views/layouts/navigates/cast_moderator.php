<div class="flex items-center justify-between h-20">
    <button id="menuButtonLeft"
            class="md:hidden p-2 rounded-lg hover:bg-slate-100">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-7 h-7"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"/>

        </svg>

    </button>
    <!-- Logo -->
    <a href="#" class="flex items-center gap-3 flex-shrink-0 ml-2">

        <img src="<?= base_url(); ?>assets/images/logo1.png"
             class="w-10 h-10"
             alt="Logo">

        <img src="<?= base_url(); ?>assets/images/logo_title.png"
             class="h-9 hidden md:block"
             alt="Infinity Webcast">
             <div class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5">

        <span class="relative flex h-3 w-3">
            <span class="absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75 animate-ping"></span>
            <span class="relative inline-flex h-3 w-3 rounded-full bg-red-500"></span>
        </span>

        <div>
            <div class="text-xs text-slate-500 uppercase tracking-wide">
                Stream Status
            </div>
            <div class="text-sm font-semibold text-red-600">
                Offline
            </div>
        </div>

    </div>

    </a>
    
    <!-- Right Action -->
    <div class="hidden xl:flex items-center gap-2">

        <!-- Status -->

        <!-- Right Control Bar -->
        <div class="hidden xl:flex items-center gap-3">

            <!-- Divider -->
            <div class="h-8 w-px bg-slate-200"></div>
<?php
    if($isModerator){
?>
            <script>
                function startStream() {
                showPrompt(
                        "Start Stream",
                        "Are you sure you want to start broadcasting?",
                        () => {
                            console.log("START STREAM");
                        }
                    );
                }
            </script>
            <!-- Start Stream -->
            <button onclick="startStream()" 
                class="flex items-center gap-2 rounded-xl bg-green-600 hover:bg-green-700 px-5 py-2.5 text-white text-sm font-semibold shadow-lg shadow-green-600/20 transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path d="M6 4l10 6-10 6V4z"/>
                </svg>

                Start Stream

            </button>
            <script>
                function stopStream() {
                showPrompt(
                        "Stop Stream",
                        "Are you sure you want to end the broadcast?",
                        () => {
                            console.log("START STREAM");
                        }
                    );
                }
            </script>
            <!-- Stop Stream -->
            <button onclick="stopStream()"
                class="flex hidden items-center gap-2 rounded-xl border border-red-200 bg-red-50 hover:bg-red-100 px-5 py-2.5 text-red-600 text-sm font-semibold transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path d="M5 5h10v10H5z"/>
                </svg>

                Stop Stream

            </button>

            <!-- Start Recording -->
            <button disabled
                class="flex items-center gap-2 rounded-xl bg-orange-500 hover:bg-orange-600 px-5 py-2.5 text-white text-sm font-semibold shadow-lg shadow-orange-500/20 transition">

                <span class="w-3 h-3 rounded-full bg-white"></span>

                Start Recording

            </button>

            <!-- Stop Recording -->
            <button
                class="flex items-center hidden gap-2 rounded-xl border border-orange-200 bg-orange-50 hover:bg-orange-100 px-5 py-2.5 text-orange-700 text-sm font-semibold transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path d="M5 5h10v10H5z"/>
                </svg>

                Stop Recording

            </button>
            <script>
                function endCast() {
                showPrompt(
                        "End Cast",
                        "Are you sure you want to End Cast?",
                        () => {
                            console.log("End Cast");
                            window.close();
                        }
                    );
                }
            </script>
            <!-- End Cast -->
            <button  onclick="endCast()"
                class="flex items-center gap-2 rounded-xl bg-slate-900 hover:bg-black px-5 py-2.5 text-white text-sm font-semibold shadow-lg transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"/>
                </svg>

                End Cast

            </button>
<?php
    }else{
?>
            <script>
                function leftCast() {
                showPrompt(
                        "Left Cast",
                        "Are you sure you want to Left Cast?",
                        () => {
                            console.log("End Cast");
                            window.close();
                        }
                    );
                }
            </script>
            <!-- End Cast -->
            <button  onclick="leftCast()"
                class="flex items-center gap-2 rounded-xl bg-slate-900 hover:bg-black px-5 py-2.5 text-white text-sm font-semibold shadow-lg transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"/>
                </svg>

                Left Cast

            </button>

        
<?php
    }
?>
</div>
        <!-- User -->

        <div class="ml-3 flex items-center gap-3 border-l pl-4 mr-2">

            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">

                AK

            </div>

            <div class="hidden 2xl:block">

                <div class="text-sm font-semibold text-slate-800">

                    <?= $jwtData['user']['name']; ?>

                </div>

                <div class="text-xs text-slate-500">

                    <?= $isModerator?'Host':'Presenter'; ?>

                </div>

            </div>

        </div>

    </div>

    <!-- Mobile -->

    <button id="menuButton"
            class="xl:hidden p-2 rounded-lg hover:bg-slate-100">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-7 h-7"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"/>

        </svg>

    </button>

</div>

<!-- Mobile Menu -->

<div id="mobileMenu"
     class="hidden xl:hidden border-t bg-white">

    <div class="p-6 space-y-3">
<?php
    if($isModerator){
?>
        <button  onclick="startStream()" class="w-full rounded-xl bg-green-600 text-white py-3 font-semibold">
            ▶ Start Stream
        </button>

        <button  onclick="stopStream()" class="w-full hidden rounded-xl bg-red-600 text-white py-3 font-semibold">
            ■ Stop Stream
        </button>

        <button class="w-full rounded-xl bg-orange-500 text-white py-3 font-semibold">
            ⏺ Start Record
        </button>

        <button class="w-full rounded-xl hidden bg-orange-700 text-white py-3 font-semibold">
            ■ Stop Record
        </button>

        <button   onclick="endCast()" class="w-full rounded-xl bg-slate-900 text-white py-3 font-semibold">
            End Cast
        </button>
<?php
    }else{
?>
        <button  onclick="leftCast()" class="w-full rounded-xl bg-slate-900 text-white py-3 font-semibold">
            Left Cast
        </button>
<?php
    }
?>
    </div>

</div>
<script>
const menuButton = document.getElementById('menuButton');
const menuButtonLeft = document.getElementById('menuButtonLeft');
const mobileMenu = document.getElementById('mobileMenu');
const sidebar = document.getElementById('sidebar');

menuButton.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
});
menuButtonLeft.addEventListener('click', () => {
    toggleSidebar();
});
</script>