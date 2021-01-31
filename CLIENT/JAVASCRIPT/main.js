// Javascript for Loading page
setTimeout(function () { $('.loading-screen').fadeToggle(900); }, 1500); // Làm hiển thị (display: block;) hoặc biến mất (display: none;) thành phần kèm với hiệu ứng làm mờ (opacity).

setInterval(function () { $("#Time").load("../HTML/Profile.php #Time"); }, 86400000);


// Javascript for to top
var Totop = document.querySelector(".to-top");
window.addEventListener("scroll", () => 
{
    if (window.pageYOffset > 200) 
    {
        Totop.classList.add("active");
    }
    else 
    {
        Totop.classList.remove("active");
    }
});



// Javascript for toggle menu 
var MenuItems = document.getElementById("MenuItems");
MenuItems.style.maxHeight = "0px";
function menutoggle() 
{
    if (MenuItems.style.maxHeight == "0px") 
    {
        MenuItems.style.maxHeight = "200px";
    }
    else 
    {
        MenuItems.style.maxHeight = "0px";
    }
}



// Link Active
const linkColor = document.querySelectorAll('.choice');
function Choice()
{
    if(linkColor)
    {
        linkColor.forEach(L => L.classList.remove('active'));
        this.classList.add('active');
    }
}
linkColor.forEach(L => L.addEventListener('click', Choice));




// Jquery for Button
$(function () 
{
    $(".btn").on('mouseenter', function (e) 
    {
        x = e.pageX - $(this).offset().left;
        y = e.pageY - $(this).offset().top;
        $(this).find('span').css({ top: y, left: x });
    });

    $(".btn").on('mouseout', function (e) 
    {
        x = e.pageX - $(this).offset().left;
        y = e.pageY - $(this).offset().top;
        $(this).find('span').css({ top: y, left: x });
    });
});



// Javascript for Login page
var LoginForm = document.getElementById("LoginForm");
var RegForm = document.getElementById("RegForm");
var Indicator = document.getElementById("Indicator");
var titlelogin = document.getElementById("title-login");
var titleregister = document.getElementById("title-register");

function register()
{
    RegForm.style.transform = "translateX(0px)";
    LoginForm.style.transform = "translateX(0px)";
    Indicator.style.transform = "translateX(231px)";
    titleregister.style.color = "rgb(255, 0, 0)";
    titlelogin.style.color = "#555";
}

function login()
{
    RegForm.style.transform = "translateX(400px)";
    LoginForm.style.transform = "translateX(400px)";
    Indicator.style.transform = "translateX(18px)";
    titlelogin.style.color = "rgb(0, 110, 255)";
    titleregister.style.color = "#555";
}



// Javascript for SHOW and HIDE Password
var password = document.getElementById("password");
var passwordtoggle = document.getElementById("password-toggle");
function Password_Toggle()
{
    if(password.type === 'password')
    {
        password.type = 'text';
        passwordtoggle.classList.remove('fa-eye-slash');
        passwordtoggle.classList.add('fa-eye');
    }
    else
    {
        password.type = 'password';
        passwordtoggle.classList.remove('fa-eye');
        passwordtoggle.classList.add('fa-eye-slash');
    }
}



// Jquery for Modal
var modalbtn = document.querySelector('.modal-btn');
var modalBg = document.querySelector('.modal-bg');
var modalClose = document.querySelector('.modal-close');
modalbtn.addEventListener('click', function()
{
    modalBg.classList.add('bg-active');
});
modalClose.addEventListener('click', function()
{
    modalBg.classList.remove('bg-active');
});




// Javascript for product gallery 
var productimg = document.getElementById("productimg");
var small_img = document.getElementsByClassName("small-img");
small_img[0].onclick = function () 
{
    productimg.src = small_img[0].src;
}
small_img[1].onclick = function () 
{
    productimg.src = small_img[1].src;
}
small_img[2].onclick = function () 
{
    productimg.src = small_img[2].src;
}
small_img[3].onclick = function () 
{
    productimg.src = small_img[3].src;
}
small_img[4].onclick = function () 
{
    productimg.src = small_img[4].src;
}
small_img[5].onclick = function () 
{
    productimg.src = small_img[5].src;
}















