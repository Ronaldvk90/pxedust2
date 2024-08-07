#!/bin/sh

cat > /var/tftpboot/autoexec.ipxe <<EOF
#!ipxe
dhcp
chain http://$IPV4/menu.php
EOF

in.tftpd -L --secure /var/tftpboot