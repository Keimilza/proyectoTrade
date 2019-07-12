
var deleteModal = $('#deleteModal');

function deleteMsg(description,id){
    $(this).click(function(event){
        event.preventDefault();
    });
    deleteModal.modal('show');
    $('.modal-body').text(description);
    $('.modal-footer .btn-danger').attr('id',id);
}

$('.modal-footer .btn-danger .p1').on("click",(ev)=>{
    $('.modal-body').text(description);
    window.location.href="/deleteProduct/"+id;
});

$('.modal-footer .btn-danger .p2').on("click",(ev)=>{
    let id= $(ev.target).attr("id");
    window.location.href="/deleteProduct/"+id;
});
