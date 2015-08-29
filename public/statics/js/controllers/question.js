$(function () {
        hljs.initHighlightingOnLoad();
        var markedModel = $('.marked');
        var renderer = new marked.Renderer();

        renderer.code = function (code, lang) {
                var language = lang && (' language-' + lang) || '';
                return '<pre class="prettyprint' + language + '">'
                        + '<code>' + code.replace(/</g, '&lt;').replace(/>/g, '&gt;') + '</code>'
                        + '</pre>';
        };

        marked.setOptions({
                renderer: renderer,
                gfm: true,
                tables: true,
                breaks: true,
                pedantic: false,
                sanitize: false,
                smartLists: true
        });

//        marked(markdownString, function (err, content) {
//                if (err)
//                        throw err;
//                console.log(content);
//        });

        marked.setOptions({
                highlight: function (code) {
                        hljs.highlightAuto(code).value;
                }
        });
        $.each(markedModel,function(i,obj){
                var markDown=marked($(this).text());
                $(this).html(markDown);
        });
});
