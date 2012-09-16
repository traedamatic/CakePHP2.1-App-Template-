<div class="view">
	<h1>Nginx Conf</h1>
	<p>A very small nginx conf</p>
	<pre>
		server {
        listen   80; ## listen for ipv4; this line is default and implied
        #listen   [::]:80 default_server ipv6only=on; ## listen for ipv6

        access_log  /var/log/nginx/exjs_access.log;
        error_log  /var/log/nginx/exjs_error.log info;


        root /var/www/github_projects/cakephp2-apptemplate/app/webroot;
        index index.php;

        # Make site accessible from http://localhost/
        server_name apptemplate.nbt;


        if (!-e $request_filename) {
                rewrite ^/(.+)$ /index.php?url=$1 last;
                break;
        }



        # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
        #
        location ~ \.php$ {
                fastcgi_split_path_info ^(.+\.php)(/.+)$;
                # NOTE: You should have "cgi.fix_pathinfo = 0;" in php.ini

                fastcgi_pass 127.0.0.1:9000;
                fastcgi_param  SCRIPT_FILENAME $document_root$fastcgi_script_name;
                fastcgi_index index.php;
                include fastcgi_params;
        }

}
	</pre>
</div>