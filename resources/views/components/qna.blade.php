<div id="chatContainer" class="flex flex-col h-full overflow-hidden">

    <div class="flex-shrink-0 flex items-center justify-center py-3 border-b border-gray-100 bg-white">
        <img class="w-6 h-6 md:w-7 md:h-7" src="{{ $assetBase . '/assets/faq.png' }}" alt="FAQ">
        <h2 class="text-base md:text-lg font-bold text-gray-800 ml-2">QnA</h2>
    </div>

    <div id="chatbox" class="flex-1 min-h-0 w-full p-4 bg-[#f8fafc] overflow-y-auto flex flex-col gap-3">
    </div>

    <div class="flex-shrink-0 bg-white border-t border-gray-100 p-3">

        <div id="question" class="w-full p-2 mb-2 text-center text-xs border border-blue-200 rounded-lg bg-blue-50 text-blue-700
                    cursor-pointer hover:bg-blue-100 transition-all border-dashed">
            Apa saja jurusannya?
        </div>

        <form id="chatForm" class="flex items-stretch gap-0">
            <textarea id="message" name="message" placeholder="Tulis pertanyaan..."
                class="flex-grow border border-gray-300 rounded-l-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-300 resize-none text-sm transition-all"
                rows="1" style="max-height: 120px; min-height: 42px; overflow-y: hidden;" required></textarea>

            <button id="submitBtn" type="submit"
                class="bg-blue-600 text-white px-5 rounded-r-xl hover:bg-blue-700 active:scale-95 transition-all flex items-center justify-center shadow-sm min-w-[55px]">
                <i class="fas fa-paper-plane"></i>
            </button>
        </form>
    </div>
</div>

<script>
const chatForm = document.getElementById('chatForm');
const chatbox = document.querySelector('#chatbox');
const messageInput = document.getElementById('message');
const submitButton = document.getElementById('submitBtn');
const questionElement = document.getElementById('question');

function resizeTextarea() {
    messageInput.style.height = 'auto';
    const newHeight = messageInput.scrollHeight;
    messageInput.style.height = newHeight + 'px';
    messageInput.style.overflowY = newHeight > 120 ? 'auto' : 'hidden';
}

messageInput.addEventListener('input', resizeTextarea);

function fillMessage(text) {
    messageInput.value = text.trim();
    messageInput.focus();
    resizeTextarea();
}

// --- LOGIC: CHAT HISTORY (LocalStorage) ---
const HISTORY_KEY = 'skaribot_chat_history';
const TIMESTAMP_KEY = 'skaribot_chat_timestamp';
const EXPIRE_TIME = 3 * 60 * 60 * 1000;

function getChatHistory() {
    const timestamp = localStorage.getItem(TIMESTAMP_KEY);
    if (timestamp && (Date.now() - parseInt(timestamp)) > EXPIRE_TIME) {
        clearChatHistory();
        return [];
    }
    const history = localStorage.getItem(HISTORY_KEY);
    return history ? JSON.parse(history) : [];
}

function saveChatHistory(history) {
    localStorage.setItem(HISTORY_KEY, JSON.stringify(history));
    localStorage.setItem(TIMESTAMP_KEY, Date.now().toString());
}

function clearChatHistory() {
    localStorage.removeItem(HISTORY_KEY);
    localStorage.removeItem(TIMESTAMP_KEY);
}

function loadChatHistory() {
    const history = getChatHistory();
    chatbox.innerHTML = '';
    history.forEach(chat => appendMessage(chat.sender, chat.text, false));
    scrollToBottom();
}

function scrollToBottom() {
    chatbox.scrollTo({
        top: chatbox.scrollHeight,
        behavior: 'smooth'
    });
}

function appendMessage(sender, text, saveToHistory = true) {
    const div = document.createElement('div');
    div.classList.add('bubble', sender);
    div.innerHTML = text;
    chatbox.appendChild(div);
    scrollToBottom();

    if (saveToHistory) {
        const history = getChatHistory();
        history.push({
            sender,
            text,
            timestamp: Date.now()
        });
        saveChatHistory(history);
    }
    return div;
}

function appendTyping() {
    const typing = document.createElement('div');
    typing.classList.add('bubble', 'bot');
    typing.innerHTML = `<div class="typing"><span></span><span></span><span></span></div>`;
    chatbox.appendChild(typing);
    scrollToBottom();
    return typing;
}

messageInput.addEventListener('keydown', (e) => {
    if (e.key === "Enter" && !e.shiftKey) {
        e.preventDefault();
        chatForm.dispatchEvent(new Event('submit'));
    }
});

chatForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const message = messageInput.value.trim();
    if (!message) return;

    // Reset UI
    appendMessage('user', message);
    messageInput.value = '';
    resizeTextarea();

    const typingBubble = appendTyping();

    try {
        const res = await fetch("{{ route('chat.ask') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                message
            })
        });

        if (!res.ok) throw new Error("Server error");

        const data = await res.json();
        typingBubble.remove();
        appendMessage('bot', data.reply);
    } catch (err) {
        typingBubble.remove();
        appendMessage('bot', "Maaf, terjadi kesalahan koneksi. Coba lagi nanti ya.");
        console.error(err);
    }
});

const questions = [
    "Apa saja jurusannya?",
    "Bagaimana cara mendaftar?",
    "Apa saja ekstrakurikuler yang ada?",
    "Dimana letak sekolahnya?",
    "Prestasi terbaik sekolah?",
    "Fasilitas sekolah apa saja?",
    "Visi dan misinya apa?",
    "Terakreditasi apa sekolahnya?"
];

let currentQuestionIndex = 0;
setInterval(() => {
    questionElement.classList.add('opacity-0');
    setTimeout(() => {
        currentQuestionIndex = (currentQuestionIndex + 1) % questions.length;
        questionElement.textContent = questions[currentQuestionIndex];
        questionElement.classList.remove('opacity-0');
    }, 300);
}, 4000);

document.addEventListener('DOMContentLoaded', () => {
    loadChatHistory();
    questionElement.textContent = questions[0];
});
</script>
