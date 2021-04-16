ARG BASE_IMAGE
FROM $BASE_IMAGE

# install cron and configure scheduler to be executed each minute
RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y -o Dpkg::Options::="--force-confold" --no-install-recommends --no-install-suggests cron
RUN echo '*/1 * * * * root /usr/bin/php /var/www/html/vendor/bin/typo3 scheduler:run' | tee -a /etc/cron.d/typo3
RUN chmod 0600 /etc/cron.d/typo3 && service cron start
