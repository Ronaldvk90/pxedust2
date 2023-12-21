FROM alpine:3.19

RUN apk --no-cache add dnsmasq
ADD dnsmasq.conf /etc/dnsmasq.conf
ENTRYPOINT [ "/bin/sh", "-c", "/usr/sbin/dnsmasq --interface=${DNSMASQ_INTERFACE} --dhcp-range=${IPV4},proxy,${SUBNET} --no-daemon \"${@}\"", "--" ]