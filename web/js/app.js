
var deleteModal = $('#deleteModal');

function deleteMsg(description,id){
    $(this).click(function(event){
        event.preventDefault();
    });
    deleteModal.modal('show');
    $('.modal-body').text(description);
    $('.modal-footer .btn-danger').attr('id',id);
}

$('.modal-footer .btn-danger').on("click",(ev)=>{
    let id= $(ev.target).attr("id");
    window.location.href="/deleteProduct/"+id;
});