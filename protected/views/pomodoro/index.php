<script type='text/javascript' > 
// used by 2 javascripts downstairs
	baseUrl = "<?php echo Yii::app()->request->baseUrl; ?>";
</script>
<div class="clearme" style="height:50px;"></div>
<div class="loading">
	<center><div id="loaderImage"></div></center>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading-image/preloader_JS.js"></script>
</div>
<div class="row pom-content" style="visibility:hidden">
	<div class="col-lg-5 center"  class="clock-container">
		<div class="workingTask">
			<span class="hidden" id="taskId"></span>
			<span class="name" id="taskName"></span>
		</div>
		<div class="clock"></div>
	</div>

	<br/><br/><br/><br/><br/><br/>


	<div class="col-lg-6 center buttons-container" >	
		<center>
			<button id="start" class="btn btn-success btn-large">Start</button>
			<button id="break" class="btn btn-default btn-large">Take a break</button>
			<button id="stop" class="btn btn-warning btn-large">Stop!</button>
		</center>
	</div>

	<br/><br/><br/><br/><br/><br/>

	<div class="modal fade" id="pomExpectForm">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">What do you expect from this pomodoro?</h4>
	      </div>
	      <div class="modal-body">
	        <textarea type="text" class="form-control" id="pomExpectation" placeholder="What is your expectation (in very short)" style="width:100%"></textarea>		
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close (autocloses in 20)</button>
	        <button class="btn btn-work" id="sPomExpectation" style="width:300px">Submit</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


	<div class="modal fade" id="pomConclusionForm">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">How did it go??</h4>
	      </div>
	      <div class="modal-body">
			<textarea type="text" class="form-control" id="pomConclusion" placeholder="What is your conclusion (in very short)" style="width:100%"></textarea>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close (autocloses in 20)</button>
			<button class="btn btn-work" id="sPomConclusion" style="width:300px">Submit</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


	<div class="task-container">
		<div class="col-lg-8 center">	
			<ul id="sort">
			</ul>
		</div>

		<div class="col-lg-8 center"  style="padding-left:60px">
			<form class="form-inline">
				<div id="addErrors"></div>
				<input type="text" class="form-control" id="taskDescription" placeholder="Decription" style="width:265px">
				<input type="text" class="form-control" id="taskCount" placeholder="# of Pomodoro's" style="width:95px">
				<button id="sAdd" type ="button" onclick="" class="btn btn-default" style="width:90px" >Add</button>
			</form>
			<div id="total">Hours of tasks ahead: <span id="hours"></span></div>
		</div>
	</div>
</div>



<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/flipclock/js/flipclock/libs/prefixfree.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/flipclock/js/flipclock/flipclock.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/pom.js" language="javascript"></script>