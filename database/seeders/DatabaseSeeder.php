<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\AlatModel;
use App\Models\KategoriModel;
use App\Models\PelangganModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Admin::factory()->create([
            'admin_username' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        KategoriModel::factory()->create([
            'kategori_nama' => 'Mouse',
        ]);
        PelangganModel::factory()->create([
            'pelanggan_nama'=>'Denis',
            'pelanggan_alamat'=>'Tumpang',
            'pelanggan_notelp'=>'081227990998',
            'pelanggan_email'=>'sapapunbisa11@gmail.com',
        ]);
        AlatModel::factory()->create([
            'alat_nama' => 'Rexus',
            'alat_kategori_id' => 1,
            'alat_deskripsi' => 'Mouse',
            'alat_hargaperhari' => 5000,
            'alat_stok' => 500
        ]);
    }
}
