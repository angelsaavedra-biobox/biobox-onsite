name=$1
whoami > q.txt

echo "----------------------"

chmod 666 $name.wav
# reparamos el archivo wav
qwavheaderdump -F $name.wav

# convertimos a OGG
oggenc $name.wav -o $name.ogg

chmod 666 $name.wav $name.ogg
