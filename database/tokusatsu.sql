-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 17, 2026 lúc 02:52 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tokusatsu`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `category_name`, `description`) VALUES
(1, 'Kamen Rider', 'Movies about the Masked Riders'),
(2, 'Super Sentai', 'Movies about the Super Sentai team'),
(3, 'Ultraman', 'Movies about the Giant of Light');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `films`
--

CREATE TABLE `films` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `films`
--

INSERT INTO `films` (`id`, `title`, `description`, `images`, `user_id`, `category_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 'No.1 Sentai Gozyuger – Chiến đội Số 1 Gozyuger', 'A new generation of heroes rises as the “Number One” team, fighting powerful enemies to prove their strength and unity.', 'SG.png', 1, 2, '2026-03-21 05:44:00', '2026-04-10 18:59:56', 'approved'),
(2, 'Kamen Rider OOO – Hiệp Sĩ Mặt Nạ OOO', 'A wandering young man gains the power of OOO and battles the Greeed—monsters born from human desire—while learning the true meaning of greed and selflessness.', 'ooo.png', 1, 1, '2026-03-21 05:44:00', '2026-04-10 18:59:56', 'approved'),
(3, 'Kamen Rider W – Hiệp Sĩ hai trong một', 'Two detectives share one body to become Kamen Rider W, solving mysteries and fighting Dopants in a city filled with hidden crimes.', 'w.png', 1, 1, '2026-03-21 05:44:00', '2026-04-10 18:59:56', 'approved'),
(4, 'Kamen Rider Dragon Knight – Siêu nhân Hiệp sĩ Rồng', 'A young man enters a parallel dimension and becomes a Rider to fight monsters and uncover the truth behind his missing father.', 'ryuki.png', 1, 1, '2026-03-21 05:44:00', '2026-04-10 20:01:11', 'approved'),
(5, 'Kamen Rider Ghost – Hiệp Sĩ Mặt Nạ Ghost', 'After dying, a boy is revived as Ghost and must collect heroic spirits within a time limit to regain his life.', 'ghost.png', 1, 1, '2026-03-21 05:44:00', '2026-04-10 18:59:56', 'approved'),
(6, 'Kamen Rider Kuuga – Hiệp SĨ Mặt Nạ Kuuga', 'A kind-hearted man becomes Kuuga to protect humanity from the deadly Gurongi tribe in a grounded and emotional battle.', 'kuuga.png', 1, 1, '2026-03-21 05:44:00', '2026-04-10 18:59:56', 'approved'),
(7, 'Kamen Rider Kiva – Hiệp Sĩ Mặt Nạ Kiva', 'A lonely violinist transforms into Kiva, fighting monsters known as Fangire while uncovering secrets tied to his past and his father.', 'kiva.png', 1, 1, '2026-03-21 05:44:00', '2026-04-10 18:59:56', 'approved'),
(8, 'Kamen Rider Kabuto – Hiệp Sĩ Mặt Nạ Kabuto', 'A confident warrior fights shape-shifting aliens called Worms using super speed, walking his own path as the strongest Rider.', 'kabuto.png', 1, 1, '2026-03-21 05:44:00', '2026-04-10 18:59:56', 'approved'),
(9, 'Kamen Rider Den-O – Hiệp Sĩ Mặt Nạ Den-O', 'A timid man partners with time-traveling Imagin to protect the timeline from being altered by enemies from the future.', 'den-O.png', 1, 1, '2026-03-21 05:44:00', '2026-04-10 18:59:56', 'approved'),
(10, 'Kamen Rider Decade - Hiệp Sĩ Mặt Nạ Decade', 'A traveler journeys across parallel Rider worlds, risking their destruction as he searches for his true identity.', 'decade.png', 1, 1, '2026-03-21 05:44:00', '2026-04-10 18:59:56', 'approved'),
(11, 'Kamen Rider Build – Hiệp Sĩ Mặt Nạ Build', 'A genius physicist with lost memories fights in a divided nation, uncovering a conspiracy behind the power of the Riders.', 'build.png', 1, 1, '2026-03-21 05:44:00', '2026-04-10 18:59:56', 'approved'),
(12, 'Kamen Rider Wizard – Hiệp Sĩ Mặt Nạ Wizard', 'A magician Rider protects people from Phantoms—creatures born from despair—while keeping hope alive in a dark world.', '17.png', 1, 1, '2026-03-21 05:44:00', '2026-04-10 20:00:57', 'approved'),
(13, 'Kyoryu Sentai Zyuranger – Chiến Đội Khủng Long Zyuranger', 'Ancient warriors awaken to battle the evil witch Bandora using the power of dinosaurs to save Earth.', 'zyuranger.png', 1, 2, '2026-03-21 05:44:00', '2026-04-10 18:59:56', 'approved'),
(14, 'Mirai Sentai Timeranger – Chiến Đội Du Hành Thời Gian Timeranger', 'Time travelers from the future chase criminals into the past, learning about destiny and changing fate.', 'timeranger.png', 1, 2, '2026-03-21 05:44:00', '2026-04-10 18:59:56', 'approved'),
(15, 'Samurai Sentai Shinkenger – Chiến Đội Samurai Shinkenger', 'Samurai warriors protect the world from demons emerging from another realm, bound by duty and honor.', '25.png', 1, 2, '2026-03-21 05:44:00', '2026-04-10 20:08:14', 'approved'),
(16, 'Kaizoku Sentai Gokaiger – Chiến Đội Hải Tặc Gokaiger', 'Space pirates search for the ultimate treasure while gaining the power of past Sentai teams to fight an evil empire.', '21.png', 1, 2, '2026-03-21 05:44:00', '2026-04-10 20:05:40', 'approved'),
(17, 'Avataro Sentai Donbrothers – Chiến Đội Đào Tử Donbrothers', 'A chaotic team of heroes battles monsters born from human desires in a story full of humor and emotional twists.', '23.png', 1, 2, '2026-03-21 05:44:00', '2026-04-10 19:58:53', 'approved'),
(18, 'Ultraman Tiga – Siêu Nhân Điện Quang Tiga', 'An ancient giant of light awakens to defend humanity from darkness and inspire hope in a modern world.', 'tiga.png', 1, 3, '2026-03-21 05:44:00', '2026-04-10 18:59:56', 'approved'),
(19, 'Ultraman Dyna – Siêu Nhân Điện Quang Dyna', 'A cheerful hero protects Earth from cosmic threats while exploring the mysteries of space and humanity’s future.', 'dyna.png', 1, 3, '2026-03-21 05:44:00', '2026-04-10 18:59:56', 'approved'),
(20, 'Ultraman Gaia – Siêu Nhân Điện Quang Gaia', 'Two opposing Ultramen represent Earth and the sea, clashing over how to protect the planet from destruction.', 'gaia.png', 1, 3, '2026-03-21 05:44:00', '2026-04-10 18:59:56', 'approved'),
(21, 'Ultraman Mebius – Siêu Nhân Điện Quang Mebius', 'A young Ultraman learns about humanity while fighting alongside a defense team to protect Earth.', 'mebius.png', 1, 3, '2026-03-21 05:44:00', '2026-04-10 18:59:56', 'approved'),
(22, 'Ultraman Zero - Siêu Nhân Điện Quang Zero', 'First appeared in Mega Monster Battle: Ultra Galaxy Legends (2009). He is the son of Ultraseven. He has a cool, confident personality, sometimes arrogant but always righteous. He was once exiled for breaking the rules but later redeemed himself and became one of the strongest Ultramen. He uses the Zero Slugger as his weapon and has the ability to travel across different universes. He also serves as a mentor to many Ultramen, including Ultraman Z. In short, he is a veteran hero with top-tier power.\r\n\r\nA rookie Ultraman partners with a human host to battle monsters and grow into a true hero.', 'zero.png', 1, 3, '2026-03-21 05:44:00', '2026-04-10 19:11:26', 'approved'),
(75, 'Ultraman Z (Ultraman Zett)', 'Appeared in Ultraman Z (2020). He is a disciple of Ultraman Zero. He has an enthusiastic personality, sometimes a bit clumsy, but very sincere. The story follows his journey alongside a human partner (Haruki), fighting monsters and gradually growing into a true Ultraman. His special feature is using the Z Riser and Medals to transform, with multiple forms such as Alpha Edge and Delta Rise Claw. In short, he is a young warrior in the process of maturing.', '15.png', 1, 3, '2026-04-10 19:09:39', '2026-04-10 19:59:27', 'approved'),
(76, 'Ultraman Geed', 'Appeared in Ultraman Geed (2017). He is the son of the infamous villain Ultraman Belial. He has a kind personality and constantly strives to overcome his dark origins. The story focuses on his struggle to prove that he is not evil despite his lineage. He uses the Fusion Rise system to combine the powers of other Ultramen, with his notable form being Royal Mega Master. In short, he is a character who represents “the son of a villain who chooses to become a hero.”', '16.png', 1, 3, '2026-04-10 19:13:43', '2026-04-10 19:59:58', 'approved'),
(77, 'Mahou Sentai Magiranger (Chiến Đội Phép Thuật Magiranger)', 'Appeared in Mahou Sentai Magiranger (2005). The story follows a family of five siblings who inherit magical powers from their mother, a legendary sorceress. Each member becomes a Magiranger, using elemental magic to fight against the forces of darkness from the Infershia realm. Throughout the series, they not only battle powerful enemies but also grow stronger through the bonds of family and courage. The team uses magical transformation devices and can combine their powers into stronger forms. In short, it is a story about family, magic, and unity in the fight against evil.', '18.png', 1, 2, '2026-04-10 19:19:32', '2026-04-10 20:00:23', 'approved'),
(78, 'Kishiryu Sentai Ryusoulger (Chiến đội linh hồn khủng long)', 'A team of noble knights harnesses the power of ancient dinosaurs to protect Earth from the evil Druidon tribe. Using mystical Ryusoul items and powerful Kishiryu mecha, they fight to preserve peace while upholding the code of chivalry and courage.', '20.png', 1, 2, '2026-04-10 19:35:28', '2026-04-10 20:00:38', 'approved'),
(79, 'Tokusou Sentai Dekaranger (Lực lượng đặc nhiệm S.P.D)', 'A special police team known as S.P.D. (Special Police Dekaranger) protects Earth from alien criminals. Each member is trained to investigate, track, and eliminate threats from space, using advanced technology, teamwork, and a strong sense of justice to maintain peace across the galaxy.', '22.png', 1, 2, '2026-04-10 19:45:28', '2026-04-10 20:00:10', 'approved'),
(80, 'Power Rangers Jungle Fury (Chiến đội Quyền Thú)', 'A group of skilled martial artists trains under the ancient Pai Zhua order to master the power of animal spirits. When the evil Dai Shi is unleashed, they become Jungle Fury Rangers and use their abilities to protect the world from darkness. Through intense training, discipline, and teamwork, they unlock new powers and forms while facing powerful enemies and learning the true meaning of strength and balance.', '24.png', 1, 2, '2026-04-10 20:04:35', '2026-04-10 20:05:06', 'approved'),
(90, 'Ultraman Cosmos', 'The story follows Musashi Haruno, a kind-hearted young man who encounters Ultraman Cosmos, a giant being of light who values peace over destruction. After forming a bond with Cosmos, Musashi becomes his human partner and works with the defense team EYES (Elite Young Experts Squad).\r\n\r\nTogether, they face various alien creatures and monsters, but instead of simply defeating them, Cosmos often tries to calm, heal, or relocate these beings. Throughout the series, Musashi learns important lessons about coexistence, empathy, and protecting life in all forms, while confronting threats that challenge his ideals of peace.', '1776210981_26.png', 1, 3, '2026-04-14 23:56:21', '2026-04-14 23:56:21', 'approved');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_message` text NOT NULL,
  `admin_reply` text DEFAULT NULL,
  `status` enum('pending','seen','replied') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) DEFAULT 0 COMMENT '0 = User thường, 1 = Admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `avatar` varchar(255) DEFAULT 'default_avatar.jpg',
  `bio` text DEFAULT NULL,
  `favorite_genre` varchar(100) DEFAULT NULL,
  `status` enum('active','on_break') DEFAULT 'active',
  `credibility_score` int(11) DEFAULT 0,
  `badge` varchar(50) DEFAULT 'Newbie',
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `avatar`, `bio`, `favorite_genre`, `status`, `credibility_score`, `badge`, `is_deleted`) VALUES
(1, 'Admin', 'admin@tokusatsu.com', '$2y$10$q8I/p9LMolHZzTFU/V3gQO6wRHH6Ts.yIQ3Fw4rwP3Hmez7uJ2XH2', 1, '2026-03-12 05:00:00', '2026-04-17 00:52:13', '', '', '', 'active', 9999, 'Administrator', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `film_id` (`film_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `films`
--
ALTER TABLE `films`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `films_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `films_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
