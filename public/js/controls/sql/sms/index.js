// Generated by CoffeeScript 1.5.0

exports.insertMessageIntoBase = function(data, cn) {
  var fields, sanitize, table;
  sanitize = global.controls.lib.validator.sanitize();
  table = cn.tables.messages.name;
  fields = cn.tables.messages.fields;
  return 'insert into ' + table + ' ' + '(' + fields.index + ',' + fields.sim + ',' + fields.phone + ',' + fields.date + ',' + fields.text + ') values ' + '(' + sanitize(data.index).toInt() + ',' + sanitize(data.sim).toInt() + ',"' + sanitize(data.phone).escape() + '",' + sanitize(data.date).escape() + ',"' + sanitize(data.text).escape() + '"")';
};
