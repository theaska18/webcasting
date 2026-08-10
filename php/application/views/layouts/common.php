<div id="modalPrompt"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

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
<script>
    const modalPrompt = document.getElementById('modalPrompt');
    const titleEl = document.getElementById('promptTitle');
    const messageEl = document.getElementById('promptMessage');
    const btnYes = document.getElementById('btnPromptYes');
    const btnNo = document.getElementById('btnPromptNo');

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