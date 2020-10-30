
$('.file-upload').on('change', function (e) {
    e.preventDefault();
    let data = e.target.files[0]
    let file = URL.createObjectURL(data)
    $('.img-validation').append(`<div><img src="${file}" alt="${data.name}" class="img-thumbnail w-100"></div>`)
});
$('.btn-upload').on('click', function () {
    console.log('ok')
});