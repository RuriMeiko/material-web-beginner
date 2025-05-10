# Web Chat Application

A real-time web chat application built with PHP and Apache, featuring messaging, user authentication, and a responsive design.

## Overview
This project was developed between April 24, 2024, and May 31, 2024, as a web-based chat platform. It allows users to register, log in, and exchange messages in real-time, with a focus on simplicity and usability.

## Features
- Real-time messaging powered by PHP and JavaScript
- User authentication for secure access
- Responsive UI designed with HTML and CSS
- URL routing handled by `.htaccess` for clean URLs
- Hosted on Apache web server

## Technologies
- **PHP**: Server-side logic and API handling
- **Apache**: Web server with `.htaccess` for routing
- **HTML/CSS**: Front-end structure and styling
- **JavaScript**: Real-time interactivity and client-side logic

## Prerequisites
- Apache web server (e.g., XAMPP, WAMP, or a Linux-based server) with `mod_rewrite` enabled
- PHP 7.4 or higher
- MySQL (optional, for user authentication and message storage)
- A modern web browser (Chrome, Firefox, Safari)

## Installation
1. Clone the repository and switch to the `chat` branch:
   ```bash
   git clone https://github.com/RuriMeiko/material-web-beginner.git
   git checkout chat
   ```
2. Move the entire project (including the `.htaccess` file) to your Apache web server's root directory (e.g., `htdocs` for XAMPP or `/var/www/html` for Linux).
   - Example:
     ```bash
     mv material-web-beginner /path/to/apache/htdocs/chat
     ```
3. Ensure Apache has `mod_rewrite` enabled to support `.htaccess` routing:
   - On Linux, enable it with:
     ```bash
     sudo a2enmod rewrite
     sudo service apache2 restart
     ```
   - For XAMPP/WAMP, ensure `rewrite_module` is enabled in the Apache configuration.
4. (Optional) Configure a MySQL database and update `config.php` with your database credentials.
5. Start the Apache server.
6. Access the application via your browser (e.g., `http://localhost/chat`).

## Usage
- Open the application in a web browser.
- Register a new account or log in with existing credentials.
- Start sending and receiving messages in real-time.


## Contributing
Contributions are welcome! Please:
1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Submit a pull request with a clear description of your changes.

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact
For questions or feedback, feel free to open an issue on GitHub.

![Thư mục giải nén](https://p21-ad-sg.ibyteimg.com/obj/ad-site-i18n-sg/202404255d0d7ab435fe049d4ae7973a)
