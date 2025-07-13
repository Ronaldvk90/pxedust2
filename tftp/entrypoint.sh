#!/bin/sh

cat <<EOF > /var/tftpboot/autoexec.ipxe
#!ipxe
dhcp
chain http://$IPV4/menu.php
EOF

in.tftpd -L --secure /var/tftpboot