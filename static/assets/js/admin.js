$(function(){
	$.ajaxSetup({global : false});
	$(document).ajaxSend(function(){
		console.info("ajax  --------  开始了-------");
	});
	$(document).ajaxComplete(function(){
		console.info("ajax ---------结束了 -------");
	});
	// $.ajaxSetup({
	// 	global : false,
	// 	beforeSend : function(){
	// 		console.info("开始了");
	// 	},
	// 	complete : function(){
	// 		console.info("结束了");
	// 	}
	// });
	// menus动态加载
	$(".aside").load('/admin/inc/aside.php .aside>*',function(){
		getMenus();
	});
	window['getMenus'] = function () {
		$.ajax({
		    type : 'get',
		     url : '/admin/controller/menus.php',
		       success: function(result){
		            var toJson = eval('(' + result + ')');
		           	var menus = toLinkJson(toJson,'parent_id');
		           	var data = {
		           		'menus': menus
		           	};
		        	var html = template("nav_wrap",data);
		    		document.getElementById("nav_content").innerHTML = html;
		        }
		});
	};

	//导航条动态加载
	$(".navbar").load('/admin/inc/navbar.php .navbar>*');

	//统计信息
	var char_info = {
		config : [
					{ "num" : 4 , "color" : window.chartColors.red},
					{ "num" : 4 , "color" : window.chartColors.orange},
					{ "num" : 7 , "color" : window.chartColors.yellow}
				],
		getNums : function(){
						var info = this.config;
						var nums = [];
						for (var i = 0; i < info.length; i++) {
							var num = info[i]['num'];
							nums.push(num);
						}
						// console.info(nums);
						return nums;
				},
		getColors : function(){
						var info = this.config;
						var colors = [];
						for (var i = 0; i < info.length; i++) {
							var color = info[i]['color'];
							colors.push(color);
						}
						// console.info(colors);
						return colors;
					}


	}

	var config = {
			type: 'pie',
			data: {
				datasets: [{
					data: char_info.getNums(),
					backgroundColor: char_info.getColors(),
					label: 'Dataset 1'
				}],
				labels: [
					'Red',
					'Orange',
					'Yellow',
				]
			},
			options: {
				responsive: true
			}
		};
		window['loadChart'] = function(){
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
		}

		
}());

			
			
