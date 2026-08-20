<script>
	var api=null;
	var actionStream=false;
	var allowClose=false;
	var isBroadcast=false;
	var cancelClose=false;
	var videoJsPlayer=null;
	var isAutoJoin=false;
	window.addEventListener("beforeunload", function (e) {
		if(allowClose==false){
			e.preventDefault();
			e.returnValue = "";
		}
		<?php if($isModerator){ ?>
		ws.send(JSON.stringify({
			action: "MODERATOR_LEFT"
		}));
		if(isBroadcast){
			api.executeCommand('stopRecording', 'stream');
		}
		<?php } ?>
		ajaxLeft();
	});
</script>
<div class="flex items-center justify-between h-20">
    <button id="menuButtonLeft" class="md:hidden p-2 pl-5 rounded-lg hover:bg-slate-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>
    <!-- Logo -->
    <a href="#" class="flex items-center gap-3 flex-shrink-0 ml-2">
        <img src="<?= base_url(); ?>assets/images/logo1.png" class="w-10 h-10" alt="Logo">
        <img src="<?= base_url(); ?>assets/images/logo_title.png" class="h-9 hidden md:block" alt="Ckamal Webcast">
		<?php if($isModerator==true){ ?>
		<div id="streamStatusCard"
     class="inline-flex items-center gap-2 rounded-lg border border-red-200 bg-red-50 px-3 py-2 transition-all duration-300">

    <span class="relative flex h-2.5 w-2.5">

        <span id="pointStatusStream1"
              class="absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75 animate-ping">
        </span>

        <span id="pointStatusStream2"
              class="relative inline-flex h-2.5 w-2.5 rounded-full bg-red-500">
        </span>

    </span>

    <span class="text-xs text-slate-500">
        Stream
    </span>

    <span id="labelStatusStream1"
          class="text-xs font-bold text-red-600">
        Offline
    </span>

</div>
		<?php } ?>
    </a>
    <!-- Right Action -->
    <div class="hidden xl:flex items-center gap-2">
        <!-- Status -->
        <!-- Right Control Bar -->
        <div class="hidden xl:flex items-center gap-3">
            <!-- Divider -->
            <div class="h-8 w-px bg-slate-200"></div>
<?php
    if($isModerator){
?>
            <script>
                function startStream() {
                showPrompt(
                        "Start Stream",
                        "Are you sure you want to start broadcasting?",
                        () => {
                            console.log("START STREAM");
							<?php if($isModerator==true){ ?>
							try {
								api.executeCommand('startRecording', {
									mode: 'stream',
									rtmpStreamKey: 'rtmp://nginx-rtmp/stream/<?= $eventData->event_code; ?>'
								});

								console.log('Streaming started');
							} catch (e) {
								console.error('Failed to start streaming', e);
							}
							actionStream=true;
							$('#btnStartingStreamDesktop').removeClass('hidden');
							$('#btnStartStreamDesktop').addClass('hidden');
							$('#btnStartingStreamMobile').removeClass('hidden');
							$('#btnStartStreamMobile').addClass('hidden');
							<?php } ?>
                        }
                    );
                }
            </script>
            <div class="inline-flex overflow-hidden rounded-lg border border-slate-300 shadow-sm">
				<button
					disabled
					id="btnStartingStreamDesktop"
					class="hidden inline-flex h-8 items-center gap-2 border-slate-300 bg-slate-400 px-2.5 text-xs font-semibold text-white cursor-wait">

					<!-- Loading Spinner -->
					<svg
						class="w-3 h-3 animate-spin"
						xmlns="http://www.w3.org/2000/svg"
						fill="none"
						viewBox="0 0 24 24">

						<circle
							class="opacity-25"
							cx="12"
							cy="12"
							r="10"
							stroke="currentColor"
							stroke-width="4">
						</circle>

						<path
							class="opacity-90"
							fill="currentColor"
							d="M12 2a10 10 0 0110 10h-4a6 6 0 00-6-6V2z">
						</path>

					</svg>

					Starting...

				</button>
				<button
					disabled
					id="btnStoppingStreamDesktop"
					class="hidden inline-flex h-8 items-center gap-2 border-slate-300 bg-slate-400 px-2.5 text-xs font-semibold text-white cursor-wait">

					<!-- Loading Spinner -->
					<svg
						class="w-3 h-3 animate-spin"
						xmlns="http://www.w3.org/2000/svg"
						fill="none"
						viewBox="0 0 24 24">

						<circle
							class="opacity-25"
							cx="12"
							cy="12"
							r="10"
							stroke="currentColor"
							stroke-width="4">
						</circle>

						<path
							class="opacity-90"
							fill="currentColor"
							d="M12 2a10 10 0 0110 10h-4a6 6 0 00-6-6V2z">
						</path>

					</svg>

					Stopping...

				</button>
				<!-- Start Stream -->
				<button
					onclick="startStream()"
					id="btnStartStreamDesktop"
					class="inline-flex h-8 items-center gap-2 border-r border-slate-300 bg-blue-600 hover:bg-blue-700 px-3 text-xs font-semibold text-white transition">

					<svg xmlns="http://www.w3.org/2000/svg"
						class="w-3 h-3"
						fill="currentColor"
						viewBox="0 0 20 20">
						<path d="M6 4l10 6-10 6V4z"/>
					</svg>

					Start Stream

				</button>
				
				<script> 
					function stopStream() { 
						showPrompt( "Stop Stream", "Are you sure you want to end the broadcast?", () => { 
							console.log("START STREAM"); 
							<?php if($isModerator==true){ ?> 
							api.executeCommand('stopRecording', 'stream'); 
							actionStream=true;
							$('#btnStoppingStreamDesktop').removeClass('hidden');
							$('#btnStopStreamDesktop').addClass('hidden');
							$('#btnStoppingStreamMobile').removeClass('hidden');
							$('#btnStopStreamMobile').addClass('hidden');
							<?php } ?> 
						}); 
					} 
				</script>
				<!-- Stop Stream -->
				<button
					onclick="stopStream()"
					id="btnStopStreamDesktop"
					class="hidden inline-flex h-8 items-center gap-2 border-r border-slate-300 bg-red-600 hover:bg-red-700 px-3 text-xs font-semibold text-white transition">

					<svg xmlns="http://www.w3.org/2000/svg"
						class="w-3 h-3"
						fill="currentColor"
						viewBox="0 0 20 20">
						<path d="M5 5h10v10H5z"/>
					</svg>

					Stop Stream

				</button>

				<!-- Start Recording -->
				<button
					id="btnRecordingDesktop"
					disabled
					class="inline-flex h-8 items-center gap-2 border-r border-slate-300 bg-slate-400 px-3 text-xs font-semibold text-white opacity-60 cursor-not-allowed transition">

					<span class="w-2 h-2 rounded-full bg-white"></span>

					Start Recording

				</button>

				<!-- Stop Recording -->
				<button
					id="btnStopRecordingDesktop"
					class="hidden inline-flex h-8 items-center gap-2 border-r border-slate-300 bg-orange-50 hover:bg-orange-100 px-3 text-xs font-semibold text-orange-700 transition">

					<svg xmlns="http://www.w3.org/2000/svg"
						class="w-3 h-3"
						fill="currentColor"
						viewBox="0 0 20 20">
						<path d="M5 5h10v10H5z"/>
					</svg>

					Stop Recording

				</button>
				<script> function endCast() { showPrompt( "End Cast", "Are you sure you want to End Cast?", () => { console.log("End Cast"); allowClose=true; window.close(); } ); } </script>
				<!-- End Cast -->
				<button
					onclick="endCast()"
					class="inline-flex h-8 items-center gap-2 bg-red-600 hover:bg-red-700 px-3 text-xs font-semibold text-white transition">

					<svg xmlns="http://www.w3.org/2000/svg"
						class="w-3 h-3"
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
<?php
    }else{
?>
            <script>
                function leftCast() {
                showPrompt(
                        "Left Cast",
                        "Are you sure you want to Left Cast?",
                        () => {
                            console.log("End Cast");
							allowClose=true;
                            window.close();
                        }
                    );
                }
            </script>
            <!-- End Cast -->
            <button  onclick="leftCast()"
                class="flex h-8 items-center gap-2 rounded-xl bg-red-600 hover:bg-red-700 px-2.5 py-2.5 text-white text-xs font-semibold shadow-lg transition">

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

                Left Cast

            </button>

        
<?php
    }
	function getInitial($name){
		$words = preg_split('/\s+/', trim($name));
		$initial = '';

		foreach ($words as $word) {
			if ($word !== '') {
				$initial .= strtoupper(substr($word, 0, 1));
			}

			if (strlen($initial) >= 2) {
				break;
			}
		}

		return $initial;
	}
?>
</div>
        <!-- User -->

        <div class="ml-3 flex items-center gap-3 border-l pl-4 mr-2">

            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">

                <?= getInitial($eventData->user_name); ?>

            </div>

            <div class="hidden xl:block">

                <div class="text-sm font-semibold text-slate-800">

                    <?= nl2br(html_escape($eventData->user_name)); ?>

                </div>

                <div class="text-xs text-slate-500">

                    <?= nl2br(html_escape($isModerator?'Host':($eventData->participant_flag==true ? 'Presenter' :'Audience'))); ?>

                </div>

            </div>

        </div>

    </div>

    <!-- Mobile -->

	<button id="menuButton" class="relative xl:hidden p-2 rounded-lg pr-5 hover:bg-gray-100">

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

		<!-- Notification -->
		<span class="absolute top-1 right-2 flex h-3 w-3">

			<span class="absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75 animate-ping"></span>

			<span class="relative inline-flex h-3 w-3 rounded-full bg-red-500 border border-white"></span>

		</span>

	</button>
</div>

<!-- Mobile Menu -->

<div id="mobileMenu"
     class="hidden xl:hidden border-t bg-white">

    <div class="p-6  pt-3  space-y-3">
<?php
    if($isModerator){
?>
		<button
			disabled
			id="btnStartingStreamMobile"
			class=" inline-flex h-8 hidden items-center gap-2 rounded-lg border-slate-300 bg-slate-400 px-2.5 text-xs font-semibold text-white cursor-wait">
			<svg class="w-3 h-3 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
				<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
				<path class="opacity-90" fill="currentColor" d="M12 2a10 10 0 0110 10h-4a6 6 0 00-6-6V2z"></path>
			</svg>
			Starting...
		</button>
		<button disabled id="btnStoppingStreamMobile"
			class="hidden inline-flex h-8 items-center rounded-lg gap-2 border-slate-300 bg-slate-400 px-2.5 text-xs font-semibold text-white cursor-wait">
			<svg class="w-3 h-3 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
				<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
				<path class="opacity-90" fill="currentColor" d="M12 2a10 10 0 0110 10h-4a6 6 0 00-6-6V2z"></path>
			</svg>
			Stopping...
		</button>
        <button  onclick="startStream()"  id="btnStartStreamMobile" class="px-3 h-8 rounded-lg bg-green-600  text-xs text-white py-1 font-semibold">
            ▶ Start Stream
        </button>

        <button  onclick="stopStream()"  id="btnStopStreamMobile" class="px-3 h-8 hidden rounded-lg bg-red-600 text-xs text-white py-1 font-semibold">
            ■ Stop Stream
        </button>

        <button class="px-3 h-8 rounded-lg bg-orange-500 text-white py-1 font-semibold  text-xs">
            ⏺ Start Record
        </button>

        <button class="px-3 h-8 rounded-lg hidden bg-orange-700 text-white py-1 font-semibold  text-xs">
            ■ Stop Record
        </button>

        <button  onclick="endCast()" class="flex px-3 h-8 rounded-lg bg-red-600 text-white py-1 font-semibold  items-center text-xs">
            <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"/>
                </svg>End Cast
        </button>
<?php
    }else{
?>
        <button  onclick="leftCast()" class="px-3  h-8 rounded-lg bg-red-600 text-white py-1 font-semibold">
            Left Cast
        </button>
<?php
    }
?>
    </div>

</div>
<script>
const menuButton = document.getElementById('menuButton');
const menuButtonLeft = document.getElementById('menuButtonLeft');
const mobileMenu = document.getElementById('mobileMenu');
const sidebar = document.getElementById('sidebar');

menuButton.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
});
menuButtonLeft.addEventListener('click', () => {
    toggleSidebar();
});
</script>