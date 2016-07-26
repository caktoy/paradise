$(document).ready(function(){
//apabila terjadi event onchange terhadap object <select id=propinsi>
$("#divisi").change(function(){
var divisi = $("#divisi").val();
$.ajax({
url: "PHP/ambildivisi2.php",
data: "divisi="+divisi,
cache: false,
success: function(msg){
//jika data sukses diambil dari server kita tampilkan
//di <select id=kota>
$("#jabatan").html(msg);
}
});
});
});