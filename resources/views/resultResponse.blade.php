<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Result Response-Lecturer</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .custom-row {
            height: 2000px;
            margin: 20px;
        }

        .custom-card-body {
            padding: 200px;
        }

    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
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
                    <span>Dashboard</span></a>
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
                    <span>Response Result </span></a>
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
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

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
                   

                    <!-- Content Row -->
                    <div class="row" >
                        <!-- Pie Chart -->
                        <div class="col">
                            <div class="card shadow mb-2" >
                                <div class="card-header py-3">
                                    <h1 class="h3 mb-2 font-weight-bold text-primary">Response Result Pie Chart</h1>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success" data-mdb-ripple-color="dark"  onclick="window.location.href = '{{ route('resultResponse') }}'">Refresh</button>
                                    </div>
                                </div>
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <div class="row w-100">
                                        <div class="col-6">
                                            <h6 class="m-0 font-weight-bold text-primary">
                                                <form id="filterForm" method="get" action="{{ route('resultResponse') }}">
                                                    <!-- Question Dropdown -->
                                                    <select id="questionId" name="questionId"  class="custom-select custom-select-sm form-control form-control-sm">
                                                        <option value="" selected disabled>Choose question </option>
                                                        @foreach ($Questions as $question)
                                                            <option value="{{ $question->questionId }}" {{ request('questionId') == $question->questionId ? 'selected' : '' }}>
                                                                {{ $question->questionTitle }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Filter Question</button>
                                                </form>
                                                @if ($selectedQuestion)
                                                    <div class="card-header py-3">
                                                        <h6 class="font-weight-bold text-primary">Selected Question : {{ $selectedQuestion->questionTitle }}</h6>
                                                    </div>
                                                @else
                                                    <div class="card-header py-3">
                                                        <h6 class="font-weight-bold text-primary">Selected Question : All</h6>
                                                    </div>
                                                @endif
                                            </h6>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="m-0 font-weight-bold text-primary">
                                                <form id="filterForm" method="get" action="{{ route('resultResponse') }}">
                                                    <!-- Question Step Dropdown -->
                                                    <select id="questionStepId" name="questionStepId" class="custom-select custom-select-sm form-control form-control-sm">
                                                        <option value="" >Choose question step</option>
                                                        @foreach ($QuestionSteps as $step)
                                                            <option value="{{ $step->questionStepId }}" {{ request('questionStepId') == $step->questionStepId ? 'selected' : '' }}>
                                                                Step {{ $loop->iteration }} , {{ $step->instruction }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="questionId" value="{{ request('questionId') }}">
                                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Filter Step</button>
                                                </form>
                                                <!-- Display selected question and question step -->
                                                @if ($selectedQuestionStep)
                                                    @php
                                                        $iteration = $QuestionSteps->search(function ($step) use ($selectedQuestionStep) {
                                                            return $step->questionStepId == $selectedQuestionStep->questionStepId;
                                                        }) + 1; // Adding 1 to make it 1-based index
                                                    @endphp
                                                    <div class="card-header py-3">
                                                        <h6 class="font-weight-bold text-primary">Selected Question Step : Step {{ $iteration }}, {{ $selectedQuestionStep->instruction }}</h6>
                                                    </div>
                                                @else
                                                    <div class="card-header py-3">
                                                        <h6 class="font-weight-bold text-primary">Selected Question Step : All</h6>
                                                    </div>
                                                @endif
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body mb-4">
                                    <div class="chart-pie">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="chartData" value="{{ $data }}">
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

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="noResponsesModal" tabindex="-1" role="dialog" aria-labelledby="noResponsesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noResponsesModalLabel">No Responses</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    There are no responses for the selected question.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
    <script src="{{ asset ('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Check if there are no responses for the selected question
            const hasResponses = @json($hasResponses);
    
            if (!hasResponses) {
                $('#noResponsesModal').modal('show');
            }
    
            // Pie Chart script goes here (refer to the updated pie.js)
        });
    </script>

</body>
</html>