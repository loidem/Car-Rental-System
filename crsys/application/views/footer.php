	
	<hr>

		<footer>
			<p>&copy; Company 2015</p>
		</footer>
		</div>
	</body>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="http://localhost/crsys/public/js/bootstrap.min.js"></script>
	<script src="http://localhost/crsys/public/js/bootstrap-datepicker.js"></script>
  
	<script>
		$('.datepicker').datepicker();
		
		(function($) {
		    $.fn.uniformHeight = function() {
		        var maxHeight   = 0,
		            max         = Math.max;

		        return this.each(function() {
		            maxHeight = max(maxHeight, $(this).height());
		        }).height(maxHeight);
		    }
		})(jQuery);

		$(".thumbnails").find(".thumbnail").uniformHeight();
	</script>
</html>