/**
 * 
 */

$('#checkall').on('change', function() {
	var checked = $('#checkall').is(':checked');
	$('input.ids').each(function() {
		$(this).prop('checked', checked);
	});
});

$('#formindex').submit(function (event) {
    var marcou = false;
    $('input.ids').each(function () {
        if (this.checked) {
            marcou = true;
        }
    });

    if (marcou) {
        if (confirm('Deseja realmente excluir?')) {
            return true;
        }
    }
    event.preventDefault();
    return false;
});