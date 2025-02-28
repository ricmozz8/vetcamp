CREATE TABLE reactive_useraccount (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    OTP TEXT NOT NULL,
    made_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);