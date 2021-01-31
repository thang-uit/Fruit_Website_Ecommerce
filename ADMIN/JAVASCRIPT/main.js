// Javascript for Loading page
setTimeout(function () { $('.loader_bg').fadeToggle(900); }, 2000); // Làm hiển thị (display: block;) hoặc biến mất (display: none;) thành phần kèm với hiệu ứng làm mờ (opacity).


// Javascript for Toggle Sidebar
var sidebarOpen = false;
var sidebar = document.getElementById("sidebar");
var sidebarCloseIcon = document.getElementById("sidebarIcon");
function Toggle_Sidebar()
{
    if(!sidebarOpen)
    {
        sidebar.classList.add("sidebar_responsive");
        sidebarOpen = true;
    }
}
function Close_Sidebar()
{
    if(sidebarOpen)
    {
        sidebar.classList.remove("sidebar_responsive");
        sidebarOpen = false;
    }
}



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



