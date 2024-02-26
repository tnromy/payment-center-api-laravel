<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(JenisDokumenTableSeeder::class);
        $this->call(RefTablesTableSeeder::class);
        $this->call(KeteranganJabatanTableSeeder::class);
        $this->call(RequestForUpdateStatusTableSeeder::class);
        $this->call(JenisKepangkatanTableSeeder::class);
        $this->call(RiwayatPendidikanStatusTableSeeder::class);
        $this->call(SukuTableSeeder::class);
        $this->call(KedudukanHukumTableSeeder::class);
        $this->call(KategoriJabatanTableSeeder::class);
        $this->call(JenisJabatanTableSeeder::class);
        $this->call(LokasiTableSeeder::class);
        $this->call(TaspenTableSeeder::class);
        $this->call(KpknTableSeeder::class);
        $this->call(InstansiTableSeeder::class);
        $this->call(KelompokJabatanTableSeeder::class);
        $this->call(AgamaTableSeeder::class);
        $this->call(GolonganTableSeeder::class);
        $this->call(JenisPegawaiTableSeeder::class);
        $this->call(GelarTableSeeder::class);
        $this->call(StatusPerkawinanTableSeeder::class);
        $this->call(AplikasiTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RoleAppsTableSeeder::class);
        $this->call(SystemConfigsTableSeeder::class);
        $this->call(TkPendidikanTableSeeder::class);
        $this->call(PendidikanTableSeeder::class);
        $this->call(LembagaPendidikanTableSeeder::class);
        $this->call(KelompokJabatanFungsionalTableSeeder::class);
        $this->call(JabatanTableSeeder::class);
        $this->call(PeraturanTableSeeder::class);
        $this->call(UnorTableSeeder::class);
        $this->call(NegaraTableSeeder::class);
        $this->call(PegawaiTableSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
