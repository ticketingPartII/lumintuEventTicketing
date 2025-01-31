<!doctype html>
<?php
    session_start();
    $cred = $_SESSION['cred'];

    $customerURL = 'http://lumintu-tiket.tamiaindah.xyz:8055/items/customer';

    $curl = curl_init();

    //get customer ID
    curl_setopt($curl, CURLOPT_URL, $customerURL . '?&filter[customer_code]=' . $_SESSION['cred']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $responseID = curl_exec($curl);
    $resultID = json_decode($responseID, true);
    $customerEmail = $resultID['data'][0]['customer_email'];

    curl_close($curl);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- Independent CSS-->
    <link rel="stylesheet" href="../public/css/details.css">
    <link rel="stylesheet" href="../public/css/slider.css">
    <link rel="stylesheet" href="../public/css/loader.css">

    <title>Details Event | Lumintu Event</title>
</head>
<script>
    // Deklarasi Function Show Pop Up Sukses
    const showPopUp = () => {
        Swal.fire({
            icon: 'success',
            title: 'Invitation Success!',
            showConfirmButton: true,
            confirmButtonColor: '#3085d6',
            text: "Your Invitation is Completed! Please check the invitee's email.",
        })
    }

    // Deklarasi Function Show Pop Up Email Exist
    const showPopUpError = () => {
        Swal.fire({
            icon: 'error',
            title: 'Invitation Failed!',
            showConfirmButton: true,
            confirmButtonColor: '#3085d6',
            text: `Failed!"`,
        })
    }
</script>

<!-- <?php
    if (isset($_GET['scs'])){
        echo '<script type="text/javascript">
                showPopUp();
            </script>';
    }else{
        echo '<script type="text/javascript">showPopUpError();</script>';
    }
?> -->

    <script>
        // Deklarasi Function Show Pop Up Sukses
        const showPopUp = () => {
            Swal.fire({
                icon: 'success',
                title: 'Invitation Success!',
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                text: "Your Invitation is Completed! Please check the invitee's email.",
            })
        }

        // Deklarasi Function Show Pop Up Email Exist
        const showPopUpError = () => {
            Swal.fire({
                icon: 'error',
                title: 'Invitation Failed!',
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                text: `Failed!"`,
            })
        }
    </script>

    <!-- <?php
        if (isset($_GET['scs'])){
            echo '<script type="text/javascript">
                    showPopUp();
                </script>';
        }else{
            echo '<script type="text/javascript">showPopUpError();</script>';
        }
    ?> -->

<body>
    <div class="container-fluid banner-event mb-4">
        <div class="container deskripsi d-flex align-items-center justify-content-start">
            <div class="jumbotron rounded my-auto p-lg-5 p-sm-3 p-3">
                <h1 class="h3 nama-event"></h1>
                <h4 class="h5 tanggal eventClient mb-4"></h4>
                <p class="text-white eventAddress"></p>
                <button class="btn btn-buy" data-toggle="modal" data-target="#exampleModalScrollable" type="button">Buy
                    Ticket
                </button>
            </div>
        </div>


    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 description">
                <p class="h5 title-event mb-3">Description</p>
                <p class="text-justify eventDesc"></p>
            </div>

            <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="header-popup modal-title container">
                                <p class="h3 text-center">Dream World Wide in Jogja</p>
                                <p class="organizer text-center">By Lumintu Logic</p>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="body-form" name="bodyForm" method="post"
                                action="../controller/insertInvitationProcess.php">
                                <div class="body-popup mx-3">
                                    <div class="peserta rounded mb-3" id="peserta1">
                                        <div class="row special mb-2 align-items-center">
                                            <div class="col-12 text-right ">
                                                <div class="toggle-buyMe">
                                                    <label class="switch">
                                                        <input type="checkbox" class="switchMe">
                                                        <span class="slider round"></span>
                                                    </label>
                                                    <small class="mr-1 my-auto">Use Voucher</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row input-section mb-1">
                                            <div class="col-12 col-lg-3 col-md-3 col-sm-12 my-auto">
                                                <p class="m-0 p-0 urutan">Peserta 1</p>
                                            </div>
                                            <div class="col-10 col-lg-7 col-md-7 col-sm-10 my-auto">

                                                <input type="email" name="peserta1" class="form-control"
                                                    id="inputPeserta1" aria-describedby="emailHelp"
                                                    placeholder="example : ex@gmail.com" oninput="validate(this.name)"
                                                    value="<?php echo $customerEmail; ?>" readonly>
                                                <small id="emailHelpBlock" class="form-text text-danger d-none">
                                                    Your email is not valid!
                                                </small>
                                            </div>
                                            <div class="col-2 col-lg-2 col-md-2 col-sm-2 my-auto">
                                                <button class="btn btn-danger btn-delete btn-sm rounded-0" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Delete" disabled
                                                    onclick="deleteField()"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                            </form>

                        </div>

                        <div class="modal-footer border-0">
                            <div class="m-0 mb-2 mt-5 d-none input-voucher p-0 w-100">
                                <div class="container-fluid row mx-auto">
                                    <input type="text" name="voucher" class="form-control text-center col-10 w-100"
                                        id="inputVoucherCode" aria-describedby="voucherHelp" placeholder="Voucher Code">
                                    <button class="btn btn-danger col-2 btn-check">Check</button>
                                </div>
                            </div>
                            <div class="text-center m-0 p-0 w-100">
                                <div class="container-fluid row mx-auto">
                                    <button class="btn btn-invite col-10" type="submit">Invite</button>
                                    <div class="text-right btn-plus col-2">
                                        <button type="button"
                                            class="btn btn-default btn-circle btn-lg rounded-circle mx-auto"
                                            onclick="addInputFieldInvitation()">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="header-carousel">
                    <div class="owl-carousel owl-theme">
                    </div>
                </div>

                <div class="body-session">
                    <div class="table-responsive">
                        <table class="table">
                            <div class="spinner-border text-primary spinner-event d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="outer d-none" id="loader">
        <div class="middle">
            <div class="inner text-center">
                <blockquote class="blockquote text-center">
                    <p class="mb-0">Sabar dan ikhlas bisa menjadikan kamu seorang yang mulia dan terhormat di dunia
                        sekalipun kamu bukan apa-apa.</p>
                    <footer class="blockquote-footer">Someone famous in <cite title="Source Title">PINTAR</cite>
                    </footer>
                </blockquote>
                <div class="spinner-border text-light" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Bootstrap CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>

    <!-- Font Awesome CDN -->
    <script src="https://use.fontawesome.com/7a7a4d3981.js"></script>

    <!-- SweetAlert2 CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- OwlCarousel2 CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- MomentJS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Independent Js -->
    <script src="../public/js/details.js"></script>

</body>

</html>