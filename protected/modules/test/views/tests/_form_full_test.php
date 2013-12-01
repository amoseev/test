<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tests-form',
	'enableAjaxValidation'=>false,
   /* 'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),*/
)); ?>

    <?php //скрипт для работы с тестом на клиенте
    Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('test.assets')).'/js/ManageTest.js' , CClientScript::POS_HEAD); ?>

	<p class="help-block">Поля, отмеченные <span class="required">*</span>, обязательны для заполнения</p> 

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'category',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->dropDownListRow($model,'statuse',array('1'=>'enable','0'=>'disable'),array('class'=>'span5')); ?>

<hr />
<? $countQuestions = count($model->listQuestions); ?>

<h5>Вопросы к тесту:</h5>
<div id="qa-field" max_number_question="<?php echo $countQuestions ?>">
      <?php foreach($model->listQuestions as $numberQ=>$question){
                echo $this->renderPartial('_form_question', array('question'=>$question,'numberQ'=>$numberQ,'form'=>$form));
            }
      ?>
</div>

<br />
	   <hr />

        <div class="form-actions">
        <strong>Шаблон вопроса:</strong>
        <div id="template-qa-field">
                <label>Вопрос</label>
                <textarea rows="2" cols="50" class="span8" name="Questions[<? echo $countQuestions; ?>]"></textarea>
                <label>Варианты ответов:</label>
                <table class="table table-bordered table-condensed answer-table" max_answer_number="1" question_number="<? echo $countQuestions; ?>">
                <thead>
                  <tr>
                    <td>Вариант ответа     <button class="btn btn-mini btn-primary add-answer" type="button">Добавить</button></td>
                    <td>Балл</td>
                    <td>Действия</td>
                  </tr>
                </thead>
                  <tr a_number="0">
                    <td><input class="span6 a-response" name="Answer[q_number][0][response]" type="text" value=""></input></td>
                    <td><input class="span1 a-score" name="Answer[q_number][0][score]" type="number" value=""></input></td>
                    <td><a class="delete delete-answer-row" rel="tooltip" href="#" data-original-title="Удалить"><i class="icon-trash"></i></a></td>
                  </tr>
                  <tr a_number="1">
                    <td><input class="span6 a-response" name="Answer[q_number][1][response]" type="text" value=""></input></td>
                    <td><input class="span1 a-score" name="Answer[q_number][1][score]" type="number" value=""></input></td>
                    <td><a class="delete delete-answer-row" rel="tooltip" href="#" data-original-title="Удалить" ><i class="icon-trash"></i></a></td>
                  </tr>
                </table>
         </div>
        <label for="qa-count-for-add-by-template">Добавить количество вопросов по шаблону</label>
        <input class="span2" type="number" id="qa-count-for-add-by-template" value="1"></input>
        <br />
        <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type'=>'primary',
			'label'=>'Добавить',
            'htmlOptions'   => array('id'=> 'add-questions'),
		)); ?>
        </div>
       

        <hr />
        
        <label><strong> Ключи к тесту:</strong></label>
            <div id="keys-field"></div>
                <table class="table table-bordered table-condensed keys-table" max_key_number="<? $max_key_number = count($model->listKeys)-1;  echo $max_key_number ?>">
                <thead>
                  <tr>
                    <td>Минимальный балл</td>
                    <td>Максимальный балл    </td>
                    <td>Описание <button class="btn btn-mini btn-primary add-key" type="button">Добавить</button></td>
                    <td>Действия</td>
                  </tr>
                </thead>
                    <tbody>
                        <?php  foreach($model->listKeys as $numberK=>$key){
                                   echo $this->renderPartial('_form_key', array('key'=>$key,'numberK'=>$numberK,'form'=>$form));
                               }
                        ?>
                    </tbody>
                </table>


 	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
   </div>
<?php $this->endWidget(); ?>

