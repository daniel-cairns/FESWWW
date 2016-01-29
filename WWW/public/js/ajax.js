$('document').ready(function(){

  // Listen for changes on the select element
  $('#user').change(getUserInfo);
  
  if ($('#user').click()) {
    getUserInfo();
  }

});
   
function getUserInfo()
{

  var userId = $('#user option:selected').data('user-id');
  
  $.ajax({
    
    url: "/userDisplay/"+userId,
    
    success:  function(dataFromServer){
      
      console.log(dataFromServer);
      var user      = dataFromServer.user;
      var packages  = dataFromServer.packages;
      
      $('#userDisplay').html('');
      $('#userImages').html('');
      $('#packages').html('');
      $('#userRemove').html('');
      $('#ajaxModals').html('');

      
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
      getUserPackages(packages, user);
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

function getUserPackages(packages, user){
  
  if (packages.length > 0)
  {
    $('#packages').before('<div class="row"><div class="columns"><h2>Users Ordered Packages</h2><hr></div></div>');
  }

  for(var i=0; i<packages.length; i++ )
  {
    
    var package_id  = packages[i].package_id;
    var bought_id   = packages[i].id;  
    var status      = packages[i].status;
    displayPackage( status, package_id, bought_id );   
  } 
}

function displayPackage(status, package_id, bought_id ){
  $.ajax({
      url: "/userPackages/"+package_id,

      success: function(packageFromServer){

        $('#packages').hide(500, function(){  

          for(var i=0; i<packageFromServer.length; i++)
          {
            var currentPackage = packageFromServer[i];
            
            $('#packages').append('<li><ul class="small-block-grid-1" data-equalizer-watch="'+currentPackage.id+'"><li><h5>'+currentPackage.name+'</h5></li><li>'+currentPackage.description+'</li><li>Status: '+status+'</li><li><button class="tiny button radius insertPackage" id="package_id'+bought_id+'" data-package-id="'+bought_id+'" data-reveal-id="packageModal">Edit Package</button></li></ul></li>');
            
          }
          
          $('#packages').show(500);
        });  

      },

      error: function(){
        console.log('cannot connect to packages');
      }
    });
}

$(document).on('click', '.insertPackage', function () {
  var userPackage = $(this).data('package-id');
  console.log(userPackage);
  $('#boughtPackage').val(userPackage);
  $('#deleteBoughtPackage').val(userPackage);
});


