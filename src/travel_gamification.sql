-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th5 11, 2025 lúc 12:00 PM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `travel_gamification`
--
CREATE DATABASE IF NOT EXISTS `travel_gamification` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `travel_gamification`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `badges`
--

CREATE TABLE `badges` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `badges`
--

INSERT INTO `badges` (`id`, `name`, `description`, `icon_url`, `status`, `created_at`, `updated_at`) VALUES
(7, 'Nhà khám phá', 'Viết nhiều bài chia sẻ về các địa điểm du lịch', '/storage/badges/1746355299_avatar-anh-meo-cute-58.jpg', '0', '2025-05-04 10:41:39', '2025-05-04 10:41:39'),
(8, 'Nhà chia sẻ', 'Like và cmt \r\nnhiều bài viết', '/storage/badges/1746355356_d21f84811e130f2766c20f7cf0d145cf.jpg', '0', '2025-05-04 10:42:36', '2025-05-04 10:42:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `post_id` int UNSIGNED DEFAULT NULL,
  `parent_comment_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `destinations`
--

CREATE TABLE `destinations` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `highlights` text COLLATE utf8mb4_unicode_ci,
  `best_time` text COLLATE utf8mb4_unicode_ci,
  `local_cuisine` text COLLATE utf8mb4_unicode_ci,
  `transportation` text COLLATE utf8mb4_unicode_ci,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `travel_type_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `destinations`
--

INSERT INTO `destinations` (`id`, `name`, `price`, `highlights`, `best_time`, `local_cuisine`, `transportation`, `address`, `latitude`, `longitude`, `status`, `user_id`, `travel_type_id`, `created_at`, `updated_at`) VALUES
(5, 'Làng nổi Tân Lập', 'Có rất nhiều hoạt động khác nhau nên giá dao động từ 20.000đ đến 340.000đ', '<p>Các bạn đừng hiểu lầm <a href=\"https://thamhiemmekong.com/thong-tin-du-lich-mien-tay/long-an/lang-noi-tan-lap-diem-du-lich-noi-tieng-tai-long.html\">làng nổi Tân Lập</a> bên trong có một ngôi làng nhé, nơi đây là một khu rừng tràm nguyên sinh rộng lớn và những con đường bí ẩn dẫn vào rừng. Đây được xem là địa điểm phù hợp dành cho những ai thích tìm về với thiên nhiên hoang dã, khám phá nét văn hoá sông nước miền Tây Nam Bộ.</p><p>Sở dĩ có cái tên Làng nổi Tân Lập là do trước kia khi chưa được quy hoạch, vào mùa nước nổi khoảng tháng 7 âm lịch hàng năm người dân ở đây thường nâng cao sàn nhà theo con nước lên, nhìn từ xa giống như một làng nổi trên mặt nước mênh mông. Do đó, khi quy hoạch khu du lịch này, tên gọi làng nổi gắn với địa danh xã Tân Lập đã được đặt cho khu du lịch.</p><p>Đến khu du lịch sinh thái làng nổi Tân Lập, du khách có thể tản bộ trên con đường xuyên rừng tràm, đi thuyền xuôi theo rạch Rừng,&nbsp;thả mình vào thiên nhiên trên quãng đường dài hơn 3km xung quanh rừng tràm bằng thuyền cáp kéo.</p><p>Sau khi mua vé, du khách sẽ bắt đầu len lỏi theo những con rạch bằng xuồng nhỏ&nbsp;giữa rừng tràm. Con rạch chính dẫn vào khu trung tâm Làng nổi Tân Lập có tên là Rạch Rừng.&nbsp;Sẽ thật bình yên khi du khách ngồi trên xuồng lênh đênh trên rạch rừng, ngửi hương tràm, ngắm những vạt sen, súng rực nở một góc sông, nhìn những cánh chim chao liệng trên bầu trời xanh ngắt, thỉnh thoảng lại nghiêng mình theo con nước.</p>', '<p>Làng nổi là một khu du lịch sinh thái với cảnh quan thay đổi lớn theo mùa. Nếu bạn thắc mắc làng nổi Tân Lập vào thời điểm nào đẹp nhất?&nbsp;thì câu trả lời chính là <a href=\"https://thamhiemmekong.com/thong-tin-du-lich-mien-tay/dia-diem-du-lich-mien-tay-sieu-dep-nhat-dinh-phai-den.html\">du lịch miền Tây</a> vào mùa nước nổi tức là từ tháng 8 tới tháng 11 âm lịch hàng năm. Vào mùa nước nổi, nếu bạn đứng từ trên cao nhìn xuống sẽ thấy làng nổi Tân lập giống như một hòn đảo xanh thẳm giữa biển nước mênh mông. Tất cả tạo nên một bức tranh thiên nhiên vô cùng sống động.</p>', '<p>Khu du lịch Làng Nổi Tân Lập nổi tiếng với nhiều món ăn đặc sản miền Tây rất hấp dẫn. Dưới đây là một số món ăn đặc sắc bạn không nên bỏ lỡ khi đến tham quan và khám phá khu du lịch này:</p><p>1. Ốc Nướng Tiêu Xanh</p><p>Ốc nướng tiêu xanh là một trong những món ăn đặc trưng và hấp dẫn nhất của Làng Nổi Tân Lập. Món ăn được chế biến từ ốc bươu ướp với tiêu xanh và một số gia vị truyền thống. Sau khi ướp đều, ốc được nướng trên lửa than hoa với độ nhiệt vừa phải, tạo ra một màu vàng óng ánh, thơm phức và cay nồng đặc trưng.&nbsp; Ốc nướng tiêu xanh thường được ăn kèm với rau sống, chanh và muối ớt, tạo nên một hương vị độc đáo, khiến thực khách không thể nào quên được.</p><p>2. Cá Kho Tộ</p><p>Cá kho tộ của Làng Nổi Tân Lập được làm từ cá rô, cá hú, cá bông lau,... ướp với nước mắm, đường, tỏi và ớt, sau đó kho thật chín. Cá kho tộ được nấu trong nồi đất, trên lò củi, tạo ra một hương vị đặc biệt. Cá kho tộ có thịt ngọt, thơm, mềm và không bị khô, khi ăn kèm với cơm trắng nóng và rau sống, tạo nên một bữa ăn ngon miệng và đầy dinh dưỡng. Nếu bạn đến Làng Nổi Tân Lập, đừng quên thử món cá kho tộ tuyệt vời này!</p><p>3. Lẩu Ếch Tân Lập</p><p>Lẩu ếch là một món ăn đặc sản của Làng Nổi Tân Lập. Đây là một món ăn có vị cay nồng, được chế biến từ thịt ếch tươi ngon, cùng với nhiều loại rau và gia vị tự nhiên như lá chanh, ớt, tiêu, hành, tỏi, gừng. Nước lẩu được chế biến từ nước dùng ếch cùng các loại gia vị, mang lại hương vị đậm đà, thơm ngon và đầy hấp dẫn. Ăn lẩu ếch ở Làng Nổi Tân Lập cũng có thể được kết hợp với uống bia để có hương vị chuẩn nhất.</p><p>4. Cá Lóc Nướng Trui&nbsp;</p><p>Cá lóc nướng trui là món bạn nhất định phải thử khi đến Làng nổi Tân Lập. Được chọn từ những con cá tươi ngon, sau đó được làm sạch, rửa qua nước muối và phơi khô trong nắng cho đến khi khô ráo và có mùi thơm đặc trưng. Sau đó,cá lóc được nướng trên than hoa, với lửa nhỏ vừa để cá chín đều và giữ được độ giòn của thịt. Món ăn thường được ăn kèm với rau sống, bánh tráng và nước mắm chua ngọt.</p><p>5. Lẩu Mắm Long An</p><p>Lẩu mắm là món ăn đặc trưng của miền Tây Việt Nam và cũng là một trong những món ăn được yêu thích ở Làng Nổi Tân Lập. Để nấu món lẩu mắm, người ta sử dụng nồi đất hoặc nồi gang đặt trên bếp than để tạo ra hương vị đặc biệt. Món lẩu mắm có mùi vị đậm đà, thơm ngon, đặc biệt hấp dẫn vào những ngày mưa. Nếu bạn có dịp ghé thăm Làng Nổi Tân Lập, đừng quên thử món lẩu mắm miền Tây này.</p>', '<p>Để đến được Làng Nổi Tân Lập từ Thành phố Hồ Chí Minh, bạn có thể đi theo một trong những hướng dẫn sau đây:</p><p>Cách 1: Từ TPHCM đi qua QL1A đến Bến Lức - Long An, rẽ trái qua đường Hùng Vương, sau đó rẽ phải tiếp đến đường Lê Thị Hồng Gấm, đi thêm khoảng 500m sẽ đến khu du lịch rừng nổi Tân Lập.</p><p>Cách 2: Từ TPHCM đi đến cầu Rạch Miễu, tiếp tục rẽ phải vào đường Trần Hưng Đạo, đi thêm khoảng 17km nữa để đến khu du lịch.</p><p>Cách 3: Từ TPHCM bạn đi đến KCN Hiệp Phước, rẽ phải vào đường Nguyễn Hữu Thọ, đi tiếp thêm khoảng 22km đến khu du lịch Làng nổi Tân Lập.</p>', 'Xã Tân Lập, Huyện Mộc Hóa, Tỉnh Long An', 10.75166000, 106.01729000, '0', 4, 6, '2025-05-08 11:47:25', '2025-05-08 11:47:25'),
(6, 'Nhà Trăm Cột', 'Miễn phí', '<p>Nhà trăm cột nằm ở tả ngạn sông Vàm Cỏ Đông, thuộc xã Long Hựu Đông, huyện Cần Đước, tỉnh Long An. Ngôi nhà này do ông Trần Văn Hoa lúc ấy là Hương Sư làng Long Hựu, tổng Lộc Thành Hạ ,tỉnh Chợ Lớn xây dựng. Dù gọi là nhà trăm cột những sự thực, ngôi nhà có đến 120 cột, trong đó 68 cột chính và 52 cột vuông nhỏ phụ trợ.</p><p>Nhà trăm cột có kiểu chữ “Quốc”, 3 gian, 2 chái đôi với diện tích 822m2&nbsp;trong một khu vườn rộng 4.886m2. Ngôi nhà này được khởi công vào năm 1901, đến năm 1903 thì hoàn thành và năm 1904 thì xong phần chạm khắc trang trí do nhóm 15 thợ từ làng Mỹ Xuyên – làng chạm khắc mộc nổi tiếng của Thừa Thiên – Huế thực hiện bằng chất liệu chủ yếu là các loại gỗ quý như cẩm lai, mun… mái lợp ngói âm dương, nền nhà bằng đá tảng cao 0,9m, mặt nền lát gạch Tàu lục giác.</p><p>Nhà gồm có hai phần: phần trước là phần nội tự – ngoại khách, phần sau là phần để ở và sinh hoạt. Lẫm lúa ở sau cùng đã tháo dở (1952), nay chỉ còn nền móng. Mặt chính nhà quay về hướng Tây Bắc, quanh nhà có sân rộng dùng để phơi lúa, bột. Hành lang, hiên và nền nhà được lát gạch Tàu, không gian rộng rãi hướng ra khu vườn rộng nên luôn mát mẻ. Cửa chính và các cửa sổ có song hình con tiện, bản gỗ.</p>', NULL, NULL, '<p>Đối với những du khách sinh sống tại TP. Hồ Chí Minh hoặc các tỉnh lân cận, thì có thể chọn xe khách để đi lại tiết kiệm hơn. Hiện nay có một số hãng xe cung cấp chuyến xe đi Long An như: An Hòa Hiệp, Thiên Bảo,... với mức giá vé xe khoảng 150.000 VND - 200.000 VND.</p><p>Nếu bạn là người yêu thích tốc độ và muốn chinh phục cung đường đến <strong>nhà trăm cột</strong>, thì có thể chọn xe máy hoặc xe ô tô di chuyển. Theo đó, du khách có thể di chuyển theo cung đường như sau:</p><p>Xuất phát từ Trường Chinh, Âu Cơ, QL50 và QL50 đến Tân Lân -&gt; Đường 19/5 -&gt; ĐT23/ĐT826B tại Phước Đông -&gt; Rẽ trái vào Thế Ngọc NET -&gt; rẽ phải vào đường 19/5 -&gt; rẽ trái vào phía tạp hóa Cô Trinh vào ĐT23 /DT826B và đi thắng để đến điểm du lịch.</p>', 'Xã Long Hựu Đông, Huyện Cần Đước, Tỉnh Long An', 10.48266270, 106.69141700, '0', 4, 4, '2025-05-08 14:09:21', '2025-05-08 14:09:21'),
(7, 'Làng cổ Phước Lộc Thọ', '40.000 VND/ người', '<p>Một điều khiến du khách ấn tượng khi bước qua cổng là bộ tượng Phước Lộc Thọ bằng đá cẩm thạch. Bộ tượng được điêu khắc tỉ mỉ và khá sống động, đây là biểu tượng đúng như cái tên Phước Lộc Thọ.</p><p>Khám phá khuôn viên làng cổ, bạn sẽ lần lượt chiêm ngưỡng 22 ngôi nhà gỗ cổ được phục dựng mang nét văn hoá của cả 3 miền Bắc, Trung, Nam và nhà sàn Tây Nguyên. Đặc biệt, nơi đây trưng bày hàng trăm món đồ sưu tầm, cổ vật quý từ vật dụng sinh hoạt hàng ngày của vua chúa, quan quân, địa chủ, người dân đến các vật tâm linh văn hóa của người Việt. Mỗi vật dụng sẽ được bày trí trong một gian nhà khác nhau, đây cũng là những thứ thu hút du khách nhất.</p><p>Tiếp theo bạn sẽ khám phá những ngôi nhà đặc sắc nổi tiếng nhất trong làng cổ:</p><ul><li>Ngôi nhà chữ “Công”. Với tuổi đời trên 100, bao gồm 104 cột đồ sộ, thiết kế của ngôi nhà dựa trên kiến trúc xưa miền Bắc. Tại các cột nhà sẽ được điêu khắc tứ linh (Long - Lân - Quy - Phụng) và tứ hữu (mai - lan - cúc - trúc) thể hiện sự nguy nga, tráng lệ và uy nghi.</li><li>Ngôi nhà rường 5 gian 2 chái với cổng tam quan phía trước; trong nhà có đến 74 cột, tổng thể ngôi nhà rất sự uy nghi. Bên trong ngôi nhà trang trí nhiều vật dụng quý hiếm như bộ bàn rồng, ngà voi, tủ cổ khảm xà cừ 7 màu…</li><li>Những ngôi nhà phong cách nhà rường Huế thì nét đặc trưng là sự điêu khắc tinh xảo. Các ngôi nhà rường Huế tại làng cổ mang phong cách cung đình với chất liệu sơn son thếp vàng và được chạm trổ rồng phượng rất tinh xảo và tỉ mỉ từng chi tiết nhỏ. Đây là kiểu nhà phổ biến của quan lại và giới thượng lưu xứ kinh kỳ thời phong kiến. Bên trong lưu giữ nhiều cổ vật quý bằng đá, gỗ, kim loại, gốm sứ… thuộc các niên đại khác nhau.</li><li>&nbsp;Với 6 căn nhà sàn của các dân tộc khu vực Đông Nam Bộ và Tây Nguyên. Bạn sẽ được chiêm ngưỡng những kỷ vật như cồng, chiêng, những bức tượng gỗ và dụng cụ lao động của đồng bào dân tộc.</li><li>Ngoài ra, tại đây còn có nhà sàn Khmer, nhà sàn dân tộc Thái, nhà tiểu lâu tứ giác bát dần, chùa một cột …</li></ul>', '<p>Khí hậu tại Long An được ưu ái với thời tiết thuận lợi, mát mẻ, vì thế du khách có thể đến đây vào bất cứ thời gian nào. Để thuận lợi cho việc di chuyển, bạn nên đến tham quan làng cổ vào mùa khô (từ tháng 12 đến tháng 4 năm sau). Nếu đến vào mùa mưa bạn cũng có thể trải nghiệm được những nét văn hoá mùa nước nổi tại đây.</p>', NULL, '<p>Chỉ cách Sài Gòn khoảng 50km nên việc di chuyển đến Long An khá dễ dàng. Du khách có thể lựa chọn di chuyển bằng xe máy, ô tô hoặc với khoảng thời gian chỉ hơn 1 giờ.</p><p>Việc di chuyển đến làng cổ khá dễ dàng, nếu đi bằng xe máy bạn cứ chạy thẳng theo đường Bà Hom, đến tỉnh lộ 10 chạy tiếp và rẽ trái vào đường tỉnh 824 tại ngã ba Đức Hòa (Long An, tiếp tục chạy thêm khoảng 10 phút nữa là thấy Làng cổ Phước Lộc Thọ bên tay phải.</p><p>Bạn cũng có thể đi xe buýt chuyến 627 (Chợ Lớn - Đức Huệ) hoặc 626 (Chợ Lớn - Hậu Nghĩa), giá vé xe buýt là 22.000 VND/ lượt. Bạn sẽ ghé trạm tại ngã ba Đức Hòa, sau đó đi xe ôm vào làng cổ.</p>', 'Xã Hựu Thạnh, Huyện Đức Hòa, Tỉnh Long An', 51.50000000, 10.50000000, '0', 4, 4, '2025-05-08 14:19:59', '2025-05-08 14:19:59'),
(8, 'Khu du lịch cánh đồng bất tận', 'Dao động từ 220.000đ đến 1.200.000đ', '<p>Cánh đồng bất tận tọa lạc tại khu phố 3, thị trấn Bình Phong Thạnh, huyện Mộc Hóa, tỉnh Long An và thuộc sở hữu của Trung tâm Nghiên cứu bảo tồn và phát triển dược liệu Đồng Tháp Mười. Tại đây chứa có hơn 1000 ha rừng tràm gió nguyên sinh có tuổi thọ lên đến trăm tuổi. Không những vậy đây còn là điểm sinh trưởng và bảo tồn của hơn 80 loại gen của những loại thảo dược quý hiếm. Chính vì thế nơi đây còn được biết đến là “rừng thuốc”.</p><p>Nơi đây không quá ồn ào như nhiều khu du lịch ở miền Tây Nam Bộ, cũng chẳng mang vẻ đẹp đượm màu xưa cũ của du lịch miền Bắc, Trung. Đến với cánh đồng bất tận Long An du khách sẽ không khỏi ngỡ ngàng bởi vẻ đẹp quá đỗi bình yên của sông nước hiền hoà, của sự trong lành và yên ả của những cảnh đồng, cánh rừng mang đến.</p><p>Khám phá khu du lịch cánh đồng bất tận du khách sẽ chẳng thiếu những trải nghiệm tuyệt vời, đặc biệt cũng chẳng thiếu những góc check-in độc đáo. Vào mùa hoa súng, hoa sen nở rộ tạo nên khung cảnh đầy nên thơ sẽ làm nức lòng những tín đồ yêu thích check-in sống ảo.</p><p>Hay những buổi sớm mai và chiều tà, những cánh cò trắng bay và kiếm ăn nơi ruộng đồng cũng làm nên một quan cảnh bình yên khó tả. Ghé thăm nơi đây du khách tưởng chừng sẽ thoát khỏi chốn xô bồ náo nhiệt thường trực mà hào cùng thiên nhiên đầy nắng gió.</p>', '<p>Tại đây cây cối xanh tốt bốn mùa tạo nên một khung cảnh tràn đầy sức sống, nên du khách đến vào mùa tạo cũng sẽ cảm nhận được thiên nhiên tươi mới. Tuy mỗi mùa đều có những dấu ấn riêng biệt nhưng để có thể khám phá trọn vẹn nhất có thể du khách có thể chọn lựa các khoảng thời gian như sau:</p><ul><li>Rằm tháng giêng: Thời điểm này tại đây tổ chức Lễ Giỗ tổ Đại y tôn Hải Thượng Lãn Ông và người được mệnh danh là Đức Thánh y Tuệ Tĩnh nhằm tôn vinh cũng như nhớ về truyền thống y đức. Vào ngày này thường có các trò chơi, hát cải lương,... mọi người có thể hòa cùng không khí náo nhiệt của lễ hội.</li><li>Tháng 9 đến tháng 11: Đây là thời điểm Long An cũng như các tỉnh miền Tây bước vào mùa đặc trưng “mùa nước nổi\". Các thảm thực vật tươi tốt phủ xanh cả vùng trời. Đặc biệt là hoa sen, hoa súng nở rộ ở <strong>khu du lịch cánh đồng bất tận </strong>du khách tha hồ check-in cảnh đẹp nơi đây.</li><li>Tháng 11 đến tháng 12: Đây là thời điểm chuyển giao mùa, không khí mát mẻ, mùa nước nổi đi qua những đàn cò bay về cánh đồng gần cạn nước bắt tôm cá. Những đàn cò trắng hoà cũng màu của đất tạo nên khung cảnh bình dị nhưng lại thân thuộc đến lạ kỳ.</li></ul>', NULL, '<p>Cách thành phố Hồ Chí Minh hơn 80km nên việc di chuyển bằng xe máy sẽ là chuyện nhỏ với nhiều người, đặc biệt là những bạn trẻ đam mê phượt. Đường đi khá dễ mọi người chỉ cần theo hướng thành phố Tân An sau đó rẽ về quốc lộ 62 theo hướng Mộc Hoá - Long An hướng. Hoặc đơn giản hơn đi theo chỉ dẫn của google map định vị là sẽ đến được <strong>khu du lịch cánh đồng bất tận.</strong></p><p><strong>Đối với những du khách ở xa thì máy bay là phương tiện thuận lợi nhất trong hành trình di chuyển đến khu du lịch cánh đồng bất tận. Và tất nhiên nên chọn đáp sân bay gần Long An nhất là Tân Sơn Nhất của TP. Hồ Chí Minh.</strong></p>', 'Thị trấn Bình Phong Thạnh, Huyện Mộc Hóa, Tỉnh Long An', NULL, NULL, '0', 4, 6, '2025-05-08 14:54:25', '2025-05-08 14:54:25'),
(9, 'Ao Bà Om', 'Miễn phí', '<p>Nằm yên bình giữa lòng thành phố Trà Vinh, Ao Bà Om hiện lên như một bức tranh thủy mặc tuyệt đẹp, điểm xuyết bởi sắc xanh của nước, của trời và những tán cây cổ thụ. Không chỉ là một địa điểm <a href=\"https://thamhiemmekong.com/thong-tin-du-lich-mien-tay/dia-diem-du-lich-mien-tay-sieu-dep-nhat-dinh-phai-den.html\">du lịch Miền Tây</a> nổi tiếng, Ao Bà Om còn gắn liền với những truyền thuyết ly kỳ và nét văn hóa đặc sắc của người Khmer Nam Bộ.</p><p>Ngoài cảnh đẹp đến mê mẩn lòng người, ao nước rộng lớn này còn lung linh huyền ảo bởi những câu chuyện nửa hư nửa thực từ bao đời nay ăn sâu vào tiềm thức người dân địa phương.</p><p>Theo truyền thuyết ngày trước, vùng đất Trà Vinh hằng năm cứ đến mùa hạn thì nước ngọt khan hiếm, ruộng rẫy khô cằn, cây cỏ chết héo, người dân trong vùng vì hạn hán rơi vào cảnh lầm than. Để cứu dân khỏi cảnh khốn cùng, một ông hoàng trấn nhậm trong vùng quy tụ bà con đào ao tìm nguồn nước.</p><p>Tình cờ, trong vùng lúc đó cũng xảy ra một vụ tranh cãi khó phân xử là đàn ông và đàn bà, ai phải đi cưới ai và ai phải chịu mọi phí tổn trong lễ cưới? Ông hoàng nhân dịp này chia ra hai bên nam nữ tổ chức một cuộc thi đào ao. Ao bên nào đào sâu hơn, lớn hơn và xong trước thì thắng, bên thua sẽ phải đi cưới.</p><p>Bên nam thì đào ao tròn ở phía Tây còn bên nữ đào ao vuông ở phía Đông. Bên nữ do bà Om, một phụ nữ Khmer chỉ huy, thấy không thể kình được sức đàn ông nên bên nữ dùng “kế”: Họ vừa đào vừa ca múa để các chàng bỏ việc mà chạy sang xem. Nửa đêm, bà Om cho chặt một cây tre thật dài, treo ngọn đèn lồng rồi đem cắm ở hướng Đông. Theo giao hẹn là khi sao Mai mọc là phải ngừng công việc, khi bên nam thấy ngọn đèn tưởng là sao Mai nên họ rủ nhau về nghỉ. Trong lúc đó bên nữ đào đến sáng và xong việc trước. Bên nam thua cuộc trong sự “tâm phục, khẩu phục”. Để nhớ ơn người phụ nữ mưu trí, người ta lấy tên bà đặt tên ao, từ đó ao phụ nữ đào được gọi là ao Bà Om. Và truyền thống nam đi cưới nữ, con phải lấy họ mẹ trong dân tộc Khmer cũng bắt đầu từ đây. Mãi đến sau này khi người Pháp cai trị nước ta thì con mới lấy theo họ cha.</p>', '<p>Từ tháng 10 đến tháng 12, Ao Bà Om trở nên lộng lẫy hơn bao giờ hết khi hoa sen, hoa súng nở rộ, phủ kín mặt nước một màu hồng và tím rực rỡ. Đây là thời điểm tuyệt vời để du khách tận hưởng vẻ đẹp thanh khiết của thiên nhiên, hít thở không khí trong lành và ghi lại những khoảnh khắc đáng nhớ bên hồ nước thơ mộng.</p><p>Nếu bạn yêu thích sự yên tĩnh và trong lành, hãy đến Ao Bà Om vào buổi sáng từ 6:00 – 9:00, khi ánh nắng dịu nhẹ phủ lên mặt nước trong xanh, phản chiếu hàng cây cổ thụ soi bóng yên bình. Đây là lúc lý tưởng để dạo bộ, chụp ảnh và tận hưởng không gian thư thái.</p><p>Ngược lại, nếu bạn muốn trải nghiệm không khí sôi động và khám phá những nét đẹp văn hóa của đồng bào Khmer, hãy đến Ao Bà Om vào dịp Tết Chôl Chnăm Thmây (khoảng tháng 4 dương lịch). Lúc này, nơi đây không chỉ là điểm du lịch mà còn là trung tâm sinh hoạt cộng đồng với nhiều hoạt động truyền thống, giúp du khách cảm nhận rõ nét văn hóa và tín ngưỡng của người Khmer.</p><p>Một trong những thời điểm ấn tượng nhất để ghé thăm Ao Bà Om là rằm tháng 10 âm lịch (tức khoảng 14 – 15 tháng 10 âm lịch của người Việt, tương đương tháng 12 dương lịch). Đây là lúc lễ hội Ok Om Bok diễn ra, còn được gọi là lễ hội đút cốm dẹp hay lễ hội cúng trăng. Không khí trở nên nhộn nhịp với những màn nhảy múa, hát Dù Kê cùng vô số hoạt động truyền thống của người Khmer. Khi màn đêm buông xuống, Ao Bà Om khoác lên vẻ đẹp lung linh huyền ảo với hàng trăm chiếc đèn gió được thả bay lên bầu trời, mang theo những ước nguyện về một mùa màng bội thu, cuộc sống bình an và hạnh phúc.</p>', '<p>1. Bún nước lèo</p><p>Bún nước lèo nổi bật với nước dùng trong nhưng đậm đà nhờ vào mắm bò hóc – một loại mắm truyền thống của người Khmer, tạo nên vị ngọt tự nhiên và mùi thơm đặc trưng. Một tô bún nước lèo đúng chuẩn không thể thiếu cá lóc luộc tách xương, tôm tươi bóc vỏ cùng các loại rau sống như bắp chuối, húng quế, giá đỗ, hẹ, tất cả hòa quyện tạo nên tổng thể hài hòa giữa vị ngọt thanh, béo nhẹ và mùi thơm đặc trưng của mắm. Khi ăn, thực khách có thể cho thêm ớt, chanh và nước mắm chua ngọt để tăng thêm hương vị.</p><p>2. Bún suông</p><p>Bún suông là món ăn độc đáo và đặc trưng của Trà Vinh, hấp dẫn thực khách bởi phần chả tôm quết nhuyễn, được tạo hình thành từng miếng dài cong cong giống như con đuông dừa. Chả tôm không chỉ có hình dáng lạ mắt mà còn mang hương vị thơm ngon, dai giòn nhờ vào cách chế biến công phu: tôm được xay nhuyễn, trộn với gia vị và quết thật kỹ để tạo độ dai, sau đó được nặn thành từng miếng nhỏ và thả vào nồi nước dùng nóng hổi.</p>', '<p>Để đến Ao Bà Om từ các tỉnh thành phía Nam lân cận, bạn có thể di chuyển bằng ô tô hoặc xe máy tùy theo sở thích. Nếu đi ô tô hoặc taxi, bạn chỉ cần di chuyển khoảng 10 – 15 phút theo hướng Tây Nam là đến nơi, phù hợp với những ai muốn tiết kiệm thời gian.</p><p>Tuy nhiên, nếu bạn thích cảm giác khám phá và ngắm nhìn phong cảnh miền Tây sông nước, xe máy là lựa chọn tuyệt vời. Bạn có thể thuê xe tại trung tâm TP. Trà Vinh và đi theo cung đường Võ Văn Kiệt – Quốc lộ 53. Lộ trình này đơn giản nhưng mang đến trải nghiệm thú vị khi băng qua những cánh đồng lúa xanh mướt, hàng dừa rợp bóng và không khí trong lành đặc trưng của vùng quê Trà Vinh.</p>', 'Phường 8, Thành phố Trà Vinh, Tỉnh Trà Vinh', 9.91766720, 106.30402640, NULL, 4, 4, '2025-05-11 11:41:01', '2025-05-11 11:49:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `destination_images`
--

CREATE TABLE `destination_images` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `destination_images`
--

INSERT INTO `destination_images` (`id`, `name`, `image_url`, `status`, `destination_id`, `created_at`, `updated_at`) VALUES
(48, '1746705000-langnoitanlap01.jpg', '/storage/destination_image/1746705000-langnoitanlap01.jpg', '2', 5, '2025-05-08 11:50:01', '2025-05-08 11:50:01'),
(49, '1746705001-langnoitanlap-1.jpg', '/storage/destination_image/1746705001-langnoitanlap-1.jpg', '0', 5, '2025-05-08 11:50:01', '2025-05-08 11:50:01'),
(50, '1746705001-langnoitanlap04.jpg', '/storage/destination_image/1746705001-langnoitanlap04.jpg', '0', 5, '2025-05-08 11:50:01', '2025-05-08 11:50:01'),
(51, '1746705001-langnoitanlap-9.jpg', '/storage/destination_image/1746705001-langnoitanlap-9.jpg', '0', 5, '2025-05-08 11:50:01', '2025-05-08 11:50:01'),
(52, '1746705001-langnoitanlaplongan01.jpg', '/storage/destination_image/1746705001-langnoitanlaplongan01.jpg', '0', 5, '2025-05-08 11:50:01', '2025-05-08 11:50:01'),
(53, '1746714043-nha-tram-cot-7-1024x768.webp', '/storage/destination_image/1746714043-nha-tram-cot-7-1024x768.webp', '2', 6, '2025-05-08 14:20:43', '2025-05-08 14:20:43'),
(54, '1746714043-nha-tram-cot-1.webp', '/storage/destination_image/1746714043-nha-tram-cot-1.webp', '0', 6, '2025-05-08 14:20:43', '2025-05-08 14:20:43'),
(55, '1746714043-nha-tram-cot-2.webp', '/storage/destination_image/1746714043-nha-tram-cot-2.webp', '0', 6, '2025-05-08 14:20:43', '2025-05-08 14:20:43'),
(56, '1746714043-nha-tram-cot-6-1024x768.webp', '/storage/destination_image/1746714043-nha-tram-cot-6-1024x768.webp', '0', 6, '2025-05-08 14:20:43', '2025-05-08 14:20:43'),
(57, '1746714043-nha-tram-cot-8-1024x768.webp', '/storage/destination_image/1746714043-nha-tram-cot-8-1024x768.webp', '0', 6, '2025-05-08 14:20:43', '2025-05-08 14:20:43'),
(58, '1746714043-nha-tram-cot-9-1024x768.webp', '/storage/destination_image/1746714043-nha-tram-cot-9-1024x768.webp', '0', 6, '2025-05-08 14:20:43', '2025-05-08 14:20:43'),
(59, '1746714107-lang-co-phuoc-loc-tho-01-1696516109.jpg', '/storage/destination_image/1746714107-lang-co-phuoc-loc-tho-01-1696516109.jpg', '2', 7, '2025-05-08 14:21:47', '2025-05-08 14:21:47'),
(60, '1746714107-lang-co-phuoc-loc-tho-02-1696516109.jpg', '/storage/destination_image/1746714107-lang-co-phuoc-loc-tho-02-1696516109.jpg', '0', 7, '2025-05-08 14:21:47', '2025-05-08 14:21:47'),
(61, '1746714107-lang-co-phuoc-loc-tho-03-1696516109.jpg', '/storage/destination_image/1746714107-lang-co-phuoc-loc-tho-03-1696516109.jpg', '0', 7, '2025-05-08 14:21:47', '2025-05-08 14:21:47'),
(62, '1746714107-lang-co-phuoc-loc-tho-04-1696516109.jpg', '/storage/destination_image/1746714107-lang-co-phuoc-loc-tho-04-1696516109.jpg', '0', 7, '2025-05-08 14:21:47', '2025-05-08 14:21:47'),
(63, '1746714107-lang-co-phuoc-loc-tho-05-1696516109.jpg', '/storage/destination_image/1746714107-lang-co-phuoc-loc-tho-05-1696516109.jpg', '0', 7, '2025-05-08 14:21:47', '2025-05-08 14:21:47'),
(64, '1746714107-lang-co-phuoc-loc-tho-08-1696516170.jpg', '/storage/destination_image/1746714107-lang-co-phuoc-loc-tho-08-1696516170.jpg', '0', 7, '2025-05-08 14:21:47', '2025-05-08 14:21:47'),
(65, '1746714107-lang-co-phuoc-loc-tho-09-1696516170.jpg', '/storage/destination_image/1746714107-lang-co-phuoc-loc-tho-09-1696516170.jpg', '0', 7, '2025-05-08 14:21:47', '2025-05-08 14:21:47'),
(66, '1746716225-khu-du-lich-canh-dong-bat-tan-1-1024x683.webp', '/storage/destination_image/1746716225-khu-du-lich-canh-dong-bat-tan-1-1024x683.webp', '2', 8, '2025-05-08 14:57:06', '2025-05-08 14:57:06'),
(67, '1746716226-canhdongbattan-1.jpg', '/storage/destination_image/1746716226-canhdongbattan-1.jpg', '0', 8, '2025-05-08 14:57:06', '2025-05-08 14:57:06'),
(68, '1746716226-canhdongbattanlongan-2.jpg', '/storage/destination_image/1746716226-canhdongbattanlongan-2.jpg', '0', 8, '2025-05-08 14:57:06', '2025-05-08 14:57:06'),
(69, '1746716226-canhdongbattanlongan03.jpg', '/storage/destination_image/1746716226-canhdongbattanlongan03.jpg', '0', 8, '2025-05-08 14:57:06', '2025-05-08 14:57:06'),
(70, '1746716226-khu-du-lich-canh-dong-bat-tan-6-1024x614.webp', '/storage/destination_image/1746716226-khu-du-lich-canh-dong-bat-tan-6-1024x614.webp', '0', 8, '2025-05-08 14:57:06', '2025-05-08 14:57:06'),
(71, '1746716226-khu-du-lich-canh-dong-bat-tan-7-1024x768.webp', '/storage/destination_image/1746716226-khu-du-lich-canh-dong-bat-tan-7-1024x768.webp', '0', 8, '2025-05-08 14:57:06', '2025-05-08 14:57:06'),
(72, '1746716226-khu-du-lich-canh-dong-bat-tan-8-1024x678.webp', '/storage/destination_image/1746716226-khu-du-lich-canh-dong-bat-tan-8-1024x678.webp', '0', 8, '2025-05-08 14:57:06', '2025-05-08 14:57:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `destination_utilities`
--

CREATE TABLE `destination_utilities` (
  `destination_id` int UNSIGNED NOT NULL,
  `utility_id` int UNSIGNED NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quality` int DEFAULT NULL,
  `distance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `follows`
--

CREATE TABLE `follows` (
  `id` int UNSIGNED NOT NULL,
  `follower_id` int UNSIGNED NOT NULL,
  `following_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `likes`
--

CREATE TABLE `likes` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `post_id` int UNSIGNED DEFAULT NULL,
  `comment_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(39, '2025_05_02_011057_create_roles_table', 1),
(40, '2014_10_12_000000_create_users_table', 2),
(41, '2025_05_02_011057_create_slides_table', 3),
(42, '2025_05_02_011056_create_utility_types_table', 4),
(43, '2025_05_02_011059_create_provinces_table', 5),
(44, '2025_05_02_011056_create_travel_types_table', 6),
(45, '2025_05_02_011056_create_badges_table', 7),
(46, '2025_05_02_011055_create_districts_table', 8),
(47, '2025_05_02_011059_create_utilities_table', 9),
(48, '2025_05_02_011058_create_missions_table', 10),
(49, '2025_05_02_011059_create_notifications_table', 11),
(50, '2025_05_02_011058_create_follows_table', 12),
(51, '2025_05_02_011054_create_destinations_table', 13),
(52, '2025_05_02_011053_create_posts_table', 14),
(53, '2025_05_02_011055_create_destination_utilities_table', 15),
(54, '2025_05_02_011102_create_wards_table', 16),
(55, '2025_05_02_011058_create_user_missions_table', 17),
(56, '2025_05_02_011052_create_destination_images_table', 18),
(57, '2014_10_12_100000_create_password_reset_tokens_table', 19),
(58, '2019_08_19_000000_create_failed_jobs_table', 19),
(59, '2019_12_14_000001_create_personal_access_tokens_table', 19),
(60, '2025_05_02_011053_create_comments_table', 19),
(61, '2025_05_02_011053_create_reports_table', 19),
(62, '2025_05_02_011054_create_ratings_table', 19),
(63, '2025_05_02_011054_create_shares_table', 19),
(64, '2025_05_02_011057_create_likes_table', 19);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `missions`
--

CREATE TABLE `missions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `points_reward` int DEFAULT NULL,
  `condition_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condition_value` int DEFAULT NULL,
  `badge_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `missions`
--

INSERT INTO `missions` (`id`, `name`, `description`, `points_reward`, `condition_type`, `condition_value`, `badge_id`, `created_at`, `updated_at`) VALUES
(3, 'nhi sdfsdf êf', 'ấdf sdfgsdf sdfs', 12, 'like', 521, 7, '2025-05-04 13:25:01', '2025-05-04 13:37:56'),
(4, 'sdsdf', 'dsfsdf', 2321, 'comment', 5, 7, '2025-05-04 13:35:15', '2025-05-04 13:35:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` int UNSIGNED NOT NULL,
  `notification_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `average_rating` double(8,2) NOT NULL DEFAULT '0.00',
  `user_id` int UNSIGNED DEFAULT NULL,
  `destination_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ratings`
--

CREATE TABLE `ratings` (
  `id` int UNSIGNED NOT NULL,
  `score` int DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `post_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reports`
--

CREATE TABLE `reports` (
  `id` int UNSIGNED NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `user_id` int UNSIGNED DEFAULT NULL,
  `post_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Quản trị', '2025-05-04 01:29:51', '2025-05-04 01:29:51'),
(3, 'Người dùng', '2025-05-04 01:30:01', '2025-05-04 01:30:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shares`
--

CREATE TABLE `shares` (
  `id` int UNSIGNED NOT NULL,
  `is_public` tinyint(1) DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `post_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slides`
--

CREATE TABLE `slides` (
  `id` int UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slides`
--

INSERT INTO `slides` (`id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, '1746320666.png', '0', '2025-05-04 01:04:26', '2025-05-04 01:04:26'),
(3, '1746320674.png', '0', '2025-05-04 01:04:34', '2025-05-04 01:04:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `travel_types`
--

CREATE TABLE `travel_types` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `travel_types`
--

INSERT INTO `travel_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Du lịch làng nghề truyền thống', '0', '2025-05-04 01:03:20', '2025-05-08 10:53:59'),
(3, 'Du lịch nghỉ dưỡng', '0', '2025-05-04 01:03:33', '2025-05-04 01:03:33'),
(4, 'Du lịch văn hóa', '0', '2025-05-04 04:32:25', '2025-05-04 04:32:25'),
(6, 'Du lịch sinh thái', '0', '2025-05-08 10:53:26', '2025-05-08 10:53:26'),
(7, 'Du lịch tâm linh', '0', '2025-05-08 10:53:35', '2025-05-08 10:53:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `user_rank` int NOT NULL DEFAULT '0',
  `status` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `description`, `user_rank`, `status`, `role_id`, `created_at`, `updated_at`) VALUES
(3, 'nhudiep', 'nhudiep@gmail.com', '$2y$12$nQMyNPNqN87cY.6aI/jSXuEtVYpAljlpr5wuWJgQVo1qOVhKs0Tne', '1746716932.jpg', NULL, 0, '0', 3, '2025-05-04 01:41:29', '2025-05-08 15:08:52'),
(4, 'admin', 'admin@gmail.com', '$2y$12$MyKYKCyx9ZJ8tnj4NNQzW.fnCoX1xneuUPPjlob9VN5afgtpkXaCa', '1746716717.jpg', NULL, 0, '0', 2, '2025-05-04 01:42:35', '2025-05-08 15:05:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_missions`
--

CREATE TABLE `user_missions` (
  `user_id` int UNSIGNED NOT NULL,
  `mission_id` int UNSIGNED NOT NULL,
  `completion_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `utilities`
--

CREATE TABLE `utilities` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `distance` double DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `utility_type_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `utilities`
--

INSERT INTO `utilities` (`id`, `name`, `price`, `address`, `latitude`, `longitude`, `distance`, `time`, `image`, `status`, `description`, `utility_type_id`, `created_at`, `updated_at`) VALUES
(27, 'Khách Sạn Làng Nổi Tân Lập', 'Trung bình mỗi đêm khoảng 560.000đ/phòng', 'Xã Tân Lập, Huyện Mộc Hóa, Tỉnh Long An', NULL, NULL, NULL, '24/7', '1746705831.webp', '0', '<p>Khách Sạn Làng Nổi Tân Lập cao 8 tầng với 32 phòng, được đặt tại vị trí ấn tượng trên một hòn đảo ven sông Rạch Rừng, nằm bên trong khu du lịch. Nếu bạn thích ngắm cảnh của rừng nổi Tân Lập vào mỗi thời khắc trong ngày thì đây sẽ là lựa chọn lý tưởng nhất.&nbsp;</p>', 13, '2025-05-08 12:01:49', '2025-05-08 12:03:51'),
(28, 'Phú Thắng Grand Hotel', 'Có nhiều loại phòng giá dao động từ 230.000đ đến 2.700.000đ', 'Xã Đức Hòa Hạ, Huyện Đức Hòa, Tỉnh Long An', 51.50000000, 10.50000000, NULL, '24/7', '1746706640.webp', '0', '<p>Khách Sạn Phú Thắng Grand là một khách sạn sang trọng và hiện đại, nằm ở khu công nghiệp Tân Đức - Long An, cách Làng Nổi Tân Lập chỉ 30,5km nên rất thuận tiện cho việc du chuyển. Khách sạn có 3 hạng phòng tốt nhất là Grand Deluxe, Grand Premier và Grand Executive vô cùng sang trọng cho bạn tự do lựa chọn cùng một số tiện ích hấp dẫn kèm theo.</p>', 13, '2025-05-08 12:17:20', '2025-05-08 12:17:20'),
(29, 'The Island Lodge Thoi Son', 'Có nhiều loại phòng giá dao động từ 4.000.000đ đến 6.000.000đ', 'Xã Thới Sơn, Thành phố Mỹ Tho, Tỉnh Tiền Giang', NULL, NULL, NULL, '24/7', '1746707083.webp', '0', '<p>The Island Lodge Mỹ Tho là một khách sạn nằm ở Tiền Giang, cách Làng Nổi Tân Lập 26,3km. Với thiết kế theo phong cách kiến trúc cổ điển, khách sạn tạo ra một không gian yên tĩnh, gần gũi với thiên nhiên. Khách sạn có phòng nghỉ sang trọng, được trang bị đầy đủ tiện nghi hiện đại, cùng với một số hoạt động giải trí và dịch vụ như hồ bơi, spa, nhà hàng và bar.</p>', 13, '2025-05-08 12:24:43', '2025-05-08 13:16:48'),
(30, 'Khách sạn Ruby', 'Dao động từ 300.000đ đến 1.300.000đ', 'Thị trấn Bến Lức, Huyện Bến Lức, Tỉnh Long An', 10.63987920, 106.49937440, NULL, '24/7', '1746714353.jpg', '0', '<p>Khách sạn Ruby&nbsp;là một nhà nghỉ khách sạn được thiết kế với 32&nbsp;phòng có kích cỡ khác nhau phù hợp với nhiều nhu cầu của khách hàng. Hệ thống thiết bị hiện đại, điều hòa, tivi, bàn ghế được làm từ gỗ, sóng wifi và các các dịch vụ đưa đón khách tham quan các điểm du lịch. Được thiết kế và trang trí theo phong cách cổ điển nhưng không kém phần&nbsp;sang trọng và quý phái. Các trang thiết bị và phòng ốc của nhà nghỉ - khách sạn rất tiện nghi và hiện đại nhằm mang lại sự hài lòng và thoải mái cho khách hàng trong suốt thời gian lưu trú tại phòng khách sạn. Với vị trí thuận lợi, RuBy là nơi khách hàng lựa chọn dừng chân và nghỉ dưỡng lý tưởng nhất&nbsp;tại Long An</p>', 13, '2025-05-08 14:25:53', '2025-05-08 14:25:53'),
(31, 'Bich Ngoan Hotel', 'Từ 617.284 VND/đêm', 'Phường 1, Thành phố Trà Vinh, Tỉnh Trà Vinh', NULL, NULL, NULL, '24/7', '1746964363.webp', '0', '<p><a href=\"https://www.traveloka.com/vi-vn/hotel/vietnam/bich-ngoan-hotel-9000000975149?funnel_source=content_article&amp;funnel_id=WP_514387\"><strong>Bich Ngoan Hotel</strong></a> là lựa chọn lý tưởng cho du khách khi đến với thành phố Trà Vinh, mang đến không gian nghỉ dưỡng hiện đại và tiện nghi. Là khách sạn đạt chuẩn 2 sao, nơi đây nổi bật với thiết kế sang trọng trong từng đường nét, phong cách phục vụ chuyên nghiệp và tận tâm. Tất cả các phòng đều được trang bị đầy đủ tiện nghi hiện đại cùng nội thất cao cấp, đảm bảo mang đến sự thoải mái tối đa cho du khách trong suốt kỳ nghỉ.</p><p>Ngoài ra, Bich Ngoan Hotel còn cung cấp nhiều tiện ích hấp dẫn như hồ bơi ngoài trời để thư giãn, nhà hàng sang trọng phục vụ ẩm thực địa phương và quốc tế, cùng phòng gym hiện đại dành cho những ai yêu thích thể thao. Với sự kết hợp hoàn hảo giữa vị trí thuận tiện, tiện ích đẳng cấp và dịch vụ chất lượng, nơi đây hứa hẹn sẽ mang đến cho du khách trải nghiệm lưu trú đáng nhớ khi ghé thăm Ao Bà Om.</p>', 13, '2025-05-11 11:52:44', '2025-05-11 11:58:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `utility_types`
--

CREATE TABLE `utility_types` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `utility_types`
--

INSERT INTO `utility_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(13, 'Lưu trú', '0', '2025-05-08 10:55:29', '2025-05-08 10:55:29'),
(14, 'Ẩm thực', '0', '2025-05-08 10:55:50', '2025-05-08 10:55:50');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_parent_comment_id_foreign` (`parent_comment_id`);

--
-- Chỉ mục cho bảng `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destinations_user_id_foreign` (`user_id`),
  ADD KEY `destinations_travel_type_id_foreign` (`travel_type_id`);

--
-- Chỉ mục cho bảng `destination_images`
--
ALTER TABLE `destination_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destination_images_destination_id_foreign` (`destination_id`);

--
-- Chỉ mục cho bảng `destination_utilities`
--
ALTER TABLE `destination_utilities`
  ADD PRIMARY KEY (`destination_id`,`utility_id`),
  ADD KEY `destination_utilities_utility_id_foreign` (`utility_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follows_follower_id_foreign` (`follower_id`),
  ADD KEY `follows_following_id_foreign` (`following_id`);

--
-- Chỉ mục cho bảng `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_post_id_foreign` (`post_id`),
  ADD KEY `likes_comment_id_foreign` (`comment_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `missions_badge_id_foreign` (`badge_id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_destination_id_foreign` (`destination_id`);

--
-- Chỉ mục cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_user_id_foreign` (`user_id`),
  ADD KEY `ratings_post_id_foreign` (`post_id`);

--
-- Chỉ mục cho bảng `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_user_id_foreign` (`user_id`),
  ADD KEY `reports_post_id_foreign` (`post_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Chỉ mục cho bảng `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shares_user_id_foreign` (`user_id`),
  ADD KEY `shares_post_id_foreign` (`post_id`);

--
-- Chỉ mục cho bảng `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `travel_types`
--
ALTER TABLE `travel_types`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `user_missions`
--
ALTER TABLE `user_missions`
  ADD PRIMARY KEY (`user_id`,`mission_id`),
  ADD KEY `user_missions_mission_id_foreign` (`mission_id`);

--
-- Chỉ mục cho bảng `utilities`
--
ALTER TABLE `utilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilities_utility_type_id_foreign` (`utility_type_id`);

--
-- Chỉ mục cho bảng `utility_types`
--
ALTER TABLE `utility_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `badges`
--
ALTER TABLE `badges`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `destination_images`
--
ALTER TABLE `destination_images`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT cho bảng `missions`
--
ALTER TABLE `missions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `shares`
--
ALTER TABLE `shares`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `travel_types`
--
ALTER TABLE `travel_types`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `utilities`
--
ALTER TABLE `utilities`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `utility_types`
--
ALTER TABLE `utility_types`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_parent_comment_id_foreign` FOREIGN KEY (`parent_comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `destinations`
--
ALTER TABLE `destinations`
  ADD CONSTRAINT `destinations_travel_type_id_foreign` FOREIGN KEY (`travel_type_id`) REFERENCES `travel_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `destinations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `destination_images`
--
ALTER TABLE `destination_images`
  ADD CONSTRAINT `destination_images_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `destination_utilities`
--
ALTER TABLE `destination_utilities`
  ADD CONSTRAINT `destination_utilities_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `destination_utilities_utility_id_foreign` FOREIGN KEY (`utility_id`) REFERENCES `utilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_follower_id_foreign` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `follows_following_id_foreign` FOREIGN KEY (`following_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `missions`
--
ALTER TABLE `missions`
  ADD CONSTRAINT `missions_badge_id_foreign` FOREIGN KEY (`badge_id`) REFERENCES `badges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `shares`
--
ALTER TABLE `shares`
  ADD CONSTRAINT `shares_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shares_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `user_missions`
--
ALTER TABLE `user_missions`
  ADD CONSTRAINT `user_missions_mission_id_foreign` FOREIGN KEY (`mission_id`) REFERENCES `missions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_missions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `utilities`
--
ALTER TABLE `utilities`
  ADD CONSTRAINT `utilities_utility_type_id_foreign` FOREIGN KEY (`utility_type_id`) REFERENCES `utility_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
