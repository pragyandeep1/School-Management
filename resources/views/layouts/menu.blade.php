<ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:#00004d;">

            <!-- Sidebar - Brand -->

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
                @if(Auth::user()->role == 1)
                <div class="sidebar-brand-text mx-3">School Admin <sup></sup></div>
                @elseif(Auth::user()->role == 2)
                <div class="sidebar-brand-text mx-3">School <sup></sup></div>
                @elseif(Auth::user()->role == 3)
                <div class="sidebar-brand-text mx-3">Branch <sup></sup></div>
                @elseif(Auth::user()->role == 4)
                <div class="sidebar-brand-text mx-3">Teacher <sup></sup></div>
                @elseif(Auth::user()->role == 5)
                <div class="sidebar-brand-text mx-3">Student <sup></sup></div>
                @endif
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            @if(Auth::user()->role == 1)
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('school-list') }}">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>School</span>
                </a>
            </li>
            
            @endif
            
            @if(Auth::user()->role == 1 || Auth::user()->role == 2)
           
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('branch-list') }}">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Branch</span>
                </a>
            </li>
            @endif

            @if(Auth::user()->role == 1 || Auth::user()->role == 5)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('student-list')}}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Students</span>
                </a>
            </li>
            @endif

              @if(Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3 || Auth::user()->role == 4 || Auth::user()->role == 5)
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Academic"
                        aria-expanded="true" aria-controls="Academic">
                        <i class="fas fa-address-card"></i>
                        <span>Academic</span>
                    </a>
                    <div id="Academic" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ URL::route('academic.class') }}">
                                <i class="fa fa-sitemap"></i> <span>Class</span>
                            </a>
                            <a class="collapse-item" href="{{ URL::route('liveclass-list') }}">
                                <i class="fa fa-sitemap"></i> <span>Live Class</span>
                            </a>
                            <a class="collapse-item" href="{{ URL::route('academic.section') }}">
                                <i class="fa fa-cubes"></i> <span>Section</span>
                            </a>
                            <a class="collapse-item" href="{{ URL::route('assignments.index') }}">
                                <i class="fa fa-cubes"></i> <span>Assign List</span>
                            </a>
                        </div>
                    </div>
                </li> 
                @endif     

            @if(Auth::user()->role == 1)

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Teacher"
                    aria-expanded="true" aria-controls="Teacher">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Teacher</span>
                </a>
                <div id="Teacher" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ URL::route('teacher-list') }}">Teacher List</a>
                        <a class="collapse-item" href="{{ URL::route('attendance-form') }}">
                            <i class="fa fa-cubes"></i> <span>Attendance Form</span>
                        </a>
                    </div>
                </div>
            </li>
           
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('department-list') }}">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Department</span>
                </a>
            </li>

            @endif
            
            @if(Auth::user()->role == 1)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('subject-list') }}">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Subject</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('parent-list') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Parents</span>
                </a>
            </li>
            @endif
            
            @if(Auth::user()->role == 2 || Auth::user()->role == 3)
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Accounting"
                    aria-expanded="true" aria-controls="Accounting">
                    <i class="fas fa-fw fa-bell"></i>
                    <span>Accounting</span>
                </a>
                <div id="Accounting" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="{{route('fee-manager')}}">Student Fee Manager</a>
                        <a class="collapse-item" href="{{ route('offline-payment')}}">Offline Payment Manager</a>
                        <a class="collapse-item" href="{{route('expense-manager')}}">Expense Manager</a>
                        <a class="collapse-item" href="{{ route('expense-category')}}">Expense Category</a>
                    </div>
                </div>
            </li>
            @endif
            
            <!-- Nav Item - Pages Collapse Menu -->
            @if(Auth::user()->role == 1)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('user-list') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>