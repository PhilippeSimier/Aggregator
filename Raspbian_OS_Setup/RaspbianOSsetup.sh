# !/bin/bash
#
echo "Customizing Raspbian for Aggregator IOT..."
echo "1. Update package repository..."
sudo apt-get -y update

# Upgrade the repository to point to the latest locations
echo "2. Upgrade to latest..."
sudo apt-get -y upgrade

# Install all the required packages. Following are the required packages
echo "3. Installing required software packages..."
sudo apt-get -y install apache2
sudo apt-get -y install php
sudo apt-get -y install mariadb-client
sudo apt-get -y install mariadb-server
sudo apt-get -y install php-mysql
sudo apt-get -y install phpmyadmin


# Clean-up the installation
echo "4. Remove un-needed packages..."
sudo apt-get -y autoremove

# Configure Apache
echo "5. Configuration Apache2..."
sudo a2enmod cgi
sudo a2enmod rewrite
sudo cp /home/pi/Aggregator/Raspbian_OS_Setup/apache2.conf /etc/apache2/apache2.conf
sudo service apache2 restart


# Installe les fichiers pour le site Web
mkdir -p /var/www/html/Ruche
cp -a /home/pi/Aggregator/html/* /var/www/html/Ruche/
cp -a /home/pi/Aggregator/html/.htaccess /var/www/html/Ruche/

echo "Customization Complete..."

