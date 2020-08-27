use art_db;

# Artworks
INSERT INTO `art` (`artNo`, `title`, `artdesc`, `price`, `category`, `size`, `link`) VALUES (NULL, 'Sonic Meme', 'That one sonic meme', '12.50', 'Hand Drawn', '60x55 cm', 'https://i.imgur.com/WijgGCs.png');
INSERT INTO `art` (`artNo`, `title`, `artdesc`, `price`, `category`, `size`, `link`) VALUES (NULL, 'Mona Lisa', 'Famous rendition', '70', 'Painted', '77x53 cm', 'https://i.imgur.com/eyKYGQG.jpg');
INSERT INTO `art` (`artNo`, `title`, `artdesc`, `price`, `category`, `size`, `link`) VALUES (NULL, 'Doge', 'Such painting. Much art.', '20', 'Painted', '60x60 cm', 'https://i.imgur.com/rfYJHXS.jpg');
INSERT INTO `art` (`artNo`, `title`, `artdesc`, `price`, `category`, `size`, `link`) VALUES (NULL, 'Starry Night', 'Depicts a wonderful view', '40', 'Painted', '73.7×92.1 cm', 'https://i.imgur.com/rOAvk9H.jpg');
INSERT INTO `art` (`artNo`, `title`, `artdesc`, `price`, `category`, `size`, `link`) VALUES (NULL, 'Big Chungus', 'He’s a big chunky boy', '30', 'Painted', '75x60 cm', 'https://i.imgur.com/9owPUb7.jpg');
INSERT INTO `art` (`artNo`, `title`, `artdesc`, `price`, `category`, `size`, `link`) VALUES (NULL, 'The Great Wave off Kanagawa', 'A powerful display of nature', '45', 'Painted', '26x38 cm', 'https://i.imgur.com/pjQd18j.jpg');
INSERT INTO `art` (`artNo`, `title`, `artdesc`, `price`, `category`, `size`, `link`) VALUES (NULL, 'Sans', 'Sans Undertale', '66.60', 'Painted', '75x65 cm', 'https://i.imgur.com/wyNwkli.png');
INSERT INTO `art` (`artNo`, `title`, `artdesc`, `price`, `category`, `size`, `link`) VALUES (NULL, 'Girl with a Pearl Earring', 'A beautiful figure', '60', 'Painted', '44x39 cm', 'https://i.imgur.com/CeFjsBd.jpg');
INSERT INTO `art` (`artNo`, `title`, `artdesc`, `price`, `category`, `size`, `link`) VALUES (NULL, 'Ugandan Knuckles', 'Do you know the way?', '15', 'Hand Drawn', '50x50 cm', 'https://i.imgur.com/cJwaIPk.jpg');
INSERT INTO `art` (`artNo`, `title`, `artdesc`, `price`, `category`, `size`, `link`) VALUES (NULL, 'The Persistence of Memory', 'Famous surrealism', '55', 'Painted', '30x25 cm', 'https://i.imgur.com/jn3dSsy.jpg');

#Test users
INSERT INTO `users` (`title`, `fname`, `lname`, `email`, `shipping_address`, `city`, `shipping_state`, `country`, `postcode`, `phone`, `usertype`, `hashed_password`, `salt`) VALUES ('Mr.', 'admin', 'admin', 'admin', 'admin Street', 'Darwin', 'NT', 'Australia', '0810', '0474567321', 'admin','37e23cf0b9444fc05aa0aeea3bd9fb6f45c740c3beb85d032f81cffb46cf26b5', '2CB0EF8D9A637451');
INSERT INTO `users` (`title`, `fname`, `lname`, `email`, `shipping_address`, `city`, `shipping_state`, `country`, `postcode`, `phone`, `usertype`, `hashed_password`, `salt`) VALUES ('Mr.', 'user', 'user', 'user', 'user Street', 'Darwin', 'NT', 'Australia', '0810', '0474567678', 'user', '37e23cf0b9444fc05aa0aeea3bd9fb6f45c740c3beb85d032f81cffb46cf26b5', '2CB0EF8D9A637451');
INSERT INTO `users` (`title`, `fname`, `lname`, `email`, `shipping_address`, `city`, `shipping_state`, `country`, `postcode`, `phone`, `usertype`, `hashed_password`, `salt`) VALUES ('Mr.', 'Zephyr', 'Dobson', 'zephyr.dobson@outlook.com', '21 Melody Street', 'Darwin', 'NT', 'Australia', '0810', '0472630784', 'admin', '37e23cf0b9444fc05aa0aeea3bd9fb6f45c740c3beb85d032f81cffb46cf26b5', '2CB0EF8D9A637451');
