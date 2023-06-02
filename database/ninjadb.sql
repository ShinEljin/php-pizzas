CREATE DATABASE ninjadb

CREATE TABLE pizzas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  ingredients VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)

INSERT INTO pizzas (title, ingredients, email)
VALUES ("ninja supereme", "tomato, cheese, tofu", "test@gmail.com")

INSERT INTO pizzas (title, ingredients, email)
VALUES ("mario supereme", "tomato, cheese, mushroom", "mario@gmail.com")