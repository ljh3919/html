@extends('layouts.admin')

@section('styles')
<style>
    .table-header-custom {
        background-color: #f8f9fa;
        font-weight: 500;
        vertical-align: middle !important;
        padding-left: 20px !important;
        border-bottom: 1px solid #dee2e6 !important;
    }
    .table-cell-custom {
        padding: 12px 20px !important;
        border-bottom: 1px solid #dee2e6 !important;
    }
    .btn-outline-custom {
        background-color: #fff;
        border: 1px solid #ced4da;
        color: #333;
        font-weight: 500;
    }
    .btn-outline-custom:hover {
        background-color: #f8f9fa;
        color: #000;
    }
</style>
@endsection

@section('content')
<div class="container-fluid text-black">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <div style="font-size: 1.5rem; font-weight: 700; color: #000;">• 고인 관리</div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0">
        <div class="card-body p-0">
            <form action="{{ route('admin.deadmag.store') }}" method="POST" id="regi-form">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <colgroup>
                            <col style="width: 180px;">
                            <col>
                        </colgroup>
                        <tbody>
                            <tr>
                                <th class="table-header-custom">고인명 <span class="text-danger ml-1">*</span></th>
                                <td class="table-cell-custom">
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2 font-weight-bold" style="color: #5d401a;">故</span>
                                        <input type="text" name="name" class="form-control form-control-sm" style="width: 200px;" value="{{ old('name') }}" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-custom">구분 <span class="text-danger ml-1">*</span></th>
                                <td class="table-cell-custom">
                                    <select name="category" id="category-select" class="form-control form-control-sm" style="width: 200px;" required>
                                        <option value="">선택해주세요</option>
                                        <option value="하늘누리관" {{ old('category') == '하늘누리관' ? 'selected' : '' }}>하늘누리관</option>
                                        <option value="자연장" {{ old('category') == '자연장' ? 'selected' : '' }}>자연장</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-custom">안치장소 <span class="text-danger ml-1">*</span></th>
                                <td class="table-cell-custom">
                                    <div id="location-fields-none" class="text-secondary small py-1">구분을 먼저 선택해 주세요.</div>
                                    
                                    <div id="location-fields-hall" style="display: none;">
                                        <div class="d-flex align-items-center py-1">
                                            <span class="mr-2">관 :</span>
                                            <select name="location_hall" class="form-control form-control-sm mr-3" style="width: 150px;">
                                                <option value="">선택해주세요</option>
                                                <option value="하늘">하늘관</option>
                                                <option value="누리">누리관</option>
                                                <option value="무궁화">무궁화관</option>
                                            </select>
                                            <span class="mr-2">열 :</span>
                                            <select name="location_row_hall" class="form-control form-control-sm mr-3" style="width: 80px;">
                                                <option value="">선택</option>
                                                @for($i=1; $i<=10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            <span class="mr-2">번호 :</span>
                                            <input type="text" name="location_num_hall" class="form-control form-control-sm" style="width: 80px;">
                                        </div>
                                    </div>

                                    <div id="location-fields-area" style="display: none;">
                                        <div class="d-flex align-items-center py-1">
                                            <span class="mr-2">구역 :</span>
                                            <select name="location_area" class="form-control form-control-sm mr-3" style="width: 150px;">
                                                <option value="">선택해주세요</option>
                                                <option value="A">A구역</option>
                                                <option value="B">B구역</option>
                                                <option value="C">C구역</option>
                                            </select>
                                            <span class="mr-2">열 :</span>
                                            <select name="location_row_area" class="form-control form-control-sm mr-3" style="width: 80px;">
                                                <option value="">선택</option>
                                                @for($i=1; $i<=20; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            <span class="mr-2">번호 :</span>
                                            <input type="text" name="location_num_area" class="form-control form-control-sm" style="width: 80px;">
                                        </div>
                                    </div>

                                    <input type="hidden" name="location_row" id="final-row">
                                    <input type="hidden" name="location_num" id="final-num">
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-custom">기일 <span class="text-danger ml-1">*</span></th>
                                <td class="table-cell-custom">
                                    <div class="d-flex align-items-center">
                                        <select name="death_year" class="form-control form-control-sm mr-2" style="width: 120px;" required>
                                            @for($y=date('Y'); $y>=1900; $y--)
                                                <option value="{{ $y }}">{{ $y }}년</option>
                                            @endfor
                                        </select>
                                        <select name="death_month" class="form-control form-control-sm mr-2" style="width: 80px;" required>
                                            @for($m=1; $m<=12; $m++)
                                                <option value="{{ sprintf('%02d', $m) }}">{{ $m }}월</option>
                                            @endfor
                                        </select>
                                        <select name="death_day" class="form-control form-control-sm mr-2" style="width: 80px;" required>
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

                <div class="d-flex justify-content-between align-items-center mt-4 mb-5">
                    <p class="text-danger small mb-0 mr-auto">* 표시항목은 필수입력 항목입니다.</p>
                    <div class="d-flex">
                        <a href="{{ route('HNA_Deadmag_List_001') }}" class="btn btn-sm btn-outline-custom px-4 py-2 mr-2" style="min-width: 80px;">취소</a>
                        <button type="submit" class="btn btn-sm text-white px-4 py-2" style="background-color: #5d401a; border: 1px solid #5d401a; min-width: 80px; font-weight: 500;">등록</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
