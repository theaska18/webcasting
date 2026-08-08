<!-- CONTACT HERO -->
<section class="py-24 bg-gradient-to-b from-white to-blue-50">
    <div class="max-w-4xl mx-auto text-center px-6">

        <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900">
            Contact Us
        </h1>

        <p class="mt-6 text-lg text-gray-600">
            Have questions or need help? Our team is here to support you.
        </p>

    </div>
</section>


<!-- CONTACT CONTENT -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-10 grid lg:grid-cols-2 gap-16">

        <!-- FORM -->
        <div class="bg-white rounded-3xl shadow-xl p-8 border">

            <h2 class="text-2xl font-bold text-slate-900">
                Send us a message
            </h2>

            <form class="mt-6 space-y-5">

                <div>
                    <label class="text-sm font-medium text-gray-600">Full Name</label>
                    <input type="text" placeholder="Your name"
                           class="mt-2 w-full rounded-xl border px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-600">Email</label>
                    <input type="email" placeholder="you@example.com"
                           class="mt-2 w-full rounded-xl border px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-600">Message</label>
                    <textarea rows="5" placeholder="Write your message..."
                              class="mt-2 w-full rounded-xl border px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
                </div>

                <button type="submit"
                        class="w-full rounded-xl bg-blue-600 py-3 font-semibold text-white shadow-lg hover:bg-blue-700 transition">
                    Send Message
                </button>

            </form>
        </div>


        <!-- CONTACT INFO -->
        <div class="flex flex-col justify-between">

            <div>
                <h2 class="text-2xl font-bold text-slate-900">
                    Get in touch
                </h2>

                <p class="mt-4 text-gray-600">
                    Reach out to us for support, sales inquiries, or partnership opportunities.
                </p>

                <div class="mt-8 space-y-6">

                    <!-- EMAIL -->
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                            📧
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Email</p>
                            <p class="text-gray-500">support@yourdomain.com</p>
                        </div>
                    </div>

                    <!-- PHONE -->
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                            📞
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Phone</p>
                            <p class="text-gray-500">+62 812-3456-7890</p>
                        </div>
                    </div>

                    <!-- LOCATION -->
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                            📍
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Office</p>
                            <p class="text-gray-500">Bandung, Indonesia</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- SOCIAL -->
            <div class="mt-10">
                <p class="font-semibold text-slate-900">Follow us</p>
                <div class="mt-4 flex gap-4">
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-blue-100 transition">🌐</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-blue-100 transition">🐦</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-blue-100 transition">💼</a>
                </div>
            </div>

        </div>

    </div>
</section>


<!-- MAP -->
<section class="h-96">
    <iframe 
        class="w-full h-full border-0"
        src="https://maps.google.com/maps?q=bandung&t=&z=13&ie=UTF8&iwloc=&output=embed"
        loading="lazy">
    </iframe>
</section>


<!-- CTA -->
<section class="py-24 bg-blue-600">
    <div class="max-w-4xl mx-auto text-center px-6 text-white">

        <h2 class="text-3xl lg:text-4xl font-extrabold">
            Need Immediate Help?
        </h2>

        <p class="mt-4 text-blue-100">
            Try our demo or contact our team for faster assistance.
        </p>

        <a href="<?= base_url('demo'); ?>"
           class="mt-8 inline-block rounded-xl bg-white px-8 py-4 font-semibold text-blue-600 shadow-lg hover:bg-gray-100 transition">
            🚀 Try Demo
        </a>

    </div>
</section>