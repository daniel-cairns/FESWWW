$('document').ready(function(){

  // Listen for changes on the select element
  $('#user').change( getUserMessage );


  function getUserMessage(){
  
    var userId = $('#user option:selected').data('user-id');
    
    console.log(userId);

    $.ajax({
      
      url: "/userMessage/"+userId,
      
      success:  function(dataFromServer){
        console.log(dataFromServer.length);
        $('#message').html('');
        
        for( var i=0; i<dataFromServer.length; i++)
        {
          console.log(dataFromServer[i].message);
          $('#message').append('<p>'+dataFromServer[i].message+'</p>');
        }
       
      },

      error: function(){
        console.log('cannot connect');
      }
          
    });
  }

});



// function getUserInfo()
// {
//   // Save the id of the chosen user
//   var user_id = $(this).val();

//   // Make sure the value is a number
//   if( isNaN(user_id))
//   {
//     return; 
//   }

  //Prepare Ajax
//   $.ajax({
//     url: '/App/Ajax.php',
//     data: 
//     {
//       users: user_id
//     },

//     success: function(dataFromServer)
//     {
//       console.log(dataFromServer);
//     },

//     error: function()
//     {
//       console.log('cannot connect');
//     }
//   });
// }

