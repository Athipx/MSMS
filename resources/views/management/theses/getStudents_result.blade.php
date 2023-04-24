@if ($students->count() > 0)
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('thesis.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">ຊື່ຫົວບົດວິທະຍານິພົນ (ລາວ)<span class="text-danger">*</span></label>
                    <input name="title_lo" type="text" class="form-control"
                        placeholder="ປ້ອນຊື່ຫົວບົດວິທະຍານິພົນພາສາລາວ...">
                </div>
                <div class="form-group">
                    <label for="">ຊື່ຫົວບົດວິທະຍານິພົນ (English)<span class="text-danger">*</span></label>
                    <input name="title_en" type="text" class="form-control"
                        placeholder="ປ້ອນຊື່ຫົວບົດວິທະຍານິພົນພາສາອັງກິດ...">
                </div>
                <div class="form-group">
                    <label for="">ນັກສຶກສາ<span class="text-danger">*</span></label>
                    <select name="student" id="" class="form-control">
                        <option value="">-- ເລືອກ ນັກສຶກສາ --</option>
                        @foreach ($students as $student)
                            <option value="">{{ $student->user->fname_lo }} {{ $student->user->fname_lo }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>
        <hr>
        <button class="btn btn-primary btn-lg" type="submit"><i class="fas fa-save mr-2"></i>ບັນບຶກ</button>
    </form>
@else
    <p>ບໍ່ພົບຂໍ້ມູນ.</p>
@endif
