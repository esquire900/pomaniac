<?php

class APIController extends Controller{
	
	public function actionStart($type, $task_id = null)
	{
		if(Yii::app()->user->isGuest === true) exit(); 
		$p = new Pomodoro();
		$r['succes'] = 'false';
		if($p->isActive() === false)
		{
			$p->user_id = Yii::app()->user->id;
			$p->start_time = time();
			$p->type = $type;
			if($p->save())
			{
				if($task_id === null)
				{
					$r['succes'] = 'true';
				}
				else
				{
					$connect = new TaskHasPomodoro();
					$connect->pom_id = $p->id;
					$connect->task_id = $task_id;
					if($connect->save())
					{
						$r['succes'] = 'true';
					}else{
						$r['succes'] = 'false';
					}
				}
			}

		}	
		echo CJSON::encode($r);	
	}

	public function actionEnd()
	{
		if(Yii::app()->user->isGuest === true) exit(); 
		$p = new Pomodoro();
		if($p->end() === true)
		{
			$r['succes'] = 'true';
		}else{
			$r['succes'] = 'false';
		}
		echo CJSON::encode($r);
		
	}

	public function actionActive()
	{
		if(Yii::app()->user->isGuest === true) exit(); 
		$p = new Pomodoro();
		if($p->isActive() === true)
		{
			$p = Pomodoro::model()->find('user_id = :user_id ORDER BY start_time DESC', array(':user_id' => Yii::app()->user->id));
			$array['id'] = $p->id;
			$array['active'] = 'true';
			$array['type'] = $p->type;
			$array['start_time'] = $p->start_time;
			if($p->type == "pomodoro")
				$array['time_left'] = $p->start_time - time() + 60*25;
			if($p->type == "pause")
				$array['time_left'] = $p->start_time - time() + 60*5;
			$taskLink = TaskHasPomodoro::model()->find('pom_id = :pId', array(':pId' => $p->id));
			if(count($taskLink) != 0)
			{
				$task = Tasks::model()->findByPk($taskLink->task_id);
				$array['task'] = 'true';
				$array['task_id'] = $task->id;
				$array['task_name'] = $task->description;
			}
			echo CJSON::encode($array);
		}else{
			$a['active'] = 'false';
			echo CJSON::encode($a);
		}
		
	}

	public function actionPomExpectation($expectation)
	{
		$model = Pomodoro::model()->find('user_id = :uId order by id ASC', array(':uId' => Yii::app()->user->id));
		$model->expectation = $expectation;
		$model->expectation = str_replace("nsbpspace", ' ', $model->expectation);
		$model->expectation = str_replace("HASHTAG", '#', $model->expectation);
		if($model->save())
			$a['succes'] = 'true';
		else
			$a['succes'] = 'false';
		echo CJSON::encode($a);
	}

	public function actionPomConclusion($conclusion)
	{
		$model = Pomodoro::model()->find('user_id = :uId order by id ASC', array(':uId' => Yii::app()->user->id));
		$model->conclusion = $conclusion;
		$model->conclusion = str_replace("nsbpspace", ' ', $model->conclusion);
		$model->conclusion = str_replace("HASHTAG", '#', $model->conclusion);
		if($model->save())
			$a['succes'] = 'true';
		else
			$a['succes'] = 'false';
		echo CJSON::encode($a);
	}

	public function actionCreateTask($description, $pomCount)
	{
		if(Yii::app()->user->isGuest === true) exit(); 
		$model = new Tasks();
		$model->user_id = Yii::app()->user->id;
		$model->description = $description;
		$model->description = str_replace("nsbpspace", ' ', $model->description);
		$model->description = str_replace("HASHTAG", '#', $model->description);
		$model->pom_count = $pomCount;
		if($model->save())
			$a['succes'] = 'true';
		else
			$a['succes'] = 'false';
		echo CJSON::encode($a);
		
	}

	public function actionUpdateTask($description, $pomCount, $id)
	{
		if(Yii::app()->user->isGuest === true) exit(); 
		$model = Tasks::model()->findByPk($id);
		$model->description = $description;
		$model->pom_count = $pomCount;
		if($model->save())
			$a['succes'] = 'true';
		else
			$a['succes'] = 'false';
		echo CJSON::encode($a);
		
	}

	public function actionDeleteTask($id)
	{
		if(Yii::app()->user->isGuest === true) exit(); 
		$model = Tasks::model()->findByPk($id);
		if($model->user_id != Yii::app()->user->id) exit();
		if($model->delete())
			$a['succes'] = 'true';
		else
			$a['succes'] = 'false';
		echo CJSON::encode($a);
		
	}

	public function actionFinishTask($id)
	{
		if(Yii::app()->user->isGuest === true) exit(); 
		$model = Tasks::model()->findByPk($id);
		$model->finished = true;
		if($model->user_id != Yii::app()->user->id) exit();
		if($model->save())
			$a['succes'] = 'true';
		else
			$a['succes'] = 'false';
		echo CJSON::encode($a);
		
	}

	public function actionListTasks($unfinished = true)
	{
		if(Yii::app()->user->isGuest === true) exit(); 
		$condition = 'user_id = :uId';
		if($unfinished === true)
			$condition .= ' AND finished = 0';
		$m = Tasks::model()->findAll($condition, array(':uId' => Yii::app()->user->id));
		$output = '';
		$c = 0;
		foreach($m as $i=>$a)
		{
			
			$completed = TaskHasPomodoro::model()->findAll(
				'task_id=:tId', 
				array(':tId' => $a->id)
			);
			foreach($completed as $com){
				$ended = Pomodoro::model()->findByPk($com->pom_id);
				if($ended->ended_time == NULL)
					$c ++;
			}
				
			if($output != '') $output .= ",";
			$output .= str_replace("}", '', CJSON::encode($a)).', "pom_completed":"'.$c.'"}';
		}
		echo "[".$output."]";
	}

	public function actionIsLoggedIn()
	{
		if(Yii::app()->user->isGuest === true){
			$a['succes'] = true;
			$a['loggedIn'] = false;
		}else{
			$a['succes'] = true;
			$a['loggedIn'] = true;
			$a['userId'] = Yii::app()->user->id;
		}
		echo CJSON::encode($a);
	}
}
?>
