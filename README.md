## Tasks
1. Importing employees into the database from an XML file (you have to think of the format yourself)
2. Selecting employees from the database (Design by yourself)
3. Display a list of employees with the following information: full name, date of birth, department, position, employee type (rate or hourly pay), payment per month (calculated according to a formula depending on employee type).
4. The option of showing of (10, 25, 50, 100) employees on the page with the possibility of choosing the number of employees. (10 by default).
5. Add the possibility of pagination by employees.
6. Add navigation by department, switching by department leads to the employee page of the selected department.
7. Implement page to display 404 http status.

## Setup guide
1. ~~Create .env file~~ Done
2. `composer install`
3. `./vendor/bin/sail up -d`
4. `./vendor/bin/sail php artisan migrate --seed`

> The Xml file example: `./example_file.xml`
