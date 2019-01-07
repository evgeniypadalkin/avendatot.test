
function addItem() {
    $('[name="title"]').val('');
    $('[name="text"]').val('');
    $('[name="item_id"]').val('');
    $('#newsModal').modal('show');
}

function editItem(id) {
    $('#newsModal').modal('show');

    $.ajax({
        url: '/news/get',
        type: 'post',
        dataType: 'json',
        data: 'id='+id,

        success: function(json) {

            if(json['error'] === undefined) {
                $('[name="title"]').val(json['title']);
                $('[name="text"]').val(json['text']);
                $('[name="item_id"]').val(json['id']);
            } else {
                alert(json['error']);
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

function deleteItem(id) {
    $.ajax({
        url: '/news/delete',
        type: 'post',
        dataType: 'json',
        data: 'id='+id,

        success: function(json) {

            if(json['error'] === undefined) {
                $('.row-'+id).remove();

                if($('.news-container .row').length == 0) {
                    $('[data-page="1"]').click();
                    $('.paginate').html(json['paginate']);
                }
            } else {
                alert(json['error']);
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

$(document).on('submit','form',function (e) {
    e.preventDefault();

    let data = {
        'id': $('[name="item_id"]').val(),
        'title': $('[name="title"]').val(),
        'text': $('[name="text"]').val()
    };

    let url = '/news/edit';
    if(data.id === '') {
        url = '/news/add';
    }

    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: data,

        success: function(json) {
            if(json['error'] === undefined) {

                if(data.id === '' && json['id']) {
                    let html = '';

                    html += '<div class="row row-'+json['id']+' news-row">';
                    html += '    <div class="col-3 title">';
                    html +=         data.title;
                    html += '    </div>';
                    html += '    <div class="col-6 text">';
                    html +=         data.text;
                    html += '    </div>';
                    html += '    <div class="col-3">';
                    html += '        <button onclick="editItem('+json['id']+')" type="button" class="btn btn-outline-primary">Edit</button>';
                    html += '        <button onclick="deleteItem('+json['id']+')" type="button" class="btn btn-outline-danger">Delete</button>';
                    html += '    </div>';
                    html += '</div>';

                    $('.news-container').prepend(html);
                    $('.paginate').html(json['paginate']);

                    if($('.news-row').length > 10) {
                        $('.news-row').last().remove();
                    }

                } else {
                    $('.row-'+$('[name="item_id"]').val()+' .title').html(data.title);
                    $('.row-'+$('[name="item_id"]').val()+' .text').html(data.text);
                }

            } else {
                alert(json['error']);
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });

    $('#newsModal').modal('hide');
});

$(document).on('click','a',function (e) {
    e.preventDefault();

    let data = {
        'page': $(this).attr('data-page'),
        'limit': 10,
    };

    $.ajax({
        url: 'news',
        type: 'post',
        dataType: 'json',
        data: data,

        success: function(json) {
            if(json['error'] === undefined) {


                $('.news-container .row').remove();

                for(let i in json['news']){

                    let item = json['news'][i];
                    html = '';
                    html += '<div class="row row-'+item['id']+' news-row">';
                    html += '    <div class="col-3 title">';
                    html +=         item['title'];
                    html += '    </div>';
                    html += '    <div class="col-6 text">';
                    html +=         item['text'];
                    html += '    </div>';
                    html += '    <div class="col-3">';
                    html += '        <button onclick="editItem('+item['id']+')" type="button" class="btn btn-outline-primary">Edit</button>';
                    html += '        <button onclick="deleteItem('+item['id']+')" type="button" class="btn btn-outline-danger">Delete</button>';
                    html += '    </div>';
                    html += '</div>';

                    $('.paginate').before(html);
                }

            } else {
                alert(json['error']);
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });

});