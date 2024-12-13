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



-- Insert random data into the auteurs table
INSERT INTO auteurs (name, email, bio)
VALUES
('John Doe', 'john.doe@example.com', 'An experienced JavaScript developer specializing in open-source projects.'),
('Jane Smith', 'jane.smith@example.com', 'A passionate programmer focused on JavaScript frameworks and cloud solutions.'),
('Alice Brown', 'alice.brown@example.com', 'A JavaScript enthusiast and front-end expert.'),
('Bob Johnson', 'bob.johnson@example.com', 'Full-stack JavaScript developer with a love for solving complex problems.'),
('Charlie White', 'charlie.white@example.com', 'Node.js engineer ensuring smooth server-side performance.');

-- Insert random data into the packages table
INSERT INTO packages (name, description, auteurs_id)
VALUES
('JS Package Manager', 'A tool to manage and install JavaScript packages efficiently.', 1),
('Data Visualizer', 'A JavaScript library for creating dynamic and interactive data visualizations.', 3),
('Web Framework', 'A lightweight JavaScript framework for building web applications.', 2),
('Image Optimizer', 'A JavaScript utility for editing and optimizing images.', 4),
('Task Scheduler', 'An application for automating task scheduling in JavaScript.', 5);

-- Insert random data into the versions table
INSERT INTO versions (version_number, release_date, package_id)
VALUES
('1.0.0', '2023-01-15', 1),
('1.1.0', '2023-03-10', 1),
('0.9.0', '2023-02-20', 2),
('1.0.0', '2023-04-05', 2),
('2.0.0', '2023-06-18', 3),
('1.0.0', '2023-05-01', 4),
('1.0.0', '2023-07-12', 5),
('1.1.0', '2023-09-20', 5),
('2.0.0', '2023-11-01', 5);

ALTER TABLE `packages`
ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`auteurs_id`) REFERENCES `auteurs`(`id`) ON DELETE CASCADE;

ALTER TABLE `versions`
ADD CONSTRAINT `versions_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages`(`id`) ON DELETE CASCADE;
