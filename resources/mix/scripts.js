const glob = require('glob');

// Keenthemes' plugins
var componentJs = glob.sync(`resources/js/components/*.js`) || [];
var coreLayoutJs = glob.sync(`resources/js/layout/*.js`) || [];

module.exports = [
    ...componentJs,
    ...coreLayoutJs,
];
