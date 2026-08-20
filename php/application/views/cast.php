<?php
	$ci =& get_instance();
	$host = $ci->db
        ->where('event_id', $eventData->event_id)
        ->where('moderator_flag', 1)
        ->limit(1)
        ->get('cast_event_user')
        ->row();
	$readyJoinFlag = false;
	$isWaitingModerator=false;
	$isWaitingStreaming=false;
	if ($eventData->moderator_flag == 1) {
		$readyJoinFlag = true;
	} else {
		if($eventData->participant_flag==1){
			if ($eventData->moderator_join_flag==true) {
				$readyJoinFlag = true;
			}else{
				$isWaitingModerator=true;
			}
		}else{
			if (!empty($eventData->last_broadcast_on)) {
				$lastStream = strtotime($eventData->last_broadcast_on);
				if ($lastStream !== false && (time() - $lastStream) <= 6) {
					
					$readyJoinFlag = true;
				}else{
					$isWaitingStreaming=true;
				}
			}else{
				$isWaitingStreaming=true;
			}
		}
	}
	function format_duration($time){
		if (empty($time)) {
			return '-';
		}
		list($hour, $minute, $second) = explode(':', $time);
		$result = [];
		if ((int)$hour > 0) {
			$result[] = (int)$hour . ' Hour' . ((int)$hour > 1 ? 's' : '');
		}
		if ((int)$minute > 0) {
			$result[] = (int)$minute . ' Minute' . ((int)$minute > 1 ? 's' : '');
		}
		if ((int)$second > 0) {
			$result[] = (int)$second . ' Second' . ((int)$second > 1 ? 's' : '');
		}
		if (empty($result)) {
			return '0 Second';
		}
		return implode(' ', $result);
	}
?>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    const offsetMinutes = -new Date().getTimezoneOffset();
    const sign = offsetMinutes >= 0 ? "+" : "-";
    const hours = String(Math.floor(Math.abs(offsetMinutes) / 60)).padStart(2, "0");
    const minutes = String(Math.abs(offsetMinutes) % 60).padStart(2, "0");
    document.getElementById("userTimezone").textContent =`${timezone} (GMT ${sign}${hours}:${minutes})`;
	const dateElement = document.getElementById("eventDate");
    const timeElement = document.getElementById("eventTime");
    const start = new Date(dateElement.dataset.start);
    const end = new Date(timeElement.dataset.end);
    dateElement.textContent = start.toLocaleDateString(undefined, {
        day: "2-digit",
        month: "long",
        year: "numeric"
    });
    const timeOptions = {
        hour: "2-digit",
        minute: "2-digit",
        hour12: false
    };
    timeElement.textContent =`${start.toLocaleTimeString([], timeOptions)} - ${end.toLocaleTimeString([], timeOptions)}`;
});
var invitationCode='<?= $eventData->invitation_code; ?>';
let ws = null;
let reconnectTimer = null;
var isWaitingModerator=<?= $isWaitingModerator==true?'true':'false'; ?>;
const servers = [
    "wss://ws.ckamal.com/webcast/<?= $eventData->event_code; ?>/"
];
let serverIndex = 0;
function connect() {
    const url = servers[serverIndex];
    console.log("Connecting to:", url);
    ws = new WebSocket(url);
    ws.onopen = () => {
        console.log("Connected:", url);
        if (reconnectTimer) {
            clearTimeout(reconnectTimer);
            reconnectTimer = null;
        }
        serverIndex = 0; // reset ke server utama
        ws.send(JSON.stringify({
            action: "auth",
            token: '<?= $jwtWs; ?>',
        }));
    };
    ws.onmessage = (event) => {
		console.log(JSON.parse(event.data));
		var action=JSON.parse(event.data).action;
		if(action=='MODERATOR_JOIN' && isWaitingModerator==true){
			isWaitingModerator==false;
			<?php if($isParticipant==true){ ?>
				$('#noticeForParticipant').addClass('hidden');
				conferenceReady();
			<?php } ?>
		}else if(action=='MODERATOR_LEFT'){
			<?php if($isAudience==true || $isParticipant==true){ ?>
			eventStopStreamOrLeftHost(<?= $isParticipant?'true':'false'; ?>);
			<?php } ?>
		}else if(action=='START_STREAM'){
			<?php if($isAudience==true){ ?>
				$('#noticeForAudience').addClass('hidden');
				conferenceReady();
			<?php } ?>
		}else if(action=='STOP_STREAM'){
			<?php if($isAudience==true){ ?>
				eventStopStreamOrLeftHost(false);
			<?php } ?>
		}
        
    };
    ws.onerror = (error) => {
        console.error("WebSocket Error:", error);
        ws.close();
    };
    ws.onclose = (event) => {
        console.log(`Disconnected (${event.code})`);
        if (reconnectTimer) {
            return;
        }
        // Coba server berikutnya
        serverIndex++;
        if (serverIndex >= servers.length) {
            serverIndex = 0;
        }
        reconnectTimer = setTimeout(() => {
            reconnectTimer = null;
            connect();
        }, 1000);
    };
}
connect();
<?php if($isAudience==true || $isParticipant==true){ ?>
function eventStopStreamOrLeftHost(isParticipant){
	if(isParticipant){
		$('#noticeForParticipant').removeClass('hidden');
		cancelClose=true;
		api.executeCommand('hangup');
	}else{
		$('#noticeForAudience').removeClass('hidden');
		if(videoJsPlayer != null){
			videoJsPlayer.dispose();
			videoJsPlayer=null;
		}
	}
	$('#joinButtonWaiting').removeClass('hidden');
	$('#joinButton').removeClass('hidden');
	$('#joinButton').addClass('hidden');
	$('#joinStatusTop').removeClass('hidden');
	$('#joinStatusTopReady').removeClass('hidden');
	$('#joinStatusTopReady').addClass('hidden');
	$('#joinStatusBottom').removeClass('hidden');
	$('#joinStatusBottomReady').removeClass('hidden');
	$('#joinStatusBottomReady').addClass('hidden');
	$('#preJoinOverlay').removeClass('hidden');
}
<?php } ?>
function conferenceReady(){
	$('#joinButton').removeClass('hidden');
	$('#joinButtonWaiting').removeClass('hidden');
	$('#joinButtonWaiting').addClass('hidden');
	$('#joinStatusTopReady').removeClass('hidden');
	$('#joinStatusTop').removeClass('hidden');
	$('#joinStatusTop').addClass('hidden');
	$('#joinStatusBottomReady').removeClass('hidden');
	$('#joinStatusBottom').removeClass('hidden');
	$('#joinStatusBottom').addClass('hidden');
}
function readyJoinWebcast(){
	showPrompt(
		"Join Webcast",
		"Are you sure you want to Join Webcast?",
		() => {
			showLoading();
			joinWebcast();
		}
	);
}
function joinWebcast(){
	$.ajax({
		url: "<?= base_url() ; ?>cast/getaccess?invitation=<?= $eventData->invitation_code; ?>",
		type: "GET",
		dataType: "json",
		data: {
			invitation: '<?= $eventData->invitation_code; ?>'
		},
		success: function(response){
			document.getElementById("preJoinOverlay").classList.add("hidden");
			hideLoading();
			console.log("Response:", response);
			<?php if($isAudience==false){ ?>
			runConference(response.data.jwt);
			<?php }else{ ?>
			playLiveStreaming();
			<? } ?>
		},
		error: function(xhr, status, error){
			hideLoading();
			console.error("Status :", status);
			console.error("Error  :", error);
			console.error("Response :", xhr.responseText);
		}
	});
}
function startHeartbeat(){
	$.ajax({
		url: "<?= base_url() ; ?>cast/heartbeat",
		type: "GET",
		dataType: "json",
		data: {
			invitation: '<?= $eventData->invitation_code; ?>',
			<?php if($isModerator==true){ ?>broadcast:isBroadcast==true?'yes':'no',<?php } ?>
		},
		success: function(response){},
		error: function(xhr, status, error){
			hideLoading();
			console.error("Status :", status);
			console.error("Error  :", error);
			console.error("Response :", xhr.responseText);
		}
	});
}
function ajaxJoin(){
	$.ajax({
		url: "<?= base_url() ; ?>cast/join",
		type: "GET",
		dataType: "json",
		data: {
			invitation: '<?= $eventData->invitation_code; ?>',
		},
		success: function(response){},
		error: function(xhr, status, error){
			console.error("Status :", status);
			console.error("Error  :", error);
			console.error("Response :", xhr.responseText);
		}
	});
}
function ajaxLeft(){
	$.ajax({
		url: "<?= base_url() ; ?>cast/left",
		type: "GET",
		dataType: "json",
		data: {
			invitation: '<?= $eventData->invitation_code; ?>',
		},
		success: function(response){},
		error: function(xhr, status, error){
			console.error("Status :", status);
			console.error("Error  :", error);
			console.error("Response :", xhr.responseText);
		}
	});
}

function runConference(jwt){
	const domain = 'jitsi.ckamal.com';
          const options = {
            roomName: '<?= $eventData->event_code; ?>',
            jwt:jwt,
            parentNode: document.querySelector("#video-meet"),
            // noSsl: 'true',
            configOverwrite: {
				<?php if(!$isModerator){ ?>
				disabledSounds : [
					'LIVE_STREAMING_ON_SOUND',
					'LIVE_STREAMING_OFF_SOUND',
					'RECORDING_ON_SOUND',
					'RECORDING_OFF_SOUND'
				],
				<?php } ?>
              // pollCreationRequiresPermission: true,
                toolbarButtons: [
                     'camera',
      //  'chat',
       'closedcaptions',
      <?= $isModerator?"'desktop',":""; ?>
       'download',
      //  'embedmeeting',
       'etherpad',
      //  'feedback',
       'filmstrip',
      //  'fullscreen',
      //  'hangup',
       'help',
       'highlight',
      //  'invite',
       'linktosalesforce',
      //  'livestreaming',
       'microphone',
      //  'noisesuppression',
	  <?= $isModerator?"'participants-pane',":""; ?>
       
      //  'profile',
       'raisehand',
      //  'recording',
      //  'security',
      //  'select-background',
       'settings',
      //  'shareaudio',
      //  'sharedvideo',
      //  'shortcuts',
      //  'stats',
       'tileview',
       'toggle-camera',
    //    'videoquality',
       'whiteboard',
                ] // kosong = tidak ada tombol
            }
//           userInfo: {
//               displayName: '3065VideoTest2',
//               avatar:''
//             },
//             interfaceConfigOverwrite: {
//         SHOW_JITSI_WATERMARK: false,
//         SHOW_WATERMARK_FOR_GUESTS: false,
//         SHOW_PROMOTIONAL_CLOSE_PAGE: false,
//         DEFAULT_LOGO_URL: window.location.origin + "/assets/images/logo1.png",
//         DEFAULT_WELCOME_PAGE_LOGO_URL: window.location.origin + "/assets/images/logo1.png",
//     },
//             configOverwrite:{
//                 configOverwrite: {
//     disableInviteFunctions: true
// },
//             	disabledNotifications: ['transcribing.failed'],
//             	transcription:{
//             		disableClosedCaptions:false,
//             	}
//             },
          };
		//   allowClose=true;
        //                     window.close();
	api = new JitsiMeetExternalAPI(domain, options);
	api.addEventListener('videoConferenceJoined', () => {
		ajaxJoin();
		<?php if($isModerator){ ?>
		ws.send(JSON.stringify({
			action: "MODERATOR_JOIN"
		}));
		<?php } ?>
		setInterval(() => {
			startHeartbeat();
		}, 5000);
	});
	api.addEventListener('readyToClose', () => {
		if(cancelClose==false){
			allowClose=true;
			window.close();
		}else{
			 api.dispose();
			cancelClose=false;
		}
	});
	api.addListener('recordingStatusChanged', function (event) {
		if (event.on) {
			if(event.mode=='stream'){
				isBroadcast=true;
				<?php if($isModerator==true){ ?>
				$('#btnStartingStreamDesktop').addClass('hidden');
				$('#btnStartingStreamMobile').addClass('hidden');
				$('#btnStartStreamDesktop').addClass('hidden');
				$('#btnStartStreamMobile').addClass('hidden');
				$('#btnStopStreamDesktop').removeClass('hidden');
				$('#btnStopStreamMobile').removeClass('hidden');
				$('#labelStatusStream1').removeClass('text-red-600');
				$('#labelStatusStream1').addClass('text-green-600');
				$('#labelStatusStream1').html('Online');
				$('#pointStatusStream1').removeClass('bg-red-400');
				$('#pointStatusStream1').addClass('bg-green-400');
				$('#pointStatusStream2').removeClass('bg-red-500');
				$('#pointStatusStream2').addClass('bg-green-500');
				if(actionStream==true){
					actionStream=false;
					ws.send(JSON.stringify({
						action: "START_STREAM"
					}));
				}
				const btn = document.getElementById("btnRecordingDesktop");
				btn.disabled = false;

				btn.classList.remove(
					"bg-slate-400",
					"opacity-60",
					"cursor-not-allowed"
				);

				btn.classList.add(
					"bg-green-600",
					"hover:bg-green-700"
				);
				
				<?php } ?>
				
			}
		} else {
			if(event.mode=='stream'){
				isBroadcast=false;
				<?php if($isModerator==true){ ?>
				$('#btnStoppingStreamDesktop').addClass('hidden');
				$('#btnStoppingStreamMobile').addClass('hidden');
				$('#btnStartStreamDesktop').removeClass('hidden');
				$('#btnStartStreamMobile').removeClass('hidden');
				$('#btnStopStreamDesktop').addClass('hidden');
				$('#btnStopStreamMobile').addClass('hidden');
				$('#labelStatusStream1').removeClass('text-green-600');
				$('#labelStatusStream1').addClass('text-red-600');
				$('#labelStatusStream1').html('Offline');
				$('#pointStatusStream1').removeClass('bg-green-400');
				$('#pointStatusStream1').addClass('bg-red-400');
				$('#pointStatusStream2').removeClass('bg-green-500');
				$('#pointStatusStream2').addClass('bg-red-500');
				if(actionStream==true){
					actionStream=false;
					ws.send(JSON.stringify({
						action: "STOP_STREAM"
					}));
				}
				const btn = document.getElementById("btnRecordingDesktop");
				btn.disabled = true;
				btn.classList.remove("bg-green-600", "hover:bg-green-700");
				btn.classList.add(
					"bg-slate-400",
					"opacity-60",
					"cursor-not-allowed"
				);
				<?php } ?>
			}
		}
	});
}
</script>
<?php if(!$isAudience){ ?>
<style>
	#video-meet {
	height: 100%;
	width: 100%;
	}
</style>
<?php } ?>
<link href="https://vjs.zencdn.net/8.23.4/video-js.css" rel="stylesheet">
<script src='https://jitsi.ckamal.com/external_api.js'></script>
<div id="video-meet" ref="apiRef"></div>

<?php if($isAudience){ ?>
<video
    id="player"
    class="absolute top-1/2 -translate-y-1/2 left-0 video-js vjs-default-skin vjs-big-play-centered  w-full h-full"
    controls
    autoplay
    muted
    playsinline
></video>
<script src="https://vjs.zencdn.net/8.23.4/video.min.js"></script>
<script>
	
	function playLiveStreaming(){
		videoJsPlayer = videojs('player', {
			inactivityTimeout: 0,
			autoplay:true,
			muted:false,
			controls:true,
			preload:'auto',
			liveui:true,
			controlBar: {
				playToggle: false
			},
			html5:{
				vhs:{
					overrideNative:true,
					enableLowInitialPlaylist:true,
					smoothQualityChange:true,
					allowSeeksWithinUnsafeLiveWindow:true
				}
			}
		});
		videoJsPlayer.src({
			src:'https://live.ckamal.com/live/<?= $eventData->event_code; ?>.m3u8',
			type:'application/x-mpegURL'
		});
		videoJsPlayer.ready(function(){
			videoJsPlayer.play().catch(e=>{
				console.log(e);
			});
			videoJsPlayer.muted(false);
		});
		videoJsPlayer.on('error',function(){
			console.log("Reconnect...");
			setTimeout(loadLiveStream,3000);
		});
		
	}
	function loadLiveStream() {
		console.log("Reload stream...");
		videoJsPlayer.pause();
		videoJsPlayer.reset();
		videoJsPlayer.src({
			src: 'https://live.ckamal.com/live/<?= $eventData->event_code; ?>.m3u8?t=' + Date.now(),
			type: 'application/x-mpegURL'
		});
		videoJsPlayer.load();
		videoJsPlayer.play().catch(console.log);
	}
	setInterval(() => {
		if (videoJsPlayer != null && videoJsPlayer.readyState() < 2) {
			console.log("Stream not ready, reconnect...");
			loadLiveStream();
		}
	}, 3000);
</script>
<?php } ?>
<!-- =========================
     PRE JOIN OVERLAY
========================== -->
<div id="preJoinOverlay" class="fixed inset-0 z-[9999] bg-slate-950/70 backdrop-blur-md overflow-y-auto">
    <div class="min-h-full flex items-center justify-center lg:p-8">
        <div class="grid lg:grid-cols-5">
            <!-- ===================================================== -->
            <!-- LEFT -->
            <!-- ===================================================== -->
            <div class="lg:col-span-3 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950 text-white flex flex-col">
				<!-- Header -->
				<div class="flex items-center justify-between px-1 lg:px-10 py-6 bg-white border-b border-slate-200">
					<div class="flex items-center gap-4">
						<img src="<?= base_url(); ?>assets/images/logo1.png" class="w-14 h-14" alt="Logo">
						<img src="<?= base_url(); ?>assets/images/logo_title.png" class="h-10" alt="Logo Title">
					</div>
					<div class="flex items-center gap-3">
						<span id="joinStatusTopReady" class="<?=  (($isParticipant==true && $isWaitingModerator==true) || ($isAudience==true && $isWaitingStreaming==true))?'hidden':''; ?> inline-flex items-center gap-2 rounded-full bg-green-100 text-green-700 px-4 py-2 text-sm font-semibold truncate whitespace-nowrap">	
							<span class="w-2.5 h-2.5 rounded-full bg-green-500"></span>
							Ready to Join
						</span>
						<?php
							if($isParticipant==true && $isWaitingModerator==true){
						?>
						<span id="joinStatusTop" class="inline-flex items-center gap-2 rounded-full bg-red-100 text-red-700 px-4 py-2 text-sm font-semibold truncate whitespace-nowrap">
							<span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
							Waiting for Moderator
						</span>
						<?php
							}else if($isAudience==true && $isWaitingStreaming==true){
						?>
						<span id="joinStatusTop" class="inline-flex items-center gap-2 rounded-full bg-red-100 text-red-700 px-4 py-2 text-sm font-semibold truncate whitespace-nowrap">
							<span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
							Waiting for Streaming
						</span>
						<?php
							}
						?>
					</div>
				</div>
				<!-- Body -->
				<div class="flex-1 flex flex-col justify-center px-5 lg:px-12 py-12">
					<span class="inline-flex w-fit px-4 py-1 rounded-full bg-blue-600 text-sm font-semibold">
						LIVE WEBCAST
					</span>
					<h1 class="text-5xl font-bold mt-6 leading-tight">
						<?= nl2br(html_escape($eventData->event_name));?>
					</h1>
					<p class="text-slate-300 text-lg mt-6 leading-8 max-w-3xl">
						<?= nl2br(html_escape($eventData->event_desc)); ?>
					</p>
					<div class="grid grid-cols-2 xl:grid-cols-3 gap-5 mt-12">
						<div class="rounded-xl bg-white/5 border border-white/10 p-5">
							<div class="text-slate-400 text-sm">Organization</div>
							<div class="font-semibold mt-2">
								<?= nl2br(html_escape($eventData->organization)); ?>
							</div>
						</div>
						<div class="rounded-xl bg-white/5 border border-white/10 p-5">
							<div class="text-slate-400 text-sm">Organizer</div>
							<div class="font-semibold mt-2">
								CKamal Webcasting
							</div>
						</div>
						<div class="rounded-xl bg-white/5 border border-white/10 p-5">
							<div class="text-slate-400 text-sm">Language</div>
							<div class="font-semibold mt-2">
								English
							</div>
						</div>
						<div class="rounded-xl bg-white/5 border border-white/10 p-5">
							<div class="text-slate-400 text-sm">
								Timezone
							</div>
							<div class="font-semibold mt-2" id="userTimezone">
								Detecting...
							</div>
						</div>
						<div class="rounded-xl bg-white/5 border border-white/10 p-5">
							<div class="text-slate-400 text-sm">Duration</div>
							<div class="font-semibold mt-2">
								<?= format_duration($eventData->duration); ?>
							</div>
						</div>
						<div class="rounded-xl bg-white/5 border border-white/10 p-5">
							<div class="text-slate-400 text-sm">Status</div>
							<div class="mt-2 inline-flex items-center gap-2">
								<span id="joinStatusBottomReady" class="<?= (($isParticipant==true && $isWaitingModerator==true) || ($isAudience==true && $isWaitingStreaming==true))?'hidden':''; ?>">
									<span class="w-2.5 h-2.5 rounded-full bg-green-500"></span>
									<span class="font-semibold">
										Ready to Join
									</span>
								</span>
								<?php
									if($isParticipant==true && $isWaitingModerator==true){
								?>
								<span id="joinStatusBottom">
									<span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
									<span class="font-semibold">
										Waiting for Moderator
									</span>
								</span>
								<?php
									}else if($isAudience==true && $isWaitingStreaming==true){
								?>
								<span id="joinStatusBottom">
									<span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
									<span class="font-semibold">
										Waiting for Streaming
									</span>
								</span>
								<?php
									}
								?>
							</div>
						</div>
					</div>
					<!-- Features -->
					<div class="mt-12">
						<div class="text-lg font-semibold mb-5">
							Event Session Features
						</div>
						<div class="grid grid-cols-2 xl:grid-cols-3 gap-4">
							<?php if($eventData->record_allow==true){ ?>
							<div class="bg-white/5 rounded-xl p-4 border border-white/10">
								🎥 Recording Enabled
							</div>
							<?php } ?>
							<?php if($eventData->event_message_allow==true){ ?>
							<div class="bg-white/5 rounded-xl p-4 border border-white/10">
								💬 Live Chat
							</div>
							<?php } ?>
							<?php if($eventData->broadcast_allow==true){ ?>
							<div class="bg-white/5 rounded-xl p-4 border border-white/10">
								🌐 RTMP Streaming
							</div>
							<?php } ?>
							<div class="bg-white/5 rounded-xl p-4 border border-white/10">
								🔐 JWT Authentication
							</div>
							<?php if($eventData->event_pooling_allow==true){ ?>
							<div class="bg-white/5 rounded-xl p-4 border border-white/10">
								📊 Live Polling
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<!-- Footer -->
				<div class="border-t border-white/10 px-10 py-5 flex justify-between text-sm text-slate-400">
					<span>Powered by CKamal Webcasting Platform</span>
					<span>Version 1.0.0</span>
				</div>
			</div>
            <!-- ===================================================== -->
            <!-- RIGHT -->
            <!-- ===================================================== -->
            <div class="lg:col-span-2 p-8 bg-white">
                <h2 class="text-3xl font-bold text-slate-900">Welcome</h2>
                <p class="text-slate-500 mt-2">Please review the webcast information before joining.</p>
                <!-- Your Access -->
                <div class="mt-8 rounded-2xl border border-slate-200">
                    <div class="border-b p-5">
                        <h3 class="font-bold text-slate-900">Your Access</h3>
                    </div>
                    <div class="p-5 space-y-5">
                        <div class="flex justify-between">
                            <span class="text-slate-500">Name</span>
                            <span class="font-semibold"><?= nl2br(html_escape($eventData->user_name)); ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">
                                Role
                            </span>
                            <span class="font-semibold text-blue-600">
                                <?php
									if($isModerator){
										echo 'Moderator';
									}else if($eventData->participant_flag){
										echo 'Participant';
									}else{
										echo 'Audience';
									}
								?>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Event -->
                <div class="mt-6 rounded-2xl border border-slate-200">
                    <div class="border-b p-5">
                        <h3 class="font-bold text-slate-900">Event Information</h3>
					</div>
                    <div class="p-5 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-slate-500">Host</span>
                            <span class="font-semibold"><?= $host != null?$host->user_name:'not yet determined'; ?></span>
                        </div>
                        <?php
							$start = new DateTime($eventData->schedule_on, new DateTimeZone('UTC'));
							$end = clone $start;
							list($h, $m, $s) = explode(':', $eventData->duration);
							$end->add(new DateInterval("PT{$h}H{$m}M{$s}S"));
						?>
						<div class="flex justify-between">
							<span class="text-slate-500">Date</span>
							<span class="font-semibold" id="eventDate" data-start="<?= $start->format(DateTime::ATOM); ?>">Loading...</span>
						</div>
						<div class="flex justify-between">
							<span class="text-slate-500">Time</span>
							<span class="font-semibold" id="eventTime" data-start="<?= $start->format(DateTime::ATOM); ?>" data-end="<?= $end->format(DateTime::ATOM); ?>">Loading...</span>
						</div>
						<div class="mt-2 text-xs text-slate-500 text-right">
							<span>All dates and times are displayed in your local time zone.</span>
						</div>
                    </div>
                </div>
                <!-- Features -->
                <div class="mt-6 rounded-2xl border border-slate-200">
                    <div class="border-b p-5">
                        <h3 class="font-bold text-slate-900">Your Session Features</h3>
                    </div>
                   <div class="grid grid-cols-2 gap-3 p-5">
						<?php if($eventData->message_allow && $eventData->event_message_allow){ ?>
						<div class="rounded-lg bg-green-50 text-green-700 text-sm font-medium px-3 py-2">
							✓ Live Chat
						</div>
						<?php } ?>

						<?php if($eventData->pooling_allow && $eventData->event_pooling_allow){ ?>
						<div class="rounded-lg bg-green-50 text-green-700 text-sm font-medium px-3 py-2">
							✓ Live Polling
						</div>
						<?php } ?>
						<!-- Audience -->
						<?php if($eventData->participant_flag == 0 && $isModerator == 0){ ?>
						<div class="rounded-lg bg-green-50 text-green-700 text-sm font-medium px-3 py-2">
							✓ Watch Live Webcast
						</div>
						<div class="rounded-lg bg-green-50 text-green-700 text-sm font-medium px-3 py-2">
							✓ View Participant Conversations
						</div>
						<?php } ?>
						<!-- Participant -->
						<?php if($eventData->participant_flag == 1 && $isModerator == 0){ ?>
						<div class="rounded-lg bg-green-50 text-green-700 text-sm font-medium px-3 py-2">
							✓ Join Live Audio & Video
						</div>
						<div class="rounded-lg bg-green-50 text-green-700 text-sm font-medium px-3 py-2">
							✓ Speak with the Host/Moderator
						</div>
						<div class="rounded-lg bg-green-50 text-green-700 text-sm font-medium px-3 py-2">
							✓ View Participant Conversations
						</div>
						<?php } ?>
						<!-- Moderator -->
						<?php if($isModerator == 1){ ?>
						<div class="rounded-lg bg-green-50 text-green-700 text-sm font-medium px-3 py-2">
							✓ Manage the Webcast
						</div>

						<div class="rounded-lg bg-green-50 text-green-700 text-sm font-medium px-3 py-2">
							✓ Control Participants
						</div>
						<?php if($eventData->broadcast_allow == 1){ ?>
						<div class="rounded-lg bg-green-50 text-green-700 text-sm font-medium px-3 py-2">
							✓ Start & Stop Streaming
						</div>
						<?php }?>
						<?php if($eventData->record_allow == 1){ ?>
						<div class="rounded-lg bg-green-50 text-green-700 text-sm font-medium px-3 py-2">
							✓ Manage Recording
						</div>
						<?php }?>
						<?php if($eventData->event_message_allow == 1){ ?>
						<div class="rounded-lg bg-green-50 text-green-700 text-sm font-medium px-3 py-2">
							✓ Moderate Live Chat
						</div>
						<?php }?>
						<?php if($eventData->event_pooling_allow == 1){ ?>
						<div class="rounded-lg bg-green-50 text-green-700 text-sm font-medium px-3 py-2">
							✓ Launch Live Polls
						</div>
						<?php }?>
						<?php } ?>
					</div>
                </div>
                <!-- Button -->
				<script>
					function closeBeforeJoin() {
						showPrompt("Close Cast","Are you sure you want to Close Cast?",() => {
							allowClose=true;
							window.close();
						});
					}
				</script>
				<div id="noticeForAudience" class="mt-6 <?= $isAudience==true && $isWaitingStreaming==true?'':'hidden'; ?> rounded-xl bg-amber-50 border border-amber-200 p-4">
                    <div class="font-semibold text-amber-800">Notice</div>
					<div class="text-sm text-amber-700 mt-1 leading-6">
						The webcast is not yet available because the host or moderator has not started the live session. The <strong>Join Webcast</strong> button will become available automatically once the webcast begins.
					</div>
                </div>
				<div  id="noticeForParticipant" class="mt-6 <?= $isParticipant==true && $isWaitingModerator==true?'':'hidden'; ?> rounded-xl bg-amber-50 border border-amber-200 p-4">
                    <div class="font-semibold text-amber-800">Notice</div>
					<div class="text-sm text-amber-700 mt-1 leading-6">
						The webcast is not yet available because the host or moderator has not joined. The <strong>Join Webcast</strong> button will become available automatically once the Moderator joined.
					</div>
                </div>

                <div class="flex gap-3 mt-8">
					<button onclick="closeBeforeJoin()" class="flex-1 h-14 rounded-xl bg-slate-200 hover:bg-slate-300 font-semibold">Cancel</button>
					<button id="joinButton" onclick="readyJoinWebcast()" class="flex-1 <?= (($isParticipant==true && $isWaitingModerator==true) || ($isAudience==true && $isWaitingStreaming==true))?'hidden':''; ?> h-14 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">Join Webcast</button>
					<?php if($isParticipant==true){ ?>
					<button
						id="joinButtonWaiting" disabled
						class="flex-1 h-14 <?= $isWaitingModerator==true?'':'hidden'; ?> rounded-xl bg-amber-500 text-white font-semibold cursor-not-allowed flex items-center justify-center gap-3">
						<svg class="w-5 h-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
							<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
							<path class="opacity-90" fill="currentColor" d="M12 2a10 10 0 0110 10h-4a6 6 0 00-6-6V2z"></path>
						</svg>
						Waiting for Moderator...
					</button>
					<?php }else if($isAudience==true){ ?>
					<button id="joinButtonWaiting" disabled class="flex-1 h-14 <?= $isWaitingStreaming==true?'':'hidden'; ?> rounded-xl bg-amber-500 text-white font-semibold cursor-not-allowed flex items-center justify-center gap-3">
						<svg class="w-5 h-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
							<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
							<path class="opacity-90" fill="currentColor" d="M12 2a10 10 0 0110 10h-4a6 6 0 00-6-6V2z"></path>
						</svg>
						Waiting for Streaming...
					</button>
					<?php } ?>
				</div>
            </div>
        </div>
    </div>
</div>
<style>
#webcastTitle{
    position:absolute;
    z-index:1;

    display:flex;
    align-items:flex-start;
    gap:12px;

    color:white;
    pointer-events:none;
	top:1px;
    text-shadow:
        0 2px 6px rgba(0,0,0,.9);
}

#webcastTitle .accent{
    width:5px;
    height:50px;
    border-radius:999px;
    background:#2563eb;
}

#webcastTitle .title{
    font-size:24px;
    font-weight:700;
    line-height:1.15;
}

#webcastTitle .org{
    margin-top:4px;
    font-size:13px;
    font-weight:500;
    opacity:.9;
}
</style>

<div id="webcastTitle" class="mt-3 ml-3">

    <div class="accent"></div>

    <div>

        <div class="title">
            <?= html_escape($eventData->event_name); ?>
        </div>

        <div class="org">
            <?= html_escape($eventData->organization); ?>
        </div>

    </div>

</div>