-- Table: auteurs
CREATE TABLE auteurs(
    id INT AUTO_INCREMENT PRIMARY KEY,
    Author_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    bio TEXT
);

-- Table: packages
CREATE TABLE packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    package_name VARCHAR(255) NOT NULL,
    pack_description TEXT,
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



-- Insert random data into the auteurs table
INSERT INTO auteurs (Author_name, email, bio)
VALUES
('John Doe', 'john.doe@example.com', 'An experienced JavaScript developer specializing in open-source projects.'),
('Jane Smith', 'jane.smith@example.com', 'A passionate programmer focused on JavaScript frameworks and cloud solutions.'),
('Alice Brown', 'alice.brown@example.com', 'A JavaScript enthusiast and front-end expert.'),
('Bob Johnson', 'bob.johnson@example.com', 'Full-stack JavaScript developer with a love for solving complex problems.'),
('Charlie White', 'charlie.white@example.com', 'Node.js engineer ensuring smooth server-side performance.');

-- Insert random data into the packages table
INSERT INTO packages (package_name, pack_description, auteurs_id)
VALUES
('JS Package Manager', 'A tool to manage and install JavaScript packages efficiently.', 31),
('Data Visualizer', 'A JavaScript library for creating dynamic and interactive data visualizations.', 33),
('Web Framework', 'A lightweight JavaScript framework for building web applications.', 32),
('Image Optimizer', 'A JavaScript utility for editing and optimizing images.', 34),
('Task Scheduler', 'An application for automating task scheduling in JavaScript.', 35);

-- Insert random data into the versions table
INSERT INTO versions (version_number, release_date, package_id)
VALUES
('1.0.0', '2023-01-15', 33),
('1.1.0', '2023-03-10', 33),
('0.9.0', '2023-02-20', 34),
('1.0.0', '2023-04-05', 34),
('2.0.0', '2023-06-18', 35),
('1.0.0', '2023-05-01', 36),
('1.0.0', '2023-07-12', 37),
('1.1.0', '2023-09-20', 37),
('2.0.0', '2023-11-01', 37);

ALTER TABLE `packages`
ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`auteurs_id`) REFERENCES `auteurs`(`id`) ON DELETE CASCADE;

ALTER TABLE `versions`
ADD CONSTRAINT `versions_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages`(`id`) ON DELETE CASCADE;
