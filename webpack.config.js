const path = require('path')
const TerserPlugin = require('terser-webpack-plugin')
const fs = require('fs')

const dependenciesDir = path.resolve(__dirname, 'public/assets/dependencies')
const scriptsDir = path.resolve(__dirname, 'public/assets/scripts')
const outputDir = path.resolve(__dirname, 'public/assets/output')

const jsFiles = [
   ...fs
      .readdirSync(dependenciesDir)
      .filter((file) => file.endsWith('.js'))
      .map((file) => path.join(dependenciesDir, file)),
   ...fs
      .readdirSync(scriptsDir)
      .filter((file) => file.endsWith('.js'))
      .map((file) => path.join(scriptsDir, file)),
]

module.exports = {
   entry: jsFiles,
   output: {
      filename: 'all.min.js',
      path: outputDir,
   },
   mode: 'production',
   optimization: {
      minimize: true,
      minimizer: [new TerserPlugin()],
   },
}
