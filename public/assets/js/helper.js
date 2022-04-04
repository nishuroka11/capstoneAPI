$(document).on('change', '.positive-integer-number', function () {
    this.value = Math.abs(this.value);
});

$(document).on('dblclick', '.disabled-field', function () {
    $(this).prop('disabled', false);
    $(this).focus();
});

