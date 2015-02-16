try {
    $list = jQuery('select[name="RS[skladnik_id]"]');
    for (var $i = 0; $i < $list.length; $i++) {
        jQuery($list[$i])[0].setAttribute('name', "RS[skladnik_id][]");
    }
    $list = jQuery('select[name="RS[jednostka]"]');
    for (var $i = 0; $i < $list.length; $i++) {
        jQuery($list[$i])[0].setAttribute('name', "RS[jednostka][]");
    }
    $list = jQuery('input[name="RS[ilosc]"]');
    for (var $i = 0; $i < $list.length; $i++) {
        jQuery($list[$i])[0].setAttribute('name', "RS[ilosc][]");
    }
} catch (Exception) {
}
