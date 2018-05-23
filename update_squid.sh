#!/bin/bash
/usr/bin/php7.0  /root/mid_data/update_squid.php
mv /etc/squid/squid.conf.bak /etc/squid/squid.conf
service squid reload
