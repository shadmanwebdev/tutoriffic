-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 09, 2024 at 01:10 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment_intents`
--
ALTER TABLE `payment_intents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment_intents`
--
ALTER TABLE `payment_intents`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
