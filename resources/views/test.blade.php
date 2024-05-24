<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }

        .card-header {
            cursor: pointer;
            background-color: #f8f9fa;
            /* Light gray background */
            border: 1px solid #dee2e6;
            /* Border to separate headers */
        }

        .card-header .btn-link {
            text-decoration: none;
            color: #007bff;
            /* Default link color */
        }

        .card-body {
            background-color: #ffffff;
            /* White background for card body */
        }

        .icon-logo {
            max-width: 40px;
            /* Larger size */
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <!-- Button untuk Membuka Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentModal">
            Tampilkan Petunjuk Pembayaran
        </button>

        <!-- Modal -->
        <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="paymentModalLabel">Petunjuk Pembayaran</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="accordion" id="paymentAccordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left text-dark font-weight-bold"
                                            type="button" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            <img src="{{ asset('dashboard/img/icons/gopay.svg') }}" alt="Logo Gopay"
                                                class="img-fluid icon-logo">
                                            GoPay
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#paymentAccordion">
                                    <div class="card-body">
                                        <p>Nomor Pembayaran: 0895363116278</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button
                                            class="btn btn-link btn-block text-left text-dark font-weight-bold collapsed"
                                            type="button" data-toggle="collapse" data-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            <img src="{{ asset('dashboard/img/icons/mandiri.svg') }}"
                                                alt="Logo Bank Mandiri" class="img-fluid icon-logo">
                                            Bank Mandiri
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#paymentAccordion">
                                    <div class="card-body">
                                        <p>Nomor Rekening: 1234567890</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <div>
                            <h5>Total Pembayaran: <strong>Rp 1.500.000</strong></h5>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>



</html>
