  jQuery('document').ready(function($){

    // Get the comment form
    var commentform=$('#commentform');
    // Add a Comment Status message
    commentform.prepend('<div id="comment-status" ></div>');
    // Defining the Status message element 
    var statusdiv=$('#comment-status');
    commentform.submit(function(){
      // Serialize and store form data
      var formdata=commentform.serialize();
      //Add a status message
      statusdiv.html('<p class="ajax-placeholder">'+ translation.s1 +'</p>');
      //Extract action URL from commentform
      var formurl=commentform.attr('action');
      //Post Form with data
      $.ajax({
        type: 'post',
        url: formurl,
        data: formdata,
        error: function(XMLHttpRequest, textStatus, errorThrown){
          if (errorThrown == 'Too Many Requests') {
            statusdiv.html('<p class="comment-error">'+ translation.s2 +'</p>');
          }
          
        },
        success: function(data, textStatus){

            var regExp = /<p><p><strong>ERROR<\/strong>: (.*?)<\/p><\/p>/;
            var matches = regExp.exec(data);
            if (matches) {
              statusdiv.html('<p class="comment-error">'+matches[1]+'</p>');
            } else {
              statusdiv.html('<p class="comment-error">'+ translation.s3 +'</p>');
              setTimeout(
                function() {
                  location.reload(true);
                }, 3000);
              
            }
        }

      });
      return false;
    });
  });