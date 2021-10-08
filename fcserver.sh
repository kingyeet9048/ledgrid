#!/bin/bash

cd /usr/local/bin
sudo fcserver fcserver.json > /var/log/fcserver.log 2>&1
