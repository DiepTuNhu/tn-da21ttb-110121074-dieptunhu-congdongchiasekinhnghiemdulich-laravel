<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class ImportAddress extends Command
{
    protected $signature = 'import:address';
    protected $description = 'Import dữ liệu địa chỉ Việt Nam vào database';

    public function handle()
    {
        $jsonPath = storage_path('app/vietnamAddress.json');

        if (!File::exists($jsonPath)) {
            $this->error('❌ Không tìm thấy file vietnamAddress.json trong thư mục storage/data');
            return;
        }

        $json = File::get($jsonPath);
        $data = json_decode($json, true);

        if (!$data || !is_array($data)) {
            $this->error('❌ Dữ liệu JSON không hợp lệ!');
            return;
        }

        // Xác định vùng miền
        $regionMapping = [
            'Miền Bắc' => ['Hà Nội', 'Hải Phòng', 'Quảng Ninh', 'Bắc Ninh', 'Bắc Giang', 'Hà Nam', 'Hải Dương', 'Hòa Bình', 'Hưng Yên', 'Lạng Sơn', 'Nam Định', 'Ninh Bình', 'Phú Thọ', 'Sơn La', 'Thái Bình', 'Thái Nguyên', 'Tuyên Quang', 'Vĩnh Phúc', 'Yên Bái', 'Cao Bằng', 'Bắc Kạn', 'Điện Biên', 'Hà Giang', 'Lai Châu', 'Lào Cai'],
            'Miền Trung' => ['Thanh Hóa', 'Nghệ An', 'Hà Tĩnh', 'Quảng Bình', 'Quảng Trị', 'Thừa Thiên Huế', 'Đà Nẵng', 'Quảng Nam', 'Quảng Ngãi', 'Bình Định', 'Phú Yên', 'Khánh Hòa', 'Ninh Thuận', 'Bình Thuận', 'Kon Tum', 'Gia Lai', 'Đắk Lắk', 'Đắk Nông', 'Lâm Đồng'],
            'Miền Nam' => ['TP Hồ Chí Minh', 'Bình Dương', 'Bình Phước', 'Tây Ninh', 'Đồng Nai', 'Bà Rịa - Vũng Tàu', 'Long An', 'Tiền Giang', 'Bến Tre', 'Trà Vinh', 'Vĩnh Long', 'Đồng Tháp', 'An Giang', 'Cần Thơ', 'Hậu Giang', 'Kiên Giang', 'Sóc Trăng', 'Bạc Liêu', 'Cà Mau']
        ];
        DB::table('wards')->delete();
        DB::table('districts')->delete();
        DB::table('provinces')->delete();
        
        DB::transaction(function () use ($data, $regionMapping) {
            $provinceCount = 0;
            $districtCount = 0;
            $wardCount = 0;

            foreach ($data as $province) {
                // Insert province
                DB::table('provinces')->insert([
                    'code' => $province['Id'],
                    'name' => $province['Name'],
                    'slug' => Str::slug($province['Name']),
                    'region' => $province['Region'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $provinceCount++;

                // Get inserted province id
                $provinceId = DB::table('provinces')->where('code', $province['Id'])->value('id');

                foreach ($province['Districts'] as $district) {
                    // Insert district
                    DB::table('districts')->insert([
                        'code' => $district['Id'],
                        'name' => $district['Name'],
                        'slug' => Str::slug($district['Name']),
                        'province_id' => $provinceId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $districtCount++;

                    // Get inserted district id
                    $districtId = DB::table('districts')->where('code', $district['Id'])->value('id');

                    foreach ($district['Wards'] as $ward) {
                        if (!isset($ward['Id']) || !isset($ward['Name'])) {
                            $this->warn("⚠️ Ward thiếu Id hoặc Name: " . json_encode($ward));
                            continue;
                        }

                        DB::table('wards')->insert([
                            'code' => $ward['Id'],
                            'name' => $ward['Name'],
                            'slug' => Str::slug($ward['Name']),
                            'district_id' => $districtId,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        $wardCount++;
                    }
                }
            }

            $this->info("✅ Nhập dữ liệu thành công!");
            $this->info("Tỉnh: " . $provinceCount);
            $this->info("Huyện: " . $districtCount);
            $this->info("Xã: " . $wardCount);
        });
    }
}

// run:  php artisan import:address