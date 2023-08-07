const form = document.getElementsByTagName("form")[0];

//选中的input元素
const userID = document.getElementById("User ID");
const psw = document.getElementById("psw");
const email = document.getElementById("E-mail");



//选中的span元素，用来显示错误提示消息
const errorID = document.querySelector(".error-ID");
const errorPsw = document.querySelector(".error-psw");
const errorEmail = document.querySelector(".error-email");


//检验UserID字段
userID.addEventListener(
    "input",
    function(){
        const userIDValue = userID.value.trim();
        if(userIDValue.trim()!==""&&userIDValue.length<=10)
        {
            errorID.innerHTML="";
            errorID.className="error-ID";
        }
    },
    false,
);

//检验Password字段

psw.addEventListener(
    "input",
    function(){
        const pswValue = psw.value;
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
        if(passwordRegex.test(pswValue))
        {
            errorPsw.innerHTML="";
            errorPsw.className="error-psw";
        }
    },
    false,
);

email.addEventListener(
    "input",
    function () {
      // 当用户输入信息时，校验 email 字段
      if (email.validity.valid) 
      {
        // 如果校验通过，清除已显示的错误消息
        errorEmail.innerHTML = ""; // 重置消息的内容
        errorEmail.className = "error-email"; // 重置消息的显示状态
      }
      
    },
    false,
  );

form.addEventListener(
    "submit",
    function(event){
        const userIDValue = userID.value.trim();
        const pswValue = psw.value;
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
        if(userIDValue.trim()===""||userIDValue.length>10)
        {
            errorID.innerHTML="UserID can't be empty and exceed 10 characters!";
            errorID.className="error-ID active";
            event.preventDefault();
        }
        if(!passwordRegex.test(pswValue))
        {
            errorPsw.innerHTML="Password can't exceed 8 characters and must contain uppercase and lowercase letters and numbers!";
            errorPsw.className="error-psw active";
            event.preventDefault();
        }
        if(!email.validity.valid){
            errorEmail.innerHTML="Please input a correct email address!";
            errorEmail.className="error-email active";
            event.preventDefault();
        }
        

    },
    false,
);