$(document).ready(function(){
  $('.sidenav').sidenav();
  $('select').formSelect();
  $('.fixed-action-btn').floatingActionButton();
});
$(".dropdown-trigger").dropdown();
$(".dropdown-trigger2").dropdown();

function deleteItem(page, id) {
  $.confirm({
    title: '¡Lo vas a borrar!',
    content: '¿Realmente deseas borrarlo?',
    boxWidth: '30%',
    useBootstrap: false,
    theme: 'modern',
    buttons: {
        borrar: {
            btnClass: 'btn-red',
            action:  function() {
              $.ajax({
                method: "POST",
                url: "./actions/delete.php",
                data: { page, id }
              })
              .done(function() {
                location.reload();
              })
              .fail(function() {
                $.confirm({
                  title: '¡Imposible borrar!',
                  content: 'Puede que se esté usando en alguna otra parte',
                  type: 'red',
                  boxWidth: '30%',
                  useBootstrap: false,
                  typeAnimated: true,
                  theme: 'modern',
                  buttons: {
                      cerrar: function () {
                      }
                  }
                });
              });
            }
        },
        cancelar: {
          btnClass: 'btn-green'
        }
    }
  });
}