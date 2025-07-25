<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Advance Flume Test Open Channel 12.5 M',
            'slug' => 'Advance-Flume-Test-Ope-Channel-12.5-M',
            'stock' => 100,
            'product_expiration_date' => '2035-12-31',
            'brand' => 'Labtek',
            'kbki_code' => '4826201999',
            'product_type' => 'PDN',
            'product_specifications' => '1. Panjang (saluran air) total : 500 cm., 
                                        2. Lebar (saluran air) : 10 cm ;
                                        3. Tinggi (saluran air) : 20 cm 
                                        4. Rangka (saluran air) : Besi dan Plat
                                        5. Besi Material (saluran air) : Plat Fiberglass 0.8 cm; 
                                        6. Material Bak (saluran air) : Rangka Besi dan Plat Fiberglass 0.5 cm 
                                        7. Material Bak Penampung Air : Rangka Besi dan Plat Fiberglass 
                                        8. Pompa : Pompa Air Type Centrifugal. 
                                        9. Kelengkapan : Bak penampung air (1pc), Meter taraf (1 Pc), 
                                        10. Pintu hambat Terdiri dari : Tajam (1 Pc), Persegi (1 Pc), Bulat (1 Pc) 
                                        11. Ambang, terdiri dari : Lebar (1 Pc), Persegi Panjang (1 Pc), 2 sisi bulat (1 Pc), 1 sisi bulat (1 Pc), Tajam (1 Pc)
                                        ',
            'subcategory_id' => 1,
            'category_id' => 1,
            'status' => 'publish',
            'is_price_displayed' => 'yes',
            'price' => 1700500000,
            'e_catalog_link' => 'https://e-katalog.lkpp.go.id/katalog/produk/detail/52653018?type=general',
        ]);

        ProductImage::create([
            'images' => 'assets/dummy/Product/Product1.png',
            'product_id' => 1
        ]);


        Product::create([
            'name' => 'Basic Hydraulic Bench with Hydrostatic Pressure and Bernoullis Theorem',
            'slug' => 'Basic-Hydraulic-Bench-with-Hydrostatic-Pressure-and-Bernoullis-Theorem',
            'stock' => 100,
            'product_expiration_date' => '2035-12-31',
            'brand' => 'Labtek',
            'kbki_code' => '4826201999',
            'product_type' => 'PDN',
            'product_specifications' => '   1. Pump : Submersible 
                                        2. Max flow: 80 litres/min, 
                                        3. Motor rating 0.25kW 
                                        4. Sump tank capacity : 250 litres 
                                        5. High flow volumetric tank : 40 litres
                                        6. Low flow volumetric tank : 6 litres 
                                        7. Hydrostatic Pressure with : Tank capacity 5.5',
            'subcategory_id' => 1,
            'category_id' => 1,
            'status' => 'publish',
            'is_price_displayed' => 'yes',
            'price' => 279640000,
            'e_catalog_link' => 'https://e-katalog.lkpp.go.id/katalog/produk/detail/52655138?type=general',
        ]);

        ProductImage::create([
            'images' => 'assets/dummy/Product/Product2.png',
            'product_id' => 2
        ]);

        Product::create([
            'name' => 'DRAINAGE & SEEPAGE TANK',
            'slug' => 'DRAINAGE-&-SEEPAGE-TANK',
            'stock' => 100,
            'product_expiration_date' => '2035-12-31',
            'brand' => 'Labtek',
            'kbki_code' => '4826201999',
            'product_type' => 'PDN',
            'product_specifications' => '1. Panjang: 150 cm 
                                        2. Lebar : 15 cm 
                                        3. Tinggi : 60 cm 
                                        4. Material Diding : Plat Fiberglass. 
                                        5. Material Rangka : Besi. 
                                        6. Kelengkapan : Bak air (1 Pc)',
            'subcategory_id' => 1,
            'category_id' => 1,
            'status' => 'publish',
            'is_price_displayed' => 'yes',
            'price' => 118400000,
            'e_catalog_link' => 'https://e-katalog.lkpp.go.id/katalog/produk/detail/52663701?type=general',
        ]);

        ProductImage::create([
            'images' => 'assets/dummy/Product/Product3.png',
            'product_id' => 3
        ]);


        Product::create([
            'name' => 'Impact of Jet',
            'slug' => 'Impact-of-Jet',
            'stock' => 100,
            'product_expiration_date' => '2035-12-31',
            'brand' => 'Labtek',
            'kbki_code' => '4826201999',
            'product_type' => 'PDN',
            'product_specifications' => '1. Nozzle diameter 8mm "
                                        2. Distance between nozzle & target plate 40mm" "
                                        3. Diameter of target plate 36mm" 
                                        4. Target plate : 120° target (cone)
                                        5. 180° hemispherical target, 
                                        6. Flat target, 
                                        7. CUP 135° 
                                        8. Overall dimensions : - Length 0,325m - Width 0,20m - Height 0,50m',
            'subcategory_id' => 1,
            'category_id' => 1,
            'status' => 'publish',
            'is_price_displayed' => 'yes',
            'price' => 59570000,
            'e_catalog_link' => 'https://e-katalog.lkpp.go.id/katalog/produk/detail/52663167?type=general',
        ]);

        ProductImage::create([
            'images' => 'assets/dummy/Product/Product4.png',
            'product_id' => 4
        ]);

        Product::create([
            'name' => 'OSBORNE REYNOLD',
            'slug' => 'OSBORNE-REYNOLD',
            'stock' => 100,
            'product_expiration_date' => '2035-12-31',
            'brand' => 'Labtek',
            'kbki_code' => '4826201999',
            'product_type' => 'PDN',
            'product_specifications' => '   1. Material Tabung : Tabung Fiberglass 0.4 dan 0.5 mm 
                                        2. Material Meja Tabung : Plat Besi 0.3 mm 
                                        3. Dimensi Tabung : 
                                        4. Diameter 30 cm, 
                                        5. Tinggi 35 cm
                                        6. Dimensi Meja Tabung : 
                                        7. Diameter atas 40 cm, 
                                        8. Diameter bawah : 70 cm 
                                        9. Kelengkapan : Bola Kacan : 1 Set; Tinta @ 300 gr/btl : 1 botol',
            'subcategory_id' => 1,
            'category_id' => 1,
            'status' => 'publish',
            'is_price_displayed' => 'yes',
            'price' =>  101750000,
            'e_catalog_link' => 'https://e-katalog.lkpp.go.id/katalog/produk/detail/52649847?type=general',
        ]);

        ProductImage::create([
            'images' => 'assets/dummy/Product/Product5.png',
            'product_id' => 5
        ]);

        Product::create([
            'name' => 'ORIFICE DISCHARGE',
            'slug' => 'ORIFICE-DISCHARGE',
            'stock' => 100,
            'product_expiration_date' => '2035-12-31',
            'brand' => 'Labtek',
            'kbki_code' => '4826201999',
            'product_type' => 'PDN',
            'product_specifications' => '   1. Material Tabung : Fiberglass 0.3 mm 
                                        2. Material Kaki dan Rangka : Pipa besi 
                                        3. Dimensi : Ø Diameter 15 cm, Tinggi 40 cm',
            'subcategory_id' => 1,
            'category_id' => 1,
            'status' => 'publish',
            'is_price_displayed' => 'yes',
            'price' => 59940000,
            'e_catalog_link' => 'https://e-katalog.lkpp.go.id/katalog/produk/detail/52656383?type=general',
        ]);

        ProductImage::create([
            'images' => 'assets/dummy/Product/Product6.png',
            'product_id' => 6
        ]);

        Product::create([
            'name' => 'Laboratory-Coring-Machine',
            'slug' => 'Laboratory-Coring-Machine',
            'stock' => 100,
            'product_expiration_date' => '2035-12-31',
            'brand' => 'Labtek',
            'kbki_code' => '4826201999',
            'product_type' => 'PDN',
            'product_specifications' => '1. Watertank with drain valve c/w clamping device 
                                        2. Coring machine/core bit set Dimension (l x w x h): 800 x 700 x 540 mm',
            'subcategory_id' => 1,
            'category_id' => 1,
            'status' => 'publish',
            'is_price_displayed' => 'yes',
            'price' => 1700500000,
            'e_catalog_link' => 'https://e-katalog.lkpp.go.id/katalog/produk/detail/35664590?type=general',
        ]);

        ProductImage::create([
            'images' => 'assets/dummy/Product/Product7.png',
            'product_id' => 7
        ]);

        Product::create([
            'name' => 'BERNOULLI’S',
            'slug' => 'BERNOULLI’S',
            'stock' => 100,
            'product_expiration_date' => '2035-12-31',
            'brand' => 'Labtek',
            'kbki_code' => '4826201999',
            'product_type' => 'PDN',
            'product_specifications' => '1. Material Meja : Plat Besi 
                                        2. Material Papan Ukur : Plat Fiberglass 
                                        3. Flowmeter : Fiberglass 
                                        4. Pipa : Selang elastis 
                                        5. 8 Lubang manometer air.
                                        ',
            'subcategory_id' => 1,
            'category_id' => 1,
            'status' => 'publish',
            'is_price_displayed' => 'yes',
            'price' => 72150000,
            'e_catalog_link' => 'https://e-katalog.lkpp.go.id/katalog/produk/detail/52646257?type=general',
        ]);

        ProductImage::create([
            'images' => 'assets/dummy/Product/Product8.png',
            'product_id' => 8
        ]);

        Product::create([
            'name' => 'SEDIMENT TRANSPORTATION',
            'slug' => 'SEDIMENT-TRANSPORTATION',
            'stock' => 100,
            'product_expiration_date' => '2035-12-31',
            'brand' => 'Labtek',
            'kbki_code' => '4826201999',
            'product_type' => 'PDN',
            'product_specifications' => '   1. Panjang (saluran air) total : 500 cm
                                        2. Lebar (saluran air) : 10 cm
                                        3. Tinggi (saluran air) : 20 cm 
                                        4. Rangka (saluran air) : Besi dan Plat Besi
                                        5. Material (saluran air) : Plat Fiberglass 0.8 cm
                                        6. Material Bak (saluran air) : Rangka Besi dan 
                                        7. Plat Fiberglass 0.5 cm
                                        8. Material Bak Penampung Air : Rangka Besi 
                                        9. dan Plat Fiberglass
                                        10. Pompa : Pompa Air Type Centrifugal. 
                                        11. Kelengkapan :
                                        12. Bak penampung air (1pc), Meter taraf (1 Pc), 
                                        13. Pintu hambat
                                        14. Terdiri dari : 
                                        15. Tajam (1 Pc), Persegi (1 Pc), Bulat (1 Pc)
                                        16. Ambang, Terdiri dari :
                                        17. Lebar (1 Pc), Persegi Panjang (1 Pc), 
                                        18. 2 sisi bulat (1 Pc), 1 sisi bulat (1 Pc), Tajam (1 Pc)',
            'subcategory_id' => 1,
            'category_id' => 1,
            'status' => 'publish',
            'is_price_displayed' => 'yes',
            'price' => 109890000,
            'e_catalog_link' => 'https://e-katalog.lkpp.go.id/katalog/produk/detail/52665007?type=general',
        ]);

        ProductImage::create([
            'images' => 'assets/dummy/Product/Product9.png',
            'product_id' => 9
        ]);


        Product::create([
            'name' => 'Open Channel Flume Simulator Advance',
            'slug' => 'Open-Channel-Flume-Simulator-Advance',
            'stock' => 100,
            'product_expiration_date' => '2035-12-31',
            'brand' => 'Labtek',
            'kbki_code' => '4826201999',
            'product_type' => 'PDN',
            'product_specifications' => '1. The trainer is a system that illustrates the basic principles of an Open- Channel flow.
                                        2. The trainer consists of five main units, an open channel flume, experimental modules, an operation and control panel, a remote-control unit with a touch screen and a PC unit. 
                                        3. The open channel flume, the operation, control panel, the PC unit are connected to each other by electric and data acquisition cables. The open channel flume consists of reinforced glass sections fixed to a sturdy structure with a shaker plate.
                                        4. The open channel flume acts as a close water cycle as the open channel is supplied with water tanks as supply and drain tanks and a high - power pump. 
                                        5. The open channel flume consists of sections of reinforced glass sides and stainless-steel base fixed to a sturdy metal structure with a shaker plate, two of the glass sections are service stations to supply water at steady flow and to drain water back to tanks. 
                                        6. The tanks are made from stainless steel. 
                                        7. Each section base of the flume has four pressure sensors and four manometers’ connections. Each pressure sensor is coupled with a manometer connection. The couples are positioned at equal spaces along the section. 
                                        8. Each section is also provided with holes to fix the experimental modules (weirs). • The flume is supported on a right and a lift lifting jacks to incline the flume from 0° to 2.4° using their control panels.
                                        9. The whole trainer is operated electrically from the operation and control unit. 
                                        10. The whole trainer can be controlled manually using the operation and control unit or via the software using the remotecontrol unit. 
                                        11. The operation and control unit contains main circuit breakers of the system, safety circuit breakers for the electrical devices contained in the trainer. 
                                        12. A software is installed to the remote-control unit to be easy for the trainees to move around the system to observe the flume and control the system at the same time. 
                                        13. The PC unit demonstrates the process parameters in case of both manual control mode or software control mode.',
            'subcategory_id' => 1,
            'category_id' => 1,
            'status' => 'publish',
            'is_price_displayed' => 'yes',
            'price' => 3270000000,
            'e_catalog_link' => 'https://e-katalog.lkpp.go.id/katalog/produk/detail/66632547?type=general',
        ]);

        ProductImage::create([
            'images' => 'assets/dummy/Product/Product10.png',
            'product_id' => 10
        ]);
    }
}
