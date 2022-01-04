(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
  });

})(jQuery);

function printPage(id)
{

   var html="<html>";
   html+= document.getElementById(id).innerHTML;
   html+="</html>";
   var printWin = window.open('','','left=500,top=500,width=800,height=800,toolbar=0,scrollbars=0,status=0');
   printWin.document.write(html);
   printWin.document.close();
   printWin.focus();
   printWin.print();
   //printWin.close();
}
