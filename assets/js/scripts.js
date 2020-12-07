
$('.file-upload').on('change', function (e) {
    e.preventDefault();
    let data = e.target.files[0]
    let file = URL.createObjectURL(data)
    $('.img-validation').append(`<div><img src="${file}" alt="${data.name}" class="img-thumbnail w-100"></div>`)
});
$('.btn-upload').on('click', function () {
    console.log('ok')
});

$(document).ready(function(){  
    $('#search').keyup(function(){  
         search_table($(this).val());  
    });  
    function search_table(value){  
         $('#the_table tr').each(function(){  
              var found = 'false';  
              $(this).each(function(){  
                   if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)  
                   {  
                        found = 'true';  
                   }  
              });  
              if(found == 'true')  
              {  
                   $(this).show();  
              }  
              else  
              {  
                   $(this).hide();  
              }  
         });  
    }  
});  

$(document).ready(function() {
     $('#dtBasicExample').DataTable();
     $('.dataTables_length').addClass('bs-select');
 });
// $(".prasmanan").hide();
$('.semua-status').on('click', function () {
     $(".paket").show();
     $(".prasmanan").show();
});
$('.paket-status').on('click', function () {
     $(".paket").show();
     $(".prasmanan").hide();
});
$('.prasmanan-status').on('click', function () {
     $(".paket").hide();
     $(".prasmanan").show();
});