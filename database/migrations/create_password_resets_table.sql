--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `OTP` text NOT NULL,
  `reset_token` text NOT NULL,
  `ttl_days` int NOT NULL DEFAULT '1',
  `valid` tinyint(1) NOT NULL DEFAULT '1',
  `made_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;