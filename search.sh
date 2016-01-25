#!/bin/bash

search="$1"
pdir="$2"
pdir1="$3"

#echo "-rni "${search}" /var/www/html/${pdir} > /var/www/html/${pdir1}/${search}.txt"

grep -rni "${search}" /var/www/html/${pdir} > /var/www/html/${pdir1}/${search}.txt 

chmod -R 0777 /var/www/html/${pdir1}/${search}.txt

echo "Done"
