$('.pop-up').hide(0);
$('.pop-up-container').hide(0);

$('.button-add').click(function(){
    $('input[name="date"]').val(moment().format('YYYY-MM-DD'));
    $('input[name="time"]').val(moment().format('HH:mm'));
    $('input[type="submit"]').attr('name', 'add');
    $('input[type="submit"]').attr('value', 'Создать');
    $('.pop-up-container').show(0);
    $('.pop-up').fadeIn(300);
});
$('.pop-up span').click(function() {
    $('.pop-up-container').hide(0);
    $('.pop-up').hide(0);
});
$('.button-edit').click(function(){
    let id = $(this).attr('value');
    $('div[name="id"]').attr('value', id);
    $('textarea[name="text"]').val($('p[name="text_' + id + '"]').text());
    $('input[name="date"]').val($('p[name="time_' + id + '"]').text().slice(0, 10));
    $('input[name="time"]').val($('p[name="time_' + id + '"]').text().slice(11));
    $('select[name="period"]').val($('p[name="repeat_' + id + '"]').attr('value'));
    $('input[type="submit"]').attr('name', 'edit');
    $('input[type="submit"]').attr('value', 'Сохранить изменения');
    $('.pop-up-container').show(0);
    $('.pop-up').fadeIn(300);
});