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
