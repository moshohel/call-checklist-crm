Date.prototype.addDays = function(days) {
    this.setDate(this.getDate() + parseInt(days));
    return this;
};


Date.prototype.formateDate = function(format , date) {
    format = format.replace('yyyy', date.getFullYear());
    format = format.replace('mm', ("0"+(date.getMonth()+1)).slice(-2));
    format = format.replace('dd', ("0"+ date.getDate()).slice(-2));
    format = format.replace('hh', ("0"+ date.getHours()).slice(-2));
    format = format.replace('ii', ("0"+ date.getMinutes()).slice(-2));
    //console.log(format);
    return format;
};

function initializeDatetimepicker(selector, format)
{
    var startDate = '',
        endDate = '';

    if (selector.attr('data-date-format')) {
        format = selector.attr('data-date-format');
    }
 
    selector.datetimepicker({
        format: format.toUpperCase(),
        useCurrent:false
    });

    if (selector.attr('data-start-date')) {
        var toDay = new Date(),
            requestedDays = selector.attr('data-start-date');
        toDay.addDays(requestedDays);
        startDate = toDay.formateDate(format, toDay);
        selector.data("DateTimePicker").minDate(startDate);
    }

    if (selector.attr('data-end-date')) {
        var toDay = new Date(),
            requestedDays = selector.attr('data-end-date');
        toDay.addDays(requestedDays);
        endDate = toDay.formateDate(format, toDay);
        selector.data("DateTimePicker").maxDate(endDate);
    }
}

$('.date-picker').each(function() {
    initializeDatetimepicker($(this), 'yyyy-mm-dd');
});


$('.time-picker').each(function() {
    initializeDatetimepicker($(this), 'LT');
});


$('.date-time-picker').each(function() {
    initializeDatetimepicker($(this), 'yyyy-mm-dd hh:ii');
});
