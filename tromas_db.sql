-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 15, 2022 at 12:23 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phponline_radix`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT '0',
  `category_id` int DEFAULT '0',
  `duplicate` int DEFAULT '0',
  `content` text COLLATE utf8mb4_unicode_ci,
  `view_count` int DEFAULT '0',
  `thumbnail` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `popular` tinyint NOT NULL DEFAULT '0' COMMENT '0: Không nổi bật 1: Nổi bật	',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `user_id`, `category_id`, `duplicate`, `content`, `view_count`, `thumbnail`, `description`, `popular`, `create_at`, `update_at`) VALUES
(2, '10 Tips for Growing Your Business', '10-tips-for-growing-your-business', 7, 4, 9, '&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;Awesome Design&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;img alt=&#34;#&#34; src=&#34;/online_php/module06/radix/uploads/images/Products/blog2.jpg&#34; /&#62;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;blockquote&#62;Do what you love to do and give it your very best. Whether it&#38;#39;s business or baseball, or the theater, or any field. If you don&#38;#39;t love what you&#38;#39;re doing and you can&#38;#39;t give it your best, get out of it. Life is too short. You&#38;#39;ll be an old man before you know it.&#60;/blockquote&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words&#60;/p&#62;&#13;&#10;', 711, '/tromas/uploads/files/blog1.jpg', 'Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised', 0, '2022-10-27 21:36:43', '2022-11-15 07:14:11'),
(7, 'Amazing Multipage &#38; Onepage', 'amazing-multipage--onepage', 7, 5, 4, '&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised&#60;/p&#62;&#13;&#10;', 8, '/tromas/uploads/files/blog2.jpg', 'Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised', 1, '2022-11-01 22:28:55', '2022-11-15 07:14:26'),
(8, 'How to start online business', 'how-to-start-online-business', 8, 2, 3, '&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised&#60;/p&#62;&#13;&#10;', 6, '/tromas/uploads/files/blog3.jpg', 'Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised', 0, '2022-11-01 22:29:16', '2022-11-15 07:14:03'),
(9, 'Top 10 Tips For Growing Business', 'top-10-tips-for-growing-business', 8, 4, 3, '&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised&#60;/p&#62;&#13;&#10;', 10, '/tromas/uploads/files/blog1.jpg', 'Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised', 1, '2022-11-03 18:38:02', '2022-11-15 07:13:56'),
(10, 'Awesome Vimeo Video Song Ever', 'awesome-vimeo-video-song-ever', 8, 4, 4, '&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised&#60;/p&#62;&#13;&#10;', 12, '/tromas/uploads/files/blog1.jpg', 'Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised', 0, '2022-11-03 18:38:05', '2022-11-15 07:13:43'),
(11, 'What Makes Us Best In The World?', 'what-makes-us-best-in-the-world', 8, 4, 5, '&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised&#60;/p&#62;&#13;&#10;', 4, '/tromas/uploads/files/blog1.jpg', 'Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised', 1, '2022-11-03 18:38:06', '2022-11-15 07:13:35'),
(12, 'Tips For Success In 2017', 'tips-for-success-in-2017', 8, 5, 3, '&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised&#60;/p&#62;&#13;&#10;', 6, '/online_php/module06/tromas/uploads/files/blog2.jpg', 'Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised', 1, '2022-11-03 18:38:07', '2022-11-11 16:48:30'),
(14, 'Đánh bại Sài Gòn FC, SHB Đà Nẵng trụ hạng thành công tại V-League', 'danh-bai-sai-gon-fc-shb-da-nang-tru-hang-thanh-cong-tai-v-league', 8, 4, 6, '&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;Awesome Design&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;img alt=&#34;#&#34; src=&#34;/online_php/module06/radix/uploads/images/Products/blog2.jpg&#34; /&#62;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;blockquote&#62;Do what you love to do and give it your very best. Whether it&#38;#39;s business or baseball, or the theater, or any field. If you don&#38;#39;t love what you&#38;#39;re doing and you can&#38;#39;t give it your best, get out of it. Life is too short. You&#38;#39;ll be an old man before you know it.&#60;/blockquote&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words&#60;/p&#62;&#13;&#10;', 30, '/tromas/uploads/files/blog1.jpg', 'Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised', 1, '2022-11-03 20:11:58', '2022-11-15 07:13:26'),
(15, 'Vì sao Thái Lan chưa công bố bản quyền truyền thông World Cup 2022?', 'vi-sao-thai-lan-chua-cong-bo-ban-quyen-truyen-thong-world-cup-2022', 8, 4, 7, '&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;Awesome Design&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;img alt=&#34;#&#34; src=&#34;/online_php/module06/radix/uploads/images/Products/blog2.jpg&#34; /&#62;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;blockquote&#62;Do what you love to do and give it your very best. Whether it&#38;#39;s business or baseball, or the theater, or any field. If you don&#38;#39;t love what you&#38;#39;re doing and you can&#38;#39;t give it your best, get out of it. Life is too short. You&#38;#39;ll be an old man before you know it.&#60;/blockquote&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words&#60;/p&#62;&#13;&#10;', 205, '/tromas/uploads/files/blog3.jpg', 'Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised', 0, '2022-11-03 20:12:01', '2022-11-15 07:13:15'),
(16, 'Vượt qua Messi, Mbappe đi vào lịch sử Champions League', 'vuot-qua-messi-mbappe-di-vao-lich-su-champions-league', 8, 4, 8, '&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;Awesome Design&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;img alt=&#34;#&#34; src=&#34;/online_php/module06/radix/uploads/images/Products/blog2.jpg&#34; /&#62;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;blockquote&#62;Do what you love to do and give it your very best. Whether it&#38;#39;s business or baseball, or the theater, or any field. If you don&#38;#39;t love what you&#38;#39;re doing and you can&#38;#39;t give it your best, get out of it. Life is too short. You&#38;#39;ll be an old man before you know it.&#60;/blockquote&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words&#60;/p&#62;&#13;&#10;', 131, '/tromas/uploads/files/blog2.jpg', 'Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised', 0, '2022-11-03 20:12:04', '2022-11-15 07:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT '0',
  `duplicate` int DEFAULT '0',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `user_id`, `duplicate`, `create_at`, `update_at`) VALUES
(2, 'Văn hoá', 'van-hoa', 8, 0, '2022-10-27 21:34:59', '2022-11-08 00:25:43'),
(3, 'Chính trị', 'chinh-tri', 8, 0, '2022-10-27 21:35:05', '2022-11-08 00:25:37'),
(4, 'Kinh doanh', 'kinh-doanh', 8, 0, '2022-10-27 21:35:12', '2022-11-08 00:25:30'),
(5, 'Thế giới', 'the-gioi', 8, 0, '2022-10-27 21:35:21', '2022-11-11 15:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `parent_id` int DEFAULT '0',
  `blog_id` int DEFAULT '0',
  `user_id` int DEFAULT '0',
  `status` tinyint(1) DEFAULT '0' COMMENT '0: Chưa duyệt\r\n1: Đã duyệt',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `content`, `parent_id`, `blog_id`, `user_id`, `status`, `create_at`, `update_at`) VALUES
(2, 'Nguyễn Văn Quân', 'vanquan123@gmail.com', 'Tôi đang viết comment', 0, 2, NULL, 1, '2022-11-04 15:09:48', '2022-11-04 23:14:07'),
(3, 'Trần Kim Anh', 'trankimanh123@gmail.com', 'Anh tuấn comment', 0, 2, NULL, 1, '2022-11-04 15:29:17', '2022-11-04 23:13:56'),
(4, 'Võ Thị Trâm Anh', 'vothitramanh123@gmail.com', 'Nguyễn Văn C trả lời Anh Tuấn', 3, 2, NULL, 1, '2022-11-04 15:48:30', '2022-11-04 23:13:19'),
(5, 'Trịnh Đình Toàn', 'trinhdinhtoan123@gmail.com', 'Nguyễn Văn D trả lời Văn Quân', 2, 2, NULL, 1, '2022-11-04 15:50:18', '2022-11-04 23:12:52'),
(7, 'Hồ Tấn Tài', 'hotantai1234@gmail.com', 'Cảm ơn bạn bài viết rất hay', 0, 2, NULL, 1, '2022-11-04 16:23:45', '2022-11-04 23:12:01'),
(10, 'Đinh Công Mạnh', 'dinhcongmanh123@gmail.com', 'Tôi test comment ngày 04/11/2022', 0, 2, NULL, 1, '2022-11-04 17:11:58', '2022-11-04 23:10:50'),
(11, 'Đào Anh Tuấn', 'daoanhtuan1234@gmail.com', 'Cảm ơn bạn đã viết bình luận', 2, 2, NULL, 1, '2022-11-04 17:27:28', '2022-11-04 23:10:05'),
(12, NULL, NULL, 'Test comment user id', 0, 2, 8, 1, '2022-11-04 17:50:28', NULL),
(13, NULL, NULL, 'Test admin reply1', 7, 2, 8, 0, '2022-11-04 18:11:24', '2022-11-04 23:06:51'),
(15, 'Hoàng Anh Nam', 'hoanganhnam123@gmail.com', 'Bình luận mới sau khi đăng xuất', 0, 2, NULL, 0, '2022-11-04 18:25:13', '2022-11-04 23:10:23'),
(16, NULL, NULL, 'Hay quá', 0, 16, 8, 0, '2022-11-04 19:50:52', '2022-11-04 23:07:16'),
(17, NULL, NULL, 'test', 0, 15, 8, 1, '2022-11-08 20:51:41', NULL),
(18, NULL, NULL, 'test', 0, 15, 8, 1, '2022-11-08 20:51:50', NULL),
(19, NULL, NULL, 'a', 0, 15, 8, 1, '2022-11-08 20:51:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` int DEFAULT '0',
  `message` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) DEFAULT '0' COMMENT '0: Chưa xử lý\r\n1: Đang xử lý\r\n2: Đã xử lý',
  `note` text COLLATE utf8mb4_unicode_ci,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `fullname`, `email`, `type_id`, `message`, `status`, `note`, `create_at`, `update_at`) VALUES
(1, 'Hoàng An', 'hoangan.web@gmail.com', 1, 'Tôi muốn hỏi giá', 0, 'Khách hàng muốn mua sản phẩm giá rẻ', '2022-10-29 19:45:09', '2022-10-29 22:01:34'),
(3, 'Anh Nam', 'anhanm123@gmail.com', 2, 'Tôi muốn học lập trình', 2, NULL, '2022-10-29 19:45:09', NULL),
(5, 'Nguyễn Văn C', 'nguyenvanc@gmail.com', 2, 'Tôi muốn mua hàng', 0, 'Khách hàng muốn mua sản phẩm giá rẻ', '2022-10-29 19:45:09', '2022-10-29 22:01:51'),
(6, 'Đỗ Thị Hoà', 'dothihoa@gmail.com', 4, 'Tôi muốn tư vấn', 2, 'Đã gọi cho khách hàng nhưng không nghe máy', '2022-11-05 12:47:18', '2022-11-05 12:48:16'),
(7, 'Nguyễn Văn Trọng', 'nguyenvantrong@gmail.com', 1, 'Tôi muốn kinh doanh', 0, NULL, '2022-11-05 12:40:29', NULL),
(8, 'Đoàn Anh Quân', 'doananhquan123@gmail.com', 4, 'Tôi muốn hợp tác', 0, NULL, '2022-11-05 12:46:35', NULL),
(9, 'Bùi Văn Huy', 'btchuybui@gmail.com', 3, 'Tôi muốn hỏi thủ tục thanh toán', 0, NULL, '2022-11-05 13:48:46', NULL),
(10, 'Huy Bùi', 'btchuybui0@gmail.com', 2, 'Tôi muốn hỗ trợ đặt hàng', 0, NULL, '2022-11-05 13:52:31', NULL),
(11, 'Nguyễn Hữu Minh', 'buivanhuy2811@gmail.com', 4, 'Tôi muốn tư vấn thanh toán', 0, NULL, '2022-11-05 14:00:31', NULL),
(12, 'Đỗ Quân', 'btchuybui@gmail.com', 4, 'test21332112', 0, NULL, '2022-11-08 20:49:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_type`
--

CREATE TABLE `contact_type` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duplicate` int DEFAULT '0',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_type`
--

INSERT INTO `contact_type` (`id`, `name`, `duplicate`, `create_at`, `update_at`) VALUES
(1, 'Kinh doanh', 0, '2022-10-29 16:36:10', NULL),
(2, 'Kỹ thuật', 0, '2022-10-29 16:36:15', NULL),
(3, 'Tư vấn', 0, '2022-10-29 16:36:20', NULL),
(4, 'Chăm sóc khách hàng', 8, '2022-10-29 16:36:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` text COLLATE utf8mb4_unicode_ci,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permission`, `create_at`, `update_at`) VALUES
(1, 'Super Admin', '{\"services\":[\"add\"],\"pages\":[\"add\"],\"portfolios\":[\"add\"]}', '2022-10-24 21:50:42', NULL),
(2, 'Admin', '{\"services\":[\"lists\",\"add\",\"edit\",\"delete\",\"duplicate\"],\"pages\":[\"lists\",\"add\",\"edit\",\"delete\",\"duplicate\"],\"portfolios\":[\"lists\",\"add\",\"edit\",\"delete\",\"duplicate\"],\"portfolio_categories\":[\"lists\",\"add\",\"edit\",\"delete\",\"duplicate\"],\"blogs\":[\"lists\",\"add\",\"edit\",\"delete\",\"duplicate\"],\"blog_categories\":[\"lists\",\"add\",\"edit\",\"delete\",\"duplicate\"],\"comments\":[\"lists\",\"edit\",\"delete\",\"status\"],\"subscribe\":[\"lists\",\"edit\",\"delete\"],\"contacts\":[\"lists\",\"edit\",\"delete\"],\"contact_type\":[\"lists\",\"add\",\"edit\",\"delete\",\"duplicate\"],\"groups\":[\"lists\",\"add\",\"edit\",\"delete\",\"permission\"],\"users\":[\"lists\",\"add\",\"edit\",\"delete\",\"profile\"],\"options\":[\"general\",\"header\",\"footer\",\"home\",\"about\",\"team\",\"service\",\"portfolio\",\"blog\",\"contact\",\"menu\"]}', '2022-10-24 23:08:10', NULL),
(3, 'Manager', '{\"services\":[\"lists\"],\"options\":[\"general\",\"header\",\"footer\"]}', '2022-10-24 23:06:21', NULL),
(4, 'Staff', NULL, '2022-10-24 23:08:19', NULL),
(5, 'Sale', NULL, '2022-10-24 23:07:23', NULL),
(6, 'Nhập liệu', NULL, '2022-10-24 23:07:34', NULL),
(7, 'Kho', NULL, '2022-10-24 21:51:37', NULL),
(8, 'Mua hàng', NULL, '2022-10-25 12:53:30', NULL),
(9, 'Kinh doanh', NULL, '2022-10-25 12:54:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_token`
--

CREATE TABLE `login_token` (
  `id` int NOT NULL,
  `user_id` int DEFAULT '0',
  `token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_token`
--

INSERT INTO `login_token` (`id`, `user_id`, `token`, `create_at`) VALUES
(73, 8, '281cf3015a9afe4c9d3f54f406d1ae0b79589ea4', '2022-11-15 07:09:50');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `title`, `action`) VALUES
(1, 'services', 'Quản lý dịch vụ', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xoá\",\"duplicate\":\"Nhân bản\"}'),
(2, 'pages', 'Quản lý trang', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xoá\",\"duplicate\":\"Nhân bản\"}'),
(3, 'portfolios', 'Quản lý dự án', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xoá\",\"duplicate\":\"Nhân bản\"}'),
(4, 'portfolio_categories', 'Quản lý danh mục dự án', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xoá\",\"duplicate\":\"Nhân bản\"}'),
(5, 'blogs', 'Quản lý bài viết', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xoá\",\"duplicate\":\"Nhân bản\"}'),
(6, 'blog_categories', 'Quản lý danh mục bài viết', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xoá\",\"duplicate\":\"Nhân bản\"}'),
(7, 'comments', 'Quản lý bình luận', '{\"lists\":\"Xem\",\"edit\":\"Sửa\",\"delete\":\"Xoá\", \"status\":\"Duyệt\"}'),
(8, 'subscribe', 'Đăng ký nhận tin', '{\"lists\":\"Xem\",\"edit\":\"Sửa\",\"delete\":\"Xoá\"}'),
(9, 'contacts', 'Quản lý liên hệ', '{\"lists\":\"Xem\",\"edit\":\"Sửa\",\"delete\":\"Xoá\"}'),
(10, 'contact_type', 'Quản lý phòng ban', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xoá\",\"duplicate\":\"Nhân bản\"}'),
(11, 'groups', 'Nhóm người dùng', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xoá\", \"permission\":\"Phân quyền\"}'),
(12, 'users', 'Quản lý người dùng', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xoá\",\"profile\":\"Thông tin cá nhân\"}'),
(13, 'options', 'Cấu hình', '{\"general\": \"Chung\", \"header\": \"Header\", \"footer\":\"Footer\", \"home\":\"Trang chủ\", \"about\":\"Giới thiệu\",\"team\":\"Đội ngũ\", \"service\":\"Dịch vụ\", \"portfolio\":\"Dự án\",\"blog\":\"Bài viết\", \"contact\":\"Liên hệ\", \"menu\":\"Menu\"}');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int NOT NULL,
  `opt_key` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opt_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `opt_key`, `opt_value`, `name`) VALUES
(1, 'general_hotline', '+880123-467-789', 'Hotline'),
(2, 'general_email', 'btchuybui@gmail.com', 'Email'),
(3, 'general_time', 'Thứ 2 - CN : 8:00 - 22:00', 'Giờ làm việc'),
(4, 'general_facebook', 'https://facebook.com/tromas', 'Facebook'),
(5, 'general_twitter', 'https://twitter.com/tromas', 'Twitter'),
(6, 'general_linkedin', 'https://linkedin.com/tromas', 'LinkedIn'),
(7, 'general_youtube', 'https://youtube.com/tromas', 'Youtube'),
(8, 'general_behance', 'https://behance.net/tromas', 'Behance'),
(9, 'header_logo', '/tromas/uploads/files/logo.png', 'Logo'),
(10, 'header_favicon', '/tromas/uploads/files/favicon.png', 'Favicon'),
(11, 'general_sitename', 'Tromas', 'Tên website'),
(12, 'general_description', 'Tromas chuyên cung cấp dịch vụ tổ chức sự kiện', 'Mô tả website'),
(13, 'home_slide', '[{\"slide_title\":\"Marketing Hi\\u1ec7u Qu\\u1ea3\",\"slide_short_title\":\"Gi\\u1ea3i Ph\\u00e1p Digital\",\"slide_align\":\"left\",\"slide_button_text\":\"Play Video\",\"slide_button_link\":\"#\",\"slide_button_video\":\"https:\\/\\/www.youtube.com\\/watch?v=FZQPhrdKjow\",\"slide_image\":\"\\/tromas\\/uploads\\/files\\/slider-bg1.jpg\",\"slide_bg\":\"\",\"slide_description\":\"\\u0110\\u1ed1i v\\u1edbi ch\\u00fang t\\u00f4i, m\\u1ed7i m\\u1ed9t d\\u1ef1 \\u00e1n l\\u00e0 m\\u1ed9t th\\u1eed th\\u00e1ch, l\\u00e0 m\\u1ed9t b\\u1ee9c tranh ngh\\u1ec7 thu\\u1eadt m\\u00e0 b\\u1ea5t k\\u1ef3 m\\u1ed9t nh\\u00e2n vi\\u00ean n\\u00e0o c\\u0169ng mong mu\\u1ed1n \\u0111\\u01b0\\u1ee3c t\\u1ea1o n\\u00ean tuy\\u1ec7t t\\u00e1c.\"},{\"slide_title\":\"Marketing Hi\\u1ec7u Qu\\u1ea3\",\"slide_short_title\":\"Gi\\u1ea3i Ph\\u00e1p Digital\",\"slide_align\":\"right\",\"slide_button_text\":\"\",\"slide_button_link\":\"#\",\"slide_button_video\":\"\",\"slide_image\":\"\\/tromas\\/uploads\\/files\\/slider-bg2.jpg\",\"slide_bg\":\"\",\"slide_description\":\"\\u0110\\u1ed1i v\\u1edbi ch\\u00fang t\\u00f4i, m\\u1ed7i m\\u1ed9t d\\u1ef1 \\u00e1n l\\u00e0 m\\u1ed9t th\\u1eed th\\u00e1ch, l\\u00e0 m\\u1ed9t b\\u1ee9c tranh ngh\\u1ec7 thu\\u1eadt m\\u00e0 b\\u1ea5t k\\u1ef3 m\\u1ed9t nh\\u00e2n vi\\u00ean n\\u00e0o c\\u0169ng mong mu\\u1ed1n \\u0111\\u01b0\\u1ee3c t\\u1ea1o n\\u00ean tuy\\u1ec7t t\\u00e1c.\"}]', 'Slide'),
(14, 'home_about', '{\"information\":\"{\\\"about_title\\\":\\\"V\\\\u1ec1 ch\\\\u00fang t\\\\u00f4i\\\",\\\"about_description\\\":\\\"DigiLab gi\\\\u00fap doanh nghi\\\\u1ec7p ph\\\\u00e1t tri\\\\u1ec3n h\\\\u01a1n nh\\\\u1edd c\\\\u00f4ng ngh\\\\u1ec7\\\",\\\"about_content\\\":\\\"&#60;p&#62;DigiLab l&#38;agrave; Agency v\\\\u1edbi g\\\\u1ea7n 10 n\\\\u0103m kinh nghi\\\\u1ec7m trong l\\\\u0129nh v\\\\u1ef1c t\\\\u01b0 v\\\\u1ea5n v&#38;agrave; tri\\\\u1ec3n khai c&#38;aacute;c gi\\\\u1ea3i ph&#38;aacute;p to&#38;agrave;n di\\\\u1ec7n v\\\\u1ec1 Digital Marketing (ti\\\\u1ebfp th\\\\u1ecb tr\\\\u1ef1c tuy\\\\u1ebfn), gi&#38;uacute;p c&#38;aacute;c doanh nghi\\\\u1ec7p n&#38;acirc;ng cao kh\\\\u1ea3 n\\\\u0103ng ti\\\\u1ebfp c\\\\u1eadn kh&#38;aacute;ch h&#38;agrave;ng, n\\\\u0103ng l\\\\u1ef1c c\\\\u1ea1nh tranh tr&#38;ecirc;n th\\\\u1ecb tr\\\\u01b0\\\\u1eddng, t\\\\u0103ng doanh thu v&#38;agrave; t\\\\u0103ng nh\\\\u1eadn di\\\\u1ec7n th\\\\u01b0\\\\u01a1ng hi\\\\u1ec7u t\\\\u1ea1i th\\\\u1ecb tr\\\\u01b0\\\\u1eddng Vi\\\\u1ec7t Nam.&#60;\\\\\\/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Ch&#38;uacute;ng t&#38;ocirc;i t\\\\u1ef1 h&#38;agrave;o mang t\\\\u1edbi cho kh&#38;aacute;ch h&#38;agrave;ng nh\\\\u1eefng chi\\\\u1ebfn d\\\\u1ecbch digital marketing chuy&#38;ecirc;n nghi\\\\u1ec7p, gi&#38;uacute;p gia t\\\\u0103ng doanh s\\\\u1ed1, n&#38;acirc;ng t\\\\u1ea7m th\\\\u01b0\\\\u01a1ng hi\\\\u1ec7u, qua \\\\u0111&#38;oacute; n\\\\u1ed7 l\\\\u1ef1c g&#38;oacute;p s\\\\u1ee9c m&#38;igrave;nh v&#38;agrave;o s\\\\u1ee9 m\\\\u1ec7nh v&#38;igrave; s\\\\u1ef1 ph&#38;aacute;t tri\\\\u1ec3n c\\\\u1ee7a doanh nghi\\\\u1ec7p Vi\\\\u1ec7t. DigiLab l&#38;agrave; \\\\u0111\\\\u1ed1i t&#38;aacute;c qu\\\\u1ea3ng c&#38;aacute;o chi\\\\u1ebfn l\\\\u01b0\\\\u1ee3c c\\\\u1ee7a Google, Facebook v&#38;agrave; nhi\\\\u1ec1u m\\\\u1ea1ng qu\\\\u1ea3ng c&#38;aacute;o t\\\\u1ea1i th\\\\u1ecb tr\\\\u01b0\\\\u1eddng Vi\\\\u1ec7t Nam v&#38;agrave; khu v\\\\u1ef1c. V\\\\u1edbi b\\\\u1ec1 d&#38;agrave;y kinh nghi\\\\u1ec7m am hi\\\\u1ec3u v\\\\u1ec1 th\\\\u1ecb tr\\\\u01b0\\\\u1eddng v&#38;agrave; l&#38;agrave;m ch\\\\u1ee7 c&#38;aacute;c c&#38;ocirc;ng ngh\\\\u1ec7, ch&#38;uacute;ng t&#38;ocirc;i \\\\u0111&#38;atilde; tri\\\\u1ec3n khai v&#38;agrave; ho&#38;agrave;n th&#38;agrave;nh h&#38;agrave;ng ngh&#38;igrave;n chi\\\\u1ebfn d\\\\u1ecbch, v\\\\u1edbi ng&#38;acirc;n s&#38;aacute;ch h&#38;agrave;ng tr\\\\u0103m tri\\\\u1ec7u \\\\u0111\\\\u1ed3ng m\\\\u1ed7i ng&#38;agrave;y.&#60;\\\\\\/p&#62;&#13;&#10;\\\",\\\"about_image\\\":\\\"\\\\\\/tromas\\\\\\/uploads\\\\\\/files\\\\\\/about.jpg\\\",\\\"about_video\\\":\\\"https:\\\\\\/\\\\\\/www.youtube.com\\\\\\/watch?v=wZWiRoktNWA\\\",\\\"skill\\\":{\\\"name\\\":[\\\"Finance\\\",\\\"Marketings\\\",\\\"Resource\\\",\\\"Development\\\"],\\\"value\\\":[\\\"70\\\",\\\"90\\\",\\\"60\\\",\\\"80\\\"]}}\",\"skill\":\"[{\\\"name\\\":\\\"Finance\\\",\\\"value\\\":\\\"70\\\"},{\\\"name\\\":\\\"Marketings\\\",\\\"value\\\":\\\"90\\\"},{\\\"name\\\":\\\"Resource\\\",\\\"value\\\":\\\"60\\\"},{\\\"name\\\":\\\"Development\\\",\\\"value\\\":\\\"80\\\"}]\"}', 'Giới thiệu'),
(15, 'home_service_title', 'Dịch vụ tiêu biểu', 'Tiêu đề'),
(16, 'home_service_description', 'DigiLab cung cấp giải pháp toàn diện về Digital Marketing', 'Mô tả'),
(17, 'home_counter', '[{\"counter_name\":\"N\\u0103m ho\\u1ea1t \\u0111\\u1ed9ng\",\"counter_number\":\"8\",\"counter_icon\":\" &#60;i class=&#34;fa fa-tasks&#34;&#62;&#60;\\/i&#62;\"},{\"counter_name\":\"Kh\\u00e1ch h\\u00e0ng tin t\\u01b0\\u1edfng\",\"counter_number\":\"27000\",\"counter_icon\":\" &#60;i class=&#34;fa fa-users&#34;&#62;&#60;\\/i&#62;\"},{\"counter_name\":\"Nh\\u00e2n vi\\u00ean\",\"counter_number\":\"500\",\"counter_icon\":\" &#60;i class=&#34;fa fa-coffee&#34;&#62;&#60;\\/i&#62;\"},{\"counter_name\":\"\\u0110\\u1ed1i t\\u00e1c\",\"counter_number\":\"40\",\"counter_icon\":\"&#60;i class=&#34;fa fa-trophy&#34;&#62;&#60;\\/i&#62;\"}]', 'Thành tựu'),
(21, 'home_counter_bg', '/tromas/uploads/files/statics.jpg', 'Ảnh nền'),
(22, 'home_project_title', 'Case Study', 'Tên dự án'),
(23, 'home_project_description', 'Các dự án tiêu biểu của chúng tôi', 'Mô tả dự án'),
(24, 'home_cta_title', 'we&#39;ll one over &#60;span&#62;30 Years of experience you always&#60;/span&#62; the best guidance', 'Tiêu đề'),
(28, 'home_cta_button_text', 'Contact Us', 'Tên nút'),
(29, 'home_cta_button_link', 'http://localhost/tromas/lien-he.html', 'Link nút'),
(30, 'home_cta_button_icon', '&#60;i class=&#34;fa fa-send&#34;&#62;&#60;/i&#62;', 'Icon nút'),
(31, 'home_blog_title', 'Bài viết - Blog', 'Tiêu đề'),
(32, 'home_blog_description', 'Những dịch vụ mà Creative có thể mang lại cho bạn, phục vụ tốt nhất cho công việc kinh doanh của bạn', 'Mô tả'),
(33, 'home_client_title', 'Đối tác', 'Tiêu đề'),
(34, 'home_client_description', 'Chúng tôi tự hào là đối tác chính thức của nhiều thương hiệu lớn với 100% đội ngũ chuyên môn cao đạt các chứng chỉ khắt khe nhất từ Google, Facebook, Zalo …', 'Mô tả'),
(35, 'home_client', '[{\"client_link\":\"#\",\"client_logo\":\"\\/tromas\\/uploads\\/files\\/client1.png\"},{\"client_link\":\"#\",\"client_logo\":\"\\/tromas\\/uploads\\/files\\/client2.png\"},{\"client_link\":\"#\",\"client_logo\":\"\\/tromas\\/uploads\\/files\\/client3.png\"},{\"client_link\":\"#\",\"client_logo\":\"\\/tromas\\/uploads\\/files\\/client4.png\"},{\"client_link\":\"#\",\"client_logo\":\"\\/tromas\\/uploads\\/files\\/client5.png\"},{\"client_link\":\"#\",\"client_logo\":\"\\/tromas\\/uploads\\/files\\/client6.png\"}]', 'Đối tác'),
(36, 'general_address', 'Road no 3, Khilgaon 1200, Dhaka Bangladesh', 'Địa chỉ'),
(37, 'footer_1_title', 'Giới thiệu', 'Tiêu đề'),
(38, 'footer_1_description', '&#60;p&#62;Creative - Chuy&#38;ecirc;n cung cấp dịch vụ thiết kế website, tư vấn marketing, đăng k&#38;iacute; hosting, thiết kế app,... uy t&#38;iacute;n, chất lượng&#60;/p&#62;&#13;&#10;', 'Mô tả'),
(39, 'footer_2_title', 'Liên kết nhanh', 'Mô tả'),
(40, 'footer_2_description', '&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;/&#34;&#62;Về ch&#38;uacute;ng t&#38;ocirc;i&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;/&#34;&#62;Điều khoản dịch vụ&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;/&#34;&#62;Ch&#38;iacute;nh s&#38;aacute;ch bảo mật&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;/&#34;&#62;Hướng dẫn thanh to&#38;aacute;n&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;/&#34;&#62;Li&#38;ecirc;n hệ hỗ trợ dịch vụ&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;', 'Mô tả'),
(41, 'footer_3_title', 'Tweets Gần Đây', 'Mô tả'),
(42, 'footer_3_twitter', 'tft', 'Tài khoản Twitter'),
(43, 'footer_4_title', 'Đăng ký theo dõi', 'Mô tả'),
(44, 'footer_4_description', '&#60;p&#62;Đừng bỏ lỡ tin tức Marketing mới nhất. Theo d&#38;otilde;i ch&#38;uacute;ng t&#38;ocirc;i ngay h&#38;ocirc;m nay!&#60;/p&#62;&#13;&#10;', 'Mô tả'),
(45, 'footer_copyright', '&#60;p&#62;Copyright 2022 &#38;copy; - Bản quyền thuộc về Tromas&#60;/p&#62;&#13;&#10;', 'Copyright'),
(46, 'about_title', 'Giới thiệu chung', 'Tiêu đề'),
(47, 'team_title', 'Đội ngũ', 'Tiêu đề'),
(50, 'home_team', '[{\"team_fullname\":\"Angel Rimu\",\"team_position\":\"Creative\",\"team_image\":\"\\/tromas\\/uploads\\/files\\/team1.jpeg\",\"team_facebook\":\"#\",\"team_twitter\":\"#\",\"team_behance\":\"#\",\"team_dribbble\":\"#\"},{\"team_fullname\":\"Shakil Hossain\",\"team_position\":\"Developer\",\"team_image\":\"\\/tromas\\/uploads\\/files\\/team2.jpeg\",\"team_facebook\":\"#\",\"team_twitter\":\"#\",\"team_behance\":\"#\",\"team_dribbble\":\"#\"},{\"team_fullname\":\"Sufia Mizan\",\"team_position\":\"Branding\",\"team_image\":\"\\/tromas\\/uploads\\/files\\/team3.jpeg\",\"team_facebook\":\"#\",\"team_twitter\":\"#\",\"team_behance\":\"#\",\"team_dribbble\":\"#\"},{\"team_fullname\":\"SM Jehad\",\"team_position\":\"CEO\\/Officer\",\"team_image\":\"\\/tromas\\/uploads\\/files\\/team4.jpeg\",\"team_facebook\":\"#\",\"team_twitter\":\"#\",\"team_behance\":\"#\",\"team_dribbble\":\"#\"}]', 'Đội ngũ'),
(51, 'service_title', 'Dịch vụ Tromas', 'Tiêu đề'),
(52, 'portfolio_title', 'Case Study', 'Tiêu đề'),
(53, 'home_team_title', 'Đội Ngũ', 'Tên đội ngũ'),
(54, 'home_team_description', 'Đội ngũ của chúng tôi chính là đội ngũ của bạn. Chúng tôi ở đây, đồng hành cùng doanh nghiệp bạn!', 'Mô tả'),
(55, 'blog_title', 'Bài Viết', 'Tiêu đề'),
(56, 'contact_title', 'Liên hệ với chúng tôi', 'Tiêu đề'),
(57, 'contact_description', 'Nếu bạn có lời nhắn với chúng tôi xin hãy viết vào form dưới đây. Chúng tôi sẽ trả lời ngay sau khi nhận được lời nhắn của bạn..', 'Mô tả'),
(58, 'contact_address_title', 'Thông tin liên hệ', 'Tiêu đề'),
(59, 'contact_address_description', 'Nếu bạn có bất kỳ câu hỏi nào, xin đừng ngần ngại gửi cho chúng tôi một tin nhắn. Chúng tôi sẽ phản hồi trong vòng 24h .', 'Mô tả'),
(60, 'blog_page_number', '3', 'Số lượng phân trang bài viết'),
(61, 'menu', '[{&#34;text&#34;:&#34;Trang chủ&#34;,&#34;href&#34;:&#34;http://localhost/tromas/&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;active&#34;:&#34;active&#34;},{&#34;text&#34;:&#34;Dự án&#34;,&#34;href&#34;:&#34;http://localhost/tromas/du-an.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;active&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Dịch vụ&#34;,&#34;href&#34;:&#34;http://localhost/tromas/dich-vu.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;active&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Bài viết&#34;,&#34;href&#34;:&#34;http://localhost/tromas/bai-viet.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;active&#34;:&#34;&#34;,&#34;children&#34;:[{&#34;text&#34;:&#34;Kinh doanh&#34;,&#34;href&#34;:&#34;http://localhost/tromas/danh-muc/kinh-doanh-4.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;active&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Thế giới&#34;,&#34;href&#34;:&#34;http://localhost/tromas/danh-muc/the-gioi-5.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;active&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Văn hoá&#34;,&#34;href&#34;:&#34;http://localhost/tromas/danh-muc/van-hoa-2.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;active&#34;:&#34;&#34;}]},{&#34;text&#34;:&#34;Giới thiệu&#34;,&#34;href&#34;:&#34;http://localhost/tromas/gioi-thieu.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;active&#34;:&#34;&#34;,&#34;children&#34;:[{&#34;text&#34;:&#34;Giới thiệu chung&#34;,&#34;href&#34;:&#34;http://localhost/tromas/gioi-thieu.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;active&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Đội ngũ&#34;,&#34;href&#34;:&#34;http://localhost/tromas/doi-ngu.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;active&#34;:&#34;&#34;}]},{&#34;text&#34;:&#34;Liên hệ&#34;,&#34;href&#34;:&#34;http://localhost/tromas/lien-he.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;active&#34;:&#34;&#34;}]', 'Menu');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `user_id` int DEFAULT '0',
  `duplicate` int DEFAULT '0',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `user_id`, `duplicate`, `create_at`, `update_at`) VALUES
(1, 'Hướng dẫn mua hàng', 'huong-dan-mua-hang', '&#60;h2&#62;What is Lorem Ipsum?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h2&#62;Why do we use it?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#38;#39;Content here, content here&#38;#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#38;#39;lorem ipsum&#38;#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h2&#62;Where does it come from?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &#38;quot;de Finibus Bonorum et Malorum&#38;quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &#38;quot;Lorem ipsum dolor sit amet..&#38;quot;, comes from a line in section 1.10.32.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &#38;quot;de Finibus Bonorum et Malorum&#38;quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.&#60;/p&#62;&#13;&#10;', 7, 5, '2022-10-26 23:00:53', '2022-11-05 14:20:58'),
(2, 'Phương thức thanh toán', 'phuong-thuc-thanh-toan', '&#60;h2&#62;What is Lorem Ipsum?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h2&#62;Why do we use it?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#38;#39;Content here, content here&#38;#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#38;#39;lorem ipsum&#38;#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h2&#62;Where does it come from?&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &#38;quot;de Finibus Bonorum et Malorum&#38;quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &#38;quot;Lorem ipsum dolor sit amet..&#38;quot;, comes from a line in section 1.10.32.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &#38;quot;de Finibus Bonorum et Malorum&#38;quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.&#60;/p&#62;&#13;&#10;', 8, 0, '2022-10-26 23:00:53', '2022-11-05 14:21:24');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`) VALUES
(1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `video` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `user_id` int DEFAULT '0',
  `portfolio_category_id` int DEFAULT '0',
  `duplicate` int DEFAULT '0',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `name`, `slug`, `thumbnail`, `description`, `video`, `content`, `user_id`, `portfolio_category_id`, `duplicate`, `create_at`, `update_at`) VALUES
(12, 'Powerfull Theme', 'powerfull-theme', '/tromas/uploads/files/1.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=FZQPhrdKjow', '&#60;p&#62;Nunc imperdiet gravida erat, in porta magna feugiat quis. Aenean non massa a diam porta vulputate nec at nisi. Donec sed odio ultricies, facilisis ex vel, tincidunt libero. Donec diam tortor, mattis sit amet nibh nec, eleifend sodales lacus. In eu eros ut augue tristique dictum viverra nec sapien. Phasellus condimentum dictum sapien, nec fermentum lacus aliquet eget. Mauris sodales consectetur tortor, sed pretium arcu iaculis sit amet. Phasellus vel lectus elit. Cras porta vitae ipsum nec consectetur. Duis suscipit tristique nulla vitae faucibus. Curabitur sit amet neque a sapien lobortis egestas. Nunc tellus nisi, imperdiet ut convallis posuere, venenatis ut libero. Sed fringilla diam eros, nec iaculis justo faucibus eget.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;blockquote&#62;Do what you love to do and give it your very best. Whether it&#38;#39;s business or baseball, or the theater, or any field. If you don&#38;#39;t love what you&#38;#39;re doing and you can&#38;#39;t give it your best, get out of it. Life is too short. You&#38;#39;ll be an old man before you know it.&#60;/blockquote&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Cras dignissim metus quis lobortis dignissim. Vestibulum accumsan nulla a justo facilisis, vel tempor ex mattis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut in ultricies ligula, in ornare est. Ut maximus nibh ut felis lacinia, ut commodo enim convallis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut hendrerit risus in ipsum pharetra, a sagittis dui sodales. Duis et libero eget eros tempor semper. Nunc ac gravida dui. Praesent quis sem quis lectus feugiat congue tristique id erat.&#60;/p&#62;&#13;&#10;', 8, 17, 4, '2022-11-01 20:40:21', '2022-11-15 07:12:59'),
(13, 'Crazy Design', 'crazy-design', '/tromas/uploads/files/2.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=FZQPhrdKjow', '&#60;p&#62;Nunc imperdiet gravida erat, in porta magna feugiat quis. Aenean non massa a diam porta vulputate nec at nisi. Donec sed odio ultricies, facilisis ex vel, tincidunt libero. Donec diam tortor, mattis sit amet nibh nec, eleifend sodales lacus. In eu eros ut augue tristique dictum viverra nec sapien. Phasellus condimentum dictum sapien, nec fermentum lacus aliquet eget. Mauris sodales consectetur tortor, sed pretium arcu iaculis sit amet. Phasellus vel lectus elit. Cras porta vitae ipsum nec consectetur. Duis suscipit tristique nulla vitae faucibus. Curabitur sit amet neque a sapien lobortis egestas. Nunc tellus nisi, imperdiet ut convallis posuere, venenatis ut libero. Sed fringilla diam eros, nec iaculis justo faucibus eget.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;blockquote&#62;Do what you love to do and give it your very best. Whether it&#38;#39;s business or baseball, or the theater, or any field. If you don&#38;#39;t love what you&#38;#39;re doing and you can&#38;#39;t give it your best, get out of it. Life is too short. You&#38;#39;ll be an old man before you know it.&#60;/blockquote&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Cras dignissim metus quis lobortis dignissim. Vestibulum accumsan nulla a justo facilisis, vel tempor ex mattis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut in ultricies ligula, in ornare est. Ut maximus nibh ut felis lacinia, ut commodo enim convallis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut hendrerit risus in ipsum pharetra, a sagittis dui sodales. Duis et libero eget eros tempor semper. Nunc ac gravida dui. Praesent quis sem quis lectus feugiat congue tristique id erat.&#60;/p&#62;&#13;&#10;', 8, 17, 0, '2022-11-01 20:40:24', '2022-11-15 07:12:51'),
(14, 'Bootstrap Framework', 'bootstrap-framework', '/tromas/uploads/files/3.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=FZQPhrdKjow', '&#60;p&#62;Nunc imperdiet gravida erat, in porta magna feugiat quis. Aenean non massa a diam porta vulputate nec at nisi. Donec sed odio ultricies, facilisis ex vel, tincidunt libero. Donec diam tortor, mattis sit amet nibh nec, eleifend sodales lacus. In eu eros ut augue tristique dictum viverra nec sapien. Phasellus condimentum dictum sapien, nec fermentum lacus aliquet eget. Mauris sodales consectetur tortor, sed pretium arcu iaculis sit amet. Phasellus vel lectus elit. Cras porta vitae ipsum nec consectetur. Duis suscipit tristique nulla vitae faucibus. Curabitur sit amet neque a sapien lobortis egestas. Nunc tellus nisi, imperdiet ut convallis posuere, venenatis ut libero. Sed fringilla diam eros, nec iaculis justo faucibus eget.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;blockquote&#62;Do what you love to do and give it your very best. Whether it&#38;#39;s business or baseball, or the theater, or any field. If you don&#38;#39;t love what you&#38;#39;re doing and you can&#38;#39;t give it your best, get out of it. Life is too short. You&#38;#39;ll be an old man before you know it.&#60;/blockquote&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Cras dignissim metus quis lobortis dignissim. Vestibulum accumsan nulla a justo facilisis, vel tempor ex mattis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut in ultricies ligula, in ornare est. Ut maximus nibh ut felis lacinia, ut commodo enim convallis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut hendrerit risus in ipsum pharetra, a sagittis dui sodales. Duis et libero eget eros tempor semper. Nunc ac gravida dui. Praesent quis sem quis lectus feugiat congue tristique id erat.&#60;/p&#62;&#13;&#10;', 8, 17, 1, '2022-11-01 20:40:25', '2022-11-15 07:12:40'),
(15, 'Easy To Use', 'easy-to-use', '/tromas/uploads/files/4.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=FZQPhrdKjow', '&#60;p&#62;Nunc imperdiet gravida erat, in porta magna feugiat quis. Aenean non massa a diam porta vulputate nec at nisi. Donec sed odio ultricies, facilisis ex vel, tincidunt libero. Donec diam tortor, mattis sit amet nibh nec, eleifend sodales lacus. In eu eros ut augue tristique dictum viverra nec sapien. Phasellus condimentum dictum sapien, nec fermentum lacus aliquet eget. Mauris sodales consectetur tortor, sed pretium arcu iaculis sit amet. Phasellus vel lectus elit. Cras porta vitae ipsum nec consectetur. Duis suscipit tristique nulla vitae faucibus. Curabitur sit amet neque a sapien lobortis egestas. Nunc tellus nisi, imperdiet ut convallis posuere, venenatis ut libero. Sed fringilla diam eros, nec iaculis justo faucibus eget.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;blockquote&#62;Do what you love to do and give it your very best. Whether it&#38;#39;s business or baseball, or the theater, or any field. If you don&#38;#39;t love what you&#38;#39;re doing and you can&#38;#39;t give it your best, get out of it. Life is too short. You&#38;#39;ll be an old man before you know it.&#60;/blockquote&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Cras dignissim metus quis lobortis dignissim. Vestibulum accumsan nulla a justo facilisis, vel tempor ex mattis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut in ultricies ligula, in ornare est. Ut maximus nibh ut felis lacinia, ut commodo enim convallis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut hendrerit risus in ipsum pharetra, a sagittis dui sodales. Duis et libero eget eros tempor semper. Nunc ac gravida dui. Praesent quis sem quis lectus feugiat congue tristique id erat.&#60;/p&#62;&#13;&#10;', 8, 17, 2, '2022-11-01 20:40:26', '2022-11-15 07:12:31'),
(16, 'Modern Design', 'modern-design', '/tromas/uploads/files/6.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=E-2ocmhF6TA', '&#60;p&#62;Nunc imperdiet gravida erat, in porta magna feugiat quis. Aenean non massa a diam porta vulputate nec at nisi. Donec sed odio ultricies, facilisis ex vel, tincidunt libero. Donec diam tortor, mattis sit amet nibh nec, eleifend sodales lacus. In eu eros ut augue tristique dictum viverra nec sapien. Phasellus condimentum dictum sapien, nec fermentum lacus aliquet eget. Mauris sodales consectetur tortor, sed pretium arcu iaculis sit amet. Phasellus vel lectus elit. Cras porta vitae ipsum nec consectetur. Duis suscipit tristique nulla vitae faucibus. Curabitur sit amet neque a sapien lobortis egestas. Nunc tellus nisi, imperdiet ut convallis posuere, venenatis ut libero. Sed fringilla diam eros, nec iaculis justo faucibus eget.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;blockquote&#62;Do what you love to do and give it your very best. Whether it&#38;#39;s business or baseball, or the theater, or any field. If you don&#38;#39;t love what you&#38;#39;re doing and you can&#38;#39;t give it your best, get out of it. Life is too short. You&#38;#39;ll be an old man before you know it.&#60;/blockquote&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Cras dignissim metus quis lobortis dignissim. Vestibulum accumsan nulla a justo facilisis, vel tempor ex mattis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut in ultricies ligula, in ornare est. Ut maximus nibh ut felis lacinia, ut commodo enim convallis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut hendrerit risus in ipsum pharetra, a sagittis dui sodales. Duis et libero eget eros tempor semper. Nunc ac gravida dui. Praesent quis sem quis lectus feugiat congue tristique id erat.&#60;/p&#62;&#13;&#10;', 8, 17, 3, '2022-11-01 20:40:27', '2022-11-15 07:12:22'),
(17, 'Creative Work', 'creative-work', '/tromas/uploads/files/7.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=FZQPhrdKjow', '&#60;p&#62;Nunc imperdiet gravida erat, in porta magna feugiat quis. Aenean non massa a diam porta vulputate nec at nisi. Donec sed odio ultricies, facilisis ex vel, tincidunt libero. Donec diam tortor, mattis sit amet nibh nec, eleifend sodales lacus. In eu eros ut augue tristique dictum viverra nec sapien. Phasellus condimentum dictum sapien, nec fermentum lacus aliquet eget. Mauris sodales consectetur tortor, sed pretium arcu iaculis sit amet. Phasellus vel lectus elit. Cras porta vitae ipsum nec consectetur. Duis suscipit tristique nulla vitae faucibus. Curabitur sit amet neque a sapien lobortis egestas. Nunc tellus nisi, imperdiet ut convallis posuere, venenatis ut libero. Sed fringilla diam eros, nec iaculis justo faucibus eget.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;blockquote&#62;Do what you love to do and give it your very best. Whether it&#38;#39;s business or baseball, or the theater, or any field. If you don&#38;#39;t love what you&#38;#39;re doing and you can&#38;#39;t give it your best, get out of it. Life is too short. You&#38;#39;ll be an old man before you know it.&#60;/blockquote&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Cras dignissim metus quis lobortis dignissim. Vestibulum accumsan nulla a justo facilisis, vel tempor ex mattis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut in ultricies ligula, in ornare est. Ut maximus nibh ut felis lacinia, ut commodo enim convallis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut hendrerit risus in ipsum pharetra, a sagittis dui sodales. Duis et libero eget eros tempor semper. Nunc ac gravida dui. Praesent quis sem quis lectus feugiat congue tristique id erat.&#60;/p&#62;&#13;&#10;', 8, 18, 2, '2022-11-01 20:46:13', '2022-11-15 07:12:10'),
(18, 'Responsive Design', 'responsive-design', '/tromas/uploads/files/8.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=E-2ocmhF6TA', '&#60;p&#62;Nunc imperdiet gravida erat, in porta magna feugiat quis. Aenean non massa a diam porta vulputate nec at nisi. Donec sed odio ultricies, facilisis ex vel, tincidunt libero. Donec diam tortor, mattis sit amet nibh nec, eleifend sodales lacus. In eu eros ut augue tristique dictum viverra nec sapien. Phasellus condimentum dictum sapien, nec fermentum lacus aliquet eget. Mauris sodales consectetur tortor, sed pretium arcu iaculis sit amet. Phasellus vel lectus elit. Cras porta vitae ipsum nec consectetur. Duis suscipit tristique nulla vitae faucibus. Curabitur sit amet neque a sapien lobortis egestas. Nunc tellus nisi, imperdiet ut convallis posuere, venenatis ut libero. Sed fringilla diam eros, nec iaculis justo faucibus eget.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;blockquote&#62;Do what you love to do and give it your very best. Whether it&#38;#39;s business or baseball, or the theater, or any field. If you don&#38;#39;t love what you&#38;#39;re doing and you can&#38;#39;t give it your best, get out of it. Life is too short. You&#38;#39;ll be an old man before you know it.&#60;/blockquote&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Cras dignissim metus quis lobortis dignissim. Vestibulum accumsan nulla a justo facilisis, vel tempor ex mattis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut in ultricies ligula, in ornare est. Ut maximus nibh ut felis lacinia, ut commodo enim convallis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut hendrerit risus in ipsum pharetra, a sagittis dui sodales. Duis et libero eget eros tempor semper. Nunc ac gravida dui. Praesent quis sem quis lectus feugiat congue tristique id erat.&#60;/p&#62;&#13;&#10;', 8, 18, 0, '2022-11-01 20:46:16', '2022-11-15 07:12:00'),
(19, 'Bootstrap Based', 'bootstrap-based', '/tromas/uploads/files/9.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=FZQPhrdKjow', '&#60;p&#62;Nunc imperdiet gravida erat, in porta magna feugiat quis. Aenean non massa a diam porta vulputate nec at nisi. Donec sed odio ultricies, facilisis ex vel, tincidunt libero. Donec diam tortor, mattis sit amet nibh nec, eleifend sodales lacus. In eu eros ut augue tristique dictum viverra nec sapien. Phasellus condimentum dictum sapien, nec fermentum lacus aliquet eget. Mauris sodales consectetur tortor, sed pretium arcu iaculis sit amet. Phasellus vel lectus elit. Cras porta vitae ipsum nec consectetur. Duis suscipit tristique nulla vitae faucibus. Curabitur sit amet neque a sapien lobortis egestas. Nunc tellus nisi, imperdiet ut convallis posuere, venenatis ut libero. Sed fringilla diam eros, nec iaculis justo faucibus eget.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;blockquote&#62;Do what you love to do and give it your very best. Whether it&#38;#39;s business or baseball, or the theater, or any field. If you don&#38;#39;t love what you&#38;#39;re doing and you can&#38;#39;t give it your best, get out of it. Life is too short. You&#38;#39;ll be an old man before you know it.&#60;/blockquote&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Cras dignissim metus quis lobortis dignissim. Vestibulum accumsan nulla a justo facilisis, vel tempor ex mattis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut in ultricies ligula, in ornare est. Ut maximus nibh ut felis lacinia, ut commodo enim convallis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut hendrerit risus in ipsum pharetra, a sagittis dui sodales. Duis et libero eget eros tempor semper. Nunc ac gravida dui. Praesent quis sem quis lectus feugiat congue tristique id erat.&#60;/p&#62;&#13;&#10;', 8, 18, 1, '2022-11-01 20:46:18', '2022-11-15 07:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_categories`
--

CREATE TABLE `portfolio_categories` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT '0',
  `duplicate` int DEFAULT '0',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolio_categories`
--

INSERT INTO `portfolio_categories` (`id`, `name`, `user_id`, `duplicate`, `create_at`, `update_at`) VALUES
(16, 'Facebook Ads', 8, 0, '2022-11-01 20:36:53', '2022-11-11 17:15:26'),
(17, 'Marketing Tổng Thể', 8, 0, '2022-11-01 20:37:00', '2022-11-11 17:14:56'),
(18, 'SEO Google', 8, 0, '2022-11-01 20:37:07', '2022-11-11 17:15:17'),
(19, 'Google Ads', 8, 0, '2022-11-01 20:37:13', '2022-11-11 17:15:31');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_images`
--

CREATE TABLE `portfolio_images` (
  `id` int NOT NULL,
  `portfolio_id` int DEFAULT '0',
  `image` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolio_images`
--

INSERT INTO `portfolio_images` (`id`, `portfolio_id`, `image`, `create_at`, `update_at`) VALUES
(9, 19, '/tromas/uploads/files/proj-thumb1.jpg', '2022-11-03 11:24:25', '2022-11-15 07:11:42'),
(10, 19, '/tromas/uploads/files/proj-thumb2.jpg', '2022-11-03 11:24:25', '2022-11-15 07:11:42'),
(11, 19, '/tromas/uploads/files/proj-thumb3.jpg', '2022-11-03 11:24:25', '2022-11-15 07:11:42'),
(12, 19, '/tromas/uploads/files/proj-thumb4.jpg', '2022-11-03 11:24:25', '2022-11-15 07:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `user_id` int DEFAULT '0',
  `duplicate` int DEFAULT '0',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `slug`, `icon`, `description`, `content`, `user_id`, `duplicate`, `create_at`, `update_at`) VALUES
(13, 'Creative', 'business-consulting', '&#60;i class=&#34;fa fa-edit&#34;&#62;&#60;/i&#62;', 'Giải pháp xây dựng hình ảnh thương hiệu chuyên nghiệp..', '&#60;p&#62;Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant speaking it bringing it thoughts View busy dine oh in kne wif even Boy these along far own other equal old fanny charm Difficulty invitation put introduced see middletons nor preference Answer misery adieus add wooded how na men before though. Pretended belonging contented mrs suffering favourite you the continu. Mrs civil nay least means tried drift Natural end law whether but and towards certain.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;Here Is Our Service List&#60;br /&#62;&#13;&#10;&#38;nbsp;&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;&#38;nbsp;&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;Here Is Our Service List&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Pretended belonging contented mrs suffering favourite you the continu. Mrs civil nay least means tried drift Natural end law whether but and towards certain. Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant speaking it bringing it thoughts View busy dine oh in kne wif even Boy these along far own other equal old fanny&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant&#60;/p&#62;&#13;&#10;', 8, 5, '2022-10-31 14:58:46', '2022-11-11 17:11:11'),
(14, 'Content Marketing', 'content-marketing', '&#60;i class=&#34;fa fa-lightbulb-o&#34;&#62;&#60;/i&#62;', 'Giải pháp nền tảng để tạo ra bản sắc cho thương hiệu.', '&#60;p&#62;Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant speaking it bringing it thoughts View busy dine oh in kne wif even Boy these along far own other equal old fanny charm Difficulty invitation put introduced see middletons nor preference Answer misery adieus add wooded how na men before though. Pretended belonging contented mrs suffering favourite you the continu. Mrs civil nay least means tried drift Natural end law whether but and towards certain.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;Here Is Our Service List&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;Here Is Our Service List&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Pretended belonging contented mrs suffering favourite you the continu. Mrs civil nay least means tried drift Natural end law whether but and towards certain. Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant speaking it bringing it thoughts View busy dine oh in kne wif even Boy these along far own other equal old fanny&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant&#60;/p&#62;&#13;&#10;', 8, 0, '2022-10-31 15:01:56', '2022-11-11 17:10:53'),
(15, 'Google Ads', 'google-ads', '&#60;i class=&#34;fa fa-money&#34;&#62;&#60;/i&#62;', 'Giải pháp tăng tỷ lệ chuyển đổi với chi phí thấp cùng Google.', '&#60;p&#62;Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant speaking it bringing it thoughts View busy dine oh in kne wif even Boy these along far own other equal old fanny charm Difficulty invitation put introduced see middletons nor preference Answer misery adieus add wooded how na men before though. Pretended belonging contented mrs suffering favourite you the continu. Mrs civil nay least means tried drift Natural end law whether but and towards certain.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;Here Is Our Service List&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;Here Is Our Service List&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Pretended belonging contented mrs suffering favourite you the continu. Mrs civil nay least means tried drift Natural end law whether but and towards certain. Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant speaking it bringing it thoughts View busy dine oh in kne wif even Boy these along far own other equal old fanny&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant&#60;/p&#62;&#13;&#10;', 8, 1, '2022-10-31 15:01:58', '2022-11-11 17:10:39'),
(16, 'Facebook Adwords', 'facebook-adwords', '&#60;i class=&#34;fa fa-clock-o&#34;&#62;&#60;/i&#62;', 'Giải pháp hiệu quả để tiếp cận hàng triệu khách hàng tiềm năng trên mạng xã hội.', '&#60;p&#62;Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant speaking it bringing it thoughts View busy dine oh in kne wif even Boy these along far own other equal old fanny charm Difficulty invitation put introduced see middletons nor preference Answer misery adieus add wooded how na men before though. Pretended belonging contented mrs suffering favourite you the continu. Mrs civil nay least means tried drift Natural end law whether but and towards certain.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;Here Is Our Service List&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;Here Is Our Service List&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Pretended belonging contented mrs suffering favourite you the continu. Mrs civil nay least means tried drift Natural end law whether but and towards certain. Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant speaking it bringing it thoughts View busy dine oh in kne wif even Boy these along far own other equal old fanny&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant&#60;/p&#62;&#13;&#10;', 8, 2, '2022-10-31 15:01:59', '2022-11-11 17:10:28'),
(17, 'Dịch vụ SEO Website', 'dich-vu-seo-website', '&#60;i class=&#34;fa fa-globe&#34;&#62;&#60;/i&#62;', 'Giải pháp gia tăng lượt truy cập và tỉ lệ chuyển đổi trên website.', '&#60;p&#62;Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant speaking it bringing it thoughts View busy dine oh in kne wif even Boy these along far own other equal old fanny charm Difficulty invitation put introduced see middletons nor preference Answer misery adieus add wooded how na men before though. Pretended belonging contented mrs suffering favourite you the continu. Mrs civil nay least means tried drift Natural end law whether but and towards certain.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;Here Is Our Service List&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;Here Is Our Service List&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Pretended belonging contented mrs suffering favourite you the continu. Mrs civil nay least means tried drift Natural end law whether but and towards certain. Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant speaking it bringing it thoughts View busy dine oh in kne wif even Boy these along far own other equal old fanny&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant&#60;/p&#62;&#13;&#10;', 8, 3, '2022-10-31 15:01:59', '2022-11-11 17:10:14'),
(18, 'Marketing tổng thể', 'marketing-tong-the', '&#60;i class=&#34;fa fa-magic&#34;&#62;&#60;/i&#62;', 'Giải pháp nâng tầm thương hiệu, gia tăng doanh số toàn diện.', '&#60;p&#62;Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant speaking it bringing it thoughts View busy dine oh in kne wif even Boy these along far own other equal old fanny charm Difficulty invitation put introduced see middletons nor preference Answer misery adieus add wooded how na men before though. Pretended belonging contented mrs suffering favourite you the continu. Mrs civil nay least means tried drift Natural end law whether but and towards certain.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;Here Is Our Service List&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;&#13;&#10;&#60;h4&#62;Here Is Our Service List&#60;/h4&#62;&#13;&#10;&#13;&#10;&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Powerfull HTML5 Template&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Quality Design and more&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;Smooth Design&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;It&#38;#39;s ferfect for any business website&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Pretended belonging contented mrs suffering favourite you the continu. Mrs civil nay least means tried drift Natural end law whether but and towards certain. Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant speaking it bringing it thoughts View busy dine oh in kne wif even Boy these along far own other equal old fanny&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Continual delighted as elsewhere am convinced unfeeling Introduced stimulated attachment no by projection To loud lady whomm ymile sold four Need miss all four case fine age tell He families my pleasant&#60;/p&#62;&#13;&#10;', 8, 4, '2022-10-31 15:03:46', '2022-11-11 17:09:55');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0: Chưa xử lý\r\n1: Đang xử lý\r\n2: Đã xử lý',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id`, `email`, `status`, `create_at`, `update_at`) VALUES
(3, 'nguyenvantrong@gmail.com', 1, '2022-11-05 23:06:57', NULL),
(4, 'nguyenvand@gmail.com', 0, '2022-11-05 23:07:24', NULL),
(5, 'nguyenvanc@gmail.com', 2, '2022-11-05 23:07:54', NULL),
(6, 'vanquan123@gmail.com', 0, '2022-11-05 23:08:32', NULL),
(8, 'nguyenhuutrong@gmail.com', 0, '2022-11-05 23:12:26', '2022-11-06 17:57:15'),
(9, 'thiennguyenklongbong@gmail.com', 0, '2022-11-08 21:02:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_content` text COLLATE utf8mb4_unicode_ci,
  `contact_facebook` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_twitter` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_linkedin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_pinterest` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forget_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` int DEFAULT '0',
  `status` tinyint(1) DEFAULT '0' COMMENT '0: Chưa kích hoạt\r\n1: Đã kích hoạt',
  `last_activity` datetime DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `about_content`, `contact_facebook`, `contact_twitter`, `contact_linkedin`, `contact_pinterest`, `forget_token`, `group_id`, `status`, `last_activity`, `create_at`, `update_at`) VALUES
(7, 'Bùi Văn Huy', 'btchuybui0@gmail.com', '$2y$10$AgSHbTwpaRBOhgtXfk8DLO.WmJm4w9x8mmMOQrzwjWYvcotK4gQie', 'Hi My name is Lamp! quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alterations. Vivamus vehicula quis cursus. In hac habitasse platea dictumst Aenean tristique odio id lectus solmania trundard lamp!', 'https://facebook.com/nguyenvana', 'https://twitter.com/nguyenvana', 'https://linkedin.com/nguyenvana', 'https://pinterest.com/nguyenvana', NULL, 3, 1, '2022-11-10 00:59:09', '2022-10-25 21:57:40', NULL),
(8, 'Nguyễn Văn A', 'btchuybui@gmail.com', '$2y$10$dY6TeMBrOtsI6N.0EsqPcu1pGDuEgTFbDS2P73NbI4XXPlbP/UrjC', 'Hi My name is Lamp! quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alterations. Vivamus vehicula quis cursus. In hac habitasse platea dictumst Aenean tristique odio id lectus solmania trundard lamp!', 'https://facebook.com/nguyenvana', 'https://twitter.com/nguyenvana', 'https://linkedin.com/nguyenvana', 'https://pinterest.com/nguyenvana', NULL, 2, 1, '2022-11-15 07:19:30', '2022-10-25 21:57:56', '2022-11-04 14:18:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `contact_type`
--
ALTER TABLE `contact_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_token`
--
ALTER TABLE `login_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portfolio_category_id` (`portfolio_category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portfolio_id` (`portfolio_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_type`
--
ALTER TABLE `contact_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `login_token`
--
ALTER TABLE `login_token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `blogs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD CONSTRAINT `blog_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `contact_type` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `login_token`
--
ALTER TABLE `login_token`
  ADD CONSTRAINT `login_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD CONSTRAINT `portfolios_ibfk_1` FOREIGN KEY (`portfolio_category_id`) REFERENCES `portfolio_categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `portfolios_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  ADD CONSTRAINT `portfolio_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  ADD CONSTRAINT `portfolio_images_ibfk_1` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
