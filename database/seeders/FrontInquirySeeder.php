<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inquiry;
use App\Models\InquiryReply;
use App\Models\Member;
use App\Models\Admin;

class FrontInquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $member = Member::first();
        if (!$member) return;

        $admin = Admin::first();
        if (!$admin) return;

        // 1. 미답변 상담
        Inquiry::create([
            'username' => $member->username,
            'email' => $member->email,
            'title' => '봉안당 안치 절차 문의드립니다.',
            'content' => '어머님을 모시려고 하는데, 현장 방문 없이도 예약이 가능한가요? 필요한 서류가 무엇인지 알고 싶습니다.',
            'status' => '미답변',
        ]);

        // 2. 답변 완료 상담
        $inquiry = Inquiry::create([
            'username' => $member->username,
            'email' => $member->email,
            'title' => '자연장 가격 및 위치 문의',
            'content' => '자연장 구역 중에서 가장 경치가 좋은 곳이 어디인가요? 가격대도 궁금합니다.',
            'status' => '답변완료',
        ]);

        $reply = InquiryReply::create([
            'inquiry_id' => $inquiry->id,
            'admin_id' => $admin->id,
            'title' => '자연장 안내 답변드립니다.',
            'content' => "안녕하세요, 하늘누리입니다.\n\n자연장 구역은 현재 서쪽 숲 구역이 조망이 가장 좋습니다. 가격대는 위치에 따라 300만원에서 500만원 사이로 형성되어 있습니다.\n추가적인 상담은 방문객 센터를 예약 후 방문해 주시면 더욱 상세히 도와드리겠습니다.",
        ]);
    }
}
