/*
 Navicat Premium Data Transfer

 Source Server         : MyLocalhost
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : rental_mobil_db

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 21/07/2024 02:09:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for action_logs
-- ----------------------------
DROP TABLE IF EXISTS `action_logs`;
CREATE TABLE `action_logs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `old_values` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `new_values` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of action_logs
-- ----------------------------
INSERT INTO `action_logs` VALUES (1, 'App\\Models\\Car', 4, 'created', 1, NULL, '{\"id\":4,\"brand\":\"KIA\",\"model\":\"Carrent 2\",\"plate_number\":\"D PWPW M\",\"rental_price\":\"500000\",\"is_available\":\"1\",\"updated_at\":\"2024-07-20 09:00:34\",\"created_at\":\"2024-07-20 09:00:34\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-07-20 09:00:34', '2024-07-20 09:00:34');
INSERT INTO `action_logs` VALUES (2, 'App\\Models\\Car', 5, 'created', 1, NULL, '{\"id\":5,\"brand\":\"Toyota\",\"model\":\"Avanzaa\",\"plate_number\":\"B 1234 CDa\",\"rental_price\":\"300000\",\"is_available\":\"1\",\"updated_at\":\"2024-07-20 09:14:38\",\"created_at\":\"2024-07-20 09:14:38\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-07-20 09:14:38', '2024-07-20 09:14:38');
INSERT INTO `action_logs` VALUES (3, 'App\\Models\\Car', 6, 'created', 1, NULL, '{\"id\":6,\"brand\":\"Toyota\",\"model\":\"Avanza\",\"plate_number\":\"Z 1234 CD\",\"rental_price\":\"300000\",\"is_available\":\"1\",\"updated_at\":\"2024-07-20 09:14:53\",\"created_at\":\"2024-07-20 09:14:53\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-07-20 09:14:53', '2024-07-20 09:14:53');
INSERT INTO `action_logs` VALUES (4, 'App\\Models\\Car', 7, 'created', 1, NULL, '{\"id\":7,\"brand\":\"Toyota\",\"model\":\"Avanza\",\"plate_number\":\"A 1234 CD\",\"rental_price\":\"300000\",\"is_available\":\"1\",\"updated_at\":\"2024-07-20 09:16:19\",\"created_at\":\"2024-07-20 09:16:19\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-07-20 09:16:19', '2024-07-20 09:16:19');
INSERT INTO `action_logs` VALUES (5, 'App\\Models\\Car', 1, 'updated', 1, '{\"id\":1,\"brand\":\"Toyota\",\"model\":\"Avanza\",\"plate_number\":\"B 1234 CD\",\"rental_price\":300000,\"is_available\":1,\"created_at\":\"2024-07-20T08:59:14.000000Z\",\"updated_at\":\"2024-07-20T08:59:14.000000Z\",\"deleted_at\":null}', '{\"model\":\"Avanza T\",\"updated_at\":\"2024-07-20 09:42:43\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-07-20 09:42:43', '2024-07-20 09:42:43');
INSERT INTO `action_logs` VALUES (6, 'App\\Models\\Car', 1, 'updated', 1, '{\"id\":1,\"brand\":\"Toyota\",\"model\":\"Avanza T\",\"plate_number\":\"B 1234 CD\",\"rental_price\":300000,\"is_available\":1,\"created_at\":\"2024-07-20T08:59:14.000000Z\",\"updated_at\":\"2024-07-20T09:42:43.000000Z\",\"deleted_at\":null}', '{\"model\":\"Avanza ZZ\",\"updated_at\":\"2024-07-20 09:42:53\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-07-20 09:42:53', '2024-07-20 09:42:53');
INSERT INTO `action_logs` VALUES (7, 'App\\Models\\Car', 11, 'created', 1, NULL, '{\"brand\":\"Toyota\",\"model\":\"Avanza\",\"plate_number\":\"A 1234 CDD\",\"rental_price\":\"123123\",\"is_available\":\"1\",\"updated_at\":\"2024-07-20 09:47:18\",\"created_at\":\"2024-07-20 09:47:18\",\"id\":11}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-07-20 09:47:18', '2024-07-20 09:47:18');
INSERT INTO `action_logs` VALUES (8, 'App\\Models\\Car', 12, 'created', 1, NULL, '{\"brand\":\"Toyota\",\"model\":\"Avanza\",\"plate_number\":\"A 1234 AA\",\"rental_price\":\"200000\",\"is_available\":\"0\",\"updated_at\":\"2024-07-20 09:50:27\",\"created_at\":\"2024-07-20 09:50:27\",\"id\":12}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-07-20 09:50:27', '2024-07-20 09:50:27');
INSERT INTO `action_logs` VALUES (9, 'App\\Models\\Rental', 1, 'updated', NULL, '{\"id\":1,\"user_id\":1,\"car_id\":1,\"start_date\":\"2024-07-01\",\"end_date\":\"2024-07-07\",\"total_cost\":2100000,\"returned\":0,\"created_at\":\"2024-07-20T08:59:14.000000Z\",\"updated_at\":\"2024-07-20T08:59:14.000000Z\",\"deleted_at\":null}', '{\"user_id\":\"2\",\"car_id\":\"4\",\"updated_at\":\"2024-07-20 14:01:44\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-07-20 14:01:44', '2024-07-20 14:01:44');
INSERT INTO `action_logs` VALUES (10, 'App\\Models\\Rental', 1, 'deleted', NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-07-20 14:03:38', '2024-07-20 14:03:38');
INSERT INTO `action_logs` VALUES (11, 'App\\Models\\Rental', 2, 'updated', NULL, '{\"id\":2,\"user_id\":2,\"car_id\":2,\"start_date\":\"2024-07-05\",\"end_date\":\"2024-07-10\",\"total_cost\":2500000,\"returned\":1,\"created_at\":\"2024-07-20T08:59:14.000000Z\",\"updated_at\":\"2024-07-20T08:59:14.000000Z\",\"deleted_at\":null}', '{\"user_id\":\"3\",\"end_date\":\"2024-07-20\",\"updated_at\":\"2024-07-20 14:05:22\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-07-20 14:05:22', '2024-07-20 14:05:22');
INSERT INTO `action_logs` VALUES (12, 'App\\Models\\Rental', 3, 'updated', NULL, '{\"id\":3,\"user_id\":3,\"car_id\":3,\"start_date\":\"2024-07-10\",\"end_date\":\"2024-07-15\",\"total_cost\":1750000,\"returned\":0,\"created_at\":\"2024-07-20T08:59:14.000000Z\",\"updated_at\":\"2024-07-20T08:59:14.000000Z\",\"deleted_at\":null}', '{\"returned\":\"1\",\"updated_at\":\"2024-07-20 14:05:32\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-07-20 14:05:32', '2024-07-20 14:05:32');
INSERT INTO `action_logs` VALUES (13, 'App\\Models\\Rental', 2, 'updated', NULL, '{\"id\":2,\"user_id\":3,\"car_id\":2,\"start_date\":\"2024-07-05\",\"end_date\":\"2024-07-20\",\"total_cost\":2500000,\"returned\":1,\"created_at\":\"2024-07-20T08:59:14.000000Z\",\"updated_at\":\"2024-07-20T14:05:22.000000Z\",\"deleted_at\":null}', '{\"returned\":\"0\",\"updated_at\":\"2024-07-20 14:05:40\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-07-20 14:05:40', '2024-07-20 14:05:40');
INSERT INTO `action_logs` VALUES (14, 'App\\Models\\Rental', 2, 'updated', 1, '{\"id\":2,\"user_id\":3,\"car_id\":2,\"start_date\":\"2024-07-05\",\"end_date\":\"2024-07-20\",\"total_cost\":2500000,\"returned\":0,\"created_at\":\"2024-07-20T08:59:14.000000Z\",\"updated_at\":\"2024-07-20T14:05:40.000000Z\",\"deleted_at\":null}', '{\"returned\":\"1\",\"updated_at\":\"2024-07-20 18:59:07\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-07-20 18:59:07', '2024-07-20 18:59:07');
INSERT INTO `action_logs` VALUES (15, 'App\\Models\\Rental', 4, 'created', 1, NULL, '{\"user_id\":\"1\",\"car_id\":\"1\",\"start_date\":\"2024-07-19\",\"end_date\":\"2024-07-20\",\"total_cost\":\"300000\",\"returned\":\"1\",\"updated_at\":\"2024-07-20 19:00:40\",\"created_at\":\"2024-07-20 19:00:40\",\"id\":4}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-07-20 19:00:40', '2024-07-20 19:00:40');

-- ----------------------------
-- Table structure for cars
-- ----------------------------
DROP TABLE IF EXISTS `cars`;
CREATE TABLE `cars`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plate_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rental_price` bigint NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `cars_plate_number_unique`(`plate_number` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cars
-- ----------------------------
INSERT INTO `cars` VALUES (1, 'Toyota', 'Avanza ZZ', 'B 1234 CD', 300000, 1, '2024-07-20 08:59:14', '2024-07-20 09:42:53', NULL);
INSERT INTO `cars` VALUES (2, 'Honda', 'CR-V', 'B 5678 EF', 500000, 1, '2024-07-20 08:59:14', '2024-07-20 08:59:14', NULL);
INSERT INTO `cars` VALUES (3, 'Suzuki', 'Ertiga', 'B 9101 GH', 350000, 0, '2024-07-20 08:59:14', '2024-07-20 08:59:14', NULL);
INSERT INTO `cars` VALUES (4, 'KIA', 'Carrent 2', 'D PWPW M', 500000, 1, '2024-07-20 09:00:34', '2024-07-20 09:00:34', NULL);
INSERT INTO `cars` VALUES (5, 'Toyota', 'Avanzaa', 'B 1234 CDa', 300000, 1, '2024-07-20 09:14:38', '2024-07-20 09:14:38', NULL);
INSERT INTO `cars` VALUES (6, 'Toyota', 'Avanza', 'Z 1234 CD', 300000, 1, '2024-07-20 09:14:53', '2024-07-20 09:14:53', NULL);
INSERT INTO `cars` VALUES (7, 'Toyota', 'Avanza', 'A 1234 CD', 300000, 1, '2024-07-20 09:16:19', '2024-07-20 09:16:19', NULL);
INSERT INTO `cars` VALUES (11, 'Toyota', 'Avanza', 'A 1234 CDD', 123123, 1, '2024-07-20 09:47:18', '2024-07-20 09:47:18', NULL);
INSERT INTO `cars` VALUES (12, 'Toyota', 'Avanza', 'A 1234 AA', 200000, 0, '2024-07-20 09:50:27', '2024-07-20 09:50:27', NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2024_07_11_033910_create_master_barangs_table', 1);
INSERT INTO `migrations` VALUES (6, '2024_07_11_033911_create_transaksi_pembelians_table', 1);
INSERT INTO `migrations` VALUES (7, '2024_07_11_035708_create_transaksi_pembelian_barangs_table', 1);
INSERT INTO `migrations` VALUES (8, '2024_07_20_075613_create_cars_table', 1);
INSERT INTO `migrations` VALUES (9, '2024_07_20_075635_create_rentals_table', 1);
INSERT INTO `migrations` VALUES (10, '2024_07_20_085802_create_action_logs_table', 1);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for rentals
-- ----------------------------
DROP TABLE IF EXISTS `rentals`;
CREATE TABLE `rentals`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `car_id` bigint UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_cost` bigint NOT NULL,
  `returned` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `rentals_user_id_foreign`(`user_id` ASC) USING BTREE,
  INDEX `rentals_car_id_foreign`(`car_id` ASC) USING BTREE,
  CONSTRAINT `rentals_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `rentals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rentals
-- ----------------------------
INSERT INTO `rentals` VALUES (1, 2, 4, '2024-07-01', '2024-07-07', 2100000, 0, '2024-07-20 08:59:14', '2024-07-20 14:03:38', '2024-07-20 14:03:38');
INSERT INTO `rentals` VALUES (2, 3, 2, '2024-07-05', '2024-07-20', 2500000, 1, '2024-07-20 08:59:14', '2024-07-20 18:59:07', NULL);
INSERT INTO `rentals` VALUES (3, 3, 3, '2024-07-10', '2024-07-15', 1750000, 1, '2024-07-20 08:59:14', '2024-07-20 14:05:32', NULL);
INSERT INTO `rentals` VALUES (4, 1, 1, '2024-07-19', '2024-07-20', 300000, 1, '2024-07-20 19:00:40', '2024-07-20 19:00:40', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username` ASC) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Deni Hadiya', 'admin', '081388071014', 'Jl. ningnong, sukapura, dayeuhkolot, kab. Bandung', 'userone@example.com', NULL, '$2y$12$dUoO.5VxP3PlIw8VdLP48eD4m9fRBmwfpjbcwFvAfjbxI3sXCvIhC', NULL, '2024-07-20 08:59:14', '2024-07-20 08:59:14', NULL);
INSERT INTO `users` VALUES (2, 'User Two', 'usertwo', '087888071014', 'Jl. pariaman, sukapura, dayeuhkolot, kab. Bandung', 'usertwo@example.com', NULL, '$2y$12$qd9mOXePxcyPsplXHYVwZ.LXNOrckCsLRIdCgvuwwIb/8C485iBNa', NULL, '2024-07-20 08:59:14', '2024-07-20 08:59:14', NULL);
INSERT INTO `users` VALUES (3, 'User Three', 'userthree', '087888071014', 'Jl. ciburial, sukapura, dayeuhkolot, kab. Bandung', 'userthree@example.com', NULL, '$2y$12$T6Y8wlCcucfwIRjEAQOMl.QAvRqrzyeZgaany/Q6/hLNEfDKznpVa', NULL, '2024-07-20 08:59:14', '2024-07-20 08:59:14', NULL);

SET FOREIGN_KEY_CHECKS = 1;
