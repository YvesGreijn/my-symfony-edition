(function($) {
  // définition du plugin jQuery
  $.fn.confirmDelete = function(message)
  {
    $(this).bind('click', function(event)
    {
      var answer = confirm(message);

      if(!answer)
      {
        event.preventDefault();
      }
    });
    
    // Permettre le chaînage par jQuery
    return this;
  };
})(jQuery);