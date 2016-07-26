$(document).ready(function(){
//apabila terjadi event onchange terhadap object <select id=propinsi>
$("#namabrg2").change(function(){
var brg = $("#namabrg2").val();
var penj = document.getElementById("induk").value;
$.ajax({
url: "PHP/ambilnama2.php",
data: "brg="+brg+"&penj="+brg,
cache: false,
success: function(msg){

//jika data sukses diambil dari server kita tampilkan
//di <select id=kota>
$("#barangpenyusun").html(msg);
}
});
});
});