// material desing google
const form_material_desing = [].map.call(document.querySelectorAll('.mdc-text-field'), function (el) {
    return new mdc.textField.MDCTextField.attachTo(el);
});