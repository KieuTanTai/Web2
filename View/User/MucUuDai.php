<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="CSSofLam/MucUuDai.css">

</head>

<body>
  <div class="mucUuDai-container">
  <div class="quay-lai-profile" onclick = "onSideBar()">
    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
    </svg>
  Quay lại
  </div>
    <form class="find-discount-group">
      <input type="text" name="txtFindDiscount" placeholder="Nhập mã khuyến mãi" class="input-discount"
        onkeyup="searchDiscount(this.value)">
      <button type="button" class="btn-use">Tìm kiếm</button>
    </form>

    <div class="nav-discount">
      <div class="hinhvuong"></div>
      <div class="textMuc">Mục ưu đãi</div>
    </div>
    <div class="find-discount">
      <?php
      include ("../Model/DBConfig.php");
      if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }
      searchDiscount($_SESSION['idUserLogin']);
      ?>
            <!-- <div class="discount-card">
              <div class="infor-card">
                <div class="infor-card-main">
                  <div class="title-infor-card">
                    Khuyến mãi Lễ Hội
                  </div>
                  <div class="detail-infor-card">
                  Ưu đãi đặc biệt cho mùa lễ hội
                  </div>
                  <div class="hansudung">
                    Hạn sử dụng : Còn lại 18 ngày
                  </div>
                </div>
              </div>
              <div class="cac-hinh-tron">
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
              </div>
              <div class="use-card">
                <div class="title-use-card">
                  Mã ưu đãi
                </div>
                <div class="code-use-card">
                HOLIDAY12
                </div>
                <button class="btn-use-card" onclick="useDiscount(event)">Sử dụng</button>
              </div>
            </div>
            <div class="discount-card">
              <div class="infor-card">
                <div class="infor-card-main">
                  <div class="title-infor-card">
                    Khuyến mãi Lễ Hội
                  </div>
                  <div class="detail-infor-card">
                  Ưu đãi đặc biệt cho mùa lễ hội
                  </div>
                  <div class="hansudung">
                    Hạn sử dụng : Còn lại 18 ngày
                  </div>
                </div>
              </div>
              <div class="cac-hinh-tron">
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
              </div>
              <div class="use-card">
                <div class="title-use-card">
                  Mã ưu đãi
                </div>
                <div class="code-use-card">
                HOLIDAY12
                </div>
                <button class="btn-use-card" onclick="useDiscount(event)">Sử dụng</button>
              </div>
            </div>
            <div class="discount-card">
              <div class="infor-card">
                <div class="infor-card-main">
                  <div class="title-infor-card">
                    Khuyến mãi Lễ Hội
                  </div>
                  <div class="detail-infor-card">
                  Ưu đãi đặc biệt cho mùa lễ hội
                  </div>
                  <div class="hansudung">
                    Hạn sử dụng : Còn lại 18 ngày
                  </div>
                </div>
              </div>
              <div class="cac-hinh-tron">
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
              </div>
              <div class="use-card">
                <div class="title-use-card">
                  Mã ưu đãi
                </div>
                <div class="code-use-card">
                HOLIDAY12
                </div>
                <button class="btn-use-card" onclick="useDiscount(event)">Sử dụng</button>
              </div>
            </div>
            <div class="discount-card">
              <div class="infor-card">
                <div class="infor-card-main">
                  <div class="title-infor-card">
                    Khuyến mãi Lễ Hội
                  </div>
                  <div class="detail-infor-card">
                  Ưu đãi đặc biệt cho mùa lễ hội
                  </div>
                  <div class="hansudung">
                    Hạn sử dụng : Còn lại 18 ngày
                  </div>
                </div>
              </div>
              <div class="cac-hinh-tron">
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
              </div>
              <div class="use-card">
                <div class="title-use-card">
                  Mã ưu đãi
                </div>
                <div class="code-use-card">
                HOLIDAY12
                </div>
                <button class="btn-use-card" onclick="useDiscount(event)">Sử dụng</button>
              </div>
            </div>
            <div class="discount-card">
              <div class="infor-card">
                <div class="infor-card-main">
                  <div class="title-infor-card">
                    Khuyến mãi Lễ Hội
                  </div>
                  <div class="detail-infor-card">
                  Ưu đãi đặc biệt cho mùa lễ hội
                  </div>
                  <div class="hansudung">
                    Hạn sử dụng : Còn lại 18 ngày
                  </div>
                </div>
              </div>
              <div class="cac-hinh-tron">
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
              </div>
              <div class="use-card">
                <div class="title-use-card">
                  Mã ưu đãi
                </div>
                <div class="code-use-card">
                HOLIDAY12
                </div>
                <button class="btn-use-card" onclick="useDiscount(event)">Sử dụng</button>
              </div>
            </div>
            <div class="discount-card">
              <div class="infor-card">
                <div class="infor-card-main">
                  <div class="title-infor-card">
                    Khuyến mãi Lễ Hội
                  </div>
                  <div class="detail-infor-card">
                  Ưu đãi đặc biệt cho mùa lễ hội
                  </div>
                  <div class="hansudung">
                    Hạn sử dụng : Còn lại 18 ngày
                  </div>
                </div>
              </div>
              <div class="cac-hinh-tron">
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
              </div>
              <div class="use-card">
                <div class="title-use-card">
                  Mã ưu đãi
                </div>
                <div class="code-use-card">
                HOLIDAY12
                </div>
                <button class="btn-use-card" onclick="useDiscount(event)">Sử dụng</button>
              </div>
            </div>
            <div class="discount-card">
              <div class="infor-card">
                <div class="infor-card-main">
                  <div class="title-infor-card">
                    Khuyến mãi Lễ Hội
                  </div>
                  <div class="detail-infor-card">
                  Ưu đãi đặc biệt cho mùa lễ hội
                  </div>
                  <div class="hansudung">
                    Hạn sử dụng : Còn lại 18 ngày
                  </div>
                </div>
              </div>
              <div class="cac-hinh-tron">
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
                <div class="hinhtron"></div>
              </div>
              <div class="use-card">
                <div class="title-use-card">
                  Mã ưu đãi
                </div>
                <div class="code-use-card">
                HOLIDAY12
                </div>
                <button class="btn-use-card" onclick="useDiscount(event)">Sử dụng</button>
              </div>
            </div> -->
    </div>
  </div>
</body>

</html>