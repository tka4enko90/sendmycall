var webpack = require('webpack');
const config = require('./config');

module.exports = {
    mode: 'development',
    entry: config.entry,
    output: {
        filename: '[name].js',
        chunkFilename: 'scripts/[name].[hash].js',
    },
    module: {
        rules: [
            {
                test: /\.(js)$/,
                exclude: /(node_modules)/,
                loader: 'babel-loader',
                query: {
                    presets: ['@babel/env']
                }
            }
        ]
    },
    plugins: [
    ],
    externals: {
        jquery: 'jQuery',
    },
    devtool: 'source-map'
};