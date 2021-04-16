ARG BASE_IMAGE
FROM $BASE_IMAGE

# install cron and configure scheduler to be executed each minute
RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y -o Dpkg::Options::="--force-confold" --no-install-recommends --no-install-suggests cron
COPY cron-typo3 /etc/cron.d/cron-typo3
RUN chmod 0644 /etc/cron.d/cron-typo3
RUN crontab /etc/cron.d/cron-typo3
RUN touch /etc/crontab /etc/cron.*/* /var/log/cron.log

