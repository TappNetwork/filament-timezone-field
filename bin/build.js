import * as esbuild from "esbuild";

esbuild.build({
  entryPoints: ["resources/js/filament-timezone-field.js"],
  outfile: "./dist/filament-timezone-field.js",
  bundle: true,
  mainFields: ["module", "main"],
  platform: "browser",
  treeShaking: true,
  target: ["es2020"],
  minify: true,
});
