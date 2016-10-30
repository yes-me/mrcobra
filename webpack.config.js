
var path = require('path');
var webpack = require("webpack");

module.exports = {
    entry: {
        './app': "./src/js/app.js",
        './app.min': './src/js/app.js'
    },
    output: {
        filename: '[name].js'
    },
    devtool: 'source-map',
    plugins: [
        new webpack.optimize.UglifyJsPlugin({
            include: /\.min\.js$/,
            minimize: true
        })
    ],
    module: {
        loaders: [
            {
                test: /\.jsx?$/,
                exclude: /(node_modules|bower_components)/,
                loader: 'babel', // 'babel-loader' is also a legal name to reference
                query: {
                    presets: ['es2015']
                }
            }
        ]
    }
}