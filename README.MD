# Welcome to PxeDust 2.0!

I deliver a OOBE dnsmasq server, tftp and nginx and PHP.

For winpe you can use wimboot. The iPXE project has detailed information how to build and install winpe.
http://www.ipxe.org/wimboot

# The basics
Copy the .env.example file to .env.
Adjust the the .env file to suit your needs.

DNSMASQ_INTERFACE must correspond with the interface Dnsmasq should listen to! It won't function as a DNS server, rather a dhcp proxy for the boot file.
IPV4 is the ip address of your server/interface.
SUBNET is the subnetmask used by your network/interface.

In the menu.ipxe file from the webserver container's www folder, substitude the ip address for the IPV4 your server/interface is using.
#*note! If you are using a php menu script, also ajust menu.ipxe to "SubstituteWithDesiredName.php"*

Next is the embed.ipxe file in the tftp container folder. do exactly the same as what you did with the webserver IP.

# Populate the server.
Well... Thats about it to be honest.

*Just do a docker compose up to start the server.*

*If your ip should change, just rebuild the tftp container. It's a multistaged container that builds iPXE with the embedded boot script.*

The server comes with a network bootable option of Debian latest stable and Fedora39 both x86_64 on the house! :)

I'd suggest again checking out the iPXE project for more information how to use .ipxe scripts and how to boot different operating systems.
