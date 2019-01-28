$(document).ready(function () {
    'use strict';
    $('#search').autocompleter({
      url_list: '/search-article',
      url_get: '/?term='
    });
  
  
    $("#ui-id-1").click(function(){
      var id = $("#search").val();
  
      if(id.toString().length > 0){
        $(location).attr('href', '/article/'+id.toString());
      }
    })
  
  }); 
    