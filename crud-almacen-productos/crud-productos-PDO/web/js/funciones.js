/**
 * Funciones auxiliares de javascripts 
 */
function confirmarBorrar(codigo,nombre){
  if (confirm("¿Quieres eliminar el producto:  "+codigo+"?"))
  {
   document.location.href="?orden=Borrar&codigo="+nombre;
  }
}