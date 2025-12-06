@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>My Code Collection</h1>
        <a href="{{ route('postingan.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> New Code
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($postingans->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-code fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">No code saved yet</h4>
            <p class="text-muted">Start by creating your first code snippet!</p>
            <a href="{{ route('postingan.create') }}" class="btn btn-primary">Create Your First Code</a>
        </div>
    @else
        <div class="row">
            @foreach($postingans as $postingan)
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 text-truncate">{{ $postingan->judul }}</h6>
                            <span class="badge bg-{{ $postingan->bahasa == 'python' ? 'warning' : 'info' }}">
                                {{ strtoupper($postingan->bahasa) }}
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="code-preview">
                                <pre style="max-height: 200px; overflow: auto;"><code class="language-{{ $postingan->bahasa }}">{{ $postingan->konten }}</code></pre>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="far fa-clock"></i>
                                    {{ $postingan->created_at->format('M d, Y H:i') }}
                                </small>
                                <div>
                                    <button class="btn btn-sm btn-outline-primary" onclick="copyCode('{{ $postingan->id }}')">
                                        <i class="far fa-copy"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" onclick="viewCode('{{ $postingan->id }}')">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Modal for Viewing Code -->
<div class="modal fade" id="codeModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <pre id="modalCode" style="max-height: 500px; overflow: auto;"></pre>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="copyModalCode()">Copy Code</button>
            </div>
        </div>
    </div>
</div>

<!-- Syntax Highlighting -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/monokai.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/languages/python.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/languages/cpp.min.js"></script>

<script>
    // Initialize syntax highlighting
    document.addEventListener('DOMContentLoaded', function() {
        hljs.highlightAll();
    });

    function copyCode(postId) {
        const codeElement = document.querySelector(`[onclick="viewCode('${postId}')"]`).closest('.card').querySelector('code');
        const codeText = codeElement.textContent;

        navigator.clipboard.writeText(codeText).then(() => {
            // Show temporary feedback
            const btn = event.target.closest('button');
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check"></i>';
            btn.classList.remove('btn-outline-primary');
            btn.classList.add('btn-success');

            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.classList.remove('btn-success');
                btn.classList.add('btn-outline-primary');
            }, 2000);
        });
    }

    function viewCode(postId) {
        const card = document.querySelector(`[onclick="viewCode('${postId}')"]`).closest('.card');
        const title = card.querySelector('.card-header h6').textContent;
        const code = card.querySelector('code').textContent;
        const language = card.querySelector('.badge').textContent.trim();

        document.getElementById('modalTitle').textContent = title + ' - ' + language;
        document.getElementById('modalCode').textContent = code;

        // Re-highlight code in modal
        const modal = new bootstrap.Modal(document.getElementById('codeModal'));
        modal.show();

        // Highlight code after modal is shown
        document.getElementById('codeModal').addEventListener('shown.bs.modal', function() {
            hljs.highlightElement(document.getElementById('modalCode'));
        });
    }

    function copyModalCode() {
        const codeText = document.getElementById('modalCode').textContent;
        navigator.clipboard.writeText(codeText);

        // Feedback
        const btn = document.querySelector('#codeModal .btn-primary');
        const originalText = btn.textContent;
        btn.innerHTML = '<i class="fas fa-check"></i> Copied!';

        setTimeout(() => {
            btn.innerHTML = originalText;
        }, 2000);
    }
</script>

<style>
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
        border: 1px solid #dee2e6;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .code-preview pre {
        background: #272822;
        border-radius: 4px;
        padding: 15px;
        margin: 0;
    }

    .badge {
        font-size: 0.7em;
    }
</style>
@endsection
