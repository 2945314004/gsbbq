/*
 Navicat Premium Data Transfer

 Source Server         : 23.224.102.211
 Source Server Type    : MySQL
 Source Server Version : 50740 (5.7.40-log)
 Source Host           : 23.224.102.211:3306
 Source Schema         : biao

 Target Server Type    : MySQL
 Target Server Version : 50740 (5.7.40-log)
 File Encoding         : 65001

 Date: 08/04/2023 13:49:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `ID` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for biao
-- ----------------------------
DROP TABLE IF EXISTS `biao`;
CREATE TABLE `biao`  (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(6) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `major` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `to_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fankui
-- ----------------------------
DROP TABLE IF EXISTS `fankui`;
CREATE TABLE `fankui`  (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `contact` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `problem` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
