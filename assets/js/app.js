$(document).ready(function(){

    loadList();

    $("#add_log").submit(function(e){
        e.preventDefault();

        var form = $(this);

        $.post(base_url+'/api/save', form.serializeArray(), function(data){
            if(data.status  == 'saved'){
                form[0].reset();
                loadList();
            }else{
                alert(data.status);
            }
        });
    });

    $(document).on('click', '.pag-link', function(e){
        e.preventDefault();

        location.hash = "#pg=" + $(this).attr('href');

        loadList();
    });

    function loadList()
    {

        var page = /\bpg=(\d+)\b/.test(location.hash) ? parseInt(RegExp.$1) : 1;

        $.post(base_url+'/api/get', {'page': page}, function(data){
            if(data.items){
                $(".content-list").html('');

                $.each(data.items, function(k, v){
                   createTable(v);
                });

                createPagination(data);
            }else{
                $(".content-list").html('<h3>Empty...</h3>');
            }
        });
    }

    function createTable(data)
    {
        if(data.items){
            var container = $('<div class="log-group">').append('<h3>'+data.title+'</h3>');

            var table = $("<table>").append('<tr>' +
                '<th>Description</th>' +
                '<th>Time spent</th>' +
                '<th>Date</th>' +
                '</tr>');

            $.each(data.items, function(k, v){
                table.append('<tr>' +
                    '<td>'+v.description+'</td>' +
                    '<td>'+v.time+'</td>' +
                    '<td>'+v.readable_created_at+'</td>' +
                    '</tr>');
            });

            container.append(table);

            $(".content-list").append(container);
        }
    }

    function createPagination(data)
    {
        if(data.total_pages > 1) {
            var current = parseInt(data.current_page);
            var container = $('.content-list');
            var list = $('<ul class="pagination">');

            for (i = 1; i <= data.total_pages; i++) {
                list.append('<li ' + ((i == current) ? 'class="active"' : '') + '><a href="' + i + '" class="pag-link">' + i + '</a></li>');
            }

            container.append(list);
        }

    }

});