

$(function () {
    $('.destroy button').click(function (e, from) {
        if (from == null) {  // user clicked it!
            var btn = $(this);
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(function (result) {
                if (result.value) {
                    btn.trigger('click', ['valid']);
                }
            })
        }
    });
});