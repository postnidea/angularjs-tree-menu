-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2015 at 06:08 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `menu`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms_product_categories`
--

CREATE TABLE IF NOT EXISTS `cms_product_categories` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `pid` bigint(20) DEFAULT NULL,
  `cat_image` varchar(200) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `alias` varchar(200) NOT NULL,
  `category_title` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=90 ;

--
-- Dumping data for table `cms_product_categories`
--

INSERT INTO `cms_product_categories` (`id`, `category_name`, `pid`, `cat_image`, `lft`, `rgt`, `alias`, `category_title`) VALUES
(66, 'Fresh', 56, '', 0, 0, 'fresh', ''),
(54, 'Leafy Vegetables ', 48, '', 0, 0, 'leafy-vegetables', ''),
(46, 'Women Shoes', 45, '', 0, 0, 'women-shoes', 'Women Shoes'),
(47, 'Men Shoes', 45, '', 0, 0, 'men-shoes', 'Men Shoes'),
(63, 'Fruit Drinks & Juices', 59, '', 0, 0, 'fruit-drinks-and-juices', ''),
(56, 'Meat ', 0, '', 0, 0, 'meat', ''),
(57, 'Bakery', 0, '', 0, 0, 'bakery', ''),
(58, 'Grocery', 0, '', 0, 0, 'grocery', ''),
(59, 'Beverages', 0, '', 0, 0, 'beverages', ''),
(60, 'Desserts', 0, '', 0, 0, 'desserts', ''),
(61, 'Packed foods', 0, '', 0, 0, 'packed-foods', ''),
(62, 'foods', 61, '', 0, 0, 'foods', ''),
(64, 'Soft drink', 59, '', 0, 0, 'soft-drink', ''),
(53, 'Organic F&V', 48, '', 0, 0, 'organic-fandv', ''),
(48, 'Fruits and Vegetables', 0, '', 0, 0, 'fruits-and-vegetables', ''),
(49, 'Cut Fruits & Vegetables', 48, '', 0, 0, 'cut-fruits-and-vegetables', ''),
(50, 'F&V Combo', 48, '', 0, 0, 'fandv-combo', ''),
(51, 'Fruits ', 48, '', 0, 0, 'fruits', ''),
(52, 'Green House Vegetables', 48, '', 0, 0, 'green-house-vegetables', ''),
(45, 'Shoes', 0, '', 0, 0, 'shoes', 'Shoes'),
(67, 'Frozen', 56, '', 0, 0, 'frozen', ''),
(70, 'Dry fuits', 49, '', 0, 0, 'dryfruits', 'Dry Fruits'),
(71, 'test123', 70, '', 0, 0, 'test123', 'test123'),
(72, 'Raw Meat', 0, '', 0, 0, 'raw-meat', 'Raw Meat'),
(73, 'Chicken', 72, '', 0, 0, 'chicken', 'Chicken'),
(74, 'Mutton', 72, '', 0, 0, 'mutton', 'Mutton'),
(75, 'Fish', 72, '', 0, 0, 'fish', 'Fish'),
(76, 'Pork', 72, '', 0, 0, 'pork', 'Pork'),
(77, 'Beaf', 72, '', 0, 0, 'beaf', 'Beaf'),
(78, 'chic1', 73, '', 0, 0, 'chic1', 'chic1'),
(79, 'chic2', 73, '', 0, 0, 'chic2', 'chic2'),
(80, 'chic3', 73, '', 0, 0, 'chic3', 'chic3'),
(81, 'chic4', 80, '', 0, 0, 'chic4', 'chic4'),
(82, 'tuna', 75, '', 0, 0, 'tuna', 'tuna'),
(83, 'salmon', 75, '', 0, 0, 'salmon', 'salmon'),
(84, 'Peretta', 75, '', 0, 0, 'peretta', 'Peretta'),
(85, 'Shark', 75, '', 0, 0, 'shark', 'Shark'),
(86, 'beef1', 77, '', 0, 0, 'beef1', 'beef1'),
(87, 'beef32', 77, '', 0, 0, 'beef32', 'beef32'),
(88, 'pork1', 76, '', 0, 0, 'pork1', 'pork1'),
(89, 'mutton1', 74, '', 0, 0, 'mutton1', 'mutton1');


