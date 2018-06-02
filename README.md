# Privacy Consent Checker

This is a (dirty, but working) PHP implementation for a consent check before entering the page.

## Installation
- [Download](https://github.com/v-gar/privacy-consent-checker/archive/master.zip) the files
- rename **index.php** to something you like (e.g. **consentcheck.php**)
- add your privacy statement to **privacy-statement.html**
- place the files into your webroot of your PHP application
- add the following at **the very top (probably line 2)** of your index.php / PHP bootstrap file

```php
require 'consentcheck.php'
```
(replace consentcheck.php by the new file name you added in step 2)

## WARNING
**There could be problems with Art. 7 DSGVO. Use at own risk!**

This is only a technical proof-of-concept without any claim to correctness, accuracy or completeness!
