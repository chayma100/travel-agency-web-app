# ✈️ GoMondo - Travel Agency Web Application

> Academic project developed as part of the curriculum at **ENSI** (National School of Computer Science), University of Manouba.

---

## 📌 Overview

**GoMondo** is a full-stack travel agency website that allows customers to explore destinations, book trips, contact the agency, and access special services such as Omra packages. An admin panel is included for managing offers, services, users, and messages.

---

## 🗂️ Project Structure

```
gomondo-travel-agency/
│
├── pages/          # HTML pages (home, destinations, contact, etc.)
├── css/            # Stylesheets
├── js/             # JavaScript files
├── php/            # PHP backend (authentication, admin, booking)
├── images/         # Website images
├── uploads/        # User-uploaded files (not included in repo)
└── README.md
```

---

## ✨ Features

### 👤 Client Space
- User registration and login
- Browse travel offers and destinations
- Book and cancel trips
- Omra service with spiritual guide selection
- Contact form
- Customer reviews and feedback
- Agency locator with Google Maps
- AI Chatbot assistant
- Barcode generator for bookings
- Dark / Light mode toggle

### 🔧 Admin Panel
- Dashboard
- User management
- Add / delete offers and services
- View received messages
- Manage reservations

---

## 🛠️ Tech Stack

| Technology | Purpose |
|---|---|
| HTML5 | Page structure |
| CSS3 | Styling and design |
| JavaScript | Dynamic interactions |
| PHP | Server-side logic |
| MySQL | Database |
| PDO / MySQLi | Database connection |
| Font Awesome | Icons |
| Google Maps API | Agency locations map |
| SweetAlert2 | Styled alerts |
| PHPMailer | Email sending |

---

## 🗄️ Database

Database name: `agence_voyage`

Main tables:
- `utilisateurs` — user accounts
- `reservations` — trip bookings
- `offres` — travel offers
- `services` — available services
- `contact_messages` — contact form messages

---

## ⚙️ Local Setup

1. Clone the repository:
```bash
git clone https://github.com/yourusername/gomondo-travel-agency.git
```

2. Move the project to your local server directory (e.g. `htdocs` for XAMPP)

3. Create the MySQL database:
```sql
CREATE DATABASE agence_voyage;
```

4. Update the database connection in PHP files:
```php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "agence_voyage";
```

5. Start XAMPP and open:
```
http://localhost/gomondo-travel-agency/php/index.php
```

---

## 📄 License

Academic project — for educational purposes only.
