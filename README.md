## Bento Box Builder Web App

### Overview
A fully interactive web application that lets users create accounts and sign in to customize, save and view their own bento box meals. This project began as an assignment for Drexel University's Web Systems and Services II course. 

### Features
- #### Interactive Bento Builder
  - Live image preview of lunch box and food item pngs update instantly as user selects mains, sides, drinks and sauces
  - Chef's recommendation button that creates "chef's surprise" bento box with randomized items
  - Customizable titles and option to add notes
- #### Saved Bento Boxes
  - Save unlimited custom boxes
  - Mini preview thumbnails of saved boxes
  - Click any saved box to open a fulls-sized modal preview
  - Delete boxes individually
- #### Secure User Accounts
  - Session-based authentication
  - Password hashing
  - Users can only access their own saved boxes
 
 ### Tech Stack
- #### Frontend
  - HTML, CSS, JavaScript
- #### Backend
  - PHP
- #### Database
  - MySQL
- #### Environment
  - XAMPP/Apache
 
### How to Run Locally
  1. Visit https://www.apachefriends.org/download.html in web browser to download XAMPP
  2. Clone this repository
  3. Place the cloned repository folder inside the XAMPP htdocs folder
  4. Open XAMPP control panel and start Apache and MySQL
  5. Import database.sql file into phpMyAdmin by visiting localhost/phpmyadmin in web browser
  6. Visit http://localhost/INFO152Project_mr3798/index.php in web browser to run the site
