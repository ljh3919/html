<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>팝업 미리보기</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f4f4; padding: 20px; }
        .popup-preview-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 400px;
            margin: 0 auto;
        }
        .popup-header {
            background-color: #3f51b5;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .popup-body {
            padding: 20px;
            min-height: 200px;
        }
        .popup-footer {
            background-color: #eee;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
        }
        .ci-area { text-align: center; padding: 10px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="popup-preview-container">
        <div class="popup-header">
            <h5 class="m-0">하늘누리에서 알려드립니다</h5>
            <i class="fas fa-times" style="cursor: pointer;" onclick="window.parent.$('#previewModal').modal('hide')"></i>
        </div>
        <div class="popup-body">
            <h6 class="font-weight-bold mb-3">{{ $title }}</h6>
            <div class="content">
                {!! $content !!}
            </div>
        </div>
        <div class="popup-footer">
            <div><input type="checkbox"> 오늘 하루 보지 않기</div>
            <div style="cursor: pointer;" onclick="window.parent.$('#previewModal').modal('hide')">닫기</div>
        </div>
        <div class="ci-area text-muted small">
            <i class="fas fa-leaf mr-1"></i> 하늘누리 CI
        </div>
    </div>

    <div class="text-center mt-4">
        <button class="btn btn-secondary btn-sm" onclick="window.close()">미리보기 닫기</button>
    </div>
</body>
</html>
