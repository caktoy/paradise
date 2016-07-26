$(document).ready(function(){
//apabila terjadi event onchange terhadap object <select id=propinsi>
$("#namabrg").change(function(){
var brg = $("#namabrg").val();
$.ajax({
url: "PHP/ambilnama.php",
data: "brg="+brg,
cache: false,
success: function(msg){
//jika data sukses diambil dari server kita tampilkan
//di <select id=kota>
$("#barangpenyusun").html(msg);
}
});
});
});