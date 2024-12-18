//
// 3rd-Party Plugins JavaScript Includes
//

module.exports = [

//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
////  Mandatory Plugins Includes(do not remove or change order!)  ////
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////

    // Jquery - jQuery is a popular and feature-rich JavaScript library. Learn more: https://jquery.com/
    'node_modules/jquery/dist/jquery.js',

    // Popper.js - Tooltip & Popover Positioning Engine used by Bootstrap. Learn more: https://popper.js.org
    'node_modules/@popperjs/core/dist/umd/popper.js',

    // Bootstrap - The most popular framework uses as the foundation. Learn more: http://getbootstrap.com
    'node_modules/bootstrap/dist/js/bootstrap.min.js',

    // Moment - Parse, validate, manipulate, and display dates and times in JavaScript. Learn more: https://momentjs.com/
    'node_modules/moment/min/moment-with-locales.min.js',

    // Wnumb - Number & Money formatting. Learn more: https://refreshless.com/wnumb/
    'node_modules/wnumb/wNumb.js',

    // ES6-Shim - ECMAScript 6 compatibility shims for legacy JS engines.  Learn more: https://github.com/paulmillr/es6-shim
    'node_modules/es6-shim/es6-shim.js',

//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
///  Optional Plugins Includes(you can remove or add)  ///////////////
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////

    // Select2 - Select2 is a jQuery based replacement for select boxes: https://select2.org/
    'node_modules/select2/dist/js/select2.full.js',
    'resources/js/components/select2.init.js',

    // Inputmask - is a javascript library which creates an input mask: https://github.com/RobinHerbots/Inputmask
    'node_modules/inputmask/dist/inputmask.js',
    'node_modules/inputmask/dist/bindings/inputmask.binding.js',

    // The autosize - function accepts a single textarea element, or an array or array-like object (such as a NodeList or jQuery collection) of textarea elements: https://www.jacklmoore.com/autosize/
    'node_modules/autosize/dist/autosize.min.js',

    // DropzoneJS -  is an open source library that provides drag'n'drop file uploads with image previews: https://www.dropzonejs.com/
    'node_modules/dropzone/dist/min/dropzone.min.js',
    'resources/js/components/dropzone.init.js',

    // Tagify - Transforms an input field or a textarea into a Tags components, in an easy, customizable way, with great performance and small code footprint, exploded with features: https://github.com/yairEO/tagify
    'node_modules/@yaireo/tagify/dist/tagify.polyfills.min.js',
    'node_modules/@yaireo/tagify/dist/tagify.min.js',

    // Axios - Promise based HTTP client for the browser and node.js
    'node_modules/axios/dist/axios.js',

    // Jquery Repeater
    'node_modules/jquery.repeater/jquery.repeater.min.js',

    // Jquery UI
    'node_modules/jquery-ui/dist/jquery-ui.js',

    // Date Range Picker - A JavaScript components for choosing date ranges, dates and times: https://www.daterangepicker.com/
    'node_modules/bootstrap-daterangepicker/daterangepicker.js',

    // Tempus Dominus is the successor to the very popular Eonasdan/bootstrap-datetimepicker. The plugin provide a robust date and time picker designed to integrate into your Bootstrap project.
    'node_modules/@eonasdan/tempus-dominus/dist/js/tempus-dominus.min.js',
    'node_modules/@eonasdan/tempus-dominus/dist/plugins/customDateFormat.js',

];
