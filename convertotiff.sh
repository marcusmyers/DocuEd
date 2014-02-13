#!/bin/sh
gs -dNOPAUSE -sDEVICE=tiffg4 -r600x600 -dBATCH -sPAPERSIZE=letter -sOutputFile=$2 $1

