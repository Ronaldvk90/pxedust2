<?php
header ( "Content-type: text/plain" );
echo "#!ipxe\n\n";
echo "console --picture http://boot.ipxe.org/ipxe.png\n";

// Change the address according to your needs.
$url = "http://".$_ENV["IPV4"];

//================ Main Menu =================
echo "menu PXEdust2 Bootserver\n";
echo "\n";
echo "item debian                   Debian stable x86_64\n";
echo "item fedora                   Fedora Everything 42 x86_64\n";
echo "\n";
echo "item shell            Drop in the IPXE shell\n";
echo "choose target && goto \${target}\n\n";
//============ Main Menu Options =============

echo ":debian\n";
echo "chain $url/debian/debian.php\n";
echo "boot\n\n";

echo ":fedora\n";
echo "chain $url/fedora/42.php\n";
echo "boot\n\n";

echo ":shell\n";
echo "echo Type 'exit' to get the back to the menu\n";
echo "shell\n";
echo "set menu-timeout 0\n";
echo "set submenu-timeout 1\n";
echo "goto start";
//============== Main Menu End ===============