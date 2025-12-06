<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        // PERBAIKAN: Tambah pagination untuk data yang banyak
        $feedbacks = Feedback::latest()->paginate(10);
        return view('admin.feedback.index', compact('feedbacks'));
    }

    public function destroy($id)
    {
        try {
            $feedback = Feedback::findOrFail($id);
            $feedback->delete();

            return redirect()->route('admin.feedback.index')
                ->with('success', 'Feedback berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->route('admin.feedback.index')
                ->with('error', 'Gagal menghapus feedback.');
        }
    }
}
