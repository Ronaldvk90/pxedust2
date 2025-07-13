# Welcome to PxeDust 2.0!

I deliver a OOBE dnsmasq server, tftp and nginx and PHP.

For winpe you can use wimboot. The iPXE project has detailed information how to build and install winpe.
http://www.ipxe.org/wimboot

# The basics.
Copy the .env.orig file to .env.
Adjust the the env file to suit your needs.

DNSMASQ_INTERFACE must correspond with the interface Dnsmasq should listen to! It won't function as a DNS server, rather a dhcp proxy for the boot file.
IPV4 is the ip address of your server/interface. This sets everything accordingly for all containers.
SUBNET is the subnetmask used by your network/interface.

# Please note!

The bios version of PXEDust boots pxelinux.0 from the syslinux project.
https://wiki.syslinux.org/wiki/index.php?title=PXELINUX

This is due to the limits of the BIOS binary that iPXE offers. The uEFI version automaticaly downloads "autoexec.ipxe". The BIOS version doesn't. I had to work around that problem by chainloading "ipxe.lkrn" trough pxelinux.0, and append a INITRD wich is "autoexec.ipxe".

# Populate the server.
Well... Thats about it to be honest.

*Just do a docker compose up to start the server.*

The server comes with a network bootable option of Debian latest stable and Fedora42 both x86_64 on the house! :)

I'd suggest again checking out the iPXE project for more information how to use .ipxe scripts and how to boot different operating systems.
