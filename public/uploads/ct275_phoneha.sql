SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Cơ sở dữ liệu: `ct275_phoneha`
--
CREATE DATABASE IF NOT EXISTS `ct275_phoneha` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `ct275_phoneha`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mat_khau` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dien_thoai`
--

CREATE TABLE `dien_thoai` (
  `id` int(10) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `gia` int(100) NOT NULL,
  `hinh` varchar(255) NOT NULL,
  `so_luong` int(100) NOT NULL,
  `ngay_nhap` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_loai` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dien_thoai`
--

INSERT INTO `dien_thoai` (`id`, `ten`, `gia`, `hinh`, `so_luong`, `ngay_nhap`, `id_loai`) VALUES
(1, 'iPhone 15 Pro Max', 34200000, 'iphone15_pro-max.jpg', 50, '2023-11-07 04:48:14', 1),
(2, 'iPhone 15 Pro', 28000000, 'iphone15_pro.jpg', 50, '2023-11-07 04:49:51', 1),
(3, 'iPhone 14 Pro Max', 27500000, 'iphone14_pro-max.jpg', 50, '2023-11-07 04:57:49', 1),
(4, 'Samsung Galaxy Z Fold5 5G', 37000000, 'samsung-galaxy_z-fold5.jpg', 50, '2023-11-07 05:03:06', 2),
(5, 'Samsung Galaxy Z Fold4 5G', 23000000, 'samsung-galaxy_z-fold4.jpg', 50, '2023-11-07 05:04:04', 2),
(6, 'Samsung Galaxy S23 Ultra 5G', 22500000, 'samsung-galaxy_s23-ultra.jpg', 50, '2023-11-07 05:05:00', 2),
(7, 'OPPO Find N3 5G', 45000000, 'oppo-find-n3.jpg', 50, '2023-11-07 05:06:26', 3),
(8, 'OPPO Find N3 Flip 5G', 23000000, 'oppo-n3-flip.jpg', 50, '2023-11-07 05:07:22', 3),
(9, 'OPPO Reno10 Pro+ 5G ', 20000000, 'oppo-reno10-pro-plus.jpg', 50, '2023-11-07 05:08:07', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `id` int(10) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `so_đt` varchar(100) NOT NULL,
  `dia_chi` varchar(255) NOT NULL,
  `mat_khau` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_dien_thoai`
--

CREATE TABLE `loai_dien_thoai` (
  `id_loai` int(10) NOT NULL,
  `ten_loai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai_dien_thoai`
--

INSERT INTO `loai_dien_thoai` (`id_loai`, `ten_loai`) VALUES
(1, 'IPHONE'),
(2, 'SAMSUNG'),
(3, 'OPPO');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Chỉ mục cho bảng `dien_thoai`
--
ALTER TABLE `dien_thoai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_loai` (`id_loai`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Chỉ mục cho bảng `loai_dien_thoai`
--
ALTER TABLE `loai_dien_thoai`
  ADD PRIMARY KEY (`id_loai`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `dien_thoai`
--
ALTER TABLE `dien_thoai`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `loai_dien_thoai`
--
ALTER TABLE `loai_dien_thoai`
  MODIFY `id_loai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `dien_thoai`
--
ALTER TABLE `dien_thoai`
  ADD CONSTRAINT `dien_thoai_ibfk_1` FOREIGN KEY (`id_loai`) REFERENCES `loai_dien_thoai` (`id_loai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;