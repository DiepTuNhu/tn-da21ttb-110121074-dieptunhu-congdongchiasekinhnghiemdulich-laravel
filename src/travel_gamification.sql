-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `anh_dia_diem`
--

CREATE TABLE `Destination_Image` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `destination_id` int DEFAULT NULL,
  `name` VARCHAR(255),
  `image_url` varchar(255) DEFAULT NULL,
  `status` VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bai_viet`
--

CREATE TABLE `Post` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `address` VARCHAR(255),
  `status` VARCHAR(5),
  `average_rating` float DEFAULT '0',
  `destination_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bao_cao`
--

CREATE TABLE `Report` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `post_id` int DEFAULT NULL,
  `reason` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binh_luan`
--

CREATE TABLE `Comment` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `post_id` int DEFAULT NULL,
  `content` text,
  `parent_comment_id` int DEFAULT NULL,
  `status` VARCHAR(5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chia_se`
--

CREATE TABLE `Share` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `post_id` int DEFAULT NULL,
  `is_public` BOOLEAN,
  `status` VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_gia`
--

CREATE TABLE `Rating` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `post_id` int DEFAULT NULL,
  `score` int DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dia_diem`
--

CREATE TABLE `Destination` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `price` VARCHAR(255),
  `description` text,
  `address` VARCHAR(255),
  `latitude` DECIMAL(10, 8),
  `longitude` DECIMAL(11, 8),
  `created_by` INT NULL,
  `status` VARCHAR(255),
  `travel_type_id` int DEFAULT NULL,
  `province_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dia_diem_tien_ich`
--

CREATE TABLE `Destination_Utility` (
  `destination_id` int NOT NULL,
  `utility_id` int NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `quality` int DEFAULT NULL
, PRIMARY KEY (`destination_id`, `utility_id`)) ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `huyen`
--

CREATE TABLE `District` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(5),
  `name` varchar(100) DEFAULT NULL,
  `province_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `huy_hieu`
--

CREATE TABLE `Badge` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `icon_url` varchar(255) DEFAULT NULL,
  `status` VARCHAR(5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_hinh_du_lich`
--

CREATE TABLE `Travel_Type` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `status` VARCHAR(5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_tien_ich`
--

CREATE TABLE `Utility_Type` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `status` VARCHAR(5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `luot_thich`
--

CREATE TABLE `Like` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `post_id` int DEFAULT NULL,
  `comment_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoi_dung`
--
CREATE TABLE Role (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE `User` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `description` TEXT,
  `status` VARCHAR(255),
  `user_rank` int DEFAULT '0',
  `role_id` INT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoi_dung_nhiem_vu`
--

CREATE TABLE `User_Mission` (
  `user_id` int NOT NULL,
  `mission_id` int NOT NULL,
  `completion_date` datetime DEFAULT NULL
, PRIMARY KEY (`user_id`, `mission_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhiem_vu`
--

CREATE TABLE `Mission` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `points_reward` int DEFAULT NULL,
  `badge_id` int DEFAULT NULL,
  `condition_type` VARCHAR(255),
  `condition_value` INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theo_doi`
--

CREATE TABLE `Follow` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `follower_id` int NOT NULL,
  `following_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thong_bao`
--

CREATE TABLE `Notification` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `notification_type` varchar(50) DEFAULT NULL,
  `content` text,
  `is_read` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tien_ich`
--

CREATE TABLE `Utility` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `price` VARCHAR(255),
  `address` VARCHAR(255),
  `latitude` DECIMAL(10, 8),
  `longitude` DECIMAL(11, 8),
  `distance` DOUBLE,
  `time` VARCHAR(255),
  `image` VARCHAR(255),
  `status` VARCHAR(255),
  `description` text,
  `utility_type_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinh`
--

CREATE TABLE `Province` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(255),
  `name` varchar(100) DEFAULT NULL,
  `region` VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xa`
--

CREATE TABLE `Ward` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(255),
  `name` varchar(100) DEFAULT NULL,
  `district_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `anh_dia_diem`
--
ALTER TABLE `Destination_Image`
  ADD KEY `destination_id` (`destination_id`);

--
-- Chỉ mục cho bảng `bai_viet`
--
ALTER TABLE `Post`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_destination_id` (`destination_id`);

--
-- Chỉ mục cho bảng `bao_cao`
--
ALTER TABLE `Report`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Chỉ mục cho bảng `binh_luan`
--
ALTER TABLE `Comment`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Chỉ mục cho bảng `chia_se`
--
ALTER TABLE `Share`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Chỉ mục cho bảng `danh_gia`
--
ALTER TABLE `Rating`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Chỉ mục cho bảng `dia_diem`
--
ALTER TABLE `Destination`
  ADD KEY `travel_type_id` (`travel_type_id`),
  ADD KEY `fk_province_id` (`province_id`);

--
-- Chỉ mục cho bảng `dia_diem_tien_ich`
--
ALTER TABLE `Destination_Utility`
  ADD KEY `utility_id` (`utility_id`);

--
-- Chỉ mục cho bảng `huyen`
--
ALTER TABLE `District`
  ADD KEY `province_id` (`province_id`);

--
-- Chỉ mục cho bảng `luot_thich`
--
ALTER TABLE `Like`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Chỉ mục cho bảng `nguoi_dung`
--
ALTER TABLE `User`
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `nguoi_dung_nhiem_vu`
--
ALTER TABLE `User_Mission`
  ADD KEY `mission_id` (`mission_id`);

--
-- Chỉ mục cho bảng `nhiem_vu`
--
ALTER TABLE `Mission`
  ADD KEY `badge_id` (`badge_id`);

--
-- Chỉ mục cho bảng `theo_doi`
--
ALTER TABLE `Follow`
  ADD KEY `following_id` (`following_id`);

--
-- Chỉ mục cho bảng `thong_bao`
--
ALTER TABLE `Notification`
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `tien_ich`
--
ALTER TABLE `Utility`
  ADD KEY `utility_type_id` (`utility_type_id`);

--
-- Chỉ mục cho bảng `xa`
--
ALTER TABLE `Ward`
  ADD KEY `district_id` (`district_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `anh_dia_diem`
--
ALTER TABLE `Destination_Image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `bai_viet`
--
ALTER TABLE `Post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `bao_cao`
--
ALTER TABLE `Report`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `binh_luan`
--
ALTER TABLE `Comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chia_se`
--
ALTER TABLE `Share`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `danh_gia`
--
ALTER TABLE `Rating`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `dia_diem`
--
ALTER TABLE `Destination`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `huyen`
--
ALTER TABLE `District`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `huy_hieu`
--
ALTER TABLE `Badge`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `loai_hinh_du_lich`
--
ALTER TABLE `Travel_Type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `loai_tien_ich`
--
ALTER TABLE `Utility_Type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `luot_thich`
--
ALTER TABLE `Like`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `nguoi_dung`
--
ALTER TABLE `User`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `nhiem_vu`
--
ALTER TABLE `Mission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thong_bao`
--
ALTER TABLE `Notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tien_ich`
--
ALTER TABLE `Utility`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tinh`
--
ALTER TABLE `Province`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `xa`
--
ALTER TABLE `Ward`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `anh_dia_diem`
--
ALTER TABLE `destination_image`
  ADD CONSTRAINT `destination_image_ibfk_1` FOREIGN KEY (`destination_id`) REFERENCES `destination` (`id`);

ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_destination_id` FOREIGN KEY (`destination_id`) REFERENCES `destination` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`parent_comment_id`) REFERENCES `comment`(`id`);


ALTER TABLE `share`
  ADD CONSTRAINT `share_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `share_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

ALTER TABLE `destination`
  ADD CONSTRAINT `destination_ibfk_1` FOREIGN KEY (`travel_type_id`) REFERENCES `travel_type` (`id`),
  ADD CONSTRAINT `fk_province_id` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `destination_utility`
  ADD CONSTRAINT `destination_utility_ibfk_1` FOREIGN KEY (`destination_id`) REFERENCES `destination` (`id`),
  ADD CONSTRAINT `destination_utility_ibfk_2` FOREIGN KEY (`utility_id`) REFERENCES `utility` (`id`);

ALTER TABLE `district`
  ADD CONSTRAINT `district_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`);

ALTER TABLE `like`
  ADD CONSTRAINT `like_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `like_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

ALTER TABLE `user_mission`
  ADD CONSTRAINT `user_mission_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_mission_ibfk_2` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`);

ALTER TABLE `mission`
  ADD CONSTRAINT `mission_ibfk_1` FOREIGN KEY (`badge_id`) REFERENCES `badge` (`id`);

ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`following_id`) REFERENCES `user` (`id`);

ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `utility`
  ADD CONSTRAINT `utility_ibfk_1` FOREIGN KEY (`utility_type_id`) REFERENCES `utility_type` (`id`);

ALTER TABLE `ward`
  ADD CONSTRAINT `ward_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`);
COMMIT;


--
-- Thêm ràng buộc khóa ngoại bảng `users`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
