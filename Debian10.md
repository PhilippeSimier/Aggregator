# Installation Aggregator

Procédure d'installation du serveur ***Aggregator*** sur OS ***Linux Debian 10***
## 1 Installation de mariadb
    root@serveur:~# apt update
    root@serveur:~# apt install mariadb-server
    root@serveur:~# mysql_secure_installation
    
    
    root@serveur:~# mysql -e "CREATE DATABASE data"
    root@serveur:~# mysql -e "GRANT ALL PRIVILEGES ON data.* TO ruche@'%' IDENTIFIED BY 'touchard72';"
    root@serveur:~# mysql -e "create user 'admin'@'%' identified by 'touchard72';"
    root@serveur:~# mysql -e "grant all privileges on *.* to 'admin'@'%';"
    root@serveur:~# mysql -e "FLUSH PRIVILEGES;"
    
    root@serveur:~# mysql -u ruche -ptouchard72
    show databases;
    quit

## 2 Installation de php7
    
    root@serveur:~# apt install php
    root@Serveur:~# apt install php-mbstring php-zip php-gd
    root@Serveur:~# apt install  php-mysql
    
Configuration de php : éditer le fichier php.ini

    root@Serveur:~# nano /etc/php/7.3/apache2/php.ini
   
Modifier les lignes suivantes :

 -  post_max_size = 20M 
 -  upload_max_filesize = 20M 
 -  error_reporting = E_ALL
 -    display_errors = On

Redémarrer le service apache2

    root@Serveur:~# /usr/sbin/service apache2 restart

## Installation de phpmyadmin
 
  
    root@serveur:~# root@Serveur:~# wget https://files.phpmyadmin.net/phpMyAdmin/4.9.7/phpMyAdmin-4.9.7-all-languages.tar.gz
    root@serveur:~# tar xvf phpMyAdmin-4.9.7-all-languages.tar.gz
    root@Serveur:~# mv phpMyAdmin-4.9.7-all-languages/ /usr/share/phpmyadmin
    root@Serveur:~# mkdir -p /var/lib/phpmyadmin/tmp
    root@Serveur:~# chown -R www-data:www-data /var/lib/phpmyadmin
    root@Serveur:~# cp /usr/share/phpmyadmin/config.sample.inc.php /usr/share/phpmyadmin/config.inc.php
    root@Serveur:~# apt install pwgen
    root@Serveur:~# pwgen -s 32 1
Recopier le mot obtenu dans le fichier de configuration

    root@Serveur:~# nano /usr/share/phpmyadmin/config.inc.php
    
    $cfg['blowfish_secret'] = 'k6qBOUjZGYrwIq7K1dnkKeFBqaUDilRw'; 
 Ensuite, faites défiler jusqu'à la lecture du commentaire 
 
 `/* User used to manipulate with storage */`. 
 
 Cette section inclut quelques directives qui définissent un utilisateur de base de données MariaDB nommé **pma** qui effectue certaines tâches administratives dans phpMyAdmin. [Selon la documentation officielle](https://docs.phpmyadmin.net/en/latest/config.html#cfg_Servers_controlpass) , ce compte utilisateur spécial n'est pas nécessaire dans les cas où un seul utilisateur accédera à phpMyAdmin, mais il est recommandé dans les scénarios multi-utilisateurs.

Décommentez les directives `controluser`et `controlpass`en supprimant les barres obliques précédentes. 
Mettez ensuite à jour la `controlpass`directive pour qu'elle pointe vers un mot de passe sécurisé de votre choix.  
Si vous ne le faites pas, le mot de passe par défaut restera en place et des utilisateurs inconnus pourront facilement accéder à votre base de données via l'interface phpMyAdmin.

Après avoir apporté ces modifications, cette section du fichier ressemblera à ceci: 

    /* User used to manipulate with storage */
    // $cfg['Servers'][$i]['controlhost'] = '';
    // $cfg['Servers'][$i]['controlport'] = '';
     $cfg['Servers'][$i]['controluser'] = 'pma';
     $cfg['Servers'][$i]['controlpass'] = 'touchard72';
Sous cette section, vous trouverez une autre section précédée d'une lecture de commentaire 

`/* Storage database and tables */`.
 
 Décommentez chaque ligne de cette section en supprimant les barres obliques au début de chaque ligne .
 
Enfin, faites défiler vers le bas du fichier et ajoutez la ligne suivante.
```
$cfg['TempDir'] = '/var/lib/phpmyadmin/tmp';
```
Exécutez la commande suivante pour utiliser le fichier `create_tables.sql` afin de créer la base de données et les tables de stockage de configuration:

    root@Serveur:~# mariadb < /usr/share/phpmyadmin/sql/create_tables.sql
Ensuite, vous devrez créer l' utilisateur **pma** administratif .

    MariaDB [(none)]> GRANT SELECT, INSERT, UPDATE, DELETE ON phpmyadmin.* TO 'pma'@'localhost' IDENTIFIED BY 'touchard72';

Créez un fichier nommé `phpmyadmin.conf`dans le répertoire  `/etc/apache2/conf-available/`:
Copier le contenu fourni dans le fichier de même nom du dépôt.

    root@Serveur:~# nano /etc/apache2/conf-available/phpmyadmin.conf

Activer la configuration

    root@Serveur:/usr/share/phpmyadmin# /usr/sbin/a2enconf phpmyadmin.conf
    Enabling conf phpmyadmin.
    To activate the new configuration, you need to run:
      systemctl reload apache2

 
Installation des paquets supplémentaires    

    root@Serveur:~# apt install php-mbstring php-zip php-gd

Redémarrer le service apache2

    root@Serveur:~# /usr/sbin/service apache2 restart
    
## Installation de git & clonage du dépot
    
    root@Serveur:~# apt install git
    root@serveur:~# git clone https://github.com/PhilippeSimier/Aggregator.git

## Transfert des fichiers
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
 
    root@serveur:~# /usr/sbin/a2enmod rewrite
    root@Serveur:~# /usr/sbin/a2enmod headers
    root@serveur:~# /usr/sbin/service apache2 restart
 

## Remplir les tables de fuseaux horaires
La procédure d'installation de MySQL crée les tables de fuseau horaire, **mais ne les charge pas**. Utilisez la ligne de commande suivante.

    mysql_tzinfo_to_sql /usr/share/zoneinfo | mysql -u root -p mysql
laissez le mot de passe vide (appuyer sur enter)
Vous pouvez voir un avertissement comme ci-dessous, mais ne vous inquiétez pas à ce sujet.

    Warning: Unable to load '/usr/share/zoneinfo/leap-seconds.list' as time zone. Skipping it.

### Changelog

 **29/10/2020 :** Ajout du README . 
 
 
> **Notes :**


> - Licence : **licence publique générale** ![enter image description here](https://img.shields.io/badge/licence-GPL-green.svg)
> - Auteur **Philippe SIMIER - Lycée Touchard Le Mans**
>  ![enter image description here](https://img.shields.io/badge/built-passing-green.svg)
<!-- TOOLBOX 

Génération des badges : https://shields.io/
Génération de ce fichier : https://stackedit.io/editor#

