clean:
	rm -rf vendor composer.lock db/apptemplate.sqlite src/*/*dataTables*

migration:
	cd src ; ../vendor/bin/phinx migrate -c ../phinx-adapter.php ; cd ..

autoload:
	composer update

demodata:
	cd src ; ../vendor/bin/phinx seed:run -c ../phinx-adapter.php ; cd ..

newmigration:
	read -p "Enter CamelCase migration name : " migname ; ./vendor/bin/phinx create $$migname -c ./phinx-adapter.php

newseed:
	read -p "Enter CamelCase seed name : " migname ; ./vendor/bin/phinx seed:create $$migname -c ./phinx-adapter.php

dbreset:
	sudo rm -f db/apptemplate.sqlite
	echo > db/apptemplate.sqlite
	chmod 666 db/apptemplate.sqlite
	chmod ugo+rwX db

demo: dbreset migration demodata

postinst:
	DEBCONF_DEBUG=developer /usr/share/debconf/frontend /var/lib/dpkg/info/apptemplate.postinst configure $(nextversion)

redeb:
	 sudo apt -y purge apptemplate; rm ../apptemplate_*_all.deb ; debuild -us -uc ; sudo gdebi  -n ../apptemplate_*_all.deb ; sudo apache2ctl restart

deb:
	debuild -i -us -uc -b


dimage:
	docker build -t vitexsoftware/apptemplate .

drun: dimage
	docker run  -dit --name AppTemplate -p 8080:80 vitexsoftware/apptemplate
	firefox http://localhost:8080/apptemplate?login=demo\&password=demo

vagrant:
	vagrant destroy -f
	vagrant up
	firefox http://localhost:8080/apptemplate?login=demo\&password=demo

