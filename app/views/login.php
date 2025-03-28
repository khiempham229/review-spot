<head>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400|Lora');

    body {
      background: #cbc0d3;
    }

    /* div box styling */
    .login-container {
      margin: auto;
      width: 650px;
      height: 550px;
    }

    .welcome {
      background: #f6f6f6;
      width: 650px;
      height: 415px;
      position: absolute;
      top: 25%;
      border-radius: 5px;
      box-shadow: 5px 5px 5px rgba(0, 0, 0, .1);
    }

    .pinkbox {
      position: absolute;
      top: -10%;
      left: 4%;
      background: #eac7cc;
      width: 330px;
      height: 500px;
      border-radius: 5px;
      box-shadow: 2px 0 10px rgba(0, 0, 0, .1);
      transition: all 0.5s ease-in-out;
      z-index: 2;
    }

    .no-display {
      display: none;
      transition: all 0.5s ease;
    }

    .leftbox,
    .rightbox {
      position: absolute;
      width: 50%;
      transition: 1s all ease;
    }

    .leftbox {
      left: -2%;
    }

    .rightbox {
      right: -2%;
    }

    /* font & button styling */
    h1 {
      font-family: 'Open Sans', sans-serif;
      text-align: center;
      margin-top: 95px;
      text-transform: uppercase;
      color: #f6f6f6;
      font-size: 2em;
      letter-spacing: 8px;
    }

    .title {
      font-family: 'Lora', serif;
      color: #8e9aaf;
      font-size: 1.8em;
      line-height: 1.1em;
      letter-spacing: 3px;
      text-align: center;
      font-weight: 300;
      margin-top: 20%;
    }

    .desc {
      margin-top: -8px;
    }

    .login-container .account {
      margin-top: 45%;
      font-size: 10px;
    }

    .login-container p {
      font-family: 'Open Sans', sans-serif;
      font-size: 1em;
      letter-spacing: 2px;
      color: #8e9aaf;
      text-align: center;
    }

    .login-container span {
      color: #eac7cc;
    }

    .flower {
      position: absolute;
      width: 120px;
      height: 120px;
      top: 46%;
      left: 29%;
      opacity: 0.7;
    }

    .smaller {
      width: 90px;
      height: 100px;
      top: 48%;
      left: 38%;
      opacity: 0.9;
    }

    .login-container button {
      padding: 12px;
      font-family: 'Open Sans', sans-serif;
      text-transform: uppercase;
      letter-spacing: 3px;
      font-size: 16px;
      border-radius: 10px;
      margin: auto;
      outline: none;
      display: block;
    }

    .login-container button:hover {
      background: #eac7cc;
      color: #f6f6f6;
      transition: background-color 1s ease-out;
    }

    .login-container .button {
      margin-top: 3%;
      background: #f6f6f6;
      color: #ce7d88;
      border: solid 1px #eac7cc;
    }

    /* form styling */
    .login-container form {
      display: flex;
      align-items: center;
      flex-direction: column;
      padding-top: 7px;
    }

    .more-padding {
      padding-top: 35px;
    }

    .more-padding input {
      padding: 12px;
    }

    .more-padding .submit {
      margin-top: 45px;
    }

    .login-container .submit {
      margin-top: 25px;
      padding: 12px;
      border-color: #ce7d88;
    }

    .login-container .submit:hover {
      background: #cbc0d3;
      border-color: #bfb1c9;
    }

    .login-container input {
      background: #eac7cc;
      width: 65%;
      color: #ce7d88;
      border: none;
      border-bottom: 1px solid rgba(246, 246, 246, 0.5);
      padding: 9px;
      margin: 8px;
    }

    .login-container input::placeholder {
      color: rgba(246, 246, 246, 1);
      letter-spacing: 2px;
      font-size: 1em;
      font-weight: 100;
    }

    .login-container input:focus {
      color: #ce7d88;
      outline: none;
      border-bottom: 1.2px solid rgba(206, 125, 136, 0.7);
      font-size: 1em;
      transition: 0.8s all ease;
    }

    .login-container input:focus::placeholder {
      opacity: 0;
    }

    .login-container label {
      font-family: 'Open Sans', sans-serif;
      color: #ce7d88;
      font-size: 0.8em;
      letter-spacing: 1px;
    }

    .login-container .checkbox {
      display: inline;
      white-space: nowrap;
      position: relative;
      left: -62px;
      top: 5px;
    }

    .login-container input[type=checkbox] {
      width: 7px;
      background: #ce7d88;
    }

    .login-container .checkbox input[type="checkbox"]:checked+label {
      color: #ce7d88;
      transition: 0.5s all ease;
    }

    .error-msg {
      font-size: 10px;
    }
  </style>
</head>

<div class="login-container">
  <div class="welcome">
    <div class="pinkbox">
      <div class="signup no-display">
        <h1>Đăng ký</h1>
        <form id="signupForm" action="/auth/signup" method="POST" autocomplete="off">
          <input type="email" name="email" placeholder="Email*" required>
          <input type="password" name="password" placeholder="Password*" minlength="5" required>
          <p class="error-msg text-danger mb-0" id="passwordError"></p>
          <input type="password" name="confirmPassword" placeholder="Confirm password*" minlength="5" required>
          <p class="error-msg text-danger mb-0" id="confirmPasswordError"></p>
          <input type="text" name="firstName" placeholder="First name">
          <input type="text" name="lastName" placeholder="Last name">
          <button type="submit" class="button submit">Tạo tài khoản</button>
        </form>
      </div>
      <div class="signin">
        <h1>Đăng nhập</h1>
        <form id="signupForm" action="/auth/signin" method="POST" class="more-padding" autocomplete="off">
          <input type="email" name="email" placeholder="Email*" required>
          <input type="password" name="password" placeholder="Password8" required>
          <div class="checkbox">
            <input type="checkbox" id="remember" /><label for="remember">remember me</label>
          </div>

          <button type="submit" class="button submit">Đăng nhập</button>
        </form>
      </div>
    </div>
    <div class="leftbox">
      <h2 class="title"><span>BLOOM</span>&<br>BOUQUET</h2>
      <p class="desc">pick your perfect <span>bouquet</span></p>
      <img class="flower smaller" src="https://image.ibb.co/d5X6pn/1357d638624297b.jpg" alt="1357d638624297b">
      <p class="account">Have an account?</p>
      <button class="button" id="signin">Đăng nhập</button>
    </div>
    <div class="rightbox">
      <h2 class="title"><span>BLOOM</span>&<br>BOUQUET</h2>
      <p class="desc"> pick your perfect <span>bouquet</span></p>
      <img class="flower" src="https://preview.ibb.co/jvu2Un/0057c1c1bab51a0.jpg" />
      <p class="account">Don't have an account?</p>
      <button class="button" id="signup">Đăng ký <? echo $_SESSION['error'] ?></button>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#signup').click(function() {
      $('.pinkbox').css('transform', 'translateX(80%)');
      $('.signin').addClass('no-display');
      $('.signup').removeClass('no-display');
    });

    $('#signin').click(function() {
      $('.pinkbox').css('transform', 'translateX(0%)');
      $('.signup').addClass('no-display');
      $('.signin').removeClass('no-display');
    });

    $("#signupForm").submit(function(event) {
      const password = $("#signupForm input[name='password']").val();
      const confirmPassword = $("#signupForm input[name='confirmPassword']").val();
      let isValid = true;

      // Kiểm tra mật khẩu hợp lệ
      // let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
      // let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)$/;
      // if (!passwordRegex.test(password)) {
      //     $("#passwordError").text("Mật khẩu phải có ít nhất 8 ký tự, chứa chữ hoa, chữ thường và số!");
      //     isValid = false;
      // } else {
      //     $("#passwordError").text("");
      // }

      // Kiểm tra xác nhận mật khẩu
      if (password !== confirmPassword) {
        $("#confirmPasswordError").text("Mật khẩu xác nhận không khớp!");
        isValid = false;
      } else {
        $("#confirmPasswordError").text("");
      }

      if (!isValid) {
        event.preventDefault(); // Ngăn form submit nếu có lỗi
      }
    });
  })
</script>