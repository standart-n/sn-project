// Generated by CoffeeScript 1.5.0

exports.index = function(req, res) {
  var cn, colors;
  cn = global.appsettings;
  colors = global.controls.lib.colors.init();
  return global.controls.client.connect(cn, function(client) {
    return global.controls.client.getAllMessages(client, cn, function(data) {
      return global.controls.db.opendb(function(db) {
        return data.filter(function(value, i) {
          return global.controls.client.insertMessageIntoBase(value, cn, db, function(res) {});
        });
      });
    });
  });
};
