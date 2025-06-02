<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reward;
use Illuminate\Support\Facades\Storage;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::orderByDesc('id')->get();
        return view('admin.rewards.list', compact('rewards'));
    }

    public function create()
    {
        return view('admin.rewards.add');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cost_points' => 'required|integer|min:0',
            'type' => 'required|in:virtual,physical',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'active' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('rewards', 'public');
            $data['image'] = basename($data['image']);
        }

        Reward::create($data);

        return redirect()->route('rewards.index')->with('success', 'Thêm phần thưởng thành công!');
    }

    public function edit($id)
    {
        $reward = Reward::findOrFail($id);
        return view('admin.rewards.edit', compact('reward'));
    }

    public function update(Request $request, $id)
    {
        $reward = Reward::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cost_points' => 'required|integer|min:0',
            'type' => 'required|in:virtual,physical',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'active' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($reward->image && Storage::disk('public')->exists('rewards/' . $reward->image)) {
                Storage::disk('public')->delete('rewards/' . $reward->image);
            }
            $data['image'] = $request->file('image')->store('rewards', 'public');
            $data['image'] = basename($data['image']);
        }

        $reward->update($data);

        return redirect()->route('rewards.index')->with('success', 'Cập nhật phần thưởng thành công!');
    }

    public function destroy($id)
    {
        $reward = Reward::findOrFail($id);
        if ($reward->image && Storage::disk('public')->exists('rewards/' . $reward->image)) {
            Storage::disk('public')->delete('rewards/' . $reward->image);
        }
        $reward->delete();
        return redirect()->route('rewards.index')->with('success', 'Xóa phần thưởng thành công!');
    }
}
