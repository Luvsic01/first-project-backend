<div id="studentContent"></div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var requestAjax = $.ajax({
            url: "ajax/student.php",
            method: 'POST',
            data: {id:<?=  $_GET['id'] ?>},
            dataType: "html"
        })
            .done(function (data) {
                $('#studentContent').html(data)
            })
            .fail(function () {
                alert("bad news... ERROR !");
            });
    });
</script>
