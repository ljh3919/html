@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">사이버 추모관 > 고인 관리 > 상세</h1>
        <div>
            <a href="{{ route('HNA_Deadmag_Modi_001', $dead->id) }}" class="btn btn-primary">수정</a>
            <button type="button" class="btn btn-danger" onclick="if(confirm('삭제하시면 데이터를 되돌릴 수 없습니다. 정말 삭제하시겠습니까?')) document.getElementById('delete-form').submit();">삭제</button>
            <a href="{{ route('HNA_Deadmag_List_001') }}" class="btn btn-secondary">목록</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <colgroup>
                        <col style="width: 200px; background-color: #f8f9fc;">
                        <col>
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>고인코드</th>
                            <td>{{ $dead->dead_code }}</td>
                        </tr>
                        <tr>
                            <th>고인명</th>
                            <td>故 {{ $dead->name }}</td>
                        </tr>
                        <tr>
                            <th>구분</th>
                            <td>{{ $dead->category }}</td>
                        </tr>
                        <tr>
                            <th>안치장소</th>
                            <td>
                                @if($dead->category === '하늘누리관')
                                    {{ $dead->location_hall }}관 {{ $dead->location_row }}열 {{ $dead->location_num }}번
                                @else
                                    {{ $dead->location_area }}구역 {{ $dead->location_row }}열 {{ $dead->location_num }}번
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>기일</th>
                            <td>{{ $dead->death_date->format('Y.m.d') }}</td>
                        </tr>
                        <tr>
                            <th>등록일</th>
                            <td>{{ $dead->created_at->format('Y.m.d') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form id="delete-form" action="{{ route('admin.deadmag.destroy', $dead->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection
