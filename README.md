# JavaScript Packages Manager  (PACK MAN system)

This project manages information about JavaScript packages, including their descriptions, authors, and versions. It uses a relational database to store and link data effectively, enabling users to retrieve detailed information about packages and their respective versions.

## Features

- Store and manage JavaScript package data.
- Maintain a record of authors and their bios.
- Track multiple versions of each package with release dates.
- Relational database structure with foreign key relationships.
- Three user dashboards with distinct permissions:
  - **Admin Dashboard**: Full access to add, edit, and remove all packages, authors, and versions.
  - **Author Dashboard**: Limited access to add and edit only their own packages and versions.
  - **User Dashboard**: Read-only access to view package ,version information and their author.

## Database Schema

### Table: `auteurs`

Stores information about authors of the packages.

| Column    | Type         | Description                        |
|-----------|--------------|------------------------------------|
| `id`      | INT (PK)     | Unique identifier for each author. |
| `name`    | VARCHAR(255) | Author's name.                     |
| `email`   | VARCHAR(255) | Author's email address.            |
| `bio`     | TEXT         | Short bio of the author.           |

### Table: `packages`

Stores information about JavaScript packages.

| Column        | Type         | Description                              |
|---------------|--------------|------------------------------------------|
| `id`          | INT (PK)     | Unique identifier for each package.      |
| `name`        | VARCHAR(255) | Name of the JavaScript package.          |
| `description` | TEXT         | Description of the package.              |
| `created_at`  | TIMESTAMP    | Creation date of the package.            |
| `auteurs_id`  | INT (FK)     | Reference to the author in `auteurs`.    |

### Table: `versions`

Stores version information for each package.

| Column         | Type         | Description                                      |
|----------------|--------------|--------------------------------------------------|
| `id`           | INT (PK)     | Unique identifier for each version.             |
| `version_number` | VARCHAR(50) | Version number (e.g., 1.0.0).                   |
| `release_date` | DATE         | Release date of the version.                    |
| `package_id`   | INT (FK)     | Reference to the package in `packages`.         |

### Table: `users`

Stores user credentials and roles for dashboard access.

| Column    | Type         | Description                              |
|-----------|--------------|------------------------------------------|
| `id`      | INT (PK)     | Unique identifier for each user.         |
| `username`| VARCHAR(50)  | Username for login.                      |
| `password`| VARCHAR(255) | Encrypted password.                      |
| `role`    | ENUM         | User role: `admin`, `author`, or `user`. |

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Youcode-Classe-E-2024-2025/anouar-elbarry-JSpackages-manager.git
   ```

2. Set up the database:
   - Import the provided SQL schema and data into your MySQL database.

3. Configure your environment:
   - Update the database connection details in the project's configuration file.

4. Run the project locally:
   ```bash
   php -S localhost:8000
   ```

## Usage

### Admin Dashboard
- Add, edit, and remove all packages, authors, versions, and users.
- username : admin_user
- password : admin
### Author Dashboard
- Add and edit only their own packages and versions.
- username : author_user
- password : author
### User Dashboard
- View package and version information (read-only access).
- username : regular_user
- password : user
## Example Queries

### Fetch All Package Details
```sql
SELECT packages.name, packages.description, auteurs.name AS author_name, auteurs.email
FROM packages
JOIN auteurs ON packages.auteurs_id = auteurs.id;
```

### Fetch Versions for a Specific Package
```sql
SELECT versions.version_number, versions.release_date
FROM versions
WHERE versions.package_id = ?;
```

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a feature branch (`git checkout -b feature-name`).
3. Commit your changes (`git commit -m 'Add a new feature'`).
4. Push to the branch (`git push origin feature-name`).
5. Open a pull request.

## Contact

For questions or suggestions, please reach out to:

- **Name:** El barry Anouar
- **Email:** elbarryanwar37@gmail.com
