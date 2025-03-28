
function onEditProfile(event){
    let parent = event.target.parentNode.parentNode;
    parent.querySelector('.row1').style.display = 'none';
    parent.querySelector('.row2').style.display = 'none';
    parent.querySelector('.row3').style.display = 'block';
}

function offEditProfile(event){
  let parent = event.target.parentNode.parentNode;
  parent.querySelector('.row1').style.display = 'flex';
  parent.querySelector('.row2').style.display = 'block';
  parent.querySelector('.row3').style.display = 'none';
}

function offEditProfile1(event){
  let parent = event.target.parentNode.parentNode.parentNode;
  parent.querySelector('.row1').style.display = 'flex';
  parent.querySelector('.row2').style.display = 'block';
  parent.querySelector('.row3').style.display = 'none';
}

function changeNameProfile(event){
  let button = event.target;
  let parent = button.parentNode;
  let errorMess =  parent.querySelector('.errorMes');
  errorMess.innerHTML = "";
  let textHo = document.querySelector('.textHo').value;
  let textTen = document.querySelector('.textTen').value;
  var nameChange = textHo + ' ' + textTen;
  let regex =/^.{6,}$/;
  if(!regex.test(nameChange)){
      errorMess.innerHTML = "Tên người dùng phải có ít nhất 6 ký tự";
      return;
  }
  $.ajax({
      type: 'POST',
      url: './Controller/User.php',
      data: {
        action : 'nameUser',
        nameChange: nameChange },
      success: function(response) {
          alert("Thay đổi tên thành công");
          $('.profile-name-user').html(response);
          $('.tennguoidung').html(response);
          $('.name-user').html(response);
          offEditProfile(event);
      }
  });
}

function changeEmailProfile(event) {
  let button = event.target;
  let parent = button.parentNode;
  let errorMess =  parent.querySelector('.errorMes');
  errorMess.innerHTML = "";
  let emailChange = document.querySelector(".emailProfile").value;
  console.log(emailChange);
  let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regex.test(emailChange)) {
        errorMess.innerHTML = 'Email không hợp lệ (vd : abc@test.sgu)';
        errorMess.style.color = 'red';
        return ;
    }
  $.ajax({
    type : 'POST',
    url : './Controller/User.php',
    data : {
      action :'emailUser',
      emailChange : emailChange
    },
    success  : function(response) {
      $('.email-user').html(response);
      offEditProfile(event);
      errorMess[0].innerHTML = '';
    }
  })
}

function changeAddressProfile(event) {
  let button = event.target;
  let parent = button.parentNode;
  let errorMess =  parent.querySelector('.errorMes');
  errorMess.innerHTML = "";
  let addressChange = document.querySelector(".addressProfile").value;
  console.log(addressChange);
  let regex = /^.{1,}$/;
    if (!regex.test(addressChange)) {
        errorMess.innerHTML = 'Địa chỉ không được để trống';
        errorMess.style.color = 'red';
        return ;
    }
  $.ajax({
    type : 'POST',
    url : './Controller/User.php',
    data : {
      action :'addressUser',
      addressChange : addressChange
    },
    success  : function(response) {
      alert("Thay đổi số địa chỉ thành công");
      $('.address-user').html(response);
      offEditProfile(event);
      errorMess[0].innerHTML = '';
    }
  })
}

function changesdtProfile(event) {
  let button = event.target;
  let parent = button.parentNode;
  let errorMess =  parent.querySelector('.errorMes');
  errorMess.innerHTML = "";
  let sdtChange = document.querySelector(".sdt").value;
  let regex =  /^\d{10,11}$/ ;
  if(!regex.test(sdtChange))
   {
    errorMess.innerHTML = "Số điện thoại không hợp lệ ( Vd : 0375071543 )";
    return ;
   }
  console.log(sdtChange);
  $.ajax({
    type : 'POST',
    url : './Controller/User.php',
    data : {
      action :'sdtUser',
      sdtChange : sdtChange
    },
    success  : function(response) {
      console.log(response);
      alert("Thay đổi số điện thoại thành công");
      $('.sdt-user').html(response);
      offEditProfile(event);
    }
  })
}


