let header_url = "http://localhost/wiggle/";
// USER

$(".files-pesan").on("change", function (event) {
	let data = event.target.files[0];
	$(".name-files-pesan").html(data.name);
	$(".pesan-img").attr("src", URL.createObjectURL(data));
});

var loadFile = function (event) {
	var image = document.getElementById("output");
	image.src = URL.createObjectURL(event.target.files[0]);
};
// END USER
$(".kota").hide();
// RAJA ONGKIR
$.ajax({
	type: "GET",
	url: header_url + "frontend/provinsi",
	dataType: "json",
	success: function (res) {
		$.each(res, function (i, val) {
			$(".provinsi").append(
				'<option value = "' +
				val.province_id +
				'" >' +
				val.province +
				"</option>"
			);
		});
	},
});

$(".provinsi").change(function (e) {
	e.preventDefault();
	$(".kota").show();
	$(".kota").html("");
	let data = $(this).val();
	$.ajax({
		type: "GET",
		url: header_url + "frontend/kota/" + data,
		dataType: "json",
		success: function (res) {
			$.each(res, function (i, val) {
				$(".kota").append(
					'<option value = "' +
					val.city_id +
					'" >' +
					val.city_name +
					"</option>"
				);
			});
		},
	});
});
// END RAJA ONGKIR
$(".kurir").on("click", function (e) {
	let kur = $(this).val();
	let kota = $(".kota").val();
	$.ajax({
		type: "GET",
		url: "http://localhost/wiggle/frontend/tarif/" + kur + "/" + kota,
		dataType: "json",
		success: function (response) {
			$(".status").html("");
			$(".paket").html("");
			$.each(response[0].costs, function (i, val) {
				var reverse = val.cost[0].value.toString().split("").reverse().join(""),
					ribuan = reverse.match(/\d{1,3}/g);
				ribuan = ribuan.join(".").split("").reverse().join("");
				$(".paket").append(
					'<option value = "' +
					val.cost[0].value +
					'" >' +
					val.description +
					"</option>"
				);
				$(".status").append(
					"<small id='emailHelp' class='form-text text-success'>'Status :'" +
					val.description +
					"(" +
					val.cost[0].etd +
					" Hari) Rp." +
					ribuan +
					"</small>"
				);
			});
		},
	});
});
$(".pay-bill").click(function (event) {
	event.preventDefault();
	// event.preventDefault();
	let nama = $(".nama").val();
	let alamat = $(".alamat").val();
	let kota = $(".kota").val();
	let kode_pos = $(".kode_pos").val();
	let telp = $(".telpon").val();
	let text = $(".paket option:selected").text();
	let val = $(".paket option:selected").val();
	// console.log(text + " harga :" + val);
	fetch(header_url + "frontend/paket/" + val + "/" + text);
	fetch(
		header_url +
		"frontend/customer/" +
		nama +
		"/" +
		alamat +
		"/" +
		kota +
		"/" +
		kode_pos +
		"/" +
		telp
	);
	$(this).attr("disabled", "disabled");
	$.ajax({
		url: header_url + "snap/token",
		cache: false,
		success: function (data) {
			snap.pay(data, {
				onSuccess: function (result) {
					$("#nota").val(result.order_id);
					$("#status").val(result.status_message);
					window.open(result.pdf_url);
					$("#payment-form").submit();
				},
				onPending: function (result) {
					$("#nota").val(result.order_id);
					$("#status").val(result.status_message);
					window.open(result.pdf_url);
					$("#payment-form").submit();
				},
				onError: function (result) {
					console.log(result.status_message);
					window.open(result.pdf_url);
					$("#payment-form").submit();
				},
			});
		},
	});
});


let pesan = $('.alert-on').data('pesan')
if(pesan == 'berhasil'){
		Swal.fire({
			icon: 'success',
			title: 'Berhasil',
			text: 'Data Berhasil Dimasukan',
			// footer: '<a href>Why do I have this issue?</a>'
		})
}else{
	if(pesan=='gagal'){
		Swal.fire({
			icon: 'error',
			title: 'Gagal',
			text: 'Data Gagal Dimasukan',
			// footer: '<a href>Why do I have this issue?</a>'
		})
	}
}

