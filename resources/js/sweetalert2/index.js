import * as $ from 'jquery';
import Swal from 'sweetalert2';

export default (function () {
    $(document).on('click', "form.delete button", function(e) {
        var _this = $(this);
        e.preventDefault();
        Swal.fire({
            title: 'are_you_sure_QM',//'Are you sure?', // Opération Dangereuse
            text: 'are_you_sure_to_continue_QM',//'Are you sure to continue ?', // Êtes-vous sûr de continuer ?
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: 'null',
            cancelButtonColor: 'null',
            confirmButtonClass: 'btn btn-danger',
            cancelButtonClass: 'btn btn-primary',
            confirmButtonText: 'confirm_btn',//'Yeah, sure!', // Oui, sûr
            cancelButtonText: 'cancel_btn'//'Cancel', // Annuler
        }).then(res => {
            if (res.value) {
                _this.closest("form").submit();
            }
        });
    });
}())
