## Live Demo
- [VISIT_BLOG](http://bloghds.herokuapp.com).

## Installation Guid


- Download th Project file
- Create .env file in root folder
- Create Email Account
- Create Google Developer Credential for OAuth2
	redirect url wiil be APP_URL/login/google/callback
- Run Command npm install
- Run command npm run dev 




## Generate App Key
- php artisan key:generate

-

## (.env) file updates


create below rows in your .env file

- APP_URL=(http://url)
- Create Database Connection
- MAIL_DRIVER=smtp
- MAIL_HOST=smtp.gmail.com
- MAIL_PORT=587
- MAIL_USERNAME=your gmail account
- MAIL_PASSWORD=your gmail password
- MAIL_ENCRYPTION=tls
- GOOGLE_CLIENT_ID=Client ID
- GOOGLE_CLIENT_SECRET=Client Secret


## Database Migration and Seeding Data
- php artisan migrate --seed

## Speacial Note

- You have to change email address in App\mail\notificationPost to your email address

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
