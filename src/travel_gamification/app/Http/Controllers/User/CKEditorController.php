<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            if (!$file->isValid()) {
                return response()->json([
                    'uploaded' => 0,
                    'error' => ['message' => 'File upload không hợp lệ!']
                ], 400);
            }

            // Tạo tên file mới (timestamp + tên gốc)
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            // Lưu file vào storage/app/public/uploads
            $path = $file->storeAs('uploads', $filename, 'public');

            // Lấy URL truy cập public
            $url = asset('storage/' . $path);

            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url' => $url
            ]);
        }

        return response()->json([
            'uploaded' => 0,
            'error' => ['message' => 'Không có file được tải lên!']
        ], 400);
    }
}
