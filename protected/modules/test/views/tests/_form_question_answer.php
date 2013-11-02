                      <tr a_number="<?php echo $numberA ?>">
                        <td><input class="span6 a-response" name="Answer[<? echo $numberQ ?>][<?php echo $numberA ?>][response]" type="text" value="<?php echo Chtml::encode($answer["response"]) ?>"></td>
                        <td><input class="span1 a-score" name="Answer[<? echo $numberQ ?>][<?php echo $numberA ?>][score]" type="number" value="<?php echo Chtml::encode($answer["score"]) ?>"></td>
                        <td><a class="delete delete-answer-row" rel="tooltip" href="#" data-original-title="Удалить"><i class="icon-trash"></i></a></td>
                      </tr>