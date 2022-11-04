<script src="<?=ROOT?>/js/main.js"></script>
<script src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/translations/pt.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="<?=ROOT?>/js/Chart.min.js"></script>
<script src="<?=ROOT?>/js/gauge.js"></script>
<script>
    $(window).on('load', function() {

        $(".preloader-container").fadeOut("slow", function() {
            $(this).removeClass("d-flex");
        });
    })


    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $(document).ready(function() {

        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }
        let cookie = getCookie('lang') || 'en';
        $('#flag').selectpicker('val', cookie);
        $('#flag').selectpicker('refresh');

        $('#flag').on('change', function() {
            var flag = $(this).val();
            $.ajax({
                url: "<?=ROOT?>/home",
                method: "POST",
                data: {
                    flag: flag
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == 'success') {
                        location.reload();
                    }

                }
            });
        });
    });
</script>

</body>

</html>