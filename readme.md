
## CurrAnalytics

**Install Guide:**

This example uses MySQL. This guide was tested on both Linux(Ubuntu) and Windows environments. Requires node.js to compile assets

1. Clone project into your environment with "git clone https://github.com/MJBrennan/CurrAnalytics/"
2. Rename example.env to .env.
3. Create a fresh database in your mysql client and create a connection to this database by filling out your database details in the .env file.
4. Run "php artisan key:generate"
5. Run "npm install"
6. Run "npm run dev" to compile assets
7. Run "php artisan serve"
8. Go to 127.0.0.1:8000 in your browser to check that the applicaton is running

Note: make sure you run commands without the quotation marks
