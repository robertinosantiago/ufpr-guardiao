var server = location.protocol + '//' + location.host + '/ufpr-guardiao';

$('#bt-adiciona-papel').on('click', function() {
	var sistema_id = $('#SistemaId').val();
	var papel_id = $('#SistemaPapel').val();
	if (papel_id && sistema_id) {
		$.ajax({
			method: 'POST',
			url: server + '/Sistemas/adicionaPapel',
			data: {
				sistemaId: sistema_id,
				papelId: papel_id
			},
			dataType: 'json'
		})
		.done(function(data) {
			$('#SistemaPapels').empty();
			var options = '';
			$.each(data, function(key, value) {
				options += '<option value="' + key + '">' + value + '</option>';
			});
			$('#SistemaPapels').html(options);
		})
		.fail(function(data){
			alert('Não foi possível associar este Papel ao Sistema atual');
		})
		.always(function(data){
			
		});
	}
});

$('#bt-remove-papel').on('click', function() {
	var papel_id = $('#SistemaPapels').val();
	var sistema_id = $('#SistemaId').val();
	if (papel_id && sistema_id) {
		$.ajax({
			method: 'POST',
			url: server + '/Sistemas/removePapel',
			data: {
				sistemaId: sistema_id,
				papelId: papel_id
			},
			dataType: 'json'
		})
		.done(function(data){
			$('#SistemaPapels').empty();
			var options = '';
			$.each(data, function(key, value) {
				options += '<option value="' + key + '">' + value + '</option>';
			});
			$('#SistemaPapels').html(options);
		})
		.fail(function(data){
			alert('Não foi possível remover este Papel do Sistema atual');
		})
		.always(function(data){
			
		});
	}
});