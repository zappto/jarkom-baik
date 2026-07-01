<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'PT Teknologi Maju',
                'contact_person' => 'Budi Santoso',
                'phone' => '021-5551234',
                'email' => 'budi@teknologimaju.co.id',
                'address' => 'Jl. Gatot Subroto Kav. 12, Jakarta Selatan',
            ],
            [
                'name' => 'CV Sinar Abadi',
                'contact_person' => 'Siti Rahayu',
                'phone' => '031-7778901',
                'email' => 'siti@sinarabadi.co.id',
                'address' => 'Jl. Raya Darmo Permai No. 45, Surabaya',
            ],
            [
                'name' => 'UD Barokah Jaya',
                'contact_person' => 'Ahmad Hidayat',
                'phone' => '024-5556789',
                'email' => 'ahmad@barokahjaya.com',
                'address' => 'Jl. Pandanaran No. 88, Semarang',
            ],
            [
                'name' => 'PT Indo Perkasa',
                'contact_person' => 'Dewi Lestari',
                'phone' => '061-8884321',
                'email' => 'dewi@indoperkasa.co.id',
                'address' => 'Jl. Sisingamangaraja No. 67, Medan',
            ],
            [
                'name' => 'CV Karya Mandiri',
                'contact_person' => 'Rudi Hermawan',
                'phone' => '022-3334567',
                'email' => 'rudi@karyamandiri.com',
                'address' => 'Jl. Dago No. 123, Bandung',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
