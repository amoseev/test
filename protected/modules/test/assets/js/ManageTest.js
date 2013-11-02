(function(){
$(document).ready(function () {	


//при постороении теста.
        $( document ).on( "click", ".delete-question", function(event) {
            event.preventDefault();
            $(this).closest('.qa-form').remove();
        });   

        $( document ).on( "click", "#add-questions", function(event) {
            event.preventDefault();

            var number_questions=parseInt($('#qa-count-for-add-by-template').val());
            if(number_questions<1)return;
            var max_number= parseInt( $('#qa-field').attr('max_number_question'));
            $('#qa-field').attr('max_number_question',max_number+number_questions);
            var td_action_delete = $('<a class="delete delete-question" rel="tooltip"  href="#" data-original-title="Удалить вопрос" ><i class="icon-trash"></i></a>');
            for(var i=max_number+1;i<=max_number+number_questions;i++){

                var form_qa=$('#template-qa-field').clone();
                var t=form_qa.removeAttr('id').removeClass().addClass('qa-form');               
            
                t.find('.answer-table').attr('question_number',i);
                t.find("textarea[name^='Question']").attr('name','Question'+'['+i+']');
                t.find('input').each(function(ind){
                    if($(this).hasClass('a-response') || $(this).hasClass('a-score')){
                        var str = $(this).attr('name');
                        var new_str=str.replace('q_number',i);
                        $(this).attr('name',new_str);
                    }               
                }); 
                t.find('label:first-child').prepend(td_action_delete.clone()).append('  # '+i );
                $('#qa-field').append(t);
            }
            //;



        });


        $( document ).on( "click", ".delete-answer-row, .delete-key-row", function(event) {
            event.preventDefault();
            $(this).closest('tr').remove(); ;
        });
        //keys
		$( document ).on( "click", ".add-key", function(event) {
            var key_number=1+parseInt($(this).closest('.keys-table').attr('max_key_number')) ;
            $(this).closest('.keys-table').attr('max_key_number',key_number);
            var new_tr = $('<tr></tr>').attr('key_number',key_number);
            var td_bottom = $('<td></td>');
            var td_bottom_inp = $('<input></input>').addClass('span1 bottom_val').attr('name','Key'+'['+key_number+']'+'[bottom_val]').attr('type','number');
            td_bottom.append(td_bottom_inp);
            var td_top= $('<td></td>');
            var td_top_inp = $('<input></input>').addClass('span1 top_val').attr('name','Key'+'['+key_number+']'+'[top_val]').attr('type','number');
            td_top.append(td_top_inp);            
            var td_text = $('<td></td>');
            var td_text_inp = $('<textarea></textarea>').addClass('span6 description').attr('name','Key'+'['+key_number+']'+'[description]').attr('rows','3').attr('cols','30');
            td_text.append(td_text_inp);              
            var td_action = $('<td></td>');
            var td_action_inp = $('<a class="delete delete-key-row" rel="tooltip"  href="#" data-original-title="Удалить" ><i class="icon-trash"></i></a>');
            td_action.append(td_action_inp);  
            new_tr.append(td_bottom);
            new_tr.append(td_top);
            new_tr.append(td_text);
            new_tr.append(td_action);
            $(this).closest('.keys-table').append(new_tr);
    	});	    
//answers
        $( document ).on( "click", ".add-answer", function(event) {
            var a_number=1+parseInt($(this).closest('.answer-table').attr('max_answer_number')) ;
            $(this).closest('.answer-table').attr('max_answer_number',a_number);
            var template=$(this).closest('#template-qa-field');
            if(template.length>0){//шаблон
                var new_tr = $('<tr></tr>').attr('a_number',a_number);
                var td_response = $('<td></td>');  
                var td_response_inp = $('<input></input>').addClass('span6 a-response').attr('name','Answer'+'[q_number]'+'['+a_number+']'+'[response]').attr('type','text');
                td_response.append(td_response_inp);
                var td_score= $('<td></td>');
                var td_score_inp = $('<input></input>').addClass('span1 a-score').attr('name','Answer'+'[q_number]'+'['+a_number+']'+'[score]').attr('type','number');
                td_score.append(td_score_inp);                       
                var td_action = $('<td></td>');
                var td_action_inp = $('<a class="delete delete-answer-row" rel="tooltip"  href="#" data-original-title="Удалить" ><i class="icon-trash"></i></a>');
                td_action.append(td_action_inp);     
            }else{//не шаблон
                var q_number=parseInt($(this).closest('.answer-table').attr('question_number'));
                var new_tr = $('<tr></tr>').attr('a_number',a_number);
                var td_response = $('<td></td>');  
                var td_response_inp = $('<input></input>').addClass('span6 a-response').attr('name','Answer'+'['+q_number+']'+'['+a_number+']'+'[response]').attr('type','text');
                td_response.append(td_response_inp);
                var td_score= $('<td></td>');
                var td_score_inp = $('<input></input>').addClass('span1 a-score').attr('name','Answer'+'['+q_number+']'+'['+a_number+']'+'[score]').attr('type','number');
                td_score.append(td_score_inp);                       
                var td_action = $('<td></td>');
                var td_action_inp = $('<a class="delete delete-answer-row" rel="tooltip"  href="#" data-original-title="Удалить" ><i class="icon-trash"></i></a>');
                td_action.append(td_action_inp);     
//*/
            }
            new_tr.append(td_response);
            new_tr.append(td_score);
            new_tr.append(td_action);
            $(this).closest('.answer-table').append(new_tr); // */
            
        });   
        
       
    });
 })() 