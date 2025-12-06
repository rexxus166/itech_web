<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>iTech - Edukasi Programming</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Highlight.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/default.min.css">

    <!-- Custom Font -->
    <link rel="stylesheet" href="{{ asset('font/Nexa-Heavy.ttf') }}">

    <style>
        body { display:flex; flex-direction:column; min-height:100vh; }

        .main-content { flex:1; }

        /* Navbar */
        .navbar-dark-blue { background-color: #001a33 !important; }
        .navbar-nav .nav-item .btn-primary { color: white !important; font-weight:500; transition: all .2s ease; border:none; background-color:transparent !important; }
        .navbar-nav .nav-item .btn-primary:hover { background-color:#003366 !important; color:white !important; }
        .navbar-nav .nav-item.active .btn-primary { background-color:#00c3ff !important; color:white !important; font-weight:bold; }

        .btn-create { background-color:#ffc107; color:#000 !important; font-weight:bold; border:none; }
        .itech-logo { height:90px; }

        footer { background-color:#000; }

        /* Chatbot styles */
        .chatbot-button {
            position: fixed;
            right: 20px;
            bottom: 20px;
            z-index: 1080;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            box-shadow: 0 6px 18px rgba(0,0,0,.15);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size: 22px;
        }

        .chat-window {
            width: 360px;
            max-width: calc(100vw - 40px);
            height: 520px;
        }

        .chat-messages {
            height: 380px;
            overflow-y: auto;
            padding: 1rem;
            background: #f7f9fc;
        }

        .message.user { text-align: right; }
        .message.bot { text-align: left; }

        .message .bubble {
            display:inline-block;
            padding: .6rem .8rem;
            border-radius: 12px;
            margin-bottom: .6rem;
            max-width: 85%;
            line-height:1.3;
        }

        .message.user .bubble { background: #0d6efd; color: #fff; }
        .message.bot .bubble { background: #e9ecef; color: #000; }

        .typing-indicator {
            font-size: .85rem;
            color: #666;
            padding: .2rem .6rem;
        }
    </style>
</head>
<body>
    {{-- NAVBAR (sama seperti filemu) --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top navbar-dark-blue">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('images/iTech(1).png') }}" alt="iTech" class="itech-logo me-2">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarItech">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarItech">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item {{ Request::is('/') || Request::is('home') ? 'active' : '' }}">
                        <a class="btn btn-primary" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item {{ Request::is('artikel') ? 'active' : '' }}">
                        <a class="btn btn-primary" href="{{ url('artikel') }}">Edukasi</a>
                    </li>
                    <li class="nav-item {{ Request::is('about-us') ? 'active' : '' }}">
                        <a class="btn btn-primary" href="{{ url('about-us') }}">About Us</a>
                    </li>
                    <li class="nav-item {{ Request::is('feedback') ? 'active' : '' }}">
                        <a class="btn btn-primary" href="{{ url('feedback') }}">Feedback</a>
                    </li>
                    <li class="nav-item {{ Request::is('quizzes') || Request::routeIs('user.quiz.list') ? 'active' : '' }}">
                        <a class="btn btn-primary" href="{{ route('user.quiz.list') }}">Daftar Kuis</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-create me-2" href="{{ route('postingan.index') }}">Code Editor</a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="btn btn-outline-light me-2" href="{{ route('login') }}">Log In</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light" href="{{ route('register') }}">Sign Up</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container">
            <div class="row">
                <!-- About Us -->
                <div class="col-lg-4 mb-4">
                    <h5 class="text-uppercase mb-4">Tentang Kami</h5>
                    <p>Kami adalah platform pembelajaran programming yang didedikasikan untuk membantu siapa saja menjadi developer handal dengan materi berkualitas dan komunitas yang supportif.</p>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-4 mb-4">
                    <h5 class="text-uppercase mb-4">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/" class="text-white text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="/artikel" class="text-white text-decoration-none">Courses</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-4 mt-4 border-top border-secondary">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-md-0">&copy; {{ date('Y') }} Learn Programming Is Easy. All rights reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline text-center text-md-end mb-0">
                            <li class="list-inline-item"><a href="/terms" class="text-white text-decoration-none small">Terms of Service</a></li>
                            <li class="list-inline-item ms-3"><a href="/privacy" class="text-white text-decoration-none small">Privacy Policy</a></li>
                            <li class="list-inline-item ms-3"><a href="/faq" class="text-white text-decoration-none small">FAQ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- CHATBOT FLOATING BUTTON --}}
    <button id="openChatBtn" class="btn btn-primary chatbot-button" title="Chat with iTech AI">
        <i class="fa-solid fa-robot"></i>
    </button>

    <!-- Chat Modal (Bootstrap) -->
    <div class="modal fade" id="chatModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-end modal-sm">
        <div class="modal-content chat-window">
          <div class="modal-header">
            <h6 class="modal-title"><i class="fa-solid fa-robot me-2"></i>iTech AI</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body d-flex flex-column p-0">
            <div class="chat-messages" id="chatMessages" aria-live="polite"></div>

            <div class="p-3 border-top">
              <form id="chatForm" class="d-flex" onsubmit="return false;">
                <input id="chatInput" class="form-control me-2" type="text" placeholder="Tanya tentang programming, mis. 'Apa itu REST API?'" autocomplete="off" required>
                <button id="sendBtn" class="btn btn-primary" type="submit">Kirim</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
    <script>
    hljs.highlightAll();

    const chatModalEl = document.getElementById('chatModal');
    const chatModal = new bootstrap.Modal(chatModalEl, { backdrop: true });
    const openChatBtn = document.getElementById('openChatBtn');
    const chatMessages = document.getElementById('chatMessages');
    const chatForm = document.getElementById('chatForm');
    const chatInput = document.getElementById('chatInput');

    openChatBtn.addEventListener('click', () => {
        chatModal.show();
        chatInput.focus();
        if (!sessionStorage.getItem('itech_chat_started')) {
            addBotMessage("Halo! Saya iTech AI berbasis Gemini 🤖. Tanya apa saja seputar programming, HTML, PHP, atau Flutter!");
            sessionStorage.setItem('itech_chat_started', '1');
        }
    });

    function appendMessage({ from = 'bot', text = '' }) {
        const wrapper = document.createElement('div');
        wrapper.classList.add('message', from === 'user' ? 'user' : 'bot');
        const bubble = document.createElement('div');
        bubble.classList.add('bubble');
        bubble.innerHTML = text;
        wrapper.appendChild(bubble);
        chatMessages.appendChild(wrapper);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function addUserMessage(text) {
        appendMessage({ from: 'user', text: escapeHtml(text) });
    }

    function addBotMessage(text) {
        appendMessage({ from: 'bot', text: escapeHtml(text) });
    }

    function showTypingIndicator() {
        const el = document.createElement('div');
        el.className = 'typing typing-indicator';
        el.id = 'typingIndicator';
        el.textContent = 'Gemini sedang mengetik...';
        chatMessages.appendChild(el);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function removeTypingIndicator() {
        const el = document.getElementById('typingIndicator');
        if (el) el.remove();
    }

    function escapeHtml(unsafe) {
        return unsafe
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }

    chatForm.addEventListener('submit', async (e) => {
        const text = chatInput.value.trim();
        if (!text) return;
        addUserMessage(text);
        chatInput.value = '';
        chatInput.disabled = true;
        document.getElementById('sendBtn').disabled = true;

        showTypingIndicator();

        try {
            const res = await fetch("{{ url('/api/chat') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: text })
            });

            const data = await res.json();
            removeTypingIndicator();
            addBotMessage(data.reply ?? "Maaf, tidak ada jawaban.");
        } catch (err) {
            removeTypingIndicator();
            addBotMessage("Gagal menghubungi server Gemini API.");
        } finally {
            chatInput.disabled = false;
            document.getElementById('sendBtn').disabled = false;
            chatInput.focus();
        }
    });
</script>

</body>
</html>
