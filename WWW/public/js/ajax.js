$('document').ready(function(){

  // Listen for changes on the select element
  $('#user').change( getUserInfo );
  
  
  $('.insertUser').click( function(){
    alert('hi');
  }); 
  

  function getUserInfo(){
  
    var userId = $('#user option:selected').data('user-id');
    
    console.log(userId);

    $.ajax({
      
      url: "/userDisplay/"+userId,
      
      success:  function(dataFromServer){
        
        var user      = dataFromServer.user;
        var packages  = dataFromServer.packages;
        
        $('#userDisplay').html('');
        
        $('#userDisplay').hide(500, function(){
          $('#userDisplay').append('<li>'+user.name+'</li><li><a href="mailto:'+user.email+'">'+user.email+'</a></li>');
          $('#userDisplay').show(500);
        });

        $('#packages').html('');
                
        $("#userId").val(user.id);

        for(var i=0; i<packages.length; i++ )
        {
          
          $.ajax({
            url: "/userPackages/"+packages[i].package_id,

            success: function(packageFromServer){
                            
              $('#packages').hide(500, function(){  

                for(var i=0; i<packageFromServer.length; i++)
                {
                  var currentPackage = packageFromServer[i];

                  $('#packages').append('<li><ul class="small-block-grid-1" data-equalizer-watch="'+currentPackage.id+'"><li><h5>'+currentPackage.name+'</h5></li><li >'+currentPackage.description+'</li><li><button class="tiny button radius insertUser" data-package-id="'+currentPackage.id+'">Select Package</button></li></ul></li>');
                }
                
                $('#packages').show(500);
              });  

            },

            error: function(){
              console.log('cannot connect to packages');
            }
          });
        }
      },

      error: function(){
        console.log('cannot connect to users');
      }
    });
  }

  function insertUser()
  {
    alert('hi');
    var insertUserId    = $('#user option:selected').data('user-id');
    var insertPackageId = $('#packages').data('package-id');

    console.log(insertUserId);
    console.log(insertPackageId); 
  }

});


