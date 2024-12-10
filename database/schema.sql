-- Table: auteurs
CREATE TABLE auteurs(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    bio TEXT
);

-- Table: packages
CREATE TABLE packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    auteurs_id INT,
    FOREIGN KEY (auteurs_id) REFERENCES auteurs(id)
);

-- Table: versions
CREATE TABLE versions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    version_number VARCHAR(50) NOT NULL,
    release_date DATE,
    package_id INT,
    FOREIGN KEY (package_id) REFERENCES packages(id)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user', 'author') NOT NULL
);



INSERT INTO versions (version_number, release_date, package_id) VALUES
('16.13.1', '2020-03-19', 1), -- React
('17.0.2', '2021-03-22', 1), -- React
('1.1.3', '2017-03-25', 2),  -- Axios
('1.3.0', '2018-05-15', 2),  -- Axios
('2.2.19', '2022-02-10', 4), -- Tailwind CSS
('3.3.3', '2023-04-15', 4),  -- Tailwind CSS
('26.6.3', '2020-09-01', 1), -- Jest
('27.5.1', '2022-01-10', 1); -- Jest