-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 30, 2022 at 06:36 AM
-- Server version: 8.0.18
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m182999`
--

-- --------------------------------------------------------

--
-- Table structure for table `patient_log`
--

CREATE TABLE `patient_log` (
  `ID_patient` int(10) UNSIGNED NOT NULL,
  `animal_name` varchar(45) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `species` varchar(45) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `age` varchar(45) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `mail` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Table structure for table `treatment_plan`
--

CREATE TABLE `treatment_plan` (
  `ID_treatment` int(10) UNSIGNED NOT NULL,
  `treatment_type` varchar(45) COLLATE utf8mb4_czech_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `treatment_plan`
--

INSERT INTO `treatment_plan` (`ID_treatment`, `treatment_type`) VALUES
(1, 'Vysetreni krve na alergie'),
(2, 'Chirurgicky zakrok - maly'),
(3, 'Chirurgicky zakrok - velky'),
(4, 'Odstraneni zubu'),
(5, 'Fixace zlomene koncetiny'),
(6, 'Vysetreni vnejsich parazitu'),
(7, 'Vysetreni vnitrnych parazitu');

-- --------------------------------------------------------

--
-- Table structure for table `treatment_plan_has_vet`
--

CREATE TABLE `treatment_plan_has_vet` (
  `treatment_plan_ID_treatment` int(10) UNSIGNED NOT NULL,
  `vet_ID_vet` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `treatment_plan_has_vet`
--

INSERT INTO `treatment_plan_has_vet` (`treatment_plan_ID_treatment`, `vet_ID_vet`) VALUES
(5, 1),
(3, 2),
(2, 3),
(7, 3),
(1, 4),
(4, 4),
(6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `vet`
--

CREATE TABLE `vet` (
  `ID_vet` int(10) UNSIGNED NOT NULL,
  `vet_name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `vet_spec` varchar(45) COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `vet`
--

INSERT INTO `vet` (`ID_vet`, `vet_name`, `vet_spec`) VALUES
(1, 'Anna Ruzickova', 'Ortopedie'),
(2, 'Petr Zeleny', 'Chirurg'),
(3, 'Monika Kotatko', 'Vseobecny veterinar'),
(4, 'Martin Yang', 'Internista');

-- --------------------------------------------------------

--
-- Table structure for table `vet_exam_log`
--

CREATE TABLE `vet_exam_log` (
  `ID_exam` int(10) UNSIGNED NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `findings` varchar(45) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `urgency` tinyint(1) NOT NULL DEFAULT '0',
  `Patient_log_ID_patient` int(10) UNSIGNED NOT NULL,
  `treatment_plan_ID_treatment` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patient_log`
--
ALTER TABLE `patient_log`
  ADD PRIMARY KEY (`ID_patient`);

--
-- Indexes for table `treatment_plan`
--
ALTER TABLE `treatment_plan`
  ADD PRIMARY KEY (`ID_treatment`);

--
-- Indexes for table `treatment_plan_has_vet`
--
ALTER TABLE `treatment_plan_has_vet`
  ADD PRIMARY KEY (`treatment_plan_ID_treatment`,`vet_ID_vet`),
  ADD KEY `fk_treatment_plan_has_treatment_equipment_treatment_equipme_idx` (`vet_ID_vet`),
  ADD KEY `fk_treatment_plan_has_treatment_equipment_treatment_plan1_idx` (`treatment_plan_ID_treatment`);

--
-- Indexes for table `vet`
--
ALTER TABLE `vet`
  ADD PRIMARY KEY (`ID_vet`);

--
-- Indexes for table `vet_exam_log`
--
ALTER TABLE `vet_exam_log`
  ADD PRIMARY KEY (`ID_exam`,`Patient_log_ID_patient`,`treatment_plan_ID_treatment`),
  ADD KEY `fk_vet_exam_log_Patient_log1_idx` (`Patient_log_ID_patient`),
  ADD KEY `fk_vet_exam_log_treatment_plan1_idx` (`treatment_plan_ID_treatment`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patient_log`
--
ALTER TABLE `patient_log`
  MODIFY `ID_patient` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `treatment_plan`
--
ALTER TABLE `treatment_plan`
  MODIFY `ID_treatment` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vet`
--
ALTER TABLE `vet`
  MODIFY `ID_vet` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vet_exam_log`
--
ALTER TABLE `vet_exam_log`
  MODIFY `ID_exam` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `treatment_plan_has_vet`
--
ALTER TABLE `treatment_plan_has_vet`
  ADD CONSTRAINT `fk_treatment_plan_has_treatment_equipment_treatment_equipment1` FOREIGN KEY (`vet_ID_vet`) REFERENCES `vet` (`ID_vet`),
  ADD CONSTRAINT `fk_treatment_plan_has_treatment_equipment_treatment_plan1` FOREIGN KEY (`treatment_plan_ID_treatment`) REFERENCES `treatment_plan` (`ID_treatment`);

--
-- Constraints for table `vet_exam_log`
--
ALTER TABLE `vet_exam_log`
  ADD CONSTRAINT `fk_vet_exam_log_Patient_log1` FOREIGN KEY (`Patient_log_ID_patient`) REFERENCES `patient_log` (`ID_patient`),
  ADD CONSTRAINT `fk_vet_exam_log_treatment_plan1` FOREIGN KEY (`treatment_plan_ID_treatment`) REFERENCES `treatment_plan` (`ID_treatment`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
