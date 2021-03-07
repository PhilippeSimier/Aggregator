# Installation Aggregator

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
    root@serveur:~# mysql -u ruche -ptouchard72  data  <Aggregator/SQL/data.sql



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

## Remplir les tables de fuseaux horaires
La procédure d'installation de MySQL crée les tables de fuseau horaire, **mais ne les charge pas**. Utilisez la ligne de commande suivante.

    mysql_tzinfo_to_sql /usr/share/zoneinfo | mysql -u root -p mysql
laissez le mot de passe vide (appuyer sur enter)
Vous pouvez voir un avertissement comme ci-dessous, mais ne vous inquiétez pas à ce sujet.

    Warning: Unable to load '/usr/share/zoneinfo/leap-seconds.list' as time zone. Skipping it.

## Crontab
en tant qu'utilisateur root ajouter les cron jobs suivants
``` bash
crontab -e

*/10 * * * * /usr/bin/php /var/www/html/Aggregator/api/reactFrequency.php 10 > /dev/null 2>&1
*/30 * * * * /usr/bin/php /var/www/html/Aggregator/api/reactFrequency.php 30 > /dev/null 2>&1
0 * * * *    /usr/bin/php /var/www/html/Aggregator/api/reactFrequency.php 60 > /dev/null 2>&1

```

### Changelog

 **27/10/2020 :** Ajout du README . 
 
 
> **Notes :**


> - Licence : **licence publique générale** ![enter image description here](https://img.shields.io/badge/licence-GPL-green.svg)
> - Auteur **Philippe SIMIER - Lycée Touchard Le Mans**
>  ![enter image description here](https://img.shields.io/badge/built-passing-green.svg)
<!-- TOOLBOX 

Génération des badges : https://shields.io/
Génération de ce fichier : https://stackedit.io/editor#
