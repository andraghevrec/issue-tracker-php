\# Issue Tracker (PHP \& MySQL)



A simple issue tracking application built with \*\*pure PHP and MySQL\*\*, without any framework.  

This project demonstrates core backend concepts such as authentication, CRUD operations, and database relations.



---



\## Features



\- User authentication (login / logout)

\- Session-based access control

\- Create, read, update and delete issues (CRUD)

\- Issue status management: `open`, `in\_progress`, `closed`

\- Issues linked to users (SQL JOIN)

\- Clean project structure (no framework)

\- Basic UI styling with CSS



---



\## Technologies Used



\- PHP (procedural)

\- MySQL

\- PDO (prepared statements)

\- HTML \& CSS

\- phpMyAdmin (for database management)



---



\## Project Structure



issue-tracker/

│

├── assets/

│ └── style.css

│

├── config/

│ └── database.php

│

├── issues/

│ ├── create.php

│ ├── edit.php

│ └── delete.php

│

├── index.php

├── login.php

├── logout.php

├── dashboard.php

└── README.md





---



\## Database Schema



\### users

\- id (INT, PK)

\- username (VARCHAR)

\- password (VARCHAR, hashed)

\- role (ENUM: user, admin)

\- created\_at (TIMESTAMP)



\### issues

\- id (INT, PK)

\- title (VARCHAR)

\- description (TEXT)

\- status (ENUM: open, in\_progress, closed)

\- user\_id (INT, FK)

\- created\_at (TIMESTAMP)



---



\## How to Run Locally



1\. Clone the repository

2\. Place it inside `htdocs` (XAMPP)

3\. Create a MySQL database named `issue\_tracker`

4\. Import the SQL tables

5\. Configure database credentials in `config/database.php`

6\. Open the app in your browser:



http://localhost/issue-tracker/login.php





---



\## Purpose



This project was created as a \*\*learning and portfolio project\*\* to demonstrate a solid understanding of PHP fundamentals and MySQL integration without relying on frameworks.



---



\## Author



Andra Ghevrec



Junior PHP developer 



