<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\ModuleDetail;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $module = Module::create([            
            'title' => 'Mengajarkan Disiplin Sejak Dini',
            'slug' => 'mengajarkan-disiplin-sejak-dini',
            'type' => 'parent',
            'description' => 'Panduan bagi orang tua dalam menanamkan kebiasaan disiplin pada anak melalui rutinitas harian yang konsisten dan penuh kasih.',
            'image' => 'modules/images/kid_learn_1.jpg',
            'uploaded_by' => 'admin',
        ]);

        $module_detail = [
            [             
                'module_id' => 1,
                'content' => 'Mulailah dengan membuat jadwal harian sederhana untuk anak, seperti waktu bangun, belajar, dan bermain.',
                'has_image' => true,
                'has_video' => false,
                'image' => 'module-details/images/kid_learn_3.jpg',
                'video' => null,
            ],
            [                
                'module_id' => 1,
                'content' => 'Berikan contoh disiplin dengan konsisten menjalankan aturan yang telah dibuat bersama anak.',
                'has_image' => false,
                'has_video' => true,
                'image' => null,
                'video' => 'https://youtu.be/CUg9p9QDiRM?si=AMFqDp_VANmIPlpR',
            ],
        ];

        foreach($module_detail as $detail){
            ModuleDetail::create($detail);
        }
    }
}
