#!/bin/bash

printf "Generating CA keys\n"
openssl genrsa -out ./CA/CA.key 2048

printf "Generating CA pem\n"
openssl req -x509 -new -nodes -key ./CA/CA.key -sha256 -days 10000 -out ./CA/CA.pem -subj "/C=NL/O=CA"

printf "Generating CA keys\n"
openssl genrsa -out ./dev.local/dev.local.key 2048

printf "Generating Certificate Signing Request\n"
openssl req -new -key ./dev.local/dev.local.key -out ./dev.local/dev.local.csr  -subj "/C=NL/O=Developer"

printf "Generating Certificate\n"
openssl x509 -req -in ./dev.local/dev.local.csr -CA ./CA/CA.pem -CAkey ./CA/CA.key -CAcreateserial \
    -out ./dev.local/dev.local.crt -days 10000 -sha256 -extfile ./dev.local/dev.local.ext