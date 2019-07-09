//alert("Hola mundo");

alert("prueba");
var deleteModal = $('#deleteModal');

function deleteMsg(blog,id,title){
    $(this).click(function(event){
        event.preventDefault();
    });
    deleteModal.modal('show');
    $('.modal-body').text(title);
    $('.modal-footer .btn-danger').attr('id',id);
}

$('.modal-footer .btn-danger').on("click",(ev)=>{
    let id= $(ev.target).attr("id");
    window.location.href="/delete-post/"+id;
});


document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, options);
  });

  // Initialize collapsible (uncomment the lines below if you use the dropdown variation)
  // var collapsibleElem = document.querySelector('.collapsible');
  // var collapsibleInstance = M.Collapsible.init(collapsibleElem, options);

  // Or with jQuery

  $(document).ready(function(){
    $('.sidenav').sidenav();
  });
