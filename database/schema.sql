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
