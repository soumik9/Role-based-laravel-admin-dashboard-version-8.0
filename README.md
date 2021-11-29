<p align="center"><a href="https://docs.google.com/spreadsheets/d/10W31p2Vcd0jOxa6pWxibEGVr1fPzakDS3ctT-EirAUc/edit?usp=sharing" target="_blank">Role-based-laravel-admin-dashboard-version-8.0</a></p>

## About Laravel Template Admin Panel

This template can be used as starter pack of any laravel project. Easy to extend code for any feature. <br>
To see the progress report of this project, [Project report](https://docs.google.com/spreadsheets/d/10W31p2Vcd0jOxa6pWxibEGVr1fPzakDS3ctT-EirAUc/edit?usp=sharing). 

## Features

- Login (yourhostsite/admin/login) (email: admin@example.com, password: abc123)
- Reset password (setup your mail enviroment) [Mailtrap](https://mailtrap.io/)
- <b>File manager</b> used for image upload.
- <b>Tinymce</b> used for description.
- <b>Feathericons</b> used for icon.
- <b>Sweetalert</b> used for delete feature.
- Can view, create, update and delete <b>permission</b> for new features.
- Can view, create, update and delete <b>role</b> for any user.
- Can <b>assign permissions to a role when creating</b>.
- Can view, create, update and delete <b>user</b>.
- Can view <b>user activity</b>.
- Can <b>assign any ROLE to user when creating</b>.
- Can view, create, update and delete <b>Currency</b>.
- Can view, create, update and delete <b>CMS Category</b>.
- Can view, create, update and delete <b>CMS Pages</b>.
- Can <b>change Logo, Favicon, SEO setting, default CURRENCY, Contact details, Social Media links</b> from setting.
- Can read <b>errors logs</b>.


## To run this code on your enviroment

1. Make a test domain,
    Go to this location -> <b>C:\Windows\System32\drivers\etc </b> <br>
    Edit 'host' file and paste -> <b>127.0.0.1       giveaname.test </b> <br>
    Again, go to this location -> <b>C:\xampp\apache\conf\extra </b> <br>
    Edit 'httpd-vhosts.conf'file and paste ->  <br>
    <b>
    <VirtualHost *:80>
    ##ServerAdmin webmaster@dummy-host2.example.com
    DocumentRoot "C:/xampp/htdocs/projectname/public"
    ServerName giveaname.test
    ##ErrorLog "logs/dummy-host2.example.com-error.log"
    ##CustomLog "logs/dummy-host2.example.com-access.log" common
    </VirtualHost>
    </b> <br>
  
2. Create database and Edit '.env' <br>
3. Go to 'bootstrap' folder -> then 'cache' folder and delete everything inside folder. (If 'cache' folder is not available then make this folder)
4. If 'storage' folder doesn't exist then make 'storage' folder and inside 'storage' folder make these folder 'app', 'framework', 'log'. Inside 'app' folder make 'public'
   folder. Inside 'framwork' folder make these folder 'cache', 'sessions', 'testing', 'views'. Inside 'cache' folder make 'data' folder.
5. If 'storage' folder exist then delete all files inside these folder 'cache', 'sessions', 'testing', 'views'. And make sure inside 'cache' folder there exist 'data' folder.
6. Then run all of commands, <br>

                        composer install
                        php artisan key:generate
                        php artisan storage:link
                        php artisan migrate
                        php artisan db:seed
                        
                        php artisan cache:clear
                        php artisan config:clear
                        php artisan view:clear
                        php artisan config:cache
                        php artisan view:cache
                        php artisan route:cache
                        composer dump-autoload
                        php artisan vendor:publish
                       
7. For reset password feature config '.env' file with [Mailtrap](https://mailtrap.io/).
8. Now open your browser and go to your domain and ENJOY.
    
    
