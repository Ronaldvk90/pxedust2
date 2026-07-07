### Building compile container
FROM --platform=linux/amd64 alpine:3.24 AS buildcontainer

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

### Runtime container
FROM alpine:3.24
RUN apk add --no-cache tftp-hpa

### Copy the PXE file to destination
COPY --from=efibuildcontainer /ipxe/src/bin-x86_64-efi/ipxe.efi /var/tftpboot/ipxe.efi

### entrypoint script preperation
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

### Entrypoint:
ENTRYPOINT [ "/entrypoint.sh" ]