# Installation Aggregator

Procédure d'installation du serveur ***Aggregator*** sur OS ***Linux Debian 9***

    root@serveur:~# apt install apache2
    root@serveur:~# apt install php
    root@serveur:~# apt install mysql-server php-mysql
    root@serveur:~# a2enmod rewrite
    root@serveur:~# service apache2 restart
    
    root@serveur:~# mysql -e "CREATE DATABASE data"
    root@serveur:~# mysql -e "GRANT ALL PRIVILEGES ON data.* TO ruche@'%' IDENTIFIED BY 'touchard72';"
    root@serveur:~# mysql -e "FLUSH PRIVILEGES;"
    
    root@serveur:~# mysql -u ruche -ptouchard72
    show databases;
    quit
    
    root@serveur:~# apt install phpmyadmin
    root@serveur:~# apt install git
    root@serveur:~# git clone https://github.com/PhilippeSimier/Aggregator.git
    




    






