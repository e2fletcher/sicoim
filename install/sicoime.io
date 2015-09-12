server {
    # Force non-www version of the site
    listen       80;
    server_name  www.sicoime.io;
    return       301 http://sicoime.io$request_uri;
}

server {
    listen 80;
    server_name  sicoime.io;
    root /srv/http/sicoime/public;

    access_log /var/log/nginx/sicoime.io.access.log;
    error_log /var/log/nginx/sicoime.io.error.log;

    autoindex on;
    index index.php;

    # Cache static files for a long time
    include global/static-asset-caching.conf;

    # Pull in some good PHP defaults
    include global/php-restrictions.conf;

    location / {

        # First try and load files from the public folder, if they don't exist
        # then send the request through to laravel
        try_files $uri $uri/ /index.php?$query_string;
        #try_files $uri $uri/ /index.php;

        # Forward requests on to PHP-FPM
        location = /index.php {
            include /etc/nginx/fastcgi_params;
            fastcgi_index index.php;
            fastcgi_intercept_errors on;
            fastcgi_split_path_info ^(.+\.php)(/.+)$;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_pass unix:/var/run/php-fpm/php-fpm.sock;
        }
    }

    # If someone explicitly tries to load a PHP file return a 404 error,
    # always use url rewrites and never have the .php extension in the url
    location ~ \.php$ {
        return 404;
    }
}
