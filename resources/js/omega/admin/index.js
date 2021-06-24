
$(function () {
    $('.destroy button').click(function (e, from) {
        if (from == null) {  // user clicked it!
            var btn = $(this);
            e.preventDefault();
            Swal.fire({
                title: 'are_you_sure_QM',//'Are you sure?',
                text: 'wont_be_able_to_revert_EM',//"You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'confirm_delete_EM',//'Yes, delete it!',
                cancelButtonText: 'cancel_btn'// 'Cancel'
            }).then(function (result) {
                if (result.value) {
                    btn.trigger('click', ['valid']);
                }
            })
        }
    });
});
