$(document).ready(function(){
//apabila terjadi event onchange terhadap object <select id=propinsi>
$("#jadlem").change(function(){
var lembur = $("#jadlem").val();
$.ajax({
url: "PHP/ambiljam.php",
data: "jadwal="+lembur,
cache: false,
success: function(msg){
//jika data sukses diambil dari server kita tampilkan
//di <select id=kota>
$("#jammasuk").html(msg);
}
});
});
});