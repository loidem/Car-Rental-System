</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="http://localhost/crsys/public/js/bootstrap.min.js"></script>
    <script>
    	//Loads the correct sidebar on window load,
		//collapses the sidebar on window resize.
	    $(function() {
	    $(window).bind("load resize", function() {
	        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
	        if (width < 768) {
	            $('div.sidebar-collapse').addClass('collapse')
	        } else {
	            $('div.sidebar-collapse').removeClass('collapse')
	        }
	    })
		})
    </script>

</body>

</html>
