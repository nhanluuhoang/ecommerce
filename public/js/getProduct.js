let lengthOption = 0
let variantValues = []
let selectedValues = []

$(document).ready(function() {
    disableLoading()

    $('.quick-view').click(function (e) {
        e.preventDefault()
        quickView($(this).attr('data-id'))
    });


})

function showLoading() {
    $('#loading').css('display', 'block')
}

function disableLoading() {
    $('#loading').css('display', 'none')
}

function makeProductDetail(product) {
    let option = ''
    for (let i = 0; i < product.options.length; i++) {
        const optionValues = product.options[i].option_values
        let eleOptionValues = ''
        let values = []

        for (let i = 0; i < optionValues.length; i++) {
            const value = optionValues[i].value
            values.push(value)
            eleOptionValues +=
                `<div class="n-sd swatch-element">
                    <button id="${value}" class="product-button-type" onclick="clickOptionValues(this)">
                        ${optionValues[i].value}
                    </button>
                </div>`
        }

        option +=
            `<div class="header">${product.options[i].value}:</div>
            <div class="select-swap size req" data-id="${values}">${eleOptionValues}</div>`
    }

    const variantValue = `
        <div class="swatch clearfix">
            ${option}
        </div>
    `;

    return `<div
        class="fancybox-wrap fancybox-desktop fancybox-type-html fancybox-qv fancybox-opened"
        tabIndex="-1"
        style="width: 920px; height: auto; position: absolute; top: 175px; left: 185px; opacity: 1; overflow: visible;"
    >
        <div class="fancybox-skin" style="padding: 10px; width: auto; height: auto; background: #fff;">
            <div class="fancybox-outer">
                <div class="fancybox-inner" style="overflow: auto; width: 900px; height: auto;">
                    <div id="quick-view-modal">
                        <div class="modal-lg">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="image-zoom">
                                        <div class="p-imgfeature">
                                            <img
                                                class="p-product-image-feature"
                                                alt="${product.title}"
                                                src="${product.thumbnails}"
                                            >
                                        </div>
                                        <div id="p-sliderproduct" class="owl_pages">
                                            <ul class="slides owl-carousel owl-loaded owl-drag">
                                                <div class="owl-stage-outer">
                                                    <div
                                                        class="owl-stage"
                                                        style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 330px;"
                                                    >
                                                        <div class="owl-item" style="width: 105px; margin-right: 5px;">
                                                            <li
                                                                class="item product-thumb"
                                                                data-target="0"
                                                                data-item="${product.thumbnails}"
                                                            >
                                                                <a
                                                                    href="javascript:void(0);"
                                                                    data-image="${product.thumbnails}"
                                                                >
                                                                    <img
                                                                        alt="${product.title}"
                                                                        src="${product.thumbnails}"
                                                                    >
                                                                </a>
                                                            </li>
                                                        </div>
                                                        <div class="owl-item" style="width: 105px; margin-right: 5px;">
                                                            <li
                                                                class="item product-thumb"
                                                                data-target="0"
                                                                data-item="${product.thumbnails}"
                                                            >
                                                                <a
                                                                    href="javascript:void(0);"
                                                                    data-image="${product.thumbnails}"
                                                                >
                                                                    <img alt="${product.title}" src="${product.thumbnails}">
                                                                </a>
                                                            </li>
                                                        </div>
                                                        <div class="owl-item" style="width: 105px; margin-right: 5px;">
                                                            <li
                                                                class="item product-thumb"
                                                                data-target="0"
                                                                data-item="${product.thumbnails}"
                                                            >
                                                                <a href="javascript:void(0);" data-image="${product.thumbnails}">
                                                                    <img
                                                                        alt="${product.title}"
                                                                        src="${product.thumbnails}"
                                                                    >
                                                                </a>
                                                            </li>
                                                        </div>
                                                    </div>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6" id="q-detail-product">
                                    <div class="form-input head">
                                        <div class="product-title" style="padding-bottom: 10px">
                                            <h3 class="tp_product_name">${product.title}</h3>
                                            <span id="q-pro_sku">
                                            <strong>Mã sản phẩm : ${product.sku}</strong>
                                            </span>
                                        </div>
                                        <div class="product-price" id="q-price-preview">
                                            <span id="pro-price-detail" class="pro-price tp_product_price">${product.price}</span>
                                        </div>
                                    </div>
                                    <div class="select-swatch clearfix">
                                    ${variantValue}
                                    </div>
                                    <div class="product-description">
                                        <div class="title-bl">
                                            <h2 class="tp_title"></h2>
                                        </div>
                                        <div class="description-content">
                                            <div class="description-productdetail">
                                                <p>${product.descriptions}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="selector-actions">
                                        <div class="select-quantity hide">
                                            <input
                                                id="q-quantity"
                                                type="number"
                                                name="quantity"
                                                min="1"
                                                value="1"
                                                class="tc item-quantity"
                                            >
                                        </div>
                                        <button
                                            id="addToCart"
                                            class="btn-addcart btn buy unsel tp_button"
                                            data-psid="32947863"
                                            data-selid="32947863"
                                            title="Vui lòng chọn màu sắc hoặc kích cỡ!"
                                            data-ck="0"
                                        >
                                            THÊM VÀO GIỎ
                                        </button>
                                        <div class="qv-readmore">
                                            <span> hoặc </span>
                                            <a
                                                class="read-more p-url tp_title"
                                                href="/san-pham/${product.slug}"
                                                role="button"
                                            >
                                                Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="fancybox-btn-close" onclick="fancyboxClose()">
                <i style="color: white" class="fa fa-close"></i>
            </button>
        </div>
    </div>`
}

function quickView(productID) {
    lengthOption = 0
    variantValues = []
    showLoading()

    const fancyboxElement = $('#fancybox')
    fancyboxElement.empty()
    fancyboxElement.addClass('fancybox-overlay-fixed')

    $.ajax({
        url: `/api/products/${productID}`
    }).done(function (response) {
        const data = response.data
        const htmlProductDetail = makeProductDetail(data)
        fancyboxElement.append(htmlProductDetail)
        lengthOption = data.options.length
        variantValues = data.variant_values
        disableLoading()
    })
}

function fancyboxClose () {
    const fancyboxElement = $('#fancybox')
    fancyboxElement.empty()
    fancyboxElement.removeClass('fancybox-overlay-fixed')
}

function clickOptionValues(that) {
    const currentValue = that.innerText
    const parent = that.parentElement
    const grandfather = parent.parentElement
    const ID = $(grandfather).attr('data-id')
    const valueIDs = ID.split(',')
    const length = valueIDs.length
    $(that).addClass('option-value-active')

    for (let i = 0; i < length; i++) {
        const value = valueIDs[i]
        if (currentValue !== value) {
            // selectedValues.splice()
            $(`#${value}`).removeClass('option-value-active')
        }
    }

    selectedValues.push(currentValue)

    changeVariantValue()
}

function changeVariantValue() {
    const length = $('.option-value-active').length
    console.log(length)
    console.log(lengthOption)
    console.log(variantValues)

    if (length === lengthOption) {
        const eleProPrice = $('#pro-price-detail')
        for (let i = 0; i < variantValues.length; i++) {
            const valueName =  variantValues[i].product_value_name
            const reversedValueName = valueName.reverse()
            const selectedValue = selectedValues.join(',')

            if (valueName === selectedValue || reversedValueName === selectedValue) {
                eleProPrice.innerText(variantValues[i].price)
            }
        }
    }
}

function compareArr() {

}
