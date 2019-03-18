module.exports = {
  "plugins": [
    "postcss-import",
    "postcss-custom-properties",
    "postcss-custom-media",
    "postcss-easy-import",
    "postcss-nested",
    "postcss-clearfix",
    "autoprefixer"
  ],
  "custom-properties": {
    "preserve": true
  },
  "autoprefixer": {
    "browsers": "last 4 versions"
  },
  "local-plugins": true,
  "input": "dev/speedbump.css",
  "output": "src/resources/speedbump.css",
  "watch": true
}
