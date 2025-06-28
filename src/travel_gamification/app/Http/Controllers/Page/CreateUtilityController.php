<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utility;
use App\Models\Destination;
use App\Models\UtilityType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewUtilityCreated;
use Illuminate\Support\Facades\Log;

class CreateUtilityController extends Controller
{

    public function create()
    {
        $destinations = Destination::where('status', 0)->get();
        $utilityTypes = UtilityType::all();
        $step = 2; // hoặc 2, 3 tùy vị trí
        $stepsType = 'utility'; // để blade biết là 3 bước
        return view('user.layout.create_utility', compact('destinations', 'utilityTypes', 'step', 'stepsType'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'destination_id' => 'required|exists:destinations,id',
            'price'        => 'nullable|string|max:255',
            'time'         => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'utility_type_id' => 'required|exists:utility_types,id',
            'distance' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $utility = new Utility();
            $utility->name        = $request->name;
            $utility->address     = $request->address;
            $utility->price       = $request->price;
            $utility->time        = $request->time;
            $utility->description = $request->description;
            $utility->utility_type_id = $request->utility_type_id;
            // $utility->distance = $request->distance;

            if ($request->hasFile('image')) {
                $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('utility_image', $imageName, 'public');
                $utility->image = $imageName;
            }

            $utility->status = 'pending';
            $utility->save();

            // Lưu vào bảng phát sinh
            DB::table('destination_utilities')->insert([
                'destination_id' => $request->destination_id,
                'utility_id'     => $utility->id,
                'status'         => 'nearby',
                'distance'       => $request->distance !== null ? (float) $request->distance : null,
            ]);

            // Gửi thông báo cho admin khi có tiện ích mới (chỉ khi user không phải quản trị)
            $userRole = mb_strtolower(Auth::user()->role->name ?? '');
            if ($userRole !== 'quản trị') {
                $admins = User::whereHas('role', function($q) {
                    $q->whereRaw('LOWER(name) = ?', ['quản trị']);
                })->get();
                foreach ($admins as $admin) {
                    $admin->notify(new NewUtilityCreated($utility, Auth::user()->username));
                }
            }

            DB::commit();
            return redirect()->route('post_articles', [
                'id' => $utility->id,
                'postType' => 'utility'
            ]);
        } catch (\Exception $e) {
            Log::error('Utility store error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
