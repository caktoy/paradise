$(document).ready(function(){
//apabila terjadi event onchange terhadap object <select id=propinsi>
$("#propinsi").change(function(){
var propinsi = $("#propinsi").val();
$.ajax({
url: "PHP/ambilkota2.php",
data: "propinsi="+propinsi,
cache: false,
success: function(msg){
//jika data sukses diambil dari server kita tampilkan
//di <select id=kota>
$("#kota").html(msg);
}
});
});
});