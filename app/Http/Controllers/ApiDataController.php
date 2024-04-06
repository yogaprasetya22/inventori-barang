<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Kategori;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Weidner\Goutte\GoutteFacade;

class ApiDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $add_days;
    public function __construct()
    {
        $this->add_days = 0;
    }


    public function index()
    {
        $data = [];
        $faker = \Faker\Factory::create('id_ID');
        $kategori = ['Oli', 'Ban', 'Aki', 'Kampas Rem', 'Busi'];

        $oli = [
            ['product_name' => 'Mobil Industrial Turbine Premium', 'product_description' => '- Stabilitas kimia dan termal tingkat tinggi dan ketahanan terhadap pembentukan lumpur dan pernis.- Sifat pelepasan air yang sangat baik.- Per', 'product_price' => 'Rp1.399.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Bahan%20Kimia%2C%20Lem(Perekat)%20%26%20Pengelasan/Penyemprot%2C%20Oli%2C%20Gemuk/Anti%20Karat%2C%20Minyak%20Pelumas/Lain%20-%20lain/Mobil%20Industrial%20Turbine%20Premium/inP105709671-1.jpg'],
            ['product_name' => 'Shell Spirax S3 G (Oli Transmisi Mobil) (Oli Transmisi)', 'product_description' => 'Shell Spirax S3 G 80W.- High Performance Transmission and Gear oil for Mercedes and other OEMs - Longer oil drain capability: Higher reserves', 'product_price' => 'Rp80.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Oli%2C%20Bahan%20Kimia%2C%20Perbaikan/Oli%20Otomotive/Cairan%20Transmisi/Shell%20Spirax%20S3%20G%20(Oli%20Transmisi%20Mobil)%20(Oli%20Transmisi)/P102212318-1.jpg'],
            ['product_name' => 'Mobil Oli Mobil Mesin Diesel Delvac Mx', 'product_description' => 'SAE15W-40', 'product_price' => 'Rp58.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Oli%2C%20Bahan%20Kimia%2C%20Perbaikan/Oli%20Otomotive/Oli%20Mesin/Mobil%20Oli%20Mobil%20Mesin%20Diesel%20Delvac%20Mx/ejP105732523-1.jpg'],
            ['product_name' => 'Shell Oli Mesin Mobil Helix ECO', 'product_description' => '- Pelumas Fully Synthetic yang diformulasikan khusus mobil LCGC (Low Cost Green Car) yang membutuhkan spesifikasi pelumas API SN atau ILSAC GF', 'product_price' => 'Rp99.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Oli%2C%20Bahan%20Kimia%2C%20Perbaikan/Oli%20Otomotive/Oli%20Mesin/Shell%20Oli%20Mesin%20Mobil%20Helix%20ECO/P102212288-1.jpg'],
            ['product_name' => 'Mobil Oli Mobil Mesin Bensin Super 2000 X2', 'product_description' => 'SAE10W-40Volume (L)1PackagingBottle', 'product_price' => 'Rp72.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Oli%2C%20Bahan%20Kimia%2C%20Perbaikan/Oli%20Otomotive/Oli%20Mesin/Mobil%20Oli%20Mobil%20Mesin%20Bensin%20Super%202000%20X2/f7P105732547-1.JPG'],
            ['product_name' => 'Mobil Industrial Way Oils Premium', 'product_description' => '- Karakteristik Friksi Terkontrol- Kapabilitas Multibahan- Separabilitas Air dan Bahan Pendingin Cair- Adhesivitas- Perlindungan Karat dan Ko', 'product_price' => 'Rp1.899.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Bahan%20Kimia%2C%20Lem(Perekat)%20%26%20Pengelasan/Penyemprot%2C%20Oli%2C%20Gemuk/Anti%20Karat%2C%20Minyak%20Pelumas/Lain%20-%20lain/Mobil%20Industrial%20Way%20Oils%20Premium/iwP105709680-1.jpg'],
            ['product_name' => 'KIXX OIL Oli Mobil', 'product_description' => '- Hemat bahan bakar- Tenaga dan mesin terawat- Selang waktu penggantian oli lebih lama- Mencegah terjadinya keausan- Tidak menimbulkan kerak p', 'product_price' => 'Rp109.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Oli%2C%20Bahan%20Kimia%2C%20Perbaikan/Oli%20Otomotive/Oli%20Mesin/KIXX%20OIL%20Oli%20Mobil/hkP108420632-1.jpg'],
            ['product_name' => 'Mobil Oli Mobil Mesin Bensin Spesial', 'product_description' => 'SAE20W-50', 'product_price' => 'Rp41.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Oli%2C%20Bahan%20Kimia%2C%20Perbaikan/Oli%20Otomotive/Oli%20Mesin/Mobil%20Oli%20Mobil%20Mesin%20Bensin%20Spesial/g9P105732585-1.JPG'],
            ['product_name' => 'Mobil Oli Mobil Mesin Diesel Delvac Super 1300', 'product_description' => 'Volume (L)208PackagingDrum', 'product_price' => 'Rp8.199.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Oli%2C%20Bahan%20Kimia%2C%20Perbaikan/Oli%20Otomotive/Oli%20Mesin/Mobil%20Oli%20Mobil%20Mesin%20Diesel%20Delvac%20Super%201300/eqP105732530-1.jpg'],
            ['product_name' => 'Shell Spirax S5 ATF X (Oli Transmisi Mobil Automatic) (Oli Transmisi)', 'product_description' => 'Shell Spirax S5 ATF is a blend of synthetic base stocks with an advanced additive system for automatic and powershift transmissions. It is ful', 'product_price' => 'Rp86.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Oli%2C%20Bahan%20Kimia%2C%20Perbaikan/Oli%20Otomotive/Cairan%20Transmisi/Shell%20Spirax%20S5%20ATF%20X%20(Oli%20Transmisi%20Mobil%20Automatic)%20(Oli%20Transmisi)/P102212295-2.jpg'],
        ];

        $ban = [
            ['product_name' => 'Bridgestone Ban Mobil Techno', 'product_description' => '1. Block Size Combination,Meminimalkan Getaran Ban Untuk Mencegah Keausan Yang Tidak Merata Sehingga Umur Pakai Ban Menjadi Lebih Baik. 2. Opt', 'product_price' => 'Rp729.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Ban%2C%20Bagian%20Kaki%20Mobil/Ban/Bridgestone%20Ban%20Mobil%20Techno/qaP105395946-1.jpg'],
            ['product_name' => 'Bridgestone Ban Mobil Duravis', 'product_description' => '- List Of Tire Superiority. ada 3point- Ban DURAVIS R624 kini hadir, memadukan kecanggihan teknologi ban Bridgestone dan merupakan sebuah kema', 'product_price' => 'Rp1.399.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Ban%2C%20Bagian%20Kaki%20Mobil/Ban/Tires%20for%20Forklift%20Trucks%20%26%20Construction%20Machinery/Bridgestone%20Ban%20Mobil%20Duravis/1eP106295050-1.jpg'],
            ['product_name' => 'Bridgestone Ban Mobil', 'product_description' => '- QUIETERWith minimal tyre noise, you can relax in total peace or stay completely focused on the journey ahead.- SAFERLess to worry, more to e', 'product_price' => 'Rp649.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Ban%2C%20Bagian%20Kaki%20Mobil/Ban/Tires%20for%20Forklift%20Trucks%20%26%20Construction%20Machinery/Bridgestone%20Ban%20Mobil/2jP108232091-1.jpg'],
            ['product_name' => 'Bridgestone Ban Mobil Duravis', 'product_description' => '"Kata ""DURAVIS"", gabungan kata Durable (Ketahanan) dan Latin VIS (Kekuatan), menjelaskan bahwa ban ini memberikan Keamanan Lebih Baik deng', 'product_price' => 'Rp929.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Ban%2C%20Bagian%20Kaki%20Mobil/Ban/Tires%20for%20Forklift%20Trucks%20%26%20Construction%20Machinery/Bridgestone%20Ban%20Mobil%20Duravis/opP103199889-1.jpg'],
            ['product_name' => 'Bridgestone Ban Mobil Turanza', 'product_description' => 'LUXURY PERFORMANCE WITH A QUIET RIDE - Quiet, comfortable ride - Confident wet and dry performance - Long wear life - All-season performance', 'product_price' => 'Rp1.599.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Ban%2C%20Bagian%20Kaki%20Mobil/Ban/Tires%20for%20Forklift%20Trucks%20%26%20Construction%20Machinery/Bridgestone%20Ban%20Mobil%20Turanza/p4P103199904-1.jpg'],
            ['product_name' => 'Bridgestone Ban Mobil Ecopia', 'product_description' => '- Hemat Bahan Bakar- Aman dan Handal - Tahan Lama', 'product_price' => 'Rp819.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Ban%2C%20Bagian%20Kaki%20Mobil/Ban/Tires%20for%20Forklift%20Trucks%20%26%20Construction%20Machinery/Bridgestone%20Ban%20Mobil%20Ecopia/oyP103199898-1.jpg'],
            ['product_name' => 'Bridgestone Ban Mobil Dueler', 'product_description' => 'Ring Velg (inch)16Aspect Ratio70%Width (mm)265Tire Size265/70 R16', 'product_price' => 'Rp2.099.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Ban%2C%20Bagian%20Kaki%20Mobil/Ban/Tires%20for%20Forklift%20Trucks%20%26%20Construction%20Machinery/Bridgestone%20Ban%20Mobil%20Dueler/o6P103199870-1.jpg'],
            ['product_name' => 'Bridgestone Ban Truk Colt Diesel', 'product_description' => 'Rekomendasi untuk semua truk dengan velg ring 16.', 'product_price' => 'Rp2.099.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Ban%2C%20Bagian%20Kaki%20Mobil/Ban/Bridgestone%20Ban%20Truk%20Colt%20Diesel/kpP109208745-1.jpg'],
            ['product_name' => 'GT Radial Ban Mobil Champiro Eco', 'product_description' => '- Konstruksi tapak 3 alur simetris- Alur berbentuk gelombang- Formula Teerbaru untuk lapisan dalam ban- Bahan kompon yang lebih canggih', 'product_price' => 'Rp549.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Ban%2C%20Bagian%20Kaki%20Mobil/Ban/Tires%20for%20Forklift%20Trucks%20%26%20Construction%20Machinery/GT%20Radial%20Ban%20Mobil%20Champiro%20Eco/P103087478-1.jpg'],
            ['product_name' => 'GT Radial Ban Mobil Champiro BXT Pro (Ban Mobil)', 'product_description' => '- Alur dibahu ban diperpanjang. - Variasi jarak blok dan kedalaman alur- Rib tengah lebih lebar- Empat alur utama yang lebar- Telapak ban di d', 'product_price' => 'Rp419.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Ban%2C%20Bagian%20Kaki%20Mobil/Ban/Tires%20for%20Forklift%20Trucks%20%26%20Construction%20Machinery/GT%20Radial%20Ban%20Mobil%20Champiro%20BXT%20Pro%20(Ban%20Mobil)/P103087469-1.jpg'],
        ];

        $aki = [
            ['product_name' => 'GS ASTRA AKI Mobil MF', 'product_description' => '- Tangguh di iklim tropis- Bebas perawatan sehingga tidak perlu lagi mengisi air aki baik accu zuur maupun demineral water (demin water).- Beb', 'product_price' => 'Rp869.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Komponen%20Listrik%2C%20Aki%20Mobil/Aki%2C%20Catu%20Daya/Baterai%20Utama/GS%20ASTRA%20AKI%20Mobil%20MF/P102180730-1.jpg'],
            ['product_name' => 'Taffware Charger Aki Mobil Motor', 'product_description' => '12 V/24 V Charger ini digunakan untuk mengisi baterai mobil dengan tegangan 12 V dan 24 V. Otomotasi Reparasi Charger aki ini sudah dibekali d', 'product_price' => 'Rp299.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Komponen%20Listrik%2C%20Aki%20Mobil/Aki%2C%20Catu%20Daya/Isi%20Ulang/Taffware%20Charger%20Aki%20Mobil%20Motor/raP107924982-1.jpg'],
            ['product_name' => 'ATLASBX Aki Mobil Kering Tipe MF JIS (Accu kering)', 'product_description' => '- Menggunakan teknologicalsium plus, carbon plus, strukstur yg bergelombang dan memiliki grid protection.- Bebas perawatan sehingga tidak perl', 'product_price' => 'Rp809.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Komponen%20Listrik%2C%20Aki%20Mobil/Aki%2C%20Catu%20Daya/Baterai%20Utama/ATLASBX%20Aki%20Mobil%20Kering%20Tipe%20MF%20JIS%20(Accu%20kering)/P102212134-1.jpg'],
            ['product_name' => 'GS ASTRA Aki Mobil Premium (Accu Basah)', 'product_description' => '1. Aki konvensional dengan kualitas prima2. Aki langsung bertenaga optimal segera setelah isi accu zuur.3. Menjadi pilihan utama oleh hampir s', 'product_price' => 'Rp679.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Komponen%20Listrik%2C%20Aki%20Mobil/Aki%2C%20Catu%20Daya/Baterai%20Utama/GS%20ASTRA%20Aki%20Mobil%20Premium%20(Accu%20Basah)/b6P106593402-1.jpg'],
            ['product_name' => 'BOSCH Aki Kering Mobil SM Mega Power Maintenance Free', 'product_description' => 'Performa Optimal. Teknologi Calcium-Calcium untuk tenaga start yang handal. Umur pakai yang lama. Tersegel, bebas perawatan membuatnya minim s', 'product_price' => 'Rp629.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Komponen%20Listrik%2C%20Aki%20Mobil/Aki%2C%20Catu%20Daya/Baterai%20Utama/BOSCH%20Aki%20Kering%20Mobil%20SM%20Mega%20Power%20Maintenance%20Free/P101518459-2.jpg'],
            ['product_name' => 'Taffware Venus Intelligent Battery Charger Aki Mobil', 'product_description' => '12 V 6 A Dengan tegangan sebesar 12 V 6 A charger aki ini dapat mengisi baterai yang terdapat pada kendaraan seperti mobil dan motor agar perf', 'product_price' => 'Rp209.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Komponen%20Listrik%2C%20Aki%20Mobil/Aki%2C%20Catu%20Daya/Isi%20Ulang/Taffware%20Venus%20Intelligent%20Battery%20Charger%20Aki%20Mobil/19P107922045-1.jpg'],
            ['product_name' => 'Taffware Charger Aki Mobil Motor Lead Acid', 'product_description' => 'Colokan EU� Anda mendapat 1 buah kabel EU Plug yang cocok digunakan di Indonesia. 2A / 12V Charger ini digunakan untuk mengisi baterai mobil', 'product_price' => 'Rp67.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Komponen%20Listrik%2C%20Aki%20Mobil/Aki%2C%20Catu%20Daya/Isi%20Ulang/Taffware%20Charger%20Aki%20Mobil%20Motor%20Lead%20Acid/5nP107922203-1.jpg'],
            ['product_name' => 'INCOE Aki Mobil Gold', 'product_description' => 'Aki INCOE Gold NS60 merupakan Aki Hybrid sehingga membutuhkan perawatan yang lebih mudah dibandingkan Aki jenis Premiun (Konvensional). Aki in', 'product_price' => 'Rp639.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Komponen%20Listrik%2C%20Aki%20Mobil/Aki%2C%20Catu%20Daya/Baterai%20Utama/INCOE%20Aki%20Mobil%20Gold/P102927498-1.jpg'],
            ['product_name' => 'Taffware Charger Baterai Aki Mobil Motor LCD Display', 'product_description' => 'Plug Listrik EU Charger aki ini menggunakan plug listrik EU yang merupakan plug standar Indonesia sehingga tidak perlu lagi menggunakan adapto', 'product_price' => 'Rp76.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Komponen%20Listrik%2C%20Aki%20Mobil/Aki%2C%20Catu%20Daya/Isi%20Ulang/Taffware%20Charger%20Baterai%20Aki%20Mobil%20Motor%20LCD%20Display/3wP107924140-1.jpg'],
            ['product_name' => 'Yuasa Aki Basah Mobil New Pafecta', 'product_description' => 'New Pafecta-Produk battery dengan type dry changed yang membuat battery dapat disimpan lebih lama. Pafecta memiliki banyak variant.', 'product_price' => 'Rp639.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Komponen%20Listrik%2C%20Aki%20Mobil/Aki%2C%20Catu%20Daya/Baterai%20Utama/Yuasa%20Aki%20Basah%20Mobil%20New%20Pafecta/gxP102174609-2.jpg'],
        ];

        $kampas = [
            ['product_name' => 'ASPIRA Kampas Rem Cakram Motor (Brake Linning)', 'product_description' => 'Kampas Rem ASPIRA dibuat Standar Original (Genuine Standard), Pakem, Stabil, dan tidak merusak Cakram (Disc Brake)', 'product_price' => 'Rp25.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Onderdil%2C%20Aksesoris%20Motor/Perlengkapan%20Motor/Sistem%20Rem/ASPIRA%20Kampas%20Rem%20Cakram%20Motor%20(Brake%20Linning)/P102180686-1.jpg'],
            ['product_name' => 'Akebonno Kampas Rem Depan', 'product_description' => 'AKEBONNO Brake untuk Performa Rem yang pakem, handal dan awet.Keunggulan :- Ultra Quiet : tidak menghasilkan suara saat di-rem.- Low Dusting :', 'product_price' => 'Rp349.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Onderdil%20Mobil/Rem%2C%20Perlengkapan/Kampas%20Rem%20Cakram/Akebonno%20Kampas%20Rem%20Depan/P102180709-1.jpg'],
            ['product_name' => 'Akebonno Kampas Rem Belakang (Brake Linning)', 'product_description' => 'AKEBONNO Brake untuk Performa Rem yang pakem, handal dan awet.Keunggulan :- Ultra Quiet : tidak menghasilkan suara saat di-rem.- Low Dusting :', 'product_price' => 'Rp369.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Onderdil%20Mobil/Rem%2C%20Perlengkapan/Kampas%20Rem%20Cakram/Akebonno%20Kampas%20Rem%20Belakang%20(Brake%20Linning)/P102180716-1.jpg'],
            ['product_name' => 'MITSUBISHI FUSO Kampas Rem Depan', 'product_description' => 'Kami adalah Distributor Resmi Suku Cadang Asli Kendaraan Mitsubisi FusoPart nomor: MK428329IDNNama Part: LINING KIT,FR BRAKE SHOE (W=140)/ Kam', 'product_price' => 'Rp839.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Onderdil%20Mobil/Rem%2C%20Perlengkapan/Kampas%20Rem%20Cakram/MITSUBISHI%20FUSO%20Kampas%20Rem%20Depan/0dP105473013-1.jpg'],
            ['product_name' => 'MITSUBISHI FUSO Kampas Rem Belakang', 'product_description' => 'Kami adalah Distributor Resmi Suku Cadang Asli Kendaraan Mitsubisi FusoPart nomor:Nama Part: LINING KIT,RR BRAKE SHOE (W=155)/ Kampas Rem Bela', 'product_price' => 'Rp999.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Onderdil%20Mobil/Rem%2C%20Perlengkapan/Kampas%20Rem%20Cakram/MITSUBISHI%20FUSO%20Kampas%20Rem%20Belakang/0mP105473022-1.jpg'],
            ['product_name' => 'AKEBONO Kampas Rem Depan SUZUKI', 'product_description' => 'ApplicationErtiga GL & GX (2017-2018), All New Ertiga (2018-sekarang)', 'product_price' => 'Rp369.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Onderdil%20Mobil/Rem%2C%20Perlengkapan/Kampas%20Rem%20Cakram/AKEBONO%20Kampas%20Rem%20Depan%20SUZUKI/jbP106144695-1.jpg'],
            ['product_name' => 'AKEBONO Kampas Rem Belakang MAZDA', 'product_description' => 'ApplicationMazda CX-3 1.5 (2017-sekarang)', 'product_price' => 'Rp699.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Onderdil%20Mobil/Rem%2C%20Perlengkapan/Kampas%20Rem%20Cakram/AKEBONO%20Kampas%20Rem%20Belakang%20MAZDA/fcP106144552-1.jpg'],
            ['product_name' => 'Ayoto Lampu LED Mobil', 'product_description' => 'Lampu LED Ayoto Mobil di design dengan ketahanan khusus dan kualitas premium.Dilengkapi dengan sistem kecepatan tinggi untuk mendiginkan denga', 'product_price' => 'Rp149.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Komponen%20Listrik%2C%20Aki%20Mobil/Lampu%20Otomotif/Bohlam%20Pengganti/Ayoto%20Lampu%20LED%20Mobil/9tP107870353-1.jpg'],
            ['product_name' => 'AKEBONO Kampas Rem Depan MITSUBISHI', 'product_description' => 'ApplicationXpander (2017-sekarang), All New Livina (2019-now), All New Terios & Rush (2018-now)', 'product_price' => 'Rp419.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Onderdil%20Mobil/Rem%2C%20Perlengkapan/Kampas%20Rem%20Cakram/AKEBONO%20Kampas%20Rem%20Depan%20MITSUBISHI/ibP106144659-1.jpg'],
            ['product_name' => 'AKEBONO Kampas Rem Depan HONDA', 'product_description' => 'ApplicationJazz, City (2004-2007), & Genio', 'product_price' => 'Rp459.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Onderdil%20Mobil/Rem%2C%20Perlengkapan/Kampas%20Rem%20Cakram/AKEBONO%20Kampas%20Rem%20Depan%20HONDA/h1P106144613-1.jpg'],
        ];
        $busi = [
            ['product_name' => 'BRISK Busi Mobil Super', 'product_description' => 'Busi Brisk Super merupakan salah satu varian produk unggulan dari busi mobil merek Brisk. Busi yang dibuat di Czech Republic ini di produksi d', 'product_price' => 'Rp99.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Komponen%20Listrik%2C%20Aki%20Mobil/Kelistrikan/BRISK%20Busi%20Mobil%20Super/P103054939-1.jpg'],
            ['product_name' => 'BRISK Busi Mobil Silver Racing', 'product_description' => 'Busi Brisk Silver Racing ini merupakan busi dengan elektroda tengah yang terbuat dari bahan silver / perak, dengan bentuk busi yang di desain', 'product_price' => 'Rp279.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Komponen%20Listrik%2C%20Aki%20Mobil/Kelistrikan/BRISK%20Busi%20Mobil%20Silver%20Racing/P103054896-1.jpg'],
            ['product_name' => 'BRISK Busi Mobil A-Line', 'product_description' => 'Busi Brisk A-Line merupakan busi dengan fitur "elektroda ground" tunggal berbahan Yttrium. mengapa dinamakan A-line? karena busi ini memiliki', 'product_price' => 'Rp88.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Komponen%20Listrik%2C%20Aki%20Mobil/Kelistrikan/BRISK%20Busi%20Mobil%20A-Line/P103054920-1.jpg'],
            ['product_name' => 'Non Brand Kunci Busi Flexible', 'product_description' => 'DIAPLIKASIKAN UNTUK MOTOR:-HONDA : SUPRA, KHARISMA, MEGAPRO NEW, CBR-YAMAHA : JUPITER, VEGA-SUZUKI : SHOGUN', 'product_price' => 'Rp18.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Perkakas%2C%20Penyimpanan/Perkakas%20Otomotif%20Khusus/Sistem%20Kelistrikan/Non%20Brand%20Kunci%20Busi%20Flexible/guP107774606-1.jpg'],
            ['product_name' => 'BRISK Busi Mobil Premium EVO', 'product_description' => 'Busi Brisk Premium EVO merupakan salah satu varian produk premium dari busi mobil merek Brisk. Busi yang dibuat di Czech Republic ini di produ', 'product_price' => 'Rp389.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Perkakas%2C%20Penyimpanan/Perkakas%20Otomotif%20Khusus/Sistem%20Kelistrikan/BRISK%20Busi%20Mobil%20Premium%20EVO/P103054887-1.jpg'],
            ['product_name' => 'BRISK Busi Mobil Premium Iridium', 'product_description' => 'Busi Brisk Premium + Iridium merupakan salah satu varian produk unggulan dari busi mobil merek Brisk karena ketahanannya. Busi yang dibuat di', 'product_price' => 'Rp239.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Komponen%20Listrik%2C%20Aki%20Mobil/Kelistrikan/BRISK%20Busi%20Mobil%20Premium%20Iridium/P103054902-1.jpg'],
            ['product_name' => 'BRISK Busi Mobil Iridium Racing', 'product_description' => 'Busi Brisk Iridium Racing merupakan salah satu varian produk premium untuk mobil balap dari busi mobil merek Brisk. Busi yang dibuat di Czech', 'product_price' => 'Rp379.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Perkakas%2C%20Penyimpanan/Perkakas%20Otomotif%20Khusus/Sistem%20Kelistrikan/BRISK%20Busi%20Mobil%20Iridium%20Racing/1gP107788052-1.jpg'],
            ['product_name' => 'BRISK Busi Mobil Premium Plus', 'product_description' => 'Jenis mobil:HYUNDAI (All New Tucson GLS, H-1, New Santa Fe 2.4, New Sonata )KIA (Carnival 2.7 V6, Optima TF, Sorento 2.4, Sport LX, Sport Plat', 'product_price' => 'Rp249.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Perkakas%2C%20Penyimpanan/Perkakas%20Otomotif%20Khusus/Sistem%20Kelistrikan/BRISK%20Busi%20Mobil%20Premium%20Plus/0yP107788034-1.jpg'],
            ['product_name' => 'BRISK Busi Mobil', 'product_description' => 'Kelebihan Seri Aline:- Menggunakan bahan Copper/ Tembaga & Yttrium (Performa stabil diatas Iridium)- PnP & cocok untuk harian- Stater lebih mu', 'product_price' => 'Rp95.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Perkakas%2C%20Penyimpanan/Perkakas%20Otomotif%20Khusus/Sistem%20Kelistrikan/BRISK%20Busi%20Mobil/0gP107788016-1.jpg'],
            ['product_name' => 'BRISK Busi Mobil Platin', 'product_description' => 'Busi dengan kontak platinumBerbagai busi dengan elektroda pusat dan kontak platinum. Pengapian sempurna campuran udara / bahan bakar. Interval', 'product_price' => 'Rp189.000', 'product_image_url' => 'https://media.monotaro.id/mid01/small/Otomotif%2C%20Truk%20%26%20Sepeda%20Motor/Komponen%20Listrik%2C%20Aki%20Mobil/Kelistrikan/BRISK%20Busi%20Mobil%20Platin/P103054911-1.jpg'],
        ];

        for ($i = 0; count($kategori) > $i; $i++) {
            $data[] = [
                'kategori' => $kategori[$i],
                'data' => []
            ];
            if ($kategori[$i] == 'Oli') {
                for ($j = 0; count($oli) > $j; $j++) {
                    $data[$i]['data'][] = $oli[$j];
                }
            } else if ($kategori[$i] == 'Ban') {
                for ($j = 0; count($ban) > $j; $j++) {
                    $data[$i]['data'][] = $ban[$j];
                }
            } else if ($kategori[$i] == 'Aki') {
                for ($j = 0; count($aki) > $j; $j++) {
                    $data[$i]['data'][] = $aki[$j];
                }
            } else if ($kategori[$i] == 'Kampas Rem') {
                for ($j = 0; count($kampas) > $j; $j++) {
                    $data[$i]['data'][] = $kampas[$j];
                }
            } else if ($kategori[$i] == 'Busi') {
                for ($j = 0; count($busi) > $j; $j++) {
                    $data[$i]['data'][] = $busi[$j];
                }
            }
        }

        $data_barang = [];

        foreach ($data as $item) {
            for ($i = 0; count($item['data']) > $i; $i++) {
                $nama_barang = $item['data'][$i]['product_name'];
                $kategori = Kategori::where('nama_kategori', $item['kategori'])->first();
                // Menambahkan data ke dalam array
                $data_barang[] = [
                    'url_gambar' => $item['data'][$i]['product_image_url'],
                    'nama_barang' => $nama_barang,
                    'kategori_id' => $kategori->id,
                    'harga' => $item['data'][$i]['product_price'],
                    // 'kuantitas' => rand(1, 100),
                    'kuantitas' => 0,
                    'keterangan' => $item['data'][$i]['product_description'], // Keterangan menggunakan Bahasa Indonesia
                    'created_at' => now(),
                ];
            }
        }
        Barang::insert($data_barang);

        return response()->json([
            'message' => 'Data berhasil di-generate',
            'data' => $data_barang,
        ]);
    }

    /**
     * Display a listing of the resource.
     */

    public function add_barang_masuk()
    {
        $data = [];
        $selected_barang_ids = [];
        $count = 0;

        $barang_kuantitas = Barang::with('kategori')->where('kuantitas', '<', 10)->get();

        for ($i = 0; $barang_kuantitas->count() > $i; $i++) {
            $data_supplier = Supplier::with('kategori')->where('kategori_id', $barang_kuantitas[$i]->kategori->id)->get();

            // Check if $data_supplier is not empty before proceeding
            if (!$data_supplier->isEmpty()) {
                $random_supplier = $data_supplier->random();
                $random_barang_id = $barang_kuantitas[$i]->id;

                // Ensure $random_barang_id is not duplicated
                if (!in_array($random_barang_id, $selected_barang_ids)) {
                    $selected_barang_ids[] = $random_barang_id;
                    $data[] = [
                        'barang_id' => $random_barang_id,
                        'supplier_id' => $random_supplier->id,
                        'nama_barang' => $barang_kuantitas[$i]->nama_barang,
                        'tanggal_masuk' => Carbon::now()->timezone('Asia/Jakarta')->addDays($this->add_days)->format('Y-m-d'),
                        'kategori_id' => $barang_kuantitas[$i]->kategori->id,
                        'kuantitas' => rand(10, 30),
                        'keterangan' => $barang_kuantitas[$i]->keterangan,
                        'created_at' => now(),
                    ];
                    $count++;
                }
            }
        }

        $data_kuantitas_barang = [];

        foreach ($data as $item) {
            $barang = Barang::find($item['barang_id']);
            $data_kuantitas_barang[] = [
                'barang_id' => $item['barang_id'],
                'kuantitas' => $barang->kuantitas + $item['kuantitas'],
            ];
        }

        // Insert the data into the database
        BarangMasuk::insert($data);

        // Update the kuantitas of the barang
        foreach ($data_kuantitas_barang as $item) {
            Barang::where('id', $item['barang_id'])->update(['kuantitas' => $item['kuantitas']]);
        }

        return response()->json([
            'message' => 'Data berhasil di-generate',
            'barang_kuantitas' => $barang_kuantitas->count(),
            'count' => $count,
            'data' => $data,
            'data_kuantitas_barang' => $data_kuantitas_barang,
        ]);
    }


    public function add_barang_keluar()
    {
        // Get the desired data_barang (for example, the first 5 items)
        $data_barang = Barang::with('kategori')->get();

        $data = [];
        $selected_barang_ids = [];
        $count = 0;
        $random_5_40 = rand(5, 20);

        for ($i = 0; $data_barang->count() > $i; $i++) {
            if ($data_barang[$i]->kuantitas > 0) {
                while ($count < $random_5_40) {
                    $barang = $data_barang->random();
                    $data_supplier = Supplier::with('kategori')->where('kategori_id', $barang->kategori->id)->get();

                    // Check if $data_supplier is not empty before proceeding
                    if (!$data_supplier->isEmpty()) {
                        $random_supplier = $data_supplier->random();
                        $random_barang_id = $barang->id;

                        // Ensure $random_barang_id is not duplicated
                        if (!in_array($random_barang_id, $selected_barang_ids)) {
                            $selected_barang_ids[] = $random_barang_id;
                            $data[] = [
                                'barang_id' => $random_barang_id,
                                'nama_barang' => $barang->nama_barang,
                                'tanggal_keluar' => Carbon::now()->timezone('Asia/Jakarta')->addDays($this->add_days)->format('Y-m-d'),
                                'kategori_id' => $barang->kategori->id,
                                'kuantitas' => $data_barang[$i]->kuantitas ? rand(10, $data_barang[$i]->kuantitas) : 1,
                                'keterangan' => $barang->keterangan,
                                'created_at' => now(),
                            ];
                            $count++;
                        }
                    }
                }
            }
        }

        $data_kuantitas_barang = [];

        foreach ($data as $item) {
            $barang = Barang::find($item['barang_id']);
            // Menghitung kuantitas setelah pengurangan, memastikan nilainya tidak negatif
            $kuantitas = max($barang->kuantitas - $item['kuantitas'], 0);
            $data_kuantitas_barang[] = [
                'barang_id' => $item['barang_id'],
                'kuantitas' => $kuantitas,
            ];
        }


        // Insert the data into the database
        BarangKeluar::insert($data);

        // Update the kuantitas of the barang
        foreach ($data_kuantitas_barang as $item) {
            Barang::where('id', $item['barang_id'])->update(['kuantitas' => $item['kuantitas']]);
        }

        return response()->json([
            'message' => 'Data berhasil di-generate',
            'random' => $random_5_40,
            'data' => $data,
            'data_kuantitas_barang' => $data_kuantitas_barang,
        ]);
    }




    /**
     * Show the form for creating a new resource.
     */

    public function scrape()
    {
        $supplier = Supplier::with('kategori')->get();

        return response()->json([
            'message' => 'Data berhasil di-generate',
            'data' => $supplier,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
