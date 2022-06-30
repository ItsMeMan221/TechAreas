-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2022 at 05:32 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `20212_wp2_412020004`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `tanggal_dibuat` date DEFAULT NULL,
  `admin_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `segmentasi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `gambar`, `isi`, `tanggal_dibuat`, `admin_id`, `status_id`, `segmentasi_id`) VALUES
(3, 'Infinix Note 12 VIP Resmi Melenggang di Indonesia! Inilah Harganya!', '../uploads/gambarArtikel/01bb12c6091d6b40d79d5af8621de845.jpg', 'Tak lama setelah meluncurkan Infinix Note 12, Infinix kembali menghadirkan produk terbarunya, yakni Infinix Note 12 VIP. Masih mengusung kekhasan fitur Note, Infinix Note 12 VIP juga membawa berbagai fitur unggulan yang tentunya akan memudahkan pengguna di kehidupan sehari-hari.\r\n\r\nKehadiran Infinix Note 12 VIP dikhususkan untuk mempermudah pengguna di dalam kehidupan sehari-hari. Hal itu terlihat dari teknologi charging mutakhir yang bisa #NgechargeSecepatKilat. Smartphone ini juga masih membawa tema #TaklukanBatas.\r\n\r\n“Note 12 VIP adalah manifestasi inovasi tiada henti Infinix untuk konsumen smartphone anak muda Indonesia. Bisa dibilang, Infinix Note 12 VIP membawa pengalaman menggunakan smartphone khas seri Note yang premium namun tetap mengedepankan performa mumpuni,” ucap Sergio Ticoalu, Country Marketing Manager Infinix Indonesia.\r\n\r\nInfinix mengintegrasikan smartphone Note 12 VIP dengan 120W Hyper Charge dan baterai 4500mAh untuk memberi pengguna kapasitas baterai maksimal dan kecepatan pengisian supersonik yang memberi daya perangkat dari 0% hingga 100% daya baterai hanya dalam 17 menit.\r\n\r\nUntuk membantu mencapai kemampuan pengisian cepat, Infinix menggabungkan dual charge-pump dan dual-cell battery. Hal ini memungkinkan Note 12 VIP untuk menyesuaikan tegangan dan arus listrik ke rasio optimal, serta menggandakan input yang tersedia.\r\n\r\nUntuk menjaga pengisian cepat aman, smartphone ini juga menyertakan 103 fitur dan perlindungan baterai, yang mencakup seluruh siklus pengisian daya untuk pengisi daya, sirkuit, dan baterai. Selain itu, Note 12 VIP juga memiliki 18 sensor termal untuk memantau suhu perangkat secara real-time untuk memastikan pengisian daya selalu aman.\r\n\r\nLebih lanjut, Infinix Note 12 VIP menggunakan bahan superkonduktor platinum yang meningkatkan ketahanan akan korosi di kabel pengisi daya untuk ketahanan bahan pengisi daya yang besar. 120W Hyper Charge dari Note 12 VIP juga sudah lolos sertifikasi TüV Rheinland Safe Fast-Charge System.\r\n\r\nNote 12 VIP menawarkan desain yang stylish dan canggih yang dibalut dengan fitur performa tinggi untuk menciptakan smartphone yang ideal. Perangkat ini adalah yang pertama menggunakan bahan utilize aerospace-grade ultra-thin glass fiber dengan tekstur kaca dan kekuatan serat karbon.\r\n\r\nTak lupa desain ultra-ramping 7,89 mm yang beratnya hanya 199 gram. Infinix Note 12 VIP menggunakan layar AMOLED FHD+ berukuran 6,7 inci yang memberi pengguna layar tajam yang dikemas dengan fitur gambar penting seperti color gamut 100% DCI-P3, kedalaman warna 10-bit dengan lebih dari 1 miliar warna.\r\n\r\nTak hanya itu, Infinix Note 12 VIP juga punya dukungan layar yang memberi pengguna pengalaman visual dengan sangat halus berkat ultra-refresh rate 120Hz yang tajam dan pengambilan sampel sentuh 360Hz yang langsung disinkronkan dengan setiap sentuhan.\r\n\r\nSementara, kehadiran Cinematic Triple Camera 108 MP di Infinix Note 12 VIP juga dibantu oleh lensa sudut ultra-wide 13 MP dan lensa kedalaman dengan Laser Detection Auto Focus. Kamera ini menggabungkan sensor 1/1,67 inci dengan resolusi ultra-tinggi 12000 x 9000. Sementara di bagian depan, terdapat kamera dengan resolusi 16 MP.\r\n\r\nBagaimana dengan dapur pacunya? Infinix membekali Note 12 VIP dengan chipset MediaTek Helio G96. Chipset dengan CPU Octa-core ini menggabungkan dua inti Arm Cortex-A76 yang kuat dengan clock hingga 2,05 GHz dan dukungan GPU Arm Mali G57.\r\n\r\nDi sesi first Sale ini, Infinix Note 12 VIP bisa konsumen dapatkan dengan harga Rp3.799.000. Tak kalah seru, di dalam kotak kemasan Infinix Note 12 VIP terdapat Starter Pack Smartfren dengan bonus kuota 17GB/bulan (syarat dan ketentuan berlaku).', '2022-06-09', 8, 2, 1),
(5, 'ASUS Indonesia Akan Jual Laptop Gaming CPU AMD Ryzen Terbaru Bulan Ini, Siapkan Tabunganmu!', '../uploads/gambarArtikel/07b1c2bbac0f9895f5b74d0a680d6d0c.jpg', ' ASUS Indonesia akan segera menghadirkan jajaran laptop gaming dengan prosesor AMD Ryzen™ 6000 kepada konsumen Indonesia dari berbagai macam seri dan segmen konsumen.\r\n\r\nLaptop-laptop yang dibawa ASUS mulai dari seri TUF yang sudah berstandar militer sampai Zeophyrus Duo yang sudah menggunakan sistem dua layar.\r\n\r\nNamun ASUS tidak hanya mengganti CPU yang digunakan, namun juga melakukan beberapa pembaharuan dari segi cooling, layar,fitur, audio dan visual untuk seri-seri laptopnya ini.\r\n\r\n“Adalah tanggung jawab kami sebagai brand laptop gaming nomor satu untuk menghadirkan inovasi teknologi terkini di Indonesia,” ujar Jimmy Lin, ASUS Southeast Asia Regional Director.\r\n\r\n“Selain menjadi brand pertama yang menghadirkan laptop gaming dengan prosesor AMD Ryzen™ 6000 Series di Indonesia, ASUS ROG juga akan menghadirkan jajaran laptop gaming yang sangat lengkap mulai dari laptop gaming untuk gamer mainstream, content creator, gamer e-sports, hingga game streamer.”\r\n\r\nLine Up Laptop ASUS Dengan CPU AMD Ryzen 6000\r\n\r\nUntuk tahun 2022 ini, ASUS melakukan pembaharuan terhadap line up laptopnya yang menggunakan CPU AMD khususnya prosesor AMD Ryzen™ 6000.\r\n\r\nMulai dari ASUS TUF Gaming A15 yaitu laptop gaming kelas mainstream berperforma tinggi dan menjadi favorit berkat harga yang menarik di kelasnya.\r\n\r\nASUS juga membawa ROG Strix G15 & G17 dengan prosesor AMD terbaru yang dirancang bagi para pemain e-sports karena memiliki refresh rate tinggi dan respons yang cepat.', '2022-06-11', 10, 2, 2),
(6, 'Tampilan asli ponsel Samsung Galaxy Z Flip 4 Bocor', '../uploads/gambarArtikel/a9b71bba95be7227a663b00c4aaa3101.jpg', 'Samsung diprediksi akan meluncurkan dua seri smartphone baru dari lini ponsel lipat mereka tahun ini. Kabarnya, perusahaan asal Korea Selatan ini tidak lama lagi akan mengadakan acara untuk peluncuran kedua perangkat tersebut. \r\n\r\nAcara peluncuran diperkirakan bakal dilaksanakan Samsung pada 10 Agustus 2022 mendatang. Perusahaan tampaknya akan memperkenalkan perangkat Samsung Galaxy Z Fold 4, Samsung Galaxy Z Flip 4 dan Galaxy Watch 5 dalam peluncuran kali ini.  \r\n\r\nKendati masih beberapa bulan sebelum peluncuran, gambar asli dari ponsel lipat Samsung Galaxy Z Flip 4 telah bocor di internet. Foto Samsung Galaxy Z Flip 4 ini pertama kali dibagikan oleh TechTalkTV untuk mengungkap desain perangkat. \r\n\r\nDari bocoran foto perangkat tersebut, tidak ada perubahan desain yang besar pada Samsung Galaxy Z Flip 4. Melansir dari Gizmochina (13/6), tampilan keseluruhan ponsel lipat ini identik dengan generasi sebelumnya, yaitu Galaxy Z Flip 3.\r\n\r\nPada bagian depan, Galaxy Z Flip 4 akan menawarkan bezel yang sedikit lebih tipis. Ini masih menampilkan layar yang dapat dilipat dengan lubang punch yang diposisikan secara terpusat. Lebih lanjut, laporan dari TechTalkTV mengklaim, layar Galaxy Z Flip 4 akan memiliki lipatan yang lebih dangkal dibandingkan pendahulunya. Selain itu, layar sekunder perangkat foldable smartphone ini juga akan sedikit lebih besar dari Galaxy Z Flip 3. \r\n\r\nGalaxy Z Flip 4 diprediksi akan lebih ringan dari model sebelumnya. Ini terlihat dari ukuran engsel ponsel lipat ini juga terlihat jauh lebih tipis dibandingkan Galaxy Z Flip 3. Samsung menawarkan desain yang berbeda dengan adanya sedikit celah yang terlihat ketika perangkat ditutup. Perubahan ini diharapkan dapat memperpanjang umur ponsel serta memberikan pengalaman yang lebih baik untuk pengguna.\r\n\r\nPerangkat ini masih menampilkan desain dual-tone dengan dukungan tampilan penutup sistem dual-kamera. Samsung juga menambahkan pemindai sidik jari yang menghadap ke samping pada Galaxy Z Flip 4. \r\n\r\nLaporan ini juga menyebut, Galaxy Z Flip 4 akan menawarkan daya tahan baterai yang lebih besar. Samsung diperkirakan bakal menghadirkan baterai berkekuatan 3.700 mAh untuk disandingkan dengan chipset yang lebih hemat. Ini akan membawa dukungan untuk pengisian cepat 25W dan pengisian nirkabel. \r\n\r\nSebagai informasi, laporan sebelumnya telah mengungkapkan bahwa Galaxy Z Flip 4 akan datang dengan layar lipat AMOLED FHD+ 120Hz 6,7 inci. Dapur pacu perangkat akan menggunakan chipset Snapdragon 8+ Gen 1 yang didukung RAM 12 GB dengan penyimpanan internal 512 GB.', '2022-06-12', 8, 2, 1),
(7, 'Gadget dan Laptop di Eropa Bakal Wajib Pakai USB-C, Fast Charging HP Juga Sama', '../uploads/gambarArtikel/f0b14ec7cb30bc7ac2b750dbc5e391be.jpg', 'Setelah beberapa lama menjadi pembicaraan, kini Komisi Uni Eropa (EU) bersepakat membuat UU tentang standar port USB Type-C untuk perangkat elektronik yang dijual di Eropa.\r\n\r\nSetelah disahkan nanti, UU itu baru akan berlaku efektif 2 tahun setelah diterbitkan, yaitu sekitar Juli-September 2024.\r\n\r\nInilah jenis perangkat elektronik di Eropa yang wajib memakai port USB C mulai tahun 2024 :\r\n\r\n-Smartphone\r\n-Tablet\r\n-Kamera digital\r\n-Earbud/ True Wireless Stereo\r\n-E-reader\r\n-Headphone dan headset\r\n-Konsol game portable\r\n-Speaker portable\r\n-Keyboard\r\n-Mouse\r\n-Laptop\r\n\r\nKhusus untuk vendor laptop diberikan waktu lebih lama, yaitu sekitar 3 tahun 4 bulan untuk mematuhi kewajiban tersebut, atau mulai tahun 2025 mendatang.\r\n\r\nSaat ini beberapa produk laptop seperti Apple, Dell, Asus, serta Lenovo sudah mulai diberikan port USB-C.\r\n\r\nSedangkan vendor smartphone Android kini sudah beralih memakai port USB-C, meski masih ada sedikit yang menyertakan port Micro USB.\r\n\r\nApple berbeda sendiri, karena iPhone masih memakai port Lightning.\r\n\r\nNamun sudah jelas, bahwa 2 hingga 3 tahun ke depan, seluruh merek perangkat elektronik di Eropa harus memakai charger USB Type-C.\r\n\r\nLalu apa tujuan dibuat aturan port charger USB-C itu.\r\n\r\nTernyata tujunanya untuk melindungi lingkungan, yaitu membantu mengurangi limbah elektronik.\r\n\r\nMenurut anggota Parlemen EU, Malta Alex Agius Saliba, jumlah adapter charger yang tidak dipakai diperkirakan menjadi limbah elektronik 11.000-15.000 ton per tahun.\r\n\r\nBayangkan jika semua alat elektronik memakai port USB C, maka pemilik cukup punya satu buah charger yang bisa dipakai untuk beberapa perangkat.\r\n\r\nJadi tak perlu membeli charger baru saat membeli gadget baru, seperti dilansir The Verge.Jika dihitung, pemakaian USB-C untuk semua alat elektronik di Eropa akan menghemat hingga 250 juta euro (setara Rp 3,8 triliun) per tahun, yaitu dari hilangnya biaya pembelian charger.', '2022-06-14', 8, 2, 2),
(8, 'Video konsep Samsung Galaxy S23 Ultra tampilkan kamera 200 MP', '../uploads/gambarArtikel/0d6e291b0ccdb486049f4f9d75468478.jpg', 'Saat ini Samsung sedang mengembangkan ponsel flagship Galaxy S23 mendatang. Terdapat video konsep yang memberikan informasi ponsel ini akan mendukung kamera 200 MP.\r\n\r\nSamsung sedang mengerjakan ponsel flagship seri Galaxy S generasi berikutnya dan detail tentang ponsel mendatang ini telah bocor secara online beberapa kali. Salah satu perangkat dari seri ini, yakni Galaxy S23 Ultra dikabarkan akan memiliki sensor kamera 200 MP, dimana kemudian Technizo membuat video render yang menampilkan seperti apa modul kamera pada ponsel flagship tersebut.\r\n\r\nSesuai laporan, Samsung Galaxy S23 Ultra akan dilengkapi dengan sensor Samsung HM1 ISOCELL 200 megapiksel. Patut dicatat bahwa prosesor seperti Qualcomm Snapdragon 8 Gen 1 mendukung resolusi kamera tunggal maksimum hingga 200 MP.\r\n\r\nDi sisi lain, dua model lain dalam jajaran, Galaxy S23 dan Galaxy S23 Plus diharapkan memiliki sensor kamera utama 108 MP. Ketiga model itu akan hadir dengan beberapa sensor kamera di panel belakang.\r\n\r\nDilansir dari Gizmochina (9/6), berdasarkan laporan sejauh ini ponsel seri Galaxy S23 akan hadir dengan layar LTPO serta refresh rate dinamis mulai dari 10 Hz hingga 120 Hz. Perangkat ini akan ditenagai oleh prosesor Qualcomm Snapdragon 8 Gen 2 dan chipset flagship Samsung Exynos, tergantung pada wilayahnya.\r\n\r\nPerangkat itu akan dilengkapi dengan modem Qualcomm X70 5G untuk fitur konektivitas yang lebih baik. Adapun soal perangkat lunak, ponsel ini akan menjalankan sistem operasi Android 13 terbaru dengan One UI 5 khas Samsung. Berikut adalah video komsep Galaxy S23 Ultra dengan 200 MP', '2022-06-14', 1, 2, 1),
(9, 'Google Pixel 6a muncul di Facebook Marketplace', '../uploads/gambarArtikel/83f9c188244b9eb971934ea0935a66e6.png', 'Menjelang perilisan, ponsel pintar buatan Google yaitu Pixel 6a sempat beredar dan terdaftar dalam situs penjualan Facebook.\r\n\r\nGoogle bakal meluncurkan smartphone terbaru mereka yaitu Google Pixel 6a pada 28 Juli 2022 mendatang. Namun menjelang perilisan resminya, ponsel pintar tersebut sempat terdaftar dan dijual pada situs penjualan Facebook Marketplace. \r\n\r\nMelansir dari Gizmochina (7/6), Google Pixel 6a sebelumnya juga pernah beredar melalui video unboxing yang diunggah salah satu akun di TikTok. Meski saat ini daftar Pixel 6a telah dihapus dari Facebook Marketplace, diduga daftar tersebut diunggah oleh pengguna akun yang sama dengan video unboxing yang tersebar di TikTok tersebut. \r\n\r\nSeperti yang terdapat pada video unboxing, Google Pixel 6a yang sempat didaftarkan pada Facebook Marketplace juga menggunakan model warna hitam. Melalui dua bocoran tersebut, diketahui ponsel Pixel 6a akan dibundel dengan adaptor bermerek Google dan kabel USB-C.\r\n\r\nLebih lanjut, Pixel 6a ini akan mengemas layar FHD+ OLED 6,1 inci dengan dukungan kecepatan refresh 60Hz dan dilindungi lapisan Corning Gorilla Glass 3. Untuk optik, Pixel 6a mengemas kamera utama 12,2MP yang dipadukan dengan kamera ultrawide 12MP dan kamera depan 8MP untuk selfie. \r\n\r\nPerangkat Pixel 6a ditenagai oleh chipset Tensor milik Google dengan fitur yang didukung AI dan dilengkapi dengan chip keamanan Titan M2. Prosesor ini akan dipasangkan dengan RAM LPDDR5 6GB dan penyimpanan internal UFS 3.1 128GB. \r\n\r\nSmartphone terbaru Google ini akan didukung dengan kemampuan tahan air yang berada pada tingkat  IP67. Untuk perilisannya, Google Pixel 6a ini akan tersedia secara global mulai tanggal 28 Juli 2022 mendatang.', '2022-06-14', 8, 2, 1),
(10, 'YouTube Rilis Fitur Correction, Bisa Perbaiki Video Tanpa Upload Ulang', '../uploads/gambarArtikel/5e11aadb135f80e638e85684c512cefe.jpg', 'YouTube memerkenalkan sebuah fitur baru bernama Correction. Fitur ini memungkinkan pengguna untuk mengoreksi sebuah video tanpa perlu dihapus.\r\n\r\nSelama ini beberapa pengguna kerap kali menghapus video apabila ada beberapa klip yang perlu diedit.\r\n\r\nAkibat itu, mereka memerlukan waktu tambahan untuk memperbaiki dan upload ulang video.\r\n\r\nDengan fitur Correction, kreator bisa lebih mudah untuk menambahkan catatan informasi koreksi di video pada detik tertentu.\r\n\r\n\"Dengan peluncuran Correction, kreator konten dapat memperhatikan koreksi dan klarifikasi dalam deskripsi video mereka yang sudah diterbitkan,\" kata YouTube, dilansir dari Social Media Today, Selasa (21/6/2022).\r\n\r\nFitur Correction ini tampil di sudut kanan atas saat video dimainkan.\r\n\r\nJika diklik, maka itu menampilkan sebuah timestamp yang deskripsinya bisa ditulis kreator untuk klarifikasi atau pernyataan tambahan.\r\n\r\nNamun, Correction ini bukan berarti mengubah video secara keseluruhan.\r\n\r\nKreator hanya bisa menambahkan deskripsi singkat di detik tertentu untuk menjelaskan lebih banyak informasi apabila dinilai kurang.\r\n\r\nMeski demikian, fitur ini tetap dinilai berguna ketimbang kreator mesti hapus dan upload ulang video dengan kesalahan kecil.', '2022-06-21', 1, 2, 1),
(11, 'Komparasi Realme Narzo 50 5G vs Realme Narzo 50', '../uploads/gambarArtikel/9c8f08bbbe355ddcd88068a6cb72ba63.jpg', 'Bagi kamu yang sedang mencari HP baru dengan harga terjangkau, Realme bisa menjadi pilihan.\r\n\r\nKomparasi Realme Narzo 50 5G vs Realme Narzo 50 bisa jadi pertimbangkan jika kamu memilih produk di kelas menengah.\r\n\r\nJika dilihat dari segi harga tentu Realme Narzo 50 menawarkan harga lebih terjangkau. Keduanya diklaim memiliki performa yang unggul di kelasnya.\r\n\r\nDari segi desain, keduanya memiliki tampilan yang elegan dan stylish.\r\n\r\nRealme Narzo 50 5G memiliki tampilan bodi belakang dengan efek glossy sehingga terlihat mengkilap.\r\n\r\nHal ini juga didukung dengan pilihan desain bodi bagian tepi yang rata, bukan membulat atau melengkung.\r\n\r\nHasilnya, bodi Realme Narzo 50 5G terasa tebal tapi ada kesan mewah secara keseluruhan.\r\n\r\nRealme Narzo 50 5G hadir dengan dua pilihan warna, yaitu Hyper Black dan Hyper Blue.\r\n\r\nSedangkan Realme Narzo 50 memiliki filosofi desain yang berbeda dari sebelumnya karena menghadirkan desain Kevlar Speed Texture yang terinspirasi dari mobil balap.\r\n\r\nSekilas, bagian belakangnya memang terlihat kosong, namun ia memiliki pola menyerupai serat karbon yang terlihat keren di bawah sinar matahari.\r\n\r\nRealme Narzo 50 hadir dengan dua pilihan warna Speed Black dan Speed Blue.\r\n\r\nSama-sama memiliki desain elegan, lantas mana yang unggul dalam Battle Realme Narzo 50 5G vs Realme Narzo 50 ini?\r\n\r\nBerikut komparasi Realme Narzo 50 5G vs Realme Narzo 50 yang dirangkum untuk kamu\r\n\r\nSecara dimensi, Realme Narzo 50 5G memiliki dimensi 64.1 x 75.5 x 8.5 mm (6.46 x 2.97 x 0.33 in) dengan bobot: 194 g (6.84 oz).\r\n\r\nRealme Narzo 50 5G menggunakan panel LCD berukuran 6,6 inci dengan resolusi Full HD Plus (2.408 x 1.080 piksel), refresh rate 90 Hz, serta touch sampling rate 180 Hz.\r\n\r\nSedangkan Realme Narzo 50 memiliki dimensi ketebalan 8,5 mm dengan panjang dan lebar sebesar 164,1 x 75,5 mm.\r\n\r\nDi bagian layar, sudah tersemat panel IPS LCD dengan ukuran 6,6 inci. Layar ini sudah berada di resolusi Full HD+ alias 1080 x 2412 piksel pada aspek rasio 20:9.\r\n\r\nKetajaman layarnya pun sungguh memanjakan mata pengguna, menghasilkan kerapatan piksel sebesar 400 ppi.\r\n\r\nDitambah lagi, layar mendukung refresh rate tinggi hingga 120 Hz agar tampilan animasi saat scrolling dan membuka aplikasi bisa terlihat dua kali lipat lebih mulus.', '2022-06-21', 8, 2, 1),
(12, 'Asus TUF Gaming A15 versi AMD Ryzen 6000 Masuk Indonesia', '../uploads/gambarArtikel/69fa034f4c008b29fe0e7445e28050d8.jpg', 'Asus TUF Gaming A15 meluncur ke Indonesia pada Senin (20/6/2022). Kali ini laptop gaming entry-level tersebut menggunakan prosesor AMD Ryzen 6000 series, yang juga baru dikenalkan ke Tanah Air.\r\n\r\n\"Prosesor AMD Ryzen 6000 Series yang menjadi otak dari TUF Gaming A15 membuat laptop ini tidak hanya tampil lebih powerful, tetapi juga lebih efisien dalam hal konsumsi daya,\" kata Jimmy Lin, ASUS Regional Director Southeast Asia, dalam konferensi pers di Jakarta.\r\n\r\nSeri TUF Gaming A15 terbaru kali ini juga telah dilengkapi dengan MUX Switch. Fitur ini berfungsi untuk meningkatkan performa gaming dengan cara mengalihkan jalur data dari chip grafis secara langsung ke display tanpa harus melalui chip grafis terintegrasi yang ada di prosesor.\r\n\r\nDengan fitur ini, lanjut Jimmy, performa gaming dapat meningkat hingga 10 persen di sebagian besar game modern yang ada saat ini.\r\n\r\nTeknologi pendinginan juga menjadi fokus pada TUF Gaming A15 versi baru. Laptop itu kini telah dilengkapi dengan dua kipas Arc Flow yang memiliki lebih banyak bilah kipas sebanyak 84 bilah.\r\n\r\nSetiap bilah dari kipas tersebut memiliki ketebalan hanya 0,1 mm di bagian ujungnya. Desain itu dapat mengurangi turbulensi, sehingga aliran udara menjadi lebih lancar tanpa harus membuat kipas berputar lebih kencang.\r\n\r\nBerkat inovasi tersebut, sistem pendinginan TUF Gaming A15 terbaru dapat tampil lebih senyap namun mampu mengalirkan udara hingga 13 persen lebih baik dari generasi sebelumnya.\r\n\r\nASUS juga memberikan opsi layar Full HD dengan refresh rate 144Hz di seri TUF Gaming terbaru. Selain itu, laptop gaming ini juga tampil dengan desain yang terinspirasi dari mecha anime.\r\n\r\nPerangkat juga dipastikan punya ketahanan tangguh karena telah mengantongi sertifikasi lolos uji ketahanan berstandar militer AS (MIL-STD 801H).\r\n\r\nHarga Asus TUF Gaming A15 (FA507)\r\nRyzen 7 6800H, RTX 3050 = Rp 17.799.000\r\nRyzen 7 6800H, RTX 3050Ti = Rp 19.299.000\r\nRyzen 7 6800H, RTX 3060 = Rp 24.499.000.', '2022-06-21', 8, 2, 2),
(13, 'Deretan Fitur Kamera OPPO Find X5 Pro 5G, Maksimalkan Potensi Fotografi!', '../uploads/gambarArtikel/9f443062939b71a426c8b9fd8d42323b.png', 'OPPO Find X5 Pro 5G baru saja meluncur ke Indonesia pada Kamis, 2 Juni 2022.\r\n\r\nSmartphone kelas flagship ini membawa beberapa fitur kamera unggulan untuk mendukung produktivitas seperti membuat konten di media sosial.\r\n\r\nSeperti diketahui, OPPO memperkenalkan Neural Processing Unit (NPU) khusus bernama MariSilicon X.\r\nIni adalah prosesor yang dibuat agar pengguna bisa menangkap gambar dengan jelas dan penuh detail, terutama saat malam hari atau minim cahaya.\r\n\r\nSelain itu, OPPO juga bekerja sama dengan Hasselblad dalam rangka menciptakan warna alami dan profesional dalam teknologi pencitraan smartphone.\r\n\r\nKeduanya berkolaborasi menghadirkan Natural Color Calibration dalam OPPO Find X5 Pro 5G.\r\n\r\nNah apa saja fitur-fitur kamera di OPPO Find X5 Pro 5G? Berikut rinciannya.\r\n\r\nOPPO Find X5 Pro 5G mengusung dual primary camera yaitu Sony IMX 766 50MP untuk kamera utama dan kamera ultrawide di bagian belakang.\r\n\r\nKamera ini ditampilkan sejajar secara vertikal dan mampu menangkap 1 billion colour.\r\n\r\nSecara rinci, kamera utama Wide Angle Sony IMX 766 ini beresolusi 50MP dengan ukuran 2µm, bukaan lensa f/1.7, dan dilengkapi dengan Optical Image Stabilization (OIS).\r\n\r\nSementara kamera keduanya adalah lensa ultrawide Sony IMX766 beresolusi 50MP, berukuran 2µm, bukaan lensa f/2.2, dan bidang pandang 110 derajat.\r\n\r\nSelama pemakaian, kamera Wide Angle atau kamera utama ini mampu menghasilkan warna cerah dan mampu menangkap cahaya yang cukup.\r\n\r\nEntah itu dalam kondisi outdoor, indoor, maupun cahaya redup atau malam hari.\r\n\r\nBegitu pula dengan kamera Ultrawide. Bedanya dengan kamera utama adalah lensa ini cocok dipakai untuk ambil foto dengan orang banyak, atau sebuah gedung dengan tampilan penuh (zoom-out).\r\n\r\nKamera telefoto 13MP di OPPO Find X5 Pro 5G ini tampil di samping kanan dua sensor besarnya.\r\n\r\nKamera telefoto ini memiliki kemampuan 2x hybrid optical zoom dan 20x optical zoom.\r\n\r\nBiasanya kamera telefoto ini dipakai kebutuhan seperti memfoto bulan, melihat menu dari jarak yang tidak terlihat, atau menangkap momen di jarak yang jauh.\r\n\r\nSelain di sektor hardware, OPPO Find X5 Pro 5G juga memiliki software ColorOS 12.1 dengan beberapa fitur kamera.\r\n\r\nFitur ini akan membantu kalian menghasilkan foto atau video terbaik untuk pembuatan konten ataupun mendukung produktivitas.\r\n\r\nBerikut rincian fitur kamera di ColorOS 12.1 OPPO Find X5 Pro 5G:\r\n\r\nNight Mode\r\n\r\nNight Mode adalah salah satu fitur yang memungkinkan hasil foto malam hari menjadi lebih cantik.\r\n\r\nMode malam ini membantu kamera dapat menangkap cahaya dan warna agar lebih terang.\r\n\r\nSementara untuk video, Night Mode OPPO Find X5 Pro 5G dibantu oleh chip MariSilicon X.\r\n\r\nHasilnya, NPU ini mampu memberikan peningkatan night video resolution empat kali lebih besar, pengurangan efek grain pada gambar, serta penangkapan warna yang lebih baik.\r\n\r\nDengan teknologi MariSilicon X, pengguna untuk pertama kalinya dapat merekam video 4K dengan kualitas terbaik menggunakan smartphone Android.\r\n\r\nHasil rekaman pun bersih tanpa efek grain, dengan kualitas gambar yang sama seperti mengambil foto tidak bergerak.\r\n\r\nPortrait adalah sebuah mode yang memungkinkan hasil foto menjadi fokus di satu subjek dan mengaburkan latar belakangnya.', '2022-06-21', 1, 2, 1),
(14, 'Laptop Asus ROG Zephyrus G14 dan G15 Meluncur ke Indonesia, Ini Harganya', '../uploads/gambarArtikel/4cb793bde51c86e9f2e742e4a2ff58d6.jpg', 'Asus memperkenalkan jajaran laptop ROG Zephyrus G14 dan G15 ke Indonesia hari ini. Keduanya sama-sama mengusung prosesor AMD Ryzen 6000 series terbaru.\r\n\r\nPerbedaannya terletak di layar, di mana ROG Zephyrus G14 memiliki layar 14 inci. Sedangkan ROG Zephyrus G15 membawa layar 15 inci.\r\n\r\nAsus ROG Zephyrus G14 (GA402)\r\nLaptop Asus ROG Zephyrus G14 terbaru ini mengkombinasikan prosesor AMD Ryzen 6000 Series dengan chip grafis AMD Radeon terbaru. Laptop ini juga dibekali dengan fitur eksklusif seperti AMD SmartShift, AMD Smart Access Memory, Radeon Chill, AMD Radeon Anti-Lag, AMD Radeon Boost, serta AMD Radeon Image Sharpening.\r\n\r\nROG Zephyrus G14 juga menggunakan sistem pendingin yang memanfaatkan Vapor Chamber khusus serta Liquid Metal Thermal Compound di CPU dan GPU untuk pendinginan yang maksimal.\r\n\r\nBerbeda dengan generasi sebelumnya, ROG Zephyrus G14 kini mengusung layar 14-inci dengan rasio 16:10. Bezelnya juga tipis yang membuat screen-to-body ratio laptop mencapai 91 persen.\r\n\r\nROG Zephyrus G14 juga tetap dilengkapi dengan AniMe Matrix Display di balik layar utamanya. Kali ini jumlah LED yang digunakan di sistem AniMe Matrix Display lebih banyak dari tahun sebelumnya, yaitu mencapai 1449 LED.\r\n\r\nSehingga animasi dan gambar yang ditampilkan menjadi lebih detail dari generasi sebelumnya. AniMe Matrix Display merupakan fitur eksklusif yang hanya bisa didapatkan di seri laptop gaming ROG Zephyrus G14.\r\n\r\nHarga Asus ROG Zephyrus G14 (GA402)\r\nRyzen R7 6800HS, AMD Radeon RX 6700S, RAM 16GB, SSD 1TB = Rp 28.999.000\r\nRyzen R9 6900HS, AMD Radeon RX 6800S, RAM 16GB, SSD 1TB = Rp 32.999.000\r\n\r\nAsus ROG Zephyrus G15 (GA503)\r\nAsus ROG Zephyrus G15 terbaru ini ditenagai oleh prosesor AMD Ryzen 6000 Series yang dipasangkan dengan chip grafis NVIDIA GeForce RTX generasi terbaru. Untuk penyimpanan, laptop dibekali RAM DDR5 480MHz serta PCIe 4.0 x4 SSD.\r\n\r\nMeski layarnya masih tetap menggunakan rasio 16:9, namun ROG Zephyrus G15 tetap menggunakan panel beresolusi QHD (2K) dengan color gamut 100 persen DCI-P3 dan mengantongi sertifikasi PANTONE Validated Display.\r\n\r\nLayar tersebut tidak hanya cocok untuk content creation, tetapi juga gaming. Kemudian ada refresh rate 165Hz dan response time 3ms yang membuat ROG Zephyrus G15 juga sangat nyaman untuk bermain game.\r\n\r\nHarga Asus ROG Zephyrus G15 (GA503)\r\nRyzen 7 6800HS, RTX 3060 = Rp 29.499.000\r\nRyzen 9 6900HS, RTX 3070 Ti = Rp 38.999.000.\r\n\r\n', '2022-06-21', 8, 2, 2),
(15, 'Samsung Sebarkan Video Teaser Singkat Untuk Galaxy Note 10!', '../uploads/gambarArtikel/bf95d26358c8bcf8b3879eb7f440b15a.jpg', 'Sudah bukan rahasia lagi jika Galaxy Note 10 akan menjadi flagship berikutnya dari Samsung untuk semester kedua tahun 2019 ini, dan baru-baru ini Samsung Indonesia baru saja mengunggah tweet video singkat tentang acara Galaxy Note10 Unpacked yang akan berlangsung pada 7 Agustus mendatang. \r\n\r\nSementara untuk tanggal tersebut sebelumnya telah diketahui secara resmi sejauh ini, tetapi video tersebut mengisyaratkan bagaimana Samsung akan memasarkan smartphone flagship terbarunya.\r\n\r\nUntuk tema pada video tersebut menekankan sebuah perangkat yang dapat menggantikan peran beberapa perangkat. Misalnya, hanya dengan tamabahan DeX, Galaxy Note 10 dapat menggantikan fungsi laptop ketika Anda sedang berada di luar kantor. \r\n\r\nTentunya itu adalah pandangan berorientasi bisnis yang mengejutkan dari Samsung Galaxy Note 10. Jika kita mengingat video promosi pertama dari Galaxy Note 9, itu memang menunjukkan perangkat yang cocok untuk lingkungan kantor, namun juga dikenal memiliki kualitas yang baik pada segi kamera, performa gaming, dan ketahanan air sehingga dijuluki sebagai perangkat serba bisa, tidak hanya sebagai perangkat bisnis. \r\n\r\nNamun, ini hanya video pertama dari banyak banyak yang akan datang di waktu yang akan datang. Kita sudah tahu bahwa kamera Galaxy Note 10 akan berbasis setting kamera milik Galaxy S10 5G yang terdiri dari tiga kamera + sensor ToF 3D dan perangkat ini juga akan ditenagai oleh chipset yang telah ditingkatkan. Untuk lebih jelasnya, kita nantikan saja teaser berikutnya dari Samsung.', '2022-06-22', 12, 2, 1),
(16, 'Resmi: Infinix Note 12 Meluncur di Indonesia, Baterai Awet, Gamer Wajib Beli !', '../uploads/gambarArtikel/e2e4addf473ec524cf8d3380daa3b352.jpeg', 'Produsen Hp Infinix secara resmi meluncurkan produk barunya di Indonesia. Lalu, bagaimana spesifikasi dan harga yang ditawarkan oleh HP keluaran baru Infinix ini? Mari kita bahas.\r\n\r\nInfinix Note 12 G96 merupakan varian lain dari keluarga Infinix 12 yang diluncurkan sebelumnya. Secara keseluruhan, ada beberapa perbedaan antara Infinix Note 12 dengan para pendahulunya. Berikut merupakan spesifikasi dan harga yang ditawarkan oleh Infinix Note 12 G96 ini.\r\n\r\n\r\nYang pertama, HP dengan tagar #TaklukanBatas ini memiliki 3 kamera belakang dengan kamera utamanya memiliki sensor 50 MP Ultra Night. Jadi foto yang teman teman ambil pada malam hari, tidak kalah bagusnya dengan siang hari.\r\n\r\nUntuk perekaman video dapat menghasilkan warna yang ciamik dan resolusi video sebesar 3k 30 fps. Sedangkan untuk kamera depannya, teman teman yang doyan selfy tidak perlu khawatir. Teman teman akan dimanjakan dengan kamera depan beresolusi 16 MP ditambah lampu LED khusus untuk selfy. Jadi gak perlu khawatir lagi selfy ditempat yang kurang penerangan.\r\n\r\nUntuk urusan baterai, HP ini ditenagai baterai berkapasitas 5000 mAh, cukup banget untuk aktifitas harian temen temen. Disamping itu, HP ini sudah di dukung fast charging dengan daya 33W. \r\n\r\nTidak seperti kebanyakan HP zaman sekarang yang menjual secara terpisah antara HP dan Cas nya, Infinix Note 12 ini tetap memanjakan costumernya dengan menyertakan adaptor dan cas hp dalam satu paket pembelian.\r\n\r\nProsesor & RAM\r\n\r\nHp Infinix Note 12 G96 seperti namanya HP ini didukung oleh Ultra Gaming Prosesor. Dikemas dengan lebih banyak tenaga, Helio G96 menggabungkan proses 2 x Cortex-A76 dan 6 x Cortex-A55 yang bekerja sama memanfaatkan kecerdasan tingkat lanjut untuk memperoleh kinerja yang inovatif.\r\n\r\n\r\n\r\n', '2022-06-23', 8, 2, 1),
(17, 'Lenovo Pamer Laptop Konsep dengan Proyektor dan Keyboard Retractable', '../uploads/gambarArtikel/33f2f144a1a69921550bb8918cae88a3.jpg', 'Lenovo memamerkan laptop konsep baru, yaitu Lenovo Mozi. Perangkat ini memiliki integrasi proyektor internal dan keyboard yang dapat ditarik (retractable).\r\n\r\nLenovo kembali memamerkan sebuah perangkat konsep dengan fitur unik belum lama ini. Produk ini berupa sebuah laptop yang memiliki sebuah proyektor terintegerasi dan sebuah keyboard dengan fitur yang lazim hadir di perangkat laptop manapun pada saat ini.\r\n\r\nPerusahaan yang berbasis di Tiongkok tersebut telah memamerkan Lenovo Mozi, sebuah laptop konsep yang dilengkapi integrasi proyektor dan keyboard yang dapat ditarik (retractable). Lenovo juga mengungkapkan bahwa perangkat itu telah memenangkan Red Dot Design Award.\r\n\r\nLenovo hanya membagikan satu gambar dari laptop konsep baru ini, yang menampilkan desain keyboard yang dapat ditarik. Dilansir dari Gizmochina (21/6), bodi utama laptop juga memiliki modul proyeksi untuk menampilkan gambar di dinding.\r\n\r\nSaat ini, pihak Lenovo belum mengungkapkan apapun terkait spesifikasi laptop konsep baru ini. Tidak diketahui pula apakah perusahaan itu berencana untuk memproduksi perangkat ini secara massal agar tersedia bagi pelanggan untuk dibeli.\r\n\r\nRed Dot memperkenalkan perangkat tersebut sebagai laptop pintar yang menampilkan gambar melalui proyeksi cahaya rendah. Laptop ini dilengkapi dengan unit komputer, unit proyeksi, dan layar terpisah. Red Dot menambahkan bahwa terinspirasi oleh proyeksi inovatifnya, Mozi dapat digunakan tanpa monitor, menghemat sumber daya dan meningkatkan kegunaan notebook.', '2022-06-24', 12, 2, 2),
(18, 'Spesifikasi HP Android Nothing Phone 1 Nongol di Geekbench', '../uploads/gambarArtikel/fab2217ee32e19e405b85a20ab91db21.jpg', ' Nothing, perusahaan rintisan Carl Pei ini akan meluncurkan HP Android pertama mereka bernama phone (1) pada 12 Juli 2022.\r\n\r\nJadi ponsel paling banyak diperbincangkan di internet, bocoran tentang spesifikasi Nothing phone (1) pun sudah mulai beredar.\r\n\r\nInformasi terkini datang dari situs Geekbench, dimana ponsel pertama Nothing itu menggunakan prosesor Snapdragon 778G Plus.\r\n\r\nDiketahui, prosesor yang terpasang di ponsel adalah versi overclock dari chipset model lama Snapdragon 778G.\r\n\r\nBerdasarkan database di Geekbench, Nothing phone (1) mampu mencetak skor 797 di pengujian single core, dan 2,803 poin untuk multi-core.\r\n\r\nDatabase Geekbench juga mengungkap, ponsel ini sudah langsung beroperasi menggunakan Android 12 dengan balutan Nothing OS.\r\n\r\nSebelumnya, banyak pihak yang meyakini Nothing phone (1) akan dirilis menggunakan prosesor Snapdragon 7 Gen 1.\r\n\r\nDisebutkan, HP Android ini bakal mendukung kemampuan charging 45W dan akan dijual dengan sistem undangan--seperti ponsel pertama OnePlus.\r\n\r\nPara pecinta smartphone di dunia banyak yang tak sabar menunggu kehadiran smartphone perdana dari Nothing yang dipastikan akan mengusung nama Phone 1.\r\n\r\nMeskipun peluncuran Nothing Phone 1 masih sekitar satu bulan lagi, perusahaan mulai menunjukkan tampilan dari smartphone tersebut di media sosial (Twitter).\r\n\r\n Dari jauh, perangkat ini tampak seperti perpaduan antara bagian belakang iPhone X (dengan cangkang kamera ganda berbentuk pil) dan tepi datar iPhone 12.\r\n\r\nMenariknya, cover belakang Nothing Phone 1 transparan, memperlihatkan koil pengisi daya nirkabel besar, beberapa sekrup, dan pola unik yang sebelumnya dibocorkan oleh sang pendiri, Carl Pei.\r\n\r\nNamun, sebagaimana dikutip dari Engadget, Kamis (16/6/2022), Nothing belum memberikan detail lebih lanjut dalam posting-an itu. Sebelumnya, Pei disebut akan menghadirkan ekosistem produk yang terbuka dan beragam melalui perangkat tersebut.\r\n\r\nSejauh ini, Phone 1 diketahui akan diperkuat chipset Qualcomm Snapdragon (diperkirakan kelas menengah) dan tidak berjalan dengan OS Android murni.\r\n\r\nSementara itu, tim desain Nothing dipimpin oleh mantan desainer utama Dyson, Adam Bates, yang bergabung dengan perusahaan pada awal 2022.\r\n\r\n', '2022-06-24', 8, 2, 1),
(19, 'HP Layar Lipat Vivo X Fold Bakal Dipamerkan di Indonesia pada 29 Juni 2022', '../uploads/gambarArtikel/20ead8a1fea92870ef4be85ac55d2fce.jpg', 'Vivo beberapa waktu lalu secara resmi telah terjun ke pasar smartphone layar lipat atau foldable smartphone dengan meluncurkan Vivo X Fold untuk pasar Tiongkok.\r\n\r\nVivo pun mengumumkan bakal memamerkan smartphone layar lipat pertamanya ini di Indonesia dalam acara Vivo Technology Week: Unfold Excellence pada tanggal 29 Juni hingga 3 Juli 2022 mendatang.\r\n\r\nHadie Mandala, Product Manager Vivo Indonesia mengatakan, pengembangan fungsi smartphone dan perangkat pintar sudah menjadi bagian dari perjalanan panjang perusahaan.\r\n\r\n\"Vivo juga senantiasa berkomitmen menghadirkan inovasi terbaik dari seri produknya agar tetap kompetitif di berbagai kategori produk dan pasar,\" kata Hadie dalam siaran persnya, Rabu (22/6/2022).\r\n\r\nMenurut Hadie, peluncuran Vivo X Fold di pasar Tiongkok dilakukan demi menjawab kebutuhan pasar akan smartphone dengan layar yang lebar dan visual yang lebih nyata.\r\n\r\nVivo X Fold sendiri merupakan smartphone flagship pertama yang disokong teknologi profesional folding screen dengan kinerja yang komprehensif.\r\n\r\nUntuk perangkat ini, Vivo menyusung engsel multi-dimensi yang tahan lama dan andal, serta dapat menahan 300 ribu lipatan.\r\n\r\nPerangkat ini menggunakan komponen Sixfold Aerospace yang dipadukan dengan Zirconium Alloys Flexibel Mid-plate dan FS53 Aviation-level High Strength Steel.\r\n\r\nPerpaduan ini demi memenuhi standar sertifikasi kualitas ketahanan perangkat dan kinerja keseluruhan HP Android ini.\r\n\r\nVivo X Fold juga menjadi foldable smartphone pertama yang memiliki sistem 3D Ultrasonic Dual Fingerprint Sensors di kedua layarnya.\r\n\r\nLewat teknologi ini, smartphone tersebut diklaim memiliki akurasi sensor hampir 100 persen dan kecepatan membuka kunci 38,7 persen lebih tinggi dibandingkan sensor sidik jari fotolistrik tradisional.\r\n\r\nSedangkan untuk software-nya, vivo X Fold menyuguhkan Quantum Kit, Amber Scan, role-based recording, free-stop watching, free-stop calling, dan free-stop input pada 60 derajat hingga 120 derajat.\r\n\r\nVivo X Fold mengusung baterai 4600mAh untuk mendukung hingga 20,55 jam panggilan non-stop, 12 jam konferensi video, dan 8 jam aktivitas gaming.\r\n\r\nSmartphone ini juga diperkuat dengan 66W Dual-cell FlashCharge yang dapat mengisi daya baterai smartphone hingga 50 persen hanya dalam waktu 17 menit. ', '2022-06-24', 8, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `description`, `active`) VALUES
(1, 'Samsung', 1),
(2, 'Apple', 1),
(3, 'Xiaomi', 1),
(4, 'Oppo', 0),
(6, 'Huawei', 1),
(7, 'Asus', 1),
(8, 'Realme', 1),
(9, 'LG', 1),
(10, 'Acer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_admin`
--

CREATE TABLE `detail_admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_handphone` varchar(255) NOT NULL,
  `gender_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_admin`
--

INSERT INTO `detail_admin` (`id_admin`, `nama`, `tanggal_lahir`, `email`, `no_handphone`, `gender_id`) VALUES
(1, 'Super Admin', '2000-06-15', 'superadmin@gmail.com', '085331235571', 1),
(8, 'Santiago', '2002-05-13', 'igosantiago91@gmail.com', '08815471812', 1),
(10, 'Johnny Stott', '2002-05-13', 'Johnnystotts@gmail.com', '08560123771', 1),
(11, 'testing123', '2002-05-16', 'admin@gmail.com', '08851231234', 1),
(12, 'Ronald McCruffin', '2000-01-25', 'ronaldcruff@gmail.com', '08566712381', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_user`
--

CREATE TABLE `detail_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_handphone` varchar(255) NOT NULL,
  `gender_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_user`
--

INSERT INTO `detail_user` (`id_user`, `nama`, `no_handphone`, `gender_id`) VALUES
(3, 'Santiago', '08815471812', 1),
(4, 'Atmaja Prasetya', '085331223336', 1),
(5, 'Haley Chasey', '0888123123', 2),
(6, 'Johnny Scott', '085608221381', 1),
(9, 'Tester123', '0888123123', 1),
(10, 'Testing123', '088124761235', 1),
(11, 'testClinet', '09912375123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `description`) VALUES
(1, 'Laki-Laki'),
(2, 'Perempuan'),
(3, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul` text NOT NULL,
  `isi` text NOT NULL,
  `dikirim_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id`, `id_user`, `judul`, `isi`, `dikirim_tanggal`) VALUES
(1, 6, 'Bug pada halaman berita', 'Ada bug pada halaman berita', '2022-06-23'),
(2, 6, 'Ada beberapa bug', 'Pada detail ada bug', '2022-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `login_admin`
--

CREATE TABLE `login_admin` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_admin`
--

INSERT INTO `login_admin` (`id`, `role_id`, `username`, `password`, `active`) VALUES
(1, 2, 'superAdmin01', '$2y$10$2JxXysf11gQczyJ2cte6WucgZb.Hx/O/ayLQM3kWDtK0ioVHSlWse', 1),
(8, 1, 'SanZ', '$2y$10$nMd19Fq9hAcZ/j3c.sOfwOGfHTKcjdCjQT0atZrLEXJDk3IWu1uLu', 1),
(10, 1, 'Johnny', '$2y$10$I2uQbDdPLbu.NodFLTe90u9SFKJlkEIXzVOZ7igv1F9F37h1DDEt6', 1),
(11, 2, 'adm022', '$2y$10$Q5LgKiMYkMNkYT1uN7H0WOjcqdGLVXsxXPrzHVceEZmD1COlh45bq', 1),
(12, 1, 'RonS778', '$2y$10$PRoLZ7rtZpbg08EmljKXoecwZBIYfnzZgvzrmW9IfkMxEnDXM77TO', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_user`
--

CREATE TABLE `login_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_user`
--

INSERT INTO `login_user` (`id`, `username`, `email`, `password`, `avatar`) VALUES
(3, 'client2213', 'igosantiago91@gmail.com', '$2y$10$IylBKu.vRqlU3qpEUBlzs.E0aMDJ5Ft0XnSwfN56MrAFI2/YhlcHK', '../uploads/f5f0b151c61c8d93d53623cac55ec85f.jpg'),
(4, 'Atmax', 'atamajya@gmail.com', '$2y$10$C.ywWxW3U6Z38mkWTSjAaOLxp.MlD0cS/PgaAoHvw5mt094h4okom', '../uploads/93791852ff4635cfec2fc12361db47f6.jpg'),
(5, 'hazelnuts1xx', 'hailley123@gmail.com', '$2y$10$giA99K0anFIrBdVMWs54Oec21awlxmDKlnUrt3NHdS2PzLgPFb1Qm', '../uploads/03dadecea53e766309b38a108d019572.jpg'),
(6, 'jjjj', 'johnyscotter@gmail.com', '$2y$10$mKyGpwlqBYCyqvrUeKUzw.b0dzsedLip.C9A9JdKoh7/UfM9L7CgC', '../uploads/c36db6c6e363bae1f351f9609893b65f.jpg'),
(9, 'testtt123', 'test@gmail.com', '$2y$10$HQoTiy13KtUo8GXClapyl.GDU4ZNEsGU6gmgiR1kxitMTm8vTB5tK', '../uploads/d15a985513b8c95974b6f76781337ecb.jpg'),
(10, 'CobaCoba', 'coba@gmail.com', '$2y$10$jCyWqE7KhsZOqc8rK3S7oum2dxVGqqlfQQLI3CiRsbV4MfBpFZ2l2', '../uploads/e322004930b25f99d4f2c1f5f1a83598.jpg'),
(11, 'testClient', 'testclient@gmail.com', '$2y$10$XdJS/whxmMsr3qLOOtZl5eqSl/y2agVn82EIQ1OK29rozDxqp62uC', '../uploads/dfe77be77bd578c3dce2d9d104956e01.png');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `description`) VALUES
(1, 'Admin'),
(2, 'SuperAdmin');

-- --------------------------------------------------------

--
-- Table structure for table `segmen`
--

CREATE TABLE `segmen` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `segmen`
--

INSERT INTO `segmen` (`id`, `description`) VALUES
(1, 'Smartphone'),
(2, 'Laptop');

-- --------------------------------------------------------

--
-- Table structure for table `spesifikasi`
--

CREATE TABLE `spesifikasi` (
  `id` int(11) NOT NULL,
  `segmentasi_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `nama_model` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `processor` varchar(255) NOT NULL,
  `OS` varchar(255) NOT NULL,
  `RAM` varchar(255) NOT NULL,
  `GPU` varchar(255) NOT NULL,
  `dimensi_layar` varchar(255) NOT NULL,
  `berat` varchar(255) NOT NULL,
  `penyimpanan` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `dibuat_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spesifikasi`
--

INSERT INTO `spesifikasi` (`id`, `segmentasi_id`, `brand_id`, `status_id`, `admin_id`, `nama_model`, `gambar`, `processor`, `OS`, `RAM`, `GPU`, `dimensi_layar`, `berat`, `penyimpanan`, `harga`, `dibuat_tanggal`) VALUES
(1, 1, 1, 2, 8, 'Samsung Galaxy S24 Ultra 5G', '../uploads/gambarModel/fba6cd30fb37d78169dbf88fce959607.jpg', 'Octa-core (1x2.8 GHz Cortex-X2 &amp; 3x2.50 GHz Cortex-A710 &amp; 4x1.8 GHz Cortex-A510)', 'Android 12, One UI 4.1', '8/12', 'Xclipse 920', '1440 x 3088 pixels (~500 ppi density)', '228', '128', 'Rp.22,499,000.00', '2022-06-15'),
(2, 1, 2, 2, 1, 'Apple iPhone 13 Pro Max', '../uploads/gambarModel/fd5431f8775d32f489f5e6690cdf55a8.png', 'Hexa-core (2x3.23 GHz Avalanche + 4x1.82 GHz Blizzard)', 'iOS 15, upgradable to iOS 15.5', '6', 'Apple GPU (5-core graphics)', '1284 x 2778 pixels, 19.5:9 ratio (~458 ppi density)', '240', '128/256', 'Rp.11,500,000.00', '2022-06-17'),
(3, 1, 1, 2, 8, 'Samsung Galaxy A53 5G', '../uploads/gambarModel/fec4c2321c82639530cea5c16ed04802.png', 'Octa-core (2x2.4 GHz Cortex-A78 &amp; 6x2.0 GHz Cortex-A55)', 'Android 12, One UI 4.1', '4/8', 'Mali-G68', '1080 x 2400 pixels, 20:9 ratio (~405 ppi density)', '189', '128/256', 'Rp.4,500,000.00', '2022-06-20'),
(4, 1, 3, 2, 8, 'Xiaomi Poco C40', '../uploads/gambarModel/ee80a59b8104a1be6a9da9dff51f21f1.jpg', 'Octa-core (4x2.0 GHz Cortex-A55 &amp; 4x1.5 GHz Cortex-A55)', 'Android 11, MIUI 13 for POCO', '3/4', 'Mali-G57 MC1', '720 x 1650 pixels (~268 ppi density)', '204', '32/64', 'Rp2,199,000.00', '2022-06-20'),
(5, 2, 2, 2, 8, 'Apple MacBook Pro 13-inch 2020', '../uploads/gambarModel/2837fc4786fe415645e2baa5337a68d4.jpeg', 'Intel Core i5 8th Gen', 'macOS', '8', 'Intel Integrated Iris Plus Graphics 645', '1600x2560', '1400', '256/512', 'Rp17,649,000.00', '2022-06-21'),
(6, 2, 1, 2, 8, 'Samsung Galaxy Book 2 Pro 360 13.3', '../uploads/gambarModel/db0e06943ca5bf6f4da66a1b989f3788.jpg', 'Intel Core i7 12th Gen i7-1260P', 'Windows 11', '16', 'Intel Iris Xe', '1920x1080', '1040', '512/1024', 'Rp.31,500,000.00', '2022-06-21'),
(7, 1, 3, 2, 12, 'Xiaomi Redmi Note 10 Pro', '../uploads/gambarModel/ac65f8b65a90e9e8f2494c649555c48c.jpg', 'Octa-core (2x2.3 GHz Kryo 470 Gold &amp; 6x1.8 GHz Kryo 470 Silver)', 'Android 11, MIUI 12', '6/8', 'Adreno 618', '1080 x 2400 pixels, 20:9 ratio (~395 ppi density)', '193', '64/128', 'Rp3,799,000.00', '2022-06-22'),
(8, 1, 8, 2, 12, 'Realme Pad X', '../uploads/gambarModel/9f4853209f5b306ae28a5be8f13068b9.jpg', 'Octa-core (2x2.2 GHz Kryo 660 Gold &amp; 6x1.7 GHz Kryo 660 Silver)', 'Android, Realme UI 3.0', '4/6', 'Qualcomm SM6375 Snapdragon 695 5G (6 nm)', '1200 x 2000 pixels, 5:3 ratio (~220 ppi density)', '499', '64/128', 'Rp2,800,000.00', '2022-06-24'),
(9, 1, 2, 2, 12, 'Apple iPad Air (2022)', '../uploads/gambarModel/6def643fc4e7af68982653faff00c5fc.jpg', 'Octa-core', 'iPadOS 15.4, up to iPadOS 15.5, planned upgrade to iPadOS 16', '8', 'Apple M1', '1640 x 2360 pixels (~264 ppi density)', '461', '64/256', 'Rp.8,600,000.00', '2022-06-24');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `description`) VALUES
(1, 'Pending'),
(2, 'Accepted'),
(3, 'Rejected'),
(4, 'Taken Down');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_admin`
--
ALTER TABLE `detail_admin`
  ADD UNIQUE KEY `id_admin_fk` (`id_admin`);

--
-- Indexes for table `detail_user`
--
ALTER TABLE `detail_user`
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_admin`
--
ALTER TABLE `login_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_user`
--
ALTER TABLE `login_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `segmen`
--
ALTER TABLE `segmen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spesifikasi`
--
ALTER TABLE `spesifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_admin`
--
ALTER TABLE `login_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login_user`
--
ALTER TABLE `login_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `segmen`
--
ALTER TABLE `segmen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `spesifikasi`
--
ALTER TABLE `spesifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
