<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barang = [ [
            'dept_id' => '1',
            'partcode' => 'GENCOU0086RL',
            'description' => 'COUPLER NITTO 2S-A',
            'satuan' => 'NOS',
            'stok_sub' => 25,
            'stok_main' => 100,
            'minimal_stok' => 30,
            'harga' => 140000,
            'created_at'      => \Carbon\Carbon::now('Asia/Jakarta')
        ],[
            'dept_id' => '1',
            'partcode' => 'GENSEN0028RL',
            'description' => 'SENTER KEPALA',
            'satuan' => 'NOS',
            'stok_sub' => 5,
            'stok_main' => 0,
            'minimal_stok' => 2,
            'harga' => 140000,
            'created_at'      => \Carbon\Carbon::now('Asia/Jakarta')
        ],
        [
            'dept_id' => '1',
            'partcode' => 'GENKAW0056RL',
            'description' => 'KAWAT SELING 4 X 200MM SS304',
            'satuan' => 'NOS',
            'stok_sub' => 10,
            'stok_main' => 100,
            'minimal_stok' => 20,
            'harga' => 10800,
            'created_at'      => \Carbon\Carbon::now('Asia/Jakarta')
        ],
        [
            'dept_id' => '2',
            'partcode' => 'GENAIR0028RL',
            'description' => 'AIR CYLINDER CDM2B40 ',
            'satuan' => 'NOS',
            'stok_sub' => 5,
            'stok_main' => 5,
            'minimal_stok' => 5,
            'harga' => 1012000,
            'created_at'      => \Carbon\Carbon::now('Asia/Jakarta')
        ],
        [
            'dept_id' => '2',
            'partcode' => 'GENYARN0001Ri',
            'description' => 'YARN GUIDE ASSY 9381',
            'satuan' => 'NOS',
            'stok_sub' => 100,
            'stok_main' => 0,
            'minimal_stok' => 100,
            'harga' => 190000,
            'created_at'      => \Carbon\Carbon::now('Asia/Jakarta')
        ],
        [
            'dept_id' => '2',
            'partcode' => 'GENSEP0009RI',
            'description' => 'SEPARATOR ROLL WHOLE SET',
            'satuan' => 'NOS',
            'stok_sub' => 10,
            'stok_main' => 5,
            'minimal_stok' => 5,
            'harga' => 10800000,
            'created_at'      => \Carbon\Carbon::now('Asia/Jakarta')
        ],
        [
            'dept_id' => '2',
            'partcode' => 'GENSEA0050RL',
            'description' => 'SEAL KIT CQSB20 SMC',
            'satuan' => 'NOS',
            'stok_sub' => 25,
            'stok_main' => 100,
            'minimal_stok' => 30,
            'harga' => 50000,
            'created_at'      => \Carbon\Carbon::now('Asia/Jakarta')
        ],
        ];
        Material::insert($barang);
//
        //
    }
}
