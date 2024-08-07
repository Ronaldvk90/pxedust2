FROM alpine:3.20 as buildcontainer
RUN apk add --no-cache git gcc binutils make perl xz-dev mtools libc-dev
RUN git clone https://github.com/ipxe/ipxe.git
WORKDIR /ipxe/src
RUN sed -i '/CONSOLE_CMD/c #define CONSOLE_CMD' config/general.h
RUN sed -i '/CONSOLE_FRAMEBUFFER/c #define CONSOLE_FRAMEBUFFER' config/console.h

FROM buildcontainer as buildBiosBetter
RUN make bin/ipxe.lkrn

FROM buildcontainer as buildEfiBetter
RUN make bin-x86_64-efi/snponly.efi

FROM alpine:3.20
RUN apk add --no-cache tftp-hpa
RUN wget https://mirrors.edge.kernel.org/pub/linux/utils/boot/syslinux/syslinux-6.03.tar.gz -O /syslinux.tar.gz
RUN tar xvfz syslinux.tar.gz
RUN mkdir -p /var/tftpboot/pxelinux.cfg
RUN cp /syslinux*/bios/core/pxelinux.0 /var/tftpboot/pxelinux.0
RUN cp /syslinux*/bios/com32/elflink/ldlinux/ldlinux.c32 /var/tftpboot/ldlinux.c32
COPY ./default /var/tftpboot/pxelinux.cfg/default
RUN rm -rf /syslinux*
COPY --from=buildBiosBetter /ipxe/src/bin/ipxe.lkrn /var/tftpboot/ipxe.lkrn
COPY --from=buildEfiBetter  /ipxe/src/bin-x86_64-efi/snponly.efi /var/tftpboot/snponly.efi
COPY ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh


EXPOSE 69/udp
ENTRYPOINT ["/entrypoint.sh"]