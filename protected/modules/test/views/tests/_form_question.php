<div class="qa-form">
    <label>
    <?php echo CHTML::link("<i class='icon-trash'></i>","#",array('class' => 'delete delete-question','rel'=>'tooltip','data-original-title'=>'Удалить вопрос'))  ;?>
    <?php   $numberQpl1=$numberQ+1;
            echo CHtml::encode('Вопрос # '."$numberQpl1");
    ?>
    </label>
    <label>Варианты ответов:</label>
    <?php echo CHTML::textArea("Question[$numberQpl1]",$question["statement"],array('class'=>'span8','maxlength'=>64,  )); ?>
    <table class="table table-bordered table-condensed answer-table" max_answer_number="1" question_number="<? echo CHtml::encode($numberQpl1);  ?>">
        <thead>
            <tr>
                <td>Вариант ответа     <button class="btn btn-mini btn-primary add-answer" type="button">Добавить</button>     </td>
                <td>Балл</td>
                <td>Действия</td>
            </tr>
        </thead>
        <tbody>
            <?php
                    foreach($question["answers"] as $numberA=>$answer){
                        echo $this->renderPartial('_form_question_answer', array('answer'=>$answer,'numberA'=>$numberA,'form'=>$form,'numberQpl1'=>$numberQpl1));
                    }
            ?>
        </tbody>
    </table>
</div>