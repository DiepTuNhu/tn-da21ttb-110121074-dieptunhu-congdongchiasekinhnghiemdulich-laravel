<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\Badge;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;

class MissionsController extends Controller
{
    public function index()
    {
        $missions = Mission::all(); // Lấy tất cả các tỉnh
       
        if (request()->ajax()) {
            // Nếu là request AJAX, chỉ trả phần nội dung @section('content')
            return view('admin.mission.list', compact('missions'))->render();
        }

        // Nếu là request bình thường, trả toàn bộ layout
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
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required',
            'points_reward' => 'required|integer|min:0',
            'condition_type' => 'nullable|string|max:255',
            'condition_value' => 'nullable|integer',
            'badge_id' => 'nullable|exists:badges,id',
            'frequency' => 'nullable|string|max:20',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|boolean',
        ], [
            'name.required' => 'Vui lòng nhập tên nhiệm vụ.',
            'description.required' => 'Vui lòng nhập mô tả.',
            'points_reward.required' => 'Vui lòng nhập điểm thưởng.',
            'points_reward.integer' => 'Điểm thưởng phải là số nguyên.',
            'points_reward.min' => 'Điểm thưởng phải lớn hơn hoặc bằng 0.',
            'badge_id.exists' => 'Huy hiệu không hợp lệ.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
        ]);

        // Lưu dữ liệu vào cơ sở dữ liệu
        $mission = new Mission();
        $mission->name = $request->name;
        $mission->description = $request->description;
        $mission->points_reward = $request->points_reward;
        $mission->condition_type = $request->condition_type;
        $mission->condition_value = $request->condition_value;
        $mission->badge_id = $request->badge_id;
        $mission->frequency = $request->frequency;
        $mission->start_date = $request->start_date;
        $mission->end_date = $request->end_date;
        $mission->status = $request->status;
        $mission->save();

        // Chuyển hướng về danh sách nhiệm vụ với thông báo thành công
        return redirect()->route('missions.index')->with('success', 'Nhiệm vụ đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mission = \App\Models\Mission::with('badge')->findOrFail($id);
        return view('admin.mission.show', compact('mission'));
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
            'condition_type' => 'nullable|string|max:255',
            'condition_value' => 'nullable|integer',
            'badge_id' => 'nullable|exists:badges,id',
            'frequency' => 'nullable|string|max:20',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|boolean',
        ], [
            'name.required' => 'Vui lòng nhập tên nhiệm vụ.',
            'description.required' => 'Vui lòng nhập mô tả.',
            'points_reward.required' => 'Vui lòng nhập điểm thưởng.',
            'points_reward.integer' => 'Điểm thưởng phải là số nguyên.',
            'points_reward.min' => 'Điểm thưởng phải lớn hơn hoặc bằng 0.',
            'condition_type.string' => 'Loại điều kiện phải là chuỗi.',
            'badge_id.exists' => 'Huy hiệu không hợp lệ.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
        ]);

        // Cập nhật thông tin nhiệm vụ
        $mission->name = $request->name;
        $mission->description = $request->description;
        $mission->points_reward = $request->points_reward;
        $mission->condition_type = $request->condition_type;
        $mission->condition_value = $request->condition_value;
        $mission->badge_id = $request->badge_id;
        $mission->frequency = $request->frequency;
        $mission->start_date = $request->start_date;
        $mission->end_date = $request->end_date;
        $mission->status = $request->status;
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

    public function isMissionAvailable($mission)
    {
        $now = Carbon::now();

        // Nếu chưa tới ngày bắt đầu thì không active
        if ($mission->start_date && $now->lt($mission->start_date)) {
            return false;
        }
        // Nếu có ngày kết thúc và đã quá ngày kết thúc thì không active
        if ($mission->end_date && $now->gt($mission->end_date)) {
            return false;
        }

        // Kiểm tra theo chu kỳ
        switch ($mission->frequency) {
            case 'daily':
                $start = $now->copy()->startOfDay();
                $end = $now->copy()->endOfDay();
                break;
            case 'weekly':
                $start = $now->copy()->startOfWeek();
                $end = $now->copy()->endOfWeek();
                break;
            case 'monthly':
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
                break;
            default:
                $start = $mission->start_date;
                $end = $mission->end_date;
                break;
        }

        return $now->between($start, $end);
    }
}
