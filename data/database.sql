CREATE TABLE `products` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL DEFAULT '',
  `price` DECIMAL(10,2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE `orders` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) NOT NULL DEFAULT '0',
  `total` DECIMAL(12,2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE `order_products` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `order_id` INT(11) NOT NULL,
  `product_id` INT(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

ALTER TABLE `order_products` ADD CONSTRAINT `fk-orders-order_id`
FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`)
ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `order_products` ADD CONSTRAINT `fk-products-product_id`
FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)
ON DELETE SET NULL ON UPDATE CASCADE;