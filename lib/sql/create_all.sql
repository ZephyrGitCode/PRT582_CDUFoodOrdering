USE art_db;

CREATE TABLE `users` (
  id int(11) NOT NULL auto_increment,
  PRIMARY KEY (id),
  title varchar(10),
  fname varchar(40) NOT NULL,
  lname varchar(40) NOT NULL,
  email varchar(60) NOT NULL,
  UNIQUE (email),
  shipping_address varchar(120),
  city varchar(100),
  shipping_state char(3),
  country varchar(120),
  postcode varchar(4),
  phone varchar(12),
  usertype varchar(5) DEFAULT 'user',
  # Assuming SHA256 hash
  hashed_password char(64) NOT NULL,
  # Assuming 16 chars in salt
  salt char(16) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `purchase` (
  purchaseNo int(11) NOT NULL auto_increment,
  PRIMARY KEY (purchaseNo),
  id int(11) NOT NULL,
  CONSTRAINT FOREIGN KEY (id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
  pdate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE `art` (
  artNo int(11) NOT NULL auto_increment,
  title varchar(40) NOT NULL,
  artdesc varchar(255) NOT NULL,
  price float(24) NOT NULL,
  category varchar(25) NOT NULL,
  size varchar(25) NOT NULL,
  link varchar(255) NOT NULL,
  PRIMARY KEY (artNo)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE `purchaseitem` (
  purchaseNo int(11) NOT NULL,
  artNo int(11) NOT NULL,
  quantity int(3) NOT NULL,
  PRIMARY KEY (purchaseNo, artNo),
  FOREIGN KEY (purchaseNo) REFERENCES purchase(purchaseNo) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (artNo) REFERENCES art(artNo) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `testimonial` (
  testNo int(11) NOT NULL auto_increment,
  PRIMARY KEY (testNo),
  id int(11) NOT NULL,
  CONSTRAINT FOREIGN KEY (id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
  artNo int(11) NOT NULL,
  CONSTRAINT FOREIGN KEY (artNo) REFERENCES art(artNo) ON DELETE CASCADE ON UPDATE CASCADE,
  test varchar(255) NOT NULL,
  approved VARCHAR(5) DEFAULT 'false'
) ENGINE=InnoDB AUTO_INCREMENT=1 CHARSET=utf8;