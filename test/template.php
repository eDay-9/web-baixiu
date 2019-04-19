<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<div id="app"></div>
<script src="../static/verdors/art-template/template-web.js"></script>
<script id="main" type="text/html">
    <ul>
       {{each list}}
            <li>{{$value}}</li>
        {{/each}}
    </ul>
</script>
<script id="test" type="text/html">
    <div>
        <ul>
            {{each person}}
                <li>{{if $imports.isExist(value)}} aa{{else}} aa{{/if}}</li>
            {{/each}}
        </ul>
        {{include 'main' a}}
    </div>
</script>
<script>
    var data = {
        person:[
            {name:"jack",age:18},
            {name:"tom",age:19},
            {name:"jerry",age:20},
            {name:"kid",age:21},
            {name:"jade",age:22}
        ],
        a:{
            list:['文艺', '博客', '摄影', '电影', '民谣', '旅行', '吉他']
        }
    };
    var html = template("test",data);
    document.getElementById("app").innerHTML=html;
     //自定义函数
     template.defaults.imports.isExist = function(){
        console.info("aa")
        console.info(obj);
     };
</script>
</body>
</html>