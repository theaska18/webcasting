<div class="h-full w-full flex flex-col"><!-- Tabs -->
<div class="grid grid-cols-4 gap-1 p-2 bg-slate-950 border-b border-slate-800">

    

    <!-- Chat -->
    <button class="tab-btn flex items-center justify-center gap-1 rounded-lg py-2 text-xs font-medium text-slate-400 hover:bg-slate-800 hover:text-white transition" data-tab="message" >

		<svg xmlns="http://www.w3.org/2000/svg"
			class="h-4 w-4"
			fill="none"
			viewBox="0 0 24 24"
			stroke="currentColor"
			stroke-width="2">

			<path stroke-linecap="round"
				stroke-linejoin="round"
				d="M8 10h8M8 14h5m-9 7l2.5-2.5A2 2 0 004 17.5V5a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H8.5a2 2 0 00-1.4.6L5 21z"/>
		</svg>

		<span class="relative">
			Chat

			<span id="chatNotification"
				class="absolute -top-1.5 -right-2 w-2.5 h-2.5 rounded-full bg-red-500 border border-white hidden">
			</span>
		</span>

	</button>

    <!-- Poll -->
    <button
        class="tab-btn flex items-center justify-center gap-1 rounded-lg py-2 text-xs font-medium text-slate-400 hover:bg-slate-800 hover:text-white transition"
        data-tab="poll">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-4 w-4"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor"
             stroke-width="2">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M9 17v-6m4 6V7m4 10V4"/>

        </svg>

        <span>Poll</span>

    </button>
<?php if($isModerator==true){ ?>
    <!-- Analytics -->
    <button
        class="tab-btn flex items-center justify-center gap-1 rounded-lg py-2 text-xs font-medium text-slate-400 hover:bg-slate-800 hover:text-white transition"
        data-tab="analytics">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-4 w-4"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor"
             stroke-width="2">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M3 3v18h18M8 14l3-3 2 2 5-6"/>

        </svg>

        <span>Stats</span>

    </button>
	
	<!-- Participants -->
    <button
        class="tab-btn flex items-center justify-center gap-1 rounded-lg py-2 text-xs font-medium text-slate-400 hover:bg-slate-800 hover:text-white transition"
        data-tab="participants">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-4 w-4"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor"
             stroke-width="2">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M17 20h5V18a4 4 0 00-5.356-3.772M9 20H4V18a4 4 0 015.356-3.772M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 2a2 2 0 11-4 0 2 2 0 014 0zM7 9a2 2 0 11-4 0 2 2 0 014 0z"/>

        </svg>

        <span id="labelCountParticipantMenu">0</span>

    </button>
	<style>
		#labelCountParticipantMenu {
			display: inline-block;
		}

		#labelCountParticipantMenu.animate {
			animation: pop .3s ease;
		}

		@keyframes pop {
			0% {
				transform: scale(1);
			}
			50% {
				transform: scale(1.5);
				color: #3b82f6;
			}
			100% {
				transform: scale(1);
			}
		}
	</style>
<?php } ?>
</div>

<div class="flex-1 overflow-y-auto">

    <!-- MESSAGE -->

    <div id="message" class="tab-content h-full flex flex-col bg-slate-950 text-slate-200">

		<!-- Header -->
		<div class="flex items-center justify-between border-b border-slate-800 px-3 py-2">

			<div>
				<h3 class="text-sm font-semibold text-white">
					Live Messages
				</h3>

				<p class="text-[10px] text-slate-500">
					Public & Private Messages
				</p>
			</div>

			<!-- <span class="rounded-full bg-slate-800 px-2 py-1 text-[10px] text-slate-400">
				126
			</span> -->

		</div>
		<style>
			/* Chat */
			#listPooling, #listChatMessages {
				/* padding-right: 4px; */
			}

			#listPooling::-webkit-scrollbar , #listChatMessages::-webkit-scrollbar {
				width: 8px;
			}

			#listPooling::-webkit-scrollbar-track, #listChatMessages::-webkit-scrollbar-track {
				margin: 8px 0;
				background: transparent;
			}

			#listPooling::-webkit-scrollbar-thumb, #listChatMessages::-webkit-scrollbar-thumb {
				background: linear-gradient(
					180deg,
					#475569,
					#334155
				);

				border-radius: 9999px;
				border: 2px solid transparent;
				background-clip: padding-box;
			}

			#listPooling::-webkit-scrollbar-thumb:hover, #listChatMessages::-webkit-scrollbar-thumb:hover {
				background: linear-gradient(
					180deg,
					#64748b,
					#475569
				);

				background-clip: padding-box;
			}
		</style>
		<!-- Messages -->
		<div id="listChatMessages" class="flex-1 overflow-y-auto space-y-3 px-3 py-3">


		</div>
		<button
			id="btnScrollBottom"
			onclick="scrollChatToBottom()"
			class="hidden absolute bottom-20 right-4 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 text-white shadow-lg transition hover:bg-blue-700">

			<svg xmlns="http://www.w3.org/2000/svg"
				class="h-5 w-5"
				fill="none"
				viewBox="0 0 24 24"
				stroke="currentColor"
				stroke-width="2">

				<path
					stroke-linecap="round"
					stroke-linejoin="round"
					d="M19 14l-7 7-7-7M12 21V3"/>

			</svg>

		</button>
		<script>
			const listChatMessages = document.getElementById("listChatMessages");
			const btnScrollBottom = document.getElementById("btnScrollBottom");

			listChatMessages.addEventListener("scroll", () => {

				const isBottom =
					listChatMessages.scrollTop + listChatMessages.clientHeight >= listChatMessages.scrollHeight - 10;

				if (isBottom) {
					btnScrollBottom.classList.add("hidden");
				} else {
					btnScrollBottom.classList.remove("hidden");
				}
				if (listChatMessages.scrollTop <= 0 && !isLoadMessage) {
					loadMessage();
				}
			});
			function scrollChatToBottom() {

				listChatMessages.scrollTo({
					top: listChatMessages.scrollHeight,
					behavior: "smooth"
				});

			}
		</script>
		<!-- Input -->
		<div class="border-t border-slate-800 p-3">

			<div class="flex items-end gap-2">
				
				<textarea
					rows="1"
					id="txtAreaMessage"
					class="flex-1 resize-none pretty-scrollbar overflow-y-auto rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-[11px] text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none"
					placeholder="Type a message..."></textarea>
				<script>
					const txtAreaMessage = document.getElementById("txtAreaMessage");

					const lineHeight = 20; // sesuaikan jika perlu
					const maxRows = 3;

					txtAreaMessage.addEventListener("input", autoResizeInputMessage);

					txtAreaMessage.addEventListener("keydown", function (e) {
						// Shift + Enter => baris baru
						if (e.key === "Enter" && e.shiftKey) {
							requestAnimationFrame(() => {
								autoResizeInputMessage();

								// Scroll ke paling bawah
								txtAreaMessage.scrollTop = txtAreaMessage.scrollHeight;
							});
							return;
						}

						// Enter => kirim
						if (e.key === "Enter") {
							e.preventDefault();
							const message = txtAreaMessage.value.trim();
							if (message.length === 0) return;
							sendMessage();
						}
					});
					function autoResizeInputMessage() {
						const lines = txtAreaMessage.value.split("\n").length;
						txtAreaMessage.rows = Math.min(lines, 3);
					}
				</script>
				<button onclick="sendMessage()"
					class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-600 text-white hover:bg-blue-700">

					<svg xmlns="http://www.w3.org/2000/svg"
						class="h-4 w-4"
						fill="none"
						viewBox="0 0 24 24"
						stroke="currentColor"
						stroke-width="2">

						<path stroke-linecap="round"
							stroke-linejoin="round"
							d="M22 2L11 13"/>

						<path stroke-linecap="round"
							stroke-linejoin="round"
							d="M22 2L15 22L11 13L2 9L22 2"/>

					</svg>

				</button>

			</div>

		</div>

	</div>

    <!-- POLL -->

    <div id="poll" class="tab-content hidden h-full flex flex-col bg-slate-950 text-slate-200">

		<!-- Header -->
		<div class="flex items-center justify-between border-b border-slate-800 px-3 py-2">

			<div>
				<h3 class="text-sm font-semibold text-white">
					Polls
				</h3>

				<p class="text-[10px] text-slate-500">
					Audience Voting
				</p>
			</div>
<?php if($isModerator){ ?>
			<button onclick="openPollModal()"
				class="rounded-md bg-green-600 px-2 py-1 text-[10px] font-medium text-white hover:bg-green-700">
				+ Poll
			</button>
			<script>

				function openPollModal() {

					const modal = document.getElementById('pollModal');

					modal.classList.remove('hidden');
					modal.classList.add('flex');

					document.getElementById('pollQuestion').focus();
				}
				function closePollModal() {

					const modal = document.getElementById('pollModal');

					modal.classList.add('hidden');
					modal.classList.remove('flex');
				}


				function addPollOption() {

					const container = document.getElementById('pollOptions');

					const count = container.querySelectorAll('.poll-option').length + 1;

					const wrapper = document.createElement('div');

					wrapper.className = 'flex items-center gap-2';

					wrapper.innerHTML = `
						<input
							type="text"
							placeholder="Option ${count}"
							class="poll-option flex-1 rounded-lg border border-slate-700
								bg-slate-950 px-4 py-2.5 text-sm text-white
								placeholder-slate-500 outline-none
								focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
						>

						<button
							onclick="this.parentElement.remove()"
							class="rounded-lg p-2 text-slate-500
								hover:bg-slate-800 hover:text-red-400"
						>
							✕
						</button>
					`;

					container.appendChild(wrapper);
				}


				function createPoll() {
					showPrompt(
					"Save Poll",
					"Are you sure create new poll?",
					() => {
						const question =
						document.getElementById('pollQuestion').value.trim();

						const options = [...document.querySelectorAll('.poll-option')]
							.map(input => input.value.trim())
							.filter(value => value !== '');

						const allowMultiple =
							document.getElementById('allowMultiple').checked;
						const alloInputOther =
							document.getElementById('alloInputOther').checked;


						if (!question) {
							toast("Please enter a question.", "warning");
							return;
						}

						if (options.length < 2) {
							toast("Please add at least 2 options.", "warning");
							alert('Please add at least 2 options.');
							return;
						}


						const poll = {
							invitation: '<?= $eventData->invitation_code; ?>',
							question: question,
							options: options,
							allowMultiple: allowMultiple,
							allowInputOther: alloInputOther
						};


						console.log('Poll:', poll);

						$.ajax({
							url: "<?= base_url() ; ?>cast/createpoll",
							type: "POST",
							dataType: "json",
							data: poll,
							success: function(response){
								toast("Polling Created.", "success");
								closePollModal();
							},
							error: function(xhr, status, error){

							}
						});

						
					});
					
				}
			</script>
		
<?php } ?>
		</div>
		<!-- Poll List -->
		<div id="listPooling" class="flex-1 overflow-y-auto p-3">


			<!-- Moderator Poll -->
			<div
				id="moderatorPoll"
				class="w-full mb-3 max-w-full rounded-xl border border-slate-700 bg-slate-900 p-4"
			>

				<!-- Header -->
				<div class="mb-4">

					<div class="flex items-start justify-between gap-2">

						<div class="min-w-0 flex-1">

							<div class="flex items-center gap-1.5">

								<span class="text-base flex-shrink-0">📊</span>

								<h3 class="truncate text-sm font-semibold text-white">
									Live Poll
								</h3>

								<span
									class="flex-shrink-0 rounded-full bg-emerald-500/10
										px-1.5 py-0.5 text-[9px] font-semibold
										text-emerald-400"
								>
									LIVE
								</span>

							</div>

							<p class="mt-1 text-[10px] text-slate-500">
								27 participants voted
							</p>

						</div>


						<!-- Close -->
						<button
							class="flex-shrink-0 rounded-lg border border-red-500/30
								bg-red-500/10 px-2 py-1 text-[10px]
								font-semibold text-red-400
								hover:bg-red-500/20"
						>
							Close
						</button>

					</div>

				</div>


				<!-- Question -->
				<div class="mb-4">

					<div class="break-words text-xs font-medium leading-5 text-white">
						What topic should we discuss next?
					</div>

				</div>


				<!-- Results -->
				<div class="space-y-3">

					<!-- Option -->
					<div>

						<div class="mb-1 flex items-center justify-between gap-2 text-[10px]">

							<span class="min-w-0 truncate text-slate-300">
								WebRTC
							</span>

							<span class="flex-shrink-0 font-semibold text-white">
								48%
							</span>

						</div>

						<div class="h-1.5 w-full overflow-hidden rounded-full bg-slate-800">

							<div
								class="h-full rounded-full bg-blue-500"
								style="width: 48%"
							></div>

						</div>

						<div class="mt-1 text-[9px] text-slate-500">
							13 votes
						</div>

					</div>


					<!-- Option -->
					<div>

						<div class="mb-1 flex items-center justify-between gap-2 text-[10px]">

							<span class="min-w-0 truncate text-slate-300">
								Jitsi
							</span>

							<span class="flex-shrink-0 font-semibold text-white">
								30%
							</span>

						</div>

						<div class="h-1.5 w-full overflow-hidden rounded-full bg-slate-800">

							<div
								class="h-full rounded-full bg-blue-500"
								style="width: 30%"
							></div>

						</div>

						<div class="mt-1 text-[9px] text-slate-500">
							8 votes
						</div>

					</div>


					<!-- Option -->
					<div>

						<div class="mb-1 flex items-center justify-between gap-2 text-[10px]">

							<span class="min-w-0 truncate text-slate-300">
								Streaming
							</span>

							<span class="flex-shrink-0 font-semibold text-white">
								22%
							</span>

						</div>

						<div class="h-1.5 w-full overflow-hidden rounded-full bg-slate-800">

							<div
								class="h-full rounded-full bg-blue-500"
								style="width: 22%"
							></div>

						</div>

						<div class="mt-1 text-[9px] text-slate-500">
							6 votes
						</div>

					</div>

				</div>


				<!-- Footer -->
				<div
					class="mt-4 flex items-center justify-between
						border-t border-slate-800 pt-3"
				>

					<span class="text-[9px] text-slate-500">
						Total votes
					</span>

					<span class="text-xs font-bold text-white">
						27
					</span>

				</div>

			</div>
			<!-- Participant Poll -->
			<div
				id="participantPoll"
				class="w-full mb-3 max-w-full rounded-xl border border-slate-700 bg-slate-900 p-4"
			>

				<!-- Header -->
				<div class="mb-4">

					<div class="flex items-center gap-1.5">

						<span class="flex-shrink-0 text-base">
							📊
						</span>

						<span
							class="text-[10px] font-semibold uppercase
								tracking-wide text-blue-400"
						>
							Live Poll
						</span>

					</div>

				</div>


				<!-- Question -->
				<div class="mb-4">

					<h3
						class="break-words text-xs font-semibold
							leading-5 text-white"
					>
						What topic should we discuss next?
					</h3>

				</div>


				<!-- Options -->
				<div class="space-y-2">

					<!-- Option 1 -->
					<label
						class="group flex w-full cursor-pointer items-center gap-2
							rounded-lg border border-slate-700 bg-slate-950 p-2.5
							transition hover:border-blue-500/50
							hover:bg-slate-800"
					>

						<input
							type="radio"
							name="poll"
							value="webrtc"
							class="h-3.5 w-3.5 flex-shrink-0 border-slate-600
								bg-slate-800 text-blue-600
								focus:ring-blue-500"
						>

						<span
							class="min-w-0 truncate text-xs text-slate-300"
						>
							WebRTC
						</span>

					</label>


					<!-- Option 2 -->
					<label
						class="group flex w-full cursor-pointer items-center gap-2
							rounded-lg border border-slate-700 bg-slate-950 p-2.5
							transition hover:border-blue-500/50
							hover:bg-slate-800"
					>

						<input
							type="radio"
							name="poll"
							value="jitsi"
							class="h-3.5 w-3.5 flex-shrink-0 border-slate-600
								bg-slate-800 text-blue-600
								focus:ring-blue-500"
						>

						<span
							class="min-w-0 truncate text-xs text-slate-300"
						>
							Jitsi
						</span>

					</label>


					<!-- Option 3 -->
					<label
						class="group flex w-full cursor-pointer items-center gap-2
							rounded-lg border border-slate-700 bg-slate-950 p-2.5
							transition hover:border-blue-500/50
							hover:bg-slate-800"
					>

						<input
							type="radio"
							name="poll"
							value="streaming"
							class="h-3.5 w-3.5 flex-shrink-0 border-slate-600
								bg-slate-800 text-blue-600
								focus:ring-blue-500"
						>

						<span
							class="min-w-0 truncate text-xs text-slate-300"
						>
							Streaming
						</span>

					</label>

				</div>


				<!-- Vote -->
				<button
					onclick="submitVote()"
					class="mt-4 w-full rounded-lg bg-blue-600 px-3 py-2
						text-xs font-semibold text-white transition
						hover:bg-blue-500"
				>
					Vote
				</button>

			</div>
			<div
				id="participantPollResult"
				class="w-full mb-3 max-w-full rounded-xl border border-slate-700 bg-slate-900 p-4"
			>

				<!-- Header -->
				<div class="mb-4">

					<div class="flex items-center gap-1.5">

						<span class="flex-shrink-0 text-base">
							📊
						</span>

						<span
							class="text-[10px] font-semibold uppercase
								tracking-wide text-emerald-400"
						>
							Poll Results
						</span>

					</div>

					<!-- Question -->
					<h3
						class="mt-2 break-words text-xs font-semibold
							leading-5 text-white"
					>
						What topic should we discuss next?
					</h3>

				</div>


				<!-- Results -->
				<div class="space-y-3">

					<!-- Result 1 -->
					<div>

						<div
							class="mb-1 flex items-center justify-between
								gap-2 text-[10px]"
						>

							<span class="min-w-0 truncate text-slate-300">
								WebRTC
							</span>

							<span class="flex-shrink-0 font-semibold text-white">
								48%
							</span>

						</div>

						<div
							class="h-1.5 w-full overflow-hidden rounded-full
								bg-slate-800"
						>

							<div
								class="h-full rounded-full bg-blue-500"
								style="width: 48%"
							></div>

						</div>

					</div>


					<!-- Result 2 -->
					<div>

						<div
							class="mb-1 flex items-center justify-between
								gap-2 text-[10px]"
						>

							<span class="min-w-0 truncate text-slate-300">
								Jitsi
							</span>

							<span class="flex-shrink-0 font-semibold text-white">
								30%
							</span>

						</div>

						<div
							class="h-1.5 w-full overflow-hidden rounded-full
								bg-slate-800"
						>

							<div
								class="h-full rounded-full bg-blue-500"
								style="width: 30%"
							></div>

						</div>

					</div>


					<!-- Result 3 -->
					<div>

						<div
							class="mb-1 flex items-center justify-between
								gap-2 text-[10px]"
						>

							<span class="min-w-0 truncate text-slate-300">
								Streaming
							</span>

							<span class="flex-shrink-0 font-semibold text-white">
								22%
							</span>

						</div>

						<div
							class="h-1.5 w-full overflow-hidden rounded-full
								bg-slate-800"
						>

							<div
								class="h-full rounded-full bg-blue-500"
								style="width: 22%"
							></div>

						</div>

					</div>

				</div>


				<!-- Vote Status -->
				<div
					class="mt-4 border-t border-slate-800 pt-3 text-center"
				>

					<span class="text-[9px] text-slate-500">
						✓ Your vote has been recorded
					</span>

				</div>

			</div>

		</div>

	</div>
    <!-- ANALYTICS -->

    <div id="analytics" class="tab-content hidden h-full flex flex-col bg-slate-950 text-slate-200">

		<!-- Header -->
		<div class="border-b border-slate-800 px-3 py-2">

			<h3 class="text-sm font-semibold text-white">
				Live Analytics
			</h3>

			<p class="text-[10px] text-slate-500">
				Real-time Statistics
			</p>

		</div>

		<div class="flex-1 overflow-y-auto p-3 space-y-3">

			<!-- Stats -->

			<div class="grid grid-cols-2 gap-2">

				<div class="rounded-lg bg-slate-900 p-3">

					<div class="text-[10px] text-slate-500">
						All Viewers
					</div>

					<div id="labelCountAllView" class="mt-1 text-lg font-bold text-white">
						0
					</div>

				</div>

				<div class="rounded-lg bg-slate-900 p-3">

					<div class="text-[10px] text-slate-500">
						Paricipant
					</div>

					<div  id="labelCountParticipantView" class="mt-1 text-lg font-bold text-emerald-400">
						0
					</div>

				</div>
			</div>

			<!-- Stream Health -->

			<div class="rounded-lg bg-slate-900 p-3">

				<div class="mb-3 text-xs font-semibold text-white">
					Stream Health
				</div>

				<div class="space-y-2 text-[11px]">

					<div class="flex justify-between">
						<span class="text-slate-400">CPU</span>
						<span id="labelHealthCpu">0%</span>
					</div>

					<div class="flex justify-between">
						<span class="text-slate-400">Memory</span>
						<span id="labelHealthMemory">Loading ...</span>
					</div>

				</div>

			</div>

		</div>

	</div>
	<div id="participants" class="tab-content hidden h-full flex flex-col bg-slate-950 text-slate-200">

		<div class="flex items-center justify-between border-b border-slate-800 px-3 py-3">

			<div>

				<h3 class="text-sm font-semibold text-slate-100">
					Participants
				</h3>

				<p class="text-[10px] text-slate-500">
					Currently Connected
				</p>

			</div>

			<div class="flex items-center gap-2">

				<!-- Total Participant -->
				<span
					id="participantCountLabel"
					class="rounded-full bg-blue-600 px-2 py-1 text-[10px] font-semibold text-white">

					<?= count($userList); ?>

				</span>

				<!-- Invite -->
				<button
					class="flex h-7 w-7 items-center justify-center rounded-md bg-slate-800 text-slate-300 transition hover:bg-blue-600 hover:text-white"
					onclick="fatureDisable()"
					title="Invite Participant">

					<svg xmlns="http://www.w3.org/2000/svg"
						class="h-4 w-4"
						fill="none"
						viewBox="0 0 24 24"
						stroke="currentColor"
						stroke-width="2">

						<path stroke-linecap="round"
							stroke-linejoin="round"
							d="M18 8a3 3 0 100-6 3 3 0 000 6zM6 14a4 4 0 018 0v1H6v-1zm12 3v-2m0 0h-2m2 0h2"/>

					</svg>

				</button>

			</div>

		</div>

		<!-- List -->
		<div
			id="participantList"
			class="flex-1 overflow-y-auto divide-y divide-slate-800">
			<?php
				for($i=0,$iLen=count($userList);$i<$iLen;$i++){
			?>
			<!-- Moderator -->
			<div class="flex items-center gap-2 px-3 py-2 hover:bg-slate-900 transition">

				<div class="relative">

					<div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-600 text-[11px] font-bold text-white">
						<?= getInitial($userList[$i]->user_name); ?>
					</div>

					<!-- <span class="absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-slate-950"></span> -->
					<span id="flag-online-user-list-<?= $userList[$i]->user_id; ?>" class="flag-online-user-list absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full bg-slate-500 ring-2 ring-slate-950"></span>

				</div>

				<div class="min-w-0 flex-1">
					<div class="flex items-center gap-2">

						<div class="truncate text-[11px] font-semibold text-slate-100">
							<?= $userList[$i]->user_name; ?>
						</div>

						<span id="labelBannedUser<?= $userList[$i]->user_id; ?>" class="rounded bg-red-600 px-1.5 py-0.5 text-[8px] font-bold uppercase tracking-wide text-white <?= $userList[$i]->ban_flag==false?'hidden':''; ?>">
							BANNED
						</span>

					</div>

					<div class="text-[10px] <?= $userList[$i]->role=='moderator'?'text-blue-400':($userList[$i]->role=='participant'?'text-emerald-400':'text-slate-400') ?>">
						<?= $userList[$i]->role=='moderator'?'Moderator':($userList[$i]->role=='participant'?'Presenter':'Audience') ?>
					</div>

				</div>
				<?php if($userList[$i]->role!='moderator'){ ?>
				<!-- Menu -->
				<div class="relative">

					<button onclick="toggleParticipantMenu(this)"
							class="rounded-md p-1.5 text-slate-400 transition hover:bg-slate-800 hover:text-white">

						<svg xmlns="http://www.w3.org/2000/svg"
							class="h-5 w-5"
							fill="none"
							viewBox="0 0 24 24"
							stroke="currentColor"
							stroke-width="2">

							<circle cx="12" cy="5" r="1.5"/>
							<circle cx="12" cy="12" r="1.5"/>
							<circle cx="12" cy="19" r="1.5"/>

						</svg>

					</button>
					
					<!-- Dropdown -->
					<div class="participant-menu hidden absolute right-0 top-10 z-50 w-52 overflow-hidden rounded-lg border border-slate-700 bg-slate-800 shadow-xl">
						<?php if($userList[$i]->role=='participant'){ ?>
						<button id="btnRequestShareScreenUser<?= $userList[$i]->user_id; ?>" onclick="requestSharedScreen('<?= $userList[$i]->user_id; ?>')" class="flex w-full items-center gap-3 px-4 py-2 text-left text-sm text-slate-200 hover:bg-slate-700">
							<svg xmlns="http://www.w3.org/2000/svg"
								class="h-4 w-4"
								fill="none"
								viewBox="0 0 24 24"
								stroke="currentColor"
								stroke-width="2">

								<rect x="3" y="4" width="18" height="13" rx="2"
									stroke-linecap="round"
									stroke-linejoin="round"/>

								<path stroke-linecap="round"
									stroke-linejoin="round"
									d="M8 21h8M12 17v4"/>

							</svg>
							<span>Request Share Screen</span>

						</button>
						
						<?php } ?>
						<button id="btnBannedUser<?= $userList[$i]->user_id; ?>" onclick="bannedUser('<?= $userList[$i]->user_id; ?>')" class="flex w-full items-center gap-3 px-4 py-2 text-left text-sm text-red-400 hover:bg-red-600 hover:text-white <?= $userList[$i]->ban_flag==false?'':'hidden'; ?>">

							🚫 <span>Banned</span>

						</button>
						<button id="btnUnBannedUser<?= $userList[$i]->user_id; ?>" onclick="unbannedUser('<?= $userList[$i]->user_id; ?>')" class="flex w-full items-center gap-3 px-4 py-2 text-left text-sm text-green-400 hover:bg-green-600 hover:text-white <?= $userList[$i]->ban_flag==false?'hidden':''; ?>">

							<svg xmlns="http://www.w3.org/2000/svg" title="UnBanned" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

								<path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>

								<circle cx="8.5" cy="7" r="4"></circle>

								<path stroke-linecap="round" stroke-linejoin="round" d="M16 11l2 2 4-4"></path>

							</svg> <span>UnBanned</span>

						</button>

					</div>

				</div>
				<?php }else{ ?>
				<button
					disabled
					class="rounded bg-slate-800 px-2 py-1 text-[10px] text-slate-500 cursor-not-allowed">
					Host
				</button>
				<?php } ?>
			</div>
			<?php
				}
			?>
			

		</div>
		<script>
			function requestSharedScreen(userId){
				showPrompt(
					"Share Screen",
					"Are you sure you want to Request Share Screen?",
					() => {
						ws.send(JSON.stringify({
							action: "REQUEST_SHARE_SCREEN",
							userId:userId
						}));
					}
				);
			}
		</script>
	</div>
</div>
<script>
	function toggleParticipantMenu(button) {

    const menu = button.nextElementSibling;

    // tutup menu participant lain
    document.querySelectorAll('.participant-menu').forEach(item => {
        if (item !== menu) {
            item.classList.add('hidden');
        }
    });

    menu.classList.toggle('hidden');
}

// klik di luar menu
document.addEventListener('click', function (e) {

    if (!e.target.closest('.relative')) {
        document.querySelectorAll('.participant-menu').forEach(item => {
            item.classList.add('hidden');
        });
    }

});
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
		if(this.dataset.tab=='message'){
			$('#chatNotification').addClass('hidden');
		}
        this.classList.add('border-blue-600','text-blue-600','font-semibold');

    });

});
</script>
</div>