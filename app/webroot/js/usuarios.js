var server = location.protocol + '//' + location.host + '/ufpr-guardiao';

$(document).ready(function(){
	var nivel_id = $('#SistemaNivels').val();
	var papel_id = $('#SistemaPapels').val();
	var sistema_id = $('#SistemaId').val();
	if (nivel_id && papel_id && sistema_id) {
		atualizaListaUsuarios('atualizaNivelPapelSistemaUsuario', nivel_id, papel_id, sistema_id);
	}
});

/**
 * Renderiza a listagem de usuários associados a Papéis,
 * Níveis de Acesso e Sistema
 * @todo A listagem dever ser organizada por ordem alfabética
 * @param data
 */
function renderizaListagem(data) {
	$('#SistemaNivelPapelSistemaUsuarios').empty();
	var options = '';
	$.each(data, function(key, value) {
		options += '<option value="' + key + '">' + value + '</option>';
	});
	$('#SistemaNivelPapelSistemaUsuarios').html(options);
}

/**
 * Atualiza a listagem de Usuários quando os selects de
 * Nível de acesso e Papel são alterados
 * @param url
 * @param nivel_id
 * @param papel_id
 * @param sistema_id
 */
function atualizaListaUsuarios(url, nivel_id, papel_id, sistema_id) {
	$.ajax({
		method: 'POST',
		url: server + '/Sistemas/'+url,
		data: {
			nivelId: nivel_id,
			papelId: papel_id,
			sistemaId: sistema_id,
		},
		dataType: 'json'
	})
	.done(function(data) {
		renderizaListagem(data);
	})
	.fail(function(data){
		alert('Não foi possível carregar a página');
	})
	.always(function(data){
		
	});
}

/**
 * Permite adicionar ou remover Usuários a um Sistema de acordo
 * com o Nível de Acesso e o Papel
 * @param url
 * @param nivel_id
 * @param papel_id
 * @param sistema_id
 * @param usuarios
 */
function manipulaUsuariosListagem(url, nivel_id, papel_id, sistema_id, usuarios) {
	$.ajax({
		method: 'POST',
		url: server + '/Sistemas/'+url,
		data: {
			nivelId: nivel_id,
			papelId: papel_id,
			sistemaId: sistema_id,
			usuariosIds: usuarios
		},
		dataType: 'json'
	})
	.done(function(data) {
		renderizaListagem(data);
	})
	.fail(function(data){
		alert('Não foi possível carregar a página');
	})
	.always(function(data){
		
	});
}

$('#SistemaNivels').on('change', function(){
	var nivel_id = $('#SistemaNivels').val();
	var papel_id = $('#SistemaPapels').val();
	var sistema_id = $('#SistemaId').val();
	if (nivel_id && papel_id && sistema_id) {
		atualizaListaUsuarios('atualizaNivelPapelSistemaUsuario', nivel_id, papel_id, sistema_id);
	}
});

$('#SistemaPapels').on('change', function() {
	var nivel_id = $('#SistemaNivels').val();
	var papel_id = $('#SistemaPapels').val();
	var sistema_id = $('#SistemaId').val();
	if (nivel_id && papel_id && sistema_id) {
		atualizaListaUsuarios('atualizaNivelPapelSistemaUsuario', nivel_id, papel_id, sistema_id);
	}
});

$('#bt-adicionar-usuario').on('click', function() {
	var nivel_id = $('#SistemaNivels').val();
	var papel_id = $('#SistemaPapels').val();
	var sistema_id = $('#SistemaId').val();
	var usuarios = $('#SistemaUsuarios').val() || [];
	if (nivel_id && papel_id && sistema_id && usuarios.length) {
		manipulaUsuariosListagem('adicionaNivelPapelSistemaUsuario',nivel_id, papel_id, sistema_id, usuarios);
	}
});

$('#bt-remover-usuario').on('click', function() {
	var nivel_id = $('#SistemaNivels').val();
	var papel_id = $('#SistemaPapels').val();
	var sistema_id = $('#SistemaId').val();
	var usuarios = $('#SistemaNivelPapelSistemaUsuarios').val() || [];
	if (nivel_id && papel_id && sistema_id && usuarios.length) {
		manipulaUsuariosListagem('removeNivelPapelSistemaUsuario',nivel_id, papel_id, sistema_id, usuarios);
	}
});

