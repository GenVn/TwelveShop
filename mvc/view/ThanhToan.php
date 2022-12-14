<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/TwelveShop/my-css.css">
    <script src="/TwelveShop/processFunc.js"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        paypal.Button.render({
            // Configure environment
            env: 'sandbox',
            client: {
                sandbox: 'ATS7UmLxz0243HbSNH9Q7NnFDW04fAMDNxtKuVBna0KYGNS8VMdHEFG4jbrrl8nhx_sce8wO8bdmrylS',
                production: 'demo_production_client_id'
            },
            // Customize button (optional)
            locale: 'en_US',
            style: {
                size: 'small',
                color: 'gold',
                shape: 'pill',
            },

            // Enable Pay Now checkout flow (optional)
            commit: true,

            // Set up a payment
            payment: function(data, actions) {
                return actions.payment.create({
                    transactions: [{
                        amount: {
                            total: $tong,
                            currency: 'USD'
                        }
                    }]
                });
            },
            // Execute the payment
            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    // Show a confirmation message to the buyer
                    window.alert('C???m ??n ???? mua h??ng !!!');
                    orderCartWithPayPal();
                });
            }
        }, '#paypal-button');
    </script>
    <title>Thanh To??n</title>
</head>

<body>
    <div class="header">
        <div class="address">
            <i class="fa fa-map-marker"> H??? Ch?? Minh, Vi???t Nam</i>
            <i class="fa fa-envelope"> twelveshop@gmail.com</i>
        </div>
    </div>
    <nav class="navbar sticky-top navbar-expand-md navbar-light ">
        <div class="container-fluid">
            <a class="navar-branch" style="cursor: pointer;" href="/TwelveShop/TrangChu">
                <img src="/TwelveShop/public/image/logo.png" alt="logo" height="60px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav mx-auto " id="lsp">
                    <li class="nav-item active">
                        <a class="nav-link a active" style="cursor: pointer;" href="/TwelveShop/TrangChu.php">TRANG CH???</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link a" style="cursor: pointer;" href="/TwelveShop/AoQuan">??O & QU???N</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link a" style="cursor: pointer;" href="/TwelveShop/Balo">BALO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link a" style="cursor: pointer;" href="/TwelveShop/PhuKien">PH??? KI???N C??C LO???I</a>
                    </li>
                </ul>
            </div>
            <?php if (isset($_SESSION['account'])) {
                echo "<div style='margin-top:2rem;'> Hello ," . $_SESSION['account']['TENKH'] . '</div>';
            } ?>

            <div class="user-nav">
                <div class="dropdown">
                    <i class="fa fa-user"></i><i class="fa fa-angle-down"></i>
                    <div class="dropdown-content user" style="margin-top: -0.5rem;">
                        <?php
                        if (!isset($_SESSION['account'])) {
                            echo '<a href="/TwelveShop/DangNhap">????ng nh???p</a>';
                            echo '<a href="/TwelveShop/DangKy">????ng k??</a>';
                        } else {
                            echo '<a href="/TwelveShop/ThayDoiThongTin">Thay ?????i th??ng tin</a>
                                <a href="/TwelveShop/DoiMatKhau">?????i m???t kh???u</a>
                                <a href="/TwelveShop/LichSuGioHang">L???ch s???</a>
                                <a href="/TwelveShop/TrangChu/Logout">????ng xu???t</a>';
                        }
                        ?>
                    </div>
                </div>
                <a href="/TwelveShop/GioHang" style="cursor: pointer;"><i class="fa fa-shopping-cart"></i></a>
                <span id="counter">
                    <?php
                    if (isset($_SESSION['cart'])) {
                        $count = 0;
                        foreach ($_SESSION['cart'] as $value) {
                            $count += $value['amount'];
                        }
                        echo $count;
                    } else {
                        echo 0;
                    }
                    ?>
                </span>
            </div>
        </div>
    </nav><br>
    <h2 class="title">
        <span>THANH TO??N</span>
    </h2><br>
    <div style="width: 80%;margin-left: 10%;">
        <table class="table" style="width: 100%;" id="shopping-cart-id"></table>

    </div>

    <table class="table" style="font-family: 'Times New Roman', Times, serif;width: 50%;margin-left: 10%;">
        <tbody>
            <tr>
                <td>?????a ch??? nh???n h??ng</td>
                <td>
                    <?php echo $_SESSION['account']['DIACHI']; ?>
                </td>
            </tr>
            <tr>
                <td>Ph????ng th???c thanh to??n</td>
                <td>
                    <select name="" id="paypal_cart" style="width: 20rem;">
                        <option value="1">Thanh to??n khi nh???n h??ng</option>
                        <option value="0">Thanh to??n online</option>
                    </select>
                </td>
            </tr>
            <tr id="online_pay">
                <td>Thanh to??n qua paypal</td>
                <td>
                    <div id="paypal-button"></div>
                </td>
            </tr>
            <tr id="offline_pay">
                <td>Thanh to??n qua khi nh???n h??ng</td>
                <td>
                    <button onclick="orderCart()" style="background-color: black;color: white;padding: 0 1rem 0 1rem;">Thanh to??n</button>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="footer-container">
        <div class="footer">
            <img src="/TwelveShop/public/image/logo.png" alt="">
        </div>
        <div class="footer">
            <a href="">GIAO H??NG</a><br>
            <a href="">B???O H??NH</a><br>
            <a href="">B???O D?????NG</a><br>
            <a href="">?????T H??NG</a><br>
            <a href="">C???A H??NG</a><br>
            <a href="">LI??N H???</a><br>
        </div>
        <div class="footer">
            <a href="">V??? MILD</a><br>
            <a href="">T???I SAO L???I CH???N MILD</a><br>
        </div>
        <div class="footer">
            <h3>????NG K?? NH???N TIN</h3><br>
            <input type="text">
            <button class="footer-btn">????NG K??</button>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".customer_input_address").hide();
            $("#online_pay").hide();

            $("#paypal_cart").change(function() {
                $value = parseInt($("#paypal_cart").val());
                switch ($value) {
                    case 0: {
                        $("#online_pay").show();
                        $("#offline_pay").hide();
                        break;
                    }
                    case 1: {
                        $("#online_pay").hide();
                        $("#offline_pay").show();

                        break;
                    }
                }
            })
        })

        function loadCart() {
            $tong=0;
            $.ajax({
                url: '/TwelveShop/Admin/getCart',
                success: function(data) {
                    var data = JSON.parse(data);
                    $xhtml = '<tr>' +
                        '<th scope="col">H??nh ???nh</th>' +
                        '<th>T??n s???n ph???m</th>' +
                        '<th>Gi??</th>' +
                        '<th>S??? l?????ng</th>' +
                        '<th>T???ng ti???n</th>' +
                        '</tr>';
                    $sum = 0;
                    for (var key in data) {
                        $obj = data[key];
                        $sum += $obj.GIA * (1 - $obj.PHANTRAMGIAM / 100) * $obj.amount;
                        $xhtml += '<tr>' +
                            '<td><img src="/TwelveShop/public/image/HINHANH/' + $obj.HINHANH + '" alt=""></td>' +
                            '<td>' +
                            '<p style="margin: 0;">' + $obj.TENSP + ' (-' + $obj.PHANTRAMGIAM + '%)</p>' +
                            '</td>' +
                            '<td>';

                        if ($obj.PHANTRAMGIAM == 0) {
                            $xhtml += '<div class="price">' + formatter.format($obj.GIA) + ' <sup>??</sup></div>';
                        } else {
                            $xhtml += '<div class="price">' + formatter.format($obj.GIA * (1 - $obj.PHANTRAMGIAM / 100)) + ' <sup>??</sup></div>';
                            $xhtml += '<div style="text-decoration: line-through;" class="price">' + formatter.format($obj.GIA) + ' <sup>??</sup></div>';
                        }
                        $xhtml += '</td>' +
                            '<td><input id="number-product-item-' + $obj.MASP + '" type="number" onchange="changeNumberCart(\'' + $obj.MASP + '\');" placeholder="1" class="number" value="' + $obj.amount + '"><i class="fa fa-trash" onclick="deleteCartItem(\'' + $obj.MASP + '\')"></i><p style="color:red;">' + $obj.ERROR + '</p></td>' +
                            '<td scope="col">' +
                            formatter.format($obj.GIA * (1 - $obj.PHANTRAMGIAM / 100) * $obj.amount) +
                            '</td>' +
                            '</tr>';
                    }
                    $.ajax({
                        url: '/TwelveShop/Admin/getSale',
                        success: function(subdata) {
                            var subdata = JSON.parse(subdata);
                            if (subdata === undefined || subdata.length == 0 || data.length == 0 || data === undefined) {
                                $xhtml += '<tr>' +
                                    '<td colspan="3">' +
                                    '</td>' +
                                    '<td colspan="2" style="text-align: end;">' +
                                    '<div class="total-price">' + formatter.format($sum) + '<sup>??</sup>' +
                                    '</div>' +
                                    '</td>' +
                                    '</tr>';

                            } else {
                                $xhtml += '<tr>' +
                                    '<td>T???ng</td>' +
                                    '<td></td>' +
                                    '<td></td>' +
                                    '<td></td>' +
                                    '<td style="text-align: end;">' +
                                    '<div class="total-price">' + formatter.format($sum) + '</div>' +
                                    '</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Khuy???n m??i</td>' +
                                    '<td></td>' +
                                    '<td>' + subdata.PHANTRAMGIAM + '%</td>' +
                                    '<td>(' + subdata.NGAYBD + ' ?????n ' + subdata.NGAYKT + ')</td>' +
                                    '<td style="text-align: end;">' +
                                    '<div class="total-price">- ' + formatter.format($sum * (subdata.PHANTRAMGIAM / 100)) + '</div>' +
                                    '</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td><div class="total-price">Th??nh ti???n</div></td>' +
                                    '<td colspan="3"></td>' +
                                    '<td style="text-align: end;">' +
                                    '<div class="total-price">' + formatter.format($sum * (1 - subdata.PHANTRAMGIAM / 100)) +
                                    '</div>' +
                                    '</td>' +
                                    '</tr>';
                            }

                           
                            $tong=Math.round($sum*(1-subdata.PHANTRAMGIAM/100)/23080); 
                                                        
                            $("#shopping-cart-id").html($xhtml);

                        }
                    })
                }
            })
        }
        $(document).ready(function() {
            loadCart();
        });




        function orderCart() {
            $.ajax({
                url: '/TwelveShop/Admin/orderCart/0',
                success: function(data) {
                    var data = JSON.parse(data);
                    console.log(data);
                    if (data.SMS == "NOT_LOGIN") {
                        alert("Vui l??ng ????ng nh???p ????? ti???p t???c");
                        window.location.href = "/TwelveShop/DangNhap?return=GioHang"
                    } else if(data.SMS === '?????t h??ng th??nh c??ng'){
                        alert(data.SMS);
                        window.location.href='/TwelveShop/TrangChu';
                    }
                    else{
                        alert(data.SMS);
                    }
                    
                }
            })
        }

        function orderCartWithPayPal(){
            $.ajax({
                url: '/TwelveShop/Admin/orderCart/1',
                success: function(data) {
                    var data = JSON.parse(data);
                    console.log(data);
                    if (data.SMS == "NOT_LOGIN") {
                        alert("Vui l??ng ????ng nh???p ????? ti???p t???c");
                        window.location.href = "/TwelveShop/DangNhap?return=GioHang"
                    } else if(data.SMS === '?????t h??ng th??nh c??ng'){
                        alert(data.SMS);
                        window.location.href='/TwelveShop/TrangChu';
                    }
                    else{
                        alert(data.SMS);
                    }
                    
                }
            })

            loadCart();
        }
    </script>
</body>

</html>