﻿# Installation Aggregator

Procédure d'installation du serveur ***Aggregator*** sur OS ***Linux Debian 9***

    root@serveur:~# apt install apache2
    root@serveur:~# apt install php
    root@serveur:~# apt install mysql-server php-mysql
    root@serveur:~# a2enmod rewrite
    root@serveur:~# service apache2 restart
    
    root@serveur:~# mysql -e "CREATE DATABASE data"
    root@serveur:~# mysql -e "GRANT ALL PRIVILEGES ON data.* TO ruche@'%' IDENTIFIED BY 'touchard72';"
    root@serveur:~# mysql -e "create user 'admin'@'%' identified by 'touchard72';"
    root@serveur:~# mysql -e "grant all privileges on *.* to 'admin'@'%';"
    root@serveur:~# mysql -e "FLUSH PRIVILEGES;"
    
    root@serveur:~# mysql -u ruche -ptouchard72
    show databases;
    quit
    
    root@serveur:~# apt install phpmyadmin
    root@serveur:~# apt install git
    root@serveur:~# git clone https://github.com/PhilippeSimier/Aggregator.git
    root@serveur:~# mkdir -p /var/www/html/aggregator
    root@serveur:~# cp -a Aggregator/html/* /var/www/html/aggregator/
    root@serveur:~# cp Aggregator/html/.htaccess /var/www/html/aggregator/.htaccess
    root@serveur:~# mysql -u admin -ptouchard72  data  <Aggregator/SQL/data.sql



## Configuration du serveur Apache2

Les fichiers .htaccess ne sont pas activés par défaut . Pour modifier la configuration du site par défaut, éditer le fichier /etc/apache2/apache2.conf


    root@serveur:~# nano /etc/apache2/apache2.conf
Puis, recherchez toutes les lignes contenant: 

    AllowOverride None 

Et remplacez-les par 

    AllowOverride All 

   

Ajouter les lignes suivantes à la fin du fichier

    <ifModule mod_rewrite.c>    
    RewriteEngine On    
    </ifModule>

Redémarrer le service ***apache2***
 

    root@serveur:~# service apache2 restart



