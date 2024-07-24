<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Question-Lecturer</title>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .fullscreen-container,
        .fullscreen-create-container,
        .fullscreen-delete-container {
            display: none;
            display: none;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(90, 90, 90, 0.5);
            z-index: 9999;
        }
    
        .formContainer2 
        {
            max-width: 500px;
            max-height: 400px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
        }
    
        #popdiv2 
        {
            position: fixed;
            left: 50%;
            top: 3%;
            transform: translate(-50%, 5%);
            border-radius: 20px;
        }
    
        .formContainer input[type=text],
        .formContainer input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 20px 0;
            border: none;
            border-radius: 50px;
            background: #eee;
        }
    
        .formContainer input[type=text]:focus,
        .formContainer input[type=password]:focus {
            background-color: #ddd;
            outline: none;
            border-radius: 50px;
        }
    
        .formContainer .btn {
            padding: 4px 4px;
            border: none;
            background-color: #8ebf42;
            color: #fff;
            cursor: pointer;
            opacity: 0.8;
    
        }
    
        .formContainer .cancel {
            background-color: #cc0000;
        }
    
        .formContainer .btn:hover,
        .openButton:hover {
            opacity: 1;
        }
    
    
        .formContainer2 .cancel {
            background-color: #cc0000;
        }
    
        .formContainer2 .btn:hover,
        .openButton:hover {
            opacity: 1;
        }
    
        .button-container {
            display: flex;
            text-align: center;
            justify-content: space-between;
        }
    
        .headSubj {
            text-align: center;
        }
    </style>
    

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href='lecturer'>
                <div class="sidebar-brand-icon">
                    <i class="bi bi-amd"></i>
                </div>    
                <div class="sidebar-brand-text mx-3">QMT437 IntelliTutor</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href='lecturer'>
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href='listQuestionL'>
                    <i class="fas fa-fw fa-table"></i>
                    <span>List of Questions</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='questionForm'>
                    <i class="bi bi-file-earmark-plus-fill"></i>
                    <span>Add Questions</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('resultResponse') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Result Response</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">                         
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle bi bi-person-circle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                &nbsp;{{ Auth::user()->name }}
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h1 class="h3 m-0 font-weight-bold text-primary">List Of Question</h1>
                        </div>
                        <br>
                        <div class="d-flex justify-content-end mb-0.5">
                            <!-- Topbar Search -->
                            <div class="search-container d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
                                <form action='listQuestionL' method="GET">
                                    <input type="text" name="search" placeholder="Search..." class="form-control bg-light border-1 small">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-search fa-sm"></i></button>
                                </form>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px;">No.</th>
                                            <th>Question Number</th>
                                            <th>Topic</th>
                                            <th>Difficulty</th>
                                            <th>Upload by</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($questions as $question)
                                        <tr>
                                            <td align="center">{{ $loop->iteration }}</td>
                                            <td>{{ $question->questionTitle ?? 'N/A' }}</td>
                                            <td>{{ $question->topic->topicName ?? 'N/A' }}</td>
                                            <td>{{ $question->difficulty->difficultyName ?? 'N/A' }}</td>
                                            <td>{{ $question->user->name ?? 'N/A' }}</td>
                                            <td>{{ $question->created_at ?? 'N/A' }}</td>
                                            <td class="text-center">
                                                <a href={{ url('viewQuestionL/' . $question->questionId) }} class="btn btn-success btn-circle btn-sm"><i class="fa fa-search"></i></a>
                                                <a href={{ url('editQuestion/' . $question->questionId) }} class="btn btn-warning btn-circle btn-sm"><i class="fa fa-wrench"></i></a>
                                                <button class="btn3 btn-danger btn-circle btn-sm" data-question-id="{{ $question->questionId }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8">No data available</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="width: 50px;">No.</th>
                                            <th>Question Number</th>
                                            <th>Topic</th>
                                            <th>Difficulty</th>
                                            <th>Upload by</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <strong>QMT437 INTELLITUTOR</strong> 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete popup -->
    <div class="fullscreen-delete-container" style="display: none;">
        <div id="popdiv2">
            <form id="deleteForm" class="formContainer2" method="POST">
                @csrf
                @method('DELETE')
                <div class="headSubj">
                    <h3><strong>Are You Sure</strong></h3>
                    <label for="text">
                        <strong>You are about to delete the question!</strong>
                    </label>
                    <br><br>
                </div>
                <div class="button-container">
                    <button type="submit" class="btn btn-success">Yes</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-danger" id="but5">Cancel</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

    <script>
        $(function() {
            // Delete Confirmation
            $(".btn3").click(function() {
                var questionId = $(this).data("question-id");
                var deleteFormAction = "{{ route('deleteQuestion', ['questionId' => '__questionId__']) }}";
                deleteFormAction = deleteFormAction.replace('__questionId__', questionId);
                $("#deleteForm").attr("action", deleteFormAction);
                $(".fullscreen-delete-container").fadeIn(200);
            });
    
            $("#but5").click(function() {
                $(".fullscreen-delete-container").fadeOut(200);
            });
        });
    </script>
    
</body>
</html>