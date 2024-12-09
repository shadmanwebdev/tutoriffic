CREATE TABLE reviews (
    review_id int(11) PRIMARY KEY AUTO_INCREMENT,
    post_id int(11) NOT NULL,
    reviewed_by_id int(11) NOT NULL,
    rating decimal(10,1) NOT NULL,
    review_content text NOT NULL,
    created_at varchar(255) DEFAULT NULL
);

INSERT INTO reviews (post_id, reviewed_by_id, rating, review_content, created_at) 
VALUES 
(1, 2, 5, "I couldn't be happier with storing my vehicle with Billy! Location is great, SUPERB communication", '2024-03-31 07:34:30'),
(2, 2, 5, "I couldn't be happier with storing my vehicle with Billy! Location is great, SUPERB communication", '2024-03-31 07:34:30'),
(3, 2, 5, "I couldn't be happier with storing my vehicle with Billy! Location is great, SUPERB communication", '2024-03-31 07:34:30'),
(4, 2, 5, "I couldn't be happier with storing my vehicle with Billy! Location is great, SUPERB communication", '2024-03-31 07:34:30');

