/***
 * Filter/View Data in the bootstrap table.
 * 
 * */
function render(url) {
    $('#data-table-body').css({display: "none"});
    $('#spinner').css({display: "table-row-group"});
    $.ajax({
        url: url,
        method: "get",
        dataType: 'JSON',
        success: function (data) {
            $('#data-table-body').css({display: "table-row-group"}).html(data.result);
            $('#spinner').css({display: "none"});
            $('#paginationLinksContainer').html(data.links)
        },
        error: function (data) 
        {
            if (data.responseJSON.errors) {
                Object.keys(data.responseJSON.errors).forEach(function (key, index) {
                    data.responseJSON.errors[key].forEach(function (err) {
                        toastr.error(err);
                    })
                });
            } 
            else if (data.responseJSON.error)
                toastr.error(data.responseJSON.error);
            $('#spinner').css({display: "none"});

        }
    });
}
/***
 * Inject The data to bootstrap modals.
 * 
 * */
function injectModalData(resource_id, URL,form_id, method ,table_id=null)
{
    document.querySelector('#record_resource_id').value = resource_id;
    document.querySelector('#confirm_password_action_method').value = method;
    document.querySelector('#' + form_id).setAttribute('action', URL);
}
/***
 * Trash, restore or destroy a record
 * 
 * */
$(document).on('submit', '#confirm-password-form', function(event) 
{
    event.preventDefault();
    var url      = $(this).attr('action');
    var record   = document.getElementById('record_resource_id').value;
    var password = document.getElementById('inputAdminPass').value;
    var _method  = document.getElementById('confirm_password_action_method').value;
    var token    = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: url,
        method: _method,
        data: {
            _token:token,
            resource_id:record,
            admin_password:password
        },
        dataType: 'JSON',
        success: function (data) {
            if (data['code']===200) 
            {
                $('#confirm-password-modal').modal('toggle');
                toastr.success(data['message']);
                $('#tableRecord-' + data['item']).remove();
                $('#module-' + data['data']['module']).html(data['data']['trashesCount']).hide().fadeIn('slow');
            }
            if (data['code']===500) 
                toastr.error(data['message']);
            if (data['code']===101) 
                toastr.error(data['message']);
        },
        error: function (data) {
            if (data.responseJSON.errors) {
                Object.keys(data.responseJSON.errors).forEach(function (key, index) {
                    data.responseJSON.errors[key].forEach(function (err) {
                        toastr.error(err);
                    })
                });
            }
            else
                toastr.error('Failed, Please try again later.');
        }
    });
});

/***
 * Upload Multiple Files using dropzone js library.
 * 
 * */
 function uploadMultipleFiles(url, token)
 {
     Dropzone.options.myDropzone = 
     {
       url: url,
       sending: function(data, xhr, formData) {
         formData.append('_token',token);
       }      ,
       paramName: "files",
       uploadMultiple: true,
       parallelUploads: 2,
       maxFiles:50,
       maxFilesize: 50,
       addRemoveLinks: true,
       dictFileTooBig: 'Image is larger than 50MB',
       timeout: 10000,
       acceptedFiles: ".jpeg,.jpg,.png,.gif",
       success: function(file, done) 
       {
         if(done['code']==200)
             $('#data-table-body').html(done['data']['results']).hide().fadeIn('slow');
         else
             toastr.error('Failed, Try upload files later.');
       }
     };
 }