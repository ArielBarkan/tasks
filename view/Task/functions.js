$(function(){
    var act;
    var id;

    $(document).on("click", "a", function () {
       return false;
    });

    function refreshList(){
        $.ajax({
            url: "Task",
            dataType: 'json',
            type: 'post',
            data: 'act=list',
            success: function(result){
                if(result.msg)
                    alert(result.msg);
                else{
                    $('.fetchList').html('');
                    if(result.list.length == 0){
                        $('.fetchList').append('<tr><td colspan="5">There are no tasks.</td></tr>');
                    }

                    for(i in result.list){
                        $('.fetchList').append(
                            '<tr>'
                            +'<td class="id">'+result.list[i]['id']+'</td>'
                            +'<td class="name">'+result.list[i]['name']+'</td>'
                            +'<td class="date">'+result.list[i]['date']+'</td>'
                            +'<td class="desc" style="display: none">'+result.list[i]['desc']+'</td>'
                            +'<td class="status" style="display: none">'+result.list[i]['status']+'</td>'
                            +'<td><a class="edit" href="">Edit</a> / <a class="del" href="">Delete</a></td>'
                            +'<td></td>'
                            +'</tr>')
                    }
                }
            },
            error: function(result){
                alert('There was an error, please try again later');
            },
        });
    }
    refreshList();

    function refreshTotal(){
        $.ajax({
            url: "Task",
            dataType: 'json',
            type: 'post',
            data: 'act=total',
            success: function(result){
                if(result.msg)
                    alert(result.msg);
                else{
                    $('.total.count .data').text(result.total.count);
                    $('.total.completed .data').text(result.total.completed);
                    $('.total.remaining .data').text(result.total.remaining);
                }
            },
            error: function(result){
                alert('There was an error, please try again later');
            },
        });
    }
    refreshTotal();

    $('.create').on('click',function(){
        act = 'create';

        $('.task .title').text('Create New Task');
        $('.task').fadeIn();
        $('.task input[name=title]').removeAttr('disabled');
        $('.task input').val('');
        $('.task textarea').val('');
    });

    $(document).on("click", ".edit", function() {
        act = 'edit';
        var taskDetails = $(this).parent().parent();
        id = taskDetails.find('.id').text();

        $('.task .title').text('Edit Task');
        $('.task input[name=title]').attr('disabled','disabled').val(taskDetails.find('.name').text());
        $('.task textarea[name=desc]').text(taskDetails.find('.desc').text());
        $('.task select option[value='+taskDetails.find('.status').text()+']').attr('selected');
        $('.task select').val(taskDetails.find('.status').text()).trigger('change');

        $('.task').fadeIn();
    });

    $(document).on("click", ".del", function() {
        var taskDetails = $(this).parent().parent();
        id = taskDetails.find('.id').text();

        if (window.confirm("Are you sure?")) {
            $.ajax({
                url: "Task",
                dataType: 'json',
                type: 'post',
                data: 'act=del&id='+id,
                success: function(result){
                    $('.task').fadeOut();

                    if(result.status == 1){
                        taskDetails.remove();
                        refreshList();
                        refreshTotal();
                    }
                    alert(result.msg);
                },
                error: function(result){
                    alert('There was an error, please try again later');
                },
            });

        }

    });

    $('form').on('submit',function(){
        var name = $('.task input[name=title]').val();
        var desc = $('.task textarea[name=desc]').val();
        var status = $('.task select[name=status]').val();

        $.ajax({
            url: "Task",
            dataType: 'json',
            type: 'post',
            data: 'act='+act+'&id='+id+'&name='+name+'&desc='+desc+'&status='+status,
            success: function(result){
                $('.task').fadeOut();

                alert(result.msg);
                refreshList();
                refreshTotal();
            },
            error: function(result){
                alert('There was an error, please try again later');
            },
        });
        return false;
    });

});