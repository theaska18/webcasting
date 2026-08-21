<div class="h-full w-full flex flex-col"><!-- Tabs -->
<div class="grid grid-cols-4 gap-1 p-2 bg-slate-950 border-b border-slate-800">

    

    <!-- Chat -->
    <button
        class="tab-btn relative flex items-center justify-center gap-1 rounded-lg py-2 text-xs font-medium text-slate-400 hover:bg-slate-800 hover:text-white transition"
        data-tab="message">

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

        <span>Chat</span>

        <!-- <span class="absolute -top-1 -right-1 flex h-4 min-w-[16px] items-center justify-center rounded-full bg-red-500 px-1 text-[9px] font-bold text-white">
            5
        </span> -->

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

        <span>18</span>

    </button>
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
			#listChatMessages {
				/* padding-right: 4px; */
			}

			#listChatMessages::-webkit-scrollbar {
				width: 8px;
			}

			#listChatMessages::-webkit-scrollbar-track {
				margin: 8px 0;
				background: transparent;
			}

			#listChatMessages::-webkit-scrollbar-thumb {
				background: linear-gradient(
					180deg,
					#475569,
					#334155
				);

				border-radius: 9999px;
				border: 2px solid transparent;
				background-clip: padding-box;
			}

			#listChatMessages::-webkit-scrollbar-thumb:hover {
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
			<button
				class="rounded-md bg-green-600 px-2 py-1 text-[10px] font-medium text-white hover:bg-green-700">
				+ Poll
			</button>

		</div>
<?php } ?>
		<!-- Poll List -->
		<div class="flex-1 overflow-y-auto p-3">

			<div class="rounded-lg bg-slate-900 p-3">

				<h4 class="text-[11px] font-semibold leading-5 text-white">
					How satisfied are you with today's webcast?
				</h4>

				<div class="mt-4 space-y-3">

					<div>

						<div class="flex justify-between text-[11px]">
							<span>Excellent</span>
							<span class="text-blue-400">65%</span>
						</div>

						<div class="mt-1 h-1.5 rounded-full bg-slate-700">
							<div class="h-1.5 w-[65%] rounded-full bg-blue-500"></div>
						</div>

					</div>

					<div>

						<div class="flex justify-between text-[11px]">
							<span>Good</span>
							<span class="text-green-400">22%</span>
						</div>

						<div class="mt-1 h-1.5 rounded-full bg-slate-700">
							<div class="h-1.5 w-[22%] rounded-full bg-green-500"></div>
						</div>

					</div>

					<div>

						<div class="flex justify-between text-[11px]">
							<span>Average</span>
							<span class="text-yellow-400">10%</span>
						</div>

						<div class="mt-1 h-1.5 rounded-full bg-slate-700">
							<div class="h-1.5 w-[10%] rounded-full bg-yellow-500"></div>
						</div>

					</div>

					<div>

						<div class="flex justify-between text-[11px]">
							<span>Poor</span>
							<span class="text-red-400">3%</span>
						</div>

						<div class="mt-1 h-1.5 rounded-full bg-slate-700">
							<div class="h-1.5 w-[3%] rounded-full bg-red-500"></div>
						</div>

					</div>

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
						Viewers
					</div>

					<div class="mt-1 text-lg font-bold text-white">
						5,421
					</div>

				</div>

				<div class="rounded-lg bg-slate-900 p-3">

					<div class="text-[10px] text-slate-500">
						Active
					</div>

					<div class="mt-1 text-lg font-bold text-emerald-400">
						5,108
					</div>

				</div>

				<div class="rounded-lg bg-slate-900 p-3">

					<div class="text-[10px] text-slate-500">
						Avg Time
					</div>

					<div class="mt-1 text-lg font-bold text-amber-400">
						42m
					</div>

				</div>

				<div class="rounded-lg bg-slate-900 p-3">

					<div class="text-[10px] text-slate-500">
						Peak
					</div>

					<div class="mt-1 text-lg font-bold text-red-400">
						6,028
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
						<span>18%</span>
					</div>

					<div class="flex justify-between">
						<span class="text-slate-400">Memory</span>
						<span>2.4 GB</span>
					</div>

					<div class="flex justify-between">
						<span class="text-slate-400">Bitrate</span>
						<span>4.5 Mbps</span>
					</div>

					<div class="flex justify-between">
						<span class="text-slate-400">Latency</span>
						<span>126 ms</span>
					</div>

					<div class="flex justify-between">
						<span class="text-slate-400">Packet Loss</span>
						<span class="text-emerald-400 font-semibold">
							0%
						</span>
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
					id="participantCount"
					class="rounded-full bg-blue-600 px-2 py-1 text-[10px] font-semibold text-white">

					18

				</span>

				<!-- Invite -->
				<button
					class="flex h-7 w-7 items-center justify-center rounded-md bg-slate-800 text-slate-300 transition hover:bg-blue-600 hover:text-white"
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

			<!-- Moderator -->
			<div class="flex items-center gap-2 px-3 py-2 hover:bg-slate-900 transition">

				<div class="relative">

					<div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-600 text-[11px] font-bold text-white">
						AK
					</div>

					<span class="absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-slate-950"></span>

				</div>

				<div class="min-w-0 flex-1">

					<div class="truncate text-[11px] font-semibold text-white">
						Asep Kamaludin
					</div>

					<div class="text-[10px] text-blue-400">
						Moderator
					</div>

				</div>

				<button
					disabled
					class="rounded bg-slate-800 px-2 py-1 text-[10px] text-slate-500 cursor-not-allowed">
					Host
				</button>

			</div>

			<!-- Presenter -->
			<div class="flex items-center gap-2 px-3 py-2 hover:bg-slate-900 transition">

				<div class="relative">

					<div class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-[11px] font-bold text-white">
						JS
					</div>

					<span class="absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-slate-950"></span>

				</div>

				<div class="min-w-0 flex-1">

					<div class="truncate text-[11px] font-semibold">
						John Smith
					</div>

					<div class="text-[10px] text-emerald-400">
						Presenter
					</div>

				</div>

				<button
					class="rounded bg-red-600 hover:bg-red-700 px-2 py-1 text-[10px] font-medium text-white transition">
					<svg xmlns="http://www.w3.org/2000/svg"
						class="h-4 w-4"
						fill="none"
						viewBox="0 0 24 24"
						stroke="currentColor"
						stroke-width="2">

						<circle cx="12" cy="12" r="9"/>

						<path stroke-linecap="round"
							stroke-linejoin="round"
							d="M8 8l8 8"/>

					</svg>
				</button>

			</div>

			<!-- Audience -->
			<div class="flex items-center gap-2 px-3 py-2 hover:bg-slate-900 transition">

				<div class="relative">

					<div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-700 text-[11px] font-bold text-white">
						SJ
					</div>

					<span class="absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-slate-950"></span>

				</div>

				<div class="min-w-0 flex-1">

					<div class="truncate text-[11px] font-semibold">
						Sarah Johnson
					</div>

					<div class="text-[10px] text-slate-400">
						Audience
					</div>

				</div>

				<button
					class="rounded bg-red-600 hover:bg-red-700 px-2 py-1 text-[10px] font-medium text-white transition">
					<svg xmlns="http://www.w3.org/2000/svg"
						class="h-4 w-4"
						fill="none"
						viewBox="0 0 24 24"
						stroke="currentColor"
						stroke-width="2">

						<circle cx="12" cy="12" r="9"/>

						<path stroke-linecap="round"
							stroke-linejoin="round"
							d="M8 8l8 8"/>

					</svg>
				</button>

			</div>

			<!-- Audience -->
			<div class="flex items-center gap-2 px-3 py-2 hover:bg-slate-900 transition">

				<div class="relative">

					<div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-700 text-[11px] font-bold text-white">
						MA
					</div>

					<span class="absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full bg-yellow-500 ring-2 ring-slate-950"></span>

				</div>

				<div class="min-w-0 flex-1">

					<div class="flex items-center gap-2">

						<div class="truncate text-[11px] font-semibold text-slate-100">
							Michael Anderson
						</div>

						<span class="rounded bg-red-600 px-1.5 py-0.5 text-[8px] font-bold uppercase tracking-wide text-white">
							BANNED
						</span>

					</div>

					<div class="text-[10px] text-slate-500">
						Audience
					</div>

				</div>

				<button
					class="rounded bg-blue-600 hover:bg-blue-700 px-2 py-1 text-[10px] font-medium text-white transition">
					<svg xmlns="http://www.w3.org/2000/svg" title="UnBanned"
						class="h-4 w-4"
						fill="none"
						viewBox="0 0 24 24"
						stroke="currentColor"
						stroke-width="2">

						<path stroke-linecap="round"
							stroke-linejoin="round"
							d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>

						<circle cx="8.5" cy="7" r="4"/>

						<path stroke-linecap="round"
							stroke-linejoin="round"
							d="M16 11l2 2 4-4"/>

					</svg>
				</button>

			</div>

			<!-- Audience -->
			<div class="flex items-center gap-2 px-3 py-2 hover:bg-slate-900 transition">

				<div class="relative">

					<div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-700 text-[11px] font-bold text-white">
						DB
					</div>

					<span class="absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full bg-slate-500 ring-2 ring-slate-950"></span>

				</div>

				<div class="min-w-0 flex-1">

					<div class="truncate text-[11px] font-semibold">
						David Brown
					</div>

					<div class="text-[10px] text-slate-500">
						Offline
					</div>

				</div>

				<button
					disabled
					class="rounded bg-slate-800 px-2 py-1 text-[10px] text-slate-600 cursor-not-allowed">
					<svg xmlns="http://www.w3.org/2000/svg"
						class="h-4 w-4"
						fill="none"
						viewBox="0 0 24 24"
						stroke="currentColor"
						stroke-width="2">

						<circle cx="12" cy="12" r="9"/>

						<path stroke-linecap="round"
							stroke-linejoin="round"
							d="M8 8l8 8"/>

					</svg>
				</button>

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
</div>