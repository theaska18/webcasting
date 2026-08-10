<div class="flex items-center justify-center px-6 py-10">

    <div class="w-full max-w-md">

        <!-- Logo -->
        <div class="text-center">

            <img
                src="<?= base_url(); ?>assets/images/logo_title.png"
                class="h-14 mx-auto">

            <h1 class="mt-8 text-4xl font-bold text-slate-900">
                Welcome Back
            </h1>

            <p class="mt-3 text-slate-500 leading-7">
                Sign in to access your Webcast dashboard.
            </p>

        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8">

            <!-- Username -->
            <div class="mb-6">

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Username or Email
                </label>

                <input
                    type="text"
                    placeholder="Enter your username"
                    class="w-full rounded-xl border border-slate-300
                           px-5 py-4
                           focus:border-[#2A83F8]
                           focus:ring-4
                           focus:ring-blue-100
                           outline-none
                           transition">

            </div>

            <!-- Password -->
            <div>

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Password
                </label>

                <div class="relative">

                    <input
                        type="password"
                        placeholder="Enter your password"
                        class="w-full rounded-xl border border-slate-300
                               px-5 py-4 pr-12
                               focus:border-[#2A83F8]
                               focus:ring-4
                               focus:ring-blue-100
                               outline-none">

                    <button
                        type="button"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#1556D8]">

                        👁

                    </button>

                </div>

            </div>

            <!-- Remember -->
            <div class="flex justify-between items-center mt-6 text-sm">

                <label class="flex items-center gap-2 text-slate-600">

                    <input
                        type="checkbox"
                        class="rounded border-slate-300 text-[#1556D8]">

                    Remember Me

                </label>

                <a href="#"
                   class="font-medium text-[#1556D8] hover:text-[#FF7A1A]">

                    Forgot Password?

                </a>

            </div>

            <!-- Button -->

            <button
                class="mt-8 w-full rounded-xl py-4
                       font-semibold
                       text-white
                       bg-gradient-to-r
                       from-[#1556D8]
                       via-[#2A83F8]
                       to-[#FF7A1A]
                       hover:shadow-xl
                       hover:scale-[1.01]
                       transition">

                Sign In

            </button>

        </div>

        <!-- Bottom -->

        <div class="mt-8 flex justify-center gap-6 text-sm text-slate-500">

            <span>🔒 Secure</span>

            <span>📡 WebRTC</span>

            <span>⚡ Low Latency</span>

        </div>

    </div>

</div>