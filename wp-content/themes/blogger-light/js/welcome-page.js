
;(function($) {

	$('.blogger-tab-nav a').on('click',function (e) {
		e.preventDefault();
		$(this).addClass('active').siblings().removeClass('active');
	});

	$('.blogger-tab-nav .begin').on('click',function (e) {		
		$('.blogger-tab-wrapper .begin').addClass('show').siblings().removeClass('show');
	});	
	$('.blogger-tab-nav .actions, .blogger-tab .actions').on('click',function (e) {		
		e.preventDefault();
		$('.blogger-tab-wrapper .actions').addClass('show').siblings().removeClass('show');

		$('.blogger-tab-nav a.actions').addClass('active').siblings().removeClass('active');

	});	
	$('.blogger-tab-nav .support').on('click',function (e) {		
		$('.blogger-tab-wrapper .support').addClass('show').siblings().removeClass('show');
	});	
	$('.blogger-tab-nav .table').on('click',function (e) {		
		$('.blogger-tab-wrapper .table').addClass('show').siblings().removeClass('show');
	});	


	$('.blogger-tab-wrapper .install-now.importer-install').on('click',function (e) {	
		$('.importer-button').show();
	});	


})(jQuery);
