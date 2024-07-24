<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Add Question-Lecturer</title>

        <!-- Custom fonts for this template -->
        <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

        <!-- Custom styles for this page -->
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        

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
                        <span>Response Result</span></a>
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

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h1 class="h3 m-0 font-weight-bold text-primary">Update Question</h1>
                                <div class="text-right">
                                    <button type="button" class="btn btn-success"  onclick="window.location.href='{{ route('listQuestionL') }}'">Return</button>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <form method="post" action="{{ url('updateQuestion/' . $questions->questionId) }}">
                                    {{ csrf_field() }}
                                    @method('PUT')
                                    <input type="hidden" id="deletedSteps" name="deletedSteps" value="">
                                    <div class="row row-cols-2">
                                        <div class="col mb-3">
                                            <label class="form-label">Question Difficulty</label>
                                            <div class="input-group mb-3">
                                                <select id="difficulty" class="form-control @error('difficulty') is-invalid @enderror" name="difficultyId" required autofocus>
                                                        @foreach ($difficultys as $difficulty)
                                                                <option value="{{ $difficulty->difficultyId }}" 
                                                                    {{ $difficulty->difficultyId === $questions->difficultyId ? 'selected' : '' }}> 
                                                                    {{ $difficulty->difficultyName }} 
                                                                </option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label">Question Topic</label>
                                            <div class="input-group mb-3">
                                                    <select id="topic" class="form-control @error('topic') is-invalid @enderror" name="topicId" required autofocus>
                                                        @foreach ($topics as $topic)
                                                                <option value="{{ $topic->topicId }}" 
                                                                    {{ $topic->topicId === $questions->topicId ? 'selected' : '' }}> 
                                                                    {{ $topic->topicName }} 
                                                                </option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label">Question Title</label>
                                            <div class="input-group mb-3">
                                                <input type="text" id="questionTitle" value="{{ $questions->questionTitle }}" name="questionTitle" 
                                                    class="form-control" aria-describedby="basic-addon3" required/>
                                            </div>
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label">Question Description</label>
                                            <div class="input-group mb-3">
                                                <textarea id="question" name="question" class="form-control" aria-describedby="basic-addon3" 
                                                          style="height: 150px; resize: none;" required>{{ $questions->question }}</textarea>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <!-- Question Steps -->
                                    @foreach($questionSteps as $index => $questionStep)
                                    <div id="row-{{ $questionStep->questionStepId }}">
                                        <div class="mb-3">
                                            <label class="form-label">Question Instruction (step {{ $index + 1 }})</label>
                                            <div class="input-group mb-3">
                                                <input type="hidden" name="steps[{{ $index }}][questionStepId]" value="{{ $questionStep->questionStepId }}">
                                                <input type="text" id="instruction" value="{{ $questionStep->instruction }}" name="steps[{{ $index }}][instruction]"
                                                    class="form-control" aria-describedby="basic-addon3" required />
                                                <div class="input-group-append">
                                                    <button class="btn btn-danger delete-row" data-id="{{ $questionStep->questionStepId }}" type="button"><i class="bi bi-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                   
                                        <div class="row row-cols-2">
                                            <div class="col mb-3">
                                                <label class="form-label">Question Formula</label>
                                                <div class="input-group mb-3">
                                                    <select id="formula" class="form-control @error('formula') is-invalid @enderror" name="steps[{{ $index }}][formulaId]" required autofocus>
                                                        @foreach ($formulas as $formula)
                                                                <option value="{{ $formula->formulaId }}" {{ $formula->formulaId === $questionStep->formulaId ? 'selected' : '' }}> 
                                                                    {{ $formula->formulaName }} , {{ $formula->formula }}
                                                                </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                       
                                            <div class="col mb-3">
                                                <label class="form-label">Question Answer</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" id="answer" step="0.0001"  value="{{ $questionStep->answer ?? 'N/A' }}" name="steps[{{ $index }}][answer]"
                                                        class="form-control" aria-describedby="basic-addon3" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- Below to add new question step -->
                                    <div id="newinput"></div>
                                    <!-- Add Step Button -->
                                    <div class="text-center">
                                        <button id="rowAdder" type="button" class="btn btn-primary"><i class="bi">Add Step</i></button>
                                    </div>
                                    <!-- Submit Button -->
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
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

        <!-- Success Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-success" id="successModalLabel">Success!</h5>
                    </div>
                    <div class="modal-body">
                        {{ session('success') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
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

         <!-- Include Bootstrap JS for alert dismissible functionality -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>

        <script>
            let questionStepCount = {{ count($questionSteps) }};
            let lastStepCount = questionStepCount;
            const formulas = @json($formulas);

            $("#rowAdder").click(function () {
                questionStepCount++;
                lastStepCount++;

                let newRowAdd =
                    `<div id="row-${lastStepCount}">
                        <hr class="dropdown-divider custom-divider">
                        <div class="mb-3">
                            <label class="form-label">Question Instruction (step ${lastStepCount})</label>
                            <div class="input-group mb-3">
                                <input type="hidden" name="steps[${lastStepCount - 1}][questionStepId]" value="">
                                <input type="text" class="form-control" id="instruction" name="steps[${lastStepCount - 1}][instruction]" aria-describedby="basic-addon3" required>
                                <div class="input-group-append">
                                    <button class="btn btn-danger delete-row" data-id="${lastStepCount}" type="button"><i class="bi bi-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-2">
                            <div class="col mb-3">
                                <label class="form-label">Question Formula</label>
                                <div class="input-group mb-3">
                                    <select id="formulaName" class="form-control @error('formulaName') is-invalid @enderror" name="steps[${lastStepCount - 1}][formulaId]" required autofocus>
                                        <option value="" selected disabled>Choose formula</option>
                                        ${formulas.map(formula => `<option value="${formula.formulaId}">${formula.formulaName} , ${formula.formula}</option>`).join('')}
                                    </select>
                                </div>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Question Answer</label>
                                <div class="input-group mb-3">
                                    <input type="number" step="0.0001" class="form-control" id="answer" name="steps[${lastStepCount - 1}][answer]" aria-describedby="basic-addon3" required>
                                </div>
                            </div>
                        </div>
                        <div id="newinput"></div>
                    </div>`;

                $('#newinput').append(newRowAdd);
                // Update the last step count
                lastStepCount = questionStepCount;
            });

            $("body").on("click", ".delete-row", function () 
            {
                let stepId = $(this).data("id");
                let deletedSteps = $("#deletedSteps").val();

                if (deletedSteps.length > 0) {
                    deletedSteps += `,${stepId}`;
                } else {
                    deletedSteps = stepId;
                }

                $("#deletedSteps").val(deletedSteps);
                $(this).closest("#row-" + stepId).remove();

                // Update the last step count by recounting the existing steps
                lastStepCount = $('#newinput #row').length + 1;
            });

            $(document).ready(function() {
                @if(session('success'))
                    $('#successModal').modal('show');
                @endif
            });
        </script>
    </body>
</html>