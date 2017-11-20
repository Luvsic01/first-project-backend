$(document).ready(function() {

    ////////////////////////////////
    ///// send email reset /////////
    ////////////////////////////////
    $('#formResetPwd').on('submit', function (e) {
        e.preventDefault();
        var dataForm = $(this).serialize();
        var token = $(this).data('token');
        dataForm += "&token=" + token;
        console.log(dataForm);
        $.ajax({
            url: "ajax/resetPwd.php",
            method: 'POST',
            data: dataForm,
            dataType: "html"
        })
            .done(function (data) {
                $('#infoForm').html(data)
            })
            .fail(function () {
                alert("error ajax");
            });
    });

    ////////////////////////////////
    ///// send email reset /////////
    ////////////////////////////////
    $('#formSendReset').on('submit', function (e) {
        e.preventDefault();
        var dataForm = $(this).serialize();
        $.ajax({
            url: "ajax/sendEmailForgetPwd.php",
            method: 'POST',
            data: dataForm,
            dataType: "html"
        })
            .done(function (data) {
                $('#infoForm').html(data)
            })
            .fail(function () {
                alert("error ajax");
            });
    });

    ///////////////////////////
    ///// Add Student /////////
    ///////////////////////////
    $('#formAdd').on('submit', function (e) {
        e.preventDefault();
        var studentId = $(this).data('id');
        var dataForm = $(this).serialize();
        if(studentId !== false){
            dataForm += "&id=" + studentId;
        }
        console.log(dataForm);
        $.ajax({
            url: "ajax/add.php",
            method: 'POST',
            data: dataForm,
            dataType: "html"
        })
            .done(function (data) {
                $('#infoform').html(data)
            })
            .fail(function () {
                alert("error ajax");
            });
    });

    ///////////////////////////////
    ///// détails student /////////
    ///////////////////////////////
    $('.student-details').on('click', function (e) {
        e.preventDefault();
        var studentId = $(this).data('id');
        $.ajax({
            url: "ajax/student.php",
            method: 'POST',
            data: {id: studentId},
            dataType: "json"
        })
            .done(function (data) {
                var student =
                    "<h4>" + data['stu_firstname'] + " " + data['stu_lastname'] + "</h4>" +
                    "<ul>" +
                        "<li>ID : " + data['stu_id'] + "</li>" +
                        "<li>Prénom : " + data['stu_firstname'] + "</li>" +
                        "<li>Nom : " + data['stu_lastname'] + "</li>" +
                        "<li>Email : " + data['stu_email'] + "</li>" +
                        "<li>Date de naissance : " + data['stu_birthdate'] + "</li>" +
                        "<li>Age : " + data['stu_birthdate'] + "</li>" +
                        "<li>Ville : " + data['cit_name'] + "</li>" +
                        "<li>Sympathie : " + data['stu_friendliness'] + "</li>" +
                        "<li>Nom session : " + data['tra_name'] + "</li>" +
                        "<li>N° de session : " + data['ses_number'] + "</li>" +
                    "</ul>";
                $('#modalStudent').find('.modal-content').html( student )
            })
            .fail(function () {
                alert("error ajax");
            });
    });

    ///////////////////////////
    ///// MATERIALIZE /////////
    ///////////////////////////
    // formulaire
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: false // Close upon selecting a date,
    });
    $(document).ready(function () {
        $('select').material_select();
    });
    // navbar
    $(".button-collapse").sideNav();
    //modal delette
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
    $('#modal1').modal('open');
    $('#modal1').modal('close');
});