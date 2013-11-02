                   <tr key_number="<?php echo $numberK ?>">
                    <td><input class="span1 bottom_val" name="Key[<?php echo $numberK ?>][bottom_val]" type="number" value="<?php echo Chtml::encode($key["bottom_val"]) ?>"></input></td>
                    <td><input class="span1 top_val" name="Key[<?php echo $numberK ?>][top_val]" type="number" value="<?php echo Chtml::encode($key["top_val"]) ?>"></input></td>
                    <td><textarea rows="3" cols="30" class="span6 description" name="Key[<?php echo $numberK ?>][description]"><?php echo Chtml::encode($key["description"]) ?></textarea></td>
                    <td><a class="delete delete-key-row" rel="tooltip" href="#" data-original-title="Удалить" ><i class="icon-trash"></i></a></td>
                  </tr>