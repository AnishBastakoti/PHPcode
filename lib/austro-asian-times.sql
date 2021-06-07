-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2021 at 12:13 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `austro-asian-times`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `articleID` int(11) NOT NULL,
  `articleTitle` text NOT NULL,
  `articleDescription` text NOT NULL,
  `articleDate` date NOT NULL,
  `articleStatus` varchar(25) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`articleID`, `articleTitle`, `articleDescription`, `articleDate`, `articleStatus`, `userID`) VALUES
(3, 'Second wave of covid in India', 'The Second Wave was not unusual for India. Anywhere if there was a laxity in precautions, the Second Wave happened in countries such as such in Italy, Germany, United Kingdom and the USA.\r\n\r\nThe Second Wave in the USA was very severe but not as bad as in India as neither the USA nor the European Countries had a Kumbh Maila or large political rallies. Did China cause the Second Wave there also? Assuming that China did cause the Second Wave in India, then it reflects a serious concern about the failure of Indian intelligence. Irrespective of China’s role, the Indian intelligence is one of the worst ones in the world. Besides spending a lot of money on buying defense equipment, India must concentrate on improving its intelligence agencies. India failed to properly pursue the vaccination production and availability. Besides bragging about being the largest producer of vaccines, India should have planned for enough vaccinations for Indians. India should not blame China for Covid. However, India should be careful that taking advantage of the severe Corona epidemic in India, China does not grab India’s territory in addition to 4,000 square kilometers it already occupies.\r\n\r\nAs I mentioned earlier, U.S. and other countries also blamed China. I have been and continue to be anti-China, but cannot ignore facts. Did China gain much, if anything, from the spread of Corona? No. First, China had to lock down its population and businesses when the virus started spreading there. As the news media is controlled in China, we will never know how many Chinese got sick from Corona and how many died. All the sickness and deaths must have taken its toll on Chinese economy also, but these are not small numbers. With the spread of Covid-19 virus, the demand for products, shut down of manufacturing facilities, businesses, leisure and personal transportation slowed down all over the world. China must have lost a lot of export and domestic markets. Because of ill will created against her, China lost some export markets forever and a number of foreign manufacturing activities have also moved out of China perhaps forever. It is correct that China’s GDP has started increasing again, no one knows for sure. Has Chine achieved its pre-epidemic GDP level? The answer is no and it will take at least a couple of years before China or any other country gets to their pre-epidemic economic growth.', '2021-05-19', 'published', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(70) NOT NULL,
  `last_name` varchar(70) NOT NULL,
  `email_id` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `position` varchar(70) NOT NULL,
  `authentication` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email_id`, `password`, `position`, `authentication`) VALUES
(1, 'Eden', 'Hazard', 'eden@gmail.com', '12345', 'admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`articleID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `articleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
