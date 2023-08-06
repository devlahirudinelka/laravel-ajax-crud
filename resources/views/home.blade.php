<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf" content="{{ 'csrf_token' }}">
    <title>Laravel Ajex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    {{-- data Table --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
    <style>
        .green {
            color: rgb(0, 81, 255);
            margin: 0px 10px;
        }

        .red {
            color: rgb(197, 60, 67);
            margin: 0px 10px;
        }

        .avatar-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #00ffea;
        }
    </style>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5 mb-5 shadow">
                    <div class="card-header d-flex justify-content-between align-item-center">
                        <h5>Student Managment</h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addStudentModal">
                            Add New Student <i class="bi bi-plus-circle-dotted mr-1"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="show_all_student_data"></div>
                    </div>
                </div>


                <!--Add Student Modal -->
                <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Student</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="#" method="POST" enctype="multipart/form-data" id="addNewStudentForm">
                                <div class="modal-body">

                                    @csrf
                                    <div class="row mt-2">
                                        <div class="col-lg">
                                            <label for="firstName">First Name :</label>
                                            <input type="text" name="firstName" class="form-control"
                                                placeholder="First Name" required>

                                        </div>
                                        <div class="col-lg">
                                            <label for="lastName">Last Name :</label>
                                            <input type="text" name="lastName" class="form-control"
                                                placeholder="Last Name" required>

                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-lg">
                                            <label for="email">Email :</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="hello@Email.com" required>

                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-lg">
                                            <label for="avatar">Avatar :</label>
                                            <input type="file" name="avatar" class="form-control"
                                                placeholder="coose file here" required>

                                        </div>

                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i
                                            class="bi bi-x"></i> Cancel</button>
                                    <button type="submit" class="btn btn-success" id="add_stu_btn"><i
                                            class="bi bi-check2"></i> Add New
                                        Student </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- Edit Student Mode --}}
                <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Student</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="#" method="POST" enctype="multipart/form-data"
                                id="updateStudentForm">
                                <div class="modal-body">

                                    @csrf
                                    <input type="hidden" name="user_id" id="user_id">
                                    <div class="row mt-2">
                                        <div class="col-lg d-flex justify-content-center">
                                            <div id="avatar" class="avatar-img"></div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-lg">
                                            <label for="firstName">First Name :</label>
                                            <input type="text" id="fName" name="firstName"
                                                class="form-control" placeholder="First Name" required>

                                        </div>
                                        <div class="col-lg">
                                            <label for="lastName">Last Name :</label>
                                            <input type="text" id="lName" name="lastName"
                                                class="form-control" placeholder="Last Name" required>

                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-lg">
                                            <label for="email">Email :</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="hello@Email.com" required>

                                        </div>
                                    </div>
                                    <div class="row mt-2">

                                        <div class="col-lg">
                                            <label for="avatar">Avatar :</label>
                                            <input type="file" id="avatar" name="avatar" class="form-control"
                                                placeholder="coose file here">

                                        </div>

                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i
                                            class="bi bi-x"></i> Cancel</button>
                                    <button type="submit" class="btn btn-success" id="update_stu_btn"><i
                                            class="bi bi-pencil-square"></i> Update this student </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- Jqury --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    {{-- dataTable --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#addNewStudentForm').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $('#add_stu_btn').text('Adding....');
                $.ajax({

                    url: `{{ route('store') }}`,
                    method: 'post',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(responce) {
                        if (responce.status == 200) {
                            let timerInterval
                            Swal.fire({
                                title: 'Added',
                                html: 'Student Added Successfuly',
                                timer: 2000,
                                backdrop: `rgba(0,0,123,0.4)`,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer().querySelector(
                                        'b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    console.log('Added Byee !')
                                }
                            })
                            $('#add_stu_btn').text('Add Student');
                            $('#addNewStudentForm')[0].reset();
                            $('#addStudentModal').modal('hide');
                            fetchAllStudent();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                footer: '<a href="">Why do I have this issue?</a>'
                            })
                        }
                    }
                });
            });
            $('.userEditBtn').click();
            $(document).on('click', '.userEditBtn', function(e) {
                e.preventDefault();
                var id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('edit') }}',
                    method: 'get',
                    data: {
                        'id': id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(responce) {
                        $('#fName').val(responce.first_name);
                        $('#lName').val(responce.last_name);
                        $('#email').val(responce.email);
                        $('#avatar').html(
                            `<img src="storage/avatar/${responce.avatar}"  class="img-thumbnail rounded-circle">`
                        );
                        $('#user_id').val(responce.id);
                    }
                })

            })
            fetchAllStudent();

            function fetchAllStudent() {
                $.ajax({
                    url: '{{ route('fetchAll') }}',
                    method: 'get',
                    success: function(responce) {
                        console.log(responce);
                        $('#show_all_student_data').html(responce);
                        $('#stuTable').DataTable();
                    }
                });

            }
            $('#updateStudentForm').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $('#update_stu_btn').text('Updating...');
                $.ajax({

                    url: `{{ route('update') }}`,
                    method: 'post',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(responce) {
                        if (responce.status == 200) {
                            let timerInterval
                            Swal.fire({
                                title: 'Updated',
                                html: 'Student Updated Successfuly',
                                timer: 2000,
                                backdrop: `rgba(0,0,123,0.4)`,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer().querySelector(
                                        'b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    console.log('Added Byee !')
                                }
                            })
                            $('#update_stu_btn').text('Update this student');
                            $('#updateStudentForm')[0].reset();
                            $('#editStudentModal').modal('hide');
                            fetchAllStudent();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                footer: '<a href="">Why do I have this issue?</a>'
                            })
                        }
                    }
                });
            });
            $('.userEditBtn').click();
            $(document).on('click', '.userEditBtn', function(e) {
                e.preventDefault();
                var id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('edit') }}',
                    method: 'get',
                    data: {
                        'id': id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(responce) {
                        $('#fName').val(responce.first_name);
                        $('#lName').val(responce.last_name);
                        $('#email').val(responce.email);
                        $('#avatar').html(
                            `<img src="storage/avatar/${responce.avatar}"  class="img-thumbnail rounded-circle">`
                        );
                        $('#user_id').val(responce.id);
                    }
                })

            })
        })
    </script>
</body>

</html>
