-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2021 at 04:19 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinjam`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `desc` text NOT NULL,
  `stock` int(10) NOT NULL,
  `gambar` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `name`, `desc`, `stock`, `gambar`) VALUES
(1, 'Proyektor', 'Toshiba, Hitam, Mulus', 10, 'proyektor.jpg'),
(2, 'Meja', 'Coklat, Bersih dari Coretan', 17, 'meja.jpg'),
(3, 'Kursi', 'Hitam', 30, 'kursi.jpg'),
(6, 'Ruangan Kelas', 'Full AC, 1 Proyektor, 2 Papan Tulis, Kapasitas 100 orang', 10, 'kelas.jpg'),
(7, 'Ruang Laboratorium', 'Full AC, 1 Proyektor, 1 Papan Tulis, 20 Meja Kursi, 20 PC', 10, 'labor.jpg'),
(10, 'Spidol', 'Snowman, Hitam', 99, 'spidol.png'),
(11, 'Kipas Angin', 'Miyako, Biru', 12, 'kipas.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjam`
--

CREATE TABLE `tbl_pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `id_brg` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `job` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `awal_pinjam` date NOT NULL,
  `akhir_pinjam` date NOT NULL,
  `tujuan` varchar(256) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pinjam`
--

INSERT INTO `tbl_pinjam` (`id_pinjam`, `id_brg`, `id_user`, `full_name`, `job`, `address`, `jumlah`, `awal_pinjam`, `akhir_pinjam`, `tujuan`, `status`) VALUES
(1, 1, 4, 'Angela', 'Mahasiswi', 'Jl Berdikari', 2, '2021-06-23', '2021-06-28', 'Penelitian', 3),
(2, 2, 10, 'Angeli Rinawati', 'Mahasiswi', 'Jl Berdikari 2', 3, '2021-07-08', '2021-07-10', 'Seminar', 0),
(3, 10, 10, 'Angeli Rinawati', 'Mahasiswi', 'Jl Berdikari 2', 2, '2021-06-08', '2021-06-09', 'Pengajaran Lab', 1),
(4, 1, 10, 'Angeli Rinawati', 'Mahasiswi', 'Jl Berdikari 2', 1, '2021-06-08', '2021-06-09', 'Pengajaran Lab', 4),
(5, 6, 10, 'Angeli Rinawati', 'Mahasiswi', 'Jl Berdikari 2', 1, '2021-06-08', '2021-06-09', 'Pengajaran Lab', 2),
(6, 1, 10, 'Angeli Rinawati', 'Mahasiswi', 'Jl Berdikari 2', 2, '2021-06-10', '2021-06-21', 'Pelatihan', 0),
(7, 10, 10, 'Angeli Rinawati', 'Mahasiswi', 'Jl Berdikari', 100, '2021-06-10', '2021-06-15', 'As', 2),
(8, 11, 10, 'Angeli Rinawati', 'Mahasiswi', 'Jl Berdikari 2', 2, '2021-06-10', '2021-06-16', 'Pelatihan', 0);

--
-- Triggers `tbl_pinjam`
--
DELIMITER $$
CREATE TRIGGER `kurang_stock` AFTER UPDATE ON `tbl_pinjam` FOR EACH ROW BEGIN
UPDATE tbl_barang SET 
stock = STOCK-NEW.jumlah
WHERE id_barang = NEW.id_brg AND
NEW.status=1;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_stock` AFTER UPDATE ON `tbl_pinjam` FOR EACH ROW BEGIN
UPDATE tbl_barang SET 
stock = STOCK+NEW.jumlah
WHERE id_barang = NEW.id_brg AND
NEW.status=4;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(4, 'Angela', 'angel@gmail.com', 'default.jpg', '$2y$10$cXPYXIqqUvFeeUK64UxmYOjg8hxK/WGKpYyIu392JBrG5yNXbR4i.', 2, 1, 1622267227),
(7, 'Erik', 'erik@gmail.com', 'default.jpg', '$2y$10$7j8kFwhAhHWQgbgHzzWQX.n7OHMoI6IMGVH51gURhz92ZqDWrRNKC', 2, 0, 1622447182),
(10, 'Angeli Rinawati', 'silabanrinawati26@gmail.com', 'default.jpg', '$2y$10$o4s17BUbMcMIjpSUR8SDpeeNXLbLMMVwR09FEs3dF35CCLvY4UrWy', 2, 1, 1622472641),
(11, 'Jessica Elizabeth R', 'jessicaaer09@gmail.com', 'default.jpg', '$2y$10$Vqrhu4w7SJBvKxtOJC/d3uaSQPVndyZXJLKfGl7PPVJvUPlHEKAZi', 1, 1, 1622517247);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(9, 2, 5),
(10, 2, 4),
(11, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Dashboard'),
(3, 'Menu'),
(4, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 4, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 4, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(7, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(8, 4, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(9, 1, 'Barang', 'admin/barang', 'fa fa-fw fa-archive', 1),
(12, 2, 'Data Barang', 'user/databarang', 'fas fa-fw fa-list-ul', 1),
(13, 1, 'Permohonan', 'admin/permohonan', 'far fa-fw fa-file-alt', 1),
(14, 2, 'History', 'user/historypeminjaman', 'fas fa-fw fa-history', 1),
(15, 1, 'Pengembalian', 'admin/pengembalian', 'fas fa-fw fa-clipboard-check', 1),
(16, 1, 'History', 'admin/history', 'fas fa-fw fa-history', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(8, 'silabanrinawati26@gmail.com', '8T+XsQ0v3Sji+rzYMrBpTcbXlYae9ZF2sXj34xtHDO0=', 0),
(9, 'silabanrinawati26@gmail.com', 'DPrm5qJSNgZy04QhUUatVci48dmsN+kJnD9dzY1CrGI=', 0),
(10, 'silabanrinawati26@gmail.com', '/q1Dy/KsMwpoaKWemkTPINV8RXwnKDJPirpSOHhEBhc=', 0),
(11, 'silabanrinawati26@gmail.com', 'bUljeCuEucsYi3FA4OSfnVWZkccI6acRc3BLNB+a5YI=', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
