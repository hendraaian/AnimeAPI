<?php
// URL API dari Jikan untuk mendapatkan daftar anime yang sedang populer
$apiUrl = "https://api.jikan.moe/v4/anime";

// Mengambil data dari API
$response = file_get_contents($apiUrl);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Anime API</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="src/css/style.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <div class="menu-top">
        <p>Do ea nulla duis sunt laborum voluptate dolore veniam cillum.</p>
    </div>
    <header>
        <nav class="nav-menu">
            <a href="#">Beranda</a>
            <a href="#">List Anime</a>
            <a href="#">Jadwal</a>
            <a href="#">Genre</a>
            <div class="nav-search">
                <form action="" method="get">
                    <input type="text" name="value" placeholder="cari anime..." autocomplete="off">
                    <button type="submit" name="cari">Cari Anime</button>
                </form>
            </div>
        </nav>
    </header>
    <!-- Memeriksa apakah respons berhasil diambil  -->
    <?php if ($response === FALSE) { ?>
    <h1>Gagal Mengambil Data API</h1>
    <?php }else { ?>
    <?php $animeList = json_decode($response, true);//Mengubah respons JSON menjadi array PHP ?>
    <!-- Mencek apakah ada data anime  -->
    <?php if (isset($animeList['data'])) { ?>
    <section class="section-anime">
        <h2>On Going</h2>
        <!-- Implementasi Data ke dalam sturct html -->
        <div class="anime-list">
            <?php foreach ($animeList['data'] as $anime) { ?>
            <div class="anime-card">
                <!-- Menampilkan Gambar -->
                <?php if (isset($anime['images']['jpg']['image_url'])) { ?>
                <img src="<?php echo  $anime['images']['jpg']['image_url']; ?>" alt="img-anime" class="img-anime">
                <?php } ?>
                <div class="card-desk">
                    <h4><?php echo $anime['title']; ?></h4>
                    <p>
                        <!-- Menampilkan Genre -->
                        <?php if (isset($anime['genres']) && !empty($anime['genres'])) { ?>
                        <?php $genres = []; ?>
                        <?php foreach ($anime['genres'] as $genre) { ?>
                        <?php  $genres[] = $genre['name']; ?>
                        <span><?php echo implode(", ", $genres);  // Menggabungkan genre dengan koma; ?></span>
                        <?php } ?>
                        <?php } ?>
                    </p>
                    <p>Episode <?php echo $anime['episodes']; ?></p>
                </div>
                <div class="on-going">
                    <!-- Hari Tayang -->
                    <?php if (isset($anime['broadcast']['day'])) { ?>
                    <p><?php echo $anime['broadcast']['day']; ?></p>
                    <?php }else { ?>
                    <?php echo "Finished"; }?>
                </div>
                <span class="material-symbols-outlined card-icon">
                    star
                </span>
            </div>
            <?php } ?>
        </div>
    </section>
    <?php } ?>
    <?php } ?>
</body>

</html>