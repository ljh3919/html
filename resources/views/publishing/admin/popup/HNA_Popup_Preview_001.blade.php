<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>팝업 미리보기</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f4f4; padding: 20px; font-family: 'Noto Sans KR', sans-serif; }
        .popup-preview-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            overflow: hidden;
            max-width: 450px;
            margin: 0 auto;
        }
        .popup-header {
            background-color: #5d401a;
            color: white;
            padding: 18px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .popup-header h5 { font-weight: 600; font-size: 1.1rem; }
        .popup-body {
            padding: 25px 20px;
            min-height: 200px;
            color: #333;
        }
        .popup-footer {
            background-color: #f8f9fa;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            border-top: 1px solid #eee;
        }
        .ci-area { text-align: center; padding: 15px; background-color: white; color: #999; }
        .close-btn { cursor: pointer; opacity: 0.8; transition: opacity 0.2s; }
        .close-btn:hover { opacity: 1; }
    </style>
</head>
<body>
    <div class="popup-preview-container">
        <div class="popup-header">
            <h5 class="m-0">하늘누리에서 알려드립니다</h5>
            <i class="fas fa-times close-btn" onclick="window.parent.$('#previewModal').modal('hide')"></i>
        </div>
        <div class="popup-body">
            <h6 class="font-weight-bold mb-3" style="font-size: 1.2rem; color: #5d401a;">{{ $title }}</h6>
            <div class="content" style="line-height: 1.7; font-size: 1rem;">
                {!! $content !!}
            </div>
        </div>
        <div class="popup-footer">
            <label class="mb-0" style="cursor: pointer;">
                <input type="checkbox" class="mr-1"> 오늘 하루 보지 않기
            </label>
            <div style="cursor: pointer; font-weight: 500; color: #5d401a;" onclick="window.parent.$('#previewModal').modal('hide')">닫기</div>
        </div>
    </div>

    <div class="text-center mt-4">
        <button class="btn btn-dark btn-sm px-4" style="background-color: #333; border-radius: 20px;" onclick="window.close()">미리보기 창 닫기</button>
    </div>
</body>
</html>
