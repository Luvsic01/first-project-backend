$(document).ready(function() {

    function studentPage() {

    }







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