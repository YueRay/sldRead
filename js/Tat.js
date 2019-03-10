/**
 * Created by Mr'Run on 2016/3/11.
 * 加载推荐与标签云,Tag hbtj ztjb
 */

var jof = 'j';
var funs = new Functions();
var url = 'config-tj/' + jof + '/tags_tj.txt';
var tagdivid = '#tagtj', hbtjdivid = '#hbtj', ztjbdivid = '#ztjb';
var tagsarr = '';
funs.gets(url, function (data, status) {
    var json = $.parseJSON(data);
    tagsarr = json.tagcloud;
    var taghtml = tagshtml(json.tagcloud, jof, false);
    var hbtj = json.hbtj;
    var ztjb = json.ztjb;
    tags(tagdivid, taghtml)
    tjbooks(hbtjdivid, hbtj);
    tjbooks(ztjbdivid, ztjb);
});

function moretags() {
    var taghtml = tagshtml(tagsarr, jof, true);
    tags(tagdivid, taghtml);
    $('#moretag').hide();
}


//标签
function tags(divid, taghtml) {
    $(divid).html(taghtml);
}
//推荐公共方法
function tjbooks(divid, tj) {

    for (var i = 0; i < 10; i++) {
        var num = funs.add0(i);
        var book = tj[i];
        $(divid + num).html(getBookurl(book.bookid, book.bookname));
    }
}
//标签云html
function tagshtml(tagarr, jof, all) {
    var length = 18;
    if (all == true) {
        length = tagarr.length;
    }
    var taghtml = '';
    for (var i = 0; i < length; i++) {
        taghtml += "<a class=\"tag" + tagarr[i] + " " + jof + "img\" title=\"tag\" onclick=\"tolist('tag',"+tagarr[i]+",1)\" href=\"javascript:void(0)\"</a>";
    }
    taghtml += "<a id='moretag' class=\"moretag\" title=\"tag\" onclick='moretags()'>...</a>";
    return taghtml;
}
//推荐书籍html
function getBookurl(bookid, bookname) {
    var book = $("<a></a>").text(bookname);
    book.attr({"onclick":"tolist('id',"+bookid+",'1')"});
    book.attr({"href": "javascript:void(0)"});
    return book;

}