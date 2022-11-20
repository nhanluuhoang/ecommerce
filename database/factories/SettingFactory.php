<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_logo'               => 'public/images.png',
            'company_name'               => 'NLH Company',
            'company_info'               => '<div>NLH là một thương hiệu về hương được thành lập vào năm 2022.</div>',
            'company_address'            => '39 Nguyễn Thị Diệu, Phường 6, Quận 3, TP.Hồ Chí Minh',
            'company_tax_code'           => 'MST: 123456789 do Sở Kế hoạch và Đầu tư TP Hồ Chí Minh cấp ngày 01.01.2020',
            'return_policy'              => '<div>Chính sách đổi trả</div>',
            'terms_of_sale'              => '<div>Điều khoản mua bán</div>',
            'delivery_policy'            => '<div>Chính sách giao hàng</div>',
            'payment_methods'            => '<div>Phương thức thanh toán</div>',
            'information_privacy_policy' => '<div>Chính sách bảo mật thông tin</div>',
            'social_network'             => [
                [
                    'title' => 'FACEBOOK',
                    'link'  => 'FACEBOOK',
                ],
                [
                    'title' => 'TWITTER',
                    'link'  => 'TWITTER',
                ],
                [
                    'title' => 'INSTAGRAM',
                    'link'  => 'INSTAGRAM',
                ],
                [
                    'title' => 'YOUTUBE',
                    'link'  => 'YOUTUBE',
                ],
                [
                    'title' => 'GOOGLE',
                    'link'  => 'GOOGLE',
                ],
                [
                    'title' => 'PINTEREST',
                    'link'  => 'PINTEREST',
                ]
            ],
            'company_contact'            => [
                [
                    'title'        => 'Zalo',
                    'descriptions' => '0123456789',
                ],
                [
                    'title'        => 'Phone',
                    'descriptions' => '0812345678',
                ],
                [
                    'title'        => 'Email',
                    'descriptions' => '0123456789@gmail.com',
                ]
            ],
            'shop_online'                => [
                [
                    'title' => 'SHOPEE',
                    'link'  => 'https://shopee',
                ],
                [
                    'title' => 'TIKI',
                    'link'  => 'https://tiki',
                ],
                [
                    'title' => 'LAZADA',
                    'link'  => 'https://lazada',
                ]
            ]
        ];
    }
}
