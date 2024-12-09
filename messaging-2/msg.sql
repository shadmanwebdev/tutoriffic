CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    photo VARCHAR(255) DEFAULT NULL,
    user_status VARCHAR(255) DEFAULT 'member',
    account_status VARCHAR(255) DEFAULT 'pending',
    user_account_type_id INT DEFAULT 1,
    gender VARCHAR(255) DEFAULT NULL,
    date_of_birth VARCHAR(255) DEFAULT NULL,
    phone VARCHAR(255) DEFAULT NULL,
    skype_id VARCHAR(255) DEFAULT NULL,
    postal_address VARCHAR(255) DEFAULT NULL,
    certificate_file VARCHAR(255) DEFAULT NULL,
    identification_file VARCHAR(255) DEFAULT NULL,
    created_at VARCHAR(255) DEFAULT NULL,
    updated_at VARCHAR(255) DEFAULT NULL
);



INSERT INTO users (id, firstname, lastname, email, pwd, photo, user_status, account_status, user_account_type_id, gender, date_of_birth, phone, skype_id, postal_address, certificate_file, identification_file, created_at, updated_at)
VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '$2y$11$FHUYy1yizt/pjNBQrY/BEOpCLP8y5a3T/yWXjK0.GHVZ9vTRN9m5.', 'person_1 (1).jpg', 'member', 'verified', 3, 'Male', '1990-01-01', '+123456789', 'john_doe_skype', '123 Main St, City', 'certificate.pdf', 'id_card.pdf', NOW(), NOW()),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '$2y$11$FHUYy1yizt/pjNBQrY/BEOpCLP8y5a3T/yWXjK0.GHVZ9vTRN9m5.', 'person_1.jpg', 'member', 'verified', 3, 'Female', '1985-05-15', '+987654321', 'jane_smith_skype', '456 Oak St, Town', 'certificate.pdf', 'id_card.pdf', NOW(), NOW()),
(3, 'Bob', 'Johnson', 'bob.johnson@example.com', '$2y$11$FHUYy1yizt/pjNBQrY/BEOpCLP8y5a3T/yWXjK0.GHVZ9vTRN9m5.', 'person_2 (1).jpg', 'admin', 'verified', 1, 'Male', '1980-09-20', '+111222333', 'bob_johnson_skype', '789 Pine St, Village', 'certificate.pdf', 'id_card.pdf', NOW(), NOW()),
(4, 'Helena', 'Walsh', 'helena.walsh@example.com', '$2y$11$FHUYy1yizt/pjNBQrY/BEOpCLP8y5a3T/yWXjK0.GHVZ9vTRN9m5.', 'c1.jpg', 'member', 'verified', 3, 'Male', '1990-01-01', '+123456789', 'john_doe_skype', '123 Main St, City', 'certificate.pdf', 'id_card.pdf', NOW(), NOW()),
(5, 'Samantha', 'Hayes', 'samantha.hayes@example.com', '$2y$11$FHUYy1yizt/pjNBQrY/BEOpCLP8y5a3T/yWXjK0.GHVZ9vTRN9m5.', 'tst-image2.jpg', 'member', 'verified', 3, 'Female', '1985-05-15', '+987654321', 'jane_smith_skype', '456 Oak St, Town', 'certificate.pdf', 'id_card.pdf', NOW(), NOW()),
(6, 'Miguel', 'Gomez', 'miguel.gomez@example.com', '$2y$11$FHUYy1yizt/pjNBQrY/BEOpCLP8y5a3T/yWXjK0.GHVZ9vTRN9m5.', 'instructor_2.jpg', 'member', 'verified', 3, 'Male', '1980-09-20', '+111222333', 'bob_johnson_skype', '789 Pine St, Village', 'certificate.pdf', 'id_card.pdf', NOW(), NOW()),
(7, 'Conor', 'Murphy', 'conor.murphy@example.com', '$2y$11$FHUYy1yizt/pjNBQrY/BEOpCLP8y5a3T/yWXjK0.GHVZ9vTRN9m5.', 'tst-image4.jpg', 'member', 'verified', 3, 'Male', '1990-01-01', '+123456789', 'john_doe_skype', '123 Main St, City', 'certificate.pdf', 'id_card.pdf', NOW(), NOW()),
(8, 'George', 'Wilson', 'george.wilson@example.com', '$2y$11$FHUYy1yizt/pjNBQrY/BEOpCLP8y5a3T/yWXjK0.GHVZ9vTRN9m5.', 'avatar-3.jpg', 'member', 'verified', 2, 'Male', '1990-01-01', '+123456789', 'john_doe_skype', '123 Main St, City', 'certificate.pdf', 'id_card.pdf', NOW(), NOW());



CREATE TABLE msgs (
    msg_id INT AUTO_INCREMENT PRIMARY KEY,
    msg_content TEXT DEFAULT NULL,
    from_id INT NOT NULL,
    to_id INT DEFAULT NULL,
    msg_created_at DATETIME DEFAULT NULL
);

INSERT INTO `msgs` (`msg_id`, `msg_content`, `from_id`, `to_id`, `msg_created_at`) VALUES
(1, 'Lorem ipsum dolor sit amet', 1, 8, '2023-08-29 17:56:04'),
(2, 'Lorem ipsum dolor sit amet', 8, 1, '2023-08-29 17:56:04');


CREATE TABLE msg_files (
    file_id INT AUTO_INCREMENT PRIMARY KEY,
    file_msg_id INT NOT NULL,
    msg_filename VARCHAR(255) DEFAULT NULL,
    msg_file_type VARCHAR(255) DEFAULT NULL,
    file_uploaded_at DATETIME DEFAULT NULL
);

INSERT INTO msg_files (file_id, file_msg_id, msg_filename, msg_file_type, file_uploaded_at)
VALUES (1, 1, 'file.pdf', 'pdf', '2023-08-29 17:56:04');
