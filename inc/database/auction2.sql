-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2021 at 05:49 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(255) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `building` varchar(50) NOT NULL,
  `zip` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `country`, `city`, `street`, `building`, `zip`) VALUES
(1, 'Albania', 'Tirana', 'Sali Butka', '24', 55555),
(2, 'Albania', 'Lushnje', 'Shetitorja e Palmave', '12', 55554);

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE `bid` (
  `costumer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `offer` int(11) NOT NULL,
  `sessionid` varchar(255) DEFAULT NULL,
  `payed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`costumer_id`, `product_id`, `offer`, `sessionid`, `payed`) VALUES
(1, 1, 12000, '38383865316334366461333965376264333637613663396333643863326362643038663162396435', 0),
(1, 4, 730, '63383238633230666133656631633932666136313561306238383161393637306164303564316630', 0),
(66, 3, 620001, '65623263393337643930396236386265613032623035666333393838396665633131353432303139', 0),
(66, 4, 740, '64623964366164626139623065626633386335663965623432643661663431613435646232663365', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_picture`) VALUES
(1, 'Tv Audio', 'tvaudio-category.jpg'),
(2, 'Cameras', 'cameras-category.jpg'),
(3, 'Fine Jewelry', 'finejewelry-category.jpg'),
(4, 'Sporting Goods', 'sportinggoods-category.jpg'),
(7, 'Arts', 'arts.png'),
(8, 'Cars', 'cars.jpg'),
(9, 'Movies memorabilia', 'movies.jpg'),
(10, 'Old electronics', 'electronics.jpg'),
(11, 'Singers memorabilia', 'singers.jpg'),
(12, 'Sports memorabilia', 'sports.jpg'),
(13, 'World War II memorabilia', 'ww2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `costumer`
--

CREATE TABLE `costumer` (
  `costumer_id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `costumer`
--

INSERT INTO `costumer` (`costumer_id`, `user_id`, `first_name`, `last_name`, `phone_number`) VALUES
(1, 61, 'Joel', 'Tafilaj', '355696783553'),
(66, 79, 'Aldo', 'Haka', ''),
(67, 80, 'test5', 'test5', ''),
(68, 81, 'test7', 'test7', '');

-- --------------------------------------------------------

--
-- Table structure for table `homepage`
--

CREATE TABLE `homepage` (
  `id` int(11) NOT NULL,
  `carousel_image1` varchar(50) NOT NULL,
  `carousel_image2` varchar(50) NOT NULL,
  `carousel_image3` varchar(50) NOT NULL,
  `cooming_soon_header` varchar(50) NOT NULL,
  `gallery_header` varchar(50) NOT NULL,
  `discover_header` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homepage`
--

INSERT INTO `homepage` (`id`, `carousel_image1`, `carousel_image2`, `carousel_image3`, `cooming_soon_header`, `gallery_header`, `discover_header`, `email`, `phone_number`, `location`) VALUES
(1, 'auction3.jpg', 'auction2.jpg', 'auction1.jpg', 'Products coming soon...', 'Gallery', 'Discover Categories', 'huskiescyber@gmail.com', '+35569678553', 'Road xxxx km Y , Albania, Tirana');

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `picture_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `picture_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`picture_id`, `product_id`, `picture_url`) VALUES
(1, 1, 'product-1-image-1.jpg'),
(2, 1, 'product-1-image-2.jpg'),
(3, 1, 'product-1-image-3.jpg'),
(4, 3, 'product-2-image-1.jpg'),
(5, 3, 'product-2-image-2.jpg'),
(7, 4, 'product-3-image-1.jpg'),
(8, 4, 'product-3-image-2.jpg'),
(9, 5, 'product-4-image-1.jpg'),
(10, 5, 'product-4-image-2.jpg'),
(11, 6, 'product-5-image-1.jpg'),
(12, 6, 'product-5-image-2.jpg'),
(13, 6, 'product-5-image-3.jpg'),
(14, 7, 'product-6-image-1.jpg'),
(15, 7, 'product-6-image-2.jpg'),
(16, 7, 'product-6-image-3.jpg'),
(17, 8, 'product-7-image-1.jpg'),
(18, 8, 'product-7-image-2.jpg'),
(19, 8, 'product-7-image-3.jpg'),
(20, 9, 'product-8-image-1.jpg'),
(21, 9, 'product-8-image-2.jpg'),
(22, 9, 'product-8-image-3.jpg'),
(23, 5, 'product-5-image-3.jpg'),
(37, 21, 'product-3-image-1.jpg'),
(38, 21, 'product-6-image-1.jpg'),
(39, 21, 'product-7-image-3.jpg'),
(40, 21, 'product-2-image-2.jpg'),
(41, 22, 'Street Scene in Montmartre.jpg'),
(42, 23, 'the weeping woman.jpg'),
(43, 24, 'a_lacquered-wood_arm_rest_inlaid_with_mother-of-pearl_joseon_dynasty, the robert moore collection of korean art.jpg'),
(44, 25, 'xk_150_1_0.jpg'),
(45, 25, 'xk_150_2.jpg'),
(46, 26, 'djet_1.jpg'),
(47, 26, 'djet_2.jpg'),
(48, 27, 'The Avengers Framed 8x10 Reprint Photo With Stan Lee & Cast Facsimile Signatures.jpg'),
(49, 28, 'Daniel Radcliffe Signed Harry Potter And The Sorcerers Stone Full Size Poster.jpg'),
(50, 29, '30 years old super nes nintendo, priceless in gaming history.jpg'),
(51, 30, 'MUHAMMAD ALI TRAINING-WORN FIGHT ROBE.jpg'),
(52, 31, 'ww2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `salessman_id` int(11) NOT NULL,
  `starting_price` int(11) NOT NULL,
  `bid_now` int(11) DEFAULT NULL,
  `highies_bidder` int(11) DEFAULT NULL,
  `sale_start` datetime DEFAULT NULL,
  `sale_end` datetime DEFAULT NULL,
  `description` varchar(2500) NOT NULL,
  `category_id` int(11) NOT NULL,
  `picture_cover_url` varchar(255) NOT NULL,
  `email_checkout` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `salessman_id`, `starting_price`, `bid_now`, `highies_bidder`, `sale_start`, `sale_end`, `description`, `category_id`, `picture_cover_url`, `email_checkout`) VALUES
(1, 'Sony High Tech Camera', 11, 4000, 12000, 1, '2021-06-03 00:24:00', '2021-06-07 15:32:44', 'High Tech camera from sonyHigh Tech camera from sonyHigh Tech camera from sonyHigh Tech camera from sonyHigh Tech camera from sonyHigh Tech camera from sonyHigh Tech camera from sonyHigh Tech camera from sony', 2, 'product-1-image-1.jpg', 0),
(3, 'Harbeth Bookshelf type speaker', 11, 60000, 620001, 66, '2021-05-05 18:20:09', '2021-06-07 08:59:59', 'Harbetgher level of performor Harbeth with its novel approach including aluminum hard dome tweeters, and in 2004, the HL5 was reborn as the Super HL5, a three-way system with the addition of titanium hard dome super tweeters. In 2004, the HL5 was reborn as the Super HL5, a 3-way with a titanium hard dome super tweeter, and adopted the RADIAL diaphragm, a mid- to low-frequency cone that had been under development since the 1990s, adding new values of resolution and power to the neat sound quality that is unique to Harbeth.\r\nIn 2015, Harbeth completed the \"Super HL5 plus\" based on a number of technical re-examinations to further enhance its potential. The remarkable improvement in performance an', 1, 'product-2-image-1.jpg', 0),
(4, 'DDoptics Pirschler 10x56 Generation 3', 11, 720, 740, 66, '2021-06-01 18:00:00', '2021-06-30 08:00:00', 'Das neue ultrahelle und unverwüstliche Nacht & Jagdfernglas Pirschler 10x56 Abbe-König / Magnesium\r\nist die lange erwartete Neuauflage unseres erfolgreichen Fernglases Pirschler 10x56. Neben Verbesserungen der optischen Eigenschaften, ist dieses Fernglas besonders auf Langlebigkeit konzipiert. Modernste Materialien und Fertigungsverfahren aus dem Flugzeugbau haben dieses 10x56 Fernglas darüber hinaus auch noch deutlich leichter werden lassen als das Vorgängermodell.\r\n \r\nStabilität und Robustheit des Fernglases\r\nAn dem neuen „Pirschler“-Fernglas findet sich (die Stativschutzkappe ausgenommen) kein Gramm Kunststoff, weder am Körper selbst, noch an Verschleißteilen. Körper und Brücke sind aus einer ultraharten aber extrem leichten Magnesiumlegierung aus dem Flugzeugbau und machen das Fernglas nahezu unzerbrechlich. Zusätzlicher Vorteil: Das Magnesium senkt das Gesamtgewicht um stattliche 70 g auf 1150 g. Der Diopter (Verstellbereich +-4) befindet sich wegen der besseren Funktionalität nicht mehr am Fokussierrad, sondern am rechten Okular . All diese Bedienungselemente – Diopter, Okular , Fokussierend – bestehen aus Duraluminium und sind damit Garant für eine große Langzeitbelastung. Eine sogenannte „Best Grip“- Armierung an der Außenseite des Körpers verhindert ein Abrutschen der Hände. Damit wird das einhändige Greifen und Halten dieses kompakten Fernglases auch mit Handschuhen angenehm komfortabel und sicher.', 2, 'product-3-image-1.jpg', 0),
(5, 'Sony E PZ 16-50mm f/3.5-5.6 OSS Lens for Sony E-Mo', 11, 120, 141, 66, '2021-06-01 18:00:00', '2021-06-10 17:00:00', 'Compact and lightweight its clever retracting mechanism, this zoom lens collapses to just 3/16\" making it the perfect choice for on-the-go shooting when a compact, lightweight lens is ideal. Measuring just 3/16\" when fully retracted, this retractable zoom lens is super compact and easy to carry so you can quickly whip out your camera and spontaneously grab shots as they occur. It\'s perfect for traveling and other scenarios that require a lightweight, compact camera and lens combo. It covers a 16 mm to 50 mm range for flexible shooting, and is equipped with one ED (extra-low dispersion) and four aspherical elements, resulting in a high-performance lens that is surprisingly compact.', 2, 'product-4-image-1.jpg', 0),
(6, 'Designer Vintage 14KT Yellow Gold Wheel Broken Hea', 11, 5999, NULL, NULL, '2021-06-03 18:30:00', '2021-06-05 20:55:54', 'Description:\r\n\r\nVery Good Condition\r\nTotal Length: 24\"\r\nSpring Ring Closure\r\nPendant Length: 1.75\'\r\nCondition:\r\n\r\nPre-Owned\r\nScratches to hardware.', 3, 'product-5-image-1.jpg', 0),
(7, 'LADIES ROLEX DIAMOND SAPPHIRE DATEJUST 18K WHITE G', 11, 869, 130000, 1, '2021-06-02 17:00:00', '2021-06-09 23:50:00', 'Model:	Rolex Lady-Datejust	Dial Color:	Blue\r\nDepartment:	Women	Band Color:	Silver\r\nWatch Shape:	Round	Reference Number:	6917\r\nGender:	Women\'s	Display:	Analog\r\nCase Color:	Silver	Lug Width:	13mm\r\nStone:	Diamond, Sapphire	Brand:	Rolex\r\nAge Group:	Adult	Case Size:	26mm\r\nSeller\'s Warranty:	Yes	Number of Jewels:	28\r\nType of Certificate:	Pure Watches Certificate of Authenticity	Water Resistance:	Water Resistant\r\nFace Color:	Blue	Country/Region of Manufacture:	Switzerland\r\nCase Material:	Stainless Steel	Style:	Luxury: Dress Styles\r\nCertificate:	Yes	Caseback:	Screwback Case\r\nDial:	Rolex Dial w/ Added Genuine Diamond Markers	Indices:	12-Hour Dial\r\nBand:	Custom Jubilee Band (Upgrade to Rolex Avail)	Band Material:	Stainless Steel\r\nMovement:	Mechanical (Automatic)	Features:	Date, Diamonds, Sapphires, 12-Hour Dial, Chronometer, Date Indicator, Sapphire Crystal, Screwdown Crown, Seconds Hand, Swiss Made, Swiss Movement', 3, 'product-6-image-1.jpg', 0),
(8, 'Cleto Reyes Extra Padding Boxing Gloves with Forza', 11, 120, NULL, NULL, '2021-06-05 10:00:00', '2021-06-06 18:00:00', 'The Cleto Reyes Extra Padding Boxing Gloves feature an attached thumb which prevents eye injury and also prevents thumb from being broken or sprained. The two inches of padding gives you even more protection to handle your biggest hits and punches. The water-repellent nylon lining prevents moisture from entering padding. Available in 14 or 16 ounces. The Forza Handwraps allow a tight fit that contours to your wrist while lending vital support to your fist. The wraps give you a long length of 180\", or 4.5 meters, to safely wrap your hands and wrists while punching, striking and fighting your way to the top! The Forza Mini Boxing Glove Keychain boldly states your passion for the sport and still fits nicely in your pocket or purse. It comes complete with a secure metal chain and ring. The details are lifelike and realistic down to the laces! Perfect for any boxing and combat sports athletes, officials, fans, and more.', 4, 'product-7-image-1.jpg', 0),
(9, 'Reebok Legacy Lifter II FU9459 Mens Black Athletic', 11, 120, NULL, NULL, '2021-06-27 22:59:59', '2021-06-30 18:00:00', '\r\nCondition:	\r\nNew with box: A brand-new, unused, and unworn item (including handmade items) in the original packaging (such as the original box or bag) and/or with the original tags attached. See all condition definitions	Brand:	Reebok\r\nShoe Width:	M	Style:	Sneaker\r\nPerformance/Activity:	Weightlifting	Color:	Black\r\nFeatures:	Not Specified	Department:	Men\r\nPattern:	None	Type:	Athletic\r\nUpper Material:	Synthetic	Product Line:	Reebok Legacy Lifter II\r\nVintage:	No	Model:	Reebok Legacy Lifter II\r\nClosure:	Strap	Country/Region of Manufacture:	Myanmar', 4, 'product-8-image-1.jpg', 0),
(21, 'asdasdsadads', 11, 10, NULL, NULL, '2021-06-07 23:46:00', '2021-06-09 23:44:00', 'saodsaldsaoasdoasdsaodsaldsa oasdoasdsaodsaldsaoasdoasdsaodsaldsaoasdoasd saodsaldsaoasdoasdsaodsal dsaoasdoasdsaodsaldsaoasdoasd saodsaldsaoasdoasdsaodsaldsaoasdoasdsaodsaldsaoasdoasd saodsaldsaoasdoasdsaodsaldsaoasdoasdsaodsaldsaoasdoasd', 1, 'product-4-image-1.jpg', 0),
(22, 'Street Scene in Montmartre', 12, 10000, NULL, NULL, '2021-06-09 17:00:00', '2021-06-30 17:00:00', 'A painting of Paris by Vincent van Gogh, barely seen by the public after being stashed in a French family s private collection for more than a century, sold at auction Thursday for 13.1 million euros ($15.4 million).\r\nStreet scene in Montmartre was painted in the spring of 1887, three years before the Dutch master is believed to have died by suicide. It fetched significantly more than the top estimate of 8 million euros ($9.4 million) during a sale at Sothebys in Paris.\r\nBut the auction, which also saw works by the likes of Edgar Degas and René Magritte go under the hammer, generated an amount of confusion, with Sothebys initially declaring that the Van Gogh had sold for over 16 million euros ($19.1 million). Following what a Sothebys spokesperson called a bidding error, the painting was then offered to buyers again at the end of the sale, with a second round of bidding resulting in the lower final price.\r\nVan Gogh s painting shows Parisians walking through a rural and sparse landscape in Montmartre, a historic district that today is one of the city s most popular destinations.\r\nThe moment we set eyes on this painting for the first time we were immediately captivated, said Claudia Mercier and Fabien Mirabaud of Parisian auction house Mirabaud Mercier, who discovered the work.\r\nIt is with great pleasure that we can now present this to the world, after being treasured by the same French family for a century, they said in a statement prior to the sale.\r\nThe painting is part of a series of works representing the famed Moulin de la Galette, a windmill turned into a dance hall in Montmartre. The district is still popular among tourists and locals for its village feel, but the surrounding streets have been built up and now bear little resemblance to the scene in the painting.', 7, 'Street Scene in Montmartre.jpg', 0),
(23, 'The weeping woman', 12, 20000, NULL, NULL, '2021-06-09 17:13:00', '2021-07-10 17:13:00', 'The Weeping Woman is an oil on canvas painting by Pablo Picasso, which he created in France in 1937. The painting depicts Dora Maar, Picasso s mistress and muse.\r\nThe Weeping Woman is an oil on canvas painting by Pablo Picasso, which he created in France in 1937. The painting depicts Dora Maar, Picasso s mistress and muse.\r\nThe Weeping Woman is an oil on canvas painting by Pablo Picasso, which he created in France in 1937. The painting depicts Dora Maar, Picasso s mistress and muse.\r\nThe Weeping Woman is an oil on canvas painting by Pablo Picasso, which he created in France in 1937. The painting depicts Dora Maar, Picasso s mistress and muse.\r\nThe Weeping Woman is an oil on canvas painting by Pablo Picasso, which he created in France in 1937. The painting depicts Dora Maar, Picasso s mistress and muse.\r\nThe Weeping Woman is an oil on canvas painting by Pablo Picasso, which he created in France in 1937. The painting depicts Dora Maar, Picasso s mistress and muse.', 7, 'the weeping woman.jpg', 0),
(24, 'A lacquered wood arm rest inlaid with mother of pe', 12, 15000, NULL, NULL, '2021-06-09 17:16:00', '2021-08-05 17:16:00', 'A Scalloped Small Celadon Bowl\r\nKoryo dynasty (13th century)\r\nMoulded in the form of a flower and incised on each of the interior petals with scalloped clouds surrounding a center roundel of three chrysanthemum florets in white slip and white and iron-slip birds within successive bands of white-slip lines and pulloch o and white and iron-slip scallops; the exterior panels inlaid in white and iron slip with double-chrysanthemums; covered overall by a greyish green celadon glaze\r\n3½in. (8.8cm.) diameter; 1¼in. (13.3cm.) high', 7, 'a_lacquered-wood_arm_rest_inlaid_with_mother-of-pearl_joseon_dynasty, the robert moore collection of korean art.jpg', 0),
(25, 'Jaguar xk 150 comes straight from 80s', 12, 40000, NULL, NULL, '2021-06-09 17:22:00', '2021-08-07 17:23:00', 'Jaguar is a British luxury car manufacturer located in Coventry, England. Founded by Sir William Lyons in 1922 as a manufacturer of motorcycle sidecars, the company s subsequent car designs - such as the XK120 and E-type - are widely regarded to be some of the most beautiful in automotive history. Jaguar is currently part of Jaguar Land Rover, which was purchased by Tata Motors from the Ford Motor Company in January 2008.\r\nJaguar is a British luxury car manufacturer located in Coventry, England. Founded by Sir William Lyons in 1922 as a manufacturer of motorcycle sidecars, the company s subsequent car designs - such as the XK120 and E-type - are widely regarded to be some of the most beautiful in automotive history. Jaguar is currently part of Jaguar Land Rover, which was purchased by Tata Motors from the Ford Motor Company in January 2008.\r\nJaguar is a British luxury car manufacturer located in Coventry, England. Founded by Sir William Lyons in 1922 as a manufacturer of motorcycle sidecars, the company s subsequent car designs - such as the XK120 and E-type - are widely regarded to be some of the most beautiful in automotive history. Jaguar is currently part of Jaguar Land Rover, which was purchased by Tata Motors from the Ford Motor Company in January 2008.\r\nJaguar is a British luxury car manufacturer located in Coventry, England. Founded by Sir William Lyons in 1922 as a manufacturer of motorcycle sidecars, the company s subsequent car designs - such as the XK120 and E-type - are widely regarded to be some of the most beautiful in automotive history. Jaguar is currently part of Jaguar Land Rover, which was purchased by Tata Motors from the Ford Motor Company in January 2008.', 8, 'xk_150_1_0.jpg', 0),
(26, '1962 Djet, 4-speed manual transmission', 12, 30000, NULL, NULL, '2021-06-09 17:27:00', '2021-07-10 17:27:00', 'The Matra Djet is a French sports car that was originally designed and sold by René Bonnet. As the Bonnet Djet it was the world s first rear mid-engined production road car. Different versions of the car were produced from 1962 until 1967 and sold under a variety of names that included René Bonnet Djet, Matra-Bonnet Djet, Matra Sports Djet and finally, Matra Sports Jet.\r\nThe Matra Djet is a French sports car that was originally designed and sold by René Bonnet. As the Bonnet Djet it was the world s first rear mid-engined production road car. Different versions of the car were produced from 1962 until 1967 and sold under a variety of names that included René Bonnet Djet, Matra-Bonnet Djet, Matra Sports Djet and finally, Matra Sports Jet.\r\nThe Matra Djet is a French sports car that was originally designed and sold by René Bonnet. As the Bonnet Djet it was the world s first rear mid-engined production road car. Different versions of the car were produced from 1962 until 1967 and sold under a variety of names that included René Bonnet Djet, Matra-Bonnet Djet, Matra Sports Djet and finally, Matra Sports Jet.\r\nThe Matra Djet is a French sports car that was originally designed and sold by René Bonnet. As the Bonnet Djet it was the world s first rear mid-engined production road car. Different versions of the car were produced from 1962 until 1967 and sold under a variety of names that included René Bonnet Djet, Matra-Bonnet Djet, Matra Sports Djet and finally, Matra Sports Jet.', 8, 'djet_1.jpg', 0),
(27, 'The Avengers Framed 8x10 Reprint Photo With Stan L', 12, 10000, NULL, NULL, '2021-06-17 17:29:00', '2021-07-28 17:29:00', 'Description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description', 9, 'The Avengers Framed 8x10 Reprint Photo With Stan Lee & Cast Facsimile Signatures.jpg', 0),
(28, 'Daniel Radcliffe Signed Harry Potter And The Sorce', 12, 10000, NULL, NULL, '2021-06-09 17:33:00', '2021-07-10 17:33:00', 'Description description description description description description description description description description description description description description description description description description description description description description description description', 9, 'Daniel Radcliffe Signed Harry Potter And The Sorcerers Stone Full Size Poster.jpg', 0),
(29, '30 years old super NES Nintendo, priceless in gami', 12, 5000, NULL, NULL, '2021-06-09 17:34:00', '2021-06-23 17:35:00', 'Description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description', 10, '30 years old super nes nintendo, priceless in gaming history.jpg', 0),
(30, 'MUHAMMAD ALI TRAINING WORN FIGHT ROBE', 12, 10000, NULL, NULL, '2021-06-09 17:36:00', '2021-06-30 17:36:00', 'Description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description', 12, 'MUHAMMAD ALI TRAINING-WORN FIGHT ROBE.jpg', 0),
(31, 'SPITFIRE K5054 MAIDEN FLIGHT PRESENTATION TROPHY M', 12, 1000, NULL, NULL, '2021-06-09 17:44:00', '2021-07-02 17:44:00', 'Description  description description description description description description description description description description description description description description description description description description description description description description description description description description description', 13, 'ww2.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salessman`
--

CREATE TABLE `salessman` (
  `salessman_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `totalN_products` int(50) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salessman`
--

INSERT INTO `salessman` (`salessman_id`, `user_id`, `first_name`, `last_name`, `phone_number`, `totalN_products`) VALUES
(11, 78, 'Ergi', 'Hasko', '', 0),
(12, 82, 'test4', 'test4', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `vkey` varchar(255) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `vkey`, `verified`, `password`, `user_type`, `is_active`) VALUES
(61, 'joel.tafilaj', 'tafilaj82@gmail.com', '65366162333035386666346262366135393262663765363839396136363731336261386431313637', 1, 'b40d03386fb8fd7dc6ca9c6f8d680dfc58d60fd6ea72c63f573cc5bfbb09695746a849c91517c235cdfeaca4e734208f184bc08aae06797748988e95928f80b1', 'costumer', 0),
(78, 'ergi.eh7', 'joeltafilaj4@gmail.com', '66623562323666313261313336353836323862616436343138633336623132656666306639373432', 1, 'b40d03386fb8fd7dc6ca9c6f8d680dfc58d60fd6ea72c63f573cc5bfbb09695746a849c91517c235cdfeaca4e734208f184bc08aae06797748988e95928f80b1', 'salessman', 1),
(79, 'aldohaka11', 'joel.tafilaj@fshnstudent.info', '37333964333566666165353063313136393032373466346438663833623336333537356336643963', 1, 'b40d03386fb8fd7dc6ca9c6f8d680dfc58d60fd6ea72c63f573cc5bfbb09695746a849c91517c235cdfeaca4e734208f184bc08aae06797748988e95928f80b1', 'costumer', 0),
(80, 'test5', 'jonduljja@live.com', '34643336333837353666613662373662343630643861613937373431363961353136356431343039', 0, '2bbe0c48b91a7d1b8a6753a8b9cbe1db16b84379f3f91fe115621284df7a48f1cd71e9beb90ea614c7bd924250aa9e446a866725e685a65df5d139a5cd180dc9', 'costumer', 0),
(81, 'test7', 'jondulja@gmail.com', '63313039353637333862303839393339646434643730666534343363326632343039393164336331', 1, '2bbe0c48b91a7d1b8a6753a8b9cbe1db16b84379f3f91fe115621284df7a48f1cd71e9beb90ea614c7bd924250aa9e446a866725e685a65df5d139a5cd180dc9', 'costumer', 0),
(82, 'test4', 'jondulja@live.com', '63633636333565336133313930303766623464303831656263666661663239346230633431366130', 1, '2bbe0c48b91a7d1b8a6753a8b9cbe1db16b84379f3f91fe115621284df7a48f1cd71e9beb90ea614c7bd924250aa9e446a866725e685a65df5d139a5cd180dc9', 'salessman', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`user_id`, `product_id`) VALUES
(1, 4),
(1, 8),
(1, 9),
(66, 1),
(66, 3),
(66, 5),
(66, 6),
(67, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`costumer_id`,`product_id`),
  ADD KEY `product_iddd` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `costumer`
--
ALTER TABLE `costumer`
  ADD PRIMARY KEY (`costumer_id`),
  ADD KEY `costumer_ibfk_1` (`user_id`);

--
-- Indexes for table `homepage`
--
ALTER TABLE `homepage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`picture_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `salessman_idd` (`salessman_id`),
  ADD KEY `bider_id` (`highies_bidder`);

--
-- Indexes for table `salessman`
--
ALTER TABLE `salessman`
  ADD PRIMARY KEY (`salessman_id`),
  ADD KEY `salessman_ibfk_1` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `product_idd` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `costumer`
--
ALTER TABLE `costumer`
  MODIFY `costumer_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `homepage`
--
ALTER TABLE `homepage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `salessman`
--
ALTER TABLE `salessman`
  MODIFY `salessman_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `costumer_iddd` FOREIGN KEY (`costumer_id`) REFERENCES `costumer` (`costumer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_iddd` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `costumer`
--
ALTER TABLE `costumer`
  ADD CONSTRAINT `costumer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `bider_id` FOREIGN KEY (`highies_bidder`) REFERENCES `costumer` (`costumer_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `salessman_idd` FOREIGN KEY (`salessman_id`) REFERENCES `salessman` (`salessman_id`);

--
-- Constraints for table `salessman`
--
ALTER TABLE `salessman`
  ADD CONSTRAINT `salessman_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `costumer_id` FOREIGN KEY (`user_id`) REFERENCES `costumer` (`costumer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_idd` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
