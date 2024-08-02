$(document).ready(function (e) {
    //function noti
    function notifications(type, data, title) {
        $(function () {
            Command: toastr[type](data, title);
            toastr.options = {
                closeButton: true,
                debug: false,
                newestOnTop: true,
                progressBar: true,
                positionClass: "toast-top-right",
                preventDuplicates: true,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                timeOut: "5000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
            };
        });
    };
    // cart
    $('.checkBoxAll').click(function () {
        $('.checkBoxProduct').prop('checked', $(this).prop('checked'));
        $('.checkBoxAll').prop('checked', $(this).prop('checked'));
    })
    $('.checkBoxProduct').click(function () {
        if ($('.checkBoxProduct:checked').length != $('.checkBoxProduct').length) {
            $('.checkBoxAll').prop('checked', false);
        } else {
            $('.checkBoxAll').prop('checked', true);
        }
    })
    // productDetail
    var flag = 0;
    var flag_image = false;
    var attribute_value_ids = [];
    var current_item_id = 0;
    var product_id = $('.product_id').val();
    var total_attributes = $('.total_attributes').val();
    var get_main_image_src = $('.main-image').attr('src');
    var get_main_image_src2 = $('.main-image').attr('src');
    var total_stock = $('.update-stock').text();
    var total_stock2 = total_stock;
    // console.log(total_stock);
    $('.attribute_item').click(function (e) {
        var attributeValueId = $(this).data('id');
        if ($(this).hasClass('focused')) {
            flag--;
            $(this).removeClass('focused');
            attribute_value_ids = attribute_value_ids.filter(function (item) {
                return item != attributeValueId;
            });
            $('.attribute_group').each(function () {
                var group = $(this);
                var groupId = group.data('id');
                if (groupId == 1) {
                    console.log("Group: " + groupId);
                    var group_attribute_values_id_1 = [];
                    attributeValues = group.find('.attribute_item');
                    attributeValues.each(function () {
                        attributeValuesId = $(this).data('id');
                        group_attribute_values_id_1.push(attributeValuesId);
                        console.log(group_attribute_values_id_1);
                    })
                    if (group_attribute_values_id_1.includes(attributeValueId)) {
                        flag_image = false;
                        $('.main-image').attr('src', get_main_image_src2);
                        $('.main-image').attr('xoriginal', get_main_image_src2);
                        get_main_image_src = get_main_image_src2;
                        console.log(123);
                    }
                }
            });
            $('.update-stock').text(total_stock2);
            total_stock = total_stock2;
        } else {
            var current_item = $(this).closest('.attribute_group').find('.attribute_item.focused');
            if (current_item.hasClass('focused')) {
                current_item.removeClass('focused');
                current_item_id = current_item.data('id');
                console.log('Id trước đó:' + current_item_id);
                flag--;
                attribute_value_ids = attribute_value_ids.filter(function (item) {
                    return item != current_item_id;
                });
            }
            flag++;
            $(this).addClass('focused');
            attribute_value_ids.push(attributeValueId);

            console.log('Total_attributes:' + total_attributes);
            console.log('Flag:' + flag);
            // Action handling
            e.preventDefault();
            $('.attribute_group').each(function () {
                var group = $(this);
                var groupId = group.data('id');
                if (groupId == 1) {
                    attributeValues = group.find('.attribute_item');
                    attributeValues.each(function () {
                        attributeValuesId = $(this).data('id');
                        if (attribute_value_ids.includes(attributeValuesId)) {
                            $.ajax({
                                url: "{{route('userProductDetailFocused.show')}}",
                                type: "POST",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    attribute_value_ids: attribute_value_ids,
                                    product_id: product_id
                                },
                                success: function (response) {
                                    if (response.status == "success") {
                                        notifications('success', 'Đã cập nhật sản phẩm', 'Success');
                                        var imageUrl = response.data['image'];
                                        var purchase_price = response.data['purchase_price'];
                                        var sale_price = response.data['sale_price'];
                                        var stock = response.data['stock'];
                                        var percent_discount = (100 - (sale_price / purchase_price * 100)).toFixed(1);
                                        console.log(purchase_price);
                                        console.log(response.data['image'])
                                        if (imageUrl) {
                                            $('.main-image').attr('src', imageUrl);
                                            $('.main-image').attr('xoriginal', imageUrl);
                                            get_main_image_src = imageUrl;
                                            flag_image = true;
                                        } else {
                                            console.log('Image url is null of undefind')
                                        }
                                        $('.update-purchar-price').text(purchase_price);
                                        $('.update-sale-price').text(sale_price);
                                        $('.update-stock').text(stock);
                                        $('.update-percent-discount').text(percent_discount);
                                    } else {
                                        $('.update-stock').text(0);
                                        notifications('error', 'Sản phẩm không có sẵn', 'Hết hàng');
                                        console.log('Response status is not success');
                                    }
                                },
                                error: function (xhr) {
                                    alert('Đã xảy ra lỗi trong quá trình xử lý yêu cầu.');
                                }
                            })
                        }
                    })
                }
            });
        }
        console.log('Id mới được chọn:' + attributeValueId);
        console.log('Cờ:' + flag);
        console.log('Mảng:' + attribute_value_ids);
    });
    //Handle images
    //Handle when hover sub images
    $('.sub_image_second').hover(
        function () {
            $(this).addClass('border border-danger border-3 cs-pt');
            var get_image_src = $(this).attr('src');
            $('.main-image').attr('src', get_image_src);
            $('.main-image').attr('xoriginal', get_image_src);
            console.log(get_image_src);
        },
        function () {
            if (!$(this).hasClass('clicked')) {
                $('.main-image').attr('src', get_main_image_src);
                $('.main-image').attr('xoriginal', get_main_image_src);
                $(this).removeClass('border border-danger border-3 cs-pt');
            }
        });
    //Handle when click
    $('.sub_image_second').click(
        function () {
            if (!$(this).hasClass('clicked')) {
                $('.sub_image_second').removeClass('clicked border border-danger border-3 cs-pt');
                $(this).addClass('clicked border border-danger border-3 cs-pt');
                var get_image_src = $(this).attr('src');
                $('.main-image').attr('src', get_image_src);
                $('.main-image').attr('xoriginal', get_image_src);
                console.log('Đã click vào được');
            } else {
                $(this).removeClass('clicked');
                $('.main-image').attr('src', get_main_image_src);
                $('.main-image').attr('xoriginal', get_main_image_src);
            }
        }
    );
    //Handle when hover main image
    $('.xzoom, .xzoom-gallery').xzoom({
        tint: "#333",
        Xoffset: 15,
    })
})