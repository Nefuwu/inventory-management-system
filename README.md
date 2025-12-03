# 📦 Inventory Management System

A secure, full-stack inventory tracking application built with **PHP (PDO)** and **MySQL**. Designed to help small businesses manage stock levels, categorize products, and track real-time inventory status.

## 🚀 Features

- **User Authentication:** Secure login system using `bcrypt` password hashing.
- **Dashboard Overview:** Real-time statistics for total products, categories, and low-stock alerts.
- **CRUD Operations:** Full Create, Read, Update, Delete functionality for:
  - Products (with stock logic)
  - Categories (with cascade deletion)
- **Stock Alerts:** Visual indicators (Red/Yellow) for Out-of-Stock and Low-Stock items.
- **Security:** \* SQL Injection protection via **PDO Prepared Statements**.
  - XSS protection via special character escaping.
  - Session-based access control.

## 🛠️ Tech Stack

- **Backend:** PHP 8.x
- **Database:** MySQL
- **Frontend:** Bootstrap 5 (Responsive Design)
- **Version Control:** Git & GitHub

## 📸 Screenshots

_(You can upload screenshots to your repo later and link them here to show off the UI)_

## ⚙️ Installation & Setup

1.  **Clone the repository**

    ```bash
    git clone [https://github.com/Nefuwu/inventory-management-system.git](https://github.com/Nefuwu/inventory-management-system.git)
    ```

2.  **Configure the Database**

    - Create a database named `inventory_system` in phpMyAdmin.
    - Import the database schema (SQL) provided below.
    - Update `includes/db.php` if your MySQL credentials differ from `root` / `""`.

3.  **Run the Seeder**
    - Create a file `seed.php` to generate your first hashed admin password (as described in the code comments) or manually insert a hashed password.

---

### 📝 Database Schema (Quick Setup)

```sql
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  last_login DATETIME
);

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(60) NOT NULL
);

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  categorie_id INT NOT NULL,
  name VARCHAR(255) NOT NULL,
  quantity INT(11) DEFAULT 0,
  buy_price DECIMAL(10,2),
  sale_price DECIMAL(10,2),
  date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE CASCADE
);
```
