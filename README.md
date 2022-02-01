## Seriously do not use this
This is a work in progress and nowhere near complete.

## Some setup
sudo apt-get install apache2 php libapache2-mod-php -y<br />
sudo apt-get install php-ldap<br />
sudo apt-get install php-mbstring<br />
sudo systemctl restart apache2<br />

## Mod a file
sudo nano /etc/ldap/ldap.conf<br />
add the line<br />
TLS_REQCERT never<br />

## git clone
sudo git clone http://172.27.21.22:3000/steven.grosvenor995/passwords.git /var/www/html/passwords<br />

## Prepare Directory
sudo chgrp -R www-data /var/www/html/passwords<br />
sudo chmod g+rx /var/www/html/passwords<br />

## Testing
http://yourserver/passwords/