<?php
header ( "Content-type: text/plain" );
echo "#!ipxe\n\n";

// Set source URI
echo "set mirror http://fedora.mirror.wearetriple.com/linux/releases/40/\n";
echo "set repo \${mirror}/Everything/x86_64/os\n\n";

// Start installer
echo "kernel \${repo}/images/pxeboot/vmlinuz initrd=initrd.img ip=dhcp inst.repo=\${repo}\n";
echo "initrd \${repo}/images/pxeboot/initrd.img\n";
echo "boot";