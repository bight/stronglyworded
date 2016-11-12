[![Packagist](https://img.shields.io/packagist/v/greatislander/stronglyworded.svg?style=flat-square)](https://packagist.org/packages/greatislander/stronglyworded)

# Strongly Worded

Strongly Worded is a simple web application which lets you create customizable form letters which signees can fill out and turn into PDF for printing and mailing. Built as an alternative to electronic petition sites, Strongly Worded can be used to facilitate civic engagement by mail.

Requires PHP >= 5.6.

## Usage (LAMP/LEMP Server)

1. Clone this repo: `git clone https://github.com/greatislander/stronglyworded.git`.
2. Run `composer install` from within it (maybe you need to [install Composer](https://getcomposer.org) first).
3. Edit `config.yml` to suit your needs.
4. Replace the contents of `content/body.md` with your letter.
5. Replace the contents of `content/intro.md` with an introduction explaining your letter to visitors.
6. Commit your changes: `git commit -am "Update configuration and content."` (optional).
7. Upload the folder's contents (including `vendor`) to the webroot of a LAMP or LEMP server.

## Usage (Heroku)

1. Clone this repo: `git clone https://github.com/greatislander/stronglyworded.git`.
2. Edit `config.yml` to suit your needs.
3. Replace the contents of `content/body.md` with your letter.
4. Replace the contents of `content/intro.md` with an introduction explaining your letter to visitors.
5. Commit your changes: `git commit -am "Update configuration and content."`.
6. Log in to your Heroku account (maybe you need to [install the Heroku CLI](https://devcenter.heroku.com/articles/heroku-command-line#download-and-install) first): `heroku login`.
7. Create an app on Heroku: `heroku create`.
8. Deploy your code: `git push heroku master`.
9. Ensure that at least one instance of your app is running: `heroku ps:scale web=1`.
10. Open your app: `heroku open`.
