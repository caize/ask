$(function () {
        $("#search").keyup(function (event) {
                if (event.keyCode == 13) {
                        var keyword=$(this).val();
                        if(keyword){
                                window.location.href="?keyword="+keyword;
                        }
                }
        });
});