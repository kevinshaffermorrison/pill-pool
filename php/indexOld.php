<!DOCTYPE html>
<html>
<?php include('header.php'); ?>

<body>
<div class="container">
	<div class="row">
	<br>
		<input class="form-control" style="width:50%;float:left" placeholder="Number of Players" id="num_players">
		<input class="form-control" style="width:50%;float:right" placeholder="Balls Per Player" id="num_balls"><br><br>
		<button class="btn btn-primary btn-block" href="" id="pick_balls" >Pick Balls</button><br>
		<button onclick="updatePlayerModal(1)" style="display:none"  class="btn btn-default btn-block" id="1" data-toggle="modal" data-target="#ballsModal">Show Player One's Balls</button><br>
		<button onclick="updatePlayerModal(2)" style="display:none" class="btn btn-success btn-block" id="2" data-toggle="modal" data-target="#ballsModal">Show Player Two's Balls</button><br>
		<button onclick="updatePlayerModal(3)" style="display:none" class="btn btn-default btn-block" id="3" data-toggle="modal" data-target="#ballsModal">Show Player Three's Balls</button><br>
		<button onclick="updatePlayerModal(4)" style="display:none" class="btn btn-success btn-block" id="4" data-toggle="modal" data-target="#ballsModal">Show Player Four's Balls</button><br>
		<button onclick="updatePlayerModal(5)" style="display:none" class="btn btn-default btn-block" id="5" data-toggle="modal" data-target="#ballsModal">Show Player Five's Balls</button><br>
		<button onclick="updatePlayerModal(6)" style="display:none" class="btn btn-success btn-block" id="6" data-toggle="modal" data-target="#ballsModal">Show Player Six's Balls</button><br>
		<button onclick="updatePlayerModal(7)" style="display:none" class="btn btn-default btn-block" id="7" data-toggle="modal" data-target="#ballsModal">Show Player Seven's Balls</button><br>
		<button onclick="updatePlayerModal(8)" style="display:none" class="btn btn-success btn-block" id="8" data-toggle="modal" data-target="#ballsModal">Show Player Eight's Balls</button>
<span  class="ball1"></span>
		
		<div class="modal fade bs-example-modal-sm" id="ballsModal">
		  <div class="modal-dialog modal-sm">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title">Player One's Balls</h4>		<img class="ball1" >	
		      </div>
		      <div class="modal-body">

		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
</div>
</body>
<script>

  $(function() {


  	$("#pick_balls").click(function(){
  	num_players=$("#num_players").val();
  	num_balls=$("#num_balls").val();
  	if (num_balls*num_players > 15 || num_players>8){
	  	alert("That's not gonna work!");
  	num_players=$("#num_players").val("Number of Players");
  	num_balls=$("#num_balls").val("Balls Per Player");
	  for (j=1;j<=8;j++){
			$("#"+String(j)).hide();
	  }	
  	}
  	else {
   	if (num_balls === '1'){
	  	keyword = "ball is ";
  	}
  	else {
	  	keyword = "balls are ";
  	}
	  	pick_balls(num_balls,num_players); 	
	  for (j=1;j<=num_players;j++){
			$("#"+String(j)).show();
	  }	
	  $("#pick_balls").text("Re-Pick Balls");
  	}
  	});
	});
	function updatePlayerModal(number){
	var balls = String(Players[number].sort(function(a,b){return a - b}))
	balls = "Your "+keyword+balls.substring(0,balls.length-1).replace(/,/g,', ');
	$(".modal-body").text(balls);
	$(".modal-title").text("Player "+number+" Balls");
	}
  function pick_balls(num_balls,num_players){
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