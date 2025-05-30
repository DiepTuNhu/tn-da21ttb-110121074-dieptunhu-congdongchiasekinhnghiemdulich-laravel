<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utility;
use App\Models\Destination;
use App\Models\UtilityType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CreateUtilityController extends Controller
{

    public function create()
    {
        $destinations = Destination::where('status', 0)->get();
        $utilityTypes = UtilityType::all();
        return view('user.layout.create_utility', compact('destinations', 'utilityTypes'));
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
            $utility->distance = $request->distance;

            if ($request->hasFile('image')) {
                $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('utility_image', $imageName, 'public');
                $utility->image = $imageName;
            }

            $utility->status = 0;
            $utility->save();

            // Lưu vào bảng phát sinh
            DB::table('destination_utilities')->insert([
                'destination_id' => $request->destination_id,
                'utility_id'     => $utility->id,
                'status'         => 'nearby',
                'distance'       => $request->distance,
            ]);

            DB::commit();
            return redirect()->route('page.post_share')->with('success', 'Tạo tiện ích thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
