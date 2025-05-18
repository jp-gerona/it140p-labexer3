# IT140P: Lab Exercise 3

This lab exercise demonstrates how to create a SOAP application using the NuSOAP library. In addition, various concepts were explored in the project, such as: Designing with Bootstrap and Testing.

## Lab Instructions

Using Nusoap Library create an application that will respond the courses taken by the student this term AY 2024-2025, user's input should be the student's complete name. Indicate on the application "STUDENT COURSE PORTAL 3T 2024- 2025". Fault element must be visible in case a student information is not found like "Record not found for: Belen Ladesma".

## Stack

<div align="center">

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white)
![Codeception](https://img.shields.io/badge/codeception-%236BFD.svg?style=for-the-badge)
![Selenium](https://img.shields.io/badge/-selenium-%43B02A?style=for-the-badge&logo=selenium&logoColor=white)

</div>

## Libraries

- NuSOAP (v.0.9.5)
- Bootstrap (v.5.1.3)
- Codeception (v5.3.1)

## Features

- Composer: package manager for handling dependencies
- NuSOAP: API for sending XML request and gettings XML response
- Bootstrap: UI Library
- Codeception: application acceptance testing

## Prerequesites

Ensure the following are installed:

- XAMPP
- Composer

## Setup

1. Clone the repository inside your XAMPP `htdocs` folder.
```bash
git clone https://github.com/jp-gerona/it140p-labexer3.git
cd it140p-labexer3
```

2. Install Composer dependencies
```bash
composer install
```

3. Start Apache web server using the XAMPP interface

4. Navigate to the page
```bash
http://localhost/it140p-labexer3/src/index.php
```

## Testing

Acceptance testing cases are written using Codeception and are automated in a real browser using Selenium Standalone Server. Testing can be ran either thru PHPBrowser or WebDriver.

### Using PHPBrowser

1. In the `Acceptance.suite.yml` file, Uncomment the PHPBrowser config and comment out the WebDriver lines.

### Using a WebDriver

Using a WebDriver requires the following installed:

- Selenium Standalone Server
- Webdriver(ChromeDriver, GeckoDriver, etc.)

1. Start Selenium Server, for example:
```bash
java -jar /usr/local/bin/selenium-server-standalone-3.141.59.jar
```

2. Execute the tests written, for example:
```bash
vendor/bin/codecept run Acceptance --steps
```
