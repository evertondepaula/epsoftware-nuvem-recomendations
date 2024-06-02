(function () {
    'use strict';

    var gulp = require('gulp'),
        aglio = require('aglio'),
        browserSync = require('browser-sync'),
        concat = require('gulp-concat');


    // concat all api-blueprint files into single all.apib file
    gulp.task('concat-apib', function () {
        return gulp.src(['docs/apiblueprint/**/*.apib', '!docs/apiblueprint/all.apib'])
            .pipe(concat('all.apib'))
            .pipe(gulp.dest('docs/apiblueprint/'));
    });

    // generate html off previously concat-ed all.apib
    gulp.task('make-html', ['concat-apib'], function () {
        var opts = {
            themeVariables: 'streak',
            themeTemplate: 'triple'
        };

        aglio.renderFile('docs/apiblueprint/all.apib', 'resources/views/docs/index.html', opts, function () { });
    });

    gulp.task('watch', ['make-html'], function () {
        gulp.watch('docs/apiblueprint/*.apib', ['make-html']).on('change', browserSync.reload);

        gulp.watch('resources/views/docs/index.html').on('change', browserSync.reload);
    });

    gulp.task('default', ['watch']);

})();
