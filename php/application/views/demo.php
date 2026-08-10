<div class="bg-white overflow-hidden">
<script>
    var joinType="host";
    var hostName="<?= $hostName; ?>";
    var presenterName="<?= $presenterName; ?>";
    var audienceName="<?= $audienceName; ?>";
    var jwtHost="<?= $jwtHost; ?>";
    var jwtPresenter="<?= $jwtPresenter; ?>";
    var jwtAudience="<?= $jwtAudience; ?>";
    function handleRoleChange(el) {
        console.log("Selected:", el.value);
        joinType=el.value;
        if (el.value === "host") {
            $('#inputName').val(hostName);
        }else if(el.value === "presenter"){
            $('#inputName').val(presenterName);
        }else if(el.value === "audience"){
            $('#inputName').val(audienceName);
        }
    }
    function openJoin(){
        if(joinType=='host'){
            window.open('<?= base_url();?>cast/<?= $roomName; ?>/'+jwtHost);
        }else if(joinType=='presenter'){
            window.open('<?= base_url();?>cast/<?= $roomName; ?>/'+jwtPresenter);
        }
    }
</script>
    <div class="grid lg:grid-cols-5">

        <!-- Left Panel -->
        <div class="lg:col-span-2 bg-gradient-to-br from-[#1556D8] via-[#2A83F8] to-[#5EBEFF] relative overflow-hidden">

            <!-- Background Glow -->
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-[#FF7A1A]/25 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-16 -left-16 w-64 h-64 bg-[#FFA34A]/20 rounded-full blur-3xl"></div>

            <div class="relative z-10 h-full flex flex-col justify-center p-10">

                <img src="<?= base_url(); ?>assets/images/logo_title.png"
                     class="h-12 w-fit mb-10"
                     alt="Infinity Webcast">

                <span class="inline-flex w-fit items-center rounded-full bg-white/15 px-4 py-2 text-sm text-white">
                    Enterprise Webcasting Platform
                </span>

                <h2 class="mt-6 text-5xl font-bold text-white leading-tight">
                    Broadcast
                    <br>
                    Without Limits
                </h2>

                <p class="mt-6 text-blue-100 text-lg leading-8">
                    Deliver secure and scalable live webcasts for webinars,
                    corporate town halls, product launches, online training,
                    and virtual events with enterprise-grade performance.
                </p>

                <div class="mt-12 space-y-6">

                    <div class="flex items-start gap-4">

                        <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-xl">
                            📡
                        </div>

                        <div>

                            <h3 class="font-semibold text-lg text-white">
                                Live Broadcasting
                            </h3>

                            <p class="text-blue-100 text-sm">
                                Stream high-quality events to thousands of viewers.
                            </p>

                        </div>

                    </div>

                    <div class="flex items-start gap-4">

                        <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-xl">
                            ⚡
                        </div>

                        <div>

                            <h3 class="font-semibold text-lg text-white">
                                Ultra Low Latency
                            </h3>

                            <p class="text-blue-100 text-sm">
                                Real-time streaming powered by WebRTC technology.
                            </p>

                        </div>

                    </div>

                    <div class="flex items-start gap-4">

                        <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-xl">
                            🔒
                        </div>

                        <div>

                            <h3 class="font-semibold text-lg text-white">
                                Enterprise Security
                            </h3>

                            <p class="text-blue-100 text-sm">
                                Secure authentication and protected live broadcasts.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Right Panel -->
        <div class="lg:col-span-3 p-10 flex items-center">

            <div class="w-full">

                <h3 class="text-3xl font-bold text-slate-800">
                    Join Webcast Conference
                </h3>

                <p class="text-slate-500 mt-3 leading-7">
                    Join an existing webcast as a <strong>Host</strong>,
                    <strong>Presenter</strong>, or <strong>Audience</strong>.
                    Simply enter your webcast details below.
                </p>

                <div class="mt-8 space-y-6">

                    <!-- Room -->

                    <div>

                        <label class="block font-medium text-slate-700 mb-2">
                            Webcast Room
                        </label>

                        <input
                            type="text"
                            value="<?= $roomName; ?>"
                            placeholder="e.g. annual-townhall-2026"
                            class="w-full rounded-xl border border-slate-300 px-5 py-3
                                   focus:ring-4 focus:ring-blue-100
                                   focus:border-[#2A83F8]
                                   outline-none" readOnly>

                    </div>

                    <!-- Name -->

                    <div>

                        <label class="block font-medium text-slate-700 mb-2">
                            Display Name
                        </label>

                        <input
                            type="text"
                            id="inputName"
                            value="<?= $hostName;?>"
                            placeholder="Enter your name"
                            class="w-full rounded-xl border border-slate-300 px-5 py-3
                                   focus:ring-4 focus:ring-blue-100
                                   focus:border-[#2A83F8]
                                   outline-none" readOnly>

                    </div>

                    <!-- Role -->

                    <div>

                        <label class="block font-medium text-slate-700 mb-3">
                            Choose Your Role
                        </label>

                        <div class="grid grid-cols-3 gap-4">

                            <!-- Host -->

                            <label class="cursor-pointer">

                                <input
                                    type="radio"
                                    name="role"
                                    value="host"
                                    class="peer hidden"
                                    onchange="handleRoleChange(this)"
                                    checked>

                                <div class="rounded-2xl border-2 border-slate-200 p-5 text-center transition
                                            peer-checked:border-[#1556D8]
                                            peer-checked:bg-blue-50">

                                    <div class="text-3xl mb-3">🎙️</div>

                                    <div class="font-bold">
                                        Host
                                    </div>

                                    <div class="text-xs text-slate-500 mt-1">
                                        Manage webcast
                                    </div>

                                </div>

                            </label>

                            <!-- Presenter -->

                            <label class="cursor-pointer">

                                <input
                                    type="radio"
                                    name="role"
                                    value="presenter"
                                    class="peer hidden" onchange="handleRoleChange(this)">

                                <div class="rounded-2xl border-2 border-slate-200 p-5 text-center transition
                                            peer-checked:border-[#FF7A1A]
                                            peer-checked:bg-orange-50">

                                    <div class="text-3xl mb-3">🎤</div>

                                    <div class="font-bold">
                                        Presenter
                                    </div>

                                    <div class="text-xs text-slate-500 mt-1">
                                        Share audio & video
                                    </div>

                                </div>

                            </label>

                            <!-- Audience -->

                            <label class="cursor-pointer">

                                <input
                                    type="radio"
                                    name="role"
                                    value="audience"
                                    onchange="handleRoleChange(this)"
                                    class="peer hidden">

                                <div class="rounded-2xl border-2 border-slate-200 p-5 text-center transition
                                            peer-checked:border-[#5EBEFF]
                                            peer-checked:bg-sky-50">

                                    <div class="text-3xl mb-3">👥</div>

                                    <div class="font-bold">
                                        Audience
                                    </div>

                                    <div class="text-xs text-slate-500 mt-1">
                                        Watch live webcast
                                    </div>

                                </div>

                            </label>

                        </div>

                    </div>

                    <!-- Button -->

                    <button
                        class="w-full rounded-xl py-4 text-lg font-semibold text-white
                               bg-gradient-to-r
                               from-[#1556D8]
                               via-[#2A83F8]
                               to-[#FF7A1A]
                               hover:shadow-xl
                               hover:scale-[1.01]
                               transition-all duration-300" onclick="openJoin()">

                        Join Webcast →

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>