-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2021 at 10:33 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

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
  `offer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`costumer_id`, `product_id`, `offer`) VALUES
(1, 3, 60000),
(66, 3, 61000);

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
(4, 'Sporting Goods', 'sportinggoods-category.jpg');

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
(66, 79, 'Aldo', 'Haka', '');

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
(23, 5, 'product-5-image-3.jpg');

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
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `salessman_id`, `starting_price`, `bid_now`, `highies_bidder`, `sale_start`, `sale_end`, `description`, `category_id`, `picture_cover_url`, `status`) VALUES
(1, 'Sony VPL-VW270ES', 11, 4000, 12000, 66, '2021-06-01 23:59:59', '2021-06-04 20:05:44', 'Sie wünschen sich ein mitreißendes 4K-Erlebnis in Kinoqualität auch in Ihrer Wohnung? Mit unserem Heimkinoprojektor VPL-VW270ES wird dieser Traum wahr.\r\nDenn mit unseren nativen 4K-SXRD-Paneln (4096 x 2160) liefert der VPL-VW270ES Bilder in echter 4K-Aufl', 1, 'product-1-image-1.jpg', 0),
(3, 'Harbeth Bookshelf type speaker', 11, 60000, 61000, 66, '2021-05-05 18:20:09', '2021-06-05 23:59:59', 'Harbetgher level of performor Harbeth with its novel approach including aluminum hard dome tweeters, and in 2004, the HL5 was reborn as the Super HL5, a three-way system with the addition of titanium hard dome super tweeters. In 2004, the HL5 was reborn as the Super HL5, a 3-way with a titanium hard dome super tweeter, and adopted the RADIAL diaphragm, a mid- to low-frequency cone that had been under development since the 1990s, adding new values of resolution and power to the neat sound quality that is unique to Harbeth.\r\nIn 2015, Harbeth completed the \"Super HL5 plus\" based on a number of technical re-examinations to further enhance its potential. The remarkable improvement in performance an', 1, 'product-2-image-1.jpg', 0),
(4, 'DDoptics Pirschler 10x56 Generation 3', 11, 720, NULL, NULL, '2021-06-01 18:00:00', '2021-06-04 08:00:00', 'Das neue ultrahelle und unverwüstliche Nacht & Jagdfernglas Pirschler 10x56 Abbe-König / Magnesium\r\nist die lange erwartete Neuauflage unseres erfolgreichen Fernglases Pirschler 10x56. Neben Verbesserungen der optischen Eigenschaften, ist dieses Fernglas besonders auf Langlebigkeit konzipiert. Modernste Materialien und Fertigungsverfahren aus dem Flugzeugbau haben dieses 10x56 Fernglas darüber hinaus auch noch deutlich leichter werden lassen als das Vorgängermodell.\r\n \r\nStabilität und Robustheit des Fernglases\r\nAn dem neuen „Pirschler“-Fernglas findet sich (die Stativschutzkappe ausgenommen) kein Gramm Kunststoff, weder am Körper selbst, noch an Verschleißteilen. Körper und Brücke sind aus einer ultraharten aber extrem leichten Magnesiumlegierung aus dem Flugzeugbau und machen das Fernglas nahezu unzerbrechlich. Zusätzlicher Vorteil: Das Magnesium senkt das Gesamtgewicht um stattliche 70 g auf 1150 g. Der Diopter (Verstellbereich +-4) befindet sich wegen der besseren Funktionalität nicht mehr am Fokussierrad, sondern am rechten Okular . All diese Bedienungselemente – Diopter, Okular , Fokussierend – bestehen aus Duraluminium und sind damit Garant für eine große Langzeitbelastung. Eine sogenannte „Best Grip“- Armierung an der Außenseite des Körpers verhindert ein Abrutschen der Hände. Damit wird das einhändige Greifen und Halten dieses kompakten Fernglases auch mit Handschuhen angenehm komfortabel und sicher.', 2, 'product-3-image-1.jpg', 1),
(5, 'Sony E PZ 16-50mm f/3.5-5.6 OSS Lens for Sony E-Mo', 11, 120, 141, 66, '2021-06-01 18:00:00', '2021-06-04 17:00:00', 'Compact and lightweight its clever retracting mechanism, this zoom lens collapses to just 3/16\" making it the perfect choice for on-the-go shooting when a compact, lightweight lens is ideal. Measuring just 3/16\" when fully retracted, this retractable zoom lens is super compact and easy to carry so you can quickly whip out your camera and spontaneously grab shots as they occur. It\'s perfect for traveling and other scenarios that require a lightweight, compact camera and lens combo. It covers a 16 mm to 50 mm range for flexible shooting, and is equipped with one ED (extra-low dispersion) and four aspherical elements, resulting in a high-performance lens that is surprisingly compact.', 2, 'product-4-image-1.jpg', 0),
(6, 'Designer Vintage 14KT Yellow Gold Wheel Broken Hea', 11, 5999, NULL, NULL, '2021-06-03 18:30:00', '2021-06-05 20:55:54', 'Description:\r\n\r\nVery Good Condition\r\nTotal Length: 24\"\r\nSpring Ring Closure\r\nPendant Length: 1.75\'\r\nCondition:\r\n\r\nPre-Owned\r\nScratches to hardware.', 3, 'product-5-image-1.jpg', 1),
(7, 'LADIES ROLEX DIAMOND SAPPHIRE DATEJUST 18K WHITE G', 11, 869, 1200, 1, '2021-06-02 17:00:00', '2021-06-02 23:50:00', 'Model:	Rolex Lady-Datejust	Dial Color:	Blue\r\nDepartment:	Women	Band Color:	Silver\r\nWatch Shape:	Round	Reference Number:	6917\r\nGender:	Women\'s	Display:	Analog\r\nCase Color:	Silver	Lug Width:	13mm\r\nStone:	Diamond, Sapphire	Brand:	Rolex\r\nAge Group:	Adult	Case Size:	26mm\r\nSeller\'s Warranty:	Yes	Number of Jewels:	28\r\nType of Certificate:	Pure Watches Certificate of Authenticity	Water Resistance:	Water Resistant\r\nFace Color:	Blue	Country/Region of Manufacture:	Switzerland\r\nCase Material:	Stainless Steel	Style:	Luxury: Dress Styles\r\nCertificate:	Yes	Caseback:	Screwback Case\r\nDial:	Rolex Dial w/ Added Genuine Diamond Markers	Indices:	12-Hour Dial\r\nBand:	Custom Jubilee Band (Upgrade to Rolex Avail)	Band Material:	Stainless Steel\r\nMovement:	Mechanical (Automatic)	Features:	Date, Diamonds, Sapphires, 12-Hour Dial, Chronometer, Date Indicator, Sapphire Crystal, Screwdown Crown, Seconds Hand, Swiss Made, Swiss Movement', 3, 'product-6-image-1.jpg', 1),
(8, 'Cleto Reyes Extra Padding Boxing Gloves with Forza', 11, 120, NULL, NULL, '2021-06-05 10:00:00', '2021-06-06 18:00:00', 'The Cleto Reyes Extra Padding Boxing Gloves feature an attached thumb which prevents eye injury and also prevents thumb from being broken or sprained. The two inches of padding gives you even more protection to handle your biggest hits and punches. The water-repellent nylon lining prevents moisture from entering padding. Available in 14 or 16 ounces. The Forza Handwraps allow a tight fit that contours to your wrist while lending vital support to your fist. The wraps give you a long length of 180\", or 4.5 meters, to safely wrap your hands and wrists while punching, striking and fighting your way to the top! The Forza Mini Boxing Glove Keychain boldly states your passion for the sport and still fits nicely in your pocket or purse. It comes complete with a secure metal chain and ring. The details are lifelike and realistic down to the laces! Perfect for any boxing and combat sports athletes, officials, fans, and more.', 4, 'product-7-image-1.jpg', 1),
(9, 'Reebok Legacy Lifter II FU9459 Mens Black Athletic', 11, 120, NULL, NULL, '2021-06-27 22:59:59', '2021-06-30 18:00:00', '\r\nCondition:	\r\nNew with box: A brand-new, unused, and unworn item (including handmade items) in the original packaging (such as the original box or bag) and/or with the original tags attached. See all condition definitions	Brand:	Reebok\r\nShoe Width:	M	Style:	Sneaker\r\nPerformance/Activity:	Weightlifting	Color:	Black\r\nFeatures:	Not Specified	Department:	Men\r\nPattern:	None	Type:	Athletic\r\nUpper Material:	Synthetic	Product Line:	Reebok Legacy Lifter II\r\nVintage:	No	Model:	Reebok Legacy Lifter II\r\nClosure:	Strap	Country/Region of Manufacture:	Myanmar', 4, 'product-8-image-1.jpg', 1);

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
(11, 78, 'Ergi', 'Hasko', '', 0);

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
(78, 'ergi.eh7', 'joeltafilaj4@gmail.com', '66623562323666313261313336353836323862616436343138633336623132656666306639373432', 1, 'b40d03386fb8fd7dc6ca9c6f8d680dfc58d60fd6ea72c63f573cc5bfbb09695746a849c91517c235cdfeaca4e734208f184bc08aae06797748988e95928f80b1', 'salessman', 0),
(79, 'aldohaka11', 'joel.tafilaj@fshnstudent.info', '37333964333566666165353063313136393032373466346438663833623336333537356336643963', 1, 'b40d03386fb8fd7dc6ca9c6f8d680dfc58d60fd6ea72c63f573cc5bfbb09695746a849c91517c235cdfeaca4e734208f184bc08aae06797748988e95928f80b1', 'costumer', 0);

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
(1, 6),
(1, 7),
(1, 8),
(66, 1),
(66, 3),
(66, 5),
(66, 6);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `costumer`
--
ALTER TABLE `costumer`
  MODIFY `costumer_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `homepage`
--
ALTER TABLE `homepage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `salessman`
--
ALTER TABLE `salessman`
  MODIFY `salessman_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

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
