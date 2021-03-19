-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 13, 2020 at 07:29 AM
-- Server version: 10.2.34-MariaDB-log-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dikertas_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_activity`
--

CREATE TABLE `data_activity` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `course_id` varchar(10) COLLATE utf8mb4_swedish_ci NOT NULL,
  `description` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `start_date` bigint(20) NOT NULL,
  `end_date` bigint(20) NOT NULL,
  `faculty` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL,
  `major` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL,
  `class` varchar(10) COLLATE utf8mb4_swedish_ci NOT NULL,
  `teacher_id` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL,
  `display` int(11) NOT NULL,
  `register_date` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `data_activity`
--

INSERT INTO `data_activity` (`id`, `title`, `course_id`, `description`, `start_date`, `end_date`, `faculty`, `major`, `class`, `teacher_id`, `display`, `register_date`) VALUES
(19, 'Perkuliahan Grafik Komputer 2020/2021', 'AK-045205', '<p><a href=\"https://id.wikipedia.org/wiki/Grafika_komputer\" target=\"_blank\" rel=\"noopener noreferrer\">Grafika komputer</a> (bahasa Inggris: computer graphics) adalah bagian dari ilmu komputer yang berkaitan dengan pembuatan dan manipulasi gambar (visual) secara digital. Bentuk sederhana dari grafika komputer adalah grafika komputer 2D yang kemudian berkembang menjadi grafika komputer 3D, pemrosesan citra (image processing), dan pengenalan pola (pattern recognition). Grafika komputer sering dikenal juga dengan istilah visualisasi data.</p>', 1593536402, 1602694799, 'FTI', 'IA', '2IA02', '7182175689', 1, 1594725679);

-- --------------------------------------------------------

--
-- Table structure for table `data_answer`
--

CREATE TABLE `data_answer` (
  `id` int(11) NOT NULL,
  `question` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `question_type` int(11) NOT NULL,
  `answer` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `true_answer` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `my_answer` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `score` int(11) NOT NULL,
  `file_list` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `attach_form` int(11) NOT NULL,
  `chance` int(11) NOT NULL,
  `cluster_id` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  `attempt_id` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL,
  `mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `data_answer`
--

INSERT INTO `data_answer` (`id`, `question`, `question_type`, `answer`, `true_answer`, `my_answer`, `score`, `file_list`, `attach_form`, `chance`, `cluster_id`, `student_id`, `attempt_id`, `note`, `status`, `mark`) VALUES
(110, '[\"Shortcut Untuk mengcopy object\",\"Shorcut Untuk Paste Object\",\"Shorcut Untuk memotong object\",\"Shorcut Untuk Keluat dari program\"]', 2, '[\"Ctrl c\",\"Ctrl v\",\"Ctrl x\",\"Ctrl w\"]', '[\"Ctrl c\",\"Ctrl v\",\"Ctrl x\",\"Ctrl w\"]', 'data-1,data-4,data-3,data-4', 3, '', 0, 0, '7182175689-1594726561', 56417324, 0, '', 0, 0),
(111, '<p>Software Pengolah gambar yang mendukung berbagai proses editing adalah</p>', 0, '[\"Adobe Photoshop\",\"Sublime\",\"React JS\",\"Timeviewer\"]', '[\"Adobe Photoshop\"]', '1', 1, '', 0, 0, '7182175689-1594726561', 56417324, 0, '', 0, 0),
(112, '<p><iframe src=\"https://www.youtube.com/embed/yw10ohidGGI\" width=\"100%\" height=\"420\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\"></iframe></p>\r\n<p>Dari video tersebut, berikan pendapat anda mengenai proses pembuatan film iron man yang dapat berguna bagi pekermbangan perfileman di indonesia</p>', 1, '', '', '<p>Iron Man (Anthony Edward \"Tony\" Stark) adalah pahlawan super fiksi yang muncul dalam buku komik Amerika yang diterbitkan oleh Marvel Comics, serta media yang terkait. Karakter diciptakan oleh penulis dan editor Stan Lee, yang dikembangkan oleh penulis skenario Larry Lieber, dan dirancang oleh seniman Don Heck dan Jack Kirby. Dia membuat penampilan pertamanya di Tales of Suspense #39 (cover tertanggal bulan Maret 1963).</p>\r\n<p>Sepanjang sebagian besar sejarah publikasi karakter, Iron Man telah menjadi anggota pendiri tim superhero Avengers dan telah tampil dalam beberapa inkarnasi dari berbagai seri buku komik sendiri. Iron Man telah diadaptasi untuk beberapa acara TV animasi dan film. Karakter ini diperankan oleh Robert Downey Jr. dalam hidup film aksi Iron Man (2008), yang merupakan box office. Downey, yang menerima banyak pujian untuk penampilannya, mengulangi peran dalam cameo di The Incredible Hulk (2008), dua sekuel Iron Man Iron Man 2 (2010) dan Iron Man 3 (2013), The Avengers (2012), Avengers: Age of Ultron (2015), dan Captain America: Civil War (2016), dan akan melakukannya lagi di Spider-Man: Homecoming (2017) serta Avengers: Infinity War (2018) dan sekuelnya Avengers: Endgame (2019) di Marvel Cinematic Universe.</p>', 1, '/Bukti Sumber.pdf', 1, 0, '7182175689-1594726561', 56417324, 0, '<p>Ga boleh kopas gan</p>', 0, 0),
(113, '<p>Istilah Grafik Komputer ditemukan pada tahun</p>', 0, '[\"1961\",\"1951\",\"1950\",\"1960\"]', '[\"1950\"]', '2', 0, '', 0, 0, '7182175689-1594726132', 56417324, 0, '', 0, 0),
(114, '<p>Istilah Grafik Komputer ditemukan oleh</p>', 0, '[\"Robert William\",\"Fetter Willian\",\"Robert Fetter\",\"William Fetter\"]', '[\"William Fetter\"]', '2', 0, '', 0, 0, '7182175689-1594726132', 56417324, 0, '', 0, 0),
(115, '<p>Komponen Dasar Sistem Grafik Interaktif adalah</p>', 0, '[\"Output\",\"Input\",\"Proses dan Penyimpanan\",\"Benar Semua\"]', '[\"Benar Semua\"]', '4', 1, '', 0, 0, '7182175689-1594726132', 56417324, 0, '', 0, 0),
(116, '<p>suatu proses pembuatan, penyimpanan dan manipulasi model dan citra disebut dengan</p>', 0, '[\"Sistem Informasi\",\"Grafik Komputer\",\"Grafik Informasi\",\"Sistem Komputer\"]', '[\"Grafik Komputer\"]', '3', 0, '', 0, 0, '7182175689-1594726132', 56417324, 0, '', 0, 0),
(117, '<p>Sistem Interaktif Pertama ditemukan oleh</p>', 0, '[\"Ivan Sutherland\",\"Ivan William\",\"Robert William\",\"William Fetter\"]', '[\"Ivan William\"]', '3', 0, '', 0, 0, '7182175689-1594726132', 56417324, 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_attempt`
--

CREATE TABLE `data_attempt` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `attempt` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `start_date` bigint(20) NOT NULL,
  `finish_date` bigint(20) NOT NULL,
  `submit_time` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `data_attempt`
--

INSERT INTO `data_attempt` (`id`, `student_id`, `quiz_id`, `status`, `attempt`, `grade`, `start_date`, `finish_date`, `submit_time`) VALUES
(40, 56417324, 26, 1, 1, 83, 1594726669, 1594730269, 1594726804),
(41, 56417324, 25, 1, 1, 20, 1596987429, 1598720340, 1596987490);

-- --------------------------------------------------------

--
-- Table structure for table `data_course`
--

CREATE TABLE `data_course` (
  `kdmk` varchar(10) COLLATE utf8mb4_swedish_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `sks` int(2) NOT NULL,
  `register_date` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `data_course`
--

INSERT INTO `data_course` (`kdmk`, `title`, `sks`, `register_date`) VALUES
('AK-045205', 'Grafik Komputer 1 **', 2, 1591725943),
('AK-045218', 'Pengantar Kecerdasan Buatan **', 2, 1591725943),
('AK-045231', 'Sistem Informasi */**', 2, 1591725943),
('AK-045308', 'Jaringan Komputer */**', 3, 1591725943),
('AK-045325', 'Perancangan dan Analisis Algoritma **', 3, 1591725943),
('AK-045329', 'Sistem Basis Data 1 **', 3, 1591725943),
('AK-045333', 'Sistem Operasi */**', 3, 1591725943),
('PHP', 'Bahasa PHP', 1, 1605281320);

-- --------------------------------------------------------

--
-- Table structure for table `data_faculty`
--

CREATE TABLE `data_faculty` (
  `idf` varchar(10) COLLATE utf8mb4_swedish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `degree` varchar(4) COLLATE utf8mb4_swedish_ci NOT NULL,
  `register_date` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `data_faculty`
--

INSERT INTO `data_faculty` (`idf`, `name`, `degree`, `register_date`) VALUES
('FE', 'Fakultas Ekonomi', 'S1', 1591725943),
('FIKTI', 'Fakultas Ilmu Komputer dan Teknologi Informasi', 'S1', 1591725943),
('FK', 'Fakultas Kedokteran', 'S1', 1592667507),
('FPSI', 'Fakultas Psikologi', 'S1', 1591725943),
('FS', 'Fakultas Sastra', 'S1', 1591725943),
('FTI', 'Fakultas Teknologi Industri', 'S1', 1591725943),
('FTSP', 'Fakultas Teknik Sipil dan Perencanaan', 'S1', 1591725943);

-- --------------------------------------------------------

--
-- Table structure for table `data_major`
--

CREATE TABLE `data_major` (
  `idm` varchar(10) COLLATE utf8mb4_swedish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `faculty_id` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL,
  `register_date` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `data_major`
--

INSERT INTO `data_major` (`idm`, `name`, `faculty_id`, `register_date`) VALUES
('DG', 'Dokter Gigi', 'FK', 1592667544),
('DH', 'Dokter Hewan', 'FK', 1592667531),
('DU', 'Dokter Umum', 'FK', 1592667518),
('EA', 'Manajemen', 'FE', 1591725943),
('EB', 'Akuntansi', 'FE', 1591725943),
('IA', 'Teknik Informatika', 'FTI', 1591725943),
('IB', 'Teknik Elektro', 'FTI', 1591725943),
('IC', 'Teknik Mesin', 'FTI', 1591725943),
('ID', 'Teknik Industri', 'FTI', 1591725943),
('KA', 'Sistem Informasi', 'FIKTI', 1591725943),
('KB', 'Sistem Komputer', 'FIKTI', 1591725943),
('PA', 'Ilmu Psikologi', 'FPSI', 1591725943),
('SA', 'Sastra Inggris', 'FS', 1591725943),
('TA', 'Teknik Sipil', 'FTSP', 1591725943),
('TB', 'Teknik Arsitektur', 'FTSP', 1591725943);

-- --------------------------------------------------------

--
-- Table structure for table `data_question`
--

CREATE TABLE `data_question` (
  `id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_swedish_ci NOT NULL,
  `start_time` bigint(20) NOT NULL,
  `end_time` bigint(20) NOT NULL,
  `time_limit` int(11) NOT NULL,
  `show_correct_answer` int(20) NOT NULL,
  `show_grade_result` int(20) NOT NULL,
  `display` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `register_date` bigint(20) NOT NULL,
  `cluster` text COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `data_question`
--

INSERT INTO `data_question` (`id`, `title`, `start_time`, `end_time`, `time_limit`, `show_correct_answer`, `show_grade_result`, `display`, `topic_id`, `register_date`, `cluster`) VALUES
(25, 'Kuis 1', 1593561600, 1598720340, 0, 1, 1, 0, 15, 1596986861, '7182175689-1594726132'),
(26, 'Kuis 2', 1593583200, 1598594400, 60, 1, 1, 0, 16, 1596986872, '7182175689-1594726561');

-- --------------------------------------------------------

--
-- Table structure for table `data_question_list`
--

CREATE TABLE `data_question_list` (
  `id` int(11) NOT NULL,
  `question` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `question_type` int(11) NOT NULL,
  `answer` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `true_answer` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `attach_form` int(11) NOT NULL,
  `chance` int(11) NOT NULL,
  `cluster_id` text COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `data_question_list`
--

INSERT INTO `data_question_list` (`id`, `question`, `question_type`, `answer`, `true_answer`, `attach_form`, `chance`, `cluster_id`) VALUES
(72, '<p>Istilah Grafik Komputer ditemukan oleh</p>', 0, '[\"Robert William\",\"Fetter Willian\",\"Robert Fetter\",\"William Fetter\"]', '[\"William Fetter\"]', 0, 0, '7182175689-1594726132'),
(73, '<p>Komponen Dasar Sistem Grafik Interaktif adalah</p>', 0, '[\"Output\",\"Input\",\"Proses dan Penyimpanan\",\"Benar Semua\"]', '[\"Benar Semua\"]', 0, 0, '7182175689-1594726132'),
(74, '<p>suatu proses pembuatan, penyimpanan dan manipulasi model dan citra disebut dengan</p>', 0, '[\"Sistem Informasi\",\"Grafik Komputer\",\"Grafik Informasi\",\"Sistem Komputer\"]', '[\"Grafik Komputer\"]', 0, 0, '7182175689-1594726132'),
(75, '<p>Sistem Interaktif Pertama ditemukan oleh</p>', 0, '[\"Ivan Sutherland\",\"Ivan William\",\"Robert William\",\"William Fetter\"]', '[\"Ivan William\"]', 0, 0, '7182175689-1594726132'),
(76, '<p>Istilah Grafik Komputer ditemukan pada tahun</p>', 0, '[\"1961\",\"1951\",\"1950\",\"1960\"]', '[\"1950\"]', 0, 0, '7182175689-1594726132'),
(77, '<p>Software Pengolah gambar yang mendukung berbagai proses editing adalah</p>', 0, '[\"Adobe Photoshop\",\"Sublime\",\"React JS\",\"Timeviewer\"]', '[\"Adobe Photoshop\"]', 0, 0, '7182175689-1594726561'),
(78, '<p><iframe src=\"https://www.youtube.com/embed/yw10ohidGGI\" width=\"100%\" height=\"420\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\"></iframe></p>\r\n<p>Dari video tersebut, berikan pendapat anda mengenai proses pembuatan film iron man yang dapat berguna bagi pekermbangan perfileman di indonesia</p>', 1, '', '', 1, 0, '7182175689-1594726561'),
(79, '[\"Shortcut Untuk mengcopy object\",\"Shorcut Untuk Paste Object\",\"Shorcut Untuk memotong object\",\"Shorcut Untuk Keluat dari program\"]', 2, '[\"Ctrl c\",\"Ctrl v\",\"Ctrl x\",\"Ctrl w\"]', '[\"Ctrl c\",\"Ctrl v\",\"Ctrl x\",\"Ctrl w\"]', 0, 0, '7182175689-1594726561');

-- --------------------------------------------------------

--
-- Table structure for table `data_religion`
--

CREATE TABLE `data_religion` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `data_religion`
--

INSERT INTO `data_religion` (`id`, `name`) VALUES
(1, 'Islam'),
(2, 'Kristen Protest'),
(3, 'Kristen Katolik'),
(4, 'Hindu'),
(5, 'Buddha'),
(6, 'Khonghucu'),
(7, 'Percaya Kepada Tuhan Y.M.E');

-- --------------------------------------------------------

--
-- Table structure for table `data_setting`
--

CREATE TABLE `data_setting` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `conf` text COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `data_setting`
--

INSERT INTO `data_setting` (`id`, `title`, `conf`) VALUES
(1, 'favicon', 'favicon.png'),
(2, 'logo', 'logo-white.png'),
(4, 'institution_name', 'University'),
(5, 'address', 'Jl. Margonda Raya Pondok Cina, Depok'),
(10, 'phone', '7863819'),
(11, 'email_server', 'uuniversitas@gunadarma.ac.id'),
(12, 'smtp_host', 'smtp.university.ac.id'),
(13, 'smtp_username', 'admin@university.ac.id'),
(14, 'smtp_password', 'gunadarma'),
(15, 'smtp_port', '587'),
(16, 'login_status', '1'),
(17, 'logo_full_color', '1593224998.png');

-- --------------------------------------------------------

--
-- Table structure for table `data_student`
--

CREATE TABLE `data_student` (
  `nim` int(10) NOT NULL,
  `first_name` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `gender` int(11) NOT NULL,
  `birth_day` bigint(20) NOT NULL,
  `birth_place` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL,
  `religion` int(2) NOT NULL,
  `address` varchar(150) COLLATE utf8mb4_swedish_ci NOT NULL,
  `district` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `village` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `province` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `postal_code` int(5) NOT NULL,
  `phone` varchar(13) COLLATE utf8mb4_swedish_ci NOT NULL,
  `class` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
  `faculty` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL,
  `major` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL,
  `active_course` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `register_date` bigint(20) NOT NULL,
  `online` bigint(20) NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_swedish_ci NOT NULL,
  `password` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `profile_pict` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `display` int(11) NOT NULL,
  `account_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `data_student`
--

INSERT INTO `data_student` (`nim`, `first_name`, `last_name`, `gender`, `birth_day`, `birth_place`, `religion`, `address`, `district`, `village`, `province`, `postal_code`, `phone`, `class`, `faculty`, `major`, `active_course`, `register_date`, `online`, `email`, `password`, `profile_pict`, `display`, `account_status`) VALUES
(56417324, 'Kato', 'Megumi', 0, 916160400, 'Tokyo', 7, 'Jl. HR. Rasuna Said Menteng', 'Jakarta Pusat', 'Menteng', 'DKI Jakarta', 10320, '082110976556', '2{major}02', 'FTI', 'IA', 'AK-045205,AK-045218,AK-045231,AK-045308,AK-045325,AK-045329,AK-045333', 1593604803, 1597025897, 'yudharomadhoen@gmail.com', '453bbddfa16f5b619c08044e0f371e8b', '1593604803.jpeg', 1, 1),
(56417894, 'Charllote 123123', 'Vins', 1, 838746000, '13', 3, 'Jl. Pegangsaan TImur No 56 Jakarta', 'Jakarta Pusat', 'Menteng', 'DKI Jakarta', 10320, '087545698521', '3{major}10', 'FK', 'DG', 'AK-045333,IT-045233', 1594344877, 1594344877, 'charllotte@gmail.com', '25f9e794323b453885f5181f1b624d0b', '1594344877.jpeg', 0, 0),
(56712458, 'Titus', 'Alexandria', 1, 677350800, 'Rhoma', 3, 'Komplek Pejaten Elok Blok B3 Pejaten Barat', 'Jakarta Selatan', 'Pasar Minggu', 'DKI Jakarta', 12540, '082298538212', '2{major}02', 'FTI', 'IA', 'AK-045205', 1593679251, 1593679251, 'pymtechnologi@gmail.com', '25f9e794323b453885f5181f1b624d0b', '1593679251.jpeg', 0, 1),
(2147483647, 'Geadalfa', 'Giyanda', 1, 931885200, 'Jember', 3, 'Jl Mewarna Masa Depan Dunia', 'Jembrana', 'Denpasar Timur', 'Bali', 80119, '082256478912', '2{major}02', 'FE', 'DG', 'AK-045205,AK-045218,AK-045231', 1594662990, 1594662990, 'geadalfa@gmail.com', '25f9e794323b453885f5181f1b624d0b', '1594662990.jpeg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_teacher`
--

CREATE TABLE `data_teacher` (
  `nidn` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL,
  `first_name` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `gender` int(11) NOT NULL,
  `birth_place` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL,
  `birth_day` bigint(20) NOT NULL,
  `religion` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL,
  `address` varchar(150) COLLATE utf8mb4_swedish_ci NOT NULL,
  `district` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `village` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `province` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `postal_code` int(5) NOT NULL,
  `phone` varchar(13) COLLATE utf8mb4_swedish_ci NOT NULL,
  `active_course` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `register_date` bigint(20) NOT NULL,
  `online` bigint(20) NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_swedish_ci NOT NULL,
  `password` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `profile_pict` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `level` int(11) NOT NULL,
  `display` int(11) NOT NULL,
  `account_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `data_teacher`
--

INSERT INTO `data_teacher` (`nidn`, `first_name`, `last_name`, `gender`, `birth_place`, `birth_day`, `religion`, `address`, `district`, `village`, `province`, `postal_code`, `phone`, `active_course`, `register_date`, `online`, `email`, `password`, `profile_pict`, `level`, `display`, `account_status`) VALUES
('7182175689', 'Yudha', 'Romadhon', 1, 'Banten', 925837200, '1', 'Jl. Pegangsaan Timur No 56 Jakarta', 'Jakarta Pusat', 'Menteng', 'DKI Jakarta', 10330, '082110976556', 'AK-045205,AK-045218,AK-045231,AK-045308,AK-045325,AK-045329,AK-045333', 1593604550, 1605281254, 'steavenroger@gmail.com', 'd7831f1db7dfd1a5250deb29abe2b92a', '1596986819.jpeg', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_topic`
--

CREATE TABLE `data_topic` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `description` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `attach_file` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `attach_forum` int(11) NOT NULL,
  `forum_title` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `quiz` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `display` int(2) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `register_date` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `data_topic`
--

INSERT INTO `data_topic` (`id`, `title`, `description`, `attach_file`, `attach_forum`, `forum_title`, `quiz`, `display`, `activity_id`, `register_date`) VALUES
(1, 'Open GL', '<p>pengganti pertemuan minggu ke 3 ( 16 Mar - 21 Mar 2020 )</p>', 'Materi Open GL.pdf/CATATAN-BELANJA.xlsx', 0, '', '', 1, 7, 1594708631),
(12, 'adasd', '<p>asdasdasd</p>', 'Manual Book_Muhammad Refky_54417186.pdf', 0, '', '', 1, 16, 1594348011),
(13, 'Structure chart', '<p><iframe src=\"https://www.youtube.com/embed/ck4RGeoHFko\" width=\"600\" height=\"400\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\"></iframe></p>\r\n<p>Silahkan DI tonton gan, jangan sange ya</p>', 'Link Dewasa.docx', 0, '', '', 1, 17, 1594700329),
(14, 'pertemuan 69', '<p>ini isi</p>', '', 0, '', '', 1, 7, 1594725257),
(15, 'Pertemuan Ke 1', '<p>pengganti pertemuan minggu ke 3 ( 16 Mar - 21 Mar 2020)</p>', 'Materi Permulaan.pdf', 0, '', '', 1, 19, 1594726154),
(16, 'Pertemuan Ke 2', '<p>vclass-2 pengganti minggu ke 4 (23 Mar - 28 Mar 2020)</p>', '', 0, '', '', 1, 19, 1594726245);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_activity`
--
ALTER TABLE `data_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_answer`
--
ALTER TABLE `data_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_attempt`
--
ALTER TABLE `data_attempt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_course`
--
ALTER TABLE `data_course`
  ADD PRIMARY KEY (`kdmk`);

--
-- Indexes for table `data_faculty`
--
ALTER TABLE `data_faculty`
  ADD PRIMARY KEY (`idf`);

--
-- Indexes for table `data_major`
--
ALTER TABLE `data_major`
  ADD PRIMARY KEY (`idm`);

--
-- Indexes for table `data_question`
--
ALTER TABLE `data_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_question_list`
--
ALTER TABLE `data_question_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_religion`
--
ALTER TABLE `data_religion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_setting`
--
ALTER TABLE `data_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_student`
--
ALTER TABLE `data_student`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `data_teacher`
--
ALTER TABLE `data_teacher`
  ADD PRIMARY KEY (`nidn`);

--
-- Indexes for table `data_topic`
--
ALTER TABLE `data_topic`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_activity`
--
ALTER TABLE `data_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `data_answer`
--
ALTER TABLE `data_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `data_attempt`
--
ALTER TABLE `data_attempt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `data_question`
--
ALTER TABLE `data_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `data_question_list`
--
ALTER TABLE `data_question_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `data_religion`
--
ALTER TABLE `data_religion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_setting`
--
ALTER TABLE `data_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `data_topic`
--
ALTER TABLE `data_topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
