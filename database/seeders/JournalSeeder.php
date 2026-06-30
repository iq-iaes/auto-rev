<?php

namespace Database\Seeders;

use App\Models\Journal;
use Illuminate\Database\Seeder;

class JournalSeeder extends Seeder
{
    public function run(): void
    {
        Journal::create([
            'name' => 'Jurnal Pendidikan Indonesia',
            'base_url' => 'https://jpi.example.com',
            'ojs_version' => '3.3.0',
            'description' => 'Jurnal Pendidikan Indonesia adalah jurnal peer-review yang mempublikasikan penelitian tentang pendidikan.',
            'is_active' => true
        ]);

        Journal::create([
            'name' => 'Jurnal Teknologi Informasi',
            'base_url' => 'https://jti.example.com',
            'ojs_version' => '3.2.0',
            'description' => 'Jurnal Teknologi Informasi mempublikasikan artikel tentang inovasi teknologi informasi.',
            'is_active' => true
        ]);
    }
}