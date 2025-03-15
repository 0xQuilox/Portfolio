-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2022 at 11:49 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mift_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(100) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `admin_image` text NOT NULL,
  `admin_country` text NOT NULL,
  `admin_about` text NOT NULL,
  `admin_contact` varchar(255) NOT NULL,
  `admin_job` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`, `admin_image`, `admin_country`, `admin_about`, `admin_contact`, `admin_job`) VALUES
(2, 'Chelsea manu', 'chelsea@gmail.com', 'manu', 'person_3.jpg', 'England', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt dolore eius quos laborum nihil consectetur?', '090878267464', 'Web Developer/Web DEsigner'),
(3, 'Ayomide Ayoka', 'ayomide2000@gmail.com', 'ayo', 'person_1.jpg', 'Nigeria', 'I am ayomide ayoka, a senior software engineer. I hail from the ancient city of ibadan, Oyo State NIGERIA.', '090987654321', 'Software engineer / tech enthusiast');

-- --------------------------------------------------------

--
-- Table structure for table `boxes_section`
--

CREATE TABLE `boxes_section` (
  `box_id` int(100) NOT NULL,
  `box_title` text NOT NULL,
  `box_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `boxes_section`
--

INSERT INTO `boxes_section` (`box_id`, `box_title`, `box_desc`) VALUES
(1, 'Best Products', ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo ab et eligendi corrupti itaque quam nobis delectus, unde sed possimus facilis reiciendis expedita, velit ipsa ea fugiat culpa voluptates quas.'),
(2, 'Best Offers', ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo ab et eligendi corrupti itaque quam nobis delectus, unde sed possimus facilis reiciendis expedita, velit ipsa ea fugiat culpa voluptates quas.'),
(3, '100% Satisfaction', ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo ab et eligendi corrupti itaque quam nobis delectus, unde sed possimus facilis reiciendis expedita, velit ipsa ea fugiat culpa voluptates quas.');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL,
  `size` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`p_id`, `ip_add`, `qty`, `size`) VALUES
(3, '::1', 4, 'Small');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL,
  `cat_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_desc`) VALUES
(1, 'Cat Men', 'This Cat Men has been updated'),
(2, 'Women', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, impedit sit esse voluptatum ipsum architecto!'),
(3, 'Kids', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, impedit sit esse voluptatum ipsum architecto!'),
(4, 'Other', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, impedit sit esse voluptatum ipsum architecto!');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(100) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_pass` varchar(255) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_cty` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_image` varchar(100) NOT NULL,
  `customer_ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_cty`, `customer_contact`, `customer_address`, `customer_image`, `customer_ip`) VALUES
(3, 'Olushoga', 'olushoga30@gmail.com', 'oluboy', 'NewZealand', 'Atrico', '+345-980-897-987', 'No 247, Alausa Contronio Atrico , NewZealand.', 'person_4.jpg', '::1'),
(5, 'olayimika adepoju', 'oladepoju100@gmail.com', 'olupoju', 'England', 'Manchester', '+401-980-811-900', 'No 247, Alausa Contronio Atrico , Manchester.', 's-img.jpg', '::1'),
(6, 'bankole', 'bami10@yahoomail.com', 'bami', 'Nigeria', 'Ikeja', '09087653567', 'No 5, Alausa ikeja lagos , Nigeria.', 'person_4.jpg', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

CREATE TABLE `customer_orders` (
  `order_id` int(100) NOT NULL,
  `customer_id` int(100) NOT NULL,
  `due_amount` int(100) NOT NULL,
  `invoice_no` int(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `size` text NOT NULL,
  `order_date` date NOT NULL,
  `order_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_orders`
--

INSERT INTO `customer_orders` (`order_id`, `customer_id`, `due_amount`, `invoice_no`, `qty`, `size`, `order_date`, `order_status`) VALUES
(66, 6, 1000, 830320041, 5, 'Large', '2020-12-23', 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(100) NOT NULL,
  `invoice_no` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `payment_mode` text NOT NULL,
  `ref_no` int(100) NOT NULL,
  `code` int(100) NOT NULL,
  `payment_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pending_orders`
--

CREATE TABLE `pending_orders` (
  `order_id` int(100) NOT NULL,
  `customer_id` int(100) NOT NULL,
  `invoice_no` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `size` text NOT NULL,
  `order_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pending_orders`
--

INSERT INTO `pending_orders` (`order_id`, `customer_id`, `invoice_no`, `product_id`, `qty`, `size`, `order_status`) VALUES
(65, 6, 830320041, 10, 5, 'Large', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `p_cat_id` int(100) NOT NULL,
  `cat_id` int(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_title` text NOT NULL,
  `product_img1` text NOT NULL,
  `product_img2` text NOT NULL,
  `product_img3` text NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_keywords` text NOT NULL,
  `product_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `p_cat_id`, `cat_id`, `date`, `product_title`, `product_img1`, `product_img2`, `product_img3`, `product_price`, `product_keywords`, `product_desc`) VALUES
(3, 3, 3, '2022-10-10 10:09:45', 'Boys Puffer Coat With Detachable Hood 1', 'boys-Puffer-Coat-With-Detachable-Hood-1.jpg', '', '', 120, 'Hood', '<p>badejo is a gonner one of the gratest rival red devils ever had in ibadan microgold</p>'),
(4, 5, 2, '2022-10-10 10:18:38', 'g polos tshirt-1', 'g-polos-tshirt-1.jpg', '', '', 100, 'Shirt', '<p>100%&nbsp; Quality&nbsp; T-Shirt&nbsp;</p>'),
(7, 4, 0, '2022-10-10 10:30:07', 'Man-Adidas-Suarez-Slop-On-1', 'Man-Adidas-Suarez-Slop-On-1.jpg', '', '', 66, 'Sneakers', '<p>Nice Sneakers for Jugging and Sport</p>'),
(13, 5, 1, '2022-10-10 12:39:54', 'Boys Polo T-Shirt', 'polos-tshirt-1.jpg', 'polos-tshirt-2.jpg', '', 40, 'Casuals', '<p>100% quality T-shirt for young lads age (6-15) years.Made in Ibadan,Nigeria.</p>'),
(14, 1, 0, '2022-10-10 13:21:10', 'Red-Winter-jacket-1', 'Red-Winter-jacket-1.jpg', 'Red-Winter-jacket-2.jpg', 'Red-Winter-jacket-3.jpg', 96, 'Hood', '<p>100% quality silk.made with latest silk mateerial in town</p>');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `p_cat_id` int(100) NOT NULL,
  `p_cat_title` text NOT NULL,
  `p_cat_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`p_cat_id`, `p_cat_title`, `p_cat_desc`) VALUES
(1, 'Jackets Jean', 'Jackets changed to JACKET JEAN.'),
(2, 'Accessories', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi sint iste placeat. Quo, deleniti quaerat.'),
(3, 'Coats', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi sint iste placeat. Quo, deleniti quaerat.'),
(4, 'Shoes', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi sint iste placeat. Quo, deleniti quaerat.'),
(5, 'T-Shirts', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi sint iste placeat. Quo, deleniti quaerat.');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slide_id` int(100) NOT NULL,
  `slide_name` varchar(255) NOT NULL,
  `slide_image` text NOT NULL,
  `slide_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slide_id`, `slide_name`, `slide_image`, `slide_url`) VALUES
(9, 'Edited slide number 1', 'about_1.jpg', 'http://localhost/m-dev-store/admin_area/slides_images/about_1.jpg'),
(10, 'Edited slide number 2', 'hero_2.jpg', 'http://localhost/m-dev-store/admin_area/slides_images/hero_2.jpg'),
(12, 'slide number 4', 'product_1.png', 'http://localhost/m-dev-store/admin_area/slides_images/product_1.png'),
(18, 'slide number 5', 'person_1.jpg', 'www.ayomioka.com');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `term_id` int(100) NOT NULL,
  `term_title` varchar(100) NOT NULL,
  `term_link` varchar(100) NOT NULL,
  `term_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`term_id`, `term_title`, `term_link`, `term_desc`) VALUES
(1, 'Terms & Conditions', 'termLink', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat doloremque, quod doloribus voluptatum tempora odit, illo commodi natus quasi cum impedit repudiandae voluptatibus ex ad facilis sit quisquam soluta exercitationem?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat doloremque, quod doloribus voluptatum tempora odit, illo commodi natus quasi cum impedit repudiandae voluptatibus ex ad facilis sit quisquam soluta exercitationem?hello'),
(2, 'Refund Policy', 'refundLink', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat doloremque, quod doloribus voluptatum tempora odit, illo commodi natus quasi cum impedit repudiandae voluptatibus ex ad facilis sit quisquam soluta exercitationem?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat doloremque, quod doloribus voluptatum tempora odit, illo commodi natus quasi cum impedit repudiandae voluptatibus ex ad facilis sit quisquam soluta exercitationem?'),
(3, 'Promo & Other Term Conditions', 'PromoTermConditions', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat doloremque, quod doloribus voluptatum tempora odit, illo commodi natus quasi cum impedit repudiandae voluptatibus ex ad facilis sit quisquam soluta exercitationem?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat doloremque, quod doloribus voluptatum tempora odit, illo commodi natus quasi cum impedit repudiandae voluptatibus ex ad facilis sit quisquam soluta exercitationem?'),
(4, 'Bonanza', 'bananzaLink', '\nLorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil debitis dolore adipisci voluptas. Repudiandae ipsum architecto odio, accusamus, tempore itaque eum ipsam maiores perferendis, modi et eos nam consectetur quibusdam?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat doloremque, quod doloribus voluptatum tempora odit, illo commodi natus quasi cum impedit repudiandae voluptatibus ex ad facilis sit quisquam soluta exercitationem?');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `boxes_section`
--
ALTER TABLE `boxes_section`
  ADD PRIMARY KEY (`box_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `pending_orders`
--
ALTER TABLE `pending_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`p_cat_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`term_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `boxes_section`
--
ALTER TABLE `boxes_section`
  MODIFY `box_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_orders`
--
ALTER TABLE `customer_orders`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pending_orders`
--
ALTER TABLE `pending_orders`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
