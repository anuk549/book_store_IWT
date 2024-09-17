CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    author VARCHAR(255),
    image VARCHAR(255)
);

ALTER TABLE user_reviews

ADD book_id INT,
ADD FOREIGN KEY (book_id) REFERENCES books(id);


CREATE TABLE user_reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    book_title VARCHAR(255),
    review TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
