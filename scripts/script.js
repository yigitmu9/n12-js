jQuery.ajax({
	url: 'http://localhost/n12/server/php/rest/log',
	method: 'GET',
	success: function(response) {
	    console.log(response);

        for (var i in response) {
	    	var item = response[i];

	    	jQuery('#main-section').append(`
			    <div class ="box">
			    <span >`+item.name+`</span>
			    <p>`+item.price+`₺</p>
                <button class = "box2" data-name="`+item.name+ ` ` + item.price +`₺">
				<i class="material-icons">add_shopping_cart</i>
                <span style="text-align:centered;">Sepete Ekle</span>
			    </button>
			    </div>
    	    `);
	    } 	

		jQuery('.box2').click(function(event) {
			var dataName = jQuery(this).attr('data-name');
		    jQuery('#box8').append(`
                <div class = "box6">
    		    `+ dataName +`
	    		    <button class="box7">
				    	<i class="material-icons">delete</i>
			        </button>
                </div>
            `)

            $( ".box7" ).unbind( "click" );

            jQuery('.box7').click(function(event) {
            	event.target.parentElement.remove();
            })
	    });    
	}
});