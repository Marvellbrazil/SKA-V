<div x-data="{ open: false }" class="relative z-[9999]">

    <style>
    [x-cloak] {
        display: none !important;
    }

    #chatbox {
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: pre-wrap;
        scroll-behavior: smooth;
        flex: 1;
        min-height: 150px;
        max-height: 400px;
        /* Sedikit saya besarkan agar proporsional */
        overflow-y: auto;
        padding: 0.75rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        background-color: #f5f7fa;
        border-radius: 12px;
    }

    .menu-item a {
        display: inline-block;
        width: 100%;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    #chatContainer {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    /* Custom scrollbar */
    #chatbox::-webkit-scrollbar {
        width: 5px;
    }

    #chatbox::-webkit-scrollbar-track {
        background: transparent;
    }

    #chatbox::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    #chatbox::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Bubbles & Animations */
    .bubble {
        max-width: 80%;
        padding: 0.75rem 1rem;
        border-radius: 16px;
        line-height: 1.4;
        word-wrap: break-word;
        font-size: 0.95rem;
        animation: fadeIn 0.2s ease-in;
    }

    .bubble.user {
        align-self: flex-end;
        background-color: #0078ff;
        color: white;
        border-bottom-right-radius: 4px;
    }

    .bubble.bot {
        align-self: flex-start;
        background-color: #e5e7eb;
        color: #111827;
        border-bottom-left-radius: 4px;
    }

    .typing {
        display: inline-block;
        width: 40px;
        text-align: left;
    }

    .typing span {
        display: inline-block;
        width: 6px;
        height: 6px;
        margin: 0 1px;
        background: #999;
        border-radius: 50%;
        animation: blink 1.4s infinite both;
    }

    .typing span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes blink {

        0%,
        80%,
        100% {
            opacity: 0;
        }

        40% {
            opacity: 1;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(4px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>

    <button @click="open = !open" class="fixed bottom-6 right-6 w-[50px] h-[50px] bg-[#E17626] text-white rounded-full
               flex items-center justify-center shadow-[0_4px_10px_rgba(0,0,0,0.3)]
               hover:scale-110 transition-all duration-300 z-50 focus:outline-none">

        <div class="flex items-center justify-center">
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
    </button>

    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-y-4 opacity-0 scale-95"
        x-transition:enter-end="translate-y-0 opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-y-0 opacity-100 scale-100"
        x-transition:leave-end="translate-y-4 opacity-0 scale-95"
        class="fixed bottom-24 right-6 z-40 w-[350px] h-[500px] bg-white rounded-2xl flex flex-col shadow-2xl border border-gray-200">

        <div class="p-4 rounded-t-2xl bg-gradient-to-r from-blue-600 to-blue-700 text-white flex-shrink-0">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <img class="w-8 h-8 bg-white rounded-full p-1" src="{{ $assetBase . '/assets/skariga logo 1.png' }}"
                        alt="Logo">
                    <div>
                        <h1 class="text-sm font-bold leading-tight">SMK PGRI 3 MALANG</h1>
                        <p class="text-[10px] text-blue-100 uppercase">Online Assistant</p>
                    </div>
                </div>
                <button @click="open = false" class="text-white/80 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex-1 min-h-0 p-4 overflow-hidden bg-gray-50 flex flex-col">
            <x-qna></x-qna>
        </div>
    </div>
</div>
