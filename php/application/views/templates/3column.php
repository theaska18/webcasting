<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/images/logo1.png">
        <title>Template | Webcasting</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <style>
        body{
            font-family:Inter,sans-serif;
        }
        </style>
    </head>
    <body class="min-h-screen flex flex-col bg-slate-50">
        <?php
            if(isset($navigate)==null){
                $this->load->view('layouts/navigates/main');
            }else{
                $this->load->view('layouts/$navigate');
            }
        ?>
        <main class="flex-1">
            <!-- HERO -->
            <section class="bg-slate-50">

                <div class="max-w-7xl mx-auto px-6 py-16">

                    <div class="grid lg:grid-cols-12 gap-8">

                        <!-- LEFT -->
                        <aside class="lg:col-span-2">

                            <div class="bg-white rounded-2xl shadow p-6 sticky top-24">

                                <h3 class="font-bold mb-5">
                                    Quick Access
                                </h3>

                                <nav class="space-y-3">

                                    <a href="#schedule" class="block hover:text-blue-600">
                                        📅 Schedule
                                    </a>

                                    <a href="#polling" class="block hover:text-blue-600">
                                        📊 Polling
                                    </a>

                                    <a href="#recording" class="block hover:text-blue-600">
                                        🎥 Recording
                                    </a>

                                    <a href="#streaming" class="block hover:text-blue-600">
                                        📡 Streaming
                                    </a>

                                    <a href="#messaging" class="block hover:text-blue-600">
                                        💬 Messaging
                                    </a>

                                </nav>

                            </div>

                        </aside>

                        <!-- CENTER -->
                        <main class="lg:col-span-7">

                            <span class="inline-flex px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold">
                                Professional Platform
                            </span>

                            <h1 class="mt-6 text-5xl font-extrabold leading-tight">

                                Host Webinars,
                                Meetings &
                                Live Streaming

                            </h1>

                            <p class="mt-6 text-lg text-gray-600">

                                Schedule webinars, engage your audience with live polling,
                                record every session, collaborate with multiple participants,
                                and broadcast in Ultra HD.

                            </p>

                            <div class="mt-8 flex gap-4">

                                <a href="#"
                                class="rounded-xl bg-blue-600 px-6 py-4 text-white font-semibold">

                                    🚀 Try Demo

                                </a>

                                <a href="#"
                                class="rounded-xl border px-6 py-4">

                                    Contact Sales

                                </a>

                            </div>

                            <!-- Feature Icons -->

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-5 mt-12">

                                <div class="bg-white rounded-xl p-5 shadow">

                                    📅<br>
                                    Schedule

                                </div>

                                <div class="bg-white rounded-xl p-5 shadow">

                                    📊<br>
                                    Polling

                                </div>

                                <div class="bg-white rounded-xl p-5 shadow">

                                    🎥<br>
                                    Recording

                                </div>

                                <div class="bg-white rounded-xl p-5 shadow">

                                    📡<br>
                                    Streaming

                                </div>

                                <div class="bg-white rounded-xl p-5 shadow">

                                    💬<br>
                                    Messaging

                                </div>

                                <div class="bg-white rounded-xl p-5 shadow">

                                    👥<br>
                                    Participants

                                </div>

                            </div>

                        </main>

                        <!-- RIGHT -->
                        <aside class="lg:col-span-3">

                            <div class="space-y-5 sticky top-24">

                                <div class="bg-white rounded-2xl shadow p-5">

                                    <div class="text-sm text-gray-500">
                                        Live Poll
                                    </div>

                                    <div class="text-3xl font-bold mt-2">
                                        82%
                                    </div>

                                    <div class="text-green-600">
                                        Audience Voted
                                    </div>

                                </div>

                                <div class="bg-white rounded-2xl shadow p-5">

                                    <div class="text-sm text-gray-500">
                                        Live Chat
                                    </div>

                                    <div class="text-3xl font-bold mt-2">
                                        254
                                    </div>

                                    <div>
                                        Messages
                                    </div>

                                </div>

                                <div class="bg-white rounded-2xl shadow p-5">

                                    <div class="text-red-600 font-bold">

                                        🔴 Recording

                                    </div>

                                    <div class="text-gray-500 mt-2">

                                        Session is currently being recorded.

                                    </div>

                                </div>

                            </div>

                        </aside>

                    </div>

                </div>

            </section>

        </main>
        <?php $this->load->view('layouts/footer'); ?>
    </body>
</html>