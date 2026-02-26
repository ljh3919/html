@extends('layouts.admin')

@section('content')
<!-- title -->
<div class="wrap-tit">
    <h2 class="tit01">고인 관리</h2>
</div>

<form id="modi-form" action="{{ route('admin.deadmag.update', $dead->id) }}" method="POST">
    @csrf
    @method('PUT')
    <!-- table -->
    <table class="table board-table vertical-table">
        <tr>
            <th class="required">고인명</th>
            <td>
                <div class="wrap-form">
                    <div class="bold-before" style="color: #5d401a;">故</div>
                    <div class="input-group h30">
                        <input type="text" name="name" class="input-box" style="width: 200px;" value="{{ old('name', $dead->name) }}" required />
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
                                <option value="하늘누리관" {{ old('category', $dead->category) == '하늘누리관' ? 'selected' : '' }}>하늘누리관</option>
                                <option value="자연장" {{ old('category', $dead->category) == '자연장' ? 'selected' : '' }}>자연장</option>
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
                <div id="location-fields-hall" style="{{ old('category', $dead->category) == '하늘누리관' ? '' : 'display: none;' }}">
                    <div class="wrap-form">
                        <div class="bold-before">관:</div>
                        <div class="input-group h30">
                            <div class="select-wrapper">
                                <select name="location_hall" class="input-box select" style="width: 150px;">
                                    <option value="">선택해주세요</option>
                                    <option value="하늘" {{ $dead->category == '하늘누리관' && $dead->location_hall == '하늘' ? 'selected' : '' }}>하늘관</option>
                                    <option value="누리" {{ $dead->category == '하늘누리관' && $dead->location_hall == '누리' ? 'selected' : '' }}>누리관</option>
                                    <option value="무궁화" {{ $dead->category == '하늘누리관' && $dead->location_hall == '무궁화' ? 'selected' : '' }}>무궁화관</option>
                                </select>
                            </div>
                        </div>
                        <div class="bold-before ml-8">열:</div>
                        <div class="input-group h30">
                            <div class="select-wrapper">
                                <select name="location_row_hall" class="input-box select" style="width: 80px;">
                                    <option value="">선택</option>
                                    @for($i=1; $i<=10; $i++)
                                        <option value="{{ $i }}" {{ $dead->category == '하늘누리관' && $dead->location_row == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="bold-before ml-8">번호:</div>
                        <div class="input-group h30">
                            <input type="text" name="location_num_hall" class="input-box" style="width: 80px;" value="{{ $dead->category == '하늘누리관' ? $dead->location_num : '' }}" />
                        </div>
                    </div>
                </div>

                <div id="location-fields-area" style="{{ old('category', $dead->category) == '자연장' ? '' : 'display: none;' }}">
                    <div class="wrap-form">
                        <div class="bold-before">구역:</div>
                        <div class="input-group h30">
                            <div class="select-wrapper">
                                <select name="location_area" class="input-box select" style="width: 150px;">
                                    <option value="">선택해주세요</option>
                                    <option value="A" {{ $dead->category == '자연장' && $dead->location_area == 'A' ? 'selected' : '' }}>A구역</option>
                                    <option value="B" {{ $dead->category == '자연장' && $dead->location_area == 'B' ? 'selected' : '' }}>B구역</option>
                                    <option value="C" {{ $dead->category == '자연장' && $dead->location_area == 'C' ? 'selected' : '' }}>C구역</option>
                                </select>
                            </div>
                        </div>
                        <div class="bold-before ml-8">열:</div>
                        <div class="input-group h30">
                            <div class="select-wrapper">
                                <select name="location_row_area" class="input-box select" style="width: 80px;">
                                    <option value="">선택</option>
                                    @for($i=1; $i<=20; $i++)
                                        <option value="{{ $i }}" {{ $dead->category == '자연장' && $dead->location_row == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="bold-before ml-8">번호:</div>
                        <div class="input-group h30">
                            <input type="text" name="location_num_area" class="input-box" style="width: 80px;" value="{{ $dead->category == '자연장' ? $dead->location_num : '' }}" />
                        </div>
                    </div>
                </div>

                <input type="hidden" name="location_row" id="final-row" value="{{ $dead->location_row }}">
                <input type="hidden" name="location_num" id="final-num" value="{{ $dead->location_num }}">
            </td>
        </tr>
        <tr>
            <th class="required">기일</th>
            <td>
                <div class="wrap-form">
                    @php
                        $death_at = \Carbon\Carbon::parse($dead->death_date);
                    @endphp
                    <div class="input-group h30">
                        <div class="select-wrapper">
                            <select name="death_year" class="input-box select" style="width: 120px;" required>
                                @for($y=date('Y'); $y>=1900; $y--)
                                    <option value="{{ $y }}" {{ $death_at->year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="bold-after">년</div>
                    <div class="input-group h30 ml-8">
                        <div class="select-wrapper">
                            <select name="death_month" class="input-box select" style="width: 80px;" required>
                                @for($m=1; $m<=12; $m++)
                                    <option value="{{ sprintf('%02d', $m) }}" {{ $death_at->month == $m ? 'selected' : '' }}>{{ $m }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="bold-after">월</div>
                    <div class="input-group h30 ml-8">
                        <div class="select-wrapper">
                            <select name="death_day" class="input-box select" style="width: 80px;" required>
                                @for($d=1; $d<=31; $d++)
                                    <option value="{{ sprintf('%02d', $d) }}" {{ $death_at->day == $d ? 'selected' : '' }}>{{ $d }}</option>
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
        <div class="text-info">표시항목은 필수입력 항목입니다.</div>
        <div class="wrap-btn-right">
            <button type="button" class="btn line small" onclick="location.href='{{ route('HNA_Deadmag_View_001', $dead->id) }}'">
                <span>취소</span>
            </button>
            <button type="submit" class="btn primary small">
                <span>수정</span>
            </button>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category-select');
    const hallFields = document.getElementById('location-fields-hall');
    const areaFields = document.getElementById('location-fields-area');

    function toggleFields() {
        const val = categorySelect.value;
        hallFields.style.display = 'none';
        areaFields.style.display = 'none';

        if (val === '하늘누리관') {
            hallFields.style.display = 'block';
        } else if (val === '자연장') {
            areaFields.style.display = 'block';
        }
    }

    categorySelect.addEventListener('change', toggleFields);
    
    document.getElementById('modi-form').addEventListener('submit', function(e) {
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
