$(function(){

    $('a').on('click',function(){
       return false;
    });
    //todo: if edit disable title, revert if create
    //todo: json only
    //todo: alerts
    //todo: in php, if edit can't change title

    $('.create').on('click',function(){
        $('.task .title').text('Create New Task');
        $('.task').show();
        $('input[name=title]').removeAttr('disabled');
    });

    $('.edit').on('click',function(){
        var taskDetails = $(this).parent().parent();
        $('.task .title').text('Edit Task');
        $('.task').show();
        $('.task input[name=title]').attr('disabled','disabled').val(taskDetails.find('.name').text());
        $('.task textarea[name=desc]').text(taskDetails.find('.desc').text());
        $('.task select option[value='+taskDetails.find('.status').text()+']').attr('selected');
        $('.task select').val(taskDetails.find('.status').text()).trigger('change');
    });


    //todo: on ajax change selected

   /* $('.filter').on('click',function(){

        $.ajax({
            url: "Task",
            dataType: 'json',
            type: 'post',
            data: $('.task form').serialize(),
            success: function(result){
                if(!result.check){
                    console.log(result);
                    $(".result").html('Error: '+result.error);
                }
                else{
                    if(!result.data.length){
                        html = 'No results.';
                    }
                    else{
                        html = '';
                        html +='<table>';
                        html +='<tr><th>Date</th><th>Successfully sent</th><th>Faild</th></tr>';
                        for(i in result.data){
                            html +='<tr><td>'+result.data[i]['date']+'</td><td>'+result.data[i]['success']+'</td><td>'+result.data[i]['failed']+'</td></tr>';
                        }
                        html +='</table>';
                    }

                    $(".result").html(html);
                }

            }});

        return false;
    });*/


});