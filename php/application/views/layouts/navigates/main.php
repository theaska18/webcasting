<nav class="sticky top-0 z-50 border-b bg-white/90 backdrop-blur">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between h-20">

            <!-- Logo -->
            <a href="<?= base_url(); ?>" class="flex items-center gap-3 flex-shrink-0">
                <img src="<?= base_url(); ?>assets/images/logo1.png"
                     class="w-10 h-10 hidden sm:block"
                     alt="Logo">

                <img src="<?= base_url(); ?>assets/images/logo_title.png"
                     class="h-9"
                     alt="Webcasting Expert">
            </a>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center gap-8">

                <a href="<?= base_url('features'); ?>" class="text-gray-600 hover:text-blue-600">Features</a>
                <a href="<?= base_url('pricing'); ?>" class="text-gray-600 hover:text-blue-600">Pricing</a>
                <a href="<?= base_url('about'); ?>" class="text-gray-600 hover:text-blue-600">About</a>
                <a href="<?= base_url('contact'); ?>" class="text-gray-600 hover:text-blue-600">Contact</a>

            </div>

            <!-- Desktop Button -->
            <div class="hidden lg:flex items-center gap-3">

                <a href="<?= base_url('login'); ?>"
                   class="rounded-xl border border-blue-600 px-5 py-2.5 font-semibold text-blue-600 hover:bg-blue-50 transition">
                    Login
                </a>

                <a href="<?= base_url('demo'); ?>"
                   class="rounded-xl bg-blue-600 px-5 py-2.5 font-semibold text-white hover:bg-blue-700 transition">
                    Try Demo
                </a>

            </div>

            <!-- Mobile Button -->
            <button id="menuButton"
                    class="lg:hidden p-2 rounded-lg hover:bg-gray-100">

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

    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu"
         class="hidden lg:hidden border-t bg-white">

        <div class="px-6 py-5 space-y-4">

            <a href="<?= base_url('features'); ?>" class="block hover:text-blue-600">Features</a>

            <a href="<?= base_url('pricing'); ?>" class="block hover:text-blue-600">Pricing</a>

            <a href="<?= base_url('about'); ?>" class="block hover:text-blue-600">About</a>

            <a href="<?= base_url('contact'); ?>" class="block hover:text-blue-600">Contact</a>

            <hr>

            <a href="<?= base_url('login'); ?>"
               class="block text-center rounded-xl border border-blue-600 py-3 font-semibold text-blue-600">
                Login
            </a>

            <a href="<?= base_url('demo'); ?>"
               class="block text-center rounded-xl bg-blue-600 py-3 font-semibold text-white">
                Try Demo
            </a>

        </div>

    </div>
</nav>

<script>
const menuButton = document.getElementById('menuButton');
const mobileMenu = document.getElementById('mobileMenu');

menuButton.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
});
</script>