<!DOCTYPE html>
<html>
<?php include('header.php'); ?>
<body>
<div class="container">
	<div class="row"><div class="col-sm-12">
	<br>
		<input class="form-control" style="width:50%;float:left" placeholder="Number of Players" id="num_players">
		<input class="form-control" style="width:50%;float:right" placeholder="Balls Per Player" id="num_balls"><br><br>
		<button class="btn btn-primary btn-block" href="" id="new_game" onClick="animate()">New Game</button>
		<button onclick="updatePlayerModal(1)" style="display:none"  class="btn btn-default btn-block" id="1" data-toggle="modal" data-target="#ballsModal">Show Player One's Balls</button>
		<button onclick="updatePlayerModal(2)" style="display:none" class="btn btn-success btn-block" id="2" data-toggle="modal" data-target="#ballsModal">Show Player Two's Balls</button>
		<button onclick="updatePlayerModal(3)" style="display:none" class="btn btn-default btn-block" id="3" data-toggle="modal" data-target="#ballsModal">Show Player Three's Balls</button>
		<button onclick="updatePlayerModal(4)" style="display:none" class="btn btn-success btn-block" id="4" data-toggle="modal" data-target="#ballsModal">Show Player Four's Balls</button>
		<button onclick="updatePlayerModal(5)" style="display:none" class="btn btn-default btn-block" id="5" data-toggle="modal" data-target="#ballsModal">Show Player Five's Balls</button>
		<button onclick="updatePlayerModal(6)" style="display:none" class="btn btn-success btn-block" id="6" data-toggle="modal" data-target="#ballsModal">Show Player Six's Balls</button>
		<button onclick="updatePlayerModal(7)" style="display:none" class="btn btn-default btn-block" id="7" data-toggle="modal" data-target="#ballsModal">Show Player Seven's Balls</button>
		<button onclick="updatePlayerModal(8)" style="display:none" class="btn btn-success btn-block" id="8" data-toggle="modal" data-target="#ballsModal">Show Player Eight's Balls</button><br>
		<div  style="text-align:center" class="col-sm-12">
		<span id="allBalls" style="display:none;color:white">Tap ball when potted</span><br><br>
		<?php 
		for ($i=1; $i<=15; $i++ ){

		echo  "<span onclick='toggleOpacity($i)' style='text-align:center;margin:0px 2px 0px 2px;opacity:.25' id='left$i' class='ball$i'></span>";
				//if ($i % 5 == 0){ echo "<br>";}
		 }
		?>
		</div>
		<div class="modal fade " id="ballsModal">
		  <div class="modal-dialog ">
		    <div class="modal-content">
		      <div style="background:lightgrey" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title">Player One's Balls</h4>
		      </div>
		      <div style="background:grey" class="modal-body">

		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div></div>
</div>
</body>
<script>

  $(function() {
    BallsLeft = new Array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
  	$("#new_game").click(Setup);
  	});
  	function Setup(){
	  	$("#allBalls").show();

	  	num_players=$("#num_players").val();
	  	num_balls=$("#num_balls").val();
	  	if (num_balls*num_players > 15 || num_players>8 || num_players < 1 || num_balls < 1){
		  	alert("That's not gonna work!");
				num_players=$("#num_players").val("Number of Players");
				num_balls=$("#num_balls").val("Balls Per Player");
				for (j=1;j<=8;j++){
					$("#"+String(j)).hide();
				}	
	  	}
	  	else {
		  	new_game(num_balls,num_players); 
				for (j=1;j<=8;j++){
					$("#"+String(j)).hide();
				}		
				for (j=1;j<=num_players;j++){
					$("#"+String(j)).show();
				}	
	  	}
  	};
	function toggleOpacity(number){


		var currentOpacity = $(".ball"+String(number)).css('opacity');
		if (currentOpacity === '1' ){
		BallsLeft.removeByValue(number);
		$(".ball"+String(number)).fadeTo(50,.25);
		}
		else {
		BallsLeft.push(number);
		$(".ball"+String(number)).fadeTo(50,1);			
		}
		if (BallsLeft.length===0){
			var r=confirm("New Game?");
			if (r==true){ Setup();}
			
		}

	}
	
	function updatePlayerModal(number){
	var balls = String(Players[number].sort(function(a,b){return a - b}))
	//balls = "Your "+keyword+balls.substring(0,balls.length-1).replace(/,/g,', ');

	var body = "";
	var opacs = new Array(num_balls);
	for (i=0;i<num_balls;i++){
		var cO = $(".ball"+String(Players[number][i])).css('opacity');
		body+='<span 	style="margin:0px 5px 0px 0px;opacity:'+String(cO)+'" class="ball'+String(Players[number][i])+'"></span>';
	}
	$(".modal-body").html("<div style='text-align:center'>"+body+"</div>");	
	$(".modal-title").text("Player "+number+" Balls");
	}
	
  function new_game(num_balls,num_players){
    BallsLeft = new Array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
    for (i=1;i<16;i++){
	    $(".ball"+String(i)).fadeTo("fast",1);		
    }
	  var balls = new Array();
	  for (i=1;i<16;i++){
		  balls[i-1]=i;
	  }
	  Players = new Array();
	  for (j=1;j<=num_players;j++){
	  	Players[j] = new Array();
	  }	
	  for (j=1;j<=num_balls;j++){
	  	for (i=1;i<=num_players;i++) {
	  		var ball = balls[Math.floor(Math.random()*balls.length)];
				balls.removeByValue(ball);
				//console.log(ball);
				Players[i][j]=ball;
			}
		}
	}
Array.prototype.removeByValue = function(val) {
    for(var i=0; i<this.length; i++) {
        if(this[i] == val) {
            this.splice(i, 1);
            break;
        }
    }
}

  </script>
</html>