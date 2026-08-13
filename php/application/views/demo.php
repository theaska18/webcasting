<?php
	$ci =& get_instance();
    // Ambil 1 event random
    $event = $ci->db
        ->where('event_id >=', 1)
        ->where('event_id <=', 10)
        ->order_by('RAND()')
        ->limit(1)
        ->get('cast_event')
        ->row_array();

    if (!$event) {
        return null;
    }

    $eventId = $event['event_id'];

    // Host
    $host = $ci->db
        ->where('event_id', $eventId)
        ->where('moderator_flag', 1)
        ->limit(1)
        ->get('cast_event_user')
        ->row_array();

    // Participant
    $participant = $ci->db
        ->where('event_id', $eventId)
        ->where('moderator_flag', 0)
        ->where('participant_flag', 1)
        ->limit(1)
        ->get('cast_event_user')
        ->row_array();

    // Audience
    $audience = $ci->db
        ->where('event_id', $eventId)
        ->where('moderator_flag', 0)
        ->where('participant_flag', 0)
        ->limit(1)
        ->get('cast_event_user')
        ->row_array();

?>
<div class="bg-white overflow-hidden">
<script>
    var hostName="<?= $host['user_name']; ?>";
    var presenterName="<?= $participant['user_name']; ?>";
    var audienceName="<?= $audience['user_name']; ?>";
    var jwtHost="<?= $host['invitation_code']; ?>";
    var jwtPresenter="<?= $participant['invitation_code']; ?>";
    var jwtAudience="<?= $audience['invitation_code']; ?>";
    function openJoin(joinType){
        if(joinType=='host'){
            window.open('<?= base_url();?>cast?invitation='+jwtHost);
        }else if(joinType=='presenter'){
            window.open('<?= base_url();?>cast?invitation='+jwtPresenter);
        }else{
			window.open('<?= base_url();?>cast?invitation='+jwtAudience);
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
                     alt="Ckamal Webcast">

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
                            Webcast Topic
                        </label>

                        <input
                            type="text"
                            value="<?= $event['event_name']; ?>"
                            placeholder="e.g. annual-townhall-2026"
                            class="w-full rounded-xl border border-slate-300 px-5 py-3
                                   focus:ring-4 focus:ring-blue-100
                                   focus:border-[#2A83F8]
                                   outline-none" readOnly>

                    </div>

					<!-- Organization -->

                    <div>

                        <label class="block font-medium text-slate-700 mb-2">
                            Organization
                        </label>

                        <input
                            type="text"
                            value="<?= $event['organization']; ?>"
                            placeholder="e.g. annual-townhall-2026"
                            class="w-full rounded-xl border border-slate-300 px-5 py-3
                                   focus:ring-4 focus:ring-blue-100
                                   focus:border-[#2A83F8]
                                   outline-none" readOnly>

                    </div>

                    <div>

						<label class="block font-medium text-slate-700 mb-3">
							Join As
						</label>

						<div class="grid md:grid-cols-3 gap-4">

							<!-- Host -->

							<button
								type="button"
								onclick="openJoin('host')"
								class="rounded-2xl border-2 border-blue-200 bg-blue-50 hover:bg-blue-100 hover:border-blue-500 transition p-6 text-center group">

								<div class="text-4xl mb-3">
									🎙️
								</div>

								<div class="font-bold text-lg text-slate-800">
									Host
								</div>

								<div class="text-sm text-slate-500 mt-2">
									Manage webcast, recording, participants and streaming.
								</div>

							</button>

							<!-- Participant -->

							<button
								type="button"
								onclick="openJoin('presenter')"
								class="rounded-2xl border-2 border-orange-200 bg-orange-50 hover:bg-orange-100 hover:border-orange-500 transition p-6 text-center group">

								<div class="text-4xl mb-3">
									🎤
								</div>

								<div class="font-bold text-lg text-slate-800">
									Participant
								</div>

								<div class="text-sm text-slate-500 mt-2">
									Join with microphone and camera.
								</div>

							</button>

							<!-- Audience -->

							<button
								type="button"
								onclick="openJoin('audience')"
								class="rounded-2xl border-2 border-sky-200 bg-sky-50 hover:bg-sky-100 hover:border-sky-500 transition p-6 text-center group">

								<div class="text-4xl mb-3">
									👥
								</div>

								<div class="font-bold text-lg text-slate-800">
									Audience
								</div>

								<div class="text-sm text-slate-500 mt-2">
									Watch the webcast without participating.
								</div>

							</button>

						</div>

					</div>

                </div>

            </div>

        </div>

    </div>

</div>