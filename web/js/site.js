try {
    $list = jQuery('select[name="RecepturySkladniki[skladnik_id]"]');
    for (var $i = 0; $i < $list.length; $i++) {
        jQuery($list[$i])[0].setAttribute('name', "RecepturySkladniki[skladnik_id][]");
    }
    $list = jQuery('select[name="RecepturySkladniki[jednostka]"]');
    for ($i = 0; $i < $list.length; $i++) {
        jQuery($list[$i])[0].setAttribute('name', "RecepturySkladniki[jednostka][]");
    }
    $list = jQuery('input[name="RecepturySkladniki[ilosc]"]');
    for ($i = 0; $i < $list.length; $i++) {
        jQuery($list[$i])[0].setAttribute('name', "RecepturySkladniki[ilosc][]");
    }
    $list = jQuery('input[name="RecepturySkladniki[wyswietlac_procent]"]');
    var $j = 0;
    for ($i = 0; $i < $list.length; $i++) {
        $j = Math.floor($i / 2);
        jQuery($list[$i])[0].setAttribute('name', "RecepturySkladniki[wyswietlac_procent][" + $j + "]");
    }
} catch (Exception) {
}
try {
    $list = jQuery('select[name="SkladnikiSkladniki[skladnik_id]"]');
    for (var $i = 0; $i < $list.length; $i++) {
        jQuery($list[$i])[0].setAttribute('name', "SkladnikiSkladniki[skladnik_id][]");
    }
    $list = jQuery('input[name="SkladnikiSkladniki[kilogramy]"]');
    for ($i = 0; $i < $list.length; $i++) {
        jQuery($list[$i])[0].setAttribute('name', "SkladnikiSkladniki[kilogramy][]");
    }
    $list = jQuery('input[name="SkladnikiSkladniki[procenty]"]');
    for ($i = 0; $i < $list.length; $i++) {
        jQuery($list[$i])[0].setAttribute('name', "SkladnikiSkladniki[procenty][]");
    }
    $list = jQuery('input[name="SkladnikiSkladniki[wyswietlac_procent]"]');
    var $j = 0;
    for ($i = 0; $i < $list.length; $i++) {
        $j = Math.floor($i / 2);
        jQuery($list[$i])[0].setAttribute('name', "SkladnikiSkladniki[wyswietlac_procent][" + $j + "]");
    }
} catch (Exception) {
}

jQuery('.add-ingredient').click(function () {
    var $formSection = jQuery('.last');
    var $new = $formSection.clone(true);
    $formSection.removeClass('last');
    $new.appendTo('#ingredients');
    var $formSelect = jQuery('.last select');
    $formSelect[0].selectedIndex = 0;
    try {
        $formSelect[1].selectedIndex = 0;
    } catch (Exception) {
    }
    var $formInput = jQuery('.last input[type="text"]');
    $formInput.val('');
    $formInput = jQuery('.last input[type="checkbox"]');
    try {
        $formInput[0].checked = false
        $formInput[1].checked = false
    } catch (Exception) {
    }
    var $list = jQuery('input[name^="RecepturySkladniki[wyswietlac_procent]"]');
    var $j = 0;
    for ($i = 0; $i < $list.length; $i++) {
        $j = Math.floor($i / 2);
        jQuery($list[$i])[0].setAttribute('name', "RecepturySkladniki[wyswietlac_procent][" + $j + "]");
    }
    $list = jQuery('input[name^="SkladnikiSkladniki[wyswietlac_procent]"]');
    $j = 0;
    for ($i = 0; $i < $list.length; $i++) {
        $j = Math.floor($i / 2);
        jQuery($list[$i])[0].setAttribute('name', "SkladnikiSkladniki[wyswietlac_procent][" + $j + "]");
    }
    jQuery('body, html').animate({ scrollTop: jQuery('.last').position().top + 'px'});
    return false;
});

jQuery('.remove-ingredient').click(function () {
    var $removeVal = false;

    $removeVal = confirm('Na pewno usunąć?');
    if ($removeVal) {
        var $this = jQuery(this);
        var $parent = jQuery($this.parents('div')[0]);
        if ($parent.hasClass('last')) {
            var $formSections = jQuery('.form-section.with-percent');
            var $len = $formSections.length;
            if ($len >= 2) {
                jQuery($formSections[$len - 2]).addClass('last');
            } else {
                alert('Musi zawierać przynajmniej jeden składnik');
                return false;
            }
        }
        $parent.remove();
        var $list = jQuery('input[name^="RecepturySkladniki[wyswietlac_procent]"]');
        var $j = 0;
        for ($i = 0; $i < $list.length; $i++) {
            $j = Math.floor($i / 2);
            jQuery($list[$i])[0].setAttribute('name', "RecepturySkladniki[wyswietlac_procent][" + $j + "]");
        }
        $list = jQuery('input[name^="SkladnikiSkladniki[wyswietlac_procent]"]');
        $j = 0;
        for ($i = 0; $i < $list.length; $i++) {
            $j = Math.floor($i / 2);
            jQuery($list[$i])[0].setAttribute('name', "SkladnikiSkladniki[wyswietlac_procent][" + $j + "]");
        }
    }
});

jQuery(document).ready(function () {
    var order;
    if(jQuery('.my-data-table').hasClass('recipe-table')){
        order = [[ 1, 'asc' ]];
    } else {
        order = [[ 0, 'asc' ]];
    }
    jQuery('.my-data-table').DataTable({
        "language": {
            "paginate": {
                "first": "Pierwsza",
                "last": "Ostatnia",
                "previous": "Poprzednia",
                "next": "Natępna"
            },
            "emptyTable": "Brak danych",
            "info": "Pokazywne _START_ do _END_ z _TOTAL_ wpisów",
            "infoEmpty": "Brak wpisów",
            "infoFiltered": " (wyfiltrowane z _MAX_ wpisów)",
            "lengthMenu": "Pokazuj _MENU_ wpisów",
            "search": "Szukaj: ",
            "zeroRecords": "Brak wpisów do pokazania"
        },
        "iDisplayLength": defaultNumberOfItems,
        "aLengthMenu": [[ 10, 25, 50, 100, -1 ],[10,25,50,100,"Wszystkie"]],
        "order": order
    });
});
jQuery(function () {
    jQuery("#produkty-data_od").datepicker({format: 'yyyy-mm-dd', weekStart: 1});
    jQuery("#produkty-data_do").datepicker({format: 'yyyy-mm-dd', weekStart: 1});
    jQuery("#receptury-data_od").datepicker({format: 'yyyy-mm-dd', weekStart: 1});
    jQuery("#receptury-data_do").datepicker({format: 'yyyy-mm-dd', weekStart: 1});
    jQuery("#skladniki-od_kiedy").datepicker({format: 'yyyy-mm-dd', weekStart: 1});
    jQuery("#skladniki-do_kiedy").datepicker({format: 'yyyy-mm-dd', weekStart: 1});
    jQuery("#zamowienia-data").datepicker({format: 'yyyy-mm-dd', weekStart: 1});
    jQuery("#zamowienia-zrealizowane").datepicker({format: 'yyyy-mm-dd', weekStart: 1});
    jQuery("#zamowienia-zafakturowane").datepicker({format: 'yyyy-mm-dd', weekStart: 1});
});

jQuery('.remove-button').click(function () {
    var returnVal = false;

    returnVal = confirm('Na pewno usunąć?');

    return returnVal;
});

jQuery('#check-all-allergens').click(function () {
    if ($(this).data('check')) {
        var inputs = jQuery('.allergens input');
        for (var i = 1; i < inputs.length; i++) {
            inputs[i].checked = true;
        }
        $(this).data('check',false);
        $(this)[0].innerText = 'Odznacz wszystkie alergeny';
    } else {
        var inputs = jQuery('.allergens input');
        for (var i = 1; i < inputs.length; i++) {
            inputs[i].checked = false;
        }
        $(this).data('check',true);
        $(this)[0].innerText = 'Zaznacz wszystkie alergeny';
    }
    return false;
});

jQuery('#set-default').click(function(){
    if ($(this).data('check')) {
        var inputs = jQuery('.number-input');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].value = $(inputs[i]).data('value');
        }
        $(this).data('check',false);
        $(this)[0].innerHTML = '<i class="glyphicon glyphicon-transfer"></i> Usuń wartości dla wszystkich produktów';
    } else {
        var inputs = jQuery('.number-input');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].value = "";
        }
        $(this).data('check',true);
        $(this)[0].innerHTML = '<i class="glyphicon glyphicon-transfer"></i> Ustaw domyślne wartości dla wszystkich produktów';
    }
});

jQuery('#check-all-products').click(function () {
    if ($(this).data('check')) {
        var inputs = jQuery('.products');
        for (var i = 1; i < inputs.length; i++) {
            inputs[i].checked = true;
        }
        $(this).data('check',false);
        $(this)[0].innerText = 'Odznacz wszystkie produkty';
    } else {
        var inputs = jQuery('.products');
        for (var i = 1; i < inputs.length; i++) {
            inputs[i].checked = false;
        }
        $(this).data('check',true);
        $(this)[0].innerText = 'Zaznacz wszystkie alergeny';
    }
    return false;
});
