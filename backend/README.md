# Luhn Number Validator
Written for php version 7.1.

### Usage
To use the LuhnValidator, run this command from the command line:
```
php src/main.php <number>
```
The current working directory doesn't matter. The number provided will be validated against the Luhn checksum. The number must be a single, whole number of at least 2 digits.

### Tests
To run automated tests, execute this command:
```
php test/luhn-test.php
```
This will run a series of tests against the LuhnValidator class and then again against the main.php script. Output simply echoes out Pass or FAIL messages.