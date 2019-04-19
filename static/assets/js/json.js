//比较两个对象是否相等
window.onload = function() {
    function isObj(object) {
        return object && typeof(object) == 'object' && Object.prototype.toString.call(object).toLowerCase() == "[object object]";
    }

    function isArray(object) {
        return object && typeof(object) == 'object' && object.constructor == Array;
    }

    function getLength(object) {
        var count = 0;
        for (var i in object) count++;
        return count;
    }

    function Compare(objA, objB) {
        if (!isObj(objA) || !isObj(objB)) return false; //判断类型是否正确
        if (getLength(objA) != getLength(objB)) return false; //判断长度是否一致
        return CompareObj(objA, objB, true); //默认为true
    }

    function CompareObj(objA, objB, flag) {
        for (var key in objA) {
            if (!flag) //跳出整个循环
                break;
            if (!objB.hasOwnProperty(key)) { flag = false; break; }
            if (!isArray(objA[key])) { //子级不是数组时,比较属性值
                if (objB[key] != objA[key]) { flag = false; break; }
            } else {
                if (!isArray(objB[key])) { flag = false; break; }
                var oA = objA[key],
                    oB = objB[key];
                if (oA.length != oB.length) { flag = false; break; }
                for (var k in oA) {
                    if (!flag) //这里跳出循环是为了不让递归继续
                        break;
                    flag = CompareObj(oA[k], oB[k], flag);
                }
            }
        }
        return flag;
    }
    // var jsonObjA = {
    //     "Name": "MyName",
    //     "Company": "MyCompany",
    //     "Infos": [
    //         { "Age": "100" },
    //         {
    //             "Box": [
    //                 { "Height": "100" },
    //                 { "Weight": "200" }
    //             ]
    //         }
    //     ],
    //     "Address": "马栏山"
    // };
    // var jsonObjB = {
    //     "Name": "MyName",
    //     "Company": "MyCompany",
    //     "Infos": [
    //         { "Age": "100" },
    //         {
    //             "Box": [
    //                 { "Height": "100" },
    //                 { "Weight": "200" }
    //             ]
    //         }
    //     ],
    //     "Address": "马栏山二号"
    // };
    // var result = Compare(jsonObjA, jsonObjB);
    // console.log(result); // true or false
};

// 将无关联的json转变为有关联的json
    // var formJson = [
    //     {
    //         'id': '1',
    //         'name': '文章',
    //         'pId': '0'
    //     },
    //     {
    //         'id': '2',
    //         'name': '所有文章',
    //         'pId': '1'
    //     },
    //     {
    //         'id': '3',
    //         'name': '写文章',
    //         'pId': '1'
    //     },
    //     {
    //         'id': '4',
    //         'name': '文章分类',
    //         'pId': '1'
    //     },
    //     {
    //         'id': '5',
    //         'name': '评论',
    //         'pId': '0'
    //     },
    //     {
    //         'id': '6',
    //         'name': '设置',
    //         'pId': '0'
    //     },
    //     {
    //         'id': '7',
    //         'name': '网站设置',
    //         'pId': '6'
    //     },
    //     {
    //         'id': '8',
    //         'name': '网站设置1',
    //         'pId': '7'
    //     }
    // ];
    
    // var fromJson = [
    //     {
    //         'id': '1',
    //         'name': '文章',
    //         'pId': '0',
    //         'children': [{
    //                 'id': '2',
    //                 'name': '所有文章',
    //                 'pId': '1',
    //                 'children': []
    //             },
    //             {
    //                 'id': '3',
    //                 'name': '写文章',
    //                 'pId': '1',
    //                 'children': []
    //             },
    //             {
    //                 'id': '4',
    //                 'name': '文章分类',
    //                 'pId': '1',
    //                 'children': []
    //             }
    //         ]
    //     },
    //     {
    //         'id': '5',
    //         'name': '评论',
    //         'pId': '0',
    //         'children': []
    //     },
    //     {
    //         'id': '6',
    //         'name': '设置',
    //         'pId': '0',
    //         'children': [{
    //             'id': '7',
    //             'name': '网站设置',
    //             'pId': '6',
    //             'children': []
    //         }]
    //     }
    // ];
    
    var formJson = [];
    var pId = 'parent_id';
    var id = 'id';
    function transform() {
        for (var i = 0; i < formJson.length; i++) {
            if (typeof formJson[i].isDelete !== 'undefined') { continue; }
            var id = formJson[i][id];
            loop(formJson[i],formJson);
        }
        var toJson = [];
        for (var i = 0; i < formJson.length; i++) {
            if (typeof formJson[i].isDelete !== 'undefined') {
                continue;
            }
            toJson.push(formJson[i]);
        }
        return toJson;
    }

    function loop(root) {
        var id = root['id'];
        for (var j = 0; j < formJson.length; j++) {
            if (typeof formJson[j].isDelete !== 'undefined') continue;
            var pid = formJson[j][pId];
            if (pid == id) {
                flag = true;
                formJson[j].isDelete = 0;
                if (typeof root.children == 'undefined') {
                    root.children = [];
                }
                var back = copy(loop(formJson[j]));
                delete back.isDelete;
                root.children.push(back);
            }
        }
        return root;
    }

    //复制元素
    function copy(form) {
        var to = {};
        if (typeof form !== 'object') {
            return form;
        }
        for (var attr in form) {
            to[attr] = copy(form[attr]);
        }
        return to;
    }

    function toLinkJson(fromJson,pId){
        formJson = fromJson;
        pId = pId;
        return transform();
    }

    // var json = transform(formJson);
    // console.info(json);

    