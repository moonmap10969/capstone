-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307/
-- Generation Time: Mar 05, 2026 at 07:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fumces_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year_range` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `is_current` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`id`, `year_range`, `semester`, `is_current`, `created_at`, `updated_at`) VALUES
(1, '2025-2026', '2nd Semester', 1, '2026-03-01 13:24:24', '2026-03-01 13:24:24'),
(2, '2024-2025', '1st Semester', 0, '2025-02-28 16:00:00', '2025-02-28 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE `admissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academic_year_id` bigint(20) UNSIGNED DEFAULT NULL,
  `studentNumber` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `studentFirstName` varchar(255) NOT NULL,
  `studentLastName` varchar(255) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `year_level` varchar(255) NOT NULL,
  `previousSchool` varchar(255) DEFAULT NULL,
  `parentFirstName` varchar(255) NOT NULL,
  `parentLastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipCode` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `student_number` varchar(255) DEFAULT NULL,
  `report_card` varchar(255) DEFAULT NULL,
  `birth_certificate` varchar(255) DEFAULT NULL,
  `applicant_photo` varchar(255) DEFAULT NULL,
  `father_photo` varchar(255) DEFAULT NULL,
  `mother_photo` varchar(255) DEFAULT NULL,
  `guardian_photo` varchar(255) DEFAULT NULL,
  `transferee_docs` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `household_income` varchar(50) DEFAULT NULL,
  `household_size` int(11) DEFAULT NULL,
  `employment_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`id`, `academic_year_id`, `studentNumber`, `user_id`, `studentFirstName`, `studentLastName`, `dateOfBirth`, `gender`, `year_level`, `previousSchool`, `parentFirstName`, `parentLastName`, `email`, `phone`, `address`, `city`, `state`, `zipCode`, `street`, `zip`, `status`, `student_number`, `report_card`, `birth_certificate`, `applicant_photo`, `father_photo`, `mother_photo`, `guardian_photo`, `transferee_docs`, `created_at`, `updated_at`, `household_income`, `household_size`, `employment_status`) VALUES
(11, 1, 'TEMP-1', 6, 'Daniel', 'Caesar', '2019-03-04', NULL, 'grade10', NULL, 'Chona', 'Razon', 'elaiza.mharie@gmail.com', '09565129489', '282, Bancal Guagua Pampanga', 'Guagua', 'Region', '2003', '282, Bancal Guagua Pampanga', '2003', 'enrolled', NULL, 'admissions/documents/lJ7P8Yb7qNYoUwMXcmqbEcCbyOtF02xUdLUnv3Ef.png', 'admissions/documents/MHOXQjV4CZjh3O1usx8Oa6ZkvmaCiI2jLVcjBEcj.png', 'admissions/documents/mDCMAo35HPnmFuXw9fBaFOxlbDk1OQxV4AotPh3c.png', 'admissions/documents/AJMKotlM9fMXsfEFBoF16shfEz0VUWAwNF2EMTdx.png', 'admissions/documents/hGBgP50HoFwlk4hPM4FDPFXlShM3QEq7xKEedgmm.png', 'admissions/documents/XUICG9fXQxl8SMr7ycE8mhCskUHKJ9cFe4fiAW1b.png', 'admissions/documents/Tju2B8LhIhZyVMDFomb7yChBZmP6TEIEgeEYZleb.png', '2026-02-02 07:30:53', '2026-02-17 08:41:02', NULL, NULL, NULL),
(13, 1, 'TEMP-2', 8, 'Charles', 'Keith', '2019-03-03', NULL, 'grade7', NULL, 'Wave', 'Test', 'charles@gmail.com', '09565129489', '282, Bancal Guagua Pampanga', 'Guagua', 'Region', '2003', '282, Bancal Guagua Pampanga', '2003', 'enrolled', NULL, 'admissions/documents/ZDcaRBq8zKzrCuyqbpKyYXd1yQ87C0lu5tJSPAUJ.png', 'admissions/documents/h4ylSmRFgcBHRRR3rtxmq5xKa6sn1QtdgDBWv0oc.png', 'admissions/documents/jZdSqDvcCp2xYw1AJCpJ9dQxIX3mmR1EzQWMBVCK.png', 'admissions/documents/BgXWTIeaKyMcGqPGexuqR9l0PC0tqRRoUhMTNNS9.png', 'admissions/documents/1drBNE4vfmvgUxApqqlt1g1VJYVd7p16cktt5XSY.png', 'admissions/documents/YJrLxZQ5szLXpJmi52mS0UP2R39wVCeDxGuzkUgB.png', 'admissions/documents/KnZJyZqbBYrqC0wwI54nqLmV2zhZoM8CSb0Bk1cg.png', '2026-02-02 08:39:26', '2026-02-17 09:09:51', NULL, NULL, NULL),
(14, 1, 'TEMP-3', 9, 'Jeffrey', 'Buckley', '2017-03-03', NULL, 'grade8', NULL, 'Jeff', 'Test', 'jeff@gmail.com', '09565129489', '282, Bancal Guagua Pampanga', 'Guagua', 'Region', '2003', '282, Bancal Guagua Pampanga', '2003', 'approved', NULL, 'admissions/documents/U6Dr7d3wzbGOCs7wjk57TuPQZJT37QWmE5TbaYsH.png', 'admissions/documents/CrMWDOTTUjNPyzRezvtvalWb9dJNQy8oypqUYa4M.png', 'admissions/documents/iIFbNnZr6QbGLPbiC0HPvidh3I0QBwghzRTgkwGy.png', 'admissions/documents/uVpucgAxbXEDCDJls3mSvNA2UyHzWZaBzDeMxXD0.png', 'admissions/documents/WErjizfkqg5ZccoRhWuU92MN1FjzYQKMekVTqnIR.png', 'admissions/documents/etRLRyLYWV0cYozucbpBH5VH9v0xa0gNfGhPilmn.png', 'admissions/documents/jicMRC7KXwJoWi0Lg1axEMGt0erbwC9u8E6B3Sp6.png', '2026-02-02 09:30:24', '2026-02-02 09:30:38', NULL, NULL, NULL),
(19, 1, 'TEMP-8', 15, 'Jacob', 'Razon', '2016-08-02', NULL, 'grade5', NULL, 'Chona', 'Razon', 'elaiza.mharie@gmail.com', '09565129489', '282, Bancal Guagua Pampanga', 'Guagua', 'Region', '2003', '282, Bancal Guagua Pampanga', '2003', 'enrolled', NULL, 'admissions/documents/qMHswE0KxSg8XOXG4KE14OlW71s2JfCIUtFOOT9n.png', 'admissions/documents/XQUAsbiPIt6RK7lhy0YHJgNbYIfV8O41KQFf77nR.png', 'admissions/documents/EkiOgr5CyiwymV86uiXEN69mJCXMTPRMkdAWxjp0.png', 'admissions/documents/AI18dAOnLeoSI720oYIUcya7p68bIj8JKflIfgsV.png', 'admissions/documents/0P8jplXj79TWfBEw9tkSJf2nMTxx97Lf4e1uUnMH.png', 'admissions/documents/Kn2yM2Ido1mlMRWZjfhVTsZ1Bhp8az7vLSRZwfct.png', 'admissions/documents/O2hSMSjed38bVv2TO7D41uMVBr6Oi8rV5zjFN7pU.png', '2026-02-05 01:55:08', '2026-02-17 09:12:20', NULL, NULL, NULL),
(20, 1, 'TEMP-9', 17, 'James', 'Razon', '2016-08-02', NULL, 'grade7', NULL, 'Chona', 'Razon', 'elaiza.mharie@gmail.com', '09565129489', '282, Bancal Guagua Pampanga', 'Guagua', 'Region', '2003', '282, Bancal Guagua Pampanga', '2003', 'enrolled', NULL, 'admissions/documents/A5BaWlB2VT9Q0qzS9QbSP7ddR40gBAo39WRiEuAt.png', 'admissions/documents/Zu6pBSVo4RwXF9iGRoweVQPunYzTRqPJYjWHT8RR.png', 'admissions/documents/LJJqwtXEBokr3mC0xObeqHj0eUSrTMdTcl4Qvzto.png', 'admissions/documents/o7ySIlVgg6V64QUyypGApCmVqzoM5HhNPpDuXyjb.png', 'admissions/documents/E2XlXBHVi9QiPmENGpIhbsG7qvHGg0vFWDcpdVtg.png', 'admissions/documents/RneeMhzBO3ezXXHq7K5tzNkTRBXx94B3JGuv78Yc.png', 'admissions/documents/KHm359TiJ6FGatTQ0qGJMAcCXaG1qrz0Bvfz5RQj.png', '2026-02-09 01:19:31', '2026-02-18 20:25:27', NULL, NULL, NULL),
(21, 1, 'TEMP-10', 18, 'John', 'Salonga', '2016-03-03', NULL, 'grade6', NULL, 'Tricia', 'Salonga', 'tricia2@gmail.com', '09565129489', '282, Bancal Guagua Pampanga', 'Guagua', 'Region', '2003', '282, Bancal Guagua Pampanga', '2003', 'pending', NULL, 'admissions/documents/R3poxI3rohmmnywX0BAL4UBaZxuC1jYJEQbVbdJA.png', 'admissions/documents/CYh4jHdEsfFF8tYgf1RyiViNXjrCMxFskXhqyEAT.png', 'admissions/documents/PTP5rHVg1DHhpDeHYzVPoMTLoyZif1jCjaa4eD2f.png', 'admissions/documents/yD9RXRdaYrO2NQsaF3pPIULZlpvfZRX8w8B0oeON.png', 'admissions/documents/ytH6JHUzVcnDIhQDy0EROsItl7WEhYQuXvXpf9d4.png', 'admissions/documents/7RLzBYhEVx8YqH20pGaC8na4tST11rqZEEUL0iXZ.png', 'admissions/documents/tprGPgEOuGJVEQokLhOlRk7E0GRwCWDOVNoDT49U.png', '2026-02-09 01:26:32', '2026-02-09 01:26:32', NULL, NULL, NULL),
(22, 1, 'TEMP-11', 19, 'Noemi', 'Mercado', '2016-02-03', NULL, 'grade5', NULL, 'Normita', 'Mercado', 'normita@gmail.com', '09565129489', '282, Bancal Guagua Pampanga', 'Guagua', 'Region', '2003', '282, Bancal Guagua Pampanga', '2003', 'pending', NULL, 'admissions/documents/SXCKWlv8R495I1BTguFhyoaDk1f40JokgSB2DlvE.png', 'admissions/documents/m7pqMFebre2IRQHKtW1ImBXk75EOr105hsOJKqte.png', 'admissions/documents/HRQTOrUWaLoWPBSvuB1CVbp4FImJPDyyAHzLx53Q.png', 'admissions/documents/PED6VYpYCTx9aVSIA1QgCbRjUtyX5GvkvVZXwusa.png', 'admissions/documents/fVL3EQ6ofrxDX862kVfFMU7vROQZiWJgSJ9rbIoB.png', 'admissions/documents/4nMEx43L8b612q4t4w0aipNRTfhF5GUM6D9KX2IR.png', 'admissions/documents/0xfT2tXR1KqgzogsS2bcgdYAsszlFlU04zk1qwKD.png', '2026-02-09 01:31:23', '2026-02-09 01:31:23', NULL, NULL, NULL),
(23, 1, 'TEMP-12', 59, 'Bruno', 'Mars', '2003-03-03', NULL, 'grade9', 'GNC', 'Chona', 'Razon', 'elaiza.mharie@gmail.com', '09565129489', '282, Bancal Guagua Pampanga', 'Guagua', 'Region', '2003', '282, Bancal Guagua Pampanga', '2003', 'pending', NULL, 'admissions/documents/03uuAARQyUv8llSnijO3NPL8HF4YbQqOmYCxufIq.png', 'admissions/documents/qnfZ4EEbDMGxN4WwxnVEC7xuWLUy403m2m1tQiGE.png', 'admissions/documents/rjaupbeissltnqFsgBYs70wMtd4X2riyUEPK9ZjN.png', 'admissions/documents/H4KAAVafkLEb19F0Po8y3Qf1mNm81SYmc5IKoQzR.png', 'admissions/documents/e9yZ0oi2EZmCxJEZ1t0pqHe4YXBwHfegvSh7ExNn.png', 'admissions/documents/Q7ZPRAYViBdmGRVNR6petOsxywt85CEccTAclJFK.png', 'admissions/documents/EZBaMf7Fl0gbZosWQnFDGhO1qZMbASFZdzeHKHix.png', '2026-02-16 09:29:04', '2026-02-16 09:29:04', NULL, NULL, NULL),
(24, 1, 'TEMP-13', 59, 'Bruno', 'Mars', '2003-03-03', NULL, 'grade9', 'GNC', 'Chona', 'Razon', 'elaiza.mharie@gmail.com', '09565129489', '282, Bancal Guagua Pampanga', 'Guagua', 'Region', '2003', '282, Bancal Guagua Pampanga', '2003', 'approved', NULL, 'admissions/documents/iAcNp183aymFl8wjMiuIbFJ7aszjLKpyvkyKsxhB.png', 'admissions/documents/dVPj0p1XBZSL4ljMp1ZRcr1eEfYssXxJT4cmULEu.png', 'admissions/documents/PnyvM6Ty2XZlwGdUGzNW8OukoOQiaWm2ZwzN5zoC.png', 'admissions/documents/4wHAR49j43zfEglWYJazWSQfcUyDdxH0Kyrq5jcA.png', 'admissions/documents/1yFTzi4vPKA4tvymCGXYcsr697jNPLpeIkvP4Il8.png', 'admissions/documents/jKNy7MPYecsVaOK0uYDGTvZitbNVXXWvz01xNfrt.png', 'admissions/documents/LPjugglolSkWuUNCyx0p3LEdtZ77eMhvOhHNkgpm.png', '2026-02-16 09:29:51', '2026-02-16 09:42:26', NULL, NULL, NULL),
(25, 1, 'SN-2026-0025', 42, 'Vince', 'Loverez', '2016-03-03', NULL, 'grade7', NULL, 'Chona', 'Razon', 'elaiza.mharie@gmail.com', '09565129489', '282, Bancal Guagua Pampanga', 'Guagua', 'Region', '2003', '282, Bancal Guagua Pampanga', '2003', 'enrolled', NULL, 'admissions/documents/vvEeUy8sETo6ijbvde4vHmeOAkKLWStjPtpjfh3P.png', 'admissions/documents/PVkeDbwWT6kG9iraAWPREorpxbu8pLykgQpOnnXF.png', 'admissions/documents/9Rk48MXuUp78StS405BrM0KPGQ6Ms9ACcXJ1cMIq.png', 'admissions/documents/E2b3niQPyTEJHPBCKpNNfYM5mJ1f90hl9xVeTE7V.png', 'admissions/documents/CsP8MJBteamDieNFPEnierLAujsPTAdxW4fzg61K.png', 'admissions/documents/LrudOLmv18oEcgfCLYwyMos9nzMn4DmtNRyWfHyp.png', NULL, '2026-02-17 07:54:16', '2026-02-17 08:42:29', NULL, NULL, NULL),
(26, 1, '2026000026', 45, 'Jefferson', 'Lite', '2016-03-03', NULL, 'kinder2', NULL, 'vince', 'loverez', 'vince@gmail.com', '09271591627', '282, Bancal Guagua Pampanga', 'Guagua', 'Region', '2003', '282, Bancal Guagua Pampanga', '2003', 'enrolled', NULL, 'admissions/documents/AOP13wAYZR8scJqoLE9hNiZfyrzqdbr2coucq9Tu.png', 'admissions/documents/EVWZAd6i0plOYwVSafqBbuMUpldMyVVLGdZvEXfn.png', 'admissions/documents/xQixrs8CnOvu69ALghzj0ZQaDvU4pNBhg6PMsm8k.png', 'admissions/documents/maIEjys4nRWm9dV988erCSebrowCjCj1edwP9nXw.png', 'admissions/documents/2gBcVdX1h5zTuuUhTlqFDDCaZZLQKr5GUWiDrs0n.png', 'admissions/documents/zptw94jqshTlwBBZwS1G7PSnDfDEvsCKmseeSAl5.png', NULL, '2026-02-18 22:44:34', '2026-02-24 09:21:48', NULL, NULL, NULL),
(27, 1, '2026000027', 46, 'Channel', 'Oronico', '2016-01-02', NULL, 'grade10', NULL, 'Bernadette', 'Oronico', 'oronico@gmail.com', '095651291489', 'University Tower 5', 'Sampaloc', 'Region', '2003', 'University Tower 5', '2003', 'enrolled', NULL, 'admissions/documents/ufxS9VOGJ13F8wvvUQLN3AQCSFfML0VsI67KKErf.png', 'admissions/documents/bywW53GQBCKrL2g7xMr6eMtnqeXwYRDHuekEOsFc.png', 'admissions/documents/tu9y2IYb9zes0mW0PJP3eohqOGUhove8dTJwnZRb.png', 'admissions/documents/kvUS7JVM7QkpcMMPV3W6qNmZTv66cmU4aHG5UGs1.png', 'admissions/documents/9444bafDwb2MFOqwibpPL3ebhGaAbImQd8fbi9r6.png', 'admissions/documents/K1XMh1ZjTYbnaqXqDNQRFohNjauS1TfmxYhSsmrP.png', NULL, '2026-02-19 00:11:35', '2026-02-19 00:18:19', NULL, NULL, NULL),
(28, 1, 'PENDING-1771853597', 53, 'Sophie', 'Pring', '2020-10-17', NULL, 'kinder1', NULL, 'Almira', 'Pring', 'almira@gmail.com', '09565129489', '282, Bancal Guagua Pampanga', 'Guagua', 'Region', '2003', '282, Bancal Guagua Pampanga', '2003', 'pending', NULL, 'admissions/documents/3ZrftRQ5jvoybdP8lYiLYptFfKwEeuRtR5toNAOy.png', 'admissions/documents/hj82I0DQPMUkhnP816K6oVgiJhSk58wmoCKjnUFp.png', 'admissions/documents/vvswhuzPs5e7SB5AcZV1wrHhxf61n9nqgmiOhFUx.png', 'admissions/documents/o3vgBGnZ3ODtefsZMLzkNqoqc2W0jDa2SUhgCjb2.png', 'admissions/documents/ArISdROrsO56FxvhIfBNaMQ0TNUSDTazdyxwnJde.png', 'admissions/documents/A9zlcT25HULkihVjDb7iALSYTvQQTXksMNBDppic.png', NULL, '2026-02-23 05:33:17', '2026-02-23 05:33:17', NULL, NULL, NULL),
(29, 1, 'PENDING-1771944069', 41, 'bern', 'coloma', '2005-01-24', NULL, 'grade10', NULL, 'Chona', 'Razon', 'elaiza.mharie@gmail.com', '09565129489', '282, Bancal Guagua Pampanga', 'Guagua', 'Region', '2003', '282, Bancal Guagua Pampanga', '2003', 'pending', NULL, 'admissions/documents/Vzaspyo8bav6MIxxlEfSQW9ZCTBpv3677q4I6LTk.png', 'admissions/documents/Gr7vwGjtcmXQ92iHLcxeY0J56hdIIFBlEod9n3wH.png', 'admissions/documents/nbFh1DNJvV2yFQF5nLPFBh1Ji0dE6r3J1WC5tStk.png', 'admissions/documents/uHCsYouyLHIuEkAMOFPsdpfg8Z0PPvPGsIoDjvXU.png', 'admissions/documents/jZKeQF6rvrQmb2Ts4ZTsskZ0dFc07AcYdmfDRicA.png', 'admissions/documents/a4VkdT4T5ra6Get4dmCjldAf3uBBezCrytzlqJiB.png', NULL, '2026-02-24 06:41:09', '2026-02-24 06:41:09', NULL, NULL, NULL),
(30, 1, '2026000030', 41, 'Chona', 'Razon', '2026-02-03', NULL, 'grade9', NULL, 'Chona', 'Razon', 'elaiza.mharie@gmail.com', '09565129489', '282, Bancal Guagua Pampanga', 'Guagua', 'Region', '2003', '282, Bancal Guagua Pampanga', '2003', 'approved', NULL, 'admissions/documents/xXAC96wgHqSTKpmleHxjHiZFEFJzijBZmHclvPSh.png', 'admissions/documents/KjA3oAMnL2HnDbKCUJopf5I2dINvlmip9m7QAxfJ.png', 'admissions/documents/pFh0YFIgur41pW0ubfVHwE2fdxuYjfWsF2VMdiOK.png', 'admissions/documents/o6hKOPsepwyw6cwF2GSo4Le4H0p3tvKeUnl5gl8j.png', 'admissions/documents/iRwvMGGfvnU0uKeXAMzxhKsJRtOv2NXhzgpbFDmA.png', 'admissions/documents/16armzOvuZWgjaUMvmiSVn9DvjTEiryIw22oLJYa.png', NULL, '2026-02-24 06:43:56', '2026-02-24 08:02:39', NULL, NULL, NULL),
(40, 1, '2026000040', 100, 'Zoe', 'Saldana', '2021-02-14', NULL, 'kinder1', NULL, 'Marco', 'Perego', 'zoe.s@email.com', '09170000100', 'Pandora St', 'Manila', 'NCR', '1000', 'Street 100', '1000', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:05', '2026-02-24 09:23:51', NULL, NULL, NULL),
(41, 1, '2026000041', 101, 'Adam', 'Driver', '2020-05-19', NULL, 'kinder2', NULL, 'Joe', 'Driver', 'adam.d@email.com', '09170000101', 'Galaxy Way', 'Pasig', 'NCR', '1600', 'Street 101', '1600', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:05', '2026-02-24 09:22:00', NULL, NULL, NULL),
(42, 1, '2026000042', 102, 'Bella', 'Hadid', '2019-10-09', NULL, 'grade1', NULL, 'Mohamed', 'Hadid', 'bella.h@email.com', '09170000102', 'Runway Dr', 'Quezon City', 'NCR', '1100', 'Street 102', '1100', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:05', '2026-02-25 01:22:27', NULL, NULL, NULL),
(43, 1, '2026000043', 103, 'Chris', 'Evans', '2018-06-13', NULL, 'grade2', NULL, 'Robert', 'Evans', 'chris.e@email.com', '09170000103', 'Shield Blvd', 'Makati', 'NCR', '1200', 'Street 103', '1200', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:05', '2026-02-24 08:15:58', NULL, NULL, NULL),
(44, 1, '2026000044', 104, 'Dua', 'Lipa', '2019-08-22', NULL, 'grade1', NULL, 'Dukagjin', 'Lipa', 'dua.l@email.com', '09170000104', 'Levitating St', 'Taguig', 'NCR', '1630', 'Street 104', '1630', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:05', '2026-03-02 04:56:52', NULL, NULL, NULL),
(45, 1, '2026000045', 105, 'Eddie', 'Redmayne', '2021-01-06', NULL, 'kinder1', NULL, 'Richard', 'Redmayne', 'eddie.r@email.com', '09170000105', 'Beasts Rd', 'Manila', 'NCR', '1000', 'Street 105', '1000', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:05', '2026-02-24 09:23:51', NULL, NULL, NULL),
(46, 1, '2026000046', 106, 'Florence', 'Pugh', '2020-01-03', NULL, 'kinder2', NULL, 'Clinton', 'Pugh', 'florence.p@email.com', '09170000106', 'Widow Ave', 'Pasig', 'NCR', '1600', 'Street 106', '1600', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:05', '2026-02-24 08:39:23', NULL, NULL, NULL),
(47, 1, '2026000047', 107, 'Gal', 'Gadot', '2019-04-30', NULL, 'grade1', NULL, 'Michael', 'Gadot', 'gal.g@email.com', '09170000107', 'Themyscira St', 'Quezon City', 'NCR', '1100', 'Street 107', '1100', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:05', '2026-03-02 04:56:52', NULL, NULL, NULL),
(48, 1, '2026000048', 108, 'Henry', 'Cavill', '2018-05-05', NULL, 'grade2', NULL, 'Colin', 'Cavill', 'henry.c@email.com', '09170000108', 'Krypton St', 'Makati', 'NCR', '1200', 'Street 108', '1200', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:05', '2026-02-24 08:16:38', NULL, NULL, NULL),
(49, 1, '2026000049', 109, 'Iris', 'West', '2019-09-24', NULL, 'grade1', NULL, 'Joe', 'West', 'iris.w@email.com', '09170000109', 'Central City', 'Taguig', 'NCR', '1630', 'Street 109', '1630', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:05', '2026-02-24 09:28:46', NULL, NULL, NULL),
(50, 1, '2026000050', 110, 'Jack', 'Sparrow', '2021-04-10', NULL, 'kinder1', NULL, 'Edward', 'Teague', 'jack.s@email.com', '09170000110', 'Black Pearl St', 'Manila', 'NCR', '1000', 'Street 110', '1000', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:35', '2026-02-24 09:23:51', NULL, NULL, NULL),
(51, 1, '2026000051', 111, 'Katniss', 'Everdeen', '2020-05-08', NULL, 'kinder2', NULL, 'Mr.', 'Everdeen', 'katniss.e@email.com', '09170000111', 'District 12', 'Pasig', 'NCR', '1600', 'Street 111', '1600', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:35', '2026-02-24 09:22:00', NULL, NULL, NULL),
(52, 1, '2026000052', 112, 'Lara', 'Croft', '2019-02-14', NULL, 'grade1', NULL, 'Richard', 'Croft', 'lara.c@email.com', '09170000112', 'Croft Manor', 'Quezon City', 'NCR', '1100', 'Street 112', '1100', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:35', '2026-03-02 04:56:52', NULL, NULL, NULL),
(53, 1, '2026000053', 113, 'Marty', 'McFly', '2018-06-12', NULL, 'grade2', NULL, 'George', 'McFly', 'marty.m@email.com', '09170000113', 'Hill Valley', 'Makati', 'NCR', '1200', 'Street 113', '1200', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:35', '2026-02-24 08:17:16', NULL, NULL, NULL),
(54, 1, '2026000054', 114, 'Natasha', 'Romanoff', '2019-11-22', NULL, 'grade1', NULL, 'Ivan', 'Romanoff', 'natasha.r@email.com', '09170000114', 'Red Room Rd', 'Taguig', 'NCR', '1630', 'Street 114', '1630', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:35', '2026-03-02 04:56:52', NULL, NULL, NULL),
(55, 1, '2026000055', 115, 'Oscar', 'Isaac', '2021-03-09', NULL, 'kinder1', NULL, 'Maria', 'Isaac', 'oscar.i@email.com', '09170000115', 'Moon Knight Dr', 'Manila', 'NCR', '1000', 'Street 115', '1000', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:35', '2026-02-24 09:23:51', NULL, NULL, NULL),
(56, 1, '2026000056', 116, 'Peter', 'Parker', '2020-08-10', NULL, 'kinder2', NULL, 'Richard', 'Parker', 'peter.p@email.com', '09170000116', 'Queens St', 'Pasig', 'NCR', '1600', 'Street 116', '1600', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:35', '2026-02-24 09:22:00', NULL, NULL, NULL),
(57, 1, '2026000057', 117, 'Quinn', 'Fabray', '2019-07-04', NULL, 'grade1', NULL, 'Russell', 'Fabray', 'quinn.f@email.com', '09170000117', 'Lima Way', 'Quezon City', 'NCR', '1100', 'Street 117', '1100', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:35', '2026-03-02 04:56:52', NULL, NULL, NULL),
(58, 1, '2026000058', 118, 'Rose', 'Dawson', '2018-10-05', NULL, 'grade2', NULL, 'Jack', 'Dawson', 'rose.d@email.com', '09170000118', 'Titanic Blvd', 'Makati', 'NCR', '1200', 'Street 118', '1200', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:35', '2026-02-24 08:17:53', NULL, NULL, NULL),
(59, 1, '2026000059', 119, 'Steve', 'Rogers', '2019-07-04', NULL, 'grade1', NULL, 'Joseph', 'Rogers', 'steve.r@email.com', '09170000119', 'Brooklyn Rd', 'Taguig', 'NCR', '1630', 'Street 119', '1630', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:08:35', '2026-03-02 04:56:52', NULL, NULL, NULL),
(60, 1, '2026000060', 120, 'Thor', 'Odinson', '2021-08-11', NULL, 'kinder1', NULL, 'Odin', 'Borson', 'thor.o@email.com', '09170000120', 'Asgard Ave', 'Manila', 'NCR', '1000', 'Street 120', '1000', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:09:40', '2026-02-24 09:23:51', NULL, NULL, NULL),
(61, 1, '2026000061', 121, 'Uma', 'Thurman', '2020-04-29', NULL, 'kinder2', NULL, 'Robert', 'Thurman', 'uma.t@email.com', '09170000121', 'Kill Bill St', 'Pasig', 'NCR', '1600', 'Street 121', '1600', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:09:40', '2026-02-24 09:22:00', NULL, NULL, NULL),
(62, 1, '2026000062', 122, 'Vito', 'Corleone', '2019-12-07', NULL, 'grade1', NULL, 'Antonio', 'Corleone', 'vito.c@email.com', '09170000122', 'Godfather Rd', 'Quezon City', 'NCR', '1100', 'Street 122', '1100', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:09:40', '2026-03-02 04:56:52', NULL, NULL, NULL),
(63, 1, '2026000063', 123, 'Will', 'Smith', '2018-09-25', NULL, 'grade2', NULL, 'Willard', 'Smith', 'will.s@email.com', '09170000123', 'Bel-Air Dr', 'Makati', 'NCR', '1200', 'Street 123', '1200', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:09:40', '2026-02-24 08:18:32', NULL, NULL, NULL),
(64, 1, '2026000064', 124, 'Xena', 'Warrior', '2019-02-15', NULL, 'grade1', NULL, 'Atrius', 'Warrior', 'xena.w@email.com', '09170000124', 'Amphipolis', 'Taguig', 'NCR', '1630', 'Street 124', '1630', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:09:40', '2026-03-02 04:56:52', NULL, NULL, NULL),
(65, 1, '2026000065', 125, 'Yara', 'Greyjoy', '2021-01-19', NULL, 'kinder1', NULL, 'Balon', 'Greyjoy', 'yara.g@email.com', '09170000125', 'Iron Islands', 'Manila', 'NCR', '1000', 'Street 125', '1000', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:09:40', '2026-02-24 09:23:51', NULL, NULL, NULL),
(66, 1, '2026000066', 126, 'Zelda', 'Hyrule', '2020-02-21', NULL, 'kinder2', NULL, 'King', 'Hyrule', 'zelda.h@email.com', '09170000126', 'Hyrule Castle', 'Pasig', 'NCR', '1600', 'Street 126', '1600', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:09:40', '2026-02-24 09:29:52', NULL, NULL, NULL),
(67, 1, '2026000067', 127, 'Arthur', 'Curry', '2019-06-16', NULL, 'grade1', NULL, 'Thomas', 'Curry', 'arthur.c@email.com', '09170000127', 'Atlantis St', 'Quezon City', 'NCR', '1100', 'Street 127', '1100', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:09:40', '2026-03-02 04:56:52', NULL, NULL, NULL),
(68, 1, '2026000068', 128, 'Bruce', 'Wayne', '2018-02-19', NULL, 'grade2', NULL, 'Thomas', 'Wayne', 'bruce.w@email.com', '09170000128', 'Wayne Manor', 'Makati', 'NCR', '1200', 'Street 128', '1200', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:09:40', '2026-02-24 08:19:27', NULL, NULL, NULL),
(69, 1, '2026000069', 129, 'Clark', 'Kent', '2019-04-18', NULL, 'grade1', NULL, 'Jonathan', 'Kent', 'clark.k@email.com', '09170000129', 'Smallville Rd', 'Taguig', 'NCR', '1630', 'Street 129', '1630', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:09:40', '2026-03-02 04:56:52', NULL, NULL, NULL),
(70, 1, '2026000070', 130, 'Diana', 'Prince', '2021-10-12', NULL, 'kinder1', NULL, 'Hippolyta', 'Prince', 'diana.p@email.com', '09170000130', 'Themyscira Rd', 'Manila', 'NCR', '1000', 'Street 130', '1000', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:14', '2026-02-24 09:26:31', NULL, NULL, NULL),
(71, 1, '2026000071', 131, 'Barry', 'Allen', '2020-03-14', NULL, 'kinder2', NULL, 'Henry', 'Allen', 'barry.a@email.com', '09170000131', 'Flash Way', 'Pasig', 'NCR', '1600', 'Street 131', '1600', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:14', '2026-02-24 09:29:52', NULL, NULL, NULL),
(72, 1, '2026000072', 132, 'Victor', 'Stone', '2019-05-20', NULL, 'grade1', NULL, 'Silas', 'Stone', 'vic.s@email.com', '09170000132', 'Star Labs', 'Quezon City', 'NCR', '1100', 'Street 132', '1100', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:14', '2026-03-02 04:56:52', NULL, NULL, NULL),
(73, 1, '2026000073', 133, 'Hal', 'Jordan', '2018-01-15', NULL, 'grade2', NULL, 'Martin', 'Jordan', 'hal.j@email.com', '09170000133', 'Coast City', 'Makati', 'NCR', '1200', 'Street 133', '1200', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:14', '2026-02-24 08:20:01', NULL, NULL, NULL),
(74, 1, '2026000074', 134, 'Billy', 'Batson', '2019-12-01', NULL, 'grade1', NULL, 'Marilyn', 'Batson', 'billy.b@email.com', '09170000134', 'Rock of Eternity', 'Taguig', 'NCR', '1630', 'Street 134', '1630', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:14', '2026-03-02 04:56:52', NULL, NULL, NULL),
(75, 1, '2026000075', 135, 'Oliver', 'Queen', '2021-04-16', NULL, 'kinder1', NULL, 'Robert', 'Queen', 'ollie.q@email.com', '09170000135', 'Star City', 'Manila', 'NCR', '1000', 'Street 135', '1000', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:14', '2026-02-24 09:26:31', NULL, NULL, NULL),
(76, 1, '2026000076', 136, 'Dinah', 'Lance', '2020-09-22', NULL, 'kinder2', NULL, 'Larry', 'Lance', 'dinah.l@email.com', '09170000136', 'Canary Cry', 'Pasig', 'NCR', '1600', 'Street 136', '1600', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:14', '2026-02-24 09:29:52', NULL, NULL, NULL),
(77, 1, '2026000077', 137, 'Kara', 'Danvers', '2019-06-18', NULL, 'grade1', NULL, 'Jeremiah', 'Danvers', 'kara.d@email.com', '09170000137', 'National City', 'Quezon City', 'NCR', '1100', 'Street 137', '1100', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:14', '2026-03-02 04:56:52', NULL, NULL, NULL),
(78, 1, '2026000078', 138, 'John', 'Constantine', '2018-07-25', NULL, 'grade2', NULL, 'Thomas', 'Constantine', 'john.c@email.com', '09170000138', 'Liverpool St', 'Makati', 'NCR', '1200', 'Street 138', '1200', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:14', '2026-02-24 08:20:39', NULL, NULL, NULL),
(79, 1, '2026000079', 139, 'Shayera', 'Hol', '2019-02-02', NULL, 'grade1', NULL, 'Thanagar', 'Hol', 'shay.h@email.com', '09170000139', 'Hawkman Ave', 'Taguig', 'NCR', '1630', 'Street 139', '1630', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:14', '2026-03-02 04:56:52', NULL, NULL, NULL),
(80, 1, '2026000080', 140, 'Peter', 'Quill', '2021-05-04', NULL, 'kinder1', NULL, 'Meredith', 'Quill', 'peter.q@email.com', '09170000140', 'Milano St', 'Manila', 'NCR', '1000', 'Street 140', '1000', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:45', '2026-02-24 09:26:31', NULL, NULL, NULL),
(81, 1, '2026000081', 141, 'Gamora', 'Zen', '2020-09-12', NULL, 'kinder2', NULL, 'Thanos', 'Zen', 'gamora.z@email.com', '09170000141', 'Zen-Whoberi', 'Pasig', 'NCR', '1600', 'Street 141', '1600', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:45', '2026-02-24 09:29:52', NULL, NULL, NULL),
(82, 1, '2026000082', 142, 'Rocket', 'Raccoon', '2019-03-25', NULL, 'grade1', NULL, 'Halfworld', 'Raccoon', 'rocket.r@email.com', '09170000142', 'Cyborg Ave', 'Quezon City', 'NCR', '1100', 'Street 142', '1100', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:45', '2026-03-02 04:56:52', NULL, NULL, NULL),
(83, 1, '2026000083', 143, 'Groot', 'Tree', '2018-08-30', NULL, 'grade2', NULL, 'Flora', 'Tree', 'groot.t@email.com', '09170000143', 'Planet X', 'Makati', 'NCR', '1200', 'Street 143', '1200', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:45', '2026-02-24 08:21:12', NULL, NULL, NULL),
(84, 1, '2026000084', 144, 'Drax', 'Destroyer', '2019-11-14', NULL, 'grade1', NULL, 'Arthur', 'Douglas', 'drax.d@email.com', '09170000144', 'Kyln Rd', 'Taguig', 'NCR', '1630', 'Street 144', '1630', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:45', '2026-03-02 04:56:52', NULL, NULL, NULL),
(85, 1, '2026000085', 145, 'Mantice', 'Leaf', '2021-07-07', NULL, 'kinder1', NULL, 'Ego', 'Celestial', 'mantice.l@email.com', '09170000145', 'Garden Way', 'Manila', 'NCR', '1000', 'Street 145', '1000', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:45', '2026-02-24 09:26:31', NULL, NULL, NULL),
(86, 1, '2026000086', 146, 'Nebula', 'Blue', '2020-12-15', NULL, 'kinder2', NULL, 'Thanos', 'Blue', 'nebula.b@email.com', '09170000146', 'Cybernetic St', 'Pasig', 'NCR', '1600', 'Street 146', '1600', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:45', '2026-03-02 04:54:59', NULL, NULL, NULL),
(87, 1, '2026000087', 147, 'Yondu', 'Udonta', '2019-04-20', NULL, 'grade1', NULL, 'Centauri', 'Udonta', 'yondu.u@email.com', '09170000147', 'Ravager Way', 'Quezon City', 'NCR', '1100', 'Street 147', '1100', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:45', '2026-03-02 04:56:52', NULL, NULL, NULL),
(88, 1, '2026000088', 148, 'Scott', 'Lang', '2018-02-14', NULL, 'grade2', NULL, 'Hank', 'Lang', 'scott.l@email.com', '09170000148', 'Quantum Blvd', 'Makati', 'NCR', '1200', 'Street 148', '1200', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:45', '2026-02-24 08:21:51', NULL, NULL, NULL),
(89, 1, '2026000089', 149, 'Hope', 'Pym', '2019-06-22', NULL, 'grade1', NULL, 'Janet', 'Pym', 'hope.p@email.com', '09170000149', 'Wasp St', 'Taguig', 'NCR', '1630', 'Street 149', '1630', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:10:45', '2026-03-02 04:56:52', NULL, NULL, NULL),
(90, 1, '2026000090', 150, 'Harry', 'Potter', '2019-07-31', NULL, 'grade1', NULL, 'James', 'Potter', 'harry.p@email.com', '09170000150', 'Privet Drive', 'Manila', 'NCR', '1000', 'Street 150', '1000', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:19', '2026-03-02 05:04:58', NULL, NULL, NULL),
(91, 1, '2026000091', 151, 'Hermione', 'Granger', '2019-09-19', NULL, 'grade1', NULL, 'Mr.', 'Granger', 'hermione.g@email.com', '09170000151', 'Library St', 'Pasig', 'NCR', '1600', 'Street 151', '1600', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:19', '2026-03-02 05:04:58', NULL, NULL, NULL),
(92, 1, '2026000092', 152, 'Ron', 'Weasley', '2019-03-01', NULL, 'grade1', NULL, 'Arthur', 'Weasley', 'ron.w@email.com', '09170000152', 'The Burrow', 'Quezon City', 'NCR', '1100', 'Street 152', '1100', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:19', '2026-03-02 05:04:58', NULL, NULL, NULL),
(93, 1, '2026000093', 153, 'Draco', 'Malfoy', '2018-06-05', NULL, 'grade2', NULL, 'Lucius', 'Malfoy', 'draco.m@email.com', '09170000153', 'Malfoy Manor', 'Makati', 'NCR', '1200', 'Street 153', '1200', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:19', '2026-02-24 08:22:23', NULL, NULL, NULL),
(94, 1, '2026000094', 154, 'Luna', 'Lovegood', '2021-02-13', NULL, 'kinder1', NULL, 'Xenophilius', 'Lovegood', 'luna.love@email.com', '09170000154', 'Rook Ridge', 'Taguig', 'NCR', '1630', 'Street 154', '1630', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:19', '2026-02-24 09:26:31', NULL, NULL, NULL),
(95, 1, '2026000095', 155, 'Cedric', 'Diggory', '2018-10-10', NULL, 'grade2', NULL, 'Amos', 'Diggory', 'cedric.d@email.com', '09170000155', 'Hufflepuff Way', 'Manila', 'NCR', '1000', 'Street 155', '1000', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:19', '2026-02-24 08:22:38', NULL, NULL, NULL),
(96, 1, '2026000096', 156, 'Cho', 'Chang', '2019-12-31', NULL, 'grade1', NULL, 'Mr.', 'Chang', 'cho.c@email.com', '09170000156', 'Ravenclaw Rd', 'Pasig', 'NCR', '1600', 'Street 156', '1600', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:19', '2026-03-02 05:04:58', NULL, NULL, NULL),
(97, 1, '2026000097', 157, 'Neville', 'Longbottom', '2020-07-30', NULL, 'kinder2', NULL, 'Frank', 'Longbottom', 'neville.l@email.com', '09170000157', 'Herbology Ln', 'Quezon City', 'NCR', '1100', 'Street 157', '1100', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:19', '2026-03-02 04:54:59', NULL, NULL, NULL),
(98, 1, '2026000098', 158, 'Ginny', 'Weasley', '2020-08-11', NULL, 'kinder2', NULL, 'Arthur', 'Weasley', 'ginny.w@email.com', '09170000158', 'The Burrow', 'Makati', 'NCR', '1200', 'Street 158', '1200', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:19', '2026-03-02 04:54:59', NULL, NULL, NULL),
(99, 1, '2026000099', 159, 'Fred', 'Weasley', '2018-04-01', NULL, 'grade2', NULL, 'Arthur', 'Weasley', 'fred.w@email.com', '09170000159', 'Joke Shop St', 'Taguig', 'NCR', '1630', 'Street 159', '1630', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:19', '2026-02-24 08:23:04', NULL, NULL, NULL),
(100, 1, '2026000100', 160, 'George', 'Weasley', '2018-04-01', NULL, 'grade2', NULL, 'Arthur', 'Weasley', 'george.w@email.com', '09170000160', 'The Burrow', 'Manila', 'NCR', '1000', 'Street 160', '1000', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:51', '2026-02-24 08:23:11', NULL, NULL, NULL),
(101, 1, '2026000101', 161, 'Luna', 'Lovegood', '2021-02-13', NULL, 'kinder1', NULL, 'Xenophilius', 'Lovegood', 'luna.l2@email.com', '09170000161', 'Rook Ridge', 'Pasig', 'NCR', '1600', 'Street 161', '1600', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:51', '2026-02-24 09:26:31', NULL, NULL, NULL),
(102, 1, '2026000102', 162, 'Albus', 'Dumbledore', '2019-08-20', NULL, 'grade1', NULL, 'Percival', 'Dumbledore', 'albus.d@email.com', '09170000162', 'Godrics Hollow', 'Quezon City', 'NCR', '1100', 'Street 162', '1100', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:51', '2026-03-02 05:04:58', NULL, NULL, NULL),
(103, 1, '2026000103', 163, 'Severus', 'Snape', '2020-01-09', NULL, 'kinder2', NULL, 'Tobias', 'Snape', 'sev.s@email.com', '09170000163', 'Spinners End', 'Makati', 'NCR', '1200', 'Street 163', '1200', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:51', '2026-03-02 04:54:59', NULL, NULL, NULL),
(104, 1, '2026000104', 164, 'Rubeus', 'Hagrid', '2018-12-06', NULL, 'grade2', NULL, 'Mr.', 'Hagrid', 'hagrid.r@email.com', '09170000164', 'Hut Rd', 'Taguig', 'NCR', '1630', 'Street 164', '1630', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:51', '2026-02-24 08:23:38', NULL, NULL, NULL),
(105, 1, '2026000105', 165, 'Minerva', 'McGonagall', '2019-10-04', NULL, 'grade1', NULL, 'Robert', 'McGonagall', 'minerva.m@email.com', '09170000165', 'Highlands', 'Manila', 'NCR', '1000', 'Street 165', '1000', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:51', '2026-03-02 05:04:59', NULL, NULL, NULL),
(106, 1, '2026000106', 166, 'Remus', 'Lupin', '2020-03-10', NULL, 'kinder2', NULL, 'Lyall', 'Lupin', 'remus.l@email.com', '09170000166', 'Moony Ln', 'Pasig', 'NCR', '1600', 'Street 166', '1600', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:51', '2026-03-02 04:54:59', NULL, NULL, NULL),
(107, 1, '2026000107', 167, 'Sirius', 'Black', '2019-11-03', NULL, 'grade1', NULL, 'Orion', 'Black', 'sirius.b@email.com', '09170000167', 'Grimmauld Place', 'Quezon City', 'NCR', '1100', 'Street 167', '1100', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:51', '2026-03-02 05:04:59', NULL, NULL, NULL),
(108, 1, '2026000108', 168, 'Bellatrix', 'Lestrange', '2018-05-15', NULL, 'grade2', NULL, 'Cygnus', 'Black', 'bella.l@email.com', '09170000168', 'Black Manor', 'Makati', 'NCR', '1200', 'Street 168', '1200', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:51', '2026-02-24 08:24:18', NULL, NULL, NULL),
(109, 1, '2026000109', 169, 'Tom', 'Riddle', '2021-12-31', NULL, 'kinder1', NULL, 'Thomas', 'Riddle', 'tom.r@email.com', '09170000169', 'Orphanage St', 'Taguig', 'NCR', '1630', 'Street 169', '1630', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:11:51', '2026-02-24 08:24:24', NULL, NULL, NULL),
(110, 1, '2026000110', 170, 'Frodo', 'Baggins', '2021-09-22', NULL, 'kinder1', NULL, 'Drogo', 'Baggins', 'frodo.b@email.com', '09170000170', 'Bag End', 'Manila', 'NCR', '1000', 'Street 170', '1000', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:24', '2026-02-24 08:24:30', NULL, NULL, NULL),
(111, 1, '2026000111', 171, 'Samwise', 'Gamgee', '2020-04-06', NULL, 'kinder2', NULL, 'Hamfast', 'Gamgee', 'sam.g@email.com', '09170000171', 'Bagshot Row', 'Pasig', 'NCR', '1600', 'Street 171', '1600', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:24', '2026-03-02 04:54:59', NULL, NULL, NULL),
(112, 1, '2026000112', 172, 'Gandalf', 'Grey', '2019-01-01', NULL, 'grade1', NULL, 'Olórin', 'Grey', 'gandalf.g@email.com', '09170000172', 'Grey Havens', 'Quezon City', 'NCR', '1100', 'Street 172', '1100', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:24', '2026-03-02 05:04:59', NULL, NULL, NULL),
(113, 1, '2026000113', 173, 'Aragorn', 'Elessar', '2018-03-01', NULL, 'grade2', NULL, 'Arathorn', 'Elessar', 'aragorn.e@email.com', '09170000173', 'Minas Tirith', 'Makati', 'NCR', '1200', 'Street 173', '1200', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:24', '2026-02-24 08:24:51', NULL, NULL, NULL),
(114, 1, '2026000114', 174, 'Legolas', 'Greenleaf', '2019-10-25', NULL, 'grade1', NULL, 'Thranduil', 'Greenleaf', 'legolas.g@email.com', '09170000174', 'Mirkwood', 'Taguig', 'NCR', '1630', 'Street 174', '1630', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:24', '2026-03-02 05:04:59', NULL, NULL, NULL),
(115, 1, '2026000115', 175, 'Gimli', 'Gloin', '2021-12-01', NULL, 'kinder1', NULL, 'Glóin', 'Gloin', 'gimli.g@email.com', '09170000175', 'Lonely Mountain', 'Manila', 'NCR', '1000', 'Street 175', '1000', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:24', '2026-02-24 08:25:07', NULL, NULL, NULL),
(116, 1, '2026000116', 176, 'Boromir', 'Denethor', '2020-11-15', NULL, 'kinder2', NULL, 'Denethor', 'Denethor', 'boromir.d@email.com', '09170000176', 'Gondor St', 'Pasig', 'NCR', '1600', 'Street 176', '1600', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:24', '2026-03-02 04:54:59', NULL, NULL, NULL),
(117, 1, '2026000117', 177, 'Galadriel', 'Celeborn', '2019-05-24', NULL, 'grade1', NULL, 'Finarfin', 'Celeborn', 'galadriel.c@email.com', '09170000177', 'Lothlórien', 'Quezon City', 'NCR', '1100', 'Street 177', '1100', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:24', '2026-03-02 05:04:59', NULL, NULL, NULL),
(118, 1, '2026000118', 178, 'Elrond', 'Peredhel', '2018-07-09', NULL, 'grade2', NULL, 'Eärendil', 'Peredhel', 'elrond.p@email.com', '09170000178', 'Rivendell', 'Makati', 'NCR', '1200', 'Street 178', '1200', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:24', '2026-02-24 08:25:27', NULL, NULL, NULL),
(119, 1, '2026000119', 179, 'Eowyn', 'Rohan', '2019-02-14', NULL, 'grade1', NULL, 'Éomund', 'Rohan', 'eowyn.r@email.com', '09170000179', 'Edoras', 'Taguig', 'NCR', '1630', 'Street 179', '1630', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:24', '2026-03-02 05:05:05', NULL, NULL, NULL),
(120, 1, '2026000120', 180, 'Katniss', 'Everdeen', '2019-05-08', NULL, 'grade1', NULL, 'Mr.', 'Everdeen', 'katniss.e@email.com', '09170000180', 'District 12', 'Manila', 'NCR', '1000', 'Street 180', '1000', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:55', '2026-02-24 08:25:40', NULL, NULL, NULL),
(121, 1, '2026000121', 181, 'Peeta', 'Mellark', '2019-10-12', NULL, 'grade1', NULL, 'Mr.', 'Mellark', 'peeta.m@email.com', '09170000181', 'Bakery Lane', 'Pasig', 'NCR', '1600', 'Street 181', '1600', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:55', '2026-02-24 08:25:50', NULL, NULL, NULL),
(122, 1, '2026000122', 182, 'Gale', 'Hawthorne', '2018-07-05', NULL, 'grade2', NULL, 'Hazelle', 'Hawthorne', 'gale.h@email.com', '09170000182', 'The Seam', 'Quezon City', 'NCR', '1100', 'Street 182', '1100', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:55', '2026-02-24 08:25:57', NULL, NULL, NULL),
(123, 1, '2026000123', 183, 'Haymitch', 'Abernathy', '2018-11-20', NULL, 'grade2', NULL, 'Mrs.', 'Abernathy', 'haymitch.a@email.com', '09170000183', 'Victors Village', 'Makati', 'NCR', '1200', 'Street 183', '1200', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:55', '2026-02-24 08:26:03', NULL, NULL, NULL),
(124, 1, '2026000124', 184, 'Effie', 'Trinket', '2021-03-15', NULL, 'kinder1', NULL, 'Capital', 'Trinket', 'effie.t@email.com', '09170000184', 'Capitol Blvd', 'Taguig', 'NCR', '1630', 'Street 184', '1630', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:55', '2026-02-24 08:26:10', NULL, NULL, NULL),
(125, 1, '2026000125', 185, 'Primrose', 'Everdeen', '2021-12-25', NULL, 'kinder1', NULL, 'Mr.', 'Everdeen', 'prim.e@email.com', '09170000185', 'District 12', 'Manila', 'NCR', '1000', 'Street 185', '1000', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:55', '2026-02-24 08:26:19', NULL, NULL, NULL),
(126, 1, '2026000126', 186, 'Finnick', 'Odair', '2019-02-14', NULL, 'grade1', NULL, 'District 4', 'Odair', 'finnick.o@email.com', '09170000186', 'Ocean Drive', 'Pasig', 'NCR', '1600', 'Street 186', '1600', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:55', '2026-02-24 08:26:26', NULL, NULL, NULL),
(127, 1, '2026000127', 187, 'Johanna', 'Mason', '2018-06-30', NULL, 'grade2', NULL, 'District 7', 'Mason', 'johanna.m@email.com', '09170000187', 'Forest Rd', 'Quezon City', 'NCR', '1100', 'Street 187', '1100', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:55', '2026-02-24 08:26:32', NULL, NULL, NULL),
(128, 1, '2026000128', 188, 'Coriolanus', 'Snow', '2020-01-01', NULL, 'kinder2', NULL, 'Crassus', 'Snow', 'corio.s@email.com', '09170000188', 'Presidential Palace', 'Makati', 'NCR', '1200', 'Street 188', '1200', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:55', '2026-03-02 04:54:59', NULL, NULL, NULL),
(129, 1, '2026000129', 189, 'Lucy', 'Gray', '2020-04-22', NULL, 'kinder2', NULL, 'The', 'Covey', 'lucy.g@email.com', '09170000189', 'Meadow Ln', 'Taguig', 'NCR', '1630', 'Street 189', '1630', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:12:55', '2026-03-02 04:54:59', NULL, NULL, NULL),
(130, NULL, '2026000130', 211, 'Joe', 'Alwin', '2016-03-02', NULL, 'grade3', NULL, 'Taylor', 'Swift', 'swift.t@gmail.com', '09271591627', '282, Bancal Guagua Pampanga', 'Guagua', 'Region', '2003', '282, Bancal Guagua Pampanga', '2003', 'enrolled', NULL, 'admissions/documents/Vr35iCqDBVc00xQmJJQpHYDRT2JlV7QXMUT14Rjm.png', 'admissions/documents/nLbjGxmKxNU9bu9bjOVepYwy6wUJyDt0Cdpcttph.png', 'admissions/documents/TBFe8vTqsPl1BkxZTjjfUBqF6TUX3XcVT2ly9ES5.png', 'admissions/documents/CdSrkcaj0UXw7sEtzibH6jpeS3UICqNkNTIuBDRR.png', 'admissions/documents/YLCz8VQJ7PQj1taSSLeOXxvLly1G30gsvRUYjtMg.png', 'admissions/documents/yNSF6jJzR42eMoZis3iPyklSyPZvBPafOoG6Rcgu.png', NULL, '2026-03-03 23:51:27', '2026-03-04 02:15:21', '25k_to_50k', 3, 'employed_full'),
(151, NULL, '2026000150', 1, 'Mateo', 'Dela Cruz', '2015-05-14', NULL, 'grade4', NULL, 'Maria', 'Dela Cruz', 'm1@test.com', '09171234567', 'San Nicolas 1st', 'Guagua', 'Pampanga', '2003', '', '', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'below_25k', 8, 'unemployed'),
(152, NULL, '2026000151', 2, 'Sofia', 'Santos', '2016-08-22', NULL, 'grade3', NULL, 'Jose', 'Santos', 's2@test.com', '09181234567', 'Plaza Burgos', 'Guagua', 'Pampanga', '2003', '', '', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'above_100k', 3, 'employed_full'),
(153, NULL, '2026000152', 3, 'Lucas', 'Reyes', '2017-11-03', NULL, 'grade2', NULL, 'Elena', 'Reyes', 'l3@test.com', '09191234567', 'San Matias', 'Guagua', 'Pampanga', '2003', '', '', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25k_to_50k', 5, 'self_employed'),
(154, NULL, '2026000153', 4, 'Isabella', 'Bautista', '2014-02-19', NULL, 'grade5', NULL, 'Carlos', 'Bautista', 'i4@test.com', '09201234567', 'Betis', 'Guagua', 'Pampanga', '2003', '', '', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50k_to_100k', 4, 'employed_full'),
(155, NULL, '2026000154', 5, 'Elias', 'Garcia', '2015-09-11', NULL, 'grade4', NULL, 'Ana', 'Garcia', 'e5@test.com', '09211234567', 'Natividad', 'Guagua', 'Pampanga', '2003', '', '', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'below_25k', 6, 'employed_part'),
(156, NULL, '2026000155', 6, 'Chloe', 'Mendoza', '2018-01-25', NULL, 'grade1', NULL, 'Luis', 'Mendoza', 'c6@test.com', '09221234567', 'San Pedro', 'Guagua', 'Pampanga', '2003', '', '', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'above_100k', 4, 'self_employed'),
(157, NULL, '2026000156', 7, 'Gabriel', 'Cruz', '2019-04-16', NULL, 'kinder3', NULL, 'Sofia', 'Cruz', 'g7@test.com', '09231234567', 'San Juan', 'Guagua', 'Pampanga', '2003', '', '', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25k_to_50k', 7, 'unemployed'),
(158, NULL, '2026000157', 8, 'Mia', 'Aquino', '2016-12-05', NULL, 'grade3', NULL, 'Miguel', 'Aquino', 'm8@test.com', '09241234567', 'San Roque', 'Guagua', 'Pampanga', '2003', '', '', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50k_to_100k', 5, 'employed_full'),
(159, NULL, '2026000158', 9, 'Liam', 'Navarro', '2015-07-30', NULL, 'grade4', NULL, 'Carmen', 'Navarro', 'l9@test.com', '09251234567', 'Sta. Filomena', 'Guagua', 'Pampanga', '2003', '', '', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'below_25k', 9, 'retired'),
(160, NULL, '2026000159', 10, 'Amelia', 'Tolentino', '2017-03-12', NULL, 'grade2', NULL, 'Roberto', 'Tolentino', 'a10@test.com', '09261234567', 'San Antonio', 'Guagua', 'Pampanga', '2003', '', '', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'above_100k', 3, 'employed_full'),
(161, NULL, '2026000160', 11, 'Ethan', 'Gonzales', '2018-06-08', NULL, 'grade1', NULL, 'Teresa', 'Gonzales', 'e11@test.com', '09271234567', 'San Vicente', 'Guagua', 'Pampanga', '2003', '', '', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25k_to_50k', 6, 'employed_part'),
(162, NULL, '2026000161', 12, 'Ava', 'Lopez', '2014-10-21', NULL, 'grade5', NULL, 'Ricardo', 'Lopez', 'a12@test.com', '09281234567', 'Bancal', 'Guagua', 'Pampanga', '2003', '', '', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50k_to_100k', 4, 'self_employed'),
(163, NULL, '2026000162', 13, 'Noah', 'Gomez', '2019-02-14', NULL, 'kinder3', NULL, 'Rosa', 'Gomez', 'n13@test.com', '09291234567', 'San Miguel', 'Guagua', 'Pampanga', '2003', '', '', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'below_25k', 7, 'unemployed'),
(164, NULL, '2026000163', 14, 'Olivia', 'Perez', '2015-11-28', NULL, 'grade4', NULL, 'Fernando', 'Perez', 'o14@test.com', '09301234567', 'Lambac', 'Guagua', 'Pampanga', '2003', '', '', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'above_100k', 5, 'employed_full'),
(165, NULL, '2026000164', 15, 'Jacob', 'Marquez', '2016-05-09', NULL, 'grade3', NULL, 'Lucia', 'Marquez', 'j15@test.com', '09311234567', 'Magsaysay', 'Guagua', 'Pampanga', '2003', '', '', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25k_to_50k', 8, 'employed_part'),
(166, NULL, '2026000165', 16, 'Sophia', 'Alvarez', '2017-08-17', NULL, 'grade2', NULL, 'Eduardo', 'Alvarez', 's16@test.com', '09321234567', 'Rizal', 'Guagua', 'Pampanga', '2003', '', '', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50k_to_100k', 3, 'self_employed'),
(167, NULL, '2026000166', 17, 'Logan', 'Romero', '2014-04-02', NULL, 'grade5', NULL, 'Silvia', 'Romero', 'l17@test.com', '09331234567', 'San Pablo', 'Guagua', 'Pampanga', '2003', '', '', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'below_25k', 6, 'retired'),
(168, NULL, '2026000167', 18, 'Zoe', 'Herrera', '2018-09-26', NULL, 'grade1', NULL, 'Jorge', 'Herrera', 'z18@test.com', '09341234567', 'San Nicolas 2nd', 'Guagua', 'Pampanga', '2003', '', '', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'above_100k', 4, 'employed_full'),
(169, NULL, '2026000168', 19, 'Jackson', 'Medina', '2019-01-15', NULL, 'kinder3', NULL, 'Isabel', 'Medina', 'j19@test.com', '09351234567', 'San Matias', 'Guagua', 'Pampanga', '2003', '', '', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25k_to_50k', 5, 'employed_part'),
(170, NULL, '2026000169', 20, 'Emma', 'Castro', '2015-12-10', NULL, 'grade4', NULL, 'Victor', 'Castro', 'e20@test.com', '09361234567', 'Betis', 'Guagua', 'Pampanga', '2003', '', '', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50k_to_100k', 6, 'self_employed'),
(171, 2, '20240001', NULL, 'Missing', 'Student1', '0000-00-00', 'Female', 'grade6', NULL, '', '', '', '', '', '', '', '', '', '', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-31 16:00:00', '2024-05-31 16:00:00', NULL, NULL, NULL),
(172, 2, '20240002', NULL, 'Missing', 'Student2', '0000-00-00', 'Female', 'grade5', NULL, '', '', '', '', '', '', '', '', '', '', 'enrolled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-31 16:00:00', '2024-05-31 16:00:00', NULL, NULL, NULL),
(601, 2, '20240101', NULL, 'Leon', 'Kennedy', '0000-00-00', NULL, 'grade9', NULL, '', '', '', '', '', '', '', '', '', '', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 17:00:43', '2026-03-04 17:00:43', NULL, NULL, NULL),
(602, 2, '20240102', NULL, 'Claire', 'Redfield', '0000-00-00', NULL, 'grade9', NULL, '', '', '', '', '', '', '', '', '', '', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 17:00:43', '2026-03-04 17:00:43', NULL, NULL, NULL),
(603, 2, '20240103', NULL, 'Jill', 'Valentine', '0000-00-00', NULL, 'grade9', NULL, '', '', '', '', '', '', '', '', '', '', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 17:00:43', '2026-03-04 17:00:43', NULL, NULL, NULL),
(604, 2, '20240104', NULL, 'Chris', 'Redfield', '0000-00-00', NULL, 'grade9', NULL, '', '', '', '', '', '', '', '', '', '', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 17:00:43', '2026-03-04 17:00:43', NULL, NULL, NULL),
(605, 2, '20240105', NULL, 'Ada', 'Wong', '0000-00-00', NULL, 'grade9', NULL, '', '', '', '', '', '', '', '', '', '', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 17:00:43', '2026-03-04 17:00:43', NULL, NULL, NULL),
(606, 2, '20240106', NULL, 'Albert', 'Wesker', '0000-00-00', NULL, 'grade9', NULL, '', '', '', '', '', '', '', '', '', '', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 17:00:43', '2026-03-04 17:00:43', NULL, NULL, NULL);
INSERT INTO `admissions` (`id`, `academic_year_id`, `studentNumber`, `user_id`, `studentFirstName`, `studentLastName`, `dateOfBirth`, `gender`, `year_level`, `previousSchool`, `parentFirstName`, `parentLastName`, `email`, `phone`, `address`, `city`, `state`, `zipCode`, `street`, `zip`, `status`, `student_number`, `report_card`, `birth_certificate`, `applicant_photo`, `father_photo`, `mother_photo`, `guardian_photo`, `transferee_docs`, `created_at`, `updated_at`, `household_income`, `household_size`, `employment_status`) VALUES
(701, 2, '20240201', 701, 'Ashley', 'Graham', '0000-00-00', NULL, 'grade10', NULL, '', '', 'ashley.graham@example.com', '', '', '', '', '', '', '', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 18:24:15', '2026-03-04 18:24:15', NULL, NULL, NULL),
(702, 2, '20240202', 702, 'Ethan', 'Winters', '0000-00-00', NULL, 'grade10', NULL, '', '', 'ethan.winters@example.com', '', '', '', '', '', '', '', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 18:24:15', '2026-03-04 18:24:15', NULL, NULL, NULL),
(703, 2, '20240203', 703, 'Mia', 'Winters', '0000-00-00', NULL, 'grade10', NULL, '', '', 'mia.winters@example.com', '', '', '', '', '', '', '', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 18:24:15', '2026-03-04 18:24:15', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `studentNumber` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `status` enum('Present','Absent','Late','Excused') DEFAULT 'Present',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `section_id`, `studentNumber`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1027, '2026000049', '2026-02-24', 'Present', '2026-02-24 10:09:59', '2026-02-24 10:09:59'),
(3, 1025, '0', '2026-02-24', 'Present', '2026-02-24 10:20:37', '2026-02-24 10:20:37'),
(4, 1025, '2026000046', '2026-02-24', 'Present', '2026-02-24 10:24:21', '2026-02-24 10:24:21'),
(5, 1025, '2026000026', '2026-02-24', 'Present', '2026-02-24 10:24:21', '2026-02-24 10:24:21'),
(6, 1025, '2026000051', '2026-02-24', 'Present', '2026-02-24 10:24:21', '2026-02-24 10:24:21'),
(7, 1025, '2026000041', '2026-02-24', 'Present', '2026-02-24 10:24:21', '2026-02-24 10:24:21'),
(8, 1025, '2026000056', '2026-02-24', 'Present', '2026-02-24 10:24:21', '2026-02-24 10:24:21'),
(9, 1025, '2026000061', '2026-02-24', 'Present', '2026-02-24 10:24:21', '2026-02-24 10:24:21'),
(10, 1025, '2026000066', '2026-02-24', 'Absent', '2026-02-24 10:24:21', '2026-02-24 10:24:21'),
(11, 1025, '2026000071', '2026-02-24', 'Present', '2026-02-24 10:24:21', '2026-02-24 10:24:21'),
(12, 1025, '2026000076', '2026-02-24', 'Present', '2026-02-24 10:24:21', '2026-02-24 10:24:21'),
(13, 1025, '2026000081', '2026-02-24', 'Present', '2026-02-24 10:24:21', '2026-02-24 10:24:21'),
(14, 1025, '2026000046', '2026-02-25', 'Present', '2026-02-24 10:33:24', '2026-02-24 10:33:24'),
(15, 1025, '2026000026', '2026-02-25', 'Present', '2026-02-24 10:33:24', '2026-02-24 10:33:24'),
(16, 1025, '2026000051', '2026-02-25', 'Present', '2026-02-24 10:33:24', '2026-02-24 10:33:24'),
(17, 1025, '2026000041', '2026-02-25', 'Present', '2026-02-24 10:33:24', '2026-02-24 10:33:24'),
(18, 1025, '2026000056', '2026-02-25', 'Absent', '2026-02-24 10:33:24', '2026-02-24 10:33:24'),
(19, 1025, '2026000061', '2026-02-25', 'Absent', '2026-02-24 10:33:24', '2026-02-24 10:33:24'),
(20, 1025, '2026000066', '2026-02-25', 'Present', '2026-02-24 10:33:24', '2026-02-24 10:33:24'),
(21, 1025, '2026000071', '2026-02-25', 'Present', '2026-02-24 10:33:24', '2026-02-24 10:33:24'),
(22, 1025, '2026000076', '2026-02-25', 'Present', '2026-02-24 10:33:24', '2026-02-24 10:33:24'),
(23, 1025, '2026000081', '2026-02-25', 'Present', '2026-02-24 10:33:24', '2026-02-24 10:33:24'),
(24, 1025, '2026000046', '2026-02-07', 'Present', '2026-02-24 11:23:48', '2026-02-24 11:23:48'),
(25, 1025, '2026000026', '2026-02-07', 'Present', '2026-02-24 11:23:48', '2026-02-24 11:23:48'),
(26, 1025, '2026000051', '2026-02-07', 'Present', '2026-02-24 11:23:48', '2026-02-24 11:23:48'),
(27, 1025, '2026000041', '2026-02-07', 'Present', '2026-02-24 11:23:48', '2026-02-24 11:23:48'),
(28, 1025, '2026000056', '2026-02-07', 'Present', '2026-02-24 11:23:48', '2026-02-24 11:23:48'),
(29, 1025, '2026000061', '2026-02-07', 'Present', '2026-02-24 11:23:48', '2026-02-24 11:23:48'),
(30, 1025, '2026000066', '2026-02-07', 'Present', '2026-02-24 11:23:48', '2026-02-24 11:23:48'),
(31, 1025, '2026000071', '2026-02-07', 'Present', '2026-02-24 11:23:48', '2026-02-24 11:23:48'),
(32, 1025, '2026000076', '2026-02-07', 'Present', '2026-02-24 11:23:48', '2026-02-24 11:23:48'),
(33, 1025, '2026000081', '2026-02-07', 'Present', '2026-02-24 11:23:48', '2026-02-24 11:23:48'),
(34, 1027, '2026000049', '2026-02-02', 'Present', '2026-02-24 12:01:53', '2026-02-24 12:01:53'),
(35, 1027, '2026000049', '2026-02-01', 'Present', '2026-02-24 12:02:01', '2026-02-24 12:02:01'),
(36, 1025, '2026000046', '2026-02-03', 'Present', '2026-02-24 12:08:35', '2026-02-24 12:08:35'),
(37, 1025, '2026000026', '2026-02-03', 'Absent', '2026-02-24 12:08:35', '2026-02-24 12:08:35'),
(38, 1025, '2026000051', '2026-02-03', 'Absent', '2026-02-24 12:08:35', '2026-02-24 12:08:35'),
(39, 1025, '2026000041', '2026-02-03', 'Absent', '2026-02-24 12:08:35', '2026-02-24 12:08:35'),
(40, 1025, '2026000056', '2026-02-03', 'Absent', '2026-02-24 12:08:35', '2026-02-24 12:08:35'),
(41, 1025, '2026000061', '2026-02-03', 'Absent', '2026-02-24 12:08:35', '2026-02-24 12:08:35'),
(42, 1025, '2026000066', '2026-02-03', 'Absent', '2026-02-24 12:08:35', '2026-02-24 12:08:35'),
(43, 1025, '2026000071', '2026-02-03', 'Absent', '2026-02-24 12:08:35', '2026-02-24 12:08:35'),
(44, 1025, '2026000076', '2026-02-03', 'Absent', '2026-02-24 12:08:35', '2026-02-24 12:08:35'),
(45, 1025, '2026000081', '2026-02-03', 'Absent', '2026-02-24 12:08:35', '2026-02-24 12:08:35');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('fumces-cache-smith@gmail.com|127.0.0.1', 'i:2;', 1772619432),
('fumces-cache-smith@gmail.com|127.0.0.1:timer', 'i:1772619432;', 1772619432),
('fumces-cache-teacher@gmail.com|127.0.0.1', 'i:1;', 1772619446),
('fumces-cache-teacher@gmail.com|127.0.0.1:timer', 'i:1772619446;', 1772619446);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_records`
--

CREATE TABLE `class_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `studentNumber` bigint(20) UNSIGNED NOT NULL,
  `section_id` int(11) NOT NULL,
  `final_average` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_records`
--

INSERT INTO `class_records` (`id`, `studentNumber`, `section_id`, `final_average`, `created_at`, `updated_at`) VALUES
(2, 30, 1027, 10.00, '2026-02-24 11:28:15', '2026-03-04 02:17:34'),
(3, 8, 1025, 99.40, '2026-02-24 11:38:42', '2026-02-25 00:44:11'),
(4, 8, 1025, 49.00, '2026-02-24 11:38:42', '2026-02-24 11:38:42'),
(5, 13, 1025, 69.90, '2026-02-24 11:38:42', '2026-02-25 00:44:11'),
(6, 13, 1025, 52.00, '2026-02-24 11:38:42', '2026-02-24 11:38:42'),
(7, 14, 1025, 69.90, '2026-02-24 11:38:42', '2026-02-25 00:44:11'),
(8, 14, 1025, 35.80, '2026-02-24 11:38:42', '2026-02-24 11:38:42'),
(9, 15, 1025, 70.50, '2026-02-24 11:38:42', '2026-02-25 00:44:11'),
(10, 15, 1025, 37.60, '2026-02-24 11:38:42', '2026-02-24 11:38:42'),
(11, 16, 1025, 68.60, '2026-02-24 11:38:42', '2026-02-25 00:44:11'),
(12, 16, 1025, 36.07, '2026-02-24 11:38:42', '2026-02-24 11:38:42'),
(13, 17, 1025, 69.20, '2026-02-24 11:38:42', '2026-02-25 00:44:11'),
(14, 17, 1025, 39.07, '2026-02-24 11:38:42', '2026-02-24 11:38:42'),
(15, 31, 1025, 69.20, '2026-02-24 11:38:42', '2026-02-25 00:44:11'),
(16, 31, 1025, 43.87, '2026-02-24 11:38:42', '2026-02-24 11:38:42'),
(17, 32, 1025, 71.70, '2026-02-24 11:38:42', '2026-02-25 00:44:11'),
(18, 32, 1025, 39.40, '2026-02-24 11:38:42', '2026-02-24 11:38:42'),
(19, 33, 1025, 71.70, '2026-02-24 11:38:42', '2026-02-25 00:44:11'),
(20, 33, 1025, 42.40, '2026-02-24 11:38:42', '2026-02-24 11:38:42'),
(21, 34, 1025, 71.70, '2026-02-24 11:38:42', '2026-02-25 00:44:11'),
(23, 35, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(24, 45, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(25, 46, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(26, 47, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(27, 48, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(28, 49, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(29, 50, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(30, 51, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(31, 52, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(32, 53, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(33, 54, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(34, 55, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(35, 56, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(36, 57, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(37, 58, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(38, 59, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(39, 60, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(40, 61, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(41, 62, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(42, 63, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(43, 64, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(44, 65, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(45, 66, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(46, 67, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(47, 68, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(48, 69, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(49, 70, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(50, 71, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(51, 72, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(52, 73, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34'),
(53, 74, 1027, 0.00, '2026-03-04 02:17:34', '2026-03-04 02:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `grade_level` varchar(20) NOT NULL,
  `section` varchar(50) NOT NULL,
  `school_year` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `user_id`, `file_path`, `type`, `status`, `created_at`, `updated_at`, `file_name`) VALUES
(1, '', 5, 'admissions/documents/p78nJESBmHfkglVwTNdi8ImdqDh1sKryhUR2wKeK.png', 'admission_record', 'approved', '2026-02-02 06:19:28', '2026-02-02 06:19:28', NULL),
(2, '', 5, 'admissions/documents/wL474ob5zVTOlj69SUvN3Q2BhsmAEZFasPmn5PbU.png', 'admission_record', 'pending', '2026-02-02 06:19:28', '2026-02-02 06:19:28', NULL),
(3, '', 5, 'admissions/documents/YXmNArqsyU2fvEN0HMuTocQpMWPcfpqccHVJ2MKU.png', 'admission_record', 'pending', '2026-02-02 06:19:28', '2026-02-02 06:19:28', NULL),
(4, '', 5, 'admissions/documents/oJ4nL2cYkzCazNY9H3nmU6jLdaPbsI5vwJuvt4d5.png', 'admission_record', 'pending', '2026-02-02 06:19:28', '2026-02-02 06:19:28', NULL),
(5, '', 5, 'admissions/documents/cGJyzKH2JGJN7vjF7dz3vo2llO49QlkN8U4wHK4n.png', 'admission_record', 'pending', '2026-02-02 06:19:28', '2026-02-02 06:19:28', NULL),
(6, '', 5, 'admissions/documents/yinGHhEG47qZ7yjckROfjyqMVluKrW281EvJt5SQ.png', 'admission_record', 'pending', '2026-02-02 06:19:28', '2026-02-02 06:19:28', NULL),
(7, '', 5, 'admissions/documents/p78nJESBmHfkglVwTNdi8ImdqDh1sKryhUR2wKeK.png', 'admission_record', 'pending', '2026-02-02 06:20:46', '2026-02-02 06:20:46', NULL),
(8, '', 5, 'admissions/documents/wL474ob5zVTOlj69SUvN3Q2BhsmAEZFasPmn5PbU.png', 'admission_record', 'pending', '2026-02-02 06:20:46', '2026-02-02 06:20:46', NULL),
(9, '', 5, 'admissions/documents/YXmNArqsyU2fvEN0HMuTocQpMWPcfpqccHVJ2MKU.png', 'admission_record', 'pending', '2026-02-02 06:20:46', '2026-02-02 06:20:46', NULL),
(10, '', 5, 'admissions/documents/oJ4nL2cYkzCazNY9H3nmU6jLdaPbsI5vwJuvt4d5.png', 'admission_record', 'pending', '2026-02-02 06:20:46', '2026-02-02 06:20:46', NULL),
(11, '', 5, 'admissions/documents/cGJyzKH2JGJN7vjF7dz3vo2llO49QlkN8U4wHK4n.png', 'admission_record', 'pending', '2026-02-02 06:20:46', '2026-02-02 06:20:46', NULL),
(12, '', 5, 'admissions/documents/yinGHhEG47qZ7yjckROfjyqMVluKrW281EvJt5SQ.png', 'admission_record', 'pending', '2026-02-02 06:20:46', '2026-02-02 06:20:46', NULL),
(13, '', 5, 'admissions/documents/p78nJESBmHfkglVwTNdi8ImdqDh1sKryhUR2wKeK.png', 'admission_record', 'pending', '2026-02-02 06:21:53', '2026-02-02 06:21:53', NULL),
(14, '', 5, 'admissions/documents/wL474ob5zVTOlj69SUvN3Q2BhsmAEZFasPmn5PbU.png', 'admission_record', 'pending', '2026-02-02 06:21:53', '2026-02-02 06:21:53', NULL),
(15, '', 5, 'admissions/documents/YXmNArqsyU2fvEN0HMuTocQpMWPcfpqccHVJ2MKU.png', 'admission_record', 'pending', '2026-02-02 06:21:53', '2026-02-02 06:21:53', NULL),
(16, '', 5, 'admissions/documents/oJ4nL2cYkzCazNY9H3nmU6jLdaPbsI5vwJuvt4d5.png', 'admission_record', 'pending', '2026-02-02 06:21:53', '2026-02-02 06:21:53', NULL),
(17, '', 5, 'admissions/documents/cGJyzKH2JGJN7vjF7dz3vo2llO49QlkN8U4wHK4n.png', 'admission_record', 'pending', '2026-02-02 06:21:53', '2026-02-02 06:21:53', NULL),
(18, '', 5, 'admissions/documents/yinGHhEG47qZ7yjckROfjyqMVluKrW281EvJt5SQ.png', 'admission_record', 'pending', '2026-02-02 06:21:53', '2026-02-02 06:21:53', NULL),
(19, '', 5, 'admissions/documents/p78nJESBmHfkglVwTNdi8ImdqDh1sKryhUR2wKeK.png', 'admission_record', 'pending', '2026-02-02 06:22:12', '2026-02-02 06:22:12', NULL),
(20, '', 5, 'admissions/documents/wL474ob5zVTOlj69SUvN3Q2BhsmAEZFasPmn5PbU.png', 'admission_record', 'pending', '2026-02-02 06:22:12', '2026-02-02 06:22:12', NULL),
(21, '', 5, 'admissions/documents/YXmNArqsyU2fvEN0HMuTocQpMWPcfpqccHVJ2MKU.png', 'admission_record', 'pending', '2026-02-02 06:22:12', '2026-02-02 06:22:12', NULL),
(22, '', 5, 'admissions/documents/oJ4nL2cYkzCazNY9H3nmU6jLdaPbsI5vwJuvt4d5.png', 'admission_record', 'pending', '2026-02-02 06:22:12', '2026-02-02 06:22:12', NULL),
(23, '', 5, 'admissions/documents/cGJyzKH2JGJN7vjF7dz3vo2llO49QlkN8U4wHK4n.png', 'admission_record', '', '2026-02-02 06:22:12', '2026-02-02 06:22:12', NULL),
(24, '', 5, 'admissions/documents/yinGHhEG47qZ7yjckROfjyqMVluKrW281EvJt5SQ.png', 'admission_record', 'pending', '2026-02-02 06:22:12', '2026-02-02 06:22:12', NULL),
(25, '', 5, 'admissions/documents/p78nJESBmHfkglVwTNdi8ImdqDh1sKryhUR2wKeK.png', 'admission_record', 'pending', '2026-02-02 06:22:49', '2026-02-02 06:22:49', NULL),
(26, '', 5, 'admissions/documents/wL474ob5zVTOlj69SUvN3Q2BhsmAEZFasPmn5PbU.png', 'admission_record', 'pending', '2026-02-02 06:22:49', '2026-02-02 06:22:49', NULL),
(27, '', 5, 'admissions/documents/YXmNArqsyU2fvEN0HMuTocQpMWPcfpqccHVJ2MKU.png', 'admission_record', 'pending', '2026-02-02 06:22:49', '2026-02-02 06:22:49', NULL),
(28, '', 5, 'admissions/documents/oJ4nL2cYkzCazNY9H3nmU6jLdaPbsI5vwJuvt4d5.png', 'admission_record', 'pending', '2026-02-02 06:22:49', '2026-02-02 06:22:49', NULL),
(29, '', 5, 'admissions/documents/cGJyzKH2JGJN7vjF7dz3vo2llO49QlkN8U4wHK4n.png', 'admission_record', 'pending', '2026-02-02 06:22:49', '2026-02-02 06:22:49', NULL),
(30, '', 5, 'admissions/documents/yinGHhEG47qZ7yjckROfjyqMVluKrW281EvJt5SQ.png', 'admission_record', 'pending', '2026-02-02 06:22:49', '2026-02-02 06:22:49', NULL),
(31, '', 6, 'admissions/documents/LdIOncDZ0S367jAaB3fVLWUXf4cOy7ugWgseqSJG.png', 'admission_record', 'pending', '2026-02-02 07:28:03', '2026-02-02 07:28:03', NULL),
(32, '', 6, 'admissions/documents/6ES6FALvlNztS9I1LZ74qiDPh5YITV9Y9lewLNGH.png', 'admission_record', 'pending', '2026-02-02 07:28:03', '2026-02-02 07:28:03', NULL),
(33, '', 6, 'admissions/documents/6ry3L9arpd5BZvjEaO75f4lVCCivloPkQJcfi0FU.png', 'admission_record', 'pending', '2026-02-02 07:28:03', '2026-02-02 07:28:03', NULL),
(34, '', 6, 'admissions/documents/K6YF5qozyhLfeaob62wh4hzgGk6DlXD4Y5e5264C.png', 'admission_record', 'pending', '2026-02-02 07:28:03', '2026-02-02 07:28:03', NULL),
(35, '', 6, 'admissions/documents/m1MrVF7jbjxd3V5n4YLcZLYbsD2FejT5jdJNsHO8.png', 'admission_record', 'pending', '2026-02-02 07:28:03', '2026-02-02 07:28:03', NULL),
(36, '', 6, 'admissions/documents/OSjYPpm5tTdBjIdw8Bq3hPZHST9UHyt0GiyNd08v.png', 'admission_record', 'pending', '2026-02-02 07:28:03', '2026-02-02 07:28:03', NULL),
(37, '', 6, 'admissions/documents/lJ7P8Yb7qNYoUwMXcmqbEcCbyOtF02xUdLUnv3Ef.png', 'admission_record', 'pending', '2026-02-02 07:31:08', '2026-02-02 07:31:08', NULL),
(38, '', 6, 'admissions/documents/MHOXQjV4CZjh3O1usx8Oa6ZkvmaCiI2jLVcjBEcj.png', 'admission_record', 'pending', '2026-02-02 07:31:08', '2026-02-02 07:31:08', NULL),
(39, '', 6, 'admissions/documents/mDCMAo35HPnmFuXw9fBaFOxlbDk1OQxV4AotPh3c.png', 'admission_record', 'pending', '2026-02-02 07:31:08', '2026-02-02 07:31:08', NULL),
(40, '', 6, 'admissions/documents/AJMKotlM9fMXsfEFBoF16shfEz0VUWAwNF2EMTdx.png', 'admission_record', 'pending', '2026-02-02 07:31:08', '2026-02-02 07:31:08', NULL),
(41, '', 6, 'admissions/documents/hGBgP50HoFwlk4hPM4FDPFXlShM3QEq7xKEedgmm.png', 'admission_record', 'pending', '2026-02-02 07:31:08', '2026-02-02 07:31:08', NULL),
(42, '', 6, 'admissions/documents/XUICG9fXQxl8SMr7ycE8mhCskUHKJ9cFe4fiAW1b.png', 'admission_record', 'pending', '2026-02-02 07:31:08', '2026-02-02 07:31:08', NULL),
(43, '', 6, 'admissions/documents/LdIOncDZ0S367jAaB3fVLWUXf4cOy7ugWgseqSJG.png', 'admission_record', 'pending', '2026-02-02 07:40:38', '2026-02-02 07:40:38', NULL),
(44, '', 6, 'admissions/documents/6ES6FALvlNztS9I1LZ74qiDPh5YITV9Y9lewLNGH.png', 'admission_record', 'pending', '2026-02-02 07:40:38', '2026-02-02 07:40:38', NULL),
(45, '', 6, 'admissions/documents/6ry3L9arpd5BZvjEaO75f4lVCCivloPkQJcfi0FU.png', 'admission_record', 'pending', '2026-02-02 07:40:38', '2026-02-02 07:40:38', NULL),
(46, '', 6, 'admissions/documents/K6YF5qozyhLfeaob62wh4hzgGk6DlXD4Y5e5264C.png', 'admission_record', 'pending', '2026-02-02 07:40:38', '2026-02-02 07:40:38', NULL),
(47, '', 6, 'admissions/documents/m1MrVF7jbjxd3V5n4YLcZLYbsD2FejT5jdJNsHO8.png', 'admission_record', 'pending', '2026-02-02 07:40:38', '2026-02-02 07:40:38', NULL),
(48, '', 6, 'admissions/documents/OSjYPpm5tTdBjIdw8Bq3hPZHST9UHyt0GiyNd08v.png', 'admission_record', 'pending', '2026-02-02 07:40:38', '2026-02-02 07:40:38', NULL),
(49, '', 6, 'admissions/documents/lJ7P8Yb7qNYoUwMXcmqbEcCbyOtF02xUdLUnv3Ef.png', 'admission_record', 'pending', '2026-02-02 07:47:37', '2026-02-02 07:47:37', NULL),
(50, '', 6, 'admissions/documents/MHOXQjV4CZjh3O1usx8Oa6ZkvmaCiI2jLVcjBEcj.png', 'admission_record', 'pending', '2026-02-02 07:47:37', '2026-02-02 07:47:37', NULL),
(51, '', 6, 'admissions/documents/mDCMAo35HPnmFuXw9fBaFOxlbDk1OQxV4AotPh3c.png', 'admission_record', 'pending', '2026-02-02 07:47:37', '2026-02-02 07:47:37', NULL),
(52, '', 6, 'admissions/documents/AJMKotlM9fMXsfEFBoF16shfEz0VUWAwNF2EMTdx.png', 'admission_record', 'pending', '2026-02-02 07:47:37', '2026-02-02 07:47:37', NULL),
(53, '', 6, 'admissions/documents/hGBgP50HoFwlk4hPM4FDPFXlShM3QEq7xKEedgmm.png', 'admission_record', 'pending', '2026-02-02 07:47:37', '2026-02-02 07:47:37', NULL),
(54, '', 6, 'admissions/documents/XUICG9fXQxl8SMr7ycE8mhCskUHKJ9cFe4fiAW1b.png', 'admission_record', 'pending', '2026-02-02 07:47:37', '2026-02-02 07:47:37', NULL),
(55, '', 6, 'admissions/documents/LdIOncDZ0S367jAaB3fVLWUXf4cOy7ugWgseqSJG.png', 'admission_record', 'pending', '2026-02-02 07:48:27', '2026-02-02 07:48:27', NULL),
(56, '', 6, 'admissions/documents/6ES6FALvlNztS9I1LZ74qiDPh5YITV9Y9lewLNGH.png', 'admission_record', 'pending', '2026-02-02 07:48:27', '2026-02-02 07:48:27', NULL),
(57, '', 6, 'admissions/documents/6ry3L9arpd5BZvjEaO75f4lVCCivloPkQJcfi0FU.png', 'admission_record', 'pending', '2026-02-02 07:48:27', '2026-02-02 07:48:27', NULL),
(58, '', 6, 'admissions/documents/K6YF5qozyhLfeaob62wh4hzgGk6DlXD4Y5e5264C.png', 'admission_record', 'pending', '2026-02-02 07:48:27', '2026-02-02 07:48:27', NULL),
(59, '', 6, 'admissions/documents/m1MrVF7jbjxd3V5n4YLcZLYbsD2FejT5jdJNsHO8.png', 'admission_record', 'pending', '2026-02-02 07:48:27', '2026-02-02 07:48:27', NULL),
(60, '', 6, 'admissions/documents/OSjYPpm5tTdBjIdw8Bq3hPZHST9UHyt0GiyNd08v.png', 'admission_record', 'pending', '2026-02-02 07:48:27', '2026-02-02 07:48:27', NULL),
(61, '', 7, 'admissions/documents/wN0OfMZ454Gnz6sr74zLgrAmrJbX8fxhdEBLyFJk.png', 'admission_record', 'pending', '2026-02-02 07:52:58', '2026-02-02 07:52:58', NULL),
(62, '', 7, 'admissions/documents/mISFuqsBbFVMsEcNVqo4oBbUY5iEPPvKkfEOGt2N.png', 'admission_record', 'pending', '2026-02-02 07:52:58', '2026-02-02 07:52:58', NULL),
(63, '', 7, 'admissions/documents/iMi7D9XdoLZ2zH2CpIvst1pWmrbPTOJ4IrQDdKZS.png', 'admission_record', 'pending', '2026-02-02 07:52:58', '2026-02-02 07:52:58', NULL),
(64, '', 7, 'admissions/documents/LxrJ3pMdrR9g5LplVZvEILtjSCW4LflxKmzpaMvm.png', 'admission_record', 'pending', '2026-02-02 07:52:58', '2026-02-02 07:52:58', NULL),
(65, '', 7, 'admissions/documents/C0b788FHAwbHl8jg1Smpk6non73eD0O8RAbCNThE.png', 'admission_record', 'pending', '2026-02-02 07:52:58', '2026-02-02 07:52:58', NULL),
(66, '', 7, 'admissions/documents/rWyahPZj7rev2cWFH9sfXIXDW2CHkcwa4B4iVfwA.png', 'admission_record', 'pending', '2026-02-02 07:52:58', '2026-02-02 07:52:58', NULL),
(67, '', 7, 'admissions/documents/wN0OfMZ454Gnz6sr74zLgrAmrJbX8fxhdEBLyFJk.png', 'admission_record', 'pending', '2026-02-02 07:54:58', '2026-02-02 07:54:58', NULL),
(68, '', 7, 'admissions/documents/mISFuqsBbFVMsEcNVqo4oBbUY5iEPPvKkfEOGt2N.png', 'admission_record', 'pending', '2026-02-02 07:54:58', '2026-02-02 07:54:58', NULL),
(69, '', 7, 'admissions/documents/iMi7D9XdoLZ2zH2CpIvst1pWmrbPTOJ4IrQDdKZS.png', 'admission_record', 'pending', '2026-02-02 07:54:58', '2026-02-02 07:54:58', NULL),
(70, '', 7, 'admissions/documents/LxrJ3pMdrR9g5LplVZvEILtjSCW4LflxKmzpaMvm.png', 'admission_record', 'pending', '2026-02-02 07:54:58', '2026-02-02 07:54:58', NULL),
(71, '', 7, 'admissions/documents/C0b788FHAwbHl8jg1Smpk6non73eD0O8RAbCNThE.png', 'admission_record', 'pending', '2026-02-02 07:54:58', '2026-02-02 07:54:58', NULL),
(72, '', 7, 'admissions/documents/rWyahPZj7rev2cWFH9sfXIXDW2CHkcwa4B4iVfwA.png', 'admission_record', 'pending', '2026-02-02 07:54:58', '2026-02-02 07:54:58', NULL),
(73, '', 8, 'admissions/documents/ZDcaRBq8zKzrCuyqbpKyYXd1yQ87C0lu5tJSPAUJ.png', 'admission_record', 'pending', '2026-02-02 08:40:56', '2026-02-02 08:40:56', NULL),
(74, '', 8, 'admissions/documents/h4ylSmRFgcBHRRR3rtxmq5xKa6sn1QtdgDBWv0oc.png', 'admission_record', 'pending', '2026-02-02 08:40:56', '2026-02-02 08:40:56', NULL),
(75, '', 8, 'admissions/documents/jZdSqDvcCp2xYw1AJCpJ9dQxIX3mmR1EzQWMBVCK.png', 'admission_record', 'pending', '2026-02-02 08:40:56', '2026-02-02 08:40:56', NULL),
(76, '', 8, 'admissions/documents/BgXWTIeaKyMcGqPGexuqR9l0PC0tqRRoUhMTNNS9.png', 'admission_record', 'pending', '2026-02-02 08:40:56', '2026-02-02 08:40:56', NULL),
(77, '', 8, 'admissions/documents/1drBNE4vfmvgUxApqqlt1g1VJYVd7p16cktt5XSY.png', 'admission_record', 'pending', '2026-02-02 08:40:56', '2026-02-02 08:40:56', NULL),
(78, '', 8, 'admissions/documents/YJrLxZQ5szLXpJmi52mS0UP2R39wVCeDxGuzkUgB.png', 'admission_record', 'pending', '2026-02-02 08:40:56', '2026-02-02 08:40:56', NULL),
(79, '', 9, 'admissions/documents/U6Dr7d3wzbGOCs7wjk57TuPQZJT37QWmE5TbaYsH.png', 'admission_record', 'Approved', '2026-02-02 09:30:38', '2026-02-02 09:30:38', NULL),
(80, '', 9, 'admissions/documents/CrMWDOTTUjNPyzRezvtvalWb9dJNQy8oypqUYa4M.png', 'admission_record', 'Approved', '2026-02-02 09:30:38', '2026-02-02 09:30:38', NULL),
(81, '', 9, 'admissions/documents/iIFbNnZr6QbGLPbiC0HPvidh3I0QBwghzRTgkwGy.png', 'admission_record', 'Approved', '2026-02-02 09:30:38', '2026-02-02 09:30:38', NULL),
(82, '', 9, 'admissions/documents/uVpucgAxbXEDCDJls3mSvNA2UyHzWZaBzDeMxXD0.png', 'admission_record', 'Approved', '2026-02-02 09:30:38', '2026-02-02 09:30:38', NULL),
(83, '', 9, 'admissions/documents/WErjizfkqg5ZccoRhWuU92MN1FjzYQKMekVTqnIR.png', 'admission_record', 'Approved', '2026-02-02 09:30:38', '2026-02-02 09:30:38', NULL),
(84, '', 9, 'admissions/documents/etRLRyLYWV0cYozucbpBH5VH9v0xa0gNfGhPilmn.png', 'admission_record', 'Approved', '2026-02-02 09:30:38', '2026-02-02 09:30:38', NULL),
(85, NULL, 11, 'documents/lc7391wx2u7w54kdZ3oFKtOpw5hZGRkYopYOseg3.png', 'admission', 'pending', '2026-02-03 04:55:40', '2026-02-03 04:55:40', NULL),
(86, NULL, 11, 'documents/ifdu5CqkgDH93G7RkouPktzUtD6x3IpxrI9Drsdq.png', 'admission', 'pending', '2026-02-03 04:55:40', '2026-02-03 04:55:40', NULL),
(87, NULL, 11, 'documents/QzlVAJCFmcufEBNEJ755WPNO4XvJ0aWzhVnTagpb.png', 'admission', 'pending', '2026-02-03 04:55:40', '2026-02-03 04:55:40', NULL),
(88, NULL, 11, 'documents/kD7R7vHnsYO4SMsfnJzzNKtm8cowkwRunT53fpq5.png', 'admission', 'pending', '2026-02-03 04:55:40', '2026-02-03 04:55:40', NULL),
(89, NULL, 11, 'documents/g7rB92JXDgzEixwqbkMN8t4R5Wdz6Cy1LzAj3w3y.png', 'admission', 'pending', '2026-02-03 04:55:40', '2026-02-03 04:55:40', NULL),
(90, NULL, 11, 'documents/PDZZpijbMFTX6Qz0TDr4cdoXPY9xDw91wX4MCKU7.png', 'admission', 'pending', '2026-02-03 04:55:40', '2026-02-03 04:55:40', NULL),
(91, NULL, 11, 'documents/xy9uOqUCLgwbtxhmjh8gbHZ5pVDXMFK1WMwfqhr6.png', 'admission', 'pending', '2026-02-03 04:55:40', '2026-02-03 04:55:40', NULL),
(92, NULL, 10, 'admissions/documents/BDbYoYhWCbYojh3sUPjDSQjxVzivp1XWb2MT7K3R.png', 'admission_record', 'Approved', '2026-02-03 04:56:12', '2026-02-03 04:56:12', NULL),
(93, NULL, 10, 'admissions/documents/yWPynACo3hsTUbr9KOvGZDYnblM7OmdA2hhaKj58.png', 'admission_record', 'Approved', '2026-02-03 04:56:12', '2026-02-03 04:56:12', NULL),
(94, NULL, 10, 'admissions/documents/IwsPVlgzr13mnrbYbxDPuYWbMSRNbsOfHZbEZ0Fv.png', 'admission_record', 'Approved', '2026-02-03 04:56:12', '2026-02-03 04:56:12', NULL),
(95, NULL, 10, 'admissions/documents/71o4NqKKUcbVqT3LaO19QIB73XFYc83bHVP2zMXF.png', 'admission_record', 'Approved', '2026-02-03 04:56:12', '2026-02-03 04:56:12', NULL),
(96, NULL, 10, 'admissions/documents/9F2GJVJRer6YgMRZaEEb8a6Z6pNnWLtPxpn1kCnE.png', 'admission_record', 'Approved', '2026-02-03 04:56:12', '2026-02-03 04:56:12', NULL),
(97, NULL, 10, 'admissions/documents/5FFHFkQGlY5jswBFVh9vCxnRfgN4v4sJkCaVjV2P.png', 'admission_record', 'Approved', '2026-02-03 04:56:12', '2026-02-03 04:56:12', NULL),
(98, NULL, 11, 'documents/2vTkDVkXM4CUi96cYrS3jiUxRMeGvIrr4f7xQwfB.png', 'admission', 'pending', '2026-02-03 05:06:23', '2026-02-03 05:06:23', NULL),
(99, NULL, 11, 'documents/vfFr4lWzme2fVNBBAdFKm0RblFgLgFiaLYTtzcqJ.png', 'admission', 'pending', '2026-02-03 05:06:23', '2026-02-03 05:06:23', NULL),
(100, NULL, 11, 'documents/Im2bv6daocTlu8T4rA0ryc8IyfYYb7uQmWVMNkoS.png', 'admission', 'pending', '2026-02-03 05:06:23', '2026-02-03 05:06:23', NULL),
(101, NULL, 11, 'documents/hVVNPI7MPXxO3hG8HS1niJsjkFVbLKixEbriHatq.png', 'admission', 'pending', '2026-02-03 05:06:23', '2026-02-03 05:06:23', NULL),
(102, NULL, 11, 'documents/TLVBY0tsAXwdm5vaq40J397n5CVs1YpVNQKFwwpW.png', 'admission', 'pending', '2026-02-03 05:06:23', '2026-02-03 05:06:23', NULL),
(103, NULL, 11, 'documents/2IBPSjPOyDAMlS1JVhwpWbBFTk3wgIZ8ZzAW7fUj.png', 'admission', 'pending', '2026-02-03 05:06:23', '2026-02-03 05:06:23', NULL),
(104, NULL, 11, 'admissions/documents/2nPNoxEXfYL8F7RTaXqf2TJqJwcASOreDPjSdYjC.png', 'admission_record', 'Approved', '2026-02-03 05:09:08', '2026-02-03 05:09:08', NULL),
(105, NULL, 11, 'admissions/documents/PMrE1I5BtMMvPz3SEaxgvGf9jvhaRXItJ8UOFLJu.png', 'admission_record', 'Approved', '2026-02-03 05:09:08', '2026-02-03 05:09:08', NULL),
(106, NULL, 11, 'admissions/documents/ePIxVRn5xcMptkgvdsqSxjOwZJlsWBb9FnBcr6uN.png', 'admission_record', 'Approved', '2026-02-03 05:09:08', '2026-02-03 05:09:08', NULL),
(107, NULL, 11, 'admissions/documents/clfziFu6jXkeBx7GliRmlyaTNZqyRTDQcJ9F2c85.png', 'admission_record', 'Approved', '2026-02-03 05:09:08', '2026-02-03 05:09:08', NULL),
(108, NULL, 11, 'admissions/documents/sxHIZRbhfOlSA8EisjzTJcFlRqVHc7xNBsDJSKNo.png', 'admission_record', 'Approved', '2026-02-03 05:09:08', '2026-02-03 05:09:08', NULL),
(109, NULL, 11, 'admissions/documents/B8OKoIyCwRMfeN9FfI4mgL3a4wFWoCZdgHX3UXaF.png', 'admission_record', 'Approved', '2026-02-03 05:09:08', '2026-02-03 05:09:08', NULL),
(110, NULL, 11, 'admissions/documents/2nPNoxEXfYL8F7RTaXqf2TJqJwcASOreDPjSdYjC.png', 'admission_record', 'Approved', '2026-02-03 05:21:14', '2026-02-03 05:21:14', NULL),
(111, NULL, 11, 'admissions/documents/PMrE1I5BtMMvPz3SEaxgvGf9jvhaRXItJ8UOFLJu.png', 'admission_record', 'Approved', '2026-02-03 05:21:14', '2026-02-03 05:21:14', NULL),
(112, NULL, 11, 'admissions/documents/ePIxVRn5xcMptkgvdsqSxjOwZJlsWBb9FnBcr6uN.png', 'admission_record', 'Approved', '2026-02-03 05:21:14', '2026-02-03 05:21:14', NULL),
(113, NULL, 11, 'admissions/documents/clfziFu6jXkeBx7GliRmlyaTNZqyRTDQcJ9F2c85.png', 'admission_record', 'Approved', '2026-02-03 05:21:14', '2026-02-03 05:21:14', NULL),
(114, NULL, 11, 'admissions/documents/sxHIZRbhfOlSA8EisjzTJcFlRqVHc7xNBsDJSKNo.png', 'admission_record', 'Approved', '2026-02-03 05:21:14', '2026-02-03 05:21:14', NULL),
(115, NULL, 11, 'admissions/documents/B8OKoIyCwRMfeN9FfI4mgL3a4wFWoCZdgHX3UXaF.png', 'admission_record', 'Approved', '2026-02-03 05:21:14', '2026-02-03 05:21:14', NULL),
(116, NULL, 12, 'admissions/documents/bW4Wbwpn7aVsU5cFnaambUaNcMtslNOLALRMyDF4.png', 'admission_record', 'Pending', '2026-02-04 11:31:51', '2026-02-04 11:31:51', 'Report Card'),
(117, NULL, 12, 'admissions/documents/kmm5j6hFDMogjhsQU91ZgpVgvijTPa6naADR9xCW.png', 'admission_record', 'Pending', '2026-02-04 11:31:51', '2026-02-04 11:31:51', 'Birth Certificate'),
(118, NULL, 12, 'admissions/documents/hSRHslbUZuFegO31DYoMGktKo2wEXGrccRsBZvam.png', 'admission_record', 'Pending', '2026-02-04 11:31:51', '2026-02-04 11:31:51', 'Applicant Photo'),
(119, NULL, 12, 'admissions/documents/vGFrPieEwcZiXQuYqwbEUdWRQjidLvTYLGcXT8Mr.png', 'admission_record', 'Pending', '2026-02-04 11:31:51', '2026-02-04 11:31:51', 'Father Photo'),
(120, NULL, 12, 'admissions/documents/F9j0bu6sHVrirnkcJ0ZaqUGVDWJHCuoyXyqZiScT.png', 'admission_record', 'Pending', '2026-02-04 11:31:51', '2026-02-04 11:31:51', 'Mother Photo'),
(121, NULL, 12, 'admissions/documents/tDotKIMwKcgjgbej1Om93jjWPSx9SYZv3gl949EP.png', 'admission_record', 'Pending', '2026-02-04 11:31:51', '2026-02-04 11:31:51', 'Guardian Photo'),
(122, NULL, 12, 'admissions/documents/msNZ5iR7qejvQHLqkVQMR3Hr1BDys76zmi6Xx2Lv.png', 'admission_record', 'Pending', '2026-02-04 11:31:51', '2026-02-04 11:31:51', 'Transferee Docs'),
(123, NULL, 14, 'admissions/documents/W3ji3UFm0DhISrRQxYOc5KqxM1zpdWa7wLShT0FD.png', 'admission_record', 'Pending', '2026-02-05 00:45:22', '2026-02-05 00:45:22', 'Report Card'),
(124, NULL, 14, 'admissions/documents/HTyPF8hwpIxJhtpS13HcRbkZKO3h5vMZ0nAIyq7a.png', 'admission_record', 'Pending', '2026-02-05 00:45:22', '2026-02-05 00:45:22', 'Birth Certificate'),
(125, NULL, 14, 'admissions/documents/VWLsMrThmeNm6iC1GPdljEn95auxxZ8oF52MPgUV.png', 'admission_record', 'Pending', '2026-02-05 00:45:22', '2026-02-05 00:45:22', 'Applicant Photo'),
(126, NULL, 14, 'admissions/documents/nJHcWDHwhntH8FTVdwalRYALEace6tEecONRT93w.png', 'admission_record', 'Pending', '2026-02-05 00:45:22', '2026-02-05 00:45:22', 'Father Photo'),
(127, NULL, 14, 'admissions/documents/UWMxE1lTruYGQ75k6RJO2IEy5BO5YCaudeteCzrD.png', 'admission_record', 'Pending', '2026-02-05 00:45:22', '2026-02-05 00:45:22', 'Mother Photo'),
(128, NULL, 14, 'admissions/documents/cH5JtU3q0YmsmiIipaCR3JFeq5EWGsKDiSWOrzNe.png', 'admission_record', 'Pending', '2026-02-05 00:45:22', '2026-02-05 00:45:22', 'Guardian Photo'),
(129, NULL, 14, 'admissions/documents/ZDubCpltd7OZ8uKffmbfmU8SsK0Arxgc2ocDsI4o.png', 'admission_record', 'Pending', '2026-02-05 00:45:22', '2026-02-05 00:45:22', 'Transferee Docs'),
(130, NULL, 15, 'admissions/documents/qMHswE0KxSg8XOXG4KE14OlW71s2JfCIUtFOOT9n.png', 'admission_record', 'Pending', '2026-02-05 01:55:08', '2026-02-05 01:55:08', 'Report Card'),
(131, NULL, 15, 'admissions/documents/XQUAsbiPIt6RK7lhy0YHJgNbYIfV8O41KQFf77nR.png', 'admission_record', 'Pending', '2026-02-05 01:55:08', '2026-02-05 01:55:08', 'Birth Certificate'),
(132, NULL, 15, 'admissions/documents/EkiOgr5CyiwymV86uiXEN69mJCXMTPRMkdAWxjp0.png', 'admission_record', 'Pending', '2026-02-05 01:55:08', '2026-02-05 01:55:08', 'Applicant Photo'),
(133, NULL, 15, 'admissions/documents/AI18dAOnLeoSI720oYIUcya7p68bIj8JKflIfgsV.png', 'admission_record', 'Pending', '2026-02-05 01:55:08', '2026-02-05 01:55:08', 'Father Photo'),
(134, NULL, 15, 'admissions/documents/0P8jplXj79TWfBEw9tkSJf2nMTxx97Lf4e1uUnMH.png', 'admission_record', 'Pending', '2026-02-05 01:55:08', '2026-02-05 01:55:08', 'Mother Photo'),
(135, NULL, 15, 'admissions/documents/Kn2yM2Ido1mlMRWZjfhVTsZ1Bhp8az7vLSRZwfct.png', 'admission_record', 'Pending', '2026-02-05 01:55:08', '2026-02-05 01:55:08', 'Guardian Photo'),
(136, NULL, 15, 'admissions/documents/O2hSMSjed38bVv2TO7D41uMVBr6Oi8rV5zjFN7pU.png', 'admission_record', 'Pending', '2026-02-05 01:55:08', '2026-02-05 01:55:08', 'Transferee Docs'),
(137, NULL, 17, 'admissions/documents/A5BaWlB2VT9Q0qzS9QbSP7ddR40gBAo39WRiEuAt.png', 'admission_record', 'Pending', '2026-02-09 01:19:31', '2026-02-09 01:19:31', 'Report Card'),
(138, NULL, 17, 'admissions/documents/Zu6pBSVo4RwXF9iGRoweVQPunYzTRqPJYjWHT8RR.png', 'admission_record', 'Pending', '2026-02-09 01:19:31', '2026-02-09 01:19:31', 'Birth Certificate'),
(139, NULL, 17, 'admissions/documents/LJJqwtXEBokr3mC0xObeqHj0eUSrTMdTcl4Qvzto.png', 'admission_record', 'Pending', '2026-02-09 01:19:31', '2026-02-09 01:19:31', 'Applicant Photo'),
(140, NULL, 17, 'admissions/documents/o7ySIlVgg6V64QUyypGApCmVqzoM5HhNPpDuXyjb.png', 'admission_record', 'Pending', '2026-02-09 01:19:31', '2026-02-09 01:19:31', 'Father Photo'),
(141, NULL, 17, 'admissions/documents/E2XlXBHVi9QiPmENGpIhbsG7qvHGg0vFWDcpdVtg.png', 'admission_record', 'Pending', '2026-02-09 01:19:31', '2026-02-09 01:19:31', 'Mother Photo'),
(142, NULL, 17, 'admissions/documents/RneeMhzBO3ezXXHq7K5tzNkTRBXx94B3JGuv78Yc.png', 'admission_record', 'Pending', '2026-02-09 01:19:31', '2026-02-09 01:19:31', 'Guardian Photo'),
(143, NULL, 17, 'admissions/documents/KHm359TiJ6FGatTQ0qGJMAcCXaG1qrz0Bvfz5RQj.png', 'admission_record', 'Pending', '2026-02-09 01:19:31', '2026-02-09 01:19:31', 'Transferee Docs'),
(144, NULL, 18, 'admissions/documents/R3poxI3rohmmnywX0BAL4UBaZxuC1jYJEQbVbdJA.png', 'admission_record', 'Pending', '2026-02-09 01:26:32', '2026-02-09 01:26:32', 'Report Card'),
(145, NULL, 18, 'admissions/documents/CYh4jHdEsfFF8tYgf1RyiViNXjrCMxFskXhqyEAT.png', 'admission_record', 'Pending', '2026-02-09 01:26:32', '2026-02-09 01:26:32', 'Birth Certificate'),
(146, NULL, 18, 'admissions/documents/PTP5rHVg1DHhpDeHYzVPoMTLoyZif1jCjaa4eD2f.png', 'admission_record', 'Pending', '2026-02-09 01:26:32', '2026-02-09 01:26:32', 'Applicant Photo'),
(147, NULL, 18, 'admissions/documents/yD9RXRdaYrO2NQsaF3pPIULZlpvfZRX8w8B0oeON.png', 'admission_record', 'Pending', '2026-02-09 01:26:32', '2026-02-09 01:26:32', 'Father Photo'),
(148, NULL, 18, 'admissions/documents/ytH6JHUzVcnDIhQDy0EROsItl7WEhYQuXvXpf9d4.png', 'admission_record', 'Pending', '2026-02-09 01:26:32', '2026-02-09 01:26:32', 'Mother Photo'),
(149, NULL, 18, 'admissions/documents/7RLzBYhEVx8YqH20pGaC8na4tST11rqZEEUL0iXZ.png', 'admission_record', 'Pending', '2026-02-09 01:26:32', '2026-02-09 01:26:32', 'Guardian Photo'),
(150, NULL, 18, 'admissions/documents/tprGPgEOuGJVEQokLhOlRk7E0GRwCWDOVNoDT49U.png', 'admission_record', 'Pending', '2026-02-09 01:26:32', '2026-02-09 01:26:32', 'Transferee Docs'),
(151, NULL, 19, 'admissions/documents/SXCKWlv8R495I1BTguFhyoaDk1f40JokgSB2DlvE.png', 'admission_record', 'Pending', '2026-02-09 01:31:23', '2026-02-09 01:31:23', 'Report Card'),
(152, NULL, 19, 'admissions/documents/m7pqMFebre2IRQHKtW1ImBXk75EOr105hsOJKqte.png', 'admission_record', 'Pending', '2026-02-09 01:31:23', '2026-02-09 01:31:23', 'Birth Certificate'),
(153, NULL, 19, 'admissions/documents/HRQTOrUWaLoWPBSvuB1CVbp4FImJPDyyAHzLx53Q.png', 'admission_record', 'Pending', '2026-02-09 01:31:23', '2026-02-09 01:31:23', 'Applicant Photo'),
(154, NULL, 19, 'admissions/documents/PED6VYpYCTx9aVSIA1QgCbRjUtyX5GvkvVZXwusa.png', 'admission_record', 'Pending', '2026-02-09 01:31:23', '2026-02-09 01:31:23', 'Father Photo'),
(155, NULL, 19, 'admissions/documents/fVL3EQ6ofrxDX862kVfFMU7vROQZiWJgSJ9rbIoB.png', 'admission_record', 'Pending', '2026-02-09 01:31:23', '2026-02-09 01:31:23', 'Mother Photo'),
(156, NULL, 19, 'admissions/documents/4nMEx43L8b612q4t4w0aipNRTfhF5GUM6D9KX2IR.png', 'admission_record', 'Pending', '2026-02-09 01:31:23', '2026-02-09 01:31:23', 'Guardian Photo'),
(157, NULL, 19, 'admissions/documents/0xfT2tXR1KqgzogsS2bcgdYAsszlFlU04zk1qwKD.png', 'admission_record', 'Pending', '2026-02-09 01:31:23', '2026-02-09 01:31:23', 'Transferee Docs'),
(158, NULL, 59, 'admissions/documents/iAcNp183aymFl8wjMiuIbFJ7aszjLKpyvkyKsxhB.png', 'admission_record', 'Pending', '2026-02-16 09:29:51', '2026-02-16 09:29:51', 'Report Card'),
(159, NULL, 59, 'admissions/documents/dVPj0p1XBZSL4ljMp1ZRcr1eEfYssXxJT4cmULEu.png', 'admission_record', 'Pending', '2026-02-16 09:29:51', '2026-02-16 09:29:51', 'Birth Certificate'),
(160, NULL, 59, 'admissions/documents/PnyvM6Ty2XZlwGdUGzNW8OukoOQiaWm2ZwzN5zoC.png', 'admission_record', 'Pending', '2026-02-16 09:29:51', '2026-02-16 09:29:51', 'Applicant Photo'),
(161, NULL, 59, 'admissions/documents/4wHAR49j43zfEglWYJazWSQfcUyDdxH0Kyrq5jcA.png', 'admission_record', 'Pending', '2026-02-16 09:29:51', '2026-02-16 09:29:51', 'Father Photo'),
(162, NULL, 59, 'admissions/documents/1yFTzi4vPKA4tvymCGXYcsr697jNPLpeIkvP4Il8.png', 'admission_record', 'Pending', '2026-02-16 09:29:51', '2026-02-16 09:29:51', 'Mother Photo'),
(163, NULL, 59, 'admissions/documents/jKNy7MPYecsVaOK0uYDGTvZitbNVXXWvz01xNfrt.png', 'admission_record', 'Pending', '2026-02-16 09:29:51', '2026-02-16 09:29:51', 'Guardian Photo'),
(164, NULL, 59, 'admissions/documents/LPjugglolSkWuUNCyx0p3LEdtZ77eMhvOhHNkgpm.png', 'admission_record', 'Pending', '2026-02-16 09:29:51', '2026-02-16 09:29:51', 'Transferee Docs'),
(165, NULL, 42, 'admissions/documents/vvEeUy8sETo6ijbvde4vHmeOAkKLWStjPtpjfh3P.png', 'admission_record', 'Pending', '2026-02-17 07:54:16', '2026-02-17 07:54:16', 'Report Card'),
(166, NULL, 42, 'admissions/documents/PVkeDbwWT6kG9iraAWPREorpxbu8pLykgQpOnnXF.png', 'admission_record', 'Pending', '2026-02-17 07:54:16', '2026-02-17 07:54:16', 'Birth Certificate'),
(167, NULL, 42, 'admissions/documents/9Rk48MXuUp78StS405BrM0KPGQ6Ms9ACcXJ1cMIq.png', 'admission_record', 'Pending', '2026-02-17 07:54:16', '2026-02-17 07:54:16', 'Applicant Photo'),
(168, NULL, 42, 'admissions/documents/E2b3niQPyTEJHPBCKpNNfYM5mJ1f90hl9xVeTE7V.png', 'admission_record', 'Pending', '2026-02-17 07:54:16', '2026-02-17 07:54:16', 'Father Photo'),
(169, NULL, 42, 'admissions/documents/CsP8MJBteamDieNFPEnierLAujsPTAdxW4fzg61K.png', 'admission_record', 'Pending', '2026-02-17 07:54:16', '2026-02-17 07:54:16', 'Mother Photo'),
(170, NULL, 42, 'admissions/documents/LrudOLmv18oEcgfCLYwyMos9nzMn4DmtNRyWfHyp.png', 'admission_record', 'Pending', '2026-02-17 07:54:16', '2026-02-17 07:54:16', 'Guardian Photo'),
(171, NULL, 45, 'admissions/documents/AOP13wAYZR8scJqoLE9hNiZfyrzqdbr2coucq9Tu.png', 'admission_record', 'Pending', '2026-02-18 22:44:34', '2026-02-18 22:44:34', 'Report Card'),
(172, NULL, 45, 'admissions/documents/EVWZAd6i0plOYwVSafqBbuMUpldMyVVLGdZvEXfn.png', 'admission_record', 'Pending', '2026-02-18 22:44:34', '2026-02-18 22:44:34', 'Birth Certificate'),
(173, NULL, 45, 'admissions/documents/xQixrs8CnOvu69ALghzj0ZQaDvU4pNBhg6PMsm8k.png', 'admission_record', 'Pending', '2026-02-18 22:44:34', '2026-02-18 22:44:34', 'Applicant Photo'),
(174, NULL, 45, 'admissions/documents/maIEjys4nRWm9dV988erCSebrowCjCj1edwP9nXw.png', 'admission_record', 'Pending', '2026-02-18 22:44:34', '2026-02-18 22:44:34', 'Father Photo'),
(175, NULL, 45, 'admissions/documents/2gBcVdX1h5zTuuUhTlqFDDCaZZLQKr5GUWiDrs0n.png', 'admission_record', 'Pending', '2026-02-18 22:44:34', '2026-02-18 22:44:34', 'Mother Photo'),
(176, NULL, 45, 'admissions/documents/zptw94jqshTlwBBZwS1G7PSnDfDEvsCKmseeSAl5.png', 'admission_record', 'Pending', '2026-02-18 22:44:34', '2026-02-18 22:44:34', 'Guardian Photo'),
(177, NULL, 46, 'admissions/documents/ufxS9VOGJ13F8wvvUQLN3AQCSFfML0VsI67KKErf.png', 'admission_record', 'Pending', '2026-02-19 00:11:35', '2026-02-19 00:11:35', 'Report Card'),
(178, NULL, 46, 'admissions/documents/bywW53GQBCKrL2g7xMr6eMtnqeXwYRDHuekEOsFc.png', 'admission_record', 'Pending', '2026-02-19 00:11:35', '2026-02-19 00:11:35', 'Birth Certificate'),
(179, NULL, 46, 'admissions/documents/tu9y2IYb9zes0mW0PJP3eohqOGUhove8dTJwnZRb.png', 'admission_record', 'Pending', '2026-02-19 00:11:35', '2026-02-19 00:11:35', 'Applicant Photo'),
(180, NULL, 46, 'admissions/documents/kvUS7JVM7QkpcMMPV3W6qNmZTv66cmU4aHG5UGs1.png', 'admission_record', 'Pending', '2026-02-19 00:11:35', '2026-02-19 00:11:35', 'Father Photo'),
(181, NULL, 46, 'admissions/documents/9444bafDwb2MFOqwibpPL3ebhGaAbImQd8fbi9r6.png', 'admission_record', 'Pending', '2026-02-19 00:11:35', '2026-02-19 00:11:35', 'Mother Photo'),
(182, NULL, 46, 'admissions/documents/K1XMh1ZjTYbnaqXqDNQRFohNjauS1TfmxYhSsmrP.png', 'admission_record', 'Pending', '2026-02-19 00:11:35', '2026-02-19 00:11:35', 'Guardian Photo'),
(183, NULL, 53, 'admissions/documents/3ZrftRQ5jvoybdP8lYiLYptFfKwEeuRtR5toNAOy.png', 'admission_record', 'Pending', '2026-02-23 05:33:17', '2026-02-23 05:33:17', 'Report Card'),
(184, NULL, 53, 'admissions/documents/hj82I0DQPMUkhnP816K6oVgiJhSk58wmoCKjnUFp.png', 'admission_record', 'Pending', '2026-02-23 05:33:17', '2026-02-23 05:33:17', 'Birth Certificate'),
(185, NULL, 53, 'admissions/documents/vvswhuzPs5e7SB5AcZV1wrHhxf61n9nqgmiOhFUx.png', 'admission_record', 'Pending', '2026-02-23 05:33:17', '2026-02-23 05:33:17', 'Applicant Photo'),
(186, NULL, 53, 'admissions/documents/o3vgBGnZ3ODtefsZMLzkNqoqc2W0jDa2SUhgCjb2.png', 'admission_record', 'Pending', '2026-02-23 05:33:17', '2026-02-23 05:33:17', 'Father Photo'),
(187, NULL, 53, 'admissions/documents/ArISdROrsO56FxvhIfBNaMQ0TNUSDTazdyxwnJde.png', 'admission_record', 'Pending', '2026-02-23 05:33:17', '2026-02-23 05:33:17', 'Mother Photo'),
(188, NULL, 53, 'admissions/documents/A9zlcT25HULkihVjDb7iALSYTvQQTXksMNBDppic.png', 'admission_record', 'Pending', '2026-02-23 05:33:17', '2026-02-23 05:33:17', 'Guardian Photo'),
(189, NULL, 41, 'admissions/documents/Vzaspyo8bav6MIxxlEfSQW9ZCTBpv3677q4I6LTk.png', 'admission_record', 'Pending', '2026-02-24 06:41:09', '2026-02-24 06:41:09', 'Report Card'),
(190, NULL, 41, 'admissions/documents/Gr7vwGjtcmXQ92iHLcxeY0J56hdIIFBlEod9n3wH.png', 'admission_record', 'Pending', '2026-02-24 06:41:09', '2026-02-24 06:41:09', 'Birth Certificate'),
(191, NULL, 41, 'admissions/documents/nbFh1DNJvV2yFQF5nLPFBh1Ji0dE6r3J1WC5tStk.png', 'admission_record', 'Pending', '2026-02-24 06:41:09', '2026-02-24 06:41:09', 'Applicant Photo'),
(192, NULL, 41, 'admissions/documents/uHCsYouyLHIuEkAMOFPsdpfg8Z0PPvPGsIoDjvXU.png', 'admission_record', 'Pending', '2026-02-24 06:41:09', '2026-02-24 06:41:09', 'Father Photo'),
(193, NULL, 41, 'admissions/documents/jZKeQF6rvrQmb2Ts4ZTsskZ0dFc07AcYdmfDRicA.png', 'admission_record', 'Pending', '2026-02-24 06:41:09', '2026-02-24 06:41:09', 'Mother Photo'),
(194, NULL, 41, 'admissions/documents/a4VkdT4T5ra6Get4dmCjldAf3uBBezCrytzlqJiB.png', 'admission_record', 'Pending', '2026-02-24 06:41:09', '2026-02-24 06:41:09', 'Guardian Photo'),
(195, NULL, 41, 'admissions/documents/xXAC96wgHqSTKpmleHxjHiZFEFJzijBZmHclvPSh.png', 'admission_record', 'Pending', '2026-02-24 06:43:56', '2026-02-24 06:43:56', 'Report Card'),
(196, NULL, 41, 'admissions/documents/KjA3oAMnL2HnDbKCUJopf5I2dINvlmip9m7QAxfJ.png', 'admission_record', 'Pending', '2026-02-24 06:43:56', '2026-02-24 06:43:56', 'Birth Certificate'),
(197, NULL, 41, 'admissions/documents/pFh0YFIgur41pW0ubfVHwE2fdxuYjfWsF2VMdiOK.png', 'admission_record', 'Pending', '2026-02-24 06:43:56', '2026-02-24 06:43:56', 'Applicant Photo'),
(198, NULL, 41, 'admissions/documents/o6hKOPsepwyw6cwF2GSo4Le4H0p3tvKeUnl5gl8j.png', 'admission_record', 'Pending', '2026-02-24 06:43:56', '2026-02-24 06:43:56', 'Father Photo'),
(199, NULL, 41, 'admissions/documents/iRwvMGGfvnU0uKeXAMzxhKsJRtOv2NXhzgpbFDmA.png', 'admission_record', 'Pending', '2026-02-24 06:43:56', '2026-02-24 06:43:56', 'Mother Photo'),
(200, NULL, 41, 'admissions/documents/16armzOvuZWgjaUMvmiSVn9DvjTEiryIw22oLJYa.png', 'admission_record', 'Pending', '2026-02-24 06:43:56', '2026-02-24 06:43:56', 'Guardian Photo'),
(201, NULL, 211, 'admissions/documents/Vr35iCqDBVc00xQmJJQpHYDRT2JlV7QXMUT14Rjm.png', 'admission_record', 'Pending', '2026-03-03 23:51:27', '2026-03-03 23:51:27', 'Report Card'),
(202, NULL, 211, 'admissions/documents/nLbjGxmKxNU9bu9bjOVepYwy6wUJyDt0Cdpcttph.png', 'admission_record', 'Pending', '2026-03-03 23:51:27', '2026-03-03 23:51:27', 'Birth Certificate'),
(203, NULL, 211, 'admissions/documents/TBFe8vTqsPl1BkxZTjjfUBqF6TUX3XcVT2ly9ES5.png', 'admission_record', 'Pending', '2026-03-03 23:51:27', '2026-03-03 23:51:27', 'Applicant Photo'),
(204, NULL, 211, 'admissions/documents/CdSrkcaj0UXw7sEtzibH6jpeS3UICqNkNTIuBDRR.png', 'admission_record', 'Pending', '2026-03-03 23:51:27', '2026-03-03 23:51:27', 'Father Photo'),
(205, NULL, 211, 'admissions/documents/YLCz8VQJ7PQj1taSSLeOXxvLly1G30gsvRUYjtMg.png', 'admission_record', 'Pending', '2026-03-03 23:51:27', '2026-03-03 23:51:27', 'Mother Photo'),
(206, NULL, 211, 'admissions/documents/yNSF6jJzR42eMoZis3iPyklSyPZvBPafOoG6Rcgu.png', 'admission_record', 'Pending', '2026-03-03 23:51:27', '2026-03-03 23:51:27', 'Guardian Photo');

-- --------------------------------------------------------

--
-- Table structure for table `email_logs`
--

CREATE TABLE `email_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `studentNumber` varchar(255) NOT NULL,
  `recipient_email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT 'Enrollment Reminder',
  `message` text NOT NULL,
  `status` varchar(50) NOT NULL COMMENT 'sent or failed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_logs`
--

INSERT INTO `email_logs` (`id`, `studentNumber`, `recipient_email`, `subject`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, '20240201', 'ashley.graham@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Ashley! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:26:09', '2026-03-04 10:26:09'),
(2, '20240202', 'ethan.winters@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Ethan! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:26:10', '2026-03-04 10:26:10'),
(3, '20240203', 'mia.winters@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Mia! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:26:11', '2026-03-04 10:26:11'),
(4, '20240201', 'ashley.graham@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Ashley! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:28:22', '2026-03-04 10:28:22'),
(5, '20240202', 'ethan.winters@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Ethan! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:28:23', '2026-03-04 10:28:23'),
(6, '20240203', 'mia.winters@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Mia! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:28:24', '2026-03-04 10:28:24'),
(7, '20240201', 'ashley.graham@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Ashley! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:30:14', '2026-03-04 10:30:14'),
(8, '20240202', 'ethan.winters@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Ethan! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:30:15', '2026-03-04 10:30:15'),
(9, '20240203', 'mia.winters@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Mia! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:30:16', '2026-03-04 10:30:16'),
(10, '20240201', 'ashley.graham@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Ashley! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:31:49', '2026-03-04 10:31:49'),
(11, '20240202', 'ethan.winters@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Ethan! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:31:50', '2026-03-04 10:31:50'),
(12, '20240203', 'mia.winters@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Mia! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:31:51', '2026-03-04 10:31:51'),
(13, '20240201', 'ashley.graham@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Ashley! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:36:52', '2026-03-04 10:36:52'),
(14, '20240202', 'ethan.winters@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Ethan! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:36:54', '2026-03-04 10:36:54'),
(15, '20240203', 'mia.winters@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Mia! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:36:55', '2026-03-04 10:36:55'),
(16, '20240201', 'ashley.graham@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Ashley! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:39:49', '2026-03-04 10:39:49'),
(17, '20240202', 'ethan.winters@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Ethan! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:39:52', '2026-03-04 10:39:52'),
(18, '20240203', 'mia.winters@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Mia! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:39:54', '2026-03-04 10:39:54'),
(19, '20240201', 'ashley.graham@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Ashley! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:40:01', '2026-03-04 10:40:01'),
(20, '20240202', 'ethan.winters@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Ethan! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:40:03', '2026-03-04 10:40:03'),
(21, '20240203', 'mia.winters@example.com', 'Action Required: Enrollment for SY 2025-2026', 'Hi Mia! This is FUMCES. We noticed you haven\'t registered for SY 2025-2026 yet. Secure your slot now!', 'sent', '2026-03-04 10:40:06', '2026-03-04 10:40:06');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academic_year_id` bigint(20) UNSIGNED NOT NULL,
  `studentNumber` varchar(255) NOT NULL,
  `student_type` varchar(20) DEFAULT 'new',
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shift` enum('morning','afternoon','whole day') NOT NULL,
  `year_level` varchar(255) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `academic_year_id`, `studentNumber`, `student_type`, `section_id`, `shift`, `year_level`, `school_year`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'TEMP-1', 'new', 1010, 'morning', 'grade10', '2026-2027', 'enrolled', '2026-02-17 08:41:02', '2026-02-17 08:41:02'),
(2, 1, 'SN-2026-0025', 'new', 202, 'morning', 'grade7', '2026-2027', 'enrolled', '2026-02-17 08:42:29', '2026-02-17 08:42:29'),
(3, 1, 'TEMP-2', 'new', 202, 'morning', 'grade7', '2026-2027', 'enrolled', '2026-02-17 09:09:51', '2026-02-17 09:09:51'),
(4, 1, 'TEMP-8', 'new', 3, 'morning', 'grade5', '2026-2027', 'enrolled', '2026-02-17 09:12:20', '2026-02-17 09:12:20'),
(6, 1, 'TEMP-9', 'new', 202, 'morning', 'grade7', '2026-2027', 'enrolled', '2026-02-18 20:25:27', '2026-02-18 20:25:27'),
(7, 1, '2026000027', 'new', 1010, 'morning', 'grade10', '2026-2027', 'enrolled', '2026-02-19 00:18:19', '2026-02-19 00:18:19'),
(8, 1, '2026000046', 'new', 1025, 'morning', 'kinder2', '2026-2027', 'enrolled', '2026-02-24 08:39:23', '2026-02-24 08:39:23'),
(13, 1, '2026000026', 'new', 1025, 'whole day', 'kinder2', '2025-2026', 'enrolled', '2026-02-24 09:21:48', '2026-02-24 09:21:48'),
(14, 1, '2026000051', 'new', 1025, 'morning', 'kinder2', '2025-2026', 'enrolled', '2026-02-24 09:22:00', '2026-02-24 09:22:00'),
(15, 1, '2026000041', 'new', 1025, 'morning', 'kinder2', '2025-2026', 'enrolled', '2026-02-24 09:22:00', '2026-02-24 09:22:00'),
(16, 1, '2026000056', 'new', 1025, 'morning', 'kinder2', '2025-2026', 'enrolled', '2026-02-24 09:22:00', '2026-02-24 09:22:00'),
(17, 1, '2026000061', 'new', 1025, 'morning', 'kinder2', '2025-2026', 'enrolled', '2026-02-24 09:22:00', '2026-02-24 09:22:00'),
(18, 1, '2026000040', 'new', 1024, 'morning', 'kinder1', '2025-2026', 'enrolled', '2026-02-24 09:23:51', '2026-02-24 09:23:51'),
(19, 1, '2026000045', 'new', 1024, 'morning', 'kinder1', '2025-2026', 'enrolled', '2026-02-24 09:23:51', '2026-02-24 09:23:51'),
(20, 1, '2026000050', 'new', 1024, 'morning', 'kinder1', '2025-2026', 'enrolled', '2026-02-24 09:23:51', '2026-02-24 09:23:51'),
(21, 1, '2026000055', 'new', 1024, 'morning', 'kinder1', '2025-2026', 'enrolled', '2026-02-24 09:23:51', '2026-02-24 09:23:51'),
(22, 1, '2026000060', 'new', 1024, 'morning', 'kinder1', '2025-2026', 'enrolled', '2026-02-24 09:23:51', '2026-02-24 09:23:51'),
(23, 1, '2026000065', 'new', 1024, 'morning', 'kinder1', '2025-2026', 'enrolled', '2026-02-24 09:23:51', '2026-02-24 09:23:51'),
(24, 1, '2026000070', 'new', 1024, 'morning', 'kinder1', '2025-2026', 'enrolled', '2026-02-24 09:26:31', '2026-02-24 09:26:31'),
(25, 1, '2026000075', 'new', 1024, 'morning', 'kinder1', '2025-2026', 'enrolled', '2026-02-24 09:26:31', '2026-02-24 09:26:31'),
(26, 1, '2026000080', 'new', 1024, 'morning', 'kinder1', '2025-2026', 'enrolled', '2026-02-24 09:26:31', '2026-02-24 09:26:31'),
(27, 1, '2026000101', 'new', 1024, 'morning', 'kinder1', '2025-2026', 'enrolled', '2026-02-24 09:26:31', '2026-02-24 09:26:31'),
(28, 1, '2026000094', 'new', 1024, 'morning', 'kinder1', '2025-2026', 'enrolled', '2026-02-24 09:26:31', '2026-02-24 09:26:31'),
(29, 1, '2026000085', 'new', 1024, 'morning', 'kinder1', '2025-2026', 'enrolled', '2026-02-24 09:26:31', '2026-02-24 09:26:31'),
(30, 1, '2026000049', 'new', 1027, 'morning', 'grade1', '2025-2026', 'enrolled', '2026-02-24 09:28:46', '2026-02-24 09:28:46'),
(31, 1, '2026000066', 'new', 1025, 'morning', 'kinder2', '2025-2026', 'enrolled', '2026-02-24 09:29:52', '2026-02-24 09:29:52'),
(32, 1, '2026000071', 'new', 1025, 'morning', 'kinder2', '2025-2026', 'enrolled', '2026-02-24 09:29:52', '2026-02-24 09:29:52'),
(33, 1, '2026000076', 'new', 1025, 'morning', 'kinder2', '2025-2026', 'enrolled', '2026-02-24 09:29:52', '2026-02-24 09:29:52'),
(34, 1, '2026000081', 'new', 1025, 'morning', 'kinder2', '2025-2026', 'enrolled', '2026-02-24 09:29:52', '2026-02-24 09:29:52'),
(35, 1, '2026000042', 'new', 1027, 'whole day', 'grade1', '2025-2026', 'enrolled', '2026-02-25 01:22:27', '2026-02-25 01:22:27'),
(36, 1, '2026000086', 'new', 1025, 'morning', 'kinder2', '2026-2027', 'enrolled', '2026-03-02 04:54:59', '2026-03-02 04:54:59'),
(37, 1, '2026000097', 'new', 1025, 'morning', 'kinder2', '2026-2027', 'enrolled', '2026-03-02 04:54:59', '2026-03-02 04:54:59'),
(38, 1, '2026000098', 'new', 1025, 'morning', 'kinder2', '2026-2027', 'enrolled', '2026-03-02 04:54:59', '2026-03-02 04:54:59'),
(39, 1, '2026000106', 'new', 1025, 'morning', 'kinder2', '2026-2027', 'enrolled', '2026-03-02 04:54:59', '2026-03-02 04:54:59'),
(40, 1, '2026000103', 'new', 1025, 'morning', 'kinder2', '2026-2027', 'enrolled', '2026-03-02 04:54:59', '2026-03-02 04:54:59'),
(41, 1, '2026000111', 'new', 1025, 'morning', 'kinder2', '2026-2027', 'enrolled', '2026-03-02 04:54:59', '2026-03-02 04:54:59'),
(42, 1, '2026000116', 'new', 1025, 'morning', 'kinder2', '2026-2027', 'enrolled', '2026-03-02 04:54:59', '2026-03-02 04:54:59'),
(43, 1, '2026000128', 'new', 1025, 'morning', 'kinder2', '2026-2027', 'enrolled', '2026-03-02 04:54:59', '2026-03-02 04:54:59'),
(44, 1, '2026000129', 'new', 1025, 'morning', 'kinder2', '2026-2027', 'enrolled', '2026-03-02 04:54:59', '2026-03-02 04:54:59'),
(45, 1, '2026000044', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(46, 1, '2026000047', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(47, 1, '2026000052', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(48, 1, '2026000054', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(49, 1, '2026000057', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(50, 1, '2026000059', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(51, 1, '2026000062', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(52, 1, '2026000064', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(53, 1, '2026000067', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(54, 1, '2026000069', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(55, 1, '2026000072', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(56, 1, '2026000074', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(57, 1, '2026000077', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(58, 1, '2026000079', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(59, 1, '2026000082', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(60, 1, '2026000084', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(61, 1, '2026000087', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(62, 1, '2026000089', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(63, 1, '2026000090', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 05:04:58', '2026-03-02 05:04:58'),
(64, 1, '2026000091', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 05:04:58', '2026-03-02 05:04:58'),
(65, 1, '2026000092', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 05:04:58', '2026-03-02 05:04:58'),
(66, 1, '2026000096', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 05:04:58', '2026-03-02 05:04:58'),
(67, 1, '2026000102', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 05:04:58', '2026-03-02 05:04:58'),
(68, 1, '2026000105', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 05:04:58', '2026-03-02 05:04:58'),
(69, 1, '2026000107', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 05:04:59', '2026-03-02 05:04:59'),
(70, 1, '2026000112', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 05:04:59', '2026-03-02 05:04:59'),
(71, 1, '2026000114', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 05:04:59', '2026-03-02 05:04:59'),
(72, 1, '2026000117', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-02 05:04:59', '2026-03-02 05:04:59'),
(73, 1, '2026000119', 'new', 1027, 'morning', 'grade1', '2026-2027', 'enrolled', '2026-03-02 05:05:05', '2026-03-02 05:05:05'),
(74, 1, '2026000130', 'new', 1027, 'whole day', 'grade1', '2026-2027', 'enrolled', '2026-03-04 02:15:21', '2026-03-04 02:15:21'),
(75, 2, '20240001', 'new', NULL, 'morning', 'grade6', '2024-2025', 'enrolled', '2026-03-04 15:37:49', '2026-03-04 15:37:49'),
(76, 2, '20240002', 'new', NULL, 'morning', 'grade5', '2024-2025', 'enrolled', '2026-03-04 15:37:49', '2026-03-04 15:37:49'),
(601, 2, '20240101', 'new', NULL, 'morning', 'grade9', '2024-2025', 'enrolled', '2026-03-04 17:00:51', '2026-03-04 17:00:51'),
(602, 2, '20240102', 'new', NULL, 'morning', 'grade9', '2024-2025', 'enrolled', '2026-03-04 17:00:51', '2026-03-04 17:00:51'),
(603, 2, '20240103', 'new', NULL, 'morning', 'grade9', '2024-2025', 'enrolled', '2026-03-04 17:00:51', '2026-03-04 17:00:51'),
(604, 2, '20240104', 'new', NULL, 'morning', 'grade9', '2024-2025', 'enrolled', '2026-03-04 17:00:51', '2026-03-04 17:00:51'),
(605, 2, '20240105', 'new', NULL, 'morning', 'grade9', '2024-2025', 'enrolled', '2026-03-04 17:00:51', '2026-03-04 17:00:51'),
(606, 2, '20240106', 'new', NULL, 'morning', 'grade9', '2024-2025', 'enrolled', '2026-03-04 17:00:51', '2026-03-04 17:00:51'),
(701, 2, '20240201', 'new', NULL, 'morning', 'grade10', '2024-2025', 'enrolled', '2026-03-04 18:25:53', '2026-03-04 18:25:53'),
(702, 2, '20240202', 'new', NULL, 'morning', 'grade10', '2024-2025', 'enrolled', '2026-03-04 18:25:53', '2026-03-04 18:25:53'),
(703, 2, '20240203', 'new', NULL, 'morning', 'grade10', '2024-2025', 'enrolled', '2026-03-04 18:25:53', '2026-03-04 18:25:53');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_structures`
--

CREATE TABLE `fee_structures` (
  `id` int(11) NOT NULL,
  `academic_year_id` bigint(20) UNSIGNED DEFAULT NULL,
  `year_level` varchar(255) NOT NULL,
  `base_tuition` decimal(15,2) DEFAULT 0.00,
  `reg_fee` decimal(15,2) DEFAULT 0.00,
  `learning_materials` decimal(15,2) DEFAULT 0.00,
  `medical_dental` decimal(15,2) DEFAULT 0.00,
  `testing_materials` decimal(15,2) DEFAULT 0.00,
  `id_fee` decimal(15,2) DEFAULT 0.00,
  `insurance` decimal(15,2) DEFAULT 0.00,
  `av_computer` decimal(15,2) DEFAULT 0.00,
  `handbook` decimal(15,2) DEFAULT 0.00,
  `athletes` decimal(15,2) DEFAULT 0.00,
  `red_cross` decimal(15,2) DEFAULT 0.00,
  `energy_fee` decimal(15,2) DEFAULT 0.00,
  `membership_fees` decimal(15,2) DEFAULT 0.00,
  `prisap_umesa` decimal(15,2) DEFAULT 0.00,
  `hgp_modules` decimal(15,2) DEFAULT 0.00,
  `lab_fees` decimal(15,2) DEFAULT 0.00,
  `total_misc` decimal(15,2) DEFAULT 0.00,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fee_structures`
--

INSERT INTO `fee_structures` (`id`, `academic_year_id`, `year_level`, `base_tuition`, `reg_fee`, `learning_materials`, `medical_dental`, `testing_materials`, `id_fee`, `insurance`, `av_computer`, `handbook`, `athletes`, `red_cross`, `energy_fee`, `membership_fees`, `prisap_umesa`, `hgp_modules`, `lab_fees`, `total_misc`, `updated_at`, `created_at`) VALUES
(4, 1, 'kinder1', 7500.00, 599.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 4099.00, '2026-03-01 14:25:45', '2026-02-25 11:06:46'),
(5, 1, 'grade1', 12000.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 3750.00, '2026-03-01 14:25:45', '2026-02-25 11:09:16'),
(6, 1, 'kinder2', 10500.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 250.00, 3750.00, '2026-03-01 14:25:45', '2026-02-25 11:12:01'),
(7, 1, 'kinder3', 15000.00, 100.00, 100.00, 100.00, 100.00, 100.00, 100.00, 100.00, 100.00, 100.00, 100.00, 100.00, 100.00, 100.00, 100.00, 100.00, 1500.00, '2026-03-01 06:25:48', '2026-03-01 06:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `grading_components`
--

CREATE TABLE `grading_components` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `calculation_method` varchar(50) DEFAULT 'average',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grading_components`
--

INSERT INTO `grading_components` (`id`, `section_id`, `code`, `category`, `percentage`, `calculation_method`, `created_at`, `updated_at`) VALUES
(2, 1027, 'AT', 'Attendance', 10.00, 'average', '2026-02-24 07:44:08', '2026-02-24 07:44:08'),
(3, 1025, 'AT', 'Attendance', 10.00, 'average', '2026-02-24 09:54:23', '2026-02-24 09:54:23'),
(4, 1025, 'PE', 'Periodic Exam', 30.00, 'average', '2026-02-24 10:35:58', '2026-02-24 10:35:58'),
(8, 1025, 'AC', 'Activity', 60.00, 'average', '2026-02-24 11:50:25', '2026-02-24 11:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `grading_items`
--

CREATE TABLE `grading_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `component_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `max_score` int(11) NOT NULL,
  `date_administered` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grading_items`
--

INSERT INTO `grading_items` (`id`, `component_id`, `section_id`, `item_name`, `max_score`, `date_administered`, `created_at`, `updated_at`) VALUES
(2, 2, 1027, 'Attendance', 10, NULL, '2026-02-24 09:54:04', '2026-02-24 09:54:04'),
(3, 3, 1025, 'Attendance', 10, NULL, '2026-02-24 09:54:29', '2026-02-24 09:54:29'),
(4, 4, 1025, 'Periodic Exam', 50, NULL, '2026-02-24 10:36:10', '2026-02-24 10:36:10'),
(7, 8, 1025, 'Activity 1', 5, NULL, '2026-02-24 12:03:57', '2026-02-24 12:03:57');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('draft','ready','completed') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `title`, `subject`, `date`, `description`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Introduction to Arts', 'English', '2026-02-04', NULL, 'completed', '2026-02-10 08:21:19', '2026-02-18 07:42:42'),
(4, 'Makeup', 'Mathematics', '2026-02-13', 'makeup tutorial', 'draft', '2026-02-11 22:20:06', '2026-02-18 07:42:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_11_150748_add_role_to_users_table', 1),
(5, '2026_01_11_184839_create_classrooms_table', 1),
(6, '2026_01_11_184859_create_grades_table', 1),
(7, '2026_01_16_063816_create_admissions_table', 2),
(8, '2026_02_02_141720_create_students_table', 3),
(9, '2026_02_02_141856_create_documents_table', 4),
(10, '2026_02_02_155909_add_status_to_documents_table', 5),
(11, '2026_02_02_164015_add_student_fields_to_users_table', 6),
(12, '2026_02_03_124930_add_title_to_documents_table', 7),
(13, '2026_02_03_125214_add_file_name_to_documents_table', 8),
(14, '2026_02_03_131839_add_is_approved_to_users_table', 9),
(15, '2026_02_04_110949_create_schedules_table', 10),
(16, '2026_02_04_191601_change_year_level_to_string_in_tables', 11),
(17, '2026_02_03_070827_create_tuitions_table', 12),
(18, '2026_02_04_195447_add_registrar_role_to_users_table', 13),
(19, '2026_02_04_200927_add_payment_type_to_tuitions_table', 14),
(20, '2026_01_17_140921_create_payments_table', 15),
(21, '2026_02_04_202628_rename_student_number_column_in_payments_table', 16),
(22, '2026_02_04_202902_rename_student_name_column_in_tuitions_table', 17),
(23, '2026_02_04_203453_rename_student_number_column_in_tuitions_table', 18),
(24, '2026_02_05_082602_rename_approval_status_in_tuitions_table', 19),
(25, '2026_02_05_083541_rename_file_path_to_payment_proof_in_tuitions_table', 20),
(26, '2026_02_09_101524_create_enrollments_table', 21),
(27, '2026_02_09_125548_change_year_level_to_string_in_enrollments_table', 22),
(28, '2026_02_09_152857_create_lessons_table', 23),
(29, '2026_02_23_062117_create_grading_items', 24),
(30, '2026_02_23_062126_create_students_grades', 25);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('sev.s@email.com', '$2y$12$BPvXk02oYNapMjGCISHdROwpDwaH3GbIc9qNIWhfja/hYIMBetX32', '2026-03-04 02:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enrollment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tuition_id` bigint(20) UNSIGNED NOT NULL,
  `academic_year_id` bigint(20) UNSIGNED DEFAULT NULL,
  `origin` varchar(20) DEFAULT 'student',
  `studentNumber` varchar(255) NOT NULL,
  `reference_number` varchar(255) NOT NULL DEFAULT 'N/A',
  `payment_method` varchar(255) NOT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL DEFAULT 'N/A',
  `amount` decimal(10,2) NOT NULL,
  `receipt_path` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `approval_status` varchar(50) DEFAULT 'pending',
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `enrollment_id`, `tuition_id`, `academic_year_id`, `origin`, `studentNumber`, `reference_number`, `payment_method`, `payment_proof`, `description`, `amount`, `receipt_path`, `status`, `approval_status`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 16, 36, 1, 'student', '2026000056', 'REF-1772051208-k9m7w', 'Bank Transfer', NULL, 'N/A', 10500.00, 'receipts/2026000056_1772051208.dat', 'completed', 'approved', NULL, '2026-02-25 12:26:48', '2026-03-01 00:20:37'),
(2, 33, 40, 1, 'student', '2026000076', 'REF-1772052254-JHr1l', 'gcash', NULL, 'N/A', 14250.00, 'receipts/2026000076_1772052254.dat', 'completed', 'approved', NULL, '2026-02-25 12:44:14', '2026-02-25 12:44:14'),
(6, 13, 17, 1, 'cashier', '2026000026', 'WALK-IN-ND7PTGBN', 'cash', NULL, 'N/A', 4250.00, 'CASH_PAYMENT', 'completed', 'approved', 'Walk-in payment processed by cashier.', '2026-03-01 00:53:20', '2026-03-01 00:53:20'),
(8, 34, 41, 1, 'cashier', '2026000081', 'WALK-IN-4AUO9HJ7', 'cash', NULL, 'N/A', 4250.00, 'CASH_PAYMENT', 'completed', 'approved', NULL, '2026-03-02 01:47:21', '2026-03-02 01:47:21'),
(14, 58, 77, NULL, 'student', '2026000079', 'REF-RO04D4P8', 'cash', NULL, 'N/A', 5750.00, 'receipts/placeholder.pdf', 'completed', 'approved', NULL, '2026-03-02 05:07:03', '2026-03-02 05:07:03'),
(15, 49, 68, NULL, 'cashier', '2026000057', 'REF-GM8AFAL1', 'cash', NULL, 'N/A', 5750.00, 'receipts/placeholder.pdf', 'completed', 'approved', NULL, '2026-03-02 05:31:15', '2026-03-02 05:31:15'),
(16, 49, 68, NULL, 'cashier', '2026000057', 'REF-12345678', 'gcash', NULL, 'N/A', 10000.00, 'receipts/1772458943_images.png', 'completed', 'approved', NULL, '2026-03-02 05:42:23', '2026-03-02 05:42:23'),
(17, 50, 69, NULL, 'cashier', '2026000059', 'REF-56464564', 'gcash', NULL, 'N/A', 15750.00, 'receipts/1772459231_VwDu4RouWn.dat', 'completed', 'approved', NULL, '2026-03-02 05:47:11', '2026-03-02 05:47:11'),
(18, NULL, 59, NULL, 'student', '2026000103', 'REF-3948394', 'GCash', NULL, 'N/A', 4250.00, '1772523580_images.png', 'rejected', 'rejected', 'not encrypted', '2026-03-02 23:39:40', '2026-03-02 23:50:33'),
(19, NULL, 59, NULL, 'student', '2026000103', 'REF-984504', 'GCash', NULL, 'N/A', 4250.00, '1772524263_w1kxn5lD3l.dat', 'completed', 'approved', NULL, '2026-03-02 23:51:03', '2026-03-03 00:36:38'),
(20, NULL, 59, NULL, 'student', '2026000103', 'REF-49058490', 'GCash', NULL, 'N/A', 10000.00, '1772524453_VA6DaC6BIY.dat', 'pending', 'pending', NULL, '2026-03-02 23:54:13', '2026-03-02 23:54:13'),
(21, NULL, 59, NULL, 'student', '2026000103', 'REF-47398743', 'GCash', NULL, 'N/A', 10000.00, '1772526394_tmf0CdWmEm.dat', 'completed', 'approved', NULL, '2026-03-03 00:26:34', '2026-03-03 00:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `teacher` varchar(255) NOT NULL,
  `day_of_week` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room` varchar(255) NOT NULL,
  `year_level` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `subject`, `teacher`, `day_of_week`, `start_time`, `end_time`, `room`, `year_level`, `section`, `created_at`, `updated_at`, `section_id`) VALUES
(2101, 'English', 'Alice Thompson', 'Monday', '08:00:00', '09:00:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2102, 'Math', 'Benjamin Clark', 'Monday', '09:00:00', '10:00:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2103, 'Science', 'Catherine Reyes', 'Monday', '10:30:00', '11:30:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2104, 'Filipino', 'David Wilson', 'Monday', '11:30:00', '12:30:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2105, 'MAPEH', 'Elena Rodriguez', 'Monday', '13:30:00', '14:30:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2106, 'Araling Panlipunan', 'Franklin Moore', 'Tuesday', '08:00:00', '09:00:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2107, 'Values Ed', 'Grace Santos', 'Tuesday', '09:00:00', '10:00:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2108, 'English', 'Henry Taylor', 'Tuesday', '10:30:00', '11:30:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2109, 'Math', 'Isabella Garcia', 'Tuesday', '11:30:00', '12:30:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2110, 'Computer', 'Jonathan Lee', 'Tuesday', '13:30:00', '14:30:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2111, 'Science', 'Karen Bautista', 'Wednesday', '08:00:00', '09:00:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2112, 'Filipino', 'Leonardo Cruz', 'Wednesday', '09:00:00', '10:00:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2113, 'MAPEH', 'Maria Villareal', 'Wednesday', '10:30:00', '11:30:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2114, 'English', 'Alice Thompson', 'Wednesday', '11:30:00', '12:30:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2115, 'Math', 'Benjamin Clark', 'Wednesday', '13:30:00', '14:30:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2116, 'Araling Panlipunan', 'Catherine Reyes', 'Thursday', '08:00:00', '09:00:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2117, 'Values Ed', 'David Wilson', 'Thursday', '09:00:00', '10:00:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2118, 'Science', 'Elena Rodriguez', 'Thursday', '10:30:00', '11:30:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2119, 'Filipino', 'Franklin Moore', 'Thursday', '11:30:00', '12:30:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2120, 'MAPEH', 'Grace Santos', 'Thursday', '13:30:00', '14:30:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2121, 'English', 'Henry Taylor', 'Friday', '08:00:00', '09:00:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2122, 'Math', 'Isabella Garcia', 'Friday', '09:00:00', '10:00:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2123, 'Science', 'Jonathan Lee', 'Friday', '10:30:00', '11:30:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2124, 'Homeroom', 'Karen Bautista', 'Friday', '11:30:00', '12:30:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(2125, 'Club Activity', 'Leonardo Cruz', 'Friday', '13:30:00', '14:30:00', 'Rm 101', 'grade1', 'Rizal', '2026-02-24 13:48:15', '2026-02-24 13:48:15', 1027),
(11101, 'Circle Time', 'Alice Thompson', 'Monday', '09:00:00', '10:00:00', 'Room K1', 'kinder1', 'Hope', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1024),
(11102, 'Numeracy', 'Benjamin Clark', 'Tuesday', '09:00:00', '10:00:00', 'Room K1', 'kinder1', 'Hope', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1024),
(11103, 'Storytelling', 'Catherine Reyes', 'Wednesday', '09:00:00', '10:00:00', 'Room K1', 'kinder1', 'Hope', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1024),
(11104, 'Creative Arts', 'David Wilson', 'Thursday', '09:00:00', '10:00:00', 'Room K1', 'kinder1', 'Hope', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1024),
(11105, 'Values Education', 'Elena Rodriguez', 'Friday', '09:00:00', '10:00:00', 'Room K1', 'kinder1', 'Hope', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1024),
(11106, 'Free Play', 'Franklin Moore', 'Monday', '10:30:00', '12:00:00', 'Room K1', 'kinder1', 'Hope', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1024),
(11107, 'Music', 'Grace Santos', 'Tuesday', '10:30:00', '12:00:00', 'Room K1', 'kinder1', 'Hope', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1024),
(11108, 'Sensory Play', 'Henry Taylor', 'Wednesday', '10:30:00', '12:00:00', 'Room K1', 'kinder1', 'Hope', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1024),
(11109, 'Outdoor Play', 'Isabella Garcia', 'Thursday', '10:30:00', '12:00:00', 'Playground', 'kinder1', 'Hope', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1024),
(11110, 'Weekly Review', 'Jonathan Lee', 'Friday', '10:30:00', '12:00:00', 'Room K1', 'kinder1', 'Hope', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1024),
(12101, 'Reading', 'Karen Bautista', 'Monday', '09:00:00', '10:30:00', 'Room K2', 'kinder2', 'Torch', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1025),
(12102, 'Science', 'Leonardo Cruz', 'Tuesday', '09:00:00', '10:30:00', 'Room K2', 'kinder2', 'Torch', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1025),
(12103, 'Math', 'Maria Villareal', 'Wednesday', '09:00:00', '10:30:00', 'Room K2', 'kinder2', 'Torch', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1025),
(12104, 'Writing', 'Alice Thompson', 'Thursday', '09:00:00', '10:30:00', 'Room K2', 'kinder2', 'Torch', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1025),
(12105, 'Social Skills', 'Benjamin Clark', 'Friday', '09:00:00', '10:30:00', 'Room K2', 'kinder2', 'Torch', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1025),
(12106, 'Art', 'Catherine Reyes', 'Monday', '11:00:00', '12:00:00', 'Room K2', 'kinder2', 'Torch', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1025),
(12107, 'P.E.', 'David Wilson', 'Tuesday', '11:00:00', '12:00:00', 'Gym', 'kinder2', 'Torch', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1025),
(12108, 'Phonics', 'Elena Rodriguez', 'Wednesday', '11:00:00', '12:00:00', 'Room K2', 'kinder2', 'Torch', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1025),
(12109, 'Drama', 'Franklin Moore', 'Thursday', '11:00:00', '12:00:00', 'Room K2', 'kinder2', 'Torch', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1025),
(12110, 'Character', 'Grace Santos', 'Friday', '11:00:00', '12:00:00', 'Room K2', 'kinder2', 'Torch', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1025),
(13101, 'English', 'Henry Taylor', 'Monday', '09:00:00', '10:30:00', 'Room K3', 'kinder3', 'Essence', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1026),
(13102, 'Mathematics', 'Isabella Garcia', 'Tuesday', '09:00:00', '10:30:00', 'Room K3', 'kinder3', 'Essence', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1026),
(13103, 'Science', 'Jonathan Lee', 'Wednesday', '09:00:00', '10:30:00', 'Room K3', 'kinder3', 'Essence', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1026),
(13104, 'Computer', 'Karen Bautista', 'Thursday', '09:00:00', '10:30:00', 'Lab 1', 'kinder3', 'Essence', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1026),
(13105, 'Filipino', 'Leonardo Cruz', 'Friday', '09:00:00', '10:30:00', 'Room K3', 'kinder3', 'Essence', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1026),
(13106, 'Civics', 'Maria Villareal', 'Monday', '11:00:00', '12:00:00', 'Room K3', 'kinder3', 'Essence', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1026),
(13107, 'Reading', 'Alice Thompson', 'Tuesday', '11:00:00', '12:00:00', 'Room K3', 'kinder3', 'Essence', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1026),
(13108, 'Health', 'Benjamin Clark', 'Wednesday', '11:00:00', '12:00:00', 'Room K3', 'kinder3', 'Essence', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1026),
(13109, 'Poetry', 'Catherine Reyes', 'Thursday', '11:00:00', '12:00:00', 'Room K3', 'kinder3', 'Essence', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1026),
(13110, 'Homeroom', 'David Wilson', 'Friday', '11:00:00', '12:00:00', 'Room K3', 'kinder3', 'Essence', '2026-02-24 13:44:09', '2026-02-24 13:44:09', 1026),
(22001, 'English', 'Alice Thompson', 'Monday', '08:00:00', '09:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22002, 'Mathematics', 'Benjamin Clark', 'Monday', '09:00:00', '10:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22003, 'Science', 'Catherine Reyes', 'Monday', '10:30:00', '11:30:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22004, 'Filipino', 'David Wilson', 'Monday', '13:00:00', '14:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22005, 'MAPEH', 'Elena Rodriguez', 'Monday', '14:00:00', '15:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22006, 'Araling Panlipunan', 'Franklin Moore', 'Tuesday', '08:00:00', '09:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22007, 'ESP', 'Grace Santos', 'Tuesday', '09:00:00', '10:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22008, 'English', 'Henry Taylor', 'Tuesday', '10:30:00', '11:30:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22009, 'Mathematics', 'Isabella Garcia', 'Tuesday', '13:00:00', '14:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22010, 'Computer', 'Jonathan Lee', 'Tuesday', '14:00:00', '15:00:00', 'Computer Lab', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22011, 'Science', 'Karen Bautista', 'Wednesday', '08:00:00', '09:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22012, 'Filipino', 'Leonardo Cruz', 'Wednesday', '09:00:00', '10:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22013, 'MAPEH', 'Maria Villareal', 'Wednesday', '10:30:00', '11:30:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22014, 'Araling Panlipunan', 'Alice Thompson', 'Wednesday', '13:00:00', '14:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22015, 'English', 'Benjamin Clark', 'Wednesday', '14:00:00', '15:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22016, 'Mathematics', 'Catherine Reyes', 'Thursday', '08:00:00', '09:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22017, 'Science', 'David Wilson', 'Thursday', '09:00:00', '10:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22018, 'ESP', 'Elena Rodriguez', 'Thursday', '10:30:00', '11:30:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22019, 'Filipino', 'Franklin Moore', 'Thursday', '13:00:00', '14:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22020, 'MAPEH', 'Grace Santos', 'Thursday', '14:00:00', '15:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22021, 'English', 'Henry Taylor', 'Friday', '08:00:00', '09:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22022, 'Mathematics', 'Isabella Garcia', 'Friday', '09:00:00', '10:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22023, 'Science', 'Jonathan Lee', 'Friday', '10:30:00', '11:30:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22024, 'Homeroom', 'Karen Bautista', 'Friday', '13:00:00', '14:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(22025, 'Club Activity', 'Leonardo Cruz', 'Friday', '14:00:00', '15:00:00', 'Room 202', 'grade2', 'Bonifacio', '2026-02-24 13:49:29', '2026-02-24 13:49:29', 1028),
(23001, 'English', 'Maria Villareal', 'Monday', '08:00:00', '09:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23002, 'Mathematics', 'Alice Thompson', 'Monday', '09:00:00', '10:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23003, 'Science', 'Benjamin Clark', 'Monday', '10:30:00', '11:30:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23004, 'Filipino', 'Catherine Reyes', 'Monday', '13:00:00', '14:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23005, 'MAPEH', 'David Wilson', 'Monday', '14:00:00', '15:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23006, 'Araling Panlipunan', 'Elena Rodriguez', 'Tuesday', '08:00:00', '09:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23007, 'ESP', 'Franklin Moore', 'Tuesday', '09:00:00', '10:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23008, 'English', 'Grace Santos', 'Tuesday', '10:30:00', '11:30:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23009, 'Mathematics', 'Henry Taylor', 'Tuesday', '13:00:00', '14:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23010, 'Computer', 'Isabella Garcia', 'Tuesday', '14:00:00', '15:00:00', 'Computer Lab', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23011, 'Science', 'Jonathan Lee', 'Wednesday', '08:00:00', '09:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23012, 'Filipino', 'Karen Bautista', 'Wednesday', '09:00:00', '10:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23013, 'MAPEH', 'Leonardo Cruz', 'Wednesday', '10:30:00', '11:30:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23014, 'Araling Panlipunan', 'Maria Villareal', 'Wednesday', '13:00:00', '14:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23015, 'English', 'Alice Thompson', 'Wednesday', '14:00:00', '15:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23016, 'Mathematics', 'Benjamin Clark', 'Thursday', '08:00:00', '09:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23017, 'Science', 'Catherine Reyes', 'Thursday', '09:00:00', '10:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23018, 'ESP', 'David Wilson', 'Thursday', '10:30:00', '11:30:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23019, 'Filipino', 'Elena Rodriguez', 'Thursday', '13:00:00', '14:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23020, 'MAPEH', 'Franklin Moore', 'Thursday', '14:00:00', '15:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23021, 'English', 'Grace Santos', 'Friday', '08:00:00', '09:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23022, 'Mathematics', 'Henry Taylor', 'Friday', '09:00:00', '10:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23023, 'Science', 'Isabella Garcia', 'Friday', '10:30:00', '11:30:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23024, 'Homeroom', 'Jonathan Lee', 'Friday', '13:00:00', '14:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(23025, 'Club Activity', 'Karen Bautista', 'Friday', '14:00:00', '15:00:00', 'Room 303', 'grade3', 'Mabini', '2026-02-24 13:50:03', '2026-02-24 13:50:03', 1029),
(24001, 'English', 'Leonardo Cruz', 'Monday', '08:00:00', '09:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24002, 'Mathematics', 'Maria Villareal', 'Monday', '09:00:00', '10:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24003, 'Science', 'Alice Thompson', 'Monday', '10:30:00', '11:30:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24004, 'EPP (HE)', 'Benjamin Clark', 'Monday', '13:00:00', '14:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24005, 'MAPEH', 'Catherine Reyes', 'Monday', '14:00:00', '15:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24006, 'Araling Panlipunan', 'David Wilson', 'Tuesday', '08:00:00', '09:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24007, 'ESP', 'Elena Rodriguez', 'Tuesday', '09:00:00', '10:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24008, 'English', 'Franklin Moore', 'Tuesday', '10:30:00', '11:30:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24009, 'Mathematics', 'Grace Santos', 'Tuesday', '13:00:00', '14:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24010, 'Computer/ICT', 'Henry Taylor', 'Tuesday', '14:00:00', '15:00:00', 'Computer Lab', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24011, 'Science', 'Isabella Garcia', 'Wednesday', '08:00:00', '09:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24012, 'Filipino', 'Jonathan Lee', 'Wednesday', '09:00:00', '10:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24013, 'MAPEH', 'Karen Bautista', 'Wednesday', '10:30:00', '11:30:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24014, 'Araling Panlipunan', 'Leonardo Cruz', 'Wednesday', '13:00:00', '14:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24015, 'English', 'Maria Villareal', 'Wednesday', '14:00:00', '15:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24016, 'Mathematics', 'Alice Thompson', 'Thursday', '08:00:00', '09:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24017, 'Science', 'Benjamin Clark', 'Thursday', '09:00:00', '10:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24018, 'ESP', 'Catherine Reyes', 'Thursday', '10:30:00', '11:30:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24019, 'Filipino', 'David Wilson', 'Thursday', '13:00:00', '14:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24020, 'EPP (Agri)', 'Elena Rodriguez', 'Thursday', '14:00:00', '15:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24021, 'English', 'Franklin Moore', 'Friday', '08:00:00', '09:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24022, 'Mathematics', 'Grace Santos', 'Friday', '09:00:00', '10:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24023, 'Science', 'Henry Taylor', 'Friday', '10:30:00', '11:30:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24024, 'Homeroom', 'Isabella Garcia', 'Friday', '13:00:00', '14:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(24025, 'MAPEH (Health)', 'Jonathan Lee', 'Friday', '14:00:00', '15:00:00', 'Room 401', 'grade4', 'Del Pilar', '2026-02-24 13:50:13', '2026-02-24 13:50:13', 1030),
(25001, 'English', 'Karen Bautista', 'Monday', '08:00:00', '09:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25002, 'Mathematics', 'Leonardo Cruz', 'Monday', '09:00:00', '10:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25003, 'Science', 'Maria Villareal', 'Monday', '10:30:00', '11:30:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25004, 'EPP (ICT)', 'Alice Thompson', 'Monday', '13:00:00', '14:00:00', 'Computer Lab', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25005, 'MAPEH', 'Benjamin Clark', 'Monday', '14:00:00', '15:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25006, 'Araling Panlipunan', 'Catherine Reyes', 'Tuesday', '08:00:00', '09:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25007, 'ESP', 'David Wilson', 'Tuesday', '09:00:00', '10:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25008, 'English', 'Elena Rodriguez', 'Tuesday', '10:30:00', '11:30:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25009, 'Mathematics', 'Franklin Moore', 'Tuesday', '13:00:00', '14:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25010, 'Filipino', 'Grace Santos', 'Tuesday', '14:00:00', '15:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25011, 'Science', 'Henry Taylor', 'Wednesday', '08:00:00', '09:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25012, 'Filipino', 'Isabella Garcia', 'Wednesday', '09:00:00', '10:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25013, 'MAPEH', 'Jonathan Lee', 'Wednesday', '10:30:00', '11:30:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25014, 'Araling Panlipunan', 'Karen Bautista', 'Wednesday', '13:00:00', '14:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25015, 'English', 'Leonardo Cruz', 'Wednesday', '14:00:00', '15:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25016, 'Mathematics', 'Maria Villareal', 'Thursday', '08:00:00', '09:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25017, 'Science', 'Alice Thompson', 'Thursday', '09:00:00', '10:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25018, 'ESP', 'Benjamin Clark', 'Thursday', '10:30:00', '11:30:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25019, 'Filipino', 'Catherine Reyes', 'Thursday', '13:00:00', '14:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25020, 'EPP (IA)', 'David Wilson', 'Thursday', '14:00:00', '15:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25021, 'English', 'Elena Rodriguez', 'Friday', '08:00:00', '09:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25022, 'Mathematics', 'Franklin Moore', 'Friday', '09:00:00', '10:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25023, 'Science', 'Grace Santos', 'Friday', '10:30:00', '11:30:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25024, 'Homeroom', 'Henry Taylor', 'Friday', '13:00:00', '14:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(25025, 'MAPEH (Health)', 'Isabella Garcia', 'Friday', '14:00:00', '15:00:00', 'Room 502', 'grade5', 'Silang', '2026-02-24 13:50:36', '2026-02-24 13:50:36', 1031),
(26001, 'English', 'Jonathan Lee', 'Monday', '08:00:00', '09:00:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26002, 'Mathematics', 'Karen Bautista', 'Monday', '09:00:00', '10:00:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26003, 'Science', 'Leonardo Cruz', 'Monday', '10:30:00', '11:30:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26004, 'EPP (Agriculture)', 'Maria Villareal', 'Monday', '13:00:00', '14:00:00', 'Garden Area', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26005, 'MAPEH', 'Alice Thompson', 'Monday', '14:00:00', '15:00:00', 'Gym', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26006, 'Araling Panlipunan', 'Benjamin Clark', 'Tuesday', '08:00:00', '09:00:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26007, 'ESP', 'Catherine Reyes', 'Tuesday', '09:00:00', '10:00:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26008, 'English', 'David Wilson', 'Tuesday', '10:30:00', '11:30:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26009, 'Mathematics', 'Elena Rodriguez', 'Tuesday', '13:00:00', '14:00:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26010, 'Filipino', 'Franklin Moore', 'Tuesday', '14:00:00', '15:00:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26011, 'Science', 'Grace Santos', 'Wednesday', '08:00:00', '09:00:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26012, 'Filipino', 'Henry Taylor', 'Wednesday', '09:00:00', '10:00:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26013, 'MAPEH', 'Isabella Garcia', 'Wednesday', '10:30:00', '11:30:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26014, 'Araling Panlipunan', 'Jonathan Lee', 'Wednesday', '13:00:00', '14:00:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26015, 'English', 'Karen Bautista', 'Wednesday', '14:00:00', '15:00:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26016, 'Mathematics', 'Leonardo Cruz', 'Thursday', '08:00:00', '09:00:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26017, 'Science', 'Maria Villareal', 'Thursday', '09:00:00', '10:00:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26018, 'ESP', 'Alice Thompson', 'Thursday', '10:30:00', '11:30:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26019, 'Filipino', 'Benjamin Clark', 'Thursday', '13:00:00', '14:00:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26020, 'EPP (HE)', 'Catherine Reyes', 'Thursday', '14:00:00', '15:00:00', 'HE Room', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26021, 'English', 'David Wilson', 'Friday', '08:00:00', '09:00:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26022, 'Mathematics', 'Elena Rodriguez', 'Friday', '09:00:00', '10:00:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26023, 'Science', 'Franklin Moore', 'Friday', '10:30:00', '11:30:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26024, 'Homeroom', 'Grace Santos', 'Friday', '13:00:00', '14:00:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(26025, 'MAPEH (Health)', 'Henry Taylor', 'Friday', '14:00:00', '15:00:00', 'Room 601', 'grade6', 'Luna', '2026-02-24 13:51:13', '2026-02-24 13:51:13', 1032),
(27001, 'English (Literature)', 'Isabella Garcia', 'Monday', '07:30:00', '08:30:00', 'Room 7-W', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27002, 'Mathematics (Algebra)', 'Jonathan Lee', 'Monday', '08:30:00', '09:30:00', 'Room 7-W', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27003, 'Integrated Science', 'Karen Bautista', 'Monday', '10:00:00', '11:00:00', 'Science Lab 1', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27004, 'Filipino', 'Leonardo Cruz', 'Monday', '11:00:00', '12:00:00', 'Room 7-W', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27005, 'TLE (Cookery)', 'Maria Villareal', 'Monday', '13:00:00', '14:30:00', 'TLE Lab', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27006, 'Araling Panlipunan', 'Alice Thompson', 'Tuesday', '07:30:00', '08:30:00', 'Room 7-W', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27007, 'EsP', 'Benjamin Clark', 'Tuesday', '08:30:00', '09:30:00', 'Room 7-W', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27008, 'English (Grammar)', 'Catherine Reyes', 'Tuesday', '10:00:00', '11:00:00', 'Room 7-W', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27009, 'Mathematics (Algebra)', 'David Wilson', 'Tuesday', '11:00:00', '12:00:00', 'Room 7-W', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27010, 'MAPEH (Music)', 'Elena Rodriguez', 'Tuesday', '13:00:00', '14:00:00', 'Music Room', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27011, 'Integrated Science', 'Franklin Moore', 'Wednesday', '07:30:00', '09:00:00', 'Science Lab 1', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27012, 'Filipino', 'Grace Santos', 'Wednesday', '09:00:00', '10:00:00', 'Room 7-W', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27013, 'MAPEH (Arts)', 'Henry Taylor', 'Wednesday', '10:30:00', '11:30:00', 'Room 7-W', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27014, 'Araling Panlipunan', 'Isabella Garcia', 'Wednesday', '13:00:00', '14:00:00', 'Room 7-W', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27015, 'English (Literature)', 'Jonathan Lee', 'Wednesday', '14:00:00', '15:00:00', 'Room 7-W', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27016, 'Mathematics (Algebra)', 'Karen Bautista', 'Thursday', '07:30:00', '08:30:00', 'Room 7-W', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27017, 'Integrated Science', 'Leonardo Cruz', 'Thursday', '08:30:00', '09:30:00', 'Science Lab 1', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27018, 'EsP', 'Maria Villareal', 'Thursday', '10:00:00', '11:00:00', 'Room 7-W', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27019, 'Filipino', 'Alice Thompson', 'Thursday', '11:00:00', '12:00:00', 'Room 7-W', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27020, 'TLE (ICT)', 'Benjamin Clark', 'Thursday', '13:00:00', '14:30:00', 'Computer Lab', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27021, 'English (Grammar)', 'Catherine Reyes', 'Friday', '07:30:00', '08:30:00', 'Room 7-W', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27022, 'Mathematics (Algebra)', 'David Wilson', 'Friday', '08:30:00', '09:30:00', 'Room 7-W', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27023, 'Integrated Science', 'Elena Rodriguez', 'Friday', '10:00:00', '11:30:00', 'Science Lab 1', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27024, 'Homeroom', 'Franklin Moore', 'Friday', '13:00:00', '14:00:00', 'Room 7-W', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(27025, 'MAPEH (P.E.)', 'Grace Santos', 'Friday', '14:00:00', '15:30:00', 'Court', 'grade7', 'Wisdom', '2026-02-24 13:51:52', '2026-02-24 13:51:52', 1033),
(28001, 'English (Afro-Asian)', 'Henry Taylor', 'Monday', '07:30:00', '08:30:00', 'Room 8-S', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28002, 'Mathematics (Geometry)', 'Isabella Garcia', 'Monday', '08:30:00', '09:30:00', 'Room 8-S', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28003, 'Science (Biology)', 'Jonathan Lee', 'Monday', '10:00:00', '11:00:00', 'Science Lab 2', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28004, 'Filipino', 'Karen Bautista', 'Monday', '11:00:00', '12:00:00', 'Room 8-S', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28005, 'TLE (Dressmaking)', 'Leonardo Cruz', 'Monday', '13:00:00', '14:30:00', 'TLE Lab', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28006, 'Araling Panlipunan', 'Maria Villareal', 'Tuesday', '07:30:00', '08:30:00', 'Room 8-S', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28007, 'EsP', 'Alice Thompson', 'Tuesday', '08:30:00', '09:30:00', 'Room 8-S', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28008, 'English (Grammar)', 'Benjamin Clark', 'Tuesday', '10:00:00', '11:00:00', 'Room 8-S', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28009, 'Mathematics (Geometry)', 'Catherine Reyes', 'Tuesday', '11:00:00', '12:00:00', 'Room 8-S', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28010, 'MAPEH (Music)', 'David Wilson', 'Tuesday', '13:00:00', '14:00:00', 'Music Room', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28011, 'Science (Biology)', 'Elena Rodriguez', 'Wednesday', '07:30:00', '09:00:00', 'Science Lab 2', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28012, 'Filipino', 'Franklin Moore', 'Wednesday', '09:00:00', '10:00:00', 'Room 8-S', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28013, 'MAPEH (Arts)', 'Grace Santos', 'Wednesday', '10:30:00', '11:30:00', 'Room 8-S', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28014, 'Araling Panlipunan', 'Henry Taylor', 'Wednesday', '13:00:00', '14:00:00', 'Room 8-S', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28015, 'English (Afro-Asian)', 'Isabella Garcia', 'Wednesday', '14:00:00', '15:00:00', 'Room 8-S', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28016, 'Mathematics (Geometry)', 'Jonathan Lee', 'Thursday', '07:30:00', '08:30:00', 'Room 8-S', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28017, 'Science (Biology)', 'Karen Bautista', 'Thursday', '08:30:00', '09:30:00', 'Science Lab 2', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28018, 'EsP', 'Leonardo Cruz', 'Thursday', '10:00:00', '11:00:00', 'Room 8-S', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28019, 'Filipino', 'Maria Villareal', 'Thursday', '11:00:00', '12:00:00', 'Room 8-S', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28020, 'TLE (ICT)', 'Alice Thompson', 'Thursday', '13:00:00', '14:30:00', 'Computer Lab', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28021, 'English (Grammar)', 'Benjamin Clark', 'Friday', '07:30:00', '08:30:00', 'Room 8-S', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28022, 'Mathematics (Geometry)', 'Catherine Reyes', 'Friday', '08:30:00', '09:30:00', 'Room 8-S', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28023, 'Science (Biology)', 'David Wilson', 'Friday', '10:00:00', '11:30:00', 'Science Lab 2', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28024, 'Homeroom', 'Elena Rodriguez', 'Friday', '13:00:00', '14:00:00', 'Room 8-S', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(28025, 'MAPEH (P.E.)', 'Franklin Moore', 'Friday', '14:00:00', '15:30:00', 'Court', 'grade8', 'Solidarity', '2026-02-24 13:52:21', '2026-02-24 13:52:21', 1034),
(29001, 'English (Anglo-American)', 'Grace Santos', 'Monday', '07:30:00', '08:30:00', 'Room 9-H', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29002, 'Mathematics (Trigonometry)', 'Henry Taylor', 'Monday', '08:30:00', '09:30:00', 'Room 9-H', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29003, 'Science (Chemistry)', 'Isabella Garcia', 'Monday', '10:00:00', '11:00:00', 'Science Lab 3', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29004, 'Filipino', 'Jonathan Lee', 'Monday', '11:00:00', '12:00:00', 'Room 9-H', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29005, 'TLE (Drafting)', 'Karen Bautista', 'Monday', '13:00:00', '14:30:00', 'TLE Lab', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29006, 'Araling Panlipunan', 'Leonardo Cruz', 'Tuesday', '07:30:00', '08:30:00', 'Room 9-H', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29007, 'EsP', 'Maria Villareal', 'Tuesday', '08:30:00', '09:30:00', 'Room 9-H', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29008, 'English (Grammar)', 'Alice Thompson', 'Tuesday', '10:00:00', '11:00:00', 'Room 9-H', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29009, 'Mathematics (Trigonometry)', 'Benjamin Clark', 'Tuesday', '11:00:00', '12:00:00', 'Room 9-H', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29010, 'MAPEH (Music)', 'Catherine Reyes', 'Tuesday', '13:00:00', '14:00:00', 'Music Room', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29011, 'Science (Chemistry)', 'David Wilson', 'Wednesday', '07:30:00', '09:00:00', 'Science Lab 3', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29012, 'Filipino', 'Elena Rodriguez', 'Wednesday', '09:00:00', '10:00:00', 'Room 9-H', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29013, 'MAPEH (Arts)', 'Franklin Moore', 'Wednesday', '10:30:00', '11:30:00', 'Room 9-H', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29014, 'Araling Panlipunan', 'Grace Santos', 'Wednesday', '13:00:00', '14:00:00', 'Room 9-H', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29015, 'English (Anglo-American)', 'Henry Taylor', 'Wednesday', '14:00:00', '15:00:00', 'Room 9-H', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29016, 'Mathematics (Trigonometry)', 'Isabella Garcia', 'Thursday', '07:30:00', '08:30:00', 'Room 9-H', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29017, 'Science (Chemistry)', 'Jonathan Lee', 'Thursday', '08:30:00', '09:30:00', 'Science Lab 3', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29018, 'EsP', 'Karen Bautista', 'Thursday', '10:00:00', '11:00:00', 'Room 9-H', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29019, 'Filipino', 'Leonardo Cruz', 'Thursday', '11:00:00', '12:00:00', 'Room 9-H', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29020, 'TLE (ICT)', 'Maria Villareal', 'Thursday', '13:00:00', '14:30:00', 'Computer Lab', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29021, 'English (Grammar)', 'Alice Thompson', 'Friday', '07:30:00', '08:30:00', 'Room 9-H', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29022, 'Mathematics (Trigonometry)', 'Benjamin Clark', 'Friday', '08:30:00', '09:30:00', 'Room 9-H', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29023, 'Science (Chemistry)', 'Catherine Reyes', 'Friday', '10:00:00', '11:30:00', 'Science Lab 3', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29024, 'Homeroom', 'David Wilson', 'Friday', '13:00:00', '14:00:00', 'Room 9-H', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(29025, 'MAPEH (P.E.)', 'Elena Rodriguez', 'Friday', '14:00:00', '15:30:00', 'Court', 'grade9', 'Heritage', '2026-02-24 13:52:51', '2026-02-24 13:52:51', 1035),
(30001, 'English (World Literature)', 'Franklin Moore', 'Monday', '07:30:00', '08:30:00', 'Room 10-R', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30002, 'Mathematics (Statistics)', 'Grace Santos', 'Monday', '08:30:00', '09:30:00', 'Room 10-R', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30003, 'Science (Physics)', 'Henry Taylor', 'Monday', '10:00:00', '11:00:00', 'Science Lab 4', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30004, 'Filipino', 'Isabella Garcia', 'Monday', '11:00:00', '12:00:00', 'Room 10-R', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30005, 'TLE (Consumer Electronics)', 'Jonathan Lee', 'Monday', '13:00:00', '14:30:00', 'TLE Lab', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30006, 'Araling Panlipunan (Economics)', 'Karen Bautista', 'Tuesday', '07:30:00', '08:30:00', 'Room 10-R', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30007, 'EsP', 'Leonardo Cruz', 'Tuesday', '08:30:00', '09:30:00', 'Room 10-R', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30008, 'English (Grammar)', 'Maria Villareal', 'Tuesday', '10:00:00', '11:00:00', 'Room 10-R', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30009, 'Mathematics (Statistics)', 'Alice Thompson', 'Tuesday', '11:00:00', '12:00:00', 'Room 10-R', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30010, 'MAPEH (Music)', 'Benjamin Clark', 'Tuesday', '13:00:00', '14:00:00', 'Music Room', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30011, 'Science (Physics)', 'Catherine Reyes', 'Wednesday', '07:30:00', '09:00:00', 'Science Lab 4', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30012, 'Filipino', 'David Wilson', 'Wednesday', '09:00:00', '10:00:00', 'Room 10-R', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30013, 'MAPEH (Arts)', 'Elena Rodriguez', 'Wednesday', '10:30:00', '11:30:00', 'Room 10-R', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30014, 'Araling Panlipunan (Economics)', 'Franklin Moore', 'Wednesday', '13:00:00', '14:00:00', 'Room 10-R', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30015, 'English (World Literature)', 'Grace Santos', 'Wednesday', '14:00:00', '15:00:00', 'Room 10-R', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30016, 'Mathematics (Statistics)', 'Henry Taylor', 'Thursday', '07:30:00', '08:30:00', 'Room 10-R', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30017, 'Science (Physics)', 'Isabella Garcia', 'Thursday', '08:30:00', '09:30:00', 'Science Lab 4', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30018, 'EsP', 'Jonathan Lee', 'Thursday', '10:00:00', '11:00:00', 'Room 10-R', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30019, 'Filipino', 'Karen Bautista', 'Thursday', '11:00:00', '12:00:00', 'Room 10-R', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30020, 'TLE (ICT)', 'Leonardo Cruz', 'Thursday', '13:00:00', '14:30:00', 'Computer Lab', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30021, 'English (Grammar)', 'Maria Villareal', 'Friday', '07:30:00', '08:30:00', 'Room 10-R', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30022, 'Mathematics (Statistics)', 'Alice Thompson', 'Friday', '08:30:00', '09:30:00', 'Room 10-R', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30023, 'Science (Physics)', 'Benjamin Clark', 'Friday', '10:00:00', '11:30:00', 'Science Lab 4', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30024, 'Homeroom', 'Catherine Reyes', 'Friday', '13:00:00', '14:00:00', 'Room 10-R', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036),
(30025, 'MAPEH (P.E.)', 'David Wilson', 'Friday', '14:00:00', '15:30:00', 'Court', 'grade10', 'Republic', '2026-02-24 13:53:05', '2026-02-24 13:53:05', 1036);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(11) NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `year_level` varchar(50) NOT NULL,
  `shift` enum('morning','afternoon','whole day') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `capacity`, `name`, `year_level`, `shift`) VALUES
(1024, 25, 'Hope', 'kinder1', 'morning'),
(1025, 25, 'Torch', 'kinder2', 'morning'),
(1026, 25, 'Essence', 'kinder3', 'morning'),
(1027, 35, 'Rizal', 'grade1', 'whole day'),
(1028, 35, 'Bonifacio', 'grade2', 'whole day'),
(1029, 35, 'Mabini', 'grade3', 'whole day'),
(1030, 40, 'Del Pilar', 'grade4', 'whole day'),
(1031, 40, 'Silang', 'grade5', 'whole day'),
(1032, 40, 'Luna', 'grade6', 'whole day'),
(1033, 45, 'Wisdom', 'grade7', 'whole day'),
(1034, 45, 'Solidarity', 'grade8', 'whole day'),
(1035, 45, 'Heritage', 'grade9', 'whole day'),
(1036, 45, 'Republic', 'grade10', 'whole day');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('RKzGZAqcChfzOBDcQKecINi09k8GdVaKyxnXQYYY', 163, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ0xyS2J2MEJrYTJtOGk2Mm9nN2VVQzRVOW16a2ZKSFN2WmpsQ290bSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9mdW1jZXNzLW1haW4udGVzdC9zdHVkZW50L2dyYWRlcyI7czo1OiJyb3V0ZSI7czoyMDoic3R1ZGVudC5ncmFkZXMuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNjM7fQ==', 1772697515);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `course_year` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_grades`
--

CREATE TABLE `student_grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enrollment_id` bigint(20) UNSIGNED NOT NULL,
  `grading_item_id` bigint(20) UNSIGNED NOT NULL,
  `raw_score` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_grades`
--

INSERT INTO `student_grades` (`id`, `enrollment_id`, `grading_item_id`, `raw_score`, `created_at`, `updated_at`) VALUES
(1, 8, 4, 49.00, '2026-02-24 10:39:12', '2026-02-24 12:21:13'),
(2, 13, 4, 4.00, '2026-02-24 10:39:12', '2026-02-24 11:53:37'),
(3, 14, 4, 4.00, '2026-02-24 10:39:12', '2026-02-24 11:53:37'),
(4, 15, 4, 5.00, '2026-02-24 10:39:12', '2026-02-24 11:53:37'),
(5, 16, 4, 6.00, '2026-02-24 10:39:12', '2026-02-24 11:53:37'),
(6, 17, 4, 7.00, '2026-02-24 10:39:12', '2026-02-24 11:53:37'),
(7, 31, 4, 7.00, '2026-02-24 10:39:12', '2026-02-24 11:53:37'),
(8, 32, 4, 7.00, '2026-02-24 10:39:12', '2026-02-24 11:53:37'),
(9, 33, 4, 7.00, '2026-02-24 10:39:12', '2026-02-24 11:53:37'),
(10, 34, 4, 7.00, '2026-02-24 10:39:12', '2026-02-24 11:53:37'),
(11, 8, 5, 2.00, '2026-02-24 10:54:29', '2026-02-24 11:38:59'),
(12, 13, 5, 3.00, '2026-02-24 10:54:29', '2026-02-24 11:38:59'),
(13, 14, 5, 4.00, '2026-02-24 10:54:29', '2026-02-24 11:38:59'),
(14, 15, 5, 5.00, '2026-02-24 10:54:29', '2026-02-24 11:38:59'),
(15, 16, 5, 5.00, '2026-02-24 10:54:29', '2026-02-24 11:38:59'),
(16, 17, 5, 5.00, '2026-02-24 10:54:29', '2026-02-24 11:38:59'),
(17, 31, 5, 5.00, '2026-02-24 10:54:29', '2026-02-24 11:38:59'),
(18, 32, 5, 5.00, '2026-02-24 10:54:29', '2026-02-24 11:38:59'),
(19, 33, 5, 5.00, '2026-02-24 10:54:29', '2026-02-24 11:38:59'),
(20, 34, 5, 5.00, '2026-02-24 10:54:29', '2026-02-24 11:38:59'),
(21, 8, 3, 9.00, '2026-02-24 11:22:33', '2026-02-24 12:34:57'),
(22, 13, 3, 1.00, '2026-02-24 11:22:33', '2026-02-24 11:50:44'),
(23, 14, 3, 1.00, '2026-02-24 11:22:33', '2026-02-24 11:50:44'),
(24, 15, 3, 3.00, '2026-02-24 11:22:33', '2026-02-24 11:50:44'),
(25, 16, 3, 4.00, '2026-02-24 11:22:33', '2026-02-24 11:50:44'),
(26, 17, 3, 5.00, '2026-02-24 11:22:33', '2026-02-24 11:50:44'),
(27, 31, 3, 6.00, '2026-02-24 11:22:33', '2026-02-24 11:50:44'),
(28, 32, 3, 7.00, '2026-02-24 11:22:33', '2026-02-24 11:50:44'),
(29, 33, 3, 8.00, '2026-02-24 11:22:33', '2026-02-24 11:50:44'),
(30, 34, 3, 8.00, '2026-02-24 11:22:33', '2026-02-24 11:50:44'),
(31, 30, 2, 3.00, '2026-02-24 11:28:31', '2026-02-24 12:02:25'),
(32, 8, 7, 5.00, '2026-02-24 12:17:03', '2026-02-24 12:17:03'),
(33, 13, 7, 5.00, '2026-02-24 12:17:03', '2026-02-24 12:17:03'),
(34, 14, 7, 5.00, '2026-02-24 12:17:03', '2026-02-24 12:17:03'),
(35, 15, 7, 5.00, '2026-02-24 12:17:03', '2026-02-24 12:17:03'),
(36, 16, 7, 5.00, '2026-02-24 12:17:03', '2026-02-24 12:17:03'),
(37, 17, 7, 5.00, '2026-02-24 12:17:03', '2026-02-24 12:17:03'),
(38, 31, 7, 5.00, '2026-02-24 12:17:03', '2026-02-24 12:17:03'),
(39, 32, 7, 5.00, '2026-02-24 12:17:03', '2026-02-24 12:17:03'),
(40, 33, 7, 5.00, '2026-02-24 12:17:03', '2026-02-24 12:17:03'),
(41, 34, 7, 5.00, '2026-02-24 12:17:03', '2026-02-24 12:17:03');

-- --------------------------------------------------------

--
-- Table structure for table `tuitions`
--

CREATE TABLE `tuitions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academic_year_id` bigint(20) UNSIGNED DEFAULT NULL,
  `enrollment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `studentNumber` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year_level` varchar(50) DEFAULT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tuition_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `misc_fees` decimal(10,2) NOT NULL DEFAULT 0.00,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid_amount` decimal(15,2) DEFAULT 0.00,
  `payment_schedule` varchar(255) DEFAULT 'monthly',
  `umc_affiliation` varchar(255) DEFAULT 'none',
  `sibling_order` varchar(255) DEFAULT 'none',
  `grade_level` varchar(255) DEFAULT NULL,
  `payment_method` enum('gcash','bank_transfer','cash') DEFAULT NULL,
  `status` varchar(255) DEFAULT 'pending',
  `payment_type` varchar(255) NOT NULL DEFAULT 'partial',
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `reference_number` varchar(255) DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tuitions`
--

INSERT INTO `tuitions` (`id`, `academic_year_id`, `enrollment_id`, `studentNumber`, `name`, `year_level`, `balance`, `tuition_fee`, `misc_fees`, `amount`, `paid_amount`, `payment_schedule`, `umc_affiliation`, `sibling_order`, `grade_level`, `payment_method`, `status`, `payment_type`, `approval_status`, `reference_number`, `payment_proof`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2026000037', 'Aidan Black', NULL, 12121.00, 0.00, 0.00, 15738.00, 0.00, 'monthly', 'none', 'none', NULL, 'cash', 'approved', 'full', 'approved', NULL, NULL, NULL, '2026-02-23 06:14:52'),
(12, 1, NULL, '2026000036', 'Eric Thorton', NULL, 0.00, 0.00, 0.00, 15019.20, 0.00, 'monthly', 'none', 'none', NULL, 'gcash', 'approved', 'full', 'pending', NULL, NULL, '2026-02-23 00:41:26', '2026-02-23 06:15:20'),
(14, 1, NULL, '2026000031', 'Raven Howe', NULL, 0.00, 0.00, 8550.00, 8550.00, 0.00, 'monthly', 'none', 'none', NULL, 'cash', 'pending', 'partial', 'pending', NULL, NULL, '2026-02-23 07:34:35', '2026-02-23 07:34:35'),
(15, 1, NULL, '2026000037', 'Aidan Black', NULL, 0.00, 0.00, 8550.00, 8550.00, 0.00, 'monthly', 'none', 'none', NULL, 'bank_transfer', 'pending', 'partial', 'pending', NULL, NULL, '2026-02-23 07:40:09', '2026-02-23 07:40:09'),
(16, 1, NULL, '2026000037', 'Aidan Black', NULL, 0.00, 5031.60, 8550.00, 13581.60, 0.00, 'monthly', 'none', 'none', NULL, 'gcash', 'pending', 'partial', 'pending', NULL, 'payment_proofs/MTFmh4IK8J8Ry5M4TbYAmakPkH5wiIcLGGAgISbX.png', '2026-02-23 07:58:16', '2026-02-23 07:58:16'),
(17, 1, 13, '2026000026', 'Lite, Jefferson', 'kinder2', 0.00, 10500.00, 3750.00, 14250.00, 4250.00, 'monthly', 'none', 'none', NULL, 'gcash', 'partial', 'partial', 'pending', NULL, 'payment_proofs/oHaGZpPHsplX7yADlb8tZ8Kb0PyHs4kia2ORCvQT.png', '2026-02-23 08:15:53', '2026-03-02 02:41:24'),
(24, 1, NULL, '2026000067', 'Arthur Curry', NULL, 5964.30, 3414.30, 8550.00, 1000.00, 0.00, 'quarterly', 'member', '2nd', 'grade1', 'cash', 'pending', 'partial', 'approved', NULL, NULL, '2026-02-25 07:52:52', '2026-02-25 10:17:52'),
(25, 1, NULL, '2026000077', 'Kara Danvers', NULL, 0.00, 0.00, 8550.00, 8550.00, 0.00, 'quarterly', 'worker', '2nd', 'grade1', 'cash', 'pending', 'partial', 'pending', NULL, NULL, '2026-02-25 07:53:13', '2026-02-25 10:22:37'),
(26, 1, NULL, '2026000110', 'Baggins, Frodo', NULL, 9000.00, 13500.00, 500.00, 5000.00, 0.00, 'monthly', 'none', 'none', NULL, 'cash', 'pending', 'partial', 'approved', NULL, NULL, '2026-02-25 08:56:29', '2026-02-25 10:18:59'),
(27, 1, NULL, '2026000074', 'Batson, Billy', NULL, 1114.00, 3594.00, 8520.00, 23114.00, 0.00, 'monthly', 'none', 'none', NULL, 'cash', 'partial', 'partial', 'approved', NULL, NULL, '2026-02-25 08:56:42', '2026-02-25 10:42:30'),
(28, 1, NULL, '2026000107', 'Black, Sirius', NULL, 6520.00, 0.00, 8520.00, 10520.00, 0.00, 'monthly', 'none', 'none', NULL, 'cash', 'pending', 'partial', 'approved', NULL, NULL, '2026-02-25 08:57:04', '2026-02-25 10:43:44'),
(29, 1, 7, '2026000027', 'Channel Oronico', NULL, 0.00, 0.00, 0.00, 500.00, 0.00, 'monthly', 'none', 'none', NULL, 'cash', 'pending', 'partial', 'pending', NULL, NULL, '2026-02-25 09:56:45', '2026-02-25 09:56:45'),
(30, 1, NULL, '2026000067', 'Arthur Curry', NULL, 0.00, 0.00, 0.00, 11964.30, 0.00, 'monthly', 'none', 'none', NULL, 'cash', 'pending', 'partial', 'pending', NULL, NULL, '2026-02-25 10:08:26', '2026-02-25 10:08:26'),
(31, 1, NULL, '2026000077', 'Kara Danvers', NULL, 0.00, 0.00, 0.00, 5000.00, 0.00, 'monthly', 'none', 'none', NULL, 'cash', 'pending', 'partial', 'pending', NULL, NULL, '2026-02-25 10:08:49', '2026-02-25 10:08:49'),
(32, 1, NULL, '2026000067', 'Arthur Curry', NULL, 0.00, 0.00, 0.00, 5000.00, 0.00, 'monthly', 'none', 'none', NULL, 'cash', 'pending', 'partial', 'pending', NULL, NULL, '2026-02-25 10:09:56', '2026-02-25 10:09:56'),
(33, 1, 15, '2026000041', 'Driver, Adam', 'kinder2', 1500.00, 10500.00, 3750.00, 14250.00, 12750.00, 'monthly', 'none', 'none', NULL, 'cash', 'partial', 'partial', 'approved', NULL, NULL, '2026-02-25 11:18:21', '2026-02-25 11:53:32'),
(34, 1, 8, '2026000046', 'Pugh, Florence', 'kinder2', 0.00, 10500.00, 3750.00, 14250.00, 14250.00, 'monthly', 'none', 'none', NULL, NULL, 'paid', 'partial', 'pending', NULL, NULL, '2026-02-25 11:18:21', '2026-02-25 12:46:43'),
(35, 1, 14, '2026000051', 'Everdeen, Katniss', 'kinder2', 3750.00, 10500.00, 3750.00, 14250.00, 10500.00, 'monthly', 'none', 'none', NULL, 'cash', 'partial', 'partial', 'approved', NULL, NULL, '2026-02-25 11:18:21', '2026-02-25 11:56:03'),
(36, 1, 16, '2026000056', 'Parker, Peter', 'kinder2', -6750.00, 10500.00, 3750.00, 14250.00, 21000.00, 'monthly', 'none', 'none', NULL, NULL, 'paid', 'partial', 'pending', NULL, NULL, '2026-02-25 11:18:21', '2026-02-25 12:26:48'),
(37, 1, 17, '2026000061', 'Thurman, Uma', 'kinder2', 10000.00, 10500.00, 3750.00, 14250.00, 4250.00, 'monthly', 'none', 'none', NULL, NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-02-25 11:18:21', '2026-03-01 07:30:59'),
(38, 1, 31, '2026000066', 'Hyrule, Zelda', 'kinder2', 3750.00, 10500.00, 3750.00, 14250.00, 10500.00, 'monthly', 'none', 'none', NULL, NULL, 'partial', 'partial', 'pending', NULL, NULL, '2026-02-25 11:18:21', '2026-02-25 12:07:20'),
(39, 1, 32, '2026000071', 'Allen, Barry', 'kinder2', 6100.00, 7350.00, 3750.00, 16100.00, 0.00, 'monthly', 'none', 'none', NULL, 'cash', 'partial', 'partial', 'approved', NULL, NULL, '2026-02-25 11:18:21', '2026-02-25 11:46:51'),
(40, 1, 33, '2026000076', 'Lance, Dinah', 'kinder2', 0.00, 10500.00, 3750.00, 14250.00, 14250.00, 'monthly', 'none', 'none', NULL, NULL, 'paid', 'partial', 'pending', NULL, NULL, '2026-02-25 11:18:21', '2026-02-25 12:44:14'),
(41, 1, 34, '2026000081', 'Zen, Gamora', 'kinder2', 0.00, 10500.00, 3750.00, 14250.00, 14250.00, 'monthly', 'none', 'none', NULL, NULL, 'paid', 'partial', 'pending', NULL, NULL, '2026-02-25 11:18:21', '2026-03-02 02:22:31'),
(42, 1, NULL, '2026000086', 'Blue, Nebula', 'kinder2', 9000.00, 5250.00, 3750.00, 9000.00, 0.00, 'monthly', 'none', 'none', NULL, NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-02-25 11:18:21', '2026-02-25 11:34:41'),
(43, 1, NULL, '2026000097', 'Longbottom, Neville', 'kinder2', 14250.00, 10500.00, 3750.00, 14250.00, 0.00, 'monthly', 'none', 'none', NULL, NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-02-25 11:18:21', '2026-02-25 11:18:21'),
(44, 1, NULL, '2026000098', 'Weasley, Ginny', 'kinder2', 14250.00, 10500.00, 3750.00, 14250.00, 0.00, 'monthly', 'none', 'none', NULL, NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-02-25 11:18:21', '2026-02-25 11:18:21'),
(46, 1, NULL, '2026000106', 'Lupin, Remus', 'kinder2', -85500.00, 10500.00, 3750.00, 14250.00, 99750.00, 'monthly', 'none', 'none', NULL, NULL, 'paid', 'partial', 'pending', NULL, NULL, '2026-02-25 11:18:21', '2026-02-25 12:19:10'),
(47, 1, NULL, '2026000111', 'Gamgee, Samwise', 'kinder2', 3750.00, 10500.00, 3750.00, 14250.00, 10500.00, 'monthly', 'none', 'none', NULL, NULL, 'partial', 'partial', 'pending', NULL, NULL, '2026-02-25 11:18:21', '2026-02-25 12:02:24'),
(48, 1, NULL, '2026000116', 'Denethor, Boromir', 'kinder2', 0.00, 0.00, 3750.00, 7500.00, 0.00, 'monthly', 'worker', 'none', NULL, 'cash', 'paid', 'partial', 'approved', NULL, NULL, '2026-02-25 11:18:21', '2026-02-25 11:40:25'),
(49, 1, NULL, '2026000128', 'Snow, Coriolanus', 'kinder2', 14250.00, 10500.00, 3750.00, 14250.00, 0.00, 'monthly', 'none', 'none', NULL, NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-02-25 11:18:21', '2026-02-25 11:18:21'),
(50, 1, NULL, '2026000129', 'Gray, Lucy', 'kinder2', 3750.00, 10500.00, 3750.00, 14250.00, 10500.00, 'monthly', 'none', 'none', NULL, NULL, 'partial', 'partial', 'pending', NULL, NULL, '2026-02-25 11:18:21', '2026-02-25 12:04:39'),
(55, 1, NULL, '2026000086', 'Nebula Blue', NULL, 14250.00, 10500.00, 3750.00, 14250.00, 0.00, 'monthly', 'none', 'none', 'kinder2', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:54:59', '2026-03-02 04:54:59'),
(56, 1, NULL, '2026000097', 'Neville Longbottom', NULL, 14250.00, 10500.00, 3750.00, 14250.00, 0.00, 'monthly', 'none', 'none', 'kinder2', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:54:59', '2026-03-02 04:54:59'),
(57, 1, NULL, '2026000098', 'Ginny Weasley', NULL, 14250.00, 10500.00, 3750.00, 14250.00, 0.00, 'monthly', 'none', 'none', 'kinder2', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:54:59', '2026-03-02 04:54:59'),
(58, 1, NULL, '2026000106', 'Remus Lupin', NULL, 14250.00, 10500.00, 3750.00, 14250.00, 0.00, 'monthly', 'none', 'none', 'kinder2', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:54:59', '2026-03-02 04:54:59'),
(59, 1, NULL, '2026000103', 'Severus Snape', NULL, 0.00, 10500.00, 3750.00, 14250.00, 14250.00, 'monthly', 'none', 'none', 'kinder2', NULL, 'paid', 'partial', 'pending', NULL, NULL, '2026-03-02 04:54:59', '2026-03-03 00:36:38'),
(60, 1, NULL, '2026000111', 'Samwise Gamgee', NULL, 14250.00, 10500.00, 3750.00, 14250.00, 0.00, 'monthly', 'none', 'none', 'kinder2', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:54:59', '2026-03-02 04:54:59'),
(61, 1, NULL, '2026000116', 'Boromir Denethor', NULL, 14250.00, 10500.00, 3750.00, 14250.00, 0.00, 'monthly', 'none', 'none', 'kinder2', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:54:59', '2026-03-02 04:54:59'),
(62, 1, NULL, '2026000128', 'Coriolanus Snow', NULL, 14250.00, 10500.00, 3750.00, 14250.00, 0.00, 'monthly', 'none', 'none', 'kinder2', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:54:59', '2026-03-02 04:54:59'),
(63, 1, NULL, '2026000129', 'Lucy Gray', NULL, 14250.00, 10500.00, 3750.00, 14250.00, 0.00, 'monthly', 'none', 'none', 'kinder2', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:54:59', '2026-03-02 04:54:59'),
(64, 1, 45, '2026000044', 'Dua Lipa', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(65, 1, 46, '2026000047', 'Gal Gadot', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(66, 1, 47, '2026000052', 'Lara Croft', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(67, 1, 48, '2026000054', 'Natasha Romanoff', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(68, 1, 49, '2026000057', 'Quinn Fabray', NULL, 0.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 05:42:23'),
(69, 1, 50, '2026000059', 'Steve Rogers', NULL, 0.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 05:47:11'),
(70, 1, 51, '2026000062', 'Vito Corleone', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(71, 1, 52, '2026000064', 'Xena Warrior', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(72, 1, 53, '2026000067', 'Arthur Curry', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(73, 1, 54, '2026000069', 'Clark Kent', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(74, 1, 55, '2026000072', 'Victor Stone', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(75, 1, 56, '2026000074', 'Billy Batson', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(76, 1, 57, '2026000077', 'Kara Danvers', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(77, 1, 58, '2026000079', 'Shayera Hol', NULL, 10000.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 05:07:03'),
(78, 1, 59, '2026000082', 'Rocket Raccoon', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(79, 1, 60, '2026000084', 'Drax Destroyer', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(80, 1, 61, '2026000087', 'Yondu Udonta', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(81, 1, 62, '2026000089', 'Hope Pym', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 04:56:52', '2026-03-02 04:56:52'),
(82, 1, 63, '2026000090', 'Harry Potter', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 05:04:58', '2026-03-02 05:04:58'),
(83, 1, 64, '2026000091', 'Hermione Granger', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 05:04:58', '2026-03-02 05:04:58'),
(84, 1, 65, '2026000092', 'Ron Weasley', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 05:04:58', '2026-03-02 05:04:58'),
(85, 1, 66, '2026000096', 'Cho Chang', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 05:04:58', '2026-03-02 05:04:58'),
(86, 1, 67, '2026000102', 'Albus Dumbledore', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 05:04:58', '2026-03-02 05:04:58'),
(87, 1, 68, '2026000105', 'Minerva McGonagall', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 05:04:59', '2026-03-02 05:04:59'),
(88, 1, 69, '2026000107', 'Sirius Black', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 05:04:59', '2026-03-02 05:04:59'),
(89, 1, 70, '2026000112', 'Gandalf Grey', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 05:04:59', '2026-03-02 05:04:59'),
(90, 1, 71, '2026000114', 'Legolas Greenleaf', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 05:04:59', '2026-03-02 05:04:59'),
(91, 1, 72, '2026000117', 'Galadriel Celeborn', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 05:04:59', '2026-03-02 05:04:59'),
(92, 1, 73, '2026000119', 'Eowyn Rohan', NULL, 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', 'grade1', NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-02 05:05:05', '2026-03-02 05:05:05'),
(93, 1, 74, '2026000130', 'Joe Alwin', 'grade1', 15750.00, 12000.00, 3750.00, 15750.00, 0.00, 'monthly', 'none', 'none', NULL, NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-04 02:15:21', '2026-03-04 02:15:21'),
(94, 2, 601, '20240101', 'Leon Kennedy', 'grade9', 0.00, 15000.00, 5000.00, 20000.00, 0.00, 'monthly', 'none', 'none', NULL, NULL, 'paid', 'partial', 'pending', NULL, NULL, '2026-03-04 17:01:02', '2026-03-04 17:01:02'),
(95, 2, 602, '20240102', 'Claire Redfield', 'grade9', 0.00, 15000.00, 5000.00, 20000.00, 0.00, 'monthly', 'none', 'none', NULL, NULL, 'paid', 'partial', 'pending', NULL, NULL, '2026-03-04 17:01:02', '2026-03-04 17:01:02'),
(96, 2, 603, '20240103', 'Jill Valentine', 'grade9', 0.00, 15000.00, 5000.00, 20000.00, 0.00, 'monthly', 'none', 'none', NULL, NULL, 'paid', 'partial', 'pending', NULL, NULL, '2026-03-04 17:01:02', '2026-03-04 17:01:02'),
(97, 2, 604, '20240104', 'Chris Redfield', 'grade9', 5000.00, 15000.00, 5000.00, 20000.00, 0.00, 'monthly', 'none', 'none', NULL, NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-04 17:01:02', '2026-03-04 17:01:02'),
(98, 2, 605, '20240105', 'Ada Wong', 'grade9', 10000.00, 15000.00, 5000.00, 20000.00, 0.00, 'monthly', 'none', 'none', NULL, NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-04 17:01:02', '2026-03-04 17:01:02'),
(99, 2, 606, '20240106', 'Albert Wesker', 'grade9', 20000.00, 15000.00, 5000.00, 20000.00, 0.00, 'monthly', 'none', 'none', NULL, NULL, 'pending', 'partial', 'pending', NULL, NULL, '2026-03-04 17:01:02', '2026-03-04 17:01:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `year_level` varchar(255) DEFAULT NULL,
  `role` enum('user','applicant','student','admissions','teacher','cashier','registrar','admin') NOT NULL DEFAULT 'user',
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `year_level`, `role`, `is_approved`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `id`) VALUES
('admin', 'admin@gmail.com', NULL, 'admin', 0, '2026-02-24 09:14:16', '$2y$12$MmF739z.cC28B3bZcT973uv.kGBMNKQ5ZiiUcYu87jWh3scku4vPy', '1DKPXrQ37h8KvzeI0SSMUygTCLJzwvQ8e8YyrTq1Xt1X9y0JMM8MA6gRiFPH', '2026-02-02 00:24:50', '2026-02-02 00:24:50', 1),
('Chona Razon', 'chona@gmail.com', 'kinder1', 'student', 1, NULL, '$2y$12$.cpttFzSUVGUSvQM2OWwte796LCiRVKh.tI4gG9su1.Ca0Rfft9ya', NULL, '2026-02-02 01:30:09', '2026-02-24 08:04:12', 2),
('Tricia Salonga', 'tricia@gmail.com', NULL, 'student', 0, NULL, '$2y$12$undf1ZhDMuPdQo1WU4hjaeRuOkk8iu8gnxStcUqn1YGaU5TTiyqe2', NULL, '2026-02-02 07:23:32', '2026-02-02 07:23:32', 5),
('Maria', 'maria@gmail.com', NULL, 'student', 0, NULL, '$2y$12$H5GQP/0OHFDhbtxF5UGCguaGBwl86AVhT66kUCiqyiPqFobk2agW6', NULL, '2026-02-02 07:51:44', '2026-02-02 07:51:44', 6),
('registrar', 'registrar@gmail.com', NULL, 'registrar', 0, '2026-02-24 13:56:44', '$2y$12$NF10VcTgLPLwuMyl6PO5qugc.AbwiD0bBAbiqSjYnzU2mFx9wt/qW', 'BBsVREMXYQ3JKPISRPSfmtWZzPteeg7hl0WndkGsVTJ7oqT8XI7SxMgaCv0W', '2026-02-04 11:52:37', '2026-02-04 11:52:37', 12),
('Tricia Salonga', 'tricia2@gmail.com', NULL, 'applicant', 0, NULL, '$2y$12$CiX.q0iemnkakvFEHjIsDOwjyJOYIZI1oqIDHIqWfT.DBND4Qe5nO', NULL, '2026-02-09 01:23:39', '2026-02-09 01:23:39', 17),
('Normita Mercado', 'normita@gmail.com', NULL, 'applicant', 0, NULL, '$2y$12$qv/oanUlrrqzCY/Ae7doI.II9/uAfyt4KLW9S9TYq6yhUibtnBn4a', NULL, '2026-02-09 01:30:42', '2026-02-09 01:30:42', 18),
('admin', 'admin@gmail.com', NULL, 'admin', 0, NULL, '$2y$12$MmF739z.cC28B3bZcT973uv.kGBMNKQ5ZiiUcYu87jWh3scku4vPy', NULL, '2026-02-02 00:24:50', '2026-02-02 00:24:50', 20),
('Chona Razon', 'chona@gmail.com', NULL, 'student', 0, NULL, '$2y$12$.cpttFzSUVGUSvQM2OWwte796LCiRVKh.tI4gG9su1.Ca0Rfft9ya', NULL, '2026-02-02 01:30:09', '2026-02-02 01:30:09', 21),
('Tricia Salonga', 'tricia@gmail.com', NULL, 'student', 0, NULL, '$2y$12$undf1ZhDMuPdQo1WU4hjaeRuOkk8iu8gnxStcUqn1YGaU5TTiyqe2', NULL, '2026-02-02 07:23:32', '2026-02-02 07:23:32', 24),
('Maria', 'maria@gmail.com', NULL, 'student', 0, NULL, '$2y$12$H5GQP/0OHFDhbtxF5UGCguaGBwl86AVhT66kUCiqyiPqFobk2agW6', NULL, '2026-02-02 07:51:44', '2026-02-02 07:51:44', 25),
('Charles Keith', 'charles@gmail.com', 'grade7', 'student', 0, NULL, '$2y$12$x0Q.h26WaYA.Ca.QbtonK.DICQzMDOjQc7ggu3Kckda3Y4wgpGQ4O', NULL, '2026-02-02 08:38:37', '2026-02-02 08:40:56', 26),
('Jeffrey Buckley', 'jeff@gmail.com', 'grade8', 'student', 0, NULL, '$2y$12$lchqafxOM6ppIwLNE2sjSOTQbAH1qBS5gL03pmNQ1eZLw.VUkFB92', NULL, '2026-02-02 09:29:41', '2026-02-02 09:30:38', 27),
('registrar', 'registrar@gmail.com', NULL, 'registrar', 0, NULL, '$2y$12$NF10VcTgLPLwuMyl6PO5qugc.AbwiD0bBAbiqSjYnzU2mFx9wt/qW', 'QyoTeiWfv9Gz7LTu5WLP1ZqIwbfn2RUpmI9i6ytT5NIhRDr1FD4xvlmMHzo3', '2026-02-04 11:52:37', '2026-02-04 11:52:37', 31),
('Elaiza Salonga', 'elaiza1@gmail.com', 'grade7', 'student', 1, NULL, '$2y$12$Q/7Bkyb8Sqo5m6oEU4YhIu4EY45tN.f7bElYnQXKhDmRpisMmx1di', NULL, '2026-02-09 01:18:41', '2026-02-09 06:45:08', 35),
('Tricia Salonga', 'tricia2@gmail.com', NULL, 'applicant', 0, NULL, '$2y$12$CiX.q0iemnkakvFEHjIsDOwjyJOYIZI1oqIDHIqWfT.DBND4Qe5nO', NULL, '2026-02-09 01:23:39', '2026-02-09 01:23:39', 36),
('Normita Mercado', 'normita@gmail.com', NULL, 'applicant', 0, NULL, '$2y$12$qv/oanUlrrqzCY/Ae7doI.II9/uAfyt4KLW9S9TYq6yhUibtnBn4a', NULL, '2026-02-09 01:30:42', '2026-02-09 01:30:42', 37),
('Bruno Mars', 'bruno@gmail.com', 'grade9', 'student', 1, NULL, '$2y$12$JVRjbCj9qXUKU40H4Q8yiuDEO1KEZIHhJUjHfqjGkPBSLyAG18jA2', NULL, '2026-02-16 09:06:22', '2026-02-16 09:42:26', 39),
('Elaiza Salonga', 'admissions@gmail.com', NULL, 'admissions', 0, '2026-02-24 15:56:12', '$2y$12$t9OQV0kAV2isFuoWJZ2RjurK7u5/cJayHNS4tZmjxwqFqKoCqq.Oy', '9cgrvXRx8wtW2ouNuxZpvMqDvRuKOCW5kfP9fv7U95sUH9fEuPOozpS0pIGJ', '2026-02-16 09:35:48', '2026-02-16 09:35:48', 40),
('bern', 'bern@gmail.com', 'grade9', 'student', 1, NULL, '$2y$12$Tp0sitJrXsMA6LE0zFV7guIHl1EAQtinW3M0ujO65dYducNWxs92e', NULL, '2026-02-17 06:34:37', '2026-02-24 08:02:39', 41),
('Vince Loverez', 'vince@gmail.com', 'grade7', 'student', 1, NULL, '$2y$12$AnYPhYn1OF34b62BpCaiF.FwdYpbnznyRD/qiYTaGRq8Ff960Codi', NULL, '2026-02-17 07:16:29', '2026-02-17 08:01:39', 42),
('Emily Lim', 'cashier@gmail.com', NULL, 'cashier', 0, NULL, '$2y$12$j4gb5WaCfEDBByVoMpXUHexMRM3HrMwvAV0YlNgYczaIvY18jgGWW', NULL, '2026-02-18 09:07:06', '2026-02-18 09:07:06', 43),
('Carl Marc', 'carl@gmail.com', NULL, 'cashier', 0, NULL, '$2y$12$11o0UgFrPCewuQRHV.gOfOz.8wsQdCZKf.5zW9Sp/D68PJPBio2TK', NULL, '2026-02-18 09:25:09', '2026-02-18 09:25:09', 44),
('Jefferson Lite', 'lite@gmail.com', 'kinder2', 'student', 1, NULL, '$2y$12$bvLRX1NINS2684ezQBXfxubszr6BoBhrPM8/nfiduEzzOfxn.Xune', NULL, '2026-02-18 22:41:13', '2026-02-18 22:46:09', 45),
('Channel Oronico', 'oronico@gmail.com', 'grade10', 'student', 1, NULL, '$2y$12$N0vhjPDqOvApzL93.t0liOp23NhFPHccxflzSddOCFEPyodszuV7W', NULL, '2026-02-19 00:08:24', '2026-02-19 00:13:17', 46),
('Benito Mendez', 'benitomendez@gmail.com', NULL, 'user', 0, NULL, '$2y$12$BXTvg2T68pSXsnnSa3LqsOb7vgFLcZThuZYyBO/QGhpICjg9zSb6i', NULL, '2026-02-19 00:25:02', '2026-02-19 00:25:02', 47),
('Elaiza Salonga', 'elaiza.mharie@gmail.com', NULL, 'user', 0, '2026-02-23 05:25:43', '$2y$12$KKJGGmAw6l6Y8ltuCEp/oOdI1JUMEoNmAcy5WbbvovQn4HUumIWbG', 'KBMQWlSIPqBbFbbnGdfQ2gR0tGqZQzGTnXjNzLyDRiAFFcy6UVuJ5Fn6CnK5', '2026-02-23 05:25:13', '2026-02-23 05:57:30', 53),
('Alice Thompson', 'thompson@gmail.com', NULL, 'user', 0, NULL, '$2y$12$9oQIytPNUY.Hv7FynYfAmO6U4Xo4yIGVlL9bfyIQky/hV5IjunvR6', NULL, '2026-02-24 01:06:40', '2026-02-24 01:06:40', 55),
('Benjamin Clark', 'clark@gmail.com', NULL, 'user', 0, NULL, '$2y$12$obVskN/ARqsw9g.sDYl9iuMhzYgdWZfVWgordhGGS37SqqVHrBpvS', NULL, '2026-02-24 01:07:46', '2026-02-24 01:07:46', 56),
('Catherine Reyes', 'reyes@gmail.com', NULL, 'user', 0, NULL, '$2y$12$WAgxKTlIr0JkAv5obUWkK.idhpmZ8dAKrUn1aRDRs/6sGybhYhiTC', NULL, '2026-02-24 01:08:21', '2026-02-24 01:08:21', 57),
('David Wilson', 'wilson@gmail.com', NULL, 'teacher', 0, NULL, '$2y$12$mqteRDsGjtkYEX2i7vyZru.wU03LdreXyeJSMgSV.Zl3L6qvPeFaC', NULL, '2026-02-24 01:08:43', '2026-02-24 01:15:09', 58),
('Elena Rodriguez', 'rodriguez@gmail.com', NULL, 'teacher', 0, NULL, '$2y$12$xFqbGkE5SMahZ2opxFvgCuHRvUe4he3EcQ7qF4bFJjQ.xOMLbHN5.', NULL, '2026-02-24 01:09:19', '2026-02-24 01:15:33', 59),
('Franklin Moore', 'moore@gmail.com', NULL, 'teacher', 0, NULL, '$2y$12$jJchuYJOaGa6fKNJ/ex9IO8S9YPfpVvIAQLXy7h/tecf46u5JypDq', NULL, '2026-02-24 01:09:35', '2026-02-24 01:15:41', 60),
('Grace Santos', 'santos@gmail.com', NULL, 'teacher', 0, NULL, '$2y$12$VsqDU0Ic2sCL0oymcP/mmuKleXUHXHckNQKk1eKbiG/cWec7BVTNO', NULL, '2026-02-24 01:10:26', '2026-02-24 01:15:51', 61),
('Henry Taylor', 'taylor@gmail.com', NULL, 'teacher', 0, NULL, '$2y$12$2whmudyT1aRueqixwISzy.5jRDILULshjSyGhVFziWKY6EA3mO4H.', NULL, '2026-02-24 01:11:09', '2026-02-24 01:15:55', 62),
('Isabella Garcia', 'garcia@gmail.com', NULL, 'teacher', 0, NULL, '$2y$12$j8909XepisCWYVgb9qdEreRaET/R0sCLkAiGImxsBvWKt9aqBLyD2', NULL, '2026-02-24 01:11:24', '2026-02-24 01:16:06', 63),
('Jonathan Lee', 'lee@gmail.com', NULL, 'teacher', 0, NULL, '$2y$12$dQCcyGvzYmO42f0vTcIA..9Pmbnh8.8/0WIcRyxdEmC.qpA.6WT4u', NULL, '2026-02-24 01:11:59', '2026-02-24 01:16:11', 64),
('Karen Bautista', 'bautista@gmail.com', NULL, 'teacher', 0, NULL, '$2y$12$Iks6w9rNsEz.6QbQ48Cvd.RwBVmYGFVr2heg/oFoj2t7GsHBqCv6S', NULL, '2026-02-24 01:12:31', '2026-02-24 01:16:24', 65),
('Leonardo Cruz', 'cruz@gmail.com', NULL, 'teacher', 0, '2026-02-24 14:46:39', '$2y$12$YMEIUHQ.hq3JnV09WrVHueoqNBcFGJrxg3/8YJ.fDOtg6rMtbF02G', 'Dbs9Cndown1mj4Ag4AcpRCRQRrXRLUDCfOzLvCTJkpARc17y25YKZuwqno7W', '2026-02-24 01:12:53', '2026-02-24 01:16:28', 66),
('Maria Villareal', 'villareal@gmail.com', NULL, 'teacher', 0, NULL, '$2y$12$CLSPiHqRGpPnkW4ZWTkKIOqCGJKm.CPxAjMXOEik0oiGuq17pNCtS', NULL, '2026-02-24 01:13:14', '2026-02-24 01:16:36', 67),
('Carl Coloma', 'coloma@gmail.com', NULL, 'user', 0, NULL, '$2y$12$IsG0dXCOEIhHqWd4tXqwY.l4WmSutMU7KJ.I6B5d7w2um0N6zry1C', NULL, '2026-02-24 06:24:37', '2026-02-24 06:24:37', 68),
('carl', 'carll@gmail.com', NULL, 'teacher', 0, NULL, '$2y$12$zP8TccWomjxKi0VHYP0J5e6l11zdJ8LftlGDFjWYHSvak/.JsczIe', NULL, '2026-02-24 06:25:47', '2026-03-04 02:24:16', 69),
('jacob', 'jacob@gmail.com', NULL, 'user', 0, NULL, '$2y$12$1OPMnz1EyNrnm0HkwvD8r.ZhvYwzcQuWxsxER/2D8ckQeME0.aV62', NULL, '2026-02-24 06:27:36', '2026-02-24 06:27:36', 71),
('Zoe Saldana', 'zoe.s@email.com', 'kinder1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:07:58', '2026-02-24 08:15:25', 100),
('Adam Driver', 'adam.d@email.com', 'kinder2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:07:58', '2026-02-24 08:15:41', 101),
('Bella Hadid', 'bella.h@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:07:58', '2026-02-24 08:15:51', 102),
('Chris Evans', 'chris.e@email.com', 'grade2', 'student', 1, '2026-03-04 15:57:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:07:58', '2026-02-24 08:15:58', 103),
('Dua Lipa', 'dua.l@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:07:58', '2026-02-24 08:16:06', 104),
('Eddie Redmayne', 'eddie.r@email.com', 'kinder1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:07:58', '2026-02-24 08:16:15', 105),
('Florence Pugh', 'florence.p@email.com', 'kinder2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:07:58', '2026-02-24 08:16:23', 106),
('Gal Gadot', 'gal.g@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:07:58', '2026-02-24 08:16:31', 107),
('Henry Cavill', 'henry.c@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:07:58', '2026-02-24 08:16:38', 108),
('Iris West', 'iris.w@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:07:58', '2026-02-24 08:16:45', 109),
('Jack Sparrow', 'jack.s@email.com', 'kinder1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:08:31', '2026-02-24 08:16:51', 110),
('Katniss Everdeen', 'katniss.e@email.com', 'kinder2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:08:31', '2026-02-24 08:16:59', 111),
('Lara Croft', 'lara.c@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:08:31', '2026-02-24 08:17:09', 112),
('Marty McFly', 'marty.m@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:08:31', '2026-02-24 08:17:16', 113),
('Natasha Romanoff', 'natasha.r@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:08:31', '2026-02-24 08:17:22', 114),
('Oscar Isaac', 'oscar.i@email.com', 'kinder1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:08:31', '2026-02-24 08:17:32', 115),
('Peter Parker', 'peter.p@email.com', 'kinder2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:08:31', '2026-02-24 08:17:40', 116),
('Quinn Fabray', 'quinn.f@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:08:31', '2026-02-24 08:17:46', 117),
('Rose Dawson', 'rose.d@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:08:31', '2026-02-24 08:17:53', 118),
('Steve Rogers', 'steve.r@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:08:31', '2026-02-24 08:17:59', 119),
('Thor Odinson', 'thor.o@email.com', 'kinder1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:09:20', '2026-02-24 08:18:05', 120),
('Uma Thurman', 'uma.t@email.com', 'kinder2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:09:20', '2026-02-24 08:18:13', 121),
('Vito Corleone', 'vito.c@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:09:20', '2026-02-24 08:18:20', 122),
('Will Smith', 'will.s@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:09:20', '2026-02-24 08:18:32', 123),
('Xena Warrior', 'xena.w@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:09:20', '2026-02-24 08:18:42', 124),
('Yara Greyjoy', 'yara.g@email.com', 'kinder1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:09:20', '2026-02-24 08:19:07', 125),
('Zelda Hyrule', 'zelda.h@email.com', 'kinder2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:09:20', '2026-02-24 08:19:13', 126),
('Arthur Curry', 'arthur.c@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:09:20', '2026-02-24 08:19:20', 127),
('Bruce Wayne', 'bruce.w@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:09:20', '2026-02-24 08:19:27', 128),
('Clark Kent', 'clark.k@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:09:20', '2026-02-24 08:19:33', 129),
('Diana Prince', 'diana.p@email.com', 'kinder1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:01', '2026-02-24 08:19:40', 130),
('Barry Allen', 'barry.a@email.com', 'kinder2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:01', '2026-02-24 08:19:48', 131),
('Victor Stone', 'vic.s@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:01', '2026-02-24 08:19:55', 132),
('Hal Jordan', 'hal.j@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:01', '2026-02-24 08:20:01', 133),
('Billy Batson', 'billy.b@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:01', '2026-02-24 08:20:08', 134),
('Oliver Queen', 'ollie.q@email.com', 'kinder1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:01', '2026-02-24 08:20:20', 135),
('Dinah Lance', 'dinah.l@email.com', 'kinder2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:01', '2026-02-24 08:20:26', 136),
('Kara Danvers', 'kara.d@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:01', '2026-02-24 08:20:33', 137),
('John Constantine', 'john.c@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:01', '2026-02-24 08:20:39', 138),
('Shayera Hol', 'shay.h@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:01', '2026-02-24 08:20:46', 139),
('Peter Quill', 'peter.q@email.com', 'kinder1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:34', '2026-02-24 08:20:52', 140),
('Gamora Zen', 'gamora.z@email.com', 'kinder2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:34', '2026-02-24 08:20:58', 141),
('Rocket Raccoon', 'rocket.r@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:34', '2026-02-24 08:21:05', 142),
('Groot Tree', 'groot.t@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:34', '2026-02-24 08:21:12', 143),
('Drax Destroyer', 'drax.d@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:34', '2026-02-24 08:21:18', 144),
('Mantice Leaf', 'mantice.l@email.com', 'kinder1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:34', '2026-02-24 08:21:32', 145),
('Nebula Blue', 'nebula.b@email.com', 'kinder2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:34', '2026-02-24 08:21:38', 146),
('Yondu Udonta', 'yondu.u@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:34', '2026-02-24 08:21:45', 147),
('Scott Lang', 'scott.l@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:34', '2026-02-24 08:21:51', 148),
('Hope Pym', 'hope.p@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:10:34', '2026-02-24 08:21:58', 149),
('Harry Potter', 'harry.p@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:09', '2026-02-24 08:22:04', 150),
('Hermione Granger', 'hermione.g@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:09', '2026-02-24 08:22:10', 151),
('Ron Weasley', 'ron.w@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:09', '2026-02-24 08:22:16', 152),
('Draco Malfoy', 'draco.m@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpk$O0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:09', '2026-02-24 08:22:23', 153),
('Luna Lovegood', 'luna.love@email.com', 'kinder1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:09', '2026-02-24 08:22:30', 154),
('Cedric Diggory', 'cedric.d@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:09', '2026-02-24 08:22:38', 155),
('Cho Chang', 'cho.c@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:09', '2026-02-24 08:22:45', 156),
('Neville Longbottom', 'neville.l@email.com', 'kinder2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:09', '2026-02-24 08:22:51', 157),
('Ginny Weasley', 'ginny.w@email.com', 'kinder2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:09', '2026-02-24 08:22:57', 158),
('Fred Weasley', 'fred.w@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:09', '2026-02-24 08:23:04', 159),
('George Weasley', 'george.w@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:42', '2026-02-24 08:23:11', 160),
('Luna Lovegood', 'luna.l2@email.com', 'kinder1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:42', '2026-02-24 08:23:17', 161),
('Albus Dumbledore', 'albus.d@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:42', '2026-02-24 08:23:24', 162),
('Severus Snape', 'sev.s@email.com', 'kinder2', 'student', 1, '2026-02-25 21:21:48', '$2y$12$Mmtdu3VusOxALd8BwdfxZ.9Sj9phTxzlCsf9/8wXEI/SzoJQw.JKy', NULL, '2026-02-24 16:11:42', '2026-02-25 13:21:38', 163),
('Rubeus Hagrid', 'hagrid.r@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:42', '2026-02-24 08:23:38', 164),
('Minerva McGonagall', 'minerva.m@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:42', '2026-02-24 08:23:58', 165),
('Remus Lupin', 'remus.l@email.com', 'kinder2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:42', '2026-02-24 08:24:04', 166),
('Sirius Black', 'sirius.b@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:42', '2026-02-24 08:24:11', 167),
('Bellatrix Lestrange', 'bella.l@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:42', '2026-02-24 08:24:18', 168),
('Tom Riddle', 'tom.r@email.com', 'kinder1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:11:42', '2026-02-24 08:24:24', 169),
('Frodo Baggins', 'frodo.b@email.com', 'kinder1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:15', '2026-02-24 08:24:30', 170),
('Samwise Gamgee', 'sam.g@email.com', 'kinder2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:15', '2026-02-24 08:24:37', 171),
('Gandalf Grey', 'gandalf.g@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:15', '2026-02-24 08:24:44', 172),
('Aragorn Elessar', 'aragorn.e@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:15', '2026-02-24 08:24:51', 173),
('Legolas Greenleaf', 'legolas.g@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:15', '2026-02-24 08:24:57', 174),
('Gimli Gloin', 'gimli.g@email.com', 'kinder1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:15', '2026-02-24 08:25:07', 175),
('Boromir Denethor', 'boromir.d@email.com', 'kinder2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:15', '2026-02-24 08:25:13', 176),
('Galadriel Celeborn', 'galadriel.c@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:15', '2026-02-24 08:25:20', 177),
('Elrond Peredhel', 'elrond.p@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:15', '2026-02-24 08:25:27', 178),
('Eowyn Rohan', 'eowyn.r@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:15', '2026-02-24 08:25:33', 179),
('Katniss Everdeen', 'katniss.e@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:48', '2026-02-24 08:25:40', 180),
('Peeta Mellark', 'peeta.m@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:48', '2026-02-24 08:25:50', 181),
('Gale Hawthorne', 'gale.h@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:48', '2026-02-24 08:25:57', 182),
('Haymitch Abernathy', 'haymitch.a@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:48', '2026-02-24 08:26:04', 183),
('Effie Trinket', 'effie.t@email.com', 'kinder1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:48', '2026-02-24 08:26:10', 184),
('Primrose Everdeen', 'prim.e@email.com', 'kinder1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:48', '2026-02-24 08:26:19', 185),
('Finnick Odair', 'finnick.o@email.com', 'grade1', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:48', '2026-02-24 08:26:26', 186),
('Johanna Mason', 'johanna.m@email.com', 'grade2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:48', '2026-02-24 08:26:32', 187),
('Coriolanus Snow', 'corio.s@email.com', 'kinder2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:48', '2026-02-24 08:26:39', 188),
('Lucy Gray', 'lucy.g@email.com', 'kinder2', 'student', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:12:48', '2026-02-24 08:26:46', 189),
('Tony Stark', 'tony.s@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:13:21', '2026-02-24 16:13:21', 190),
('Steve Rogers', 'steve.r@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:13:21', '2026-02-24 16:13:21', 191),
('Natasha Romanoff', 'natasha.r@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:13:21', '2026-02-24 16:13:21', 192),
('Bruce Banner', 'bruce.b@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:13:21', '2026-02-24 16:13:21', 193),
('Clint Barton', 'clint.b@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:13:21', '2026-02-24 16:13:21', 194),
('Wanda Maximoff', 'wanda.max@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:13:21', '2026-02-24 16:13:21', 195),
('Vision Jarvis', 'vision.j@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:13:21', '2026-02-24 16:13:21', 196),
('Sam Wilson', 'sam.w@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:13:21', '2026-02-24 16:13:21', 197),
('Bucky Barnes', 'bucky.b@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:13:21', '2026-02-24 16:13:21', 198),
('Peter Parker', 'spidey.p@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:13:21', '2026-02-24 16:13:21', 199),
('Tchalla Udaku', 'tchalla.u@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:14:18', '2026-02-24 16:14:18', 200),
('Shuri Udaku', 'shuri.u@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:14:18', '2026-02-24 16:14:18', 201),
('Stephen Strange', 'stephen.s@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:14:18', '2026-02-24 16:14:18', 202),
('Wong Lee', 'wong.l@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:14:18', '2026-02-24 16:14:18', 203),
('Carol Danvers', 'carol.d@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:14:18', '2026-02-24 16:14:18', 204),
('Monica Rambeau', 'monica.r@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:14:18', '2026-02-24 16:14:18', 205),
('Kamala Khan', 'kamala.k@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:14:18', '2026-02-24 16:14:18', 206),
('Shang Chi', 'shang.c@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:14:18', '2026-02-24 16:14:18', 207),
('Katy Chen', 'katy.c@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:14:18', '2026-02-24 16:14:18', 208),
('Nick Fury', 'nick.f@email.com', NULL, 'student', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-02-24 16:14:18', '2026-02-24 16:14:18', 209),
('Maribel Salonga', 'salonga@gmail.com', NULL, 'cashier', 0, '2026-02-25 01:32:43', '$2y$12$R2q7ZYs6XcMHOhT5F0Dgtuc2qsoDDIeh1sLadyaKHlVA54gJerJLy', 'EDswgbo3HfLG5nbyAH0bdxs3JkS8tcXf9qnmHtEPZrYxU5TFIAdg8A8XVYWV', '2026-02-25 01:30:12', '2026-02-25 01:32:43', 210),
('Taylor Swift', 'swift.t@gmail.com', 'grade3', 'student', 1, '2026-03-04 07:49:55', '$2y$12$GQCa50RznD8odZzLBVIc8OoDHuSSZSVpCs/kKsTgCj2bDUv0.6Zeu', 'seB8qtbJAY8QPZPOl0z2RQAALSb2zu3kkd5obi9RfjaH8ITVB596om2L2znX', '2026-03-03 23:49:09', '2026-03-04 02:13:57', 211),
('Ashley Graham', 'ashley.graham@example.com', NULL, 'user', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-03-04 18:23:17', '2026-03-04 18:23:17', 701),
('Ethan Winters', 'ethan.winters@example.com', NULL, 'user', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-03-04 18:23:17', '2026-03-04 18:23:17', 702),
('Mia Winters', 'mia.winters@example.com', NULL, 'user', 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-03-04 18:23:17', '2026-03-04 18:23:17', 703);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admissions`
--
ALTER TABLE `admissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentNumber` (`studentNumber`),
  ADD UNIQUE KEY `studentNumber_2` (`studentNumber`),
  ADD UNIQUE KEY `admissions_student_number_unique` (`student_number`),
  ADD KEY `admissions_user_id_foreign` (`user_id`),
  ADD KEY `studentNumber_3` (`studentNumber`),
  ADD KEY `fk_admissions_academic_year` (`academic_year_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_attendance_lookup` (`section_id`,`studentNumber`,`date`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_records`
--
ALTER TABLE `class_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_student_record` (`studentNumber`),
  ADD KEY `fk_section_record` (`section_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_user_id_foreign` (`user_id`);

--
-- Indexes for table `email_logs`
--
ALTER TABLE `email_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_student_number` (`studentNumber`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollments_studentnumber_foreign` (`studentNumber`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fee_structures`
--
ALTER TABLE `fee_structures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `year_level` (`year_level`),
  ADD KEY `fk_fee_structures_academic_year` (`academic_year_id`);

--
-- Indexes for table `grading_components`
--
ALTER TABLE `grading_components`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `grading_section_category_unique` (`section_id`,`category`);

--
-- Indexes for table `grading_items`
--
ALTER TABLE `grading_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_item_component` (`component_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_payments_tuition` (`tuition_id`),
  ADD KEY `idx_payment_enrollment` (`enrollment_id`),
  ADD KEY `fk_payments_academic_year` (`academic_year_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_student_id_unique` (`student_id`),
  ADD KEY `students_user_id_foreign` (`user_id`);

--
-- Indexes for table `student_grades`
--
ALTER TABLE `student_grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_enrollment` (`enrollment_id`);

--
-- Indexes for table `tuitions`
--
ALTER TABLE `tuitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_studentNumber` (`studentNumber`),
  ADD KEY `fk_tuitions_academic_year` (`academic_year_id`),
  ADD KEY `fk_tuition_enrollment` (`enrollment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admissions`
--
ALTER TABLE `admissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=704;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `class_records`
--
ALTER TABLE `class_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `email_logs`
--
ALTER TABLE `email_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=704;

--
-- AUTO_INCREMENT for table `fee_structures`
--
ALTER TABLE `fee_structures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `grading_components`
--
ALTER TABLE `grading_components`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `grading_items`
--
ALTER TABLE `grading_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94474;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1040;

--
-- AUTO_INCREMENT for table `student_grades`
--
ALTER TABLE `student_grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tuitions`
--
ALTER TABLE `tuitions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=704;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admissions`
--
ALTER TABLE `admissions`
  ADD CONSTRAINT `fk_admissions_academic_year` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `class_records`
--
ALTER TABLE `class_records`
  ADD CONSTRAINT `fk_section_record` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_student_record` FOREIGN KEY (`studentNumber`) REFERENCES `enrollments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_studentnumber_foreign` FOREIGN KEY (`studentNumber`) REFERENCES `admissions` (`studentNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fee_structures`
--
ALTER TABLE `fee_structures`
  ADD CONSTRAINT `fk_fee_structures_academic_year` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `grading_components`
--
ALTER TABLE `grading_components`
  ADD CONSTRAINT `fk_grading_section` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`) ON DELETE CASCADE;

--
-- Constraints for table `grading_items`
--
ALTER TABLE `grading_items`
  ADD CONSTRAINT `fk_item_component` FOREIGN KEY (`component_id`) REFERENCES `grading_components` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payment_enrollment` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_payments_academic_year` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_payments_tuition` FOREIGN KEY (`tuition_id`) REFERENCES `tuitions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_grades`
--
ALTER TABLE `student_grades`
  ADD CONSTRAINT `fk_enrollment` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tuitions`
--
ALTER TABLE `tuitions`
  ADD CONSTRAINT `fk_tuition_enrollment` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tuitions_academic_year` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
