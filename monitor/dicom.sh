#!/bin/bash
localAET=`cat aetitle.local`
localIP='127.0.0.1'
remotoAET='BIOBOX_CENTRAL'
remotoIP='10.8.0.1'
status=`cat status.txt`
# eco local
bb_local=`echoscu -v -aet $localAET -aec $localAET $localIP 11112 2>/tmp/salida; grep Status /tmp/salida | cut -d ' ' -f 6 | sed 's/[),(]//g'`
# eco remoto
bb_remoto=`echoscu -v -aet $remotoAET -aec $remotoAET $remotoIP 11112 2>/tmp/salida; grep Status /tmp/salida | cut -d ' ' -f 6 | sed 's/[),(]//g'`

# http://dc.biobox.com.ar/monitor/gmail.php?f=Huayra&mensaje=lalal
if [ "$bb_local" != "Success" ] ; then
	wget -O /dev/null "http://10.8.0.1/monitor/gmail.php?f=$localAET&mensaje=Local:$bb_local"
	echo 'fail' > status.txt
	service dcm4chee stop; service dcm4chee start
elif [ "$bb_remoto" != "Success" ] ; then
	wget -O /dev/null "http://10.8.0.1/monitor/gmail.php?f=$localAET&mensaje=Central:$bb_remoto"
else
	echo "Local: $bb_local - Remoto: $bb_remoto"
	echo 'ok' > status.txt
fi