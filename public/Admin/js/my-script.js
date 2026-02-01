function previewImage() {
    const image = document.querySelector("#image");

    const imgPreview = document.querySelector("#img-preview");

    imgPreview.style.display = "block";

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);
    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
}

// function showImage(e) {
//     console.log(e);

//     const showImageModal = document.querySelector("#showImage");

//     showImageModal.modal("show");
// }

$(document).ready(function () {
    // console.log($(".ongkir").addClass("d-none"));

    // Fungsi untuk simpan :
    $(".save-btn").click((e) => {
        e.preventDefault();

        let form = $("#submit-form");

        let total_harga_keseluruhan = $(
            'input[name="total_harga_keseluruhan"]'
        );

        // console.log(total_harga_keseluruhan);
        if (total_harga_keseluruhan.val() === "") {
            alert("Silahkan isi form dengan benar");
            return;
        }

        // jika file belum di input :
        var fileInput = $("#image").val(); // Ambil nilai input file

        if (fileInput === "") {
            alert("Silakan input bukti pembayaran terlebih dahulu!");
            return;
        }

        if (confirm("Apakah resi pembayaran sudah benar") == true) {
            form.submit();
        }
    });

    $('select[name="jenis_pengiriman"]').change((e) => {
        // console.log($(this).find(":selected").text());

        // ambil value jenis :

        let total_harga_keseluruhan = $(
            'input[name="total_harga_keseluruhan"]'
        );
        let jenis = $('input[name="jenis"]');

        let getText = $(this).find(":selected").text();

        let result = getText.split(": ")[1];

        if (result == "Pilih Jenis ") {
            total_harga_keseluruhan.val("");
            return;
        }

        let getNumber = result.split("{")[1].split("}")[0];

        let getJenis = result.split(" ")[0];
        // let getJenis =

        console.log(result);
        console.log(getJenis);
        jenis.val(getJenis);

        // Ubah total harga :

        let harga = $("#total_harga");

        let ttl = parseInt(harga.val()) + parseInt(getNumber);

        total_harga_keseluruhan.val(ttl);
    });

    $(".btn-showImage").click(function (e) {
        $("#showImageModal").modal("show");

        let data = $(this).data("image");

        let image = $("#modalImage");

        let img = image[0];
        img.src = "file/" + data;

        console.log(img);
    });

    // ==============================================================================================
    // For User :

    $("#jumlah").change((e) => {
        let harga = $("#total_harga");

        // harga = harga[0];

        let valueJumlah = e.currentTarget.value;

        let getHarga = harga.data("harga");

        let totalHarga = valueJumlah * parseInt(getHarga);

        let getInputBerat = $("input[name='berat']");

        console.log(getInputBerat.val());

        let totalBerat = parseInt(valueJumlah) * getInputBerat.val();

        console.log(totalBerat);

        $("input[name='weight']").val(totalBerat);

        harga.val(totalHarga);
        // console.log(totalHarga);
    });

    $(".provinsi").select2();

    $('select[name="province_destination"]').on("change", function () {
        let provindeId = $(this).val();

        if (provindeId == "") {
            $('select[name="city_destination"]').empty();
        }

        if (provindeId) {
            jQuery.ajax({
                url: "/cities/" + provindeId,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    $('select[name="city_destination"]').empty();
                    $('select[name="city_destination"]').append(
                        '<option value="">-- pilih kota tujuan --</option>'
                    );
                    $.each(response, function (key, value) {
                        $('select[name="city_destination"]').append(
                            '<option value="' + key + '">' + value + "</option>"
                        );
                    });
                },
            });
        } else {
            $('select[name="city_destination"]').append(
                '<option value="">-- pilih kota tujuan --</option>'
            );
        }
    });

    // click :
    $(".check-btn").click(function (e) {
        e.preventDefault();

        // console.log($("input[name='weight']").val());
        if ($("input[name='weight']").val() === "") {
            return alert("Silahkan isi berat barang");
        }

        let token = $("meta[name='csrf-token']").attr("content");
        // let city_origin = $("select[name=city_origin]").val();
        let city_destination = $("select[name=city_destination]").val();
        let courier = $("select[name=courier]").val();
        let weight = $("#weight").val();

        // if (isProcessing) {
        //     return;
        // }

        // isProcessing = true;
        jQuery.ajax({
            url: "/ongkir",
            data: {
                _token: token,
                // city_origin: city_origin,
                city_destination: city_destination,
                courier: courier,
                weight: weight,
            },
            dataType: "JSON",
            type: "POST",
            success: function (response) {
                // isProcessing =  false;
                if (response) {
                    const data = JSON.parse(response);
                    console.log(data["rajaongkir"]["results"]);
                    console.log(data["rajaongkir"]["query"]);
                    $("#ongkir").empty();
                    $(".ongkir").addClass("d-block");

                    $.each(
                        data["rajaongkir"]["results"][0]["costs"],
                        function (key, value) {
                            console.log(value.service);
                        }
                    );

                    console.log(data["rajaongkir"]["results"][0]["costs"]);

                    const code = data["rajaongkir"]["results"][0]["code"];
                    // $.each(response[0]["costs"], function (key, value) {

                    $('select[name="jenis_pengiriman"]').empty();
                    $.each(
                        data["rajaongkir"]["results"][0]["costs"],
                        function (key, value) {
                            $("#ongkir").append(
                                '<li class="list-group-item">' +
                                    code.toUpperCase() +
                                    " : <strong>" +
                                    value.service +
                                    "</strong> - Rp. " +
                                    value["cost"][0].value +
                                    " (" +
                                    value["cost"][0].etd +
                                    " hari)</li>"
                            );

                            $('select[name="jenis_pengiriman"]').append(
                                '<option value="' +
                                    key +
                                    '">' +
                                    code +
                                    " : " +
                                    value.service +
                                    " - Rp. {" +
                                    value["cost"][0].value +
                                    "} (" +
                                    value["cost"][0].etd +
                                    " hari)" +
                                    "</option>"
                            );

                            // $('select[name="jenis_pengiriman"]').append(
                            //     '<option value="' +
                            //         key +
                            //         '" data-harga="' +
                            //         value.cost[0].value +
                            //         '" data-etd="' +
                            //         value.cost[0].etd +
                            //         '">' +
                            //         response[0].code.toUpperCase() +
                            //         " : " +
                            //         value.service +
                            //         " - Rp. " +
                            //         value.cost[0].value +
                            //         " (" +
                            //         value.cost[0].etd +
                            //         " hari)" +
                            //         "</option>"
                            // );
                        }
                    );
                }
            },
        });
    });
});
