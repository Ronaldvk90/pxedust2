# Welcome to PxeDust 2.0!

I deliver a OOBE dnsmasq server, tftp and nginx and PHP.

For winpe you can use wimboot. The iPXE project has detailed information how to build and install winpe.
http://www.ipxe.org/wimboot

# The basics.
Adjust the the environment file to suit your needs.

DNSMASQ_INTERFACE must correspond with the interface Dnsmasq should listen to! It won't function as a DNS server, rather a dhcp proxy for the boot file.
IPV4 is the ip address of your server/interface. This sets everything accordingly for all containers.
SUBNET is the subnetmask used by your network/interface.

# Populate the server.
Well... Thats about it to be honest.

*Just do a docker compose up to start the server.*

The server comes with a network bootable option of Debian latest stable and Fedora40 both x86_64 on the house! :)

I'd suggest again checking out the iPXE project for more information how to use .ipxe scripts and how to boot different operating systems.
