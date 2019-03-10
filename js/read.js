/**
 * Created by Mr'Run on 2016/4/5.
 */
var funs = new Functions();
var secname = '';
var baseEnDe = new Base64();
function getBook(){
    loading();
    var url = "api-server/datainteraction/BooksDI.php?type=id&query="+bookid+"&jof="+jof+"&page=1";
    funs.gets(url,getinfo,jof);
    $('#chaplist').attr({"onclick":"tolist('id',"+bookid+",'1')"});
}

function getinfo(data,status,jof) {
    var jf = 'j';
    if(jof==0){
        jf = 'j';
    }else{
        jf = 'f';
    }

    if (status != 'success') {
        error404();
    } else {
        if (jof == 0) {
            jf == 'j';
        } else {
            jf == 'f';
        }
        var datas = funs.bookdata(data, jf);
        var book = datas.normals;
        if (book.length == 0) {
            book = datas.forbiddens;
        }
        if (book.length != 0) {
            secname = decodeURI(book[0].booknames);
            $('#readtag').html(book[0].tags);
            getContent(page);
        } else {
            error404();
        }
    }
}
getBook();



function getContent(page) {

    if (page <= 0 || parseInt(page) > pageNum) {
        error404();
    } else {
        if (secname == 'undefined') {
            secname = '分节阅读';
        }
        $('#chapname').text(secname + '_' + page);
        document.title = secname+'-水帘洞小说';
        var contentUrl = "./api-server/datainteraction/BookContent.php?page=" + page + "&type=content&bookid=" + bookid + "&jof=" + jof;
        $.get(contentUrl, function (data, status) {
            if (status != 'success') {
                error404();
            } else {
                var content = baseEnDe.decode(data);
                $('#chaptxt').html(content);
                changePage();
                success();
            }
        });
    }
}
function lastPage(){
    if(page!=1){
        loading();
        page--;
        location.hash = page;
        getContent(page);
    }
}

function nextPage(){
    if(page!=pageNum){
        loading();
        page++;
        location.hash = page;
        getContent(page);
    }
}


function changePage(){
    if(page==1){
        $('#pre-chap').removeClass();
        $('#pre-chap').addClass('btn disabled');
        $('#pre-chap').attr({"onclick":""});

    }else{
        $('#pre-chap').removeClass();
        $('#pre-chap').addClass('btn');
        $('#pre-chap').attr({"onclick":"lastPage()"});
    }
    if(page==pageNum){
        $('#next-chap').removeClass();
        $('#next-chap').addClass('btn disabled');
        $('#next-chap').attr({"onclick":""});
    }else{
        $('#next-chap').removeClass();
        $('#next-chap').addClass('btn');
        $('#next-chap').attr({"onclick":"nextPage()"});
    }
}

function error404(){
    $('#loading').hide();
    $('#error404').show();
    $('#footer').show();
    $('#footer-nav').show();
}

function loading(){
    $('#main').hide();
    $('#error404').hide();
    $('#footer-nav').hide();
    $('#footer').hide();
    $('#loading').show();
}
function success(){
    $('#main').show();
    $('#footer').show();
    $('#footer-nav').show();
    $('#loading').hide();
}