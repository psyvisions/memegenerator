$(document).ready(function() {
  $('#contact_form').submit(function() {
    valid = validate_form(this);
    if(!valid)
    {
      return false;
    }
    data = $(this).serialize();
    $.ajax({
      url: '/send',
      data: data,
      type: 'post',
      success: function(response)
      {
        if(response == 'ok')
        {
          alert('Thank you. We will be in contact with you soon.');
          $('#contact_form').each(function() { this.reset();});
        }
      }
    })
    return false;
  });
  
  function validate_form(formulary)
  {
    valid = true;
    if(formulary.name.value == '')
    {
      valid = false;
      $(formulary.name).css('border', 'red 1px solid');
    }
    else
    {
      $(formulary.name).css('border', '#000 1px solid');
    }
    
    if(formulary.email.value == '')
    {
      valid = false;
      $(formulary.email).css('border', 'red 1px solid');
    }
    else
    {
      $(formulary.email).css('border', '#000 1px solid');
    }
    
    if(formulary.comment.value == '')
    {
      valid = false;
      $(formulary.comment).css('border', 'red 1px solid');
    }
    else
    {
      $(formulary.comment).css('border', '#000 1px solid');
    }
    return valid;
    
  }
  
});