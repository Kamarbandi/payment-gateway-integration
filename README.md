This repository contains the code for integrating with the provider's API for credit card data encryption and testing API interactions through a local mock server. The mock server allows you to test API interactions without the need for a real server.

### To start the local mock server, use the following command:

```bash
php -S localhost:8080 mock-server.php
```

### After that, the server will be available at the following address:

http://localhost:8080/tokenize


### Running tests
#### To run the tests for your project, execute the following command in the root directory of the project:

```bash
vendor/bin/phpunit --bootstrap vendor/autoload.php tests/PaymentServiceTest.php
```

#### If you want to run all the tests in the "tests" folder, execute the following command:

```bash
vendor/bin/phpunit --bootstrap vendor/autoload.php tests
```

#### To run a specific test, specify the test class name and the method name you want to check:

```bash
vendor/bin/phpunit --bootstrap vendor/autoload.php --filter testCreateTransaction tests/PaymentServiceTest.php
```