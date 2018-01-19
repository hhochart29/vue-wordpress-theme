'use strict'
const utils = require('./utils')
const webpack = require('webpack')
const config = require('../config')
const merge = require('webpack-merge')
const baseWebpackConfig = require('./webpack.base.conf')
const FriendlyErrorsPlugin = require('friendly-errors-webpack-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const portfinder = require('portfinder')

const devWebpackConfig = merge(baseWebpackConfig, {
  module: {
    rules: utils.styleLoaders({sourceMap: config.dev.cssSourceMap, usePostCSS: true})
  },
  // cheap-module-eval-source-map is faster for development
  devtool: config.dev.devtool,
  output: {
    path: config.dev.assetsRoot,
    filename: utils.assetsPath('js/[name].js'),
    chunkFilename: utils.assetsPath('js/[name].js')
  },
  plugins: [
    new webpack.DefinePlugin({
      'process.env': require('../config/dev.env')
    }),
    new webpack.NoEmitOnErrorsPlugin(),
    new BrowserSyncPlugin({
      host: process.env.HOST || config.dev.host,
      port: process.env.PORT || config.dev.port,
      proxy: config.dev.proxy
    })
  ]
})

module.exports = devWebpackConfig
