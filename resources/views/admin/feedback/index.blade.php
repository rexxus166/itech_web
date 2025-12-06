@extends('admin.layout.main')

@section('content')
<div class="container">
    <h1>Data Feedback</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($feedbacks as $feedback)
                        <tr>
                            <td>{{ $loop->iteration + ($feedbacks->currentPage() - 1) * $feedbacks->perPage() }}</td>
                            <td>{{ $feedback->name }}</td>
                            <td>{{ $feedback->email }}</td>
                            <td>{{ Str::limit($feedback->message, 100) }}</td>
                            <td>{{ $feedback->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.feedback.destroy', $feedback->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus feedback ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada feedback.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- PERBAIKAN: Tambah pagination -->
            @if($feedbacks->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $feedbacks->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
