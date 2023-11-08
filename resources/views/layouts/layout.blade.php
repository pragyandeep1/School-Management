<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <!-- Custom fonts for this template-->
    <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css')}}">
    <!-- End plugin css for this page -->

    <!-- Custom styles for this template-->
    <link href="{{asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
   
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar bg-gradient-primary -->
        @include('layouts/menu')
        
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                 @include('layouts/menu-topbar')
                
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-4 text-gray-800">Blank Page</h1> -->


                    @yield('content')

                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('layouts/footer')
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top bg-secondary" style="border-radius: 50%;" href="#page-top">
        <i class="fas fa-angle-up fa-lg"></i>
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('admin/js/sb-admin-2.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.4/dayjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script src="{{asset('admin/js/timepicker-bs4.js')}}" defer="defer"></script>
    <script src="{{asset('assets/vendors/fuelux/js/spinner.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Select2 Multiple
            $('.select2-multiple-branch').select2({
                placeholder: "Select Branch",
                allowClear: true
            });
            $('.select2-multiple-school').select2({
                placeholder: "Select School",
                allowClear: true
            });
            /*$('#designation').select2({
                placeholder: "Pick a designation",
                allowClear: true
            });*/
            $('.class,.teacher').select2({
                placeholder: "Select School",
                allowClear: true
            });

        });
        document.addEventListener('DOMContentLoaded', function () {
            jQuery('#start_time, #end_time, #appt_time, #meet_time, #odd_time').timepicker({
            
            });
        });

    </script>

    
    <!-- Start Data Tables -->
    <script src="{{asset('assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('assets/js/data-table.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>

    <!-- End Data Tables -->
<script>
    $(document).ready(function() {
        // Fetch the user count from your Laravel route
            $.get('/get-user-count', function(data) {
                if (data.userCount !== undefined) {
                    // Update the content of the element with class "h5"
                    $('.card1 .h5').text(data.userCount);
                }
            });
            $.get('/get-payment-count', function(data) {
                if (data.paymentCount !== undefined && data.paymentCount >= 0) {
                    // Update the content of the element with class "h5" for card2
                    $('.card2 .h5').text(data.paymentCount);
                } else {
                    // Display "0" when the count is not defined or negative for card2
                    $('.card2 .h5').text('0');
                }
            });
            $.get('/get-task-count', function(data) {
                if (data.userCount !== undefined) {
                    // Calculate the percentage
                    var totalSubjects = data.userCount; // Assuming the task count is equivalent to the subject count
                    var percentage = (totalSubjects / 100) * 100;

                    // Update the percentage text and progress bar
                    $('#subjectPercentage').text(percentage + '%');
                    $('.progress-bar').css('width', percentage + '%').attr('aria-valuenow', percentage);
                } else {
                    // Display an error message if the data is not available
                    $('#subjectPercentage').text('Error');
                }
            });
        $('.card1').click(function() {
            // Define the URL you want to navigate to
            var url = "{{'user-list'}}";            
            // Redirect to the URL
            window.open(url, '_blank');
        });
        /*$('.card2').click(function() {
            // Define the URL you want to navigate to
            var url = "{{'offline-payment'}}";            
            // Redirect to the URL
            window.open(url, '_blank');
        });*/
        $('.card3').click(function() {
            // Define the URL you want to navigate to
            var url = "{{'subject-list'}}";            
            // Redirect to the URL
            window.open(url, '_blank');
        });
        /*$('.card4').click(function() {
            // Define the URL you want to navigate to
            var url = "{{'admission-list'}}";            
            // Redirect to the URL
            window.open(url, '_blank');
        });*/
    });
</script>

<script>
        // Add an event listener to the phone number input
        $(document).ready(function () {
            $('#phone').on('input', function () {
                // Get the current value of the input
                var phoneNumber = $(this).val();
                
                // Check if the length exceeds 10 characters
                if (phoneNumber.length > 10) {
                    // Trim the input to 10 characters
                    phoneNumber = phoneNumber.substring(0, 10);
                    
                    // Update the input with the trimmed value
                    $(this).val(phoneNumber);
                }
            });
        });
</script>
    <script>
        // Add an event listener to the phone number input
        $(document).ready(function () {
            $('#phone1').on('input', function () {
                // Get the current value of the input
                var phoneNumber = $(this).val();
                
                // Check if the length exceeds 10 characters
                if (phoneNumber.length > 10) {
                    // Trim the input to 10 characters
                    phoneNumber = phoneNumber.substring(0, 10);
                    
                    // Update the input with the trimmed value
                    $(this).val(phoneNumber);
                }
            });
        });
        $(document).ready(function () {
            $('#pin').on('input', function () {
                // Get the current value of the input
                var pincode = $(this).val();
                
                // Check if the length exceeds 6 characters
                if (pincode.length > 6) {
                    // Trim the input to 6 characters
                    pincode = pincode.substring(0, 6);
                    
                    // Update the input with the trimmed value
                    $(this).val(pincode);
                }
            });
        });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteLinks = document.querySelectorAll(".delete-school");

        deleteLinks.forEach(link => {
            link.addEventListener("click", function(event) {
                event.preventDefault();
                const schoolId = this.getAttribute("data-school-id");
                const confirmation = confirm("Are you sure you want to delete this school?");

                if (confirmation) {
                    // User confirmed the deletion, send a POST request to delete the school
                    const form = document.createElement("form");
                    form.method = "POST";
                    form.action = this.href;
                    form.style.display = "none";

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const csrfInput = document.createElement("input");
                    csrfInput.type = "hidden";
                    csrfInput.name = "_token";
                    csrfInput.value = csrfToken;

                    const schoolIdInput = document.createElement("input");
                    schoolIdInput.type = "hidden";
                    schoolIdInput.name = "school_id";
                    schoolIdInput.value = schoolId;

                    form.appendChild(csrfInput);
                    form.appendChild(schoolIdInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
</script>

<!-- <script>
    $(document).ready(function () {
        $('form').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/accounting/expenses',
                data: $(this).serialize(),
                success: function (data) {
                }
            });
        });
    });

</script> -->

<!-- <script>
    // Get references to the checkbox and input fields
    const guardianExistsCheckbox = document.getElementById('guardian_exists');
    const parentNameInput = document.getElementById('parent_name');
    const relationInput = document.getElementById('relation');
    const occupationInput = document.getElementById('occupation');
    const incomeInput = document.getElementById('income');
    const educationInput = document.getElementById('education');
    const cityInput = document.getElementById('city');
    const stateInput = document.getElementById('state');
    const mobileInput = document.getElementById('mobile');
    const emailInput = document.getElementById('name');
    const addressTextarea = document.querySelector('textarea[address="guardian_address"]');
    const systemLogoInput = document.querySelector('input[name="system_logo"]');
    const usernameInput = document.querySelector('input[name="guardian_username"]');
    const passwordInputs = document.querySelectorAll('input[name="guardian_password"]');

    // Function to disable or enable the input fields
    function toggleInputs() {
        const isDisabled = guardianExistsCheckbox.checked;

        parentNameInput.disabled = isDisabled;
        parentNameInput.style.display = isDisabled ? "none" : "block";
        relationInput.disabled = isDisabled;
        relationInput.style.display = isDisabled ? "none" : "block";
        occupationInput.disabled = isDisabled;
        occupationInput.style.display = isDisabled ? "none" : "block";
        incomeInput.disabled = isDisabled;
        incomeInput.style.display = isDisabled ? "none" : "block";
        educationInput.disabled = isDisabled;
        educationInput.style.display = isDisabled ? "none" : "block";
        cityInput.disabled = isDisabled;
        cityInput.style.display = isDisabled ? "none" : "block";
        stateInput.disabled = isDisabled;
        stateInput.style.display = isDisabled ? "none" : "block";
        mobileInput.disabled = isDisabled;
        mobileInput.style.display = isDisabled ? "none" : "block";
        emailInput.disabled = isDisabled;
        emailInput.style.display = isDisabled ? "none" : "block";
        addressTextarea.disabled = isDisabled;
        addressTextarea.style.display = isDisabled ? "none" : "block";
        systemLogoInput.disabled = isDisabled;
        systemLogoInput.style.display = isDisabled ? "none" : "block";
        usernameInput.disabled = isDisabled;
        usernameInput.style.display = isDisabled ? "none" : "block";

        for (const passwordInput of passwordInputs) {
            passwordInput.disabled = isDisabled;
            passwordInput.style.display = isDisabled ? "none" : "block";
        }
    }

    // Add an event listener to the checkbox
    guardianExistsCheckbox.addEventListener('change', toggleInputs);

    // Initially, check the checkbox's status and disable inputs if needed
    toggleInputs();
</script> -->

<script>
     $(document).ready(function () {
        $('#school_id').on('change', function () {
            var schoolId = this.value;
            $("#branch_id").html('');
                if (schoolId) {
                $.ajax({
                    url: '/get-branches/' + schoolId,
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        branch_id: schoolId,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (result) {
                        // Clear the current options
                        $('select[name="select_branch"]').empty();
                        $('#branch_id').html('<option value="">Select</option>');
                        // Add new options based on the response
                        $.each(result, function (key, value) {
                            $('select[name="select_branch"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
                } else {
                $('select[name="select_branch"]').empty();
            }
        });
        $('#branch_id').on('change', function () {
                var branchId = this.value;
                $("#teacher_id").html('');
                console.log('('+branchId+')');
                if (branchId) {
                $.ajax({
                    url: '/get-teachers/' + branchId,
                    type: "GET",
                    dataType: 'json',
                    data: {
                        teacher_id: branchId,
                        _token: '{{csrf_token()}}',
                        // alert(""+teacherId+"")
                    },
                    success: function (result) {
                        $('select[name="select_teacher"]').empty();
                        $('#teacher_id').html('<option value="">Select</option>');
                        $.each(result, function (key, value) {
                                $('select[name="select_teacher"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }

                });
                } else {
                $('select[name="select_teacher"]').empty();
            }

            });
        $('#branch_id').on('change', function () {
                var branchId = this.value;
                $("#class_id").html('');
                if (branchId) {
                $.ajax({
                    url: '/get-classes/' + branchId,
                    type: "GET",
                    dataType: 'json',
                    data: {
                        class_id: branchId,
                        _token: '{{csrf_token()}}',
                    },
                    success: function (result) {
                        $('select[name="select_class"]').empty();
                        $('#class_id').html('<option value="">Select</option>');
                        $.each(result, function (key, value) {
                                $('select[name="select_class"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
                } else {
                $('select[name="select_class"]').empty();
            }

            });
        /*$('#teacher_id').on('change', function () {
                var teacherId = this.value;
                $("#class_id").html('');
                if (teacherId) {
                $.ajax({
                    url: '/get-classes/' + teacherId,
                    type: "GET",
                    dataType: 'json',
                    data: {
                        class_id: teacherId,
                        _token: '{{csrf_token()}}',
                        // alert(""+teacherId+"")
                    },
                    success: function (result) {
                        $('select[name="select_class"]').empty();
                        $('#class_id').html('<option value="">Select</option>');
                        $.each(result, function (key, value) {
                                $('select[name="select_class"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }

                    // alert(""+teacherId+"");
                });
                } else {
                $('select[name="select_class"]').empty();
            }

            });*/
        $('#class_id').on('change', function () {
                var classId = this.value;
                $("#section_id").html('');
                if (classId) {
                $.ajax({
                    url: '/get-sections/' + classId,
                    type: "GET",
                    dataType: 'json',
                    data: {
                        section_id: classId,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (result) {
                        $('select[name="select_section"]').empty();
                        $('#section_id').html('<option value="">Select</option>');
                        $.each(result, function (key, value) {
                                $('select[name="select_section"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
                } else {
                $('select[name="select_section"]').empty();
            }

            });
            $('#section_id').on('change', function () {
                var sectionId = this.value;
                $("#student_id").html('');
                if (sectionId) {
                $.ajax({
                    url: '/get-students/' + sectionId,
                    type: "GET",
                    dataType: 'json',
                    data: {
                        section_id: sectionId,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (result) {
                        $('select[name="select_student"]').empty();
                        $('#student_id').html('<option value="">Select</option>');
                        $.each(result, function (key, value) {
                                $('select[name="select_student"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
                } else {
                $('select[name="select_student"]').empty();
            }

            });
            /*$('#section_id').on('change', function () {
                var sectionId = this.value;
                $("#teacher_id").html('');
                if (sectionId) {
                $.ajax({
                    url: '/get-teachers/' + sectionId,
                    type: "GET",
                    dataType: 'json',
                    data: {
                        section_id: sectionId,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (result) {
                        $('select[name="select_teacher"]').empty();
                        $('#teacher_id').html('<option value="">Select</option>');
                        $.each(result, function (key, value) {
                                $('select[name="select_teacher"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
                } else {
                $('select[name="select_teacher"]').empty();
            }

            });*/
    });
</script>

<script>
    $(document).ready(function () {
        // Listen for changes to the select dropdown
        $('select[name="status"]').on('change', function () {
            var selectedStatus = $(this).val();

            // Update the text of all buttons to match the selected status
            if (selectedStatus === '1') {
                $('button[data-status="0"]').text('Present');
            } else if (selectedStatus === '0') {
                $('button[data-status="1"]').text('Absent');
            }
        });

        // Listen for button clicks and update the button text and data-status attribute
        $('button[data-status]').on('click', function () {
            var currentStatus = $(this).attr('data-status');

            // Toggle the status and update the button text
            currentStatus = currentStatus === '1' ? '0' : '1';
            $(this).attr('data-status', currentStatus);
            $(this).text(currentStatus === '1' ? 'Present' : 'Absent');
        });
    });
</script>

<script>
        $(document).ready(function () {
            var dataTable = $('#student_table').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "/attendance-form/",
                    type: "GET",
                    data: {
                        action: 'index_fetch'
                    }
                }
            });

            $('.input-daterange').datepicker({
                todayBtn: "linked",
                format: "yyyy-mm-dd",
                autoclose: true,
                container: '#formModal modal-body'
            });

            $(document).on('click', '.search', function () {
                var student_id = $(this).attr('id');
                $('#student_id').val(student_id);
                $('#formModal').modal('show');
            });

            $('#create_report').click(function () {
                var student_id = $('#student_id').val();
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                var error = 0;
                if (from_date == '') {
                    $('#error_from_date').text('From Date is Required');
                    error++;
                } else {
                    $('#error_from_date').text('');
                }
                if (to_date == '') {
                    $('#error_to_date').text('To Date is Required');
                    error++;
                } else {
                    $('#error_to_date').text('');
                }

                if (error == 0) {
                    $('#from_date').val('');
                    $('#to_date').val('');
                    $('#formModal').modal('hide');
                    window.open("/attendance-form?action=student_report&student_id=" + student_id + "&from_date=" + from_date +
                        "&to_date=" + to_date);
                }
            });
        });
    </script>

{{--<script>
document.getElementById("fetch-student-details").addEventListener("click", function() {
    // Retrieve the selected teacher and date values
    const selectedTeacher = document.getElementById("teacher_id").value;
    const selectedDate = document.getElementById("scheduledate").value;

    // Check if a teacher and date have been selected
    if (selectedTeacher !== "Select Teacher" && selectedDate) {
        // Perform an AJAX request to fetch student details
        fetch(`/get-student-details?teacher=${selectedTeacher}&date=${selectedDate}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    // Generate HTML for the student details
                    const studentDetailsHTML = data.map(student => `
                        <div>
                            <input type="checkbox" name="attendance[]" value="${student.id}" id="student_${student.id}">
                            <strong>Student Name</strong> <br>${student.name}<br>
                            <strong>Roll</strong> <br>${student.roll_no}<br>
                        </div>
                    `).join("");

                    // Update the student-details container with the generated HTML
                    document.getElementById("student-details").innerHTML = studentDetailsHTML;
                    document.getElementById("no-results-alert").style.display = "none"; // Hide the "No Results Found" alert

                    // Show the "Update" button
                    document.getElementById("update-attendance-button").style.display = "block";
                } else {
                    // If no students are available for the selected teacher and date, display the "No Results Found" alert
                    document.getElementById("student-details").innerHTML = "";
                    document.getElementById("no-results-alert").style.display = "block";
                    document.getElementById("update-attendance-button").style.display = "none";
                }
            })
            .catch(error => {
                console.error(error);
                // Handle error here
            });
    }
});
</script>--}}



<script>
    $(document).ready(function() {
        $('#subject').tagsinput();
    });
</script>
</body>

</html>