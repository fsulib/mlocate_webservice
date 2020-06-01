rm -f /etc/localtime
ln -s /usr/share/zoneinfo/US/Eastern /etc/localtime

apt update
apt -y upgrade
apt -y install apache2 unzip php7.2 php-dev php-gd php-soap php-mbstring php-zip php-curl

echo "AddHandler php5-script .php" >> /etc/apache2/apache2.conf
echo "AddType text/html .php" >> /etc/apache2/apache2.conf
sed -i -e 's/AllowOverride\ None/AllowOverride\ All/g' /etc/apache2/apache2.conf

rm /var/www/html/index.html
cp /vagrant/index.php /var/www/html/index.php

service apache2 restart
