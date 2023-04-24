<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('teacher.dashboard') }}" class="waves-effect">
                        <div class="d-inline-block icons-sm mx-1">
                            <i class="fas fa-th-large" style="color: #3051d3;"></i>
                        </div>
                        {{-- <span class="badge badge-pill badge-success float-right">3</span> --}}
                        <span>ພາບລວມລະບົບ</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('students.view') }}" class="waves-effect">
                        <div class="d-inline-block icons-sm mx-1">
                            <i class="fas fa-users" style="color: #3051d3;"></i>
                        </div>
                        {{-- <span class="badge badge-pill badge-success float-right">3</span> --}}
                        <span>ນັກສຶກສາ</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block icons-sm mx-1">
                            <i class="fas fa-graduation-cap" style="color: #3051d3;"></i>
                        </div>
                        <span>ການສຶກສາ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('teacher.assigns.view') }}">ການຮຽນ-ສອນ</a></li>
                        <li><a href="{{ route('teacher.grades.view') }}">ຄະແນນການສຶກສາ</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <div class="d-inline-block icons-sm mx-1"><span class="uim-svg" style=""><i
                                    class="fas fa-file-alt" style="color: #3051d3;"></i></span></div>
                        <span>ລາຍງານ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('students.report') }}">ລາຍງານນັກສຶກສາ</a></li>
                        <li><a href="{{ route('teacher.assigns.report') }}">ລາຍງານການຮຽນ-ການສອນ</a></li>
                        <li><a href="{{ route('teacher.grades.report') }}">ລາຍງານຄະແນນການສຶກສາ</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
