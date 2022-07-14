function limparCreate(){
    var inputTitulo = document.getElementById('tituloInput');
    inputTitulo.value = '';
    var inputPreco = document.getElementById('inputPrice');
    inputPreco.value = '';
    var inputWc = document.getElementById('inputBath');
    inputWc.value = '';
    var inputAreaBruta = document.getElementById('inputGrossArea');
    inputAreaBruta.value = '';
    var inputAreaUtil = document.getElementById('inputArea');
    inputAreaUtil.value = '';
    var inputDesc = document.getElementById('inputDesc');
    inputDesc.value = '';
    var inputLink = document.getElementById('inputLink');
    inputLink.value = '';

    var selectTypePrice = document.getElementById('selectPriceType');
    selectTypePrice.value = 'DO';
    var selectDistrict = document.getElementById('selectDistrict');
    selectDistrict.value = 'DO';
    var selectPropertieType = document.getElementById('selectPropertieType');
    selectPropertieType.value = 'DO';
    var selectTypology = document.getElementById('selectTypology');
    selectTypology.value = 'DO';
    var selectWebsite = document.getElementById('selectWebsite');
    selectWebsite.value = 'DO';
    $('.text-danger').remove();
    $('input:text, textarea').val('');

}
function imgPreview() {
    // Multiple images preview with JavaScript
    var multiImgPreview = function(input, imgPreviewPlaceholder) {

        document.getElementById('imgPrev').innerHTML = "";
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img width=200> ')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $('#images').on('change', function() {
        multiImgPreview(this, 'div.imgPreview');
    });
};  