<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xin chào {{$full_name}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/26096abf41.js" crossorigin="anonymous"></script>
</head>

<body>
    <h2>Xin chào {{$full_name}}</h2>
    <p>Cảm ơn bạn đã đặt hàng tại trang web của chúng tôi!</p>
    <p>Dưới đây là thông tin đơn hàng của bạn!</p>
    <div style="background-color: #fff; padding: 1rem;">
        <div style="display: flex; flex-direction: column;">
            <h3 style="text-align: center; padding-top: 1rem; padding-bottom: 1rem;">
                <i class="fa-solid fa-circle-info" style="margin-right: 0.5rem;"></i>Thông tin đơn hàng
            </h3>
            <div style="display: flex; flex-direction: column; border-top: 1px solid #dee2e6;">
                <div style="display: flex; flex-direction: row; align-items: center;">
                    <i class="fa-solid fa-location-dot fa-md" style="margin-top: 1rem; margin-right: 0.5rem; color: #dc3545;"></i>
                    <p style="margin: 0; margin-top: 1rem; font-size: 1.25rem; color: #dc3545;">Địa chỉ nhận hàng</p>
                </div>
                <div style="display: flex; flex-direction: row; align-items: center; margin-top: 1rem;">
                    <h5 style="margin: 0; margin-right: 0.5rem;">{{$orderDetailData['full_name']}}</h5>
                    <h5 style="margin: 0; margin-right: 0.5rem;">(+84) {{$orderDetailData['phone_number']}}</h5>
                    <p style="margin: 0; margin-right: 0.5rem;">{{$orderDetailData['address']}}</p>
                </div>
            </div>
            <div style="display: flex; flex-direction: row; justify-content: space-around; align-items: center; margin-top: 1rem;">
                <div style="display: flex; flex-direction: row; align-items: center;">
                    <i class="fa-solid fa-truck fa-md" style="margin-right: 0.5rem;"></i>
                    <h5 style="margin: 0;">Nhận hàng từ: 3-5 ngày</h5>
                </div>
            </div>
            <div style="margin-top: 1rem;">
                <table style="width: 100%; margin-bottom: 1rem; color: #212529; background-color: transparent;">
                    <thead style="background-color: #343a40; color: #fff;">
                        <tr>
                            <th style="text-align: center; width: 25%;">Sản phẩm</th>
                            <th></th>
                            <th style="text-align: center;">Đơn giá</th>
                            <th style="text-align: center;">Số lượng</th>
                            <th style="text-align: center;">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderDetailData['product_variants'] as $itemVariant)
                        <tr>
                            <td>
                                <div style="display: flex; flex-direction: row; align-items: center;">
                                    <img style="margin-right: 0.5rem;" src="{{$itemVariant['image']}}" alt="" width="110">
                                    <h6>{{$itemVariant['name']}}</h6>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; flex-direction: column; align-items: center;">
                                    <span>Phân loại hàng:</span>
                                    <span style="font-weight: bold;">{{$itemVariant['attribute_values']}}</span>
                                </div>
                            </td>
                            <td style="text-align: center;" class="currency">{{$itemVariant['price']}}</td>
                            <td style="text-align: center;">{{$itemVariant['quantity']}}</td>
                            <td style="text-align: center; color: #dc3545;" class="currency">{{$itemVariant['total_price']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="display: flex; flex-direction: column; justify-content: space-around; align-items: center; margin-top: 1rem;">
                    <div style="display: flex; flex-direction: row; align-items: center;">
                        <i class="fa-solid fa-person-running fa-lg" style="margin-right: 0.5rem;"></i>
                        <h5 style="margin: 0;">Phương thức thanh toán</h5>
                    </div>
                    <div>
                        <p style="margin: 0;">Thanh toán khi nhận hàng</p>
                    </div>
                </div>
                <div style="display: flex; justify-content: center; margin-top: 1rem; background-color: #f8f9fa;">
                    <table style="width: 50%; background-color: #f8f9fa;">
                        <tbody>
                            <tr>
                                <td>Tổng tiền hàng</td>
                                <th class="currency">{{$orderDetailData['total_cost']}}</th>
                            </tr>
                            <tr>
                                <td>Phí vận chuyển</td>
                                <th class="currency">{{$orderDetailData['shipping_price']}}</th>
                            </tr>
                            <tr>
                                <td>Giảm phí vận chuyển</td>
                                <th class="currency">{{$orderDetailData['shipping_voucher']}}</th>
                            </tr>
                            <tr>
                                <td>Voucher từ eSportsJacket</td>
                                <th class="currency">{{$orderDetailData['voucher']}}</th>
                            </tr>
                            <tr>
                                <td style="text-align: center;">Thành tiền</td>
                                <th style="font-size: 1.5rem; color: #dc3545; font-weight: bold;" class="currency">{{$orderDetailData['total_payment']}}</th>
                            </tr>
                            <tr>
                                <td style="text-align: center;">Ngày đặt hàng</td>
                                <td>{{$orderDetailData['created_at']}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">Trạng thái</td>
                                <td style="color: #28a745;">{{$orderDetailData['status']==1?'Chờ xác nhận!':'Không xác định!'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function currency() {
            var status = true;
            try {
                $('.currency').each(function() {
                    var value = $(this).text();
                    var numericValue = parseFloat(value.replace(/[^0-9]/g, ''));
                    var formattedValue = new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(numericValue);
                    $(this).text(formattedValue);
                });
            } catch (e) {
                status = false;
            }
            return status;
        }
        currency();
    </script>
</body>

</html>