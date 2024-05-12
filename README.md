## Installation & Configuration:

1- Navigate/Change into (using the **cd** command) to the project root directory, then run the '***composer install***' command.

2- Run the '***npm install***' command (and only in case you face any issues/errors, run the 'npm audit fix' command), and then run the '***npm run build***' command.

3- Create a MySQL database named multivendor_ecommerce, then import the multivendor_ecommerce database SQL Dump File into your multivendor_ecommerce database.

4- Navigate to the **[.env](.env)** file and configure/update it with your MySQL database credentials and other configuration settings.

5- Run the '***php artisan serve***' command, and then open your browser and visit **http://127.0.0.1:8000** to access the Frontend section of the application, or **http://127.0.0.1:8000/admin/login** to access the Admin Panel.

Ready-to-use registered accounts credentials you can use to log in:
1. Superadmin (to access the Admin Panel): Email: admin@admin.com, Password: 123456

2. Vendor (to access the Admin Panel): Email: yasser@admin.com**, Password: 123456
    
3. User (to access the Frontend): Email: ibrahim@gmail.com, Password: 123456