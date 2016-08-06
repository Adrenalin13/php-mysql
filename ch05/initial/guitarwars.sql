CREATE TABLE `guitarwars` (
  `id` INT AUTO_INCREMENT,
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `name` VARCHAR(32),
  `score` INT,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
);

INSERT INTO `guitarwars` VALUES (0, NOW(), 'Paco Jastorius', 127650, 'fdsa.rrr');
INSERT INTO `guitarwars` VALUES (0, NOW(), 'Nevil Johansson', 98430, 'fdsa.rrr');
INSERT INTO `guitarwars` VALUES (0, NOW(), 'Eddie Vanilli', 345900, 'fdsa.rrr');
INSERT INTO `guitarwars` VALUES (0, NOW(), 'Belita Chevy', 282470, 'fdsa.rrr');
INSERT INTO `guitarwars` VALUES (0, NOW(), 'Ashton Simpson', 368420, 'fdsa.rrr');
INSERT INTO `guitarwars` VALUES (0, NOW(), 'Kenny Lavitz', 64930, 'fdsa.rrr');
