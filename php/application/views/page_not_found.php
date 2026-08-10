

    <div class="flex items-center justify-center px-6 py-10">

        <div class="max-w-xl w-full text-center">

            <!-- Error Code -->
            <div class="text-8xl font-extrabold text-blue-600">
                404
            </div>

            <!-- Title -->
            <h1 class="mt-6 text-3xl font-bold text-slate-800">
                Page Not Found
            </h1>

            <!-- Description -->
            <p class="mt-4 text-slate-500 leading-relaxed">
                Sorry, the page you are looking for doesn't exist,
                may have been moved, or the URL is incorrect.
            </p>

            <!-- Illustration -->
            <div class="mt-10 flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-56 h-56 text-blue-500"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="1.5">

                    <circle cx="12" cy="12" r="9"></circle>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M9.75 9.75h.008v.008H9.75zm4.5 0h.008v.008h-.008z"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M9 16c.8-.7 1.8-1 3-1s2.2.3 3 1"/>

                </svg>
            </div>

            <!-- Buttons -->
            <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">

                <a href="/"
                   class="inline-flex items-center justify-center rounded-xl bg-blue-600 hover:bg-blue-700 px-6 py-3 text-white font-semibold transition">

                    Back to Home

                </a>

                <button onclick="history.back()"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white hover:bg-slate-50 px-6 py-3 text-slate-700 font-semibold transition">

                    Go Back

                </button>

            </div>

        </div>

    </div>