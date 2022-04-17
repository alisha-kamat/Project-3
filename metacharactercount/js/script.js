(function($) {
    $(document).ready(function() {

        var max_desc = 160;
        var metadesc = [];
        var metadesc_badge = [];
        var color = 'badge-success bg-success';
	    var badge;

        if(meta_counter_params.params.desc_length > 0) 
	    {
            max_desc = meta_counter_params.params.desc_length;
        }

        metadesc.push($('.com_content.view-article #jform_metadesc'));

        $.each(metadesc, function(i) {
            count = ($(this).val() || '').length;
            if (count == 0) 
	        {
                count = max_desc;
            } 
	        else 
	        {
                count = max_desc - count;
                if (count < 0) 
		        {
                    color = 'badge-important bg-danger';
                } 
		        else 
		        {
                    color = 'badge-success bg-success';
                }
            }

            badge = '<span style="margin-left: 10px;" class="badge '+color+' hasTooltip" data-original-title="'+meta_counter_params.AK_META_CHARACTERS_LEFT+'">'+count+'</span>';
            $(this).after(badge);
            metadesc_badge[i] = $(this).next('.badge');
            CharacterCount ($(this), max_desc, metadesc_badge[i]);
        });

    });

    function CharacterCount (Input, max, Badge) {
        $(Input).keyup(function() {
            var count = $(this).val().length;
            var remaining = max - count;
            $(Badge).text(remaining);
            if (remaining > -1) {
                $(Badge).removeClass('badge-important');
                $(Badge).addClass('badge-success');
            } else {
                $(Badge).removeClass('badge-success');
                $(Badge).addClass('badge-important');
            }
        });

    }

})(jQuery);