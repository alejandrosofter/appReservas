#!/bin/bash
echo ""
echo ""
echo "Corriendo METEOR de YAVU"
echo ""
echo ""
echo ""
read -p "Como es la instancia de docker? (default: appreservas_host_1)" instanciaDocker



if [ "$instanciaDocker" == "" ];
then
instanciaDocker="appreservas_host_1"
fi


read -p "Queres Correr la CONSOLA? (default: si)" console
if [ "$console" == "" ];
then
docker exec -it $instanciaDocker bash 
fi
