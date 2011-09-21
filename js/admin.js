var admin = {
	showAdminMenu: function(week){
		command = $("#commandname").val();
		if(command == "admin"){
			$("#adminUl").html("<li><a href='#' onclick='admin.showScores(" + week + "); return false;'>Update results</li>" +
			"<li><a href='#' onclick='admin.changeWeek($(\"#commandname\").val()); return false;'>Change week</li>" + 
			"<li><a href='#' onclick='admin.changeState(); return false;'>Change mode</li>" +
			"<li><a href='#' onclick='admin.calculatePoints(); return false;'>Calculate points</li>");
		}else{
			admin.login(command);
		}
	},
	showScores: function(week){
		$("#centerColumn").html("<div id='games-weeks' class='pagination'></div><div id='resultedList'></div>");
		$("#games-weeks").pagination(17, {
			items_per_page:1, current_page: week - 1, num_display_entries: 17, next_text: "", prev_text: "",
			callback: function(index, element){ admin.fetchWeek(index + 1, true); }
		});
	},
	fetchWeek: function(week, adminMode){
		console.log("Fetching week " + week);
		$.ajax({
		    url: 'http://www.nfl.com/scores/2011/REG' + week,
		    type: 'GET',
		    success: function(res) {
		    	resultsHTML = "";
		    	games = new Array();
		    	$(res.responseText).find(".new-score-box").each(function(){
		    		visitor_name = $(this).find(".away-team .team-name a").text();
		    		local_name = $(this).find(".home-team .team-name a").text();
		    		
		    		visitor_score = parseInt($(this).find(".away-team p.total-score").text());
		    		local_score = parseInt($(this).find(".home-team p.total-score").text());
		    		
		    		visitor_logo = $(this).find(".away-team img.team-logo").attr("src");
		    		visitor = visitor_logo.substring(visitor_logo.lastIndexOf("/") + 1, visitor_logo.lastIndexOf("."));
		    		visitor_logo_img = admin.logosTemplate.replace("{__}",visitor); 
		    		
		    		local_logo = $(this).find(".home-team img.team-logo").attr("src");
		    		local = local_logo.substring(local_logo.lastIndexOf("/") + 1, local_logo.lastIndexOf("."));
		    		local_logo_img = admin.logosTemplate.replace("{__}",local); 
		    		
		    		winner = isNaN(visitor_score) ? null : (visitor_score > local_score ? visitor : local);
		    		
		    		resultsHTML += "<div class='game'><div class='visitor'>" + visitor_logo_img + "<div class='name'>" + visitor_name + "</div></div>" +
		    		"<div class='local'>" + local_logo_img + "<div class='name'>" + local_name + "</div></div><div class='score'>" + visitor_score + " - " + local_score + "</div></div>";
		    		
		    		games.push({"visitor" : visitor, "local" : local, "winner": winner, "week": week});
		    	});
				$("#resultedList").html(resultsHTML);
				if(admin.editMode == "EDITION" && adminMode) admin.loadResults(games);
		    }
		});
	},
	changeWeek: function(week){
		$.ajax({
		    url: 'index.php/admin/setAdminWeek',
		    type: 'POST', dataType: "json",
		    data: {"week": week},
		    success: function(res) {
		    	console.log("Saving week " + res.admin_week);
		    	$("#weekCounter").html(res.admin_week);
		    	admin.week = res.admin_week;
		    }
		});
	},
	changeState: function(){
		$.ajax({
		    url: 'index.php/admin/setAdminState',
		    type: 'POST', dataType: "json",
		    success: function(res) {
		    	console.log("Saving mode " + res.admin_state);
		    	admin.editMode = res.admin_state;
		    }
		});
	},
	login: function(playerName){
		$.ajax({
		    url: 'index.php/admin/login',
		    type: 'POST', dataType: "json",
		    data: {"name" : playerName},
		    success: function(res) {
		    	console.log("Loging " + res.id);
		    	if(res.id == 0){
		    		alert(res.message);
		    	}else{
		    		admin.player = res;
		    		$("#player_h").html("Welcome: <span>" + res.name + "</span>");
		    		$("#totalPoints").html(res.points);
		    		$("#totalPoints").show();
		    		pool.showProfile(admin.player.id);
		    	}
		    }
		});
	},
	loadResults: function(games){
		for(index in games){
			$.ajax({
			    url: 'index.php/admin/loadGames',
			    type: 'POST', dataType: "json",
			    data: games[index],
			    success: function(res) {
			    	console.log("Saving game " + res.id);
			    }
			});
		}
	},
	calculatePoints: function(){
		$.ajax({
			    url: 'index.php/admin/calculatePoints',
			    type: 'POST', data: {"week": admin.week},
			    success: function(res) {
			    	console.log(res);
			    }
			});
	},
	logosTemplate: "<img src='http://img.static.nfl.com/static/site/3.6/img/logos/teams-matte-80x53/{__}.png' />",
	editMode: "", player: null, week: 0
};
