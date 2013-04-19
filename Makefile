TPL = smarty
DATE = $(shell date +%I:%M%p)
CHECK = \033[32m✔\033[39m
HR = \#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#\#


#
# BUILD DOCS
#

def: all

all: client finish

client: css js lmd

server: node-app node-controls node-routes

lmd:
	@echo "\n lmd... \n"
	@lmd build dev

templates:
	@jade --pretty ./layout/${TPL}/* -O ./tpl/templates/


js:
	@coffee -cbjvp ./client/sn/* > ./public/js/client/sn.js
	@uglifyjs ./public/js/client/sn.js -nc > ./public/js/client/sn.min.js --config ./.jshintrc

	@coffee -cbjvp ./script/main*.coffee > ./public/js/client/main.js
	@uglifyjs ./public/js/client/main.js -nc > ./public/js/client/main.min.js --config ./.jshintrc

	@coffee -cbjvp ./script/ie6*.coffee > ./public/js/client/ie6.js
	@uglifyjs ./public/js/client/ie6.js -nc > ./public/js/client/ie6.min.js --config ./.jshintrc


css:
	@recess --compile ./less/index.less > ./public/css/style.css
	@recess --compress ./less/index.less > ./public/css/style.min.css

	@recess --compile ./less/ie6.less > ./public/css/ie6.css
	@recess --compress ./less/ie6.less > ./public/css/ie6.min.css

	@recess --compile ./less/ie7.less > ./public/css/ie7.css
	@recess --compress ./less/ie7.less > ./public/css/ie7.min.css


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

.PHONY: clean
