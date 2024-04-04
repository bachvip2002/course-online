function showMessage(res, formElement) {
    //show all error messages
    if (res.responseJSON != undefined) {

        for (const key in res.responseJSON.errors) {

            let classNameInput = `.ajax-msg-display-${key.replace(/\./g, '\\.')}`

            if ($(classNameInput).length > 0) {

                let element = $(formElement)
                    .find(classNameInput)

                // not show error message input input_disabled
                if (this.input_disabled == true) {
                    input_disabled = element
                        .closest('.form-ajax-validate')
                        .find('input[disabled],textarea[disabled]')

                    if (input_disabled.length > 0) {
                        continue
                    }
                }

                element.html(res.responseJSON.errors[key][0])

                element.closest('.form-ajax-validate')
                    .find('.ajax-input-css-display')
                    .addClass('is-invalid')
                    .addClass(this.classError?.inputCSS)

            }
        }

    }
}

function deleteMessage(formElement) {
    //remove all error messages
    if ($(formElement).find('.text-danger').length > 0) {

        $(formElement)
            .find('.is-invalid')
            .removeClass('is-invalid')
            .removeClass(this.classError?.inputCSS)

        $(formElement)
            .find('.text-danger')
            .html('')
    }
}


function failForm(res, formElement) {
    deleteMessage(formElement)
    showMessage(res, formElement)
}