<!DOCTYPE html>
<html>
<?php include('php/header.php'); ?>
<body>
<div class="container">
	<div class="row"><div class="col-sm-12">
	<br>
		<select class="form-control" style="width:50%;float:right" id="num_balls">
				<option selected disabled value="default">Balls per Player</option>
		<?php
		for ($i=1;$i<=15;$i++){ ?>
		<option value="<?=$i?>"><?=$i?></option>
		<?php } ?>
		</select>
		<select class="form-control" style="width:50%;float:left" id="num_players">
		<option selected disabled value="default">Players</option>
		<?php
		for ($i=1;$i<=15;$i++){ ?>
		<option value="<?=$i?>"><?=$i?></option>
		<?php } ?>
		</select><br><br>
		<button class="btn btn-primary btn-block" href="" id="new_game" >New Game</button>
		<?php 
		for ($i=1;$i<=15;$i++){ 
		if ($i%2==1){
		?>
		<button onclick="updatePlayerModal(<?=$i?>)" style="display:none"  class="btn btn-default btn-block" id="<?=$i?>" data-toggle="modal" data-target="#ballsModal">Show Player <?=$i?>'s Balls</button>
		<?php }
		else { ?>
		<button onclick="updatePlayerModal(<?=$i?>)" style="display:none"  class="btn btn-success btn-block" id="<?=$i?>" data-toggle="modal" data-target="#ballsModal">Show Player <?=$i?>'s Balls</button>
		<?php } }?>
		<br>
		<div  style="text-align:center" class="col-sm-12">
		<span id="allBalls" style="display:none;color:white">Tap ball when potted</span><br><br>
		<?php 
		for ($i=1; $i<=15; $i++ ){

		echo  "<span onclick='toggleOpacity($i)' style='text-align:center;margin:0px 2px 0px 2px;opacity:.25' id='left$i' class='ball$i ballz ballAnimate'></span>";
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

	  	num_players=$("#num_players").val();
	  	num_balls=$("#num_balls").val();
	  	if (num_balls*num_players > 15 || num_players>8 || num_players < 1 || num_balls < 1){
		  	alert("That's not gonna work!");
		  	$("#num_players option[value=default]").attr('selected', 'selected');
		  	$("#num_balls option[value=default]").attr('selected', 'selected');

				for (j=1;j<=8;j++){
					$("#"+String(j)).hide();
				}	
	  	}
	  	else {
	  	$("#allBalls").show();
	  	$(".ballz").toggleClass("ballAnimate");
			setTimeout(function(){$(".ballz").toggleClass("ballAnimate"),1100});
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