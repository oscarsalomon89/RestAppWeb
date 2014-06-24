$(document).ready(function()
{
  $("#botones p a").click(function ()
{
  var pagina=$(this).attr("href");
  $("#tabla").load(pagina); 
  return false;
});  
});



