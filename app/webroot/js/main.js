$(function() {
  $('#side-menu').metisMenu();
  
  var liLevel1 = Cookies.get('liLevel1');
  var liLevel2 = Cookies.get('liLevel2');
  
  if (liLevel1 && liLevel2) {
	  $('li.selected').removeClass('selected');
	  $('#' + liLevel1).addClass('selected');
	  $('#' + liLevel1).children('ul').addClass('collapse in');
	  $('#' + liLevel2).addClass('selected');
  } else if (liLevel1) {
	  $('li.selected').removeClass('selected');
	  $('#' + liLevel1).addClass('selected');
  }
  
  $('#side-menu li.first-level').click(function() {
	  Cookies.set('liLevel1', $(this).attr('id'));
	  if ($(this).children('ul').length === 0) {
		  Cookies.remove('liLevel2');
	  }
  });
  
  $('#side-menu li.second-level').click(function() {
	  liLevel1 = Cookies.set('liLevel2', $(this).attr('id'));
  });
  
  $('i.fa-home').click(function() {
	  Cookies.set('liLevel1', $('#li-dashboard').attr('id'));
	  Cookies.remove('liLevel2');
  });
  
});
