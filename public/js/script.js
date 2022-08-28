$(() => {
    $(".delete-student").on('click', (elem) => {
        let id = $(elem.currentTarget).data('id')
        $('#deleteform' + id).submit()
    })
})