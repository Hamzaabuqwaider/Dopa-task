<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Dopa Travel Company Task

The goal of this task is to implement a secure, expiring one-time access link for users. This link should be:

Signed for security
Time-limited (expires after 10 minutes)
One-time use (invalid after the first access)
Logged to track unauthorized access attempts

- Requirements
1. Generate and Send a Secure Link
   Generate a random token.
   Store the token in the database with an expiration timestamp.
   Create a signed URL containing the token.
   Send the one-time access link via email (optional: if you need).


2. Validate the Access Link
       Ensure the signature is valid to prevent tampering.
       Check if the link has expired.
       Ensure the link has not been used before.
       Allow access only if all conditions are met.


3. Log Unauthorized Access Attempts
   Log cases where:
   The link has expired.
   The token is invalid or already used.
   The link is tampered.


4. Implement Middleware for Security
   Use middleware to validate the request before reaching the controller.

## Notes
- If any issue appears related to timezone , Please change the timezone in .env file to Asia/Amman
and in  config/app.php :
'timezone' => env('APP_TIMEZONE', 'Asia/Amman.
and run command php artisan o:c 

In this task, we implemented an email sending mechanism using Mailtrap for testing purposes, allowing us to simulate the process of generating and sending an email with a one-time access link.

- A new configuration key, can_send_mail, was added to config/mail.php. This setting is controlled by the .env file and determines whether emails should be sent when generating the link. By default, this is set to true.


- The ability to turn off email sending by setting CAN_SEND_MAIL=false in the .env file provides flexibility in testing and real-world scenarios where emails might need to be disabled temporarily.

## Endpoint API's

- For generate new token ... POST / api/generate-link
- For validate the link ... GET / api/secure-content/{token}
