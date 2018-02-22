  $('.datepicker').pickadate({
    formatSubmit: 'dd/mm/yyyy',
    format: 'dd/mm/yyyy',
    firstDay: 1,
    monthsFull: [ 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre' ],
    monthsShort: [ 'Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec' ],
    weekdaysFull: [ 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche' ],
    weekdaysShort: [ 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim' ],
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 70, // Creates a dropdown of 15 years to control year,
    today: 'AUJOURD\'HUI',
    clear: 'Effacer',
    close: 'Ok',
    closeOnSelect: false // Close upon selecting a date,
  });
