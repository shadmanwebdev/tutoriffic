CREATE TABLE site_settings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sitename varchar(255) DEFAULT NULL,
  title_tag varchar(255) DEFAULT NULL,
  meta_description varchar(255) DEFAULT NULL,
  copyright_text varchar(255) DEFAULT NULL,
  contact varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `site_settings` (
    `id`, 
    `sitename`, 
    `title_tag`, 
    `meta_description`, 
    `copyright_text`,
    `contact`
) VALUES (1, 'New Website', 'New Website', 
'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia', 
'Coypright © Website', 'contact@website.com');

