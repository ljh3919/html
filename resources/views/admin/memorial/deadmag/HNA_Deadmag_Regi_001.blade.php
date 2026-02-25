@extends('layouts.admin')

@section('content')
<!-- title -->
<div class="wrap-tit">
    <h2 class="tit01">고인 관리</h2>
</div>

<form action="{{ route('admin.deadmag.store') }}" method="POST" id="regi-form">
    @csrf
    <!-- table -->
    <table class="table board-table vertical-table">
        <tr>
            <th class="required">고인명</th>
            <td>
                <div class="wrap-form">
                    <div class="bold-before" style="color: #5d401a;">故</div>
                    <div class="input-group h30">
                        <input type="text" name="name" class="input-box" style="width: 200px;" value="{{ old('name') }}" required />
                    </div>
                </div>
                @error('name')
                <div class="wrap-form mt-1">
                    <span class="error-message">
                        <span class="error-icon">!</span>
                        {{ $message }}
                    </span>
                </div>
                @enderror
            </td>
        </tr>
        <tr>
            <th class="required">구분</th>
            <td>
                <div class="wrap-form">
                    <div class="input-group h30">
                        <div class="select-wrapper">
                            <select name="category" id="category-select" class="input-box select" style="width: 200px;" required>
                                <option value="">선택해주세요</option>
                                <option value="하늘누리관" {{ old('category') == '하늘누리관' ? 'selected' : '' }}>하늘누리관</option>
                                <option value="자연장" {{ old('category') == '자연장' ? 'selected' : '' }}>자연장</option>
                            </select>
                        </div>
                    </div>
                </div>
                @error('category')
                <div class="wrap-form mt-1">
                    <span class="error-message">
                        <span class="error-icon">!</span>
                        {{ $message }}
                    </span>
                </div>
                @enderror
            </td>
        </tr>
        <tr>
            <th class="required">안치장소</th>
            <td>
                <div id="location-fields-none" class="wrap-form text-secondary small py-1">구분을 먼저 선택해 주세요.</div>
                
                <div id="location-fields-hall" style="display: none;">
                    <div class="wrap-form">
                        <div class="bold-before">관:</div>
                        <div class="input-group h30">
                            <div class="select-wrapper">
                                <select name="location_hall" class="input-box select" style="width: 150px;">
                                    <option value="">선택해주세요</option>
                                    <option value="하늘">하늘관</option>
                                    <option value="누리">누리관</option>
                                    <option value="무궁화">무궁화관</option>
                                </select>
                            </div>
                        </div>
                        <div class="bold-before ml-8">열:</div>
                        <div class="input-group h30">
                            <div class="select-wrapper">
                                <select name="location_row_hall" class="input-box select" style="width: 80px;">
                                    <option value="">선택</option>
                                    @for($i=1; $i<=10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="bold-before ml-8">번호:</div>
                        <div class="input-group h30">
                            <input type="text" name="location_num_hall" class="input-box" style="width: 80px;" />
                        </div>
                    </div>
                </div>

                <div id="location-fields-area" style="display: none;">
                    <div class="wrap-form">
                        <div class="bold-before">구역:</div>
                        <div class="input-group h30">
                            <div class="select-wrapper">
                                <select name="location_area" class="input-box select" style="width: 150px;">
                                    <option value="">선택해주세요</option>
                                    <option value="A">A구역</option>
                                    <option value="B">B구역</option>
                                    <option value="C">C구역</option>
                                </select>
                            </div>
                        </div>
                        <div class="bold-before ml-8">열:</div>
                        <div class="input-group h30">
                            <div class="select-wrapper">
                                <select name="location_row_area" class="input-box select" style="width: 80px;">
                                    <option value="">선택</option>
                                    @for($i=1; $i<=20; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="bold-before ml-8">번호:</div>
                        <div class="input-group h30">
                            <input type="text" name="location_num_area" class="input-box" style="width: 80px;" />
                        </div>
                    </div>
                </div>

                <input type="hidden" name="location_row" id="final-row">
                <input type="hidden" name="location_num" id="final-num">
            </td>
        </tr>
        <tr>
            <th class="required">기일</th>
            <td>
                <div class="wrap-form">
                    <div class="input-group h30">
                        <div class="select-wrapper">
                            <select name="death_year" class="input-box select" style="width: 120px;" required>
                                @for($y=date('Y'); $y>=1900; $y--)
                                    <option value="{{ $y }}" {{ old('death_year', date('Y')) == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="bold-after">년</div>
                    <div class="input-group h30 ml-8">
                        <div class="select-wrapper">
                            <select name="death_month" class="input-box select" style="width: 80px;" required>
                                @for($m=1; $m<=12; $m++)
                                    @php $mv = sprintf('%02d', $m); @endphp
                                    <option value="{{ $mv }}" {{ old('death_month', date('m')) == $mv ? 'selected' : '' }}>{{ $m }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="bold-after">월</div>
                    <div class="input-group h30 ml-8">
                        <div class="select-wrapper">
                            <select name="death_day" class="input-box select" style="width: 80px;" required>
                                @for($d=1; $d<=31; $d++)
                                    @php $dv = sprintf('%02d', $d); @endphp
                                    <option value="{{ $dv }}" {{ old('death_day', date('d')) == $dv ? 'selected' : '' }}>{{ $d }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="bold-after">일</div>
                    <input type="hidden" name="death_date" id="death-date-full">
                </div>
            </td>
        </tr>
    </table>

    <div class="wrap-board-btn">
        <div class="wrap-btn-left">
            <p class="text-danger small mb-0 mr-auto">* 표시항목은 필수입력 항목입니다.</p>
        </div>
        <div class="wrap-btn-right">
            <button type="button" class="btn line small" onclick="location.href='{{ route('HNA_Deadmag_List_001') }}'">
                <span>취소</span>
            </button>
            <button type="submit" class="btn primary small">
                <span>등록</span>
            </button>
        </div>
    </div>
</form>

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
    toggleFields();

    document.getElementById('regi-form').addEventListener('submit', function(e) {
        const cat = categorySelect.value;
        
        if (cat === '하늘누리관') {
            document.getElementById('final-row').value = document.querySelector('select[name="location_row_hall"]').value;
            document.getElementById('final-num').value = document.querySelector('input[name="location_num_hall"]').value;
        } else if (cat === '자연장') {
            document.getElementById('final-row').value = document.querySelector('select[name="location_row_area"]').value;
            document.getElementById('final-num').value = document.querySelector('input[name="location_num_area"]').value;
        }

        const y = document.querySelector('select[name="death_year"]').value;
        const m = document.querySelector('select[name="death_month"]').value;
        const d = document.querySelector('select[name="death_day"]').value;
        document.getElementById('death-date-full').value = `${y}-${m}-${d}`;
    });
});
</script>
@endsection
