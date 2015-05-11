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
    $formInput =  jQuery('.last input[type="checkbox"]');
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
    if($removeVal){
        var $this = jQuery(this);
        var $parent = jQuery($this.parents('div')[0]);
        if ($parent.hasClass('last')) {
            var $formSections = jQuery('.form-section');
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
        }
    });
});
jQuery(function () {
    jQuery("#produkty-data_od").datepicker({format: 'dd-mm-yyyy', weekStart: 1});
    jQuery("#produkty-data_do").datepicker({format: 'dd-mm-yyyy', weekStart: 1});
    jQuery("#receptury-data_od").datepicker({format: 'dd-mm-yyyy', weekStart: 1});
    jQuery("#receptury-data_do").datepicker({format: 'dd-mm-yyyy', weekStart: 1});
    jQuery("#skladniki-od_kiedy").datepicker({format: 'dd-mm-yyyy', weekStart: 1});
    jQuery("#skladniki-do_kiedy").datepicker({format: 'dd-mm-yyyy', weekStart: 1});
});

jQuery('.remove-button').click(function(){
    var returnVal = false;

    returnVal = confirm('Na pewno usunąć?');

    return returnVal;
});
