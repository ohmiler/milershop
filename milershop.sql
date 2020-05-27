-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `order_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order_name` varchar(100) NOT NULL,
  `order_email` varchar(100) NOT NULL,
  `order_phone` varchar(20) NOT NULL,
  `order_address` text NOT NULL,
  `total` int(11) NOT NULL,
  `cust_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `detail_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `order_id` int(5) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `product_qty` int(5) NOT NULL,
  `product_detail` text NOT NULL,
  `type_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products_type`
--

CREATE TABLE `products_type` (
  `type_id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

