<div class="flex items-center justify-between h-20">

    <!-- Logo -->
    <a href="<?= base_url(); ?>" class="flex items-center gap-3 flex-shrink-0 ml-2">

        <img src="<?= base_url(); ?>assets/images/logo1.png"
             class="w-10 h-10"
             alt="Logo">

        <img src="<?= base_url(); ?>assets/images/logo_title.png"
             class="h-9 hidden lg:block"
             alt="Infinity Webcast">

    </a>

    <!-- Right Action -->
    <div class="hidden xl:flex items-center gap-2">

        <!-- Status -->

        <!-- Right Control Bar -->
        <div class="hidden xl:flex items-center gap-3">

            <!-- Status -->
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

            <!-- Divider -->
            <div class="h-8 w-px bg-slate-200"></div>

            <!-- Preview -->
            <button
                class="flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 hover:border-blue-500 hover:text-blue-600 hover:bg-blue-50 transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0s-3.5 7-9 7-9-7-9-7 3.5-7 9-7 9 7 9 7z"/>
                </svg>

                Preview

            </button>

            <!-- Start Stream -->
            <button
                class="flex items-center gap-2 rounded-xl bg-green-600 hover:bg-green-700 px-5 py-2.5 text-white text-sm font-semibold shadow-lg shadow-green-600/20 transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path d="M6 4l10 6-10 6V4z"/>
                </svg>

                Start Stream

            </button>

            <!-- Stop Stream -->
            <button
                class="flex items-center gap-2 rounded-xl border border-red-200 bg-red-50 hover:bg-red-100 px-5 py-2.5 text-red-600 text-sm font-semibold transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path d="M5 5h10v10H5z"/>
                </svg>

                Stop Stream

            </button>

            <!-- Start Recording -->
            <button
                class="flex items-center gap-2 rounded-xl bg-orange-500 hover:bg-orange-600 px-5 py-2.5 text-white text-sm font-semibold shadow-lg shadow-orange-500/20 transition">

                <span class="w-3 h-3 rounded-full bg-white"></span>

                Start Recording

            </button>

            <!-- Stop Recording -->
            <button
                class="flex items-center gap-2 rounded-xl border border-orange-200 bg-orange-50 hover:bg-orange-100 px-5 py-2.5 text-orange-700 text-sm font-semibold transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path d="M5 5h10v10H5z"/>
                </svg>

                Stop Recording

            </button>

            <!-- End Cast -->
            <button
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

        </div>

        <!-- User -->

        <div class="ml-3 flex items-center gap-3 border-l pl-4 mr-2">

            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">

                AK

            </div>

            <div class="hidden 2xl:block">

                <div class="text-sm font-semibold text-slate-800">

                    Asep Kamaludin

                </div>

                <div class="text-xs text-slate-500">

                    Administrator

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

        <button class="w-full rounded-xl bg-green-600 text-white py-3 font-semibold">
            ▶ Start Stream
        </button>

        <button class="w-full rounded-xl bg-red-600 text-white py-3 font-semibold">
            ■ Stop Stream
        </button>

        <button class="w-full rounded-xl bg-orange-500 text-white py-3 font-semibold">
            ⏺ Start Record
        </button>

        <button class="w-full rounded-xl bg-orange-700 text-white py-3 font-semibold">
            ■ Stop Record
        </button>

        <button class="w-full rounded-xl bg-slate-900 text-white py-3 font-semibold">
            End Cast
        </button>

    </div>

</div>
<script>
const menuButton = document.getElementById('menuButton');
const mobileMenu = document.getElementById('mobileMenu');

menuButton.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
});
</script>