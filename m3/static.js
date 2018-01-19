var crossobj=document.all? document.all.pagefly : document.getElementById? document.getElementById("pagefly") : document.pagefly

function positionit(fucking,shit) {
var dsocleft=document.all? document.body.scrollLeft : pageXOffset
var dsoctop=document.all? document.body.scrollTop : pageYOffset
var window_width=document.all? document.body.clientWidth : window.innerWidth

if (document.all||document.getElementById) {
crossobj.style.left=parseInt(dsocleft)+shit
crossobj.style.top=dsoctop+fucking
} else if (document.layers){
crossobj.right=dsocright+shit
crossobj.top=dsoctop+fuckin
}
}