#!/bin/bash
echo ""
echo ""
echo "ACTUALIZANDO AFRICA"
echo ""
echo ""
echo ""
read -p "Deseas actualizar el sistema en cloud?" actualizar



if [ "$actualizar" == "" ];
then

host="179.43.123.61"
puerto="5164"
usuario="alejandro"
desde="www/africa/"
droplet="DROPLET CUENTA africa =====> cuenta de pauzanotti@hotmail.com maria2012"
hasta="$host:/var/www/africa/"
echo "PASO 2 - SUBO =>ejecutando"
echo "DESDE: $desde"
echo "HASTA: $hasta"
echo "EN DON WEB $droplet"
rsync -e "ssh -p $puerto" -av $desde $hasta --progress --exclude="/assets"
echo "-------------------------------HECHO SUBIDO-------------------------------------------"
echo "-----------------------------------------------------------------------------------------"
fi