<div id="modalPrompt"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-[10000]">

    <div class="bg-white rounded-xl p-6 w-full max-w-md">

        <h2 id="promptTitle" class="text-lg font-bold"></h2>
        <p id="promptMessage" class="mt-2 text-sm text-slate-600"></p>

        <div class="flex justify-end gap-3 mt-6">
            <button id="btnPromptNo"
                class="px-4 py-2 rounded-lg bg-slate-200 text-sm">
                Cancel
            </button>

            <button id="btnPromptYes"
                class="px-4 py-2 rounded-lg bg-green-600 text-white text-sm">
                Yes
            </button>
        </div>
    </div>
</div>
<!-- Loading Overlay -->
<div id="loadingOverlay"
     class="fixed hidden inset-0 z-[99999] flex items-center justify-center
            bg-slate-950/80 backdrop-blur-lg">

    <div class="w-full max-w-md mx-6">

        <div class="rounded-3xl bg-white shadow-2xl p-10 text-center">

            <!-- Logo -->

            <div class="flex items-center justify-center gap-4 mb-8">

                <img src="<?= base_url(); ?>assets/images/logo1.png"
                     class="w-14 h-14"
                     alt="Logo">

                <img src="<?= base_url(); ?>assets/images/logo_title.png"
                     class="h-10"
                     alt="Logo Title">

            </div>

            <!-- Spinner -->

            <div class="flex justify-center mb-8">

                <div class="relative w-20 h-20">

                    <div class="absolute inset-0 rounded-full border-4 border-slate-200"></div>

                    <div class="absolute inset-0 rounded-full border-4 border-blue-600 border-t-transparent animate-spin"></div>

                </div>

            </div>

            <!-- Title -->

            <h2 class="text-2xl font-bold text-slate-800" id="loadingOverlayTitle" >
                Joining Webcast
            </h2>

            <p class="text-slate-500 mt-3 leading-7"  id="loadingOverlayDesc" >
                Please wait while we securely connect you to the webcast session.
            </p>

            <!-- Progress -->

            <div class="mt-8">

                <div class="h-2 bg-slate-200 rounded-full overflow-hidden">

                    <div id="loadingProgress"
                         class="h-full w-0 bg-gradient-to-r from-blue-600 to-cyan-400 transition-all duration-500">
                    </div>

                </div>

            </div>

            <!-- Status -->

            <div id="loadingStatus"
                 class="mt-6 text-sm text-slate-500">

                Please Wait ...

            </div>

        </div>

    </div>

</div>
<script>
    const modalPrompt = document.getElementById('modalPrompt');
    const titleEl = document.getElementById('promptTitle');
    const messageEl = document.getElementById('promptMessage');
    const btnYes = document.getElementById('btnPromptYes');
    const btnNo = document.getElementById('btnPromptNo');

	const loadingOverlay = document.getElementById('loadingOverlay');
	const loadingOverlayTitle = document.getElementById('loadingOverlayTitle');
	const loadingOverlayDesc = document.getElementById('loadingOverlayDesc');

	function showLoading({
            title = 'Loading',
            desc = 'Please wait to retrieve data securely'
        } = {}){
		loadingOverlayTitle.innerText = title;
		loadingOverlayDesc.innerText = desc;
		loadingOverlay.classList.remove('hidden');
	}
	function hideLoading(){
		loadingOverlay.classList.add('hidden');
	}
    function openPrompt() {
        modalPrompt.classList.remove('hidden');
        modalPrompt.classList.add('flex');
    }

    function closePrompt() {
        modalPrompt.classList.add('hidden');
        modalPrompt.classList.remove('flex');
    }

    // 🔥 GLOBAL handler biar tidak numpuk
    modalPrompt.addEventListener('click', function(e) {
        if (e.target === modalPrompt) {
            closePrompt();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === "Escape") {
            closePrompt();
        }
    });

    // ✅ REUSABLE PROMPT
    function showPrompt(
        title,
        message,
        onYes = () => {},
        {
            textYes = 'Yes',
            textNo = 'Cancel',
            onClose = closePrompt
        } = {}
    ) {

        // set content
        titleEl.innerText = title;
        messageEl.innerText = message;

        // set button text
        btnYes.innerText = textYes;
        btnNo.innerText = textNo;

        // reset event (biar tidak dobel)
        btnYes.onclick = null;
        btnNo.onclick = null;

        // set event
        btnYes.onclick = () => {
            onYes();
            closePrompt();
        };

        btnNo.onclick = () => {
            onClose();
        };

        openPrompt();
    }
</script>