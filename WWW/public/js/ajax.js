$('document').ready(function(){

  // Listen for changes on the select element
  $('#user').change(getUserInfo);
  
  if ($('#user').click()) {
    getUserInfo();
  }

  $('.insertPackage').click(function(){
    $(this).slidUp();
  });

  selectUserPackage();

});
    
   
function getUserInfo()
{

  var userId = $('#user option:selected').data('user-id');
  
  $.ajax({
    
    url: "/userDisplay/"+userId,
    
    success:  function(dataFromServer){
      
      var user      = dataFromServer.user;
      var packages  = dataFromServer.packages;
      console.log(packages);
      
      $('#userDisplay').html('');
      $('#userImages').html('');
      $('#packages').html('');
      $('#userRemove').html('');

      
      $('#userDisplay').hide(500, function(){
        $('#userDisplay').append('<li>'+user.name+'</li><li><a href="mailto:'+user.email+'">'+user.email+'</a></li>');
        $('#userDisplay').show(500);
      });

      $('#removeUser').hide(500, function(){
        $('#userRemove').val(user.id);
        $('#userName').html(user.name);
        $('#removeUser').show(500);
      });
              
      $("#userId").val(user.id);

      getUserImages(user);
      getUserPackages(packages);
    },
    error: function(){
      console.log('cannot connect to users');
    }
  });
}

function getUserImages(user)
{
  
  $.ajax({
    
    url: "/userImages/"+user.id,

    success: function(imageFromServer){
      
      if(imageFromServer.length > 0 )
      {
        $('#userImages').before('<div class="row"><div class="columns"><h2>Images</h2></div></div>');
      }
      console.log(imageFromServer);
      $('#userImages').hide(500, function(){
        for( var i=0; i<imageFromServer.length; i++){
          
          $('#userImages').append('<li><img src="img/users/'+imageFromServer[i].name+'"></li>');

        }
        $('#userImages').show(500);
      });
    },

    error: function() {
      console.log('cannot connect to images');
    }
  
  });
}  

function getUserPackages(packages){
  
  if (packages.length > 0)
  {
    $('#packages').before('<div class="row"><div class="columns"><h2>Packages</h2></div></div>');
  }

  for(var i=0; i<packages.length; i++ )
  {
    $.ajax({
      url: "/userPackages/"+packages[i].package_id,

      success: function(packageFromServer){
        console.log('test');
        console.log(packageFromServer);
        $('#packages').hide(500, function(){  

          for(var i=0; i<packageFromServer.length; i++)
          {
            var currentPackage = packageFromServer[i];
      
            $('#packages').append('<li><ul class="small-block-grid-1" data-equalizer-watch="'+currentPackage.id+'"><li><h5>'+currentPackage.name+'</h5></li><li>'+currentPackage.description+'</li><li>'+packages[i].status+'</li><li><button class="tiny button radius insertPackage" id="package_id'+currentPackage.id+'"data-package-id="'+currentPackage.id+'">Select Package</button></li></ul></li>');
          }
          
          $('#packages').show(500);
        });  

      },

      error: function(){
        console.log('cannot connect to packages');
      }
    });
  }  
}

function selectUserPackage()
{
  var userPackage = $('.imsertPackage').data('package-id');

  console.log(userPackage);
}

