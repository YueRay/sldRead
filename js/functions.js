/**
 * Created by Mr'Run on 2016/3/8.
 */

function Functions(){

    //get请求
    this.gets = function(url,callback,jof,page){
        $(document).ready(function(){
            $.get(url, function (data,status) {
                callback(data,status,jof,page);
            });
        });
    }

    //post请求
    this.posts = function(url,datas,callback){
        $(document).ready(function(){
            $.post(url,datas,function(data,status){
                callback(data,status);
            });
        });
    }

    //404错误显示error层,隐藏数据层
    this.error404 = function(show,none){
        $('#'+show)[0].style.display = 'block';
        $('#'+none)[0].style.display = 'none';
    }

    //将小于10的数字前面+0转为string
    this.add0 = function(num){
        if(num<10){
            num = "0"+num;
        }
        return num;
    }

    //解析json
    this.bookdata = function(jsonStr,jof) {
        var json = $.parseJSON(jsonStr);
        var normals = this.booksObj(json.normal,jof,0);
        var forbiddens =this.booksObj(json.forbidden,jof,1);
        var count = json.count;
        return {
            count: count,
            normals: normals,
            forbiddens: forbiddens
        }
    }

    //将json数组数据封装成页面需要的books数组
    this.booksObj = function(jsonarray,jof,isfb){
        var books = [];
        if(jsonarray == undefined ||jsonarray == '0' ){
            return books;
        }
        for(var i = 0;i<jsonarray.length;i++){
            //classname,完结状态，书名，作者，简介，标签
            var catename,state,bookname,category,autothor,intro,tags,secname,sex;
            var num = this.add0(i);
            //判断频道和分类，设置div的class
            if(jsonarray[i].sex=='男'){
                catename = 'bkcard boy';
            }else{
                catename = 'bkcard girl';
            }
            catename += this.add0(jsonarray[i].cateId);
            //判断完结状态
            if(jsonarray[i].state=='完结'||jsonarray[i].state=='完結'){
                state = function(obj){
                    obj.show();
                };
            }else{
                state = function(obj){
                    obj.hide();
                };
            }

            var bookurl = "./list.php?type=id&query="+jsonarray[i].bookId+"&";
            var cateurl = "./list.php?type=category&query="+jsonarray[i].category+"&";
            var tagurl = "./list.php?type=tag&query=";
            var onclicks = "tolist()";

            //判断是否是禁书,是禁书则bookname改为图片，secname改为分节阅读
            if(isfb==1){
                //bookname = "<a class='"+jof+"img fbbook fbb"+jsonarray[i].bookId+"'  href='"+bookurl+"'></a>";
                bookname = "<a class='"+jof+"img fbbook fbb"+jsonarray[i].bookId+"' onclick='tolist(\"id\","+jsonarray[i].bookId+",1)' href='javascript:void(0)'></a>";
                secname = "分节阅读";
            }else{
                //bookname = "<a href='"+bookurl+"'>"+jsonarray[i].bookname+"</a>";
                bookname = "<a onclick='tolist(\"id\","+jsonarray[i].bookId+",1)' href='javascript:void(0)'>"+jsonarray[i].bookname+"</a>";
                secname = jsonarray[i].bookname;
            }
            //分类

            category = "<a onclick='tolist(\"category\",\""+encodeURI(jsonarray[i].category)+"\",1)' href='javascript:void(0)'>"+jsonarray[i].category+"</a>";
            //作者
            autothor = jsonarray[i].autothor;
            //简介
            intro = jsonarray[i].intro;
            //标签
            var tagarr = jsonarray[i].tag.split(',');
            tags = '';
            for(var k =0;k<tagarr.length;k++){
                tags += "<a class='tag"+tagarr[k]+" "+jof+"img' title='tag' onclick='tolist(\"tag\","+tagarr[k]+",1)' href='javascript:void(0)'></a>";
            }
            //将书籍信息封装起来放入books数组中
            books[i] = new Object();
            books[i].sex = jsonarray[i].sex;
            books[i].catename = catename;
            books[i].state = state;
            books[i].bookname = bookname;
            books[i].category = category;
            books[i].autothor = autothor;
            books[i].intro = intro;
            books[i].tags = tags;
            books[i].bookid = jsonarray[i].bookId;
            books[i].booknames = encodeURI(jsonarray[i].bookname);
            books[i].secname = secname;
        }
        return books;
    }
}

(function($) {
    $.extend({
        urlGet:function()
        {
            var aQuery = window.location.href.split("?");  //取得Get参数
            var aGET = new Array();
            if(aQuery.length > 1)
            {
                var aBuf = aQuery[1].split("&");
                for(var i=0, iLoop = aBuf.length; i<iLoop; i++)
                {
                    var aTmp = aBuf[i].split("=");  //分离key与Value
                    aGET[aTmp[0]] = aTmp[1];
                }
            }
            return aGET;
        }
    })
})(jQuery);


function setCookie(name,value)
{
    var Days = 30;
    var exp = new Date();
    exp.setTime(exp.getTime() + Days*24*60*60*1000);
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}

function getCookie(name)
{
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
    if(arr=document.cookie.match(reg))
        return unescape(arr[2]);
    else
        return null;
}


function delCookie(name)
{
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval=getCookie(name);
    if(cval!=null)
        document.cookie= name + "="+cval+";expires="+exp.toGMTString();
}






























