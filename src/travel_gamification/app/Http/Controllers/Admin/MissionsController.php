<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\Badge;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Post;

class MissionsController extends Controller
{
    public function index()
    {
        $missions = Mission::all(); // Lấy tất cả các tỉnh
        return view('admin.mission.list', compact('missions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $badges = Badge::all(); // Lấy tất cả các huy hiệu
        return view('admin.mission.add', compact('badges')); // Truyền biến $badges sang view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required',
            'points_reward' => 'required|integer|min:0',
            'condition_type' => 'required|string|max:255',
            'condition_value' => 'nullable|integer',
            'badge_id' => 'nullable|exists:badges,id',
        ], [
            'name.required' => 'Vui lòng nhập tên nhiệm vụ.',
            'description.required' => 'Vui lòng nhập mô tả.',
            'points_reward.required' => 'Vui lòng nhập điểm thưởng.',
            'points_reward.integer' => 'Điểm thưởng phải là số nguyên.',
            'points_reward.min' => 'Điểm thưởng phải lớn hơn hoặc bằng 0.',
            'condition_type.required' => 'Vui lòng nhập loại điều kiện.',
            'condition_type.string' => 'Loại điều kiện phải là chuỗi.',
            'badge_id.exists' => 'Huy hiệu không hợp lệ.',
        ]);

        // Lưu dữ liệu vào cơ sở dữ liệu
        $mission = new Mission();
        $mission->name = $request->name;
        $mission->description = $request->description;
        $mission->points_reward = $request->points_reward;
        $mission->condition_type = $request->condition_type;
        $mission->condition_value = $request->condition_value;
        $mission->badge_id = $request->badge_id;
        $mission->save();

        // Chuyển hướng về danh sách nhiệm vụ với thông báo thành công
        return redirect()->route('missions.index')->with('success', 'Nhiệm vụ đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mission = Mission::find($id);
        $badges = Badge::all(); // Lấy tất cả các huy hiệu
    return view('admin.mission.edit', compact('mission', 'badges')); // Truyền $mission và $badges sang view
        return view('admin.mission.edit',compact('mission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Tìm nhiệm vụ theo ID
        $mission = Mission::findOrFail($id);

        // Validate dữ liệu
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required',
            'points_reward' => 'required|integer|min:0',
            'condition_type' => 'required|string|max:255',
            'condition_value' => 'nullable|integer',
            'badge_id' => 'nullable|exists:badges,id',
        ], [
            'name.required' => 'Vui lòng nhập tên nhiệm vụ.',
            'description.required' => 'Vui lòng nhập mô tả.',
            'points_reward.required' => 'Vui lòng nhập điểm thưởng.',
            'points_reward.integer' => 'Điểm thưởng phải là số nguyên.',
            'points_reward.min' => 'Điểm thưởng phải lớn hơn hoặc bằng 0.',
            'condition_type.required' => 'Vui lòng nhập loại điều kiện.',
            'condition_type.string' => 'Loại điều kiện phải là chuỗi.',
            'badge_id.exists' => 'Huy hiệu không hợp lệ.',
        ]);

        // Cập nhật thông tin nhiệm vụ
        $mission->name = $request->name;
        $mission->description = $request->description;
        $mission->points_reward = $request->points_reward;
        $mission->condition_type = $request->condition_type;
        $mission->condition_value = $request->condition_value;
        $mission->badge_id = $request->badge_id;
        $mission->save();

        // Chuyển hướng về danh sách nhiệm vụ với thông báo thành công
        return redirect()->route('missions.index')->with('success', 'Cập nhật nhiệm vụ thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        $mission = Mission::find($id);
        $mission->delete();
        return redirect()->route('missions.index');
    }

    public function checkMissionCompletion($userId, $missionId)
    {
        $mission = Mission::find($missionId);

        switch ($mission->condition_type) {
            case 'like':
                return Like::where('user_id', $userId)
                           ->where('post_id', $mission->condition_value)
                           ->exists();

            case 'comment':
                return Comment::where('user_id', $userId)
                              ->where('post_id', $mission->condition_value)
                              ->exists();

            case 'post':
                return Post::where('user_id', $userId)
                           ->where('id', $mission->condition_value)
                           ->exists();

            default:
                return false;
        }
    }
}
