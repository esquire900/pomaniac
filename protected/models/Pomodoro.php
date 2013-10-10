<?php

/**
 * This is the model class for table "pomodoro".
 *
 * The followings are the available columns in table 'pomodoro':
 * @property integer $id
 * @property integer $user_id
 * @property integer $start_time
 * @property string $type
 */
class Pomodoro extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pomodoro the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pomodoro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, start_time, type', 'required'),
			array('user_id, start_time, ended_time', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>8),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, start_time, type', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'start_time' => 'Start Time',
			'type' => 'Type',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('start_time',$this->start_time);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function isActive()
	{
		$model = Pomodoro::model()->find('user_id = :user_id ORDER BY start_time DESC', array(':user_id' => Yii::app()->user->id));
		if(count($model) == 0) return false;
		if($model->ended_time != null) return false;
		if($this->timeLeft($model->start_time, $model->type) > 0 AND $model->type="pomodoro")
			return true;
		if($this->timeLeft($model->start_time, $model->type) > 0 AND $model->type="pause")
			return true;

		return false;
	}

	public function start($type)
	{
		$p = new Pomodoro();
		if(!$p->isActive())
		{
			$p->user_id = Yii::app()->user->id;
			$p->start_time = time();
			$p->type = $type;
			if($p->save())
				return true;
			else
				return false;
		}
	}

	public function end()
	{
		$p = new Pomodoro();
		if($p->isActive())
		{
			$model = Pomodoro::model()->find('user_id = :user_id ORDER BY start_time DESC', array(':user_id' => Yii::app()->user->id));
			if($this->timeLeft($model->start_time, $model->type) < 0)
				return true;
			$model->ended_time = time();
			if($model->save())
				return true;
		}
		return false;
	}

	public function timeLeft($start, $type)
	{
		$left = 0;
		if($type == "pomodoro")
			$left = $start - time() + 60*25;
		if($type == "pause")
			$left = $start - time() + 60*5;
		return $left;
	}
}