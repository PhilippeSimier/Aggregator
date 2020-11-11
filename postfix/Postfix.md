# Installation Postfix

**Postfix** est un agent de transfert de courrier électronique (MTA), une application utilisée pour envoyer et recevoir des courriels. Dans ce tuto, vous allez installer et configurer Postfix de manière à ce qu’il puisse être utilisé pour envoyer des courriers électroniques au moyen d’applications locales uniquement, c’est-à-dire celles installées sur le même serveur que Postfix.

Pourquoi voudriez-vous faire ça?
Vous gérez un serveur cloud sur lequel vous avez installé des applications nécessitant l’**envoi de notifications par courrier**, l’exécution d’un serveur SMTP local à envoi uniquement est une bonne alternative à l’utilisation d’un fournisseur de service de messagerie tiers ou à l’exécution d’un serveur SMTP complet.

## 1 Conditions préalables

Notez que le nom d’hôte de votre serveur doit correspondre à votre domaine ou sous-domaine. Vous pouvez vérifier le nom d’hôte du serveur en tapant `hostname` à l’invite de commande.

## 2 Installation
 
    root@serveur:~# apt update
    root@Serveur:/home/toto# apt install mailutils
    root@Serveur:/home/toto# apt install postfix
    
## 3 Configuration

Au cours de cette étape, vous configurerez **Postfix** pour qu’il traite les demandes d’envoi d’e-mails uniquement à partir du serveur sur lequel il est exécuté, c'est-à-dire de  `localhost`.

Pour cela, Postfix doit être configuré pour écouter uniquement sur  _loopback interface_, l’interface réseau virtuelle que le serveur utilise pour communiquer en interne.

    root@Serveur:/home/toto# cp /etc/postfix/main.cf /etc/postfix/main.cf.origin

**Editer le fichier de configuration**
Changez la ligne  `inet_interfaces = all` en
 

     inet_interfaces = loopback-only

Une autre directive à modifier est `mydestination`, utilisée pour spécifier la liste des domaines livrés via le transport . la ligne devient

    mydestination = $myhostname,
puis redémarrer **postfix**

    sudo systemctl restart postfix

  
## 3 tests

Dans cette étape, nous allons vérifier si Postfix peut envoyer des courriels à un compte de messagerie externe à l’aide de la commande ` mail `, qui fait partie du paquetage ` mailutils ` que nous avons installé à l’étape 1.


    root@philippes:/home/pi# echo "This is the body of the email" | mail -s "This is the subject line" philaure@wanadoo.fr

    root@philippes:/var/log# echo "This is the body" | mail -s "Subject" -aFrom:Harry\<harry@gmail.com\> philaure@wanadoo.fr

### Changelog

 **11/11/2020 :** Ajout du README . 
 
 
> **Notes :**


> - Licence : **licence publique générale** ![enter image description here](https://img.shields.io/badge/licence-GPL-green.svg)
> - Auteur **Philippe SIMIER - Lycée Touchard Le Mans**
>  ![enter image description here](https://img.shields.io/badge/built-passing-green.svg)
<!-- TOOLBOX 

Génération des badges : https://shields.io/
Génération de ce fichier : https://stackedit.io/editor#

