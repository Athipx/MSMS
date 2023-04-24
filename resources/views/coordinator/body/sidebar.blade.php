<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('coordinator.dashboard') }}" class="waves-effect">
                        <div class="d-inline-block icons-sm mx-1">
                            <i class="fas fa-th-large" style="color: #3051d3;"></i>
                        </div>
                        {{-- <span class="badge badge-pill badge-success float-right">3</span> --}}
                        <span>ພາບລວມລະບົບ</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block icons-sm mx-1">
                            <i class="fas fa-users" style="color: #3051d3;"></i>
                        </div>
                        <span>ຜູ້ໃຊ້ງານລະບົບ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('students.view') }}">ນັກສຶກສາ</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block icons-sm mx-1">
                            <i class="fas fa-money-check-alt" style="color: #3051d3;"></i>
                        </div>
                        <span>ຄ່າທຳນຽມ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('feeTypes.view') }}">ປະເພດຄ່າທຳນຽມ</a></li>
                        <li><a href="{{ route('fees.view') }}">ຊຳລະຄ່າທຳນຽມ</a></li>
                        <li><a href="{{ route('tutitions.view') }}">ຊຳລະຄ່າຮຽນ</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <div class="d-inline-block icons-sm mx-1"><span class="uim-svg" style=""><i
                                    class="fas fa-file-alt" style="color: #3051d3;"></i></span></div>
                        <span>ລາຍງານ</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true" style="height: 0px;">
                        <li><a href="{{ route('students.report') }}">ລາຍງານນັກສຶກສາ</a></li>
                        <li class=""><a href="javascript: void(0);" class="has-arrow"
                                aria-expanded="false">ລາຍງານຄ່າທຳນຽມ</a>
                            <ul class="sub-menu mm-collapse" aria-expanded="true" style="height: 0px;">
                                <li><a href="{{ route('fees.report') }}">ລາຍງານການຊຳລະຄ່າທຳນຽມ</a></li>
                                <li><a href="{{ route('tutitions.report') }}">ລາຍງານການຊຳລະຄ່າຮຽນ</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
