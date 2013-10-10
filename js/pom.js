//  $( "#sort" ).sortable({
//  	distance: 15,
//  	axis: "y"
//  });
// $( "#sort" ).disableSelection();
var baseUrl = '../../../../pomodoro/'
var timeLeft;
var pomActive;
var hasTask;
var taskName;
var taskId;
var mode;
var minutesLeft = 0;
var pomodoroTime = 25*60;
var breakTime = 5*60;
var clockTicks = false;
var clock = $('.clock').FlipClock({'clockFace': 'MinuteCounter'});
// $("#pomExpectForm").hide();
// $("#pomConclusionForm").hide();
clock.stop();

function flush()
{
	timeLeft = '';
	pomActive = '';
	hasTask = '';
	taskName = '';
	taskId = '';
	mode = '';
	checkActive();
}
/**
 * Checks weather there is an active session
 * @return no return, just sets the global vars
 */
function checkActive()
{
	var d = new Date();
	$.getJSON(window.baseUrl + "/API/active",function(data){
		pomActive = data['active'];
		timeLeft = data['time_left'];
		mode = data['type'];
		hasTask = data['task'];
		taskName = data['task_name'];
		taskId = data['task_id'];
		doClock();
	});
}

/**
 * Sets the clock and gets it spinning, if on task
 * @return {[type]} [description]
 */
function doClock(){
	if(pomActive == 'true'){
		clock.start();
		clock.setTime(timeLeft);
		clock.setCountdown(true);
		clockTicks = true;
	}else{
		clock.stop();
		clock.setTime(pomodoroTime);
		clockTicks = false;
	}
	focusMode();	
}

/**
 * Start the timer with a new session
 * @param  {integer} id optional, id of the task
 * @return {[type]}    [description]
 */
function startTimer(id)
{
	if(clockTicks === true) return;
	var url = '';
	// start the pomodoro
	if(id === undefined)		{
		url = baseUrl + "/API/start?type=pomodoro";
	}else{
		url = baseUrl + "/API/start?type=pomodoro&task_id="+id;
	} 
	$('#pomExpectForm').modal('show');
	$("#pomExpectation").focus();
	setTimeout(function() {
	    $('#pomExpectForm').modal('hide');
	}, 20000);
	$.getJSON(url,function(data){
		if(data.succes == 'true')
		{
			checkActive();
		}
	});
}

function deleteTask(id)
{
	$.getJSON(baseUrl + "/API/deleteTask?id="+id,function(data){
		if(data.succes == 'true')
		{
			$('#'+id).slideUp(500);

		}
	});
}

function finishTask(id)
{
	$.getJSON(baseUrl + "/API/finishTask?id="+id,function(data){
		if(data.succes == 'true')
		{
			$('#'+id).slideUp(500);

		}
	});
}

function addTask()
{
	var desc = $("#taskDescription").val().replace(/ +/g,'nsbpspace').replace(/#/g,'HASHTAG').trim();;
	var count = $("#taskCount").val();
	if(desc === "")
	{
		$("#addErrors").append('Description should be atleast something!<br/>');
		return;
	}
	if(count === '' || !IsNumeric(count))
	{
		$("#addErrors").append('Number of tasks should be numberic!<br/>');
		return;
	}
	$.getJSON(baseUrl + "/API/createTask?description="+desc+"&pomCount="+count,function(data){
		if(data.succes == 'true')
		{
			$("#taskDescription").val('');
			$("#taskCount").val('');
			$("#addErrors").text('');

			fillTasks();
		}
	});
}

function stopCounter()
{
	// end current session
	$.getJSON(baseUrl + "/API/end",function(data){
		if(data.succes == 'true')
		{
			clock.stop();
			clockTicks = false;
			flush();
		}
	});
	
}

function takeBreak()
{
	if(clockTicks == 'true')
	{
		stopCounter();
	}
	$.getJSON(baseUrl + "/API/start/type/pause",function(data){
		if(data.succes == 'true')
		{
			checkActive();
			doClock();

		}
	});

}


$('#break').click(function(){
	takeBreak();
});
$("#sAdd").click(function(){
	addTask();
})

$('#stop').click(function(){
	if(clockTicks == 'false') return;
	stopCounter();
	$("#pomConclusionForm").modal('show');
	$("#pomConclusion").focus();
	setTimeout(function() {
	    $("#pomConclusionForm").modal('hide');
	}, 20000);
});

$('#start').click(function(){
	startTimer();
});

function fillTasks()
{
	$("#sort").empty();
	$.getJSON(baseUrl + "/API/listtasks",function(data){
		for(var i = 0; i<data.length; i++)
		{
			var html = '';
			html += '<li class="list-item" id="'+ data[i]['id'] +'">';
			html +=	'<div class="col-05">';
			html += '<button class="btn btn-mini btn-success" onclick="finishTask('+data[i]['id']+')"><i class="icon-ok"></i></button></div>';
			html +=	'<div class="col-lg-6" id="desc"><center>'+ data[i]['description'] +'</center></div> ';
			html +=	'<div class="col-lg-2" id="count">';
			for(var a = 0; a< data[i]['pom_completed']; a++)
			{
				html +=	'<i class="icon-leaf" style="color:green"></i>';
			}
			for(var a = 0; a< data[i]['pom_count'] - data[i]['pom_completed']; a++)
			{
				html +=	'<i class="icon-leaf" style="color:grey"></i>';
				minutesLeft += (pomodoroTime + breakTime) / 60;
			}
			html += '</div>';
			
			html +=	'<button onclick="startTimer('+data[i]['id']+')" class="btn btn-mini btn-work">Work on me!</button>';
			html +=	'<button id="delete" class="btn btn-mini" onclick="deleteTask('+data[i]['id']+')"><i class="icon-remove"></i></button>';
			
			html += '</li>';

			$("#sort").append(html);
		}
		if(minutesLeft > 0)
		{
			$("#hours").text(minutesLeft/60);
			$("#total").show();
		}
		
		
	});
	

}

function IsNumeric(input)
{
    return (input - 0) == input && (input+'').replace(/^\s+|\s+$/g, "").length > 0;
}

$("#sPomExpectation").click(function(){
	var desc = $("#pomExpectation").val().replace(/ +/g,'nsbpspace').replace(/#/g,'HASHTAG').trim();
	$.getJSON(baseUrl + "/API/pomExpectation?expectation="+desc,function(data){
		if(data.succes == 'true')
		{
			$("#pomExpectForm").modal('hide');
		}
	});
	return 0;
})

$("#sPomConclusion").click(function(){
	var desc = $("#pomConclusion").val().replace(/ +/g,'nsbpspace').replace(/#/g,'HASHTAG').trim();
	$.getJSON(baseUrl + "/API/pomConclusion?conclusion="+desc,function(data){
		if(data.succes == 'true')
		{
			$("#pomConclusionForm").modal('hide');
		}
	});
	return 0;
})

function focusMode(load)
{
	var speed = 0;
	if(load === true) speed = 0;
	$("#footer").hide();
	if(mode == "pomodoro" && pomActive == 'true')
	{
		$(".task-container").slideUp(speed);
		$("#start").slideUp(speed);
		$(".workingTask").slideDown(speed);
		$("#stop").slideDown(speed);
	}
	if(mode == "pause"){
		$(".task-container").slideDown(speed);
		$("#start").slideDown(speed);
		$("#break").slideUp(speed);
		$("#stop").slideUp(speed);
		$(".workingTask").slideDown(speed);
	}
	if(pomActive == 'false'){
		$(".task-container").slideDown(speed);
		$("#start").slideDown(speed);
		$("#break").slideUp(speed);
		$("#stop").slideUp(speed);
		$(".workingTask").slideUp(speed);
	}
	
	fillText();
}

function fillText()
{

	if(mode == "pomodoro")
	{
		$("#taskId").text(taskId);
		$("#taskName").text(taskName);
		if(taskName == undefined)
			$("#taskName").text("No specific task");
	}
	if(mode == "pause")
		$("#taskName").text("You're on a break, go get a coffee!");

}

$(document).ready(function(){
	checkActive();
	focusMode(true);
	fillTasks();

	function timeCheck()
	{
	if(clock.getTime() <= 0 && pomActive == 'true')
		{
			alert('klaar!');
			$("#pomConclusionForm").show();
			flush();
			clockTicks = false;
		}
		setTimeout(timeCheck, 1000);

	}
	timeCheck();
	if($(".pom-content").css('visibility') == "hidden")
	{
		setTimeout(function() {
		    $(".pom-content").css('visibility','visible');
		    $(".loading").slideUp(500);
		}, 2500);
	}
});
