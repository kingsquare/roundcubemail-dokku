FROM roundcube/roundcubemail:1.3.7-apache
LABEL maintainer="Kingsquare <docker@kingsquare.nl>"

COPY src /dokku

ENTRYPOINT ["/dokku/entrypoint.sh"]
CMD ["apache2-foreground"]
