var server = 'http://localhost/ufpr-guardiao';

$('#bt-adiciona-nivel').on('click', function() {
	var sistema_id = $('#SistemaId').val();
	var nivel_id = $('#SistemaNivel').val();
	if (nivel_id && sistema_id) {
		$.ajax({
			method: 'POST',
			url: server + '/Sistemas/adicionaNivel',
			data: {
				sistemaId: sistema_id,
				nivelId: nivel_id
			},
			dataType: 'json'
		})
		.done(function(data) {
			$('#SistemaNivels').empty();
			var options = '';
			$.each(data, function(key, value) {
				options += '<option value="' + key + '">' + value + '</option>';
			});
			$('#SistemaNivels').html(options);
		})
		.fail(function(data){
			alert('Não foi possível associar este Nivel ao Sistema atual');
		})
		.always(function(data){
			
		});
	}
});

$('#bt-remove-nivel').on('click', function() {
	var nivel_id = $('#SistemaNivels').val();
	var sistema_id = $('#SistemaId').val();
	if (nivel_id && sistema_id) {
		$.ajax({
			method: 'POST',
			url: server + '/Sistemas/removeNivel',
			data: {
				sistemaId: sistema_id,
				nivelId: nivel_id
			},
			dataType: 'json'
		})
		.done(function(data){
			$('#SistemaNivels').empty();
			var options = '';
			$.each(data, function(key, value) {
				options += '<option value="' + key + '">' + value + '</option>';
			});
			$('#SistemaNivels').html(options);
		})
		.fail(function(data){
			alert('Não foi possível remover este Nivel do Sistema atual');
		})
		.always(function(data){
			
		});
	}
});