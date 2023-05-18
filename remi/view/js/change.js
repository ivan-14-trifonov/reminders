jQuery(function ($) {
    $('form[name="addForm"]').submit(function (e) {
        e.preventDefault();
        empty = ($('textarea[name="text"]').val()=="") || ($('input[name="date"]').val()=="") || ($('input[name="time"]').val()=="") || ($('select[name="period"]').val()=="");
        if(empty) {
            alert('Необходимо заполнить все поля!');
        } else {
            change();
        }
    });
})

function change() {
    
    let data = $('form[name="addForm"]').serialize();
    if ($('input[type="submit"]').attr('name') == 'add') {
        data = data + "&change=add";
    }
    if ($('input[type="submit"]').attr('name') == 'edit') {
        data = "id=" + $('div[name="id"]').attr('value') + "&" + data + "&change=edit";
    }
    
    $.ajax({
        type: "POST",
        url: "/../remi/public/remi.php",
        data: data,
        dataType: 'html',
        success: callback
    });
    
    $('.pop-up-container').hide(0);
    $('.pop-up').hide(0);
}

$('.button-delete').click(function() {
    let result;
    result = confirm('Вы действительно хотите удалить напоминание? Отменить это действие будет невозможно.');
    
    if (result) {
        let id = $(this).attr('value');
        let data = "id=" + id + "&change=delete";
    
        $.ajax({
            type: "POST",
            url: "/../remi/public/remi.php",
            data: data,
            dataType: 'html',
            success: callback
        });
    }
});

function callback(response) {
    $("#message").empty();
    $("#message").append(response);
}