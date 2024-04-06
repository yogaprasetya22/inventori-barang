<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        // create supplier data
        $supplier_oli = [
            ["nama_supplier" => "Panca Jaya EquipmentTelah bergabung selama 15 Tahun", "keterangan" => "0821-3400-0565 | Panca Jaya Equipment merupakan Distributor Peralatan Bengkel Otomotif Terbaik di Surabaya Jawa Timur Indonesia. Cek Produk dan Katalog kami sekarang. Dapatkan Penawaran Harga Terbaik dari Produk Terlengkap kami melalui Sales & Marketing Panca Jaya Equipment. Pesan sekarang juga! Kon"],
            ["nama_supplier" => "PT. Global Gemilang SuksesTelah bergabung selama 2 Tahun", "keterangan" => "PT. Global Gemilang Sukses founded in late 1990�s by Mr. Sudjiatno, it is a family business company engaged in trading lubricant goods and retail business. Selling all kinds of brands for automotive lubricants, in the late 1990�s we approached US Global Petroleum, LTD a lubricant and che"],
            ["nama_supplier" => "PT. Eco Tangguh LubrindoTelah bergabung selama 13 Tahun", "keterangan" => "PT.�ECO TANGGUH LUBRINDO�merupakan supplier atau agen untuk oli/ pelumas dan grease. Kami�siap melayani kebutuhan berbagai merk�pelumas�terkenal seperti PERTAMINA, SHELL, EXXON MOBIL, TOTAL, ENI, REPSOL, CASTROL, GULF, IDEMITSU, KLUBER, FUCHS dll. Hubungi : 0815 832 0002 ( Call / WA )"],
            ["nama_supplier" => "PT. INDO FILTER SEMESTATelah bergabung selama 16 Tahun", "keterangan" => "PT. Indo Filter Semesta Stockist Importir Industrial Filter Equipment"],
            ["nama_supplier" => "PT. KARYA INTERCHEM MITRANIAGATelah bergabung selama 17 Tahun", "keterangan" => "PT. KARYA INTERCHEM MITRANIAGA adalah produsen produk-produk Chemicals untuk maintenance, cleaning, water treatment dan distributor barang-barang kimia kebutuhan industri, oil & gas, dan sebagainya."],
        ];

        $supplier_ban = [
            ["nama_supplier" => "Panca Jaya EquipmentTelah bergabung selama 15 Tahun", "keterangan" => "0821-3400-0565 | Panca Jaya Equipment merupakan Distributor Peralatan Bengkel Otomotif Terbaik di Surabaya Jawa Timur Indonesia. Cek Produk dan Katalog kami sekarang. Dapatkan Penawaran Harga Terbaik dari Produk Terlengkap kami melalui Sales & Marketing Panca Jaya Equipment. Pesan sekarang juga! Kon"],
            ["nama_supplier" => "PT. Denko Wahana SaktiTelah bergabung selama 14 Tahun", "keterangan" => "PT. Denko wana sakti adalah Importir Scissor Lift, Hand Lift, Hand Pallet, Hand Lift Stacker, Hand Lift Stacker Electric, Hand Stacker, Hand Stacker Electric, Scissor Lift, Jual Scissor Lift, Electric Scissor Lift, Jual Scissor Lift Allumunium, Electric Full Scissor, Jual Scissor Lifts, mobile crane"],
            ["nama_supplier" => "PT. Denko Wahana SaktiTelah bergabung selama 10 Tahun", "keterangan" => "PT. Denko Wahana Sakti�merupakan perusahaan�Distributor / Agen Material Handling Equipment. Selain itu kami juga melayani bidang Manufacturing Denko Turbin Ventilator yang siap membantu Anda untuk menyediakan Product Material Handling Equipment, Roda Castor & Turbin Ventilator.Diantara"],
            ["nama_supplier" => "DUTA KHANSA MANDIRITelah bergabung selama 6 Tahun", "keterangan" => "CV.��DUTA KHANSA MANDIRI Menyediakan: Jasa KONTRAK SERIVICE� & Penjualan Sparepart Alat berat dari China, Jepang, Korea maupun UK & USA. Dengan merek XGMA, LIUGONG, XCMG, CHANGLIN, WEICHAI, YUCHAI, CATERPILAR, KOMATSU, CATERPILLAR, HYUNDAI , DOOSAN, KOBELCO, HITACHI, LONKING,"],
            ["nama_supplier" => "Berkat Partindo AbadiTelah bergabung selama 12 Tahun", "keterangan" => "Berkat Partindo Abadi�adalah perusahaan yang berbegerak dalam bidang penjualan�Ban, Velg, Suku Cadang, Aki, Oli, dsb untuk Dump Truck, Mobile Crane, Forklift, Loader, Traktor, Grader, Compactor, Road Roller, Vibro, Tandem, Wheel Dozer, Skidder, Reach Stacker, Straddle Carrier, Gantry Gate, Harvester"],
        ];

        $supplier_aki = [
            ["nama_supplier" => "Pegasus HikariTelah bergabung selama 14 Tahun", "keterangan" => "Pegasushikari.co.id | Pegasus Hikari merupakan pabrik produsen yang menyediakan & jual air aki, air zuur, air radiator coolant, semir ban, silikon pengkilap, kanebo chamois di Surabaya. Cek produk & katalog kami lainnya, dapatkan Penawaran Spesial Termurah melalui Admin Pegasus Hikari. Hub 0812-3202"],
            ["nama_supplier" => "PT. SARANA TEKNIK GROUPTelah bergabung selama 12 Tahun", "keterangan" => "PT. SARANA TEKNIKJln. Wonodri Sendang Raya No. 15ATelp: 024 � 3566377Email: sarana_smg@cbn.net.idWebsite: www.sarana-teknik.comJual: WIREMESH, MESIN CRUSHER, JAW CRUSHER, DAN UNIT CONVEYORProduk:BACKSTOP/CLUTCH BRAKE: Shinko Sinfonia, KEB, Mitsubishi, Osaka, Suntes, Airflex Eaton, Warner, dll."],
            ["nama_supplier" => "PT. SARANA GEAR MOTOR BONFIGIOLI ROSIITelah bergabung selama 7 Tahun", "keterangan" => "Sarana Teknik Group sebagai distributor terkemuka untuk transmisi daya berkualitas, mekanis & produk motor listrik. Melalui perwakilan penjualan di seluruh Indonesia, yang terlatih juga memberikan bantuan teknis kepada pelanggan kami senantiasa memberikan layanan yang prima dengan menjaga kualitas p"],
            ["nama_supplier" => "PT. BALFILTRACS INDONESIATelah bergabung selama 12 Tahun", "keterangan" => "PERUSAHAAN KAMI ADALAH DISTRIBUTOR / DEALER / AGEN / STOCKIST BERBAGAI MACAM FILTER-FILTER UNTUK KEBUTUHAN ENGINE DIESEL, AKI, DIESELPARTS, RADIATOR COOLANT, HYDRAULIC SEAL KIT, MINYAK REM, VAN BELT, STARTER MOTOR, ALTERNATOR, STICK SOUNDING, LUBRICANT, GREASE, BEARING, DLL"],
            ["nama_supplier" => "PT. SARANA TEKNIKTelah bergabung selama 15 Tahun", "keterangan" => "PT. Sarana Teknik adalah Perusahaan yang menjadi distributor transmisi tenaga mekanik & produk motor listrik dengan product sebagai berikut : BALDOR MOTOR DODGE COUPLING, DODGE BEARING FALK COUPLING REXNORD COUPLING, REXNORD CHAIN ADDAX COUPLING, THOMAS, FENNER BELT COUPLING PULLEY , SIHI PUMP, etc."],
        ];

        $supplier_kampas = [
            ["nama_supplier" => "Bayu Jaya PackingTelah bergabung selama 1 Tahun", "keterangan" => "Specialist Paking Gasket & Supplier."],
            ["nama_supplier" => "CV. Sinar GemilangTelah bergabung selama 8 Tahun", "keterangan" => "Perkenalkan Kami dari

TOKO SINAR GEMILANG

(SPESIALIS PACKING GASKET) kami menjual produk segala jenis Packing Gasket dan Kebutuhan Industri seperti Klingerit packing tombo type, 1000 , 1303, 1100, 1935, 1120, 1995 dll, Packing Valqua type 1500, 1501Ac, 6500 dll, Packing gabus karet, Packing klinge"],
            ["nama_supplier" => "PT. Mandiri Niagamas CemerlangTelah bergabung selama 6 Tahun", "keterangan" => "PT. MANDIRI NIAGA MAS CEMERLANG adalah�perusahan penyedia alat kebutuhan industri seperti Gland Packing, Sheet Packing, Rubber Packing, Conveyor Belt,  Industrial Machine, Machining, Heat Insulation, Rubber Lining, Casting, Mechanical Seal, Manufacturing, Elastomer Bearing Pad, Chemical Coal Additiv"],
            ["nama_supplier" => "Subur Teknik PratamaTelah bergabung selama 3 Tahun", "keterangan" => "Kami merupakan distributor dan spesialis untuk produk: Spiral Wound Gasket, Carbonized Fiber Packing, Expanded Graphite with wire packing, Aramid Fiber packing, Ramie Packing, Gasket Tombo, Gland packing, Asbestos PTFE packing, Ceramic Packing, Fiberglass Packing dan lainnya dengan harga terjangkau."],
            ["nama_supplier" => "PT. Arisco MandiriTelah bergabung selama 17 Tahun", "keterangan" => "Arisco Mandiri adalah supplier sparepart alat berat di Jakarta unit Komatsu, Perkins, Yanmar, Caterpillar, Kobelco, Volvo untuk tipe unit Excavator, Bulldozer, Dump Truck, Wheel Loader, Motorgrader."],
        ];

        $supplier_busi = [
            ["nama_supplier" => "Virera MandiriTelah bergabung selama 16 Tahun", "keterangan" => "Kami adalah perusahaan yg bergerak di bidang pengadaan barang dan solusi kebutuhan industri. Beberapa Brand Eropa dan Asia yang kami wakili di Indonesia adalah: 1. SENSOR dan TRANSDUCERS 2. INSTRUMENTS, 3. TEMPERATURE DAN PRESSURE GAUGES. 4. POWER DC and Power Supply. 5. WEIGHING AND CONTROL. 6. PUM"],
            ["nama_supplier" => "HANDI CIPTA PERKASATelah bergabung selama 13 Tahun", "keterangan" => "Kami Adalah Perusahaan Yang Bergerak Dalam Penyediaan Suku Cadang Untuk Mesin-Mesin Industri, Alat Berat, Genset, Truck, Dll Suku Cadang Yang Kami Sediakan Diantaranya Untuk : Cummins Komatsu Caterpillar Kobelco Hitachi Perkins Furukawa Deutz Detroit Diesel Scania Volvo Mitsubishi Nissan Hino John D"],
            ["nama_supplier" => "PD. MULTI PARTINDO JAYATelah bergabung selama 14 Tahun", "keterangan" => "Perusahaan kami bergerak di bidang penjualan spare part alat berat, genset serta engine marine. Dimana kami menjual spare part untuk segala engine Caterpillar, Cummins, Komatsu, Nissan, Mitsubishi, Kobelco, Hitachi, Bomag dll. Kami juga menyediakan teknikal supplay untuk Perusahaan yang membutuhkan"],
            ["nama_supplier" => "Indo AutozoneTelah bergabung selama 11 Tahun", "keterangan" => "Indo Autozone merupakan solusi terlengkap dan terpercaya untuk kebutuhan ban dan suku cadang untuk kendaraan industrial khususnya forklift dan alat- alat berat yang digunakan di area konstruksi, pertambangan & pertanian seperti loader, grader, dozer, crane, traktor, roller, compactor, vibro, skid st"],
            ["nama_supplier" => "PT. DWI SUBUR MAKMURTelah bergabung selama 16 Tahun", "keterangan" => "PT. DWI SUBUR MAKMUR berdiri sejak tahun 2003. Aktivitas utama kami adalah perusahaan perdagangan yang menyediakan kebutuhan barang bagi Industri yang ada di Indonesia/ Dalam maupun Luar Negeri meliputi bidang Automation System dan Electrical Components."],

        ];

        $kategori = ['Oli', 'Ban', 'Aki', 'Kampas Rem', 'Busi'];

        $data = [];

        for ($i = 0; count($kategori) > $i; $i++) {
            $data[] = [
                'kategori' => $kategori[$i],
                'data' => []
            ];
            if ($kategori[$i] == 'Oli') {
                for ($j = 0; count($supplier_oli) > $j; $j++) {
                    $data[$i]['data'][] = $supplier_oli[$j];
                }
            } else if ($kategori[$i] == 'Ban') {
                for (
                    $j = 0;
                    count($supplier_ban) > $j;
                    $j++
                ) {
                    $data[$i]['data'][] = $supplier_ban[$j];
                }
            } else if ($kategori[$i] == 'Aki') {
                for ($j = 0; count($supplier_aki) > $j; $j++) {
                    $data[$i]['data'][] = $supplier_aki[$j];
                }
            } else if ($kategori[$i] == 'Kampas Rem') {
                for ($j = 0; count($supplier_kampas) > $j; $j++) {
                    $data[$i]['data'][] = $supplier_kampas[$j];
                }
            } else if ($kategori[$i] == 'Busi') {
                for ($j = 0; count($supplier_busi) > $j; $j++) {
                    $data[$i]['data'][] = $supplier_busi[$j];
                }
            }
        }


        $data_supplier = [];
        foreach ($data as $key => $value) {
            foreach ($value['data'] as $key2 => $value2) {
                $kategori = Kategori::where('nama_kategori', $value['kategori'])->first();
                $data_supplier[] = [
                    'nama_supplier' => $value2['nama_supplier'],
                    'alamat' => $faker->address,
                    'no_telp' => $faker->phoneNumber,
                    'keterangan' => $value2['keterangan'],
                    'kategori_id' => $kategori->id,
                    'created_at' => now(),
                ];
            }
        }


        \App\Models\Supplier::insert($data_supplier);
    }
}
