<?php
// ===== DATA PRODUK (nanti bakal disave di array) =====
$products = [
    [
        "nama" => "ThinkPad X1 Carbon Gen 9",
        "kategori" => "Laptop",
        "harga" => 12499000,
        "stok" => 8,
        "ikon" => "💻"
    ],
    [
        "nama" => "Headphone Wireless Noise Cancelling",
        "kategori" => "Audio",
        "harga" => 899000,
        "stok" => 15,
        "ikon" => "🎧"
    ],
    [
        "nama" => "Smartphone Galaxy Z Fold 3",
        "kategori" => "Handphone",
        "harga" => 11349000,
        "stok" => 0,
        "ikon" => "📲"
    ],
    [
        "nama" => "Keyboard Ergonomis Mechanical",
        "kategori" => "Aksesoris",
        "harga" => 1749000,
        "stok" => 5,
        "ikon" => "⌨️"
    ],
    [
        "nama" => "SSD Eksternal 1 TB",
        "kategori" => "Penyimpanan",
        "harga" => 1399000,
        "stok" => 3,
        "ikon" => "💾"
    ],
    [
        "nama" => "Smartwatch Pulse 2",
        "kategori" => "Wearable",
        "harga" => 1850000,
        "stok" => 0,
        "ikon" => "⌚"
    ],
    [
        "nama" => "Power Bank 10.000 mAh",
        "kategori" => "Daya",
        "harga" => 229000,
        "stok" => 22,
        "ikon" => "🔋"
    ],
    [
        "nama" => "Earbuds Nano True Wireless",
        "kategori" => "Audio",
        "harga" => 599000,
        "stok" => 11,
        "ikon" => "🎵"
    ]
];

// ===== HITUNG JUMLAH PRODUK (otomatis) =====
$total_produk = count($products);
$total_tersedia = 0;
$total_habis = 0;

foreach ($products as $p) {
    if ($p["stok"] > 0) {
        $total_tersedia++;
    } else {
        $total_habis++;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIA STORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- navbar -->
    <div class="container-navbar">
        <ul class="ul-navbar">
            <li class="li-navbar"><a href="#home">Home</a></li>
            <li class="li-navbar"><a href="#products">Products</a></li>
            <li class="li-navbar"><a href="#contact">Contact</a></li>
        </ul>
    </div>
    <!-- navbar end -->

    <!-- main content -->
    <div class="container-hero" id="home">
        <h1> 𑣲⋆｡˚ Welcome to CIA STORE</h1>
        <p class="hero-text">Toko perangkat dan aksesoris teknologi. Cek stok produk langsung di sini!</p>
        <a href="#products" class="btn-hero">Lihat Produk</a>
    </div>

    <!-- info jumlah produk -->
    <div class="container-info">
        <div class="box-info">
            <h2><?php echo $total_produk; ?></h2>
            <p>Total Produk</p>
        </div>
        <div class="box-info box-hijau">
            <h2><?php echo $total_tersedia; ?></h2>
            <p>Tersedia</p>
        </div>
        <div class="box-info box-merah">
            <h2><?php echo $total_habis; ?></h2>
            <p>Stok Habis</p>
        </div>
    </div>
    <!-- info jumlah produk end -->

    <!-- katalog produk -->
    <h2 class="judul-katalog" id="products">Katalog Produk</h2>
    <div class="container-products">

        <?php foreach ($products as $p) { ?>

            <?php
            // [STUDY CASE TAMBAHAN - PROMO DISKON]
            // Panggil fungsi hitung_diskon() (ada di bagian paling bawah file ini)
            // supaya harga setelah diskon dihitung otomatis oleh PHP, bukan ditulis manual.
            $promo = hitung_diskon($p["harga"]);

            // percabangan: cek stok untuk menentukan status
            if ($p["stok"] > 0) {
                $status = "Tersedia";
                $class_status = "status-tersedia";
            } else {
                $status = "Stok Habis";
                $class_status = "status-habis";
            }
            ?>

            <div class="card">
                <div class="card-gambar"><?php echo $p["ikon"]; ?></div>
                <div class="card-isi">
                    <p class="card-kategori"><?php echo $p["kategori"]; ?></p>
                    <h3 class="card-nama"><?php echo $p["nama"]; ?></h3>
                    <?php if ($promo["dapat_diskon"]) { ?>
                        <!-- [PROMO] Produk >= Rp1.000.000: tampilkan harga normal, % diskon, dan harga setelah diskon -->
                        <div class="promo-box">
                            <p class="promo-baris">
                                <span class="promo-label">Harga normal</span>
                                <span class="harga-coret">Rp <?php echo number_format($promo["harga_normal"], 0, ",", "."); ?></span>
                            </p>
                            <p class="promo-baris">
                                <span class="promo-label">Diskon</span>
                                <span class="badge-diskon"><?php echo $promo["persen"]; ?>%</span>
                            </p>
                            <p class="promo-label">Harga setelah diskon</p>
                            <p class="card-harga">Rp <?php echo number_format($promo["harga_akhir"], 0, ",", "."); ?></p>
                        </div>
                    <?php } else { ?>
                        <!-- [PROMO] Produk < Rp1.000.000: tidak dapat diskon, harga ditampilkan seperti biasa -->
                        <p class="card-harga">Rp <?php echo number_format($p["harga"], 0, ",", "."); ?></p>
                    <?php } ?>
                    <p class="card-stok">Stok: <?php echo $p["stok"]; ?></p>
                    <p class="status <?php echo $class_status; ?>"><?php echo $status; ?></p>

                    <?php if ($p["stok"] > 0) { ?>
                        <button class="btn-beli">Beli</button>
                    <?php } else { ?>
                        <button class="btn-habis" disabled>Stok Kosong</button>
                    <?php } ?>
                </div>
            </div>

        <?php } ?>

    </div>
    <!-- katalog produk end -->
    <!-- main content end -->

    <!-- footer -->
    <div class="container-footer" id="contact">
        <h3>CIA STORE</h3>
        <p>Jam buka: Senin - Sabtu, 09.00 - 20.00</p>
        <p>&copy; <?php echo date("Y"); ?> CIA STORE. All rights reserved.</p>
    </div>
    <!-- footer end -->
</body>
</html>

<?php
function hitung_diskon($harga)
{
    $batas_harga   = 1000000;
    $persen_diskon = 10;

    // percabangan
    if ($harga >= $batas_harga) {
        $nominal_diskon = $harga * $persen_diskon / 100;
        $harga_akhir    = $harga - $nominal_diskon;

        return [
            "dapat_diskon" => true,
            "harga_normal" => $harga,
            "persen"       => $persen_diskon,
            "harga_akhir"  => $harga_akhir
        ];
    }
    
    return [
        "dapat_diskon" => false,
        "harga_normal" => $harga,
        "persen"       => 0,
        "harga_akhir"  => $harga
    ];
}
?>
