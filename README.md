salary-dates
============

PHP/Symfony2.8 application.

1. To run application enter command:

app/console app:salary-dates [filename]

Parameter:
[filename] - output csv filename

Sample: app/console app:salary-dates myfile

Output file is generated to 'web' directory.

2. Unit tests can be run using following command:

./vendor/phpunit/phpunit/phpunit ./src/AppBundle/Tests/Entity/SalaryDateCalculationsTest

