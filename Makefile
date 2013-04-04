TPL=smarty
DATE=$(shell date +%I:%M%p)
CHECK=\033[32m✔\033[39m
HR=\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#


#
# BUILD DOCS
#

def: all

all: client server finish

client: css layout indexhtml js lmd

server: node-app node-controls node-routes

folders: folders-public folders-tpl

indexhtml:
	@rm -f ./index.html
	@jade --pretty ./layout/${TPL}/index.jade -O ./

lmd:
	@echo "\n lmd... \n"
	@lmd build dev

layout:
	@rm -R ./tpl/templates/
	@mkdir -p ./tpl/templates/
	@touch ./tpl/templates/.gitignore
	@jade --pretty ./layout/${TPL}/ -O ./tpl/templates

js:
	@coffee -cbjvp ./client/sn/sn*.coffee > ./public/js/client/sn.js
	@uglifyjs ./public/js/client/sn.js -nc > ./public/js/client/sn.min.js
	@coffee -cbjvp ./script/main*.coffee > ./public/js/client/main.js
	@uglifyjs ./public/js/client/main.js -nc > ./public/js/client/main.min.js


css:
	@recess --compile ./less/index.less > ./public/css/style.css
	@recess --compress ./less/index.less > ./public/css/style.min.css
	@cat ./public/css/*.min.css > ./public/assets/style.css



node-app:
	@echo "\n app... \n"
	@coffee -cbjvp ./script/index*.coffee > ./index.js

node-controls:
	@echo "\n controls... \n"
	@rm -fR ./public/js/controls
	@mkdir -p ./public/js/controls
	@coffee -o ./public/js/controls -cb ./node_controls/

node-routes:
	@echo "\n routes... \n"
	@rm -fR ./public/js/routes
	@mkdir -p ./public/js/routes
	@coffee -o ./public/js/routes -cb ./node_routes/



start:
	@echo "forever start -o ./log/out.log -e ./log/err.log index.js"
	@forever start -o ./log/out.log -e ./log/err.log index.js

stop:
	@echo "stop index.js"
	@forever stop index.js


folders-tpl:
	@mkdir -p ./tpl/cache
	@mkdir -p ./tpl/configs
	@mkdir -p ./tpl/templates
	@mkdir -p ./tpl/templates_c

folders-public:
	@mkdir -p ./public/assets
	@mkdir -p ./public/img
	@mkdir -p ./public/css
	@mkdir -p ./public/materials
	@mkdir -p ./public/files
	@mkdir -p ./public/js/client
	@mkdir -p ./public/js/controls
	@mkdir -p ./public/js/routes
	@mkdir -p ./public/js/tpl
	
finish:
	@echo "\nSuccessfully built at ${DATE}."


bootstrap:
	@cat ./client/bootstrap/bootstrap-*.js  > ./public/js/client/bootstrap.js
	@uglifyjs ./public/js/client/bootstrap.js -nc > ./public/js/client/bootstrap.min.tmp.js

	@echo "/**\n* bootstrap.js v2.2.2 by @fat & @mdo\n* Copyright 2012 Twitter, Inc.\n* http://www.apache.org/licenses/LICENSE-2.0.txt\n*/" > ./copyright
	@cat ./copyright ./public/js/client/bootstrap.min.tmp.js > ./public/js/client/bootstrap.min.js
	@rm ./copyright ./public/js/client/bootstrap.min.tmp.js



#
# RUN JSHINT & QUNIT TESTS IN PHANTOMJS
#

#.PHONY: docs watch gh-pages
