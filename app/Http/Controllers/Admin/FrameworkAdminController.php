<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Framework;

class FrameworkAdminController extends Controller
{
    public function index() {
        $frameworks = Framework::all();
        return view('admin.frameworks.index', compact('frameworks'));
    }

    public function create() {
        return view('admin.frameworks.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:frameworks',
            'description' => 'required'
        ]);
        

        Framework::create($request->all());

        return redirect()->route('admin.frameworks.index')->with('success', 'Framework ditambahkan!');
    }

    public function edit($id) {
        $framework = Framework::findOrFail($id);
        return view('admin.frameworks.edit', compact('framework'));
    }

    public function update(Request $request, $id) {
        $framework = Framework::findOrFail($id);
        $framework->update($request->all());

        return redirect()->route('admin.frameworks.index')->with('success', 'Framework diupdate!');
    }

    public function destroy($id) {
        Framework::destroy($id);
        return redirect()->route('admin.frameworks.index')->with('success', 'Framework dihapus!');
    }
}
