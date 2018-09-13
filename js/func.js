$(function(){
	//ログインフォーム
	$("#form_login").validationEngine({
		promptPosition: "topLeft"
	});
	$("#form_signup").validationEngine({
		promptPosition: "topLeft"
	});
	//入力フォーム
	$("#form_diary").validationEngine({
		promptPosition: "topLeft"
	});

	//アカウント登録後のアクション
	if(code != ""){
		if(code == "success"){
			$("body").append("<div id='finish_dialog' title='アカウント作成'><p>アカウントの登録が完了しました。</p></div>");
		}else if(code == "error"){
			$("body").append("<div id='finish_dialog' title='アカウント作成'><p>入力されたユーザー名は既に使用されています。</p></div>");
		}
		$( "#finish_dialog" ).dialog({
			modal:true,
	        buttons:{
	        	"OK":function(){
	        		$(this).dialog("close");
	        	}
	        },
	        close: function() {}
		});
	}
	//ログイン失敗時のアクション
	if(error != ""){
		$("body").append("<div id='error_dialog' title='ログインエラー'><p>ユーザー名またはパスワードが違います</p></div>");
		$( "#error_dialog" ).dialog({
			modal:true,
	        buttons:{
	        	"OK":function(){
	        		$(this).dialog("close");
	        	}
	        },
	        close: function() {}
		});
	}

	//tab login
	$( "#login_tabs" ).tabs();

	//design
	$('#add_chemical').button({
	      icons: {
	        primary: "ui-icon-plus"
	      },
	      text: false
	});
	$('#add_fertilizer').button({
	      icons: {
	        primary: "ui-icon-plus"
	      },
	      text: false
	});
	$('#add_diary').button({
	      icons: {
	        primary: "ui-icon-pencil"
	      }
	});
	$('#remove_record').button({
	      icons: {
	        primary: "ui-icon-trash"
	      },
	      text:false
	});
	$("#autologin").toggleSwitch();

	//tab main
	$( "#tabs" ).tabs({
		activate: function(event, ui) {
			//グラフタブが開かれたときのアクション
			//年月カレンダー
			$("#datepicker_chart").MonthPicker({
				MaxMonth: 0,
				OnAfterChooseMonth: function(selectedDate) {
					var dt = new Date(selectedDate);
					var y = dt.getFullYear();
					var m = ("00" + (dt.getMonth()+1)).slice(-2);
					var d = ("00" + dt.getDate()).slice(-2);
					var selected_format_date = y + "-" + m + "-" + d;
					var max_days = new Date(y, m, 0).getDate();
					var chart_x = [];
					var label_x = [];
					for(var i = 1; i <= max_days; i++){
						var d = ('00' + i).slice(-2);
						chart_x[i-1] =  y + "-" + m + "-" + d;
						label_x[i-1] = m + "/" + d;
					}

					if(ui.newTab.index() == 1){
						$.ajax({
				            url:'./',
				            type:'POST',
				            data:{
				            	'chart_flg':true,
				            }
				        })
				        .done( (data) => {
				        	var json_chart = JSON.parse(data);
				        	var low_temperature = [];
				        	var high_temperature = [];
				        	var working_hour = [];
				        	var water_minutes = [];
				        	var yield = [];
				        	var i = 0;
				        	chart_x.forEach(function(key){
					        	var flg = false;
				        		json_chart.forEach(function(val){
				        			if(val["date"] == chart_x[i]){
				        				low_temperature[i] = val["low_temperature"];
				        				high_temperature[i] = val["high_temperature"];
				        				working_hour[i] = val["working_hour"];
				        				water_minutes[i] = val["water_minutes"];
				        				yield[i] = val["yield"];
				        				flg = true;
				        			}
				        		});
				        		if(flg === false){
				        			low_temperature[i] = 0;
				        			high_temperature[i] = 0;
				        			working_hour[i] = 0;
				        			water_minutes[i] = 0;
				        			yield[i] = 0;
				        		}
				        		i++;
				        	});
				        	//気温グラフ描画処理
				        	var ctx1 = document.getElementById("chart_temperature").getContext('2d');
							var chart_temperature = new Chart(ctx1, {
							   type: 'line',
							   data: {
							      labels: label_x,
							      datasets: [
							    	  {
								         label: "最低気温",
								         borderColor: 'rgb(0, 0, 255)',
								         fill: false,
								         data: low_temperature,
							    	  },
							    	  {
							    		 label:"最高気温",
								         borderColor: 'rgb(255, 0, 0)',
								         fill: false,
								         data: high_temperature,
							    	  }
							    	  ]
							   },
							   options: {
							      responsive: true,
							      scales: {
								      yAxes: [{
									      ticks: {
										      beginAtZero: true,
										      min: -10,
										      max: 50
									      }
								      }]
							      }
							   }
							});
							//作業時間グラフ描画
							var ctx2 = document.getElementById("chart_working_hour").getContext('2d');
							var chart_working_hour = new Chart(ctx2, {
							   type: 'line',
							   data: {
							      labels: label_x,
							      datasets: [
							    	  {
								         label: "作業時間",
								         borderColor: 'rgb(0, 255, 0)',
								         lineTension: 0,
								         fill: false,
								         data: working_hour
							    	  }
							    	  ]
							   },
							   options: {
							      responsive: true,
							      scales: {
								      yAxes: [{
									      ticks: {
										      beginAtZero: true,
										      min: 0,
										      max: 12
									      }
								      }]
							      }
							   }
							});
							//灌水時間グラフ描画
							var ctx3 = document.getElementById("chart_water_minutes").getContext('2d');
							var chart_working_hour = new Chart(ctx3, {
							   type: 'line',
							   data: {
							      labels: label_x,
							      datasets: [
							    	  {
								         label: "灌水時間",
								         borderColor: 'rgb(0, 0, 128)',
								         fill: false,
								         data: water_minutes
							    	  }
							    	  ]
							   },
							   options: {
							      responsive: true,
							      scales: {
								      yAxes: [{
									      ticks: {
										      beginAtZero: true,
										      min: 0,
										      stepSize: 10
									      }
								      }]
							      }
							   }
							});
							//収量グラフ描画
							var ctx4 = document.getElementById("chart_yield").getContext('2d');
							var chart_working_hour = new Chart(ctx4, {
							   type: 'line',
							   data: {
							      labels: label_x,
							      datasets: [
							    	  {
								         label: "収穫量",
								         borderColor: 'rgb(255, 0, 255)',
								         fill: false,
								         data: yield
							    	  }
							    	  ]
							   },
							   options: {
							      responsive: true,
							      scales: {
								      yAxes: [{
									      ticks: {
										      beginAtZero: true,
										      min: 0,
									      }
								      }]
							      }
							   }
							});
				        })
					}
				}
			});
		}
	});




	//品目セレクトアクション
	$('#item_pulldown').change(function(){
		/////////////////
	});


	//今日の日誌の有無で削除ボタンの有効/無効化
	if($("#delete_flg").val() == "1"){
		$('#remove_record').button({
		      disabled:false
		});
	}else{
		$('#remove_record').button({
		      disabled:true
		});
	}
	//カレンダー
	var default_date = window.sessionStorage.getItem(['default_date']);
	window.sessionStorage.clear();
	if(default_date == null){
		var dt = new Date();
		var y = dt.getFullYear();
		var m = ("00" + (dt.getMonth()+1)).slice(-2);
		var d = ("00" + dt.getDate()).slice(-2);
		var result = y + "-" + m + "-" + d;
		default_date = result;
	}
	$("#datepicker").datepicker({
		dateFormat: "yy-mm-dd",
		defaultDate:default_date,
		maxDate: 0,
		//押下された日付のレコードを取得する
		onSelect:function(dateText){
			$("#date_input").val(dateText);
			$.ajax({
	            url:'./',
	            type:'POST',
	            data:{
	                'date_input':$('#date_input').val()
	            }
	        })
	        .done( (data) => {
	        	var json_diary = JSON.parse(data);
	        	$('#weather_input').val(json_diary["weather_id"]);
	        	$('#low_temperature_input').val(json_diary["low_temperature"]);
	        	$('#high_temperature_input').val(json_diary["high_temperature"]);
	        	$('#working_hour_input').val(json_diary["working_hour"]);
	        	$('#water_minutes_input').val(json_diary["water_minutes"]);
	        	$('#yield_input').val(json_diary["yield"]);
	        	if(json_diary["chemical_id"] != ""){
	        		$('#chemical_input').val(json_diary["chemical_id"]);
	        	}else{
	        		$('#chemical_input option').filter(function(index){
	        			return $(this).text() === '未選択';
	        		}).prop('selected', true);
	        	}
	        	if(json_diary["fertilizer_id"] != ""){
	        		$('#fertilizer_input').val(json_diary["fertilizer_id"]);
	        	}else{
	        		$('#fertilizer_input option').filter(function(index){
	        			return $(this).text() === '未選択';
	        		}).prop('selected', true);
	        	}
	        	$('#annotation_input').val(json_diary["annotation"]);
	        	//削除ボタンの操作
	        	if(json_diary["search_result"] === false){
	        		$('#remove_record').button({
	        		      disabled:true
	        		});
	        	}else{
	        		$('#remove_record').button({
	        		      disabled:false
	        		});
	        	}
	        	//diary_id付与
	        	$("#delete_id").val(json_diary["diary_id"]);
	        })
		},
		//入力済み日付の色変更
		beforeShowDay: function(date) {
            for (var i = 0; i < entered_date.length; i++) {
                var t = Date.parse(entered_date[i]);
                var entered = new Date();
                entered.setTime(t);

                if (entered.getYear() == date.getYear() &&
                		entered.getMonth() == date.getMonth() &&
                		entered.getDate() == date.getDate()) {
                    return [true, 'class-entered'];
                }
            }

            // 平日
            return [true, ''];
        }
	});

    //投稿ボタン押下アクション
    $('#add_diary').on('click',function(){
        $.ajax({
            url:'./',
            type:'POST',
            data:{
            	'post_flg':true,
            	'item_id_input':$('#item_id_input').val(),
                'date_input':$('#date_input').val(),
                'weather_input':$('#weather_input').val(),
                'low_temperature_input':$('#low_temperature_input').val(),
                'high_temperature_input':$('#high_temperature_input').val(),
                'working_hour_input':$('#working_hour_input').val(),
                'water_minutes_input':$('#water_minutes_input').val(),
                'yield_input':$('#yield_input').val(),
                'chemical_input':$('#chemical_input').val(),
                'fertilizer_input':$('#fertilizer_input').val(),
                'annotation_input':$('#annotation_input').val()
            }
        })
        .done( (data) => {
        	window.sessionStorage.setItem(['default_date'],data);
        })
    });

    //削除ボタン押下アクション
    $("#remove_record").button().click(function(e) {
        $( "#delete_dialog" ).dialog({
            autoOpen: false,
            modal: true,
            buttons:{
            	"削除":function(){
            		//AJAXリクエスト
            		$.ajax({
                        url:'./',
                        type:'POST',
                        data:{
                            'delete_flg':true,
                            'delete_id':$('#delete_id').val()
                        }
                    })
                    .done( (data) => {
                    	//inputを空にする
        	        	$('#weather_input').val("1");
        	        	$('#low_temperature_input').val("");
        	        	$('#high_temperature_input').val("");
        	        	$('#working_hour_input').val("");
        	        	$('#water_minutes_input').val("");
        	        	$('#yield_input').val("");
    	        		$('#chemical_input option').filter(function(index){
    	        			return $(this).text() === '未選択';
    	        		}).prop('selected', true);
    	        		$('#fertilizer_input option').filter(function(index){
    	        			return $(this).text() === '未選択';
    	        		}).prop('selected', true);
    	        		$('#annotation_input').val("");

                    	$("#add_done").dialog({
                    		autoOpen:false,
                    		modal:true,
                    		buttons:{
                    			"OK":function(){
                            		$(this).dialog("close");
                            		location.reload();
                            	}
                    		}
                    	});
                    	$("#add_done").text(data).dialog("open");
    		        })

            		$(this).dialog("close");
            	},
            	"キャンセル":function(){
            		$(this).dialog("close");
            	}
            },
            close: function() {}
        });
    	e.preventDefault();
    	$("#delete_dialog").dialog("open");
    });

    //農薬追加ボタン押下アクション
    $( "#add_chemical_dialog" ).dialog({
        autoOpen: false,
        modal: true,
        buttons:{
        	"登録":function(){
        		//AJAXリクエスト
        		$.ajax({
                    url:'./',
                    type:'POST',
                    data:{
                        'add_chemical_name':$('#add_chemical_name').val()
                    }
                })
                .done( (data) => {
                	$("#add_done").dialog({
                		autoOpen:false,
                		modal:true
                	});
                	var json_chemical = JSON.parse(data);
                	if(json_chemical["result"] === true){
	                	$("#add_done").text(json_chemical["dialog_message"]).dialog("open");
	                	$('#chemical_input').append($('<option>').html(json_chemical["chemical_name"]).val(json_chemical["chemical_id"]));
                	}else{
                		$("#add_done").text(json_chemical["dialog_message"]).dialog("open");
                	}
		        })
        		$(this).dialog("close");
        	},
        	"キャンセル":function(){
        		$(this).dialog("close");
        	}
        },
        close: function() {}
      });
    $("#add_chemical").button().click(function(e) {
    	e.preventDefault();
      $("#add_chemical_dialog").dialog("open");
    });

    //肥料追加ボタン押下アクション
    $( "#add_fertilizer_dialog" ).dialog({
        autoOpen: false,
        modal: true,
        buttons:{
        	"登録":function(){
        		//AJAXリクエスト
        		$.ajax({
                    url:'./',
                    type:'POST',
                    data:{
                        'add_fertilizer_name':$('#add_fertilizer_name').val()
                    }
                })
                .done( (data) => {
                	$("#add_done").dialog({
                		autoOpen:false,
                		modal:true
                	});
                	var json_fertilizer = JSON.parse(data);
                	if(json_fertilizer["result"] === true){
	                	$("#add_done").text(json_fertilizer["dialog_message"]).dialog("open");
	                	$('#fertilizer_input').append($('<option>').html(json_fertilizer["fertilizer_name"]).val(json_fertilizer["fertilizer_id"]));
                	}else{
                		$("#add_done").text(json_fertilizer["dialog_message"]).dialog("open");
                	}
		        })
        		$(this).dialog("close");
        	},
        	"キャンセル":function(){
        		$(this).dialog("close");
        	}
        },
        close: function() {}
      });
    $("#add_fertilizer").button().click(function(e) {
    	e.preventDefault();
      $("#add_fertilizer_dialog").dialog("open");
    });
});