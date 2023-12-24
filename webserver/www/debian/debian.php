<?php
header ( "Content-type: text/plain" );
echo "#!ipxe\n\n";

echo "kernel http://ftp.nluug.nl/pub/os/Linux/distr/debian/dists/stable/main/installer-amd64/current/images/netboot/debian-installer/amd64/linux initrd=initrd.gz\n";
echo "initrd http://ftp.nluug.nl/pub/os/Linux/distr/debian/dists/stable/main/installer-amd64/current/images/netboot/debian-installer/amd64/initrd.gz\n";
echo "boot";