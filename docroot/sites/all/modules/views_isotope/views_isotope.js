(function ($) {
  Drupal.behaviors.views_isotope = {
    attach:function(context, settings)
    {

      /* Start JS */

/* The initial sort. @TODO: Shift this to HTML.
      var firstSort = $( ".sorterbutton" ).first().attr("data-sort-by");
      $('.isotope-container').isotope({ sortBy: [ firstSort ] });
*/
      // Pre-select first option in option sets.
      $('.isotope-options .option-set li:first-child a').addClass('selected');

      // store filter for each group
      var filters = {};
      $('.isotope-options').on( 'click', '.filterbutton', function(e) {
        var $this = $(this);

        // Don't proceed if already selected.
        if ($this.hasClass('selected')) {
          return false;
        }

        // identify what has been clicked
        var $optionSet = $this.parents('.option-set');
        var filterGroup = $optionSet.attr('data-filter-group');
        var instanceID = $optionSet.attr('data-instance-id');

        // set filter for group
        filters[filterGroup] = $this.attr('data-filter');

        // find all identical optionSets
        if(typeof instanceID != 'undefined'){
          var $optionSets = $(".option-set[data-filter-group='" + filterGroup + "'][data-instance-id='" + instanceID + "']");
          var $container = $('#' + instanceID);
        } else {
          var $optionSets = $(".option-set[data-filter-group='" + filterGroup + "']");
          // If no instance is set, the filter should apply to all instances
          var $container = $('.isotope-container');
        }

        //Apply class change to all identical optionsets
        $optionSets.find('.selected').removeClass('selected');
        $optionSets.find("[data-filter='" + filters[filterGroup] + "']").addClass('selected');

        // combine filters
        var filterValue = '';
        for ( var prop in filters ) {
          filterValue += filters[ prop ];
        }

        // set filter for Isotope
        $container.isotope({ filter: filterValue });

        e.preventDefault();
      });

      //Apply Sorts
      $('.isotope-options').on( 'click', '.sorterbutton', function(e) {
        var $this = $(this);

        // Don't proceed if already selected.
        if ($this.hasClass('selected')) {
          return false;
        }
        
        // identify what has been clicked
        var $optionSet = $this.parents('.option-set');
        var instanceID = $optionSet.attr('data-instance-id');

        // find all identical optionSets
        if(typeof instanceID != 'undefined'){
          var $optionSets = $(".option-set.sorts[data-instance-id='" + instanceID + "']");
          var $container = $('#' + instanceID);
        } else {
          var $optionSets = $(".option-set.sorts");
          // If no instance is set, the filter should apply to all instances
          var $container = $('.isotope-container');
        }

        //Apply class change to all identical optionsets
        $optionSets.find('.selected').removeClass('selected');
        $optionSets.find("[data-sort-by='" + $this.attr('data-sort-by') + "']").addClass('selected');

        //Apply Sort
        var sortValue = $this.attr('data-sort-by');
        // make an array of values
        sortValue = sortValue.split(',');
        $container.isotope({ sortBy: sortValue });

        e.preventDefault();
      });

      /* End JS */

    }
  }
}(jQuery));