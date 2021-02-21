ALTER TABLE products
drop COLUMN `max_in_invoice` ;
  ALTER TABLE products
DROP COLUMN  `max_discount`;
  
ALTER TABLE products
ADD  `max_in_invoice` int(11) DEFAULT NULL;
  ALTER TABLE products
ADD  `max_discount` int(11) DEFAULT NULL;
  
