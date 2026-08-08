<!-- Tabs -->
<div class="border-b">

    <div class="grid grid-cols-3">

        <button
            class="tab-btn px-4 py-4 border-b-2 border-blue-600 text-blue-600 font-semibold"
            data-tab="message">

            💬 Message

        </button>

        <button
            class="tab-btn px-4 py-4 text-slate-500 hover:text-blue-600"
            data-tab="poll">

            📊 Polls

        </button>

        <button
            class="tab-btn px-4 py-4 text-slate-500 hover:text-blue-600"
            data-tab="analytics">

            📈 Analytics

        </button>

    </div>

</div>

<div class="flex-1 overflow-y-auto">

    <!-- MESSAGE -->

    <div id="message" class="tab-content p-5">

        <h3 class="font-bold text-xl mb-5">
            Live Messages
        </h3>

        <div class="space-y-4">

            <div class="rounded-xl bg-slate-100 p-4">

                <div class="flex justify-between">

                    <span class="font-semibold">
                        John Smith
                    </span>

                    <span class="text-xs text-slate-500">
                        10:12
                    </span>

                </div>

                <p class="mt-2 text-sm text-slate-600">
                    Great presentation! Thanks.
                </p>

            </div>

            <div class="rounded-xl bg-blue-50 p-4">

                <div class="flex justify-between">

                    <span class="font-semibold">
                        Moderator
                    </span>

                    <span class="text-xs text-slate-500">
                        10:15
                    </span>

                </div>

                <p class="mt-2 text-sm text-slate-700">
                    Poll will begin in 5 minutes.
                </p>

            </div>

        </div>

        <div class="mt-6">

            <textarea
                rows="3"
                class="w-full rounded-xl border p-3"
                placeholder="Broadcast message..."></textarea>

            <button
                class="mt-3 w-full rounded-xl bg-blue-600 py-3 text-white font-semibold">

                Send Message

            </button>

        </div>

    </div>

    <!-- POLL -->

    <div id="poll" class="tab-content hidden p-5">

        <div class="flex justify-between items-center">

            <h3 class="font-bold text-xl">

                Polls

            </h3>

            <button
                class="rounded-lg bg-green-600 px-4 py-2 text-white">

                + Add Poll

            </button>

        </div>

        <div class="mt-6 rounded-xl border p-5">

            <h4 class="font-semibold">

                How satisfied are you with today's webcast?

            </h4>

            <div class="mt-5 space-y-4">

                <div>

                    <div class="flex justify-between text-sm">

                        <span>Excellent</span>

                        <span>65%</span>

                    </div>

                    <div class="mt-1 h-2 rounded bg-slate-200">

                        <div class="h-2 rounded bg-blue-600 w-[65%]"></div>

                    </div>

                </div>

                <div>

                    <div class="flex justify-between text-sm">

                        <span>Good</span>

                        <span>22%</span>

                    </div>

                    <div class="mt-1 h-2 rounded bg-slate-200">

                        <div class="h-2 rounded bg-green-500 w-[22%]"></div>

                    </div>

                </div>

                <div>

                    <div class="flex justify-between text-sm">

                        <span>Average</span>

                        <span>10%</span>

                    </div>

                    <div class="mt-1 h-2 rounded bg-slate-200">

                        <div class="h-2 rounded bg-yellow-500 w-[10%]"></div>

                    </div>

                </div>

                <div>

                    <div class="flex justify-between text-sm">

                        <span>Poor</span>

                        <span>3%</span>

                    </div>

                    <div class="mt-1 h-2 rounded bg-slate-200">

                        <div class="h-2 rounded bg-red-500 w-[3%]"></div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- ANALYTICS -->

    <div id="analytics" class="tab-content hidden p-5">

        <h3 class="font-bold text-xl mb-5">

            Live Analytics

        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div class="rounded-xl bg-blue-50 p-5">

                <div class="text-sm text-slate-500">

                    Viewers

                </div>

                <div class="mt-2 text-3xl font-bold">

                    5,421

                </div>

            </div>

            <div class="rounded-xl bg-green-50 p-5">

                <div class="text-sm text-slate-500">

                    Active Users

                </div>

                <div class="mt-2 text-3xl font-bold">

                    5,108

                </div>

            </div>

            <div class="rounded-xl bg-orange-50 p-5">

                <div class="text-sm text-slate-500">

                    Avg Watch Time

                </div>

                <div class="mt-2 text-3xl font-bold">

                    42m

                </div>

            </div>

            <div class="rounded-xl bg-red-50 p-5">

                <div class="text-sm text-slate-500">

                    Peak Viewers

                </div>

                <div class="mt-2 text-3xl font-bold">

                    6,028

                </div>

            </div>

        </div>

        <div class="mt-6 rounded-xl border p-5">

            <h4 class="font-semibold mb-4">

                Stream Health

            </h4>

            <div class="space-y-3">

                <div class="flex justify-between">

                    <span>CPU Usage</span>

                    <span>18%</span>

                </div>

                <div class="flex justify-between">

                    <span>Memory Usage</span>

                    <span>2.4 GB</span>

                </div>

                <div class="flex justify-between">

                    <span>Bitrate</span>

                    <span>4.5 Mbps</span>

                </div>

                <div class="flex justify-between">

                    <span>Latency</span>

                    <span>126 ms</span>

                </div>

                <div class="flex justify-between">

                    <span>Packet Loss</span>

                    <span class="text-green-600">

                        0%

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>
<script>
document.querySelectorAll('.tab-btn').forEach(btn => {

    btn.addEventListener('click', function(){

        document.querySelectorAll('.tab-content').forEach(tab=>{
            tab.classList.add('hidden');
        });

        document.querySelectorAll('.tab-btn').forEach(tab=>{
            tab.classList.remove('border-blue-600','text-blue-600','font-semibold');
            tab.classList.add('text-slate-500');
        });

        document.getElementById(this.dataset.tab).classList.remove('hidden');

        this.classList.add('border-blue-600','text-blue-600','font-semibold');

    });

});
</script>