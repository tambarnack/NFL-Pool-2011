var pool = {
	showLeaderboard: function(){
		$.ajax({ url: 'index.php/welcome/leaderboard', type: 'GET', success: function(res) { $("#centerColumn").html(res); }});
	},
	showScores: function(week){
		$("#centerColumn").html("<div id='games-weeks' class='pagination'></div><div id='resultedList'></div>");
		$("#games-weeks").pagination(17, {
			items_per_page:1, current_page: week - 1, num_display_entries: 17, next_text: "", prev_text: "",
			callback: function(index, element){ admin.fetchWeek(index + 1, false); }
		});
	},
	showWeekPool: function(){
		if(admin.player == null){
			if(admin.editMode && admin.week > 1){
				//Show last week results
			}else if(!admin.editMode){
				//Show this week pool
			}
		}else{
			
		}
	},
	showProfile: function(profileId){
		
		$("#centerColumn").html("<div id='games-weeks' class='pagination'></div><div id='resultedList'></div>");
		$("#games-weeks").pagination(17, {
			items_per_page:1, current_page: admin.week - 1, num_display_entries: 17, next_text: "", prev_text: "",
			callback: function(index, element){ 
				if(admin.player == null || admin.player.id != profileId){
					pool.fetchProfileWeek(profileId, index + 1);
				}else{ 
					pool.fetchMyWeek(index + 1);
				}
			}
		});
	},
	fetchProfileWeek: function(profileId, week){
		console.log("Fetch  data of " + profileId + " on the week " + week);
		$.ajax({
		    url: 'index.php/welcome/weekPlayer',
		    type: 'GET', 
		    data: {"playerId" : profileId, "week" : week},
		    success: function(res) {
		    	$("#resultedList").html(res);
		    }
		});
	},
	fetchMyWeek: function(week){
		$.ajax({
		    url: 'index.php/welcome/weekPool',
		    type: 'GET', 
		    data: {"playerId" : admin.player.id, "week" : week},
		    success: function(res) {
		    	$("#resultedList").html(res);
		    }
		});
	},
	savePool: function(week){
		queryData = new Array();
		$("input.pool-radio").each(function(){
			if(this.checked){
				queryData.push(this.value);
			}
		});
		$.ajax({
		    url: 'index.php/welcome/savePool',
		    type: 'POST', dataType: "json",
		    data: "forecast=" + queryData.join(",") + "&playerId="+admin.player.id+"&week="+week,
		    success: function(res) {
		    	alert("The pool for week " + week + " was successfuly updated");
		    }
		});
	}
};
