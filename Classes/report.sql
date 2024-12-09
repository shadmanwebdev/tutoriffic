CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reported_ad_id INT NOT NULL,
    reported_by INT NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME DEFAULT NULL
);