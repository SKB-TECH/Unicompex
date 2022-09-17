-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 17, 2022 at 08:03 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nyalukemba_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `autres_depenses`
--

CREATE TABLE `autres_depenses` (
  `code_autres` int(11) NOT NULL,
  `montant_depense` double NOT NULL,
  `motif` varchar(50) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `avance`
--

CREATE TABLE `avance` (
  `id` int(11) NOT NULL,
  `idagent` int(11) NOT NULL,
  `mois` varchar(55) NOT NULL,
  `montant` float NOT NULL,
  `um` varchar(15) NOT NULL,
  `dates` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `avance`
--

INSERT INTO `avance` (`id`, `idagent`, `mois`, `montant`, `um`, `dates`) VALUES
(2, 3, '2022-02', 4000, 'Fc', '2022-09-22'),
(3, 1, '2022-06', 20000, 'Fc', '2022-09-29'),
(4, 2, '2022-11', 20000, 'Fc', '09/02/2022');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `idagent` int(11) NOT NULL,
  `mois` varchar(25) NOT NULL,
  `montant` float NOT NULL,
  `um` varchar(25) NOT NULL,
  `dates` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `depense`
--

CREATE TABLE `depense` (
  `id` int(11) NOT NULL,
  `motif` text NOT NULL,
  `montant` int(11) NOT NULL,
  `um` varchar(15) NOT NULL,
  `mois` varchar(25) NOT NULL,
  `dates` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `depense`
--

INSERT INTO `depense` (`id`, `motif`, `montant`, `um`, `mois`, `dates`) VALUES
(2, 'Achat Fournitures de bureau', 120000, '$', '2022-03', '2022-09-23'),
(4, 'Coordination', 34500, '$', '2022-07', '2022-09-23'),
(5, 'Entretien', 45000, 'Fc', '2022-02', '2022-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `eleves`
--

CREATE TABLE `eleves` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `postnom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `date_naissance` date NOT NULL,
  `lieu_naissance` varchar(50) NOT NULL,
  `classe` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eleves`
--

INSERT INTO `eleves` (`id`, `nom`, `postnom`, `prenom`, `sexe`, `date_naissance`, `lieu_naissance`, `classe`) VALUES
(1, 'shako', 'kin', 'ben', 'M', '2022-09-21', 'bkv', '3 ème'),
(3, 'Arnaulde', 'Kinyamba', 'benjamin', 'M', '2022-09-29', 'Bukavu', '3 ème');

-- --------------------------------------------------------

--
-- Table structure for table `enseignants`
--

CREATE TABLE `enseignants` (
  `id` int(11) NOT NULL,
  `noms` varchar(150) NOT NULL,
  `grade` varchar(40) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `adresse` varchar(40) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `domaine` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enseignants`
--

INSERT INTO `enseignants` (`id`, `noms`, `grade`, `sexe`, `adresse`, `telephone`, `domaine`) VALUES
(1, 'shako kinyamba benjamin', 'Licencie', 'Homme', 'Goma', '0813678926', 'Enseignant'),
(3, 'Doddy Parolier', 'Licencie', 'Homme', 'Bagira', '0813678926', 'Informatique'),
(4, 'Ben Gourou', 'Licencie', 'Homme', 'Nguba', '0813678926', 'Prefet'),
(5, 'Ben Gourou', 'D6', 'Homme', 'Nguba', '+243977423201', 'Proviseur'),
(6, 'Audrey Kibibi', 'Licencie', 'Homme', 'Nguba', '0813678926', 'Prefet');

-- --------------------------------------------------------

--
-- Table structure for table `frais`
--

CREATE TABLE `frais` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `montant_frais` decimal(50,0) NOT NULL,
  `devise` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `frais`
--

INSERT INTO `frais` (`id`, `libelle`, `montant_frais`, `devise`) VALUES
(1, 'Frais scolaire', '20000', 'fc'),
(2, 'Frais divers', '20000', 'fc');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `code_option` int(11) NOT NULL,
  `designation_option` varchar(50) NOT NULL,
  `idSection` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paie`
--

CREATE TABLE `paie` (
  `id` int(11) NOT NULL,
  `idagent` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `mituelle` int(11) NOT NULL,
  `avance` int(11) NOT NULL,
  `net` int(11) NOT NULL,
  `mois` varchar(55) NOT NULL,
  `dates` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paie`
--

INSERT INTO `paie` (`id`, `idagent`, `montant`, `mituelle`, `avance`, `net`, `mois`, `dates`) VALUES
(2, 4, 20000, 5000, 5000, 10000, '2022-3', '09/02/2022'),
(12, 3, 45000, 4500, 4000, 36500, '2022-02', '2022-09-14'),
(13, 3, 45000, 4500, 4000, 45678, '2022-02', '2022-09-23');

-- --------------------------------------------------------

--
-- Table structure for table `perception`
--

CREATE TABLE `perception` (
  `id` int(11) NOT NULL,
  `date_perception` date NOT NULL,
  `montant_percu` double NOT NULL,
  `idEleve` int(11) NOT NULL,
  `idFrais` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perception`
--

INSERT INTO `perception` (`id`, `date_perception`, `montant_percu`, `idEleve`, `idFrais`, `idUser`) VALUES
(1, '2022-09-12', 23455, 1, 2, 1),
(2, '2022-09-12', 23455, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `code_section` int(11) NOT NULL,
  `designation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `noms` varchar(50) NOT NULL,
  `fonction` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autres_depenses`
--
ALTER TABLE `autres_depenses`
  ADD PRIMARY KEY (`code_autres`);

--
-- Indexes for table `avance`
--
ALTER TABLE `avance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depense`
--
ALTER TABLE `depense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eleves`
--
ALTER TABLE `eleves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enseignants`
--
ALTER TABLE `enseignants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frais`
--
ALTER TABLE `frais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`code_option`);

--
-- Indexes for table `paie`
--
ALTER TABLE `paie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perception`
--
ALTER TABLE `perception`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`code_section`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avance`
--
ALTER TABLE `avance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `depense`
--
ALTER TABLE `depense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `eleves`
--
ALTER TABLE `eleves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enseignants`
--
ALTER TABLE `enseignants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `frais`
--
ALTER TABLE `frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `code_option` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paie`
--
ALTER TABLE `paie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `perception`
--
ALTER TABLE `perception`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;