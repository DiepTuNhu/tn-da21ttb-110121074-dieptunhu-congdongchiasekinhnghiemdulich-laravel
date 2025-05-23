-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 23, 2025 at 05:47 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel_gamification`
--
CREATE DATABASE IF NOT EXISTS `travel_gamification` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `travel_gamification`;

-- --------------------------------------------------------

--
-- Table structure for table `badges`
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
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`id`, `name`, `description`, `icon_url`, `status`, `created_at`, `updated_at`) VALUES
(9, 'Người ủng hộ mỗi ngày', 'Luôn sẵn lòng lan tỏa năng lượng tích cực bằng cách thả tim mỗi ngày.', '/storage/badges/1747658503_1.png', '0', '2025-05-19 12:41:43', '2025-05-19 12:41:43'),
(10, 'Người trò chuyện hàng ngày', 'Mỗi ngày là một cuộc trò chuyện mới – bạn luôn đóng góp tiếng nói của mình.', '/storage/badges/1747658521_1.png', '0', '2025-05-19 12:42:01', '2025-05-19 12:42:01'),
(11, 'Nhà kể chuyện hàng ngày', 'Mỗi ngày bạn đều có một câu chuyện du lịch đáng chia sẻ – và bạn đã làm điều đó!', '/storage/badges/1747658535_1.png', '0', '2025-05-19 12:42:15', '2025-05-19 12:42:15'),
(12, 'Người kết nối tích cực', 'Bạn không chỉ thích – bạn kết nối với cộng đồng bằng hành động mỗi tuần.', '/storage/badges/1747658553_1.png', '0', '2025-05-19 12:42:33', '2025-05-19 12:42:33'),
(13, 'Người tham gia nhiệt tình', 'Góp mặt trong các cuộc trò chuyện và mang đến giá trị qua từng bình luận.', '/storage/badges/1747658566_1.png', '0', '2025-05-19 12:42:46', '2025-05-19 12:42:46'),
(14, 'Người kể chuyện hàng tuần', 'Mỗi tuần, bạn đều để lại dấu ấn với những câu chuyện truyền cảm hứng.', '/storage/badges/1747658578_1.png', '0', '2025-05-19 12:42:58', '2025-05-19 12:42:58'),
(15, 'Người yêu thích nội dung', 'Một người luôn tìm ra những nội dung hay và không ngại thể hiện sự yêu thích.', '/storage/badges/1747658592_1.png', '0', '2025-05-19 12:43:12', '2025-05-19 12:43:12'),
(16, 'Người giao tiếp thân thiện', 'Luôn hiện diện trong các cuộc trò chuyện, chia sẻ và phản hồi tích cực.', '/storage/badges/1747658612_1.png', '0', '2025-05-19 12:43:32', '2025-05-19 12:43:32'),
(17, 'Nhà khám phá tháng', 'Với những bài viết trải nghiệm chất lượng, bạn là người lan tỏa tinh thần khám phá.', '/storage/badges/1747658625_1.png', '0', '2025-05-19 12:43:45', '2025-05-19 12:43:45');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
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
-- Table structure for table `destinations`
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
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `name`, `price`, `highlights`, `best_time`, `local_cuisine`, `transportation`, `address`, `latitude`, `longitude`, `status`, `user_id`, `travel_type_id`, `created_at`, `updated_at`) VALUES
(5, 'Làng nổi Tân Lập', 'Có rất nhiều hoạt động khác nhau nên giá dao động từ 20.000VNĐ đến 340.000VNĐ', '<p>Các bạn đừng hiểu lầm làng nổi Tân Lập bên trong có một ngôi làng nhé, nơi đây là một khu rừng tràm nguyên sinh rộng lớn và những con đường bí ẩn dẫn vào rừng. Đây được xem là địa điểm phù hợp dành cho những ai thích tìm về với thiên nhiên hoang dã, khám phá nét văn hoá sông nước miền Tây Nam Bộ.</p><p>Sở dĩ có cái tên Làng nổi Tân Lập là do trước kia khi chưa được quy hoạch, vào mùa nước nổi khoảng tháng 7 âm lịch hàng năm người dân ở đây thường nâng cao sàn nhà theo con nước lên, nhìn từ xa giống như một làng nổi trên mặt nước mênh mông. Do đó, khi quy hoạch khu du lịch này, tên gọi làng nổi gắn với địa danh xã Tân Lập đã được đặt cho khu du lịch.</p><p>Đến khu du lịch sinh thái làng nổi Tân Lập, du khách có thể tản bộ trên con đường xuyên rừng tràm, đi thuyền xuôi theo rạch Rừng,&nbsp;thả mình vào thiên nhiên trên quãng đường dài hơn 3km xung quanh rừng tràm bằng thuyền cáp kéo.</p><p>Sau khi mua vé, du khách sẽ bắt đầu len lỏi theo những con rạch bằng xuồng nhỏ&nbsp;giữa rừng tràm. Con rạch chính dẫn vào khu trung tâm Làng nổi Tân Lập có tên là Rạch Rừng.&nbsp;Sẽ thật bình yên khi du khách ngồi trên xuồng lênh đênh trên rạch rừng, ngửi hương tràm, ngắm những vạt sen, súng rực nở một góc sông, nhìn những cánh chim chao liệng trên bầu trời xanh ngắt, thỉnh thoảng lại nghiêng mình theo con nước.</p>', '<p>Làng nổi là một khu du lịch sinh thái với cảnh quan thay đổi lớn theo mùa. Nếu bạn thắc mắc làng nổi Tân Lập vào thời điểm nào đẹp nhất?&nbsp;thì câu trả lời chính là du lịch miền Tây vào mùa nước nổi tức là từ tháng 8 tới tháng 11 âm lịch hàng năm. Vào mùa nước nổi, nếu bạn đứng từ trên cao nhìn xuống sẽ thấy làng nổi Tân lập giống như một hòn đảo xanh thẳm giữa biển nước mênh mông. Tất cả tạo nên một bức tranh thiên nhiên vô cùng sống động.</p>', '<p>Khu du lịch Làng Nổi Tân Lập nổi tiếng với nhiều món ăn đặc sản miền Tây rất hấp dẫn. Dưới đây là một số món ăn đặc sắc bạn không nên bỏ lỡ khi đến tham quan và khám phá khu du lịch này:</p><p>1. Ốc Nướng Tiêu Xanh</p><p>Ốc nướng tiêu xanh là một trong những món ăn đặc trưng và hấp dẫn nhất của Làng Nổi Tân Lập. Món ăn được chế biến từ ốc bươu ướp với tiêu xanh và một số gia vị truyền thống. Sau khi ướp đều, ốc được nướng trên lửa than hoa với độ nhiệt vừa phải, tạo ra một màu vàng óng ánh, thơm phức và cay nồng đặc trưng.&nbsp; Ốc nướng tiêu xanh thường được ăn kèm với rau sống, chanh và muối ớt, tạo nên một hương vị độc đáo, khiến thực khách không thể nào quên được.</p><p>2. Cá Kho Tộ</p><p>Cá kho tộ của Làng Nổi Tân Lập được làm từ cá rô, cá hú, cá bông lau,... ướp với nước mắm, đường, tỏi và ớt, sau đó kho thật chín. Cá kho tộ được nấu trong nồi đất, trên lò củi, tạo ra một hương vị đặc biệt. Cá kho tộ có thịt ngọt, thơm, mềm và không bị khô, khi ăn kèm với cơm trắng nóng và rau sống, tạo nên một bữa ăn ngon miệng và đầy dinh dưỡng. Nếu bạn đến Làng Nổi Tân Lập, đừng quên thử món cá kho tộ tuyệt vời này!</p><p>3. Lẩu Ếch Tân Lập</p><p>Lẩu ếch là một món ăn đặc sản của Làng Nổi Tân Lập. Đây là một món ăn có vị cay nồng, được chế biến từ thịt ếch tươi ngon, cùng với nhiều loại rau và gia vị tự nhiên như lá chanh, ớt, tiêu, hành, tỏi, gừng. Nước lẩu được chế biến từ nước dùng ếch cùng các loại gia vị, mang lại hương vị đậm đà, thơm ngon và đầy hấp dẫn. Ăn lẩu ếch ở Làng Nổi Tân Lập cũng có thể được kết hợp với uống bia để có hương vị chuẩn nhất.</p><p>4. Cá Lóc Nướng Trui&nbsp;</p><p>Cá lóc nướng trui là món bạn nhất định phải thử khi đến Làng nổi Tân Lập. Được chọn từ những con cá tươi ngon, sau đó được làm sạch, rửa qua nước muối và phơi khô trong nắng cho đến khi khô ráo và có mùi thơm đặc trưng. Sau đó,cá lóc được nướng trên than hoa, với lửa nhỏ vừa để cá chín đều và giữ được độ giòn của thịt. Món ăn thường được ăn kèm với rau sống, bánh tráng và nước mắm chua ngọt.</p><p>5. Lẩu Mắm Long An</p><p>Lẩu mắm là món ăn đặc trưng của miền Tây Việt Nam và cũng là một trong những món ăn được yêu thích ở Làng Nổi Tân Lập. Để nấu món lẩu mắm, người ta sử dụng nồi đất hoặc nồi gang đặt trên bếp than để tạo ra hương vị đặc biệt. Món lẩu mắm có mùi vị đậm đà, thơm ngon, đặc biệt hấp dẫn vào những ngày mưa. Nếu bạn có dịp ghé thăm Làng Nổi Tân Lập, đừng quên thử món lẩu mắm miền Tây này.</p>', '<p>Để đến được Làng Nổi Tân Lập từ Thành phố Hồ Chí Minh, bạn có thể đi theo một trong những hướng dẫn sau đây:</p><p>Cách 1: Từ TPHCM đi qua QL1A đến Bến Lức - Long An, rẽ trái qua đường Hùng Vương, sau đó rẽ phải tiếp đến đường Lê Thị Hồng Gấm, đi thêm khoảng 500m sẽ đến khu du lịch rừng nổi Tân Lập.</p><p>Cách 2: Từ TPHCM đi đến cầu Rạch Miễu, tiếp tục rẽ phải vào đường Trần Hưng Đạo, đi thêm khoảng 17km nữa để đến khu du lịch.</p><p>Cách 3: Từ TPHCM bạn đi đến KCN Hiệp Phước, rẽ phải vào đường Nguyễn Hữu Thọ, đi tiếp thêm khoảng 22km đến khu du lịch Làng nổi Tân Lập.</p>', 'Xã Tân Lập, Huyện Mộc Hóa, Tỉnh Long An', 10.75166000, 106.01729000, '0', 4, 6, '2025-05-08 11:47:25', '2025-05-19 16:10:55'),
(6, 'Nhà Trăm Cột', 'Miễn phí', '<p>Nhà trăm cột nằm ở tả ngạn sông Vàm Cỏ Đông, thuộc xã Long Hựu Đông, huyện Cần Đước, tỉnh Long An. Ngôi nhà này do ông Trần Văn Hoa lúc ấy là Hương Sư làng Long Hựu, tổng Lộc Thành Hạ ,tỉnh Chợ Lớn xây dựng. Dù gọi là nhà trăm cột những sự thực, ngôi nhà có đến 120 cột, trong đó 68 cột chính và 52 cột vuông nhỏ phụ trợ.</p><p>Nhà trăm cột có kiểu chữ “Quốc”, 3 gian, 2 chái đôi với diện tích 822m2&nbsp;trong một khu vườn rộng 4.886m2. Ngôi nhà này được khởi công vào năm 1901, đến năm 1903 thì hoàn thành và năm 1904 thì xong phần chạm khắc trang trí do nhóm 15 thợ từ làng Mỹ Xuyên – làng chạm khắc mộc nổi tiếng của Thừa Thiên – Huế thực hiện bằng chất liệu chủ yếu là các loại gỗ quý như cẩm lai, mun… mái lợp ngói âm dương, nền nhà bằng đá tảng cao 0,9m, mặt nền lát gạch Tàu lục giác.</p><p>Nhà gồm có hai phần: phần trước là phần nội tự – ngoại khách, phần sau là phần để ở và sinh hoạt. Lẫm lúa ở sau cùng đã tháo dở (1952), nay chỉ còn nền móng. Mặt chính nhà quay về hướng Tây Bắc, quanh nhà có sân rộng dùng để phơi lúa, bột. Hành lang, hiên và nền nhà được lát gạch Tàu, không gian rộng rãi hướng ra khu vườn rộng nên luôn mát mẻ. Cửa chính và các cửa sổ có song hình con tiện, bản gỗ.</p>', '<p>Khí hậu tại Long An được ưu ái với thời tiết thuận lợi, mát mẻ, vì thế du khách có thể đến đây vào bất cứ thời gian nào. Để thuận lợi cho việc di chuyển, bạn nên đến tham quan Nhà Trăm Cột vào mùa khô (từ tháng 12 đến tháng 4 năm sau). Nếu đến vào mùa mưa bạn cũng có thể trải nghiệm được những nét văn hoá mùa nước nổi tại đây.</p>', '<p>1. Ốc Nướng Tiêu Xanh</p><p>Ốc nướng tiêu xanh là một trong những món ăn đặc trưng và hấp dẫn. Món ăn được chế biến từ ốc bươu ướp với tiêu xanh và một số gia vị truyền thống. Sau khi ướp đều, ốc được nướng trên lửa than hoa với độ nhiệt vừa phải, tạo ra một màu vàng óng ánh, thơm phức và cay nồng đặc trưng.&nbsp; Ốc nướng tiêu xanh thường được ăn kèm với rau sống, chanh và muối ớt, tạo nên một hương vị độc đáo, khiến thực khách không thể nào quên được.</p><p>2. Cá Kho Tộ</p><p>Cá kho tộ của được làm từ cá rô, cá hú, cá bông lau,... ướp với nước mắm, đường, tỏi và ớt, sau đó kho thật chín. Cá kho tộ được nấu trong nồi đất, trên lò củi, tạo ra một hương vị đặc biệt. Cá kho tộ có thịt ngọt, thơm, mềm và không bị khô, khi ăn kèm với cơm trắng nóng và rau sống, tạo nên một bữa ăn ngon miệng và đầy dinh dưỡng. Nếu bạn đến, đừng quên thử món cá kho tộ tuyệt vời này!</p><p>3. Lẩu Ếch Tân Lập</p><p>Lẩu ếch là một món ăn đặc sản của. Đây là một món ăn có vị cay nồng, được chế biến từ thịt ếch tươi ngon, cùng với nhiều loại rau và gia vị tự nhiên như lá chanh, ớt, tiêu, hành, tỏi, gừng. Nước lẩu được chế biến từ nước dùng ếch cùng các loại gia vị, mang lại hương vị đậm đà, thơm ngon và đầy hấp dẫn. Ăn lẩu ếch ở cũng có thể được kết hợp với uống bia để có hương vị chuẩn nhất.</p><p>4. Cá Lóc Nướng Trui&nbsp;</p><p>Cá lóc nướng trui là món bạn nhất định phải thử khi đến. Được chọn từ những con cá tươi ngon, sau đó được làm sạch, rửa qua nước muối và phơi khô trong nắng cho đến khi khô ráo và có mùi thơm đặc trưng. Sau đó,cá lóc được nướng trên than hoa, với lửa nhỏ vừa để cá chín đều và giữ được độ giòn của thịt. Món ăn thường được ăn kèm với rau sống, bánh tráng và nước mắm chua ngọt.</p><p>5. Lẩu Mắm Long An</p><p>Lẩu mắm là món ăn đặc trưng của miền Tây Việt Nam và cũng là một trong những món ăn được yêu thích ở. Để nấu món lẩu mắm, người ta sử dụng nồi đất hoặc nồi gang đặt trên bếp than để tạo ra hương vị đặc biệt. Món lẩu mắm có mùi vị đậm đà, thơm ngon, đặc biệt hấp dẫn vào những ngày mưa. Nếu bạn có dịp ghé thăm, đừng quên thử món lẩu mắm miền Tây này.</p>', '<p>Đối với những du khách sinh sống tại TP. Hồ Chí Minh hoặc các tỉnh lân cận, thì có thể chọn xe khách để đi lại tiết kiệm hơn. Hiện nay có một số hãng xe cung cấp chuyến xe đi Long An như: An Hòa Hiệp, Thiên Bảo,... với mức giá vé xe khoảng 150.000 VND - 200.000 VND.</p><p>Nếu bạn là người yêu thích tốc độ và muốn chinh phục cung đường đến nhà trăm cột, thì có thể chọn xe máy hoặc xe ô tô di chuyển. Theo đó, du khách có thể di chuyển theo cung đường như sau:</p><p>Xuất phát từ Trường Chinh, Âu Cơ, QL50 và QL50 đến Tân Lân -&gt; Đường 19/5 -&gt; ĐT23/ĐT826B tại Phước Đông -&gt; Rẽ trái vào Thế Ngọc NET -&gt; rẽ phải vào đường 19/5 -&gt; rẽ trái vào phía tạp hóa Cô Trinh vào ĐT23 /DT826B và đi thắng để đến điểm du lịch.</p>', 'Xã Long Hựu Đông, Huyện Cần Đước, Tỉnh Long An', 10.48266270, 106.69141700, '0', 4, 4, '2025-05-08 14:09:21', '2025-05-23 13:58:09'),
(7, 'Làng cổ Phước Lộc Thọ', '40.000 VND/ người', '<p>Một điều khiến du khách ấn tượng khi bước qua cổng là bộ tượng Phước Lộc Thọ bằng đá cẩm thạch. Bộ tượng được điêu khắc tỉ mỉ và khá sống động, đây là biểu tượng đúng như cái tên Phước Lộc Thọ.</p><p>Khám phá khuôn viên làng cổ, bạn sẽ lần lượt chiêm ngưỡng 22 ngôi nhà gỗ cổ được phục dựng mang nét văn hoá của cả 3 miền Bắc, Trung, Nam và nhà sàn Tây Nguyên. Đặc biệt, nơi đây trưng bày hàng trăm món đồ sưu tầm, cổ vật quý từ vật dụng sinh hoạt hàng ngày của vua chúa, quan quân, địa chủ, người dân đến các vật tâm linh văn hóa của người Việt. Mỗi vật dụng sẽ được bày trí trong một gian nhà khác nhau, đây cũng là những thứ thu hút du khách nhất.</p><p>Tiếp theo bạn sẽ khám phá những ngôi nhà đặc sắc nổi tiếng nhất trong làng cổ:</p><ul><li>Ngôi nhà chữ “Công”. Với tuổi đời trên 100, bao gồm 104 cột đồ sộ, thiết kế của ngôi nhà dựa trên kiến trúc xưa miền Bắc. Tại các cột nhà sẽ được điêu khắc tứ linh (Long - Lân - Quy - Phụng) và tứ hữu (mai - lan - cúc - trúc) thể hiện sự nguy nga, tráng lệ và uy nghi.</li><li>Ngôi nhà rường 5 gian 2 chái với cổng tam quan phía trước; trong nhà có đến 74 cột, tổng thể ngôi nhà rất sự uy nghi. Bên trong ngôi nhà trang trí nhiều vật dụng quý hiếm như bộ bàn rồng, ngà voi, tủ cổ khảm xà cừ 7 màu…</li><li>Những ngôi nhà phong cách nhà rường Huế thì nét đặc trưng là sự điêu khắc tinh xảo. Các ngôi nhà rường Huế tại làng cổ mang phong cách cung đình với chất liệu sơn son thếp vàng và được chạm trổ rồng phượng rất tinh xảo và tỉ mỉ từng chi tiết nhỏ. Đây là kiểu nhà phổ biến của quan lại và giới thượng lưu xứ kinh kỳ thời phong kiến. Bên trong lưu giữ nhiều cổ vật quý bằng đá, gỗ, kim loại, gốm sứ… thuộc các niên đại khác nhau.</li><li>&nbsp;Với 6 căn nhà sàn của các dân tộc khu vực Đông Nam Bộ và Tây Nguyên. Bạn sẽ được chiêm ngưỡng những kỷ vật như cồng, chiêng, những bức tượng gỗ và dụng cụ lao động của đồng bào dân tộc.</li><li>Ngoài ra, tại đây còn có nhà sàn Khmer, nhà sàn dân tộc Thái, nhà tiểu lâu tứ giác bát dần, chùa một cột …</li></ul>', '<p>Khí hậu tại Long An được ưu ái với thời tiết thuận lợi, mát mẻ, vì thế du khách có thể đến đây vào bất cứ thời gian nào. Để thuận lợi cho việc di chuyển, bạn nên đến tham quan làng cổ vào mùa khô (từ tháng 12 đến tháng 4 năm sau). Nếu đến vào mùa mưa bạn cũng có thể trải nghiệm được những nét văn hoá mùa nước nổi tại đây.</p>', '<p>1. Ốc Nướng Tiêu Xanh</p><p>Ốc nướng tiêu xanh là một trong những món ăn đặc trưng và hấp dẫn nhất của. Món ăn được chế biến từ ốc bươu ướp với tiêu xanh và một số gia vị truyền thống. Sau khi ướp đều, ốc được nướng trên lửa than hoa với độ nhiệt vừa phải, tạo ra một màu vàng óng ánh, thơm phức và cay nồng đặc trưng.&nbsp; Ốc nướng tiêu xanh thường được ăn kèm với rau sống, chanh và muối ớt, tạo nên một hương vị độc đáo, khiến thực khách không thể nào quên được.</p><p>2. Cá Kho Tộ</p><p>Cá kho tộ của được làm từ cá rô, cá hú, cá bông lau,... ướp với nước mắm, đường, tỏi và ớt, sau đó kho thật chín. Cá kho tộ được nấu trong nồi đất, trên lò củi, tạo ra một hương vị đặc biệt. Cá kho tộ có thịt ngọt, thơm, mềm và không bị khô, khi ăn kèm với cơm trắng nóng và rau sống, tạo nên một bữa ăn ngon miệng và đầy dinh dưỡng. Nếu bạn đến, đừng quên thử món cá kho tộ tuyệt vời này!</p><p>3. Lẩu Ếch Tân Lập</p><p>Lẩu ếch là một món ăn đặc sản của. Đây là một món ăn có vị cay nồng, được chế biến từ thịt ếch tươi ngon, cùng với nhiều loại rau và gia vị tự nhiên như lá chanh, ớt, tiêu, hành, tỏi, gừng. Nước lẩu được chế biến từ nước dùng ếch cùng các loại gia vị, mang lại hương vị đậm đà, thơm ngon và đầy hấp dẫn. Ăn lẩu ếch ở cũng có thể được kết hợp với uống bia để có hương vị chuẩn nhất.</p><p>4. Cá Lóc Nướng Trui&nbsp;</p><p>Cá lóc nướng trui là món bạn nhất định phải thử khi đến. Được chọn từ những con cá tươi ngon, sau đó được làm sạch, rửa qua nước muối và phơi khô trong nắng cho đến khi khô ráo và có mùi thơm đặc trưng. Sau đó,cá lóc được nướng trên than hoa, với lửa nhỏ vừa để cá chín đều và giữ được độ giòn của thịt. Món ăn thường được ăn kèm với rau sống, bánh tráng và nước mắm chua ngọt.</p><p>5. Lẩu Mắm Long An</p><p>Lẩu mắm là món ăn đặc trưng của miền Tây Việt Nam và cũng là một trong những món ăn được yêu thích ở. Để nấu món lẩu mắm, người ta sử dụng nồi đất hoặc nồi gang đặt trên bếp than để tạo ra hương vị đặc biệt. Món lẩu mắm có mùi vị đậm đà, thơm ngon, đặc biệt hấp dẫn vào những ngày mưa. Nếu bạn có dịp ghé thăm, đừng quên thử món lẩu mắm miền Tây này.</p>', '<p>Chỉ cách Sài Gòn khoảng 50km nên việc di chuyển đến Long An khá dễ dàng. Du khách có thể lựa chọn di chuyển bằng xe máy, ô tô hoặc với khoảng thời gian chỉ hơn 1 giờ.</p><p>Việc di chuyển đến làng cổ khá dễ dàng, nếu đi bằng xe máy bạn cứ chạy thẳng theo đường Bà Hom, đến tỉnh lộ 10 chạy tiếp và rẽ trái vào đường tỉnh 824 tại ngã ba Đức Hòa (Long An, tiếp tục chạy thêm khoảng 10 phút nữa là thấy Làng cổ Phước Lộc Thọ bên tay phải.</p><p>Bạn cũng có thể đi xe buýt chuyến 627 (Chợ Lớn - Đức Huệ) hoặc 626 (Chợ Lớn - Hậu Nghĩa), giá vé xe buýt là 22.000 VND/ lượt. Bạn sẽ ghé trạm tại ngã ba Đức Hòa, sau đó đi xe ôm vào làng cổ.</p>', 'Xã Hựu Thạnh, Huyện Đức Hòa, Tỉnh Long An', 51.50000000, 10.50000000, '0', 4, 4, '2025-05-08 14:19:59', '2025-05-23 13:59:06'),
(8, 'Khu du lịch cánh đồng bất tận', 'Dao động từ 220.000VNĐ đến 1.200.000VNĐ', '<p>Cánh đồng bất tận tọa lạc tại khu phố 3, thị trấn Bình Phong Thạnh, huyện Mộc Hóa, tỉnh Long An và thuộc sở hữu của Trung tâm Nghiên cứu bảo tồn và phát triển dược liệu Đồng Tháp Mười. Tại đây chứa có hơn 1000 ha rừng tràm gió nguyên sinh có tuổi thọ lên đến trăm tuổi. Không những vậy đây còn là điểm sinh trưởng và bảo tồn của hơn 80 loại gen của những loại thảo dược quý hiếm. Chính vì thế nơi đây còn được biết đến là “rừng thuốc”.</p><p>Nơi đây không quá ồn ào như nhiều khu du lịch ở miền Tây Nam Bộ, cũng chẳng mang vẻ đẹp đượm màu xưa cũ của du lịch miền Bắc, Trung. Đến với cánh đồng bất tận Long An du khách sẽ không khỏi ngỡ ngàng bởi vẻ đẹp quá đỗi bình yên của sông nước hiền hoà, của sự trong lành và yên ả của những cảnh đồng, cánh rừng mang đến.</p><p>Khám phá khu du lịch cánh đồng bất tận du khách sẽ chẳng thiếu những trải nghiệm tuyệt vời, đặc biệt cũng chẳng thiếu những góc check-in độc đáo. Vào mùa hoa súng, hoa sen nở rộ tạo nên khung cảnh đầy nên thơ sẽ làm nức lòng những tín đồ yêu thích check-in sống ảo.</p><p>Hay những buổi sớm mai và chiều tà, những cánh cò trắng bay và kiếm ăn nơi ruộng đồng cũng làm nên một quan cảnh bình yên khó tả. Ghé thăm nơi đây du khách tưởng chừng sẽ thoát khỏi chốn xô bồ náo nhiệt thường trực mà hào cùng thiên nhiên đầy nắng gió.</p>', '<p>Tại đây cây cối xanh tốt bốn mùa tạo nên một khung cảnh tràn đầy sức sống, nên du khách đến vào mùa tạo cũng sẽ cảm nhận được thiên nhiên tươi mới. Tuy mỗi mùa đều có những dấu ấn riêng biệt nhưng để có thể khám phá trọn vẹn nhất có thể du khách có thể chọn lựa các khoảng thời gian như sau:</p><ul><li>Rằm tháng giêng: Thời điểm này tại đây tổ chức Lễ Giỗ tổ Đại y tôn Hải Thượng Lãn Ông và người được mệnh danh là Đức Thánh y Tuệ Tĩnh nhằm tôn vinh cũng như nhớ về truyền thống y đức. Vào ngày này thường có các trò chơi, hát cải lương,... mọi người có thể hòa cùng không khí náo nhiệt của lễ hội.</li><li>Tháng 9 đến tháng 11: Đây là thời điểm Long An cũng như các tỉnh miền Tây bước vào mùa đặc trưng “mùa nước nổi\". Các thảm thực vật tươi tốt phủ xanh cả vùng trời. Đặc biệt là hoa sen, hoa súng nở rộ ở khu du lịch cánh đồng bất tận du khách tha hồ check-in cảnh đẹp nơi đây.</li><li>Tháng 11 đến tháng 12: Đây là thời điểm chuyển giao mùa, không khí mát mẻ, mùa nước nổi đi qua những đàn cò bay về cánh đồng gần cạn nước bắt tôm cá. Những đàn cò trắng hoà cũng màu của đất tạo nên khung cảnh bình dị nhưng lại thân thuộc đến lạ kỳ.</li></ul>', '<p>1. Ốc Nướng Tiêu Xanh</p><p>Ốc nướng tiêu xanh là một trong những món ăn đặc trưng và hấp dẫn nhất của. Món ăn được chế biến từ ốc bươu ướp với tiêu xanh và một số gia vị truyền thống. Sau khi ướp đều, ốc được nướng trên lửa than hoa với độ nhiệt vừa phải, tạo ra một màu vàng óng ánh, thơm phức và cay nồng đặc trưng.&nbsp; Ốc nướng tiêu xanh thường được ăn kèm với rau sống, chanh và muối ớt, tạo nên một hương vị độc đáo, khiến thực khách không thể nào quên được.</p><p>2. Cá Kho Tộ</p><p>Cá kho tộ của được làm từ cá rô, cá hú, cá bông lau,... ướp với nước mắm, đường, tỏi và ớt, sau đó kho thật chín. Cá kho tộ được nấu trong nồi đất, trên lò củi, tạo ra một hương vị đặc biệt. Cá kho tộ có thịt ngọt, thơm, mềm và không bị khô, khi ăn kèm với cơm trắng nóng và rau sống, tạo nên một bữa ăn ngon miệng và đầy dinh dưỡng. Nếu bạn đến, đừng quên thử món cá kho tộ tuyệt vời này!</p><p>3. Lẩu Ếch Tân Lập</p><p>Lẩu ếch là một món ăn đặc sản của. Đây là một món ăn có vị cay nồng, được chế biến từ thịt ếch tươi ngon, cùng với nhiều loại rau và gia vị tự nhiên như lá chanh, ớt, tiêu, hành, tỏi, gừng. Nước lẩu được chế biến từ nước dùng ếch cùng các loại gia vị, mang lại hương vị đậm đà, thơm ngon và đầy hấp dẫn. Ăn lẩu ếch ở cũng có thể được kết hợp với uống bia để có hương vị chuẩn nhất.</p><p>4. Cá Lóc Nướng Trui&nbsp;</p><p>Cá lóc nướng trui là món bạn nhất định phải thử khi đến. Được chọn từ những con cá tươi ngon, sau đó được làm sạch, rửa qua nước muối và phơi khô trong nắng cho đến khi khô ráo và có mùi thơm đặc trưng. Sau đó,cá lóc được nướng trên than hoa, với lửa nhỏ vừa để cá chín đều và giữ được độ giòn của thịt. Món ăn thường được ăn kèm với rau sống, bánh tráng và nước mắm chua ngọt.</p><p>5. Lẩu Mắm Long An</p><p>Lẩu mắm là món ăn đặc trưng của miền Tây Việt Nam và cũng là một trong những món ăn được yêu thích ở. Để nấu món lẩu mắm, người ta sử dụng nồi đất hoặc nồi gang đặt trên bếp than để tạo ra hương vị đặc biệt. Món lẩu mắm có mùi vị đậm đà, thơm ngon, đặc biệt hấp dẫn vào những ngày mưa. Nếu bạn có dịp ghé thăm, đừng quên thử món lẩu mắm miền Tây này.</p>', '<p>Cách thành phố Hồ Chí Minh hơn 80km nên việc di chuyển bằng xe máy sẽ là chuyện nhỏ với nhiều người, đặc biệt là những bạn trẻ đam mê phượt. Đường đi khá dễ mọi người chỉ cần theo hướng thành phố Tân An sau đó rẽ về quốc lộ 62 theo hướng Mộc Hoá - Long An hướng. Hoặc đơn giản hơn đi theo chỉ dẫn của google map định vị là sẽ đến được khu du lịch cánh đồng bất tận.</p><p>Đối với những du khách ở xa thì máy bay là phương tiện thuận lợi nhất trong hành trình di chuyển đến khu du lịch cánh đồng bất tận. Và tất nhiên nên chọn đáp sân bay gần Long An nhất là Tân Sơn Nhất của TP. Hồ Chí Minh.</p>', 'Thị trấn Bình Phong Thạnh, Huyện Mộc Hóa, Tỉnh Long An', 10.72510720, 106.08230580, '0', 4, 6, '2025-05-08 14:54:25', '2025-05-23 14:00:00'),
(11, 'Ao Bà Om', 'Miễn phí', '<p>Nằm yên bình giữa lòng thành phố Trà Vinh, Ao Bà Om hiện lên như một bức tranh thủy mặc tuyệt đẹp, điểm xuyết bởi sắc xanh của nước, của trời và những tán cây cổ thụ. Không chỉ là một địa điểm du lịch miền Tây nổi tiếng, Ao Bà Om còn gắn liền với những truyền thuyết ly kỳ và nét văn hóa đặc sắc của người Khmer Nam Bộ.</p><p>Ngoài cảnh đẹp đến mê mẩn lòng người, ao nước rộng lớn này còn lung linh huyền ảo bởi những câu chuyện nửa hư nửa thực từ bao đời nay ăn sâu vào tiềm thức người dân địa phương.</p><p>Theo truyền thuyết ngày trước, vùng đất Trà Vinh hằng năm cứ đến mùa hạn thì nước ngọt khan hiếm, ruộng rẫy khô cằn, cây cỏ chết héo, người dân trong vùng vì hạn hán rơi vào cảnh lầm than. Để cứu dân khỏi cảnh khốn cùng, một ông hoàng trấn nhậm trong vùng quy tụ bà con đào ao tìm nguồn nước.</p><p>Tình cờ, trong vùng lúc đó cũng xảy ra một vụ tranh cãi khó phân xử là đàn ông và đàn bà, ai phải đi cưới ai và ai phải chịu mọi phí tổn trong lễ cưới? Ông hoàng nhân dịp này chia ra hai bên nam nữ tổ chức một cuộc thi đào ao. Ao bên nào đào sâu hơn, lớn hơn và xong trước thì thắng, bên thua sẽ phải đi cưới.</p><p>Bên nam thì đào ao tròn ở phía Tây còn bên nữ đào ao vuông ở phía Đông. Bên nữ do bà Om, một phụ nữ Khmer chỉ huy, thấy không thể kình được sức đàn ông nên bên nữ dùng “kế”: Họ vừa đào vừa ca múa để các chàng bỏ việc mà chạy sang xem. Nửa đêm, bà Om cho chặt một cây tre thật dài, treo ngọn đèn lồng rồi đem cắm ở hướng Đông. Theo giao hẹn là khi sao Mai mọc là phải ngừng công việc, khi bên nam thấy ngọn đèn tưởng là sao Mai nên họ rủ nhau về nghỉ. Trong lúc đó bên nữ đào đến sáng và xong việc trước. Bên nam thua cuộc trong sự “tâm phục, khẩu phục”. Để nhớ ơn người phụ nữ mưu trí, người ta lấy tên bà đặt tên ao, từ đó ao phụ nữ đào được gọi là ao Bà Om. Và truyền thống nam đi cưới nữ, con phải lấy họ mẹ trong dân tộc Khmer cũng bắt đầu từ đây. Mãi đến sau này khi người Pháp cai trị nước ta thì con mới lấy theo họ cha.</p>', '<p>Từ tháng 10 đến tháng 12, Ao Bà Om trở nên lộng lẫy hơn bao giờ hết khi hoa sen, hoa súng nở rộ, phủ kín mặt nước một màu hồng và tím rực rỡ. Đây là thời điểm tuyệt vời để du khách tận hưởng vẻ đẹp thanh khiết của thiên nhiên, hít thở không khí trong lành và ghi lại những khoảnh khắc đáng nhớ bên hồ nước thơ mộng.</p><p>Nếu bạn yêu thích sự yên tĩnh và trong lành, hãy đến Ao Bà Om vào buổi sáng từ 6:00 – 9:00, khi ánh nắng dịu nhẹ phủ lên mặt nước trong xanh, phản chiếu hàng cây cổ thụ soi bóng yên bình. Đây là lúc lý tưởng để dạo bộ, chụp ảnh và tận hưởng không gian thư thái.</p><p>Ngược lại, nếu bạn muốn trải nghiệm không khí sôi động và khám phá những nét đẹp văn hóa của đồng bào Khmer, hãy đến Ao Bà Om vào dịp Tết Chôl Chnăm Thmây (khoảng tháng 4 dương lịch). Lúc này, nơi đây không chỉ là điểm du lịch mà còn là trung tâm sinh hoạt cộng đồng với nhiều hoạt động truyền thống, giúp du khách cảm nhận rõ nét văn hóa và tín ngưỡng của người Khmer.</p><p>Một trong những thời điểm ấn tượng nhất để ghé thăm Ao Bà Om là rằm tháng 10 âm lịch (tức khoảng 14 – 15 tháng 10 âm lịch của người Việt, tương đương tháng 12 dương lịch). Đây là lúc lễ hội Ok Om Bok diễn ra, còn được gọi là lễ hội đút cốm dẹp hay lễ hội cúng trăng. Không khí trở nên nhộn nhịp với những màn nhảy múa, hát Dù Kê cùng vô số hoạt động truyền thống của người Khmer. Khi màn đêm buông xuống, Ao Bà Om khoác lên vẻ đẹp lung linh huyền ảo với hàng trăm chiếc đèn gió được thả bay lên bầu trời, mang theo những ước nguyện về một mùa màng bội thu, cuộc sống bình an và hạnh phúc.</p>', '<p>1. Bún nước lèo</p><p>Bún nước lèo nổi bật với nước dùng trong nhưng đậm đà nhờ vào mắm bò hóc – một loại mắm truyền thống của người Khmer, tạo nên vị ngọt tự nhiên và mùi thơm đặc trưng. Một tô bún nước lèo đúng chuẩn không thể thiếu cá lóc luộc tách xương, tôm tươi bóc vỏ cùng các loại rau sống như bắp chuối, húng quế, giá đỗ, hẹ, tất cả hòa quyện tạo nên tổng thể hài hòa giữa vị ngọt thanh, béo nhẹ và mùi thơm đặc trưng của mắm. Khi ăn, thực khách có thể cho thêm ớt, chanh và nước mắm chua ngọt để tăng thêm hương vị.</p><p>2. Bún suông</p><p>Bún suông là món ăn độc đáo và đặc trưng của Trà Vinh, hấp dẫn thực khách bởi phần chả tôm quết nhuyễn, được tạo hình thành từng miếng dài cong cong giống như con đuông dừa. Chả tôm không chỉ có hình dáng lạ mắt mà còn mang hương vị thơm ngon, dai giòn nhờ vào cách chế biến công phu: tôm được xay nhuyễn, trộn với gia vị và quết thật kỹ để tạo độ dai, sau đó được nặn thành từng miếng nhỏ và thả vào nồi nước dùng nóng hổi.</p>', '<p>Để đến Ao Bà Om từ các tỉnh thành phía Nam lân cận, bạn có thể di chuyển bằng ô tô hoặc xe máy tùy theo sở thích. Nếu đi ô tô hoặc taxi, bạn chỉ cần di chuyển khoảng 10 – 15 phút theo hướng Tây Nam là đến nơi, phù hợp với những ai muốn tiết kiệm thời gian.</p><p>Tuy nhiên, nếu bạn thích cảm giác khám phá và ngắm nhìn phong cảnh miền Tây sông nước, xe máy là lựa chọn tuyệt vời. Bạn có thể thuê xe tại trung tâm TP. Trà Vinh và đi theo cung đường Võ Văn Kiệt – Quốc lộ 53. Lộ trình này đơn giản nhưng mang đến trải nghiệm thú vị khi băng qua những cánh đồng lúa xanh mướt, hàng dừa rợp bóng và không khí trong lành đặc trưng của vùng quê Trà Vinh.</p>', 'Phường 8, Thành phố Trà Vinh, Tỉnh Trà Vinh', 9.91766720, 106.30402640, '0', 4, 4, '2025-05-11 12:35:09', '2025-05-15 13:42:53'),
(12, 'Chùa Âng', 'Miễn phí', '<p>Chùa Âng, gọi theo ngôn ngữ Paly là Wat Angkor Raig Borei, tọa lạc tại Phường 8, thành phố Trà Vinh. Ngôi chùa nằm trong cụm danh thắng Ao Bà Om và bảo tàng văn hóa dân tộc Khmer.</p><p>Từ xa nhìn vào, bạn sẽ thấy những tòa nhà trong chùa với lối kiến trúc hình tháp vươn thẳng lên trời, mang nét đẹp nguy nga, tráng lệ nhưng cũng không kém phần trang nghiêm.</p><p>Theo sử sách thì chùa Âng được xây dựng vào thế kỷ thứ 10 (năm 990) và được xây dựng qui mô như hiện nay vào năm Thiệu Trị thứ 3, tức năm 1842 theo dương lịch. Từ đó đến nay, ngôi chùa được trùng tu, sửa chữa nhiều lần, trong đó xây dựng mới các công trình phụ như nhà tăng xá, trai đường… nhưng ngôi chánh điện cơ bản vẫn giữ được nguyên trạng như buổi đầu mới hình thành.</p><p>Như bao ngôi chùa Khmer khác trên địa bàn Trà Vinh, chùa Âng là một quần thể các công trình kiến trúc bao gồm tăng xá, giảng đường dạy chữ Paly và chữ Khmer… bao quanh ngôi chánh điện uy nghi. Ngôi chùa quay mặt về hướng đông, thể hiện tư tưởng Phật giáo là Phật Thích ca ở tây phương nhìn về hướng đông để độ trì chúng sinh.</p><p>Cổng chùa Âng được trang trí bằng nghệ thuật điêu khắc rất kỳ công, tinh xảo với những tượng chằn, tiên nữ, chim thần theo mô típ truyền thống Khmer.</p>', '<p>Thời điểm tốt nhất để tham quan chùa Âng ở Trà Vinh là vào các dịp lễ hội và mùa lễ hội của người Khmer, khi không khí tại đây đặc biệt sôi động và náo nhiệt có thể tham gia bao gồm:</p><p>Tết Chol Chnam Thmay (lễ hội năm mới Khmer): Lễ hội này diễn ra vào khoảng tháng 4 hàng năm, là dịp lễ quan trọng nhất trong năm của người Khmer. Đây là thời điểm lý tưởng để trải nghiệm các nghi lễ truyền thống, văn hóa và phong tục tập quán đặc sắc.</p><p>Lễ Ok Om Bok (lễ cúng trăng): Lễ hội này sẽ diễn ra vào tháng 10 hoặc tháng 11, bao gồm các hoạt động văn hóa, thể thao và ẩm thực đặc sắc, giúp du khách có thể hiểu thêm về phong tục tập quán của cộng đồng Khmer.</p><p>Ngoài các lễ hội, du khách cũng có thể tham quan chùa Âng vào thời điểm từ tháng 11 đến tháng 4 hàng năm, khi thời tiết ở Trà Vinh thường khô ráo và dễ chịu, rất thuận lợi cho việc khám phá các điểm du lịch và tận hưởng cảnh quan yên bình của chùa Âng.</p>', '<p>1. Bún nước lèo</p><p>Bún nước lèo nổi bật với nước dùng trong nhưng đậm đà nhờ vào mắm bò hóc – một loại mắm truyền thống của người Khmer, tạo nên vị ngọt tự nhiên và mùi thơm đặc trưng. Một tô bún nước lèo đúng chuẩn không thể thiếu cá lóc luộc tách xương, tôm tươi bóc vỏ cùng các loại rau sống như bắp chuối, húng quế, giá đỗ, hẹ, tất cả hòa quyện tạo nên tổng thể hài hòa giữa vị ngọt thanh, béo nhẹ và mùi thơm đặc trưng của mắm. Khi ăn, thực khách có thể cho thêm ớt, chanh và nước mắm chua ngọt để tăng thêm hương vị.</p><p>2. Bún suông</p><p>Bún suông là món ăn độc đáo và đặc trưng của Trà Vinh, hấp dẫn thực khách bởi phần chả tôm quết nhuyễn, được tạo hình thành từng miếng dài cong cong giống như con đuông dừa. Chả tôm không chỉ có hình dáng lạ mắt mà còn mang hương vị thơm ngon, dai giòn nhờ vào cách chế biến công phu: tôm được xay nhuyễn, trộn với gia vị và quết thật kỹ để tạo độ dai, sau đó được nặn thành từng miếng nhỏ và thả vào nồi nước dùng nóng hổi.</p>', '<p>Để đến chùa Âng từ các tỉnh thành phía Nam lân cận, bạn có thể di chuyển bằng ô tô hoặc xe máy tùy theo sở thích. Nếu đi ô tô hoặc taxi, bạn chỉ cần di chuyển khoảng 10 – 15 phút theo hướng Tây Nam là đến nơi, phù hợp với những ai muốn tiết kiệm thời gian.</p><p>Tuy nhiên, nếu bạn thích cảm giác khám phá và ngắm nhìn phong cảnh miền Tây sông nước, xe máy là lựa chọn tuyệt vời. Bạn có thể thuê xe tại trung tâm TP. Trà Vinh và đi theo cung đường Võ Văn Kiệt – Quốc lộ 53. Lộ trình này đơn giản nhưng mang đến trải nghiệm thú vị khi băng qua những cánh đồng lúa xanh mướt, hàng dừa rợp bóng và không khí trong lành đặc trưng của vùng quê Trà Vinh.</p>', 'Phường 8, Thành phố Trà Vinh, Tỉnh Trà Vinh', 9.91595540, 106.30346360, '0', 4, 7, '2025-05-14 15:50:54', '2025-05-23 14:01:54'),
(13, 'Nhà thờ Đức Bà Sài Gòn', 'Miễn phí', '<p>Nhà thờ Đức Bà Sài Gòn được xây dựng với phong cách kiến ​​trúc tân La Mã Romanesque Revival (hay Neo-Romanesque). Đây là phong cách xây dựng được ưa chuộng vào khoảng giữa thế kỷ 19, lấy cảm hứng từ kiến ​​trúc Romanesque thế kỷ 11 và 12. Các tòa nhà theo phong cách này có xu hướng đặc trưng với các mái vòm và cửa sổ thiết kế đơn giản.</p><p>Trong quá trình xây dựng Nhà thờ Đức Bà Sài Gòn, toàn bộ vật liệu từ xi măng, sắt thép đến ốc vít đều được mang từ Pháp sang. Mặt ngoài của công trình được làm bằng gạch sản xuất tại Marseille. Ưu điểm của loại gạch này là để trần, không tô trát, không bị rêu bụi, vẫn giữ nguyên màu sáng hồng sau nhiều thập kỷ. Toàn bộ thánh đường có 56 cửa sổ kính màu được sản xuất tại tỉnh Chartres (Pháp).</p><p>Phần móng của thánh đường được thiết kế đặc biệt để chịu trọng lượng gấp 10 lần toàn bộ khối lượng kiến ​​trúc xây dựng. Và một điều rất đặc biệt là nhà thờ không có hàng rào, tường bao như các nhà thờ quanh Sài Gòn Gia Định lúc bấy giờ.&nbsp;</p><p>Nội thất thánh đường có hai dãy chính hình chữ nhật, mỗi bên sáu dãy tượng trưng cho 12 tông đồ. Bệ thờ của Nhà thờ Đức Bà Sài Gòn được làm bằng đá hoa cương nguyên khối với sáu vị thiên thần tạc vào đá, bệ chia làm ba ô, mỗi ô là một tác phẩm điêu khắc mô tả thánh tích.&nbsp;</p><p>Các bức tường được trang trí bằng 56 ô cửa kính mô tả các nhân vật hoặc sự kiện trong Kinh thánh, 31 hình hoa hồng tròn, 25 ô cửa sổ mắt bò nhiều màu kết hợp với các hình ảnh đẹp mắt. Mọi đường nét, gờ chỉ, hoa văn đều theo phom dáng Roman và Gothic trang nghiêm, tao nhã. Tuy nhiên, trong số 56 cửa kính này, chỉ có 4 cửa còn nguyên vẹn. Còn các cửa kính khác đã được tu sửa vào năm 1949 do bị phá hủy vì chiến tranh.</p>', '<p>Nhà thờ Đức Bà mở cửa miễn phí cho du khách tham quan. Nhưng để có thể trải nghiệm đầy đủ không khí tôn giáo, bạn nên đến vào giờ lễ của nhà thờ. Cụ thể, giờ lễ trong ngày tại Nhà thờ Đức Bà:</p><ul><li>Thứ 2 – Thứ 7: 5h30, 17h30</li><li>Chủ Nhật: 5h30, 6h45, 8h00, 9h30 (thánh lễ bằng tiếng Anh), 16h00, 17h15, 18h30.</li></ul><p>Lưu ý: Tùy thuộc vào quá trình trùng tu, giờ lễ và lịch lễ tại nhà thờ có thể thay đổi.&nbsp;</p>', '<p>Bánh tráng nướng: Được mệnh danh là “pizza Việt Nam,” thơm ngon và dễ ăn, phù hợp cho mọi lứa tuổi. Bạn nên thử ăn ở bánh tráng nướng cô Mập, bánh tráng nướng Hai Chị Em bình dân,…</p><p>Bánh mì Sài Gòn: Đây là món ăn mang đậm dấu ấn văn hóa ẩm thực đường phố. Một số tiệm bánh mì ngon xung quanh là bánh mì Huỳnh Hoa, bánh mì Bảy Hổ, bánh mì Như Lan, bánh mì Hồng Hoa.&nbsp;</p><p>Súp cua: Là món ăn đường phố quen thuộc và hấp dẫn, được yêu thích bởi hương vị đậm đà. Bạn có thể thử súp cua ở Súp cua Bông Mạc Đĩnh Chi, Súp cua Nhà thờ Đức Bà, Súp cua Hạnh,…</p>', '<p>Di chuyển bằng phương tiện cá nhân (xe máy, ô tô,…): Từ khu trung tâm, đi dọc theo đường Lê Duẩn, Hai Bà Trưng hoặc Đồng Khởi để đến Nhà thờ Đức Bà. Các điểm gửi xe bạn có thể tham khảo là đối diện Bưu điện Thành phố (phía sau nhà thờ). Ngoài ra con có ãi xe tư nhân trên đường Lê Duẩn, Hai Bà Trưng,…</p><p>Di chuyển bằng phương tiện công cộng (xe bus,…): Một số tuyến xe buýt có điểm dừng gần Nhà thờ Đức Bà bao gồm 14, 18, 30, 36, 45, 93, 152. Các tuyến này đều có điểm dừng tại khu vực công trường Công xã Paris. Qua đường Đồng Khởi hoặc đường Lê Duẩn – cách Nhà thờ Đức Bà một quãng đi bộ ngắn.</p>', 'Phường Bến Nghé, Quận 1, Thành phố Hồ Chí Minh', 10.77974380, 106.69901190, '0', 4, 7, '2025-05-14 15:54:54', '2025-05-15 13:25:34'),
(17, 'Biển Tân Thành', 'Miễn phí', '<p>Vốn là vùng biển phù sa nên biển Tân Thành mang một sắc nâu khác biệt, cát đen, nước biển không trong xanh hút mắt như các bãi biển du lịch nổi tiếng khác. Nhưng chính nét riêng độc đáo ấy càng giúp nơi đây trở nên thú vị hơn với nhiều cảnh quan mới mẻ, đặc biệt là vô số các hoạt động hấp dẫn đang chờ đợi bạn khám phá.</p><p>Cách TP. Hồ Chí Minh chỉ tầm 2 giờ di chuyển, biển Tân Thành đã và đang trở thành điểm du lịch lý tưởng cho những tín đồ yêu thích khám phá, chinh phục các điểm đến hấp dẫn. Giữa cuộc sống bộn bề hối hả, ta cần lắm những nơi như thế này để xả bớt căng thẳng, áp lực hằng ngày. Muốn hít thở bầu không khí trong lành, tìm về cảm giác bình yên hay đơn giản là ăn món hải sản yêu thích, chụp hình check-in giữa khung cảnh thiên nhiên bao la… vậy thì còn chần chờ gì, đến biển Tân Thành thôi!</p><p>Nếu đã bỏ công di chuyển đến biển Tân Thành thì chẳng có lý do gì để bạn bỏ lỡ khoảnh khắc thưởng thức bình minh và hoàng hôn ở nơi đây. Sáng sớm, khi Mặt trời dần ló dạng, ánh bình minh chiếu rọi khắp mọi nơi, thêm bầu không khí trong lành, gió biển rười rượi, dạo bước trên nền cát đen lấp lánh mang đến một cảm giác hứng khởi khó tả.</p><p>Đến khi chiều muộn, khung cảnh hoàng hôn trên biển lại khiến cho những ai được mục sở thị phải bồi hồi mê mẩn. Hình ảnh người dân vùng biển nối tiếp nhau ra về, kết thúc một ngày làm việc vất vả. Khoảng không bỗng chốc yên ắng đến xao xuyến lạ thường.</p>', '<p>Tại biển Tân Thành Gò Công, mỗi một mùa đều mang một nét đẹp riêng khác nhau. Chính vì thế, bạn có thể lựa chọn những thời điểm khác nhau để tham quan bãi biển này. Ngoài ra, nếu bạn là “tín đồ” mê hải sản, bạn có thể ghé đến biển Tân Thành Gò Công vào những mùa hải sản trong năm bao gồm:</p><ul><li>Mùa nghêu: Trải dài từ tháng 3 đến tháng 9 âm lịch hàng năm</li><li>Mùa ốc: Tháng 5 âm lịch hàng năm</li><li>Mùa sam: Trải dài từ tháng 10 đến tháng 2 âm lịch hàng năm.</li></ul>', '<p>Đên Tân Thành nhất định bạn phải thưởng thức qua đặc sản nghêu nơi đây. Đó là một món ăn vô cùng thơm ngon và hấp dẫn. Ngoài ra còn có cá dứa, ốc hương Tân Thành được chế biến vô cùng ngon miệng và đặc biệt là món sam biển béo, thơm vô cùng nổi tiếng ở đây. Chính vì thế khi du lịch Tân Thành du khách sẽ không cần phải lo lắng về việc ăn gì.</p>', '<p>Biển Tân Thành Gò Công nằm cách trung tâm thành phố Hồ Chí Minh khoảng chừng 73km. Nếu xuất phát từ trung tâm thành phố, bạn sẽ chỉ cần đi dọc theo tuyến đường Quốc Lộ 50, qua thị trấn Cần Giuộc và đến với Cần Đước. Sau đó, bạn tiếp tục đi thẳng đến bờ Bắc sông Soài Rạp, qua phà Mỹ Lợi để đến với thị xã Gò Công. Tại Gò Công, bạn chạy thẳng một đoạn đường dài khoảng 25km nữa là đã có thể đến với biển Tân Thành Gò Công này.&nbsp;</p>', 'Xã Tân Thành, Huyện Gò Công Đông, Tỉnh Tiền Giang', 10.29115940, 106.77899910, '0', 4, 3, '2025-05-23 14:13:21', '2025-05-23 14:13:21'),
(18, 'Nhà thờ Cái Bè', 'Miễn phí', '<p>Nhà thờ do linh mục Adophe Keller người Đức và bà con giáo xứ Cái Bè xây dựng từ năm 1929-1932. Nhà thờ Cái Bè có lối kiến trúc Roman của phương tây bằng bê tông cốt thép đúc đá, qua bao thăng trầm thời gian vẫn giữ được dáng vẻ đẹp thanh thoát, cổ kính.</p><p>Mặt bằng nhà thờ có hình Thánh giá với hai cánh ngang rất cân đối, gồm một lòng chính và hai lòng phụ với khuôn viên rộng và mát mẻ.&nbsp;Nhìn từ trên cao, nhà thờ như một dấu chữ thập khổng lồ nổi bật giữa khuôn viên cây xanh và xóm làng bình dị.</p><p>Tháp chuông có bộ chuông rất lớn gồm 4 trái, được đúc tại Pháp vào năm 1931, với kỹ thuật thiết kế quả lắc chuông và thanh treo chuông rất tiên tiến.</p><p>Bộ chuông nhà thờ Đức Bà Sai Gon do một hãng khác đúc thì thua xa về kỹ thuật thiết kế quả lắc của của nhà thờ này. Dưới chân tháp chuông là một hầm chứa nước khá lớn nhằm khuếch đại âm thanh của tiếng chuông. &nbsp;Tiếng chuông nhà thờ là âm thanh của sự yên lành, thanh bình, thánh thiện, gieo vào lòng người những cung bậc của bác ái và hân hoan.</p><p>Mái vòm cao, chia múi với những hoa văn đơn giản mà tinh tế. Nội thất tráng lệ cùng những bức tranh được bài trí trang trọng bên trong nhà thờ. Tấm tranh bằng kính màu vừa có tác dụng chiếu sáng nội thất thánh đường vừa mang tính thẩm mỹ độc đáo, tạo nên một không gian linh thiêng cho những tín đồ tin tưởng nguyện cầu.&nbsp;</p><p>Nhà thờ có 5 bàn thờ bằng đá cẩm thạch quý và một bộ cửa kính màu rất đẹp. Khi bước vào bên trong nhà thờ du khách sẽ cảm nhận được một thiết kế giàu tính thẩm mỹ, hàng ghế ngồi được đặt ngay ngắn hai bên lối đi.</p><p>Trong ánh sáng hừng đông, toàn bộ quần thể nhà thờ trở nên đẹp lộng lẫy với tháp chuông cao vút, tượng đức mẹ uy nghi trên nền trời xanh, mái nâu sáng rực, dòng sông hiền hòa cũng bừng lên phản chiếu ánh bình minh.</p>', '<p>Thời gian lý tưởng để tham quan nhà thờ Cái Bè (ở Tiền Giang, không phải Trà Vinh) là vào những ngày Chủ Nhật (5 giờ sáng - 5 giờ chiều) hoặc các ngày thường (5 giờ sáng - 5 giờ 30 chiều). Bạn có thể đến thăm nhà thờ bất cứ khi nào nó mở cửa để chiêm ngưỡng vẻ đẹp kiến trúc Roman độc đáo.&nbsp;</p>', '<p>1. Hủ tiếu Mỹ Tho</p><p>Hủ tiếu Mỹ Tho là đặc sản Tiền Giang ngon trứ danh, nổi tiếng ở khắp nơi. Sợi hủ tiếu được&nbsp;làm từ gạo, sợi trong, khi trụng nước sôi có độ khô dai vừa phải, không bở hoặc mềm. Một tô hủ tiếu thường có xương, thịt bằm, lòng heo hoặc hải sản, chan ngập nước dùng… Các loại rau để ăn kèm như hẹ, xà lách, giá được bày lên trên, rắc thêm một ít hành phi và tiêu để món ăn tròn vị hơn.</p><p>2. Chuối quết dừa</p><p>Chuối quết dừa là món ăn dân dã mà bạn nhất định phải thử khi đến Tiền Giang. Thoạt nhìn, chuối quết dừa&nbsp;trông giống cốm dẹp, nhưng khi nhìn kỹ sẽ thấy có nhiều điểm khác nhau.&nbsp;Nguyên liệu để làm món chuối quết dừa bao gồm chuối sứ xanh, già và dừa nạo. Công đoạn chế biến đơn giản nhưng đòi hòi người làm phải khéo léo và có kinh nghiệm. Ăn kèm với chuối quết dừa còn có các loại rau thơm như lá lốt, rau càng cua, rau húng lủi, rau thơm, bánh tráng… và rắc thêm một ít đậu phộng rang lên món chuối. Và nước chấm chua ngọt là điều không thể thiếu khi thưởng thức món chuối quết dừa này.</p><p>3. Bún gỏi già Mỹ Tho</p><p>Bún gỏi già là một trong những món ăn hấp dẫn của vùng đất Tiền Giang gây ấn tượng với nhiều thực khách, bởi hương vị đặc trưng của tép, me chua và tương xay. Một bát bún gỏi già thường có bún, tôm, tép tươi hoặc sườn non, thịt ba chỉ, giá chần, nước lèo và một số loại rau ăn kèm như rau muống, rau chuối bào và rau hẹ, đặc biệt không thể thiếu nước chấm là mắm cá linh nguyên chất. Nước dùng của bún gỏi già được hầm bằng xương heo, tôm và thịt ba rọi. Khi thưởng thức, bạn sẽ cảm nhận được vị đậm đà của nước lèo, chua thanh của me và béo bùi của đậu phộng, tôm, thịt…</p>', '<p>Để di chuyển đến Nhà thờ Cái Bè, bạn có thể sử dụng xe máy hoặc taxi. Nếu bạn đi xe máy, hãy sử dụng Google Maps hoặc hỏi đường từ người dân địa phương.&nbsp;</p><ul><li>Xe máy: Do Nhà thờ Cái Bè nằm ở vị trí đắc địa, việc di chuyển bằng xe máy rất thuận tiện. Bạn có thể sử dụng Google Maps hoặc hỏi đường từ người dân địa phương để tránh bị lạc.</li><li>Taxi: Bạn cũng có thể sử dụng taxi để đến Nhà thờ Cái Bè</li></ul>', 'Thị trấn Cái Bè, Huyện Cái Bè, Tỉnh Tiền Giang', 10.33798240, 106.03534320, '0', 4, 7, '2025-05-23 14:48:34', '2025-05-23 15:10:03'),
(19, 'Nhà thờ Chánh Toà Mỹ Tho', 'Miễn phí', '<p>Bởi vì được xây trên một nền đất sình nên chiều cao của Nhà thờ Chánh Tòa Mỹ Tho bắt buộc phải hạ thấp xuống để đảm bảo an toàn. Hiện nay, nhà thờ cao 24m, dài 53m và rộng hơn 17m, gồm một gian chính và hai gian phụ ở hai bên. Nhà thờ xây theo kiến trúc Hy Lạp – Roman thời Phục Hưng với phần cột tròn chống đỡ với phần mái vòm được trang trí bằng những họa tiết hoa văn tỉ mẩn, cầu kỳ và công phu.</p><p>Tiếp tục đi vào bên trong, bạn chắc chắn sẽ ngạc nhiên trước không gian thoáng đãng của ngôi thánh đường. Sử dụng tông màu trắng chủ đạo, không gian bên trong Nhà thờ Chánh Tòa Mỹ Tho mang đến cho mọi người cảm giác thoáng đãng, rộng rãi và sang trọng cùng phần sàn được lót hoàn toàn bằng gạch men trơn. Trong khi đó, khu vực trần lại được điểm xuyến với những chùm đèn châu Âu lộng lẫy.</p><p>Phần cửa vòm được điểm tô bằng những họa tiết hoa văn đầy tinh xảo theo lối kiến trúc Hy Lạp – Roman thời Phục Hưng. Càng chiêm ngắm kỹ, bạn sẽ càng phải bất ngờ và cảm thấn trước sự đơn giản nhưng không đánh mất đi vẻ đẹp lộng lẫy, cổ kính của ngôi nhà Chúa.</p><p>Cung thánh của Nhà thờ Chánh Tòa Mỹ Tho sử dụng màu vàng chủ đạo, viền trắng và lợp ngói đỏ. Điều này giúp toát lên vẻ uy nghi, cổ kính, đồng thời thể hiện nét đẹp vững chải, phát triển của giáo xứ sau suốt chặng đường hình thành hơn 100 năm.</p><p>Về phần tháp chuông, hiện nay tháp chuông cũ đã được Cha sở Phaolô Nguyễn Minh Chiếu dời lên tháp cao phía Nam. Sau này, cha Giuse Chúc đã xây dựng lại một tháp chuông khác tách rời khỏi nhà thờ. Đây cũng là tháp chuông hiện nay mà nhà thờ sử dụng để thông báo giờ lễ hoặc những dịp lễ trọng cũng như đổ chuông sầu khi gia đình ai trong giáo xứ có người thân qua đời.</p>', '<p>Thời điểm lý tưởng để ghé thăm Nhà thờ Chánh Toà Mỹ Tho là buổi sáng sớm hoặc chiều mát, khi không quá nóng và không gian nhà thờ vẫn còn yên tĩnh, giúp bạn có thể thưởng thức vẻ đẹp kiến trúc và cảm nhận sự bình yên. Ngoài ra, bạn cũng có thể tham dự lễ tại nhà thờ để trải nghiệm thêm về đời sống tâm linh của giáo dân.&nbsp;</p>', '<p>1. Hủ tiếu Mỹ Tho</p><p>Hủ tiếu Mỹ Tho là đặc sản Tiền Giang ngon trứ danh, nổi tiếng ở khắp nơi. Sợi hủ tiếu được&nbsp;làm từ gạo, sợi trong, khi trụng nước sôi có độ khô dai vừa phải, không bở hoặc mềm. Một tô hủ tiếu thường có xương, thịt bằm, lòng heo hoặc hải sản, chan ngập nước dùng… Các loại rau để ăn kèm như hẹ, xà lách, giá được bày lên trên, rắc thêm một ít hành phi và tiêu để món ăn tròn vị hơn.</p><p>2. Chuối quết dừa</p><p>Chuối quết dừa là món ăn dân dã mà bạn nhất định phải thử khi đến Tiền Giang. Thoạt nhìn, chuối quết dừa&nbsp;trông giống cốm dẹp, nhưng khi nhìn kỹ sẽ thấy có nhiều điểm khác nhau.&nbsp;Nguyên liệu để làm món chuối quết dừa bao gồm chuối sứ xanh, già và dừa nạo. Công đoạn chế biến đơn giản nhưng đòi hòi người làm phải khéo léo và có kinh nghiệm. Ăn kèm với chuối quết dừa còn có các loại rau thơm như lá lốt, rau càng cua, rau húng lủi, rau thơm, bánh tráng… và rắc thêm một ít đậu phộng rang lên món chuối. Và nước chấm chua ngọt là điều không thể thiếu khi thưởng thức món chuối quết dừa này.</p><p>3. Bún gỏi già Mỹ Tho</p><p>Bún gỏi già là một trong những món ăn hấp dẫn của vùng đất Tiền Giang gây ấn tượng với nhiều thực khách, bởi hương vị đặc trưng của tép, me chua và tương xay. Một bát bún gỏi già thường có bún, tôm, tép tươi hoặc sườn non, thịt ba chỉ, giá chần, nước lèo và một số loại rau ăn kèm như rau muống, rau chuối bào và rau hẹ, đặc biệt không thể thiếu nước chấm là mắm cá linh nguyên chất. Nước dùng của bún gỏi già được hầm bằng xương heo, tôm và thịt ba rọi. Khi thưởng thức, bạn sẽ cảm nhận được vị đậm đà của nước lèo, chua thanh của me và béo bùi của đậu phộng, tôm, thịt…</p>', '<p>Nếu như bạn đã từng ấn tượng với một nhà thờ nằm yên bình nơi ngã ba dòng sông Tiền thơ mộng, vậy thì Nhà thờ Chánh Tòa Mỹ Tho lại tọa lạc ở vị thế cũng đắc địa chẳng kém: trên đại lộ Hùng Vương luôn tấp nập khung cảnh người xe qua lại. Chính vì thế nên trong hành trình về với miền Tây sông nước, nếu bạn có ý định tham quan ngôi thánh đường cổ kính này, bạn sẽ có thể lựa chọn xe máy hoặc xe ô tô làm phương tiện di chuyển chính.</p><p>Nếu bạn là người muốn chủ động hơn về mặt thời gian cũng như có thể dừng lại ngắm cảnh, chụp ảnh với cảnh đẹp hai bên đường trong suốt hành trình, xe máy chính là phương tiện phù hợp nhất. Bạn có thể đi theo lộ trình như sau: ngã ba Ấp Bắc – ngã tư Nguyễn Trãi – rẽ trái vào đại lộ Hùng Vương.</p><p>Ở quanh khu vực trung tâm thành phố hiện nay cũng có đa dạng các cửa hàng cho thuê xe máy với mức giá dao động từ 100.000 VNĐ đến 150.000 VNĐ / ngày tùy theo loại xe mà bạn chọn, có thể là xe số hoặc xe ga. Bạn chú ý di chuyển đúng luật giao thông, đội mũ bảo hiểm đầy đủ, chuẩn bị các loại giấy tờ tùy thân cần thiết và không đùa giỡn trong suốt quá</p>', 'Phường 1, Thành phố Mỹ Tho, Tỉnh Tiền Giang', 10.36148850, 106.36497210, '0', 4, 7, '2025-05-23 15:03:15', '2025-05-23 15:09:55'),
(20, 'Làng cổ Đông Hòa Hiệp', 'Miễn phí', '<p>àng cổ Đông Hòa Hiệp Tiền Giang nằm ở khu vực huyện Cái Bè và cách trung tâm thành phố Mỹ Tho khoảng độ đâu đó 40km, không quá xa khu vực quốc lộ 1A. Bởi các nhà cổ tại Đông Hòa Hiệp nằm cách nhau cũng không gần nên nếu muốn tham quan hết thì bạn phải đi bằng xe máy hoặc thuyền du lịch.</p><p>Làng cổ này có diện tích cũng khá rộng với khoảng 7 ngôi nhà cổ, 3 ngôi chùa cổ và cả đình làng lịch sử hơn 100 năm tuổi. Xã Đông Hòa Hiệp có tổng cộng tất cả là 7 ấp với hệ thống kênh rạch thông nhau: kênh 8, kênh Giồng Tre, rạch Bà Giang, rạch Cầu Chùa, rạch Cầu Miếu, rạch Cây Da, sông Phú An, sông Thông Lưu, rạch Bà Hợp, rạch Cây Cam, sông Cái Bè.</p><p>Người dân tại làng cổ sinh sống chủ yếu nhờ vào các vườn cây ăn trái, trong đó có các loại đặc sản trái cây Cái Bè chủ yếu là xoài cát Hòa Lộc, vú sữa Vĩnh Kim, quýt Cái Bè, nhãn. Ngoài ra còn có các hộ dân chuyên làm nghề thủ công truyền thống, chẳng hạn như làm: bánh tráng, bánh cốm hay bánh phồng…</p><p>Làng cổ Đông Hòa Hiệp Tiền Giang có 36 căn nhà niên đại từ 100 – 200 năm nhưng để được công nhận là nhà cổ di sản thì chỉ có 7 căn. Ấn tượng đầu tiên khi đặt chân đến Làng cổ Đông Hòa Hiệp Tiền Giang có lẽ chính là những ngôi nhà mang đậm kiến trúc nhà vườn Nam Bộ, nằm xen lẫn giữa khu vườn cây trái có sông nước hữu tình và không gian mát mẻ. Nhà tại đây không phải được xây theo hướng Nam như miền Trung mà xây theo nguyên tắc “nhất cận thị – nhị cận giang – tam cận lộ” để thuận tiện hơn cho văn hóa và kinh tế miền sông nước.</p>', '<p>Một điểm mà chúng ta nên lưu ý khi đi khám phá Làng cổ Đông Hòa Hiệp Tiền Giang chính là không nên đến vào mùa mưa. Bởi lúc đó chúng ta không thể di chuyển ra thăm vườn được, mà đây lại là điểm đặc sắc chính của làng. Thế nên thời điểm đi khám phá đẹp nhất chính là từ tháng 1 đến tháng 5 khi vào mùa khô hoặc mùa trái cây.</p>', '<p>1. Hủ tiếu Mỹ Tho</p><p>Hủ tiếu Mỹ Tho là đặc sản Tiền Giang ngon trứ danh, nổi tiếng ở khắp nơi. Sợi hủ tiếu được&nbsp;làm từ gạo, sợi trong, khi trụng nước sôi có độ khô dai vừa phải, không bở hoặc mềm. Một tô hủ tiếu thường có xương, thịt bằm, lòng heo hoặc hải sản, chan ngập nước dùng… Các loại rau để ăn kèm như hẹ, xà lách, giá được bày lên trên, rắc thêm một ít hành phi và tiêu để món ăn tròn vị hơn.</p><p>2. Chuối quết dừa</p><p>Chuối quết dừa là món ăn dân dã mà bạn nhất định phải thử khi đến Tiền Giang. Thoạt nhìn, chuối quết dừa&nbsp;trông giống cốm dẹp, nhưng khi nhìn kỹ sẽ thấy có nhiều điểm khác nhau.&nbsp;Nguyên liệu để làm món chuối quết dừa bao gồm chuối sứ xanh, già và dừa nạo. Công đoạn chế biến đơn giản nhưng đòi hòi người làm phải khéo léo và có kinh nghiệm. Ăn kèm với chuối quết dừa còn có các loại rau thơm như lá lốt, rau càng cua, rau húng lủi, rau thơm, bánh tráng… và rắc thêm một ít đậu phộng rang lên món chuối. Và nước chấm chua ngọt là điều không thể thiếu khi thưởng thức món chuối quết dừa này.</p><p>3. Bún gỏi già Mỹ Tho</p><p>Bún gỏi già là một trong những món ăn hấp dẫn của vùng đất Tiền Giang gây ấn tượng với nhiều thực khách, bởi hương vị đặc trưng của tép, me chua và tương xay. Một bát bún gỏi già thường có bún, tôm, tép tươi hoặc sườn non, thịt ba chỉ, giá chần, nước lèo và một số loại rau ăn kèm như rau muống, rau chuối bào và rau hẹ, đặc biệt không thể thiếu nước chấm là mắm cá linh nguyên chất. Nước dùng của bún gỏi già được hầm bằng xương heo, tôm và thịt ba rọi. Khi thưởng thức, bạn sẽ cảm nhận được vị đậm đà của nước lèo, chua thanh của me và béo bùi của đậu phộng, tôm, thịt…</p>', '<p>Bạn có thể đi từ thành phố Mỹ Tho hoặc quốc lộ 1A, sau đó đến các ấp của xã Đông Hòa Hiệp và tham quan các ngôi nhà cổ, chùa, đình làng. Hệ thống kênh rạch ở đây cũng giúp bạn có thể đi bằng thuyền du lịch để khám phá làng cổ.&nbsp;</p><p>Xe máy: Phù hợp để đi tham quan các ngôi nhà cổ, chùa, đình làng và các địa điểm khác nhau trong làng.</p><p>Thuyền du lịch: Giúp bạn khám phá các kênh rạch và cảnh quan xung quanh làng, đặc biệt nếu bạn muốn đi từ kênh này sang kênh khác.&nbsp;</p>', 'Xã Đông Hòa Hiệp, Huyện Cái Bè, Tỉnh Tiền Giang', 10.34652030, 106.00792830, '0', 4, 4, '2025-05-23 15:20:02', '2025-05-23 15:20:34');
INSERT INTO `destinations` (`id`, `name`, `price`, `highlights`, `best_time`, `local_cuisine`, `transportation`, `address`, `latitude`, `longitude`, `status`, `user_id`, `travel_type_id`, `created_at`, `updated_at`) VALUES
(21, 'Đường hoa Sa Đéc', 'Miễn phí', '<p>Không chỉ sở hữu những di tích lịch sử, văn hóa giá trị cùng nghệ thuật ẩm thực độc đáo, Đồng Tháp còn để lại ấn tượng khó phai nhạt cho tín đồ du lịch với làng hoa Sa Đéc. Hình thành từ cuối thế kỷ 19, nép mình bên dòng sông Tiền, nơi đây ban đầu được biết đến với tên gọi là làng hoa Tân Quy Đông - một làng nghề truyền thống hơn trăm năm tuổi.&nbsp;</p><p>Vào lúc bấy giờ, tại khu vực này chỉ có vài hộ dân trồng hoa để trang trí dịp Tết. Dần dần thấy hoa hợp đất, nở đẹp, số hộ trồng hoa tăng lên. Công việc hằng năm trở thành ngành nghề chính tại phường Tân Quy Đông. Làng hoa về sau lan rộng ra các vùng khác như rạch Sa Nhiên, phường An Hòa, xã Tân Khánh Đông, v.v.</p><p>Đến nay, tổng diện tích làng hoa Sa Đéc đã lên đến gầ 1000 ha với khoảng 4.000 hộ trồng hoa kiểng, 190 hộ kinh doanh, 17 hợp tác xã và tổ hợp tác, biến nơi đây thành một trong những vựa hoa lớn nhất vùng Đồng bằng sông Cửu Long và miền Nam.</p><p>Đến đây vào tháng Chạp, bạn sẽ có cơ hội tham gia lễ hội hoa xuân được tổ chức hằng năm tại công viên Sa Đéc. Lễ hội có nhiều chương trình thú vị như hội chợ, trưng bày và triển lãm sinh vật cảnh, liên hoan dân vũ, hội thi áo bà ba, hội thi ẩm thực từ các loài hoa, cuộc thi chọi gà nghệ thuật, biểu diễn đường phố, v.v. Tuy chỉ diễn ra trong một ngày duy nhất tùy theo lịch trình của địa phương nhưng sự kiện này có rất nhiều hoạt động đặc sắc để bạn khám phá về nghề trồng hoa và cả những nét đẹp văn hóa đặc sắc của Sa Đéc.</p>', '<p>Thời điểm lý tưởng để bạn có thể đến tham quan Làng hoa Sa Đéc - Đồng Tháp là vào khoảng từ tháng 12 đến tháng 2 hàng năm, đặc biệt là trước và trong dịp Tết Nguyên Đán. Đây là lúc làng hoa rực rỡ khoe sắc và đẹp nhất với hàng trăm loại hoa nở rộ chuẩn bị cho mùa xuân. Du khách đến vào thời gian này sẽ được chiêm ngưỡng những luống hoa đầy màu sắc trải dài, từ cúc mâm xôi, hoa hồng, đến vạn thọ, tạo nên khung cảnh tươi tắn và rộn ràng hơn bao giờ hết.</p><p>Ngoài ra, khoảng thời gian này cũng có nhiều lễ hội và hoạt động văn hóa đặc sắc, như Lễ hội hoa xuân Sa Đéc thu hút đông đảo du khách tham gia. Không khí trong lành, tiết trời mát mẻ kết hợp với cảnh quan tuyệt đẹp khiến cho chuyến tham quan làng hoa Sa Đéc vào dịp này trở nên vô cùng thú vị và đáng nhớ.</p>', '<p>Hủ tiếu Sa Đéc: Đây là món ăn nổi tiếng nhất của Sa Đéc, với sợi hủ tiếu dai và lạ miệng, nước dùng ngọt thanh và đậm đà.&nbsp;</p><p>Bánh tằm bì: Món bánh này có sợi bánh tằm mềm, xíu mại, bì cắt nhuyễn, rau sống và nước cốt dừa béo ngọt đặc trưng.&nbsp;</p><p>Cơm hạt sen: Cơm hạt sen được nấu với vài hạt sen trên bề mặt, mang hương thơm đặc biệt và có thể ăn kèm với mắm cá linh hoặc cá kho tộ.&nbsp;</p><p>Bánh xèo, bánh khọt, bánh bò, bánh da lợn, ít trần...: Những món bánh làm từ bột gạo Sa Đéc này cũng là những lựa chọn hấp dẫn cho thực khách.&nbsp;</p>', '<p>Di chuyển đến làng hoa Sa Đéc: Ngôi làng nằm cách Sài Gòn khoảng 140km, mất chừng 3 tiếng di chuyển. Các bạn có thể đến đây bằng xe máy hoặc xe khách tùy theo nhu cầu và điều kiện tài chính. Nếu đi xe khách, bạn nên cân nhắc qua một số hãng xe uy tín như xe Phương Trang, Phú Vĩnh Long, Lộc Điền… với giá vé dao động từ 80.000 VNĐ - 105.000 VNĐ/chiều/khách. Bởi vì các chuyến xe Sài Gòn - Sa Đéc xuất bến liên tục nên bạn không cần lo lắng về lịch trình.</p><p>Di chuyển ở Sa Đéc: Các điểm tham quan ở làng hoa Sa Đéc Đồng Tháp khá gần nhau, do đó bạn có thể di chuyển qua lại bằng xe máy hoặc xe đẹp. Trước khi đến, bạn nên chủ động tìm kiếm và liên hệ với chỗ cho thuê xe máy để tránh mất thời gian. Ngoài ra, phần lớn các khách sạn, homestay ở Sa Đéc cũng có dịch vụ cho thuê xe theo ngày với mức giá rất phải chăng, hợp lý.</p>', 'Phường Tân Quy Đông, Thành phố Sa Đéc, Tỉnh Đồng Tháp', 10.32062340, 105.74072810, '0', 4, 6, '2025-05-23 15:34:01', '2025-05-23 15:34:01'),
(22, 'Nhà cổ Huỳnh Thuỷ Lê', '30.000 VND/ người', '<p>Một trong những điểm nhấn nổi bật tạo nên sức hút cho công trình cổ xưa này, đó chính là lối kiến trúc kết hợp Việt, Hoa và phương Tây thú vị. Ngay khi bước vào không gian, bạn sẽ thấy sự xuất hiện của các loại gỗ quý được dùng làm khung sườn nhà, cột trụ và kết hợp đường nét hoa văn truyền thống. Nhờ đó, tạo nên tổng quan thu hút và ấn tượng cho bất kỳ ai khi ghé thăm.</p><p>Với tổng diện tích 258m2, tường giàu 30 - 40cm, tạo nên tổng quan thoáng mát và sự vững chắc cho công trình sau rất nhiều năm xây dựng. Nhà cổ Huỳnh Thủy Lê còn có phần khung cửa sổ, mặt tiền và trần nhà được trang trí phù điêu phong cách La Mã, Phục Hưng. Tất cả tạo nên vẻ đẹp huyền bí, ấn tượng cho tổng quan công trình.</p><p>Tuy nhiên, phần kiến trúc 3 gian đặc trưng của Nam Bộ Việt Nam vẫn được giữ nguyên, cùng mái ngói đỏ cong truyền thống. Cùng với đó, bên trong không gian của công trình cũng được sơn son thếp vàng đặc trưng của người Hoa. Tường của công trình được sử dụng tông màu vàng sáng, kết hợp những chi tiết gỗ nâu đen lâu đời, tạo nên điểm nhấn cổ xưa, trang trọng cho một công trình có hơn 125 năm tuổi.</p><p>Đặc biệt, giữa gian nhà bạn có thể thấy bàn thờ Quan Công được đặt chính giữa uy nghiêm, thể hiện cho quyền lực và sự phồn vinh của một gia tộc lớn. Đối với phần sàn nhà được thiết kế trũng xuống, dựa theo quan niệm lâu đời tiền bạc sẽ chảy vào nhà và không bị thất thoát về sau.</p>', '<p>Nhà cổ Huỳnh Thủy Lê thường đông khách vào các dịp lễ, Tết, cuối tuần. Vì thế bạn nên đến tham quan vào các ngày thường trong tuần để có không gian thoải mái hơn.</p>', '<p>Hủ tiếu Sa Đéc: Đây là món ăn nổi tiếng nhất của Sa Đéc, với sợi hủ tiếu dai và lạ miệng, nước dùng ngọt thanh và đậm đà.&nbsp;</p><p>Bánh tằm bì: Món bánh này có sợi bánh tằm mềm, xíu mại, bì cắt nhuyễn, rau sống và nước cốt dừa béo ngọt đặc trưng.&nbsp;</p><p>Cơm hạt sen: Cơm hạt sen được nấu với vài hạt sen trên bề mặt, mang hương thơm đặc biệt và có thể ăn kèm với mắm cá linh hoặc cá kho tộ.&nbsp;</p><p>Bánh xèo, bánh khọt, bánh bò, bánh da lợn, ít trần...: Những món bánh làm từ bột gạo Sa Đéc này cũng là những lựa chọn hấp dẫn cho thực khách.&nbsp;</p>', '<p>Để đi từ thành phố Hồ Chí Minh đến Sa Đéc, du khách có thể chọn một trong hai tuyến đường sau:</p><p>Tuyến đường thứ nhất: Từ trung tâm thành phố, đi về hướng Bình Chánh và tiếp tục đi đến cầu vượt nút giao thông Bình Thuận. Tại đây, quẹo phải vào quốc lộ 1A và tiếp tục đi thẳng qua các tỉnh Long An, Tiền Giang, Vĩnh Long. Tại nút giao thông gần cầu Mỹ Thuận, quẹo phải và tiếp tục đi thêm khoảng 16km là đến thị xã Sa Đéc, tỉnh Đồng Tháp.</p><p>Tuyến đường thứ hai (chỉ dành riêng cho xe ô tô): Cũng từ hướng Bình Chánh, tại nút giao thông Bình Thuận, du khách tiếp tục đi thẳng vào cao tốc Sài Gòn - Trung Lương. Sau đó, đi thẳng khoảng 50km rồi quẹo phải vào quốc lộ 1A. Từ đây, tiếp tục đi như hướng dẫn trên.</p><p>Khi đến được thị xã Sa Đéc, du khách đi vào đường Nguyễn Huệ và đến số nhà 255A, đó chính là vị trí của nhà cổ Huỳnh Thủy Lê.</p><p>Nếu du khách ở khu vực miền Bắc, hoặc miền Trung thì có thể lựa chọn di chuyển đến thành phố Hồ Chí Minh bằng máy bay. Sau khi hạ cánh tại sân bay Tân Sơn Nhất, du khách chỉ cần đón xe để đến địa phận Đồng Tháp nếu như không muốn thuê xe tự đi.</p>', 'Phường 2, Thành phố Sa Đéc, Tỉnh Đồng Tháp', 10.29391760, 105.76829780, '0', 4, 4, '2025-05-23 15:39:43', '2025-05-23 15:39:57'),
(23, 'Phước Kiển Tự', 'Miễn phí', '<p>Chùa Phước Kiển nằm ở xã Hòa Tân, huyện Châu Thành, tỉnh Đồng Tháp, được thành lập trước thời vua Thiệu Trị. Theo sư trụ trì Thích Huệ Từ thì trước đây ngôi chùa rất lớn, uy nghiêm, sở hữu không gian khoáng đãng, thanh tịnh, mát mẻ, Phước Kiển Tự còn từng là cơ sở hoạt động cách mạng. Tuy nhiên không may là vào năm 1966, bom đạn chiến tranh đã làm sập hoàn toàn ngôi chùa. Sau năm 1975, chùa được xây lại với kiến trúc đơn giản không cầu kỳ bao gồm: cổng vào, tháp thờ Phật Quan Âm và chính điện.</p><p>Những hố bom được các sư thầy trong chùa dùng làm hồ sen. Vừa khỏa lấp được vết tích của chiến tranh vừa có chỗ để khách du lịch tham quan. Trong ao sen có một loài sen kỳ lạ và hiếm thấy không chỉ ở Việt Nam mà ở cả các nước Đông Nam Á.</p><p>Ao sen ở chùa Phước Kiển có hình vuông tượng trưng cho đất, lá sen có hình tròn tượng trưng cho trời. Lá sen khổng lồ, to như những cái nia, vành cong gần cả tấc tay, nom rất đẹp mắt. Nếu không tận mắt nhìn thấy, chắc chắn bạn sẽ hồ nghi rằng, đây chỉ là lá sen làm bằng nhựa hoặc bên dưới lá có sắt thép chống đỡ.</p><p>Được biết, loài sen này xuất hiện trong ao của nhà chùa từ năm 1992 và tồn tại cho đến bây giờ. Không ai biết tên gọi chính xác của chúng nên người ta thường gọi bằng nhiều tên khác nhau. Có người gọi là sen vua, có khi gọi là súng nia, cây nong tầm,…chính vì có loài sen lạ nên người dân&nbsp;thường gọi chùa bằng cái tên dân dã “Chùa Sen Vua” hay “Chùa Lá Sen”…,</p><p>Tìm hiểu thì loại sen này có nguồn gốc từ vùng Amazon, tên khoa học là Victoria regia. Sen lá to, dày và có nhiều gai. Chính đặc điểm này giúp cho cây thích ứng với môi trường sống, tránh sự tấn công của các loài động vật dưới nước.</p><p>Lá sen vua đặc biệt ở một điểm là có thể co rút theo mùa. Vào mùa khô lá chỉ tầm khoảng 1 mét nhưng vào mùa nước nổi lá to với đường kính từ 3 đến 4 mét. Phần mép lá cao hơn mặt nước khoảng từ 3 đến 5cm, hình dáng của chúng tựa như chiếc nón quai của những cô gái làng quan họ. Vào mùa con nước nhảy bờ, lá sen to có thể dễ dàng chứa được một người trọng lượng 70 – 80 cân mà chỉ làm chao nhẹ mặt nước. Còn vào mùa khô, lá sen chỉ to khoảng 1 – 1,5m.</p>', '<p>Thông thường, bạn nên du lịch các tỉnh miền Tây nói chung và Phước Kiển Tự nói riêng vào khoảng mùa nắng. Đặc biệt, lựa chọn tham quan vào tháng 11 đến tháng 4 năm sau là rất hợp lý. Đây là lúc ít mua bão, trời nắng nhẹ không quá chói chang. Rất thích hợp cho các buổi du lịch tham quan, chụp ảnh check-in đẹp mê hồn.</p><p>Còn nếu bạn muốn ngắm sen nở thì nên đến vào khoảng tháng 9 – 10, đặc biệt là khoảng 10 sáng. Vào lúc này, sen trong hồ sẽ nở rộ tạo nên một cảnh sắc thơ mộng khó tả. Không những thế, đây cũng là mùa nước nổi tại miền Tây nên bạn có thể thưởng thức thêm những món ăn đặc sản tại Đồng Tháp.</p>', '<p>Hủ tiếu Sa Đéc: Tuy không nổi đình đám như hủ tiếu Nam Vang hay hủ tiếu Mỹ Tho nhưng hủ tiếu Sa Đéc lại để lại dư vị đậm đà cho những ai đã từng thưởng thức. Sợi hủ tiếu dai, nước lèo ngọt thanh, mùi thơm hòa quyện từ thịt, tôm, hẹ, hành, chanh, ớt,... chắc chắn sẽ tạo ra một món mỹ vị khiến thực khách phải “nhớ mãi không quên”.</p><p>Lẩu cá linh bông điên điển: Vào những ngày nước nổi, ngồi quây quần bên nồi lẩu cá linh là cảnh tượng ấm cúng trong ký ức tuổi thơ của biết bao người con Sa Đéc. Lẩu có vị ngọt thanh, thơm thoang thoảng mùi hương đồng nội của miền sông nước, quyện với thịt cá linh đầu mùa béo ngậy, điểm thêm nắm bông điên điển vàng rực. Tất cả tạo nên một hương vị đặc trưng, hương vị của miền Tây những ngày con nước lớn đổ về.<br>Bông súng mắm kho:</p><p><i>“Muốn ăn bông súng mắm kho</i><br><i>Thì vô Đồng Tháp ăn cho đã thèm…”</i></p><p>Có thể nói, là xứ sở của sen, của súng, các món ăn đặc trưng của Đồng Tháp không thể thiếu những nguyên liệu đơn sơ mà ngon miệng này. Đến Đồng Tháp mà không thử một lần ăn bông súng mắm kho là thiếu sót lớn. Vị giòn sần sật của bông súng, vị thịt ba rọi béo ngậy, cùng vị ngọt của tép đồng được hòa lại với nhau bởi một gia vị không thể thiếu - mắm miền Tây. Món ăn dân dã mà bình dị ấy hội đủ hương vị của hương đồng cỏ nội vùng Đồng Tháp, đủ đậm đà để “gây thương nhớ”, có thể làm xiêu lòng bất cứ vị khách khó tính nào.</p>', '<p>Nếu muốn tham quan “lá sen khổng lồ” thì bạn có thể lựa chọn một trong những cách sau:</p><p>Phượt Đồng Tháp bằng xe máy: Đối với các bạn trẻ ở Đồng Tháp hoặc các tỉnh thành lân cận có thể thử đi bằng xe máy. Đây là một các tốt nhất giúp bạn tiết kiệm chi phí và tự do tham quan các địa điểm du lịch gần đó.</p><p>Thuê xe du lịch Đồng Tháp: Nhóm bạn đông người hoặc gia đình có thể thuê xe trong ngày để du lịch đất sen hồng mỗi cuối tuần thư giãn. Bạn sẽ không phải quá quan ngại khi phải đi dưới bất kỳ thời tiết nào. Và tất nhiên, nếu gia đình có cụ già hoặc con nhỏ sẽ rất thuận tiện.</p>', 'Xã Hòa Tân, Huyện Châu Thành, Tỉnh Đồng Tháp', 10.19570280, 105.81633360, '0', 4, 7, '2025-05-23 16:03:30', '2025-05-23 16:03:30'),
(24, 'Đồng sen Tháp Mười', 'Ngày thường 20,000 VND/ người. Cuối tuần là 30,000 VND/ người.', '<p>Đồng sen Tháp Mười, cách thành phố Cao Lãnh chừng &nbsp;35 km, cách TP HCM khoảng 150 km. Đường đến nơi đây cũng rất thuận tiện, không có nhiều phương tiện đông đúc thường thấy ở các khu du lịch. Nếu đi từ tp HCM đến đây bạn có thể theo hướng&nbsp; về thị trấn An Mỹ, qua cầu Mỹ An rẽ trái là đến.</p><p>Với diện tích gần 20ha, không có xe cộ đông đúc, khói bụi, không có sự chen lấn, ồn ào thường thấy tại các địa điểm du lịch, đồng sen Tháp Mười yên bình, gần gũi đến lạ kỳ! Với diện tích rộng lớn nên khi đến đồng sen Tháp Mười du khách sẽ có được những khoảng không gian riêng tư mà không phải chen lấn hay tranh giành để có thể ngắm sen.&nbsp;Những cánh đồng sen xanh mát xen lẫn những đóa sen hồng lay nhẹ theo cơn gió làm say lòng du khách.</p><p>Đồng Tháp mùa nào cũng đẹp, không khí trong lành. Tuy nhiên, Đồng Sen Tháp Mười đẹp nhất vào mùa hè, khi sen nở rộ, bông này chen lấy bông kia vươn lên đón nắng. Sen Đồng Tháp Mười bắt đầu nở buổi sáng. Hoa sen lúc đầu có sắc trắng, đến giữa trưa thì chuyển sang hồng. Đến khoảng 15 giờ chiều, sen chuyển màu hồng đậm, rồi chuyển sang đỏ khi mặt trời lặn. Qua ngày sau, sen tiếp tục nở và chuyển màu theo chu kỳ như vậy trong 3 ngày rồi chuyển sang màu tím thẫm và tàn. Cứ hoa này tàn thì hoa khác lại mọc lên và đua nhau nở rộ, điều này chỉ sen Tháp Mười mới có.</p><p>Du khách cũng có thể dạo cảnh ngắm sen, hít thở mùi hương của sen hồng… hay có thể hóa thân thành những cô thôn nữ, những chàng trai miệt vườn khi về với đồng sen, khu du lịch còn có dịch vụ cho thuê trang phục áo bà ba, áo dài… lưu lại những khoảnh khắc đẹp bên cánh sen cùng bạn bè, người thân. Đây cũng là địa điểm lý tưởng cho những cặp đôi lựa chọn chụp ảnh cưới.</p><p>Khách đến thăm có thể đi xuồng di chuyển sâu vào bên trong, vừa ngắm cảnh đồng quê, vừa cảm nhận sự gần gũi, yên bình từ thiên nhiên. Hít căng lồng ngực không khí trong lành, mát mẻ của buổi sớm, khẽ chạm vào từng chiếc lá, từng bông hoa, đưa tay khoát nhẹ dòng nước mát lành. Chiếc xuồng trôi chầm chậm đưa bạn vào trong, vừa đi bạn vừa có thể&nbsp; ngắm phong cảnh cảnh hai bên ven sông và trải nghiệm một ngày làm nông dân “thứ thiệt” khi tự mình chống xuồng hái sen, câu cá.</p>', '<p>Thời điểm lý tưởng để bạn có thể lên kế hoạch đến tham quan là từ tháng 5 đến tháng 11 hằng năm, khi sen bước vào mùa nở rộ và đẹp nhất. Trong giai đoạn này, cánh đồng sen rực rỡ với sắc hồng xen lẫn xanh tươi của lá, tạo nên khung cảnh thơ mộng và thu hút nhiều du khách đến check in. Buổi sáng sớm hoặc chiều mát là lúc thích hợp nhất để du khách có thể chiêm ngưỡng vẻ đẹp thanh bình của đầm sen, khi sen tỏa hương thơm nhẹ nhàng và ánh nắng cũng không quá gay gắt. Nếu muốn chụp ảnh và ngắm cảnh, bạn nên ghé đến khu du lịch Đồng Sen Tháp Mười vào sáng sớm khi hoa sen vừa nở và không khí mát mẻ. Đây cũng là thời điểm lý tưởng để bạn trải nghiệm các hoạt động thú vị như chèo xuồng, chụp ảnh áo dài bên sen và thưởng thức các món ăn dân dã từ sen.</p>', '<p>Cá lóc nướng trui: Đây là một món ăn nổi tiếng, cá lóc được nướng trực tiếp trên lửa, giữ nguyên vị ngọt và thơm ngon. Món này thường sẽ được ăn kèm với rau sống và nước chấm đặc biệt.</p><p>Gỏi ngó sen: Một món ăn hấp dẫn, kết hợp ngó sen giòn với tôm, thịt gà hoặc thịt heo, cùng với các loại gia vị và rau thơm, tạo nên hương vị thanh mát và đậm đà hấp dẫn.</p><p>Chè hạt sen: Đây là một món tráng miệng ngọt mát nổi tiếng của xứ sen hồng. Chè hạt sen thường được nấu với đường phèn, hạt sen mềm và thơm, rất thích hợp để làm dịu cơn khát trong những ngày nắng nóng.</p><p>Cơm gói lá sen: Cơm được gói trong lá sen, giúp cơm có hương vị đặc biệt và thơm ngon vô cùng. Món này thường sẽ được ăn kèm với các món mặn như thịt kho hoặc cá kho.</p><p>Bánh xèo: Món bánh xèo miền Tây nổi tiếng giòn rụm, nhân đầy đặn với thịt, tôm và giá đỗ, thường được ăn kèm với rau sống và nước mắm chua ngọt.</p>', '<p>Cách trung tâm TP. Hồ Chí Minh khoảng 150km, khu du lịch sinh thái Đồng Sen Tháp Mười là điểm đến hấp dẫn được nhiều du khách ghé thăm. bạn có thể di chuyển đến đây bằng nhiều phương tiện như xe máy, xe khách, taxi,… Nhưng các phương tiện di chuyển cá nhân được khuyến khích hơn để mang đến nhiều trải nghiệm thú vị cho chuyến hành trình.</p>', 'Xã Mỹ Hòa, Huyện Tháp Mười, Tỉnh Đồng Tháp', 10.60441730, 105.82106850, '0', 4, 6, '2025-05-23 16:09:26', '2025-05-23 16:09:26'),
(25, 'Vườn quốc gia Tràm Chim', 'Có rất nhiều hoạt động khác nhau nên giá dao động từ 20.000VNĐ đến 500.000VNĐ', '<p>Được xây dựng với diện tích lên đến hơn 7500ha, Tràm Chim phân chia hệ sinh thái thảm thực vật hơn 130 loài khác nhau ra thành từng quần xã đặc trưng, phân bố xen kẽ với nhau như quần xã sen, đầm lầy, rừng tràm, lúa trời, mồm mốc...</p><p>Bên cạnh đó, hệ sinh thái động vật tại đây cũng nhiều không đếm xuể, đa phần đều là những loài động vật quý hiếm, có tên trong sách đỏ Việt Nam. Trong đó không thể bỏ qua hệ chim nước với hơn 233 loại, thuộc 49 họ và 25 chi. Một số loài động vật quý hiếm có thể kể đến như công đất, giang sen, bồ nông chân xám, choi choi lưng đen, ngan cánh trắng... Loài sếu đầu đỏ thuộc họ Hạc chiếm số lượng lớn nhất và cũng chính là món quà thiên nhiên quý giá nhất tại Vườn quốc gia Tràm Chim.</p><p>Chèo xuồng len lỏi qua cánh rừng Tràm Chim, cảm nhận sự mát mẻ của bầu không khí trong lành, ngắm nhìn ánh nắng khẽ xuyên qua tán lá cây tràm rũ xuống mặt nước... Tất tần tật mọi cảnh vật như cùng nhau vẽ nên bức tranh thiên nhiên say đắm lòng người. Thỉnh thoảng, một vài chú chim cò sẽ bay ngang qua cánh rừng, cất lên những tiếng kêu vang khắp cả một vùng trời.</p><p>Khung cảnh hai bên cánh rừng cứ thế thay đổi liên tục khi con thuyền xuôi dần theo dòng nước. Có khi là những rạch nước, có khi lại là rừng tràm mọc san sát nhau, có khi xuất hiện các đồng sen lênh đênh trên mặt nước. Thuyền xuôi dòng đến đâu, bạn sẽ càng được ngắm nhìn nhiều hơn và thả hồn mình vào thiên nhiên.</p><p>Loài chim quý hiếm có tên trong sách đỏ Việt Nam cũng như sách đỏ IUCN thế giới, sếu đầu đỏ như một món quà vô giá mà thiên nhiên đã ban tặng cho Vườn quốc gia Tràm Chim. Loài chim này hiện đang sinh sống nhiều ở Campuchia và thỉnh thoảng có bay về vườn quốc gia vào mùa khô, tuy nhiên tần suất khá hiếm. Chính vì vậy, mọi người thường rủ nhau đổ xô đến Vườn quốc gia Tràm Chim vào mùa khô để \"săn\" được những bức ảnh quý giá cùng loài sếu đầu đỏ.</p>', '<p>1. Mùa nước nổi</p><p>Thời điểm lý tưởng nhất để bạn tới tham quan Vườn quốc gia Tràm Chim cũng như miền Tây sông nước là vào mùa nước nổi, tầm khoảng tháng 9 đến tháng 12. Đây là lúc hoa sen, hoa súng bừng nở và cũng vào thời điểm sinh sản của những loài chim. Bên cạnh đó, mùa nước nổi cũng thích hợp để bạn trải nghiệm nhiều hoạt động thú vị trên sông nước như chèo xuồng, câu cá, học làm ngư dân giăng lưới, đặt lợp…</p><p>2. Mùa hoa hoàng đầu ấn</p><p>Từ tháng 12 đến tháng 2 năm sau, Đồng Tháp Mười đón chào mùa hoa hoàng đầu ấn, trải dài khắp các cánh đồng tựa như một thảm hoa vàng rực rỡ. Đến với Vườn quốc gia Tràm Chim vào thời điểm này, bạn sẽ có cơ hội được ngắm nhìn những đồng hoa hoàng đầu ấn đẹp mê mẩn. Dù là đi bộ hay xuôi dòng trên tắc ráng, bạn vẫn có thể cảm nhận hết trọn vẹn vẻ đẹp của loài hoa này.</p><p>3. Mùa hoa nhĩ cán</p><p>Hoa nhĩ cán (hay hoa rong ly tím) sẽ bắt đầu nở rộ vào tháng Giêng và khoe sắc rực rỡ từ 30 - 40 ngày. Loại hoa này rất quý hiếm, thường sinh sống ở nơi ẩm thấp, ẩn trong quần xã sen, súng và ngập nước phèn chua. Màu hoa dịu dàng, nhẹ nhàng giúp tô phần cho cảnh đẹp nơi đây. Chính vì thế, khi mùa hoa này nở rộ cũng là lúc bạn nên lên đường khám phá Vườn quốc gia Tràm Chim.</p><p>4. Mùa khô có sếu đầu đỏ</p><p>Bên cạnh mùa nước nổi đặc trưng và các mùa hoa rực rỡ, bạn cũng có thể tới khám phá Vườn quốc gia Tràm chim từ tháng 1 đến tháng 6 trong năm. Đây là lúc miền Tây vào mùa khô, ít mưa, nhiều nắng nên cực kỳ lý tưởng để tham gia các hoạt động trên vùng sông nước. Không chỉ vậy, đến đây vào mùa khô, bạn còn có cơ hội ngắm nhìn đàn sếu đầu đỏ quý hiếm đi kiếm ăn. Đặc biệt là vào tháng 2 đến tháng 5, lượng sếu đầu đỏ xuất hiện ngày càng đông hơn nên bạn có thể ngắm nhìn chúng thật dễ dàng.</p>', '<p>Sau một ngày dài tham quan, cùng quây quần với bạn bè, gia đình trên những gian nhà lá hoặc bè nổi để thưởng thức đặc sản Đồng Tháp thì còn gì bằng? Tại Vườn quốc gia Tràm Chim có hệ thống các nhà hàng trên sông để mọi người có thể thưởng thức ẩm thực miền Tây sông nước giữa khung cảnh thiên nhiên thơ mộng, trữ tình. Tại đây chuyên phục vụ thực đơn với vô vàn món ăn đậm hương vị đồng quê như cá lóc nướng trui, lẩu cua đồng, khô cá trèn, lươn um sả, lẩu cá linh bông điên điển... Nếu đến đây đúng vào mùa sen nở, nhà hàng sẽ đặc biệt chế biến thêm nhiều món ăn làm từ sen như gỏi ngó sen, củ sen nấu sườn, cháo gà hạt sen...</p>', '<p>Vườn quốc gia Tràm Chim nằm cách Thành phố Hồ Chí Minh 140km và Thành phố Cần Thơ chừng 120km. Để di chuyển tới đây, bạn có thể lựa chọn đi bằng xe khách nếu không biết đường xá và muốn chuyến đi an toàn hơn. Bạn sẽ mất khoảng 3 tiếng đồng hồ để tới nơi. Ngoài ra, xe máy cũng là lựa chọn hoàn hảo với những ai thích đi phượt. Đi xe máy sẽ tiết kiệm và chủ động thời gian hơn rất nhiều.</p>', 'Xã Phú Hiệp, Huyện Tam Nông, Tỉnh Đồng Tháp', 24.00000000, -98.75000000, '0', 4, 6, '2025-05-23 16:14:45', '2025-05-23 17:34:17'),
(26, 'Chợ nổi Trà Ôn', 'Miễn phí', '<p>Chợ nổi Trà Ôn hoạt động cả ngày nhưng đông vui nhất là từ 5:00 - 6:00 sáng. Nếu muốn khám phá và check-in tại chợ nổi Trà Ôn thì bạn nên dậy thật sớm và thuê thuyền để đi đến chợ lúc trời còn chưa sáng. Hầu hết bến thuyền ở huyện Trà Ôn đều cho thuê thuyền đi tham quan chợ nổi. Sau khi đã thuê được thuyền, bạn chỉ cần xuôi theo dòng sông Hậu để tới chợ nổi Trà Ôn. Khi thuyền vừa đến gần khu chợ, bạn chắc chắn sẽ bị không khí sôi nổi và náo nhiệt ở đây làm cho mê mẩn.&nbsp;</p><p>Mỗi ngày, chợ nổi Trà Ôn đều quy tụ hơn 100 thuyền bè từ các tỉnh miền Tây đến đây buôn bán. Trong làn sương mờ ảo bên bờ sông Hậu khi mặt trời chưa ló dạng, nhiều thuyền bè chở đầy các loại hàng hóa đã tập trung lại gần vàm Trà Ôn để bắt đầu giao thương. Những chiếc thuyền trên khu chợ nổi đều mang trên mình đầy ắp rau củ, trái cây, nông sản, hàng tiêu dùng… Thuyền sẽ di chuyển qua lại xung quanh khu chợ nổi để tìm những chiếc thuyền khác có loại hàng hóa mà mình muốn trao đổi. Tất cả những hoạt động buôn bán đều diễn ra trên sông nên mới có cái tên chợ nổi.</p><p>Chợ nổi Trà Ôn hoạt động cả ngày nhưng đông vui nhất là từ 5:00 - 6:00 sáng. Nếu muốn khám phá và check-in tại chợ nổi Trà Ôn thì bạn nên dậy thật sớm và thuê thuyền để đi đến chợ lúc trời còn chưa sáng. Hầu hết bến thuyền ở huyện Trà Ôn đều cho thuê thuyền đi tham quan chợ nổi. Sau khi đã thuê được thuyền, bạn chỉ cần xuôi theo dòng sông Hậu để tới chợ nổi Trà Ôn. Khi thuyền vừa đến gần khu chợ, bạn chắc chắn sẽ bị không khí sôi nổi và náo nhiệt ở đây làm cho mê mẩn.&nbsp;</p><p>Mỗi ngày, chợ nổi Trà Ôn đều quy tụ hơn 100 thuyền bè từ các tỉnh miền Tây đến đây buôn bán. Trong làn sương mờ ảo bên bờ sông Hậu khi mặt trời chưa ló dạng, nhiều thuyền bè chở đầy các loại hàng hóa đã tập trung lại gần vàm Trà Ôn để bắt đầu giao thương. Những chiếc thuyền trên khu chợ nổi đều mang trên mình đầy ắp rau củ, trái cây, nông sản, hàng tiêu dùng… Thuyền sẽ di chuyển qua lại xung quanh khu chợ nổi để tìm những chiếc thuyền khác có loại hàng hóa mà mình muốn trao đổi. Tất cả những hoạt động buôn bán đều diễn ra trên sông nên mới có cái tên chợ nổi.</p>', '<p>Cũng giống như hầu hết những khu chợ nổi khác tại miền Tây, chợ nổi Trà Ôn thường bắt đầu họp từ lúc sáng sớm. Khi nhiều người vẫn còn đang chìm vào giấc ngủ thì trên chợ nổi Trà Ôn đã có rất nhiều thuyền bè qua lại để giao thương hàng hóa. Thuyền bè đến từ khắp các tỉnh miền Tây Nam Bộ đều quy tụ lại khu chợ nổi này để buôn bán và trao đổi các mặt hàng từ sáng sớm cho đến tận chiều tối mới tan hẳn. Chính vì vậy nên bạn có thể ghé đến tham quan chợ nổi Trà Ôn vào bất kỳ thời điểm nào trong ngày. Tuy nhiên, theo những bạn đã từng ghé thăm chợ nổi Trà Ôn thì thời gian lý tưởng nhất để tham quan nơi này là vào sáng sớm tinh mơ, khoảng từ 5:00 - 6:00. Bởi vì đây là lúc khu chợ đông vui và tấp nập nhất cũng như có rất nhiều mặt hàng phong phú được bày bán để thỏa sức khám phá.&nbsp;</p>', '<p>Đến tham quan chợ nổi Trà Ôn, du khách sẽ có cơ hội thưởng thức những món ăn đặc sắc của vùng sông nước miền Tây. Mỗi góc chợ là một thế giới ẩm thực phong phú, từ bánh mì nướng, bánh xèo cho đến các món lẩu cá, lẩu mực tươi ngon. Đặc biệt, hương vị đặc trưng của các món như cơm lam, cá lóc nướng trui hay gỏi cá đuối khiến du khách không thể quên. Những món ăn đều được chế biến từ nguyên liệu tươi ngon, đảm bảo vệ sinh an toàn thực phẩm. Việc thưởng thức ẩm thực tại chợ nổi Trà Ôn sẽ là một trải nghiệm thú vị để du khách có thể khám phá văn hóa ẩm thực miền Tây độc đáo.</p>', '<p>- Xe máy: Đây là gợi ý lý tưởng dành cho những ai ở Thành phố Hồ Chí Minh và yêu thích các chuyến đi phượt miền Tây. Bạn hoàn toàn có thể di chuyển bằng xe máy từ Thành phố Hồ Chí Minh đến chợ nổi Trà Ôn và về trong ngày với thời gian chỉ tầm 4 tiếng đồng hồ. Sau khi tới trung tâm thành phố Vĩnh Long, bạn tiếp tục di chuyển theo đường Quốc lộ 1A đến thị xã Bình Minh. Tại đây, bạn rẽ vào Quốc lộ 54 và đi thêm khoảng 10km là đến được chợ nổi Trà Ôn.</p><p>- Xe khách: Hiện nay có khá nhiều nhà xe cho bạn tự do lựa chọn. Một số hãng xe khách uy tín có thể kể đến là Mai Linh, Trung Kiên, Phú Vĩnh Long… Giá vé xe khách thường dao động trong khoảng 100.000 VND -&nbsp; 120.000 VND/lượt.</p><p>- Máy bay: Nếu bạn xuất phát từ các tỉnh miền Bắc hoặc miền Trung thì có thể mua vé máy bay để di chuyển tới Thành phố Hồ Chí Minh. Sau đó, bạn bắt xe khách hoặc thuê xe máy để tiếp tục di chuyển đến chợ nổi Trà Ôn.&nbsp;</p>', 'Xã Lục Sỹ Thành, Huyện Trà Ôn, Tỉnh Vĩnh Long', 9.96019490, 105.91592390, '0', 4, 4, '2025-05-23 16:20:51', '2025-05-23 16:20:51'),
(27, 'Lò gạch Mang Thít', 'Miễn phí', '<p>Lò gạch Mang Thít Vĩnh Long được mọi người nhớ đến với hình ảnh từng mái lò đỏ hồng, những hàng gạch nhuốm màu thời gian giữa dòng sông Cổ Chiên hàng trăm năm qua. Từ những viên gạch đỏ với đầy đủ sắc thái khác nhau, dưới bàn tay điêu luyện của nghệ nhân làng Mang Thít, nhiều tác phẩm kiệt tác được ra đời.&nbsp;</p><p>Cùng với dòng sông Cổ Chiên, lò gạch cũ ám khói lặng lẽ vượt qua bao thăng trầm, nên ai đến đây cũng đều cảm nhận được nét đẹp vượt thời gian của chính nó. Lò gạch Mang Thít Vĩnh Long mang một vẻ đẹp cổ kính và độc đáo. Hình ảnh những viên gạch im lìm nằm giữa khung cảnh hiền hòa, bình yên tại các lò nung, khiến khung cảnh nơi đây càng trở nên cuốn hút, thanh bình hơn bao giờ hết. Vào những buổi chiều tà, khung cảnh lò gạch Mang Thít Vĩnh Long càng trở nên lung linh và ấn tượng.</p><p>Lò gạch Mang Thít Vĩnh Long là nơi vẫn còn lưu giữ nhiều mỏ sét nguyên sinh cổ xưa có giá trị. Tất cả các mỏ sét nguyên sinh đều nằm bên trong những ngôi làng làm nghề gạch gốm đỏ truyền thống dọc theo hai bên bờ. Đây là nguyên liệu quan trọng nhất để làm thành các sản phẩm trang trí, hoặc trong xây dựng như gạch đỏ, nung, đồ gốm… Từ những bàn tay nhiều kinh nghiệm của người thợ thủ công, hàng nghìn tác phẩm có giá trị được ra đời mang đến cho con người nhiều công dụng hữu ích.</p>', '<p>Thời điểm lý tưởng để khám phá lò gạch Măng Thít là vào <strong>buổi sớm, khoảng 5 giờ sáng</strong>. Khi đó, du khách có thể chiêm ngưỡng bình minh dần ló dạng bên dòng sông Cổ Chiên, tận hưởng cảnh sắc tuyệt đẹp, đồng thời quan sát nhịp sống và những hoạt động của lò gạch lúc còn ít khách du lịch.</p>', '<p>Đến tham quan chợ nổi Trà Ôn, du khách sẽ có cơ hội thưởng thức những món ăn đặc sắc của vùng sông nước miền Tây. Mỗi góc chợ là một thế giới ẩm thực phong phú, từ bánh mì nướng, bánh xèo cho đến các món lẩu cá, lẩu mực tươi ngon. Đặc biệt, hương vị đặc trưng của các món như cơm lam, cá lóc nướng trui hay gỏi cá đuối khiến du khách không thể quên. Những món ăn đều được chế biến từ nguyên liệu tươi ngon, đảm bảo vệ sinh an toàn thực phẩm. Việc thưởng thức ẩm thực tại chợ nổi Trà Ôn sẽ là một trải nghiệm thú vị để du khách có thể khám phá văn hóa ẩm thực miền Tây độc đáo.</p>', '<p>Để đến được Vĩnh Long, một số bạn ở các tỉnh thành xa sẽ đặt vé máy bay để di chuyển. Tuy nhiên, Vĩnh Long là tỉnh thành chưa xây dựng sân bay nên mọi người sẽ phải đáp xuống Thành phố Hồ Chí Minh. Sau đó, các bạn sẽ di chuyển bằng xe khách hoặc taxi để đến Vĩnh Long. Đây là một bất lợi đối với các bạn ở xa mong muốn khám phá làng gạch truyền thống Mang Thít.</p><p>Xe máy và xe khách là hai phương tiện thuận tiện, phù hợp nhất đối với các bạn trẻ xuất phát từ Sài Gòn. Quãng đường Vĩnh Long - TP HCM khoảng 100km nên thường phải mất khoảng 2 giờ đồng hồ để di chuyển bằng xe khách. Giá vé xe khách dao động từ 120.000 VNĐ - 150.000 VNĐ. Một số hãng xe khách bạn có thể tham khảo như: Phương Trang, Thanh Nhàn, Trung Kiên, Mai Linh...</p><p>Nếu một số bạn đi xe máy khởi hành từ Sài Gòn có thể tham khảo lộ trình sau đây để có cơ hội check-in lò gạch miền Tây một cách trọn vẹn nhất.Từ cầu Mỹ Thuận đến phà Đình Khao, các bạn chỉ cần chạy thẳng một đoạn đường ngắn khoảng 10km là có thể đến vùng ven sông Cổ Chiên, nơi tập trung nhiều lò gạch. Sau đó, nếu lộ trình này đi ngang qua đường tỉnh 902, các bạn nên đi tiếp đến rạch Thầy Cai để ghé thăm và check-in nhiều bức ảnh độc lạ tại đây nhé.</p>', 'Xã Hòa Tịnh, Huyện Mang Thít, Tỉnh Vĩnh Long', 10.21679580, 106.04630410, '0', 4, 2, '2025-05-23 16:25:38', '2025-05-23 16:25:52'),
(28, 'Chùa Phật Ngọc Xá Lợi', 'Miễn phí', '<p>Đứng từ xa nhìn lại, bạn sẽ nhìn thấy hình ảnh cổng chùa với vẻ đẹp uy nghiêm, bề thế. MIA.vn nghĩ rằng, các bạn nên check-in ngay cổng chùa để lưu lại nhiều khoảnh khắc tuyệt đẹp, có 1 - 0 -2 ngay tại đây. Khi đến Chùa Phật Ngọc Xá Lợi Vĩnh Long, các bạn không chỉ được hòa mình vào khung cảnh thiên nhiên yên bình, thanh tĩnh mà còn được chiêm ngưỡng vẻ đẹp cổ kính, linh thiêng của ngôi chùa.&nbsp;</p><p>Ngôi chùa sở hữu diện tích hơn 1.7ha , được xây dựng vào năm 1970 do cố Hòa Thượng Thích Thiện Hoa trụ trì. Tuy nhiên, đến tháng 4 nằm 1975, vì nhiều lý do khác nhau nên việc thi công đã tạm dừng. Đến năm 2015, việc thi xông xây dựng tại Chùa Phật Ngọc Xá Lợi Vĩnh Long mới được tiếp tục. Trong đó có nhiều hạng mục đến thời điểm 2015 mới dần hoàn thiện như: chánh điện, bảo tháp, đài Đức Quan Thế Âm lộ thiên, cổng tam quan...&nbsp;</p><p>Chùa Phật Ngọc Xá Lợi Vĩnh Long được mọi người ví von như một thị trấn cổ thu nhỏ vì phong cách kiến trúc mang đậm bản sắc văn hóa Phật giáo của người Việt Nam. Với lối thiết kế khoa học, ngôi chùa sử dụng nhiều khoảng trống để tạo không gian nhẹ nhàng, thanh tịnh. Lối kiến trúc nghệ thuật vừa tinh xảo vừa hài hòa của Chùa Phật Ngọc Xá Lợi Vĩnh Long khiến nhiều người vô cùng thích thú khi được check-in tại đây. Không những thế, hầu hết các hạng mục từ ngoài vào trong của ngôi chùa đều mang đậm nét văn hóa tâm linh đặc trưng của kiến trúc truyền thống Việt Nam nên đã vô cùng thu hút khách thập phương.</p>', '<p>Mỗi năm, số lượng người đổ về&nbsp;Chùa Phật Ngọc Xá Lợi Vĩnh Long vô cùng lớn. Tuy nhiên, mọi người thường đến đây nhiều nhất vào mùa hè hay dịp tháng rằm tháng 7. Theo kinh nghiệm, thời điểm từ tháng 11 đến tháng 4 rất lý tưởng để mọi người có thể thoải mái vi vu, khám phá khắp Vĩnh Long. Đối với những người đam mê khám phá du lịch, thời điểm mùa hè là khoảng thời gian lý tưởng để họ có thể vừa chiêm ngưỡng cảnh đẹp tại Chùa Phật Ngọc Xá Lợi Vĩnh Long vừa khám phá nhiều điểm đến du lịch sinh thái nổi tiếng khác như: vườn trái cây thuộc Cù Lao An Bình, Chợ Nổi Trà Ôn...&nbsp;</p>', '<p>Ẩm thực chay Vĩnh Long nổi tiếng với sự đa dạng và thơm ngon của các món ăn, với nhiều quán chay được yêu thích. Một số quán chay nổi tiếng tại Vĩnh Long bao gồm Ẩm thực Chay Hoa Sen, Tịnh Bình Chay, Quán chay Thanh Đạm, Quán chay An Lạc, Quán chay Hoa Tâm và Quán chay 125.&nbsp;</p>', '<p>Theo nhận xét của nhiều bạn cho biết, ngôi chùa nằm ở trên con đường khá nổi tiếng, nhiều người qua lại nên có thể dễ dàng tìm thấy bằng Google Maps. Vé xe khách đi từ Thành phố Hồ Chí Minh đến Vĩnh Long dao động từ 100.000 VNĐ/lượt đến 120.000 VNĐ/lượt. Xe khách sẽ đưa bạn đến đúng địa chỉ của ngôi chùa. Ngoài ra, bạn có thể gọi taxi Vĩnh Long để di chuyển đến chùa nếu xe khách dừng tại bến xe.&nbsp;</p><p>Nếu đi bằng xe máy, các bạn có thể tham khảo lộ trình sau đây: Từ trung tâm thành phố Hồ Chí Minh di chuyển về huyện Cái Bè - Tiền Giang theo đường Quốc lộ 1A. Chỉ cần vượt qua cầu Mỹ Thuận, bạn sẽ đến được Chùa Phật Ngọc Xá Lợi Vĩnh Long.</p>', 'Phường Tân Ngãi, Thành phố Vĩnh Long, Tỉnh Vĩnh Long', 10.26480700, 105.91290910, '0', 4, 7, '2025-05-23 16:31:54', '2025-05-23 16:31:54'),
(29, 'Chùa ông Thất Phủ Miếu', 'Miễn phí', '<p>Theo sử sách ghi lại, Chùa Ông Thất Phủ Miếu đã có từ thời Nguyễn. Căn cứ vào các dữ liệu lịch sử, hai vị tướng nhà Minh Mạt tên là Dương Ngạn Địch và Trần Thượng Xuyên đã sang Việt Nam lánh nạn. Các quan tướng nhà Nguyễn cho phép người của Dương Ngạn Địch lập hội Thất Phủ, cũng tương tự như các bang cộng đồng hương của người Hoa lúc này.&nbsp;</p><p>Vì địa hình tương đối tốt, thuận lợi cả đường bộ và đường thủy cho nên người Hoa đã ưu ái chọn nơi này để đặt làm Hội quán tiếp xúc. Khi đến thời kỳ Pháp thuộc, số lượng người Hoa di cư đến Vĩnh Long để sinh sống ngày càng nhiều. Số người từ Quảng Đông, Triều Châu tách ra lập bang hội riêng nên một số người dân Phúc Kiến bị bỏ rơi đã cùng nhau tái thiết miếu Thất Phủ cũ. Ngôi miếu này được người dân đặt tên mới là \"Vĩnh An cung\" để trùng tu, gia công Hội quán cho bang của mình.</p><p>Do đó, Chùa Ông Thất Phủ Miếu lúc này chỉ thuộc bang của người Trung Hoa Phúc Kiến còn sót lại vào những năm 1872. Công trình kiến trúc Chùa Ông Thất Phủ Miếu được triển khai, xây dựng bởi những người thợ tài hoa từ Phúc Kiến sang thực hiện. Chính vì vậy, ngôi chùa sở hữu vẻ đẹp cổ kính, linh thiêng của người Hoa thuộc miền Nam Trung Quốc. Bên cạnh đó, công trình Chùa Ông Thất Phủ Miếu cũng có sự góp sức của nhóm nghệ nhân cùng công nhân bản địa ở làng Tân Giai, Tân Nhơn…</p>', '<p>Chùa Ông Thất Phủ Miếu tại địa chỉ 22 đường Nguyễn Chí Thanh, phường 5, TP Vĩnh Long, tỉnh Vĩnh Long mở cửa cả ngày. Lễ hội chính của chùa diễn ra từ ngày 6 đến 9 tháng 2 (tức 10 đến 13 tháng Giêng) hàng năm. Ngoài ra, chùa còn có nhiều ngày lễ lớn như vía Ông, vía Bà, Vu Lan.&nbsp;</p>', '<p>Ẩm thực chay Vĩnh Long nổi tiếng với sự đa dạng và thơm ngon của các món ăn, với nhiều quán chay được yêu thích. Một số quán chay nổi tiếng tại Vĩnh Long bao gồm Ẩm thực Chay Hoa Sen, Tịnh Bình Chay, Quán chay Thanh Đạm, Quán chay An Lạc, Quán chay Hoa Tâm và Quán chay 125.&nbsp;</p>', '<p>Chùa Ông Thất Phủ Miếu là một điểm tham quan nổi tiếng nằm ngay tại trung tâm thành phố Vĩnh Long, rất dễ tìm thấy nhờ sự hỗ trợ của ứng dụng Google Maps. Bạn chỉ cần nhập tên ngôi chùa, hệ thống sẽ chỉ dẫn bạn đến địa điểm này một cách nhanh chóng và tiện lợi. Đối với những ai chọn di chuyển bằng xe khách từ Thành phố Hồ Chí Minh, giá vé thường dao động từ 100.000 VNĐ đến 120.000 VNĐ cho mỗi lượt đi. Quãng đường di chuyển từ Thành phố Hồ Chí Minh đến Vĩnh Long mất khoảng 3 giờ đồng hồ, tùy vào tình hình giao thông. Xe khách là phương tiện phổ biến, giúp bạn tiết kiệm sức lực, đồng thời có thể nghỉ ngơi suốt hành trình, đảm bảo sự thoải mái và an toàn hơn so với việc tự điều khiển xe máy. Khi đến nơi, bạn có thể dễ dàng bắt xe ôm hoặc taxi để đến Chùa Ông Thất Phủ Miếu, hoặc tự khám phá các địa điểm lân cận khác trong thành phố.</p>', 'Phường 5, Thành phố Vĩnh Long, Tỉnh Vĩnh Long', 10.25178000, 105.94231000, '0', 4, 7, '2025-05-23 16:38:32', '2025-05-23 16:38:46'),
(30, 'Biển Ba Động', 'Miễn phí', '<p>Ba Động có bờ biển trải dài hơn 10km cùng bầu không khí trong lành, mát mẻ đặc trưng của miền biển Nam Bộ. Là một trong những bãi biển hiếm hoi của vùng Tây Nam Bộ vẫn giữ được màu nước trong vắt dù thượng nguồn sông Mê Kông hằng năm đổ về lượng phù sa rất lớn, du lịch biển Ba Động hiện đang là lựa chọn số 1 của bà con miền Tây khi có nhu cầu đi chơi biển trong phạm vi gần. Đặc biệt, nơi đây ngày càng thu hút được nhiều du khách phương xa trong hành trình tìm hiểu và khám phá xứ Nam Kỳ Lục Tỉnh.</p><p>Với những vẻ đẹp khác biệt mà thiên nhiên ưu ái ban tặng, không có gì ngạc nhiên khi biển Ba Động được khai thác du lịch và nghỉ dưỡng ngay từ thời thuộc địa. Người Pháp sau khi sang Việt Nam đã triển khai nhiều hoạt động du lịch phục vụ người bản xứ như xây dựng khu nghỉ mát ven biển (nay là địa danh Nhà Mát), mở sân golf (nay là địa danh Cồn Cù). Sau giai đoạn chiến tranh ác liệt, người Pháp rút khỏi Việt Nam, tỉnh Trà Vinh được thành lập, các quan chức của tỉnh tiếp tục cho triển khai và đẩy mạnh du lịch tại đây, đưa Ba Động trở thành điểm nghỉ dưỡng lý tưởng bậc nhất miền Tây.</p><p>Cũng do nằm trong khu vực biển phù sa nên bãi cát Ba Động không trắng muốt hay vàng óng ả, nước biển Ba Động cũng không thể trong xanh như với các bãi biển Nha Trang hay Vũng Tàu. Tuy nhiên, dọc bờ biển Đông, từ Gò Công tới Cà Mau, Ba Động có bãi cát đẹp, nước biển khá trong, nhất là vào những tháng sau Tết Nguyên đán, sóng yên biển lặng, hình thành khu du lịch biển được nhiều người ưa chuộng.</p><p>Sớm nhận ra giá trị của bãi biển Ba Động, từ đầu thế kỷ XX, nhà cầm quyền thực dân Pháp đã xây dựng ở đây khu nghỉ mát và gần đó là một sân golf mini (lúc đó sân golf gọi là sân cù, đánh golf gọi là đánh cù) dành cho các quan chức, giới thượng lưu trong tỉnh và các tỉnh lận cận về nghỉ dưỡng dịp cuối tuần. Qua giai đoạn chiến tranh ác liệt, khu nghỉ mát và sân golf ấy không còn nhưng đã để lại địa danh ấp Nhà Mát (thuộc xã Trường Long Hòa, thị xã Duyên Hải) và ấp Cồn Cù (thuộc xã Đông Hải, huyện Duyên Hải). Sau khi tỉnh Trà Vinh được tái lập (1992), Nhà nước tập trung nguồn kinh phí đầu tư hệ thống kết cấu hạ tầng như giao thông, điện lưới quốc gia, viễn thông, rừng phòng hộ phi lao, bờ kè chống sạt lở… tạo điều kiện đánh thức tiềm năng du lịch biển Ba Động.</p>', '<p>Đến du lịch Trà Vinh mỗi mùa trong năm đều mang đến một vẻ đẹp đặc biệt. Do đó, du khách có thể lựa chọn bất kỳ thời điểm nào để đến đây. Tuy nhiên, thường thì nơi này thu hút nhiều du khách vào mùa lễ hội nhất.</p>', '<p>Khám phá biển Ba Động du khách đừng bỏ lỡ các món hải sản tươi ngon ngay sau khi được đánh bắt. Các thức quà biển này du khách có thể tìm mua ở các khu chợ dân sinh với giá rẻ, ngay sau khi được đổ lưới. Sau đó có thể thuê nhà hàng để chế biến hoặc du khách có thể tự chế biến theo kiểu dã ngoại, vừa hít thở không khí trong lành bên bãi biển, vừa thưởng thức hải sản tươi ngọt thì xem như chuyến du lịch biển Ba Động cũng đã vẹn tròn</p><p>Đặc biệt nơi đây còn có một thoại đặc sản mà du khách nhất định phải thưởng thức, đó là chù ụ. Đây là một loại giáp xác, gần giống cua và ba khía nhưng lại có hương vị khác biệt hơn nhiều. Một số món ngon từ chù ụ mà du khách có thể tham khảo như chù ụ rang me, hấp, nướng mọi hay đơn giản là luộc lên chấm với muối ớt hoặc muối tiêu chanh, ăn kèm với các loại rau thơm, rau răm, xà lách thôi là đã thấy cái hương vị biển cả vùng duyên hải ngập tràn trong từng thớ thịt.</p>', '<p>Biển Ba Động nằm tại phường Long Hòa, huyện Duyên Hải và cách trung tâm của Trà Vinh khoảng 55km. Đối với du khách từ miền Bắc hoặc miền Trung, cần lưu ý rằng Trà Vinh không có sân bay, do đó du khách có thể mua vé máy bay đến TP.HCM hoặc Cần Thơ trước, sau đó di chuyển đến Trà Vinh.</p><ul><li>Nếu đi từ TP.HCM, có thể chọn xe máy hoặc ô tô và đi khoảng 200km. Khi đến Trà Vinh, tiếp tục di chuyển trên QL53 đến thị trấn Cầu Ngang, sau đó đi theo hướng ĐT 913 đến xã Trường Long Hòa, cách trung tâm Trà Vinh khoảng 58km.</li><li>Nếu đi từ Cần Thơ, quãng đường sẽ khoảng tầm 75km nên nhiều người thường chọn xe máy. Từ trung tâm Cần Thơ, du khách đi theo hướng QL1A và qua cầu Cần Thơ sau đó rẽ phải vào QL54 và tiếp tục trên hướng TL911 để đến được tỉnh Trà Vinh.</li></ul>', 'Xã Trường Long Hòa, Thị xã Duyên Hải, Tỉnh Trà Vinh', 9.68610890, 106.57608570, '0', 4, 3, '2025-05-23 16:45:35', '2025-05-23 16:45:35'),
(31, 'Đền thờ Bác Hồ', 'Miễn phí', '<p>Đền thờ Chủ tịch Hồ Chí Minh, người dân địa phương vẫn quen gọi là Đền thờ Bác Hồ, nhà nghiên cứu Trần Bạch Đằng khái quát thành biểu tượng “Công trình của Trái tim” bởi ý nghĩa thiêng liêng của việc hình thành, quá trình chiến đấu bảo vệ ngoan cường và giá trị tinh thần của ngôi đền trong đời sống tinh thần của Đảng bộ, quân dân tỉnh Trà Vinh.</p><p>Ngôi đền tọa lạc tại ấp Vĩnh Hội, xã Long Đức, thành phố Trà Vinh, cách trung tâm tỉnh lỵ Trà Vinh hơn 4 km về phía bắc.</p><p>Đền thờ Chủ tịch Hồ Chí Minh tỉnh Trà Vinh đã được Bộ Văn hóa Thông tin, nay là Bộ Văn hóa, Thể thao và Du lịch xếp hạng di tích lịch sử – văn hóa cấp quốc gia vào năm 1989.</p><p>Khu di tích đền thờ Bác Hồ rộng 5,4 ha với các hạng mục chính như: Đền thờ Bác Hồ, nhà trưng bày thân thế sự nghiệp Chủ tịch Hồ Chí Minh, khuôn viên cây xanh, ao cá, khu vui chơi cắm trại…và đặc biệt là mô hình Nhà sàn Bác Hồ được thiết kế, in sao và lắp khoa học với tỉ lệ 97% theo nguyên bản nhà sàn Bác Hồ tại Phủ Chủ tịch ở thủ đô Hà Nội.</p><p>Đền thờ Chủ tịch Hồ Chí Minh tỉnh Trà Vinh đã được Bộ Văn hóa Thông tin; nay là Bộ Văn hóa; Thể thao và Du lịch xếp hạng di tích lịch sử – văn hóa cấp quốc gia vào năm 1989. Trở thành “địa chỉ đỏ” giáo dục tinh thần yêu nước; truyền thống anh hùng cách mạng cho thế hệ trẻ mai sau.</p><p>Thăm Khu di tích đền thờ Bác Hồ; thắp một nén hương tỏ lòng biết ơn; xem hiện vật trưng bày; nghe những câu chuyện cảm động về lịch sử xây dựng và bảo vệ đền thờ Bác…; càng thấy tình cảm lớn lao chân thành của đồng bào nơi đây dành cho vị lãnh tụ vĩ đại của dân tộc.</p>', '<p>Đền thờ Chủ tịch Hồ Chí Minh ở Trà Vinh mở cửa từ 7 giờ sáng đến 7 giờ tối tất cả các ngày trong tuần.&nbsp;</p>', '<p>1. Bún nước lèo</p><p>Bún nước lèo nổi bật với nước dùng trong nhưng đậm đà nhờ vào mắm bò hóc – một loại mắm truyền thống của người Khmer, tạo nên vị ngọt tự nhiên và mùi thơm đặc trưng. Một tô bún nước lèo đúng chuẩn không thể thiếu cá lóc luộc tách xương, tôm tươi bóc vỏ cùng các loại rau sống như bắp chuối, húng quế, giá đỗ, hẹ, tất cả hòa quyện tạo nên tổng thể hài hòa giữa vị ngọt thanh, béo nhẹ và mùi thơm đặc trưng của mắm. Khi ăn, thực khách có thể cho thêm ớt, chanh và nước mắm chua ngọt để tăng thêm hương vị.</p><p>2. Bún suông</p><p>Bún suông là món ăn độc đáo và đặc trưng của Trà Vinh, hấp dẫn thực khách bởi phần chả tôm quết nhuyễn, được tạo hình thành từng miếng dài cong cong giống như con đuông dừa. Chả tôm không chỉ có hình dáng lạ mắt mà còn mang hương vị thơm ngon, dai giòn nhờ vào cách chế biến công phu: tôm được xay nhuyễn, trộn với gia vị và quết thật kỹ để tạo độ dai, sau đó được nặn thành từng miếng nhỏ và thả vào nồi nước dùng nóng hổi.</p>', '<p>Để đến Đền thờ Bác Trà Vinh, bạn sẽ mất khoảng 15 phút chạy xe. Bạn có thể thuê xe máy, ô tô tự lái để tiện di chuyển đến các điểm tham quan nổi tiếng trong những ngày du lịch Trà Vinh. Hoặc bạn cũng có thể gọi taxi để đến Đền thờ Bác. Tuy nhiên theo kinh nghiệm, ở Trà Vinh taxi công nghệ không nhiều, nếu bạn gọi taxi tư nhân thì nên hỏi trước giá rồi mới đi, tránh bị chặt chém nhé.</p>', 'Xã Long Đức, Thành phố Trà Vinh, Tỉnh Trà Vinh', 9.98423960, 106.33064110, '0', 4, 4, '2025-05-23 16:53:48', '2025-05-23 16:54:15'),
(32, 'Chợ nổi Ngã Bảy', 'Miễn phí', '<p>Chợ nổi Ngã Bảy có tên gọi xuất phát từ vị trí đặc biệt của nó, đây là nơi giao thoa của bảy dòng sông: Cái Côn, Bún Tàu, Mang Cá, Xẻo Môn, Xẻo Dong, Búng Nhỏ, và Búng Lớn. Sự hội tụ này tạo nên một ngã bảy đặc biệt trên sông nước, từ đó khu chợ này mới hình thành tên gọi “chợ nổi Ngã Bảy”.</p><p>Tên gọi Chợ nổi Ngã Bảy không chỉ phản ánh vị trí địa lý đặc biệt mà còn chứa đựng ý nghĩa về sự giao lưu, kết nối văn hóa và thương mại của người dân miền Tây Nam Bộ. Chợ nổi Ngã Bảy là nơi buôn bán sầm uất, nơi gặp gỡ của các thương lái và người dân từ khắp nơi đến trao đổi hàng hóa. Sự phong phú về sản phẩm, từ nông sản đến thủ công mỹ nghệ cùng với những con người thân thiện, hiếu khách đã tạo nên một nét văn hóa độc đáo và thu hút du khách tìm đến khám phá. Chợ nổi Ngã Bảy không chỉ là một địa điểm mua sắm náo nhiệt mà còn là biểu tượng của sự phồn thịnh và đa dạng văn hóa của vùng đất Hậu Giang.</p><p>Chợ nổi Ngã Bảy - Hậu Giang là biểu tượng của văn hóa sông nước miền Tây Nam Bộ với những nét đẹp đặc trưng rất riêng. Đây là không gian giao thoa văn hóa của các dân tộc Khmer, Hoa, và người Kinh, từ cách sống cho đến hoạt động mua bán diễn ra trên sông. Người dân nơi đây rất hiếu khách và thân thiện, luôn sẵn sàng chia sẻ về đời sống và văn hoá của họ cho bất cứ ai đến tham quan.</p><p>Chợ nổi Ngã Bảy là nơi mua bán truyền thống trên sông, với hàng trăm thuyền ghe bày đủ mọi loại hàng hóa từ nông sản đến thủ công mỹ nghệ. Du khách hoàn toàn có thể trải nghiệm không khí sôi động của chợ, được thưởng thức những món ăn đặc sản trứ danh. Đây là nơi lưu giữ và phát triển những giá trị văn hóa sông nước, là điểm đến hấp dẫn cho những ai yêu thích khám phá và trải nghiệm văn hóa dân gian độc đáo của miền Tây sông nước.</p><p>Đến du lịch chợ nổi Ngã Bảy - Hậu Giang, du khách sẽ thật sự choáng ngợp trước sự đa dạng và phong phú của các mặt hàng được bày bán trên thuyền ghe trên sông. Các sản phẩm bao gồm đủ loại nông sản tươi ngon như rau củ, trái cây mùa và các loại cá tươi sống. Ngoài ra, du khách cũng có thể mua được các món đặc sản chế biến sẵn và thưởng thức trực tiếp ngay tại ghe, thuyền như bánh xèo, bánh tét, trái cây.... Chợ nổi Ngã Bảy không chỉ là nơi để mua sắm mà còn là cơ hội tuyệt vời để bạn có thể khám phá và trải nghiệm sự sôi động đầy màu sắc của đời sống miền Tây Nam Bộ.</p>', '<p>Thời gian lý tưởng để du khách có thể tham quan Chợ nổi Ngã Bảy - Hậu Giang là vào các buổi sáng sớm, từ khoảng 6 đến 9 giờ sáng. Lúc này là thời điểm chợ nổi rộn ràng nhất, các thuyền ghe sẽ bắt đầu kéo về bờ và các hoạt động buôn bán diễn ra vô cùng sôi động. Du khách hoàn toàn có thể hòa mình vào không khí sôi động của chợ, tham gia mua sắm các sản phẩm đặc sản, trải nghiệm đời sống văn hoá của người dân địa phương.&nbsp;</p><p>Ngoài ra, vào thời điểm sáng sớm, thời tiết thường sẽ mát mẻ hơn so với buổi chiều nắng gắt và điều này sẽ giúp bạn thoải mái hơn trong việc di chuyển cũng như khám phá. Nếu muốn có trải nghiệm hoàng hôn tuyệt vời trên sông, bạn cũng có thể dành thời gian để ở lại chợ nổi Ngã Bảy vào lúc chiều tà, khi ánh nắng dần buông và chợ nổi lặng lẽ hơn sau một ngày làm việc sôi động.</p>', '<p>Đến với chợ nổi Ngã Bảy, du khách sẽ có cơ hội được thưởng thức những món đặc sản nức tiếng gần xa. Bánh xèo miền Tây là một ví dụ điển hình với lớp vỏ giòn và nhân thịt, tôm, giá xanh… được chế biến tại chỗ trước mặt khách hàng giúp bạn có thể thưởng thức được trọn vẹn hương vị. Ngoài ra, bạn cũng có thể thử qua món bún nước lèo đặc sản với nước lèo đậm đà và cùng với rau sống, ngò rí và các loại gia vị. Đặc biệt, khi tham quan tại chợ nổi Ngã Bảy, bạn cũng có thể thưởng thức các loại trái cây tươi ngon như xoài, bưởi, dưa hấu theo mùa vô cùng hấp dẫn. Có thể nói hành trình khám phá chợ nổi Ngã Bảy sẽ mang đến trải nghiệm ẩm thực đặc biệt không thể bỏ qua khi ghé thăm Hậu Giang.</p>', '<p>Đến Chợ nổi Ngã Bảy (Phụng Hiệp, Hậu Giang), bạn có thể đi bằng nhiều phương tiện, bao gồm xe máy, xe khách, tàu thủy, hoặc thuê xe riêng. Khoảng cách giữa hai địa điểm này là khoảng 60-70km, tùy thuộc vào lộ trình cụ thể.</p>', 'Xã Đại Thành, Thành phố Ngã Bảy, Tỉnh Hậu Giang', 9.82836190, 105.83168610, '0', 4, 4, '2025-05-23 17:04:33', '2025-05-23 17:04:33');
INSERT INTO `destinations` (`id`, `name`, `price`, `highlights`, `best_time`, `local_cuisine`, `transportation`, `address`, `latitude`, `longitude`, `status`, `user_id`, `travel_type_id`, `created_at`, `updated_at`) VALUES
(33, 'Rừng Tràm Vị Thủy', 'Miễn phí', '<p>Rừng tràm Vị Thủy được đánh giá là nơi có hệ sinh thái đất ngập nước ngọt độc đáo nhất tại vùng đồng bằng sông Cửu Long. Nơi đây từng được quản lý bởi Nông trường Cờ Đỏ. Đến năm 2007 đã được bàn giao cho Công Ty TNHH Việt – Úc đầu tư xây dựng thành một khu du lịch sinh thái hấp nên cái tên là khu du lịch sinh thái Việt Úc có từ đó.</p><p>Điểm nhấn của khu du lịch sinh thái Việt Úc là vườn chim tự nhiên rộng 10 ha với các loại chim, cò đặc trưng vùng sông nước miền Tây như cò trâu, cò ngà, vạc, le le, cồng cộc, vịt trời; khu nuôi động vật hoang dã có heo rừng, trăn, ong lấy mật; các kênh mương được thả nhiều loại cá đồng như cá lóc, cá trê, cá thát lát, cá phi… Đây là nguồn cá để du khách trải nghiệm các hoạt động câu cá, đặt lờ, trúm, giăng lưới cũng như thưởng thức các loại cá sống trong môi trường tự nhiên.</p><p>Rừng tràm Vị Thủy không đơn thuần là một điểm tham quan mà còn chứa đựng vẻ đẹp văn hóa của con người và sông nước vùng Đồng bằng sông Cửu Long. Đến đây các bạn sẽ được ngồi thuyền xuôi theo những dòng kênh nằm dưới những tán cây xanh thẳm trong khu rừng và ngắm nhìn cảnh vật xung quanh. Trong không gian tĩnh lặng ấy, những đàn chim líu lo bay lượn như đang muốn chào mời du khách.</p><p>Hiện nay, Khu du lịch đã hoàn thành việc cải tạo cảnh quan, vườn cây ăn trái, nuôi cá và động vật hoang dã. Đang xây dựng một số khu chức năng như: Khu điều hành và quản lý;&nbsp; Khu nghỉ dưỡng; Khu nuôi trồng thủy sản nước ngọt kết hợp với dịch vụ hỗ trợ: Ăn uống, câu cá, đặt lợp, du ngoạn bằng tàu,…</p>', '<p>Thời điểm thích hợp để du lịch rừng tràm Vị Thủy chính là vào lúc sáng sớm hoặc chiều muộn vì vào thời điểm này bạn sẽ bắt gặp được nhiều loài chim hơn khi chúng chuẩn bị đi kiếm ăn và bay về tổ. Đặc biệt, vào mùa nơi đây đều có các loài chim về làm tổ. Nếu may mắn hơn bạn bắt gặp được rất nhiều loài chim quý hiếm có trong danh sách đỏ.</p>', '<p>Đặc sản của vùng đất Nam bộ là những vườn cây ăn trái bạt ngàn với vô vàn trái lành thơm ngọt. Ai từng du lịch miền Tây cũng từng nghe danh vườn trái cây Chợ Lách, vườn sầu riêng Cái Mơn, Bảy Thảo,... Đến khu du lịch sinh thái tràm chim Vị Thủy, bạn cũng được thưởng thức các loại trái cây đặc sản của miền Tây như sầu riêng, chôm chôm, nhãn, quýt tại khu vườn vừa được đầu tư chăm trồng để tạo nên hệ sinh thái đa dạng của đểm đến hấp dẫn này nữa đấy.</p>', '<p>Nếu xuất phát từ trung tâm thành phố Vị Thanh, bạn đi theo đường Nguyễn Viết Xuân, hướng về phía đường Trần Hưng Đạo. Khi đến được vòng xuyến thì đi theo lối ra thứ nhất vào đường Ba Tháng Hai. Hãy tiếp tục di chuyển cho đến khi gặp vòng xuyến thứ hai thì rẽ ngay vào lối ra thứ nhất theo hướng đường QL61. Kế tiếp, hãy lái xe đến đường Vị Tường khoảng 5km thì bắt đầu rẽ trái và đi tiếp khoảng 23m. Đến đây thì bạn hãy rẽ phải là sẽ đến được địa điểm ngay gần khu rừng tràm tại xã Vĩnh Tường rồi đấy. Bạn có thể đi bộ thêm một đoạn ngắn để được trải nghiệm các hoạt động thú vị ở Vị Thủy. Nếu ngại đi bộ thì hãy đi xe ôm hay taxi để đến rừng nhé.</p>', 'Xã Vĩnh Tường, Huyện Vị Thuỷ, Tỉnh Hậu Giang', 9.77552090, 105.58526650, '0', 4, 6, '2025-05-23 17:11:18', '2025-05-23 17:11:18'),
(34, 'Thiền Viện Trúc Lâm', 'Miễn phí', '<p>Thiền viện Trúc Lâm Hậu Giang được khánh thành năm 2018, sau hơn ba năm thi công. Với diện tích hơn 4 ha, 16 hạng mục của Thiền viện đã được xây dựng và hoàn thành, góp phần tạo nên một quần thể kiến trúc văn hóa tâm linh đặc sắc. Thiền viện Trúc Lâm Hậu Giang không chỉ bảo tồn và phát huy những giá trị truyền thống của văn hóa Phật giáo mà còn kết nối các di tích lịch sử và văn hóa truyền thống của địa phương, trở thành điểm nhấn <a href=\"https://mia.vn/cam-nang-du-lich\">du lịch</a> văn hóa tâm linh của Hậu Giang.</p><p>Thiền viện Trúc Lâm Hậu Giang là nơi tu theo Thiền phái Trúc Lâm Yên Tử một dòng thiền mang đậm bản sắc văn hóa dân tộc Việt Nam do vua Trần Nhân Tông khai mở và phát triển. Ông là vị vua thứ ba triều đại Nhà Trần, sau khi lãnh đạo tinh thần dân tộc chống quân Nguyên Mông, đất nước yên bình, Ngài nhường ngôn lại cho con, lên non Yên Tử xuất gia tu hành. Sau khi đắc đạo, Ngài dung hợp 3 Thiền phái trước đó và sáng lập thành Thiền phái Trúc lâm.</p><p>Dáng vóc ngôi thiền viện xây dựng theo kiến trúc mỹ thuật Phật giáo thời Lý, Trần&nbsp;trên diện tích 40.000 m2. Bao gồm các hạng mục: Chánh điện, nhà Tổ, lầu chuông, lầu trống, Cổng tam quan, nhà nghỉ chân, tôn tượng Quan Âm lộ thiên, miếu thờ Mẹ Âu Cơ, giảng đường, trai đường, nhà trụ trì, nhà khách, thư viện, Tăng xá, Ni xá…</p><p>Khi vào bên trong chánh điện du khách sẽ rất ấn tượng với vẻ tĩnh lặng mà đầy uy nghiêm ở đây. Sàn lót gạch màu đỏ, tất cả cột gỗ đều được đặt trang trọng trên những tấm tán bằng đá xám vân mây, chạm trổ hình hoa sen cách điệu.</p><p>Với lối kiến trúc của các triều đại Việt Nam truyền thống, Thiền viện Trúc Lâm mang lại cho người dân cảm giác rất thanh tịnh&nbsp;yên bình của chốn Thiền Tu. Điều này đã khiến không ít bước chân của lữ khách thập phương phải trầm trồ khen ngợi mỗi khi đến đây.</p>', '<p>Thiền Viện Trúc Lâm mở cửa vào lúc 5:00, và đóng cửa vào lúc 21:00 hàng ngày. Tuy nhiên, nếu bạn muốn ngắm cảnh sương sớm tại Thiền Viện, ngắm nhìn phong cảnh thiên nhiên lúc mặt trời chỉ vừa mới chớm mọc thì cũng có thể liên lạc với trụ trì để ở lại qua đêm. Mọi người sẽ rất vui vẻ nếu giúp được bạn sắp xếp chỗ ngủ lại tại Thiền Viện đấy.</p>', '<p>Các thiền viện thường có những quy định về thực đơn, tập trung vào các món ăn chay, đơn giản, kết hợp với rau củ quả tươi của vùng.&nbsp;</p>', '<p>Theo Quốc lộ 1A đến cầu Cần Thơ, sau đó tiếp tục đi theo Quốc lộ 1A đến Hậu Giang. Từ Vị Thanh, bạn đi khoảng 21.8km nữa là đến thị xã Long Mỹ, nơi Thiền viện Trúc Lâm tọa lạc</p>', 'Phường Vĩnh Tường, Thị xã Long Mỹ, Tỉnh Hậu Giang', 18.07422000, 99.83073000, '0', 4, 7, '2025-05-23 17:20:22', '2025-05-23 17:20:22'),
(35, 'Con đường tre', '20.000 VND (trẻ em) - 30.000 VND (người lớn)', '<p>Vườn tre Tư Sang Hậu Giang là một địa điểm du lịch sinh thái mới nổi thuộc khu vực ấp Phú Xuân, xã Thạnh Hòa, huyện Phụng Hiệp. Đây là một địa điểm tham quan với không gian rộng lớn, diện tích lên đến 3 hecta mang đến bạn nhiều trải nghiệm giải trí độc đáo và đáng khám phá.</p><p>Vườn tre Tư Sang Hậu Giang còn được biết đến với tên gọi Bamboo Garden. Đây vốn dĩ là một con đường tre xanh mát tuyệt đẹp của lão nông Đặng Văn Sang. Sở hữu vẻ đẹp bình dị cùng không gian trong lành đáng thưởng ngoạn, vườn tre Tư Sang thu hút đông đảo tín đồ du lịch tìm đến trải nghiệm và thư giãn sau những ngày làm việc mệt mỏi.</p><p>Phong cảnh làng quê của Vườn Tư Sang gắn liền với hình ảnh cây tre quen thuộc trong văn hóa làng xã của người Việt Nam. Hình ảnh cây tre vươn mình xõa bóng mềm mại nhưng lại vô cùng chắc chắn gợi nên hình ảnh người dân Việt Nam hiền hòa, đôn hậu nhưng lại mạnh mẽ, quật cường khi cần thiết.</p><p>Ông Đặng Văn Sang cho biết, khi những vụ mía và bạch đàn không mang lại hiệu quả kinh tế như kỳ vọng, ông đã quyết định trồng nên vườn tre này để cải thiện kinh tế gia đình. Vườn tre này đến này đã có tuổi đời lên đến hơn 20 năm và được tận tay ông Đặng Văn Sang chăm sóc và vun trồng.</p><p>Vào mỗi thời điểm rãnh rỗi, ông thường ra vườn tre tỉa nhánh, dọn lá rụng rồi ủ làm phân bón cho gốc tre. Nhờ sự chăm sóc tỉ mẩn, cẩn thận của ông, vườn tre Tư Sang luôn giữ được vẻ ngoài xanh tốt, tạo nên cảnh quan xinh đẹp để những tín đồ du lịch gần xa đến thưởng ngoạn.</p>', '<p>ườn tre Tư Sang là một địa điểm mà bạn có thể tham quan vào bất cứ thời điểm nào trong năm. Không gian nơi đây luôn được chủ vườn chăm sóc cẩn thận nên quanh năm luôn giữ được sự tươi tốt, trong lành.</p><p>Tuy nhiên, bạn nên cân nhắc thật kỹ nếu đến Vườn tre Tư Sang Hậu giang vào mùa mưa. Những cơn mưa bất chợt thường sẽ gây cản trở cho những hoạt động tham quan ngoài trời của bạn. Thông thường, mùa mưa ở Hậu Giang sẽ kéo dài từ tháng 5 đến tháng 11 và cao điểm sẽ rơi vào tháng 9. Vì thế, bạn nên xem trước dự báo thời tiết để lựa chọn thời điểm thích hợp tham quan Vườn tre Tư Sang nhé!</p><p>Vườn tre Tư Sang Hậu Giang sẽ trở nên đông đúc vào thời điểm cuối tuần. Lượng tín đồ du lịch tìm đến đây vào thời điểm này khá nhiều khiến nơi đây trở nên nhộn nhịp, sôi động hơn thường ngày. Nếu muốn tìm kiếm sự yên ả, nhẹ nhàng và dễ chịu, hãy thử cân nhắc đến đây vào thời điểm trong tuần nhé!</p>', '<p>Bếp của Vườn tre Tư Sang Hậu Giang luôn mang đến bạn những món ăn ấn tượng đáng để thử qua. Những món ăn ở đây đều mang đậm dấu ấn dân dã miền Tây Nam Bộ với những nguyên liệu miệt vườn quen thuộc.</p>', '<p>Vườn tre Tư Sang Hậu Giang cách trung tâm thành phố Vị Thanh khoảng 37 km. Để di chuyển từ trung tâm thành phố Vị Thanh đến Vườn tre Tư Sang, bạn sẽ mất một khoảng thời gian từ 50 phút đến 1 tiếng đồng hồ.</p><p>Bạn có thể sử dụng Google Maps để di chuyển đến Vườn tre Tư Sang hoặc đi theo hướng dẫn cụ thể của MIA.vn như sau: Thành phố Vị Thanh - Quốc lộ 61 - rẽ phải vào Lê Quý Đôn - rẽ trái vào Quốc lộ 61C - rẽ trái vào hướng đi Tầm Vu - rẽ phải vào Tầm Vu - cuối đường Tầm Vu rẽ phải - rẽ trái vào Quốc lộ 61 - qua Cầu Ba Láng - rẽ phải vào DT928 ngay chân cầu - bạn sẽ thấy Vườn tre Tư Sang Hậu Giang ngay bên phía tay trái.</p>', 'Xã Thạnh Hòa, Huyện Phụng Hiệp, Tỉnh Hậu Giang', 9.86038500, 105.68214010, '0', 4, 6, '2025-05-23 17:24:18', '2025-05-23 17:24:18'),
(36, 'Chùa Dơi', 'Miễn phí', '<p>Chùa Dơi còn gọi chùa Mã Tộc (hay chùa Mahatúp) nằm bên&nbsp;đường Văn Ngọc Chính (có bảng chỉ dẫn) thuộc Phường 3, thành phố Sóc Trăng. Sở dĩ có cái tên đặc biệt này là vì chùa là ngôi nhà của những bầy dơi đông đúc. Ngôi chùa là không gian văn hóa duy nhất thờ Phật Thích Ca của cộng đồng dân tộc Khmer Nam Bộ tại tỉnh Sóc Trăng.</p><p>Theo thư tịch cổ còn lại có ghi chép: Chùa được khởi công xây dựng vào từ năm 1569, cách nay đã hơn 440 năm. Ban đầu, chính điện của chùa chỉ được xây dựng bằng tre lá, sau đó được xây lại bằng gạch, mái lợp ngói. Năm 1960, chùa được sửa chữa lớn ở chánh điện và cho đến khi có được vẻ khang trang đẹp đẽ như hiện nay, chùa đã trải qua nhiều lần trùng tu tôn tạo.</p><p>Chùa Dơi là một tổng thể kiến trúc gồm có: Ngôi chánh điện, Sala, nhà hội của sư sãi và tín đồ, phòng ở của sư sãi và trụ trì, các tháp để tro người chết, phòng khách… Toàn bộ các công trình toạ lạc trong một khuôn viên rộng có nhiều cây cổ thụ, diện tích khoảng 04 hecta.</p><p>Tuy là không gian thờ Phật Thích Ca nhưng kiến trúc chùa Dơi Sóc Trăng vẫn bị ảnh hưởng mạnh mẽ bởi văn hóa Khmer. Ngôi chùa nổi bật trong không gian xanh mát của cây cối nhờ sắc màu vàng cam Khmer đặc trưng.</p><p>Chùa có mái được lợp ngói, bốn đầu mái cong vút chạm trổ hình rắn Naga, trên đỉnh mái có một ngọn tháp nhọn. Bao quanh chánh điện là các hàng cột đỡ, mỗi cột có một tượng tiên nữ Kemnar chắp hai tay trước ngực…</p>', '<p>Thời điểm lý tưởng để tham quan Chùa Dơi là vào mùa khô, từ tháng 11 đến tháng 4 năm sau, khi thời tiết mát mẻ, ít mưa, thuận lợi cho việc di chuyển và tham quan. Bạn có thể chọn đi vào buổi sáng để chiêm ngưỡng đàn dơi vẫn còn treo mình trên các tán cây. Nếu muốn trải nghiệm lễ hội, nên đi vào dịp lễ Dolta (tháng 9 âm lịch) hoặc lễ Ok Om Bok (tháng 10 âm lịch).&nbsp;</p>', '<p>1. Bánh ú mặn&nbsp;</p><p>Bánh ú mặn với những nguyên liệu để làm ra bánh gồm nếp, đậu phộng, nước cốt dừa, tôm khô, thịt heo, nấm đông cô, lạp xưởng và đặc biệt là lòng đỏ trứng vịt muối. Bánh thường được gói bằng lá chuối, dạng hình tam giác cân và buộc bằng dây lạc. Đến Sóc Trăng mà không thưởng thức bánh ú mặn, quả thật là điều đáng tiếc!</p><p>2. Mè láo</p><p>Mè láo là đặc sản nổi tiếng của người Hoa ở Sóc Trăng. Nó được làm từ khoai môn bào mỏng rồi đem phơi nắng khoảng 3 ngày. Khi chiên bánh, người ta cắt miếng khoai môn thành miếng hình chữ nhật rồi đem trộn với nước đường đã thắng thành kẹo, rồi lăn qua vừng và rang chín. Miếng bánh sẽ phình to ra sau khi chiên, do có chứa bột nếp. Nếu có dịp du lịch Sóc Trăng, bạn có thể mua mè láo làm quà tặng cho người thân và gia đình sau chuyến đi.</p><p>3. Bánh phồng tôm</p><p>Với thành phần nguyên liệu chính gồm bột mì, thịt tôm hoặc tép được xay nhuyễn với một ít hạt tiêu giã nhỏ. Các nguyên liệu trên sau khi trộn với nhau sẽ được nhồi vào những chiếc túi vải dạng hình ống dài. Sau khi hấp chín, người ta cắt ra từng lát hình chữ nhật hay tròn rồi đem phơi khô. Trước khi ăn, phải đem bánh chiên giòn với dầu ăn đã sôi lên, bánh sẽ nở to ra.</p><p>4. Bánh pía</p><p>Bánh pía là đặc sản Sóc Trăng ngon trứ danh, nổi tiếng khắp nơi và thường được nhiều du khách mua làm quà sau mỗi chuyến ghé thăm nơi đây. Từ thế kỉ 17, bánh pía ở Sóc Trăng đã theo chân những người Hán di cư đến phương Nam, Theo thời gian, bánh được chế biến cho phù hợp với khẩu vị của người Việt nhờ tận dụng nguồn nguyên liệu từ vùng đất Nam Bộ. Bánh pía có vỏ bánh mềm, bên trong gồm nhân đậu xanh, sầu riêng, trứng muối,… thơm ngon dễ “gây nghiện” với những tín đồ hảo ngọt.</p><p>5. Bánh cống</p><p>Bánh cống là món ăn <i>đặc sản Sóc Trăng </i>gây ấn tượng nhờ sự kết hợp giữa vị bùi của đậu xanh, ngọt từ tôm thịt cùng lớp vỏ giòn. Bánh có vỏ được làm từ bột gạo,&nbsp;bột đậu nành và trứng, còn nhân bánh là thịt heo băm ướp gia vị,&nbsp;trộn với củ hành tím xắt nhỏ và một ít đậu xanh hấp. Nhìn vẻ ngoài của bánh cống trông đẹp mắt và hấp dẫn. Bánh cống rất ngon khi ăn kèm với các loại rau sống như húng, xà lách, cải, gừng…</p>', '<p>Từ trung tâm thành phố, muốn tìm địa chỉ chùa Dơi Sóc Trăng, khách du lịch có thể di chuyển theo hướng sau:</p><p>Đi về hướng Nam khoảng 800m lên đường Hai Bà Trưng giao cắt với Trần Hưng Đạo, hay cũng là hướng về phía đường 30 tháng 4</p><p>=&gt; Di chuyển trên đường Trần Hưng Đạo khoảng 800m để tới vòng xuyến</p><p>=&gt; Tại vòng xuyến, đi theo lối ra thứ 2 vào Lê Hồng Phong bạn chạy thêm chừng 850 m</p><p>=&gt; Rẽ phải vào Văn Ngọc Chính khoảng 1,0 km là tới được Chùa Dơi</p>', 'Phường 3, Thành phố Sóc Trăng, Tỉnh Sóc Trăng', 9.57896790, 105.97243960, '0', 4, 7, '2025-05-23 17:31:14', '2025-05-23 17:31:14'),
(37, 'Chợ nổi Ngã Năm', 'Miễn phí', '<p>Chợ nổi Ngã Năm là khu chợ nổi tiếng bậc nhất của tỉnh Sóc Trăng. Sở dĩ có tên như vậy vì chợ nằm ngay vị trí trung tâm, từ đây chia thành 5 nhánh sông xuôi về những địa phương lân cận. Chợ nổi là một trong những địa chỉ buôn bán tấp nập bậc nhất của người dân Sóc Trăng, đồng thời còn trở thành điểm du lịch thu hút đông đảo các tín đồ xê dịch ghé đến khám phá.</p><p>Chợ nổi Ngã Năm là nơi người dân Sóc Trăng và các địa phương lân cận tập trung về để giao thương, buôn bán. Các gia đình mang trái cây, thủy hải sản, nông sản... ra chợ bán cho thương lái. Còn các tiểu thương thì mang quần áo, giày dép, đồ ăn, thức uống... nhập từ chợ đầu mối về bán cho bà con. Không khí mua bán tại đây mỗi ngày đều rất sôi động, ồn ã, tấp nập.</p><p>Thường chợ sẽ họp từ 4h sáng. Các thương lái đổ về đây rất sớm để mua hàng hóa với giá tốt từ người dân. Đến khoảng 6h là lúc chợ đông đúc nhất, người người nhà nhà đổ ra chợ mua sắm, đặc biệt là vào những ngày cuối tuần. Chợ nổi Ngã Năm bán gần như đầy đủ mọi thứ, mỗi thuyền sẽ cắm một cây cọc, trên cọc treo những mặt hàng mà họ bán để người mua dễ dàng nhận diện.</p><p>Giữa buổi sáng tinh sương, khi mặt trời còn chưa mọc, không khí tại đây đã vô cùng rộn rã. Bạn sẽ nghe tiếng người mua chào hàng, người bán trả giá, tiếng động cơ thuyền máy ầm ĩ, mọi thanh âm hòa vào nhau tạo nên không khí đặc trưng của chợ nổi.</p>', '<p>Theo kinh nghiệm đi chợ nổi Ngã Năm thì người dân thường bắt đầu buôn bán từ khá sớm khoảng 3 giờ sáng đã có rất đông ghe chở hàng hóa từ khắp các ngả sông đổ về chợ nổi Ngã Năm. Khúc sông Ngã Năm đang tĩnh lặng về đêm bỗng trở nên bừng bừng sức sống trong tiếng mua bán tấp nập và kéo dài đến tận trưa. Chợ đông đúc nhất là từ 5 đến 6 giờ với cảnh hàng trăm ghe thuyền tụ họp, huyên náo cả bến sông. Do đó, theo kinh nghiệm đi chợ nổi Ngã Năm thì đây cũng chính là khoảng thời gian lý tưởng nhất để trải nghiệm và khám phá nơi này. Vào những ngày thường thì có khoảng 200 ghe, xuồng lớn nhỏ mua bán tấp nập, nhưng vào dịp giáp Tết thì con số này có thể lên tới 400 chiếc. Và cũng vào dịp này, chợ nổi Ngã Năm hầu như hoạt động từ sáng đến tối khiến cho không khí nơi đây càng thêm sôi nổi</p>', '<p>Khi đến Chợ nổi Ngã Năm, bạn chắc chắn không thể bỏ lỡ những món ăn sáng thơm ngon. Chợ có nhiều ghe nhỏ bán đủ thứ từ cà phê, sinh tố, nước ép, thuốc lá, cơm tấm, hủ tiếu, bún nước lèo, bún xào v.v. Những lò than rực hồng, bên trên là nồi nước lèo bốc khói nghi ngút, mùi hương thơm lừng làm nên vẻ đẹp riêng của nơi đây.</p>', '<p>Nếu bạn muốn di chuyển từ Thành phố Hồ Chí Minh đến Sóc Trăng bằng xe khách thì chỉ cần ra bến xe Miền Tây ở 395 Kinh Dương Vương, An Lạc, Quận Bình Tân. Sau đó, bạn có thể dễ dàng mua vé xe đến thành phố Sóc Trăng với giá dao động trong khoảng từ 160.000 đến 200.000 VND/người, thời gian di chuyển khoảng 5 tiếng.</p><p>Ngoài xe khách, với những bạn trẻ thích khám phá và trải nghiệm thì phương tiện tự lái cũng là lựa chọn khá lý tưởng. Bạn có thể đi xe máy hoặc ô tô, di chuyển từ Thành phố Hồ Chí Minh theo tuyến đường tới cầu Cần Thơ. Ở đây, bạn rẽ trái và chạy thêm khoảng 67km nữa là sẽ tới thành phố Sóc Trăng.</p>', 'Phường 1, Thị xã Ngã Năm, Tỉnh Sóc Trăng', 9.56639690, 105.59720900, '0', 4, 4, '2025-05-23 17:37:07', '2025-05-23 17:37:07'),
(38, 'Vườn cò Tân Long', 'Miễn phí', '<p>Vườn cò Tân Long thuộc quyền sở hữu của gia đình ông Huỳnh Văn Mười, 73 tuổi. Ông Mười đã dành 30 năm cuộc đời mình để xây dựng và phát triển nên vườn cò này. Diện tích nơi đây rộng khoảng 1.5ha, xung quanh được che phủ bởi những hàng dừa và tre cao vút. Bên trong vườn cò là nơi những cây bụi, dây leo mọc xen kẽ nhau, tạo nên vẻ đẹp mộc mạc, chân quê mà cũng rất đỗi thân thương, gần gũi với con người miền Tây sông nước. Ông Mười cho xây một lối đi nhỏ, tráng xi măng sạch sẽ để khách đến tham quan có thể vào sâu bên trong vườn ngắm các loài chim sinh sống. Hai bên đường là những hàng cây tỏa bóng râm mát mẻ, vài bụi hoa dại lung linh trong nắng, bạn sẽ cảm nhận được sự tỉ mỉ, tâm huyết mà ông Mười dành cho sân chim này.</p><p>Ban đầu, theo lời ông Mười kể, vườn cò chỉ là một mảnh đất hoang. Gia đình ông cải tạo để đào ao nuôi cá trồng cây, phần diện tích lớn thì để cây bụi mọc lan tràn. Chim chóc đổ về đây sinh sống, ông Mười không đánh bắt mà cứ kệ chúng làm tổ, sinh sản, kiếm ăn một cách tự nhiên. Đất lành chim đậu, mấy chục năm trôi qua, giờ đây sân chim ngày nào của ông đã trở thành Vườn cò Tân Long khổng lồ, nổi tiếng gần xa. Các loài chim ở đây rất đa dạng, số lượng đông đảo nhất phải kể đến cò gà, cò trắng, cò bợ, cò đầu đỏ, cò cá, cò lạo xám, cò nhạn, cò quắm, cồng cộc, cò trâu, vạc diệc mốc. v.v.</p><p>Những năm gần đây, khi du lịch sinh thái trở thành xu hướng, Vườn cò Tân Long có cơ hội mở cửa để đón các đoàn khách vào tham quan. Mọi người đến đây đều rất thích thú với những loài chim kích thước lớn, sống trong môi trường tự nhiên nhưng rất hiền lành và dạn người. Theo gia đình ông Mười chia sẻ, vườn hiện đang có vài trăm cá thể diệc mốc, đây là loài chim quý hiếm với kích thước cao to, nặng đến trên 3kg cùng bộ lông màu xám nổi bật. Đến thăm vườn cò, bạn sẽ được ông Mười giới thiệu về những chú chim này và tập tính độc đáo của chúng.</p>', '<p>Thời điểm lý tưởng để tham quan vườn cò Tân Long ở Sóc Trăng là vào mùa khô, từ tháng 12 đến tháng 4. Lúc này, thời tiết khô ráo, nắng ấm, rất thích hợp để ngắm nhìn đàn cò trắng bay lượn trên bầu trời, đặc biệt là vào buổi sáng sớm hoặc chiều muộn. Tháng 4 là thời điểm lý tưởng nhất vì đây là lúc các loài cò và chim về đây sinh sản, tạo nên một khung cảnh tuyệt đẹp.&nbsp;</p>', '<p>Bên cạnh cơ hội du ngoạn, ngắm cảnh, khám phá và tìm hiểu về đời sống của các các loài chim, bạn sẽ còn được trải nghiệm khoảng thời gian lý tưởng với nhiều hoạt động thú vị tại Vườn cò Tân Long. Bạn có thể chuẩn bị lều trại, đồ ăn, đồ uống để picnic giữa không gian xanh mướt. Vườn cò mở cửa hoàn toàn miễn phí nên rất thích hợp với các bạn học sinh, sinh viên muốn có chuyến đi chơi cuối tuần thật tiết kiệm.&nbsp;</p><p>Bên cạnh đó, chủ vườn còn phục vụ menu đặc sản Sóc Trăng với những món ăn thơm ngon, hấp dẫn như bún mắm, bánh xèo, bún xào, bún nước lèo, gà nướng v.v. Các món ăn được chế biến theo phong vị chuẩn miền Tây chắc chắn sẽ là trải nghiệm ẩm thực đáng nhớ trong chuyến đi của bạn.</p>', '<p>Theo kinh nghiệm khám phá Sóc Trăng, để đến được Vườn cò Tân Long, trước hết bạn cần di chuyển tới Sóc Trăng. Với những bạn ở xa thì xe khách và máy bay sẽ là lựa chọn phù hợp. Còn nếu bạn đi từ TPHCM hoặc các tỉnh Nam Bộ thì có thể chọn phượt xe máy để có nhiều cơ hội khám phá những điều thú vị và mới mẻ hơn.&nbsp;</p><p>Sau khi đến Sóc Trăng, bạn tra Google Maps hoặc hỏi đường tới thị trấn Ngã Năm, thuộc huyện Ngã Năm, tỉnh Sóc Trăng. Từ đây, bạn đi dọc theo đường tỉnh lộ 42 khoảng 5km là sẽ tới được Vườn cò Tân Long. Con đường này một bên là con kênh xanh xanh, bên kia là cây cối tươi tốt, màu xanh mát mắt vô cùng thơ mộng. Tổng quãng đường di chuyển từ trung tâm thành phố Sóc Trăng tới đây là khoảng gần 50km, nếu không muốn đi xe tự lái thì xe khách cũng là lựa chọn hợp lý.</p><p>Bạn di chuyển đến bến xe nằm trên đường Lê Văn Tám để mua vé. Tại đây chuyên bán vé nội đô thành phố Sóc Trăng, bạn có thể nhờ nhân viên tư vấn để mua vé đến các điểm tham quan khác. Đi xe khách thì chi phí sẽ tiết kiệm và ngồi trên xe cũng ít mất sức hơn nhưng điểm dừng đỗ không linh hoạt nên bạn có thể cân nhắc để có sự lựa chọn phù hợp nhé.</p>', 'Xã Long Bình, Thị xã Ngã Năm, Tỉnh Sóc Trăng', 9.53953280, 105.64178050, '0', 4, 6, '2025-05-23 17:40:27', '2025-05-23 17:40:27'),
(39, 'Chùa La Hán', 'Miễn phí', '<p>Theo lời kể của những người cao tuổi ở địa phương và các ghi chép còn lưu lại, chùa La Hán được xây dựng từ năm 1952 do người Hoa vùng Triều Châu quản lý. Ban đầu, nơi đây chỉ là một gian nhà tranh đơn sơ với vách ván để thờ phụng các chư Phật, trong đó nổi bật nhất là hình ảnh của 18 vị La Hán. Cũng vì lẽ đó mà dần về sau, ngôi chùa thường được người dân trong vùng gọi theo các tượng Phật nên mới có tên như ngày nay. Lúc bấy giờ, đây là chốn tu tập của Phật tử và là địa điểm để bà con quanh xóm cầu nguyện cho mưa thuận gió hòa, làm ăn thuận lợi.</p><p>Khoảng 4 năm sau, tức vào năm 1956, chùa La Hán bị tàn phá nặng nề vì một cơn bão quét qua. Sau đó, người dân địa phương đã góp công sức để xây dựng lại ngôi chùa bằng gỗ và gạch ngói. Đến năm 1990, chùa La Hán đã được xây cất hoàn thiện, trở nên khang trang và kiên cố hơn rất nhiều nhờ công sức của Phật tử và bà con khắp nơi đóng góp. Hiện tại, ngôi chùa có thiết kế gồm một tầng trệt, một tầng lầu cùng với khuôn viên rộng lớn và xinh đẹp.</p><p>Chùa có khuôn viên rộng rãi với nhiều thiết kế độc đáo, trong đó ấn tượng nhất là hình long, lân, quy, phụng được bên cạnh ngọn núi Phổ Đà nhân tạo. Phần sân trước của chùa La Hán thờ tượng Phước Đức Lão Ông và Phật Bà Quan Âm. Ngoài ra, trong khuôn viên còn có vô số tiểu cảnh thiên nhiên làm tăng thêm nét thơ mộng cho ngôi cổ tự như ao sen, hồ rùa, đình miếu... Bên cạnh đó, các vật trang trí như đèn bát bửu, ngọc kỳ lân, tượng tạc hình rồng bay phượng múa cũng góp phần tô điểm cho cảnh quan tuyệt đẹp nơi đây.&nbsp;</p><p>Không chỉ có vậy, chùa La Hán còn mang điểm nhấn cực kỳ đặc biệt ở cách thiết kế các bức tường. Hầu hết những bức tường bao quanh chùa không làm bằng gỗ, bê tông và sơn màu vàng truyền thống mà lại xây nên từ đá tạo ấn tượng về sự vững chắc, bề thế. Thế nên nếu ngắm nhìn từ xa, ngôi chùa này trông giống hệt như một tòa lâu đài cổ tích xinh đẹp nằm giữa mảnh đất miền Tây thanh bình và trù phú.</p>', '<p>Vào mỗi dịp lễ lớn của nhà Phật, Ban Trị sự chùa La Hán đều tổ chức cúng kiến vô cùng trang trọng. Đặc biệt vào dịp Tết Nguyên Tiêu, chùa thường tổ chức lễ hội rước đèn, bửu tháp, bánh phước với ý nghĩa mang điều tốt lành đến cho mọi nhà và động viên tinh thần làm việc hăng hái trong năm. Vào ngày lễ Vu Lan (tháng 7 âm lịch), nhà chùa cũng tổ chức phát muối ăn và gạo trắng cho những hộ gia đình nghèo khó ở địa phương. Với tinh thần và nghĩa cử cao đẹp, Ban Trị sự chùa La Hán thường xuyên trích khoảng tiền nhang đèn từ thiện để mua gạo giúp người dân khó khăn, tài trợ cho nhà tình nghĩa, nhà tình thương, các quỹ vì người nghèo, quỹ khuyến học và mua đồ cứu trợ để phát cho những gia đình bị lũ lụt. Hằng năm, chùa La Hán còn thường xuyên hỗ trợ kinh phí cho trường bổ túc Dục Anh ở đường Mạc Đỉnh Chi, thành phố Sóc Trăng cũng như quỹ phúc lợi cho các giáo viên giảng dạy tại đây.&nbsp;</p>', '<p>1. Bánh ú mặn&nbsp;</p><p>Bánh ú mặn với những nguyên liệu để làm ra bánh gồm nếp, đậu phộng, nước cốt dừa, tôm khô, thịt heo, nấm đông cô, lạp xưởng và đặc biệt là lòng đỏ trứng vịt muối. Bánh thường được gói bằng lá chuối, dạng hình tam giác cân và buộc bằng dây lạc. Đến Sóc Trăng mà không thưởng thức bánh ú mặn, quả thật là điều đáng tiếc!</p><p>2. Mè láo</p><p>Mè láo là đặc sản nổi tiếng của người Hoa ở Sóc Trăng. Nó được làm từ khoai môn bào mỏng rồi đem phơi nắng khoảng 3 ngày. Khi chiên bánh, người ta cắt miếng khoai môn thành miếng hình chữ nhật rồi đem trộn với nước đường đã thắng thành kẹo, rồi lăn qua vừng và rang chín. Miếng bánh sẽ phình to ra sau khi chiên, do có chứa bột nếp. Nếu có dịp du lịch Sóc Trăng, bạn có thể mua mè láo làm quà tặng cho người thân và gia đình sau chuyến đi.</p><p>3. Bánh phồng tôm</p><p>Với thành phần nguyên liệu chính gồm bột mì, thịt tôm hoặc tép được xay nhuyễn với một ít hạt tiêu giã nhỏ. Các nguyên liệu trên sau khi trộn với nhau sẽ được nhồi vào những chiếc túi vải dạng hình ống dài. Sau khi hấp chín, người ta cắt ra từng lát hình chữ nhật hay tròn rồi đem phơi khô. Trước khi ăn, phải đem bánh chiên giòn với dầu ăn đã sôi lên, bánh sẽ nở to ra.</p><p>4. Bánh pía</p><p>Bánh pía là đặc sản Sóc Trăng ngon trứ danh, nổi tiếng khắp nơi và thường được nhiều du khách mua làm quà sau mỗi chuyến ghé thăm nơi đây. Từ thế kỉ 17, bánh pía ở Sóc Trăng đã theo chân những người Hán di cư đến phương Nam, Theo thời gian, bánh được chế biến cho phù hợp với khẩu vị của người Việt nhờ tận dụng nguồn nguyên liệu từ vùng đất Nam Bộ. Bánh pía có vỏ bánh mềm, bên trong gồm nhân đậu xanh, sầu riêng, trứng muối,… thơm ngon dễ “gây nghiện” với những tín đồ hảo ngọt.</p><p>5. Bánh cống</p><p>Bánh cống là món ăn <i>đặc sản Sóc Trăng </i>gây ấn tượng nhờ sự kết hợp giữa vị bùi của đậu xanh, ngọt từ tôm thịt cùng lớp vỏ giòn. Bánh có vỏ được làm từ bột gạo,&nbsp;bột đậu nành và trứng, còn nhân bánh là thịt heo băm ướp gia vị,&nbsp;trộn với củ hành tím xắt nhỏ và một ít đậu xanh hấp. Nhìn vẻ ngoài của bánh cống trông đẹp mắt và hấp dẫn. Bánh cống rất ngon khi ăn kèm với các loại rau sống như húng, xà lách, cải, gừng…</p>', '<p>Từ Thành phố Hồ Chí Minh, bạn cần di chuyển đến Sóc Trăng để tới viếng thăm chùa La Hán. Bạn có thể lựa chọn các phương tiện khác nhau như ô tô cá nhân, xe máy, xe khách tuỳ vào điều kiện hoặc tham khảo một số dịch vụ thuê xe. Sau khi tới thành phố Sóc Trăng, bạn tiếp tục di chuyển theo đường Tôn Đức Thắng rồi rẽ phải vào đường Đặng Văn Viễn. Tại đây, bạn đi qua một con hẻm nhỏ có tên xóm Cầu Đen thêm khoảng 200m nữa là sẽ đến nơi.&nbsp;</p>', 'Phường 8, Thành phố Sóc Trăng, Tỉnh Sóc Trăng', 9.60760740, 105.98094210, '0', 4, 7, '2025-05-23 17:46:00', '2025-05-23 17:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `destination_images`
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
-- Dumping data for table `destination_images`
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
(72, '1746716226-khu-du-lich-canh-dong-bat-tan-8-1024x678.webp', '/storage/destination_image/1746716226-khu-du-lich-canh-dong-bat-tan-8-1024x678.webp', '0', 8, '2025-05-08 14:57:06', '2025-05-08 14:57:06'),
(73, '1747143631-ao-ba-om.jpg', '/storage/destination_image/1747143631-ao-ba-om.jpg', '2', 11, '2025-05-13 13:40:32', '2025-05-13 13:40:32'),
(74, '1747143632-1b715c21-8b45-45e2-bf69-8cf1b115bbbc-chua-ong-metjpg.jpg', '/storage/destination_image/1747143632-1b715c21-8b45-45e2-bf69-8cf1b115bbbc-chua-ong-metjpg.jpg', '0', 11, '2025-05-13 13:40:32', '2025-05-13 13:40:32'),
(75, '1747143632-aobaom-1.jpg', '/storage/destination_image/1747143632-aobaom-1.jpg', '0', 11, '2025-05-13 13:40:32', '2025-05-13 13:40:32'),
(76, '1747143632-aobaom-6.jpg', '/storage/destination_image/1747143632-aobaom-6.jpg', '0', 11, '2025-05-13 13:40:32', '2025-05-13 13:40:32'),
(77, '1747143632-aobaom-8.jpg', '/storage/destination_image/1747143632-aobaom-8.jpg', '0', 11, '2025-05-13 13:40:32', '2025-05-13 13:40:32'),
(78, '1747314645-chua-ang-02-1700589047.jpg', '/storage/destination_image/1747314645-chua-ang-02-1700589047.jpg', '2', 12, '2025-05-15 13:10:45', '2025-05-15 13:10:45'),
(79, '1747314645-chua-ang-01-1700589047.jpg', '/storage/destination_image/1747314645-chua-ang-01-1700589047.jpg', '0', 12, '2025-05-15 13:10:45', '2025-05-15 13:10:45'),
(80, '1747314645-chuaang3-1.jpg', '/storage/destination_image/1747314645-chuaang3-1.jpg', '0', 12, '2025-05-15 13:10:45', '2025-05-15 13:10:45'),
(81, '1747314645-chua-ang-04-1700589047.jpg', '/storage/destination_image/1747314645-chua-ang-04-1700589047.jpg', '0', 12, '2025-05-15 13:10:45', '2025-05-15 13:10:45'),
(82, '1747314645-chua-ang-06-1700589040.jpg', '/storage/destination_image/1747314645-chua-ang-06-1700589040.jpg', '0', 12, '2025-05-15 13:10:45', '2025-05-15 13:10:45'),
(83, '1747316318-nha-tho-duc-ba-sai-gon-5-1733709376.jpg', '/storage/destination_image/1747316318-nha-tho-duc-ba-sai-gon-5-1733709376.jpg', '2', 13, '2025-05-15 13:38:38', '2025-05-15 13:38:38'),
(84, '1747316318-a926ac35-nha-tho-duc-ba-11-min.jpg', '/storage/destination_image/1747316318-a926ac35-nha-tho-duc-ba-11-min.jpg', '0', 13, '2025-05-15 13:38:38', '2025-05-15 13:38:38'),
(85, '1747316318-f5d8fc3e-nha-tho-duc-ba-thumbnail-min-1.jpg', '/storage/destination_image/1747316318-f5d8fc3e-nha-tho-duc-ba-thumbnail-min-1.jpg', '0', 13, '2025-05-15 13:38:38', '2025-05-15 13:38:38'),
(86, '1747316318-nha-tho-duc-ba-sai-gon-2-1736393709.jpg', '/storage/destination_image/1747316318-nha-tho-duc-ba-sai-gon-2-1736393709.jpg', '0', 13, '2025-05-15 13:38:38', '2025-05-15 13:38:38'),
(87, '1747316318-nha-tho-duc-ba-sai-gon-6-1733709375.jpg', '/storage/destination_image/1747316318-nha-tho-duc-ba-sai-gon-6-1733709375.jpg', '0', 13, '2025-05-15 13:38:38', '2025-05-15 13:38:38'),
(88, '1747316318-thanh-duong-nha-tho-duc-ba-sai-gon-1692570430.jpg', '/storage/destination_image/1747316318-thanh-duong-nha-tho-duc-ba-sai-gon-1692570430.jpg', '0', 13, '2025-05-15 13:38:38', '2025-05-15 13:38:38'),
(90, '1748011788-bien-tan-thanh-go-cong-0.jpg', '/storage/destination_image/1748011788-bien-tan-thanh-go-cong-0.jpg', '2', 17, '2025-05-23 14:49:48', '2025-05-23 14:49:48'),
(91, '1748011788-bientanthanh-1.jpg', '/storage/destination_image/1748011788-bientanthanh-1.jpg', '0', 17, '2025-05-23 14:49:48', '2025-05-23 14:49:48'),
(92, '1748011788-bien-tan-thanh-go-cong-1.jpg', '/storage/destination_image/1748011788-bien-tan-thanh-go-cong-1.jpg', '0', 17, '2025-05-23 14:49:48', '2025-05-23 14:49:48'),
(93, '1748011788-bien-tan-thanh-go-cong-3-min.jpg', '/storage/destination_image/1748011788-bien-tan-thanh-go-cong-3-min.jpg', '0', 17, '2025-05-23 14:49:48', '2025-05-23 14:49:48'),
(94, '1748011788-bien-tan-thanh-go-cong-7.jpg', '/storage/destination_image/1748011788-bien-tan-thanh-go-cong-7.jpg', '0', 17, '2025-05-23 14:49:48', '2025-05-23 14:49:48'),
(95, '1748011788-kinh-nghiem-du-lich-bien-tan-thanh-go-cong-tien-giang-day-du-202203240751282536.jpg', '/storage/destination_image/1748011788-kinh-nghiem-du-lich-bien-tan-thanh-go-cong-tien-giang-day-du-202203240751282536.jpg', '0', 17, '2025-05-23 14:49:48', '2025-05-23 14:49:48'),
(96, '1748011853-nhathocaibe2.jpg', '/storage/destination_image/1748011853-nhathocaibe2.jpg', '2', 18, '2025-05-23 14:50:53', '2025-05-23 14:50:53'),
(97, '1748011853-nhathocaibe1.jpg', '/storage/destination_image/1748011853-nhathocaibe1.jpg', '0', 18, '2025-05-23 14:50:53', '2025-05-23 14:50:53'),
(98, '1748011853-nhathocaibe3.jpg', '/storage/destination_image/1748011853-nhathocaibe3.jpg', '0', 18, '2025-05-23 14:50:53', '2025-05-23 14:50:53'),
(99, '1748011853-nhathocaibe4-1.jpg', '/storage/destination_image/1748011853-nhathocaibe4-1.jpg', '0', 18, '2025-05-23 14:50:53', '2025-05-23 14:50:53'),
(100, '1748011853-nhathocaibe5.jpg', '/storage/destination_image/1748011853-nhathocaibe5.jpg', '0', 18, '2025-05-23 14:50:53', '2025-05-23 14:50:53'),
(101, '1748011853-nhathocaibe9.jpg', '/storage/destination_image/1748011853-nhathocaibe9.jpg', '0', 18, '2025-05-23 14:50:53', '2025-05-23 14:50:53'),
(102, '1748013120-nha-tho-chanh-toa-my-tho-co-tuoi-doi-tram-nam-voi-ve-dep-yen-binh-5-1650972388.jpg', '/storage/destination_image/1748013120-nha-tho-chanh-toa-my-tho-co-tuoi-doi-tram-nam-voi-ve-dep-yen-binh-5-1650972388.jpg', '2', 19, '2025-05-23 15:12:00', '2025-05-23 15:12:00'),
(103, '1748013120-nha-tho-chanh-toa-my-tho-co-tuoi-doi-tram-nam-voi-ve-dep-yen-binh-4-1650972388.jpg', '/storage/destination_image/1748013120-nha-tho-chanh-toa-my-tho-co-tuoi-doi-tram-nam-voi-ve-dep-yen-binh-4-1650972388.jpg', '0', 19, '2025-05-23 15:12:00', '2025-05-23 15:12:00'),
(104, '1748013120-nha-tho-chanh-toa-my-tho-co-tuoi-doi-tram-nam-voi-ve-dep-yen-binh-6-1650972388.jpg', '/storage/destination_image/1748013120-nha-tho-chanh-toa-my-tho-co-tuoi-doi-tram-nam-voi-ve-dep-yen-binh-6-1650972388.jpg', '0', 19, '2025-05-23 15:12:00', '2025-05-23 15:12:00'),
(105, '1748013120-Nha-tho-chinh-toa-My-Tho-4.jpg', '/storage/destination_image/1748013120-Nha-tho-chinh-toa-My-Tho-4.jpg', '0', 19, '2025-05-23 15:12:00', '2025-05-23 15:12:00'),
(106, '1748013120-Nha-tho-chinh-toa-My-Tho-7-1170x785.jpg', '/storage/destination_image/1748013120-Nha-tho-chinh-toa-My-Tho-7-1170x785.jpg', '0', 19, '2025-05-23 15:12:00', '2025-05-23 15:12:00'),
(107, '1748013691-kham-pha-khong-gian-nam-bo-tai-lang-co-dong-hoa-hiep-tien-giang-1-1650992389.jpg', '/storage/destination_image/1748013691-kham-pha-khong-gian-nam-bo-tai-lang-co-dong-hoa-hiep-tien-giang-1-1650992389.jpg', '2', 20, '2025-05-23 15:21:31', '2025-05-23 15:21:31'),
(108, '1748013691-kham-pha-khong-gian-nam-bo-tai-lang-co-dong-hoa-hiep-tien-giang-2-1650992389.jpg', '/storage/destination_image/1748013691-kham-pha-khong-gian-nam-bo-tai-lang-co-dong-hoa-hiep-tien-giang-2-1650992389.jpg', '0', 20, '2025-05-23 15:21:31', '2025-05-23 15:21:31'),
(109, '1748013691-kham-pha-khong-gian-nam-bo-tai-lang-co-dong-hoa-hiep-tien-giang-4-1651231499.jpg', '/storage/destination_image/1748013691-kham-pha-khong-gian-nam-bo-tai-lang-co-dong-hoa-hiep-tien-giang-4-1651231499.jpg', '0', 20, '2025-05-23 15:21:31', '2025-05-23 15:21:31'),
(110, '1748013691-langcodonghoahiep.jpg', '/storage/destination_image/1748013691-langcodonghoahiep.jpg', '0', 20, '2025-05-23 15:21:31', '2025-05-23 15:21:31'),
(111, '1748013718-kham-pha-khong-gian-nam-bo-tai-lang-co-dong-hoa-hiep-tien-giang-5-1650992389.jpg', '/storage/destination_image/1748013718-kham-pha-khong-gian-nam-bo-tai-lang-co-dong-hoa-hiep-tien-giang-5-1650992389.jpg', '0', 20, '2025-05-23 15:21:58', '2025-05-23 15:21:58'),
(112, '1748014476-dia-diem-du-lich-dong-thap-4.webp', '/storage/destination_image/1748014476-dia-diem-du-lich-dong-thap-4.webp', '2', 21, '2025-05-23 15:34:36', '2025-05-23 15:34:36'),
(113, '1748014476-24d3e752a8046b5a3215_805332015.jpeg', '/storage/destination_image/1748014476-24d3e752a8046b5a3215_805332015.jpeg', '0', 21, '2025-05-23 15:34:36', '2025-05-23 15:34:36'),
(114, '1748014476-du-lich-lang-hoa-sa-dec-dong-thap.jpg', '/storage/destination_image/1748014476-du-lich-lang-hoa-sa-dec-dong-thap.jpg', '0', 21, '2025-05-23 15:34:36', '2025-05-23 15:34:36'),
(115, '1748014476-lang-hoa-sa-dec.jpg', '/storage/destination_image/1748014476-lang-hoa-sa-dec.jpg', '0', 21, '2025-05-23 15:34:36', '2025-05-23 15:34:36'),
(116, '1748014476-lang-hoa-sa-dec-dong-thap-la-cai-noi-cua-nghe-trong-hoa-kieng(1).jpg', '/storage/destination_image/1748014476-lang-hoa-sa-dec-dong-thap-la-cai-noi-cua-nghe-trong-hoa-kieng(1).jpg', '0', 21, '2025-05-23 15:34:36', '2025-05-23 15:34:36'),
(117, '1748014476-lang-hoa-sa-dec-o-dau-1024x640.jpg', '/storage/destination_image/1748014476-lang-hoa-sa-dec-o-dau-1024x640.jpg', '0', 21, '2025-05-23 15:34:36', '2025-05-23 15:34:36'),
(118, '1748014476-ve-dep-cua-lang-hoa-sa-dec-dong-thap(1).jpg', '/storage/destination_image/1748014476-ve-dep-cua-lang-hoa-sa-dec-dong-thap(1).jpg', '0', 21, '2025-05-23 15:34:36', '2025-05-23 15:34:36'),
(119, '1748014826-nhacohuynhthuyle-1.jpg', '/storage/destination_image/1748014826-nhacohuynhthuyle-1.jpg', '2', 22, '2025-05-23 15:40:26', '2025-05-23 15:40:26'),
(120, '1748014826-nhacohuynhthuyle.jpg', '/storage/destination_image/1748014826-nhacohuynhthuyle.jpg', '0', 22, '2025-05-23 15:40:26', '2025-05-23 15:40:26'),
(121, '1748014826-nha-co-huynh-thuy-le02.jpg', '/storage/destination_image/1748014826-nha-co-huynh-thuy-le02.jpg', '0', 22, '2025-05-23 15:40:26', '2025-05-23 15:40:26'),
(122, '1748014826-nha-co-huynh-thuy-le-5.webp', '/storage/destination_image/1748014826-nha-co-huynh-thuy-le-5.webp', '0', 22, '2025-05-23 15:40:26', '2025-05-23 15:40:26'),
(123, '1748014826-nha-co-huynh-thuy-le-06.jpg', '/storage/destination_image/1748014826-nha-co-huynh-thuy-le-06.jpg', '0', 22, '2025-05-23 15:40:26', '2025-05-23 15:40:26'),
(124, '1748014826-nha-co-huynh-thuy-le-7-1024x683.webp', '/storage/destination_image/1748014826-nha-co-huynh-thuy-le-7-1024x683.webp', '0', 22, '2025-05-23 15:40:26', '2025-05-23 15:40:26'),
(125, '1748016271-chua-la-sen-2-1024x576.webp', '/storage/destination_image/1748016271-chua-la-sen-2-1024x576.webp', '2', 23, '2025-05-23 16:04:31', '2025-05-23 16:04:31'),
(126, '1748016271-chua-la-sen-1-1024x576.webp', '/storage/destination_image/1748016271-chua-la-sen-1-1024x576.webp', '0', 23, '2025-05-23 16:04:31', '2025-05-23 16:04:31'),
(127, '1748016271-chua-la-sen-5.jpg', '/storage/destination_image/1748016271-chua-la-sen-5.jpg', '0', 23, '2025-05-23 16:04:31', '2025-05-23 16:04:31'),
(128, '1748016271-download (1).jpg', '/storage/destination_image/1748016271-download (1).jpg', '0', 23, '2025-05-23 16:04:31', '2025-05-23 16:04:31'),
(129, '1748016271-download.jpg', '/storage/destination_image/1748016271-download.jpg', '0', 23, '2025-05-23 16:04:31', '2025-05-23 16:04:31'),
(130, '1748016271-images.jpg', '/storage/destination_image/1748016271-images.jpg', '0', 23, '2025-05-23 16:04:31', '2025-05-23 16:04:31'),
(131, '1748016590-khu-du-lich-sinh-thai-dong-sen-thap-muoi-1.webp', '/storage/destination_image/1748016590-khu-du-lich-sinh-thai-dong-sen-thap-muoi-1.webp', '2', 24, '2025-05-23 16:09:50', '2025-05-23 16:09:50'),
(132, '1748016590-khu-du-lich-sinh-thai-dong-sen-thap-muoi-3.webp', '/storage/destination_image/1748016590-khu-du-lich-sinh-thai-dong-sen-thap-muoi-3.webp', '0', 24, '2025-05-23 16:09:50', '2025-05-23 16:09:50'),
(133, '1748016590-khu-du-lich-sinh-thai-dong-sen-thap-muoi-5.webp', '/storage/destination_image/1748016590-khu-du-lich-sinh-thai-dong-sen-thap-muoi-5.webp', '0', 24, '2025-05-23 16:09:50', '2025-05-23 16:09:50'),
(134, '1748016590-khu-du-lich-sinh-thai-dong-sen-thap-muoi-6.webp', '/storage/destination_image/1748016590-khu-du-lich-sinh-thai-dong-sen-thap-muoi-6.webp', '0', 24, '2025-05-23 16:09:50', '2025-05-23 16:09:50'),
(135, '1748016590-khu-du-lich-sinh-thai-dong-sen-thap-muoi-cover.webp', '/storage/destination_image/1748016590-khu-du-lich-sinh-thai-dong-sen-thap-muoi-cover.webp', '0', 24, '2025-05-23 16:09:50', '2025-05-23 16:09:50'),
(136, '1748016916-vuon-quoc-gia-tram-chim-dong-thap-7.jpg', '/storage/destination_image/1748016916-vuon-quoc-gia-tram-chim-dong-thap-7.jpg', '2', 25, '2025-05-23 16:15:16', '2025-05-23 16:15:16'),
(137, '1748016916-vuon-quoc-gia-tram-chim-1-1.jpg', '/storage/destination_image/1748016916-vuon-quoc-gia-tram-chim-1-1.jpg', '0', 25, '2025-05-23 16:15:16', '2025-05-23 16:15:16'),
(138, '1748016916-vuon-quoc-gia-tram-chim-2.jpg', '/storage/destination_image/1748016916-vuon-quoc-gia-tram-chim-2.jpg', '0', 25, '2025-05-23 16:15:16', '2025-05-23 16:15:16'),
(139, '1748016916-vuon-quoc-gia-tram-chim-2.webp', '/storage/destination_image/1748016916-vuon-quoc-gia-tram-chim-2.webp', '0', 25, '2025-05-23 16:15:16', '2025-05-23 16:15:16'),
(140, '1748016916-vuon-quoc-gia-tram-chim-3.jpg', '/storage/destination_image/1748016916-vuon-quoc-gia-tram-chim-3.jpg', '0', 25, '2025-05-23 16:15:16', '2025-05-23 16:15:16'),
(141, '1748016916-vuon-quoc-gia-tram-chim-7-1024x571.webp', '/storage/destination_image/1748016916-vuon-quoc-gia-tram-chim-7-1024x571.webp', '0', 25, '2025-05-23 16:15:16', '2025-05-23 16:15:16'),
(142, '1748016916-vuon-quoc-gia-tram-chim-dong-thap-3.jpg', '/storage/destination_image/1748016916-vuon-quoc-gia-tram-chim-dong-thap-3.jpg', '0', 25, '2025-05-23 16:15:16', '2025-05-23 16:15:16'),
(143, '1748017276-cho-noi-tra-on-net-van-hoa-giao-thuong-dac-sac-mien-cuu-long-02-1662643226.jpeg', '/storage/destination_image/1748017276-cho-noi-tra-on-net-van-hoa-giao-thuong-dac-sac-mien-cuu-long-02-1662643226.jpeg', '2', 26, '2025-05-23 16:21:16', '2025-05-23 16:21:16'),
(144, '1748017276-cho-noi-tra-on-net-van-hoa-giao-thuong-dac-sac-mien-cuu-long-01-1662643226.jpeg', '/storage/destination_image/1748017276-cho-noi-tra-on-net-van-hoa-giao-thuong-dac-sac-mien-cuu-long-01-1662643226.jpeg', '0', 26, '2025-05-23 16:21:16', '2025-05-23 16:21:16'),
(145, '1748017276-cho-noi-tra-on-net-van-hoa-giao-thuong-dac-sac-mien-cuu-long-05-1662643226.jpeg', '/storage/destination_image/1748017276-cho-noi-tra-on-net-van-hoa-giao-thuong-dac-sac-mien-cuu-long-05-1662643226.jpeg', '0', 26, '2025-05-23 16:21:16', '2025-05-23 16:21:16'),
(146, '1748017276-tra_on1_BongTrip_vn.jpg', '/storage/destination_image/1748017276-tra_on1_BongTrip_vn.jpg', '0', 26, '2025-05-23 16:21:16', '2025-05-23 16:21:16'),
(147, '1748017276-tra_on3_Bazan_Travel.jpg', '/storage/destination_image/1748017276-tra_on3_Bazan_Travel.jpg', '0', 26, '2025-05-23 16:21:16', '2025-05-23 16:21:16'),
(148, '1748017573-check-in-lo-gach-mang-thit-vinh-long-vuong-quoc-do-nam-canh-dong-song-co-chien-1-1662911129.jpeg', '/storage/destination_image/1748017573-check-in-lo-gach-mang-thit-vinh-long-vuong-quoc-do-nam-canh-dong-song-co-chien-1-1662911129.jpeg', '2', 27, '2025-05-23 16:26:13', '2025-05-23 16:26:13'),
(149, '1748017573-check-in-lo-gach-mang-thit-vinh-long-vuong-quoc-do-nam-canh-dong-song-co-chien-3-1662911129.jpeg', '/storage/destination_image/1748017573-check-in-lo-gach-mang-thit-vinh-long-vuong-quoc-do-nam-canh-dong-song-co-chien-3-1662911129.jpeg', '0', 27, '2025-05-23 16:26:13', '2025-05-23 16:26:13'),
(150, '1748017573-check-in-lo-gach-mang-thit-vinh-long-vuong-quoc-do-nam-canh-dong-song-co-chien-4-1662911129.jpeg', '/storage/destination_image/1748017573-check-in-lo-gach-mang-thit-vinh-long-vuong-quoc-do-nam-canh-dong-song-co-chien-4-1662911129.jpeg', '0', 27, '2025-05-23 16:26:13', '2025-05-23 16:26:13'),
(151, '1748017573-check-in-lo-gach-mang-thit-vinh-long-vuong-quoc-do-nam-canh-dong-song-co-chien-5-1662911129.jpeg', '/storage/destination_image/1748017573-check-in-lo-gach-mang-thit-vinh-long-vuong-quoc-do-nam-canh-dong-song-co-chien-5-1662911129.jpeg', '0', 27, '2025-05-23 16:26:13', '2025-05-23 16:26:13'),
(152, '1748017573-check-in-lo-gach-mang-thit-vinh-long-vuong-quoc-do-nam-canh-dong-song-co-chien-6-1662911129.jpeg', '/storage/destination_image/1748017573-check-in-lo-gach-mang-thit-vinh-long-vuong-quoc-do-nam-canh-dong-song-co-chien-6-1662911129.jpeg', '0', 27, '2025-05-23 16:26:13', '2025-05-23 16:26:13'),
(153, '1748017984-chua-phat-ngoc-xa-loi-vinh-long-chon-thanh-tinh-ban-nen-ghe-tham-2-1662989919.jpeg', '/storage/destination_image/1748017984-chua-phat-ngoc-xa-loi-vinh-long-chon-thanh-tinh-ban-nen-ghe-tham-2-1662989919.jpeg', '2', 28, '2025-05-23 16:33:04', '2025-05-23 16:33:04'),
(154, '1748017984-chua-phat-ngoc-xa-loi-vinh-long-chon-thanh-tinh-ban-nen-ghe-tham-1-1662989919.jpeg', '/storage/destination_image/1748017984-chua-phat-ngoc-xa-loi-vinh-long-chon-thanh-tinh-ban-nen-ghe-tham-1-1662989919.jpeg', '0', 28, '2025-05-23 16:33:04', '2025-05-23 16:33:04'),
(155, '1748017984-chua-phat-ngoc-xa-loi-vinh-long-chon-thanh-tinh-ban-nen-ghe-tham-3-1662989919.jpeg', '/storage/destination_image/1748017984-chua-phat-ngoc-xa-loi-vinh-long-chon-thanh-tinh-ban-nen-ghe-tham-3-1662989919.jpeg', '0', 28, '2025-05-23 16:33:04', '2025-05-23 16:33:04'),
(156, '1748017984-chua-phat-ngoc-xa-loi-vinh-long-chon-thanh-tinh-ban-nen-ghe-tham-4-1662989918.jpeg', '/storage/destination_image/1748017984-chua-phat-ngoc-xa-loi-vinh-long-chon-thanh-tinh-ban-nen-ghe-tham-4-1662989918.jpeg', '0', 28, '2025-05-23 16:33:04', '2025-05-23 16:33:04'),
(157, '1748017984-chua-phat-ngoc-xa-loi-vinh-long-chon-thanh-tinh-ban-nen-ghe-tham-6-1662989918.jpeg', '/storage/destination_image/1748017984-chua-phat-ngoc-xa-loi-vinh-long-chon-thanh-tinh-ban-nen-ghe-tham-6-1662989918.jpeg', '0', 28, '2025-05-23 16:33:04', '2025-05-23 16:33:04'),
(158, '1748018409-chua-ong-that-phu-mieu-vinh-long-cong-trinh-kien-truc-doc-dao-cua-nguoi-hoa-2-1662305153.jpeg', '/storage/destination_image/1748018409-chua-ong-that-phu-mieu-vinh-long-cong-trinh-kien-truc-doc-dao-cua-nguoi-hoa-2-1662305153.jpeg', '2', 29, '2025-05-23 16:40:09', '2025-05-23 16:40:09'),
(159, '1748018409-chua_ong_that_phu_mieu_vinh_long_thamhiemmekong_2.jpg', '/storage/destination_image/1748018409-chua_ong_that_phu_mieu_vinh_long_thamhiemmekong_2.jpg', '0', 29, '2025-05-23 16:40:09', '2025-05-23 16:40:09'),
(160, '1748018409-chua-ong-that-phu-mieu-vinh-long-cong-trinh-kien-truc-doc-dao-cua-nguoi-hoa-3-1662305153.jpeg', '/storage/destination_image/1748018409-chua-ong-that-phu-mieu-vinh-long-cong-trinh-kien-truc-doc-dao-cua-nguoi-hoa-3-1662305153.jpeg', '0', 29, '2025-05-23 16:40:09', '2025-05-23 16:40:09'),
(161, '1748018409-chua-ong-that-phu-mieu-vinh-long-cong-trinh-kien-truc-doc-dao-cua-nguoi-hoa-6-1662305153.jpeg', '/storage/destination_image/1748018409-chua-ong-that-phu-mieu-vinh-long-cong-trinh-kien-truc-doc-dao-cua-nguoi-hoa-6-1662305153.jpeg', '0', 29, '2025-05-23 16:40:09', '2025-05-23 16:40:09'),
(162, '1748018409-Screenshot 2024-12-20 213412.png', '/storage/destination_image/1748018409-Screenshot 2024-12-20 213412.png', '0', 29, '2025-05-23 16:40:09', '2025-05-23 16:40:09'),
(163, '1748018853-bien-ba-dong-dia-diem-thu-hut-dong-dao-khach-du-lich-tai-tra-vinh.jpg', '/storage/destination_image/1748018853-bien-ba-dong-dia-diem-thu-hut-dong-dao-khach-du-lich-tai-tra-vinh.jpg', '2', 30, '2025-05-23 16:47:33', '2025-05-23 16:47:33'),
(164, '1748018853-badong1.jpg', '/storage/destination_image/1748018853-badong1.jpg', '0', 30, '2025-05-23 16:47:33', '2025-05-23 16:47:33'),
(165, '1748018853-bien-ba-dong-2-1024x576.webp', '/storage/destination_image/1748018853-bien-ba-dong-2-1024x576.webp', '0', 30, '2025-05-23 16:47:33', '2025-05-23 16:47:33'),
(166, '1748018853-bien-ba-dong-3-1024x654.webp', '/storage/destination_image/1748018853-bien-ba-dong-3-1024x654.webp', '0', 30, '2025-05-23 16:47:33', '2025-05-23 16:47:33'),
(167, '1748018854-bien-ba-dong-6.webp', '/storage/destination_image/1748018854-bien-ba-dong-6.webp', '0', 30, '2025-05-23 16:47:34', '2025-05-23 16:47:34'),
(168, '1748018854-bien-ba-dong-9-822x1024.webp', '/storage/destination_image/1748018854-bien-ba-dong-9-822x1024.webp', '0', 30, '2025-05-23 16:47:34', '2025-05-23 16:47:34'),
(169, '1748019276-den-tho-bac-tra-vinh-tu-tren-cao-1705917255.jpg', '/storage/destination_image/1748019276-den-tho-bac-tra-vinh-tu-tren-cao-1705917255.jpg', '2', 31, '2025-05-23 16:54:36', '2025-05-23 16:54:36'),
(170, '1748019276-0aab38b2e28320dd7992-2048x1365.jpg', '/storage/destination_image/1748019276-0aab38b2e28320dd7992-2048x1365.jpg', '0', 31, '2025-05-23 16:54:36', '2025-05-23 16:54:36'),
(171, '1748019276-6f16f20a4f3b8d65d42a-2048x1365.jpg', '/storage/destination_image/1748019276-6f16f20a4f3b8d65d42a-2048x1365.jpg', '0', 31, '2025-05-23 16:54:36', '2025-05-23 16:54:36'),
(172, '1748019276-605a0a3db40c76522f1d-2048x1365.jpg', '/storage/destination_image/1748019276-605a0a3db40c76522f1d-2048x1365.jpg', '0', 31, '2025-05-23 16:54:36', '2025-05-23 16:54:36'),
(173, '1748019276-f9ba6ec9d3f811a648e9-2048x1536.jpg', '/storage/destination_image/1748019276-f9ba6ec9d3f811a648e9-2048x1536.jpg', '0', 31, '2025-05-23 16:54:36', '2025-05-23 16:54:36'),
(174, '1748019894-nga-bay-hau-giang-1141.jpg', '/storage/destination_image/1748019894-nga-bay-hau-giang-1141.jpg', '2', 32, '2025-05-23 17:04:54', '2025-05-23 17:04:54'),
(175, '1748019894-cho-noi-cai-be.png', '/storage/destination_image/1748019894-cho-noi-cai-be.png', '0', 32, '2025-05-23 17:04:54', '2025-05-23 17:04:54'),
(176, '1748019894-cho-noi-nga-bay.jpg', '/storage/destination_image/1748019894-cho-noi-nga-bay.jpg', '0', 32, '2025-05-23 17:04:54', '2025-05-23 17:04:54'),
(177, '1748019894-cho-noi-nga-bay-la-noi-giao-thoa-cua-7-dong-song.jpg', '/storage/destination_image/1748019894-cho-noi-nga-bay-la-noi-giao-thoa-cua-7-dong-song.jpg', '0', 32, '2025-05-23 17:04:54', '2025-05-23 17:04:54'),
(178, '1748019894-net-van-hoa-dac-sac.jpg', '/storage/destination_image/1748019894-net-van-hoa-dac-sac.jpg', '0', 32, '2025-05-23 17:04:54', '2025-05-23 17:04:54'),
(179, '1748020882-diem-qua-2-dia-diem-du-lich-vi-thuy-hau-giang-duoc-ua-chuong-202311152236089892.jpg', '/storage/destination_image/1748020882-diem-qua-2-dia-diem-du-lich-vi-thuy-hau-giang-duoc-ua-chuong-202311152236089892.jpg', '2', 33, '2025-05-23 17:21:22', '2025-05-23 17:21:22'),
(180, '1748020882-di-giua-mien-tram.jpg', '/storage/destination_image/1748020882-di-giua-mien-tram.jpg', '0', 33, '2025-05-23 17:21:22', '2025-05-23 17:21:22'),
(181, '1748020882-khu_bao_ton_lung_ngoc_hoang_du_lich_thu_duc_5.jpg', '/storage/destination_image/1748020882-khu_bao_ton_lung_ngoc_hoang_du_lich_thu_duc_5.jpg', '0', 33, '2025-05-23 17:21:22', '2025-05-23 17:21:22'),
(182, '1748020882-khu_sinh_thai_rung_tram_chim_vi_thuy_du_lich_thu_duc_2.jpg', '/storage/destination_image/1748020882-khu_sinh_thai_rung_tram_chim_vi_thuy_du_lich_thu_duc_2.jpg', '0', 33, '2025-05-23 17:21:22', '2025-05-23 17:21:22'),
(183, '1748020882-khu_sinh_thai_rung_tram_chim_vi_thuy_du_lich_thu_duc_3.jpg', '/storage/destination_image/1748020882-khu_sinh_thai_rung_tram_chim_vi_thuy_du_lich_thu_duc_3.jpg', '0', 33, '2025-05-23 17:21:22', '2025-05-23 17:21:22'),
(184, '1748020882-rungtramvithuy-2.jpg', '/storage/destination_image/1748020882-rungtramvithuy-2.jpg', '0', 33, '2025-05-23 17:21:22', '2025-05-23 17:21:22'),
(185, '1748020882-Screenshot 2024-12-20 214154.png', '/storage/destination_image/1748020882-Screenshot 2024-12-20 214154.png', '0', 33, '2025-05-23 17:21:22', '2025-05-23 17:21:22'),
(186, '1748020904-2.-Thien-Vien-Truc-Lam-nguon-csdl.vietnamtourism.gov_.vn_-1.jpg', '/storage/destination_image/1748020904-2.-Thien-Vien-Truc-Lam-nguon-csdl.vietnamtourism.gov_.vn_-1.jpg', '2', 34, '2025-05-23 17:21:44', '2025-05-23 17:21:44'),
(187, '1748020904-20.-Thien-Vien-Truc-Lam-nguon-vi.worldcombiz.com_.jpg', '/storage/destination_image/1748020904-20.-Thien-Vien-Truc-Lam-nguon-vi.worldcombiz.com_.jpg', '0', 34, '2025-05-23 17:21:44', '2025-05-23 17:21:44'),
(188, '1748020904-screenshot_1729776474_351530299.png', '/storage/destination_image/1748020904-screenshot_1729776474_351530299.png', '0', 34, '2025-05-23 17:21:44', '2025-05-23 17:21:44'),
(189, '1748020904-thienvientruclamhaugiang.jpg', '/storage/destination_image/1748020904-thienvientruclamhaugiang.jpg', '0', 34, '2025-05-23 17:21:44', '2025-05-23 17:21:44'),
(190, '1748020904-thienvientruclamhaugiang2.jpg', '/storage/destination_image/1748020904-thienvientruclamhaugiang2.jpg', '0', 34, '2025-05-23 17:21:44', '2025-05-23 17:21:44'),
(191, '1748020904-thienvientruclamhaugiang3.jpg', '/storage/destination_image/1748020904-thienvientruclamhaugiang3.jpg', '0', 34, '2025-05-23 17:21:44', '2025-05-23 17:21:44'),
(192, '1748021125-conduongtre.jpg', '/storage/destination_image/1748021125-conduongtre.jpg', '2', 35, '2025-05-23 17:25:25', '2025-05-23 17:25:25'),
(193, '1748021125-z6150389067900_16e06b479d696125647b39f29dabdbc9.jpg', '/storage/destination_image/1748021125-z6150389067900_16e06b479d696125647b39f29dabdbc9.jpg', '0', 35, '2025-05-23 17:25:25', '2025-05-23 17:25:25'),
(194, '1748021125-z6150389067939_2a3101767d1b27975b13e4e34d276b9d.jpg', '/storage/destination_image/1748021125-z6150389067939_2a3101767d1b27975b13e4e34d276b9d.jpg', '0', 35, '2025-05-23 17:25:25', '2025-05-23 17:25:25'),
(195, '1748021125-z6150389068035_e8336a396eff71d0d9f6fe299fbb63e7.jpg', '/storage/destination_image/1748021125-z6150389068035_e8336a396eff71d0d9f6fe299fbb63e7.jpg', '0', 35, '2025-05-23 17:25:25', '2025-05-23 17:25:25'),
(196, '1748021125-z6150389068036_90de1e4a9deec6e62698a211fdf5b2bb.jpg', '/storage/destination_image/1748021125-z6150389068036_90de1e4a9deec6e62698a211fdf5b2bb.jpg', '0', 35, '2025-05-23 17:25:25', '2025-05-23 17:25:25'),
(197, '1748021559-chua-doi-nemtv-03.jpg', '/storage/destination_image/1748021559-chua-doi-nemtv-03.jpg', '2', 36, '2025-05-23 17:32:39', '2025-05-23 17:32:39'),
(198, '1748021559-chua-doi-st.png', '/storage/destination_image/1748021559-chua-doi-st.png', '0', 36, '2025-05-23 17:32:39', '2025-05-23 17:32:39'),
(199, '1748021559-Den-chua-Doi-o-Soc-Trang-tim-loi-giai-bi-an-ngan-nam-h2.jpg', '/storage/destination_image/1748021559-Den-chua-Doi-o-Soc-Trang-tim-loi-giai-bi-an-ngan-nam-h2.jpg', '0', 36, '2025-05-23 17:32:39', '2025-05-23 17:32:39'),
(200, '1748021559-kham-pha-chua-doi-400-nam-tuoi-doc-dao-tai-soc-trang-1-1664928914.jpg', '/storage/destination_image/1748021559-kham-pha-chua-doi-400-nam-tuoi-doc-dao-tai-soc-trang-1-1664928914.jpg', '0', 36, '2025-05-23 17:32:39', '2025-05-23 17:32:39'),
(201, '1748021559-kham-pha-chua-doi-400-nam-tuoi-doc-dao-tai-soc-trang-3-1664928915.jpg', '/storage/destination_image/1748021559-kham-pha-chua-doi-400-nam-tuoi-doc-dao-tai-soc-trang-3-1664928915.jpg', '0', 36, '2025-05-23 17:32:39', '2025-05-23 17:32:39'),
(202, '1748021559-kham-pha-chua-doi-400-nam-tuoi-doc-dao-tai-soc-trang-4-1664928915.jpg', '/storage/destination_image/1748021559-kham-pha-chua-doi-400-nam-tuoi-doc-dao-tai-soc-trang-4-1664928915.jpg', '0', 36, '2025-05-23 17:32:39', '2025-05-23 17:32:39'),
(203, '1748021559-Roi-1-01.jpg', '/storage/destination_image/1748021559-Roi-1-01.jpg', '0', 36, '2025-05-23 17:32:39', '2025-05-23 17:32:39'),
(204, '1748021840-chonoinganam.jpg', '/storage/destination_image/1748021840-chonoinganam.jpg', '2', 37, '2025-05-23 17:37:20', '2025-05-23 17:37:20'),
(205, '1748021840-chonoinganam-1-1.jpg', '/storage/destination_image/1748021840-chonoinganam-1-1.jpg', '0', 37, '2025-05-23 17:37:20', '2025-05-23 17:37:20'),
(206, '1748021840-chonoinganam-2.jpg', '/storage/destination_image/1748021840-chonoinganam-2.jpg', '0', 37, '2025-05-23 17:37:20', '2025-05-23 17:37:20'),
(207, '1748021840-chonoinganam-3.jpg', '/storage/destination_image/1748021840-chonoinganam-3.jpg', '0', 37, '2025-05-23 17:37:20', '2025-05-23 17:37:20'),
(208, '1748021840-chonoinganam4.jpg', '/storage/destination_image/1748021840-chonoinganam4.jpg', '0', 37, '2025-05-23 17:37:20', '2025-05-23 17:37:20'),
(209, '1748022049-khu-vuon-rong-2-ha.jpg', '/storage/destination_image/1748022049-khu-vuon-rong-2-ha.jpg', '2', 38, '2025-05-23 17:40:49', '2025-05-23 17:40:49'),
(210, '1748022049-ghe-tham-vuon-co-tan-long-kham-pha-thien-nhien-thanh-binh-tru-phu-1-1666136227.jpg', '/storage/destination_image/1748022049-ghe-tham-vuon-co-tan-long-kham-pha-thien-nhien-thanh-binh-tru-phu-1-1666136227.jpg', '0', 38, '2025-05-23 17:40:49', '2025-05-23 17:40:49'),
(211, '1748022049-ghe-tham-vuon-co-tan-long-kham-pha-thien-nhien-thanh-binh-tru-phu-4-1666136227.jpg', '/storage/destination_image/1748022049-ghe-tham-vuon-co-tan-long-kham-pha-thien-nhien-thanh-binh-tru-phu-4-1666136227.jpg', '0', 38, '2025-05-23 17:40:49', '2025-05-23 17:40:49'),
(212, '1748022049-ghe-tham-vuon-co-tan-long-kham-pha-thien-nhien-thanh-binh-tru-phu-cover-1666136227.jpg', '/storage/destination_image/1748022049-ghe-tham-vuon-co-tan-long-kham-pha-thien-nhien-thanh-binh-tru-phu-cover-1666136227.jpg', '0', 38, '2025-05-23 17:40:49', '2025-05-23 17:40:49'),
(213, '1748022049-tung-dan-co-trang-muot.jpg', '/storage/destination_image/1748022049-tung-dan-co-trang-muot.jpg', '0', 38, '2025-05-23 17:40:49', '2025-05-23 17:40:49'),
(214, '1748022403-chua-la-han-diem-den-tam-linh-dep-tua-co-tich-tai-soc-trang-04-1664443304.jpeg', '/storage/destination_image/1748022403-chua-la-han-diem-den-tam-linh-dep-tua-co-tich-tai-soc-trang-04-1664443304.jpeg', '2', 39, '2025-05-23 17:46:43', '2025-05-23 17:46:43'),
(215, '1748022403-9af74c16e6b43bea62a5_11055224032023.jpg', '/storage/destination_image/1748022403-9af74c16e6b43bea62a5_11055224032023.jpg', '0', 39, '2025-05-23 17:46:43', '2025-05-23 17:46:43'),
(216, '1748022403-chua-la-han-diem-den-tam-linh-dep-tua-co-tich-tai-soc-trang-01-1664443303.jpeg', '/storage/destination_image/1748022403-chua-la-han-diem-den-tam-linh-dep-tua-co-tich-tai-soc-trang-01-1664443303.jpeg', '0', 39, '2025-05-23 17:46:43', '2025-05-23 17:46:43'),
(217, '1748022403-chua-la-han-diem-den-tam-linh-dep-tua-co-tich-tai-soc-trang-05-1664443304.jpeg', '/storage/destination_image/1748022403-chua-la-han-diem-den-tam-linh-dep-tua-co-tich-tai-soc-trang-05-1664443304.jpeg', '0', 39, '2025-05-23 17:46:43', '2025-05-23 17:46:43'),
(218, '1748022403-photo-1-1647331350964979122023.webp', '/storage/destination_image/1748022403-photo-1-1647331350964979122023.webp', '0', 39, '2025-05-23 17:46:43', '2025-05-23 17:46:43');

-- --------------------------------------------------------

--
-- Table structure for table `destination_utilities`
--

CREATE TABLE `destination_utilities` (
  `destination_id` int UNSIGNED NOT NULL,
  `utility_id` int UNSIGNED NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quality` int DEFAULT NULL,
  `distance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destination_utilities`
--

INSERT INTO `destination_utilities` (`destination_id`, `utility_id`, `status`, `quality`, `distance`) VALUES
(13, 33, NULL, NULL, 0.115137),
(13, 34, 'nearby', NULL, 0.98336),
(18, 27, 'nearby', NULL, 0),
(18, 29, 'nearby', NULL, 0),
(18, 31, 'nearby', NULL, 0),
(23, 27, 'nearby', NULL, 0),
(23, 29, 'nearby', NULL, 0),
(23, 31, 'nearby', NULL, 0),
(26, 27, 'nearby', NULL, 0),
(26, 29, 'nearby', NULL, 0),
(26, 31, 'nearby', NULL, 0),
(28, 27, 'nearby', NULL, 0),
(28, 29, 'nearby', NULL, 0),
(28, 31, 'nearby', NULL, 0),
(32, 27, 'nearby', NULL, 0),
(32, 29, 'nearby', NULL, 0),
(32, 31, 'nearby', NULL, 0),
(33, 27, 'nearby', NULL, 0),
(33, 29, 'nearby', NULL, 0),
(33, 31, 'nearby', NULL, 0),
(35, 27, 'nearby', NULL, 0),
(35, 29, 'nearby', NULL, 0),
(35, 31, 'nearby', NULL, 0),
(38, 27, 'nearby', NULL, 0),
(38, 29, 'nearby', NULL, 0),
(38, 31, 'nearby', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `follows`
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
-- Table structure for table `likes`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
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
-- Table structure for table `missions`
--

CREATE TABLE `missions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `points_reward` int DEFAULT NULL,
  `condition_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condition_value` int DEFAULT NULL,
  `frequency` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `badge_id` int UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `missions`
--

INSERT INTO `missions` (`id`, `name`, `description`, `points_reward`, `condition_type`, `condition_value`, `frequency`, `start_date`, `end_date`, `badge_id`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Thích một bài viết mỗi ngày', 'Thả tim một bài viết bất kỳ mỗi ngày', 5, 'like', 1, 'daily', '2025-05-20 20:04:00', NULL, 9, 0, '2025-05-19 13:04:10', '2025-05-19 13:47:25'),
(7, 'Bình luận đầu tiên hôm nay', 'Đăng một bình luận chất lượng trong ngày hôm nay', 7, 'comment', 1, 'daily', '2025-05-20 20:05:00', NULL, 10, 0, '2025-05-19 13:05:08', '2025-05-19 13:47:37'),
(8, 'Chia sẻ bài viết mỗi ngày', 'Viết một bài chia sẻ mới mỗi ngày', 10, 'post', 1, 'daily', '2025-05-20 20:07:00', NULL, 11, 0, '2025-05-19 13:07:39', '2025-05-19 13:47:47'),
(9, 'Thả 10 lượt thích trong tuần', 'Bày tỏ cảm xúc với ít nhất 10 bài viết trong tuần', 15, 'like', 10, 'weekly', '2025-05-20 20:13:00', NULL, 12, 0, '2025-05-19 13:13:09', '2025-05-19 13:15:36'),
(10, 'Bình luận 20 lần trong tuần', 'Đăng 20 bình luận trong tuần, góp phần vào cuộc trò chuyện', 20, 'comment', 20, 'weekly', '2025-05-20 20:14:00', NULL, 13, 0, '2025-05-19 13:14:36', '2025-05-19 13:14:36'),
(11, 'Đăng 2 bài viết trong tuần', 'Viết ít nhất 2 bài chia sẻ mới trong tuần', 20, 'post', 2, 'weekly', '2025-05-20 20:16:00', NULL, 14, 0, '2025-05-19 13:16:26', '2025-05-19 13:16:26'),
(12, 'Thả 30 lượt thích trong tháng', 'Bày tỏ cảm xúc với ít nhất 30 bài viết trong tháng', 30, 'like', 30, 'monthly', '2025-05-20 20:17:00', NULL, 15, 0, '2025-05-19 13:17:29', '2025-05-19 13:17:29'),
(13, 'Bình luận 20 lần trong tháng', 'Tham gia thảo luận bằng cách bình luận 20 lần trở lên trong tháng', 40, 'comment', 20, 'monthly', '2025-05-20 20:18:00', NULL, 16, 0, '2025-05-19 13:18:04', '2025-05-19 13:18:04'),
(14, 'Đăng 5 bài viết chia sẻ trong tháng', 'Viết ít nhất 5 bài viết chia sẻ kinh nghiệm du lịch trong tháng', 25, 'post', 5, 'monthly', '2025-05-20 20:18:00', NULL, 17, 0, '2025-05-19 13:18:44', '2025-05-19 13:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `posts`
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
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_hours` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utility_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
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
-- Table structure for table `reports`
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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Quản trị', '2025-05-04 01:29:51', '2025-05-04 01:29:51'),
(3, 'Người dùng', '2025-05-04 01:30:01', '2025-05-04 01:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `shares`
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
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(5, '1747491171.jpg', '0', '2025-05-17 14:12:52', '2025-05-17 14:12:52'),
(6, '1747491228.jpg', '0', '2025-05-17 14:13:48', '2025-05-17 14:13:48'),
(7, '1747491263.jpg', '0', '2025-05-17 14:14:23', '2025-05-17 14:14:23'),
(9, '1747491381.jpg', '0', '2025-05-17 14:16:21', '2025-05-17 14:16:21'),
(10, '1747491411.jpg', '0', '2025-05-17 14:16:51', '2025-05-17 14:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `travel_types`
--

CREATE TABLE `travel_types` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `travel_types`
--

INSERT INTO `travel_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Du lịch làng nghề truyền thống', '0', '2025-05-04 01:03:20', '2025-05-08 10:53:59'),
(3, 'Du lịch nghỉ dưỡng', '0', '2025-05-04 01:03:33', '2025-05-04 01:03:33'),
(4, 'Du lịch văn hóa', '0', '2025-05-04 04:32:25', '2025-05-04 04:32:25'),
(6, 'Du lịch sinh thái', '0', '2025-05-08 10:53:26', '2025-05-08 10:53:26'),
(7, 'Du lịch tâm linh', '0', '2025-05-08 10:53:35', '2025-05-17 14:23:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `description`, `user_rank`, `status`, `role_id`, `created_at`, `updated_at`) VALUES
(3, 'nhudiep', 'nhudiep@gmail.com', '$2y$12$nQMyNPNqN87cY.6aI/jSXuEtVYpAljlpr5wuWJgQVo1qOVhKs0Tne', '1746716932.jpg', NULL, 0, '0', 3, '2025-05-04 01:41:29', '2025-05-08 15:08:52'),
(4, 'admin', 'admin@gmail.com', '$2y$12$MyKYKCyx9ZJ8tnj4NNQzW.fnCoX1xneuUPPjlob9VN5afgtpkXaCa', '1746716717.jpg', NULL, 0, '0', 2, '2025-05-04 01:42:35', '2025-05-08 15:05:17'),
(13, 'NhuDiep', 'nhinhi@gmail.com', '$2y$12$5YXurp1ympMG/uXy8pQNK.GWO2uOX6ELYg0CwQCnXPWa2AuWaFuve', NULL, NULL, 0, '0', 3, '2025-05-19 16:17:52', '2025-05-19 16:17:52'),
(21, 'Nga Diep', 'dieptunga25@gmail.com', '$2y$12$0wvVyqIdn0zpgZ9Gikt8Aeu1xSVxebueoieLRXMYpcWoAS7mPasma', 'https://lh3.googleusercontent.com/a/ACg8ocK9owzB-JhcQcFNDhjZkwmY5LSePsRKXpwKCPc9jDkVqyKc-w=s96-c', NULL, 0, '0', 3, '2025-05-21 13:31:55', '2025-05-21 13:31:55'),
(22, 'linh nguyễn', 'nguyenlinh200409@gmail.com', '$2y$12$NL4r..xfEzcQMiq8m9GQf.vq8m3BYQOiI/fbFqSbd1c0qViT5yE6O', 'https://lh3.googleusercontent.com/a/ACg8ocLurUr84nggrd5E_I6-3UBvRJwAH_-awCMB4dd3YBRQA97GyTU=s96-c', NULL, 0, '0', 3, '2025-05-21 13:32:38', '2025-05-21 13:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_missions`
--

CREATE TABLE `user_missions` (
  `user_id` int UNSIGNED NOT NULL,
  `mission_id` int UNSIGNED NOT NULL,
  `completion_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utilities`
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
-- Dumping data for table `utilities`
--

INSERT INTO `utilities` (`id`, `name`, `price`, `address`, `latitude`, `longitude`, `distance`, `time`, `image`, `status`, `description`, `utility_type_id`, `created_at`, `updated_at`) VALUES
(27, 'Khách Sạn Làng Nổi Tân Lập', 'Trung bình mỗi đêm khoảng 560.000VNĐ/phòng', 'Xã Tân Lập, Huyện Mộc Hóa, Tỉnh Long An', NULL, NULL, NULL, '24/7', '1746705831.webp', '0', '<p>Khách Sạn Làng Nổi Tân Lập cao 8 tầng với 32 phòng, được đặt tại vị trí ấn tượng trên một hòn đảo ven sông Rạch Rừng, nằm bên trong khu du lịch. Nếu bạn thích ngắm cảnh của rừng nổi Tân Lập vào mỗi thời khắc trong ngày thì đây sẽ là lựa chọn lý tưởng nhất.&nbsp;</p>', 13, '2025-05-08 12:01:49', '2025-05-15 14:03:04'),
(28, 'Phú Thắng Grand Hotel', 'Có nhiều loại phòng giá dao động từ 230.000VNĐ đến 2.700.000VNĐ', 'Xã Đức Hòa Hạ, Huyện Đức Hòa, Tỉnh Long An', 51.50000000, 10.50000000, NULL, '24/7', '1746706640.webp', '0', '<p>Khách Sạn Phú Thắng Grand là một khách sạn sang trọng và hiện đại, nằm ở khu công nghiệp Tân Đức - Long An, cách Làng Nổi Tân Lập chỉ 30,5km nên rất thuận tiện cho việc du chuyển. Khách sạn có 3 hạng phòng tốt nhất là Grand Deluxe, Grand Premier và Grand Executive vô cùng sang trọng cho bạn tự do lựa chọn cùng một số tiện ích hấp dẫn kèm theo.</p>', 13, '2025-05-08 12:17:20', '2025-05-15 14:02:55'),
(29, 'The Island Lodge Thoi Son', 'Có nhiều loại phòng giá dao động từ 4.000.000VNĐ đến 6.000.000VNĐ', 'Xã Thới Sơn, Thành phố Mỹ Tho, Tỉnh Tiền Giang', NULL, NULL, NULL, '24/7', '1746707083.webp', '0', '<p>The Island Lodge Mỹ Tho là một khách sạn nằm ở Tiền Giang, cách Làng Nổi Tân Lập 26,3km. Với thiết kế theo phong cách kiến trúc cổ điển, khách sạn tạo ra một không gian yên tĩnh, gần gũi với thiên nhiên. Khách sạn có phòng nghỉ sang trọng, được trang bị đầy đủ tiện nghi hiện đại, cùng với một số hoạt động giải trí và dịch vụ như hồ bơi, spa, nhà hàng và bar.</p>', 13, '2025-05-08 12:24:43', '2025-05-15 14:02:45'),
(30, 'Khách sạn Ruby', 'Dao động từ 300.000VNĐ đến 1.300.000VNĐ', 'Thị trấn Bến Lức, Huyện Bến Lức, Tỉnh Long An', 10.63987920, 106.49937440, NULL, '24/7', '1746714353.jpg', '0', '<p>Khách sạn Ruby&nbsp;là một nhà nghỉ khách sạn được thiết kế với 32&nbsp;phòng có kích cỡ khác nhau phù hợp với nhiều nhu cầu của khách hàng. Hệ thống thiết bị hiện đại, điều hòa, tivi, bàn ghế được làm từ gỗ, sóng wifi và các các dịch vụ đưa đón khách tham quan các điểm du lịch. Được thiết kế và trang trí theo phong cách cổ điển nhưng không kém phần&nbsp;sang trọng và quý phái. Các trang thiết bị và phòng ốc của nhà nghỉ - khách sạn rất tiện nghi và hiện đại nhằm mang lại sự hài lòng và thoải mái cho khách hàng trong suốt thời gian lưu trú tại phòng khách sạn. Với vị trí thuận lợi, RuBy là nơi khách hàng lựa chọn dừng chân và nghỉ dưỡng lý tưởng nhất&nbsp;tại Long An</p>', 13, '2025-05-08 14:25:53', '2025-05-15 14:02:29'),
(31, 'Bich Ngoan Hotel', 'Từ 617.284 VND/đêm', 'Phường 1, Thành phố Trà Vinh, Tỉnh Trà Vinh', NULL, NULL, NULL, '24/7', '1746964363.webp', '0', '<p>Bich Ngoan Hotel là lựa chọn lý tưởng cho du khách khi đến với thành phố Trà Vinh, mang đến không gian nghỉ dưỡng hiện đại và tiện nghi. Là khách sạn đạt chuẩn 2 sao, nơi đây nổi bật với thiết kế sang trọng trong từng đường nét, phong cách phục vụ chuyên nghiệp và tận tâm. Tất cả các phòng đều được trang bị đầy đủ tiện nghi hiện đại cùng nội thất cao cấp, đảm bảo mang đến sự thoải mái tối đa cho du khách trong suốt kỳ nghỉ.</p><p>Ngoài ra, Bich Ngoan Hotel còn cung cấp nhiều tiện ích hấp dẫn như hồ bơi ngoài trời để thư giãn, nhà hàng sang trọng phục vụ ẩm thực địa phương và quốc tế, cùng phòng gym hiện đại dành cho những ai yêu thích thể thao. Với sự kết hợp hoàn hảo giữa vị trí thuận tiện, tiện ích đẳng cấp và dịch vụ chất lượng, nơi đây hứa hẹn sẽ mang đến cho du khách trải nghiệm lưu trú đáng nhớ khi ghé thăm Ao Bà Om.</p>', 13, '2025-05-11 11:52:44', '2025-05-15 14:02:13'),
(33, 'Khách sạn Rex Hotel Saigon', 'Dao động từ 2.000.000VNĐ đến 6.000.000 VNĐ', 'Phường Bến Nghé, Quận 1, Thành phố Hồ Chí Minh', 10.78069000, 106.69944000, NULL, '24/7', '1747317602.jpg', '0', '<p>Hãy để chuyến đi của quý khách có một khởi đầu tuyệt vời khi ở lại khách sạn này, nơi có Wi-Fi miễn phí trong tất cả các phòng. Nằm ở vị trí chiến lược tại Quận 1, cho phép quý khách lui tới và gần với các điểm thu hút và tham quan địa phương. Đừng rời đi trước khi ghé thăm Bảo tàng Chứng tích chiến tranh nổi tiếng. Được xếp hạng 5 sao, chỗ nghỉ chất lượng cao này cho phép khách nghỉ sử dụng mát-xa, bể bơi ngoài trời và bồn tắm nước nóng ngay trong khuôn viên.</p>', 13, '2025-05-14 16:01:22', '2025-05-15 14:01:41'),
(34, 'Anan Saigon', '2.000.000 VND - 5.000.000 VND', 'Phường Bến Nghé, Quận 1, Thành phố Hồ Chí Minh', 10.77180320, 106.70297480, NULL, '17:00 - 23:00', '1747319912.jpg', '0', '<p>Anan Saigon là nhà hàng ẩm thực Việt hiện đại do đầu bếp Peter Cuong Franklin sáng lập, tọa lạc tại 89 Tôn Thất Đạm, Quận 1, TP.HCM. Nhà hàng nổi bật với việc nâng tầm món ăn đường phố Việt Nam bằng kỹ thuật nấu ăn tinh tế. Nơi đây đã được trao 1 sao Michelin và nằm trong top 50 nhà hàng tốt nhất châu Á năm 2024. Các món đặc trưng gồm bánh mì Wagyu, chả giò gan ngỗng, và cá chiên nghệ. Không gian hiện đại, phù hợp cho trải nghiệm ẩm thực cao cấp.</p>', 14, '2025-05-15 14:38:32', '2025-05-15 14:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `utility_types`
--

CREATE TABLE `utility_types` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `utility_types`
--

INSERT INTO `utility_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(13, 'Lưu trú', '0', '2025-05-08 10:55:29', '2025-05-08 10:55:29'),
(14, 'Ẩm thực', '0', '2025-05-08 10:55:50', '2025-05-08 10:55:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_parent_comment_id_foreign` (`parent_comment_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destinations_user_id_foreign` (`user_id`),
  ADD KEY `destinations_travel_type_id_foreign` (`travel_type_id`);

--
-- Indexes for table `destination_images`
--
ALTER TABLE `destination_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destination_images_destination_id_foreign` (`destination_id`);

--
-- Indexes for table `destination_utilities`
--
ALTER TABLE `destination_utilities`
  ADD PRIMARY KEY (`destination_id`,`utility_id`),
  ADD KEY `destination_utilities_utility_id_foreign` (`utility_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follows_follower_id_foreign` (`follower_id`),
  ADD KEY `follows_following_id_foreign` (`following_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_post_id_foreign` (`post_id`),
  ADD KEY `likes_comment_id_foreign` (`comment_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `missions_badge_id_foreign` (`badge_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_destination_id_foreign` (`destination_id`),
  ADD KEY `posts_utility_id_foreign` (`utility_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_user_id_foreign` (`user_id`),
  ADD KEY `ratings_post_id_foreign` (`post_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_user_id_foreign` (`user_id`),
  ADD KEY `reports_post_id_foreign` (`post_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shares_user_id_foreign` (`user_id`),
  ADD KEY `shares_post_id_foreign` (`post_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel_types`
--
ALTER TABLE `travel_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_missions`
--
ALTER TABLE `user_missions`
  ADD PRIMARY KEY (`user_id`,`mission_id`),
  ADD KEY `user_missions_mission_id_foreign` (`mission_id`);

--
-- Indexes for table `utilities`
--
ALTER TABLE `utilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilities_utility_type_id_foreign` (`utility_type_id`);

--
-- Indexes for table `utility_types`
--
ALTER TABLE `utility_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `destination_images`
--
ALTER TABLE `destination_images`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `missions`
--
ALTER TABLE `missions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `travel_types`
--
ALTER TABLE `travel_types`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `utilities`
--
ALTER TABLE `utilities`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `utility_types`
--
ALTER TABLE `utility_types`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_parent_comment_id_foreign` FOREIGN KEY (`parent_comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `destinations`
--
ALTER TABLE `destinations`
  ADD CONSTRAINT `destinations_travel_type_id_foreign` FOREIGN KEY (`travel_type_id`) REFERENCES `travel_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `destinations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `destination_images`
--
ALTER TABLE `destination_images`
  ADD CONSTRAINT `destination_images_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `destination_utilities`
--
ALTER TABLE `destination_utilities`
  ADD CONSTRAINT `destination_utilities_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `destination_utilities_utility_id_foreign` FOREIGN KEY (`utility_id`) REFERENCES `utilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_follower_id_foreign` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `follows_following_id_foreign` FOREIGN KEY (`following_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `missions`
--
ALTER TABLE `missions`
  ADD CONSTRAINT `missions_badge_id_foreign` FOREIGN KEY (`badge_id`) REFERENCES `badges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_utility_id_foreign` FOREIGN KEY (`utility_id`) REFERENCES `utilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shares`
--
ALTER TABLE `shares`
  ADD CONSTRAINT `shares_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shares_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_missions`
--
ALTER TABLE `user_missions`
  ADD CONSTRAINT `user_missions_mission_id_foreign` FOREIGN KEY (`mission_id`) REFERENCES `missions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_missions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `utilities`
--
ALTER TABLE `utilities`
  ADD CONSTRAINT `utilities_utility_type_id_foreign` FOREIGN KEY (`utility_type_id`) REFERENCES `utility_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
