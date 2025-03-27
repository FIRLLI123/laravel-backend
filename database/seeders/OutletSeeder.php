<?php

namespace Database\Seeders;

use App\Models\Outlet;
use Illuminate\Database\Seeder;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $outlets = [
            ['name' => 'ABC Cell', 'address' => 'Jl. Merdeka No. 1'],
            ['name' => 'XYZ Phone', 'address' => 'Jl. Sudirman No. 22'],
            ['name' => 'Gadget Store', 'address' => 'Jl. Diponegoro No. 15'],
            ['name' => 'Techno Shop', 'address' => 'Jl. Ahmad Yani No. 33'],
            ['name' => 'Smart Cell', 'address' => 'Jl. Kartini No. 5'],
        ];
        foreach ($outlets as $outlet) {
            Outlet::create($outlet);
        }
    }
}
