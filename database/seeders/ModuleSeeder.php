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

        $module_2 = Module::create([
            'title' => 'Pembelajaran Tentang Hewan',
            'slug' => 'pembelajaran-tentang-hewan',
            'type' => 'children',
            'description' => 'Panduan bagi orang tua dalam menanamkan kebiasaan disiplin pada anak melalui rutinitas harian yang konsisten dan penuh kasih.',
            'image' => 'modules/images/kid_learn_3.jpg',
            'uploaded_by' => 'admin',
        ]);

        $module_detail = [
            [             
                'module_id' => 1,    
                'title' => 'Rutinitas Harian yang Baik: Fondasi Disiplin dan Kemandirian Anak',
                'content' => 'Mulailah dengan membuat jadwal harian yang sederhana namun konsisten untuk anak. Jadwal harian yang terstruktur akan membantu anak merasa lebih aman, disiplin, dan memahami rutinitas sehari-hari. Contohnya, tentukan waktu bangun tidur yang sama setiap hari, waktu makan yang teratur, sesi belajar yang singkat sesuai usia, waktu bermain di luar ruangan, serta waktu istirahat dan tidur malam yang cukup.
Jadwal tidak perlu kaku dan kaku seperti tentara, namun cukup memberikan panduan yang jelas. Misalnya: bangun pukul 06.30, sarapan pukul 07.00, belajar atau bermain edukatif pukul 08.00–09.30, kemudian waktu bermain bebas, dan seterusnya. Yang terpenting adalah konsistensi dan fleksibilitas.
Melalui rutinitas harian yang baik, anak akan belajar mengelola waktu, mengembangkan rasa tanggung jawab, serta membentuk kebiasaan positif sejak dini. Orang tua juga akan lebih mudah mengatur aktivitas keluarga dan mengurangi kekacauan di rumah. Ingatlah, jadwal yang baik bukan untuk membatasi anak, melainkan untuk memberi mereka fondasi yang kuat menuju kedisiplinan dan kemandirian di masa depan.',
                'order' => 1,
                'has_image' => true,
                'has_video' => false,
                'image' => 'module-details/images/kid_learn_3.jpg',
                'video' => null,
            ],
            [                
                'module_id' => 1,
                'title' => 'Membangun Disiplin Positif: Kunci Keberhasilan Pengasuhan Anak',
                'content' => 'Memberikan disiplin yang konsisten merupakan salah satu kunci keberhasilan dalam mendidik anak. Disiplin bukan berarti menghukum, melainkan membimbing anak untuk memahami batasan dan tanggung jawab.
Salah satu cara terbaik adalah melibatkan anak dalam membuat aturan bersama. Misalnya, buatlah kesepakatan keluarga seperti: "Setelah bermain, mainan harus dikembalikan ke tempatnya", "Makan malam dilakukan bersama tanpa gadget", atau "Waktu layar gadget maksimal 1 jam sehari".
Setelah aturan disepakati, orang tua harus konsisten menjalankannya. Jika anak melanggar, berikan konsekuensi yang sudah disepakati sebelumnya, seperti mengurangi waktu bermain atau membersihkan mainan sendiri. Sebaliknya, berikan pujian dan apresiasi ketika anak berhasil menjalankan aturan tersebut.
Konsistensi ini akan membuat anak merasa aman dan paham bahwa aturan bukan sesuatu yang bisa dilanggar sesuka hati. Lambat laun, anak akan belajar mengatur dirinya sendiri dan memahami pentingnya tanggung jawab. Ingat, disiplin yang baik adalah disiplin yang dilakukan dengan kasih sayang dan kesabaran, bukan dengan emosi atau kekerasan.',
                'order' => 2,
                'has_image' => false,
                'has_video' => true,
                'image' => null,
                'video' => 'https://youtu.be/CUg9p9QDiRM?si=AMFqDp_VANmIPlpR',
            ],
            [                
                'module_id' => 2,
                'title' => 'Quiz Seru Tentang Hewan',
                'content' => 'Game untuk anak-anak yang sedang belajar tentang hewan',
                'order' => 1,
                'has_image' => false,
                'has_video' => false,
                'has_game'  => true,
                'image' => null,
                'video' => null,
                'game_type' => 'quiz',
                'game_file' => 'games/quiz/index.html'
            ],
            
        ];

        foreach($module_detail as $detail){
            ModuleDetail::create($detail);
        }
    }
}
