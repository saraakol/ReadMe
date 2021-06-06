-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 06, 2021 at 09:18 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `readme`
--
CREATE DATABASE IF NOT EXISTS `readme` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `readme`;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `IdB` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `Authors` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `Description` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `Image` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`IdB`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`IdB`, `Name`, `Authors`, `Description`, `Image`) VALUES
(1, 'Harry Potter and the Philosopher\'s stone', 'J.K. Rowling', 'Harry Potter has never even heard of Hogwarts when the letters start dropping on the doormat at number four, Privet Drive. Addressed in green ink on yellowish parchment with a purple seal, they are swiftly confiscated by his grisly aunt and uncle. Then, on Harry\'s eleventh birthday, a great beetle-eyed giant of a man called Rubeus Hagrid bursts in with some astonishing news: Harry Potter is a wizard, and he has a place at Hogwarts School of Witchcraft and Wizardry. An incredible adventure is about to begin!', 'yes'),
(2, 'The Master and Margarita', 'Mikhail Bulgakov', 'One hot spring, the devil arrives in Moscow, accompanied by a retinue that includes a beautiful naked witch and an immense talking black cat with a fondness for chess and vodka. The visitors quickly wreak havoc in a city that refuses to believe in either God or Satan. But they also bring peace to two unhappy Muscovites: one is the Master, a writer pilloried for daring to write a novel about Christ and Pontius Pilate; the other is Margarita, who loves the Master so deeply that she is willing literally to go to hell for him. What ensues is a novel of inexhaustible energy, humor, and philosophical depth, a work whose nuances emerge for the first time in Diana Burgin\'s and Katherine Tiernan O\'Connor\'s splendid English version.', 'yes'),
(3, 'Amazon Unbound', 'Brad Stone', 'Almost ten years ago, Bloomberg journalist Brad Stone captured the rise of Amazon in his bestseller The Everything Store. Since then, Amazon has expanded exponentially, inventing novel products like Alexa and disrupting countless industries, while its workforce has quintupled in size and its valuation has soared to well over a trillion dollars. Jeff Bezos’s empire, once housed in a garage, now spans the globe. Between services like Whole Foods, Prime Video, and Amazon’s cloud computing unit, AWS, plus Bezos’s ownership of The Washington Post, it’s impossible to go a day without encountering its impact. We live in a world run, supplied, and controlled by Amazon and its iconoclast founder.', 'yes'),
(4, 'Exhale: Hope, Healing, and a Life in Transplant', 'David Weill', 'Exhale is the riveting memoir of a top transplant doctor who rode the emotional rollercoaster of saving and losing lives—until it was time to step back and reassess his own life.\r\n\r\nA young father with a rare form of lung cancer who has been turned down for a transplant by several hospitals. A kid who was considered not “smart enough” to be worthy of a transplant. A young mother dying on the waiting list in front of her two small children. A father losing his oldest daughter after a transplant goes awry. The nights waiting for donor lungs to become available, understanding that someone needed to die so that another patient could live.', 'yes'),
(5, 'Better, Not Bitter', 'Yusef Salaam', 'So begins Yusef Salaam telling his story. No one\'s life is the sum of the worst things that happened to them, and during Yusef Salaam\'s seven years of wrongful incarceration as one of the Central Park Five, he grew from child to man, and gained a spiritual perspective on life. Yusef learned that we\'re all \"born on purpose, with a purpose.\" Despite having confronted the racist heart of America while being \"run over by the spiked wheels of injustice,\" Yusef channeled his energy and pain into something positive, not just for himself but for other marginalized people and communities.', 'yes'),
(6, 'The Alchemist', 'Paulo Coelho', 'Paulo Coelho\'s enchanting novel has inspired a devoted following around the world. This story, dazzling in its powerful simplicity and soul-stirring wisdom, is about an Andalusian shepherd boy named Santiago who travels from his homeland in Spain to the Egyptian desert in search of a treasure buried near the Pyramids. Along the way he meets a Gypsy woman, a man who calls himself king, and an alchemist, all of whom point Santiago in the direction of his quest. No one knows what the treasure is, or if Santiago will be able to surmount the obstacles in his path. But what starts out as a journey to find worldly goods turns into a discovery of the treasure found within. Lush, evocative, and deeply humane, the story of Santiago is an eternal testament to the transforming power of our dreams and the importance of listening to our hearts.', 'yes'),
(7, 'The Great Gatsby', 'Francis Scott Fitzgerald', 'The Great Gatsby, F. Scott Fitzgerald\'s third book, stands as the supreme achievement of his career. This exemplary novel of the Jazz Age has been acclaimed by generations of readers. The story is of the fabulously wealthy Jay Gatsby and his new love for the beautiful Daisy Buchanan, of lavish parties on Long Island at a time when The New York Times noted \"gin was the national drink and sex the national obsession,\" it is an exquisitely crafted tale of America in the 1920s.\r\n\r\nThe Great Gatsby is one of the great classics of twentieth-century literature.', 'yes'),
(8, '1984', 'George Orwell', 'Among the seminal texts of the 20th century, Nineteen Eighty-Four is a rare work that grows more haunting as its futuristic purgatory becomes more real. Published in 1949, the book offers political satirist George Orwell\'s nightmarish vision of a totalitarian, bureaucratic world and one poor stiff\'s attempt to find individuality. The brilliance of the novel is Orwell\'s prescience of modern life—the ubiquity of television, the distortion of the language—and his ability to construct such a thorough version of hell. Required reading for students since it was published, it ranks among the most terrifying novels ever written. ', 'yes'),
(9, 'On Juneteenth', 'Annette Gordon-Reed', 'Weaving together American history, dramatic family chronicle, and searing episodes of memoir, Annette Gordon-Reed’s On Juneteenth provides a historian’s view of the country’s long road to Juneteenth, recounting both its origins in Texas and the enormous hardships that African-Americans have endured in the century since, from Reconstruction through Jim Crow and beyond. All too aware of the stories of cowboys, ranchers, and oilmen that have long dominated the lore of the Lone Star State, Gordon-Reed—herself a Texas native and the descendant of enslaved people brought to Texas as early as the 1820s—forges a new and profoundly truthful narrative of her home state, with implications for us all.', 'yes'),
(10, 'Zero Fail: The Rise and Fall of the Secret Service', 'Carol Leonnig', 'The first definitive account of the rise and fall of the Secret Service, from the Kennedy assassination to the ongoing scandals under Obama and Trump--by Pulitzer Prize winner and #1 New York Times bestselling co-author of A Very Stable Genius.\r\nCarol Leonnig has been covering the Secret Service for The Washington Post for most of the last decade, bringing to light the gaffes and scandals that plague the agency today--from a toxic work culture to outdated equipment and training to the deep resentment among the ranks with the agency\'s leadership. But the Secret Service wasn\'t always so troubled.', 'yes'),
(11, 'Counting Down with You', 'Tashie Bhuiyan', 'A reserved Bangladeshi teenager has twenty-eight days to make the biggest decision of her life after agreeing to fake date her school’s resident bad boy.\r\nHow do you make one month last a lifetime?\r\n\r\nKarina Ahmed has a plan. Keep her head down, get through high school without a fuss, and follow her parents’ rules—even if it means sacrificing her dreams. When her parents go abroad to Bangladesh for four weeks, Karina expects some peace and quiet. Instead, one simple lie unravels everything.', 'yes'),
(12, 'Just Last Night', 'Mhairi McFarlane', 'Eve, Justin, Susie, and Ed have been friends since they were teenagers. Now in their thirties, the four are as close as ever, Thursday pub trivia night is sacred, and Eve is still secretly in love with Ed. Maybe she should have moved on by now, but she can’t stop thinking about what could have been. And she knows Ed still thinks about it, too.', 'yes'),
(13, 'The Ones We\'re Meant to Find', 'Joan He', 'One of the most twisty, surprising, engaging page-turner YAs you’ll read this year—We Were Liars meets Black Mirror, with a dash of Studio Ghibli.\r\n\r\nCee has been trapped on an abandoned island for three years without any recollection of how she arrived, or memories from her life prior. All she knows is that somewhere out there, beyond the horizon, she has a sister named Kay, and it’s up to Cee to cross the ocean and find her.', 'yes'),
(14, 'While Justice Sleeps', 'Stacey Abrams', 'Avery Keene, a brilliant young law clerk for the legendary Justice Howard Wynn, is doing her best to hold her life together--excelling in an arduous job with the court while also dealing with a troubled family. When the shocking news breaks that Justice Wynn--the cantankerous swing vote on many current high-profile cases--has slipped into a coma, Avery\'s life turns upside down. She is immediately notified that Justice Wynn has left instructions for her to serve as his legal guardian and power of attorney. Plunged into an explosive role she never anticipated, Avery finds that Justice Wynn had been secretly researching one of the most controversial cases before the court--a proposed merger between an American biotech company and an Indian genetics firm, which promises to unleash breathtaking results in the medical field. She also discovers that Wynn suspected a dangerously related conspiracy that infiltrates the highest power corridors of Washington.', 'yes'),
(34, 'Harry Potter and The Chamber of Secrets', 'J K Rowling', 'The second instalment of boy wizard Harry Potter\'s adventures at Hogwarts School of Witchcraft and Wizardry, based on the novel by JK Rowling. A mysterious elf tells Harry to expect trouble during his second year at Hogwarts, but nothing can prepare him for trees that fight back, flying cars, spiders that talk and deadly warnings written in blood on the walls of the school.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookgenres`
--

DROP TABLE IF EXISTS `bookgenres`;
CREATE TABLE IF NOT EXISTS `bookgenres` (
  `IdB` int(11) NOT NULL,
  `IdG` int(11) NOT NULL,
  PRIMARY KEY (`IdB`,`IdG`),
  KEY `idG` (`IdG`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bookgenres`
--

INSERT INTO `bookgenres` (`IdB`, `IdG`) VALUES
(1, 1),
(2, 1),
(3, 3),
(4, 3),
(5, 3),
(6, 5),
(7, 5),
(8, 5),
(34, 5),
(9, 7),
(10, 7),
(11, 8),
(12, 8);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `IdG` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdG`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`IdG`, `Name`) VALUES
(1, 'Romance'),
(2, 'Sci-Fi'),
(3, 'Biography'),
(5, 'Classics'),
(7, 'History'),
(8, 'Mystery');

-- --------------------------------------------------------

--
-- Table structure for table `quote`
--

DROP TABLE IF EXISTS `quote`;
CREATE TABLE IF NOT EXISTS `quote` (
  `IdQ` int(11) NOT NULL AUTO_INCREMENT,
  `IdU` int(11) NOT NULL,
  `IdB` int(11) NOT NULL,
  `Text` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdQ`),
  KEY `IdU` (`IdU`),
  KEY `IdB` (`IdB`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quote`
--

INSERT INTO `quote` (`IdQ`, `IdU`, `IdB`, `Text`) VALUES
(15, 1, 1, 'Mr. and Mrs. Dursley of number four, Privet Drive, were proud to say that they were perfectly normal, thank you very much.'),
(16, 1, 1, 'I hope you\'re pleased with yourselves. We could all have been killed — or worse, expelled. Now if you don\'t mind, I\'m going to bed.\" ― Hermione Granger.'),
(17, 3, 1, 'You\'re a little scary sometimes, you know that? Brilliant ... but scary.\" — Ron Weasley.'),
(18, 3, 1, 'It takes a great deal of bravery to stand up to our enemies, but just as much to stand up to our friends.\" ― Albus Dumbledore.'),
(19, 1, 2, 'Not causing trouble, not touching anything, fixing the primus.'),
(20, 1, 2, 'I wouldn’t like to meet you when you’ve got a revolver,” said Margarita with a coquettish look at Azazello. She had a passion for people who did things well.'),
(21, 3, 2, 'But why don\'t you take him with you into the light?\r\nHe does not deserve the light, he deserves peace'),
(22, 3, 3, 'I challenge you to a duel!” screamed the cat, sailing over their heads on the swinging chandelier.'),
(23, 1, 7, 'Very well, very well,\' responded the cat, and he began studying the chessboard through his opera glasses.');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

DROP TABLE IF EXISTS `rate`;
CREATE TABLE IF NOT EXISTS `rate` (
  `IdR` int(11) NOT NULL AUTO_INCREMENT,
  `IdU` int(11) NOT NULL,
  `IdB` int(11) NOT NULL,
  `rate` float NOT NULL,
  PRIMARY KEY (`IdR`),
  KEY `IdU` (`IdU`),
  KEY `IdB` (`IdB`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`IdR`, `IdU`, `IdB`, `rate`) VALUES
(1, 1, 1, 4),
(2, 1, 2, 2),
(5, 2, 1, 5),
(6, 2, 2, 4),
(7, 3, 1, 1),
(9, 3, 3, 2),
(10, 3, 4, 5),
(11, 4, 1, 2),
(12, 4, 2, 3),
(13, 4, 4, 5),
(14, 4, 6, 2),
(15, 1, 4, 5),
(16, 1, 6, 2),
(17, 3, 9, 2),
(18, 3, 12, 2),
(19, 2, 6, 5),
(20, 2, 12, 2),
(21, 68, 1, 5),
(22, 68, 2, 2),
(23, 68, 8, 1),
(24, 68, 12, 4),
(25, 68, 14, 2),
(26, 68, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `IdRev` int(11) NOT NULL AUTO_INCREMENT,
  `IdB` int(11) NOT NULL,
  `IdU` int(11) NOT NULL,
  `Text` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdRev`),
  KEY `IdU` (`IdU`),
  KEY `IdB` (`IdB`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`IdRev`, `IdB`, `IdU`, `Text`) VALUES
(47, 1, 68, 'This was very good!'),
(48, 1, 1, 'Dissapointing'),
(49, 2, 1, 'This brings back memories'),
(50, 4, 1, 'Loved this one!'),
(51, 8, 1, 'The movie was better'),
(52, 1, 2, 'I don\'t like Snape.'),
(53, 2, 2, 'Russian literature is the best'),
(54, 3, 2, 'Jef Bezos is a legend'),
(55, 1, 3, 'I am a privileged user.'),
(56, 4, 3, 'Ridiculous and uninspiring'),
(57, 6, 3, 'Made me fall in love with chemistry'),
(58, 1, 4, 'OMG Worst chapter !!'),
(59, 5, 4, 'So calming '),
(60, 7, 4, 'The GREAT Gatsby indeed'),
(61, 34, 4, 'Someone should add a cover');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE IF NOT EXISTS `subscription` (
  `IdU` int(11) NOT NULL,
  `IdG` int(11) NOT NULL,
  PRIMARY KEY (`IdU`,`IdG`),
  KEY `IdG` (`IdG`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`IdU`, `IdG`) VALUES
(3, 2),
(68, 2),
(4, 5),
(68, 5),
(4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `IdU` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `Image` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `Status` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `PersonalGoal` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdU`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Username_2` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`IdU`, `Username`, `Password`, `FirstName`, `LastName`, `Email`, `Image`, `Type`, `Status`, `PersonalGoal`) VALUES
(1, 'andrejjokic', 'andrej123', 'Andrej', 'Jokiv', 'andrejjokic@gmail.com', 'yes', 'administrator', 'registered', NULL),
(2, 'nikolakrstic', 'nikola123', 'Nikola', 'Krstic', 'nikolakrstic99@gmail.com', NULL, 'regular_user', 'registered', NULL),
(3, 'andrej123', 'andrej123', 'Andrej', 'Veselinovic', 'andrej@gmail.com', NULL, 'privileged_user', 'registered', 10),
(4, 'sara123', 'sara123', 'Sara', 'Kolarevic', 'sara@gmail.com', 'yes', 'regular_user', 'registered', NULL),
(5, 'nikola123', 'nikola123', 'Nikola', 'Tesla', 'nikola@gmail.com', 'yes', 'regular_user', 'pending', NULL),
(6, 'pera123', 'pera123', 'Petar', 'Peric', 'pera@gmail.com', NULL, 'regular_user', 'pending', NULL),
(7, 'mika123', 'mika123', 'Mika', 'Mikic', 'mika@gmail.com', NULL, 'regular_user', 'pending', NULL),
(68, 'elon123', 'elon123', 'Elon', 'Musk', 'elon@gmail.com', 'yes', 'regular_user', 'registered', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userbooks`
--

DROP TABLE IF EXISTS `userbooks`;
CREATE TABLE IF NOT EXISTS `userbooks` (
  `IdUB` int(11) NOT NULL AUTO_INCREMENT,
  `IdU` int(11) NOT NULL,
  `IdB` int(11) NOT NULL,
  `Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdUB`),
  KEY `IdU` (`IdU`),
  KEY `IdB` (`IdB`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `userbooks`
--

INSERT INTO `userbooks` (`IdUB`, `IdU`, `IdB`, `Type`) VALUES
(3, 1, 1, 'want-to-read'),
(4, 1, 11, 'want-to-read'),
(5, 1, 9, 'want-to-read'),
(6, 2, 12, 'read'),
(7, 2, 9, 'read'),
(15, 4, 7, 'read'),
(16, 4, 14, 'read'),
(18, 68, 1, 'read'),
(21, 3, 1, 'read'),
(22, 3, 2, 'read'),
(23, 3, 3, 'read'),
(24, 3, 8, 'read'),
(25, 3, 9, 'read'),
(26, 3, 10, 'read'),
(27, 3, 11, 'read'),
(30, 2, 10, 'read'),
(31, 2, 11, 'read'),
(33, 2, 1, 'read'),
(34, 2, 2, 'read'),
(35, 2, 3, 'read'),
(36, 2, 4, 'read'),
(37, 2, 5, 'read'),
(38, 2, 6, 'read');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookgenres`
--
ALTER TABLE `bookgenres`
  ADD CONSTRAINT `bookgenres_ibfk_1` FOREIGN KEY (`IdB`) REFERENCES `book` (`IdB`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookgenres_ibfk_2` FOREIGN KEY (`IdG`) REFERENCES `genre` (`IdG`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quote`
--
ALTER TABLE `quote`
  ADD CONSTRAINT `quote_ibfk_1` FOREIGN KEY (`IdU`) REFERENCES `user` (`IdU`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quote_ibfk_2` FOREIGN KEY (`IdB`) REFERENCES `book` (`IdB`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `rate_ibfk_1` FOREIGN KEY (`IdU`) REFERENCES `user` (`IdU`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rate_ibfk_2` FOREIGN KEY (`IdB`) REFERENCES `book` (`IdB`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`IdU`) REFERENCES `user` (`IdU`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`IdB`) REFERENCES `book` (`IdB`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`IdG`) REFERENCES `genre` (`IdG`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscription_ibfk_2` FOREIGN KEY (`IdU`) REFERENCES `user` (`IdU`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userbooks`
--
ALTER TABLE `userbooks`
  ADD CONSTRAINT `userbooks_ibfk_1` FOREIGN KEY (`IdU`) REFERENCES `user` (`IdU`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userbooks_ibfk_2` FOREIGN KEY (`IdB`) REFERENCES `book` (`IdB`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
