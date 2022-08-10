function confirmDelete(e,id,name){
    e.preventDefault();
    console.log(e);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to restore " + name,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#7e3af2',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete'+id).submit();
        }
    })
}
