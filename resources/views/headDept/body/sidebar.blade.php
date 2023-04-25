<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                {{-- <li class="menu-title">Menu</li> --}}
                {{-- <li>
                    <a class="waves-effect" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="d-inline-block icons-sm mx-1">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <span>ອອກຈາກລະບົບ</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                <hr> --}}
                <li>
                    <a href="{{ route('headDept.dashboard') }}" class="waves-effect">
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
                            <i class="fas fa-school" style="color: #3051d3;"></i>
                        </div>
                        <span>ວິຊາການ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('gen.view') }}">ຮຸ່ນການສຶກສາ</a></li>
                        <li><a href="{{ route('majors.view') }}">ສາຂາວິຊາ</a></li>
                        <li><a href="{{ route('semisters.view') }}">ພາກການສຶກສາ</a></li>
                        <li><a href="{{ route('classroom.view') }}">ຫ້ອງຮຽນ</a></li>
                        <li><a href="{{ route('subjects.view') }}">ວິຊາຮຽນ</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block icons-sm mx-1">
                            <i class="fas fa-graduation-cap" style="color: #3051d3;"></i>
                        </div>
                        <span>ການສຶກສາ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('assigns.view') }}">ການຮຽນ-ສອນ</a></li>
                        <li><a href="{{ route('grades.view') }}">ຄະແນນການສຶກສາ</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block icons-sm mx-1">
                            <i class="fas fa-book" style="color: #3051d3;"></i>
                        </div>
                        <span>ວິທະຍານິພົນ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="{{ route('presentation.view') }}">ການສອບຫົວຂໍ້</a></li> --}}
                        <li><a href="{{ route('theses.view') }}">ບັນດາວິທະຍານິພົນ</a></li>
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
                        <li class=""><a href="javascript: void(0);" class="has-arrow"
                                aria-expanded="false">ລາຍງານຜູ້ໃຊ້ງານລະບົບ</a>
                            <ul class="sub-menu mm-collapse" aria-expanded="true" style="height: 0px;">
                                <li><a href="{{ route('students.report') }}">ລາຍງານນັກສຶກສາ</a></li>
                                <li><a href="{{ route('teachers.report') }}">ລາຍງານອາຈານ</a></li>
                                <li><a href="{{ route('users.report') }}">ລາຍງານຜູ້ໃຊ້</a></li>
                            </ul>
                        </li>
                        <li class=""><a href="javascript: void(0);" class="has-arrow"
                                aria-expanded="false">ລາຍງານການສຶກສາ</a>
                            <ul class="sub-menu mm-collapse" aria-expanded="true" style="height: 0px;">
                                <li><a href="{{ route('assigns.report') }}">ລາຍງານການຮຽນ-ການສອນ</a></li>
                                <li><a href="{{ route('grades.report') }}">ລາຍງານຄະແນນການສຶກສາ</a></li>
                            </ul>
                        </li>
                        <li class=""><a href="javascript: void(0);" class="has-arrow"
                                aria-expanded="false">ລາຍງານວິທະຍານິພົນ</a>
                            <ul class="sub-menu mm-collapse" aria-expanded="true" style="height: 0px;">
                                <li><a href="{{ route('theses.report') }}">ລາຍງານບັນດາວິທະຍານິພົນ</a></li>
                            </ul>
                        </li>
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
