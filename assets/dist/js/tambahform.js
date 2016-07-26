$(document).ready(function() {
    var max_fields      = 5; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="col-md-4"><div class="form-group"><label>Jenis Ukuran</label><input type="text" class="form-control" name="jenisukuran[]" placeholder="masukkan jenis ukuran"></div></div><div class="col-md-4"><div class="form-group"><label>Ukuran</label><input type="text" class="form-control" placeholder="masukkan nilai ukuran" name="ukuran[]" ></div></div></div></div><div class="col-md-4"><div class="form-group"><label>Satuan</label><input type="text" class="form-control" placeholder="masukkan satuan ukuran" name="satuanukuran[]" ></div></div>'); //add input box
        }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});