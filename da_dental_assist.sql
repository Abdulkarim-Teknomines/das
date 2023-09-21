-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 21, 2023 at 06:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `da_dental_assist`
--

-- --------------------------------------------------------

--
-- Table structure for table `da_appointments`
--

CREATE TABLE `da_appointments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(255) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `clinic_user_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_appointments`
--

INSERT INTO `da_appointments` (`id`, `patient_id`, `appointment_date`, `appointment_time`, `doctor_id`, `clinic_user_id`, `clinic_id`, `created_at`, `updated_at`) VALUES
(5, 1, '2023-08-16', '12:05', 2, 1, 0, '2023-08-25 12:05:15', '2023-08-25 12:05:15'),
(6, 1, '2023-09-25', '12:05', 2, 1, 0, '2023-08-25 12:05:15', '2023-08-25 12:05:15'),
(7, 1, '2023-09-25', '12:05', 2, 1, 0, '2023-08-25 12:05:15', '2023-08-25 12:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `da_categories`
--

CREATE TABLE `da_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_categories`
--

INSERT INTO `da_categories` (`id`, `category_name`) VALUES
(1, 'Restorative'),
(2, 'Endodontics'),
(3, 'Peridontics'),
(4, 'Oral Srgery'),
(5, 'Oral Medicine'),
(6, 'Orthodontics'),
(7, 'Pedodontics'),
(8, 'Prosthodontics');

-- --------------------------------------------------------

--
-- Table structure for table `da_class_category`
--

CREATE TABLE `da_class_category` (
  `id` int(11) NOT NULL,
  `clinical_examinator_category_id` int(11) NOT NULL,
  `top_left` varchar(255) NOT NULL,
  `top_right` varchar(255) NOT NULL,
  `bottom_left` varchar(255) NOT NULL,
  `bottom_right` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_class_category`
--

INSERT INTO `da_class_category` (`id`, `clinical_examinator_category_id`, `top_left`, `top_right`, `bottom_left`, `bottom_right`) VALUES
(1, 1, '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8', '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8'),
(2, 2, '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8', '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8'),
(3, 3, '3,2,1', '1,2,3', '3,2,1', '1,2,3'),
(4, 4, '3,2,1', '1,2,3', '3,2,1', '1,2,3'),
(5, 5, '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8', '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8');

-- --------------------------------------------------------

--
-- Table structure for table `da_clinic`
--

CREATE TABLE `da_clinic` (
  `id` int(11) NOT NULL,
  `clinic_name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `landline_number` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `appointment_number` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=active 1=inactive',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_clinic`
--

INSERT INTO `da_clinic` (`id`, `clinic_name`, `logo`, `address`, `email`, `landline_number`, `mobile_number`, `appointment_number`, `website`, `payment`, `qr_code`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'clinic 1', '9117_1692767148Screenshot_from_2023-03-30_12-28-38.png', 'address', 'email@gmail.com', '8460555555', '8460555555', '12345', 'kaslfk', 'afsldkf', '8722_1692767148pexels-yurii-hlei-1545743.jpg', '0', '2023-08-23 10:35:48', '2023-08-23 10:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `da_clinical_examinator_category`
--

CREATE TABLE `da_clinical_examinator_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_clinical_examinator_category`
--

INSERT INTO `da_clinical_examinator_category` (`id`, `category_name`) VALUES
(1, 'Class - I'),
(2, 'Class - II'),
(3, 'Class - III'),
(4, 'Class - IV'),
(5, 'Class - V'),
(6, 'Deep caries'),
(7, 'Generalised discoloration / discoloration in relation to'),
(8, 'Midline diastema / spacing between'),
(9, 'Fractured amalgam/glass ionomer / composite restoration'),
(10, 'Secondary caries'),
(11, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `da_clinic_user`
--

CREATE TABLE `da_clinic_user` (
  `id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_clinic_user`
--

INSERT INTO `da_clinic_user` (`id`, `clinic_id`, `user_id`, `password`, `u_password`, `full_name`, `mobile_number`, `address`, `email_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 0, 'superadmin', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'vinodh', '8460535348', 'address', 'vinodh@mailinator.com', 1, '2023-08-23 10:32:43', '2023-08-23 10:32:43'),
(2, 1, 'clinic 1', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'doctor', '8460535353', 'address', 'abdulkarim@mailinator.com', 3, '2023-08-23 10:37:14', '2023-08-23 10:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `da_deep_caries_category`
--

CREATE TABLE `da_deep_caries_category` (
  `id` int(11) NOT NULL,
  `clinical_examinator_category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_deep_caries_category`
--

INSERT INTO `da_deep_caries_category` (`id`, `clinical_examinator_category_id`, `category_name`) VALUES
(1, 6, 'Class - I'),
(2, 6, 'Class - II');

-- --------------------------------------------------------

--
-- Table structure for table `da_deep_caries_class_category`
--

CREATE TABLE `da_deep_caries_class_category` (
  `id` int(11) NOT NULL,
  `deep_caries_category_id` int(11) NOT NULL,
  `top_left` varchar(255) NOT NULL,
  `top_right` varchar(255) NOT NULL,
  `bottom_left` varchar(255) NOT NULL,
  `bottom_right` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_deep_caries_class_category`
--

INSERT INTO `da_deep_caries_class_category` (`id`, `deep_caries_category_id`, `top_left`, `top_right`, `bottom_left`, `bottom_right`) VALUES
(1, 1, '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8', '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8'),
(2, 2, '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8', '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8');

-- --------------------------------------------------------

--
-- Table structure for table `da_dental_history_category`
--

CREATE TABLE `da_dental_history_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_dental_history_category`
--

INSERT INTO `da_dental_history_category` (`id`, `category_name`) VALUES
(1, 'No relavant history'),
(2, 'Post extraction bleeding'),
(3, 'Delayed post extraction healing'),
(4, 'History of syncope'),
(5, 'History of fits'),
(6, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `da_diagnosis_cagegory_class`
--

CREATE TABLE `da_diagnosis_cagegory_class` (
  `id` int(11) NOT NULL,
  `diagnosis_category_id` int(11) NOT NULL,
  `top_left` varchar(255) NOT NULL,
  `top_right` varchar(255) NOT NULL,
  `bottom_left` varchar(255) NOT NULL,
  `bottom_right` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_diagnosis_cagegory_class`
--

INSERT INTO `da_diagnosis_cagegory_class` (`id`, `diagnosis_category_id`, `top_left`, `top_right`, `bottom_left`, `bottom_right`) VALUES
(1, 3, '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8', '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8');

-- --------------------------------------------------------

--
-- Table structure for table `da_diagnosis_categories`
--

CREATE TABLE `da_diagnosis_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_diagnosis_categories`
--

INSERT INTO `da_diagnosis_categories` (`id`, `category_name`) VALUES
(1, 'Caries on / classI/II/IV/ V/ VI /cavity on'),
(2, 'Cervical abrasion/Class V caries on Tooth'),
(3, 'Deep caries with out pulp exposure'),
(4, 'Previously restored'),
(5, 'Discolored upper arch/ lower arch / both'),
(6, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `da_diagnosis_sub_categories`
--

CREATE TABLE `da_diagnosis_sub_categories` (
  `id` int(11) NOT NULL,
  `diagnosis_category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_diagnosis_sub_categories`
--

INSERT INTO `da_diagnosis_sub_categories` (`id`, `diagnosis_category_id`, `category_name`) VALUES
(1, 1, 'incipient'),
(2, 1, 'Enamel'),
(3, 1, 'Dentin'),
(4, 2, 'Class - V'),
(5, 5, 'Upper Arch'),
(6, 5, 'Lower Arch'),
(7, 5, 'Both');

-- --------------------------------------------------------

--
-- Table structure for table `da_diagnosis_sub_categories_class`
--

CREATE TABLE `da_diagnosis_sub_categories_class` (
  `id` int(11) NOT NULL,
  `diagnosis_sub_category_id` int(11) NOT NULL,
  `top_left` varchar(255) NOT NULL,
  `top_right` varchar(255) NOT NULL,
  `bottom_left` varchar(255) NOT NULL,
  `bottom_right` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_diagnosis_sub_categories_class`
--

INSERT INTO `da_diagnosis_sub_categories_class` (`id`, `diagnosis_sub_category_id`, `top_left`, `top_right`, `bottom_left`, `bottom_right`) VALUES
(1, 1, '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8', '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8'),
(2, 4, '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8', '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8'),
(3, 5, '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8', '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8'),
(4, 6, '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8', '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8'),
(5, 7, '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8', '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8');

-- --------------------------------------------------------

--
-- Table structure for table `da_education_videos`
--

CREATE TABLE `da_education_videos` (
  `id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `clinic_user_id` int(11) NOT NULL,
  `video_title` varchar(255) NOT NULL,
  `video_description` varchar(255) NOT NULL,
  `video_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_education_videos`
--

INSERT INTO `da_education_videos` (`id`, `clinic_id`, `clinic_user_id`, `video_title`, `video_description`, `video_link`) VALUES
(1, 0, 1, 'adfs', 'asdf', 'https://www.youtube.com/embed/qoMf9ETuirE?si=JCjptbjxrG8wQvFX'),
(2, 0, 1, 'sadf', 'sdf', 'https://www.youtube.com/watch?v=BuCawPXEVmQ'),
(3, 0, 1, 'asdf', 'fds', 'https://www.youtube.com/watch?v=BuCawPXEVmQ'),
(4, 0, 1, 'asdf', 'sdf', 'https://www.youtube.com/watch?v=BuCawPXEVmQ'),
(5, 0, 1, 'asdf', 'sadf', 'https://www.youtube.com/watch?v=BuCawPXEVmQ'),
(6, 0, 1, 'asdf', 'sadf', 'https://www.youtube.com/watch?v=BuCawPXEVmQ'),
(7, 0, 1, 'asdf', 'adsf', 'https://www.youtube.com/watch?v=BuCawPXEVmQ');

-- --------------------------------------------------------

--
-- Table structure for table `da_investigation_blood_examination_sub_categories`
--

CREATE TABLE `da_investigation_blood_examination_sub_categories` (
  `id` int(11) NOT NULL,
  `investigation_blood_examination_blood_sub_category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_investigation_blood_examination_sub_categories`
--

INSERT INTO `da_investigation_blood_examination_sub_categories` (`id`, `investigation_blood_examination_blood_sub_category_id`, `category_name`) VALUES
(1, 10, 'CBC'),
(2, 10, 'TC'),
(3, 10, 'DC'),
(4, 10, 'CSR'),
(5, 10, 'HB'),
(6, 10, 'PLT'),
(7, 10, 'BT'),
(8, 10, 'CT'),
(9, 10, 'INR'),
(10, 11, 'RBS (Sugar)'),
(11, 11, 'FBS'),
(12, 11, 'HBAIC'),
(13, 12, 'HCV'),
(14, 12, 'HBSAG'),
(15, 12, 'HIV'),
(16, 13, 'Albumin'),
(17, 13, 'Sugar'),
(18, 13, 'M/g'),
(19, 13, 'Bile Salt'),
(20, 13, 'Bile Pigment'),
(21, 13, 'Ketone Body');

-- --------------------------------------------------------

--
-- Table structure for table `da_investigation_category`
--

CREATE TABLE `da_investigation_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_investigation_category`
--

INSERT INTO `da_investigation_category` (`id`, `category_name`) VALUES
(1, 'IOPA'),
(2, 'Occlusal Xray'),
(3, 'OPG'),
(4, 'CBCT'),
(5, 'Blood Examination'),
(6, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `da_investigation_cbct_sub_categories`
--

CREATE TABLE `da_investigation_cbct_sub_categories` (
  `id` int(11) NOT NULL,
  `investigation_cbct_category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_investigation_cbct_sub_categories`
--

INSERT INTO `da_investigation_cbct_sub_categories` (`id`, `investigation_cbct_category_id`, `category_name`) VALUES
(1, 4, 'Maxilla'),
(2, 4, 'Mandible'),
(3, 4, 'Both'),
(4, 4, 'Other area'),
(10, 5, 'Blood'),
(11, 5, 'Biochemical'),
(12, 5, 'Serology'),
(13, 5, 'Urine');

-- --------------------------------------------------------

--
-- Table structure for table `da_investigation_iopa_sub_categories`
--

CREATE TABLE `da_investigation_iopa_sub_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `top_left` varchar(255) NOT NULL,
  `top_right` varchar(255) NOT NULL,
  `bottom_left` varchar(255) NOT NULL,
  `bottom_right` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_investigation_iopa_sub_categories`
--

INSERT INTO `da_investigation_iopa_sub_categories` (`id`, `category_id`, `top_left`, `top_right`, `bottom_left`, `bottom_right`) VALUES
(1, 1, '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8', '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8');

-- --------------------------------------------------------

--
-- Table structure for table `da_medical_history_category`
--

CREATE TABLE `da_medical_history_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_medical_history_category`
--

INSERT INTO `da_medical_history_category` (`id`, `category_name`) VALUES
(1, 'No relavant medical history'),
(2, 'Anamia'),
(3, 'Bleeding Disorder'),
(4, 'Cardio Respiratory Disorder'),
(5, 'Drug Treatment and allergies'),
(6, 'Fits and Faints'),
(7, 'Gastrointestinal disorder'),
(8, 'Hospital admission and Surgeries'),
(9, 'Infection'),
(10, 'Jundice'),
(11, 'Kedney diseases'),
(12, 'Medical Conditions in which antibiotic Prophlaxis is needed'),
(13, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `da_medicine`
--

CREATE TABLE `da_medicine` (
  `id` int(11) NOT NULL,
  `clinic_user_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `medicine_type_id` int(11) NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `da_medicine_type`
--

CREATE TABLE `da_medicine_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=active 1=inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_medicine_type`
--

INSERT INTO `da_medicine_type` (`id`, `name`, `is_active`) VALUES
(1, 'Cap', '0'),
(2, 'Tab', '0'),
(3, 'Inj', '0'),
(4, 'Sy', '0');

-- --------------------------------------------------------

--
-- Table structure for table `da_patients`
--

CREATE TABLE `da_patients` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `clinic_user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `whatssapp_no` varchar(255) NOT NULL,
  `blood_group_id` varchar(255) NOT NULL,
  `birth_date` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `patient_problem` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0-active 1=inactive',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_patients`
--

INSERT INTO `da_patients` (`id`, `patient_id`, `clinic_id`, `clinic_user_id`, `first_name`, `last_name`, `email_id`, `mobile_no`, `whatssapp_no`, `blood_group_id`, `birth_date`, `gender`, `address`, `patient_problem`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'DA0000001', 0, 1, 'test', 'test', 'test@gmail.com', '8460535348', '8460535348', 'A +ve', '23-08-2023', 'Other', 'address', 'tooth pain', '0', '2023-08-23 10:33:54', '2023-08-23 10:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `da_patient_categories`
--

CREATE TABLE `da_patient_categories` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_patient_categories`
--

INSERT INTO `da_patient_categories` (`id`, `patient_id`, `category_id`, `sub_category_id`) VALUES
(4, 1, 1, '5,6'),
(5, 1, 3, '29');

-- --------------------------------------------------------

--
-- Table structure for table `da_patient_details`
--

CREATE TABLE `da_patient_details` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_date` varchar(255) NOT NULL,
  `appointment_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_patient_details`
--

INSERT INTO `da_patient_details` (`id`, `patient_id`, `doctor_id`, `appointment_date`, `appointment_time`) VALUES
(2, 1, 2, '02-09-2023', '16:00');

-- --------------------------------------------------------

--
-- Table structure for table `da_role`
--

CREATE TABLE `da_role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=active 1=inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_role`
--

INSERT INTO `da_role` (`id`, `name`, `is_active`) VALUES
(1, 'SuperAdmin', '0'),
(2, 'Adminstrator', '0'),
(3, 'Doctor', '0'),
(4, 'Lab Assistant', '0');

-- --------------------------------------------------------

--
-- Table structure for table `da_sub_categories`
--

CREATE TABLE `da_sub_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_sub_categories`
--

INSERT INTO `da_sub_categories` (`id`, `category_id`, `name`) VALUES
(1, 1, 'Decayed Teeth'),
(2, 1, 'Tooth ache'),
(3, 1, 'Swelling'),
(4, 1, 'Food Impaction'),
(5, 1, 'Fractured tooth/teeth'),
(6, 1, 'Fractured filling/dislodged filling'),
(7, 1, 'Discoloration of tooth'),
(8, 1, 'Spacing of theeth'),
(9, 1, 'Small teeth'),
(10, 1, 'Hypersensitivity of tooth'),
(11, 1, 'Ugly Shaped tooth'),
(12, 1, 'Other'),
(13, 2, 'Decayed Teeth'),
(14, 2, 'Tooth ache'),
(15, 2, 'Swelling'),
(16, 2, 'Food Impaction'),
(17, 2, 'Fractured tooth/teeth'),
(18, 2, 'Fractured filling/dislodged filling'),
(19, 2, 'Discoloration of tooth'),
(20, 2, 'Spacing of theeth'),
(21, 2, 'Small teeth'),
(22, 2, 'Hypersensitivity of tooth'),
(23, 2, 'Ugly Shaped tooth'),
(24, 2, 'Other'),
(25, 3, 'Tooth ache'),
(26, 3, 'Deposits on teeth'),
(27, 3, 'Bed breath'),
(28, 3, 'Food impaction'),
(29, 3, 'Bleeding Gums'),
(30, 3, 'Spacing of teeth'),
(31, 3, 'Tooth ache radiating to other parts'),
(32, 3, 'Hypersensitivity of tooth'),
(33, 3, 'Other'),
(34, 4, 'Decayed tooth/teeth'),
(35, 4, 'Tooth Ache'),
(36, 4, 'Root stumps'),
(37, 4, 'impected Tooth'),
(38, 4, 'Food impaction'),
(39, 4, 'Fractured Tooth/teeth'),
(40, 4, 'Tooth ache radiating to other parts'),
(41, 4, 'Other'),
(42, 5, 'Decayed tooth/teeth'),
(43, 5, 'Tooth Ache'),
(44, 5, 'Root stumps'),
(45, 5, 'impected Tooth'),
(46, 5, 'Food impaction'),
(47, 5, 'Fractured Tooth/teeth'),
(48, 5, 'Tooth ache radiating to other parts'),
(49, 5, 'Other'),
(50, 6, 'Forwardly placed teeth'),
(51, 6, 'Crowding of teeth'),
(52, 6, 'Irregularly placed teeth'),
(53, 6, 'Forwardy placed jows'),
(54, 6, 'Impected tooth'),
(55, 6, 'Food impaction'),
(56, 6, 'Mouth breathing'),
(57, 6, 'Other'),
(58, 7, 'Decayed tooth/teeth'),
(59, 7, 'Tooth ache'),
(60, 7, 'Food impaction'),
(61, 7, 'Fractured tooth/teeth'),
(62, 7, 'Discoloration of tooth'),
(63, 7, 'Spacing of teeth'),
(64, 7, 'Small teeth'),
(65, 7, 'Hypersensitivity of tooth'),
(66, 7, 'Ugly Shaped tooth'),
(67, 7, 'Forwardly placed teeth'),
(68, 7, 'Crowding of teeth'),
(69, 7, 'rregularly placed teeth'),
(70, 7, 'Forwardly placed jows'),
(71, 7, 'Impected tooth'),
(72, 7, 'Mouth breathing'),
(73, 7, 'Other'),
(74, 8, 'Missing tooth/teeth'),
(75, 8, 'Edentulous arch'),
(76, 8, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `da_treatment_charges_category`
--

CREATE TABLE `da_treatment_charges_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_treatment_charges_category`
--

INSERT INTO `da_treatment_charges_category` (`id`, `category_name`) VALUES
(1, 'Consultation fee'),
(2, 'Composite restoration'),
(3, 'Composite restoration (Large)'),
(4, 'Glass ionomer restoration'),
(5, 'Glass ionomer cervical restoration'),
(6, 'Composite cervical restoration'),
(7, 'Amalgam restoration'),
(8, 'Interim/temporary restoration'),
(9, 'Bleaching vital tooth'),
(10, 'Composite Inlays'),
(11, 'Composite onlay'),
(12, 'Ceramic inlays'),
(13, 'Ceramic onlays'),
(14, 'Composite veneer'),
(15, 'Ceramic veneer'),
(16, 'Others 1,2,3');

-- --------------------------------------------------------

--
-- Table structure for table `da_treatment_plan`
--

CREATE TABLE `da_treatment_plan` (
  `id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `clinic_user_id` int(11) NOT NULL,
  `treatment_plan` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=active 1=inactive',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `da_treatment_plan_category`
--

CREATE TABLE `da_treatment_plan_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_treatment_plan_category`
--

INSERT INTO `da_treatment_plan_category` (`id`, `category_name`) VALUES
(1, 'Wait and watch/ diet modifecation'),
(2, 'Medication- review other medication'),
(3, 'Brushing technique demostrations'),
(4, 'Fluoride application'),
(5, 'Direct pulp capping/indirect-pulp-capping/ pulpotomy'),
(6, 'Bleaching nonvital'),
(7, 'Root canal treatment'),
(8, 'RCT+ Apicoectomy in relation to'),
(9, 'Non surgical endodontic treatment'),
(10, 'Other treatments');

-- --------------------------------------------------------

--
-- Table structure for table `da_treatment_plan_sub_categories`
--

CREATE TABLE `da_treatment_plan_sub_categories` (
  `id` int(11) NOT NULL,
  `treatment_plan_category_id` int(11) NOT NULL,
  `top_left` varchar(255) NOT NULL,
  `top_right` varchar(255) NOT NULL,
  `bottom_left` varchar(255) NOT NULL,
  `bottom_right` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `da_treatment_plan_sub_categories`
--

INSERT INTO `da_treatment_plan_sub_categories` (`id`, `treatment_plan_category_id`, `top_left`, `top_right`, `bottom_left`, `bottom_right`) VALUES
(1, 1, '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8', '8,7,6,5,4,3,2,1', '1,2,3,4,5,6,7,8');

-- --------------------------------------------------------

--
-- Table structure for table `da_videos`
--

CREATE TABLE `da_videos` (
  `id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `clinic_user_id` int(11) NOT NULL,
  `video_description` varchar(255) NOT NULL,
  `video_link` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0-active 1-inactive',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `da_workshop`
--

CREATE TABLE `da_workshop` (
  `id` int(11) NOT NULL,
  `clinic_user_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `workshop_name` varchar(255) NOT NULL,
  `speaker` varchar(255) NOT NULL,
  `workshop_topic` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `meeting_link` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `da_appointments`
--
ALTER TABLE `da_appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_categories`
--
ALTER TABLE `da_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_class_category`
--
ALTER TABLE `da_class_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_clinic`
--
ALTER TABLE `da_clinic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_clinical_examinator_category`
--
ALTER TABLE `da_clinical_examinator_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_clinic_user`
--
ALTER TABLE `da_clinic_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_deep_caries_category`
--
ALTER TABLE `da_deep_caries_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_deep_caries_class_category`
--
ALTER TABLE `da_deep_caries_class_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_dental_history_category`
--
ALTER TABLE `da_dental_history_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_diagnosis_cagegory_class`
--
ALTER TABLE `da_diagnosis_cagegory_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_diagnosis_categories`
--
ALTER TABLE `da_diagnosis_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_diagnosis_sub_categories`
--
ALTER TABLE `da_diagnosis_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_diagnosis_sub_categories_class`
--
ALTER TABLE `da_diagnosis_sub_categories_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_education_videos`
--
ALTER TABLE `da_education_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_investigation_blood_examination_sub_categories`
--
ALTER TABLE `da_investigation_blood_examination_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_investigation_category`
--
ALTER TABLE `da_investigation_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_investigation_cbct_sub_categories`
--
ALTER TABLE `da_investigation_cbct_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_investigation_iopa_sub_categories`
--
ALTER TABLE `da_investigation_iopa_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_medical_history_category`
--
ALTER TABLE `da_medical_history_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_medicine`
--
ALTER TABLE `da_medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_medicine_type`
--
ALTER TABLE `da_medicine_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_patients`
--
ALTER TABLE `da_patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_patient_categories`
--
ALTER TABLE `da_patient_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_patient_details`
--
ALTER TABLE `da_patient_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_role`
--
ALTER TABLE `da_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_sub_categories`
--
ALTER TABLE `da_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_treatment_charges_category`
--
ALTER TABLE `da_treatment_charges_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_treatment_plan`
--
ALTER TABLE `da_treatment_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_treatment_plan_category`
--
ALTER TABLE `da_treatment_plan_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_treatment_plan_sub_categories`
--
ALTER TABLE `da_treatment_plan_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_videos`
--
ALTER TABLE `da_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da_workshop`
--
ALTER TABLE `da_workshop`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `da_appointments`
--
ALTER TABLE `da_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `da_categories`
--
ALTER TABLE `da_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `da_class_category`
--
ALTER TABLE `da_class_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `da_clinic`
--
ALTER TABLE `da_clinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `da_clinical_examinator_category`
--
ALTER TABLE `da_clinical_examinator_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `da_clinic_user`
--
ALTER TABLE `da_clinic_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `da_deep_caries_category`
--
ALTER TABLE `da_deep_caries_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `da_deep_caries_class_category`
--
ALTER TABLE `da_deep_caries_class_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `da_dental_history_category`
--
ALTER TABLE `da_dental_history_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `da_diagnosis_cagegory_class`
--
ALTER TABLE `da_diagnosis_cagegory_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `da_diagnosis_categories`
--
ALTER TABLE `da_diagnosis_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `da_diagnosis_sub_categories`
--
ALTER TABLE `da_diagnosis_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `da_diagnosis_sub_categories_class`
--
ALTER TABLE `da_diagnosis_sub_categories_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `da_education_videos`
--
ALTER TABLE `da_education_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `da_investigation_blood_examination_sub_categories`
--
ALTER TABLE `da_investigation_blood_examination_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `da_investigation_category`
--
ALTER TABLE `da_investigation_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `da_investigation_cbct_sub_categories`
--
ALTER TABLE `da_investigation_cbct_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `da_investigation_iopa_sub_categories`
--
ALTER TABLE `da_investigation_iopa_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `da_medical_history_category`
--
ALTER TABLE `da_medical_history_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `da_medicine`
--
ALTER TABLE `da_medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `da_medicine_type`
--
ALTER TABLE `da_medicine_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `da_patients`
--
ALTER TABLE `da_patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `da_patient_categories`
--
ALTER TABLE `da_patient_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `da_patient_details`
--
ALTER TABLE `da_patient_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `da_role`
--
ALTER TABLE `da_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `da_sub_categories`
--
ALTER TABLE `da_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `da_treatment_charges_category`
--
ALTER TABLE `da_treatment_charges_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `da_treatment_plan`
--
ALTER TABLE `da_treatment_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `da_treatment_plan_category`
--
ALTER TABLE `da_treatment_plan_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `da_treatment_plan_sub_categories`
--
ALTER TABLE `da_treatment_plan_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `da_videos`
--
ALTER TABLE `da_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `da_workshop`
--
ALTER TABLE `da_workshop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
