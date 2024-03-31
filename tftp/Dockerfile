FROM alpine:3.19 as BuildBiosBetter
RUN apk add --no-cache git gcc binutils make perl xz-dev mtools libc-dev
RUN git clone https://github.com/ipxe/ipxe.git
WORKDIR /ipxe/src
RUN sed -i '/CONSOLE_CMD/c #define CONSOLE_CMD' config/general.h
RUN sed -i '/DOWNLOAD_PROTO_HTTPS/c #define DOWNLOAD_PROTO_HTTPS' config/general.h
RUN sed -i '/IMAGE_TRUST_CMD/c #define IMAGE_TRUST_CMD' config/general.h
RUN sed -i '/CONSOLE_FRAMEBUFFER/c #define CONSOLE_FRAMEBUFFER' config/console.h
COPY ./embed.ipxe .
RUN make bin/undionly.kpxe EMBED=embed.ipxe

FROM alpine:3.19 as BuildEfiBetter
RUN apk add --no-cache git gcc binutils make perl mtools libc-dev
RUN git clone https://github.com/ipxe/ipxe.git
WORKDIR /ipxe/src
RUN sed -i '/CONSOLE_CMD/c #define CONSOLE_CMD' config/general.h
RUN sed -i '/DOWNLOAD_PROTO_HTTPS/c #define DOWNLOAD_PROTO_HTTPS' config/general.h
RUN sed -i '/IMAGE_TRUST_CMD/c #define IMAGE_TRUST_CMD' config/general.h
RUN sed -i '/CONSOLE_FRAMEBUFFER/c #define CONSOLE_FRAMEBUFFER' config/console.h
COPY ./embed.ipxe .
RUN make bin-x86_64-efi/snponly.efi EMBED=embed.ipxe

FROM alpine:3.19
RUN apk add --no-cache tftp-hpa
COPY --from=BuildBiosBetter /ipxe/src/bin/undionly.kpxe /var/tftpboot/undionly.0
COPY --from=BuildEfiBetter  /ipxe/src/bin-x86_64-efi/snponly.efi /var/tftpboot/snponly.efi
EXPOSE 69/udp
ENTRYPOINT ["in.tftpd"]
CMD ["-L", "--secure", "/var/tftpboot"]
