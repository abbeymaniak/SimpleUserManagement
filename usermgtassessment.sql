-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2021 at 10:32 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usermgtassessment`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `user_group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `surname`, `dob`, `user_group_id`) VALUES
(1, 'josyvahiwy667', 'fe703d258c7ef5f50b71e06565a65aa07194907f', 'Rhiannon', 'Ryan', '1998-11-25', 3),
(4, 'tifelagev', '8154d27034840f574d28f7668950ed0de6ffccca', 'Howard', 'Knapp', '1984-05-08', 6),
(5, 'jocivegi', '33fc69dcf94533df570b64686bf24babca43dff0', 'Fredericka', 'Bennett', '1992-01-19', 5),
(6, 'hywysaxa', '4593b2b3d7b0a2f4ff15079725fc16d83e707fda', 'Hasad', 'Hahn', '2021-07-23', 1),
(7, 'dakeci', 'fa3487b7d27e0b3955afc9db97c144ce3768c09b', 'Peter', 'Rosales', '1994-10-28', 3),
(8, 'pacekyfy', 'd35630f548aecfda00aee3275879e15326bdfd74', 'Hunter', 'Hoover', '2002-07-18', 1),
(9, 'gosifidyl', 'f456dc123c07836125b7e11fae370d1eb746b3c0', 'Maia', 'Golden', '1977-02-11', 6),
(10, 'gynuqasote', '4eb1b4df256e0de6c1930c2a3c88dcf73553bf1a', 'Lee', 'Herrera', '2018-01-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `group_name`) VALUES
(1, 'Poland'),
(5, 'Mercedes'),
(7, 'Nigeria');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
