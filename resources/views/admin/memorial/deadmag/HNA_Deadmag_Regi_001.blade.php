@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">사이버 추모관 > 고인 관리 > 등록</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.deadmag.store') }}" method="POST" id="regi-form">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <colgroup>
                            <col style="width: 200px; background-color: #f8f9fc;">
                            <col>
                        </colgroup>
                        <tbody>
                            <tr>
                                <th class="align-middle">고인명 <span class="text-danger">*</span></th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">故</span>
                                        <input type="text" name="name" class="form-control w-25" value="{{ old('name') }}" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle">구분 <span class="text-danger">*</span></th>
                                <td>
                                    <select name="category" id="category-select" class="form-control w-25" required>
                                        <option value="">선택해주세요</option>
                                        <option value="하늘누리관" {{ old('category') == '하늘누리관' ? 'selected' : '' }}>하늘누리관</option>
                                        <option value="자연장" {{ old('category') == '자연장' ? 'selected' : '' }}>자연장</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle">안치장소 <span class="text-danger">*</span></th>
                                <td>
                                    <div id="location-fields-none" class="text-muted">구분을 선택해주시기 바랍니다.</div>
                                    
                                    <div id="location-fields-hall" style="display: none;">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">관 :</span>
                                            <select name="location_hall" class="form-control mr-3" style="width: 150px;">
                                                <option value="">선택해주세요</option>
                                                <option value="하늘">하늘관</option>
                                                <option value="누리">누리관</option>
                                                <option value="무궁화">무궁화관</option>
                                            </select>
                                            <span class="mr-2">열 :</span>
                                            <select name="location_row_hall" class="form-control mr-3" style="width: 100px;">
                                                <option value="">선택</option>
                                                @for($i=1; $i<=10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            <span class="mr-2">번호 :</span>
                                            <input type="text" name="location_num_hall" class="form-control" style="width: 100px;">
                                        </div>
                                    </div>

                                    <div id="location-fields-area" style="display: none;">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">구역 :</span>
                                            <select name="location_area" class="form-control mr-3" style="width: 150px;">
                                                <option value="">선택해주세요</option>
                                                <option value="A">A구역</option>
                                                <option value="B">B구역</option>
                                                <option value="C">C구역</option>
                                            </select>
                                            <span class="mr-2">열 :</span>
                                            <select name="location_row_area" class="form-control mr-3" style="width: 100px;">
                                                <option value="">선택</option>
                                                @for($i=1; $i<=20; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            <span class="mr-2">번호 :</span>
                                            <input type="text" name="location_num_area" class="form-control" style="width: 100px;">
                                        </div>
                                    </div>

                                    <input type="hidden" name="location_row" id="final-row">
                                    <input type="hidden" name="location_num" id="final-num">
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle">기일 <span class="text-danger">*</span></th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <select name="death_year" class="form-control mr-2" style="width: 120px;" required>
                                            @for($y=date('Y'); $y>=1900; $y--)
                                                <option value="{{ $y }}">{{ $y }}년</option>
                                            @endfor
                                        </select>
                                        <select name="death_month" class="form-control mr-2" style="width: 80px;" required>
                                            @for($m=1; $m<=12; $m++)
                                                <option value="{{ sprintf('%02d', $m) }}">{{ $m }}월</option>
                                            @endfor
                                        </select>
                                        <select name="death_day" class="form-control mr-2" style="width: 80px;" required>
                                            @for($d=1; $d<=31; $d++)
                                                <option value="{{ sprintf('%02d', $d) }}">{{ $d }}일</option>
                                            @endfor
                                        </select>
                                        <input type="hidden" name="death_date" id="death-date-full">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-5">등록</button>
                    <a href="{{ route('HNA_Deadmag_List_001') }}" class="btn btn-secondary px-5 ml-2">취소</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category-select');
    const hallFields = document.getElementById('location-fields-hall');
    const areaFields = document.getElementById('location-fields-area');
    const noneFields = document.getElementById('location-fields-none');

    function toggleFields() {
        const val = categorySelect.value;
        hallFields.style.display = 'none';
        areaFields.style.display = 'none';
        noneFields.style.display = 'none';

        if (val === '하늘누리관') {
            hallFields.style.display = 'block';
        } else if (val === '자연장') {
            areaFields.style.display = 'block';
        } else {
            noneFields.style.display = 'block';
        }
    }

    categorySelect.addEventListener('change', toggleFields);
    toggleFields(); // Initial call

    document.getElementById('regi-form').addEventListener('submit', function(e) {
        const cat = categorySelect.value;
        
        if (cat === '하늘누리관') {
            document.getElementById('final-row').value = document.querySelector('select[name="location_row_hall"]').value;
            document.getElementById('final-num').value = document.querySelector('input[name="location_num_hall"]').value;
        } else if (cat === '자연장') {
            document.getElementById('final-row').value = document.querySelector('select[name="location_row_area"]').value;
            document.getElementById('final-num').value = document.querySelector('input[name="location_num_area"]').value;
        }

        // 기일 조합
        const y = document.querySelector('select[name="death_year"]').value;
        const m = document.querySelector('select[name="death_month"]').value;
        const d = document.querySelector('select[name="death_day"]').value;
        document.getElementById('death-date-full').value = `${y}-${m}-${d}`;
    });
});
</script>
@endsection
