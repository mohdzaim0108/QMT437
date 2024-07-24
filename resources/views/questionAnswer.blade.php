<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Student-Question Answer</title>

        <!-- Custom fonts for this template -->
        <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

        <!-- Custom styles for this page -->
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="{{ asset('css/bs-stepper.min.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
        <!-- BS-Stepper CSS -->

    </head>
    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href='#'>
                    <div class="sidebar-brand-icon">
                        <i class="bi bi-amd"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">QMT437 IntelliTutor</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href='#'>
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <!--<div class="sidebar-heading">
                    Interface
                </div>-->

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link" href='listQuestionS'>
                        <i class="fas fa-fw fa-table"></i>
                        <span>List of Question</span></a>
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

                        <!-- Page Heading
                        <h1 class="h3 mb-2 text-gray-800">Question : {{ $questions->questionTitle }}</h1>-->

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h1 class="h3 m-0 font-weight-bold text-primary">Answer Question : {{ $questions->questionTitle }}</h1>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success" data-mdb-ripple-color="dark"  onclick="window.location.href = '{{ route('listQuestionS') }}'">Return</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="bs-stepper">
                                    <div class="bs-stepper-header" role="tablist">
                                        @if(session('message'))
                                            <div class="alert alert-success">
                                                {{ session('message') }}
                                            </div>
                                        @endif
                                        <!-- Dynamically generate stepper steps -->
                                        @foreach ($questionSteps as $index => $step)
                                            <div class="step" data-target="#step-{{ $index + 1 }}">
                                                <button type="button" class="step-trigger" role="tab" aria-controls="step-{{ $index + 1 }}" id="step-{{ $index + 1 }}-trigger">
                                                    <span class="bs-stepper-circle">{{ $index + 1 }}</span>
                                                    <span class="bs-stepper-label">Step {{ $index + 1 }}</span>
                                                </button>
                                            </div>
                                            @if ($index < count($questionSteps) - 1)
                                                <div class="line"></div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="bs-stepper-content">
                                        <div class="row row-cols-2-middle">
                                            <div class="col mb-3-middle">
                                                <label class="form-label-middle">Question Description</label>
                                                <div class="input-group mb-3">
                                                    <textarea id="question" name="question" class="form-control" aria-describedby="basic-addon3" 
                                                        style="height: 150px; resize: none;" readonly>{{ $questions->question }}</textarea>
                                                </div>                                            
                                            </div>
                                        </div>
                                        @foreach ($questionSteps as $index => $step)
                                        <form method="post" action="{{ route('checkAnswer', ['questionId' => $questions->questionId, 'questionStepId' => $step->questionStepId]) }}" id="form-step-{{ $index + 1 }}" class="step-form">
                                            @csrf
                                            <div id="step-{{ $index + 1 }}" class="content" role="tabpanel" aria-labelledby="step-{{ $index + 1 }}-trigger">
                                                <div class="mb-3">
                                                    <label class="form-label">Question Instruction (step {{ $index + 1 }})</label>
                                                    <div class="input-group mb-3">
                                                        <textarea type="text" id="instruction" name="instruction" class="form-control" aria-describedby="basic-addon3" readonly>{{ $step->instruction }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row row-cols-2">
                                                    <div class="col mb-3">
                                                        <label class="form-label">Question Answer</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" step="0.0001" class="form-control" id="answer" name="answer" aria-describedby="basic-addon3" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    @if ($index > 0)
                                                        <button type="button" class="btn btn-info" id="prev-button" onclick="stepper.previous()" >Prev</button>
                                                    @endif
                                                    @if ($index < count($questionSteps) - 1)
                                                    <button type="button" class="btn btn-info" onclick="stepper.next()" id="next-step-{{ $index + 1 }}" style="display: none;">Next</button>
                                                    @endif
                                                    <button type="submit" class="btn btn-success" id="submit-step-{{ $index + 1 }}">Submit Step Answer</button>
                                                </div>
                                                <div class="text-right">
                                                @if ($index == count($questionSteps) - 1)
                                                        <button type="button" class="btn btn-warning" id="summary-button" onclick="showSummary()" style="display: none;">Summary</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                        @endforeach
                                    </div>
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

        <!-- Result Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Result</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span id="modalMessage"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        @if ($index < count($questionSteps) - 1)
                            <button type="button" class="btn btn-primary" id="modalNextButton" onclick="nextStep()">Next</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

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
        <script src="{{ asset('js/bs-stepper.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
        <!-- BS-Stepper JS -->

        <script>
            var stepper = new Stepper(document.querySelector('.bs-stepper'));
    
            @foreach ($questionSteps as $index => $step)
                $('#form-step-{{ $index + 1 }}').on('submit', function(e) 
                {
                    e.preventDefault();
    
                    var form = $(this);
                    var actionUrl = form.attr('action');
    
                    $.ajax({
                        type: 'POST',
                        url: actionUrl,
                        data: form.serialize(),
                        success: function(response) {
                            var modalMessage = $('#modalMessage');
                            var modalNextButton = $('#modalNextButton');

                            if(response.success) {
                                modalMessage.text(response.message);
                                modalNextButton.show();
                                $('#next-step-{{ $index + 1 }}').show();
                                $('#submit-step-{{ $index + 1 }}').hide();

                                // Show Summary button if this is the last step
                                if ({{ $index }} == {{ count($questionSteps) - 1 }}) 
                                {
                                    $('#summary-button').show();
                                }
                            } else {
                                modalMessage.text(response.message);
                                modalNextButton.hide();
                                $('#prev-step-{{ $index + 1 }}').show();
                            }

                            $('#successModal').modal('show');
                        },
                        error: function(xhr) {
                            var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred. Please try again.';
                            alert(errorMessage);
                        }
                    });
                });
            @endforeach
    
            function nextStep() {
                stepper.next();
                $('#successModal').modal('hide');
            }

            function showSummary() {
                // Redirect to the summary page
                window.location.href = "{{ route('summaryAnswer', ['questionId' => $questions->questionId]) }}";
            }
    
            @if (session('successModal'))
                $(document).ready(function() {
                    $('#successModal').modal('show');
                });
            @endif
        </script>
        
    </body>
</html>
