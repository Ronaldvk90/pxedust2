### Building compile container
FROM --platform=linux/amd64 alpine:3.22 AS buildcontainer

### Install dependencies
RUN apk add --no-cache git gcc binutils make perl xz-dev mtools libc-dev
RUN git clone https://github.com/ipxe/ipxe.git

### Preparing iPXE build environment 
WORKDIR /ipxe/src
RUN sed -i '/CONSOLE_CMD/c #define CONSOLE_CMD' config/general.h
RUN sed -i '/CONSOLE_FRAMEBUFFER/c #define CONSOLE_FRAMEBUFFER' config/console.h

### Build EFI
FROM --platform=linux/amd64 buildcontainer AS efibuildcontainer 
RUN make bin-x86_64-efi/ipxe.efi

### Build BIOS
FROM --platform=linux/amd64 buildcontainer AS biosbuildcontainer
RUN apk add --no-cache wget
RUN make bin/ipxe.lkrn
WORKDIR /
RUN wget https://www.kernel.org/pub/linux/utils/boot/syslinux/syslinux-6.03.tar.gz
RUN tar xvfz syslinux-6.03.tar.gz

### Runtime container
FROM alpine:3.22
RUN apk add --no-cache tftp-hpa

### Copy all PXE files to destination
COPY --from=efibuildcontainer /ipxe/src/bin-x86_64-efi/ipxe.efi /var/tftpboot/ipxe.efi
COPY --from=biosbuildcontainer /ipxe/src/bin/ipxe.lkrn /var/tftpboot/ipxe.lkrn
COPY --from=biosbuildcontainer /syslinux-6.03/bios/com32/libutil/libutil.c32 /var/tftpboot/
COPY --from=biosbuildcontainer /syslinux-6.03/bios/core/pxelinux.0 /var/tftpboot/
COPY --from=biosbuildcontainer /syslinux-6.03/bios/com32/elflink/ldlinux/ldlinux.c32 /var/tftpboot/
COPY --from=biosbuildcontainer /syslinux-6.03/bios/com32/menu/menu.c32 /var/tftpboot/
#RUN mkdir /var/tftpboot/pxelinux.cfg
#COPY default /var/tftpboot/pxelinux.cfg/default

### entrypoint script preperation
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

### tftp port opened
EXPOSE 69/udp

### Entrypoint:
ENTRYPOINT [ "/entrypoint.sh" ]