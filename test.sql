-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2020 at 07:15 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_master_all`
--

CREATE TABLE `blog_master_all` (
  `id` int(11) NOT NULL,
  `blog_id` varchar(45) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `update_by` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_master_all`
--

INSERT INTO `blog_master_all` (`id`, `blog_id`, `title`, `category`, `description`, `image`, `created_at`, `created_by`, `updated_at`, `update_by`, `status`) VALUES
(1, 'Blog_33509', 'Rookie Moms', 'Food', 'Rookie Moms focuses on various products and activities for babies, toddlers, and preschoolers. Like the name says, the site is aimed at new moms who don’t have much experience with parenthood.', 'blog_images/1601929354img_(34).jpg', '2020-10-05 10:22:34', 'Emp_49304', '0000-00-00 00:00:00', '', '1'),
(2, 'Blog_12626', 'What’s Great About This Blog?', 'Technology', 'Both the company and its consumers produce incredible stories every day. Some of the most interesting are captured on the Microsoft Story Labs blog, which shares interesting pieces on their products and the people who use them.', 'blog_images/1601929671blog_2.jpg', '2020-10-06 05:58:22', 'Emp_49304', '0000-00-00 00:00:00', '', '1'),
(3, 'Blog_70715', 'Miss Thrifty', 'Fashion', 'One of the more popular frugal blogs in the UK, Miss Thrifty is targeting young mums with her money saving, frugal tips and articles. And rightly so! The market is massive and she’s meeting a need for this type of information. Young mums aren’t exactly rolling in cash. They may have had to give up work and are now relying on just one wage coming in, so the need to be more frugal with everyday living is a must.', 'blog_images/1601929750blog_1.png', '2020-10-05 10:29:10', 'Emp_49304', '0000-00-00 00:00:00', '', '1'),
(4, 'Blog_65895', 'Musicians Friend: The HUB', 'Music', 'Shopping for musical instruments can be challenging due to the incredible range of options for any given product category. Plus, quality can vary wildly between different pieces of equipment at different price points. For a newcomer, this can make for an intimidating shopping experience.', 'blog_images/1601929807img_(27).jpg', '2020-10-06 05:53:59', 'Emp_49304', '0000-00-00 00:00:00', '', '1'),
(5, 'Blog_29839', 'Really Easy Char Siu (Chinese BBQ Pork)', 'Food', 'Are you missing Chinese BBQ pork because your favorite local BBQ place has shut down? Try making this easy char siu at home!', 'blog_images/1601929922blog_6.jpg', '2020-10-05 10:32:02', 'Emp_49304', '0000-00-00 00:00:00', '', '1'),
(6, 'Blog_3461', 'Motivation Matters', 'Work', 'John Sylvester’s fantastic blog is pretty much a one-stop-shop on employee engagement.\r\n\r\nHis advice is straight to the point and no-nonsense, with a focus on the employee experience – so beware – after reading, you may just start questioning how great a Manager you really are.', 'blog_images/1601930033blog_4.png', '2020-10-05 10:33:53', 'Emp_49304', '0000-00-00 00:00:00', '', '1'),
(7, 'Blog_55454', 'Learning to Leap', 'Work', 'Employee engagement, benefits, wellbeing, leadership and management development, staff retention, entrepreneurship, learning and development.', 'blog_images/1601930065blog_5.png', '2020-10-05 10:34:25', 'Emp_49304', '0000-00-00 00:00:00', '', '1'),
(8, 'Blog_6198', 'Lighthouse', 'Work', 'Staff retention, employee engagement, leadership and management, developing talent, hiring, performance management, staff retention', 'blog_images/1601930172blog_7.png', '2020-10-05 10:36:12', 'Emp_49304', '0000-00-00 00:00:00', '', '1'),
(9, 'Blog_23963', 'GoNintendo (www.gonintendo.com)', 'Gaming', 'By sheer weight of posts alone, this is a required RSS feed or bookmark for anyone interested in Nintendo gaming, whether Wii or DS. It sucks up stories from around the Internet and aggregates them quickly, offering a central point for the Nintendo news of the day.', 'blog_images/1601930261blog_8.png', '2020-10-05 10:37:41', 'Emp_49304', '0000-00-00 00:00:00', '', '1'),
(10, 'Blog_81727', 'Shacknews (www.shacknews.com)', 'Gaming', 'In truth, Shacknews is one of those sites that blurs the line between a blog and a news site, so comprehensive is its mixture of news and features. With so many blogs chasing the same news, it\'s a worthy read because it still manages to pick up exclusives and new angles', 'blog_images/', '2020-10-05 10:39:09', 'Emp_49304', '0000-00-00 00:00:00', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` int(12) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `user_id` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`id`, `name`, `email`, `mobile`, `address`, `dob`, `user_id`, `password`) VALUES
(4, 'JITENDRA', 'JITENDRAWAGHE@YAHOO.COM', 2147483647, 'GHANSOLI', '2020-10-15', 'Emp_49304', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_master_all`
--
ALTER TABLE `blog_master_all`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_master_all`
--
ALTER TABLE `blog_master_all`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
