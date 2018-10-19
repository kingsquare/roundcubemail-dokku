FROM roundcube/roundcubemail:1.3.7-apache
LABEL maintainer="Kingsquare <docker@kingsquare.nl>" webmail=1 roundcubemail=1 dokku=1

COPY src /dokku

ENTRYPOINT ["/dokku/entrypoint.sh"]
CMD ["apache2-foreground"]
