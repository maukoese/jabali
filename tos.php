<?php include 'header.php'; ?>
<title>Terms Of Service [ <?php getOption('name'); ?> ]</title>
<div class="mdl-grid ">
	 <div class="mdl-card mdl-cell mdl-cell--12-col mdl-color--<?php primaryColor($_SESSION['myCode']); ?> mdl-shadow--2dp">
	  	<div class="mdl-cell mdl-cell--12-col">
	  	<?php getOption('tos'); ?>
		</div>
	</div>
</div>
<?php include 'footer.php';

    <script>
        $(function () {
            modalPosition();
            $(window).resize(function () {
                modalPosition();
            });
            $('.openModal').click(function (e) {
                $('.modal, .modal-backdrop').fadeIn('fast');
                e.preventDefault();
            });
            $('.close-modal').click(function (e) {
                $('.modal, .modal-backdrop').fadeOut('fast');
            });
        });
        function modalPosition() {
            var width = $('.modal').width();
            var pageWidth = $(window).width();
            var x = (pageWidth / 2) - (width / 2);
            $('.modal').css({ left: x + "px" });
        }
    </script>