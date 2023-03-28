<br />
<div align="center">
  <a href="#">
    <img src="https://user-images.githubusercontent.com/86828535/228288896-1d0395b5-74be-4e1e-9b26-1bfaf2e7d100.png" alt="Logo" width="80" height="80">
  </a>

<h3 align="center">HQ & RZN BOOK</h3>
<a href="https://fpalpro.rosyhaqqy.live/book">View Demo</a>

</div>

daftar isi:
* [About the Project](#about-the-project)
* [installation local](#installation-local)
  * [clone project](#clone-project)
  * [install composer](#install-composer)
  * [copy .env.example to .env](#copy-.env.example-to-.env)
  * [generate key](#generate-key)
  * [create database](#create-database)
  * [migrate database](#migrate-database)
  * [run project](#run-project)
* [fitur fitur](#fitur-fitur)
* [deployment](#deployment)
  * [command.sh](#command.sh)
  * [nginx config](#nginx-config)
  * [web.config in public](#web.config-in-public)
  * [allow all permision logs,framework,views,photo](#allow-all-permision-logs,framework,views,photo)




## About The Project
[[![a](https://user-images.githubusercontent.com/86828535/228285576-a365248f-a6a3-4f6c-8795-2ca60479197d.png)]](https://fpalpro.rosyhaqqy.live)

HQ & RZN BOOK adalah sarana review buku, seperti halnya IMDB versi buku.



## installation local
### clone project
```bash
git clone https://github.com/athraz/FP-ALPRO.git
```
### install composer
```bash
composer install
```
### copy .env.example to .env
```bash
cp .env.example .env
```
### generate key
```bash
php artisan key:generate
```
### create database
```bash
create database fpalpro
```
### migrate database
```bash
php artisan migrate
```
### run project
```bash
php artisan serve
```

## fitur fitur
* login sebagai user/admin
* register sebagai user
* admin bisa menambah, mengedit, melihat dan menghapus semua buku, genre, author, dan review 
* admin bisa menambah, mengedit, melihat, dan menghapus semua user 
* user bisa melihat buku, genre, author, dan review 
* user bisa menambah, mengedit, dan menghapus review yang dibuatnya 
* Web dapat diakses semua orang(terdeploy)
* Terdapat pembatasan permision pada role tamu,user,admin
* Fitur rating,dan rata rata rating pada review dan buku
* Semua fitur dijamin terhindar dari bug(dalam pengerjaan menemuka banyak bug seperti buku tidak bisa di hapus jika ada review dsb)

semua fitur dapat dicoba di link berikut:

[link demo](https://fpalpro.rosyhaqqy.live)


## DEPLOYMENT
### command.sh
```bash
#!/bin/bash

#Update
sudo apt-get update -y

#Install dependencies and add PHP8.1 repository
sudo apt-get install  ca-certificates apt-transport-https software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y

# install nginx
sudo apt-get install nginx -y

# You should install PHP8.1 version to run the Laravel Project
sudo apt-get update -y
sudo apt-get install php8.1-common php8.1-cli -y

# install PHP package
sudo apt-get install php8.1-mbstring php8.1-xml unzip composer -y
sudo apt-get install php8.1-curl php8.1-mysql php8.1-fpm -y

# install MYSQL
sudo apt-get install mysql-server -y

# Set MYSQL password
sudo apt-get install debconf-utils -y
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password root"


# Copy to sites-enabled directory
sudo ln -s /etc/nginx/sites-available/example.conf /etc/nginx/sites-enabled
sudo service nginx restart

```

### nginx config
```conf
server {
    listen 80;
    listen [::]:80;
    server_name fpalpro.rosyhaqqy.live;
    root /var/www/laravel/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### web.config in public
```
<!--
    Rewrites requires Microsoft URL Rewrite Module for IIS
    Download: https://www.iis.net/downloads/microsoft/url-rewrite
    Debug Help: https://docs.microsoft.com/en-us/iis/extensions/url-rewrite-module/using-failed-request-tracing-to-trace-rewrite-rules
-->
<configuration>
  <system.webServer>
    <rewrite>
      <rules>
        <rule name="Imported Rule 1" stopProcessing="true">
          <match url="^(.*)/$" ignoreCase="false" />
          <conditions>
            <add input="{REQUEST_FILENAME}" matchType="IsDirectory" ignoreCase="false" negate="true" />
          </conditions>
          <action type="Redirect" redirectType="Permanent" url="/{R:1}" />
        </rule>
        <rule name="Imported Rule 2" stopProcessing="true">
          <match url="^" ignoreCase="false" />
          <conditions>
            <add input="{REQUEST_FILENAME}" matchType="IsDirectory" ignoreCase="false" negate="true" />
            <add input="{REQUEST_FILENAME}" matchType="IsFile" ignoreCase="false" negate="true" />
          </conditions>
          <action type="Rewrite" url="index.php" />
        </rule>
      </rules>
    </rewrite>
  </system.webServer>
</configuration>
```

### allow all permision logs,framework,views,photo
```bash
sudo chmod -R 777 storage
sudo chmod -R 777 public
```

## contributors
* [Rosy Haqqy](https://github.com/hqlco)
* [razan ath](https://github.com/athraz)

----------------
"NO ROYAL ROAD IN GEOMETRY"
