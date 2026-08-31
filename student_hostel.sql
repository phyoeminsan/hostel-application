-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2026 at 03:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_hostel`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `academic_year_id` bigint(20) UNSIGNED NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`academic_year_id`, `academic_year`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '2024-2025', 'Old', NULL, '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(2, '2022-2023', 'Current', NULL, '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(3, '2021-2022', 'Old', NULL, '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(4, '2023-2024', 'Current', NULL, '2026-08-26 09:46:40', '2026-08-30 04:46:16'),
(5, '2023-2024', 'Old', NULL, '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(6, '2025-2026', 'Old', NULL, '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(7, '2021-2022', 'Current', NULL, '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(8, '2021-2022', 'Current', NULL, '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(9, '2021-2022', 'Current', NULL, '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(10, '2024-2025', 'Current', NULL, '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(11, '2026-2027', 'Old', NULL, '2026-08-30 04:19:03', '2026-08-30 04:19:30'),
(12, '2026-2027', 'Current', NULL, '2026-08-30 04:31:35', '2026-08-30 04:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '$2y$12$Jci4y56EaUPC.x/oJfKSnu4JmhCKgJVwHSfuz2xq2Yw6E4fiCavu6', NULL, '2026-08-26 09:46:41', '2026-08-30 17:12:44');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `hostels`
--

CREATE TABLE `hostels` (
  `hostel_id` bigint(20) UNSIGNED NOT NULL,
  `hostel_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `capacity` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hostels`
--

INSERT INTO `hostels` (`hostel_id`, `hostel_name`, `image`, `gender`, `capacity`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'က‌မ္ဘောဇဆောင်', '/images/hostels/1787761328.jpg', 'Male', '40', NULL, '2026-08-26 09:46:41', '2026-08-26 09:52:08'),
(2, 'သဇင်ဆောင်', '/images/hostels/1787761372.jpg', 'Female', '20', NULL, '2026-08-26 09:46:41', '2026-08-26 09:52:52'),
(3, 'ချယ်ရီဆောင်', '/images/hostels/1787761413.jpg', 'Female', '20', NULL, '2026-08-26 09:46:41', '2026-08-26 09:53:33'),
(4, 'က‌မ္ဘောဇဆောင်233', '/images/hostels/1788098853.jpg', 'Male', '50', NULL, '2026-08-30 07:37:33', '2026-08-30 07:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `hostel_allocations`
--

CREATE TABLE `hostel_allocations` (
  `allocation_id` bigint(20) UNSIGNED NOT NULL,
  `allocation_date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hostel_allocations`
--

INSERT INTO `hostel_allocations` (`allocation_id`, `allocation_date`, `status`, `description`, `payment_id`, `room_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '2026-08-26', 'unactive', 'Asperiores vel molestiae nobis alias. Ut quidem dignissimos doloremque sint quas ullam eos. Quidem incidunt est atque ut rerum ad. Enim maiores sint nesciunt.', 10, 19, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(2, '2026-08-26', 'unactive', 'Sapiente sint eveniet cupiditate voluptate et. Similique culpa deleniti autem aut voluptatem sequi et.', 3, 20, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(3, '2026-08-26', 'active', 'Dolorem ipsum ut eum harum quis iusto. Natus natus sed dolor sed voluptates ut. Et maiores aut quam sed qui iure dicta aperiam.', 8, 9, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(4, '2026-08-26', 'unactive', 'Laborum repellendus quia ipsam odit non. Facere laboriosam nihil vero sed non. Nesciunt fugit accusantium similique quis laboriosam unde ipsam.', 4, 4, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(5, '2026-08-26', 'unactive', 'Voluptatem commodi sapiente ut voluptate quis expedita enim. Dolor id quidem nesciunt expedita animi nostrum. Quaerat et velit quis itaque maiores.', 7, 7, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(6, '2026-08-26', 'active', 'Commodi sit facilis vitae nam officia repellat quia aut. Autem aut omnis soluta id.', 5, 8, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(7, '2026-08-26', 'unactive', 'Ut qui autem omnis at. Et facilis et et ab vel molestiae ipsam.', 9, 8, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(8, '2026-08-26', 'active', 'Eaque possimus quo aut odit officiis facere. Ratione accusamus voluptas autem velit delectus. Fugiat delectus quas unde sit. Saepe eos porro tempore quasi nesciunt nesciunt voluptates.', 1, 17, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(9, '2026-08-26', 'unactive', 'Iure dignissimos ipsa eligendi tempora. Voluptas itaque pariatur praesentium aliquid et omnis. Omnis rerum unde odio quia sint qui. Necessitatibus est nihil quis.', 7, 6, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(10, '2026-08-26', 'unactive', 'Ea incidunt nesciunt totam reiciendis accusamus assumenda ut. Eos dolorum et cum deleniti quidem qui et. Quis ea ducimus enim dolor culpa iure itaque. Libero voluptas voluptatem laborum quos.', 9, 17, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(11, '2026-08-29', 'unactive', 'အခန်း နေရာချထားပေးသည့်နေ့မှစ၍ (၁) လအတွင်း အဆောင်သို့ လာရောက်သတင်းပို့ နေထိုင်ခြင်းမရှိပါက အဆိုပါ အဆောင်နေထိုင်ခွင့်ကို အလိုအလျောက် ပယ်ဖျက်မည်ဖြစ်ပြီး နောက်လူသို့ လွှဲပြောင်းပေးသွားမည်ဖြစ်သည်။', 12, 19, NULL, '2026-08-29 02:40:55', '2026-08-29 08:33:22'),
(12, '2026-08-29', 'unactive', 'အခန်း နေရာချထားပေးသည့်နေ့မှစ၍ (၁) လအတွင်း အဆောင်သို့ လာရောက်သတင်းပို့ နေထိုင်ခြင်းမရှိပါက အဆိုပါ အဆောင်နေထိုင်ခွင့်ကို အလိုအလျောက် ပယ်ဖျက်မည်ဖြစ်ပြီး နောက်လူသို့ လွှဲပြောင်းပေးသွားမည်ဖြစ်သည်။', 15, 5, NULL, '2026-08-29 02:43:23', '2026-08-29 02:43:23'),
(13, '2026-08-29', 'active', 'အခန်း နေရာချထားပေးသည့်နေ့မှစ၍ (၁) လအတွင်း အဆောင်သို့ လာရောက်သတင်းပို့ နေထိုင်ခြင်းမရှိပါက အဆိုပါ အဆောင်နေထိုင်ခွင့်ကို အလိုအလျောက် ပယ်ဖျက်မည်ဖြစ်ပြီး နောက်လူသို့ လွှဲပြောင်းပေးသွားမည်ဖြစ်သည်။', 16, 1, NULL, '2026-08-29 09:13:49', '2026-08-29 09:13:49'),
(14, '2026-08-29', 'unactive', 'အခန်း နေရာချထားပေးသည့်နေ့မှစ၍ (၁) လအတွင်း အဆောင်သို့ လာရောက်သတင်းပို့ နေထိုင်ခြင်းမရှိပါက အဆိုပါ အဆောင်နေထိုင်ခွင့်ကို အလိုအလျောက် ပယ်ဖျက်မည်ဖြစ်ပြီး နောက်လူသို့ လွှဲပြောင်းပေးသွားမည်ဖြစ်သည်။', 6, 20, NULL, '2026-08-29 09:15:16', '2026-08-29 09:15:16'),
(15, '2026-08-30', 'active', 'အခန်း နေရာချထားပေးသည့်နေ့မှစ၍ (၁) လအတွင်း အဆောင်သို့ လာရောက်သတင်းပို့ နေထိုင်ခြင်းမရှိပါက အဆိုပါ အဆောင်နေထိုင်ခွင့်ကို အလိုအလျောက် ပယ်ဖျက်မည်ဖြစ်ပြီး နောက်လူသို့ လွှဲပြောင်းပေးသွားမည်ဖြစ်သည်။', 11, 21, NULL, '2026-08-29 19:21:40', '2026-08-29 19:21:40'),
(16, '2026-09-01', 'unactive', 'အခန်း နေရာချထားပေးသည့်နေ့မှစ၍ (၁) လအတွင်း အဆောင်သို့ လာရောက်သတင်းပို့ နေထိုင်ခြင်းမရှိပါက အဆိုပါ အဆောင်နေထိုင်ခွင့်ကို အလိုအလျောက် ပယ်ဖျက်မည်ဖြစ်ပြီး နောက်လူသို့ လွှဲပြောင်းပေးသွားမည်ဖြစ်သည်။', 17, 1, NULL, '2026-08-29 19:30:43', '2026-08-30 10:05:18'),
(17, '2026-08-31', 'unactive', 'အခန်း နေရာချထားပေးသည့်နေ့မှစ၍ (၁) လအတွင်း အဆောင်သို့ လာရောက်သတင်းပို့ နေထိုင်ခြင်းမရှိပါက အဆိုပါ အဆောင်နေထိုင်ခွင့်ကို အလိုအလျောက် ပယ်ဖျက်မည်ဖြစ်ပြီး နောက်လူသို့ လွှဲပြောင်းပေးသွားမည်ဖြစ်သည်။', 18, 22, NULL, '2026-08-30 19:13:46', '2026-08-30 19:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `hostel_applications`
--

CREATE TABLE `hostel_applications` (
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `record_id` bigint(20) UNSIGNED NOT NULL,
  `hostel_id` bigint(20) UNSIGNED NOT NULL,
  `apply_date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hostel_applications`
--

INSERT INTO `hostel_applications` (`application_id`, `record_id`, `hostel_id`, `apply_date`, `status`, `reason`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 6, 2, '2022-06-25', 'pending', 'iste', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(2, 3, 1, '1978-08-29', 'rejected', 'maiores', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(3, 6, 2, '1995-04-11', 'approved', 'dolor', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(4, 6, 2, '1987-03-21', 'rejected', 'you is very near', NULL, '2026-08-26 09:46:41', '2026-08-30 08:41:46'),
(5, 9, 1, '2007-02-27', 'pending', 'sed', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(6, 1, 3, '2021-12-08', 'approved', 'iure', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(7, 7, 3, '1974-08-06', 'rejected', 'harum', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(8, 9, 2, '2010-04-04', 'rejected', 'aut', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(9, 4, 2, '2014-03-06', 'approved', NULL, NULL, '2026-08-26 09:46:41', '2026-08-29 07:40:39'),
(10, 2, 2, '1989-11-09', 'rejected', 'vel', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(11, 11, 1, '2026-08-26', 'approved', NULL, NULL, '2026-08-26 09:57:48', '2026-08-26 09:59:06'),
(12, 12, 1, '2026-08-28', 'approved', NULL, NULL, '2026-08-28 04:57:16', '2026-08-28 04:57:37'),
(13, 13, 3, '2026-08-29', 'approved', NULL, NULL, '2026-08-28 22:42:05', '2026-08-28 22:42:21'),
(14, 14, 1, '2026-08-28', 'approved', NULL, NULL, '2026-08-29 09:05:44', '2026-08-29 09:07:47'),
(15, 15, 1, '2026-08-30', 'approved', NULL, NULL, '2026-08-29 19:28:14', '2026-08-29 19:28:51'),
(16, 16, 1, '2026-08-31', 'approved', NULL, NULL, '2026-08-30 18:47:45', '2026-08-30 18:48:52');

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
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `major_id` bigint(20) UNSIGNED NOT NULL,
  `major_name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`major_id`, `major_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'CST', NULL, '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(2, 'CS', NULL, '2026-08-26 09:46:40', '2026-08-26 09:47:40'),
(3, 'CT', NULL, '2026-08-26 09:46:40', '2026-08-26 09:47:49'),
(4, 'CS', NULL, '2026-08-30 05:24:39', '2026-08-30 05:30:03');

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
(4, '2026_08_15_171353_create_academic_years_table', 1),
(5, '2026_08_15_171808_create_years_table', 1),
(6, '2026_08_15_171809_create_majors_table', 1),
(7, '2026_08_15_171902_create_students_table', 1),
(8, '2026_08_16_014036_create_hostels_table', 1),
(9, '2026_08_16_014256_create_rooms_table', 1),
(10, '2026_08_16_014267_create_student_records_table', 1),
(11, '2026_08_16_055112_create_hostel_applications_table', 1),
(12, '2026_08_16_055732_create_payments_table', 1),
(13, '2026_08_16_060417_create_hostel_allocations_table', 1),
(14, '2026_08_20_144928_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `payment_slip` varchar(255) NOT NULL,
  `transaction_no` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `reason` text DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `payment_method`, `amount`, `payment_slip`, `transaction_no`, `payment_date`, `reason`, `status`, `application_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'WavePay', '22805', 'https://via.placeholder.com/640x480.png/00ffaa?text=omnis', '215311', '2026-08-26', 'est', 'paid', 3, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(2, 'Kpay', '21285', 'https://via.placeholder.com/640x480.png/00dd77?text=libero', '652105', '2026-08-26', NULL, 'paid', 1, NULL, '2026-08-26 09:46:41', '2026-08-29 19:40:03'),
(3, 'WavePay', '24158', 'https://via.placeholder.com/640x480.png/0022ee?text=voluptates', '757779', '2026-08-26', 'et', 'paid', 2, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(4, 'WavePay', '25543', 'https://via.placeholder.com/640x480.png/00cc00?text=nihil', '248943', '2026-08-26', 'sed', 'failed', 3, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(5, 'Kpay', '21257', 'https://via.placeholder.com/640x480.png/0022bb?text=aut', '260040', '2026-08-26', 'et', 'failed', 5, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(6, 'Kpay', '21695', 'https://via.placeholder.com/640x480.png/0066dd?text=itaque', '925255', '2026-08-26', 'adipisci', 'paid', 5, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(7, 'WavePay', '25252', 'https://via.placeholder.com/640x480.png/001111?text=sint', '396415', '2026-08-26', 'numquam', 'paid', 3, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(8, 'WavePay', '28591', 'https://via.placeholder.com/640x480.png/0055bb?text=hic', '537002', '2026-08-26', 'in', 'paid', 1, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(9, 'Kpay', '23378', 'https://via.placeholder.com/640x480.png/00ee44?text=tempora', '177115', '2026-08-26', 'omnis', 'paid', 9, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(10, 'Kpay', '22300', 'https://via.placeholder.com/640x480.png/00bb99?text=doloremque', '319016', '2026-08-26', 'cupiditate', 'paid', 5, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(11, 'KPay', '25000', '/images/payment_slips/1787761776.png', 'TXN-123456', '2026-08-26', NULL, 'paid', 11, NULL, '2026-08-26 09:59:36', '2026-08-29 18:57:33'),
(12, 'WavePay', '25000', '/images/payment_slips/1787975143.png', 'TXN-654123', '2026-08-29', NULL, 'paid', 12, NULL, '2026-08-28 05:00:19', '2026-08-28 21:46:04'),
(15, 'WavePay', '22000', '/images/payment_slips/1787980390.png', 'TXN-147852', '2026-08-29', NULL, 'paid', 13, NULL, '2026-08-28 22:43:10', '2026-08-28 22:43:42'),
(16, 'WavePay', '26000', '/images/payment_slips/1788018015.png', 'TXN-987456', '2026-08-29', NULL, 'paid', 14, NULL, '2026-08-29 09:08:18', '2026-08-29 09:10:29'),
(17, 'KPay', '26000', '/images/payment_slips/1788055173.jpg', 'TXN-147852', '2026-08-31', NULL, 'paid', 15, NULL, '2026-08-29 19:29:33', '2026-08-29 19:29:58'),
(18, 'bank_transfer', '24999.98', '/images/payment_slips/1788140529.jpg', 'TXN-987456', '2026-08-31', NULL, 'paid', 16, NULL, '2026-08-30 19:10:12', '2026-08-30 19:12:19');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `room_no` varchar(255) NOT NULL,
  `floor_no` varchar(255) NOT NULL,
  `no_of_person` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `hostel_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_no`, `floor_no`, `no_of_person`, `status`, `hostel_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'R-135', '2rd', '2', 'Full', 1, NULL, '2026-08-26 09:46:41', '2026-08-29 19:30:43'),
(2, 'R-263', '2rd', '2', 'Available', 2, NULL, '2026-08-26 09:46:41', '2026-08-28 22:46:06'),
(3, 'R-207', '2rd', '2', 'Available', 2, NULL, '2026-08-26 09:46:41', '2026-08-28 22:46:15'),
(4, 'R-108', '1st', '2', 'Available', 2, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(5, 'R-365', '1st', '2', 'Full', 3, NULL, '2026-08-26 09:46:41', '2026-08-29 02:43:23'),
(6, 'R-125', '1st', '1', 'Available', 2, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(7, 'R-142', '1st', '1', 'Available', 2, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(8, 'R-388', '1st', '2', 'Available', 3, NULL, '2026-08-26 09:46:41', '2026-08-28 22:45:42'),
(9, 'R-149', '1st', '2', 'Full', 1, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(10, 'R-158', '1st', '2', 'Full', 1, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(11, 'R-189', '2rd', '2', 'Full', 2, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(12, 'R-106', '1st', '1', 'Full', 2, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(13, 'R-169', '2rd', '1', 'Full', 1, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(14, 'R-103', '2rd', '1', 'Available', 2, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(15, 'R-173', '2rd', '1', 'Full', 2, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(16, 'R-367', '2rd', '2', 'Available', 3, NULL, '2026-08-26 09:46:41', '2026-08-28 22:45:51'),
(17, 'R-153', '2rd', '1', 'Full', 1, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(18, 'R-241', '1st', '2', 'Available', 2, NULL, '2026-08-26 09:46:41', '2026-08-28 22:46:26'),
(19, 'R-160', '2rd', '1', 'Full', 1, NULL, '2026-08-26 09:46:41', '2026-08-29 02:40:55'),
(20, 'R-110', '2rd', '1', 'Full', 1, NULL, '2026-08-26 09:46:41', '2026-08-29 09:15:16'),
(21, 'R-111', '1st', '2', 'Full', 1, NULL, '2026-08-29 03:15:35', '2026-08-29 19:21:40'),
(22, 'R-112', '1st', '2', 'Full', 1, NULL, '2026-08-30 08:33:30', '2026-08-30 19:13:46');

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
('1ezHKYW42uhLkKznFlGjZHEQBrdShnbmR3nAjZHQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRlVHZWQyWlpkZVkyUmJOeWpjakVLVVA4Tzh5TktZbjBVeWZnM3ExSyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czo1OiJpbmRleCI7fX0=', 1788140707),
('81xoxYHZCxcAcM3y5yK0ol9OsR6A4Hlbvlw0X163', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZkF0eXIzVE4wZ2FCNDZJVDlBckxCdlpFbjZ3MG4yOXNmTlN1cDhJcSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9ob3N0ZWxfYWxsb2NhdGlvbnMiO3M6NToicm91dGUiO3M6MjA6InN0dWRlbnQubXlBbGxvY2F0aW9uIjt9czo1NDoibG9naW5fc3R1ZGVudF81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE2O3M6MzoidXJsIjthOjA6e31zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1788140649);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `roll_no` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `major_id` bigint(20) UNSIGNED NOT NULL,
  `gender` varchar(255) NOT NULL,
  `nrc` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `roll_no`, `name`, `major_id`, `gender`, `nrc`, `date_of_birth`, `phone_no`, `address`, `profile`, `email`, `password`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'UCSPL-879', 'quasi', 2, 'female', 'tempore', '2001-09-01', '09707457480', 'cupiditate', 'https://via.placeholder.com/640x480.png/00cc33?text=ea', 'polly39@example.net', '$2y$12$UoDtdc62af1utddnMeclqejzRyhHjKkYi2QE9qGpPszcD2k2LuoTK', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(2, 'UCSPL-1334', 'totam', 2, 'female', 'aut', '2002-03-17', '09195228157', 'quae', 'https://via.placeholder.com/640x480.png/00ff11?text=aut', 'avery98@example.org', '$2y$12$UoDtdc62af1utddnMeclqejzRyhHjKkYi2QE9qGpPszcD2k2LuoTK', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(3, 'UCSPL-334', 'aliquid', 3, 'female', 'fugit', '2002-07-08', '09008070935', 'voluptatem', 'https://via.placeholder.com/640x480.png/00dd11?text=atque', 'carter.rae@example.net', '$2y$12$UoDtdc62af1utddnMeclqejzRyhHjKkYi2QE9qGpPszcD2k2LuoTK', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(4, 'UCSPL-421', 'nobis', 2, 'male', 'enim', '2004-03-30', '09074937755', 'reiciendis', 'https://via.placeholder.com/640x480.png/0022ee?text=quisquam', 'labadie.trudie@example.org', '$2y$12$UoDtdc62af1utddnMeclqejzRyhHjKkYi2QE9qGpPszcD2k2LuoTK', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(5, 'UCSPL-1230', 'et', 2, 'male', 'vero', '2005-03-20', '09744190237', 'voluptas', 'https://via.placeholder.com/640x480.png/00dd11?text=aut', 'xmccullough@example.net', '$2y$12$UoDtdc62af1utddnMeclqejzRyhHjKkYi2QE9qGpPszcD2k2LuoTK', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(6, 'UCSPL-1704', 'tenetur', 2, 'male', 'ipsum', '2003-03-28', '09972935876', 'repudiandae', 'https://via.placeholder.com/640x480.png/00dd11?text=maxime', 'graham.sunny@example.net', '$2y$12$UoDtdc62af1utddnMeclqejzRyhHjKkYi2QE9qGpPszcD2k2LuoTK', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(7, 'UCSPL-1921', 'sit', 3, 'male', 'cumque', '2003-11-29', '09307005782', 'nemo', 'https://via.placeholder.com/640x480.png/007777?text=nam', 'mcclure.violette@example.org', '$2y$12$UoDtdc62af1utddnMeclqejzRyhHjKkYi2QE9qGpPszcD2k2LuoTK', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(8, 'UCSPL-947', 'quod', 1, 'male', 'unde', '2005-02-19', '09084061379', 'nam', 'https://via.placeholder.com/640x480.png/00ddff?text=molestiae', 'ahomenick@example.net', '$2y$12$UoDtdc62af1utddnMeclqejzRyhHjKkYi2QE9qGpPszcD2k2LuoTK', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(9, 'UCSPL-412', 'adipisci', 2, 'male', 'consequatur', '2005-09-11', '09192607387', 'amet', 'https://via.placeholder.com/640x480.png/0011cc?text=voluptas', 'zack73@example.net', '$2y$12$UoDtdc62af1utddnMeclqejzRyhHjKkYi2QE9qGpPszcD2k2LuoTK', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(10, 'UCSPL-729', 'laborum', 1, 'female', 'incidunt', '2005-11-17', '09182327679', 'sed', 'https://via.placeholder.com/640x480.png/009977?text=provident', 'braeden.huels@example.net', '$2y$12$UoDtdc62af1utddnMeclqejzRyhHjKkYi2QE9qGpPszcD2k2LuoTK', NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(11, 'UCSPL-1114', 'Phyoe Min San', 2, 'Male', '13/LaLaN(N) 123456', '2005-04-12', '09890839519', 'Pang Long', '/images/profiles/1787761148.png', 'phyoeminsan@gmail.com', '$2y$12$aAgVZ49zH5C8eXel8y8DcuraAg1X6xUDfSv/p/QYO77CbXCB//nuK', NULL, '2026-08-26 09:49:08', '2026-08-26 09:49:08'),
(12, 'UCSPL-1235', 'Pyae Paing Kyaw', 2, 'Male', '13/LaLaN(N) 123456', '2005-12-01', '09890839519', 'Pang Long', '/images/profiles/1787916329.jpg', 'pyaepaingkyaw@gmail.com', '$2y$12$ql8R5ZKO0SohjUUZOksk0.YX/3twkajqrD1QNHeeMlLFz9OgJSYDq', NULL, '2026-08-28 04:55:29', '2026-08-28 04:55:54'),
(13, 'UCSPL-1185', 'Nann Nann', 2, 'Female', '13/LaLaN(N) 123456', '2005-12-01', '09890839519', 'Pang Long', '/images/profiles/1787980274.jpg', 'nanhsu@gmail.com', '$2y$12$S/i5moPn9CpwKzHvGKOv7ucdfdsGSiVZtLT4HyK8xizvWQcqfYwrK', NULL, '2026-08-28 22:41:14', '2026-08-30 10:32:19'),
(14, 'UCSPL-1000', 'Mg Zaw', 3, 'Male', '13/LaLaN(N) 123456', '2003-01-01', '09890839519', 'LoiLem', '/images/profiles/1788017675.jpg', 'mgzaw@gmail.com', '$2y$12$G/kX9a3DLR2qWT6qC.U0heosWskS4.UqnqwHYTFb43yXTHUYadUGm', NULL, '2026-08-29 09:04:35', '2026-08-29 09:04:35'),
(15, 'UCSPL-2001', 'Ko Tun', 3, 'Male', '13/LaLaN(N) 123456', '2003-01-01', '09890839519', 'Taungyi', '/images/profiles/1788067733.jpg', 'kotun@gmail.com', '$2y$12$Rv/Dq0KmTWL86QZJ5hNhmOk161f7Mj61HpFc7ELd3XAOL6hVkiXFC', NULL, '2026-08-29 19:26:19', '2026-08-29 22:58:53'),
(16, 'UCSPL-1021', 'Tun Tun', 3, 'Male', '13/LaLaN(N) 123456', '2003-08-04', '09890839519', 'Taungyi', '/images/profiles/1788092452.jpg', 'tuntun@gmail.com', '$2y$12$Q4RbTjlBVn4lgcH21AFPwO.di0xG8hMDkYIcOUq3faNu0MPxotdGq', NULL, '2026-08-30 05:50:52', '2026-08-30 06:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `student_records`
--

CREATE TABLE `student_records` (
  `record_id` bigint(20) UNSIGNED NOT NULL,
  `academic_year_id` bigint(20) UNSIGNED NOT NULL,
  `year_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_records`
--

INSERT INTO `student_records` (`record_id`, `academic_year_id`, `year_id`, `student_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 2, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(2, 2, 4, 5, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(3, 7, 1, 4, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(4, 9, 2, 4, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(5, 5, 4, 6, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(6, 7, 3, 10, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(7, 3, 5, 7, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(8, 7, 5, 7, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(9, 4, 1, 1, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(10, 9, 2, 10, NULL, '2026-08-26 09:46:41', '2026-08-26 09:46:41'),
(11, 6, 4, 11, NULL, '2026-08-26 09:55:47', '2026-08-26 09:55:47'),
(12, 6, 4, 12, NULL, '2026-08-28 04:56:20', '2026-08-28 04:56:20'),
(13, 6, 5, 13, NULL, '2026-08-28 22:41:35', '2026-08-28 22:41:35'),
(14, 2, 5, 14, NULL, '2026-08-29 09:05:00', '2026-08-29 09:05:00'),
(15, 4, 5, 15, NULL, '2026-08-29 19:27:17', '2026-08-29 19:27:17'),
(16, 12, 5, 16, NULL, '2026-08-30 07:09:13', '2026-08-30 07:27:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Myles Pfannerstill', 'gerhard05@example.com', '2026-08-26 09:46:40', '$2y$12$8YcTiGtwBdPoMnf8l1.nsu9/6Pm3fdLY4lnjswyU2TVgvk1emMRlu', 'DRVE75e6qO', '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(2, 'Krista Abernathy', 'dmurray@example.org', '2026-08-26 09:46:40', '$2y$12$8YcTiGtwBdPoMnf8l1.nsu9/6Pm3fdLY4lnjswyU2TVgvk1emMRlu', 'KhOU8GQFHE', '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(3, 'Michele Denesik', 'ike62@example.net', '2026-08-26 09:46:40', '$2y$12$8YcTiGtwBdPoMnf8l1.nsu9/6Pm3fdLY4lnjswyU2TVgvk1emMRlu', 'YILqq2vSyf', '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(4, 'Kory Friesen MD', 'chelsie.schaefer@example.net', '2026-08-26 09:46:40', '$2y$12$8YcTiGtwBdPoMnf8l1.nsu9/6Pm3fdLY4lnjswyU2TVgvk1emMRlu', 'HOipNYXpt8', '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(5, 'Leilani VonRueden', 'rickey.smith@example.com', '2026-08-26 09:46:40', '$2y$12$8YcTiGtwBdPoMnf8l1.nsu9/6Pm3fdLY4lnjswyU2TVgvk1emMRlu', 'h80RodM8FM', '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(6, 'Jessy Emmerich', 'iwisoky@example.net', '2026-08-26 09:46:40', '$2y$12$8YcTiGtwBdPoMnf8l1.nsu9/6Pm3fdLY4lnjswyU2TVgvk1emMRlu', 'klaz3G5pbn', '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(7, 'Dr. Kian Lowe IV', 'chill@example.com', '2026-08-26 09:46:40', '$2y$12$8YcTiGtwBdPoMnf8l1.nsu9/6Pm3fdLY4lnjswyU2TVgvk1emMRlu', 'QnWautpmGm', '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(8, 'Devan Stiedemann PhD', 'wmacejkovic@example.org', '2026-08-26 09:46:40', '$2y$12$8YcTiGtwBdPoMnf8l1.nsu9/6Pm3fdLY4lnjswyU2TVgvk1emMRlu', 'pwa6mm2uLM', '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(9, 'Beth Champlin III', 'xschneider@example.org', '2026-08-26 09:46:40', '$2y$12$8YcTiGtwBdPoMnf8l1.nsu9/6Pm3fdLY4lnjswyU2TVgvk1emMRlu', 'T8oTJDEUzQ', '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(10, 'Reba Macejkovic', 'ibatz@example.net', '2026-08-26 09:46:40', '$2y$12$8YcTiGtwBdPoMnf8l1.nsu9/6Pm3fdLY4lnjswyU2TVgvk1emMRlu', 'qW4alONwcI', '2026-08-26 09:46:40', '2026-08-26 09:46:40');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `year_id` bigint(20) UNSIGNED NOT NULL,
  `year_name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`year_id`, `year_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'First Year', NULL, '2026-08-26 09:46:40', '2026-08-26 09:54:37'),
(2, 'Second Year', NULL, '2026-08-26 09:46:40', '2026-08-26 09:46:40'),
(3, 'Third Year', NULL, '2026-08-26 09:46:40', '2026-08-26 09:54:47'),
(4, 'Fourth Year', NULL, '2026-08-26 09:46:40', '2026-08-26 09:54:58'),
(5, 'Final Year', NULL, '2026-08-26 09:46:40', '2026-08-26 09:55:07'),
(6, 'Six Year', NULL, '2026-08-30 05:04:37', '2026-08-30 05:08:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`academic_year_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hostels`
--
ALTER TABLE `hostels`
  ADD PRIMARY KEY (`hostel_id`);

--
-- Indexes for table `hostel_allocations`
--
ALTER TABLE `hostel_allocations`
  ADD PRIMARY KEY (`allocation_id`),
  ADD KEY `hostel_allocations_payment_id_foreign` (`payment_id`),
  ADD KEY `hostel_allocations_room_id_foreign` (`room_id`);

--
-- Indexes for table `hostel_applications`
--
ALTER TABLE `hostel_applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `hostel_applications_record_id_foreign` (`record_id`),
  ADD KEY `hostel_applications_hostel_id_foreign` (`hostel_id`);

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
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`major_id`);

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
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payments_application_id_foreign` (`application_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `rooms_hostel_id_foreign` (`hostel_id`);

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
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `students_roll_no_unique` (`roll_no`),
  ADD KEY `students_major_id_foreign` (`major_id`);

--
-- Indexes for table `student_records`
--
ALTER TABLE `student_records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `student_records_academic_year_id_foreign` (`academic_year_id`),
  ADD KEY `student_records_year_id_foreign` (`year_id`),
  ADD KEY `student_records_student_id_foreign` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`year_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `academic_year_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostels`
--
ALTER TABLE `hostels`
  MODIFY `hostel_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hostel_allocations`
--
ALTER TABLE `hostel_allocations`
  MODIFY `allocation_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `hostel_applications`
--
ALTER TABLE `hostel_applications`
  MODIFY `application_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `major_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `student_records`
--
ALTER TABLE `student_records`
  MODIFY `record_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `year_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hostel_allocations`
--
ALTER TABLE `hostel_allocations`
  ADD CONSTRAINT `hostel_allocations_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hostel_allocations_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE;

--
-- Constraints for table `hostel_applications`
--
ALTER TABLE `hostel_applications`
  ADD CONSTRAINT `hostel_applications_hostel_id_foreign` FOREIGN KEY (`hostel_id`) REFERENCES `hostels` (`hostel_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hostel_applications_record_id_foreign` FOREIGN KEY (`record_id`) REFERENCES `student_records` (`record_id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `hostel_applications` (`application_id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_hostel_id_foreign` FOREIGN KEY (`hostel_id`) REFERENCES `hostels` (`hostel_id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_major_id_foreign` FOREIGN KEY (`major_id`) REFERENCES `majors` (`major_id`) ON DELETE CASCADE;

--
-- Constraints for table `student_records`
--
ALTER TABLE `student_records`
  ADD CONSTRAINT `student_records_academic_year_id_foreign` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`academic_year_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_records_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_records_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`year_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
