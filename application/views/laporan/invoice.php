<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Style the header with a grey background and some padding */
        .header {
            overflow: hidden;
            background-color: #f1f1f1;
            padding: 20px 10px;
        }

        /* Style the header links */
        .header div {
            float: left;
            color: black;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            line-height: 25px;
            border-radius: 4px;
        }

        /* Style the logo link (notice that we set the same value of line-height and font-size to prevent the header to increase when the font gets bigger */
        .header div.logo {
            font-size: 25px;
            font-weight: bold;
        }

        /* Change the background color on mouse-over */
        .header div:hover {
            background-color: #ddd;
            color: black;
        }

        /* Style the active/current link*/
        .header div.active {
            background-color: dodgerblue;
            color: white;
        }

        /* Float the link section to the right */
        .header-right {
            float: right;
        }

        /* Add media queries for responsiveness - when the screen is 500px wide or less, stack the links on top of each other */
        @media screen and (max-width: 500px) {
            .header a {
                float: none;
                display: block;
                text-align: left;
            }

            .header-right {
                float: none;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">KATERING KU</div>
        <!-- <div class="header-right">
            <a class="active" href="#home">Home</a>
            <a href="#contact">Contact</a>
            <a href="#about">About</a>
        </div> -->
    </div>

    <div style="padding-left:20px">
        <h1>TERIMA KASIH TELAH MELAKUKAN PEMESANAN</h1>
        <h2>Setelah Melakukan Pemesanan Lakukan Langkah Berikut Sebegai Berikut :</h2>
        <ol>
            <h3>
                <li>Lakukan tranfer Bank sesuai nominal total pemesanan <br> Pilihan Bank :
                    <ol>
                        <?php foreach ($bank as $key => $value) {
                            echo "<li>$key : $value</li>";
                        } ?>

                    </ol>
                </li>
                <li>Foto Atau Screenshot Bukti Tranfer via Bank</li>
                <li>Buka menu keranjang <br> <img src="<?= base_url('assets/img/langkah_transfer/langkah1.png') ?>" alt="" srcset=""></li>
                <li>Pilih pesanan yang sudah di tranfer <br> <img src="<?= base_url('assets/img/langkah_transfer/langkah2.png') ?>" alt="" srcset=""></li>
                </li>
                <li>Lakukan validasi dengan mengirim bukti foto atau screenshot tranfer via bank</li>
            </h3>
        </ol>
    </div>
</body>

</html>