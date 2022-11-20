<footer class="footer tp_footer">
    <div class="main-footer">
        <div class="container-fluid">
            <div class="row custom_md_3">
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg col_1">
                    <div class="footer-col">
                        <h4 class="footer-title tp_footer">Về {{config('app.name')}}</h4>
                        <div class="footer-content">
                            {!! $setting->company_info !!}
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg col_2">
                    <div class="footer-col footer-block"><h4 class="footer-title tp_footer">HỖ TRỢ MUA HÀNG</h4>
                        <div class="footer-content toggle-footer">
                            @foreach($setting->shop_online as $shop)
                                @if($shop['link'])
                                    @switch($shop['title'])
                                        @case('SHOPEE')
                                            <p>
                                                <a href="{{ $shop['link'] }}">
                                                    <img style="width: 38px; height: 38px" alt="Shopee icon" src="data:image/png;base64,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" />
                                                </a>
                                                <a href="{{ $shop['link'] }}">{{ $shop['title'] }}</a>
                                            </p>
                                            @break
                                        @case('TIKI')
                                            <p>
                                                <a href="{{ $shop['link'] }}">
                                                    <img style="width: 38px; height: 38px" alt="Tiki icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAAA2FBMVEUbqf////////3///f///z7/v3///gaqv77//sAmeuk2/b///oAmvAAme0AnvfO8PwAofcAmeeS1fY0q+x7y/hWu+zw//8Xp/8aqvvp//8Aoe5qx/VjwvMAlOj2/vkAl+QbqvfC8P+v5PcBp+IAlOyK1PW75/tMsugAn+ZEufQwsvf///EAofMAmeQAl+cAo+fU9f+D0PhgwOcYo+A/r+ne/f+y6Pl5wu0Ai9wEpO5XvvbH6/yj5PmV1Pf//+15zfOD0+/f9/+/4usAheI8qtwAgtSGy/s3suVkShCJAAAJIklEQVR4nO1b63qbuhIFCSGwwAGnBvkCFo6JScE4buJ0p2m3m+ye0/d/ozMCX5vGcWIf2D86/doGImkWo5E0ayQp6pYgNWQYe1Grd/WRUuWEQunHq14r8jBmIajZEmVbf0hQOOwnmeUo/inVF+I7Vpb0hyEiIXoBgIpJazqwacZBTq1ftplRezBtEfzMAkhFSP47vBg5UE4IWhjgZFYoW6NCQOPO6GIoOwE0ojUAMD1RWWccOAqFP8pJu38jRctUcYJxh6mgMlwDIDoh7HJi/p8UPwNiTi4ZAaUbHyAkbQRdUY1+RRHdoJESsvYBZBAcD8TpHe8lATcbxJgYaNMFjYFC/dMPvRfE96kyaGx1gX4ZdKtSvpJucKmvu6Az6fLKPr8Un3cnnbILEEJjS1TW/yvhwhqDalXRQjwMKhp/u0KDIQ41BYbghVOHfkVxLmAoKiFqjWoxAJhg1EKhwsJpVheAbBoyBQ8HlTvgSvhgiBXcN3ldFuBmHyteQuuzAE08JTK5qAuA4GaktCwu6uoCwa2W0mvW5QLSCZo95cqvehnYCKi+Uj4qtfkgeKFUX9v3S/Fr/Pp/k7ynEw4fOXsivXf1PoXYldLDmSPQnIIWvUfXSwCA4cD0fSAEChWAjpwOAHdsN5mYVnaYESjP7O7ENa3TsG1oxD2Po4en4ewmP6iCMxm3nqB8L7FPgIByJ2kYuOCyXuxKFi32OJLPuX0RMaRB8Ik6fcn8juQewple66wkcyq+SzLxSnn7ytOxV1TQ01l+tCPw7oMkVJLVAZ1Lhzmle30xu/AYlC0omGGkC/tIR6D2LAX9RXuqZhD2ydq7klMXSLBqlBQM2LB3c2T06SceIhrSmAZisBBd53zPWk6dW0QMjRXFmYZSFrv7yr8q1BmrxCBL8TTCjPNsH4DRNxyuy0MNPD8u/KOjBR5Oz9dyc5b2rX0NWnfs86b89MYIJ0fNiHQUs/ivzFlK9lcD9fYCMCP8M1gVv88GHQBwlBOMZixe00jO8wbuWfsatKL0qrkuLwaekRyVfqLNL7gRrJ44tR/SW2ePBYB5QR+ty4sk9NwjF6Up8SarnwVPiDfY51S02cZf17yTTtp6wzwyAM+//d2HFn0wpM+DBV7sdQFFmczVYujL+YrmEb59bep8RWiWeF4x/wqY5c/DuflK+e6VHuVcpicpD3q4dWwewufZeehNgy6F77/1vHvnlQZp3sPD3BL3MGT6aeQep16RH26dd8L4fNq9ahjz+1cnVsGDvuH1ptP7L9d6y82OBgCxUNPtzTudjnfdc1+f2IUizG7ckXI3Djg9DQNoWtnHj5nVPHRIW5mA8qPmyTYglmHFwc2BYqf4943i/yo7ELb009+goXueDhIr+51YRVPch9+amznYsp/1B21mm3cUWuvazcNRwKSRxHPvuXRaCcSA/F7+9mwB6wqlPuXJ90fv+oO7npHkoM/7195ZLyhWHp5dfH3sRGP30GQ4NJs3UoaQtiuMMXTpAoDJMIUYE3/PJTeg7h3W9RTH5mbR4UErZXj1Lrvp/K1DmU/ZgQA4z26ZBpEM2pVQReTvdpN325gQw1BlMMK51WdqCM9s6tNV/SBmRoiJHp7DREVtmZcnBM/zA/MAAKDNINgptKrrLTb43yB4MYLmdUIQIrhnQoeMWpqMeUL9U9HJvk8FrBGASFXhnZwpgwddxtCqcXMwAAcAGKSI41SiqeWOBmKGoevQ16OWDHQRQR9s8AKzoRKgCQT3AQC4BFWCzzpD5SaIfKdMrlERlBrnr03cSwEudSM3lMo4rgypweTyZ6RBI/DNskEJANzFbhQAS2U+zHxBWy+N5umdBAao7569EQB4kblIweNAdEPF5Q6bzjRdx7FLxRKAWgIwtwFAVXsM4A35jqVfCjL2ZgCwcgrzNm6BxEMcFpWfisfZOBdcWHsAUHscakQz5JYgm5XRx9stIMUZSfnnBy6/pv1P8Vz4mbXTBRsAMDNBjOBhcFDwHMJgmBaLz/sA0EIgpCoBfLAoXyUlXgLQ5NSZFkxMRUzV45yX4dr7AJQodgCs3r5oAZHdzDXdKB7ZN5gG6RFd8EYAxMB9mybXWqgVQ1CPA0GXSZRKAGhY748mMOOA9wFn1L/nm+CjCgCIEdz+zx0r92KxPsu3klKVACBM/wELQKmI/TcXnFYMICSPhlrsBTM8y2FAbjI3lfjAcrWCwgaeBWIn+KwMQInC+Bz8koOoFEDIvBv3F/pXzUS0+hvix5ts1wSVOCH4P5HZM4hT0GNiicotoBL8iIy0+ImdTZ2qLQARF/vxXSesxBINsq3gqxIAxnImlFEkBKiXky3aWNlqGCQPMpYlcj0Y5hsElQEws2TOIPyWo4ENg/WRhKoAQJCeTTuYyOVYDXFjsNJWmQVsQU2Zm5ZkQjdwa7QkpZUBkLzA/QnRoEymgx/EJTWsFACwgiuiL8+IaYugegtwavdTUs4HjH12KwvJ1sRE4YMF1kjBCxiWaVJ6LAD2KwC7VYZe2syCTi6pGVkCkJXymElGV7z+mSnCPdOXAN68W7EDYF15tALwYQSgngFQZA57ySnRWVco9hIA8Mo36pcA9N8BWFEzmQa2V1Px2gK8OWnoaRmfgtmFuQRA3gHAGUsLQIf2nU2Ua8WomPNZcfRC0vPCAu2VBYTIJne4GIkqvnK4GRVrBCLn78jTTT25zjOytdlEszE2QqJp4YUjz4B80mX+AyKhVRwos3LJGYY4FSEvAb78nXkhCdncfXu2jJoLpmOWxuYWeO5+BfLO9Jkr5OkDN8I6EPeFu9U6zZKHVIdhsLC5oNM5hvJG+z2bt9Ttn0XRhx3sXHRn0VPUczOZchFZ0oqe7tqm2K4nnO7s7Onuy0RA8WzaiJ4u2+/KlHNhZq676zwyU+9mpkwQydyxcCx4yHY3LoAYmTKXKCRDpDwz7UyeVnoHhGKz4Vm9VabU3zw9y0PTVXa2TLHWdlLoj/yRP3KY1Heari7F/y6p/Thf7Qcaaz/SWfuh1tqP9dZ+sLn2o921H26v/Xh/7Rccar/iUfsll/qv+dR90Umt/aqXWv9lN0BQy3U/dQUAkXouPJJ1F9R95bP+S6+1X/ut/eLzSmq7+r2U+i+/13H9/39WvP49JBXG9AAAAABJRU5ErkJggg==" />
                                                </a>
                                                <a href="{{ $shop['link'] }}">{{ $shop['title'] }}</a>
                                            </p>
                                            @break
                                        @case('LAZADA')
                                            <p>
                                                <a href="{{ $shop['link'] }}">
                                                    <img style="width: 38px; height: 38px" alt="Lazada icon" src="data:image/png;base64,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">&nbsp;&nbsp;
                                                </a>
                                                <a href="{{ $shop['link'] }}">{{ $shop['title'] }}</a>
                                            </p>
                                            @break
                                    @endswitch
                                @endif
                            @endforeach
                            <p><a href="/ho-tro/chinh-sach-doi-tra">Chính sách đổi trả</a></p>
                            <p><a href="/ho-tro/dieu-khoan-mua-ban">Điều khoản mua bán</a></p>
                            <p><a href="/ho-tro/chinh-sach-giao-hang">Chính sách giao hàng</a></p>
                            <p><a href="/ho-tro/phuong-thuc-thanh-toan">Phương thức thanh toán</a></p>
                            <p><a href="/ho-tro/chinh-sach-bao-mat-thong-tin">Chính sách bảo mật thông tin</a></p>
                            <p>
                                <a href="/">
                                    <img alt="đã thông báo bộ công thương" src="" style="width:200px;height:76px;">
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg col_3 footer_none">
                    <div class="footer-col">
                        <h4 class="footer-title tp_footer">
                            <p>LIÊN HỆ</p>
                        </h4>
                        <div class="footer-content footer-contact footer-contact53436">
                            <ul>
                                @foreach($setting->company_contact as $contact)
                                    <li class="contact-5 icon">
                                        <span style="width: 55px; display: inline-block">{{ $contact['title'] }}:</span>
                                        <span style="color:#a73340">{{ $contact['descriptions'] }}</span>
                                    </li>
                                @endforeach

                                <li class="home-list-store visible-lg visible-md">
                                    <a class="tp_button" href="/ho-tro/he-thong-cua-hang">Hệ thống cửa hàng</a>
                                </li>
                            </ul>
                            <div class="wrapper-home-newsletter animation-tran">
                                <div class="content-newsletter"><h2></h2>
                                    <p class="tp_text_color">Đăng kí nhận khuyến mãi mới nhất của {{config('app.name')}}</p>
                                    <div class="form-newsletter">
                                        <form accept-charset="UTF-8" class="contact-form">
                                            <div class="form-group">
                                                <input id="contactFormEmail"
                                                       class="inputNew form-control newsletter-input" required=""
                                                       type="email" placeholder="Điền địa chỉ Email của bạn"
                                                       name="contact[email]" size="18" autocomplete="off">
                                                <button type="submit" name="submitNewsletter" id="contactFormSubmit" class="tp_button">
                                                    <span>Gửi</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg col_4">
                    <div class="footer-col">
                        <h4 class="footer-title tp_footer">Fanpage</h4>
                        <div class="footer-content footer-contact">
                            <div class="footer-static-content">
                                Fanpage
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
