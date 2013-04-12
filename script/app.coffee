
# express = require 'express'
# http = require 'http'
# path = require 'path'
# jade = require 'jade'
program = require 'commander'
global.controls = require './public/js/controls'
global.dbsettings = require './conf/database.json'
global.appsettings = require './settings/sms.json'
routes = require './public/js/routes'

global.program = program
					.version('0.1.0')
					.option('-f, --firebird','Add data into database')
					.option('-d, --debug','Show response in log')
					.option('-r, --remove','Remove sms after read')
					.parse(process.argv)

routes.index()