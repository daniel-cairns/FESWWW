$('document').ready(function(){

  // Listen for changes on the select element
  $('#user').change( getUserInfo );


});

function getUserMessage(id){

  $.get("/usermessage/"+id, function(data) {

    if(data=="OK"){

      $("#"+id).addClass("done");
    }
    
  });
}

function getUserInfo()
{
  // Save the id of the chosen user
  var user_id = $(this).val();

  // Make sure the value is a number
  if( isNaN(user_id))
  {
    return; 
  }

  //Prepare Ajax
  $.ajax({
    url: '/App/Ajax.php',
    data: 
    {
      users: user_id
    },

    success: function(dataFromServer)
    {
      console.log(dataFromServer);
    },

    error: function()
    {
      console.log('cannot connect');
    }
  });
}

