
var totales_n=0;
var array_totales = document.getElementsByClassName("total_p");
console.log(array_totales);
for(var i=0;i<array_totales.length;i++){
totales_n+=parseFloat(array_totales[i].innerHTML);
}
document.getElementById("Totales").value = totales_n;


var totales_v=0;
var array_totales = document.getElementsByClassName("total_a");
console.log(array_totales);
for(var i=0;i<array_totales.length;i++){
totales_v+=parseFloat(array_totales[i].innerHTML);
}
document.getElementById("TotalesA").value = totales_v;