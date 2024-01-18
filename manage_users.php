<!DOCTYPE html>
<html>

<head>
    <title>eShop | Manage Users</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

</head>

<body style="background-color: #74EBD5; background-image: linear-gradient(90deg, #74EBD5 0%, #9FACE6 100%);">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center">
                <h2 class="text-primary fw-bold">Manage All Users</h2>
            </div>

            <div class="col-12 mt-3">
                <div class="row">
                    <div class="offset-0  offset-lg-3 col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-warning">Search Users</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 mb-3">
                <div class="row">
                    <div class="col-2 col-lg-1 bg-primary py-2 text-end">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>
                    <div class="col-2 bg-light py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Profile Image</span>
                    </div>
                    <div class="col-6 col-lg-2 bg-primary py-2">
                        <span class="fs-4 fw-bold text-white">User Name</span>
                    </div>
                    <div class="col-2 bg-light py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Email</span>
                    </div>
                    <div class="col-2 bg-primary py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Mobile</span>
                    </div>
                    <div class="col-2 bg-light py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Registered Date</span>
                    </div>
                    <div class="col-4 col=lg-1 bg-white"></div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-2 col-lg-1 bg-primary py-2 text-end">
                        <span class="fs-6 fw-bold text-white">01</span>
                    </div>
                    <div class="col-2 bg-light py-2 d-none d-lg-block" onclick="viewMsgModel();">
                        <img src="resources/user_profile_icon.png" style="height: 40px; margin-left: 80px;">
                    </div>
                    <div class="col-6 col-lg-2 bg-primary py-2">
                        <span class="fs-6 fw-bold text-white">Achira Dimuthu</span>
                    </div>
                    <div class="col-2 bg-light py-2 d-none d-lg-block">
                        <span class="fs-6 fw-bold">achira@gmail.coml</span>
                    </div>
                    <div class="col-2 bg-primary py-2 d-none d-lg-block">
                        <span class="fs-6 fw-bold text-white">0711219636</span>
                    </div>
                    <div class="col-2 bg-light py-2 d-none d-lg-block">
                        <span class="fs-6 fw-bold">2022-06-11</span>
                    </div>
                    <div class="col-4 col-lg-1 bg-white py-2 d-grid">
                        <button class="btn btn-danger">Block</button>
                    </div>
                </div>
            </div>

            <!-- model -->
            <div class="modal" tabindex="-1" id="viewmsgmodel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <!-- receved -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-8 rounded bg-success">
                                        <div class="row">
                                            <div class="col-12 pt-2">
                                                <span class="text-white fs-4">Hello Achira!</span>
                                            </div>
                                            <div class="col-12 text-end pb-2">
                                                <span class="text-white fs-6">2022-06-11 08:00:00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- receved -->

                            <!-- sent -->
                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="offset-4 col-8 rounded bg-primary">
                                        <div class="row">
                                            <div class="col-12 pt-2">
                                                <span class="text-white fs-4">Hello Achira!</span>
                                            </div>
                                            <div class="col-12 text-end pb-2">
                                                <span class="text-white fs-6">2022-06-11 08:20:00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- sent -->

                        </div>
                        <div class="modal-footer">

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-8">
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-4 d-grid">
                                        <button class="btn btn-primary">Send</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- model -->

        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>