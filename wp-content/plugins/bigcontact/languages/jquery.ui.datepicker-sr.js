/* Serbian i18n for the jQuery UI date picker plugin. */
/* Written by Dejan Dimić. */
var bigRegion = 'sr';
jQuery.datepicker.regional['sr'] = {
    closeText: 'Затвори',
    prevText: '&#x3c;',
    nextText: '&#x3e;',
    currentText: 'Данас',
    monthNames: ['Јануар','Фебруар','Март','Април','Мај','Јун',
    'Јул','Август','Септембар','Октобар','Новембар','Децембар'],
    monthNamesShort: ['Јан','Феб','Мар','Апр','Мај','Јун',
    'Јул','Авг','Сеп','Окт','Нов','Дец'],
    dayNames: ['Недеља','Понедељак','Уторак','Среда','Четвртак','Петак','Субота'],
    dayNamesShort: ['Нед','Пон','Уто','Сре','Чет','Пет','Суб'],
    dayNamesMin: ['Не','По','Ут','Ср','Че','Пе','Су'],
    weekHeader: 'Сед',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
};
jQuery.datepicker.setDefaults(jQuery.datepicker.regional['sr']);

jQuery.timepicker.regional[bigRegion] = {
	timeText: 'време',
	hourText: 'сат',
	minuteText: 'минут'
};
jQuery.timepicker.setDefaults(jQuery.timepicker.regional[bigRegion]);
