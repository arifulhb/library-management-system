// webpack.config.js
var webpack = require('webpack');

var config = {

    entry:{
        app: "./entry.js",
        vendor: [ "jquery", 'lodash', 'moment','bootstrap',
            './node_modules/admin-lte/dist/js/app.js',
            './node_modules/bootstrap-3-typeahead/bootstrap3-typeahead.js',
            './node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'
        ]
    },
    //devtool: "source-map",
    output: {
        path: "./public/vendor",
        filename: "bundle.js"
    },
    plugins:[
        new webpack.optimize.CommonsChunkPlugin({
            name: "vendor",
            filename:"vendor.bundle.js",
            minChunks: Infinity
        }),
        new webpack.ProvidePlugin({
            $               : 'jquery',
            jQuery          : 'jquery',
            'window.jQuery' : 'jquery',
            'bootstrap'     : 'bootstrap',
            'adminlte'      : 'adminlte',
            'moment'        : 'moment',
            '_'             : 'lodash'
        })
    ],
    resolve: {
        alias: {
            'adminlte'              : './node_modules/admin-lte/dist/js/app.js',
            'inputmask'             : './node_modules/jquery.inputmask/dist/inputmask/jquery.inputmask.js'
        }
    },
    module: {
        loaders: [
            {test: /\.css$/, loader: "style-loader!css-loader"},
            {test: /\.(woff|woff2)(\?v=\d+\.\d+\.\d+)?$/, loader: 'url?limit=10000&mimetype=application/font-woff'},
            {test: /\.ttf(\?v=\d+\.\d+\.\d+)?$/, loader: 'url?limit=10000&mimetype=application/octet-stream'},
            {test: /\.eot(\?v=\d+\.\d+\.\d+)?$/, loader: 'file'},
            {test: /\.svg(\?v=\d+\.\d+\.\d+)?$/, loader: 'url?limit=10000&mimetype=image/svg+xml'},
            //{ test: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/, loader: "url-loader?limit=10000&minetype=application/font-woff" },
            { test: /\.(ttf|eot|svg)(\?v=[0-9]\.[0-9]\.[0-9])?$/, loader: "file-loader" }
        ]
    },
    node: {
        fs: "empty"
    }
};

module.exports = config;
