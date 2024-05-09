-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 09:36 AM
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
-- Database: `tutoring_service`
--
CREATE DATABASE IF NOT EXISTS `tutoring_service` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tutoring_service`;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `fk_course_id` int(11) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `fk_course_id`, `fk_user_id`, `date`) VALUES
(15, 6, 15, '2024-04-29'),
(16, 1, 15, '2024-04-29'),
(17, 1, 14, '2024-05-01'),
(18, 5, 12, '2024-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `university` varchar(50) DEFAULT NULL,
  `roomNumb` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `teacher` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `units` varchar(100) DEFAULT NULL,
  `capacity` int(11) NOT NULL,
  `availability` enum('avaiable','not avaiable') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `subject`, `name`, `university`, `roomNumb`, `date`, `end_date`, `teacher`, `email`, `picture`, `language`, `duration`, `units`, `capacity`, `availability`) VALUES
(1, 'Mathematics', 'Statistik and Mathematics II', 'Brno University of Technology', 'Room 101', '2024-04-01', '2024-04-03', 'Dr. Smith', 'alice.smith@example.com', 'math.jpg', 'English', '60', '3', 27, 'avaiable'),
(2, 'Computer Science', 'PHP course beginner', 'University of Chemistry and Technology', 'Room 201', '2024-04-04', '2024-04-05', 'Prof. Johnson', 'prof.jhonson@example.com', 'computer.jpg', 'English', '90', '4', 50, 'avaiable'),
(3, 'Physics', 'Quantum Physics', 'Charles University Prague', 'Room 301', '2024-04-08', '2024-04-10', 'Prof. Williams', 'mathias.williams@gmail.com', 'physics.jpg', 'English', '75', '3', 60, 'avaiable'),
(4, 'Literature', 'literature between worldwars', 'Jan Evangelista Purkyne University', 'Room 102', '2024-04-16', '2024-04-18', 'Ms. Brown', 'emily.brown@gmail.com', 'literature.jpg', 'English', '45', '2', 80, 'avaiable'),
(5, 'History', 'industrial revolution', 'University of Ostrava', 'Room 202', '2024-03-19', '2024-03-21', 'Dr. Davis', 'trainer@mail.com', 'history.jpg', 'English', '60', '3', 40, 'avaiable'),
(6, 'Biology', 'cell biology', 'Charles University Prague', 'Room 302', '2024-04-22', '2024-04-26', 'Dr. Martinez', 'rodrigo.martinez@hotmail.com', 'biology.jpg', 'English', '60', '3', 55, 'avaiable'),
(7, 'Chemistry', 'nobel gases', 'University of Chemistry and Technology', 'Room 103', '2024-05-01', '2024-05-03', 'Prof. Thompson', '	\r\njerry.thompson@gmail.com', 'chemistry.jpg', 'English', '90', '4', 200, 'avaiable'),
(8, 'Geography', 'cartography and geoinformation system', 'Masaryk University', 'Room 203', '2024-04-29', '2024-05-02', 'Ms. Garcia', 'emma.garcia@example.com', 'geography.png', 'English', '45', '2', 100, 'avaiable'),
(9, 'Economics', 'Microeconomics II', 'University of Economics Prague', 'Room 303', '2024-05-20', '2024-05-23', 'Dr. Robinson', 'karin.robinson@gmail.com', 'economics.jpg', 'English', '75', '3', 120, 'avaiable'),
(10, 'Art', 'liberal arts', 'Masaryk University', 'Room 104', '2024-06-12', '2024-06-13', 'Prof. Lee', '	\r\nyung.lee@gmail.com', 'art.jpeg', 'English', '60', '3', 60, 'avaiable'),
(11, 'Biology', 'flora and fauna', 'Charles University Prague', 'Room 293', '2024-05-13', '2024-05-17', 'Dr.Smith', 'alice.smith@example.com', 'biology.jpg', 'English', '120', '3', 55, 'avaiable');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `fk_course_id` int(11) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `rating`, `comment`, `date`, `fk_course_id`, `fk_user_id`) VALUES
(13, 5, 'Absolutely fantastic tutoring service! The tutors are highly knowledgeable and supportive. They helped me grasp complex concepts with ease. I highly recommend them to anyone seeking academic assistance.', '2024-04-25 00:00:00', 2, 14),
(16, 4, 'Great experience overall! The tutors are friendly and patient. I\'ve seen significant improvement in my understanding of the subjects I struggled with. The only suggestion would be to add more interactive sessions', '2024-07-01 00:00:00', 8, 22),
(17, 5, 'Outstanding tutoring service! The tutors go above and beyond to ensure students succeed. The sessions are tailored to individual needs, making learning enjoyable and effective. I\'m truly grateful for their help!', '2024-05-03 00:00:00', 1, 10),
(18, 4, 'very good teacher', '2024-04-29 00:00:00', 6, 15);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `secondName` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `Status` enum('user','admin','trainer') DEFAULT 'user',
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `secondName`, `email`, `password`, `address`, `phoneNumber`, `Status`, `picture`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '123123', '123 Main St, City', '123-456-7890', 'user', '2.jpg'),
(2, 'Alice', 'Smith', 'alice.smith@example.com', '123123', '456 Elm St, Town', '456-789-0123', 'trainer', '3.jpg'),
(6, 'Prof.', 'Jhonson', 'prof.jhonson@example.com', '123123', '321 Cedar Ln, Township', '321-098-7654', 'trainer', '4.jpg'),
(7, 'Kevin', 'Taylor', 'kevin.taylor@example.com', '123123', '456 Birch Blvd, Hamlet', '456-789-1230', 'user', '1.jpg'),
(8, 'Mrs.', 'Garcia', 'emma.garcia@example.com', '123123', '789 Spruce Dr, Manor', '789-012-3456', 'trainer', '12.jpg'),
(9, 'James', 'Lee', 'james.lee@example.com', '123123', '123 Fir Pl, Ranch', '123-456-7890', 'user', '11.jpg'),
(10, 'Sophia', 'Rodriguez', 'sophia.rodriguez@example.com', '123123', '456 Aspen Ct, Farm', '456-789-0123', 'user', 'sophia.jpg'),
(12, 'mario', 'Geremicca', 'mario@gmail.com', '', 'sfasfga', '2561561', 'user', '5.jpg'),
(13, 'Sandro', 'Geremicca', 'sandro@gmail.com', '', 'straße1', '06507845962', 'user', 'defaultPic.jpg'),
(14, 'mattia', 'Geremicca', 'user@mail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'sdfsdf', '1561564', 'user', 'mattia.jpg'),
(15, 'roberto', 'geremicca', 'nando@aon.at', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '5asfasf', '5564564', 'user', '7.jpg'),
(16, 'Mathias', 'Williams', 'mathias.williams@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Schulstraße1', '0648055416', 'trainer', '8.jpg'),
(17, 'Emily', 'Brown', 'emily.brown@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Schulstraße5', '05648975152', 'trainer', '9.jpg'),
(18, 'Jerry', 'Thompson', 'jerry.thompson@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Schönwiesenweg52', '0589155525', 'trainer', '6.jpg'),
(19, 'Karin', 'Robinson', 'karin.robinson@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Feldweg 71', '05489547845', 'trainer', '10.jpg'),
(20, 'Yung', 'Lee', 'yung.lee@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Wildschönau12', '048956842252', 'trainer', 'defaultPic.jpg'),
(21, 'Rodriogo', 'Martinez', 'rodrigo.martinez@hotmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'straße12', '06507845962', 'trainer', '14.jpg'),
(22, 'Christian', 'Davis', 'trainer@mail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Müllergasse 9', '0670554895', 'trainer', 'christian.png'),
(23, 'Johan', 'Darian', 'admin@mail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Ottakringer Straße', '0192707409123', 'admin', '13.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_booking` (`fk_user_id`,`fk_course_id`),
  ADD KEY `fk_course_id` (`fk_course_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_course_id` (`fk_course_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`fk_course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`fk_course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
