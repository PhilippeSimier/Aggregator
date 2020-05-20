#!/bin/sh
# script exécuter par le démon Gammu lors de la reception d'un SMS
# variables d'environnement
# SMS_1_CLASS
# SMS_1_NUMBER= numero tel
# SMS_1_TEXT= message
# SMS_MESSAGES = le nbre de SMS reçus
# en argument le fichier contenant le SMS

#echo "---------------------------------------" >> /opt/Ruche/etc/sms.log
#echo "$(date) : $SMS_MESSAGES  SMS(s) recu(s)" >> /opt/Ruche/etc/sms.log
#echo "from : $SMS_1_NUMBER" >> /opt/Ruche/etc/sms.log
requete=$SMS_1_TEXT$SMS_2_TEXT
protocol=`echo $requete | cut -d: -f1`

echo "requete : $requete" >> /opt/Ruche/etc/sms.log

if [ $protocol = "https" -o $protocol = "http" ]; then
    retour=`echo "$requete" | /opt/Ruche/etc/envoyerURL`
#    echo $retour >> /opt/Ruche/etc/sms.log
    sleep 15
fi
exit 0

