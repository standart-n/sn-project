// Generated by CoffeeScript 1.5.0

exports.init = function() {
  var colors, setColorTheme;
  colors = require('colors');
  setColorTheme = function(colors) {
    return colors.setTheme({
      silly: 'rainbow',
      input: 'grey',
      verbose: 'cyan',
      prompt: 'grey',
      info: 'green',
      data: 'grey',
      help: 'cyan',
      warn: 'yellow',
      debug: 'blue',
      error: 'red'
    });
  };
  setColorTheme(colors);
  return colors;
};