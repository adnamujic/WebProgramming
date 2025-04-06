-- MySQL dump 10.13  Distrib 8.4.0, for macos14 (arm64)
--
-- Host: localhost    Database: WebOnlineCourses
-- ------------------------------------------------------
-- Server version	8.4.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Blog`
--

DROP TABLE IF EXISTS `Blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Blog` (
  `blogID` int NOT NULL AUTO_INCREMENT,
  `userID` int DEFAULT NULL,
  `courseID` int DEFAULT NULL,
  `title` text,
  `content` text,
  `createdAt` date DEFAULT NULL,
  PRIMARY KEY (`blogID`),
  KEY `Blog_Users_FK` (`userID`),
  KEY `Blog_Courses_FK` (`courseID`),
  CONSTRAINT `Blog_Courses_FK` FOREIGN KEY (`courseID`) REFERENCES `Courses` (`courseID`),
  CONSTRAINT `Blog_Users_FK` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Blog`
--

LOCK TABLES `Blog` WRITE;
/*!40000 ALTER TABLE `Blog` DISABLE KEYS */;
/*!40000 ALTER TABLE `Blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Courses`
--

DROP TABLE IF EXISTS `Courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Courses` (
  `courseID` int NOT NULL AUTO_INCREMENT,
  `title` text,
  `description` text,
  `instructorID` int DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  PRIMARY KEY (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Courses`
--

LOCK TABLES `Courses` WRITE;
/*!40000 ALTER TABLE `Courses` DISABLE KEYS */;
/*!40000 ALTER TABLE `Courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Dashboard`
--

DROP TABLE IF EXISTS `Dashboard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Dashboard` (
  `userID` int DEFAULT NULL,
  `operationTime` datetime DEFAULT NULL,
  `operation(CRUD)` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`operation(CRUD)`),
  KEY `Dashboard_Users_FK` (`userID`),
  CONSTRAINT `Dashboard_Users_FK` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Dashboard`
--

LOCK TABLES `Dashboard` WRITE;
/*!40000 ALTER TABLE `Dashboard` DISABLE KEYS */;
/*!40000 ALTER TABLE `Dashboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Enrollments`
--

DROP TABLE IF EXISTS `Enrollments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Enrollments` (
  `enrollmentID` int NOT NULL AUTO_INCREMENT,
  `userID` int DEFAULT NULL,
  `courseID` int DEFAULT NULL,
  `enrolledAt` datetime DEFAULT NULL,
  PRIMARY KEY (`enrollmentID`),
  KEY `Enrollments_Users_FK` (`userID`),
  KEY `Enrollments_Courses_FK` (`courseID`),
  CONSTRAINT `Enrollments_Courses_FK` FOREIGN KEY (`courseID`) REFERENCES `Courses` (`courseID`),
  CONSTRAINT `Enrollments_Users_FK` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Enrollments`
--

LOCK TABLES `Enrollments` WRITE;
/*!40000 ALTER TABLE `Enrollments` DISABLE KEYS */;
/*!40000 ALTER TABLE `Enrollments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq` (
  `faqID` int NOT NULL AUTO_INCREMENT,
  `userID` int DEFAULT NULL,
  `question` text,
  `answer` text,
  `createdAt` datetime DEFAULT NULL,
  PRIMARY KEY (`faqID`),
  KEY `faq_Users_FK` (`userID`),
  CONSTRAINT `faq_Users_FK` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq`
--

LOCK TABLES `faq` WRITE;
/*!40000 ALTER TABLE `faq` DISABLE KEYS */;
/*!40000 ALTER TABLE `faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PracticeZone`
--

DROP TABLE IF EXISTS `PracticeZone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PracticeZone` (
  `taskID` int NOT NULL AUTO_INCREMENT,
  `courseID` int DEFAULT NULL,
  `userID` int DEFAULT NULL,
  `taskDescription` text,
  `solutionCode` text,
  `submittedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`taskID`),
  KEY `PracticeZone_Users_FK` (`userID`),
  KEY `PracticeZone_Courses_FK` (`courseID`),
  CONSTRAINT `PracticeZone_Courses_FK` FOREIGN KEY (`courseID`) REFERENCES `Courses` (`courseID`),
  CONSTRAINT `PracticeZone_Users_FK` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PracticeZone`
--

LOCK TABLES `PracticeZone` WRITE;
/*!40000 ALTER TABLE `PracticeZone` DISABLE KEYS */;
/*!40000 ALTER TABLE `PracticeZone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reviews`
--

DROP TABLE IF EXISTS `Reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Reviews` (
  `reviewID` int NOT NULL AUTO_INCREMENT,
  `userID` int DEFAULT NULL,
  `courseID` int DEFAULT NULL,
  `rating(1-5)` int DEFAULT NULL,
  `comment` text,
  `createdAt` datetime DEFAULT NULL,
  PRIMARY KEY (`reviewID`),
  KEY `Reviews_Users_FK` (`userID`),
  KEY `Reviews_Courses_FK` (`courseID`),
  CONSTRAINT `Reviews_Courses_FK` FOREIGN KEY (`courseID`) REFERENCES `Courses` (`courseID`),
  CONSTRAINT `Reviews_Users_FK` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reviews`
--

LOCK TABLES `Reviews` WRITE;
/*!40000 ALTER TABLE `Reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `Reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Users` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `password` int DEFAULT NULL,
  `role(admin, student, instructor)` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `Users_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'WebOnlineCourses'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-06 20:40:51
