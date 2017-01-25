module.exports = {
	"use": [
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
	"input": "src/css/speedbump.css",
	"output": "speedbump/resources/css/speedbump.css",
	"watch": true
}
