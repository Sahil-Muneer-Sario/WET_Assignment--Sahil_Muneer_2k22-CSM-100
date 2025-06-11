# Author
        Project Submitted By: Sahil Muneer Sario  
        Roll No: 2K22/CSM/100  
        Department: Computer Science (Pre-Medical)  
        University: University of Sindh, Jamshoro  
        Submitted To: Sir Gulsher Leghari


---

# Default Password and Username

       - User : admin
       - Password : admin
        
---

# 💻 Hardware Hub – PHP Shopping Cart for Computer Hardware

Hardware Hub is a simple web-based shopping cart system for a computer hardware store, built with PHP and MySQL. It allows users to browse products, add them to a cart, and proceed to checkout. The frontend is styled using Bootstrap 5 for a modern, responsive look.

---

## 🔧 Features

- Browse hardware items (with name and price)
- Add items to cart
- View and manage cart contents
- Checkout summary with total
- Optional login system (PHP session-based)
- Clean Bootstrap UI

---

## 🗂 Project Files

- `index.php` – Product listings page  
- `cart.php` – Shopping cart management  
- `checkout.php` – Order summary and final cart  
- `login.php` *(optional)* – User login using username/password  
- `logout.php` *(optional)* – Ends user session  
- `db.php` – MySQL database connection  
- `database.sql` – Contains table structure and sample data

---

## 🧱 Database Setup

1. Create a MySQL database (e.g., `hardware_hub`)
2. Import `database.sql` file via phpMyAdmin

### Required Tables:
```sql
-- Product Table
CREATE TABLE item (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  price DECIMAL(10,2),
  description TEXT
);

-- User Table (optional, for login)
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

-- Sample user (username: admin, password: admin)
INSERT INTO users (username, password) VALUES ('admin', MD5('admin'));
