-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 21, 2024 at 01:54 PM
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
-- Database: `tutoriffic`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `account_type_id` int NOT NULL,
  `account_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`account_type_id`, `account_type`) VALUES
(1, 'none'),
(2, 'student'),
(3, 'tutor');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `ad_id` int NOT NULL,
  `ad_title` varchar(255) DEFAULT NULL,
  `about_lesson` text,
  `about_tutor` text,
  `preferred` varchar(255) DEFAULT NULL,
  `recorded_lesson` varchar(255) DEFAULT NULL,
  `exam_board` varchar(255) DEFAULT NULL,
  `free_lessons` varchar(255) DEFAULT NULL,
  `teaching_style` varchar(255) DEFAULT NULL,
  `highest_qualification_level` varchar(255) DEFAULT NULL,
  `experiences` text,
  `current_activity` text,
  `aspirations` text,
  `motivations` text,
  `typical_lessons` text,
  `photo` varchar(255) DEFAULT NULL,
  `tutor_uid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`ad_id`, `ad_title`, `about_lesson`, `about_tutor`, `preferred`, `recorded_lesson`, `exam_board`, `free_lessons`, `teaching_style`, `highest_qualification_level`, `experiences`, `current_activity`, `aspirations`, `motivations`, `typical_lessons`, `photo`, `tutor_uid`) VALUES
(1, NULL, 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', 'no', 'no', 'aqa', 'free', 'Student-centred', 'a-level', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.                              A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', '', '', '', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', NULL, 1),
(2, NULL, NULL, NULL, 'no', 'no', 'aqa', 'free', 'Student-centred', 'a-level', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.                              A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', '', '', '', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', NULL, 2),
(3, NULL, NULL, NULL, 'no', 'no', 'aqa', 'free', 'Student-centred', 'a-level', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.                              A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', '', '', '', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', NULL, 3),
(4, NULL, NULL, NULL, 'no', 'no', 'aqa', 'free', 'Student-centred', 'a-level', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.                              A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', '', '', '', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', NULL, 4),
(5, NULL, NULL, NULL, 'no', 'no', 'aqa', 'free', 'Student-centred', 'a-level', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.                              A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', '', '', '', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', NULL, 5),
(6, NULL, NULL, NULL, 'no', 'no', 'aqa', 'free', 'Student-centred', 'a-level', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.                              A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', '', '', '', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `ad_languages`
--

CREATE TABLE `ad_languages` (
  `ad_language_id` int NOT NULL,
  `ad_id` int NOT NULL,
  `language_id` int NOT NULL,
  `fluency` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_languages`
--

INSERT INTO `ad_languages` (`ad_language_id`, `ad_id`, `language_id`, `fluency`) VALUES
(4, 1, 2, 'native'),
(5, 2, 2, 'native'),
(6, 3, 2, 'native'),
(7, 4, 2, 'native'),
(8, 5, 2, 'native'),
(9, 6, 2, 'native'),
(10, 7, 2, 'native'),
(11, 8, 2, 'native'),
(12, 9, 2, 'native'),
(13, 10, 2, 'native'),
(14, 11, 2, 'native');

-- --------------------------------------------------------

--
-- Table structure for table `ad_lesson_lengths`
--

CREATE TABLE `ad_lesson_lengths` (
  `lesson_length_id` int NOT NULL,
  `ad_id` int NOT NULL,
  `lesson_length` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_lesson_lengths`
--

INSERT INTO `ad_lesson_lengths` (`lesson_length_id`, `ad_id`, `lesson_length`) VALUES
(1, 0, '30 min'),
(2, 0, '1 hour'),
(3, 0, '30 min'),
(4, 0, '1 hour'),
(5, 0, '30 min'),
(6, 0, '1 hour'),
(7, 1, '30 min'),
(8, 1, '1 hour'),
(9, 2, '30 min'),
(10, 2, '1 hour'),
(11, 3, '30 min'),
(12, 3, '1 hour'),
(13, 4, '30 min'),
(14, 4, '1 hour'),
(15, 5, '30 min'),
(16, 5, '1 hour'),
(17, 6, '30 min'),
(18, 6, '1 hour'),
(19, 7, '30 min'),
(20, 7, '1 hour'),
(21, 8, '30 min'),
(22, 8, '1 hour'),
(23, 9, '30 min'),
(24, 9, '1 hour'),
(25, 10, '30 min'),
(26, 10, '1 hour'),
(27, 11, '30 min'),
(28, 11, '1 hour');

-- --------------------------------------------------------

--
-- Table structure for table `ad_levels`
--

CREATE TABLE `ad_levels` (
  `ad_levels_id` int NOT NULL,
  `ad_id` int NOT NULL,
  `ad_level_1` varchar(255) DEFAULT NULL,
  `ad_level_2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_levels`
--

INSERT INTO `ad_levels` (`ad_levels_id`, `ad_id`, `ad_level_1`, `ad_level_2`) VALUES
(8, 1, '', 'GCSE'),
(9, 2, 'A-Level', 'GCSE'),
(10, 3, 'A-Level', NULL),
(11, 4, 'A-Level', NULL),
(12, 5, 'A-Level', NULL),
(13, 6, '', 'GCSE');

-- --------------------------------------------------------

--
-- Table structure for table `ad_locations`
--

CREATE TABLE `ad_locations` (
  `ad_location_id` int NOT NULL,
  `ad_id` int DEFAULT NULL,
  `lesson_location_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_locations`
--

INSERT INTO `ad_locations` (`ad_location_id`, `ad_id`, `lesson_location_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 2, 3),
(5, 3, 3),
(6, 4, 1),
(7, 5, 2),
(8, 6, 3),
(9, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ad_schedule`
--

CREATE TABLE `ad_schedule` (
  `schedule_id` int NOT NULL,
  `ad_id` int NOT NULL,
  `day_of_week` varchar(255) DEFAULT NULL,
  `time_1` varchar(255) DEFAULT NULL,
  `time_2` varchar(255) DEFAULT NULL,
  `time_3` varchar(255) DEFAULT NULL,
  `time_4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_schedule`
--

INSERT INTO `ad_schedule` (`schedule_id`, `ad_id`, `day_of_week`, `time_1`, `time_2`, `time_3`, `time_4`) VALUES
(4, 1, '2', 'morning (7am - 12pm)', 'afternoon (12pm - 5pm)', 'evening (5pm-10pm)', 'night (11pm - 7am)'),
(5, 2, '2', 'morning (7am - 12pm)', 'afternoon (12pm - 5pm)', 'evening (5pm-10pm)', 'night (11pm - 7am)'),
(6, 3, '2', 'morning (7am - 12pm)', 'afternoon (12pm - 5pm)', 'evening (5pm-10pm)', 'night (11pm - 7am)'),
(7, 4, '2', 'morning (7am - 12pm)', 'afternoon (12pm - 5pm)', 'evening (5pm-10pm)', 'night (11pm - 7am)'),
(8, 5, '2', 'morning (7am - 12pm)', 'afternoon (12pm - 5pm)', 'evening (5pm-10pm)', 'night (11pm - 7am)'),
(9, 6, '2', 'morning (7am - 12pm)', 'afternoon (12pm - 5pm)', 'evening (5pm-10pm)', 'night (11pm - 7am)'),
(10, 7, '2', 'morning (7am - 12pm)', 'afternoon (12pm - 5pm)', 'evening (5pm-10pm)', 'night (11pm - 7am)'),
(11, 8, '2', 'morning (7am - 12pm)', 'afternoon (12pm - 5pm)', 'evening (5pm-10pm)', 'night (11pm - 7am)'),
(12, 9, '2', 'morning (7am - 12pm)', 'afternoon (12pm - 5pm)', 'evening (5pm-10pm)', 'night (11pm - 7am)'),
(13, 10, '2', 'morning (7am - 12pm)', 'afternoon (12pm - 5pm)', 'evening (5pm-10pm)', 'night (11pm - 7am)'),
(14, 11, '3', 'morning (7am - 12pm)', 'afternoon (12pm - 5pm)', 'evening (5pm-10pm)', 'night (11pm - 7am)');

-- --------------------------------------------------------

--
-- Table structure for table `ad_subjects`
--

CREATE TABLE `ad_subjects` (
  `ad_subject_id` int NOT NULL,
  `subj_id` int NOT NULL,
  `ad_id` int NOT NULL,
  `edexcel` varchar(255) DEFAULT NULL,
  `aqa` varchar(255) DEFAULT NULL,
  `ocr` varchar(255) DEFAULT NULL,
  `subject_level` varchar(255) DEFAULT NULL,
  `price_hourly` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_subjects`
--

INSERT INTO `ad_subjects` (`ad_subject_id`, `subj_id`, `ad_id`, `edexcel`, `aqa`, `ocr`, `subject_level`, `price_hourly`) VALUES
(5, 1, 1, 'yes', 'yes', 'no', 'A-Level', 10.00),
(6, 2, 1, 'yes', 'yes', 'no', 'GCSE', 15.00),
(7, 5, 3, 'yes', 'yes', 'no', 'A-Level', 20.00),
(8, 6, 4, 'yes', 'yes', 'no', 'GCSE', 35.00),
(9, 7, 5, 'yes', 'yes', 'no', 'A-Level', 19.99),
(10, 8, 6, 'yes', 'yes', 'no', 'GCSE', 12.50),
(11, 1, 2, 'yes', 'yes', 'no', 'A-Level', 10.00),
(12, 2, 2, 'yes', 'yes', 'no', 'GCSE', 15.00);

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` int NOT NULL,
  `addr` varchar(255) DEFAULT NULL,
  `phone` text,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`id`, `addr`, `phone`, `email`, `website`) VALUES
(1, '203 Fake St. Mountain View, San Francisco, California, USA', '+1 232 3235 324', 'youremail@domain.com', 'yoursite.com');

-- --------------------------------------------------------

--
-- Table structure for table `days_of_week`
--

CREATE TABLE `days_of_week` (
  `day_id` int NOT NULL,
  `day_of_week` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `days_of_week`
--

INSERT INTO `days_of_week` (`day_id`, `day_of_week`) VALUES
(1, 'Mon'),
(2, 'Tue'),
(3, 'Wed'),
(4, 'Thu'),
(5, 'Fri'),
(6, 'Sat');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int NOT NULL,
  `question` text,
  `answer` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`) VALUES
(1, 'Lorem ipsum dolor sit amet?', 'Magnis modipsae que voloratati andigen daepeditem quiate conecus aut labore. Laceaque quiae sitiorem rest non restibusaes maio es dem tumquam explabo.'),
(2, 'Lorem ipsum dolor sit amet?', 'Magnis modipsae que voloratati andigen daepeditem quiate conecus aut labore. Laceaque quiae sitiorem rest non restibusaes maio es dem tumquam explabo.'),
(3, 'Lorem ipsum dolor sit amet?', 'Magnis modipsae que voloratati andigen daepeditem quiate conecus aut labore. Laceaque quiae sitiorem rest non restibusaes maio es dem tumquam explabo.');

-- --------------------------------------------------------

--
-- Table structure for table `is_available`
--

CREATE TABLE `is_available` (
  `id` int NOT NULL,
  `tutor_id` int NOT NULL,
  `availability_status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `is_available`
--

INSERT INTO `is_available` (`id`, `tutor_id`, `availability_status`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `language_id` int NOT NULL,
  `lang_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`language_id`, `lang_name`) VALUES
(1, 'Spanish'),
(2, 'French'),
(3, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_locations`
--

CREATE TABLE `lesson_locations` (
  `lesson_location_id` int NOT NULL,
  `location_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lesson_locations`
--

INSERT INTO `lesson_locations` (`lesson_location_id`, `location_name`) VALUES
(1, 'Online'),
(2, 'In person'),
(3, 'Recorded lessons');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `level_id` int NOT NULL,
  `level_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`level_id`, `level_name`) VALUES
(1, 'A-Level'),
(2, 'GCSE');

-- --------------------------------------------------------

--
-- Table structure for table `msgs`
--

CREATE TABLE `msgs` (
  `msg_id` int NOT NULL,
  `msg_content` text,
  `from_id` int NOT NULL,
  `to_id` int DEFAULT NULL,
  `msg_created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msgs`
--

INSERT INTO `msgs` (`msg_id`, `msg_content`, `from_id`, `to_id`, `msg_created_at`) VALUES
(1, 'Lorem ipsum dolor sit amet', 1, 8, '2023-08-29 17:56:04'),
(2, 'Lorem ipsum dolor sit amet', 8, 1, '2023-08-29 17:56:04'),
(3, 'This is a test\r\n\r\nReply if you see this message', 1, 8, '2023-11-21 20:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `msg_files`
--

CREATE TABLE `msg_files` (
  `file_id` int NOT NULL,
  `file_msg_id` int NOT NULL,
  `msg_filename` varchar(255) DEFAULT NULL,
  `msg_file_type` varchar(255) DEFAULT NULL,
  `file_uploaded_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msg_files`
--

INSERT INTO `msg_files` (`file_id`, `file_msg_id`, `msg_filename`, `msg_file_type`, `file_uploaded_at`) VALUES
(1, 1, 'file.pdf', 'pdf', '2023-08-29 17:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `payment_intents`
--

CREATE TABLE `payment_intents` (
  `id` int NOT NULL,
  `payment_intent_id` varchar(255) NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `capture_method` varchar(255) DEFAULT 'manual',
  `connected_account_id` varchar(255) NOT NULL,
  `amount` int NOT NULL,
  `currency` varchar(255) NOT NULL,
  `created_at` int NOT NULL,
  `canceled_at` int DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL,
  `student_id` int NOT NULL,
  `tutor_id` int NOT NULL,
  `request_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_intents`
--

INSERT INTO `payment_intents` (`id`, `payment_intent_id`, `payment_method`, `capture_method`, `connected_account_id`, `amount`, `currency`, `created_at`, `canceled_at`, `payment_status`, `student_id`, `tutor_id`, `request_id`) VALUES
(3, 'pi_3Olf9cH4rZ2esk0g1eiguT2J', 'pm_1Olf9bH4rZ2esk0gg7k0d0Va', 'manual', 'acct_1OTaarQZ0lB36zVa', 1000, 'usd', 1708381060, NULL, 'succeeded', 8, 1, 1),
(4, 'pi_3Olg4iH4rZ2esk0g10IBMkd8', 'pm_1Olg4hH4rZ2esk0gTMS8tv9v', 'manual', 'acct_1OTaarQZ0lB36zVa', 1000, 'usd', 1708384600, NULL, 'succeeded', 1, 1, 2),
(5, 'pi_3Olg7RH4rZ2esk0g1cgD62L8', 'pm_1Olg7RH4rZ2esk0ghcQrKtKb', 'manual', 'acct_1OTaarQZ0lB36zVa', 1000, 'usd', 1708384769, 1708384784, 'canceled', 1, 1, 3),
(6, 'pi_3OlgIbH4rZ2esk0g1vtNLLP5', 'pm_1OlgIaH4rZ2esk0gtJE9HYKz', 'manual', 'acct_1OTaarQZ0lB36zVa', 1000, 'usd', 1708385461, 1708990262, 'canceled', 8, 1, 4),
(7, 'pi_3Olh1eH4rZ2esk0g1qr8hIYO', 'pm_1Olh1dH4rZ2esk0gVwlb05vE', 'manual', 'acct_1OTaarQZ0lB36zVa', 1000, 'usd', 1708388254, 1708993055, 'canceled', 8, 1, 5),
(8, 'pi_3OlhCoH4rZ2esk0g1nxCzNTO', 'pm_1OlhCnH4rZ2esk0gEgCOHevV', 'manual', 'acct_1OTaarQZ0lB36zVa', 1000, 'usd', 1708388946, 1708993747, 'canceled', 8, 1, 6),
(9, 'pi_3PJejiH4rZ2esk0g1bE8Hc0M', 'pm_1PJejhH4rZ2esk0gQhtmJL2V', 'manual', 'acct_1PJeAYQkE7R3AjYs', 1000, 'usd', 1716482606, NULL, 'requires_capture', 8, 1, 17),
(10, 'pi_3PJerPH4rZ2esk0g0az62zcy', 'pm_1PJerOH4rZ2esk0gLDrUo9Xv', 'manual', 'acct_1PJeAYQkE7R3AjYs', 1000, 'usd', 1716483083, NULL, 'requires_capture', 8, 1, 18),
(11, 'pi_3PJet8H4rZ2esk0g1WoE0lJF', 'pm_1PJet8H4rZ2esk0gRNv5LMwF', 'manual', 'acct_1PJeAYQkE7R3AjYs', 1000, 'usd', 1716483190, NULL, 'requires_capture', 8, 1, 19),
(12, 'pi_3PJeufH4rZ2esk0g0PAQCvkb', 'pm_1PJeufH4rZ2esk0gwYWC15aW', 'manual', 'acct_1PJeAYQkE7R3AjYs', 1000, 'usd', 1716483285, NULL, 'requires_capture', 8, 1, 20),
(13, 'pi_3PJfYUH4rZ2esk0g1YU1Y9xD', 'pm_1PJfYTH4rZ2esk0gN15NblSR', 'manual', 'acct_1PJeAYQkE7R3AjYs', 1000, 'usd', 1716485754, NULL, 'requires_capture', 8, 1, 21),
(14, 'pi_3PJfaoH4rZ2esk0g0cy1GOX9', 'pm_1PJfaoH4rZ2esk0gPgz9UmkS', 'manual', 'acct_1PJeAYQkE7R3AjYs', 1000, 'usd', 1716485898, NULL, 'requires_capture', 8, 1, 22),
(15, 'pi_3PJfcjH4rZ2esk0g1RUHbzQj', 'pm_1PJfcjH4rZ2esk0gicomugLN', 'manual', 'acct_1PJeAYQkE7R3AjYs', 1000, 'usd', 1716486017, NULL, 'requires_capture', 8, 1, 23),
(16, 'pi_3PJfePH4rZ2esk0g08bHTznG', 'pm_1PJfeMH4rZ2esk0gX0SFHidA', 'manual', 'acct_1PJeAYQkE7R3AjYs', 1000, 'usd', 1716486121, NULL, 'requires_capture', 8, 1, 24),
(17, 'pi_3PJffmH4rZ2esk0g01NnZ92z', 'pm_1PJffmH4rZ2esk0gcJD6LM1N', 'manual', 'acct_1PJeAYQkE7R3AjYs', 1000, 'usd', 1716486206, NULL, 'requires_capture', 8, 1, 25);

-- --------------------------------------------------------

--
-- Table structure for table `personal_subject_expert`
--

CREATE TABLE `personal_subject_expert` (
  `question_id` int NOT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `question` text,
  `priority_lvl` varchar(255) DEFAULT NULL,
  `attachment_id` varchar(255) DEFAULT NULL,
  `tutor_id` int DEFAULT NULL,
  `student_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personal_subject_expert`
--

INSERT INTO `personal_subject_expert` (`question_id`, `topic`, `question`, `priority_lvl`, `attachment_id`, `tutor_id`, `student_id`, `created_at`) VALUES
(1, 'English', 'Lorem ipsum dolor?', 'High', '1', 1, 8, '2024-02-07 18:19:58'),
(4, 'Mathematics', 'asdasdadas', 'High', NULL, 1, NULL, '2024-02-16 21:32:05'),
(5, 'Mathematics', 'asdasdasd sdad asd sadasd sadasddas', 'Medium', NULL, 1, NULL, '2024-02-16 21:35:17'),
(6, 'Mathematics', 'asdasdasd sdad asd sadasd sadasddas', 'Medium', NULL, 1, NULL, '2024-02-16 21:35:52'),
(7, 'Mathematics', 'asdasdasd sdad asd sadasd sadasddas', 'Medium', NULL, 1, NULL, '2024-02-16 21:37:04'),
(8, 'Mathematics', 'asdasdasd sdad asd sadasd sadasddas', 'Medium', NULL, 1, NULL, '2024-02-16 21:37:27'),
(9, 'Mathematics', 'asdasdasd sdad asd sadasd sadasddas', 'Medium', NULL, 1, NULL, '2024-02-16 21:39:46'),
(10, 'Mathematics', 'asdasdasd sdad asd sadasd sadasddas', 'Medium', NULL, 1, NULL, '2024-02-16 21:49:35'),
(11, 'Mathematics', 'asdasdasd sdad asd sadasd sadasddas', 'Medium', NULL, 1, NULL, '2024-02-16 21:51:20'),
(12, 'Mathematics', 'asdasdasd sdad asd sadasd sadasddas', 'Medium', NULL, 1, NULL, '2024-02-16 21:52:41'),
(13, 'Mathematics', 'asdasdasd sdad asd sadasd sadasddas', 'Medium', NULL, 1, NULL, '2024-02-16 21:52:56'),
(14, 'Mathematics', 'asdasdasd sdad asd sadasd sadasddas', 'Medium', NULL, 1, NULL, '2024-02-16 21:53:42'),
(15, 'Mathematics', 'asdasdasd sdad asd sadasd sadasddas', 'Medium', NULL, 1, NULL, '2024-02-16 21:54:05'),
(16, 'Mathematics', 'asdasdasd sdad asd sadasd sadasddas', 'Medium', '4', 1, NULL, '2024-02-16 21:54:52'),
(17, 'English', 'sadas sdasd asdasda', 'Medium', NULL, 1, NULL, '2024-02-16 21:57:25'),
(18, 'English', 'asdasdas asda dasdasd', 'High', '5', 1, NULL, '2024-02-17 00:03:41');

-- --------------------------------------------------------

--
-- Table structure for table `question_files`
--

CREATE TABLE `question_files` (
  `file_id` int NOT NULL,
  `file_question_id` int NOT NULL,
  `flname` varchar(255) NOT NULL,
  `file_type` varchar(10) NOT NULL,
  `uploaded_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_files`
--

INSERT INTO `question_files` (`file_id`, `file_question_id`, `flname`, `file_type`, `uploaded_at`) VALUES
(1, 13, 'blob.jpeg', 'jpeg', '2024-02-16 21:52:56'),
(2, 14, 'blob.jpeg', 'jpeg', '2024-02-16 21:53:42'),
(3, 15, 'blob.jpeg', 'jpeg', '2024-02-16 21:54:05'),
(4, 16, 'blob.jpeg', 'jpeg', '2024-02-16 21:54:52'),
(5, 18, 'about-1.png', 'png', '2024-02-17 00:03:41');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int NOT NULL,
  `reported_ad_id` int NOT NULL,
  `reported_by` int NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `reported_ad_id`, `reported_by`, `message`, `created_at`) VALUES
(1, 1, 1, 'Please be thoroughly descriptive why you are reporting this ad. Do not submit multiple reports', '2024-10-17 08:04:04'),
(2, 1, 1, 'Please be thoroughly descriptive why you are reporting this ad. Do not submit multiple reports', '2024-10-17 08:05:45'),
(3, 1, 1, 'Please be thoroughly descriptive why you are reporting this ad. Do not submit multiple reports', '2024-10-17 08:05:49'),
(4, 1, 1, ';Please be thoroughly descriptive why you are reporting this ad. Do not submit multiple reports', '2024-10-17 08:06:25'),
(5, 1, 1, 'Please be thoroughly descriptive why you are reporting this ad. Do not submit multiple reports', '2024-10-17 08:08:02'),
(6, 1, 1, 'Please be thoroughly descriptive why you are reporting this ad. Do not submit multiple reports', '2024-10-17 08:14:12'),
(7, 1, 1, 'Please be thoroughly descriptive why you are reporting this ad. Do not submit multiple reports', '2024-10-17 08:14:33'),
(8, 1, 1, 'Please be thoroughly descriptive why you are reporting this ad. Do not submit multiple reports', '2024-10-17 08:14:50'),
(9, 1, 1, 'Please be thoroughly descriptive why you are reporting this ad. Do not submit multiple reports\r\n\r\n', '2024-10-17 08:15:55'),
(10, 1, 1, 'Please be thoroughly descriptive why you are reporting this ad. Do not submit multiple reports\r\n\r\n', '2024-10-17 08:16:09'),
(11, 1, 1, 'Please be thoroughly descriptive why you are reporting this ad. Do not submit multiple reports\r\n\r\n', '2024-10-17 08:16:34'),
(12, 1, 1, 'Please be thoroughly descriptive why you are reporting this ad. Do not submit multiple reports', '2024-10-17 08:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `ad_id` int DEFAULT NULL,
  `tutor_id` int DEFAULT NULL,
  `request_created_by` int NOT NULL,
  `subjects` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `msg` text,
  `expectation` text,
  `booking_date` varchar(255) DEFAULT NULL,
  `booking_time` varchar(255) DEFAULT NULL,
  `lesson_length` varchar(50) DEFAULT NULL,
  `request_type` varchar(50) DEFAULT NULL,
  `request_status` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `student_id`, `ad_id`, `tutor_id`, `request_created_by`, `subjects`, `msg`, `expectation`, `booking_date`, `booking_time`, `lesson_length`, `request_type`, `request_status`, `created_at`, `updated_at`) VALUES
(37, 8, 1, 1, 8, '{\"6\":{\"name\":\"English\",\"price\":\"  \\n                    £15.00\\n                \",\"boards\":[{\"boardId\":\"201\",\"value\":\"Edexcel\"}]}}', 'Hello Jane,\r\n\r\nMy name is George and I am looking for a English teacher. I would like to take lessons at your place or mine. Ideally, I would like to start classes as soon as possible. Would that work for you? Could you contact me so that we can discuss it further?\r\n\r\nHave a great day,\r\n\r\nSee you soon, Shadman', 'Hello Jane,\r\n\r\nMy name is George and I am looking for a English teacher. I would like to take lessons at your place or mine. Ideally, I would like to start classes as soon as possible. Would that work for you? Could you contact me so that we can discuss it further?\r\n\r\nHave a great day,\r\n\r\nSee you soon, Shadman', '15-10-2024', '23:30', '1 hour', 'Free intro call', 'created', '2024-10-09 09:37:51', NULL),
(38, 8, 1, 1, 8, '{\"5\":{\"name\":\"Mathematics\",\"price\":\"  \\n                    £10.00\\n                \",\"boards\":[{\"boardId\":\"201\",\"value\":\"Edexcel\"},{\"boardId\":\"202\",\"value\":\"AQA\"}]},\"6\":{\"name\":\"English\",\"price\":\"  \\n                    £15.00\\n                \",\"boards\":[]}}', 'Hello Jane,\r\n\r\nMy name is George and I am looking for a English teacher. I would like to take lessons at your place or mine. Ideally, I would like to start classes as soon as possible. Would that work for you? Could you contact me so that we can discuss it further?\r\n\r\nHave a great day,\r\n\r\nSee you soon, Shadman', 'Hello Jane,\r\n\r\nMy name is George and I am looking for a English teacher. I would like to take lessons at your place or mine. Ideally, I would like to start classes as soon as possible. Would that work for you? Could you contact me so that we can discuss it further?\r\n\r\nHave a great day,\r\n\r\nSee you soon, Shadman', '15-10-2024', '23:30', '1 hour', 'Free intro call', 'created', '2024-10-09 11:15:26', NULL),
(39, 8, 1, 1, 8, '{\"5\":{\"name\":\"Mathematics\",\"price\":\"  \\n                    £10.00\\n                \",\"boards\":[{\"boardId\":\"201\",\"value\":\"Edexcel\"},{\"boardId\":\"202\",\"value\":\"AQA\"}]},\"6\":{\"name\":\"English\",\"price\":\"  \\n                    £15.00\\n                \",\"boards\":[]}}', 'Hello Jane,\r\n\r\nMy name is George and I am looking for a English teacher. I would like to take lessons at your place or mine. Ideally, I would like to start classes as soon as possible. Would that work for you? Could you contact me so that we can discuss it further?\r\n\r\nHave a great day,\r\n\r\nSee you soon, Shadman', 'Hello Jane,\r\n\r\nMy name is George and I am looking for a English teacher. I would like to take lessons at your place or mine. Ideally, I would like to start classes as soon as possible. Would that work for you? Could you contact me so that we can discuss it further?\r\n\r\nHave a great day,\r\n\r\nSee you soon, Shadman', '15-10-2024', '23:30', '1 hour', 'Free intro call', 'created', '2024-10-09 11:15:53', NULL),
(40, 8, 1, 1, 8, '{\"6\":{\"name\":\"English\",\"price\":\"  \\n                    £15.00\\n                \",\"boards\":[{\"boardId\":\"201\",\"value\":\"Edexcel\"},{\"boardId\":\"202\",\"value\":\"AQA\"}]}}', 'Hello Jane,\r\n\r\nMy name is George and I am looking for a English teacher. I would like to take lessons at your place or mine. Ideally, I would like to start classes as soon as possible. Would that work for you? Could you contact me so that we can discuss it further?\r\n\r\nHave a great day,\r\n\r\nSee you soon, Shadman', 'Hello Jane,\r\n\r\nMy name is George and I am looking for a English teacher. I would like to take lessons at your place or mine. Ideally, I would like to start classes as soon as possible. Would that work for you? Could you contact me so that we can discuss it further?\r\n\r\nHave a great day,\r\n\r\nSee you soon, Shadman', NULL, '', '30 min', 'Free intro call', 'created', '2024-10-10 08:00:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int NOT NULL,
  `ad_id` int NOT NULL,
  `tutor_id` int NOT NULL,
  `student_id` int NOT NULL,
  `rating` decimal(10,1) NOT NULL,
  `review_content` text NOT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `ad_id`, `tutor_id`, `student_id`, `rating`, `review_content`, `created_at`) VALUES
(1, 1, 1, 3, 4.9, 'Perfect! Very helpful!', '2023-11-15 03:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int NOT NULL,
  `sitename` varchar(255) DEFAULT NULL,
  `title_tag` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `copyright_text` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `sitename`, `title_tag`, `meta_description`, `copyright_text`, `contact`) VALUES
(1, 'New Website', 'New Website', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia', 'Coypright © Website', 'contact@website.com');

-- --------------------------------------------------------

--
-- Table structure for table `stripe_accounts`
--

CREATE TABLE `stripe_accounts` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `account_id` varchar(255) DEFAULT NULL,
  `account_type` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `line1` varchar(255) DEFAULT NULL,
  `line2` varchar(255) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `charges_enabled` tinyint(1) DEFAULT NULL,
  `payouts_enabled` tinyint(1) DEFAULT NULL,
  `requirements` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stripe_accounts`
--

INSERT INTO `stripe_accounts` (`id`, `user_id`, `account_id`, `account_type`, `email`, `fullname`, `city`, `country`, `line1`, `line2`, `postal_code`, `state`, `charges_enabled`, `payouts_enabled`, `requirements`, `created_at`) VALUES
(5, 1, 'acct_1PJeAYQkE7R3AjYs', 'standard', 'shadmansakibprozzal@gmail.com', 'Shadman Sakib', 'NYC', 'US', '12 Northwood Drive', NULL, '45701', 'NY', 0, 0, '{\"alternatives\":[],\"current_deadline\":null,\"currently_due\":[],\"disabled_reason\":\"requirements.pending_verification\",\"errors\":[],\"eventually_due\":[\"individual.id_number\"],\"past_due\":[],\"pending_verification\":[\"individual.id_number\"]}', '2024-05-23 06:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `student_languages`
--

CREATE TABLE `student_languages` (
  `student_language_id` int NOT NULL,
  `student_id` int NOT NULL,
  `language_id` int NOT NULL,
  `fluency` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_languages`
--

INSERT INTO `student_languages` (`student_language_id`, `student_id`, `language_id`, `fluency`) VALUES
(1, 8, 1, 'native');

-- --------------------------------------------------------

--
-- Table structure for table `student_levels`
--

CREATE TABLE `student_levels` (
  `student_level_id` int NOT NULL,
  `student_id` int NOT NULL,
  `level_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_levels`
--

INSERT INTO `student_levels` (`student_level_id`, `student_id`, `level_id`) VALUES
(1, 8, 1),
(2, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `student_subjects`
--

CREATE TABLE `student_subjects` (
  `id` int NOT NULL,
  `subj_id` int NOT NULL,
  `student_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_subjects`
--

INSERT INTO `student_subjects` (`id`, `subj_id`, `student_id`) VALUES
(1, 1, 8),
(2, 2, 12),
(3, 3, 12);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subj_id` int NOT NULL,
  `subject_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subj_id`, `subject_name`) VALUES
(1, 'Mathematics'),
(2, 'English'),
(3, 'Sciences'),
(4, 'Biology'),
(5, 'Chemistry'),
(6, 'Physics'),
(7, 'Psychology'),
(8, 'Business'),
(9, 'Economics'),
(10, 'Sociology'),
(11, 'History'),
(12, 'Geography'),
(13, 'Religious Education'),
(14, 'Computer Science'),
(15, 'Art'),
(16, 'Physical Education'),
(17, 'Languages'),
(18, 'Spanish'),
(19, 'French');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `sub_id` int NOT NULL,
  `id` varchar(28) NOT NULL,
  `customer_id` varchar(50) DEFAULT NULL,
  `collection_method` varchar(20) DEFAULT NULL,
  `created_at` int DEFAULT NULL,
  `canceled_at` int DEFAULT NULL,
  `current_period_end` int DEFAULT NULL,
  `subscription_status` varchar(20) DEFAULT NULL,
  `days_until_due` int DEFAULT NULL,
  `invoice_id` varchar(50) DEFAULT NULL,
  `account_id` varchar(50) DEFAULT NULL,
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `subscription_interval` varchar(10) DEFAULT NULL,
  `tutor_id` int DEFAULT NULL,
  `student_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`sub_id`, `id`, `customer_id`, `collection_method`, `created_at`, `canceled_at`, `current_period_end`, `subscription_status`, `days_until_due`, `invoice_id`, `account_id`, `payment_amount`, `currency`, `subscription_interval`, `tutor_id`, `student_id`) VALUES
(1, 'sub_1OlfkzH4rZ2esk0g0T9GHC6k', 'cus_ParTlfo4Z2WTMM', 'charge_automatically', 1708383377, 1716160998, 1708988177, 'canceled', NULL, 'in_1OlfkzH4rZ2esk0gjdK2KGfV', 'acct_1OTaarQZ0lB36zVa', 100.00, 'usd', 'month', 1, 8),
(2, 'sub_1Olg68H4rZ2esk0gc4ecAVP0', 'cus_Parpl3tuJFTsr8', 'charge_automatically', 1708384688, NULL, 1708989488, 'trialing', NULL, 'in_1Olg68H4rZ2esk0gFgsNjYTI', 'acct_1OTaarQZ0lB36zVa', 100.00, 'usd', 'month', 1, 1),
(3, 'sub_1OlgHsH4rZ2esk0gmufPKz4K', 'cus_Pas1nRWyoHCvMR', 'charge_automatically', 1708385416, 1716162679, 1708990216, 'canceled', NULL, 'in_1OlgHsH4rZ2esk0gfBxfDOUQ', 'acct_1OTaarQZ0lB36zVa', 100.00, 'usd', 'month', 1, 8),
(4, 'sub_1OlhAjH4rZ2esk0gWa10RCoq', 'cus_Paswfiqd1OfYCv', 'charge_automatically', 1708388817, 1716166469, 1708993617, 'canceled', NULL, 'in_1OlhAjH4rZ2esk0giD3kAsqZ', 'acct_1OTaarQZ0lB36zVa', 100.00, 'usd', 'month', 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` int NOT NULL,
  `ticket_by` int NOT NULL,
  `ticket_subject` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `screenshots` text,
  `ticket_status` enum('open','closed') DEFAULT 'open',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `ticket_by`, `ticket_subject`, `msg`, `screenshots`, `ticket_status`, `created_at`, `updated_at`) VALUES
(1, 8, 'sd', 'asd', '', 'open', '2024-10-17 09:04:51', NULL),
(2, 8, 'sd', 'asd', '', 'open', '2024-10-17 09:05:26', NULL),
(3, 8, '', '', '', 'open', '2024-10-17 09:05:31', NULL),
(4, 8, 'asdasd', 'sadasd', NULL, 'open', '2024-10-17 09:13:53', NULL),
(5, 8, 'asdasd', 'sadasd', NULL, 'open', '2024-10-17 09:14:28', NULL),
(6, 1, 'asd', 'sadsad', NULL, 'open', '2024-10-17 09:17:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_replies`
--

CREATE TABLE `ticket_replies` (
  `ticket_reply_id` int NOT NULL,
  `reply_type` varchar(255) NOT NULL,
  `support_ticket_id` int NOT NULL,
  `ticket_by` int NOT NULL,
  `msg` text NOT NULL,
  `screenshots` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_replies`
--

INSERT INTO `ticket_replies` (`ticket_reply_id`, `reply_type`, `support_ticket_id`, `ticket_by`, `msg`, `screenshots`, `created_at`, `updated_at`) VALUES
(14, 'member', 1, 8, 'asdasdasdasd', '', '2024-10-21 08:37:39', NULL),
(15, 'member', 1, 8, '123123', '', '2024-10-21 08:37:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `times_of_day`
--

CREATE TABLE `times_of_day` (
  `time_id` int NOT NULL,
  `time_of_day` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `times_of_day`
--

INSERT INTO `times_of_day` (`time_id`, `time_of_day`) VALUES
(1, 'morning (7am - 12pm)'),
(2, 'afternoon (12pm - 5pm)'),
(3, 'evening (5pm-10pm)'),
(4, 'night (11pm - 7am)');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `user_status` varchar(255) DEFAULT 'member',
  `account_status` varchar(255) DEFAULT 'pending',
  `user_account_type_id` int DEFAULT '1',
  `gender` varchar(255) DEFAULT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `skype_id` varchar(255) DEFAULT NULL,
  `postal_address` varchar(255) DEFAULT NULL,
  `certificate_file` varchar(255) DEFAULT NULL,
  `identification_file` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `pwd`, `photo`, `user_status`, `account_status`, `user_account_type_id`, `gender`, `date_of_birth`, `phone`, `skype_id`, `postal_address`, `certificate_file`, `identification_file`, `created_at`, `updated_at`) VALUES
(1, 'Jane', 'Doe', 'jane.doe@example.com', '$2y$11$FHUYy1yizt/pjNBQrY/BEOpCLP8y5a3T/yWXjK0.GHVZ9vTRN9m5.', 'tst-image3.jpg', 'member', 'verified', 3, 'Female', '1990-01-01', '+123456789', 'john_doe_skype', '12 Main St, City', '170044807120655ac747d320f.webp', '170044808415655ac7540f0ed.webp', '2023-11-14 05:02:08', '2023-12-06 17:49:01'),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '$2y$11$FHUYy1yizt/pjNBQrY/BEOpCLP8y5a3T/yWXjK0.GHVZ9vTRN9m5.', 'person_1.jpg', 'member', 'verified', 3, 'Female', '1985-05-15', '+987654321', 'jane_smith_skype', '456 Oak St, Town', 'certificate.pdf', 'id_card.pdf', '2023-11-14 05:02:08', '2023-11-14 05:02:08'),
(3, 'Bob', 'Johnson', 'bob.johnson@example.com', '$2y$11$FHUYy1yizt/pjNBQrY/BEOpCLP8y5a3T/yWXjK0.GHVZ9vTRN9m5.', 'person_2 (1).jpg', 'admin', 'verified', 1, 'Male', '1980-09-20', '+111222333', 'bob_johnson_skype', '789 Pine St, Village', 'certificate.pdf', 'id_card.pdf', '2023-11-14 05:02:08', '2023-11-14 05:02:08'),
(4, 'Helena', 'Walsh', 'helena.walsh@example.com', '$2y$11$FHUYy1yizt/pjNBQrY/BEOpCLP8y5a3T/yWXjK0.GHVZ9vTRN9m5.', 'c1.jpg', 'member', 'verified', 3, 'Male', '1990-01-01', '+123456789', 'john_doe_skype', '123 Main St, City', 'certificate.pdf', 'id_card.pdf', '2023-11-14 05:02:08', '2023-11-14 05:02:08'),
(5, 'Samantha', 'Hayes', 'samantha.hayes@example.com', '$2y$11$FHUYy1yizt/pjNBQrY/BEOpCLP8y5a3T/yWXjK0.GHVZ9vTRN9m5.', 'tst-image2.jpg', 'member', 'verified', 3, 'Female', '1985-05-15', '+987654321', 'jane_smith_skype', '456 Oak St, Town', 'certificate.pdf', 'id_card.pdf', '2023-11-14 05:02:08', '2023-11-14 05:02:08'),
(6, 'Miguel', 'Gomez', 'miguel.gomez@example.com', '$2y$11$FHUYy1yizt/pjNBQrY/BEOpCLP8y5a3T/yWXjK0.GHVZ9vTRN9m5.', '', 'member', 'verified', 3, 'Male', '1980-09-20', '+111222333', 'bob_johnson_skype', '789 Pine St, Village', 'certificate.pdf', 'id_card.pdf', '2023-11-14 05:02:08', '2023-11-14 05:02:08'),
(7, 'Conor', 'Murphy', 'conor.murphy@example.com', '$2y$11$FHUYy1yizt/pjNBQrY/BEOpCLP8y5a3T/yWXjK0.GHVZ9vTRN9m5.', 'tst-image4.jpg', 'member', 'verified', 3, 'Male', '1990-01-01', '+123456789', 'john_doe_skype', '123 Main St, City', 'certificate.pdf', 'id_card.pdf', '2023-11-14 05:02:08', '2023-11-14 05:02:08'),
(8, 'George', 'Wilson', 'george.wilson@example.com', '$2y$11$FHUYy1yizt/pjNBQrY/BEOpCLP8y5a3T/yWXjK0.GHVZ9vTRN9m5.', 'avatar-3.jpg', 'member', 'verified', 2, 'Male', '1990-01-01', '+123456789', 'john_doe_skype', '123 Main St, City', 'certificate.pdf', 'id_card.pdf', '2023-11-14 05:02:08', '2023-11-19 20:02:17'),
(9, 'Shadman', 'Sakib', 'testemail6329@gmail.com', '$2y$11$FHUYy1yizt/pjNBQrY/BEOpCLP8y5a3T/yWXjK0.GHVZ9vTRN9m5.', NULL, 'member', 'verified', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023', '2023-11-14 20:03:05'),
(10, 'Shadman', 'Sakib', 'synotype@gmail.com', '$2y$11$qIJji1FJ9bPIihy7hEpPnuhbrWmqpkag5bd0J7IWRzn5w3Bbe93ZW', NULL, 'member', 'pending', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023', '2023-11-30 18:50:08'),
(12, 'Shadman', 'Sakib', 'synotype3@gmail.com', '$2y$11$hU/f03LzbiQzpo2YHBOWzed2NFdxFOYekqWEkylVu8gPi0CMyFvvK', NULL, 'member', 'pending', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023', '2023-12-01 17:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_availability`
--

CREATE TABLE `user_availability` (
  `availability_id` int NOT NULL,
  `user_id` int NOT NULL,
  `selected_day` varchar(255) DEFAULT NULL,
  `selected_time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_availability`
--

INSERT INTO `user_availability` (`availability_id`, `user_id`, `selected_day`, `selected_time`) VALUES
(22, 1, '26-9-2024', '11:00'),
(23, 1, '26-9-2024', '11:30'),
(24, 1, '3-10-2024', '20:00'),
(25, 1, '3-10-2024', '20:30'),
(26, 1, '3-10-2024', '21:00'),
(27, 1, '8-10-2024', '23:00'),
(28, 1, '15-10-2024', '23:30'),
(29, 8, '26-9-2024', '11:00'),
(30, 8, '26-9-2024', '11:30'),
(31, 8, '3-10-2024', '20:00'),
(32, 8, '3-10-2024', '20:30'),
(33, 8, '3-10-2024', '21:00'),
(34, 8, '8-10-2024', '23:00'),
(35, 8, '15-10-2024', '20:00'),
(36, 8, '15-10-2024', '20:30'),
(37, 8, '15-10-2024', '23:30');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `questions` text,
  `account_type` varchar(50) NOT NULL,
  `other_account_type_details` text,
  `social_media` varchar(50) NOT NULL,
  `other_social_details` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `email`, `phone`, `questions`, `account_type`, `other_account_type_details`, `social_media`, `other_social_details`) VALUES
(1, 'Shadman', 'Sakib', 'testemail6329@gmail.com', '05464556456', 'sadasd', 'Student', NULL, 'LinkedIn', ''),
(2, 'Shadman', 'Sakib', 'testemail6329@gmail.com', '05464556456', 'sadasd', 'Student', '', 'LinkedIn', ''),
(3, 'Shadman', 'Sakib', 'testemail6329@gmail.com', '05464556456', 'sadasd', 'Other', 'czxczxczxc', 'other_social', 'sczxczcx'),
(4, 'Shadman', 'Sakib', 'testemail6329@gmail.com', '05464556456', 'sadasd', 'Student', 'czxczxczxc', 'LinkedIn', 'sczxczcx');

-- --------------------------------------------------------

--
-- Table structure for table `verify_email`
--

CREATE TABLE `verify_email` (
  `id` int NOT NULL,
  `vrf_email` varchar(255) NOT NULL,
  `vrf_selector` text NOT NULL,
  `vrf_token` text NOT NULL,
  `vrf_expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verify_email`
--

INSERT INTO `verify_email` (`id`, `vrf_email`, `vrf_selector`, `vrf_token`, `vrf_expires`) VALUES
(1, 'testemail6329@gmail.com', 'f7df3b002654155d', '$2y$10$gIyoCZh/LQ9RXERUjnYZiORzQnWgC4LNQMW/QreU4466HbM569RP.', '1700011985'),
(2, 'synotype@gmail.com', '85ee0fde74db3c9e', '$2y$10$Qd3ko5vhulkKlPFgB2ZFhO3QzNL9rzh0XrfDPb9ndjlrLk1R1.S5a', '1701390008'),
(3, 'synotype2@gmail.com', 'b860ecd3d5deb746', '$2y$10$A//2twYGRiMv0Dxpx7vt1uksaUdDts45NmCJZHs2g3eb1yKMSxp7y', '1701393823'),
(4, 'synotype3@gmail.com', 'c90d56d7266b281e', '$2y$10$rTpOuBmU2edY46wtvhbHmOOvm85rCQ6sXWeRsiibEal4IgrtzCXJm', '1701473188');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`account_type_id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `ad_languages`
--
ALTER TABLE `ad_languages`
  ADD PRIMARY KEY (`ad_language_id`);

--
-- Indexes for table `ad_lesson_lengths`
--
ALTER TABLE `ad_lesson_lengths`
  ADD PRIMARY KEY (`lesson_length_id`);

--
-- Indexes for table `ad_levels`
--
ALTER TABLE `ad_levels`
  ADD PRIMARY KEY (`ad_levels_id`);

--
-- Indexes for table `ad_locations`
--
ALTER TABLE `ad_locations`
  ADD PRIMARY KEY (`ad_location_id`);

--
-- Indexes for table `ad_schedule`
--
ALTER TABLE `ad_schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `ad_subjects`
--
ALTER TABLE `ad_subjects`
  ADD PRIMARY KEY (`ad_subject_id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days_of_week`
--
ALTER TABLE `days_of_week`
  ADD PRIMARY KEY (`day_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `is_available`
--
ALTER TABLE `is_available`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `lesson_locations`
--
ALTER TABLE `lesson_locations`
  ADD PRIMARY KEY (`lesson_location_id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `msgs`
--
ALTER TABLE `msgs`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `msg_files`
--
ALTER TABLE `msg_files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `payment_intents`
--
ALTER TABLE `payment_intents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_subject_expert`
--
ALTER TABLE `personal_subject_expert`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `question_files`
--
ALTER TABLE `question_files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stripe_accounts`
--
ALTER TABLE `stripe_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_languages`
--
ALTER TABLE `student_languages`
  ADD PRIMARY KEY (`student_language_id`);

--
-- Indexes for table `student_subjects`
--
ALTER TABLE `student_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subj_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  ADD PRIMARY KEY (`ticket_reply_id`);

--
-- Indexes for table `times_of_day`
--
ALTER TABLE `times_of_day`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_availability`
--
ALTER TABLE `user_availability`
  ADD PRIMARY KEY (`availability_id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verify_email`
--
ALTER TABLE `verify_email`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `account_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `ad_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ad_languages`
--
ALTER TABLE `ad_languages`
  MODIFY `ad_language_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ad_lesson_lengths`
--
ALTER TABLE `ad_lesson_lengths`
  MODIFY `lesson_length_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `ad_levels`
--
ALTER TABLE `ad_levels`
  MODIFY `ad_levels_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ad_locations`
--
ALTER TABLE `ad_locations`
  MODIFY `ad_location_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ad_schedule`
--
ALTER TABLE `ad_schedule`
  MODIFY `schedule_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ad_subjects`
--
ALTER TABLE `ad_subjects`
  MODIFY `ad_subject_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `days_of_week`
--
ALTER TABLE `days_of_week`
  MODIFY `day_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `is_available`
--
ALTER TABLE `is_available`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `language_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lesson_locations`
--
ALTER TABLE `lesson_locations`
  MODIFY `lesson_location_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `level_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `msgs`
--
ALTER TABLE `msgs`
  MODIFY `msg_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `msg_files`
--
ALTER TABLE `msg_files`
  MODIFY `file_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_intents`
--
ALTER TABLE `payment_intents`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_subject_expert`
--
ALTER TABLE `personal_subject_expert`
  MODIFY `question_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `question_files`
--
ALTER TABLE `question_files`
  MODIFY `file_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stripe_accounts`
--
ALTER TABLE `stripe_accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_languages`
--
ALTER TABLE `student_languages`
  MODIFY `student_language_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_subjects`
--
ALTER TABLE `student_subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subj_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `sub_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  MODIFY `ticket_reply_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `times_of_day`
--
ALTER TABLE `times_of_day`
  MODIFY `time_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_availability`
--
ALTER TABLE `user_availability`
  MODIFY `availability_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `verify_email`
--
ALTER TABLE `verify_email`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
