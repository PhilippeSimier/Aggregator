# Mémo SQL

## Connexion au serveur

La ligne de commande suivante permet de se connecter au serveur mysql en tant qu’utilisateur ruche (attention pas d'espace entre -p et le mot de passe).
```bash
mysql -u ruche -pxxxxxxxx72
Welcome to the MariaDB monitor.  Commands end with ; or \g.
Your MariaDB connection id is 98894
Server version: 10.1.26-MariaDB-0+deb9u1 Debian 9.1

Copyright (c) 2000, 2017, Oracle, MariaDB Corporation Ab and others.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

MariaDB [(none)]> show databases;
+--------------------+
| Database           |
+--------------------+
| data               |
| information_schema |
+--------------------+
2 rows in set (0.00 sec)

MariaDB [(none)]> use data;

```

## Ajouter une colonne 

Pour modifier la structure d'une table:  **ALTER**
La requète suivante ajoute une colonne status  **ADD `status`** de type enum à la table **things** après la colonne **name**.
```sql
 ALTER TABLE `things` ADD `status` ENUM('public','private') NULL DEFAULT NULL AFTER `name`;
```
## Mettre à jours la valeur d'un champ
Pour mettre à jour la valeur d'un champ : **UPDATE**
La requête suivante met à jours le champ **status** dans la table **things** pour la ligne dont l'**id** est égal à 1
```sql
UPDATE `data`.`things` SET `status` = 'public' WHERE `things`.`id` = 1;
```
Retirer 2 heures à un champ datetime **DATE_SUB**
```sql
UPDATE `feeds` SET `date`= DATE_SUB(`date`, INTERVAL 2 HOUR) WHERE id_channel = 539387;
```


## Créer une vue
Une vue est considérée comme une table virtuelle car elle n'a pas d’existence propre.
Une vue est créée à partir d'une requête de définition. 
```sql
CREATE
 ALGORITHM = UNDEFINED
 VIEW `users_things`
 AS SELECT `name`, `USER_API_Key`,`tag` FROM `things`,`users` where `user_id`=`users`.id
```
Interroger la vue `users_things`

Une fois créée une vue s’interroge comme une table. 
```sql
MariaDB [data]> SELECT * FROM `users_things`;
+----------------+------------------+----------+
| name           | USER_API_Key     | tag      |
+----------------+------------------+----------+
| Ruche France   | 9L0V9YXONAUJ0QRH | beehive  |
| Ruche Danemark | 9L0V9YXONAUJ0QRH | danemark |
| Ruche Philippe | RC8IK9LVVYEYZNSM | beehive  |
+----------------+------------------+----------+
3 rows in set (0.01 sec)

```

## Créer un déclencheur

Un déclencheur (trigger) peut être considéré comme une action (requête ou programme) associé à un événement particulier sur la base. (action sur un table). C'est l'événement de mise à jour de la table qui lance automatiquement le code programmé dans le déclencheur.
```sql
CREATE TRIGGER after_insert_feeds AFTER INSERT
ON feeds FOR EACH ROW

UPDATE `channels` 
SET `last_entry_id`= (SELECT count(*) FROM `feeds` WHERE `id_channel` = NEW.id_channel) , 
`last_write_at`=NOW() 
WHERE `id` = NEW.id_channel;
```
Après chaque **insertion** dans la table **feeds** les champs *last_entry_id* et *last_write_id* de la table **channels** sont mis à jours.

### Supprimer le trigger
```sql
DROP TRIGGER after_insert_feeds
```

## Définir la timezone

Afficher l'heure courante:
```sql
MariaDB [(none)]> select now();
+---------------------+
| now()               |
+---------------------+
| 2019-09-03 09:42:22 |
+---------------------+
1 row in set (0.00 sec)
```
pour configurer **@@global.time_zone variable**

Cette variable a pour  valeur par défaut  **SYSTEM**, ce qui indique que mariadb defini le même fuseau horaire que le système d'exploitation. 
```sql
MariaDB [(none)]> SET @@global.time_zone = '+00:00';
Query OK, 0 rows affected (0.00 sec)

MariaDB [(none)]> SELECT @@global.time_zone;
+--------------------+
| @@global.time_zone |
+--------------------+
| +00:00             |
+--------------------+
1 row in set (0.00 sec)
```
pour configurer **@@session.time_zone**
```sql
MariaDB [(none)]> SET @@session.time_zone = "+00:00";
Query OK, 0 rows affected (0.00 sec)

MariaDB [(none)]> SELECT @@session.time_zone;
+---------------------+
| @@session.time_zone |
+---------------------+
| +00:00              |
+---------------------+
1 row in set (0.00 sec)
```
A partir de maintenant, la fonction **now()** renvoie la date et l'heure UTC
```sql
MariaDB [(none)]> select now();
+---------------------+
| now()               |
+---------------------+
| 2019-09-03 07:44:33 |
+---------------------+
1 row in set (0.01 sec)
```
###Afficher l'historique des commandes
```
root@dmz:~# tail .mysql_history
```

### Changelog

 **10/06/2019 :** Ajout de Authentification SSH par clés . 
 
 
> **Notes :**


> - Licence : **licence publique générale** ![enter image description here](https://img.shields.io/badge/licence-GPL-green.svg)
> - Auteur **Philippe SIMIER Lycée Touchard Le Mans**
>  ![enter image description here](https://img.shields.io/badge/built-passing-green.svg)
<!-- TOOLBOX 

Génération des badges : https://shields.io/
Génération de ce fichier : https://stackedit.io/editor#
https://docplayer.fr/15188945-Le-traitement-d-images-avec-opencv.html

