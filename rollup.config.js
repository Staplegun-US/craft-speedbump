import { rollup } from 'rollup';
import nodeResolve from 'rollup-plugin-node-resolve';
import commonjs from 'rollup-plugin-commonjs';
import uglify from 'rollup-plugin-uglify';

let pkg = require('./package.json');
let external = Object.keys(pkg.dependencies);

export default {
	entry: 'dev/speedbump.js',
	format: 'iife',
	moduleName: 'speedbump',
	sourceMap: 'inline',
	plugins: [
			nodeResolve(
					{ jsnext: true, main: true, browser: true  }
			),
			commonjs({}),
			uglify()
		],
	dest: 'src/resources/speedbump.min.js'
};
